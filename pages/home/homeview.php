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
                    <div class='eventtitle'>$eventname</div>
                    <div class='eventcontent'>
                        <h3>Ort</h3>
                        $eventort
                        <h3>Datum</h3>
                        $eventdatum
                        <h3>Veranstalter</h3>
                        $veranstalter
                    </div>
               </div><br>
        ";
        
        return $out;
    }
    
    function error($par) {
        switch($par) {
            case 1: return '<span class="error"does not exist</span>';
        }
    }
}