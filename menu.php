<?php

/*
 *  Menu-Funktion: Listet die Monate auf, in welchen ein eingespeichertes Event stattfindet
 */

function menu() {
    
    $events = simplequery("SELECT `datum` FROM `event` WHERE `show` = 1 ORDER BY `datum`");
    foreach ($events as $e) {
        $jahr = date("Y", $e['datum']);
        $monat = date("m", $e['datum']);
        if($rem[$jahr.$monat] == 1) {
            continue;
        }
        $rem[$jahr.$monat] = 1;
        
        $m;
        switch($monat) {
            case 1: $m = "Jänner"; break;
            case 2: $m = "Februar"; break;
            case 3: $m = "März"; break;
            case 4: $m = "Aprill"; break;
            case 5: $m = "Mai"; break;
            case 6: $m = "Juni"; break;
            case 7: $m = "Juli"; break;
            case 8: $m = "August"; break;
            case 9: $m = "September"; break;
            case 10: $m = "Oktober"; break;
            case 11: $m = "November"; break;
            case 12: $m = "Dezember"; break;
        }
        
        $o .= "<li><a href=?url=archiv&m=" . $monat . "&j=" . $jahr . ">" . $m . " " . $jahr . "</a></li>";
    }
    echo $o;
}