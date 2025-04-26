<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
                    <div class="p-6 bg-red-100 rounded-lg shadow-md text-center">
                        <h2 class="text-xl font-semibold mb-3">Inactive Products with Zero Stock</h2>
                        <ul class="text-left">
                            @forelse (\App\Models\Product::where('is_active', 0)->get() as $product)
                                <li class="mb-2">
                                    <span class="font-bold">{{ $product->product_name }}</span> -
                                    Stock : <span class="text-red-500">{{ $product->product_stock }}</span> -
                                    Active : <span class="text-gray-500">{{ $product->is_active ? 'Yes' : 'No' }}</span>
                                </li>
                            @empty
                                <li class="text-gray-500">No inactive products found.</li>
                            @endforelse
                        </ul>
                        <a href="/products" class="text-red-500 hover:underline flex items-center justify-center mt-4">
                            Manage Products
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1 text-red-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                    <div class="p-6 bg-blue-100 rounded-lg shadow-md text-center">
                        <h2 class="text-xl font-semibold mb-3">Total Stock Available</h2>
                        <p class="text-3xl font-bold text-blue-600 mb-4">
                            {{ \App\Models\Product::sum('product_stock') }}
                        </p>
                        <a href="/products" class="text-blue-500 hover:underline flex items-center justify-center">
                            View Products
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1 text-blue-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                    <div class="p-6 bg-green-100 rounded-lg shadow-md text-center">
                        <h2 class="text-xl font-semibold mb-3">Total Orders</h2>
                        <p class="text-3xl font-bold text-green-600 mb-4">
                            {{ \App\Models\Orders::count() }}
                        </p>
                        <a href="/report" class="text-green-500 hover:underline flex items-center justify-center">
                            View Orders
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1 text-green-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
