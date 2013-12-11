<?php

class Neweventview {
    
    function getEventForm() {
        return '
          <h1>Neues Event erstellen</h1>
          <form action="?url=newevent/pr" method="post">
          
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
          
          <h3>Uhrzeit</h3>
          <input type="number" name="stunden" min="0" max="23">:
          <input type="number" name="minuten" min="0" max="59">

          <h3>Veranstalter</h3>
          <input type="text" name="veranstalter">
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