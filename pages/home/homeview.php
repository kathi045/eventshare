<?php

class Homeview {
    
    function renderEvent($id) {
        $event = simplequery("SELECT * FROM `event` WHERE `id` = '$id'");
        if(!$event){
            return;
        }
        $eventname = $event[0]['name'];
        $eventort = $event[0]['ort'];
        $eventdatum = date("d.m.Y, H:i", $event[0]['datum']);
        $veranstalter = $event[0]["veranstalter"];
        
        $out = "<div class='event'>
                  <div class='event_rechts'>
                        <a class='button' href='?url=editevent&id=".$id."'>Event bearbeiten</a>
                  </div>
                  <div class='event_links'>
                    <div class='eventtitle'><a href=\"?url=eventdetail/index&id=$id\">$eventname</a></div>
                    <div class='eventcontent'>
                        <h2>Ort</h2>
                        $eventort
                        <h2>Datum</h2>
                        $eventdatum";
        
        if($veranstalter) {
            $out .= "<h2>Veranstalter</h2>
                        $veranstalter";
        }
        
        $out .= "</div></div></div><br>";
        
        return $out;
    }
    
    function error($par) {
        switch($par) {
            case 1: return '<div class="error">Event does not exist</div>';
        }
    }
}