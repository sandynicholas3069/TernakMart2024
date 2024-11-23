<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page TernakMart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="bg-blue-500 p-4 flex justify-between items-center text-white">
        <h1 class="font-bold text-lg">TernakMart</h1>
        <div class="space-x-4">
            <a href="{{ route('landing') }}" class="bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Back</a>
        </div>
    </nav>

    <!-- Register Page -->
    <div class="min-h-screen bg-gray-50 flex items-center justify-center">
        <form action="{{ route('register') }}" method="POST" class="bg-gray-800 p-6 rounded shadow-md space-y-4">
            @csrf
            <h2 class="text-2xl text-center text-white font-bold">Register</h2>
            <input type="text" name="name" placeholder="Name" class="w-full border p-2 rounded">
            <input type="email" name="email" placeholder="Email" class="w-full border p-2 rounded">
            <input type="password" name="password" placeholder="Password" class="w-full border p-2 rounded">
            <input type="password" name="password_confirmation" placeholder="Confirm Password" class="w-full border p-2 rounded">
            <select name="role" class="w-full border p-2 rounded">
                <option value="pelanggan">Pelanggan</option>
                <option value="pemilik">Pemilik</option>
            </select>
            <button type="submit" class="w-full bg-blue-500 text-white hover:bg-blue-600 p-2 rounded">Register</button>
            <a href="{{ route('login') }}" class="text-blue-300 text-sm hover:underline transition-colors duration-300">Login</a>
        </form>
    </div>

    <!-- Footer (Optional) -->
    <footer class="bg-blue-800 text-white text-center p-4 mt-auto">
        <p>&copy; 2024 TernakMart. All Rights Reserved.</p>
    </footer>
</body>
</html>