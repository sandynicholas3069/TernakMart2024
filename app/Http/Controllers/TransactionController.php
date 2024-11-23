<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('transaction.index', compact('products'));
    }

    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);

        $product = Product::find($request->product_id);
        $cart[$product->id] = [
            'name' => $product->nama_produk,
            'quantity' => $request->quantity,
            'price' => $product->harga_produk,
            'total' => $product->harga_produk * $request->quantity,
        ];

        session()->put('cart', $cart);
        return redirect()->route('transaction.index')->with('success', 'Product added to cart!');
    }

    public function checkout()
    {
        $cart = session()->get('cart');
        if (!$cart) {
            return redirect()->route('transaction.index')->with('error', 'Cart is empty!');
        }

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'total_price' => array_sum(array_column($cart, 'total')),
        ]);

        foreach ($cart as $productId => $item) {
            TransactionItem::create([
                'transaction_id' => $transaction->id,
                'product_id' => $productId,
                'name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);

            // Update product stock
            $product = Product::find($productId);
            $product->jumlah_stok -= $item['quantity'];
            $product->save();
        }

        session()->forget('cart');
        return redirect()->route('history.index')->with('success', 'Transaction completed!');
    }

    public function history()
    {
        // Mengambil semua transaksi user yang sedang login, dengan item detailnya
        $transactions = Transaction::with('items')->where('user_id', Auth::id())->get();

        return view('history.index', compact('transactions'));
    } 

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);

        foreach ($transaction->items as $item) {
            // Restore product stock
            $product = $item->product;
            $product->jumlah_stok += $item->quantity;
            $product->save();
        }

        $transaction->delete();
        return redirect()->route('history.index')->with('success', 'Transaction deleted!');
    }
}