<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $sql = "DELETE FROM clients WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt->execute([$id])) {
        echo "Client deleted successfully";
    } else {
        echo "Error deleting client";
    }
}
?>
