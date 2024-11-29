<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Pendapatan Transaksi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="bg-blue-500 p-4 flex justify-between items-center text-white">
        <h1 class="font-bold text-lg">TernakMart - Admin</h1>
        <div class="space-x-4">
            <a href="{{ route('dashboard') }}" class="bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Back</a>
        </div>
    </nav>

    <!-- Rekap Page -->
    <div class="container mx-auto p-4">
        <h1 class="text-4xl text-center font-bold mb-4">{{ $title }}</h1>

        <!-- Filter Form -->
        <div class="min-w-full py-6">
            <div class="bg-gray-800 shadow-lg rounded-lg p-6">
                <form method="GET" action="{{ route('transaction.recap') }}" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="day" class="block text-sm font-medium text-gray-400">Tanggal</label>
                        <input type="number" name="day" id="day" min="1" max="31" value="{{ request('day') }}" required
                            placeholder="Masukkan tanggal" class="mt-1 block w-full rounded-lg bg-gray-700 border border-gray-500 text-gray-200 px-4 py-2 focus:ring-gray-500 focus:border-gray-500">
                    </div>
                    <div>
                        <label for="month" class="block text-sm font-medium text-gray-700">Bulan</label>
                        <input type="number" name="month" id="month" min="1" max="12" value="{{ request('month') }}" required
                            placeholder="Masukkan bulan" class="mt-1 block w-full rounded-lg bg-gray-700 border border-gray-500 text-gray-200 px-4 py-2 focus:ring-gray-500 focus:border-gray-500">
                    </div>
                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700">Tahun</label>
                        <input type="number" name="year" id="year" min="2000" max="2100" value="{{ request('year') }}" required
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
        <div class="flex justify-between items-center mb-2">
            @if(request('day') || request('month') || request('year'))
                <a href="{{ route('transaction.recap') }}" 
                class="bg-green-500 text-white px-4 py-2 rounded-md shadow hover:bg-green-600 transition">
                    Tampilkan Semua Transaksi
                </a>
            @endif
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
                @forelse($transactions as $transaction)
                    <tr>
                        <td class="px-4 py-2 border-b text-center">{{ $transaction->id }}</td>
                        <td class="px-4 py-2 border-b text-center">{{ $transaction->user->name }}</td>
                        <td class="px-4 py-2 border-b text-center">{{ date('d F Y', strtotime($transaction->transaction_date)) }}</td>
                        <td class="px-4 py-2 border-b text-center">Rp. {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                        <td class="px-4 py-2 border-b text-center">
                            <!-- Detail Pembelian -->
                            <ul class="list-disc list-inside text-justify">
                                @foreach($transaction->items as $item)
                                    <li>
                                        {{ $item->name }} -
                                        {{ $item->quantity }} x Rp. {{ number_format($item->price, 0, ',', '.') }}
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-500 py-4">Tidak ada transaksi ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Total Revenue -->
        <div class="mt-6 p-4 bg-green-100 rounded shadow text-green-800">
            <h2 class="text-xl font-bold">Total Pendapatan: Rp. {{ number_format($totalRevenue, 0, ',', '.') }}</h2>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-800 text-white text-center p-4 mt-auto">
        <p>&copy; 2024 TernakMart. All Rights Reserved.</p>
    </footer>
</body>
</html>