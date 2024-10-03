<!DOCTYPE html>
<html>
<head>
    <title>Data Produk</title>
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
    <h1 class="text-center">Data Produk PT Sata Harum</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Stok / Buah</th>
                <th>Kategori</th>
                <th>Total Berat / Kg</th>
                <th>Total Box</th>
                <th>Deskripsi</th>
                <th>Harga / Kg</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->nama_produk }}</td>
                    <td>{{ $product->stok }}</td>
                    <td>{{ $product->category }}</td>
                    <td>{{ $product->berat }}</td>
                    <td>{{ $product->box }}</td>
                    <td>{{ $product->deskripsi }}</td>
                    <td>Rp. {{ number_format($product->harga, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
