<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Page TernakMart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white flex flex-col min-h-screen text-gray-200">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-blue-500 to-blue-600 p-4 shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-white text-xl font-bold">TernakMart - User</h1>
            <a href="<?php echo e(route('transaction.index')); ?>" class="bg-white text-blue-600 px-4 py-2 rounded-lg hover:bg-gray-100 transition duration-300 shadow-md">
                Back
            </a>
        </div>
    </nav>

    <!-- Shopping Page -->
    <!-- Filter and Search Section -->
    <div class="container mx-auto py-6 px-4">
        <div class="bg-gray-800 shadow-lg rounded-lg p-6">
            <form method="GET" action="<?php echo e(route('transaction.create')); ?>" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Filter Area -->
                <div>
                    <h2 class="text-gray-200 text-lg font-semibold mb-4">Filter Produk</h2>
                    <div class="space-y-4">
                        <div>
                            <label for="kategori_produk" class="block text-sm font-medium text-gray-400">Kategori Produk</label>
                            <select name="kategori_produk" id="kategori_produk" class="mt-1 block w-full rounded-lg bg-gray-700 border border-gray-500 text-gray-200 px-4 py-2 focus:ring-gray-500 focus:border-gray-500">
                                <option value="">Pilih Kategori Produk</option>
                                <option value="Daging Segar" <?php echo e(request('kategori_produk') == 'Daging Segar' ? 'selected' : ''); ?>>Daging Segar</option>
                                <option value="Daging Olahan" <?php echo e(request('kategori_produk') == 'Daging Olahan' ? 'selected' : ''); ?>>Daging Olahan</option>
                            </select>
                        </div>
                        <div>
                            <label for="kategori_daging" class="block text-sm font-medium text-gray-400">Kategori Daging</label>
                            <select name="kategori_daging" id="kategori_daging" class="mt-1 block w-full rounded-lg bg-gray-700 border border-gray-500 text-gray-200 px-4 py-2 focus:ring-gray-500 focus:border-gray-500">
                                <option value="">Pilih Kategori Daging</option>
                                <option value="Daging Merah" <?php echo e(request('kategori_daging') == 'Daging Merah' ? 'selected' : ''); ?>>Daging Merah</option>
                                <option value="Daging Putih" <?php echo e(request('kategori_daging') == 'Daging Putih' ? 'selected' : ''); ?>>Daging Putih</option>
                            </select>
                        </div>
                        <button type="submit" name="filter" value="true" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-300 shadow-md">
                            Filter
                        </button>
                    </div>
                </div>

                <!-- Search Area -->
                <div>
                    <h2 class="text-gray-200 text-lg font-semibold mb-4">Cari Produk</h2>
                    <div class="space-y-4">
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-400">Nama Produk</label>
                            <input type="text" name="search" id="search" value="<?php echo e(request('search')); ?>" placeholder="Masukkan nama produk" class="mt-1 block w-full rounded-lg bg-gray-700 border border-gray-500 text-gray-200 px-4 py-2 focus:ring-gray-500 focus:border-gray-500">
                        </div>
                        <button type="submit" name="search_button" value="true" class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700 transition duration-300 shadow-md">
                            Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Product Grid -->
    <div class="container mx-auto py-6 px-4">
        <form method="POST" action="<?php echo e(route('transaction.store')); ?>">
            <?php echo csrf_field(); ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-gray-800 border border-2 shadow-xl rounded-lg overflow-hidden">
                        <div class="flex justify-between items-center bg-gray-700 px-4 py-2">
                                <span class="text-blue-400 text-sm font-medium"><?php echo e($product->kategori_produk); ?></span>
                                <span class="text-blue-400 text-sm font-medium"><?php echo e($product->kategori_daging); ?></span>
                            </div>
                            <img src="<?php echo e(asset('images/product_' . $product->id . '.jpg')); ?>" 
                                alt="<?php echo e($product->nama_produk); ?>" 
                                class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h2 class="text-lg font-semibold text-gray-100"><?php echo e($product->nama_produk); ?></h2>
                                <p class="text-green-400 font-bold mt-2">Rp <?php echo e(number_format($product->harga_produk, 0, ',', '.')); ?></p>
                                <p class="text-orange-400 mt-1">Stok: <?php echo e($product->jumlah_stok); ?></p>

                            <!-- Quantity Control -->
                            <div class="flex items-center mt-4">
                                <input type="hidden" name="produk[<?php echo e($product->id); ?>][id]" value="<?php echo e($product->id); ?>">
                                <button type="button" onclick="adjustQuantity(<?php echo e($product->id); ?>, false)" class="bg-red-600 text-white px-2 py-1 rounded-l-lg hover:bg-red-700">-</button>
                                <input type="number" id="quantity-<?php echo e($product->id); ?>" name="produk[<?php echo e($product->id); ?>][jumlah]" value="0" min="0" class="w-12 text-center bg-gray-700 text-gray-200 border border-gray-500">
                                <button type="button" onclick="adjustQuantity(<?php echo e($product->id); ?>, true)" class="bg-green-600 text-white px-2 py-1 rounded-r-lg hover:bg-green-700">+</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

                <!-- Submit Button -->
                <div class="text-center mt-6">
                    <button type="submit" class="w-full px-4 py-2 bg-green-500 text-white font-semibold rounded-md shadow-lg hover:bg-green-600 focus:ring focus:ring-green-500">
                        Tambah Barang ke Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script untuk Quantity Control -->
    <script>
        function adjustQuantity(productId, increment) {
            const quantityInput = document.getElementById(`quantity-${productId}`);
            let currentValue = parseInt(quantityInput.value);
            if (increment) {
                quantityInput.value = currentValue + 1;
            } else if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        }
    </script>
</body>
</html><?php /**PATH D:\Apps\laragon\www\ternakmart\resources\views/shopping.blade.php ENDPATH**/ ?>