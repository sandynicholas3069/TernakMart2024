<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product Page TernakMart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="bg-blue-500 p-4 flex justify-between items-center text-white">
        <h1 class="font-bold text-lg">TernakMart - Admin</h1>
        <div class="space-x-4">
            <a href="{{ route('product.index') }}" class="bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Back</a>
        </div>
    </nav>

    <!-- Add Product Page -->
    <div class="bg-gray-900 shadow-lg rounded-lg p-8 w-full max-w-3xl mx-auto mt-4 mb-4">
        <h1 class="text-3xl font-bold text-center text-white mb-6">Tambah Produk</h1>

        <form action="{{ route('product.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="kategori_produk" class="block text-sm font-medium text-white">Kategori Produk:</label>
                <select name="kategori_produk" id="kategori_produk" class="mt-1 block w-full p-2 border border-gray-700 bg-white rounded-md focus:ring focus:ring-gray-500" required>
                    <option value="daging segar">Daging Segar</option>
                    <option value="daging olahan">Daging Olahan</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="kategori_daging" class="block text-sm font-medium text-white">Kategori Daging:</label>
                <select name="kategori_daging" id="kategori_daging" class="mt-1 block w-full p-2 border border-gray-700 bg-white rounded-md focus:ring focus:ring-gray-500" required>
                    <option value="daging merah">Daging Merah</option>
                    <option value="daging putih">Daging Putih</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="nama_produk" class="block text-sm font-medium text-white">Nama Produk:</label>
                <input type="text" name="nama_produk" id="nama_produk" class="mt-1 block w-full p-2 border border-gray-700 bg-white rounded-md focus:ring focus:ring-gray-500" required>
            </div>
            <div class="mb-4">
                <label for="harga_produk" class="block text-sm font-medium text-white">Harga Produk:</label>
                <input type="number" name="harga_produk" id="harga_produk" class="mt-1 block w-full p-2 border border-gray-700 bg-white rounded-md focus:ring focus:ring-gray-500" required>
            </div>
            <div class="mb-4">
                <label for="jumlah_stok" class="block text-sm font-medium text-white">Jumlah Stok:</label>
                <input type="number" name="jumlah_stok" id="jumlah_stok" class="mt-1 block w-full p-2 border border-gray-700 bg-white rounded-md focus:ring focus:ring-gray-500" required>
            </div>
            <button type="submit" class="w-full px-4 py-2 bg-green-500 text-white font-semibold rounded-md shadow-lg hover:bg-green-600 focus:ring focus:ring-green-500">Tambah Produk</button>
        </form>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-800 text-white text-center p-4 mt-auto">
        <p>&copy; 2024 TernakMart. All Rights Reserved.</p>
    </footer>
</body>
</html>