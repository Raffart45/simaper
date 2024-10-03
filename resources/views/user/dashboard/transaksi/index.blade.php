@extends('user.dashboard.layouts.base')

@section('content')
<div class="container-xl mt-4">
    <h1 class="app-page-title mb-4">Daftar Transaksi</h1>
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="app-card app-card-orders-table shadow-sm mb-5">
        <div class="app-card-body">
            @if($transaksis->isEmpty())
                <div class="alert alert-warning text-center">Anda belum memiliki transaksi.</div>
            @else
                <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                        <thead>
                            <tr>
                                <th class="cell">No</th>
                                <th class="cell">No. Transaksi</th>
                                <th class="cell">No. Pesanan</th>
                                <th class="cell">Produk</th>
                                <th class="cell">Harga DP</th>
                                <th class="cell">Tanggal DP</th>
                                <th class="cell">Total belum Dibayarkan</th>
                                <th class="cell">Status Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksis as $transaksi)
                                <tr>
                                    <td class="cell">{{ $loop->iteration }}</td>
                                    <td class="cell">{{ $transaksi->no_transaksi }}</td>
                                    <td class="cell">{{ $transaksi->pesanan->no_pesanan }}</td>
                                    <td class="cell">{{ $transaksi->pesanan->product->nama_produk }}</td>
                                    <td class="cell">Rp. {{ number_format($transaksi->harga_dp, 0, ',', '.') }}</td>
                                    <td class="cell">{{ \Carbon\Carbon::parse($transaksi->tanggal_dp)->format('d-m-Y H:i') }}</td>
                                    <td class="cell">Rp. {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</td>
                                    <td class="cell ">
                                        @php
                                        $statusClass = '';
                                        $statusText = ucfirst($transaksi->status_transaksi);
                                        switch($transaksi->status_transaksi) {
                                            case 'DP':
                                                $statusClass = 'bg-warning text-dark';
                                                break;
                                            case 'Batal':
                                                $statusClass = 'bg-danger text-white';
                                                break;
                                            default:
                                                $statusClass = 'bg-info text-white';
                                        }
                                    @endphp
                                    <span class="badge {{ $statusClass }}">{{ $statusText }}</span>
                                    </td>
                                    <td>
                                        @if($transaksi->status_transaksi == 'DP')
                                            <a href="{{ route('user.pembayaran.lunas', $transaksi->id) }}" class="btn btn-warning">Lunasi Pembayaran</a>
                                        @endif
                                        @if($transaksi->status_transaksi == 'Lunas')
                                            <a href="{{ route('user.invoice', $transaksi->id) }}" class="btn btn-warning">Cetak Invoice Pembayaran</a>
                                        @endif
                                    </td>
                                    <td>
                                        @if($transaksi->return->isEmpty() && $transaksi->status_transaksi == 'Lunas')
                                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#returnModal">Return Produk</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!--//table-responsive-->
                   <!-- Modal -->
            <div class="modal fade" id="returnModal" tabindex="-1" aria-labelledby="returnModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="returnModalLabel">Syarat dan ketentuan return produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <ul>
                                    <li>Produk yang dikembalikan minimal 10 box</li>
                                    <li>Produk yang dikembalikan harus dalam kondisi yang dilaporkan dibuktikan dengan foto</li>
                                    <li>Harga kembalian dan ongkir produk ditanggung oleh perusahaan</li>
                                    <li>Produk dikembalikan dalam 7 hari kerja</li>
                                    <li>Produk dikirim Kembali ke konsumen selama kurang dari 7 hari</li>
                                    <li>Untuk info lebih lanjut silahkan hubungi customer service</li>
                                </ul>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="agreeCheck">
                                <label class="form-check-label" for="agreeCheck">
                                    Saya setuju dengan syarat dan ketentuan pengembalian produk.
                                </label>
                            </div>
                            <div id="returnForm" class="mt-5" style="display: none;">
                                <!-- Form Return Produk -->
                                @foreach($transaksis as $transaksi)
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('user.return.form', $transaksi->id) }}" class="btn btn-primary">Lihat Form Return</a>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div><!--//app-card-body-->      
    </div><!--//app-card-->
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var agreeCheck = document.getElementById('agreeCheck');
        var returnForm = document.getElementById('returnForm');

        agreeCheck.addEventListener('change', function () {
            if (this.checked) {
                returnForm.style.display = 'block';
            } else {
                returnForm.style.display = 'none';
            }
        });
    });
</script>
@endsection
