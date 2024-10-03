<!DOCTYPE html>
<html>
<head>
    <title>Data Inventory</title>
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
    <h1 class="text-center">Data Inventory PT Sata Harum</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Stok / Buah</th>
                <th>Tipe</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inventories as $inventory)
                <tr  class="{{ $inventory->tipe === 'masuk' ? 'text-success' : ($inventory->tipe === 'keluar' ? 'text-danger' : '') }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $inventory->product->nama_produk }}</td>
                    <td>{{ $inventory->jumlah }}</td>
                    <td>{{ ucfirst($inventory->tipe) }}</td>
                    <td>{{ \Carbon\Carbon::parse($inventory->tanggal)->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
