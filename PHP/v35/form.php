<?php
    if (isset($_GET["mingettext"])) {
        echo "Din textinmatning: " . $_GET["mingettext"];
    }
    if (isset($_POST["minposttext"])) {
        echo "Din textinmatning: " . $_POST["minposttext"];
    }
?>