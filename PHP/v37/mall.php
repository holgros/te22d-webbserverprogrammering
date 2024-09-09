<?php
// DEL 1: ENKELT EXEMPEL MALL MED UTFYLLNADSTEXT
// Mallen med utfyllnadstext
$template = "Hej ***USER***! Välkommen till vår webbplats.";

// Värdet som ska ersätta utfyllnadstexten
$realValue = "Kalle Anka";

// Ersätt utfyllnadstexten ***USER*** med det verkliga värdet
$finalText = str_replace("***USER***", $realValue, $template);

// Skriv ut den slutgiltiga texten
echo $finalText;

// DEL 2: ETT LITE MER KOMPLEXT EXEMPEL DÄR EN TABELL FYLLS UT MED UTFYLLNADSTEXT
// Mallen för en tabellrad med utfyllnadstext
$rowTemplate = "
<tr>
    <td>***NAME***</td>
    <td>***AGE***</td>
    <td>***EMAIL***</td>
</tr>";

// En array med flera rader av data
$data = [
    ["name" => "John Doe", "age" => 28, "email" => "john@example.com"],
    ["name" => "Jane Smith", "age" => 34, "email" => "jane@example.com"],
    ["name" => "Mike Johnson", "age" => 45, "email" => "mike@example.com"]
];

// Variabel för att lagra alla genererade rader
$tableRows = "";

// Loopa igenom arrayen och fyll i mallen för varje rad
foreach ($data as $person) {
    // Skapa en kopia av radmallen
    $currentRow = $rowTemplate;
    
    // Ersätt utfyllnadstexterna med verkliga värden
    $currentRow = str_replace("***NAME***", $person['name'], $currentRow);
    $currentRow = str_replace("***AGE***", $person['age'], $currentRow);
    $currentRow = str_replace("***EMAIL***", $person['email'], $currentRow);
    
    // Lägg till den genererade raden till tabellen
    $tableRows .= $currentRow;
}

// Den kompletta HTML-tabellen med rader
$tableTemplate = "
<table border='1'>
    <tr>
        <th>Namn</th>
        <th>Ålder</th>
        <th>Email</th>
    </tr>
    $tableRows
</table>";

// Skriv ut den slutgiltiga HTML-tabellen
echo $tableTemplate;


?>
