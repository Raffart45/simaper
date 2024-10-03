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
    <h1>Laporan Rekap Bulanan Pesanan Bulan ke - {{ $bulan }} Tahun - {{ $tahun }}</h1>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No. Pesanan</th>
                <th>Nama Pemesan</th>
                <th>Alamat</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total Harga</th>
                <th>Status Pesanan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesanans as $pesanan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pesanan->no_pesanan }}</td>
                    <td>{{ $pesanan->nama_pemesan }}</td>
                    <td>{{ $pesanan->alamat }}</td>
                    <td>{{ $pesanan->product->nama_produk }}</td>
                    <td>{{ $pesanan->jumlah_pesanan }}</td>
                    <td>Rp. {{ number_format($pesanan->product->harga, 0, ',', '.') }}</td>
                    <td>Rp. {{ number_format($pesanan->harga_pesanan, 0, ',', '.') }}</td>
                    <td>{{ $pesanan->status_pesanan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
