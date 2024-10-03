@extends('admin.layouts.base')

@section('content')
<div class="container py-2">
    <div class="card">
        <div class="card-header">
            <h1>Edit Data Pesanan</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('pesanan.update',$pesanan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="status">Status Pesanan</label>
                    <select name="status_pesanan" id="status" class="form-control">
                        <option value="Pending" {{ $pesanan->status_pesanan === 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Pesanan ditolak" {{ $pesanan->status_pesanan === 'Pesanan ditolak' ? 'selected' : '' }}>Pesanan ditolak</option>
                        <option value="Pesanan diterima" {{ $pesanan->status_pesanan === 'Pesanan diterima' ? 'selected' : '' }}>Pesanan diterima</option>
                        <option value="Pesanan dikirim" {{ $pesanan->status_pesanan === 'Pesanan dikirim' ? 'selected' : '' }}>Pesanan dikirim</option>
                        <option value="Pesanan sampai" {{ $pesanan->status_pesanan === 'Pesanan sampai' ? 'selected' : '' }}>Pesanan sampai</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('pesanan.index') }}" class="btn btn-warning">Kembali</a>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
