@extends('admin.layouts.base')

@section('content')
<div class="container py-2">
    <div class="card">
        <div class="card-header">
            <h1>Edit Data Produk</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('produk.update',$product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nama_produk">Nama Produk</label>
                            <input type="text" name="nama_produk" id="nama_produk" class="form-control" value="{{ old('nama_produk',$product->nama_produk) }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input type="text" name="stok" id="stok" class="form-control" oninput="validateNumberInput(this)" value="{{ old('stok',$product->stok) }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select name="category" id="category" class="form-control">
                                <option value="" disabled>Pilih kategori produk ...</option>
                                <option value="Grade A" {{$product->category == 'Grade A' ? 'selected' : '' }}>Grade A</option>
                                <option value="Grade B" {{$product->category == 'Grade B' ? 'selected' : '' }}>Grade B</option>
                                <option value="Grade C" {{$product->category == 'Grade C' ? 'selected' : '' }}>Grade C</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="text" name="harga" id="harga" class="form-control" value="{{ old('harga',$product->harga) }}" required oninput="validateNumberInput(this)">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="foto_produk">Foto Produk</label>
                            <input type="file" name="foto_produk" id="foto_produk" class="form-control">
                            @if($product->foto_produk)
                                <img src="{{ Storage::url($product->foto_produk) }}" class="mt-3" alt="Current Photo" width="100">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="thumbnails">Thumbnail</label>
                            <input type="file" name="thumbnails[]" id="thumbnails" class="form-control" multiple>
                            @if($product->thumbnails)
                                @foreach($product->thumbnails as $thumbnail)
                                    <img src="{{ Storage::url($thumbnail) }}" alt="Thumbnail" width="100" class="mt-3">
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" required>{{ old('deskripsi',$product->deskripsi) }}</textarea>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('produk.index') }}" class="btn btn-warning">Kembali</a>
                    <button type="submit" class="btn btn-success">Update</button>
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
