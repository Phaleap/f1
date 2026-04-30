@extends('admin.layouts.admin')

@section('title', 'User — ' . $user->full_name)
@section('page-title', 'Users')
@section('breadcrumb')
    <span>›</span> <a href="{{ route('admin.users.index') }}">Users</a>
    <span>›</span> <span>{{ $user->full_name }}</span>
@endsection

@section('content')

<div class="page-header">
    <div>
        <div class="page-title">{{ $user->full_name }}</div>
        <div class="page-sub">{{ $user->email }}</div>
    </div>
    <div style="display:flex; gap:8px;">
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">← Back</a>
        <form method="POST" action="{{ route('admin.users.toggle-status', $user->id) }}">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn {{ $user->status === 'active' ? 'btn-danger' : 'btn-primary' }}">
                {{ $user->status === 'active' ? 'Deactivate' : 'Activate' }}
            </button>
        </form>
    </div>
</div>

<div style="display:grid; grid-template-columns:1fr 2fr; gap:20px; align-items:start;">

    {{-- Left: Info --}}
    <div style="display:flex; flex-direction:column; gap:16px;">
        <div class="card">
            <div class="card-header"><span class="card-title">Profile</span></div>
            <div class="card-body" style="display:flex; flex-direction:column; gap:12px;">
                <div style="display:flex; flex-direction:column; gap:4px;">
                    <span style="font-size:0.72rem; color:var(--gray-400); text-transform:uppercase; letter-spacing:0.05em;">Full Name</span>
                    <span style="font-weight:500;">{{ $user->full_name }}</span>
                </div>
                <div style="display:flex; flex-direction:column; gap:4px;">
                    <span style="font-size:0.72rem; color:var(--gray-400); text-transform:uppercase; letter-spacing:0.05em;">Email</span>
                    <span>{{ $user->email }}</span>
                </div>
                <div style="display:flex; flex-direction:column; gap:4px;">
                    <span style="font-size:0.72rem; color:var(--gray-400); text-transform:uppercase; letter-spacing:0.05em;">Phone</span>
                    <span>{{ $user->phone ?? '—' }}</span>
                </div>
                <div style="display:flex; flex-direction:column; gap:4px;">
                    <span style="font-size:0.72rem; color:var(--gray-400); text-transform:uppercase; letter-spacing:0.05em;">Role</span>
                    @if($user->role)
                        <span class="badge badge-blue" style="align-self:start;">{{ $user->role->role_name }}</span>
                    @else
                        <span class="badge badge-gray" style="align-self:start;">No role</span>
                    @endif
                </div>
                <div style="display:flex; flex-direction:column; gap:4px;">
                    <span style="font-size:0.72rem; color:var(--gray-400); text-transform:uppercase; letter-spacing:0.05em;">Status</span>
                    @if($user->status === 'active')
                        <span class="badge badge-green" style="align-self:start;">Active</span>
                    @else
                        <span class="badge badge-red" style="align-self:start;">Inactive</span>
                    @endif
                </div>
                <div style="display:flex; flex-direction:column; gap:4px;">
                    <span style="font-size:0.72rem; color:var(--gray-400); text-transform:uppercase; letter-spacing:0.05em;">Joined</span>
                    <span>{{ $user->created_at->format('d M Y, H:i') }}</span>
                </div>
            </div>
        </div>

        {{-- Addresses --}}
        @if($user->addresses && $user->addresses->count())
        <div class="card">
            <div class="card-header"><span class="card-title">Addresses</span></div>
            <div class="card-body" style="display:flex; flex-direction:column; gap:12px;">
                @foreach($user->addresses as $address)
                <div style="font-size:0.83rem; color:var(--gray-700); line-height:1.6; padding-bottom:10px; border-bottom:1px solid var(--gray-100);">
                    <div style="font-weight:500;">{{ $address->recipient_name ?? $user->full_name }}</div>
                    <div>{{ $address->address_line1 }}</div>
                    @if($address->address_line2)<div>{{ $address->address_line2 }}</div>@endif
                    <div>{{ $address->city }}, {{ $address->province }}</div>
                    <div>{{ $address->postal_code }}</div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    {{-- Right: Orders --}}
    <div>
        <div class="card">
            <div class="card-header">
                <span class="card-title">Orders</span>
                <span style="font-size:0.78rem; color:var(--gray-400);">{{ $user->orders->count() }} total</span>
            </div>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($user->orders as $order)
                        <tr>
                            <td style="font-weight:500;">#{{ $order->order_id }}</td>
                            <td style="color:var(--gray-400);">{{ $order->order_date ? \Carbon\Carbon::parse($order->order_date)->format('d M Y') : '—' }}</td>
                            <td>${{ number_format($order->total_amount, 2) }}</td>
                            <td>
                                @php
                                    $statusClass = match($order->order_status) {
                                        'completed', 'delivered' => 'badge-green',
                                        'cancelled' => 'badge-red',
                                        'pending' => 'badge-yellow',
                                        'processing', 'shipped' => 'badge-blue',
                                        default => 'badge-gray',
                                    };
                                @endphp
                                <span class="badge {{ $statusClass }}">{{ ucfirst($order->order_status) }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" style="text-align:center; color:var(--gray-400); padding:30px;">No orders yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

@endsection