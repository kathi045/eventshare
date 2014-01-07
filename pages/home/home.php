<?php

/*
 * Startseite
 */

class Home extends Page {
    
    function index() {
        $this->updatePastEvents();
        $o = $this->showEvents();
        
        $this->set('title','eventshare | Home');
        $this->set('content', $o);
    }
    
    function showEvents() {
        $homeview = new Homeview;
        
        // Alle Events aus der Datenbank ausgeben und anzeigen
        $o = "<h1>Alle Events</h1><br>";
        $ids = simplequery('SELECT `id` FROM `event` WHERE `show` = 1 ORDER BY `datum`');
        foreach ($ids as $id) {
            $o .= $homeview->renderEvent($id['id']);
        }
        
        return $o;
    }
    
    function updatePastEvents() {
        $events = simplequery("SELECT * FROM `event`");
        foreach($events as $event) {
            $datum = $event['datum'];
            $id = $event['id'];
            if($datum < time()) {
                $arr = array("show" => 0);
                update($arr, "event", $id, "id");
            }
        }
    }
}