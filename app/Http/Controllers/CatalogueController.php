<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CatalogueController extends Controller
{
    public function index()
    {
        // Ambil semua data produk dari tabel
        $products = Product::all();

        // Kirim data ke view 'catalogue'
        return view('catalogue', compact('products'));
    }
}
