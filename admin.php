<?php
// Database connection
$host = "localhost";   // change if needed
$user = "root";        // your DB username
$pass = "";            // your DB password
$dbname = "volunteer_db"; // your database name

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Fetch volunteers
$volunteers = $conn->query("SELECT * FROM users WHERE type='volunteer' ORDER BY created_at DESC");

// Fetch organizations
$organizations = $conn->query("SELECT * FROM users WHERE type='organization' ORDER BY created_at DESC");

// Fetch new signups (is_new = 1)
$newSignups = $conn->query("SELECT * FROM users WHERE is_new=1 ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    .admin-header {
      background: white;
      padding: 15px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .admin-container { padding: 20px; }
    .card {
      background: white;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      margin-bottom: 20px;
    }
    table { width: 100%; border-collapse: collapse; }
    table th, table td {
      padding: 10px;
      border-bottom: 1px solid #ddd;
      text-align: left;
    }
    .notification {
      background: #e7f3ff;
      border: 1px solid #b3d7ff;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 5px;
      color: #004085;
    }
    .logo {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--primary);
    text-decoration: none;
}
  </style>
</head>
<body>
  <header class="admin-header">
    <a href="index.html" class="logo">
                <img src="Logo.png" alt="VolunteerConnect Logo">
            </a>
            
    <h1>Admin Dashboard</h1>
    <a href="index.html" class="btn btn-secondary">Logout</a>
  </header>

  <div class="admin-container">
    <!-- Notifications -->
    <div id="notifications">
      <?php if ($newSignups->num_rows > 0): ?>
        <?php while($row = $newSignups->fetch_assoc()): ?>
          <div class="notification">
            New <?= htmlspecialchars($row['type']) ?> signed up: 
            <?= htmlspecialchars($row['name']) ?> (<?= htmlspecialchars($row['email']) ?>)
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p>No new signups.</p>
      <?php endif; ?>
    </div>

    <!-- Volunteers Table -->
<tbody>
  <?php while($row = $volunteers->fetch_assoc()): ?>
    <tr>
      <td><?= htmlspecialchars($row['name']) ?></td>
      <td><?= htmlspecialchars($row['email']) ?></td>
      <td><?= htmlspecialchars($row['category']) ?></td>
      <td>
        <a href="profile.php?id=<?= $row['id'] ?>" class="btn btn-secondary">View Profile</a>
      </td>
    </tr>
  <?php endwhile; ?>
</tbody>

    <!-- Organizations -->
<div class="card">
  <h2>Active Organizations</h2>
  <table>
    <thead>
      <tr><th>Name</th><th>Email</th><th>Category</th><th>Action</th></tr>
    </thead>
    <tbody>
      <?php while($row = $organizations->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row['name']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['category']) ?></td>
          <td>
            <a href="profile.php?id=<?= $row['id'] ?>" class="btn btn-secondary">View Profile</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body>
</html>
<?php
// Mark all new users as seen (optional)
$conn->query("UPDATE users SET is_new=0 WHERE is_new=1");
$conn->close();
?>
