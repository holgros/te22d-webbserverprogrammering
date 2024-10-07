<?php
// logga in till databas - default för XAMPP är root plus en tom sträng
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webbserverprogrammering";    // ändra ifall din databas heter något annat

// Koppla till databas
$conn = new mysqli($servername, $username, $password, $dbname);
// Felhantering
if ($conn->connect_error) {
  die("Anslutning misslyckades: " . $conn->connect_error);
}

$sql = "SELECT * FROM users";   // ändra ifall din tabell heter något annat
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Skriv ut varje rad
  while($row = $result->fetch_assoc()) {
    foreach ($row as $key => $value){
        echo "$key: $value, ";
     }
     echo "<br>";
  }
} else {
  echo "Tabellen är tom";
}
$conn->close();
?>