<?php

/*
 * Home site
 */

class Home extends Page {
    
    function index() {
        $o = $this->showEvents();
        
        $this->set('title','eventshare | Home');
        $this->set('content', $o);
    }
    
    function showEvents() {
        $homeview = new Homeview;
        
        // Alle Events aus der Datenbank ausgeben und anzeigen
        $o = "<h1>Alle Events</h1><br>";
        $ids = simplequery('SELECT `id` FROM `event` ORDER BY `datum`');
        foreach ($ids as $id) {
            $o .= $homeview->renderEvent($id['id']);
        }
        
        return $o;
    }
}