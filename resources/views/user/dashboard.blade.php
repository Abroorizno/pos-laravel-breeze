<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <!-- Sales Card -->
                    <div class="dashboard-card bg-white rounded-xl p-6 flex flex-col justify-between">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 text-sm font-medium mb-4">Today's Sales</p>
                                <h2 class="text-2xl font-bold text-gray-800 mt-1">
                                    Rp {{ number_format($todayOrderSubtotal, 0, ',', '.') }}</h2>
                            </div>
                            <div class="bg-indigo-100 p-3 rounded-lg text-indigo-600">
                                <i class="fas fa-shopping-cart text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="/report" class="text-blue-500 hover:underline">View Sales</a>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block text-blue-500"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>

                    <!-- Orders Card -->
                    <div class="dashboard-card bg-white rounded-xl p-6 flex flex-col justify-between">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 text-sm font-medium mb-4">New Orders</p>
                                <h2 class="text-2xl font-bold text-gray-800 mt-1">
                                    {{ \App\Models\OrderDetails::whereDate('created_at', today())->count() }}</h2>
                            </div>
                            <div class="bg-green-100 p-3 rounded-lg text-green-600">
                                <i class="fas fa-clipboard-list text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="/products" class="text-blue-500 hover:underline">View Products</a>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block text-blue-500"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>

                    <!-- Inventory Card -->
                    <div class="dashboard-card bg-white rounded-xl p-6 flex flex-col justify-between">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-gray-500 text-sm font-medium">Low Stock Items</p>
                                <h2 class="text-2xl font-bold text-gray-800 mt-1">
                                    {{ \App\Models\Product::sum('product_stock') }}</h2>
                                @if (\App\Models\Product::where('product_stock', '<', 10)->exists())
                                    <p class="text-yellow-500 text-sm mt-2 flex items-center">
                                        <i class="fas fa-exclamation-triangle mr-1"></i> Needs attention
                                    </p>
                                @else
                                    <p class="text-green-500 text-sm mt-2 flex items-center">
                                        <i class="fas fa-check-circle mr-1"></i> All good
                                    </p>
                                @endif
                            </div>
                            <div class="bg-yellow-100 p-3 rounded-lg text-yellow-600">
                                <i class="fas fa-boxes text-xl"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <a href="/products" class="text-blue-500 hover:underline">View Products</a>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block text-blue-500"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>

                    <!-- Customers Card -->
                    <div class="dashboard-card bg-white rounded-xl p-6 flex flex-col justify-between">
                        <div class="flex justify-between items-start">
                            <div class="flex items-center gap-4">
                                @if (isset($product->product_photo))
                                    <div class="flex items-center gap-4">
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ $product->product_name }}
                                            </h3>
                                            <p class="text-red-500">
                                                Best Seller</p>
                                        </div>
                                        <img src="{{ asset('storage/' . $product->product_photo) }}"
                                            class="w-32 h-32 object-cover rounded-lg">
                                    </div>
                                @else
                                    <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center">
                                        <span class="text-gray-500">No Image</span>
                                    </div>
                                @endif
                                {{-- <span>{{ $product->product_name ?? 'No Data' }}</span> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dashboard-card bg-white rounded-xl p-6 col-span-2">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-semibold text-gray-800">Sales Overview</h3>
                        <div class="flex space-x-2">
                            <button id="dailyBtn"
                                class="px-3 py-1 text-xs bg-indigo-100 text-indigo-600 rounded-full">Daily</button>
                            <button id="weeklyBtn"
                                class="px-3 py-1 text-xs bg-gray-100 text-gray-600 rounded-full">Weekly</button>
                            <button id="monthlyBtn"
                                class="px-3 py-1 text-xs bg-gray-100 text-gray-600 rounded-full">Monthly</button>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const salesCtx = document.getElementById('salesChart').getContext('2d');

            // Data untuk chart
            const dailyData = [5, 12, 18, 25, 30, 35];
            const weeklyData = [50, 75, 90, 110, 130, 150];
            const monthlyData = [200, 300, 400, 550, 700, 800];

            // Chart awal
            const salesChart = new Chart(salesCtx, {
                type: 'line',
                data: {
                    labels: ['6AM', '9AM', '12PM', '3PM', '6PM', '9PM'],
                    datasets: [{
                        label: 'Orders',
                        data: dailyData,
                        backgroundColor: 'rgba(34, 197, 94, 0.1)',
                        borderColor: 'rgba(34, 197, 94, 1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: 'rgba(34, 197, 94, 1)',
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                callback: function(value) {
                                    return value + ' orders';
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Fungsi untuk update data chart
            function updateChart(data) {
                salesChart.data.datasets[0].data = data;
                salesChart.update();
            }

            // Event listener untuk tombol-tombol
            document.getElementById('dailyBtn').addEventListener('click', function() {
                updateChart(dailyData);
            });

            document.getElementById('weeklyBtn').addEventListener('click', function() {
                updateChart(weeklyData);
            });

            document.getElementById('monthlyBtn').addEventListener('click', function() {
                updateChart(monthlyData);
            });
        });
    </script>
</x-app-layout>
