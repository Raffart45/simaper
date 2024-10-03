<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Ongkir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pesanan;
use App\Models\Transaksi;
use App\Models\ReturnProduk;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();

        $totalOrders = Pesanan::where('user_id', $userId)->count();
        $totalTransactions = Transaksi::whereHas('pesanan', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->count();
        $totalReturns = ReturnProduk::whereHas('transaksi', function ($query) use ($userId) {
            $query->whereHas('pesanan', function ($subQuery) use ($userId) {
                $subQuery->where('user_id', $userId);
            });
        })->count();

        return view('user.dashboard.dashboard', compact('totalOrders', 'totalTransactions','totalReturns'));
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

   
  
}
