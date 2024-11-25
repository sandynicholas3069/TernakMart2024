<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Page TernakMart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function adjustQuantity(productId, isIncrement) {
            const input = document.getElementById(`quantity-${productId}`);
            let quantity = parseInt(input.value);

            if (isIncrement) {
                input.value = quantity + 1;
            } else if (quantity > 0) {
                input.value = quantity - 1;
            }

            // Jika quantity = 0, sembunyikan kontrol dan panggil fungsi deleteFromCart
            if (parseInt(input.value) === 0) {
                document.getElementById(`quantity-control-${productId}`).classList.add("hidden");
                deleteFromCart(productId);
            }
        }

        function showQuantityControl(productId) {
            document.getElementById(`quantity-${productId}`).value = 1; // Set quantity default ke 1
            document.getElementById(`quantity-control-${productId}`).classList.remove("hidden"); // Menampilkan kontrol
        }
    </script>
</head>
<body class="bg-white flex flex-col min-h-screen text-gray-200">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-blue-500 to-blue-600 p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-white text-xl font-bold">TernakMart - User</h1>
            <a href="{{ route('dashboard') }}" class="bg-white text-blue-600 px-4 py-2 rounded-lg hover:bg-gray-100 transition duration-300 shadow-md">
                Back
            </a>
        </div>
    </nav>

    <!-- Filter and Search Section -->
    <div class="container mx-auto py-6 px-4">
        <div class="bg-gray-800 shadow-lg rounded-lg p-6">
            <form method="GET" action="{{ route('transaction.index') }}" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Filter Area -->
                <div>
                    <h2 class="text-gray-200 text-lg font-semibold mb-4">Filter Produk</h2>
                    <div class="space-y-4">
                        <div>
                            <label for="kategori_produk" class="block text-sm font-medium text-gray-400">Kategori Produk</label>
                            <select name="kategori_produk" id="kategori_produk" class="mt-1 block w-full rounded-lg bg-gray-700 border border-gray-500 text-gray-200 px-4 py-2 focus:ring-gray-500 focus:border-gray-500">
                                <option value="">Pilih Kategori Produk</option>
                                <option value="Daging Segar" {{ request('kategori_produk') == 'Daging Segar' ? 'selected' : '' }}>Daging Segar</option>
                                <option value="Daging Olahan" {{ request('kategori_produk') == 'Daging Olahan' ? 'selected' : '' }}>Daging Olahan</option>
                            </select>
                        </div>
                        <div>
                            <label for="kategori_daging" class="block text-sm font-medium text-gray-400">Kategori Daging</label>
                            <select name="kategori_daging" id="kategori_daging" class="mt-1 block w-full rounded-lg bg-gray-700 border border-gray-500 text-gray-200 px-4 py-2 focus:ring-gray-500 focus:border-gray-500">
                                <option value="">Pilih Kategori Daging</option>
                                <option value="Daging Merah" {{ request('kategori_daging') == 'Daging Merah' ? 'selected' : '' }}>Daging Merah</option>
                                <option value="Daging Putih" {{ request('kategori_daging') == 'Daging Putih' ? 'selected' : '' }}>Daging Putih</option>
                            </select>
                        </div>
                        <button type="submit" name="filter" value="true" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-300 shadow-md">
                            Filter
                        </button>
                    </div>
                </div>

                <!-- Search Area -->
                <div>
                    <h2 class="text-gray-200 text-lg font-semibold mb-4">Cari Produk</h2>
                    <div class="space-y-4">
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-400">Nama Produk</label>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Masukkan nama produk" class="mt-1 block w-full rounded-lg bg-gray-700 border border-gray-500 text-gray-200 px-4 py-2 focus:ring-gray-500 focus:border-gray-500">
                        </div>
                        <button type="submit" name="search_button" value="true" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition duration-300 shadow-md">
                            Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Product Grid -->
    <div class="container mx-auto py-6 px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
                <div class="bg-gray-800 border border-2 shadow-xl rounded-lg overflow-hidden">
                    <div class="flex justify-between items-center bg-gray-700 px-4 py-2">
                        <span class="text-blue-400 text-sm font-medium">{{ $product->kategori_produk }}</span>
                        <span class="text-blue-400 text-sm font-medium">{{ $product->kategori_daging }}</span>
                    </div>
                    <img src="{{ asset('images/product_' . $product->id . '.jpg') }}" alt="{{ $product->nama_produk }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-lg font-semibold text-gray-100">{{ $product->nama_produk }}</h2>
                        <p class="text-green-400 font-bold mt-2">Rp {{ number_format($product->harga_produk, 0, ',', '.') }}</p>
                        <p class="text-orange-400 mt-1">Stok: {{ $product->jumlah_stok }}</p>

                        <!-- Tombol Add to Cart -->
                        <form method="POST" action="{{ route('transaction.addToCart') }}" class="mt-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="button" onclick="showQuantityControl({{ $product->id }})" class="w-full bg-yellow-500 text-white py-2 rounded-lg hover:bg-yellow-600 transition duration-300 shadow-md">
                                Tambah Barang ke Dalam Keranjang
                            </button>

                            <div id="quantity-control-{{ $product->id }}" class="flex items-center mt-4 hidden">
                                <button type="button" onclick="adjustQuantity({{ $product->id }}, false)" class="bg-red-600 text-white px-2 py-1 rounded-l-lg hover:bg-red-700">-</button>
                                <input type="number" id="quantity-{{ $product->id }}" name="quantity" value="1" min="0" class="w-12 text-center bg-gray-700 text-gray-200 border border-gray-500">
                                <button type="button" onclick="adjustQuantity({{ $product->id }}, true)" class="bg-green-600 text-white px-2 py-1 rounded-r-lg hover:bg-green-700">+</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Preview Cart -->
    <div class="container mx-auto py-6 px-4 mt-6">
        <div class="bg-gray-800 shadow-lg rounded-lg p-6">
            <h2 class="text-gray-200 text-2xl text-center font-semibold mb-4">Keranjang Belanja</h2>
            <div class="space-y-4">
                <table class="w-full text-gray-200">
                    <thead>
                        <tr>
                            <th class="text-left">Nama Produk</th>
                            <th class="text-left">Harga</th>
                            <th class="text-left">Jumlah</th>
                            <th class="text-left">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Loop untuk daftar produk yang ada di keranjang -->
                        @if(count($transactionItems) > 0)
                            @foreach($transactionItems as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">Your cart is empty!</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                <div class="flex justify-between items-center mt-4">
                    <span class="text-gray-200 font-semibold">Total: Rp {{ number_format($total_price, 0, ',', '.') }}</span>
                    <form method="POST" action="{{ route('transaction.checkout') }}" class="mt-4">
                        @csrf
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-300 shadow-md">
                            Konfirmasi Checkout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>