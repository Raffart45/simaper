<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .success-message {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .success-icon {
            font-size: 5rem;
            color: green;
        }
    </style>
</head>
<body style="background:#cfcfcf">
    <div class="container success-message" >
        <div class="card p-4 border border-2 rounded shadow-lg">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <i class="fas fa-check-circle success-icon"></i>
            <h1 class="mt-4">Selamat, Pesanan Anda Kami Terima!</h1>
            <p class="mt-3">Silakan menunggu konfirmasi admin PT Sata Harum untuk melakukan proses selanjutnya.</p>
            <div class="d-flex justify-content-center align-items-center">
                <a href="{{ route('user') }}" class="btn btn-primary mt-3">Kembali ke Halaman Utama</a>
            </div>
        </div>
    </div>
</body>
</html>
