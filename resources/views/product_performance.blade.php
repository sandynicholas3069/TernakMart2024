<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kinerja Penjualan Produk - TernakMart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="bg-blue-500 p-4 flex justify-between items-center text-white">
        <h1 class="font-bold text-lg">TernakMart - Kinerja Penjualan Produk</h1>
        <div class="space-x-4">
            <a href="{{ route('dashboard') }}" class="bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Dashboard</a>
            <a href="{{ route('logout') }}" class="bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Logout</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Kinerja Penjualan Produk</h2>
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