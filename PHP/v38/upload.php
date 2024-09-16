<?php
// Ange mappen där filen ska sparas
$targetDir = "uploads/"; // Glöm inte att skapa denna mapp
$targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Kontrollera om filen är en riktig fil eller om det bara är ett falskt försök
if (isset($_POST["submit"])) {
    /*  Denna kod är endast felhantering och inte absolut nödvändig för att skriptet ska fungera
    // Kontrollera filens storlek
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Filen är för stor.";
        $uploadOk = 0;
    }

    // Tillåt vissa filtyper (i detta fall bilder)
    $allowedTypes = ['jpg', 'png', 'jpeg', 'gif'];
    if (!in_array($fileType, $allowedTypes)) {
        echo "Endast JPG, JPEG, PNG & GIF filer är tillåtna.";
        $uploadOk = 0;
    }
    */

    // Om $uploadOk är 0 har något gått fel (se ovan) annars försök att ladda upp filen
    if ($uploadOk == 0) {
        echo "Filen kunde inte laddas upp.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            echo "Filen " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " har laddats upp.";
        } else {
            echo "Något gick fel vid uppladdningen av filen.";
        }
    }
}
?>
