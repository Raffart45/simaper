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
                  <li class="active">Create Inventory</li>
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
                      <strong class="card-title">Create Inventory</strong>
                  </div>
                  <div class="card-body">
                      <form action="{{ route('inventory.store') }}" method="POST">
                          @csrf

                          <div class="form-group">
                              <label for="product_id">Product</label>
                              <select name="product_id" id="product_id" class="form-control" required>
                                  <option value="">Select Product</option>
                                  @foreach($products as $product)
                                      <option value="{{ $product->id }}">{{ $product->nama_produk }}</option>
                                  @endforeach
                              </select>
                              @error('product_id')
                                  <div class="text-danger">{{ $message }}</div>
                              @enderror
                          </div>

                          <div class="form-group">
                              <label for="jumlah">Jumlah</label>
                              <input type="number" id="jumlah" name="jumlah" class="form-control" required>
                              @error('jumlah')
                                  <div class="text-danger">{{ $message }}</div>
                              @enderror
                          </div>

                          <div class="form-group">
                              <label for="tipe">Tipe</label>
                              <select name="tipe" id="tipe" class="form-control" required>
                                  <option value="">Select Type</option>
                                  <option value="masuk">Masuk</option>
                                  <option value="keluar">Keluar</option>
                              </select>
                              @error('tipe')
                                  <div class="text-danger">{{ $message }}</div>
                              @enderror
                          </div>

                          <div class="form-group">
                              <label for="tanggal">Tanggal</label>
                              <input type="date" id="tanggal" name="tanggal" class="form-control" required>
                              @error('tanggal')
                                  <div class="text-danger">{{ $message }}</div>
                              @enderror
                          </div>

                          <button type="submit" class="btn btn-primary">Save</button>
                          <a href="{{ route('inventory.index') }}" class="btn btn-secondary">Cancel</a>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div><!-- .animated -->
</div><!-- .content -->
@endsection
