<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Recap - TernakMart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Include Chart.js Date Adapter -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns"></script>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="bg-blue-500 p-4 flex justify-between items-center text-white">
        <h1 class="font-bold text-lg">TernakMart - Daily Recap</h1>
        <div class="space-x-4">
            <a href="<?php echo e(route('dashboard')); ?>" class="bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Dashboard</a>
            <a href="<?php echo e(route('logout')); ?>" class="bg-white text-blue-500 px-4 py-2 rounded hover:underline transition-colors duration-300">Logout</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Daily Recap</h2>
        <!-- Canvas for Product Sales Chart -->
        <canvas id="dailyRecapChart" width="400" height="200"></canvas>
        <!-- Total Revenue -->
        <div class="mt-6 p-4 bg-green-100 rounded shadow text-green-800">
            <h3 class="text-xl font-bold">Total Revenue Today: Rp<?php echo e(number_format($totalRevenue, 0, ',', '.')); ?></h3>
        </div>
        <!-- Canvas for Daily Revenue Chart -->
        <canvas id="dailyRevenueChart" width="400" height="200" class="mt-6"></canvas>
    </div>

    <!-- Footer -->
    <footer class="bg-blue-800 text-white text-center p-4 mt-auto">
        <p>&copy; 2024 TernakMart. All Rights Reserved.</p>
    </footer>

    <!-- JavaScript to Render Charts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var productNames = <?php echo json_encode($productSales->pluck('name')); ?>;
            var productSales = <?php echo json_encode($productSales->pluck('total_sales')); ?>;
            var dailyRevenueDates = <?php echo json_encode($dailyRevenue->pluck('date')->map(function($date) { return \Carbon\Carbon::parse($date)->format('Y-m-d'); })); ?>;
            var dailyRevenueValues = <?php echo json_encode($dailyRevenue->pluck('total_revenue')); ?>;

            console.log('Product Names:', productNames);
            console.log('Product Sales:', productSales);
            console.log('Daily Revenue Dates:', dailyRevenueDates);
            console.log('Daily Revenue Values:', dailyRevenueValues);

            var ctx1 = document.getElementById('dailyRecapChart').getContext('2d');
            var dailyRecapChart = new Chart(ctx1, {
                type: 'bar', // Change this to 'line' or other chart types if needed
                data: {
                    labels: productNames, // Product names
                    datasets: [{
                        label: 'Sales',
                        data: productSales, // Sales data
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

            var ctx2 = document.getElementById('dailyRevenueChart').getContext('2d');
            var dailyRevenueChart = new Chart(ctx2, {
                type: 'line', // Change this to 'bar' or other chart types if needed
                data: {
                    labels: dailyRevenueDates, // Dates
                    datasets: [{
                        label: 'Total Revenue',
                        data: dailyRevenueValues, // Total revenue data
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        x: {
                            type: 'time',
                            time: {
                                unit: 'day',
                                tooltipFormat: 'll'
                            },
                            title: {
                                display: true,
                                text: 'Date'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Total Revenue'
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html><?php /**PATH D:\Apps\laragon\www\ternakmart\resources\views/daily_recap.blade.php ENDPATH**/ ?>