<?php

namespace App\Http\Controllers\User\Web;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class ViewController extends Controller
{
    public function index()
    {
            // Query untuk mendapatkan produk berdasarkan kategori
            $products = Produk::all()->groupBy('category');

            return view('user.web.index', compact('products'));
    }

    public function detail($id)
    {
        $produk = Produk::findOrFail($id);
        $relatedProducts = Produk::where('category', $produk->category)
            ->where('id', '!=', $produk->id)
            ->take(8)
            ->get();
    
        // Menyimpan produk yang dipilih ke dalam session
        session()->put('checkout_product', $produk);
    
        return view('user.web.detail', compact('produk', 'relatedProducts'));
    }
    
    public function checkout()
    {
        // Mengambil produk dari session
        $produk = session()->get('checkout_product');
        $ongkirs = DB::table('ongkirs')->get(['kabupaten', 'provinsi']);

        // Jika tidak ada produk di session, redirect kembali ke halaman produk detail atau home
        if (!$produk) {
            return redirect()->route('user')->with('error', 'No product selected for checkout.');
        }

         // Mengambil data user yang sedang login
        $user = Auth::user();
    
        return view('user.web.checkout', compact('produk','ongkirs'));
    }

    public function submitOrder(Request $request)
    {
        // Validate request
        $request->validate([
            'nama_pemesan' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'kabupaten' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'jumlah_box' => 'required|integer|min:40',
            'tanggal_pesananan' => 'required|date',
            'ongkir_id' => 'required|exists:ongkirs,id',
            'product_id' => 'required|exists:products,id',
            'total_pesanan' => 'required|string'
        ]);
    
        // Retrieve the product
        $product = Produk::find($request->product_id);
        if (!$product) {
            return back()->withErrors(['product_id' => 'Produk tidak ditemukan.'])->withInput();
        }
    
        // Check if the product has enough boxes in stock
        if ($product->box < $request->jumlah_box) {
            // If not enough stock, throw an error
            return back()->withErrors(['jumlah_box' => 'Jumlah box yang dipesan melebihi stok yang tersedia.'])->withInput();
        }
    
        // Get user ID
        $userId = Auth::id();
    
        // Generate a unique order number
        $orderNumber = 'ORD-' . strtoupper(uniqid());
    
        // Extract and process the total price
        $totalPrice = $request->input('total_price');
        $hargaPesanan = preg_replace('/[\x{A0}Rp]/u', '', $totalPrice);
        $hargaPesanan = str_replace('.', '', $hargaPesanan);
        $hargaPesanan = str_replace(',', '.', $hargaPesanan);
        $hargaPesanan = (float) $hargaPesanan;
    
        // Use a transaction to ensure data consistency
        DB::transaction(function () use ($request, $userId, $orderNumber, $hargaPesanan, $product) {
            // Create new order
            $pesanan = new Pesanan();
            $pesanan->user_id = $userId;
            $pesanan->product_id = $request->input('product_id');
            $pesanan->ongkir_id = $request->input('ongkir_id');
            $pesanan->no_pesanan = $orderNumber;
            $pesanan->nama_pemesan = $request->nama_pemesan;
            $pesanan->no_telp = $request->no_telp;
            $pesanan->alamat = $request->alamat;
            $pesanan->kabupaten = $request->kabupaten;
            $pesanan->provinsi = $request->provinsi;
            $pesanan->tanggal_pesananan = $request->tanggal_pesananan;
            $pesanan->jumlah_pesanan = $request->jumlah_box;
            $pesanan->harga_pesanan = $hargaPesanan;
            $pesanan->status_pesanan = 'Pending'; // Default status
            $pesanan->save();
    
            // Update product stock
            $totalItems = $request->jumlah_box * 20; // Total items in the boxes
            $totalWeight = $request->jumlah_box * 10; // Total weight in kg
            $product->stok -= $totalItems;
            $product->berat -= $totalWeight;
            $product->box -= $request->jumlah_box;
            $product->save();
    
            // Insert inventory record for the outgoing stock
            Inventory::create([
                'product_id' => $product->id,
                'jumlah' => $totalItems,
                'tipe' => 'keluar',
                'tanggal' => $request->tanggal_pesananan,
            ]);
        });
    
        // Redirect to a confirmation page or back to the product page
        return redirect()->route('success')->with('success', 'Pesanan Anda berhasil diproses');
    }
    

    
    public function orderSuccess()
    {
        return view('user.web.success');
    }

    public function paymentSuccess()
    {
        return view('user.web.success_payment');
    }


    public function contact()
    {
        return view('user.web.contact');
    }
}
