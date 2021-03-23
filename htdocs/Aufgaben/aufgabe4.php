
<?php
/*
Über ein HTML-Formular soll eine Zahl an ein PHP-Skript übergeben werden. Das Skript soll überprüfen, ob die Zahl zwischen 1 und 7 liegt.
Ist das der Fall, soll das Skript eine Erfolgsmeldung ausgeben, sonst natürlich eine Fehlermeldung und einen Link, um das Formular erneut aufzurufen.
*/

echo '<a href="../index.php">zurück zum Index</a><br><br>';


echo "<form name='adresse' method='post' action='zahl.php'>";
echo "<p> Gebe eine Zahl zwischen 1-7 ein</p>";
echo "<p>Zahl: <input name='zahl'><br></p>";
echo "<p><input type='submit' name='Submit' value='Abschicken'></p>";
echo "</form>";

?>
