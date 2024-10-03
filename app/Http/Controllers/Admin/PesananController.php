<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\Inventory;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pesanan::query();

        if ($request->filled('status_pesanan')) {
            $query->where('status_pesanan', $request->status_pesanan);
        }

        if ($request->filled('tanggal_pesananan')) {
            $query->whereMonth('tanggal_pesananan', \Carbon\Carbon::parse($request->tanggal_pesananan)->month)
                  ->whereYear('tanggal_pesananan', \Carbon\Carbon::parse($request->tanggal_pesananan)->year);
        }

        if ($request->filled('nama_produk')) {
            $query->whereHas('product', function($q) use ($request) {
                $q->where('nama_produk', 'like', '%' . $request->nama_produk . '%');
            });
        }

        $pesanans = $query->orderBy('tanggal_pesananan', 'asc')->get();

        return view('admin.pesanan.index', compact('pesanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        return view('admin.pesanan.edit', compact('pesanan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $request->validate([
            'status_pesanan' => 'required|in:Pending,Pesanan ditolak,Pesanan diterima,Pesanan dikirim,Pesanan sampai',
        ]);

        
        $pesanan = Pesanan::find($id);

        if (!$pesanan) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        // Update status
        $pesanan->status_pesanan = $request->input('status_pesanan');
        $pesanan->save();

        // Redirect with success message
        return redirect()->route('pesanan.index')->with('success', 'Data pesanan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pesanan = Pesanan::find($id);
    
        if (!$pesanan) {
            return redirect()->back()->with('error', 'Order not found.');
        }
    
        // Get the related product
        $product = Produk::find($pesanan->product_id);
        if ($product) {
            $totalItems = $pesanan->jumlah_pesanan * 20; // Total items in the boxes
            $totalWeight = $pesanan->jumlah_pesanan * 10; // Total weight in kg
    
            // Revert product stock and weight
            $product->stok += $totalItems;
            $product->berat += $totalWeight;
            $product->box += $pesanan->jumlah_pesanan;
            $product->save();
            
            // Delete related inventory records
            Inventory::where('product_id', $product->id)
                ->where('tipe', 'keluar')
                ->where('tanggal', $pesanan->tanggal_pesananan)
                ->delete();
        }
    
        // Delete the order
        $pesanan->delete();
    
        // Redirect with success message
        return redirect()->route('pesanan.index')->with('success', 'Data pesanan berhasil dihapus');
    }

    public function printPesanan(Request $request)
    {
        $query = Pesanan::query();

        if ($request->filled('status_pesanan')) {
            $query->where('status_pesanan', $request->status_pesanan);
        }

        if ($request->filled('tanggal_pesananan')) {
            $query->whereMonth('tanggal_pesananan', \Carbon\Carbon::parse($request->tanggal_pesananan)->month)
                  ->whereYear('tanggal_pesananan', \Carbon\Carbon::parse($request->tanggal_pesananan)->year);
        }

        if ($request->filled('nama_produk')) {
            $query->whereHas('product', function($q) use ($request) {
                $q->where('nama_produk', 'like', '%' . $request->nama_produk . '%');
            });
        }

        $pesanans = $query->orderBy('tanggal_pesananan', 'asc')->get();

        $pdf = PDF::loadView('admin.pesanan.cetak_pesanan', compact('pesanans'))
                  ->setPaper('a4', 'landscape'); // Mengatur orientasi ke landscape
        return $pdf->download('pesanan.pdf');
    }

    public function rekapBulanan(Request $request)
    {
        $bulanInput = $request->input('bulan', Carbon::now()->format('m')); // Default bulan saat ini
        $tahun = $request->input('tahun', Carbon::now()->format('Y')); // Default tahun saat ini
        $bulan = substr($bulanInput, 5, 2);
        
        // Ambil data pesanan dan penjualan bulanan
        $pesanans = Pesanan::whereYear('tanggal_pesananan', $tahun)
                           ->whereMonth('tanggal_pesananan', $bulan)
                           ->get();
    
        return view('admin.laporan.rekap_bulanan_pesanan', compact('pesanans', 'bulan', 'tahun'));
    }

    // Menghasilkan PDF laporan bulanan
    public function printRekap(Request $request)
    {
        $bulan = $request->input('bulan', Carbon::now()->format('Y-m'));
        $tahun = $request->input('tahun', Carbon::now()->format('Y'));

        $pesanans = Pesanan::whereYear('tanggal_pesananan', $tahun)
                           ->whereMonth('tanggal_pesananan', $bulan)
                           ->get();

        $pdf = Pdf::loadView('admin.laporan.cetak_rekap_pesanan', compact('pesanans', 'bulan', 'tahun'))
                  ->setPaper('a4', 'landscape'); // Mengatur orientasi ke landscape
        return $pdf->download('rekap_bulanan_pesanan.pdf');
    }
    
}
