<?php

/*
 * Home site
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