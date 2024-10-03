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
                  <li class="active">Data Table Transaksi</li>
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
                        <strong class="card-title">Data Transaksi</strong>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <!-- Filter Form -->
                               <form action="{{ route('bayar.index') }}" method="GET" class="form-inline">
                                <input type="text" name="nama_produk" id="nama_produk" class="form-control mr-2" value="{{ request('nama_produk') }}" placeholder="Tulis nama produknya">
                                <select name="status_transaksi" id="status_transaksi" class="form-control mr-2">
                                    <option value="" disabled selected>Pilih status transaksi</option>
                                    <option value="Lunas" {{ request('status_transaksi') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                                    <option value="DP" {{ request('status_transaksi') == 'DP' ? 'selected' : '' }}>DP</option>
                                </select>
                                <input type="month" name="tanggal_dp" id="tanggal_dp" class="form-control mr-2" value="{{ request('tanggal_dp') }}">
                                <button type="submit" class="btn btn-primary">Filter</button>
                               </form>
                           </div>
                           <div class="ml-2">
                            <a href="#" class="btn btn-success" onclick="document.getElementById('print-form').submit();">Cetak Data</a>
                            <form action="{{ route('transaksi.print') }}" method="GET" id="print-form" class="d-none">
                                <input type="hidden" name="status_transaksi" value="{{ request('status_transaksi') }}">
                                <input type="hidden" name="tanggal_dp" value="{{ request('tanggal_dp') }}">
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
                                  <th>No. Transaksi</th>
                                  <th>No. Pesanan</th>
                                  <th>Nama Pemesan</th>
                                  <th>Produk</th>
                                  <th>Harga DP</th>
                                  <th>Tanggal DP</th>
                                  <th>Total Belum Dibayarkan</th>
                                  <th>Status Transaksi</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach($transaksis as $transaksi)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $transaksi->no_transaksi }}</td>
                                    <td>{{ $transaksi->pesanan->no_pesanan }}</td>
                                    <td>{{ $transaksi->pesanan->user->name }}</td>
                                    <td>{{ $transaksi->pesanan->product->nama_produk }}</td>
                                    <td>Rp. {{ number_format($transaksi->harga_dp, 0, ',', '.') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_dp)->format('d-m-Y H:i') }}</td>
                                    <td>Rp. {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</td>
                                    <td>
                                        @php
                                        $statusClass = '';
                                        $statusText = ucfirst($transaksi->status_transaksi);
                                        switch($transaksi->status_transaksi) {
                                            case 'DP':
                                                $statusClass = 'bg-warning text-dark';
                                                break;
                                            case 'Batal':
                                                $statusClass = 'bg-danger text-white';
                                                break;
                                            case 'Lunas':
                                                $statusClass = 'bg-success text-white';
                                                break;
                                            default:
                                                $statusClass = 'bg-secondary text-white';
                                        }
                                    @endphp
                                    <span class="badge {{ $statusClass }}" style="font-size: 15px">{{ $statusText }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('bayar.show', $transaksi->id) }}" class="btn btn-primary mb-2">
                                            <i class="ti-eye"></i>
                                        </a>
                                        {{-- <a href="{{ route('bayar.edit', $transaksi->id) }}" class="btn btn-secondary mb-2">
                                            <i class="ti-pencil-alt"></i>
                                        </a> --}}
                                        <form action="{{ route('bayar.destroy', $transaksi->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger mb-2">
                                                <i class="ti-trash"></i>
                                            </button>
                                        </form>
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
