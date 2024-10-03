<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Pelunasan Produk</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background:#ddfa76">
    <div class="container mt-5 mb-5">
        <div class="card p-4 border border-2 rounded shadow-lg">
            <div class="card-header text-center bg-success text-white">
                <h1>Form Pelunasan Pesanan Produk PT Sata Harum</h1>
            </div>
            <div class="card-body">
                <form id="payment-form" action="{{ route('user.pembayaran.lunas.store', $transaksi->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="accordion">
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class="mb-0">
                                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Detail Pelanggan
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Nama Pemesan</label>
                                                <input type="text" class="form-control" value="{{ $transaksi->pesanan->user->name }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">No Telepon Pemesan</label>
                                                <input type="text" class="form-control" value="{{ $transaksi->pesanan->user->phone_number }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Alamat Pemesan</label>
                                        <textarea name="" id="" cols="5" rows="3" class="form-control" readonly>{{ $transaksi->pesanan->alamat }}</textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">No Pesanan</label>
                                                <input type="text" class="form-control" value="{{ $transaksi->no_transaksi }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Produk</label>
                                                <input type="text" class="form-control" value="{{ $transaksi->pesanan->product->nama_produk }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Instruksi Pembayaran
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">No Rekening Bank Mandiri</label>
                                                <input type="text" class="form-control" value="1140020494509 / Arrom Bayu Satria" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <p>Qr Code</p>
                                                <div class="border border-2 border-warning p-3 text-center"> <img src="{{ url('web/img/qris.jpg') }}" alt="" width="300">  </div>     
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Detail Pembayaran
                                    </button>
                                </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Harga Produk</label>
                                                <input type="text" class="form-control" value="Rp.{{ number_format($transaksi->pesanan->harga_pesanan, 0, ',', '.') }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">DP yang sudah dibayarkan</label>
                                                <input type="text" class="form-control" value="Rp.{{ number_format($transaksi->harga_dp, 0, ',', '.') }}"  readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Nominal Pelunasan <sup class="text-danger"> * total yang belum dibayarkan = (Rp.{{ number_format($transaksi->total_bayar, 0, ',', '.') }})</sup></label>
                                                <input type="text" class="form-control" id="nominal-lunas" name="lunas" oninput="validateNumberInput(this)" required>
                                                <small id="nominal-lunas-error" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Foto Lunas</label>
                                                <input type="file" class="form-control" name="foto_lunas" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('dashboard.user.transaksi') }}" class="btn btn-primary">Kembali ke Halaman Utama</a>
                        <button type="submit" class="btn btn-success">Lunasi Pembayaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function validateNumberInput(input) {
            input.value = input.value.replace(/[^0-9]/g, '');
        }

        document.getElementById('payment-form').addEventListener('submit', function(e) {
            var nominalLunas = parseInt(document.getElementById('nominal-lunas').value.replace(/[^0-9]/g, ''));
            var hargaLunas = parseInt({{ $transaksi->total_bayar }});

            var errorMessage = '';

            if (isNaN(nominalLunas)) {
                errorMessage = 'Nominal Pelunasan harus berupa angka.';
            } else if (nominalLunas > hargaLunas) {
                errorMessage = 'Nominal Pelunasan tidak boleh lebih dari total harga yang belum dibayarkan.';
            } else if (nominalLunas < hargaLunas ) { // Assuming you need a minimum value check
                errorMessage = 'Nominal Lunas tidak boleh kurang dari total harga yang belum dibayarkan.';
            }

            if (errorMessage) {
                e.preventDefault();
                document.getElementById('nominal-lunas-error').textContent = errorMessage;
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
