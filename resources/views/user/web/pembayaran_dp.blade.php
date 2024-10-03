<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran DP</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background:#ff8787">
    <div class="container mt-5 mb-5">
        <div class="card p-4 border border-2 rounded shadow-lg">
            <div class="card-header text-center bg-primary text-white">
                <h1>Form Pembayaran DP Pesanan Produk PT Sata Harum</h1>
            </div>
            <div class="card-body">
                <form id="payment-form" action="{{ route('user.pembayaran.store', $pesanan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="accordion" id="paymentAccordion">
                        <!-- Detail Pelanggan Section -->
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Detail Pelanggan
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#paymentAccordion">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Nama Pemesan</label>
                                                <input type="text" class="form-control" value="{{ $pesanan->user->name }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">No Telepon Pemesan</label>
                                                <input type="text" class="form-control" value="{{ $pesanan->user->phone_number }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Alamat Pemesan</label>
                                        <textarea name="" id="" cols="5" rows="3" class="form-control" readonly>{{ $pesanan->alamat }}</textarea>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">No Pesanan</label>
                                                <input type="text" class="form-control" value="{{ $pesanan->no_pesanan }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Produk</label>
                                                <input type="text" class="form-control" value="{{ $pesanan->product->nama_produk }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Pembayaran Section -->
                        <div class="card">
                            <div class="card-header" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Pembayaran
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#paymentAccordion">
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
                        <!-- Harga dan DP Section -->
                        <div class="card">
                            <div class="card-header" id="headingThree">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Harga dan DP
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#paymentAccordion">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="">Harga Produk</label>
                                        <input type="text" class="form-control" value="Rp.{{ number_format($pesanan->harga_pesanan, 0, ',', '.') }}" readonly>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Nominal DP <sup class="text-danger"> * DP 50% dari harga produk = ( Rp.{{ number_format($pesanan->harga_pesanan * 0.5, 0, ',', '.') }} )</sup></label>
                                                <input type="text" class="form-control" id="nominal-dp" name="harga_dp" oninput="validateNumberInput(this)" required>
                                                <small id="nominal-dp-error" class="form-text text-danger"></small>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Foto DP</label>
                                                <input type="file" class="form-control" name="foto_dp" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('dashboard.user.pesanan') }}" class="btn btn-primary">Kembali ke Halaman Utama</a>
                        <button type="submit" class="btn btn-success">Bayar DP</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script>
        function validateNumberInput(input) {
            input.value = input.value.replace(/[^0-9]/g, '');
        }

        document.getElementById('payment-form').addEventListener('submit', function(e) {
            var nominalDp = parseInt(document.getElementById('nominal-dp').value.replace(/[^0-9]/g, ''));
            var hargaDp = parseInt({{ $pesanan->harga_pesanan * 0.5 }});

            var errorMessage = '';

            if (isNaN(nominalDp)) {
                errorMessage = 'Nominal DP harus berupa angka.';
            } else if (nominalDp > hargaDp) {
                errorMessage = 'Nominal DP tidak boleh lebih dari harga DP yang harus dibayarkan.';
            } else if (nominalDp < (hargaDp * 0.5)) { // Assuming you need a minimum value check
                errorMessage = 'Nominal DP tidak boleh kurang dari setengah harga DP yang harus dibayarkan.';
            }

            if (errorMessage) {
                e.preventDefault();
                document.getElementById('nominal-dp-error').textContent = errorMessage;
            }
        });
    </script>
</body>
</html>
