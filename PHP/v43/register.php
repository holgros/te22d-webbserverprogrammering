<?php
/*
Prepared statement är ett sätt att förhindra ondskefull input att skada databasen eller ge otillåten behörighet.
Användaren kan t.ex. skicka SQL-kod i ett formulärfält, s.k. SQL injection.
Referenser: - https://www.w3schools.com/sql/sql_injection.asp
            - https://www.w3schools.com/php/php_mysql_prepared_statements.asp
            - https://en.wikipedia.org/wiki/SQL_injection
*/

// Steg 1: Anslut till databasen
$servername = "localhost";
$username = "root";    // Ersätt med ditt MySQL-användarnamn
$password = "";        // Ersätt med ditt MySQL-lösenord
$dbname = "webbserverprogrammering"; // Databasens namn

// Skapa en anslutning till databasen
$conn = new mysqli($servername, $username, $password, $dbname);

// Kontrollera om anslutningen misslyckades
if ($conn->connect_error) {
    die("Anslutningsfel: " . $conn->connect_error);
}

// Steg 2: Hämta användarens input från formuläret
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$passwd = password_hash($_POST['passwd'], PASSWORD_DEFAULT); // Hashar lösenordet för säkerhet

// Steg 3: Använd prepared statement för att säkert infoga data i databasen
$stmt = $conn->prepare("INSERT INTO users (firstname, lastname, passwd) VALUES (?, ?, ?)");

// Kontrollera om prepared statement kunde skapas
if ($stmt === false) {
    die("Fel vid förberedning av SQL: " . $conn->error);
}

// Steg 4: Binda parametrar till prepared statement (typer: s för string)
$stmt->bind_param("sss", $firstname, $lastname, $passwd);

// Steg 5: Exekvera prepared statement och kontrollera om det lyckades
if ($stmt->execute()) {
    echo "Ny användare har registrerats!";
} else {
    echo "Fel: " . $stmt->error;
}

// Stäng prepared statement och anslutningen
$stmt->close();
$conn->close();
?>
