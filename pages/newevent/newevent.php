<?php

/*
 *  New event site
 */

class Newevent extends Page {
    
    function index() {
        $neweventview = new Neweventview;
        
        $this->set('title', "eventshare | Neues Event");
        $this->set('content', $neweventview->getEventForm());
    }
    
}