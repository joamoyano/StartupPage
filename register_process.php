<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $company = $_POST['company'];

    $sql = "INSERT INTO clients (first_name, last_name, email, phone, company) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if ($stmt->execute([$first_name, $last_name, $email, $phone, $company])) {
        echo 'success';
    } else {
        echo 'Error: ' . $stmt->errorInfo()[2];
    }
}
?>
