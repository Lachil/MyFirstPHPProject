<?php

// Verbindung mit Datenbank erstellen
$host = "localhost";
$user = "root";
$password = "";
$database = "webshop";

$connect = mysqli_connect($host, $user, $password, $database);
if (mysqli_connect_errno()) {
    die("Error with database conecte ");
}
?>

