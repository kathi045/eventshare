<?php

/*
 * Startseite
 */

class Home extends Page {
    
    /*
     * in jeder Index-Funktion (der verschiedenen pages) werden der Title des HTML-Heads
     * festgelegt sowie der Content.
     * 
     * showEvents() listet alle aktuellen Events in gekuerzter Fassung auf
     * 
     * updatePastEvents() ueberprueft bei jedem Zugriff auf die Startseite,
     * ob ein Event schon vorbei ist; wenn ja, wird der show-tag in der Datenbank
     * auf 0 gesetzt und das Event erscheint nicht mehr auf der Webseite.
     * 
     * die View-Pages sind fuer den eigentlichen Inhalt (content) verantwortlich, 
     * der angezeigt werden soll; die jeweiligen 
     * Controller (Home, Newevent, Eventdetail usw.) verarbeiten ihn.
     */
    
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