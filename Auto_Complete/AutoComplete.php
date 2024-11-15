<?php
include '../Database_Connection/DB_Connection.php';

if (isset($_GET['term'])) {
    $searchTerm = $_GET['term'] ?? '';
    $query = $conn->prepare("SELECT Product_name FROM product_info WHERE Product_name LIKE ? LIMIT 5");
    $searchTerm = $searchTerm . '%';
    $query->bind_param("s", $searchTerm);
    $query->execute();
    $result = $query->get_result();

    $suggestions = [];
    while ($row = $result->fetch_assoc()) {
        $suggestions[] = $row['Product_name'];
    }

    echo json_encode($suggestions);
    $query->close();
    $conn->close();
    exit;
}
?>
