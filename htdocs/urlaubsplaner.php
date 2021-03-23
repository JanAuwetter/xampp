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

                $Ostersonntag = ostergauss($Jahr);

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

                echo "<h3>Brückentage</h3>";
                $BT["Nach HF"][0] = "nach Himmelfahrt";
                $BT["Nach HF"][1] = date('d.m.Y', $Ostersonntag+ 40*86400);
                $BT["Nach HF"][2] = strftime("%A", $Ostersonntag+ 40*86400);

                $BT["Nach FL"][0] = "nach Frohenleichnam";
                $BT["Nach FL"][1] = date('d.m.Y', $Ostersonntag+ 61*86400);
                $BT["Nach FL"][2] = strftime("%A", $Ostersonntag+ 61*86400);


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

                for ($Tag>01; $Tag<=31 ; $Tag++) {
                    $Wochentag = strftime ("%A", mktime(0, 0, 0, 10, 03, $Jahr));
                    if ($Wochentag == "Dienstag"){
                          $BT["Tag der deutschen Einheit"][0] = "Vor Tag der deutschen Einheit ";
                          $BT["Tag der deutschen Einheit"][1] = date("d.m.Y", mktime (0, 0 ,0, 10, 02, $Jahr));
                          $BT["Tag der deutschen Einheit"][2] = strftime("%A", mktime(0, 0, 0, 10, 02, $Jahr));
                      }
                      if ($Wochentag == "Donnerstag"){
                          $BT["Tag der deutschen Einheit"][0] = "Nach Tag der deutschen Einheit ";
                          $BT["Tag der deutschen Einheit"][1] = date("d.m.Y", mktime (0, 0 ,0, 10, 04, $Jahr));
                          $BT["Tag der deutschen Einheit"][2] = strftime("%A", mktime(0, 0, 0, 10, 04, $Jahr));
                        }
                }





                Tabellenausgabe($BT);
                //Weitertreiben für andere Feiertage, schauen ob sie auf Dienstag oder donnerstag fallen,
                //um den Tag zwiscen Feiertag und Wochenende als Urlaubsvorschlag anbieten.
                // Vorschlag:  als Schleife über alle bekannten Feiertage (+24.12.)

     ?>
  </body>
</html>
