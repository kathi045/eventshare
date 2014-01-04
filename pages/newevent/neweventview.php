<?php

class Neweventview {
    
    function getEventForm() {
        return '
          <h1>Neues Event erstellen</h1>
          <form class="neweventform" action="?url=newevent/pr" method="post">
          
            <h3>Name *</h2>
            <input type="text" name="eventname">

            <h3>Ort *</h2>
            <input type="text" name="eventort">

            <h3>Datum *</h2>
            <input type="text" name="tag" pattern="[1-31]" required value="1" maxlength="2" size="2">
            <select name="monat">
              <option>J&auml;nner</option>
              <option>Februar</option>
              <option>M&auml;rz</option>
              <option>April</option>
              <option>Mai</option>
              <option>Juni</option>
              <option>Juli</option>
              <option>August</option>
              <option>September</option>
              <option>Oktober</option>
              <option>Novemebr</option>
              <option>Dezember</option>
            </select>
            <input type="text" name="jahr" pattern="[2013-2030]" required value="2013" title="Jahr" maxlength="4" size="4">

            <h3>Uhrzeit *</h3>
            <input type="number" name="stunden" min="0" max="23">:
            <input type="number" name="minuten" min="0" max="59">

            <h3>Veranstalter</h3>
            <input type="text" name="veranstalter">
            <br><br><br>

            <h2>Du willst einen Tweet verkn&uuml;pfen?</h2>
            <p>
              Nichts leichter als das.<br>
              Dazu musst du unter dem Tweet einfach auf "Mehr" klicken und "Tweet einbetten" ausw&auml;hlen.<br>
              <img src="img/tweet_embed.png" width="650"><br>
              Jetzt den Code aus dem Textfeld kopieren und in das Feld einf&uuml;gen:
            </p>

            <textarea rows="5" cols="70" name="tweetembed"></textarea>

            <br><br><br>
            <input class="button" type="submit" value="Eintragen"><br><br>
            <p style="font-size: 12px;">Felder mit * m&uuml;ssen ausgef&uuml;llt werden.</p>
            
            <h2>Du willst den Ort an einer Karte anzeigen?</h2>
            <p>
              Nichts leichter als das.<br>
              Dazu musst du nur die Koordinaten (latitude & longitude) eingeben.<br>
            </p>

            <textarea rows="1" cols="12" name="lat"></textarea>
            <textarea rows="1" cols="12" name="lng"></textarea>
            <br><br><br>
            <input class="button" type="submit" value="Eintragen"><br><br>
            
            <p style="font-size: 12px;">Felder mit * m&uuml;ssen ausgef&uuml;llt werden.</p>
          </form>
        ';
    }
    
    function error($par) {
        switch($par) {
            case 1: return '<span class="error">Es m&uuml;ssen alle Felder mit * ausgef&uuml;llt werden!</span>';
            case 2: return '<span class="error">Leider ist etwas schief gelaufen.</span>';
        }
    }
    
    
    
}