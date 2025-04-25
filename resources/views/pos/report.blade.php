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
                        <h1 class="text-2xl font-bold mb-4">POS Report</h1>
                        <form action="{{ route('report-search') }}" method="GET" class="mb-4" id="reportForm">
                            <div class="flex space-x-4">
                                <div class="w-1/2">
                                    <label for="start_date" class="block text-sm font-medium text-gray-700">Start
                                        Date</label>
                                    <input type="date" name="start_date" id="start_date"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-200"
                                        required>
                                </div>
                                <div class="w-1/2">
                                    <label for="end_date" class="block text-sm font-medium text-gray-700">End
                                        Date</label>
                                    <input type="date" name="end_date" id="end_date"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-200"
                                        value="{{ request('end_date', \Carbon\Carbon::now()->format('Y-m-d')) }}"
                                        required>
                                </div>
                                <div class="flex items-center mt-6">
                                    <button type="submit"
                                        class="bg-sky-500/100 hover:bg-sky-500/50 text-white px-4 py-2 rounded">Report</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h2 class="text-xl font-bold mb-4">Search Results</h2>
                        @if ($orders->isEmpty())
                            <p class="text-gray-600">No orders found for the selected date range.</p>
                        @else
                            <table class="table-auto w-full border-collapse border border-gray-300">
                                <thead class="bg-gray-500 text-white">
                                    <tr>
                                        <th class="border border-gray-300 px-4 py-2">No.</th>
                                        <th class="border border-gray-300 px-4 py-2">Order Code</th>
                                        <th class="border border-gray-300 px-4 py-2">Order Date</th>
                                        <th class="border border-gray-300 px-4 py-2">Subtotal</th>
                                        <th class="border border-gray-300 px-4 py-2">Amount</th>
                                        <th class="border border-gray-300 px-4 py-2">Status</th>
                                        <th class="border border-gray-300 px-4 py-2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @foreach ($orders as $order)
                                        <tr class="border-b border-gray-200">
                                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $no++ }}
                                            </td>
                                            <td class="border border-gray-300 px-4 py-2">{{ $order->order_code }}</td>
                                            <td class="border border-gray-300 px-4 py-2">
                                                {{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</td>
                                            <td class="border border-gray-300 px-4 py-2">
                                                Rp.{{ number_format($order->orderDetails->order_subtotal, 0, ',', '.') }}
                                            </td>
                                            <td class="border border-gray-300 px-4 py-2">
                                                Rp.{{ number_format($order->payment_amount, 0, ',', '.') }}</td>
                                            <td class="border border-gray-300 px-4 py-2">
                                                {{ $order->order_status == 1 ? 'Paid' : 'Unpaid' }}</td>
                                            <td class="border border-gray-300 px-2 py-2 text-center">
                                                <button data-target="details-order-{{ $order->id }}"
                                                    class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-700 transition duration-200">Details</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h2 class="text-xl font-bold mb-4">Search Results</h2>
                        <table class="table-auto w-full border-collapse border border-gray-300">
                            <thead class="bg-gray-500 text-white">
                                <tr>
                                    <th class="border border-gray-300 px-4 py-2">No.</th>
                                    <th class="border border-gray-300 px-4 py-2">Order Code</th>
                                    <th class="border border-gray-300 px-4 py-2">Order Date</th>
                                    <th class="border border-gray-300 px-4 py-2">Subtotal</th>
                                    <th class="border border-gray-300 px-4 py-2">Amount</th>
                                    <th class="border border-gray-300 px-4 py-2">Status</th>
                                    <th class="border border-gray-300 px-4 py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody id="ordersTableBody">
                                @include('pos._orders_table', ['orders' => $orders ?? collect()])
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit Role -->
        @foreach ($orders as $order)
            <div id="details-order-{{ $order->id }}"
                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-20 hidden">
                <div class="bg-white p-6 rounded shadow-lg w-full max-w-xl">
                    <h2 class="text-xl font-bold mb-4">Order Details</h2>

                    {{-- Order Info --}}
                    <div class="mb-4 flex space-x-4">
                        <div class="w-1/2">
                            <label class="block text-sm font-medium text-gray-700">Order
                                Code</label>
                            <input type="text"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-200"
                                value="{{ $order->order_code }}" readonly>
                        </div>
                        <div class="w-1/2">
                            <label class="block text-sm font-medium text-gray-700">Order
                                Date</label>
                            <input type="text"
                                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-200"
                                value="{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}" readonly>
                        </div>
                    </div>

                    {{-- Product Table --}}
                    <h2 class="text-lg font-semibold mb-4">Product Details</h2>
                    <table class="table-auto w-full border-collapse border border-gray-300 mb-4">
                        <thead class="bg-gray-500 text-white">
                            <tr>
                                <th class="border px-4 py-2">Product</th>
                                <th class="border px-4 py-2">Qty</th>
                                <th class="border px-4 py-2">Subtotal</th>
                                <th class="border px-4 py-2">Amount</th>
                                <th class="border px-4 py-2">Change</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="border px-4 py-2">
                                    {{ $order->orderDetails->product->product_name ?? 'N/A' }}
                                </td>
                                <td class="border px-4 py-2">
                                    {{ $order->orderDetails->qty }}
                                </td>
                                <td class="border px-4 py-2">
                                    Rp.{{ number_format($order->orderDetails->order_subtotal, 0, ',', '.') }}
                                </td>
                                <td class="border px-4 py-2">
                                    Rp.{{ number_format($order->payment_amount, 0, ',', '.') }}
                                </td>
                                <td class="border px-4 py-2">
                                    Rp.{{ number_format($order->order_change, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    {{-- Actions --}}
                    <div class="flex justify-end space-x-2">
                        <button type="button" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Print
                        </button>
                        <button type="button" class="bg-gray-300 text-black px-4 py-2 rounded"
                            onclick="document.getElementById('details-order-{{ $order->id }}').classList.add('hidden')">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        @endforeach


        <script>
            // document.addEventListener('DOMContentLoaded', function() {
            //     const form = document.querySelector('#reportForm');
            //     const searchResultsTable = document.querySelector('table.table-auto tbody');

            //     form.addEventListener('submit', function(e) {
            //         e.preventDefault();

            //         const startDate = document.querySelector('#start_date').value;
            //         const endDate = document.querySelector('#end_date').value;

            //         const url = form.action + '?start_date=' + startDate + '&end_date=' + endDate;

            //         fetch(url)
            //             .then(response => response.text())
            //             .then(data => {
            //                 searchResultsTable.innerHTML = data; // only replace <tbody> content
            //                 console.log('Data fetched successfully');
            //             })
            //             .catch(error => {
            //                 console.error('Error fetching data:', error);
            //             });
            //     });
            // });

            document.addEventListener('DOMContentLoaded', function() {
                const form = document.querySelector('#reportForm');
                const searchResultsTable = document.querySelector('#ordersTableBody');

                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const startDate = document.querySelector('#start_date').value;
                    const endDate = document.querySelector('#end_date').value;
                    const url = form.action + '?start_date=' + startDate + '&end_date=' + endDate;

                    fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest' // penting agar `$request->ajax()` true
                            }
                        })
                        .then(response => response.text())
                        .then(data => {
                            searchResultsTable.innerHTML = data;
                        })
                        .catch(error => {
                            console.error('Error fetching data:', error);
                        });
                });
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const openAddUserBtn = document.getElementById('openAddProductModal');
                const modals = document.querySelectorAll('[id^="details-order-"]');
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

                // openBtn?.addEventListener('click', () => {
                //     modal.classList.remove('hidden');
                //     modal.classList.add('flex');
                // });

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
