<?php
// session_start();  // No need to start session if page is public
// No login check, page is accessible to everyone
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Help - VolunteerConnect</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f9f9f9;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 700px;
      margin: 50px auto;
      background-color: #fff;
      padding: 40px 30px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    h1 {
      text-align: center;
      color: #2c7be5;
      margin-bottom: 20px;
    }

    p {
      font-size: 1rem;
      line-height: 1.6;
      margin-bottom: 20px;
    }

    ul {
      list-style: none;
      padding: 0;
    }

    ul li {
      background-color: #eaf1fb;
      margin-bottom: 12px;
      padding: 12px 15px;
      border-radius: 8px;
      font-size: 1rem;
    }

    ul li a {
      color: #2c7be5;
      text-decoration: none;
      font-weight: 500;
    }

    ul li:hover {
      background-color: #d5e4fb;
    }

    .back-btn {
      display: block;
      width: 50%;
      margin: 30px auto 0;
      padding: 10px 0;
      text-align: center;
      background-color: #2c7be5;
      color: white;
      text-decoration: none;
      border-radius: 8px;
      font-weight: 500;
      transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .back-btn:hover {
      background-color: #1a5bb8;
      transform: translateY(-2px);
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Help & Support</h1>
    <p>If you need assistance, please contact us through the following channels:</p>
    <ul>
      <li>Email: <a href="mailto:support@volunteerconnect.org">support@volunteerconnect.org</a></li>
      <li>Phone: +1 234 567 890</li>
      <li>FAQs: <a href="#">Frequently Asked Questions</a></li>
    </ul>
    <a href="index.php" class="back-btn">Back to Home</a>
  </div>
</body>
</html>
