@extends('admin.layouts.base')

@section('content')
<div class="breadcrumbs">
  <div class="col-sm-4">
      <div class="page-header float-left">
          <div class="page-title">
              <h1>Edit Status Pengembalian Produk</h1>
          </div>
      </div>
  </div>
  <div class="col-sm-8">
      <div class="page-header float-right">
          <div class="page-title">
              <ol class="breadcrumb text-right">
                  <li><a href="#">Dashboard</a></li>
                  <li><a href="#">Return Produk</a></li>
                  <li class="active">Edit Status</li>
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
                        <strong>Edit Status Pengembalian Produk</strong>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.return.update-status', $return->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="Proses Pengembalian" {{ $return->status == 'Proses Pengembalian' ? 'selected' : '' }}>Proses Pengembalian</option>
                                    <option value="Pengembalian ditolak" {{ $return->status == 'Pengembalian ditolak' ? 'selected' : '' }}>Pengembalian ditolak</option>
                                    <option value="Pengembalian diterima" {{ $return->status == 'Pengembalian diterima' ? 'selected' : '' }}>Pengembalian diterima</option>
                                    <option value="Produk dikirim" {{ $return->status == 'Produk dikirim' ? 'selected' : '' }}>Produk dikirim</option>
                                    <option value="Produk sampai" {{ $return->status == 'Produk sampai' ? 'selected' : '' }}>Produk sampai</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update Status</button>
                                <a href="{{ route('admin.return.data') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection