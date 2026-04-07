<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Order #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto px-4 space-y-6">

        @if(session('success'))
            <div class="bg-green-100 text-green-800 rounded px-4 py-3">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h3 class="font-semibold text-lg mb-4">Order Details</h3>
            <div class="grid grid-cols-2 gap-2 text-sm">
                <span class="text-gray-500">Status</span>
                <span class="capitalize font-medium">{{ $order->status }}</span>
                <span class="text-gray-500">Name</span>
                <span>{{ $order->name }}</span>
                <span class="text-gray-500">Email</span>
                <span>{{ $order->email }}</span>
                <span class="text-gray-500">Address</span>
                <span>{{ $order->address }}, {{ $order->city }}</span>
                <span class="text-gray-500">Total</span>
                <span class="font-semibold">${{ number_format($order->total, 2) }}</span>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h3 class="font-semibold text-lg mb-4">Items Ordered</h3>
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b text-left">
                        <th class="pb-2">Product</th>
                        <th class="pb-2">Qty</th>
                        <th class="pb-2 text-right">Price</th>
                        <th class="pb-2 text-right">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr class="border-b">
                        <td class="py-2">{{ $item->product->name }}</td>
                        <td class="py-2">{{ $item->quantity }}</td>
                        <td class="py-2 text-right">${{ number_format($item->price, 2) }}</td>
                        <td class="py-2 text-right">${{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="text-right">
            <a href="{{ route('orders.index') }}" class="text-red-600 hover:underline">
                View all orders →
            </a>
        </div>
    </div>
</x-app-layout>