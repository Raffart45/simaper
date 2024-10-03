<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pesanan;


class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $userId = Auth::id();
        
         $pesanans = Pesanan::where('user_id', $userId)
             ->whereIn('status_pesanan', ['Pesanan diterima', 'Pesanan ditolak', 'Pending','Pesanan dikirim','Pesanan sampai'])
             ->with('transaksi')
             ->get();
         
         return view('user.dashboard.pesanan.index', compact('pesanans'));
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
