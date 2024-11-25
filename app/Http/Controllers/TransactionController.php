<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem; // Mengimpor model TransactionItem
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Untuk penggunaan DB raw expressions

class TransactionController extends Controller
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

        // Ambil produk sesuai dengan filter
        $products = $query->get();

        // Cek apakah transaksi pending sudah ada
        $transaction = Transaction::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->first();

        // Ambil item-item dalam keranjang jika transaksi ditemukan
        $transactionItems = $transaction ? $transaction->items : [];
        $total_price = $transaction ? $transaction->total_price : 0;

        // Return view dengan data produk dan keranjang
        return view('transaction', compact('products', 'kategoriProduk', 'kategoriDaging', 'search', 'transactionItems', 'total_price'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::find($request->product_id);

        if (!$product) {
            return redirect()->route('transaction.index')->with('error', 'Product not found!');
        }

        if ($product->jumlah_stok < $request->quantity) {
            return redirect()->route('transaction.index')->with('error', 'Insufficient stock for this product.');
        }

        $transaction = Transaction::firstOrCreate(
            ['user_id' => Auth::id(), 'status' => 'pending'],
            ['total_price' => 0, 'transaction_date' => now()]
        );

        $transactionItem = $transaction->items()->where('product_id', $product->id)->first();

        if ($transactionItem) {
            $transactionItem->quantity += $request->quantity;

            if ($transactionItem->quantity <= 0) {
                $transactionItem->delete();
            } else {
                $transactionItem->save();
            }
        } else {
            $transaction->items()->create([
                'transaction_id' => $transaction->id,
                'product_id' => $product->id,
                'name' => $product->nama_produk,
                'quantity' => $request->quantity,
                'price' => $product->harga_produk,
            ]);
        }

        $this->updateTotalPrice($transaction);

        return redirect()->route('transaction.index')->with('success', 'Product added to cart!');
    }

    private function updateTotalPrice($transaction)
    {
        $totalPrice = $transaction->items->sum(function($item) {
            return $item->quantity * $item->price;
        });

        $transaction->total_price = $totalPrice;
        $transaction->save();
    }

    public function checkout()
    {
        $transaction = Transaction::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->first();

        if (!$transaction || $transaction->items->isEmpty()) {
            return redirect()->route('transaction.index')->with('error', 'Cart is empty!');
        }

        DB::transaction(function () use ($transaction) {
            foreach ($transaction->items as $item) {
                $product = $item->product;
                if ($product->jumlah_stok < $item->quantity) {
                    throw new \Exception("Stock for {$product->nama_produk} is insufficient.");
                }

                $product->jumlah_stok -= $item->quantity;
                $product->save();
            }

            $transaction->status = 'completed';
            $transaction->save();
        });

        return redirect()->route('history.index')->with('success', 'Transaction completed!');
    }

    public function history()
    {
        // Menampilkan transaksi yang sudah selesai
        $transactions = Transaction::with('items')  // Mengambil data items untuk setiap transaksi
            ->where('user_id', Auth::id())
            ->where('status', 'completed')
            ->get();

        return view('history', compact('transactions'));
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);

        // Pastikan transaksi yang ingin dihapus adalah milik pengguna yang sedang login
        if ($transaction->user_id !== Auth::id()) {
            return redirect()->route('history.index')->with('error', 'You do not have permission to delete this transaction.');
        }

        // Kembalikan stok produk
        foreach ($transaction->items as $item) {
            $product = $item->product;
            $product->jumlah_stok += $item->quantity;
            $product->save();
        }

        // Hapus transaksi
        $transaction->delete();

        return redirect()->route('history.index')->with('success', 'Transaction deleted!');
    }
}