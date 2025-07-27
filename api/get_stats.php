<?php
header('Content-Type: application/json');
require_once '../includes/auth.php';
require_once '../classes/Destination.php';

requireLogin();

$destination = new Destination();
$stats = $destination->getStats($_SESSION['user_id']);

echo json_encode($stats);
?>
