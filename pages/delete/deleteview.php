<?php

class Deleteview {
    
    function error($par) {
        
        switch($par) {
            case 1: return "<div class='error'>Leider ist etwas schief gegangen. Bitte probiere es noch einmal.</div>";
        }
    }
}