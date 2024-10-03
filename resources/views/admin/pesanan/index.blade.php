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
                  <li class="active">Data table pesanan</li>
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
                      <div class="d-flex justify-content-between">
                        <strong class="card-title">Data Pesanan</strong>
                        <div class="d-flex justify-content-between align-items-center">
                           <div>
                            <form action="{{ route('pesanan.index') }}" method="GET" class="form-inline" id="filter-form">
                                <select name="status_pesanan" class="form-control mr-2">
                                    <option value="">Pilih Status Pesanan</option>
                                    <option value="Pending" {{ request('status_pesanan') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Pesanan ditolak" {{ request('status_pesanan') == 'Pesanan ditolak' ? 'selected' : '' }}>Pesanan ditolak</option>
                                    <option value="Pesanan diterima" {{ request('status_pesanan') == 'Pesanan diterima' ? 'selected' : '' }}>Pesanan diterima</option>
                                    <option value="Pesanan dikirim" {{ request('status_pesanan') == 'Pesanan dikirim' ? 'selected' : '' }}>Pesanan dikirim</option>
                                    <option value="Pesanan sampai" {{ request('status_pesanan') == 'Pesanan sampai' ? 'selected' : '' }}>Pesanan sampai</option>
                                </select>
                                <input type="month" name="tanggal_pesananan" class="form-control mr-2" value="{{ request('tanggal_pesananan') }}">
                                <input type="text" name="nama_produk" class="form-control mr-2" placeholder="Nama Produk" value="{{ request('nama_produk') }}">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </form>
                           </div>
                           <div class="ml-2">
                            <a href="#" class="btn btn-success" onclick="document.getElementById('print-form').submit();">Cetak Data</a>
                            <form action="{{ route('pesanan.print') }}" method="GET" id="print-form" class="d-none">
                                <input type="hidden" name="status_pesanan" value="{{ request('status_pesanan') }}">
                                <input type="hidden" name="tanggal_pesananan" value="{{ request('tanggal_pesananan') }}">
                                <input type="hidden" name="nama_produk" value="{{ request('nama_produk') }}">
                            </form>
                           </div>
                        </div>
                      </div>
                  </div>
                  @if (session()->has('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
              @endif
              <div class="card-body">
                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No. Pesanan</th>
                            <th>Nama Pemesan</th>
                            <th>No. Telepon</th>
                            <th>Alamat</th>
                            <th>Produk</th>
                            <th>Jumlah Pesanan</th>
                            <th>Status Pesanan</th>
                            <th>Tanggal Pesanan</th>
                            <th>Harga Pesanan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanans as $pesanan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pesanan->no_pesanan }}</td>
                                <td>{{ $pesanan->nama_pemesan }}</td>
                                <td>{{ $pesanan->no_telp }}</td>
                                <td>{{ $pesanan->alamat }}</td>
                                <td>{{ $pesanan->product ? $pesanan->product->nama_produk : 'N/A' }}</td>
                                <td>{{ $pesanan->jumlah_pesanan }} box</td>
                                <td>
                                    @php
                                        $statusClass = '';
                                        $statusText = ucfirst($pesanan->status_pesanan);
                                        switch($pesanan->status_pesanan) {
                                            case 'Pending':
                                                $statusClass = 'bg-warning text-dark';
                                                break;
                                            case 'Pesanan ditolak':
                                                $statusClass = 'bg-danger text-white';
                                                break;
                                            case 'Pesanan diterima':
                                                $statusClass = 'bg-success text-white';
                                                break;
                                            case 'Pesanan dikirim':
                                                $statusClass = 'bg-dark text-white';
                                                break;   
                                            default:
                                                $statusClass = 'bg-info text-white';
                                        }
                                    @endphp
                                    <span class="badge {{ $statusClass }}" style="font-size: 15px">{{ $statusText }}</span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($pesanan->tanggal_pesananan)->format('d-m-Y H:i') }}</td>
                                <td>Rp. {{ number_format($pesanan->harga_pesanan) }}</td>
                                <td>
                                    <a href="{{ route('pesanan.edit', $pesanan->id) }}" class="btn btn-secondary mb-2">
                                        <i class="ti-pencil-alt"></i>
                                    </a>
                                    @if(!$pesanan->transaksi)
                                        <form action="{{ route('pesanan.destroy', $pesanan->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger mb-2">
                                                <i class="ti-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
          </div>
         

      </div>
  </div><!-- .animated -->
</div><!-- .content -->
</div>
@endsection
