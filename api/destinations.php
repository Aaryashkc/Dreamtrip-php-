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

$destinations = $destination->getByUserId($_SESSION['user_id'], $filters);

echo json_encode($destinations);
?>
