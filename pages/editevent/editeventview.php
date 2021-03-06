<?php

/* 
 * Edit Event View
 * 
 * Bestehende Events bearbeiten
 */

class Editeventview {
    
    function getEditEventForm($id) {
        /*
         * Event abrufen, das bearbeitet werden soll
         */
        $event = simplequery("SELECT * FROM `event` WHERE `id` = '$id'");
        if(!$event){
            return;
        }
        $eventname = $event[0]['name'];
        $eventort = $event[0]['ort'];
        $eventdatum = date("d.m.Y, H:i", $event[0]['datum']);
        $veranstalter = $event[0]["veranstalter"];
        $addinfos = $event[0]["addinfos"];
        $hashtag = $event[0]["hashtag"];
        $flickrtag = $event[0]["flickrtag"];
        $fb_id = $event[0]["fb_event_id"];
        $fb_url = "";
        if($fb_id) {
            $fb_url = "https://www.facebook.com/events/" . $fb_id . "/";
        }
        
        return '
          <img class="editeventicon" src="img/edit.png" alt="edit event icon"><h1>Event bearbeiten</h1>
          <form class="neweventform" action="?url=editevent/pr&id=' . $id . '" method="post">
          
            <h3>Name *</h2>
            <input type="text" name="eventname" value="' . $eventname . '">

            <h3>Ort *</h2>
            <input type="text" name="eventort" value="' . $eventort . '">

            <h3>Datum *</h2>
            <input type="text" name="tag" value="' . date("d", $event[0]["datum"]) . '" maxlength="2" size="2">
            <select name="monat">
              <option '.((date("m", $event[0]["datum"])==1)?'selected="selected"':'').'>J&auml;nner</option>
              <option '.((date("m", $event[0]["datum"])==2)?'selected="selected"':'').'>Februar</option>
              <option '.((date("m", $event[0]["datum"])==3)?'selected="selected"':'').'>M&auml;rz</option>
              <option '.((date("m", $event[0]["datum"])==4)?'selected="selected"':'').'>April</option>
              <option '.((date("m", $event[0]["datum"])==5)?'selected="selected"':'').'>Mai</option>
              <option '.((date("m", $event[0]["datum"])==6)?'selected="selected"':'').'>Juni</option>
              <option '.((date("m", $event[0]["datum"])==7)?'selected="selected"':'').'>Juli</option>
              <option '.((date("m", $event[0]["datum"])==8)?'selected="selected"':'').'>August</option>
              <option '.((date("m", $event[0]["datum"])==9)?'selected="selected"':'').'>September</option>
              <option '.((date("m", $event[0]["datum"])==10)?'selected="selected"':'').'>Oktober</option>
              <option '.((date("m", $event[0]["datum"])==11)?'selected="selected"':'').'>November</option>
              <option '.((date("m", $event[0]["datum"])==12)?'selected="selected"':'').'>Dezember</option>
            </select>
            <input type="text" name="jahr" value="' . date("Y", $event[0]["datum"]) . '" title="Jahr" maxlength="4" size="4">

            <h3>Uhrzeit *</h3>
            <input type="number" name="stunden" value="' . date("H", $event[0]["datum"]) . '" style="width:50px;">:
            <input type="number" name="minuten" value="' . date("i", $event[0]["datum"]) . '" style="width:50px;">

            <h3>Veranstalter</h3>
            <input type="text" name="veranstalter" value="' . $veranstalter . '">
            <br><br>
            
            <h3>Zus&auml;tzliche Infos:</h3>
            <textarea rows="5" cols="70" name="addinfos">' . $addinfos . '</textarea>
            <br><br>
            
            <p style="font-size: 12px;">Felder mit * m&uuml;ssen ausgef&uuml;llt werden.</p>
            <br>
            
            <h2>Facebook</h2>
            Event-URL: <input type="text" name="fb_event_url" maxlength="100" size="70" value="' .$fb_url . '">
            <br><br><br>

            <h2>Twitter</h2>
            Hashtag: #<input type="text" name="hashtag" maxlength="20" value="' . $hashtag . '">
            <br><br><br>
            
            <h2>Flickr</h2>
 
            Flickr-Tag: <input type="text" name="flickrtag" maxlength="20" value="' . $flickrtag . '">
            
            <br>
            <br>
            <br>
            <input class="submitbutton" type="submit" value="&Auml;nderungen speichern">
            
            
          </form>
          
          <button class="deletebutton" onclick="checkDelete()">Event l&ouml;schen</button>
          <script>
            function checkDelete() {
                var r = confirm("Bist du dir sicher, dass du das Event löschen willst?");
                if(r == true)
                    this.document.location = "?url=delete&id=' . $id . '";
            }
          </script>
        ';
    }
    
    function error($par) {
        switch($par) {
            case 1: "<div class='error'>Leider ist ein Problem aufgetreten. Bitte noch einmal probieren</div>";
        }
    }
}