<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CatalogueController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter filter dan search dari request
        $kategoriProduk = $request->input('kategori_produk');
        $kategoriDaging = $request->input('kategori_daging');
        $search = $request->input('search');

        // Query produk dengan kondisi filter dan pencarian
        $query = Product::query();

        if ($kategoriProduk) {
            $query->where('kategori_produk', $kategoriProduk);
        }

        if ($kategoriDaging) {
            $query->where('kategori_daging', $kategoriDaging);
        }

        if ($search) {
            $query->where('nama_produk', 'LIKE', '%' . $search . '%');
        }

        $products = $query->get();

        // Kirim data ke view 'catalogue'
        return view('catalogue', compact('products', 'kategoriProduk', 'kategoriDaging', 'search'));
    }
}