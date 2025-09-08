<?php
// Database connection details
$servername = "localhost";   // usually localhost
$username = "root";          // your MySQL username
$password = "";              // your MySQL password
$dbname = "volunteer_connect_db";   // the database we created

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
/*
// Admin user details
$username = "admin";
$email = "admin@volunteerconnect.org";
$password = password_hash("#admn721", PASSWORD_DEFAULT); // hashed password
$role = "Admin";
$nic = "200477300544";
$phone = "+94723959666";
$profile_pic = "images/adminprofile.png";

// Volunteers
$users = [
    ['volunteer1', 'volunteer1@gmail.com', '#vol123', 'Volunteer', '200123456V', '+94771234567', ''],
    ['volunteer2', 'volunteer2@gmail.com', '#vol234', 'Volunteer', '200234567V', '+94771234568', ''],
   
    // Organizations
    ['organization1', 'org1@gmail.com', '#org123', 'Organization', '200456789V', '+94771234571', ''],
    ['organization2', 'org2@gmail.com', '#org234', 'Organization', '200445873V', '+94771234572', '']
];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO users (username, email, password, role, nic, phone, profile_pic) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $username, $email, $password, $role, $nic, $phone, $profile_pic);

foreach ($users as $user) {
    $username = $user[0];
    $email = $user[1];
    $password = password_hash($user[2], PASSWORD_DEFAULT); // hash password
    $role = $user[3];
    $nic = $user[4];
    $phone = $user[5];
    $profile_pic = $user[6];

// Execute
if ($stmt->execute()) {
    echo "User inserted successfully!";
} else {
    echo "Error: " . $stmt->error;
}
}
/*INSERT INTO events (organization_id, title, description, location, event_date) VALUES
(3, 'Beach Cleanup', 'Join us to clean the local beach.', 'Colombo Beach', '2025-09-15'),
(3, 'Tree Planting', 'Help us plant trees in the community park.', 'Galle Park', '2025-09-20');

INSERT INTO event_registrations (event_id, volunteer_id) VALUES
(1, 2),
(2, 2);

INSERT INTO volunteer_requests (org_id, title, description, category, volunteer_count, datetime) VALUES
(3, 'Food Drive Volunteers', 'We need 10 volunteers to help distribute food.', 'Community Service', 10, '2025-09-18 09:00:00');

// Close
$stmt->close();
$conn->close();
?>
*/