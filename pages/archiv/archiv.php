<?php

class Archiv extends Page {

    function index() {
        
        $archivview = new Archivview();

        $this->set('title', 'eventshare | Archiv');
        $this->set('content', $archivview->showEvents());
    }
}