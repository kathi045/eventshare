<?php

class Changelogview {

    /*
     * es werden untereinander jeweils das originale und das geaenderte Event
     * angezeigt. So kann man gut die Veraenderungen der Benutzer mitverfolgen
     * und auch faelschlich geaenderte oder geloeschte Events wieder aufs Original
     * zuruecksetzen
     */
    
    function showChangelog() {
        $o = "<h1>Changelog</h1>";
        // ganzen Changelog-table abfragen
        $ch_ids = simplequery('SELECT * FROM `changelog` ORDER BY `id` DESC');
        foreach ($ch_ids as $ch_id) {
            $id_neu = simplequery("SELECT * FROM `event` WHERE `id` = " . $ch_id['id_neu']);
            $id_alt = simplequery("SELECT * FROM `event` WHERE `id` = " . $ch_id['id_alt']);
            $id_neu = $id_neu[0];
            $id_alt = $id_alt[0];
            $o .= '<h2>*** id_neu: ' . $id_neu['id'] . ' id_alt: ' . $id_alt['id'] . '***</h2>
                    ge&auml;ndert am: ' . date("d.m.Y, H:i", $ch_id["datum"]) . '<br>
                    <h3><u>Neues Event:</u></h3>
                    <strong>Name: </strong>' . $id_neu['name'] . '<br>
                    <strong>Ort: </strong>' . $id_neu['ort'] . '<br>
                    <strong>Datum: </strong>' . $id_neu['datum'] . '<br>
                    <strong>Veranstalter: </strong>' . $id_neu['veranstalter'] . '<br>
                    <strong>Hashtag: </strong>#' . $id_neu['hashtag'] . '<br>
                    <strong>Latitude: </strong>' . $id_neu['lat'] . '<br>
                    <strong>Longitude: </strong>' . $id_neu['lng'] . '<br>
                    <strong>Flickr-Tag: </strong>' . $id_neu['flickrtag'] . '<br>
                    <strong>flickrembed: </strong>' . $id_neu['flickrembed'] . '<br>
                    <strong>Additional Info: </strong><br>' . $id_neu['addinfos'] . '<br>
                  ';
            if($ch_id['delete'] == 1) {
                $o .= '<br><span style="color: red;">EVENT WURDE GEL&Ouml;SCHT</span><br><br>';
            } else {
                $o .= '<h3><u>Altes Event:</u></h3>
                    <strong>Name: </strong>' . $id_alt['name'] . '<br>
                    <strong>Ort: </strong>' . $id_alt['ort'] . '<br>
                    <strong>Datum: </strong>' . $id_alt['datum'] . '<br>
                    <strong>Veranstalter: </strong>' . $id_alt['veranstalter'] . '<br>
                    <strong>Hashtag: </strong>#' . $id_alt['hashtag'] . '<br>
                    <strong>Latitude: </strong>' . $id_alt['lat'] . '<br>
                    <strong>Longitude: </strong>' . $id_alt['lng'] . '<br>
                    <strong>Flickr-Tag: </strong>' . $id_alt['flickrtag'] . '<br>
                    <strong>flickrembed: </strong>' . $id_alt['flickrembed'] . '<br>
                    <strong>Additional Info: </strong><br>' . $id_alt['addinfos'] . '<br><br>
                  ';
            }
        }
        return $o;
    }
}