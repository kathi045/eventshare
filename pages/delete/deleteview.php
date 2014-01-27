<?php

class Deleteview {
    /*
     * error message, falls beim Loeschen etwas schief laeuft
     */
    function error($par) {
        
        switch($par) {
            case 1: return "<div class='error'>Leider ist etwas schief gegangen. Bitte probiere es noch einmal.</div>";
        }
    }
}