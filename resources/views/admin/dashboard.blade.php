@extends('admin.layouts.base')

@section('content')
<div class="breadcrumbs">
  <div class="col-sm-4">
      <div class="page-header float-left">
          <div class="page-title">
              <h1>Dashboard</h1>
          </div>
      </div>
  </div>
  <div class="col-sm-8">
      <div class="page-header float-right">
          <div class="page-title">
              <ol class="breadcrumb text-right">
                  <li class="active">Dashboard</li>
              </ol>
          </div>
      </div>
  </div>
</div>

<div class="content mt-3">

  <div class="col-sm-6 col-lg-3">
      <div class="card text-white bg-flat-color-1">
          <div class="card-body pb-0">
              <h4 class="mb-0">
                  <span class="count">{{ $totalProducts }}</span>
              </h4>
              <p class="text-light">Total Produk</p>
          </div>
      </div>
  </div>
  <!--/.col-->

  <div class="col-sm-6 col-lg-3">
      <div class="card text-white bg-flat-color-2">
          <div class="card-body pb-0">
              <h4 class="mb-0">
                  <span class="count">{{ $totalInventory }}</span>
              </h4>
              <p class="text-light">Total Inventory</p>
          </div>
      </div>
  </div>
  <!--/.col-->

  <div class="col-sm-6 col-lg-3">
      <div class="card text-white bg-flat-color-3">
          <div class="card-body pb-0">
              <h4 class="mb-0">
                  <span class="count">{{ $totalOrders }}</span>
              </h4>
              <p class="text-light">Total Pesanan</p>
          </div>
      </div>
  </div>
  <!--/.col-->

  <div class="col-sm-6 col-lg-3">
      <div class="card text-white bg-flat-color-4">
          <div class="card-body pb-0">
              <h4 class="mb-0">
                  <span class="count">{{ $totalTransactions }}</span>
              </h4>
              <p class="text-light">Total Transaksi</p>
          </div>
      </div>
  </div>
  <!--/.col-->
 
</div>

<div class="content row mt-5">
    <div class="col-md-6 col-sm-12">
        <div class="mb-4">
            <form method="GET" action="{{ route('admin.dashboard') }}">
                <div class="row">
                    <div class="col-md-10 col-sm-12">
                        <label for="tahun">Pilih Tahun</label>
                        <input type="number" id="tahun" name="tahun" class="form-control" value="{{ $selectedYear }}" min="2000" max="{{ date('Y') }}">
                    </div>
                    <div class="col-md-2 col-sm-12">
                        <button type="submit" class="btn btn-primary" style="margin-top: 30px">Filter</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card">
            <div class="card-body">
                <h4>Grafik Pesanan Tahun {{ $selectedYear }}</h4>
                <canvas id="ordersChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12">
        <div class="card">
            <div class="card-body">
                <h4>Distribusi Transaksi</h4>
                <canvas id="transactionsPieChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctxOrders = document.getElementById('ordersChart').getContext('2d');
    var ordersChart = new Chart(ctxOrders, {
        type: 'bar',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'Total Pesanan',
                data: @json($chartValues),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Bulan dan Tahun'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Pesanan'
                    }
                }
            }
        }
    });

    var ctxPie = document.getElementById('transactionsPieChart').getContext('2d');
    var transactionsPieChart = new Chart(ctxPie, {
        type: 'pie',
        data: {
            labels: @json($pieLabels),
            datasets: [{
                label: 'Jumlah Transaksi',
                data: @json($pieValues),
                backgroundColor: @json($pieColors), // Use dynamic colors
                borderColor: [
                    'rgba(255, 255, 255, 1)' // Optional border color
                ],
                borderWidth: 1
            }]
        }
    });
</script>
@endsection
