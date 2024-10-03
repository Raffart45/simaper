<!DOCTYPE html>
<html>
<head>
    <title>Data Return Produk</title>
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
    <h1 class="text-center">Data Return Produk PT Sata Harum</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No Transaksi</th>
                <th>Nama Produk</th>
                <th>Nama Pemesan</th>
                <th>Jumlah Pengembalian</th>
                <th>Tanggal</th>
                <th>Alasan Dikembalikan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($returns as $return)
            {{-- @php
            $imageData = base64_encode(file_get_contents(public_path('storage/' . $return->foto_produk)));
            @endphp --}}
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $return->transaksi->no_transaksi }}</td>
                <td>{{ $return->transaksi->pesanan->user->name }}</td>
                <td>{{ $return->transaksi->pesanan->product->nama_produk}}</td>
                <td>{{ $return->jumlah }} box</td>
                <td>{{  \Carbon\Carbon::parse($return->tanggal)->format('d-m-Y') }}</td>
                <td>{{ $return->alasan }}</td>
                <td>{{ $return->status }}</td>
                {{-- <td><img src="data:image/jpeg;base64,{{ $imageData }}" width="100"></td> --}}
            </tr>
          @endforeach
        </tbody>
    </table>
</body>
</html>
