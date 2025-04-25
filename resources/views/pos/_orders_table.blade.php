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
            <td class="border border-gray-300 px-4 py-2">
                {{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}
            </td>
            <td class="border border-gray-300 px-4 py-2">
                Rp.{{ number_format($order->orderDetails->order_subtotal, 0, ',', '.') }}
            </td>
            <td class="border border-gray-300 px-4 py-2">
                Rp.{{ number_format($order->payment_amount, 0, ',', '.') }}
            </td>
            <td class="border border-gray-300 px-4 py-2">
                {{ $order->order_status == 1 ? 'Paid' : 'Unpaid' }}
            </td>
            <td class="border border-gray-300 px-2 py-2 text-center">
                <button data-target="details-order-{{ $order->id }}"
                    class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-700 transition duration-200">Details</button>
            </td>
        </tr>
    @endforeach
@endif
