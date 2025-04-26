<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard SuperAdmin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-center">
                        <h1 class="text-2xl font-bold">Welcome to the SuperAdmin Dashboard</h1>
                    </div>
                    <div class="flex justify-center mt-4">
                        <div class="text-center flex justify-center items-center gap-4">
                            <div class="mt-4 p-4 bg-blue-100 rounded-lg shadow-md">
                                <h2 class="text-xl font-semibold mb-3">Total Registered Users</h2>
                                <p class="text-2xl font-bold text-blue-600 mb-2">{{ \App\Models\User::count() }}
                                </p>
                                <a href="/getUser" class="text-blue-500 hover:underline">View Users</a>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block text-blue-500"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                            <div class="mt-4 p-4 bg-blue-100 rounded-lg shadow-md">
                                <h2 class="text-xl font-semibold mb-3">Total Registered Roles</h2>
                                <p class="text-2xl font-bold text-blue-600 mb-2">{{ \App\Models\Role::count() }}
                                </p>
                                <a href="/roles" class="text-blue-500 hover:underline">View Roles</a>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block text-blue-500"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </div>
                        {{-- <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        </div> --}}
                    </div>
                    <div class="flex justify-center mt-4 gap-4">
                        <div class="mt-4 p-4 bg-blue-100 rounded-lg shadow-md">
                            <h2 class="text-xl font-semibold mb-3">Total Registered Products</h2>
                            <p class="text-2xl font-bold text-blue-600 mb-2">{{ \App\Models\Product::count() }}
                            </p>
                            <a href="/products" class="text-blue-500 hover:underline">View Products</a>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block text-blue-500"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                        <div class="mt-4 p-4 bg-blue-100 rounded-lg shadow-md">
                            <p class="text-2xl font-bold text-blue-600 mb-2">
                            <div class="flex items-center gap-4">
                                @if (isset($product->product_photo))
                                    <img src="{{ asset('storage/' . $product->product_photo) }}"
                                        alt="{{ $product->product_name }}" class="w-16 h-16 object-cover rounded-full">
                                @else
                                    <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center">
                                        <span class="text-gray-500">No Image</span>
                                    </div>
                                @endif
                                <span>{{ $product->product_name ?? 'No Data' }}</span>
                            </div>
                            </p>
                            <br>
                            <a href="/pos" class="text-blue-500 hover:underline">Best Selling Product</a>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block text-blue-500"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                        <div class="mt-4 p-4 bg-blue-100 rounded-lg shadow-md">
                            <h2 class="text-xl font-semibold mb-3">Total Stock Available</h2>
                            <p class="text-2xl font-bold text-blue-600 mb-2">
                                {{ \App\Models\Product::sum('product_stock') }}
                            </p>
                            <a href="/products" class="text-blue-500 hover:underline">View Products</a>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block text-blue-500"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>

                        {{-- Tampilan Untuk Pimpinan --}}
                        {{-- <div class="bg-white rounded-2xl shadow-md overflow-hidden w-80">
                            @if (isset($product->product_photo))
                                <img src="{{ asset('storage/' . $product->product_photo) }}"
                                    alt="{{ $product->product_name }}" class="w-full h-52 object-cover">
                            @else
                                <div class="w-full h-52 bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-500">No Image</span>
                                </div>
                            @endif

                            @if (isset($product))
                                <div class="p-4">
                                    <div class="flex justify-between items-center">
                                        <p class="text-lg font-semibold truncate w-40">
                                            {{ $product->product_name ?? 'No Data' }}
                                        </p>
                                        <div class="ml-auto">
                                            <a href="/categories" class="text-blue-500 hover:underline">Best Selling Product</a>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block text-blue-500"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="p-4">
                                    <p class="text-lg font-semibold text-gray-500">No Product Data Available</p>
                                </div>
                            @endif
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
