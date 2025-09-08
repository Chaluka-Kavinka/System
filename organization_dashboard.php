<?php
session_start();

// ✅ Only allow logged-in users with Organization role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'Organization') {
    header("Location: index.php");
    exit();
}

// Optional: Display username
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Organization Dashboard</title>
  <link rel="stylesheet" href="styles.css">

  <style>
    .dashboard-header {
      background: white;
      padding: 15px 0;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }
    .header-flex { display: flex; justify-content: space-between; align-items: center; }
    .header-flex h1 { margin-left: 20px; font-size: 1.8rem; color: var(--primary); }
    .header-flex a { margin-right: 20px; }
    #reqDesc {
      width: 100%; min-height: 150px; resize: vertical;
      padding: 15px; border: 1px solid #ddd; border-radius: 8px;
      background: #fff; font-size: 1rem; line-height: 1.5;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .categories-grid {
      display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
      gap: 25px; margin-top: 25px;
    }
    .category-card {
      background: white; border-radius: 10px; padding: 20px; text-align: center;
      box-shadow: 0 4px 12px rgba(0,0,0,0.05);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .category-card img { width: 60px; height: 60px; margin-bottom: 15px; }
    .category-card h4 { font-size: 1rem; color: var(--dark); }
    .category-card:hover { transform: translateY(-5px); box-shadow: 0 6px 18px rgba(0,0,0,0.1); }
  </style>
</head>
<body>
  <header class="dashboard-header">
    <div class="container header-flex">
      <h1>Welcome, <?php echo htmlspecialchars($username); ?>!</h1>
      <a href="logout.php" class="btn btn-secondary">Logout</a>
    </div>
  </header>

  <section class="categories-section">
    <div class="container">
      <h2>Categories We Support</h2>
      <div class="categories-grid">
        <div class="category-card"><img src="images/Cat1.png" alt="Education"><h4>Education</h4></div>
        <div class="category-card"><img src="images/Cat2.png" alt="Environment"><h4>Environment</h4></div>
        <div class="category-card"><img src="images/Cat3.png" alt="Healthcare"><h4>Healthcare</h4></div>
        <div class="category-card"><img src="images/Cat4.png" alt="Community Development"><h4>Community Development</h4></div>
        <div class="category-card"><img src="images/Cat5.png" alt="Animal Welfare"><h4>Animal Welfare</h4></div>
      </div>
    </div>
  </section>

  <section class="request-section">
    <div class="container">
      <h2>Request Volunteers</h2>
      <!-- ✅ Add method + enctype -->
      <form id="requestForm" method="POST" action="save_request.php" enctype="multipart/form-data">
        <div class="form-group">
          <label for="reqTitle">Title</label>
          <input type="text" name="reqTitle" id="reqTitle" placeholder="Type the Name of the New Program!" required> 
        </div>
        <div class="form-group">
          <label for="reqDesc">Description</label>
          <textarea name="reqDesc" id="reqDesc" placeholder="Type all the information for us to find the perfect volunteer for you!" required></textarea>
        </div>
        <div class="form-group">
          <label for="reqCategory">Category</label>
          <select name="reqCategory" id="reqCategory">
            <option>Education</option>
            <option>Environment</option>
            <option>Healthcare</option>
            <option>Community Development</option>
            <option>Animal Welfare</option>
          </select>
        </div>
        <div class="form-group">
          <label for="reqCount">Number of Volunteers Needed</label>
          <input type="number" name="reqCount" id="reqCount" min="1" required>
        </div>
        <div class="form-group">
          <label for="reqDate">Date & Time</label>
          <input type="datetime-local" name="reqDate" id="reqDate" required>
        </div>
        <div class="form-group">
          <label for="reqFile">Upload File (optional)</label>
          <input type="file" name="reqFile" id="reqFile">
        </div>
        <button type="submit" class="btn">Submit Request</button>
      </form>
    </div>
  </section>

</body>
</html>
