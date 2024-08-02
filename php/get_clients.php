<?php
require 'db.php';

$sql = "SELECT * FROM clients";
$stmt = $conn->prepare($sql);
$stmt->execute();
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($clients as $client) {
    echo "<tr>";
    echo "<td>{$client['first_name']}</td>";
    echo "<td>{$client['last_name']}</td>";
    echo "<td>{$client['email']}</td>";
    echo "<td>{$client['phone']}</td>";
    echo "<td>{$client['company']}</td>";
    echo '<td class="text-right">';
    echo '<button class="btn btn-sm btn-warning mr-2">Edit</button>';
    echo '<button class="btn btn-sm btn-danger">Delete</button>';
    echo '</td>';
    echo "</tr>";
}
?>
