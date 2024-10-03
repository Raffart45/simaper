<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReturnProduk;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class ReturnProdukController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Fetch return data with related transactions
        $returns = ReturnProduk::whereHas('transaksi', function ($query) use ($userId) {
            $query->whereHas('pesanan', function ($subQuery) use ($userId) {
                $subQuery->where('user_id', $userId);
            });
        })
        ->get();
    
        return view('user.dashboard.return.index', compact('returns'));
    }

    public function form($transactionId)
    {
        $transaction = Transaksi::findOrFail($transactionId);
        return view('user.dashboard.return.form', compact('transaction'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transaksis,id',
            'jumlah' => 'required|integer',
            'tanggal' => 'required|date',
            'alasan' => 'nullable|string',
            'foto_produk' => 'required|image|max:2048'
        ]);

        $fotoPath = $request->file('foto_produk')->store('return_fotos', 'public');

        ReturnProduk::create([
            'transaction_id' => $request->transaction_id,
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
            'alasan' => $request->alasan,
            'foto_produk' => $fotoPath,
            'status' => 'Proses Pengembalian',
        ]);

        return redirect()->route('dashboard.user.transaksi')->with('success', 'Form pengembalian produk berhasil dikirim.');
    }
}
