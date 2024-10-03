<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Produk;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Inventory::with('product');

        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal', $request->tahun);
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        $inventories = $query->orderBy('created_at', 'desc')->get();

        $years = Inventory::select(DB::raw('YEAR(tanggal) as year'))
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

        return view('admin.inventory.index', compact('inventories', 'years', 'months'));
    }

    public function destroy(string $id)
    {
        $inventory = Inventory::find($id);

        if (!$inventory) {
            return redirect()->back()->with('error', 'Inventory record not found.');
        }

        // Delete the inventory record
        $inventory->delete();

        // Redirect with success message
        return redirect()->route('inventory.index')->with('success', 'Inventory record successfully deleted.');
    }

    public function printInventory(Request $request)
    {
        $query = Inventory::with('product');

        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal', $request->tahun);
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', $request->bulan);
        }

        $inventories = $query->orderBy('created_at', 'desc')->get();

        $pdf = PDF::loadView('admin.inventory.cetak_inventory', compact('inventories'));
        return $pdf->download('inventory.pdf');
    }

    public function create()
    {
        $products = Produk::all();

        return view('admin.inventory.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'jumlah' => 'required|integer|min:0',
            'tipe' => 'required|in:masuk,keluar',
            'tanggal' => 'required|date',
        ]);
    
        // Create a new inventory entry
        $inventory = new Inventory();
        $inventory->product_id = $request->input('product_id');
        $inventory->jumlah = $request->input('jumlah');
        $inventory->tipe = $request->input('tipe');
        $inventory->tanggal = $request->input('tanggal');
        $inventory->save();
    
        // Get the related product
        $product = Produk::find($request->input('product_id'));
    
        if ($request->input('tipe') === 'keluar') {
            // If the inventory type is 'keluar', adjust the stock
            if ($product) {
                $product->stok -= $request->input('jumlah');
                $product->save();
            }
        } elseif ($request->input('tipe') === 'masuk') {
            // If the inventory type is 'masuk', adjust the stock
            if ($product) {
                $product->stok += $request->input('jumlah');
                $product->save();
            }
        }
    
        return redirect()->route('inventory.index')->with('success', 'Inventory created successfully!');
    }
    
}
