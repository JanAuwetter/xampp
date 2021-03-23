<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Urlaubsplaner</title>
  </head>
  <body>
    <h1>Feiertage .....</h1>
    <?php
    include_once("ostergauss.php");
    setlocale (LC_ALL,"german");

    $Jahr="";
    $Datum="";
    $Ostersonntag ="";
          if (isset($_POST['Jahr'])) $Jahr = $_POST['Jahr'];
          if ($Jahr==""){
              $Datum=getdate();
              $Jahr=$Datum["year"];
          }
                echo "<form name='form' method='post' action='urlaubsplaner.php'>";
                echo "Jahr eingeben : &nbsp; <input name='Jahr' value=$Jahr type='text' id='name'>";
                echo "&nbsp; <input type='submit' name='Submit' value='berechnen'>";
                echo "</form><br>";

                // Neujahr
            //    echo 'Neujahr: '. date ("d.m.Y", mktime(0, 0, 0, 01, 01, $Jahr)); // Stunde, Minute, Sekunde, Tag, Monat, Jahr
              //  echo ' Es ist ein: ' . strftime("%A", mktime(0, 0, 0, 01, 01, $Jahr));
                //echo "<br>";

                // Ostersonntag
                $Ostersonntag = ostergauss($Jahr);
              //  echo "Ostersonntag: " . date('d.m.Y', $Ostersonntag); //Datum wird hier vom ostergauss.php berechnet
              //  echo ' Es ist ein: ' . strftime("%A", $Ostersonntag);
              //  echo "<br>";

                // Karfreitag ist immer 2 Tage vor Ostersonntag, also Timestamp vom Ostsonntag - 2 Tage = - 2*86400 (sekunden)
/*                echo "Karfreitag: " . date('d.m.Y', $Ostersonntag- 2*86400); //Datum wird hier vom ostergauss.php berechnet
                echo ' Es ist ein: ' . strftime("%A", $Ostersonntag- 2*86400);
                echo "<br>";

                // Ostermontag
                $Ostersonntag = ostergauss($Jahr);
                echo "Ostermontag: " . date('d.m.Y', $Ostersonntag+ 1*86400); //Datum wird hier vom ostergauss.php berechnet
                echo ' Es ist ein: ' . strftime("%A", $Ostersonntag+ 1*86400);
                echo "<br>";

                // Himmelfahrt
                echo "Himmelfahrt:  " . date('d.m.Y', $Ostersonntag+ 39*86400);
                echo ' Es ist ein: ' . strftime("%A", $Ostersonntag+ 39*86400);
                echo "<br>";

                // Pfingstmontag
                echo "Pfingstmontag: " . date('d.m.Y', $Ostersonntag+ 50*86400);
                echo ' Es ist ein: ' . strftime("%A", $Ostersonntag+ 50*86400);
                echo "<br>";

                // Frohenleichnam
                echo "Frohenleichnam: " . date('d.m.Y', $Ostersonntag+ 60*86400);
                echo ' Es ist ein: ' . strftime("%A", $Ostersonntag+ 60*86400);
                echo "<br><br>";

                // Tabellenausgabe
                //$Daten[14][3] = "";
*/
                echo "<h3>Feiertage</h3>";
                $Daten["Kopf"][0]="Bezeichnung";
                $Daten["Kopf"][1]="Datum";
                $Daten["Kopf"][2]="Wochentag";

                $Daten["Neujahr"][0] = "Neujahr";
                $Daten["Neujahr"][1] = date("d.m.Y", mktime (0, 0 ,0, 01, 01, $Jahr));
                $Daten["Neujahr"][2] = strftime("%A", mktime(0, 0, 0, 01, 01, $Jahr));

                $Daten["Karfreitag"][0] = "Karfreitag";
                $Daten["Karfreitag"][1] = date('d.m.Y', $Ostersonntag- 2*86400);
                $Daten["Karfreitag"][2] = strftime("%A", $Ostersonntag- 2*86400);

                $Daten["1. Mai"][0] = "1. Mai";
                $Daten["1. Mai"][1] = date("d.m.Y", mktime (0, 0 ,0, 05, 01, $Jahr));
                $Daten["1. Mai"][2] = strftime("%A", mktime(0, 0, 0, 05, 01, $Jahr));

                $Daten["Ostermontag"][0] = "Ostermontag";
                $Daten["Ostermontag"][1] = date('d.m.Y', $Ostersonntag+ 1*86400);
                $Daten["Ostermontag"][2] = strftime("%A", $Ostersonntag+ 1*86400);

                $Daten["Himmelfahrt"][0] = "Himmelfahrt";
                $Daten["Himmelfahrt"][1] = date('d.m.Y', $Ostersonntag+ 39*86400);
                $Daten["Himmelfahrt"][2] = strftime("%A", $Ostersonntag+ 39*86400);

                $Daten["Pfingstmontag"][0] = "Pfingstmontag";
                $Daten["Pfingstmontag"][1] = date('d.m.Y', $Ostersonntag+ 50*86400);
                $Daten["Pfingstmontag"][2] = strftime("%A", $Ostersonntag+ 50*86400);

                $Daten["Frohenleichnam"][0] = "Frohenleichnam";
                $Daten["Frohenleichnam"][1] = date('d.m.Y', $Ostersonntag+ 60*86400);
                $Daten["Frohenleichnam"][2] = strftime("%A", $Ostersonntag+ 60*86400);

                $Daten["Tag der deutschen Einheit"][0] = "Tag der deutschen Einheit";
                $Daten["Tag der deutschen Einheit"][1] = date("d.m.Y", mktime (0, 0 ,0, 10, 03, $Jahr));
                $Daten["Tag der deutschen Einheit"][2] = strftime("%A", mktime(0, 0, 0, 10, 03, $Jahr));

                $Daten["Reformationstag"][0] = "Reformationstag";
                $Daten["Reformationstag"][1] = date("d.m.Y", mktime (0, 0 ,0, 10, 31, $Jahr));
                $Daten["Reformationstag"][2] = strftime("%A", mktime(0, 0, 0, 10, 31, $Jahr));

                $Daten["1. Weihnachtstag"][0] = "1. Weihnachtstag";
                $Daten["1. Weihnachtstag"][1] = date("d.m.Y", mktime (0, 0 ,0, 12, 25, $Jahr));
                $Daten["1. Weihnachtstag"][2] = strftime("%A", mktime(0, 0, 0, 12, 25, $Jahr));

                $Daten["2. Weihnachtstag"][0] = "2. Weihnachtstag";
                $Daten["2. Weihnachtstag"][1] = date("d.m.Y", mktime (0, 0 ,0, 12, 25, $Jahr));
                $Daten["2. Weihnachtstag"][2] = strftime("%A", mktime(0, 0, 0, 12, 26, $Jahr));

                Tabellenausgabe($Daten);

                $BT["Nach HF"][0] = "nach Himmelfahrt";
                $BT["Nach HF"][1] = date('d.m.Y', $Ostersonntag+ 40*86400);
                $BT["Nach HF"][2] = strftime("%A", $Ostersonntag+ 40*86400);

                // Weihnachten in einer Schleife für Test vom 27.12. bis 30.12., je nach Wochentag 2 bis 4 Urlaubstage erforderlich
                $tagcount=1;
                $Wochentag="";
                $Tag=0; // Schleifenzähler

                for ($Tag=27; $Tag<=30 ; $Tag++) {
                    $Wochentag = strftime ("%A", mktime(0, 0, 0, 12, $Tag, $Jahr));
                    if (($Wochentag != "Samstag") && ($Wochentag != "Sonntag")){
                      // dann anzeigen des Brücketages
                      $BT["Weihnachten " . $tagcount][0] = "Weihnachten " . $tagcount;
                      $BT["Weihnachten " . $tagcount][1] = date("d.m.Y", mktime (0, 0 ,0, 12, $Tag, $Jahr));
                      $BT["Weihnachten " . $tagcount][2] = strftime("%A", mktime(0, 0, 0, 12, $Tag, $Jahr));
                      $tagcount++;
                    }

                }



                echo "<h3>Brückentage</h3>";
                Tabellenausgabe($BT);
                //Weitertreiben für andere Feiertage, schauen ob sie auf Dienstag oder donnerstag fallen,
                //um den Tag zwiscen Feiertag und Wochenende als Urlaubsvorschlag anbieten.
                // Vorschlag:  als Schleife über alle bekannten Feiertage (+24.12.)

     ?>
  </body>
</html>
