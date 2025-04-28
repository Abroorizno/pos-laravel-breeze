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
                            </div>
                            <div class="flex space-x-4 mt-4">
                                <div class="w-1/3">
                                    <label for="filter_type" class="block text-sm font-medium text-gray-700">Filter
                                        Type</label>
                                    <select id="filter_type"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-200">
                                        <option value="daily" selected>Daily</option>
                                        <option value="weekly">Weekly</option>
                                        <option value="monthly">Monthly</option>
                                    </select>
                                </div>
                                <div class="flex items-center mt-6">
                                    <button type="submit"
                                        class="bg-sky-500/100 hover:bg-sky-500/50 text-white px-4 py-2 rounded">Report</button>
                                </div>
                            </div>

                            {{-- <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const filterType = document.getElementById('filter_type');
                                    const startDateInput = document.getElementById('start_date');
                                    const endDateInput = document.getElementById('end_date');

                                    // Set default values to today
                                    const today = new Date();
                                    startDateInput.value = today.toISOString().split('T')[0];
                                    endDateInput.value = today.toISOString().split('T')[0];

                                    filterType.addEventListener('change', function() {
                                        let startDate;

                                        if (this.value === 'daily') {
                                            startDate = new Date(); // Create a new Date instance
                                        } else if (this.value === 'weekly') {
                                            const dayOfWeek = today.getDay();
                                            startDate = new Date(); // Create a new Date instance
                                            startDate.setDate(today.getDate() - dayOfWeek);
                                        } else if (this.value === 'monthly') {
                                            startDate = new Date(today.getFullYear(), today.getMonth(), 1);
                                        }

                                        if (startDate) {
                                            startDateInput.value = startDate.toISOString().split('T')[0];
                                        }
                                        // Always set end date to today
                                        endDateInput.value = today.toISOString().split('T')[0];
                                    });
                                });
                            </script> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-full mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-bold">Report Sales</h2>
                            <div class="flex space-x-2">
                                <button onclick="printTable()"
                                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Print</button>
                                <button onclick="exportToExcel()"
                                    class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Export to
                                    Excel</button>
                            </div>
                        </div>
                        <table class="table-auto w-full border-collapse border border-gray-300">
                            <thead class="bg-gray-500 text-white">
                                <tr>
                                    <th class="border border-gray-300 px-4 py-2">No.</th>
                                    <th class="border border-gray-300 px-4 py-2">Order Code</th>
                                    <th class="border border-gray-300 px-4 py-2">Product Name</th>
                                    <th class="border border-gray-300 px-4 py-2">Qty</th>
                                    <th class="border border-gray-300 px-4 py-2">Order Date</th>
                                    <th class="border border-gray-300 px-4 py-2">Subtotal</th>
                                    <th class="border border-gray-300 px-4 py-2">Amount</th>
                                    <th class="border border-gray-300 px-4 py-2">Change</th>
                                    <th class="border border-gray-300 px-4 py-2">Status</th>
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


        {{-- <script>
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
        </script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
        <script>
            function exportToExcel() {
                const tableContent = document.querySelector('.table-auto');
                const rows = Array.from(tableContent.rows).map(row =>
                    Array.from(row.cells).map(cell => cell.innerText)
                );
                const worksheet = XLSX.utils.aoa_to_sheet(rows);
                const workbook = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(workbook, worksheet, 'Report');
                XLSX.writeFile(workbook, 'report.xlsx');
            }
        </script>

        <script>
            function printTable() {
                const tableContent = document.querySelector('.table-auto').outerHTML;
                const printWindow = window.open('', '_blank');
                printWindow.document.open();
                printWindow.document.write(`
                                    <html>
                                    <head>
                                        <title>Print Table</title>
                                        <style>
                                        table {
                                            width: 100%;
                                            border-collapse: collapse;
                                        }
                                        th, td {
                                            border: 1px solid #ddd;
                                            padding: 8px;
                                            text-align: left;
                                        }
                                        th {
                                            background-color: #f4f4f4;
                                        }
                                        </style>
                                    </head>
                                    <body>
                                        ${tableContent}
                                    </body>
                                    </html>
                                `);
                printWindow.document.close();
                printWindow.print();
            }
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.querySelector('#reportForm');
                const searchResultsTable = document.querySelector('#ordersTableBody');
                const filterType = document.getElementById('filter_type');
                const startDateInput = document.getElementById('start_date');
                const endDateInput = document.getElementById('end_date');

                // Set default date (today) saat halaman dimuat
                const today = new Date();
                const todayStr = today.toISOString().split('T')[0];
                startDateInput.value = todayStr;
                endDateInput.value = todayStr;

                // Event untuk filter (daily, weekly, monthly)
                filterType.addEventListener('change', function() {
                    let startDate = new Date(today); // Default clone today

                    if (this.value === 'daily') {
                        startDate = new Date(today);
                    } else if (this.value === 'weekly') {
                        const dayOfWeek = today.getDay(); // 0 (Minggu) sampai 6 (Sabtu)
                        startDate.setDate(today.getDate() - dayOfWeek - 7); // Set ke awal minggu
                    } else if (this.value === 'monthly') {
                        startDate = new Date(today.getFullYear(), today.getMonth(), 1); // Awal bulan
                    }

                    startDateInput.value = startDate.toISOString().split('T')[0];
                    endDateInput.value = todayStr;
                });

                // Submit form pakai fetch
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const startDate = startDateInput.value;
                    const endDate = endDateInput.value;
                    const url = form.action + '?start_date=' + startDate + '&end_date=' + endDate;
                    console.log('URL:', url);

                    fetch(url, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
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
