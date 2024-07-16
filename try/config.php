<?php
global $mysqli;
$mysqli = new mysqli("localhost", "root", "Leviathan0908", "user");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
