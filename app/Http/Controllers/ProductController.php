<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('product', compact('products'));
    }

    public function create()
    {
        return view('add_product');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategori_produk' => 'required|in:daging segar,daging olahan',
            'kategori_daging' => 'required|in:daging merah,daging putih',
            'nama_produk' => 'required|string|max:255',
            'harga_produk' => 'required|integer|min:0',
            'jumlah_stok' => 'required|integer|min:0',
        ]);

        Product::create($validated);

        return redirect()->route('product.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        return view('edit_product', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'kategori_produk' => 'required|in:daging segar,daging olahan',
            'kategori_daging' => 'required|in:daging merah,daging putih',
            'nama_produk' => 'required|string|max:255',
            'harga_produk' => 'required|integer|min:0',
            'jumlah_stok' => 'required|integer|min:0',
        ]);

        $product->update($validated);

        return redirect()->route('product.index')->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Produk berhasil dihapus!');
    }
}