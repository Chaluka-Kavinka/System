<?php
session_start();
include 'db_connect.php';

// Only allow organizations
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'Organization') {
    header("Location: index.php");
    exit();
}

if (!isset($_GET['event_id'])) {
    die("Event ID is required.");
}

$event_id = intval($_GET['event_id']);

// Check that this organization owns the event
$stmt = $conn->prepare("SELECT title FROM events WHERE event_id = ? AND org_id = ?");
$stmt->bind_param("ii", $event_id, $_SESSION['user_id']);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows == 0) {
    die("You do not have permission to view this event or it does not exist.");
}

$stmt->bind_result($event_title);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrations for <?php echo htmlspecialchars($event_title); ?></title>
</head>
<body>
    <h1>Registrations for "<?php echo htmlspecialchars($event_title); ?>"</h1>
    <ul>
        <?php
        $stmt = $conn->prepare("
            SELECT u.username, u.email, u.phone, u.nic
            FROM event_registrations er
            JOIN users u ON er.volunteer_id = u.user_id
            WHERE er.event_id = ?
        ");
        $stmt->bind_param("i", $event_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<li>{$row['username']} ({$row['email']}) - Phone: {$row['phone']}, NIC: {$row['nic']}</li>";
            }
        } else {
            echo "<li>No volunteers have registered yet.</li>";
        }
        $stmt->close();
        ?>
    </ul>
    <br>
    <a href="organization_dashboard.php">Back to Dashboard</a>
</body>
</html>
