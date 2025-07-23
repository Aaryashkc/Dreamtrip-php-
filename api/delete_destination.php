<?php
require_once '../includes/auth.php';
require_once '../classes/Destination.php';

requireLogin();

header('Content-Type: application/json');

$response = ['success' => false, 'message' => 'Invalid request.'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode($response);
    exit();
}

if (!isset($_POST['id']) || !verifyCSRFToken($_POST['csrf_token'] ?? '')) {
    $response['message'] = 'Invalid CSRF token.';
    echo json_encode($response);
    exit();
}

$destination_obj = new Destination();
$id = $_POST['id'];

// First, get the destination to check ownership and get the image path
$destination = $destination_obj->getById($id, $_SESSION['user_id']);

if (!$destination) {
    $response['message'] = 'Destination not found or you do not have permission to delete it.';
    echo json_encode($response);
    exit();
}

// Attempt to delete the destination from the database
if ($destination_obj->delete($id, $_SESSION['user_id'])) {
    // If deletion is successful, delete the associated image file
    if (!empty($destination['image']) && file_exists('../' . $destination['image'])) {
        unlink('../' . $destination['image']);
    }
    $response['success'] = true;
    $response['message'] = 'Destination deleted successfully!';
} else {
    $response['message'] = 'Failed to delete destination.';
}

echo json_encode($response);
?>
