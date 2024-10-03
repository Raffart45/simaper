<nav class="navbar navbar-expand-sm navbar-default">

  <div class="navbar-header">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fa fa-bars"></i>
      </button>
      <a class="navbar-brand" href="{{ route('admin.dashboard') }}">PT Sata Harum</a>
      <a class="navbar-brand hidden" href="{{ route('admin.dashboard') }}">SH</a>
  </div>

  <div id="main-menu" class="main-menu collapse navbar-collapse">
      <ul class="nav navbar-nav">
          <li class="active">
              <a href="{{ route('admin.dashboard') }}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
          </li>
          <h3 class="menu-title">Data Master</h3><!-- /.menu-title -->
          <li>
            <a href="{{route('produk.index')}}"> <i class="menu-icon ti-package"></i>Produk</a>
            <a href="{{route('inventory.index')}}"> <i class="menu-icon ti-files"></i>Inventori Produk</a>
            <a href="{{route('pesanan.index')}}"> <i class="menu-icon ti-shopping-cart"></i>Pesanan</a>
            <a href="{{route('bayar.index')}}"> <i class="menu-icon ti-credit-card"></i>Transaksi</a>
        </li>
        <h3 class="menu-title">Data Laporan</h3><!-- /.menu-title -->
        <li>
          <a href="{{route('laporan.rekapBulanan')}}"> <i class="menu-icon ti-files"></i>Laporan Pesanan</a>
          <a href="{{route('laporan.rekapBulananTransaksi')}}"> <i class="menu-icon ti-files"></i>Laporan Transaksi</a>
      </li>
      <h3 class="menu-title">Data Lainnya</h3><!-- /.menu-title -->
        <li>
          <a href="{{route('admin.ongkir.data')}}"> <i class="menu-icon ti-files"></i>Ongkir</a>
          <a href="{{route('admin.return.data')}}"> <i class="menu-icon ti-files"></i>Return Produk</a>
      </li>
      </ul>
  </div><!-- /.navbar-collapse -->
</nav>