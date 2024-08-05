<?php
$servername = "localhost";
$username = "root"; // Cambia esto si tu usuario es diferente
$password = ""; // Cambia esto si tu contraseña es diferente
$dbname = "tecnomind";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
