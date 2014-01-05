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
        
        $out = "<div class='event'>
                    <div class='eventtitle'><a href=\"?url=eventdetail/index&id=$id\">$eventname</a></div>
                    <div class='eventcontent'>
                        <h2>Ort</h2>
                        $eventort
                        <h2>Datum</h2>
                        $eventdatum
                        <h2>Veranstalter</h2>
                        $veranstalter";
        
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