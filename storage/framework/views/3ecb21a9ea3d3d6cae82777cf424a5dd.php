<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - TernakMart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="bg-blue-500 p-4 flex justify-between items-center text-white">
        <h1 class="font-bold text-lg">TernakMart - Admin Dashboard</h1>
        <div class="space-x-4">
            <a href="<?php echo e(route('dashboard')); ?>" class="bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Dashboard</a>
            <a href="<?php echo e(route('logout')); ?>" class="bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Logout</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Welcome to the Admin Dashboard</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Example Cards -->
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-xl font-bold">Manage Products</h3>
                <p class="mt-2">Add, edit, or delete products.</p>
                <a href="<?php echo e(route('product.index')); ?>" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors duration-300">Go to Products</a>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h3 class="text-xl font-bold">Manage Transactions</h3>
                <p class="mt-2">View and manage transactions.</p>
                <a href="<?php echo e(route('transaction.index')); ?>" class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors duration-300">Go to Transactions</a>
            </div>
            <!-- Add more cards as needed -->
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-800 text-white text-center p-4 mt-auto">
        <p>&copy; 2024 TernakMart. All Rights Reserved.</p>
    </footer>
</body>
</html><?php /**PATH D:\Apps\laragon\www\ternakmart\resources\views/admin_dashboard.blade.php ENDPATH**/ ?>