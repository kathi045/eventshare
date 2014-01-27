<?php

class Archivview {
    
    /*
     * Monat und Jahr werden aus der URL abgefragt und Events, die in dieser Zeit
     * stattfinden, angezeigt
     */
    
    function showEvents() {
        $homeview = new Homeview;
        $m = $_GET['m'];
        $j = $_GET['j'];
        
        $monat;
        
        switch($m) {
            case 1: $monat = "Jänner"; break;
            case 2: $monat = "Februar"; break;
            case 3: $monat = "März"; break;
            case 4: $monat = "Aprill"; break;
            case 5: $monat = "Mai"; break;
            case 6: $monat = "Juni"; break;
            case 7: $monat = "Juli"; break;
            case 8: $monat = "August"; break;
            case 9: $monat = "September"; break;
            case 10: $monat = "Oktober"; break;
            case 11: $monat = "November"; break;
            case 12: $monat = "Dezember"; break;
        }

        // Alle Events aus der Datenbank ausgeben und anzeigen
        $o = "<h1>Archiv: " . $monat . " " . $j . "</h1><br>";
        $ids = simplequery('SELECT `id`,`datum` FROM `event` WHERE `show` = 1 ORDER BY `datum`');
        if(!$ids) {
            return;
        }
        foreach ($ids as $id) {
            $monat = date("m", $id['datum']);
            $jahr = date("Y", $id['datum']);
            if($monat == $m && $jahr == $j) {
                $o .= $homeview->renderEvent($id['id']);
            }
        }

        return $o;
    }
}