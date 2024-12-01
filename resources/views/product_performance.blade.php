<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Performance Page Ternakmart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="bg-blue-500 p-4 flex justify-between items-center text-white">
        <h1 class="font-bold text-lg">TernakMart - Admin</h1>
        <div class="space-x-4">
            <a href="{{ route('dashboard') }}" class="bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Back</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto p-4">
        <h2 class="text-4xl text-center font-bold mb-4">Kinerja Penjualan Produk</h2>

        <!-- Filter Section -->
        <div class="min-w-full py-6">
            <div class="bg-gray-800 shadow-lg rounded-lg p-6">
                <form method="GET" action="{{ route('product.performance') }}" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Filter Area -->
                    <div>
                        <label for="day" class="block text-sm font-medium text-gray-400">Tanggal</label>
                        <input type="number" name="day" id="day" min="1" max="31" value="{{ request('day') }}" placeholder="Masukkan tanggal" class="mt-1 block w-full rounded-lg bg-gray-700 border border-gray-500 text-gray-200 px-4 py-2 focus:ring-gray-500 focus:border-gray-500">
                    </div>
                    <div>
                        <label for="month" class="block text-sm font-medium text-gray-400">Bulan</label>
                        <input type="number" name="month" id="month" min="1" max="12" value="{{ request('month') }}" placeholder="Masukkan bulan" class="mt-1 block w-full rounded-lg bg-gray-700 border border-gray-500 text-gray-200 px-4 py-2 focus:ring-gray-500 focus:border-gray-500">
                    </div>
                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-400">Tahun</label>
                        <input type="number" name="year" id="year" min="2000" max="2100" value="{{ request('year') }}" placeholder="Masukkan tahun" class="mt-1 block w-full rounded-lg bg-gray-700 border border-gray-500 text-gray-200 px-4 py-2 focus:ring-gray-500 focus:border-gray-500">
                    </div>
                    <div class="col-span-3">
                        <button type="submit" name="filter" value="true" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-300 shadow-md">
                            Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Canvas for Chart.js -->
        <canvas id="productPerformanceChart" width="400" height="200"></canvas>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-800 text-white text-center p-4 mt-auto">
        <p>&copy; 2024 TernakMart. All Rights Reserved.</p>
    </footer>

    <!-- JavaScript to Render Chart -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('productPerformanceChart').getContext('2d');
            var productPerformanceChart = new Chart(ctx, {
                type: 'bar', // Change this to 'line' or other chart types if needed
                data: {
                    labels: {!! json_encode($productSales->pluck('name')) !!}, // Product names
                    datasets: [{
                        label: 'Terjual',
                        data: {!! json_encode($productSales->pluck('total_sales')) !!}, // Sales data
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            stepSize: 1, // Ensure the y-axis increments by 1
                            precision: 0 // Ensure no decimal places are shown
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>