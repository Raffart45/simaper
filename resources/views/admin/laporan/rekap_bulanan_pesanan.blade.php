@extends('admin.layouts.base')

@section('content')
<div class="breadcrumbs">
  <div class="col-sm-4">
      <div class="page-header float-left">
          <div class="page-title">
              <h1>Laporan Rekap Bulanan</h1>
          </div>
      </div>
  </div>
  <div class="col-sm-8">
      <div class="page-header float-right">
          <div class="page-title">
              <ol class="breadcrumb text-right">
                  <li><a href="#">Dashboard</a></li>
                  <li><a href="#">Laporan</a></li>
                  <li class="active">Rekap Bulanan</li>
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
                        <strong class="card-title">Rekap Bulanan Pesanan</strong>
                        <div>
                          <a href="#" class="btn btn-success" onclick="document.getElementById('print-form').submit();">Cetak Data</a>
                          <form action="{{ route('laporan.printRekap') }}" method="GET" id="print-form" class="d-none">
                              <input type="hidden" name="bulan" value="{{ $bulan }}">
                              <input type="hidden" name="tahun" value="{{ $tahun }}">
                          </form>
                        </div>
                      </div>
                  </div>
                  <div class="card-body">
                      <form method="GET" action="{{ route('laporan.rekapBulanan') }}">
                          <div class="row mb-3">
                              <div class="col-md-6">
                                  <label>Bulan</label>
                                  <input type="month" name="bulan" class="form-control" value="{{ $bulan }}">
                              </div>
                              <div class="col-md-6">
                                  <label>Tahun</label>
                                  <input type="text" name="tahun" class="form-control" value="{{ $tahun }}" placeholder="YYYY">
                              </div>
                          </div>
                          <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Filter</button>
                          </div>
                      </form>

                      <!-- Tabel Rekap Pesanan -->
                      <table class="table table-striped table-bordered mt-5">
                          <thead>
                              <tr>
                                  <th>No</th>
                                  <th>No. Pesanan</th>
                                  <th>Nama Pemesan</th>
                                  <th>Alamat</th>
                                  <th>Nama Produk</th>
                                  <th>Jumlah</th>
                                  <th>Harga Satuan </th>
                                  <th>Total Harga</th>
                                  <th>Status Pesanan</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach($pesanans as $pesanan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pesanan->no_pesanan }}</td>
                                    <td>{{ $pesanan->nama_pemesan }}</td>
                                    <td>{{ $pesanan->alamat }}</td>
                                    <td>{{ $pesanan->product->nama_produk }}</td>
                                    <td>{{ $pesanan->jumlah_pesanan }} box</td>
                                    <td>Rp. {{ number_format($pesanan->product->harga, 0, ',', '.') }} /kg</td>
                                    <td>Rp. {{ number_format($pesanan->harga_pesanan, 0, ',', '.') }}</td>
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
                                            default:
                                                $statusClass = 'bg-info text-white';
                                        }
                                    @endphp
                                    <span class="badge {{ $statusClass }}" style="font-size: 15px">{{ $statusText }}</span>
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
