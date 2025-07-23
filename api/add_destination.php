<?php
require_once '../includes/auth.php';
require_once '../classes/Destination.php';

requireLogin();

header('Content-Type: application/json');

$response = ['success' => false, 'message' => 'An unknown error occurred.'];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['message'] = 'Invalid request method.';
    echo json_encode($response);
    exit();
}

if (!verifyCSRFToken($_POST['csrf_token'] ?? '')) {
    $response['message'] = 'Invalid request. Please try again.';
    echo json_encode($response);
    exit();
}

$name = sanitizeInput($_POST['name'] ?? '');
$country = sanitizeInput($_POST['country'] ?? '');
$type = sanitizeInput($_POST['type'] ?? '');
$status = sanitizeInput($_POST['status'] ?? '');
$notes = sanitizeInput($_POST['notes'] ?? '');
$image_path = null;

if (empty($name) || empty($country) || empty($type) || empty($status)) {
    $response['message'] = 'Name, country, type, and status are required fields.';
    echo json_encode($response);
    exit();
}

// Handle file upload
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $upload_dir = '../uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $file_tmp_path = $_FILES['image']['tmp_name'];
    $file_name = basename($_FILES['image']['name']);
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($file_ext, $allowed_ext)) {
        if ($_FILES['image']['size'] < 5000000) { // 5MB limit
            $new_file_name = uniqid('', true) . '.' . $file_ext;
            $dest_path = $upload_dir . $new_file_name;

            if (move_uploaded_file($file_tmp_path, $dest_path)) {
                $image_path = 'uploads/' . $new_file_name;
            } else {
                $response['message'] = 'Failed to save the uploaded image.';
                echo json_encode($response);
                exit();
            }
        } else {
            $response['message'] = 'File is too large. Maximum size is 5MB.';
            echo json_encode($response);
            exit();
        }
    } else {
        $response['message'] = 'Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.';
        echo json_encode($response);
        exit();
    }
}

$destination = new Destination();
if ($destination->create($_SESSION['user_id'], $name, $country, $type, $status, $notes, $image_path)) {
    $response['success'] = true;
    $response['message'] = 'Destination added successfully!';
} else {
    $response['message'] = 'Failed to add destination to the database.';
}

echo json_encode($response);
?>
