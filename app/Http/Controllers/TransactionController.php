<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    // Menampilkan daftar transaksi
    public function index()
    {
        // Ambil transaksi milik pengguna yang sedang login
        $transactions = Transaction::with('items')
            ->where('user_id', Auth::id())
            ->get();

        // Kirim data ke view
        return view('transaction', compact('transactions'));
    }

    // Form untuk membuat transaksi
    public function create(Request $request)
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

        return view('shopping', compact('products', 'kategoriProduk', 'kategoriDaging', 'search'));
    }

    // Menyimpan transaksi baru
    public function store(Request $request)
    {
        // Validasi input - 'nullable' untuk jumlah yang bisa kosong (0)
        $validated = $request->validate([
            'produk' => 'required|array',
            'produk.*.id' => 'required|exists:products,id',
            'produk.*.jumlah' => 'nullable|integer|min:0', // Jumlah boleh 0
        ]);

        // Filter produk yang memiliki jumlah lebih dari 0 (jumlah 0 diabaikan)
        $produk = array_filter($validated['produk'], function ($produk) {
            return isset($produk['jumlah']) && $produk['jumlah'] > 0; // Hanya produk dengan jumlah > 0 yang diproses
        });

        // Pastikan ada produk yang dipilih dengan jumlah > 0
        if (empty($produk)) {
            return redirect()->route('transaction.create')->with('error', 'Tidak ada produk yang dipilih.');
        }

        DB::transaction(function () use ($produk) {
            // Membuat transaksi baru
            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'transaction_date' => now(),
                'total_price' => 0,
            ]);

            $total_price = 0;

            foreach ($produk as $item) {
                // Cari produk berdasarkan ID
                $product = Product::findOrFail($item['id']);

                // Validasi stok produk cukup
                if ($product->jumlah_stok < $item['jumlah']) {
                    throw new \Exception("Stok untuk {$product->nama_produk} tidak mencukupi.");
                }

                // Kurangi stok produk
                $product->decrement('jumlah_stok', $item['jumlah']);

                // Tambahkan item transaksi
                TransactionItem::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $product->id,
                    'name' => $product->nama_produk,
                    'quantity' => $item['jumlah'],
                    'price' => $product->harga_produk,
                ]);

                // Hitung total harga
                $total_price += $product->harga_produk * $item['jumlah'];
            }

            // Update total harga transaksi
            $transaction->update(['total_price' => $total_price]);
        });

        return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil dibuat!');
    }

    // Menghapus transaksi
    public function destroy(Transaction $transaction)
    {
        DB::transaction(function () use ($transaction) {
            foreach ($transaction->items as $item) {
                $product = $item->product;
                $product->jumlah_stok += $item->quantity;
                $product->save();
            }

            $transaction->delete();
        });

        return redirect()->route('transaction.index')->with('success', 'Transaksi berhasil dihapus!');
    }

    public function productPerformance(Request $request)
    {
        // Ambil parameter filter dari request
        $day = $request->input('day');
        $month = $request->input('month');
        $year = $request->input('year');

        // Query dasar untuk menghitung total penjualan produk
        $query = TransactionItem::selectRaw('name, SUM(quantity) as total_sales')
            ->join('transactions', 'transaction_items.transaction_id', '=', 'transactions.id') // Pastikan join dengan tabel transaksi jika diperlukan
            ->groupBy('name');

        // Terapkan filter berdasarkan hari, bulan, atau tahun jika ada
        if ($day) {
            $query->whereDay('transactions.created_at', $day); // Filter berdasarkan hari
        }
        if ($month) {
            $query->whereMonth('transactions.created_at', $month); // Filter berdasarkan bulan
        }
        if ($year) {
            $query->whereYear('transactions.created_at', $year); // Filter berdasarkan tahun
        }

        // Eksekusi query
        $productSales = $query->get();

        // Kirim data ke view
        return view('product_performance', compact('productSales', 'day', 'month', 'year'));
    }

    public function recapTransaction(Request $request)
    {
        // Ambil parameter filter dari request
        $day = $request->input('day');
        $month = $request->input('month');
        $year = $request->input('year');

        // Query dasar untuk mengambil data transaksi dengan user dan item
        $query = Transaction::with('user', 'items');

        // Terapkan filter jika semua parameter tanggal, bulan, dan tahun diisi
        if ($day && $month && $year) {
            $query->whereDate('transaction_date', '=', "$year-$month-$day");
        }

        // Eksekusi query
        $transactions = $query->get();

        // Hitung total pendapatan
        $totalRevenue = $transactions->sum('total_price');

        // Kirim data ke view
        $title = ($day && $month && $year)
            ? "Rekap Pendapatan Transaksi TernakMart pada " . date('d F Y', strtotime("$year-$month-$day"))
            : "Rekap Pendapatan Transaksi TernakMart";

        return view('recap', compact('transactions', 'totalRevenue', 'title', 'day', 'month', 'year'));
    }

    public function dailyRecap()
    {
        // Get today's date
        $today = now()->startOfDay();

        // Fetch the total sales for each product sold today
        $productSales = TransactionItem::selectRaw('name, SUM(quantity) as total_sales')
            ->whereHas('transaction', function ($query) use ($today) {
                $query->where('transaction_date', '>=', $today);
            })
            ->groupBy('name')
            ->get();

        // Calculate the total revenue for today
        $totalRevenue = Transaction::where('transaction_date', '>=', $today)
            ->sum('total_price');

        // Fetch daily total revenue for the past week
        $dailyRevenue = Transaction::selectRaw('DATE(transaction_date) as date, SUM(total_price) as total_revenue')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        return view('daily_recap', compact('productSales', 'totalRevenue', 'dailyRevenue'));
    }

}