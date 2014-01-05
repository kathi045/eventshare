<?php

class Homeview {
    
    function renderEvent($id) {
        $event = simplequery("SELECT * FROM `event` WHERE `id` = '$id' LIMIT 1");
        if(!$event){
            return $this->error(1);
        }
        $eventname = $event[0]['name'];
        $eventort = $event[0]['ort'];
        $eventdatum = date("d.m.Y, H:i", $event[0]['datum']);
        $veranstalter = $event[0]["veranstalter"];
        if(!$veranstalter) {
            $veranstalter = "-";
        }
        $tweetembed = $event[0]["tweetembed"];
        $lat = $event[0]["lat"];
        $lng = $event[0]["lng"];
        $flickrembed = $event[0]["flickrembed"];
        
        
        $out = "<div class='event'>
                    <div class='eventtitle'><a href=\"?url=eventdetail/index&id=$id\">$eventname</a></div>
                    <div class='eventcontent'>
                        <h2>Ort</h2>
                        $eventort
                        <h2>Datum</h2>
                        $eventdatum
                        <h2>Veranstalter</h2>
                        $veranstalter";
        if($tweetembed) {
            $out .= "<br><img src='img/twitter.png' width='100' alt='Twitter'><br>
                            $tweetembed
                    ";
        }
        if($lat) {
            if($lng) {
                $out .= "<br>$lat $lng";
?>
             
<?php
            }
        }
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
?>