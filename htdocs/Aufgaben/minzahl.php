<?php
echo "<a href='aufgabe5.php'>Zurück zur Eingabe</a>";
$zahl1 = $_POST["zahl1"];
$zahl2 = $_POST["zahl2"];
$zahl3 = $_POST["zahl3"];

$zahlenarray=array($zahl1, $zahl2, $zahl3);
echo "<br><br>";
echo "die kleinste Zahl laut: ";
echo min($zahlenarray);

 ?>
