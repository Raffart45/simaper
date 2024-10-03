<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ongkir;
use Illuminate\Support\Facades\Log;


class OngkirController extends Controller
{
    public function getOngkir(Request $request)
    {
        $kabupaten = $request->query('kabupaten');
        $provinsi = $request->query('provinsi');
    
        // Validasi input
        if (!$kabupaten || !$provinsi) {
            return response()->json([
                'success' => false,
                'message' => 'Kabupaten dan Provinsi harus diisi.'
            ]);
        }
    
        // Ambil ongkir dari database
        $ongkir = Ongkir::where('kabupaten', $kabupaten)
                        ->where('provinsi', $provinsi)
                        ->first();
    
        if ($ongkir) {
            // Pastikan harga ongkir tidak memiliki desimal
            $ongkir->harga_ongkir = number_format($ongkir->harga_ongkir, 0, ',', '.');
            
            return response()->json([
                'success' => true,
                'data' => $ongkir
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Ongkir tidak ditemukan untuk kabupaten dan provinsi ini.'
            ]);
        }
    }

    public function fetch(Request $request)
    {
        $request->validate([
            'kabupaten' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
        ]);

        // Fetch the shipping cost based on kabupaten and provinsi
        $ongkir = Ongkir::where('kabupaten', $request->kabupaten)
                         ->where('provinsi', $request->provinsi)
                         ->first();

        if ($ongkir) {
            return response()->json([
                'success' => true,
                'harga_ongkir' => $ongkir->harga_ongkir,
                'id' => $ongkir->id
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Ongkir not found'], 404);
    }
    
}
