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
            <a href="<?php echo e(route('dashboard')); ?>" class="bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Back</a>
        </div>
    </nav>

    <!-- Product Page -->
    <div class="container mx-auto p-4">
        <h1 class="text-4xl text-center font-bold mb-4">Daftar Produk</h1>
        <div class="flex justify-between items-center mb-2">
            <a href="<?php echo e(route('product.create')); ?>" class="bg-green-500 text-white px-4 py-2 rounded-md shadow hover:bg-green-600 transition">Tambah Produk</a>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <table class="min-w-full table-auto bg-gray-800 text-white rounded-md">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b text-center">Nomor</th>
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
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="px-4 py-2 border-b text-center"><?php echo e($product->id); ?></td>
                        <td class="px-4 py-2 border-b text-center"><?php echo e($product->kategori_produk); ?></td>
                        <td class="px-4 py-2 border-b text-center"><?php echo e($product->kategori_daging); ?></td>
                        <td class="px-4 py-2 border-b text-center"><?php echo e($product->nama_produk); ?></td>
                        <td class="px-4 py-2 border-b text-center">Rp. <?php echo e(number_format($product->harga_produk, 0, ',', '.')); ?></td>
                        <td class="px-4 py-2 border-b text-center"><?php echo e($product->jumlah_stok); ?></td>
                        <td class="px-4 py-2 border-b text-center">
                            <a href="<?php echo e(route('product.edit', $product)); ?>" 
                            class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                            Edit
                            </a>
                        </td>
                        <td class="px-4 py-2 border-b text-center">
                            <form action="<?php echo e(route('product.destroy', $product)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" 
                                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-800 text-white text-center p-4 mt-auto">
        <p>&copy; 2024 TernakMart. All Rights Reserved.</p>
    </footer>
</body>
</html><?php /**PATH D:\Apps\laragon\www\ternakmart\resources\views/product.blade.php ENDPATH**/ ?>