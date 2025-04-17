<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
  * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
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
  background-color: rgb(15, 15, 15);
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
  padding: 35px 60px;
  transition: background 0.3s;
}

.sidebar a:hover {
  background-color: rgb(6, 6, 6);
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
}


/* Responsive Design for Smaller Screens */
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
    width: 48%;
  }
}

@media (max-width: 480px) {
  .card {
    width: 100%;
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
    <a href="{{route('dashboard')}}"><i class="fas fa-home"></i> Dashboard</a>
    <a href="{{route('users')}}"><i class="fas fa-user"></i> Users</a>
    <a href="{{route('viewproduct')}}"><i class="fa fa-product-hunt"></i> Products</a>
    <a href="{{route('settings')}}"><i class="fas fa-cogs"></i> Settings</a>
    
  </div>
 

  <!-- Footer -->
  <div class="footer">
    © 2025 Admin Dashboard. All rights reserved.
  </div>


</body>
</html>
