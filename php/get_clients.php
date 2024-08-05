<?php
require 'db.php';

// Obtener parámetros de búsqueda y paginación
$search = isset($_GET['search']) ? $_GET['search'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 10; // Número de registros por página
$offset = ($page - 1) * $limit;

// Consulta para contar el número total de registros
$countSql = "SELECT COUNT(*) FROM clients WHERE first_name LIKE ? OR last_name LIKE ? OR email LIKE ? OR phone LIKE ? OR company LIKE ?";
$countStmt = $conn->prepare($countSql);
$searchTerm = "%$search%";
$countStmt->execute([$searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm]);
$totalClients = $countStmt->fetchColumn();

// Consulta para obtener los registros con paginación y búsqueda
$sql = "SELECT * FROM clients WHERE first_name LIKE ? OR last_name LIKE ? OR email LIKE ? OR phone LIKE ? OR company LIKE ? LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $limit, $offset]);
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Crear JSON de respuesta
$response = [
    'total' => $totalClients,
    'clients' => $clients,
    'limit' => $limit,
    'page' => $page,
    'pages' => ceil($totalClients / $limit)
];

echo json_encode($response);
?>
