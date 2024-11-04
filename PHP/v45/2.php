<?php
    // starta session
    session_start();
    
    // anslut till databas
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "webbserverprogrammering";    // ändra ifall din databas heter något annat
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {             // hantera eventuella fel
        die("Connection failed: " . $conn->connect_error);
    }

    // kolla att namnet finns i databasen
    $name = $_POST["name"];
    $sql = "SELECT * FROM users WHERE firstname='$name'";   // ändra ifall din tabell eller kolumn heter något annat
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $_SESSION["name"] = $_POST["name"]; // spara som sessionsvariabel
        echo "Välkommen!
                    <form action='3.php' method='post'>
                        <label for='message'>Skriv ett meddelande:</label>
                        <input type='text' id='message' name='message'>
                        <input type='submit'>
                    </form>";
    }
    else {
        echo "Namnet finns inte i databasen. <a href='1.html'>Prova igen</a> (ange förnamn)!";
    }

    // stäng uppkoppling
    $conn->close();
?>