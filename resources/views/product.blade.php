<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Page TernakMart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="bg-blue-500 p-4 flex justify-between items-center text-white">
        <h1 class="font-bold text-lg">TernakMart - Admin</h1>
        <div class="space-x-4">
            <a href="{{ route('dashboard') }}" class="bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Back</a>
        </div>
    </nav>

    <!-- Product Page -->
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Daftar Produk</h1>
        <div class="flex justify-between items-center mb-2">
            <a href="{{ route('product.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-md shadow hover:bg-green-600 transition">Tambah Produk</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="min-w-full table-auto bg-gray-800 text-white rounded-md">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b text-center">ID</th>
                    <th class="px-4 py-2 border-b text-center">Kategori Produk</th>
                    <th class="px-4 py-2 border-b text-center">Kategori Daging</th>
                    <th class="px-4 py-2 border-b text-center">Nama Produk</th>
                    <th class="px-4 py-2 border-b text-center">Harga Produk</th>
                    <th class="px-4 py-2 border-b text-center">Jumlah Stok</th>
                    <th class="px-4 py-2 border-b text-center">Edit</th>
                    <th class="px-4 py-2 border-b text-center">Hapus</th>
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
                        <td class="px-4 py-2 border-b text-center">
                            <a href="{{ route('product.edit', $product) }}" 
                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                            Edit
                            </a>
                        </td>
                        <td class="border px-4 py-2">
                            <form action="{{ route('product.destroy', $product) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                                    Hapus
                                </button>
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