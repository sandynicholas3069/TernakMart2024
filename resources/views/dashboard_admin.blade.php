<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin Page TernakMart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="bg-blue-500 p-4 flex justify-between items-center text-white">
        <h1 class="font-bold text-lg">TernakMart - Admin</h1>
        <div class="space-x-4">
            <a href="{{ route('product.index') }}" class="bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Produk</a>
            <a href="{{ route('logout') }}" class="bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Logout</a>
        </div>
    </nav>

    <!-- Dashboard Admin Page -->
    <div class="text-center py-10">
        <h1 class="text-4xl font-bold text-blue-800">
            Selamat Datang, {{ Auth::user()->name }}, ke halaman Dashboard Admin!
        </h1>

        <img src="{{ asset('images/logo.png') }}" alt="LogoTernakMart" class="mx-auto mt-8 w-auto h-auto">
    </div>

    <!-- Footer -->
    <footer class="bg-blue-800 text-white text-center p-4 mt-auto">
        <p>&copy; 2024 TernakMart. All Rights Reserved.</p>
    </footer>
</body>
</html>