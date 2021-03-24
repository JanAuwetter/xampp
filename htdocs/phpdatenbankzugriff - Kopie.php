<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8" >
    <title>Datenbankzugriff</title>
  </head>
  <body>
<h1>Datenbankzugriff auf AuftragsDB aus SQL Kurs</h1>

    <?php

    header('Content-Type: text/html; charset=iso-8859-1');      // Zeichensatz für Umlaute !!!
    // Formular mit Eingabefeld für Suchtext zum dynamischen erstellen der SQL Abfragen

    $suchtext="";
    if (isset($_POST["suchen"])) {
        $suchtext=$_POST["suchen"];
        // folgende 2 Zeilen zum Leeren des Suchfeldes
        $SQL="Select * from mitarbeiter where Name like '%$suchtext%' order by Name";
        $suchtext="";
    }

    echo "<form name='suchfeld' method='post' action=$_SERVER[PHP_SELF]>";
    echo "Suchtext eingeben : &nbsp; <input type='text' name='suchen' value='$suchtext'>";
    echo "&nbsp; <input type='submit' name='submit' value='Suchen'>";
    echo "</form><br>";



    // ab hier Datenbankhandling**********************************************************************
    // gerade in CMD-MySQL angelegt: create user janq@localhost identified by '1111'
    // Rechte für die AuftragsDB vergeben: grant all privileges on auftragsdb.* to jan@localhost;
      $benutzer = 'jan';
      $kennwort = '1111';
      $host = 'localhost';
      $datenbank = 'auftragsdb';

      // Verbindung mit dem Server herstellen
      $verbindung = mysqli_connect($host, $benutzer, $kennwort);
      if (!$verbindung) {
        die ("Die Verbindung ist gescheitert");
        // die beendet die Scripausführung
      }
      echo "Verbindung hergestellt. <br>";

      // Datenbank wählen
      mysqli_select_db ($verbindung, $datenbank);
           // ziel Suchtext als Forumlarvariable abfragen, wie Jahreszahl im Urlaubsplaner mit POST

     // Abfrage zusammenbauen und zur Ausführung senden, Datenblock mit Überschriften/Zeilen/Spalten wird zurrückgegeben: steht im ergebnis
     //$SQL="Select * from mitarbeiter order by Name";    // Erstfassung fester SQL Text
     //$SQL="Select * from mitarbeiter where Name like '%$suchtext%' order by Name";
    // var_dump($SQL); // hiermit gibt man die Zeichenkette $SQL aus

     $ergebnis = mysqli_query($verbindung, $SQL);
     $zeilen = mysqli_num_rows($ergebnis);


    // echo "Datenbank hat " . $zeilen . " Zeilen.<br>";

     // Ausgabe der Daten in einer  Tabelle <table><tr><td>.....</td><td>......</td></tr></table>
     echo "<table border=1>";
     // Laufvariablen zum Durchlauf von Zeilen und Spalten im $ergebnis - Block

     // Block zum auslesen der Überschriften *************************************************
     $i = 0;
     $spalten = mysqli_num_fields($ergebnis);
     echo "<tr>";
           while ($i <$spalten){
             $kopf = mysqli_fetch_field_direct($ergebnis, $i);
             echo "<td>" .  $kopf->name . "</td>";

             $i++;
           }
     echo "</tr>";
     // Ende Block zum auslesen der Überschriften *********************************************

     // Block zum auslesen der Zeilen und Spalten-Werte **************************************************
     // Abfragen der Datenzeilen bis EOF (End of File)
           while ($treffer = mysqli_fetch_row($ergebnis)) {
                echo "<tr>"; // für jede Zeile table-row öffnen
                    foreach ($treffer as $feld) { //für jede Spalte in der aktuellen Datenzeile
                        if ($feld != "") { // für jedes Datenelement
                          echo "<td>" . $feld . "</td>";
                        }
                        else {
                          echo "<td>&nbsp;</td>";
                        }
                    }
                echo "</tr>";

           }




     // Ende Block zum auslesen der Zeilen und Spalten-Werte *********************************************
     echo "</table>";

     ?>



  </body>
</html>
