<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page TernakMart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="bg-blue-500 p-4 flex justify-between items-center text-white">
        <h1 class="font-bold text-lg">TernakMart</h1>
        <div class="space-x-4">
            <a href="{{ route('login') }}" class="bg-white text-blue-500 px-4 py-2 rounded hover:bg-blue-600">Login</a>
            <a href="{{ route('register') }}" class="bg-white text-blue-500 px-4 py-2 rounded hover:bg-blue-600">Register</a>
        </div>
    </nav>

    <!-- Landing Page -->
    <div class="text-center py-10">
        <h1 class="text-4xl font-bold text-blue-800">Selamat Datang di Website TernakMart!</h1>

        <img src="{{ asset('images/logo.png') }}" alt="LogoTernakMart" class="mx-auto mt-8 w-auto h-auto">

        <p class="text-blue-600 mt-4">Lokasi Pusat : Jl. Diponegoro No. 60, Surabaya | Lokasi Outlet Cabang : Jl. Raya Semampir No. 49 E, Medokan Semampir, Surabaya</p>
        <p class="text-blue-600">Jam Operasional Toko : Senin-Sabtu 08:00-17:00 | Telepon: +62 821-4088-4744</p>
        <p class="text-blue-600">Instagram : ternakmart | Tiktok : ternakmart</p>
        <p class="text-blue-600">Head of Ternakmart : Rangga Galih | CEO Ternaknesia : Dalu Nuzlul Kirom</p>
        <p class="text-blue-600 mt-4">Daging Lokal Halal Berkualitas Paling Lengkap di Surabaya!</p>
        <p class="text-blue-600">Selamat Menikmati Pengalaman Belanja Online di TernakMart!</p>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-800 text-white text-center p-4 mt-auto">
        <p>&copy; 2024 TernakMart. All Rights Reserved.</p>
    </footer>
</body>
</html>