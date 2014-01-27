<?php

/*
 * Archiv entspricht dem Sub-Menu.
 * Das Menu enthaelt nur die Monate, in denen ein Event stattfindet
 */

class Archiv extends Page {

    function index() {
        
        $archivview = new Archivview();

        $this->set('title', 'eventshare | Archiv');
        $this->set('content', $archivview->showEvents());
    }
}