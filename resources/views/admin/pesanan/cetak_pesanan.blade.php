<!DOCTYPE html>
<html>
<head>
    <title>Data Pesanan Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
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
        .text-center {
            text-align: center;
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
    <h1 class="text-center">Data Pesanan PT Sata Harum</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No. Pesanan</th>
                <th>Nama Pemesan</th>
                <th>No. Telepon</th>
                <th>Alamat</th>
                <th>Produk</th>
                <th>Jumlah Pesanan</th>
                <th>Status Pesanan</th>
                <th>Tanggal Pesanan</th>
                <th>Harga Pesanan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pesanans as $pesanan)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pesanan->no_pesanan }}</td>
                <td>{{ $pesanan->nama_pemesan }}</td>
                <td>{{ $pesanan->no_telp }}</td>
                <td>{{ $pesanan->alamat }}</td>
                <td>{{ $pesanan->product ? $pesanan->product->nama_produk : 'N/A' }}</td>
                <td>{{ $pesanan->jumlah_pesanan }} box</td>
                <td>{{ ucfirst($pesanan->status_pesanan) }}</td>
                <td>{{ \Carbon\Carbon::parse($pesanan->tanggal_pesananan)->format('d-m-Y H:i') }}</td>
                <td>Rp. {{ number_format($pesanan->harga_pesanan) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
