<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Pendapatan Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* CSS untuk tampilan cetak */
        @media print {
            /* Menyembunyikan bagian yang tidak diperlukan saat pencetakan */
            .no-print {
                display: none !important;
            }

            /* Memastikan konten tetap rapi saat dicetak */
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 20px;
            }

            .content {
                margin-top: 20px;
            }

            .total-revenue {
                font-size: 18px;
                font-weight: bold;
                margin-top: 20px;
            }

            /* Membuat tabel dan konten utama lebih jelas saat dicetak */
            table {
                width: 100%; /* Mengatur lebar tabel 100% */
                table-layout: fixed; /* Mengatur agar tabel memiliki panjang lebar tetap */
                margin: 20px 0;
            }

            th, td {
                border: 1px solid #000000; /* Warna border menjadi hitam */
                padding: 20px; /* Menambah padding untuk membuat isi lebih jelas */
                color: #000000; /* Warna teks isi tabel menjadi hitam */
            }

            th {
                background-color: #f2f2f2; /* Warna latar belakang header tabel */
                text-align: center; /* Menyelaraskan teks header ke tengah */
            }

            td {
                background-color: #ffffff; /* Warna latar belakang sel tabel */
                text-align: justify; /* Menyelaraskan teks isi tabel (selain header) ke kiri */
            }
        }
    </style>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="bg-blue-500 p-4 flex justify-between items-center text-white no-print">
        <h1 class="font-bold text-lg">TernakMart - Admin</h1>
        <div class="space-x-4">
            <a href="<?php echo e(route('dashboard')); ?>" class="bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Back</a>
        </div>
    </nav>

    <!-- Rekap Page -->
    <div class="container mx-auto p-4">
        <h1 class="text-4xl text-center font-bold mb-4"><?php echo e($title); ?></h1>

        <!-- Filter Form -->
        <div class="min-w-full py-6 no-print">
            <div class="bg-gray-800 shadow-lg rounded-lg p-6">
                <form method="GET" action="<?php echo e(route('transaction.recap')); ?>" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="day" class="block text-sm font-medium text-gray-400">Tanggal</label>
                        <input type="number" name="day" id="day" min="1" max="31" value="<?php echo e(request('day')); ?>" required
                            placeholder="Masukkan tanggal" class="mt-1 block w-full rounded-lg bg-gray-700 border border-gray-500 text-gray-200 px-4 py-2 focus:ring-gray-500 focus:border-gray-500">
                    </div>
                    <div>
                        <label for="month" class="block text-sm font-medium text-gray-700">Bulan</label>
                        <input type="number" name="month" id="month" min="1" max="12" value="<?php echo e(request('month')); ?>" required
                            placeholder="Masukkan bulan" class="mt-1 block w-full rounded-lg bg-gray-700 border border-gray-500 text-gray-200 px-4 py-2 focus:ring-gray-500 focus:border-gray-500">
                    </div>
                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700">Tahun</label>
                        <input type="number" name="year" id="year" min="2000" max="2100" value="<?php echo e(request('year')); ?>" required
                            placeholder="Masukkan tahun" class="mt-1 block w-full rounded-lg bg-gray-700 border border-gray-500 text-gray-200 px-4 py-2 focus:ring-gray-500 focus:border-gray-500">
                    </div>
                    <div class="col-span-3">
                        <button type="submit" name="filter" value="true" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-300 shadow-md">
                            Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tombol Tampilkan Semua -->
        <div class="flex justify-between items-center mb-2 no-print">
            <?php if(request('day') || request('month') || request('year')): ?>
                <a href="<?php echo e(route('transaction.recap')); ?>" 
                class="bg-green-500 text-white px-4 py-2 rounded-md shadow hover:bg-green-600 transition">
                    Tampilkan Semua Transaksi
                </a>
            <?php endif; ?>
        </div>

        <!-- Transaction Table -->
        <table class="min-w-full table-auto bg-gray-800 text-white rounded-md">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b text-center">Nomor</th>
                    <th class="px-4 py-2 border-b text-center">Nama Pembeli</th>
                    <th class="px-4 py-2 border-b text-center">Tanggal Pembelian</th>
                    <th class="px-4 py-2 border-b text-center">Total Harga</th>
                    <th class="px-4 py-2 border-b text-center">Detail Pembelian</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-4 py-2 border-b text-center"><?php echo e($transaction->id); ?></td>
                        <td class="px-4 py-2 border-b text-center"><?php echo e($transaction->user->name); ?></td>
                        <td class="px-4 py-2 border-b text-center"><?php echo e(date('d F Y', strtotime($transaction->transaction_date))); ?></td>
                        <td class="px-4 py-2 border-b text-center">Rp. <?php echo e(number_format($transaction->total_price, 0, ',', '.')); ?></td>
                        <td class="px-4 py-2 border-b text-center">
                            <!-- Detail Pembelian -->
                            <ul class="list-disc list-inside text-justify">
                                <?php $__currentLoopData = $transaction->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <?php echo e($item->name); ?> -
                                        <?php echo e($item->quantity); ?> x Rp. <?php echo e(number_format($item->price, 0, ',', '.')); ?>

                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="text-center text-gray-500 py-4">Tidak ada transaksi ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Total Revenue -->
        <div class="mt-6 p-4 bg-green-100 rounded shadow text-green-800 mb-4">
            <h2 class="text-xl font-bold">Total Pendapatan: Rp. <?php echo e(number_format($totalRevenue, 0, ',', '.')); ?></h2>
        </div>

        <!-- Tombol Print -->
        <button onclick="window.print()" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition no-print">
            Print Rekap Transaksi
        </button>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-800 text-white text-center p-4 mt-auto no-print">
        <p>&copy; 2024 TernakMart. All Rights Reserved.</p>
    </footer>
</body>
</html><?php /**PATH D:\Apps\laragon\www\ternakmart\resources\views/recap.blade.php ENDPATH**/ ?>