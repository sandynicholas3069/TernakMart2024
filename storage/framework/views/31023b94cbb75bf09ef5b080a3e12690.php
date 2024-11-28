<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User Page TernakMart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="bg-blue-500 p-4 flex justify-between items-center text-white">
        <h1 class="font-bold text-lg">TernakMart - User</h1>
        <div class="space-x-4">
            <a href="<?php echo e(route('catalogue.index')); ?>" class="bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Catalogue</a>
            <a href="<?php echo e(route('transaction.index')); ?>" class="bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Transaction</a>
            <a href="<?php echo e(route('logout')); ?>" class="bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Logout</a>
        </div>
    </nav>

    <!-- Dashboard User Page -->
    <div class="text-center py-10">
        <h1 class="text-4xl font-bold text-blue-800">
            Selamat Datang, <?php echo e(Auth::user()->name); ?>, ke halaman Dashboard User!
        </h1>

        <img src="<?php echo e(asset('images/logo.png')); ?>" alt="LogoTernakMart" class="mx-auto mt-8 w-auto h-auto">
    </div>

    <!-- Footer -->
    <footer class="bg-blue-800 text-white text-center p-4 mt-auto">
        <p>&copy; 2024 TernakMart. All Rights Reserved.</p>
    </footer>
</body>
</html><?php /**PATH D:\Apps\laragon\www\ternakmart\resources\views/dashboard_user.blade.php ENDPATH**/ ?>