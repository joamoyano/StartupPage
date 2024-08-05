<?php
require 'db.php';

header('Content-Type: application/json');

try {
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
    $stmt->bindValue(1, $searchTerm);
    $stmt->bindValue(2, $searchTerm);
    $stmt->bindValue(3, $searchTerm);
    $stmt->bindValue(4, $searchTerm);
    $stmt->bindValue(5, $searchTerm);
    $stmt->bindValue(6, (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(7, (int)$offset, PDO::PARAM_INT);
    $stmt->execute();
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
} catch (PDOException $e) {
    // Devolver error en formato JSON
    echo json_encode(['error' => $e->getMessage()]);
}
?>
