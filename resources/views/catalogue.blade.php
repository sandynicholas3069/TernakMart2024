<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue Page TernakMart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="bg-blue-500 p-4 flex justify-between items-center text-white">
        <h1 class="font-bold text-lg">TernakMart - User</h1>
        <div class="space-x-4">
            <a href="{{ route('dashboard') }}" class="bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Back</a>
        </div>
    </nav>

    <!-- Catalogue Page -->
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Katalog Produk</h1>

        <table class="min-w-full table-auto bg-gray-800 text-white rounded-md">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b text-center">ID</th>
                    <th class="px-4 py-2 border-b text-center">Kategori Produk</th>
                    <th class="px-4 py-2 border-b text-center">Kategori Daging</th>
                    <th class="px-4 py-2 border-b text-center">Nama Produk</th>
                    <th class="px-4 py-2 border-b text-center">Harga Produk</th>
                    <th class="px-4 py-2 border-b text-center">Jumlah Stok</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td class="px-4 py-2 border-b text-center">{{ $product->id }}</td>
                        <td class="px-4 py-2 border-b text-center">{{ $product->kategori_produk }}</td>
                        <td class="px-4 py-2 border-b text-center">{{ $product->kategori_daging }}</td>
                        <td class="px-4 py-2 border-b text-center">{{ $product->nama_produk }}</td>
                        <td class="px-4 py-2 border-b text-center">Rp. {{ number_format($product->harga_produk, 0, ',', '.') }}</td>
                        <td class="px-4 py-2 border-b text-center">{{ $product->jumlah_stok }}</td>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-800 text-white text-center p-4 mt-auto">
        <p>&copy; 2024 TernakMart. All Rights Reserved.</p>
    </footer>
</body>
</html>