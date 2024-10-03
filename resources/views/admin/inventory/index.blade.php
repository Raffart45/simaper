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
                  <li class="active">Data table inventory</li>
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
                        <strong class="card-title">Data Inventory</strong>
                        <div class="d-flex justify-content-between align-items-center">
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
                            <a href="{{ route('inventory.create') }}" class="btn btn-warning">Tambah Data</a>
                         </div>
                        </div>
                      </div>
                  </div>
                  <div class="card-body">
                      <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                          <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Produk</th>
                                  <th>Stok / Buah</th>
                                  <th>Tipe</th>
                                  <th>Tanggal</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($inventories as $inventory)
                              <tr  class="{{ $inventory->tipe === 'masuk' ? 'text-success' : ($inventory->tipe === 'keluar' ? 'text-danger' : '') }}">
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $inventory->product->nama_produk }}</td> <!-- Asumsi ada relasi di model Product -->
                                  <td>{{ $inventory->jumlah }}</td>
                                  <td>{{ ucfirst($inventory->tipe) }}</td>
                                  <td>{{ \Carbon\Carbon::parse($inventory->tanggal)->format('d-m-Y') }}</td>
                                  <td>
                                    <form action="{{ route('inventory.destroy', $inventory->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure?')"
                                            class="btn btn-danger mb-2"> <i class="ti-trash"></i></button>
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

@push('scripts')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#bootstrap-data-table-export').DataTable({
            order: [[3, 'asc'], [4, 'desc']], // Urutkan berdasarkan tipe (kolom ke-3) secara ascending dan tanggal (kolom ke-4) secara descending
            columnDefs: [
                {
                    targets: 4, // Kolom tanggal
                    render: function (data, type, row) {
                        if(type === 'sort' || type === 'type') {
                            // Mengembalikan format tanggal ke yyyy-mm-dd untuk pengurutan
                            return data.split('-').reverse().join('-');
                        }
                        return data;
                    }
                }
            ]
        });
    });
</script>
@endpush
