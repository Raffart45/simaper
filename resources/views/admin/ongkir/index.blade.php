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
                  <li class="active">Data table ongkir</li>
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
                        <strong class="card-title">Data Ongkir Produk</strong>
                        {{-- <div class="d-flex justify-content-between align-items-center">
                           <div>
                            <form action="{{ route('inventory.index') }}" method="GET" class="form-inline" id="filter-form">
                                <select name="tipe" class="form-control mr-2">
                                    <option value="">Pilih Tipe</option>
                                    <option value="masuk" {{ request('tipe') == 'masuk' ? 'selected' : '' }}>Masuk</option>
                                    <option value="keluar" {{ request('tipe') == 'keluar' ? 'selected' : '' }}>Keluar</option>
                                </select>
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
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </form>
                           </div>
                         <div class="ml-2">
                            <a href="#" class="btn btn-success" onclick="document.getElementById('print-form').submit();">Cetak Data</a>
                            <form action="{{ route('inventory.print') }}" method="GET" id="print-form" class="d-none">
                                <input type="hidden" name="tipe" value="{{ request('tipe') }}">
                                <input type="hidden" name="tahun" value="{{ request('tahun') }}">
                                <input type="hidden" name="bulan" value="{{ request('bulan') }}">
                            </form>
                         </div>
                        </div> --}}
                      </div>
                  </div>
                  <div class="card-body">
                      <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                          <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Kabupaten</th>
                                  <th>Provinsi</th>
                                  <th>Harga Ongkir</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($ongkirs as $ongkir)
                              <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $ongkir->kabupaten }}</td>
                                  <td>{{ $ongkir->provinsi }}</td>
                                  <td>Rp. {{ number_format($ongkir->harga_ongkir) }}</td>
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

