<?php

class Impressum extends Page {

    function index() {

        $this->set('title', 'eventshare | Impressum');
        $this->set('content', $this->showImpressum());
    }

    function showImpressum() {

        $o = "<h1>Impressum</h1>
                <h2>eventshare:</h2>
                Vorgartenstraße 54<br>
                A-1200 Wien
                <br><br>
                <h2>e-mail:</h2>
                roman.habitzl@gmx.net (Roman Habitzl)<br>
                katharina.tagwerker@outlook.com (Katharina Tagwerker)<br>
                michal.hanzen@gmail.com (Michal Hanzen)
                <br><br>
                Die Betreiber der Webseite übernehmen keine Haftung f&uuml;r den Inhalt
                von verkn&uuml;pften Social Media Beitr&auml;gen.
             ";
        return $o;
    }
}