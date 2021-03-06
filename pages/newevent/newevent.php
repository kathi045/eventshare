<?php

/*
 *  New event site: hier werden neue Events erstellt und in die Datenbank
 * gespeichert.
 */

class Newevent extends Page {
    
    function index() {
        $neweventview = new Neweventview;
        
        $this->set('title', "eventshare | Neues Event");
        $this->set('content', $neweventview->getEventForm());
    }
    
    /**
     * process new event request
     * Neues Event in die Datenbank einspeichern oder Fehlermeldung ausgeben.
     * 
     * die Post-Variablen werden ueberprueft und entweder eingespeichert oder
     * es wird eine Fehlermeldung angezeigt und das Formular erscheint erneut 
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
        $fb_event_url = $_POST["fb_event_url"];
        $hashtag = $_POST["hashtag"];
        $flickrtag = $_POST["flickrtag"];
        
        
        //fb_event_url in fb_event_id umwandeln
        $lastIndex = strrpos($fb_event_url, "/");
        $startIndex = strpos($fb_event_url, "events/") + 7;
        $length = $lastIndex - $startIndex;
        $fb_event_id = substr($fb_event_url, $startIndex, $length);
    
        
        
        $neweventview = new Neweventview;
        
        /*
         * wenn nicht alle obligaten Felder ausgefuellt sind, wird der Benutzer
         * auf das Formular zurueckverwiesen und er muss die entsprechenden Felder
         * ausfuellen.
         */
        if($tag <= 0 || $tag > 31 || $jahr < date("Y") || $jahr > 2099) {
            $o = $neweventview->error(3) . $neweventview->getEventForm();
        } elseif($stunden < 0 || $stunden > 23 || $minuten < 0 || $minuten > 59) {
            $o = $neweventview->error(4) . $neweventview->getEventForm();
        } elseif(!$eventname || !$eventort || !$eventdatum) {
            $o = $neweventview->error(1) . $neweventview->getEventForm();
        } else { // alle wichtigen Felder sind ausgefuellt
            $data = array("name" => $eventname, "ort" => $eventort, 
                "datum" => $eventdatum, "veranstalter" => $veranstalter, 
                "addinfos" => $addinfos, "fb_event_id" => $fb_event_id, 
                "hashtag" => $hashtag, "flickrtag" => $flickrtag);
            $id = insert($data, "event");
            if($id) {
                $o = "<h3>Event erfolgreich angelegt!</h3><br>";
                
                // nach dem erfolgreichen Einspeichern wird das erstellte
                // Event gleich angezeigt
                $eventdetailview = new Eventdetailview();
                $o .= $eventdetailview->renderEventdetails($id);
            } else {
                /*
                 * die Datenbank hat keine id zurückgegeben, daher muss wo
                 * ein Fehler passiert sein. Aktion wird abgebrochen
                 */
                $o = $neweventview->error(2);
            }
        }
        $this->set('content', $o);
    } 
}