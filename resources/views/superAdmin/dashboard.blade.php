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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
