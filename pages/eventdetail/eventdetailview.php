<?php 

include "classes/twitteroauth.php";
include "classes/facebook.php";

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
        $fb_event_id = $event[0]["fb_event_id"];
        $hashtag = $event[0]["hashtag"];
        //$lat = $event[0]["lat"];
        //$lng = $event[0]["lng"];
        $adresse = $event[0]["adresse"];
        $flickrtag = $event[0]["flickrtag"];
        $flickrembed = $event[0]["flickrembed"];
        
        //JavaScript Funktion zum Toggeln der Visibility
        $out = '<script type="text/javascript">
            function toggle_visibility(id) {
                var e = document.getElementById(id);
                if(e.style.display == ' . "'block'" . ')
                    e.style.display = ' . "'none'" . ';
                else
                    e.style.display = ' . "'block'" . ';
            }
        </script>';
        
        $out .= "<div class='event'>
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
        
        $out .= '<br><br><img src="img/google_maps_logo.png" width="200" alt="Google Maps"><br>
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
        
                
        
        
        
        //Facebook Event
        //API Event Documentation:  https://developers.facebook.com/docs/graph-api/reference/event/
        if ($fb_event_id) {
            
            $app_id = "557224121020260";
            $app_secret = "f76394118a2abebaf00e19ce3215bc0a";
            
            $fb_config = array(
                'appId' => $app_id,
                'secret' => $app_secret,
                'fileUpload' => false, // optional
                'allowSignedRequest' => false, // optional, but should be set to false for non-canvas apps
            );
          
            $facebook = new Facebook($fb_config);
            
            $out .= '<br><br><div><a name="facebook" href="#facebook" onclick="toggle_visibility(' . "'facebook'" . ');">Facebook</a></div><br>';
            $out .= '<div id="facebook" class="event_social" style="display:none">';
            
            $out .= "<h2>Facebook Event:</h2>";
 
            $fb_pic = $facebook->api("/" . $fb_event_id . "?fields=picture.width(99999).height(99999)");    //mit diesen Werten wird das größte verfügbare Bilde genommen, ansonsten skaliert FB die meisten Bilder runter
            $fb_pic = $fb_pic['picture']['data']['url'];
            $out .= '<img src="' . $fb_pic . '" alt="Facebook Picture"><br>';
            
            $fb_link = "https://www.facebook.com/events/" . $fb_event_id . "/";            
            $fb_name = $facebook->api("/" . $fb_event_id . "?fields=name");
            $fb_name = $fb_name['name'];
            
            $out .= '<strong><a href="' . $fb_link . '">' . $fb_name . "</a></strong><br><br>";
            
            $attending = $facebook->api("/" . $fb_event_id . "/attending");
            $attending = $attending['data'];
            
            $out .= count($attending) . " G&auml;ste haben zugesagt!<br><br>";
            
            //wenn mehr als 20 Teilnehmer dabei sind, werden sie nebeneinander gelistet
            foreach ($attending as $attendee) {
                $out .= '<a href="https://www.facebook.com/' . $attendee['id'] . '">' . $attendee['name'] . "</a>";
                if (count($attending) > 20) {
                    $out .= ", ";
                }
                else {
                    $out .= "<br>";
                }
            }
            
            $out .= '<br><br><br><strong>Neueste Kommentare:</strong><br><br>';
            
            $feed = $facebook->api("/" . $fb_event_id . "/feed");
            $feed = $feed['data'];
            
            foreach ($feed as $post) {
                if ($post['type'] == "status") {
                    $out .= '<a href="https://www.facebook.com/' . $post['from']['id'] . '">' . $post['from']['name'] . "</a><br>";
                    $out .= $post['message'] . "<br><br>";
                }
                if ($post['story']) {
                    $out .= '<a href="https://www.facebook.com/' . $post['from']['id'] . '">' . $post['from']['name'] . "</a><br>";                   
                    $out .= $post['story'] . "<br>";
                    if ($post['type'] == "photo") {
                        $out .= '<img src="' . $post['picture'] . '" alt="Facebook Photo"><br>';
                    }
                    $out .= "<br>";
                }
            }       
            $out .= '<br><a href="#facebook">Nach oben.</a>';
            $out .= "</div>";   //Ende des Facebook Wrappers
        }
        
        
        //Twitter Hashtag --- reference: https://dev.twitter.com/docs/api/1.1/get/search/tweets, tutorial: http://www.youtube.com/watch?v=iPnGB7a7dO0
        if($hashtag) {
            
            $consumer = "1stozpaVb8gfSdd15XI6xQ";
            $consumersecret = "9scMIXAMJdZsPrTCeFyDPB35QU4aXcnkAoQ1u38Y";
            $accesstoken = "2279704992-8Mf75D8VWn8VlRIc3oZbMnlyvR4c045Sl22r3am";
            $accesstokensecret = "olZqD6MOdr86yv0qE56J5Q15QEQyB1mwnhX2cXtS8qzaZ";

            $out .= '<br><br><div><a name="twitter" href="#twitter" onclick="toggle_visibility(' . "'twitter'" . ');">Twitter</a></div><br>';
            $out .= '<div id="twitter" class="event_social" style="display:none">';
            
            $out .= '<nr><img src="img/twitter_logo.png" alt="Twitter Bird" height="30px"><span class="hashtag">#' . $hashtag . '</span><br>';
            
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
            $out .= '<br><a href="#twitter">Nach oben.</a>';
            $out .= "</div>";   //Ende des Twitter Wrappers            
        }
        

        /*
         * flickr photo tag  // API reference: http://www.flickr.com/services/api/
         */
        if($flickrtag) {
            
            $out .= '<br><br><div><a name="flickr" href="#flickr" onclick="toggle_visibility(' . "'flickr'" . ');">Flickr</a></div><br>';
            $out .= '<div id="flickr" class="event_social" style="display:none">';
                         
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
            $out .= '<br><a href="#flickr">Nach oben.</a>';
            $out .= "</div>";   //Ende des Flickr Wrappers
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