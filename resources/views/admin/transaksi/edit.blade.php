@extends('admin.layouts.base')

@section('content')
<div class="breadcrumbs">
  <div class="col-sm-4">
      <div class="page-header float-left">
          <div class="page-title">
              <h1>Update Transaksi</h1>
          </div>
      </div>
  </div>
  <div class="col-sm-8">
      <div class="page-header float-right">
          <div class="page-title">
              <ol class="breadcrumb text-right">
                  <li><a href="#">Dashboard</a></li>
                  <li><a href="#">Table</a></li>
                  <li class="active">Update Transaksi</li>
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
                      <strong class="card-title">Update Transaksi</strong>
                  </div>
                  @if (session()->has('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
                  @endif
                  <div class="card-body">
                      <form action="{{ route('bayar.update', $transaksi->id) }}" method="POST" enctype="multipart/form-data">
                          @csrf
                          @method('PUT')

                          <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                      <label for="lunas">Lunas</label>
                                      <input type="number" id="lunas" name="lunas" class="form-control" value="{{ old('lunas', $transaksi->lunas) }}">
                                  </div>
                                  <div class="form-group">
                                      <label for="foto_lunas">Foto Lunas</label>
                                      <input type="file" id="foto_lunas" name="foto_lunas" class="form-control">
                                      @if($transaksi->foto_lunas)
                                          <img src="{{ url('storage/' . $transaksi->foto_lunas) }}" alt="Foto Lunas" width="100">
                                      @endif
                                  </div>
                                  <div class="form-group">
                                      <label for="tanggal_lunas">Tanggal Lunas</label>
                                      <input type="date" id="tanggal_lunas" name="tanggal_lunas" class="form-control" value="{{ old('tanggal_lunas', $transaksi->tanggal_lunas) }}">
                                  </div>
                              </div>

                              <div class="col-md-12">
                                <div class="form-group">
                                    <label for="status_transaksi">Total yang belum dibayarkan</label>
                                    <input type="text" id="" value="Rp. {{ number_format($transaksi->total_bayar, 0, ',', '.') }}" class="form-control" readonly>
                                </div>
                            </div>

                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label for="status_transaksi">Status Transaksi</label>
                                      <select id="status_transaksi" name="status_transaksi" class="form-control">
                                          <option value="" selected disabled>Pilih status transaksi ...</option>
                                          <option value="Lunas" {{ $transaksi->status_transaksi == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                                          <option value="DP" {{ $transaksi->status_transaksi == 'DP' ? 'selected' : '' }}>DP</option>
                                      </select>
                                  </div>
                              </div>

                              <div class="col-md-12">
                                  <button type="submit" class="btn btn-primary">Update Transaksi</button>
                                  <a href="{{ route('bayar.index') }}" class="btn btn-warning">Kembali</a>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection
