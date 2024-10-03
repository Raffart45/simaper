@extends('admin.layouts.base')

@section('content')
<div class="container py-2">
  <div class="card">
    <div class="card-header">
      <h1>Create Data Produk</h1>
    </div>
    <div class="card-body">
      <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="nama_produk">Nama Produk</label>
              <input type="text" name="nama_produk" id="nama_produk" class="form-control" required>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="stok">Stok</label>
              <input type="text" name="stok" id="stok" class="form-control" oninput="validateNumberInput(this)" required>
          </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="category">Category</label>
              <select name="category" id="category" class="form-control" required>
                <option value="" disabled selected>Pilih kategori produk ...</option>
                <option value="Grade A">Grade A</option>
                <option value="Grade B">Grade B</option>
                <option value="Grade C">Grade C</option>
              </select>
          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="harga">Harga</label>
              <input type="text" name="harga" id="harga" class="form-control" required oninput="validateNumberInput(this)">
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="foto_produk">Foto Produk</label>
              <input type="file" name="foto_produk" id="foto_produk" class="form-control" required>
          </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="thumbnails">Thumbnail</label>
              <input type="file" name="thumbnails[]" id="thumbnails" class="form-control" multiple required>
          </div>
          </div>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" class="form-control" required></textarea>
        </div>
       <div class="d-flex justify-content-between mt-4">
        <a href="{{route('produk.index')}}" class="btn btn-warning">Kembali</a>
        <button type="submit" class="btn btn-success">Submit</button>
       </div>
    </form>
    </div>
  </div>
</div>
<script>
  function validateNumberInput(input) {
      input.value = input.value.replace(/[^0-9]/g, '');
  }
</script>
@endsection