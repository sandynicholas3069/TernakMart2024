<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue Page TernakMart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-300 flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="bg-blue-500 p-4 flex justify-between items-center text-white">
        <h1 class="font-bold text-lg">TernakMart - User</h1>
        <div class="space-x-4">
            <a href="{{ route('dashboard') }}" class="bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Back</a>
        </div>
    </nav>

    <!-- Catalogue Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
        @foreach($products as $product)
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <!-- Kategori -->
            <div class="flex justify-between items-center bg-white px-4 py-2">
                <span class="text-blue-500 text-sm font-medium">{{ $product->kategori_produk }}</span>
                <span class="text-green-500 text-sm font-medium">{{ $product->kategori_daging }}</span>
            </div>

            <!-- Gambar Produk -->
            <img src="{{ asset('images/product_' . $product->id . '.jpg') }}" 
            alt="{{ $product->nama_produk }}" 
            class="w-full h-48 object-cover">

            <!-- Detail Produk -->
            <div class="p-4">
                <h2 class="text-lg font-semibold">{{ $product->nama_produk }}</h2>
                <p class="text-green-600 font-bold mt-2">Rp {{ number_format($product->harga_produk, 0, ',', '.') }}</p>
                <p class="text-gray-500 mt-1">Stok: {{ $product->jumlah_stok }}</p>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Footer -->
    <footer class="bg-blue-800 text-white text-center p-4 mt-auto">
        <p>&copy; 2024 TernakMart. All Rights Reserved.</p>
    </footer>
</body>
</html>