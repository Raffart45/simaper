<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success Payment</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .success-message {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            width: 600px;
        }
        .success-icon {
            font-size: 5rem;
            color: green;
        }
    </style>
</head>
<body style="background:#757575">
    <div class="container success-message" >
        <div class="card p-4 border border-2 rounded shadow-lg">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <i class="fas fa-check-circle success-icon"></i>
            <h1 class="mt-4">Selamat, Pembayaran Anda Kami Terima!</h1>
            <p class="mt-3">Terima kasih telah melakukan pembayaran. Silakan menunggu konfirmasi admin untuk melakukan proses selanjutnya.</p>
            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('dashboard.user') }}" class="btn btn-warning">Kembali ke Dashboard</a>
                <a href="{{ route('user') }}" class="btn btn-primary">Kembali ke Halaman Utama</a>
            </div>
        </div>
    </div>
</body>
</html>
