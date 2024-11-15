<?php
include '../Database_Connection/DB_Connection.php';

if (isset($_GET['term'])) {
    $searchTerm = $_GET['term'] ?? '';
    $query = $conn->prepare("SELECT products FROM autocom WHERE products LIKE ? LIMIT 5");
    $searchTerm = $searchTerm . '%';
    $query->bind_param("s", $searchTerm);
    $query->execute();
    $result = $query->get_result();

    $suggestions = [];
    while ($row = $result->fetch_assoc()) {
        $suggestions[] = $row['products'];
    }

    echo json_encode($suggestions);
    $query->close();
    $conn->close();
    exit;
}
?>
