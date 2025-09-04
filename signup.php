<?php
// signup.php
// Connect to your database
$conn = new mysqli("localhost", "your_db_user", "your_db_password", "your_db_name");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$name = $_POST['name'];
$nic = $_POST['NIC'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$password = password_hash($_POST['signupPassword'], PASSWORD_DEFAULT);
$role = $_POST['role'];

// Handle file upload
$profilePic = "";
if (isset($_FILES['Profile']) && $_FILES['Profile']['error'] == 0) {
    $targetDir = "uploads/";
    $profilePic = $targetDir . basename($_FILES["Profile"]["name"]);
    move_uploaded_file($_FILES["Profile"]["tmp_name"], $profilePic);
}

// Insert into database
$stmt = $conn->prepare("INSERT INTO users (name, nic, email, tel, password, role, profile_pic) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $name, $nic, $email, $tel, $password, $role, $profilePic);

if ($stmt->execute()) {
    echo "Signup successful!";
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>