<?php
require_once '../includes/auth.php';
require_once '../classes/Destination.php';

requireLogin();

header('Content-Type: application/json');

$destination = new Destination();
$filters = [];

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $filters['search'] = sanitizeInput($_GET['search']);
}

if (isset($_GET['country']) && !empty($_GET['country'])) {
    $filters['country'] = sanitizeInput($_GET['country']);
}

if (isset($_GET['type']) && !empty($_GET['type'])) {
    $filters['type'] = sanitizeInput($_GET['type']);
}

if (isset($_GET['status']) && !empty($_GET['status'])) {
    $filters['status'] = sanitizeInput($_GET['status']);
}

// Pagination
$page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1;
$limit = isset($_GET['limit']) && is_numeric($_GET['limit']) && $_GET['limit'] > 0 ? (int)$_GET['limit'] : 10;
$offset = ($page - 1) * $limit;

$total = $destination->countByUserId($_SESSION['user_id'], $filters);
$destinations = $destination->getByUserId($_SESSION['user_id'], $filters, $limit, $offset);

echo json_encode([
    'data' => $destinations,
    'total' => $total,
    'page' => $page,
    'limit' => $limit
]);
?>
