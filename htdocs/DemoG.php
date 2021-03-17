<html>
<a href="index.php">zurück zum Index</a><br><br>
<body>
	<h1>Demo</h1>

	<?php
//Wichtig Groß-Kleinschreibung bei Variablen/Funktionen)
		echo "Hallo Welt!";
		echo "<h2>Hallo aus PHP formatiert</h2>";
		$Wert=27;
		echo $Wert . "<br>";

		//Addition
		$Z1=7;
		$Z2=2;
		$Z2+=$Z1; //$Z2 = $Z2 + $Z1

		echo $Z2 ;

		//Logik bitweise oder als Ganzes
		$L1=13;
		$L2=4;
		$L3=$L1 || $L2;
		$L4=$L1 |  $L2;
		print ( "<br>" . $L3 . " " . $L4);
		print ( "<br> $L3  $L4");

		//Mischen zum Kartenspielen
		//Kartendeck ist Array "T7", "T8",..."TK", "TA", "P7".., "H7",..., .."KK", "KA"
		//Mischen heißt nehme 2 per Zufallszahl aus der Reihe der 32 Karten und tausche die Plätze
		//das ganze 100 mal (Test mit 2 und 3 Mal tauschen).
		//Ablagestapel: Computer schaut auf oberste Karte = "H9", zerlegt Zeichenkette in "H" und "9"
		// und schaut ober ein Herz oder eine 9 zum drauflegen hat.

		echo "Aufgabenliste";
		echo "<ul>";
		echo	"<li> Aufgabenblock1 </li>";
		echo		"<ul>" ;
					echo "<li> Aufgabe 1 <a href=' ...' >Link</a></li>";
		echo		"</ul>" ;

		echo "</ul>";

		//Uhrzeit wird in Sekunden verwaltet, 1 Tag = 60 sec * 60 min * 24 h = 86400 sec
	?>

</body>

</html>
