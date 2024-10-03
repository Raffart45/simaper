<!-- resources/views/admin/laporan/cetak_rekap.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Rekap Bulanan</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
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
        .bg-warning {
            background-color: #ffc107;
        }
        .bg-success {
            background-color: #28a745;
        }
        .bg-danger {
            background-color: #dc3545;
        }
        .text-dark {
            color: #343a40;
        }
        .text-white {
            color: #fff;
        }
        .bg-info {
            background-color: #17a2b8;
        }
        .p-3{
            padding: 10px;
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
    <h1>Laporan Rekap Bulanan Transaksi Bulan ke - {{ $bulan }} Tahun - {{ $tahun }}</h1>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No. Transaksi</th>
                <th>No. Pesanan</th>
                <th>Nama Pemesan</th>
                <th>Produk</th>
                <th>Harga DP</th>
                <th>Tanggal DP</th>
                <th>Total Harga</th>
                <th>Total yang Belum Dibayarkan</th>
                <th>Status Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $transaksi)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $transaksi->no_transaksi }}</td>
                <td>{{ $transaksi->pesanan->no_pesanan }}</td>
                <td>{{ $transaksi->pesanan->user->name }}</td>
                <td>{{ $transaksi->pesanan->product->nama_produk }}</td>
                <td>Rp. {{ number_format($transaksi->harga_dp, 0, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_dp)->format('d-m-Y H:i') }}</td>
                <td>Rp. {{ number_format($transaksi->pesanan->harga_pesanan, 0, ',', '.') }}</td>
                <td>Rp. {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</td>
                <td>{{ $transaksi->status_transaksi }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
