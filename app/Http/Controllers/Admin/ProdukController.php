<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Inventory;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
class ProdukController extends Controller
{
    // Display a listing of the products.
    public function index(Request $request)
    {
        $query = Produk::query();

        if ($request->filled('grade')) {
            $query->where('category', $request->grade);
        }

        $products = $query->get();

        return view('admin.produk.index', compact('products'));
    }

    // Show the form for creating a new product.
    public function create()
    {
        return view('admin.produk.create');
    }



    // Store a newly created product in storage.
    public function store(Request $request)
{
    
    // Validate input data
    $validatedData = $request->validate([
        'nama_produk' => 'required|string|max:255',
        'stok' => 'required|integer',
        'category' => 'required|string|max:255',
        'foto_produk' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        'deskripsi' => 'required',
        'harga' => 'required|numeric',
        'thumbnails.*' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg',
    ]);

    // Handle foto_produk upload
    if ($request->hasFile('foto_produk')) {
        $foto_produk_path = $request->file('foto_produk')->store('foto_produk', 'public');
    } else {
        $foto_produk_path = null;
    }

    // Handle thumbnails upload
    $thumbnails = [];
    if ($request->hasFile('thumbnails')) {
        foreach ($request->file('thumbnails') as $file) {
            $path = $file->store('thumbnails', 'public');
            $thumbnails[] = $path;
        }
    }

    // Calculate additional data
    $stok = $request->input('stok');
    $berat = ($stok / 20) * 10;
    $box = ceil($stok / 20);

    // Prepare data for storage
    $data = $validatedData;
    $data['foto_produk'] = $foto_produk_path;
    $data['thumbnails'] = json_encode($thumbnails); // Convert to JSON to store in a single column
    $data['berat'] = $berat;
    $data['box'] = $box;

    // Create the product
    $product = Produk::create($data);

    // Record inventory
    Inventory::create([
        'product_id' => $product->id,
        'jumlah' => $stok,
        'tipe' => 'masuk',
        'tanggal' => now(),
    ]);

    return redirect()->route('produk.index')->with('success', 'Data produk berhasil dibuat');
}


    // Display the specified product (optional).
    public function show(Produk $product)
    {
        // Optionally implement this method if needed
    }

    // Show the form for editing the specified product.
    public function edit($id)
    {
        $product = Produk::findOrFail($id);
        return view('admin.produk.edit', compact('product'));
    }

    // Update the specified product in storage.
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'stok' => 'required|integer',
            'category' => 'required|string|max:255',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            'thumbnails.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $product = Produk::findOrFail($id);
    
        if ($request->hasFile('foto_produk')) {
            if ($product->foto_produk) {
                Storage::disk('public')->delete($product->foto_produk);
            }
            $foto_produk_path = $request->file('foto_produk')->store('foto_produk', 'public');
            $validatedData['foto_produk'] = $foto_produk_path;
        }
    
        if ($request->hasFile('thumbnails')) {
            if ($product->thumbnails) {
                foreach ($product->thumbnails as $oldThumbnail) {
                    Storage::disk('public')->delete($oldThumbnail);
                }
            }
    
            $thumbnails = [];
            foreach ($request->file('thumbnails') as $file) {
                $path = $file->store('thumbnails', 'public');
                $thumbnails[] = $path;
            }
            $validatedData['thumbnails'] = $thumbnails;
        }
    
        $stok = $request->input('stok');
        $berat = ($stok / 20) * 10;
        $box = ceil($stok / 20);
    
        $validatedData['berat'] = $berat;
        $validatedData['box'] = $box;
    
        $product->update($validatedData);
    
        // Catat perubahan inventori
        $oldInventories = Inventory::where('product_id', $product->id)->get();
        $newStock = $stok;
    
        foreach ($oldInventories as $inventory) {
            if ($inventory->tipe === 'masuk') {
                $newStock -= $inventory->jumlah;
            } elseif ($inventory->tipe === 'keluar') {
                $newStock += $inventory->jumlah;
            }
        }
    
        if ($newStock > 0) {
            Inventory::create([
                'product_id' => $product->id,
                'jumlah' => $newStock,
                'tipe' => 'masuk',
                'tanggal' => now(),
            ]);
        } elseif ($newStock < 0) {
            Inventory::create([
                'product_id' => $product->id,
                'jumlah' => abs($newStock),
                'tipe' => 'keluar',
                'tanggal' => now(),
            ]);
        }
    
        return redirect()->route('produk.index')->with('success', 'Data produk berhasil diupdate');
    }
    
    
    
    // Remove the specified product from storage.
    public function destroy($id)
    {
        // Find the product by ID
        $product = Produk::findOrFail($id);
    
        // Delete the main product image if it exists
        if ($product->foto_produk) {
            $foto_produk_path = $product->foto_produk;
            if (Storage::disk('public')->exists($foto_produk_path)) {
                Storage::disk('public')->delete($foto_produk_path);
            }
        }
    
        // Delete the thumbnails if they exist
        if ($product->thumbnails) {
            foreach ($product->thumbnails as $thumbnail) {
                if (Storage::disk('public')->exists($thumbnail)) {
                    Storage::disk('public')->delete($thumbnail);
                }
            }
        }
    
        // Delete related inventory records
        Inventory::where('product_id', $id)->delete();
    
        // Delete the product
        $product->delete();
    
        // Redirect with a success message
        return redirect()->route('produk.index')->with('success', 'Data produk beserta inventaris berhasil dihapus');
    }

    public function cetakData(Request $request)
    {
        $query = Produk::query();

        if ($request->filled('grade')) {
            $query->where('category', $request->grade);
        }

        $products = $query->get();
        $pdf = PDF::loadView('admin.produk.cetak_produk', compact('products')) ->setPaper('a4', 'landscape');
        return $pdf->download('data_produk.pdf');
    }
    
}
