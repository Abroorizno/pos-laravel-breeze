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
                    <table class="table-auto w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col">No. </th>
                                <th scope="col">Role Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($roles as $role)
                                <tr class="border-b border-gray-200">
                                    <td class="py-4">{{ $no++ }}. </td>
                                    <td class="py-4">{{ $role->name }}</td>
                                    <td class="py-4">{{ $role->description }}</td>
                                    <td class="py-4"><a href="{{ route('roles.update', $role->id) }}"
                                            class="">Edit</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
