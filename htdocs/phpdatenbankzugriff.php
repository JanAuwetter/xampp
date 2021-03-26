
<html lang="de" dir="ltr">
  <head>
    <?php header('Content-Type: text/html; charset=iso-8859-1');  ?> <!-- Zeichensatz für Umlaute !!! -->

    <meta charset="utf-8" >
    <title>Datenbankzugriff</title>
  </head>
  <body>
<h1>Datenbankzugriff auf AuftragsDB aus SQL Kurs</h1>

    <?php


    // Formular mit Eingabefeld für Suchtext zum dynamischen erstellen der SQL Abfragen

    $suchtext="";
    if (isset ($_POST["suchen"])) {$suchtext = $_POST["suchen"];}




  	//folgende 2 Zeilen zum Leeren des Suchfeldes: in $SQL $suchtext verarbeiten und $suchtext vor
  			//Formulargenerierung leeren
  	$SQL="Select * from Mitarbeiter where Name like '%$suchtext%' order by Name";
  	$suchtext="";

  	//$benutzer="";
  	//$kennwort="";

  	//var_dump ($_POST);

  	if (isset($_POST["benutzer"]))//kommst du aus dem Login-Formular?
  		{$benutzer = $_POST["benutzer"];}
  		else
  			if (isset($_POST["hiddenbenutzer"])) { //kommst aus dem Zweitaufruf von DBZUgriff.php?
  				$benutzer=$_POST["hiddenbenutzer"];
  			}
  	if (isset($_POST["passwort"]))
  		{$kennwort = $_POST["passwort"];}
  		else
  			if (isset($_POST["hiddenpasswort"])) {
  				$kennwort=$_POST["hiddenpasswort"];
  			}
  	echo "<form name = 'suchfeld' method = 'post' action = $_SERVER[PHP_SELF] >";
  		echo "Suchen: <input type='text' name='suchen' size='8' value=$suchtext >";//Eingabefeld
  		echo "<input type='submit' name='submit' value='Suchen' >";
  		echo "<input type='hidden' name='hiddenbenutzer' value=$benutzer>";
  		echo "<input type='hidden' name='hiddenpasswort' value=$kennwort>";
  	echo "</form>";

  	//ab hier Datenbankhandling	************************************************************************** M y S Q L
  	//gerade in CMD-MySQL angelegt: create user groth@localhost identified by '1111'
  	//und Rechte für die AuftragsDB vergeben: grant all privileges on auftragsdb.* to groth@localhost;



  	echo "<br><h2>";
  	var_dump ($benutzer); echo "<br>";
  	var_dump ($kennwort); echo "<br>";

  	echo "</h2><hr>";

    $sqlsuchtext="";
    $SQL="";
    if (isset($_POST["sqlsuchen"])) {
        $sqlsuchtext=$_POST["sqlsuchen"];
        if ($sqlsuchtext==""){
          $sqlsuchtext="SELECT * from mitarbeiter";

        }
        // folgende 2 Zeilen zum Leeren des Suchfeldes
        echo "SQL Abfrage hat statt gefunden";
        $SQL=$sqlsuchtext;
        $sqlsuchtext="";

    }
    //  $benutzer="";
      //$kennwort="";

      if(isset($_POST["benutzer"]))
        {$benutzer = $_POST["benutzer"];}
            else {
              if (isset($_POST["hiddenbenutzer"]))
              {$benutzer=$_POST["hiddenbenutzer"];
              }
            }
      if(isset($_POST["passwort"]))
        {$kennwort = $_POST["passwort"]; }
        else {
          if (isset($_POST["hiddenpasswort"])){
            $kennwort=$_POST["hiddenpasswort"];
          }
        }

    echo "<form name='sqlsuchfeld' method='post' action=$_SERVER[PHP_SELF]>";
    echo "SQL String eingeben : &nbsp; <input type='text' size='100' name='sqlsuchen' value='$sqlsuchtext'>";
    echo "&nbsp; <input type='submit' name='submit' value='absenden'>";
    echo "<input type='hidden' name='hiddenbenutzer' value=$benutzer>";
      echo "<input type='hidden' name='hiddenpasswort' value=$kennwort>";
    echo "</form><br>";


    // ab hier Datenbankhandling**********************************************************************
    // gerade in CMD-MySQL angelegt: create user janq@localhost identified by '1111'
    // Rechte für die AuftragsDB vergeben: grant all privileges on auftragsdb.* to jan@localhost;


    echo "<br><h2>";
    var_dump ($benutzer);
     echo "<br>";
    var_dump ($kennwort);
    echo "<br>";


    //  $benutzer = 'jan';
    //  $kennwort = '1111';
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

    if ($SQL !="") {

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

}


     // Ende Block zum auslesen der Zeilen und Spalten-Werte *********************************************
     echo "</table>";
     $suchtext="";

     ?>



  </body>
</html>
