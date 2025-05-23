<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard SuperAdmin') }}
        </h2>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4 flex justify-between">
                        <h1 class="text-2xl font-bold mb-4">Product Management</h1>
                        @if (auth()->user()->role == 1)
                            <button id="openAddProductModal"
                                class="bg-sky-500/100 hover:bg-sky-500/50 text-white px-4 py-2 rounded">Add
                                Product</button>
                        @elseif (auth()->user()->role == 3)
                            <button onclick="window.history.back()"
                                class="bg-sky-500/100 hover:bg-sky-500/50 text-white px-4 py-2 rounded">Back</button>
                        @endif
                    </div>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No.</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Photo</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Product Name</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Category Name</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Product Code</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Price</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Stock</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Description</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Created At</th>
                                @if (auth()->user()->role == 1)
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($products as $product)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $no++ }}.
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <img src="{{ asset('storage/' . $product->product_photo) }}" alt="Product Image"
                                            class="w-24 h-24 object-cover rounded-md">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $product->product_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $product->category->name_category }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $product->product_code }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        Rp. {{ number_format($product->product_price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div>{{ $product->product_stock }}</div>
                                        @if (auth()->user()->role == 1 || auth()->user()->role == 3)
                                            <form action="{{ route('addStock', $product->id) }}" method="POST"
                                                class="flex items-center mt-2">
                                                @csrf
                                                <input type="number" name="stock" min="1"
                                                    class="border border-gray-300 rounded-md p-1 w-16 mr-2"
                                                    placeholder="Add">
                                                <button type="submit"
                                                    class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-700 transition duration-200">Add</button>
                                            </form>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $product->product_description }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                        {{ $product->product_stock == 0 ? 'bg-red-200 text-red-800' : 'bg-green-200 text-green-800' }}">
                                            {{ $product->product_stock == 0 ? 'No Available' : 'Available' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $product->created_at->format('Y-m-d') }}</td>
                                    @if (auth()->user()->role == 1)
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            <button data-target="edit-product-{{ $product->id }}"
                                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">Edit</button>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                                class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded transition duration-200"
                                                    id="delete">Delete</button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>

                                <!-- Modal Edit Role -->
                                <div id="edit-product-{{ $product->id }}"
                                    class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-20 hidden">
                                    <div class="bg-white p-6 rounded shadow-lg w-full max-w-xl">
                                        <h2 class="text-xl font-bold mb-4">Add New Category</h2>

                                        <form action="{{ route('products.update', $product->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="flex justify-center">
                                                <img src="{{ asset('storage/' . $product->product_photo) }}"
                                                    alt="Product Image" class="w-16 h-16 object-cover">
                                            </div>
                                            <div class="mb-4">
                                                <label for="photo"
                                                    class="block text-sm font-medium text-gray-700">Photo</label>
                                                <input type="file" id="photo" name="photo"
                                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-200">
                                            </div>
                                            <div class="mb-4">
                                                <label for="name"
                                                    class="block text-sm font-medium text-gray-700">Product
                                                    Name</label>
                                                <input type="text" id="name" name="name"
                                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-200"
                                                    value="{{ $product->product_name }}" required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="category"
                                                    class="block text-sm font-medium text-gray-700">Category
                                                    Name</label>
                                                <select id="category" name="category"
                                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-200">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                            {{ $category->name_category }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-4">
                                                <label for="price"
                                                    class="block text-sm font-medium text-gray-700">Price</label>
                                                <input type="number" id="price" name="price"
                                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-200"
                                                    value="{{ $product->product_price }}" required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="stock"
                                                    class="block text-sm font-medium text-gray-700">Stock</label>
                                                <input type="number" id="stock" name="stock"
                                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-200"
                                                    value="{{ $product->product_stock }}" required>
                                            </div>
                                            <div class="mb-4">
                                                <label for="description"
                                                    class="block text-sm font-medium text-gray-700">Description</label>
                                                <textarea id="description" name="description"
                                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-200" required>{{ $product->product_description }}</textarea>
                                            </div>
                                            <div class="mb-4">
                                                <label class="block text-sm font-medium text-gray-700">Is
                                                    Active</label>
                                                <div class="flex flex-col space-y-2">
                                                    <label class="inline-flex items-center">
                                                        <input type="radio" name="is_active" value="1"
                                                            class="form-radio text-blue-600"
                                                            {{ $product->is_active == 1 ? 'checked' : '' }}>
                                                        <span class="ml-2">Publish</span>
                                                    </label>
                                                    <label class="inline-flex items-center">
                                                        <input type="radio" name="is_active" value="0"
                                                            class="form-radio text-blue-600"
                                                            {{ $product->is_active == 0 ? 'checked' : '' }}>
                                                        <span class="ml-2">Draft</span>
                                                    </label>
                                                </div>
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
    <div id="add-product" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-20 hidden">
        <div class="bg-white p-6 rounded shadow-lg w-full max-w-xl">
            <h2 class="text-xl font-bold mb-4">Add New Product</h2>

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="photo" class="block text-sm font-medium text-gray-700">Photo</label>
                    <input type="file" id="photo" name="photo"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-200">
                </div>
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Product
                        Name</label>
                    <input type="text" id="name" name="name"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-200"
                        placeholder="Input Product Name" required>
                </div>
                <div class="mb-4">
                    <label for="category" class="block text-sm font-medium text-gray-700">Category
                        Name</label>
                    <select id="category" name="category"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-200">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name_category }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" id="price" name="price"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-200"
                        placeholder="Input Product Price" required>
                </div>
                <div class="mb-4">
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                    <input type="number" id="stock" name="stock"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-200"
                        placeholder="Input Product Stock" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="description" name="description"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-200" required></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Is Active</label>
                    <div class="flex flex-col space-y-2">
                        <label class="inline-flex items-center">
                            <input type="radio" name="is_active" value="1" class="form-radio text-blue-600"
                                checked>
                            <span class="ml-2">Publish</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="is_active" value="0" class="form-radio text-blue-600">
                            <span class="ml-2">Draft</span>
                        </label>
                    </div>
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
            const openAddUserBtn = document.getElementById('openAddProductModal');
            const modals = document.querySelectorAll('[id^="edit-product-"]');
            const cancelBtns = document.querySelectorAll('#cancelDelete');

            openAddUserBtn?.addEventListener('click', () => {
                const addRoleModal = document.getElementById('add-product');
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
            const addRoleForm = document.querySelector('#add-product form');

            addRoleForm?.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Success',
                    text: 'Product Created!',
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
