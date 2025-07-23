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
    echo json_encode($response);
    exit();
}

$destination_obj = new Destination();
$id = $_POST['id'];
$destination = $destination_obj->getById($id, $_SESSION['user_id']);

if (!$destination) {
    $response['message'] = 'Destination not found.';
    echo json_encode($response);
    exit();
}

$name = sanitizeInput($_POST['name'] ?? '');
$country = sanitizeInput($_POST['country'] ?? '');
$type = sanitizeInput($_POST['type'] ?? '');
$status = sanitizeInput($_POST['status'] ?? '');
$notes = sanitizeInput($_POST['notes'] ?? '');
$image_path = $destination['image'];

if (empty($name) || empty($country) || empty($type) || empty($status)) {
    $response['message'] = 'Name, country, type, and status are required.';
    echo json_encode($response);
    exit();
}

// Handle file upload
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $upload_dir = '../uploads/'; // Note the path is relative to this API file
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $file_tmp_path = $_FILES['image']['tmp_name'];
    $file_name = basename($_FILES['image']['name']);
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($file_ext, $allowed_ext)) {
        $new_file_name = uniqid('', true) . '.' . $file_ext;
        $dest_path = $upload_dir . $new_file_name;

        if (move_uploaded_file($file_tmp_path, $dest_path)) {
            if ($image_path && file_exists('../' . $image_path)) {
                unlink('../' . $image_path);
            }
            $image_path = 'uploads/' . $new_file_name; // Path to store in DB
        } else {
            $response['message'] = 'Failed to move uploaded file.';
            echo json_encode($response);
            exit();
        }
    } else {
        $response['message'] = 'Invalid file type.';
        echo json_encode($response);
        exit();
    }
}

if ($destination_obj->update($id, $_SESSION['user_id'], $name, $country, $type, $status, $notes, $image_path)) {
    $response['success'] = true;
    $response['message'] = 'Destination updated successfully!';
    $response['image_path'] = $image_path;
} else {
    $response['message'] = 'Failed to update destination.';
}

echo json_encode($response);
?>
