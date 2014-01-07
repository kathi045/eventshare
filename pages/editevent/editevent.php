<?php

/* 
 * Edit Page Site
 */

class Editevent extends Page {
    
    function index() {
        $editeventview = new Editeventview;
        
        $id = $_GET["id"];
        if($id) {
            $out = $editeventview->getEditEventForm($id);
        }
        else {
            $out = $editeventview->error(1);
        }
        
        $this->set('title', "eventshare | Event bearbeiten");
        $this->set('content', $out);
    }
    
    /**
     * process new event request
     * Neues Event in die Datenbank einspeichern oder Fehlermeldung
     */
    function pr() {
        $this->set('title', "eventshare | Event bearbeiten");
        
        $id_alt = $_GET["id"];
        $editeventview = new Editeventview;
        $neweventview = new Neweventview;
        
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
        $addinfos = $_POST["addinfos"];
        $hashtag = $_POST["hashtag"];
        $tweetembed = $_POST["tweetembed"];
        $lat = $_POST["lat"];
        $lng = $_POST["lng"];
        $flickrembed = $_POST["flickrembed"];
        
        if($tag <= 0 || $tag > 31 || $jahr < date("Y") || $jahr > 2099) {
            $neweventview = new Neweventview;
            $o = $neweventview->error(3) . $editeventview->getEditEventForm($id);
        } elseif($stunden < 0 || $stunden > 23 || $minuten < 0 || $minuten > 59) {
            $neweventview = new Neweventview;
            $o = $neweventview->error(4) . $editeventview->getEditEventForm($id);
        } elseif(!$eventname || !$eventort || !$eventdatum) {
            $neweventview = new Neweventview;
            $o = $neweventview->error(1) . $editeventview->getEditEventForm($id);
        } else {
            /*
             * die veraenderten Daten als neues Event speichern.
             * Beim alten Event "show" auf 0 setzen
             */
            $data = array("name" => $eventname, "ort" => $eventort, "datum" => $eventdatum, 
                "veranstalter" => $veranstalter, "addinfos" => $addinfos, "tweetembed" => $tweetembed, "hashtag" => $hashtag, "lat" => $lat,
                "lng" => $lng, "flickrembed" => $flickrembed);
            $id = insert($data, "event");
            if($id) {
                /*
                 * neue und alte event-IDs in den Changelog einspeichern
                 */
                $changelog_data = array("id_alt" => $id_alt, "id_neu" => $id);
                $ch_id = insert($changelog_data, "changelog");
                /*
                 * $id: ID des neuen, veraenderten Events
                 * $id_alt: id des alten zu aendernden Events
                 * $ch_id: ID des Changelog-Datensatzes
                 */
                if($ch_id) {
                    $arr = array("show" => 0);
                    update($arr, "event", $id_alt, "id");                // damit das alte Event nicht mehr angezeigt wird
                    
                    $o = "<h3>Event erfolgreich ge&auml;ndert!</h3><br>";
                    $eventdetailview = new Eventdetailview();
                    $o .= $eventdetailview->renderEventdetails($id);
                }
                else {
                    $o = $neweventview->error(2);
                }
            } else {
                $o = $neweventview->error(2);
            }
        }
        $this->set('content', $o);
    } 
}