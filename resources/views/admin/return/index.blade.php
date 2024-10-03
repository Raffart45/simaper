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
                  <li><a href="#">Dashboard</a></li>
                  <li><a href="#">Table</a></li>
                  <li class="active">Data table return produk</li>
              </ol>
          </div>
      </div>
  </div>
</div>

@if (session()->has('success'))
    <div class="alert alert-success mt-3 mb-3">
        {{ session('success') }}
    </div>
@endif

<div class="content mt-3">
  <div class="animated fadeIn">
      <div class="row">

          <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <div class="d-flex justify-content-between align-items-center">
                        <strong class="card-title">Data Return Produk</strong>
                        <div class="d-flex justify-content-between align-items-center">
                           <div>
                            <form action="{{ route('admin.return.data') }}" method="GET" class="form-inline" id="filter-form">
                                @csrf
                                <select name="tahun" class="form-control mr-2">
                                    <option value="">Pilih Tahun</option>
                                    @foreach ($years as $year)
                                        <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
                                    @endforeach
                                </select>
                                <select name="bulan" class="form-control mr-2">
                                    <option value="">Pilih Bulan</option>
                                    @foreach ($months as $month)
                                        <option value="{{ $month['value'] }}" {{ request('bulan') == $month['value'] ? 'selected' : '' }}>{{ $month['name'] }}</option>
                                    @endforeach
                                </select>
                                <select name="status" class="form-control mr-2">
                                    <option value="">Pilih Status</option>
                                    <option value="Proses Pengembalian" {{ request('status') == 'Proses Pengembalian' ? 'selected' : '' }}>Proses Pengembalian</option>
                                    <option value="Pengembalian ditolak" {{ request('status') == 'Pengembalian ditolak' ? 'selected' : '' }}>Pengembalian ditolak</option>
                                    <option value="Pengembalian diterima" {{ request('status') == 'Pengembalian diterima' ? 'selected' : '' }}>Pengembalian diterima</option>
                                    <option value="Produk dikirim" {{ request('status') == 'Produk dikirim' ? 'selected' : '' }}>Produk dikirim</option>
                                    <option value="Produk sampai" {{ request('status') == 'Produk sampai' ? 'selected' : '' }}>Produk sampai</option>
                                </select>
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </form>
                            
                           </div>
                         <div class="ml-2">
                            <a href="#" class="btn btn-success" onclick="document.getElementById('print-form').submit();">Cetak Data</a>
                            <form action="{{ route('return.print') }}" method="GET" id="print-form" class="d-none">
                                <input type="hidden" name="tahun" value="{{ request('tahun') }}">
                                <input type="hidden" name="bulan" value="{{ request('bulan') }}">
                                <input type="hidden" name="status" value="{{ request('status') }}">
                            </form>
                         </div>
                        </div>
                      </div>
                  </div>
                  <div class="card-body">
                      <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                          <thead>
                              <tr>
                                  <th>No</th>
                                  <th>No Transaksi</th>
                                  <th>Nama Pemesan</th>
                                  <th>Nama Produk</th>
                                  <th>Jumlah Pengembalian</th>
                                  <th>Tanggal</th>
                                  <th>Alasan Dikembalikan</th>
                                  <th>Foto Produk</th>
                                  <th>Status</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($returns as $return)
                              <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $return->transaksi->no_transaksi }}</td>
                                  <td>{{ $return->transaksi->pesanan->user->name }}</td>
                                  <td>{{ $return->transaksi->pesanan->product->nama_produk }}</td>
                                  <td>{{ $return->jumlah }} box</td>
                                  <td>{{  \Carbon\Carbon::parse($return->tanggal)->format('d-m-Y') }}</td>
                                  <td>{{ $return->alasan }}</td>
                                  <td><img src="{{ asset('storage/'.$return->foto_produk) }}" width="100"></td>
                                  <td>
                                    @php
                                    $statusClass = '';
                                    $statusText = ucfirst($return->status);
                                    switch($return->status) {
                                        case 'Proses Pengembalian':
                                            $statusClass = 'bg-warning text-dark';
                                            break;
                                        case 'Pengembalian ditolak':
                                            $statusClass = 'bg-danger text-white';
                                            break;
                                        case 'Pengembalian diterima':
                                            $statusClass = 'bg-success text-white';
                                            break;
                                        case 'Produk dikirim':
                                            $statusClass = 'bg-dark text-white';
                                            break;   
                                        default:
                                            $statusClass = 'bg-info text-white';
                                    }
                                @endphp
                                <span class="badge {{ $statusClass }}" style="font-size: 15px">{{ $statusText }}</span>
                                  </td>
                                  <td>
                                    <a href="{{ route('admin.return.edit-status', $return->id) }}" class="btn btn-secondary mb-2">
                                        <i class="ti-pencil-alt"></i>
                                    </a>
                                  </td>
                              </tr>
                            @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>

      </div>
  </div><!-- .animated -->
</div><!-- .content -->
@endsection

