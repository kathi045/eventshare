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
    
    /**
     * process new event request
     * Neues Event in die Datenbank einspeichern oder Fehlermeldung
     */
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
        $eventdatum = strtotime("$tag-$monat-$jahr $stunden:$minuten");
        $veranstalter = $_POST["veranstalter"];
        $addinfos = $_POST["addinfos"];
        $hashtag = $_POST["hashtag"];
        $tweetembed = $_POST["tweetembed"];
        //$lat = $_POST["lat"];
        //$lng = $_POST["lng"];
        $adresse = $_POST["adresse"];
        $flickrtag = $_POST["flickrtag"];
        $flickrembed = $_POST["flickrembed"];
        
        $neweventview = new Neweventview;
        
        if($tag <= 0 || $tag > 31 || $jahr < date("Y") || $jahr > 2099) {
            $o = $neweventview->error(3) . $neweventview->getEventForm();
        } elseif($stunden < 0 || $stunden > 23 || $minuten < 0 || $minuten > 59) {
            $o = $neweventview->error(4) . $neweventview->getEventForm();
        } elseif(!$eventname || !$eventort || !$eventdatum) {
            $o = $neweventview->error(1) . $neweventview->getEventForm();
        } else {
            $data = array("name" => $eventname, "ort" => $eventort, "datum" => $eventdatum, 
                "veranstalter" => $veranstalter, "addinfos" => $addinfos, "hashtag" => $hashtag, "adresse" => $adresse, "flickrtag" => $flickrtag, "flickrembed" => $flickrembed);
            $id = insert($data, "event");
            if($id) {
                $o = "<h3>Event erfolgreich angelegt!</h3><br>";
                
                $eventdetailview = new Eventdetailview();
                $o .= $eventdetailview->renderEventdetails($id);
            } else {
                $o = $neweventview->error(2);
            }
        }
        $this->set('content', $o);
    } 
}