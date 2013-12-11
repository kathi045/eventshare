<?php

class Facebooktestview {
    
    function printPage() {
        $out = "
            <h1>Facebook Test</h1>
            Hello <fb:name uid='$user' useyou='false' possessive='true' />! <br>
        ";
        return $out;
    }
    
    function error($par) {

    }
    
    
    
}