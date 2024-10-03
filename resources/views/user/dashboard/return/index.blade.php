@extends('user.dashboard.layouts.base')

@section('content')
<div class="app-content pt-3 p-md-3 p-lg-4">
    <div class="container-xl">
        
        <div class="row g-3 mb-4 align-items-center justify-content-between">
            <div class="col-auto">
                <h1 class="app-page-title mb-0">Data Return Produk Pelanggan</h1>
            </div>
        </div><!--//row-->

        @if($returns->isEmpty())
        <div class="alert alert-warning text-center">
            Tidak ada return produk anda saat ini
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
                                            <th class="cell">No Transaksi</th>
                                            <th class="cell">Nama Produk</th>
                                            <th class="cell">Nama Pemesan</th>
                                            <th class="cell">Jumlah Pengembalian</th>
                                            <th class="cell">Tanggal</th>
                                            <th class="cell">Alasan Dikembalikan</th>
                                            <th class="cell">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($returns as $return)
                                        <tr>
                                            <td class="cell">{{ $loop->iteration }}</td>
                                            <td class="cell">{{ $return->transaksi->no_transaksi }}</td>
                                            <td class="cell">{{ $return->transaksi->pesanan->user->name }}</td>
                                            <td class="cell">{{ $return->transaksi->pesanan->product->nama_produk }}</td>
                                            <td class="cell">{{ $return->jumlah }} box</td>
                                            <td class="cell">{{  \Carbon\Carbon::parse($return->tanggal)->format('d-m-Y') }}</td>
                                            <td class="cell">{{ $return->alasan }}</td>
                                            <td class="cell">
                                              @php
                                              $statusClass = '';
                                              $statusText = ucfirst($return->status);
                                              switch($return->status) {
                                                  case 'Proses Pengembalian':
                                                      $statusClass = 'bg-warning text-dark';
                                                      break;
                                                  case 'Pengembalian ditolak':
                                                      $statusClass = 'bg-danger text-white';
                                                      break;
                                                  case 'Pengembalian diterima':
                                                      $statusClass = 'bg-success text-white';
                                                      break;  
                                                  default:
                                                      $statusClass = 'bg-info text-white';
                                              }
                                          @endphp
                                          <span class="badge {{ $statusClass }}" style="font-size: 15px">{{ $statusText }}</span>
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
