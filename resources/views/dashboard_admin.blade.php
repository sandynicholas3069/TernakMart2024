<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin Page TernakMart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white flex">
    <!-- Sidebar -->
    <div class="bg-blue-500 text-white w-64 min-h-screen p-4">
        <h1 class="font-bold text-lg mb-4">TernakMart - Admin</h1>
        <nav class="space-y-4">
            <a href="{{ route('dashboard') }}" class="block bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Dashboard</a>
            <a href="{{ route('product.index') }}" class="block bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Product List</a>
            <a href="{{ route('transaction.recap') }}" class="block bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Transaction Recap</a>
            <a href="{{ route('product.performance') }}" class="block bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Product Performance</a>
            <a href="{{ route('logout') }}" class="block bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Logout</a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">

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
    </div>
</body>
</html>