@extends('user.dashboard.layouts.base')

@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Data Pesanan Pelanggan</h1>
            </div>
        </div><!--//row-->

        @if($pesanans->where('status_pesanan', 'Pending')->count() > 0)
        <div class="alert alert-warning text-center">
            Pesanan anda menunggu konfirmasi dari admin PT Saha Harum
        </div>
        @else
            <div class="tab-content" id="orders-table-tab-content">
                <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
                    <div class="app-card app-card-orders-table shadow-sm mb-5">
                        <div class="app-card-body">
                            <div class="table-responsive">
                                <table class="table app-table-hover mb-0 text-left">
                                    <thead>
                                        <tr>
                                            <th class="cell">No</th>
                                            <th class="cell">No. Pesanan</th>
                                            <th class="cell">Nama Produk</th>
                                            <th class="cell">Nama Pemesan</th>
                                            <th class="cell">No. Telepon</th>
                                            <th class="cell">Alamat</th>
                                            <th class="cell">Tanggal Pesanan</th>
                                            <th class="cell">Jumlah Pesanan</th>
                                            <th class="cell">Harga Pesanan</th>
                                            <th class="cell">Status Pesanan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pesanans->where('status_pesanan', '!=', 'Pending') as $pesanan)
                                            <tr>
                                                <td class="cell">{{ $loop->iteration }}</td>
                                                <td class="cell">{{ $pesanan->no_pesanan }}</td>
                                                <td class="cell">{{ $pesanan->product->nama_produk }}</td>
                                                <td class="cell">{{ $pesanan->nama_pemesan }}</td>
                                                <td class="cell">{{ $pesanan->no_telp }}</td>
                                                <td class="cell">{{ $pesanan->alamat }}</td>
                                                <td class="cell">{{ \Carbon\Carbon::parse($pesanan->tanggal_pesananan)->format('d-m-Y H:i') }}</td>
                                                <td class="cell">{{ $pesanan->jumlah_pesanan }} box</td>
                                                <td class="cell">Rp. {{ number_format($pesanan->harga_pesanan, 0, ',', '.') }}</td>
                                                <td class="cell">
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
                                                        <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
                                                </td>
                                                <td class="cell">
                                                    @if($pesanan->status_pesanan == 'Pesanan diterima')
                                                        <a href="{{ route('user.pembayaran', $pesanan->id) }}" class="btn btn-warning">Silahkan Bayar DP</a>
                                                    @endif
                                                     @if($pesanan->status_pesanan == 'Pesanan dikirim')
                                                     <p class="border border-info p-2">Note : Pesanan anda dalam proses pengiriman</p>
                                                    @endif
                                                    @if($pesanan->status_pesanan == 'Pesanan sampai')
                                                    <p class="border border-success p-2">Note : Terima kasih telah melakukan pesanan ke kami</p>
                                                   @endif
                                                    @if($pesanan->status_pesanan == 'Pesanan ditolak')
                                                        <p class="border border-danger p-2">Note : Mohon maaf pesanan anda kami tolak dikarenakan stok produk sudah habis</p>
                                                    @endif
                                                </td>                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div><!--//table-responsive-->
                        </div><!--//app-card-body-->		
                    </div><!--//app-card-->
                </div><!--//tab-pane-->
            </div><!--//tab-content-->
        @endif
    </div><!--//container-xl-->
</div><!--//app-content-->
@endsection
