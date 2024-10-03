<?php

namespace App\Http\Controllers\User\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Transaksi;

class PembayaranController extends Controller
{
    public function bayarDP($id)
    {
        $pesanan = Pesanan::with('product')->findOrFail($id);
        $jumlahBox = $pesanan->jumlah_box; // Adjust based on your actual column name
        $hargaPerBox = $pesanan->product->harga; // Assuming `harga` is the price per box

        return view('user.web.pembayaran_dp', compact('pesanan', 'jumlahBox', 'hargaPerBox'));
    }

    public function store(Request $request, $id)
        {
            // Validate the request
            $request->validate([
                'harga_dp' => 'required|numeric|min:1',
                'foto_dp' => 'required|image|mimes:jpeg,png,jpg,gif',
            ]);

            // Find the pesanan (order)
            $pesanan = Pesanan::findOrFail($id);

            // Calculate the DP and total payment amounts
            $totalHargaDp = $pesanan->harga_pesanan;

            if ($request->harga_dp > $totalHargaDp) {
                return back()->withErrors(['harga_dp' => 'Nominal DP tidak boleh lebih dari harga DP yang harus dibayarkan.']);
            } elseif ($request->harga_dp < ($totalHargaDp * 0.5)) {
                return back()->withErrors(['harga_dp' => 'Nominal DP tidak boleh kurang dari setengah harga DP yang harus dibayarkan.']);
            }

            // Save the uploaded image
            $foto_dp_path = $request->file('foto_dp')->store('foto_dp', 'public');

            // Create a new transaksi (transaction)
            $transaksi = new Transaksi();
            $transaksi->pesanan_id = $pesanan->id;
            $transaksi->no_transaksi = 'TRX-' . strtoupper(uniqid());
            $transaksi->harga_dp = $request->harga_dp;
            $transaksi->foto_dp = $foto_dp_path; // Store the file path
            $transaksi->tanggal_dp = now();
            $transaksi->status_transaksi = 'DP';
            $transaksi->total_bayar = $totalHargaDp - $request->harga_dp;
            $transaksi->save();

            // Update the pesanan (order) status
            $pesanan->status_pesanan = 'Pesanan dikirim';
            $pesanan->save();

            // Redirect with success message
            return redirect()->route('user.success.payment')->with('success', 'DP berhasil dibayar. Total yang harus dibayar setelah DP adalah Rp. ' . number_format($totalHargaDp - $request->harga_dp, 0, ',', '.'));
        }

        public function bayarLunas($id)
        {
            $transaksi = Transaksi::with('pesanan')->findOrFail($id);
    
            return view('user.web.pembayaran_lunas', compact('transaksi'));
        }

        public function storeLunas(Request $request, $id)
        {
            // Validate the request
            $request->validate([
                'lunas' => 'required|numeric',
                'foto_lunas' => 'required|image|mimes:jpeg,png,jpg,gif',
            ]);
        
            // Store the uploaded image
            $fotoLunasPath = $request->file('foto_lunas')->store('foto_lunas', 'public');
        
            // Find the transaksi (transaction)
            $transaksi = Transaksi::find($id);
            if (!$transaksi) {
                return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
            }
        
            // Update the transaksi (transaction) status
            $transaksi->total_bayar -= $request->lunas;
            $transaksi->lunas = $request->lunas;
            $transaksi->foto_lunas = $fotoLunasPath;
            $transaksi->tanggal_lunas = now();
            $transaksi->status_transaksi = 'Lunas';
            $transaksi->save();
        
            // Update the status pesanan (order) to 'Pesanan Sampai'
            $pesanan = $transaksi->pesanan;
            if ($pesanan) {
                $pesanan->status_pesanan = 'Pesanan Sampai';
                $pesanan->save();
            } else {
                return redirect()->back()->with('error', 'Pesanan tidak ditemukan.');
            }
        
            // Redirect with success message
            return redirect()->route('user.success.payment')->with('success', 'Pembayaran pelunasan berhasil dilakukan.');
        }
        
        
    
}
