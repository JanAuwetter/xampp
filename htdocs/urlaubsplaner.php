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
    $tagcount=1;
    $Wochentag="";
    $Tag=0; // Schleifenzähler

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

                echo "<h3>gestzliche Feiertage</h3>";
                $Daten["Kopf"][0]="<b>Bezeichnung</b>";
                $Daten["Kopf"][1]="<b>Datum</b>";
                $Daten["Kopf"][2]="<b>Wochentag</b>";
                $Daten["Kopf"][3]="<b>Bundesland</b>";

                $Daten["Neujahr"][0] = "Neujahr";
                $Daten["Neujahr"][1] = date("d.m.Y", mktime (0, 0 ,0, 01, 01, $Jahr));
                $Daten["Neujahr"][2] = strftime("%A", mktime(0, 0, 0, 01, 01, $Jahr));
                $Daten["Neujahr"][3] = "bundesweit";
                for ($Tag>01; $Tag<=31 ; $Tag++) {
                    $Wochentag = strftime ("%A", mktime(0, 0, 0, 01, 01, $Jahr));
                    if ($Wochentag == "Dienstag"){
                          $BT["Neujahr"][0] = "Vor Neujahr";
                          $BT["Neujahr"][1] = date("d.m.Y", mktime (0, 0 ,0, 12, 31, $Jahr-1));
                          $BT["Neujahr"][2] = strftime("%A", mktime(0, 0, 0, 12, 31, $Jahr-1));
                      }
                      if ($Wochentag == "Donnerstag"){
                          $BT["Neujahr"][0] = "Nach Neujahr";
                          $BT["Neujahr"][1] = date("d.m.Y", mktime (0, 0 ,0, 01, 02, $Jahr));
                          $BT["Neujahr"][2] = strftime("%A", mktime(0, 0, 0, 01, 02, $Jahr));
                        }
                }

                $Daten["Heilige 3 Könige"][0] = "Heilige 3 Könige";
                $Daten["Heilige 3 Könige"][1] = date("d.m.Y", mktime (0, 0 ,0, 1, 6, $Jahr));
                $Daten["Heilige 3 Könige"][2] = strftime("%A", mktime(0, 0, 0, 1, 6, $Jahr));
                $Daten["Heilige 3 Könige"][3] = "Baden-Württemberg, Bayern und Sachsen-Anhalt ";

                $Daten["Frauentag  "][0] = "Frauentag ";
                $Daten["Frauentag  "][1] = date("d.m.Y", mktime (0, 0 ,0, 3, 8, $Jahr));
                $Daten["Frauentag  "][2] = strftime("%A", mktime(0, 0, 0, 3, 8, $Jahr));
                $Daten["Frauentag  "][3] = "Berlin ";

                $Daten["Karfreitag"][0] = "Karfreitag";
                $Daten["Karfreitag"][1] = date('d.m.Y', $Ostersonntag- 2*86400);
                $Daten["Karfreitag"][2] = strftime("%A", $Ostersonntag- 2*86400);
                $Daten["Karfreitag"][3] = "bundesweit";

                $Daten["Ostermontag"][0] = "Ostermontag";
                $Daten["Ostermontag"][1] = date('d.m.Y', $Ostersonntag+ 1*86400);
                $Daten["Ostermontag"][2] = strftime("%A", $Ostersonntag+ 1*86400);
                $Daten["Ostermontag"][3] = "bundesweit";

                $Daten["1. Mai"][0] = "1. Mai";
                $Daten["1. Mai"][1] = date("d.m.Y", mktime (0, 0 ,0, 05, 01, $Jahr));
                $Daten["1. Mai"][2] = strftime("%A", mktime(0, 0, 0, 05, 01, $Jahr));
                $Daten["1. Mai"][3] = "bundesweit";
                for ($Tag>01; $Tag<=31 ; $Tag++) {
                    $Wochentag = strftime ("%A", mktime(0, 0, 0, 5, 01, $Jahr));
                    if ($Wochentag == "Dienstag"){
                          $BT["1. Mai"][0] = "Vor 1. Mai";
                          $BT["1. Mai"][1] = date("d.m.Y", mktime (0, 0 ,0, 04, 30, $Jahr));
                          $BT["1. Mai"][2] = strftime("%A", mktime(0, 0, 0, 04, 30, $Jahr));
                      }
                      if ($Wochentag == "Donnerstag"){
                          $BT["1. Mai"][0] = "Nach 1. Mai";
                          $BT["1. Mai"][1] = date("d.m.Y", mktime (0, 0 ,0, 05, 02, $Jahr));
                          $BT["1. Mai"][2] = strftime("%A", mktime(0, 0, 0, 05, 02, $Jahr));
                        }
                }


                $Daten["Himmelfahrt"][0] = "Himmelfahrt";
                $Daten["Himmelfahrt"][1] = date('d.m.Y', $Ostersonntag+ 39*86400);
                $Daten["Himmelfahrt"][2] = strftime("%A", $Ostersonntag+ 39*86400);
                $Daten["Himmelfahrt"][3] = "bundesweit";

                $Daten["Pfingstmontag"][0] = "Pfingstmontag";
                $Daten["Pfingstmontag"][1] = date('d.m.Y', $Ostersonntag+ 50*86400);
                $Daten["Pfingstmontag"][2] = strftime("%A", $Ostersonntag+ 50*86400);
                $Daten["Pfingstmontag"][3] = "bundesweit";

                $Daten["Frohenleichnam"][0] = "Frohenleichnam";
                $Daten["Frohenleichnam"][1] = date('d.m.Y', $Ostersonntag+ 60*86400);
                $Daten["Frohenleichnam"][2] = strftime("%A", $Ostersonntag+ 60*86400);
                $Daten["Frohenleichnam"][3] = "Baden-Württemberg, Bayern, Hessen, Nordrhein-Westfalen, Rheinland-Pfalz und im Saarland ";

                $Daten["Augsburger Hohes Friedensfest"][0] = "Augsburger Hohes Friedensfest ";
                $Daten["Augsburger Hohes Friedensfest"][1] = date("d.m.Y", mktime (0, 0 ,0, 8, 8, $Jahr));
                $Daten["Augsburger Hohes Friedensfest"][2] = strftime("%A", mktime(0, 0, 0, 8, 8, $Jahr));
                $Daten["Augsburger Hohes Friedensfest"][3] = "Beschränkt auf das Augsburger Stadtgebiet";


                $Daten["Mariä Himmelfahrt "][0] = "Mariä Himmelfahrt ";
                $Daten["Mariä Himmelfahrt "][1] = date("d.m.Y", mktime (0, 0 ,0, 8, 15, $Jahr));
                $Daten["Mariä Himmelfahrt "][2] = strftime("%A", mktime(0, 0, 0, 8, 15, $Jahr));
                $Daten["Mariä Himmelfahrt "][3] = "Saarland und in katholischen Gemeinden Bayerns";

                $Daten["Weltkindertag "][0] = "Weltkindertag";
                $Daten["Weltkindertag "][1] = date("d.m.Y", mktime (0, 0 ,0, 9, 20, $Jahr));
                $Daten["Weltkindertag "][2] = strftime("%A", mktime(0, 0, 0, 9, 20, $Jahr));
                $Daten["Weltkindertag "][3] = "Thüringen ";

                $Daten["Tag der deutschen Einheit"][0] = "Tag der deutschen Einheit ";
                $Daten["Tag der deutschen Einheit"][1] = date("d.m.Y", mktime (0, 0 ,0, 10, 03, $Jahr));
                $Daten["Tag der deutschen Einheit"][2] = strftime("%A", mktime(0, 0, 0, 10, 03, $Jahr));
                $Daten["Tag der deutschen Einheit"][3] = "bundesweit";

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

                $Daten["Reformationstag"][0] = "Reformationstag";
                $Daten["Reformationstag"][1] = date("d.m.Y", mktime (0, 0 ,0, 10, 31, $Jahr));
                $Daten["Reformationstag"][2] = strftime("%A", mktime(0, 0, 0, 10, 31, $Jahr));
                $Daten["Reformationstag"][3] = "bundesweit";

                $Daten["Allerheiligen"][0] = "Allerheiligen";
                $Daten["Allerheiligen"][1] = date("d.m.Y", mktime (0, 0 ,0, 11, 01, $Jahr));
                $Daten["Allerheiligen"][2] = strftime("%A", mktime(0, 0, 0, 11, 01, $Jahr));
                $Daten["Allerheiligen"][3] = "Baden-Wüttenberg, Bayern, Nordrein-Westfalen, Rheinland-Pfalz und Saarland";

                $Daten["1. Weihnachtstag"][0] = "1. Weihnachtstag";
                $Daten["1. Weihnachtstag"][1] = date("d.m.Y", mktime (0, 0 ,0, 12, 25, $Jahr));
                $Daten["1. Weihnachtstag"][2] = strftime("%A", mktime(0, 0, 0, 12, 25, $Jahr));
                $Daten["1. Weihnachtstag"][3] = "bundesweit";

                $Daten["2. Weihnachtstag"][0] = "2. Weihnachtstag";
                $Daten["2. Weihnachtstag"][1] = date("d.m.Y", mktime (0, 0 ,0, 12, 25, $Jahr));
                $Daten["2. Weihnachtstag"][2] = strftime("%A", mktime(0, 0, 0, 12, 26, $Jahr));
                $Daten["2. Weihnachtstag"][3] = "bundesweit";
                for ($Tag=27; $Tag<=30 ; $Tag++) {
                    $Wochentag = strftime ("%A", mktime(0, 0, 0, 12, $Tag, $Jahr));
                    if (($Wochentag != "Samstag") && ($Wochentag != "Sonntag")){
                      // dann anzeigen des Brücketages
                      $BT["Weihnachten " . $tagcount][0] = "nach Weihnachten " . $tagcount;
                      $BT["Weihnachten " . $tagcount][1] = date("d.m.Y", mktime (0, 0 ,0, 12, $Tag, $Jahr));
                      $BT["Weihnachten " . $tagcount][2] = strftime("%A", mktime(0, 0, 0, 12, $Tag, $Jahr));
                      $tagcount++;
                    }

                }

                Tabellenausgabe($Daten);


                echo "<h3>Brückentage</h3>";
                $BT["Kopf"][0]="<b>Bezeichnung</b>";
                $BT["Kopf"][1]="<b>Datum</b>";
                $BT["Kopf"][2]="<b>Wochentag</b>";

                $BT["Nach HF"][0] = "nach Himmelfahrt";
                $BT["Nach HF"][1] = date('d.m.Y', $Ostersonntag+ 40*86400);
                $BT["Nach HF"][2] = strftime("%A", $Ostersonntag+ 40*86400);

                $BT["Nach FL"][0] = "nach Frohenleichnam ";
                $BT["Nach FL"][1] = date('d.m.Y', $Ostersonntag+ 61*86400);
                $BT["Nach FL"][2] = strftime("%A", $Ostersonntag+ 61*86400);
                Tabellenausgabe($BT);


                // Weihnachten in einer Schleife für Test vom 27.12. bis 30.12., je nach Wochentag 2 bis 4 Urlaubstage erforderlich











                //Weitertreiben für andere Feiertage, schauen ob sie auf Dienstag oder donnerstag fallen,
                //um den Tag zwiscen Feiertag und Wochenende als Urlaubsvorschlag anbieten.
                // Vorschlag:  als Schleife über alle bekannten Feiertage (+24.12.)

     ?>
  </body>
</html>
