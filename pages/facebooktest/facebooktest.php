<?php

/*
 *  Facebook testing site
 */

class Facebooktest extends Page {
    
    function index() {
        $facebooktestview = new Facebooktestview;
        
        $api_key = '557224121020260';
        $secret  = 'f76394118a2abebaf00e19ce3215bc0a';
        
        include_once './facebook-platform/php/facebook.php';
        
        $facebook = new Facebook($api_key, $secret);
        $user = $facebook->require_login();
        
        $this->set('title', "eventshare | Facebooktest");
        $this->set('content', $facebooktestview->printPage());
    }
    
}