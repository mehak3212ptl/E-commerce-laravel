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
  /* overflow: hidden; */
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
  /* position: fixed;
  top: 52px;
  bottom: 50px;
  left: 0; */
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
  padding: 15px 60px;
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
  /* position: fixed;
  top: 52px;
  bottom: 50px;
  left: 220px;
  right: 0;
  padding: 20px;
  overflow-y: auto; */
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
body.dark-mode {
  background-color: #121212;
  color: #e0e0e0;
}

.dark-mode .top-navbar,
.dark-mode .footer {
  background-color: #1f1f1f;
  color: #fff;
}

.dark-mode .sidebar {
  background-color: #181818;
}

.dark-mode .sidebar a,
.dark-mode .sidebar form button {
  color: #e0e0e0;
}

.dark-mode .sidebar a:hover {
  background-color: #2a2a2a;
}

.dark-mode .header {
  background-color: #1e1e1e;
  color: #fff;
}

.dark-mode .search-box {
  border-color: #444;
}

.dark-mode .search-box input {
  background: transparent;
  color: #fff;
}
.top-navbar {
  /* background-color: #212529; */ /* REMOVE this */
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

.sidebar {
  /* width: 200px; */
  transition: all 0.3s ease;
}

.sidebar.hidden {
  /* width: 0; */
  display:naone;
  overflow: hidden;
}
#sidebarToggle {
  position: fixed;
  top: 12px;
  left: 20px;
  font-size: 24px;
  color: white;
  cursor: pointer;
  z-index: 1050; /* Make sure it's above the sidebar */
  background-color: #212529;
  padding: 8px 10px;
  border-radius: 5px;
}




</style>
</head>

<body>
@vite(['resources/css/app.css', 'resources/js/app.js'])
  <!-- Top Navbar -->


 <i id="sidebarToggle" class="bi bi-list" style="font-size: 24px; color: white; cursor: pointer;"></i>

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <a href="{{url('dashboard')}}"> Dashboard</a>
    <a href="{{url('viewproduct')}}"></i> Products</a>
    <a href="{{url('about')}}">About-us </a>
    <a href="{{url('hero')}}">Banner </a>

    <a href="{{ url('permissions') }}">Permissions</a>
    <a href="{{ url('roles') }}">Roles</a>

    
  <a href="{{url('settings')}}">Settings</a>
  <a href="#" id="modeToggle" class="bi bi-moon-stars-fill" style="padding-left: 60px; padding-top: 15px;">on | off</a>
  
  </div>
 
 
  <!-- Footer -->




  
  <script>
  const toggleBtn = document.getElementById('modeToggle');
  const body = document.body;

  // Load mode from localStorage
  if (localStorage.getItem('theme') === 'dark') {
    body.classList.add('dark-mode');
    toggleBtn.classList.remove('bi-moon-stars-fill');
    toggleBtn.classList.add('bi-sun-fill');
  }

  toggleBtn.addEventListener('click', () => {
    body.classList.toggle('dark-mode');
    const isDark = body.classList.contains('dark-mode');
    localStorage.setItem('theme', isDark ? 'dark' : 'light');
    toggleBtn.classList.toggle('bi-moon-stars-fill');
    toggleBtn.classList.toggle('bi-sun-fill');
  });


document.addEventListener('DOMContentLoaded', function () {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');

    sidebarToggle.addEventListener('click', function () {
        sidebar.classList.toggle('hidden');
    });
});


</script>


</body>
</html>
