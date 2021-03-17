<?php

$zahl1 = $_POST["zahl1"];
$zahl2 = $_POST["zahl2"];

$add = $zahl1 + $zahl2;
$sub = $zahl1 - $zahl2;
$div = $zahl1 / $zahl2;
$mal = $zahl1 * $zahl2;

echo "$zahl1 + $zahl2 = $add<br>";
echo "$zahl1 - $zahl2 = $sub<br>";
echo "$zahl1 : $zahl2 = $div<br>";
echo "$zahl1 * $zahl2 = $mal<br><br>";
echo "<a href='aufgabe3.php'>Zurück zur Eingabe</a>";

 ?>
