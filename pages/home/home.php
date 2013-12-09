<?php

/*
 * Home site
 */

class Home extends Page {
    
    function index() {
        $this->set('title','eventshare | Home');
        $o = $this->showEvents();
        $this->set('content', $o);
    }
    
    function showEvents() {
        $homeview = new Homeview;
        
        $o = "<h1>Alle Events</h1><br>";
        $ids = simplequery('SELECT `id` FROM `event`');
        foreach ($ids as $id) {
            $o .= $homeview->renderEvent($id['id']);
        }
        
        return $o;
    }
}