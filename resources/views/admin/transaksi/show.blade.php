@extends('admin.layouts.base')

@section('content')
<div class="breadcrumbs">
  <div class="col-sm-4">
      <div class="page-header float-left">
          <div class="page-title">
              <h1>Transaction Details</h1>
          </div>
      </div>
  </div>
  <div class="col-sm-8">
      <div class="page-header float-right">
          <div class="page-title">
              <ol class="breadcrumb text-right">
                  <li><a href="#">Dashboard</a></li>
                  <li><a href="#">Table</a></li>
                  <li class="active">Transaction Details</li>
              </ol>
          </div>
      </div>
  </div>
</div>

<div class="content mt-3">
  <div class="animated fadeIn">
      <div class="row">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <strong class="card-title">Transaction Details</strong>
                  </div>
                  <div class="card-body">
                      <div class="row">
                          <div class="col-md-6">
                              <p><strong>No. Transaksi:</strong> {{ $transaksi->no_transaksi }}</p>
                              <p><strong>No. Pesanan:</strong> {{ $transaksi->pesanan->no_pesanan }}</p>
                              <p><strong>Nama Pemesan:</strong> {{ $transaksi->pesanan->user->name }}</p>
                              <p><strong>Produk:</strong> {{ $transaksi->pesanan->product->nama_produk }}</p>
                              <p><strong>Harga DP:</strong> Rp. {{ number_format($transaksi->harga_dp, 0, ',', '.') }}</p>
                              <p><strong>Foto Lunas:</strong></p>
                              @if($transaksi->foto_dp && file_exists(public_path('storage/' . $transaksi->foto_dp)))
                              <img src="{{ asset('storage/' . $transaksi->foto_dp) }}" alt="Foto Lunas" width="200">
                                @else
                                    <p>Foto tidak tersedia</p>
                                @endif
                                
                              <p><strong>Tanggal DP:</strong> {{ \Carbon\Carbon::parse($transaksi->tanggal_dp)->format('d-m-Y H:i') }}</p>
                              <p><strong>Status Transaksi:</strong> {{ $transaksi->status_transaksi }}</p>
                          </div>
                          <div class="col-md-6">
                              <p><strong>Lunas:</strong> Rp. {{ number_format($transaksi->lunas, 0, ',', '.') }}</p>
                              <p><strong>Foto Lunas:</strong></p>
                              @if($transaksi->foto_lunas && file_exists(public_path('storage/' . $transaksi->foto_lunas)))
                              <img src="{{ asset('storage/' . $transaksi->foto_lunas) }}" alt="Foto Lunas" width="200">
                                @else
                                    <p>Foto tidak tersedia</p>
                                @endif
                                
                              <p><strong>Tanggal Lunas:</strong> {{ $transaksi->tanggal_lunas ? \Carbon\Carbon::parse($transaksi->tanggal_lunas)->format('d-m-Y') : 'N/A' }}</p>
                          </div>
                      </div>
                      <a href="{{ route('bayar.index') }}" class="btn btn-secondary mt-3">Kembali ke home</a>
                  </div>
              </div>
          </div>
      </div>
  </div><!-- .animated -->
</div><!-- .content -->
@endsection
