<?php

//function Tabellenausgabe($daten)  : Übergabe eines Arrays, Ausgabe in Tabellenform
//function ostergauss($year)	    : Berechnung von Ostersonntag als Datum + Rückgabe



// Ausgabe beliebiger Tabelle (2-dimensional)
function Tabellenausgabe($daten) {

//print(count($daten));
print("<table border=1  >");
//for($i=0;$i < count($daten); $i++)
foreach($daten as $zeile)
{
  print("<tr>");
  foreach($zeile as $feld){

  if ($feld)
  {
    print("<td>&nbsp;");
    print($feld);
    print("&nbsp;</td>");
  }
        else print ("<td>&nbsp;</td>");

  }
  print("</tr>");

}
print("</table>");

}//function Tabellenausgabe($daten)
//******************************************************************************************

function ostergauss($year){

      // Ostsonntag ist der erste Sonntag nach dem ersten Vollmond nach astronomischen Frühlungsanfang (Tag- und Nachgleiche).
      // Ostern seit ca. 350 nach Christus eingeführt

      // Ausnahmen von der Berechnung falls Ergebniss = 25. / 26. April ist.
      //nur von 1900 - 2099 ???? M + N Epaktenrechnung? aus Brockhaus: Osterformel, M ist dann 24!
      //M := 15 + ((3* (Jahr div 100) +3) div 4)  - (8* (Jahr div 100) +13) div 25;
      //N := 5; //auch wüste Formel, reicht bis 2099

$M = 15 + (int)((3 * (int)($year / 100) + 3) /4) - (int)((8* (int)($year / 100)+13 ) /25);
$N = 5; //für 1901 - 2099

$a = $year % 19;
$b = $year % 4;
$c = $year % 7;
$d = (19 * $a + $M) % 30;
$e = (2 * $b + 4 * $c + 6 * $d + $N) % 7;

$day = 01;
$month = 03;
$ostersonntag = mktime(0,0,0, $month, $day, $year) + ($d + $e + 21)*86400;//86400 = 1 Tag in sec (60 sec * 60 min *24h)

$OS = getdate($ostersonntag);

      //regel 1
if (($OS["mday"] == 26) && ($OS["mon"] == 4))
  $ostersonntag = $ostersonntag - 7*86400;


      //regel 2
if (($OS["mday"] == 25) && ($OS["mon"] == 4) && ($a>10) && ($d==28))
  $ostersonntag = $ostersonntag - 7*86400;


return $ostersonntag;

}

?>
