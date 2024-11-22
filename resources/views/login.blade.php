<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page TernakMart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="bg-blue-500 p-4 flex justify-between items-center text-white">
        <h1 class="font-bold text-lg">TernakMart</h1>
        <div class="space-x-4">
            <a href="{{ route('landing') }}" class="bg-white text-blue-500 px-4 py-2 rounded hover:bg-blue-600">Back</a>
        </div>
    </nav>

    <!-- Landing Page -->
    <div class="min-h-screen bg-gray-50 flex items-center justify-center">
        <form action="{{ route('login') }}" method="POST" class="bg-gray-800 p-6 rounded shadow-md space-y-4">
            @csrf
            <h2 class="text-white text-lg font-bold">Login</h2>
            <input type="email" name="email" placeholder="Input Your Email" class="w-full border p-2 rounded">
            <input type="password" name="password" placeholder="Input Your Password" class="w-full border p-2 rounded">
            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded">Login</button>
            <a href="{{ route('register') }}" class="text-blue-500 text-sm">Register</a>
        </form>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-800 text-white text-center p-4 mt-auto">
        <p>&copy; 2024 TernakMart. All Rights Reserved.</p>
    </footer>
</body>
</html>