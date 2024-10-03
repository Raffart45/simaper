<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengembalian Produk</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="mb-4">Form Pengembalian Produk</h4>
                        <form action="{{ route('user.return.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                            <div class="form-group">
                                <label for="jumlah">No Transaksi</label>
                                <input type="text" class="form-control" id="jumlah" value="{{ $transaction->no_transaksi }}" readonly>
                            </div> <!-- Replace with dynamic value -->
                            <div class="form-group">
                                <label for="jumlah">Jumlah Barang <sup class="text-danger">Minimal pengembalian 10 box</sup> </label>
                                <input type="number" class="form-control" id="jumlah" name="jumlah" min="10" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal">Tanggal Pengembalian</label>
                                <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                            </div>
                            <div class="form-group">
                                <label for="alasan">Alasan Pengembalian</label>
                                <textarea class="form-control" id="alasan" name="alasan" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="foto_produk">Foto Produk</label>
                                <input type="file" class="form-control" id="foto_produk" name="foto_produk" accept="image/*" required>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('dashboard.user') }}" class="btn btn-warning">Kembali</a>
                                <button type="submit" class="btn btn-primary">Kirim Form Pengembalian</button>
                            </div>
                        </form>
                    </div><!--//card-body-->
                </div><!--//card-->
            </div><!--//col-->
        </div><!--//row-->
    </div><!--//container-->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
