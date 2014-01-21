<?php

class Changelog extends Page {
    
    function index() {
        
        $changelogview = new Changelogview;
    
        $this->set('title', 'eventshare | Changelog');
        $this->set('content', $changelogview->showChangelog());
    }
}