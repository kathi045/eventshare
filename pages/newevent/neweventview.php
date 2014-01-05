<?php

class Neweventview {
    
    function getEventForm() {
        return '
          <h1>Neues Event erstellen</h1>
          <form class="neweventform" action="?url=newevent/pr" method="post">
          
            <h3>Name *</h2>
            <input type="text" name="eventname" value="' . $_POST["eventname"] . '">

            <h3>Ort *</h2>
            <input type="text" name="eventort" value="' . $_POST["eventort"] . '">

            <h3>Datum *</h2>
            <input type="text" name="tag" value="' . $_POST["tag"] . '" maxlength="2" size="2">
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
            <input type="text" name="jahr" value="' . $_POST["jahr"] . '" title="Jahr" maxlength="4" size="4">

            <h3>Uhrzeit *</h3>
            <input type="number" name="stunden" value="' . $_POST["stunden"] . '" style="width:50px;">:
            <input type="number" name="minuten" value="' . $_POST["minuten"] . '" style="width:50px;">

            <h3>Veranstalter</h3>
            <input type="text" name="veranstalter" value="' . $_POST["veranstalter"] . '">
            <br><br>
            
            <h3>Zus&auml;tzliche Infos:</h3>
            <textarea rows="5" cols="70" name="addinfos">' . $_POST["addinfos"] . '</textarea>
            <br><br>
            
            <p style="font-size: 12px;">Felder mit * m&uuml;ssen ausgef&uuml;llt werden.</p>
            <br>

            <h2>Du willst einen Tweet mit dem Event verkn&uuml;pfen?</h2>
            <p>
              Nichts leichter als das.<br>
              Dazu musst du unter dem Tweet einfach auf "Mehr" klicken und "Tweet einbetten" ausw&auml;hlen.<br>
              <img src="img/tweet_embed.png" width="650"><br>
              Jetzt den Code aus dem Textfeld kopieren und in das Feld einf&uuml;gen:
            </p>

            <textarea rows="5" cols="70" name="tweetembed" value="' . $_POST["tweetembed"] . '"></textarea>

            <br><br><br>
            
            <h2>Oder den Ort in einer Google Map anzeigen lassen?</h2>
            <p>
              Dazu musst du im Google Maps auf den jeweiligen Ort rechtsklicken, dann "Was ist hier?" ausw&auml;hlen und die Koordinaten, die oben im Suchfeld erscheinen, hier eingeben.
              <img src="img/googlemaps_wasisthier.png" width="400"><br>
            </p>
            
            <p><strong>Erste Zahl:</strong> (z.B. 48.211941)</p>
            <input type="text" name="lat" value="' . $_POST["lat"] . '"><br>
            <p><strong>Zweite Zahl:</strong> (z.B. 16.376848)</p>
            <input type="text" name="lng" value="' . $_POST["lng"] . '">
            <br><br><br>
            
            <h2>Oder vielleicht ein Foto von Flickr hinzuf&uuml;gen?</h2>
            <p>
              Daf&uuml;r auf das Symbol mit dem Pfeil klicken und den HTML-Code im Textfeld unten einf&uuml;gen.
              <img src="img/flickr_embed.jpg" width="650"><br>
            </p>

            <textarea rows="5" cols="70" name="flickrembed" value="' . $_POST["flickrembed"] . '"></textarea>
            <br><br><br>
            <input class="button" type="submit" value="Eintragen"><br><br>
            
            
          </form>
        ';
    }
    
    function error($par) {
        echo $par;
        switch($par) {
            case 1: return '<span class="error">Es m&uuml;ssen alle Felder mit * ausgef&uuml;llt werden!</span>';
            case 2: return '<span class="error">Leider ist etwas schief gelaufen.</span>';
            case 3: return '<span class="error">Bei der Datumeingabe ist etwas schief gegangen.</span>';
            case 4: return '<span class="error">Bei der Uhrzeiteingabe ist etwas schief gegangen.</span>';
        }
    }
    
    
    
}