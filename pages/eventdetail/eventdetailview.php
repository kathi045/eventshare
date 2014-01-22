<?php 

include "classes/twitteroauth.php";

class Eventdetailview {

    function renderEventdetails($id) {
        $event = simplequery("SELECT * FROM `event` WHERE `id` = '$id'");
        if(!$event){
            return;
        }
        $eventname = $event[0]['name'];
        $eventort = $event[0]['ort'];
        $eventdatum = date("d.m.Y, H:i", $event[0]['datum']);
        $veranstalter = $event[0]["veranstalter"];
        $addinfos = $event[0]["addinfos"];
        $hashtag = $event[0]["hashtag"];
        //$lat = $event[0]["lat"];
        //$lng = $event[0]["lng"];
        $adresse = $event[0]["adresse"];
        $flickrtag = $event[0]["flickrtag"];
        $flickrembed = $event[0]["flickrembed"];
        
        $out = "<div class='event'>
                <div class='event_rechts'>
                    <a class='button' href='?url=editevent&id=".$id."'><img class='editicon_mini' src='img/edit.png'>Event bearbeiten</a>
                </div>
                <div class='event_links'>
                    <div class='eventtitle'>$eventname</div>
                    <div class='eventcontent'>
                        <h2>Ort</h2>
                        $eventort
                        <h2>Datum</h2>
                        $eventdatum";
        
        if($veranstalter) {
            $out .= "<h2>Veranstalter</h2>
                        $veranstalter";
        }
        
        if($addinfos) {
            $out .= "<h2>Zus&auml;tzliche Infos</h2>" . nl2br($addinfos) . "<br><br>";   // nl2b: new line to break (Zeilenumbrueche)
        }
        
        //Twitter Hashtag --- reference: https://dev.twitter.com/docs/api/1.1/get/search/tweets, tutorial: http://www.youtube.com/watch?v=iPnGB7a7dO0
        if($hashtag) {
            
            $consumer = "1stozpaVb8gfSdd15XI6xQ";
            $consumersecret = "9scMIXAMJdZsPrTCeFyDPB35QU4aXcnkAoQ1u38Y";
            $accesstoken = "2279704992-8Mf75D8VWn8VlRIc3oZbMnlyvR4c045Sl22r3am";
            $accesstokensecret = "olZqD6MOdr86yv0qE56J5Q15QEQyB1mwnhX2cXtS8qzaZ";
            
            $out .= '<nr><br><br><img src="img/twitter_logo.png" alt="Twitter Bird" height="30px"><span class="hashtag">#' . $hashtag . '</span><br>';
            
            $twitter = new TwitterOAuth($consumer, $consumersecret, $accesstoken, $accesstokensecret);
            $tweets = $twitter->get('https://api.twitter.com/1.1/search/tweets.json?q=%23'.$hashtag.'&result_type=mixed');    //%23 wird als # aufgelöst (Hashtag)    //weitere Parameter: https://dev.twitter.com/docs/api/1.1/get/search/tweets
            
            $count = 0;
            foreach($tweets as $tweet) {
                foreach($tweet as $t) {
                    $count++;
                    if($count == 10) {
                        break;
                    }
                    $out .= '<div class="tweets"><img src="'.$t->user->profile_image_url.'" />';
                    $out .= '<span class="twittername">    ' . $t->user->name . '</span><br>';
                    $out .= '<div class="twittertext">' . $t->text.'</div></div><br>';                                        //text gibt den Tweet aus
                }
                if($count == 10) {
                    break;
                }
            }
        }
        
        /*
        // Google Maps x and y coords --- reference: http://w3schools.com/googleAPI/default.asp
        if($lat && $lng) {                
                $out .= '<br><img src="img/google_maps_logo.png" width="200" alt="Google Maps"><br>
                        <script>
                            function initialize() {
                                var myCenter = new google.maps.LatLng(' . $lat . ',' . $lng . ');
                                var mapProp = {
                                    center:myCenter,
                                    zoom:13,
                                    mapTypeId:google.maps.MapTypeId.ROADMAP
                                };
                                var map=new google.maps.Map(document.getElementById("googleMap' . $id . '"),mapProp);
                                
                                var marker=new google.maps.Marker({
                                    position:myCenter,
                                    });

                                marker.setMap(map);
                            }

                            google.maps.event.addDomListener(window, "load", initialize);
                        </script>
                        <div id="googleMap' . $id . '" style="width:500px; height:380px;"></div>
                        '
                        ;
        }
         * 
         */           
        /*
         *  Google Maps Geocoder: https://developers.google.com/maps/documentation/javascript/examples/geocoding-simple?csw=1
         * 
         *  Wandelt die Adresse des Event-Orts gleich in die Koordinaten um
         *  und erstellt dann eine Google Map mit dem Ort als Marker
         */
        $out .= '<br><img src="img/google_maps_logo.png" width="200" alt="Google Maps"><br>
                <script>
                var geocoder;
                var map;
                function initialize() {
                  geocoder = new google.maps.Geocoder();
                  var latlng = new google.maps.LatLng(-34.397, 150.644);
                  var mapOptions = {
                    zoom: 13,
                    center: latlng
                  }
                  map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
                  codeAddress();
                }

                function codeAddress() {
                    var address = "' . $eventort . '";
                    geocoder.geocode( { "address": address}, function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                          map.setCenter(results[0].geometry.location);
                          var marker = new google.maps.Marker({
                              map: map,
                              position: results[0].geometry.location
                          });
                        } else {
                          alert("Geocode was not successful for the following reason: " + status);
                        }
                  });
                }
                google.maps.event.addDomListener(window, "load", initialize);
                </script>
                <div id="map-canvas"></div>
                ';
        
        /*
         * flickr photo tag  // API reference: http://www.flickr.com/services/api/
         */
        if($flickrtag) {
             
            $out .= "Flickr-Photos mit Tag $flickrtag:<br>";
            
            $flickrkey = "27d0025e89ef414fcc5671a3dcad6ed6";
            
            $flickrurl = "http://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=" . $flickrkey . "&tags=" . $flickrtag . "&per_page=5&format=rest";        
            $photolist = file_get_contents($flickrurl);
        
            print_r($flickrurl);    //TEST: URL PASST
            print_r($photolist);    //TEST: WIRD NICHT AUSGEGEBEN!!!
            
            foreach ($photolist->rsp->photos->photo as $photo) {
                    $flickrurl = "http://farm" . $photo[farm] . ".staticflickr.com" . $photo[server] . "/" . $photo[id] . "_" . $photo[secret] . "_q.jpg";  // q am Ende steht für die Größe. Liste der Größenangaben: http://www.flickr.com/services/api/misc.urls.html
                    $out .= '<div><img border="0" alt="'. $photo[title] . '" src="
                        ' . $flickrurl . '" /><br /><p>' . $photo[title] . '</p></div>';
            }
            
        }
        
        // flickr photo album
        if($flickrembed) {
            $out .= "<br>$flickrembed";
        }
        
        $out .= "</div></div></div><br>";
        
        return $out;
    }
    
    function error($par) {
        switch($par) {
            case 1: return '<span class="error"does not exist</span>';
        }
    }
    
}