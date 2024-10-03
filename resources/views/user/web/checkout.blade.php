@extends('user.web.layouts.base')

@section('content')
<!-- Single Page Header start -->
<div class="container-fluid page-header py-5">
    <h1 class="text-center text-white display-6">Checkout</h1>
    <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ route('user') }}">Home</a></li>
        <li class="breadcrumb-item active text-white">Checkout</li>
    </ol>
</div>
<!-- Single Page Header End -->

<!-- Checkout Page Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <h1 class="mb-4">Billing details</h1>
       <!-- Form HTML -->
<form method="POST" action="{{ route('user.order') }}" id="orderForm">
    @csrf
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <input type="hidden" name="product_id" value="{{ $produk->id }}">
    <input type="hidden" name="harga_produk" value="{{ $produk->harga }}">
    <input type="hidden" name="ongkir_id" id="ongkirId">
    
    <div class="row g-5">
        <div class="col-md-12 col-lg-6 col-xl-7">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-item">
                        <label class="form-label my-3">Nama Pemesan<sup>*</sup></label>
                        <input type="text" class="form-control" name="nama_pemesan" required value="{{ Auth::user()->name }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-item">
                        <label class="form-label my-3">No. Telepon<sup>*</sup></label>
                        <input type="tel" class="form-control" name="no_telp" required value="{{ Auth::user()->phone_number }}">
                    </div>
                </div>
            </div>
            <div class="form-item">
                <label class="form-label my-3">Alamat<sup>*</sup></label>
                <textarea name="alamat" id="" cols="30" rows="10" class="form-control" required></textarea>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-item">
                        <label class="form-label my-3">Kabupaten/Kota<sup>*</sup></label>
                        <select id="kabupaten" class="form-control" name="kabupaten" required>
                            <option value="">Pilih Kabupaten</option>
                            @foreach($ongkirs->unique('kabupaten') as $ongkir)
                                <option value="{{ $ongkir->kabupaten }}">{{ $ongkir->kabupaten }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-item">
                        <label class="form-label my-3">Provinsi<sup class="text-danger">*</sup></label>
                        <select id="provinsi" class="form-control" name="provinsi" required>
                            <option value="">Pilih Provinsi</option>
                            @foreach($ongkirs->unique('provinsi') as $ongkir)
                                <option value="{{ $ongkir->provinsi }}">{{ $ongkir->provinsi }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-item">
                        <label class="form-label my-3">Jumlah Box<sup class="text-danger ms-2">*<span>minimal pemesanan adalah 40 box</span></sup></label>
                        <input type="number" class="form-control" name="jumlah_box" id="jumlahBox" required min="40">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-item">
                        <label class="form-label my-3">Tanggal Pesanan<sup class="text-danger">*</sup></label>
                        <input type="date" class="form-control" name="tanggal_pesananan" required>
                    </div>
                </div>
            </div>
            <div class="border border-2 border-danger p-3 mt-5 mb-5">
                <h3 class="text-center">Detail Harga</h3>
                <div class="row mb-5">
                    <div class="col-md-4">
                        <div class="form-item">
                            <label class="form-label my-3">Harga Ongkir</label>
                            <input type="text" id="ongkir" class="form-control" name="ongkir" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-item">
                            <label class="form-label my-3">Total Pesanan</label>
                            <input type="text" class="form-control" name="total_pesanan" id="totalPesanan" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-item">
                            <label class="form-label my-3">Total Price</label>
                            <input type="text" class="form-control" name="total_price" id="totalPrice" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-6 col-xl-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Harga/kg</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($produk)
                        <tr>
                            <th scope="row">
                                <div class="d-flex align-items-center mt-2">
                                    <img src="{{ Storage::url($produk->foto_produk) }}" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                </div>
                            </th>
                            <td class="py-5">{{ $produk->nama_produk }}</td>
                            <td class="py-5">Rp. {{ number_format($produk->harga, 0, ',', '.') }}</td>
                            <td class="py-5">{{ $produk->stok }} buah</td>
                            <td class="py-5">Rp. <span id="productTotal">{{ number_format($produk->harga, 0, ',', '.') }}</span></td>
                        </tr>
                        <tr>
                            <th scope="row"></th>
                            <td class="py-5">
                                <p class="mb-0 text-dark text-uppercase py-3">TOTAL</p>
                            </td>
                            <td class="py-5"></td>
                            <td class="py-5"></td>
                            <td class="py-5">
                                <div class="py-3 border-bottom border-top">
                                    <p class="mb-0 text-dark">Rp. <span id="totalPriceOne">{{ number_format($produk->harga, 0, ',', '.') }}</span></p>
                                </div>
                            </td>
                        </tr>
                        @else
                        <tr>
                            <td colspan="5">No product selected for checkout.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="border border-2 border-warning p-2">
                <h5 class="mt-2 mb-3">Detail Jasa Ongkir Perusahaan</h5>
                <div class="d-flex gap-3">
                    <img src="{{ url('web/img/fotomoil.PNG') }}" alt="">
                    <div>
                        <p class="text-dark"><strong>Standar Termasuk : </strong>Driver, bensin, asuransi jiwa, asuransi kargo</p>
                        <p class="text-dark"><strong>Biaya :</strong>Pengemudi harus mendapat persetujuan di muka untuk penggantian biaya tol, parkir, atau feri.</p>
                    </div>
                </div>
            </div>
            <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                <button type="submit" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place Order</button>
            </div>
        </div>
    </div>
</form>
    </div>
</div>
<!-- Checkout Page End -->

<script>
document.getElementById('kabupaten').addEventListener('change', fetchOngkir);
document.getElementById('provinsi').addEventListener('change', fetchOngkir);
document.getElementById('jumlahBox').addEventListener('input', calculateTotal);

// Function to format a number as currency
function formatCurrency(amount) {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(amount);
}

// Function to parse a formatted currency string to a number
function parseCurrency(formattedValue) {
    // Remove currency symbol, non-breaking spaces, thousands separators
    return parseFloat(formattedValue
        .replace(/[^0-9,-]/g, '') // Remove everything except digits, commas, and hyphens
        .replace(/,/g, '.') // Replace commas with dots for decimal points
    );
}

function fetchOngkir() {
    const kabupaten = document.getElementById('kabupaten').value;
    const provinsi = document.getElementById('provinsi').value;

    if (kabupaten && provinsi) {
        fetch(`/ongkir?kabupaten=${kabupaten}&provinsi=${provinsi}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const formattedOngkir = data.data.harga_ongkir;
                    const hargaOngkir = parseCurrency(formattedOngkir);
                    document.getElementById('ongkir').value = formatCurrency(hargaOngkir);
                    document.getElementById('ongkirId').value = data.data.id; // Ensure ongkir_id is set
                    calculateTotal(); // Recalculate total when shipping cost is updated
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    }
}

function calculateTotal() {
    const jumlahBox = parseInt(document.getElementById('jumlahBox').value) || 0;
    const hargaProduk = parseFloat(document.querySelector('input[name="harga_produk"]').value);
    const ongkirFormatted = document.getElementById('ongkir').value;

    // Parse formatted ongkir
    const ongkir = parseCurrency(ongkirFormatted);

    if (jumlahBox < 40) {
        alert('Jumlah box harus minimal 40.');
        document.getElementById('jumlahBox').value = 40;
        return;
    }

    // Calculate total order price
    const totalPesanan = jumlahBox * hargaProduk;
    const totalPrice = totalPesanan + ongkir;

    document.getElementById('totalPesanan').value = formatCurrency(totalPesanan);
    document.getElementById('totalPrice').value = formatCurrency(totalPrice);
    document.getElementById('totalPriceOne').innerText = formatCurrency(totalPrice);

}


</script>
@endsection