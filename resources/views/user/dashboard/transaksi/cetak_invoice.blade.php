<!DOCTYPE html>
<html>
<head>
    <title>Invoice {{ $transaksi->no_transaksi }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .invoice-table th {
            background-color: #f2f2f2;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header img {
            width: 100px;
        }
        .header .company-info {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('web/img/logo/logo.png') }}" alt="Company Logo">
        <div class="company-info">
            <p><strong>PT Sata Harum</strong></p>
            <p>Jl.KH Idris No.143, Dusun Krajan 1, Betektaman, Kec. Gading, Kabupaten Probolinggo, Jawa Timur 67292</p>
            <p>Email: satriyaarrom@gmail.com</p>
            <p>No. Telp: 082334391141</p>
        </div>
    </div>
    <div class="invoice-header">
        <h1>Invoice Pembayaran</h1>
        <p>No. Transaksi: {{ $transaksi->no_transaksi }}</p>
    </div>
    <table class="invoice-table">
        <thead>
            <tr>
                <th>No. Pesanan</th>
                <th>Nama Pemesan</th>
                <th>Produk</th>
                <th>Harga DP</th>
                <th>Tanggal DP</th>
                <th>Total Harga Keseluruhan</th>
                <th>Status Transaksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $transaksi->pesanan->no_pesanan }}</td>
                <td>{{ $transaksi->pesanan->nama_pemesan }}</td>
                <td>{{ $transaksi->pesanan->product->nama_produk }}</td>
                <td>Rp. {{ number_format($transaksi->harga_dp, 0, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_dp)->format('d-m-Y H:i') }}</td>
                <td>Rp.{{ number_format($transaksi->pesanan->harga_pesanan, 0, ',', '.') }}</td>
                <td>{{ $transaksi->status_transaksi }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
