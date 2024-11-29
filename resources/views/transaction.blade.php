<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction List Page TernakMart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="bg-blue-500 p-4 flex justify-between items-center text-white">
        <h1 class="font-bold text-lg">TernakMart - User</h1>
        <div class="space-x-4">
            <a href="{{ route('dashboard') }}" class="bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Back</a>
        </div>
    </nav>

    <!-- Transaction Page -->
    <div class="container mx-auto p-4">
        <h1 class="text-4xl text-center font-bold mb-4">Riwayat Transaksi {{ Auth::user()->name }}</h1>
        <div class="flex justify-between items-center mb-2">
            <a href="{{ route('transaction.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-md shadow hover:bg-green-600 transition">Buat Transaksi Baru</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="min-w-full table-auto bg-gray-800 text-white rounded-md">
            <thead>
                <tr>
                    <th class="px-4 py-2 border-b text-center">Nama Pembeli</th>
                    <th class="px-4 py-2 border-b text-center">Tanggal Pembelian</th>
                    <th class="px-4 py-2 border-b text-center">Total Harga</th>
                    <th class="px-4 py-2 border-b text-center">Detail Pembelian</th>
                    <th class="px-4 py-2 border-b text-center">Hapus</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                    <tr>
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
                        <td class="px-4 py-2 border-b text-center">
                            <form action="{{ route('transaction.destroy', $transaction) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-800 text-white text-center p-4 mt-auto">
        <p>&copy; 2024 TernakMart. All Rights Reserved.</p>
    </footer>
</body>
</html>