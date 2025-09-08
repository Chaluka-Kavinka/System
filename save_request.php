<?php
session_start();
include 'db_connect.php';

// Only allow logged-in organizations
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'Organization') {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $org_id = $_SESSION['user_id']; // organization ID
    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $volunteer_count = (int)($_POST['count'] ?? 0);
    $event_datetime = $_POST['date'] ?? null;

    // File upload
    $file_path = null;
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
        $file_name = time() . '_' . basename($_FILES['file']['name']);
        $file_path = $uploadDir . $file_name;
        move_uploaded_file($_FILES['file']['tmp_name'], $file_path);
    }

    // Basic validation
    if (!$title || !$description || !$category || !$volunteer_count || !$event_datetime) {
        echo json_encode(['status' => 'error', 'message' => 'Please fill in all required fields.']);
        exit;
    }

    // Insert request into database
    $stmt = $conn->prepare("
        INSERT INTO volunteer_requests 
        (org_id, title, description, category, volunteer_count, event_datetime, file_path) 
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->bind_param("issssis", $org_id, $title, $description, $category, $volunteer_count, $event_datetime, $file_path);
    
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Volunteer request submitted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to save request.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>
