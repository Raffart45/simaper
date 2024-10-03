<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Transaksi::query();

        if ($request->filled('status_transaksi')) {
            $query->where('status_transaksi', $request->status_transaksi);
        }

        if ($request->filled('tanggal_dp')) {
            $date = \Carbon\Carbon::parse($request->tanggal_dp);
            $query->whereMonth('tanggal_dp', $date->month)
                ->whereYear('tanggal_dp', $date->year);
        }

        if ($request->filled('nama_produk')) {
            $query->whereHas('pesanan.product', function($q) use ($request) {
                $q->where('nama_produk', 'like', '%' . $request->nama_produk . '%');
            });
        }

        $transaksis = $query->get();

        return view('admin.transaksi.index', compact('transaksis'));
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
        $transaksi = Transaksi::with('pesanan.user', 'pesanan.product')->findOrFail($id);
        return view('admin.transaksi.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('admin.transaksi.edit', compact('transaksi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Validate request
    $request->validate([
        'cicilan_satu' => 'nullable|numeric',
        'foto_cicilan_satu' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'tanggal_cicilan_satu' => 'nullable|date',
        'cicilan_dua' => 'nullable|numeric',
        'foto_cicilan_dua' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'tanggal_cicilan_dua' => 'nullable|date',
        'lunas' => 'nullable|numeric',
        'foto_lunas' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'tanggal_lunas' => 'nullable|date',
        'status_transaksi' => 'required|string'
    ]);

    $transaksi = Transaksi::findOrFail($id);

    // Process the request data
    $data = $request->only([
        'cicilan_satu', 'tanggal_cicilan_satu', 
        'cicilan_dua', 'tanggal_cicilan_dua', 
        'lunas', 'tanggal_lunas', 
        'status_transaksi'
    ]);

    // Handle file uploads
    $files = [
        'foto_cicilan_satu' => 'foto_cicilan_satu',
        'foto_cicilan_dua' => 'foto_cicilan_dua',
        'foto_lunas' => 'foto_lunas'
    ];

    foreach ($files as $fileKey => $columnName) {
        if ($request->hasFile($fileKey)) {
            $file = $request->file($fileKey);
            $fileName = time() . '.' . $file->extension();
            $file->move(public_path('uploads/foto_transaksi'), $fileName);
            $data[$columnName] = $fileName; // Update the data array with the new file name
        } else {
            // Keep the existing file name if no new file is uploaded
            $data[$columnName] = $transaksi->$columnName;
        }
    }

    // Calculate total bayar
    $totalBayar = $transaksi->total_bayar;
    if ($request->filled('cicilan_satu')) {
        $totalBayar -= $request->input('cicilan_satu');
    }
    if ($request->filled('cicilan_dua')) {
        $totalBayar -= $request->input('cicilan_dua');
    }
    if ($request->filled('lunas')) {
        $totalBayar -= $request->input('lunas');
    }

    // Add the calculated total bayar to the data array
    $data['total_bayar'] = $totalBayar;

    // Update the transaction based on the status
    switch ($request->status_transaksi) {
        case 'Cicilan Satu':
            $data['status_transaksi'] = 'Cicilan Satu';
            break;
        case 'Cicilan Dua':
            $data['status_transaksi'] = 'Cicilan Dua';
            break;
        case 'Lunas':
            $data['status_transaksi'] = 'Lunas';
            break;
        default:
            $data['status_transaksi'] = 'Pending';
            break;
    }

    // Update the record
    $transaksi->update($data);

    return redirect()->route('bayar.index')->with('success', 'Transaksi updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $transaksi->delete();
    
        return redirect()->route('bayar.index')->with('success', 'Transaksi deleted successfully.');
    }

    public function printTransaksi(Request $request)
    {
        $query = Transaksi::with('pesanan.product');
        
        // Apply filters based on request parameters
        if ($request->filled('status_transaksi')) {
            $query->where('status_transaksi', $request->status_transaksi);
        }
        
        if ($request->filled('tanggal_dp')) {
            $query->whereMonth('tanggal_dp', \Carbon\Carbon::parse($request->tanggal_dp)->month)
                  ->whereYear('tanggal_dp', \Carbon\Carbon::parse($request->tanggal_dp)->year);
        }
    
        if ($request->filled('nama_produk')) {
            $query->whereHas('pesanan.product', function($q) use ($request) {
                $q->where('nama_produk', 'like', '%' . $request->nama_produk . '%');
            });
        }
    
        $transaksis = $query->get();
    
        $pdf = PDF::loadView('admin.transaksi.cetak_transaksi', compact('transaksis'))
                  ->setPaper('a4', 'landscape'); // Set paper size and orientation
                  
        return $pdf->download('transaksi.pdf'); // Download the PDF
    }

    public function rekapBulananTransaksi(Request $request)
    {
        $bulanInput = $request->input('bulan', Carbon::now()->format('m')); // Default bulan saat ini
        $tahun = $request->input('tahun', Carbon::now()->format('Y')); // Default tahun saat ini
        $bulan = substr($bulanInput, 5, 2);
        
        // Ambil data pesanan dan penjualan bulanan
        $transaksis = Transaksi::whereYear('tanggal_dp', $tahun)
                        ->whereMonth('tanggal_dp', $bulan)
                        ->get();

        return view('admin.laporan.rekap_bulanan_transaksi', compact('transaksis', 'bulan', 'tahun'));
    }

    // Menghasilkan PDF laporan bulanan
    public function printRekapTransaksi(Request $request)
    {
        $bulan = $request->input('bulan', Carbon::now()->format('Y-m'));
        $tahun = $request->input('tahun', Carbon::now()->format('Y'));

        $transaksis = Transaksi::whereYear('tanggal_dp', $tahun)
                        ->whereMonth('tanggal_dp', $bulan)
                        ->get();

        $pdf = Pdf::loadView('admin.laporan.cetak_rekap_transaksi', compact('transaksis', 'bulan', 'tahun'))
                  ->setPaper('a4', 'landscape'); // Mengatur orientasi ke landscape
        return $pdf->download('rekap_bulanan_transaksi.pdf');
    }
    
}
