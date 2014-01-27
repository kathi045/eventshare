<?php

/*
 * Event-Detail Seite
 * 
 * Hier werden alle Informationen zu dem verlinkten Event aus der Datenbank
 * ausgelesen und angezeigt.
 * 
 * Ebenso gibt es auf dieser Seite den Button, um das Event zu bearbeiten zu koennen.
 */

class Eventdetail extends Page {
    
    function index() {
        $o = $this->showEvent();
        
        $this->set('title','eventshare | Event');
        $this->set('content', $o);
    }
    
    function showEvent() {
        $eventdetailview = new Eventdetailview;
        
        $id = $_GET['id'];
        // Ein Event aus der Datenbank ausgeben und anzeigen
        $o = "<h1>Event</h1><br>";
        $o .= $eventdetailview->renderEventdetails($id);
        
        
        return $o;
    }
}