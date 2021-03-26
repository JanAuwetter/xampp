<?php 
	header('Content-Type: text/html; charset=iso-8859-1');//Zeichensatz für Umlaute für PHP
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//DE" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<title>DB-Zugriff mit SQL</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<body>

<h1>Datenzugriff auf AuftragsDB aus SQL-Kurs &Auml;</h1>

<?php 

	//Aufgaben: erweitern des Datenbankzugriffs: (kopiert euch diesen Ist-Stand)
		//entweder ein Feld ähnlich Suchfeld für eine vollständige Eingabe eines SQL-Strings einbauen
		//Benutzername und Kennwort in einer Seite vorschalten, die dann diese Suchseite aufruft.
		//SQL-Query kann auch ein "Insert" sein, Formular zur Eingabe von Mitarbeitern und Senden an die Datenbank
		//Dieses Formular dann zum Test des Auslesens nutzen
		
		
	//Formular mit eingabefeld für Suchtext zum dynamischen Erstellen der SQL-Abfrage ***********  F o r m u l a r
	
	
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
	
	
	//die zum Testen für falsche Anmeldung um nicht eine lange Fehlerliste zu haben
		
	//$benutzer	='groth'; //Zugriff nur noch aus dem "login.php" möglich
	//$kennwort	='1111';
	$host		='localhost';
	$datenbank	='auftragsdb';
	
	//Verbindung mit dem Server herstellen
	$verbindung = mysqli_connect($host, $benutzer, $kennwort);
	if (!$verbindung){
		//die (stirb) beendet die Scriptausführung
		die ("Die Verbindung ist gescheitert");	
	}
	
	echo "Verbindung hergestellt. <br>";

	//Datenbank wählen
	mysqli_select_db($verbindung, $datenbank);
	
	//$suchtext="er"; //Ziel: Suchtext als Formularvariable abfragen und ähnlich wie Jahreszahl in Urlaubsplaner mit POST
	
	//Abfrage zusammenbauen und zur Ausführung senden, 
	//Datenblock mit Überschriften/Zeilen/Spalten wird zurückgegeben: steht in $ergebnis
	//$SQL="Select * from Mitarbeiter order by Name"; //Erstfassung fester SQL-Text
	//$SQL="Select * from Mitarbeiter where Name like '%$suchtext%' order by Name"; //nach oben schieben
	var_dump($SQL); echo "<br>";
	
	$ergebnis = mysqli_query($verbindung, $SQL);
	$zeilen = mysqli_num_rows($ergebnis);
	
	echo "Datenbank hat " . $zeilen . " Zeilen. <br>";
	//var_dump($zeilen);//Ausdruck von Zwischenergebnissen auf dem Web-Formular

	//Ausgabe der Daten in einer Tabelle
	//<table><tr><td>...</td><td>...</td> ... </tr></table>
	echo "<table border=1>";
	
	//Laufvariablen zum Durchlauf von Zeilen und Spalten im $ergebnis - Block
	
	//Block zum Auslesen der Überschriften *********************************					 Ü b e r s c h r i f t 
	$i=0;
	$spalten=mysqli_num_fields($ergebnis);
	echo "<tr>";
	while($i < $spalten){
		$kopf = mysqli_fetch_field_direct($ergebnis, $i);
		echo "<td>" . $kopf->name . "</td>";
		
		$i++;
	}
	echo "</tr>";
	//Ende Block zum Auslesen der Überschriften ***************************************
	
	//Block zum Auslesen der Zeilen und Spalten-Werte *********************************			D a t e n
	//Abragen der Datenzeilen bis EOF (End Of File)
	while ($treffer=mysqli_fetch_row($ergebnis)){
		echo "<tr>";//für jede Zeile table-row öffnen	
			foreach ($treffer as $feld){  //für jede Spalte in der aktuellen Datenzeile
				//if ($feld != ""){ //für jedes Datenelement, Prüfung wohl inzwischen durch Interpreter
					echo "<td>" . $feld . "</td>";
				//}else {echo "<td>&nbsp;</td>";}
			}
		echo "</tr>";
	}
	//Ende Block zum Auslesen der Zeilen und Spalten-Werte *********************************
	
	echo "</table>";
	$suchtext="";
	

?>

</body>
</html>