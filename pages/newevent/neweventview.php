<?php

class Neweventview {
    
    function getEventForm() {
        return '
          <h1>Neues Event erstellen</h1>
          <form>
          <h3>Name *</h2>
          <input type="text" name="eventname">
          <h3>Ort *</h2>
          <input type="text" name="eventort">
          </form>
          <h3>Datum *</h2>
          <input type="date" name="eventdate">
          <h3>Veranstalter</h3>
          <input type="text" name="veranstalter">
          <br><br><br>
          <input class="button" type="submit" value="Eintragen"><br><br>
          <p style="font-size: 12px;">Felder mit * m&uuml;ssen ausgef&uuml;llt werden.</p>
          
        ';
    }
    
}