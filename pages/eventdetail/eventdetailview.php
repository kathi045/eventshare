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
        if(!$veranstalter) {
            $veranstalter = "-";
        }
        $addinfos = $event[0]["addinfos"];
        $tweetembed = $event[0]["tweetembed"];
        $lat = $event[0]["lat"];
        $lng = $event[0]["lng"];
        $flickrembed = $event[0]["flickrembed"];
        
        $out = "<div class='event'>
                    <div class='eventtitle'>$eventname</div>
                    <div class='eventcontent'>
                        <h2>Ort</h2>
                        $eventort
                        <h2>Datum</h2>
                        $eventdatum
                        <h2>Veranstalter</h2>
                        $veranstalter
                ";
        
        if($addinfos) {
            $out .= "<h2>Zus&auml;tzliche Infos</h2>" . nl2br($addinfos) . "<br><br>";   // new line to break (Zeilenumbrueche)
        }
        
        if($tweetembed) {
            $out .= "<br><img src='img/twitter.png' width='100' alt='Twitter'><br>
                            $tweetembed
                    ";
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