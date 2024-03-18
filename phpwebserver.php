<?php
$mysqli = new mysqli("localhost", "my_user", "password", "my_database");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

echo "<h2>PHP System Information</h2>";
phpinfo();

$mysqli->close();
?>
