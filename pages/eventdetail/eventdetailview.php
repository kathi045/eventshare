<?php 

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
        $tweetembed = $event[0]["tweetembed"];
        $hashtag = $event[0]["hashtag"];
        $lat = $event[0]["lat"];
        $lng = $event[0]["lng"];
        $flickrembed = $event[0]["flickrembed"];
        
        $out = "<div class='event'>
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
        
        if($tweetembed) {
            $out .= "<br><img src='img/twitter.png' width='100' alt='Twitter'><br>$tweetembed";
        }
        
        //Twitter Hashtag
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
        
        // Google Maps x and y coords
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
        
        // flickr photo album
        if($flickrembed) {
            $out .= "<br>$flickrembed";
        }
        
        $out .= "</div>
               </div><br>";
        
        return $out;
    }
    
    function error($par) {
        switch($par) {
            case 1: return '<span class="error"does not exist</span>';
        }
    }
}