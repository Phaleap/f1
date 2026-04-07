<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">My Orders</h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto px-4">
        @if($orders->isEmpty())
            <p class="text-gray-500">You have no orders yet.</p>
        @else
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr class="text-left">
                            <th class="px-4 py-3">Order #</th>
                            <th class="px-4 py-3">Date</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-right">Total</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr class="border-t">
                            <td class="px-4 py-3">#{{ $order->id }}</td>
                            <td class="px-4 py-3">{{ $order->created_at->format('M d, Y') }}</td>
                            <td class="px-4 py-3 capitalize">{{ $order->status }}</td>
                            <td class="px-4 py-3 text-right">${{ number_format($order->total, 2) }}</td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('orders.show', $order) }}" class="text-red-600 hover:underline">
                                    View →
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</x-app-layout>