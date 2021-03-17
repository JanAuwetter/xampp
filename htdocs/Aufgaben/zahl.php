<?php

$zahl = $_POST["zahl"];

if ($zahl <= 7 && $zahl >=1) {
  echo "Richtige Zahl <br><br>";
  echo "<a href='aufgabe4.php'>zurück zur Eingabe</a>";
  // code...
}
else {
  echo "Bitte gebe eine Zahl von 1 bis 7 ein <br><br>";
  echo "<a href='aufgabe4.php'>zurück zur Eingabe</a>";
};

 ?>
