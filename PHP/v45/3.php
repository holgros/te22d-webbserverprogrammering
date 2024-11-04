<?php
    // starta session
    session_start();
    
    // skriv till textfil
    $text = $_SESSION["name"] . " har skrivit " . $_POST["message"] . ". ";
    $fp = fopen('messages.txt', 'a');   // 'a' står för 'append'
    fwrite($fp, $text);
    fclose($fp);

    // avsluta sessionen
    session_destroy();

    // återkoppla till användaren
    echo "Meddelandet är mottaget. <a href='1.html'>Prova igen</a> (ange förnamn)!";
?>