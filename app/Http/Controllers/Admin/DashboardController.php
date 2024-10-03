<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Ongkir;
use App\Models\ReturnProduk;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpParser\Node\Stmt\Return_;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Get total products count
    $totalProducts = DB::table('products')->count();
    
    // Get total inventory count
    $totalInventory = DB::table('inventoris')->count();
    
    // Get total orders count
    $totalOrders = DB::table('pesanans')->count();

    // Get total transactions count
    $totalTransactions = DB::table('transaksis')->count();

    // Get selected year from request, default to current year
    $selectedYear = $request->input('tahun', Carbon::now()->year);
    
    // Orders data for the selected year
    $ordersData = DB::table('pesanans')
        ->select(DB::raw('COUNT(*) as count'), DB::raw('MONTHNAME(tanggal_pesananan) as month'), DB::raw('MONTH(tanggal_pesananan) as month_num'))
        ->whereYear('tanggal_pesananan', $selectedYear)
        ->groupBy(DB::raw('MONTHNAME(tanggal_pesananan)'), DB::raw('MONTH(tanggal_pesananan)'))
        ->orderBy('month_num')
        ->get();

    $chartLabels = $ordersData->pluck('month')->map(function ($month) use ($selectedYear) {
        return $month . ' ' . $selectedYear;
    });
    $chartValues = $ordersData->pluck('count');

    // Transactions data for pie chart
    $transactionsData = DB::table('transaksis')
        ->select(DB::raw('COUNT(*) as count'), 'status_transaksi')
        ->groupBy('status_transaksi')
        ->get();

    $pieLabels = $transactionsData->pluck('status_transaksi');
    $pieValues = $transactionsData->pluck('count');

    // Define colors based on status
    $colorMap = [
        'Lunas' => 'rgba(40, 167, 69, 0.2)', // success
        'DP' => 'rgba(255, 193, 7, 0.2)'    // warning
    ];

    $pieColors = $transactionsData->map(function ($transaction) use ($colorMap) {
        return $colorMap[$transaction->status_transaksi] ?? 'rgba(0, 0, 0, 0.2)'; // default color
    });

    return view('admin.dashboard', compact('totalProducts', 'totalInventory', 'totalOrders', 'totalTransactions', 'chartLabels', 'chartValues', 'pieLabels', 'pieValues', 'pieColors', 'selectedYear'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showOngkir()
    {
        $ongkirs = Ongkir::all();
        return view('admin.ongkir.index', compact('ongkirs'));
    }

    public function showReturnProduk(Request $request)
    {
        
        $query = ReturnProduk::with('transaksi');

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal', $request->tahun);
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        

        $returns = $query->orderBy('created_at', 'desc')->get();

        $years = ReturnProduk::select(DB::raw('YEAR(tanggal) as year'))
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        $months = [
            ['value' => 1, 'name' => 'Januari'],
            ['value' => 2, 'name' => 'Februari'],
            ['value' => 3, 'name' => 'Maret'],
            ['value' => 4, 'name' => 'April'],
            ['value' => 5, 'name' => 'Mei'],
            ['value' => 6, 'name' => 'Juni'],
            ['value' => 7, 'name' => 'Juli'],
            ['value' => 8, 'name' => 'Agustus'],
            ['value' => 9, 'name' => 'September'],
            ['value' => 10, 'name' => 'Oktober'],
            ['value' => 11, 'name' => 'November'],
            ['value' => 12, 'name' => 'Desember']
        ];
        return view('admin.return.index', compact('returns', 'years', 'months'));
    }

    
    public function printReturnProduk(Request $request)
    {
        $query = ReturnProduk::with('transaksi');

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal', $request->tahun);
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        $returns = $query->orderBy('created_at', 'desc')->get();

        $pdf = PDF::loadView('admin.return.cetak_return', compact('returns'))->setPaper('a4', 'landscape');
        return $pdf->download('data_return_produk.pdf');
    }

            public function editStatus($id)
        {
            // Find the return record
            $return = ReturnProduk::findOrFail($id);

            // Pass the return record to the view
            return view('admin.return.edit', compact('return'));
        }

        public function updateStatus(Request $request, $id)
        {
            // Validate the request
            $request->validate([
                'status' => 'required|string',
            ]);

            // Find the return record
            $return = ReturnProduk::findOrFail($id);

            // Update the status
            $return->status = $request->status;
            $return->save();

            // Redirect with success message
            return redirect()->route('admin.return.data')->with('success', 'Status pengembalian produk berhasil diperbarui.');
        }
}
