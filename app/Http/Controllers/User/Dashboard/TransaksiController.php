<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\ReturnProduk;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();

        // Fetch transactions related to the user's orders
        $transaksis = Transaksi::whereHas('pesanan', function($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();

        return view('user.dashboard.transaksi.index', compact('transaksis'));
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

    public function generateInvoice($id)
    {
        $transaksi = Transaksi::with('pesanan.product')->findOrFail($id);

        $pdf = Pdf::loadView('user.dashboard.transaksi.cetak_invoice', compact('transaksi'))->setPaper('a4', 'landscape'); ;
        return $pdf->download('invoice-'.$transaksi->no_transaksi.'.pdf');
    }


}
