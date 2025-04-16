@extends('adminlayout.adminmaster')
@section('content')

<style>

.content {
  background-color: white;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  height: 100%;
}

.card-container {
  display: flex;
  gap: 20px;
  justify-content: space-between;
  flex-wrap: wrap;
}

.card {
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  width: 23%;
  color: black;
}

.card1 {
  background-color: #DEB887;
}

.card2 {
  background-color: #A9A9A9;
}

.card3 {
  background-color: #90EE90;
}

.card4 {
  background-color: #CD853F;
}

    </style>
<div class="main">
    <!-- <div class="header">
      <div class="search-box">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Search...">
      </div>
      <div class="profile">
        <i class="fas fa-bell"></i>
        <i class="fas fa-user-circle"></i>
      </div>
    </div> -->

    <div class="content">
      <h2>Welcome to the Admin Panel</h2>

      <!-- Card container -->
      <div class="card-container">
        <!-- Card 1 -->
        <div class="card card1">
          <h3>10000</h3>
          <p>Total-Products </p>
        </div>
        <!-- Card 2 -->
        <div class="card card2">
          <h3>500+</h3>
          <p>users</p>
        </div>
        <!-- Card 3 -->
        <div class="card card3">
          <h3>2000+</h3>
          <p>clients</p>
        </div>
        <!-- Card 4 -->
        <div class="card card4">
          <h3>900+</h3>
          <p>fllowing</p>
        </div>
      </div>
      <div class="mt-5">
  <h4>Statistics Overview</h4>
  <div class="row">
    <div class="col-md-6 mb-4">
      <canvas id="barChart"></canvas>
    </div>
    <div class="col-md-6 mb-4 d-flex justify-content-center">
      <div style="width: 250px; height: 250px;">
        <canvas id="pieChart" width="250" height="250"></canvas>
      </div>
    </div>
  </div>
</div>
</div>
    </div>
    <div class="position-relative z-50">
    </div>

  </div>

  <script>
  const barCtx = document.getElementById('barChart').getContext('2d');
  const pieCtx = document.getElementById('pieChart').getContext('2d');

  new Chart(barCtx, {
    type: 'bar',
    data: {
      labels: ['Products', 'Users', 'Clients', 'Following'],
      datasets: [{
        label: 'Metrics',
        data: [10000, 500, 2000, 900],
        backgroundColor: ['#DEB887', '#A9A9A9', '#90EE90', '#CD853F'],
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  new Chart(pieCtx, {
    type: 'pie',
    data: {
      labels: ['Products', 'Users', 'Clients', 'Following'],
      datasets: [{
        label: 'Metrics',
        data: [10000, 500, 2000, 900],
        backgroundColor: ['#DEB887', '#A9A9A9', '#90EE90', '#CD853F'],
      }]
    },
    options: {
      responsive: true,
    }
  });
</script>

@endsection