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
                  <li class="active">Data table produk</li>
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
                      <div class="d-flex justify-content-between">
                        <strong class="card-title">Data Produk</strong>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <form action="{{ route('produk.index') }}" method="GET" class="form-inline" id="filter-form">
                                    <select name="grade" class="form-control mr-2">
                                        <option value="">Pilih Grade</option>
                                        <option value="Grade A" {{ request('category') == 'Grade A' ? 'selected' : '' }}>A</option>
                                        <option value="Grade B" {{ request('category') == 'Grade B' ? 'selected' : '' }}>B</option>
                                        <option value="Grade C" {{ request('category') == 'Grade C' ? 'selected' : '' }}>C</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </form>
                            </div>
                            <div class="ml-2">
                                <a href="#" class="btn btn-success" onclick="document.getElementById('print-form').submit();">Cetak Data</a>
                                <form action="{{ route('produk.cetak') }}" method="GET" id="print-form" class="d-none">
                                    <input type="hidden" name="grade" value="{{ request('grade') }}">
                                </form>
                                <a href="{{ route('produk.create') }}" class="btn btn-warning">Tambah Data</a>
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="card-body">
                      <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                          <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Nama Produk</th>
                                  <th>Stok / Buah</th>
                                  <th>Kategori</th>
                                  <th>Foto Produk</th>
                                  <th>Total Berat / Kg</th>
                                  <th>Total Box</th>
                                  <th>Deskripsi</th>
                                  <th>Harga / Kg</th>
                                  <th>Thumbnail</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($products as $product)
                              <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{$product->nama_produk}}</td>
                                  <td>{{$product->stok}}</td>
                                  <td>{{$product->category}}</td>
                                  <td>
                                    <img src="{{ Storage::url($product->foto_produk) }}" alt="Foto Produk" width="100">
                                  </td>
                                  <td>{{$product->berat}}</td>
                                  <td>{{$product->box}}</td>
                                  <td>{{$product->deskripsi}}</td>
                                  <td>Rp. {{ number_format($product->harga, 0, ',', '.') }}</td>
                                  <td>
                                    @if($product->thumbnails)
                                        @foreach($product->thumbnails as $thumbnail)
                                            <img src="{{ Storage::url($thumbnail) }}" alt="Thumbnail" width="50">
                                        @endforeach
                                    @endif
                                  </td>
                                  <td>
                                    <a href="{{ route('produk.edit', $product->id) }}"
                                        class="btn btn-secondary mb-2">
                                        <i class="ti-pencil-alt"></i>
                                    </a>
                                    <form action="{{ route('produk.destroy', $product->id) }}"
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
