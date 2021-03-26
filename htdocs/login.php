<?php
//Login Fenster
// 2 Eingabefehler (Benutzername und Kennwort)
// formular leiter Daten auf phpdatenbankzugriff.php weiter
// daten werden dort im $_Post abgefangen und in die Variablen $benutzer und $kennwort gesetzt
// mysqli_connect prüft und statt die "die" zurück auf login.php verwiesen

echo "<h1>Datenbank Login</h1>";

$Lbenutzer="";
$Lpasswort="";

echo "<form name='formbenutzer' method='post' action='phpdatenbankzugriff.php'>";
echo "Benutzer : &nbsp; <input type='text' name='benutzer' size='5' value='$Lbenutzer'><br>";
echo "Passwort : &nbsp; <input type='text' name='passwort' size='5' value='$Lpasswort'><br>";
echo "&nbsp; <input type='submit' name='submit' value='Login'>";
echo "</form><br>";




?>
