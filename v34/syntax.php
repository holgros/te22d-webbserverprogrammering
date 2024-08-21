<?php
echo "Hello world!";

// en kommentar startar med dubbla snedstreck
// variabelnamn börjar alltid med dollartecken $
$x = 5;
$y = 4;

// grundläggande aritmetiska operationer
$z = $x+$y;
echo $z;        // 9
$z = $x*$y;
echo $z;

// lägg in en linebreak för synlighetens skull
echo "<br>";

// textvariabler
$x = "Hejsan";
$y = "Hoppsan";
echo $x;
echo "<br>";
echo $y;
echo "<br>";
$z = $x . " " . $y; //punkttecken används för att konkatenera (lägga ihop textsträngar)
echo $z;
echo "<br>";

// if-satser
$x = 5;
if ($x == 5) {
    echo "x är lika med fem<br>";
}
if ($x < 2) {
    echo "x är mindre än två<br>";
}
else {
    echo "x är inte mindre än två<br>";
}

// for-loop
for ($x = 0; $x <= 10; $x++) {
    echo "The number is: $x <br>";
}

// skriv ut html
echo "<h1>Detta är en rubrik</h1>";
echo "<p>Detta är en paragraf</p>";

?>