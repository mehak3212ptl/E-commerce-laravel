<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }

    html, body {
      height: 100%;
      overflow: hidden;
    }

    body {
      background-color: #f4f4f4;
    }

    .top-navbar {
      background-color: #212529;
      color: white;
      padding: 12px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      height: 52px;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
    }

    .top-navbar h1 {
      font-size: 20px;
    }

    .top-navbar i {
      font-size: 18px;
      cursor: pointer;
    }

    .sidebar {
      width: 220px;
      background-color:rgb(15, 15, 15);
      color: white;
      padding: 20px 0;
      position: fixed;
      top: 52px;
      bottom: 50px;
      left: 0;
      overflow-y: auto;
    }

    .sidebar h2 {
      text-align: center;
      margin-bottom: 30px;
      font-size: 24px;
    }

    .sidebar a {
      display: block;
      color: white;
      text-decoration: none;
      padding: 12px 20px;
      transition: background 0.3s;
    }

    .sidebar a:hover {
      background-color:rgb(6, 6, 6);
    }

    .sidebar form button {
      background: none;
      border: none;
      color: white;
      cursor: pointer;
      width: 100%;
      text-align: left;
      padding: 12px 20px;
      display: block;
    }

    .main {
      position: fixed;
      top: 52px;
      bottom: 50px;
      left: 220px;
      right: 0;
      padding: 20px;
      overflow-y: auto;
    }

    .header {
      position: sticky;
      top: 0;
      z-index: 10;
      background-color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 20px;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }

    .search-box {
      display: flex;
      align-items: center;
      border: 1px solid #ccc;
      padding: 5px 10px;
      border-radius: 20px;
    }

    .search-box input {
      border: none;
      outline: none;
      margin-left: 10px;
    }

    .profile {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .profile i {
      font-size: 20px;
      cursor: pointer;
    }

    .content {
      background-color: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      height: 100%; /* Ensure height fits screen */
    }

    /* Add Flexbox for the card container */
    .card-container {
      display: flex;
      gap: 20px; /* Space between cards */
      justify-content: space-between; /* Distribute the cards evenly */
      flex-wrap: wrap; /* Allow wrapping if the screen size is smaller */
    }

    /* Card styling */
    .card {
      background-color: black;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      width: 23%; /* Set the card width */
      color:white;
    }

    .footer {
      height: 50px;
      background-color: #212529;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 14px;
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      z-index: 1000;
    }

    @media (max-width: 768px) {
      .sidebar {
        display: none;
      }

      .main {
        left: 0;
      }

      .footer {
        left: 0;
      }

      .card {
        width: 48%; /* Increase the card width on smaller screens */
      }
    }

    @media (max-width: 480px) {
      .card {
        width: 100%; /* Cards will take full width on very small screens */
      }
    }
  </style>
</head>
@vite(['resources/css/app.css', 'resources/js/app.js'])
<body>

  <!-- Top Navbar -->
 @include('layouts.navigation')

  <!-- Sidebar -->
  <div class="sidebar">
    <h2>Admin</h2>
    <a href="#"><i class="fas fa-home"></i> Dashboard</a>
    <a href="#"><i class="fas fa-user"></i> Users</a>
    <a href="#"><i class="fas fa-cogs"></i> Settings</a>
    <a href="#"><i class="fas fa-cogs"></i> Settings</a>
    <a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>

  <!-- Main Content -->
  <div class="main">
    <div class="header">
      <div class="search-box">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Search...">
      </div>
      <div class="profile">
        <i class="fas fa-bell"></i>
        <i class="fas fa-user-circle"></i>
      </div>
    </div>

    <div class="content">
      <h2>Welcome to the Admin Panel</h2>

      <!-- Card container -->
      <div class="card-container">
        <!-- Card 1 -->
        <div class="card">
          <h3>10000</h3>
          <p>Total-Products </p>
        </div>
        <!-- Card 2 -->
        <div class="card">
          <h3>500+</h3>
          <p>users</p>
        </div>
        <!-- Card 3 -->
        <div class="card">
          <h3>2000+</h3>
          <p>clients</p>
        </div>
        <!-- Card 4 -->
        <div class="card">
          <h3>900+</h3>
          <p>fllowing</p>
        </div>
      </div>
     
    </div>
  </div>

  <!-- Footer -->
  <div class="footer">
    © 2025 Admin Dashboard. All rights reserved.
  </div>

</body>
</html>
