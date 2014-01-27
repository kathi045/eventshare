<?php

class Delete extends Page {
    
    function index() {
        
        $this->set('title', 'eventshare | Event l&ouml;schen');
        $this->set('content', $this->pr());
    }
    
    // event mit der angegebenen ID soll geloescht werden (d.h. nicht komplett
    // geloescht, sondern nur ein tag setzen, damit das event nicht mehr aufscheint
    function pr() {
        
        $deleteview = new Deleteview;
        
        $id = $_GET['id'];
        if($id) {
            /*
             * zuerst muss ueberprueft werden, ob das event mit der ID ueberhaupt
             * existiert und auch noch angezeigt wird
             */
            $check_id = simplequery("SELECT `id` FROM `event` WHERE `id` = " . $id . " AND `show` = 1");
            if(!$check_id) {
                return $deleteview->error(1);
            }
            // event soll auf der Startseite nicht mehr aufscheinen
            $arr = array("show" => 0);
            // im Changelog als geloescht markieren
            $arr1 = array("id_alt" => $id, "id_neu" => $id, "delete" => 1, "datum" => time());
            
            update($arr, "event", $id, "id");
            $ch_id = insert($arr1, "changelog");
            
            if($ch_id) {
                $o = "<h3>Du hast dieses Event erfolgreich gel&ouml;scht!</h3>";
            } else {
                $o = $deleteview->error(1);
            }
        } else {
            $o = $deleteview->error(1);
        }
        return $o;
    }
}