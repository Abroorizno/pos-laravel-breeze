<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard SuperAdmin') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 flex justify-between">
                        <h1 class="text-2xl font-bold mb-4">Category Management</h1>
                        <button id="openAddCategoryModal"
                            class="bg-sky-500/100 hover:bg-sky-500/50 text-white px-4 py-2 rounded">Add
                            Category</button>
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No.</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Category Name</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Created At</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($categories as $category)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">
                                        {{ $no++ }}.</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $category->name_category }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $category->created_at }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                        <button data-target="edit-category-{{ $category->id }}"
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">Edit</button>
                                        <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded transition duration-200"
                                                id="delete">Delete</button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal Edit Role -->
                                <div id="edit-category-{{ $category->id }}"
                                    class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-20 hidden">
                                    <div class="bg-white p-6 rounded shadow-lg w-full max-w-xl">
                                        <h2 class="text-xl font-bold mb-4">Add New Category</h2>

                                        <form action="{{ route('category.update', $category->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-4">
                                                <label for="name"
                                                    class="block text-sm font-medium text-gray-700">Category
                                                    Name</label>
                                                <input type="text" id="name" name="name"
                                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-200"
                                                    value="{{ $category->name_category }}" required>
                                            </div>
                                            <div class="flex justify-end space-x-2">
                                                <button type="submit"
                                                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                                    Save
                                                </button>
                                                <button type="button" id="cancelDelete"
                                                    class="bg-gray-300 text-white px-4 py-2 rounded">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Role -->
    <div id="add-category" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-20 hidden">
        <div class="bg-white p-6 rounded shadow-lg w-full max-w-xl">
            <h2 class="text-xl font-bold mb-4">Add New Role</h2>

            <form action="{{ route('category.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                    <input type="text" id="name" name="name"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-200"
                        placeholder="Enter Category Name" required>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        Save
                    </button>
                    <button type="button" id="cancelDelete"
                        class="bg-gray-300 text-white px-4 py-2 rounded">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openAddUserBtn = document.getElementById('openAddCategoryModal');
            const modals = document.querySelectorAll('[id^="edit-category-"]');
            const cancelBtns = document.querySelectorAll('#cancelDelete');

            openAddUserBtn?.addEventListener('click', () => {
                const addRoleModal = document.getElementById('add-category');
                addRoleModal.classList.remove('hidden');
                addRoleModal.classList.add('flex');
            });

            modals.forEach(modal => {
                const openEditUserBtn = document.querySelector(`[data-target="${modal.id}"]`);
                openEditUserBtn?.addEventListener('click', () => {
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                });
            });

            cancelBtns.forEach(cancelBtn => {
                cancelBtn?.addEventListener('click', () => {
                    const modal = cancelBtn.closest('.fixed');
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                });
            });

            const cancelBtn = document.getElementById('cancelDelete');

            openBtn?.addEventListener('click', () => {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            });

            cancelBtn?.addEventListener('click', () => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            });
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addRoleForm = document.querySelector('#add-category form');

            addRoleForm?.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Success',
                    text: 'User Created!',
                    icon: 'success',
                    showConfirmButton: true,
                    confirmButtonText: 'OK',
                    allowOutsideClick: false,
                    timer: 2000 // Show the alert for 1 second
                }).then(() => {
                    addRoleForm.submit();
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('form button#delete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const form = this.closest('form');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: 'Deleted!',
                                text: 'The user has been deleted.',
                                icon: 'success',
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                form.submit();
                            });
                        }
                    });
                });
            });
        });
    </script>
</x-app-layout>
