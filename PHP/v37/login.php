<?php
session_start();
$_SESSION["user"] = $_POST["user"];
echo "<p>Sessionsvariabel tilldelad!</p>
      <p><a href='checkstatus.php'>Kolla status</a></p>
      <p><a href='logout.php'>Logga ut</a></p>";
?>