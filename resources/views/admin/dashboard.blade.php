@extends('admin.layouts.admin')
@section('page-title', 'Dashboard')

@section('content')

{{-- ── Stats Grid ── --}}
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon red">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M20 7H4a1 1 0 00-1 1v11a1 1 0 001 1h16a1 1 0 001-1V8a1 1 0 00-1-1z"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/></svg>
        </div>
        <div class="stat-label">Total Products</div>
        <div class="stat-value">{{ $stats['total_products'] }}</div>
        <div class="stat-sub">{{ $stats['total_cars'] }} cars · {{ $stats['total_merchandise'] }} merch</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/></svg>
        </div>
        <div class="stat-label">Orders</div>
        <div class="stat-value">{{ $stats['total_orders'] }}</div>
        <div class="stat-sub">{{ $stats['pending_orders'] }} pending</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
        </div>
        <div class="stat-label">Users</div>
        <div class="stat-value">{{ $stats['total_users'] }}</div>
        <div class="stat-sub">Active accounts</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orange">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
        </div>
        <div class="stat-label">Teams & Drivers</div>
        <div class="stat-value">{{ $stats['total_teams'] }}</div>
        <div class="stat-sub">{{ $stats['total_drivers'] }} drivers</div>
    </div>
</div>

{{-- ── Charts Row ── --}}
<div style="display:grid; grid-template-columns: 1fr 360px; gap: 20px; margin-bottom: 20px;">

    {{-- Orders Bar Chart --}}
    <div class="card">
        <div class="card-header">
            <div>
                <span class="card-title">Orders Over Time</span>
                <span style="font-size:0.7rem; color:var(--gray-400); margin-left:8px;">Last 7 days</span>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">View all</a>
        </div>
        <div class="card-body" style="padding: 20px 20px 12px;">
            @php
                use Carbon\Carbon;
                $days        = collect(range(6, 0))->map(fn($i) => Carbon::today()->subDays($i));
                $labels      = $days->map(fn($d) => $d->format('D, M j'))->toArray();
                $labelsShort = $days->map(fn($d) => $d->format('D'))->toArray();
                $counts      = $days->map(fn($d) => $ordersByDay[$d->toDateString()] ?? 0)->toArray();
                $totalWeek   = array_sum($counts);
                $yesterday   = $ordersByDay[Carbon::yesterday()->toDateString()] ?? 0;
            @endphp

            {{-- Summary strip --}}
            <div style="display:flex; gap:28px; margin-bottom:16px;">
                <div>
                    <div style="font-size:1.4rem; font-weight:600; color:var(--gray-900); line-height:1;">{{ $totalWeek }}</div>
                    <div style="font-size:0.68rem; color:var(--gray-400); margin-top:3px; text-transform:uppercase; letter-spacing:0.05em;">This week</div>
                </div>
                <div>
                    <div style="font-size:1.4rem; font-weight:600; color:var(--gray-900); line-height:1;">{{ $yesterday }}</div>
                    <div style="font-size:0.68rem; color:var(--gray-400); margin-top:3px; text-transform:uppercase; letter-spacing:0.05em;">Yesterday</div>
                </div>
            </div>

            <div style="position:relative; height:190px;">
                <canvas id="ordersBarChart"></canvas>
            </div>
        </div>
    </div>

    {{-- Car Requests Pie Chart --}}
    <div class="card">
        <div class="card-header">
            <span class="card-title">Car Requests</span>
            <a href="{{ route('admin.car-requests.index') }}" class="btn btn-secondary btn-sm">View all</a>
        </div>
        <div class="card-body" style="display:flex; flex-direction:column; align-items:center; gap:20px;">

            @php
                $pending  = $carRequestStats['pending']  ?? 0;
                $approved = $carRequestStats['approved'] ?? 0;
                $rejected = $carRequestStats['rejected'] ?? 0;
                $total    = $pending + $approved + $rejected;
            @endphp

            @if($total === 0)
                <div style="padding:48px 0; color:var(--gray-400); font-size:0.8rem; text-align:center;">
                    <svg width="32" height="32" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.3" style="opacity:0.3;display:block;margin:0 auto 8px;"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2"/><path d="M12 12h.01M12 16h.01"/></svg>
                    No car requests yet
                </div>
            @else
                <div style="position:relative; width:160px; height:160px; flex-shrink:0;">
                    <canvas id="carRequestsPie" width="160" height="160"></canvas>
                    <div style="position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;pointer-events:none;">
                        <span style="font-size:1.4rem;font-weight:600;color:var(--gray-900);line-height:1;">{{ $total }}</span>
                        <span style="font-size:0.6rem;font-weight:500;color:var(--gray-400);letter-spacing:0.05em;text-transform:uppercase;margin-top:2px;">Total</span>
                    </div>
                </div>

                <div style="width:100%; display:flex; flex-direction:column; gap:10px;">
                    <div class="req-legend-row">
                        <span class="req-dot" style="background:#f97316;"></span>
                        <span class="req-legend-label">Pending</span>
                        <span class="req-legend-bar-wrap">
                            <span class="req-legend-bar" style="width:{{ $total > 0 ? round($pending/$total*100) : 0 }}%; background:#f97316;"></span>
                        </span>
                        <span class="req-legend-count">{{ $pending }}</span>
                        <span class="req-legend-pct">{{ $total > 0 ? round($pending/$total*100) : 0 }}%</span>
                    </div>
                    <div class="req-legend-row">
                        <span class="req-dot" style="background:#22c55e;"></span>
                        <span class="req-legend-label">Approved</span>
                        <span class="req-legend-bar-wrap">
                            <span class="req-legend-bar" style="width:{{ $total > 0 ? round($approved/$total*100) : 0 }}%; background:#22c55e;"></span>
                        </span>
                        <span class="req-legend-count">{{ $approved }}</span>
                        <span class="req-legend-pct">{{ $total > 0 ? round($approved/$total*100) : 0 }}%</span>
                    </div>
                    <div class="req-legend-row">
                        <span class="req-dot" style="background:#e10600;"></span>
                        <span class="req-legend-label">Rejected</span>
                        <span class="req-legend-bar-wrap">
                            <span class="req-legend-bar" style="width:{{ $total > 0 ? round($rejected/$total*100) : 0 }}%; background:#e10600;"></span>
                        </span>
                        <span class="req-legend-count">{{ $rejected }}</span>
                        <span class="req-legend-pct">{{ $total > 0 ? round($rejected/$total*100) : 0 }}%</span>
                    </div>
                </div>
            @endif
        </div>
    </div>

</div>

{{-- ── Row 2: Recent Orders + Low Stock ── --}}
<div style="display:grid; grid-template-columns: 1fr 1fr; gap: 20px;">

    <div class="card">
        <div class="card-header">
            <span class="card-title">Recent Orders</span>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">View all</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead><tr>
                    <th>Order</th><th>Customer</th><th>Total</th><th>Status</th>
                </tr></thead>
                <tbody>
                @forelse($recentOrders as $order)
                <tr>
                    <td><a href="{{ route('admin.orders.show', $order) }}" style="color:var(--red); text-decoration:none; font-weight:500;">#{{ $order->order_id }}</a></td>
                    <td>{{ $order->user?->full_name ?? '—' }}</td>
                    <td>${{ number_format($order->total_amount, 2) }}</td>
                    <td>
                        <span class="badge {{ match($order->order_status) {
                            'pending'   => 'badge-yellow',
                            'confirmed' => 'badge-blue',
                            'shipped'   => 'badge-blue',
                            'delivered' => 'badge-green',
                            'cancelled' => 'badge-red',
                            default     => 'badge-gray'
                        } }}">{{ ucfirst($order->order_status) }}</span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="4" style="text-align:center; color:var(--gray-400); padding:32px;">No orders yet</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <span class="card-title">Low Stock Alert</span>
            <a href="{{ route('admin.inventory.index') }}" class="btn btn-secondary btn-sm">View all</a>
        </div>
        <div class="table-wrap">
            <table>
                <thead><tr>
                    <th>Product</th><th>Stock</th><th>Min</th>
                </tr></thead>
                <tbody>
                @forelse($lowStock as $inv)
                <tr>
                    <td>{{ $inv->product?->product_name ?? '—' }}</td>
                    <td><span class="badge badge-red">{{ $inv->stock_quantity }}</span></td>
                    <td>{{ $inv->minimum_stock }}</td>
                </tr>
                @empty
                <tr><td colspan="3" style="text-align:center; color:var(--gray-400); padding:32px;">All stock levels OK</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- ── Styles ── --}}
<style>
.req-legend-row {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.78rem;
}
.req-dot {
    width: 8px; height: 8px;
    border-radius: 50%;
    flex-shrink: 0;
}
.req-legend-label {
    width: 60px;
    color: var(--gray-500);
    flex-shrink: 0;
}
.req-legend-bar-wrap {
    flex: 1;
    height: 5px;
    background: var(--gray-100);
    border-radius: 999px;
    overflow: hidden;
}
.req-legend-bar {
    display: block;
    height: 100%;
    border-radius: 999px;
    transition: width 0.6s ease;
}
.req-legend-count {
    width: 22px;
    text-align: right;
    font-weight: 600;
    color: var(--gray-900);
    font-size: 0.78rem;
    flex-shrink: 0;
}
.req-legend-pct {
    width: 34px;
    text-align: right;
    color: var(--gray-400);
    font-size: 0.72rem;
    flex-shrink: 0;
}
</style>

{{-- ── Chart.js ── --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
/* ── Bar Chart: Orders last 7 days ── */
(function () {
    const ctx = document.getElementById('ordersBarChart');
    if (!ctx) return;

    const labels     = @json($labelsShort);
    const counts     = @json($counts);
    const fullLabels = @json($labels);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Orders',
                data: counts,
                backgroundColor: counts.map((_, i) =>
                    i === counts.length - 1 ? '#E10600' : '#f3f4f6'
                ),
                borderColor: counts.map((_, i) =>
                    i === counts.length - 1 ? '#c00500' : '#e5e7eb'
                ),
                borderWidth: 1,
                borderRadius: 6,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        title: (items) => fullLabels[items[0].dataIndex],
                        label: (item) => ` ${item.parsed.y} order${item.parsed.y !== 1 ? 's' : ''}`,
                    },
                    backgroundColor: '#111827',
                    titleColor: '#f3f4f6',
                    bodyColor: '#d1d5db',
                    padding: 10,
                    cornerRadius: 6,
                    displayColors: false,
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    border: { display: false },
                    ticks: { color: '#9ca3af', font: { size: 11, family: 'Inter' } }
                },
                y: {
                    beginAtZero: true,
                    border: { display: false, dash: [4, 4] },
                    grid: { color: '#f3f4f6', drawTicks: false },
                    ticks: {
                        color: '#9ca3af',
                        font: { size: 11, family: 'Inter' },
                        padding: 8,
                        stepSize: 1,
                        precision: 0,
                    }
                }
            }
        }
    });
})();

/* ── Doughnut Chart: Car Requests ── */
(function () {
    const canvas = document.getElementById('carRequestsPie');
    if (!canvas) return;

    const pending  = {{ $pending  ?? 0 }};
    const approved = {{ $approved ?? 0 }};
    const rejected = {{ $rejected ?? 0 }};
    const total    = pending + approved + rejected;
    if (total === 0) return;

    new Chart(canvas, {
        type: 'doughnut',
        data: {
            labels: ['Pending', 'Approved', 'Rejected'],
            datasets: [{
                data: [pending, approved, rejected],
                backgroundColor: ['#f97316', '#22c55e', '#e10600'],
                borderColor: '#ffffff',
                borderWidth: 2,
                hoverOffset: 6,
            }]
        },
        options: {
            cutout: '72%',
            animation: { animateRotate: true, duration: 700 },
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: (ctx) => ` ${ctx.label}: ${ctx.parsed} (${Math.round(ctx.parsed / total * 100)}%)`,
                    },
                    backgroundColor: '#111827',
                    titleColor: '#f3f4f6',
                    bodyColor: '#d1d5db',
                    padding: 10,
                    cornerRadius: 6,
                    displayColors: true,
                    boxWidth: 8,
                    boxHeight: 8,
                }
            },
            responsive: false,
        }
    });
})();
</script>

@endsection