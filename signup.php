<?php
session_start();
include 'db_connect.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['signupPassword'];
    $role = $_POST['role'];
    $nic = trim($_POST['NIC']);
    $phone = trim($_POST['tel']);

    // Handle profile picture upload
    $profile_pic = NULL;
    if (isset($_FILES['Profile']) && $_FILES['Profile']['error'] == 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        $file_name = time() . "_" . basename($_FILES["Profile"]["name"]);
        $target_file = $target_dir . $file_name;

        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png'];

        if (in_array($file_type, $allowed_types)) {
            if (move_uploaded_file($_FILES["Profile"]["tmp_name"], $target_file)) {
                $profile_pic = $target_file;
            } else {
                die("Error uploading profile picture.");
            }
        } else {
            die("Invalid file type. Only JPG, JPEG, PNG allowed.");
        }
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

   // Check for existing username or email
$stmt = $conn->prepare("SELECT user_id FROM users WHERE username = ? OR email = ?");
$stmt->bind_param("ss", $username, $email); // bind BOTH variables
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    die("Username or email already exists.");
}
$stmt->close();


    // Insert new user
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, role, nic, phone, profile_pic) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $username, $email, $hashed_password, $role, $nic, $phone, $profile_pic);

    if ($stmt->execute()) {
        echo "<p>✅ Signup successful! You can now <a href='index.html'>login</a>.</p>";
    } else {
        echo "<p>❌ Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>
