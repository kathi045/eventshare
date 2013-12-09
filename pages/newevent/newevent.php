<?php

/*
 *  New event site
 */

class Newevent extends Page {
    
    function index() {
        $neweventview = new Neweventview;
        
        $this->set('title', "eventshare | Neues Event");
        $this->set('content', $neweventview->getEventForm());
    }
    
    function pr() {
        $this->set('title', "eventshare | Neues Event");
        
        $eventname = $_POST["eventname"];
        $eventort = $_POST["eventort"];
        $monat = $_POST["monat"];
        switch($monat) {
            case "Jänner": $monat = 1; break;
            case "Februar": $monat = 2; break;
            case "März": $monat = 3; break;
            case "April": $monat = 4; break;
            case "Mai": $monat = 5; break;
            case "Juni": $monat = 6; break;
            case "Juli": $monat = 7; break;
            case "August": $monat = 8; break;
            case "September": $monat = 9; break;
            case "Oktober": $monat = 10; break;
            case "November": $monat = 11; break;
            case "Dezember": $monat = 12; break;
        }
        $tag = $_POST["tag"];
        $jahr = $_POST["jahr"];
        $stunden = $_POST["stunden"];
        $minuten = $_POST["minuten"];
        $eventdatum = strtotime("$tag.$monat.$jahr $stunden:$minuten");
        $veranstalter = $_POST["veranstalter"];
        
        if(!$eventname || !$eventort || !$eventdatum) {
            $neweventview = new Neweventview;
            $o = $neweventview->error(1) . $neweventview->getEventForm();
        } else {
            $data = array("name" => $eventname, "ort" => $eventort, "datum" => $eventdatum, "veranstalter" => $veranstalter);
            $id = insert($data, "event");
            if($id) {
                $o = "Event erfolgreich angelegt!";
            } else {
                $o = $neweventview->error(2);
            }
        }
        $this->set('content', $o);
    } 
}