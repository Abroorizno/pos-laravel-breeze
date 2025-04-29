@if ($orders->isEmpty())
    <tr>
        <td colspan="7" class="text-center text-gray-500 py-4">No orders found for the selected date range.</td>
    </tr>
@else
    @php $no = 1; @endphp
    @foreach ($orders as $order)
        <tr class="border-b border-gray-200">
            <td class="border border-gray-300 px-4 py-2 text-center">{{ $no++ }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $order->order_code }}</td>

            {{-- Pastikan orderDetails dan product tersedia --}}
            <td class="border border-gray-300 px-4 py-2">
                {{ $order->orderDetails->product->product_name ?? '-' }}
            </td>

            <td class="border border-gray-300 px-4 py-2">
                {{ $order->orderDetails->qty ?? '-' }}
            </td>

            <td class="border border-gray-300 px-4 py-2">
                {{ optional($order->created_at)->format('d-m-Y') }}
            </td>

            <td class="border border-gray-300 px-4 py-2">
                Rp.{{ number_format($order->orderDetails->order_subtotal ?? 0, 0, ',', '.') }}
            </td>

            <td class="border border-gray-300 px-4 py-2">
                Rp.{{ number_format($order->payment_amount ?? 0, 0, ',', '.') }}
            </td>

            <td class="border border-gray-300 px-4 py-2">
                Rp.{{ number_format($order->order_change ?? 0, 0, ',', '.') }}
            </td>

            <td class="border border-gray-300 px-4 py-2">
                {{ $order->order_status == 1 ? 'Paid' : 'Unpaid' }}
            </td>
        </tr>
    @endforeach
    <tr class="font-bold bg-gray-100">
        <td colspan="5" class="border border-gray-300 px-4 py-2 text-right">Total Revenue :</td>
        <td colspan="6" class="border border-gray-300 px-4 py-2">
            Rp.{{ number_format($orders->sum(fn($order) => optional($order->orderDetails)->order_subtotal ?? 0), 0, ',', '.') }}
        </td>
    </tr>
@endif
