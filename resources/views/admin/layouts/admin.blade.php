<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Admin') — F1 Store</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
    --sidebar-w: 240px;
    --header-h: 56px;
    --red: #E10600;
    --red-light: #fff0f0;
    --gray-50: #f9fafb;
    --gray-100: #f3f4f6;
    --gray-200: #e5e7eb;
    --gray-400: #9ca3af;
    --gray-500: #6b7280;
    --gray-700: #374151;
    --gray-900: #111827;
    --white: #ffffff;
    --shadow: 0 1px 3px rgba(0,0,0,0.08);
    --shadow-md: 0 4px 12px rgba(0,0,0,0.1);
}

body {
    font-family: 'Inter', sans-serif;
    font-size: 0.875rem;
    color: var(--gray-700);
    background: var(--gray-50);
    min-height: 100vh;
    display: flex;
}

/* ── Sidebar ── */
.sidebar {
    width: var(--sidebar-w);
    background: var(--white);
    border-right: 1px solid var(--gray-200);
    display: flex;
    flex-direction: column;
    position: fixed;
    top: 0; left: 0; bottom: 0;
    z-index: 100;
    overflow-y: auto;
}

.sidebar-logo {
    padding: 20px 20px 16px;
    border-bottom: 1px solid var(--gray-200);
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
}
.sidebar-logo-icon {
    width: 32px; height: 32px;
    background: var(--red);
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 0.8rem;
    flex-shrink: 0;
}
.sidebar-logo-text {
    font-weight: 600;
    font-size: 0.9rem;
    color: var(--gray-900);
    line-height: 1.2;
}
.sidebar-logo-sub {
    font-size: 0.65rem;
    color: var(--gray-400);
    font-weight: 400;
}

.sidebar-nav { padding: 12px 0; flex: 1; }

.nav-section-label {
    font-size: 0.65rem;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--gray-400);
    padding: 12px 20px 6px;
}

.nav-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 9px 20px;
    color: var(--gray-500);
    text-decoration: none;
    font-size: 0.83rem;
    font-weight: 400;
    transition: background 0.15s, color 0.15s;
    border-radius: 0;
    position: relative;
}
.nav-item:hover { background: var(--gray-50); color: var(--gray-900); }
.nav-item.active {
    background: var(--red-light);
    color: var(--red);
    font-weight: 500;
}
.nav-item.active::before {
    content: '';
    position: absolute;
    left: 0; top: 4px; bottom: 4px;
    width: 3px;
    background: var(--red);
    border-radius: 0 2px 2px 0;
}
.nav-item svg { flex-shrink: 0; opacity: 0.7; }
.nav-item.active svg { opacity: 1; }

.sidebar-footer {
    padding: 16px 20px;
    border-top: 1px solid var(--gray-200);
}
.sidebar-user {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
}
.sidebar-avatar {
    width: 32px; height: 32px;
    border-radius: 50%;
    background: var(--gray-200);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--gray-500);
    flex-shrink: 0;
}
.sidebar-user-info { min-width: 0; }
.sidebar-user-name { font-weight: 500; font-size: 0.8rem; color: var(--gray-900); white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.sidebar-user-role { font-size: 0.68rem; color: var(--gray-400); }

.btn-logout {
    display: flex;
    align-items: center;
    gap: 8px;
    width: 100%;
    padding: 8px 12px;
    background: var(--gray-50);
    border: 1px solid var(--gray-200);
    border-radius: 6px;
    color: var(--gray-500);
    font-size: 0.78rem;
    cursor: pointer;
    text-decoration: none;
    transition: background 0.15s, color 0.15s;
}
.btn-logout:hover { background: var(--gray-100); color: var(--gray-700); }

/* ── Main ── */
.main {
    margin-left: var(--sidebar-w);
    flex: 1;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

.topbar {
    height: var(--header-h);
    background: var(--white);
    border-bottom: 1px solid var(--gray-200);
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 28px;
    position: sticky;
    top: 0;
    z-index: 50;
}
.topbar-title {
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--gray-900);
}
.topbar-breadcrumb {
    font-size: 0.75rem;
    color: var(--gray-400);
    display: flex;
    align-items: center;
    gap: 6px;
}
.topbar-breadcrumb a { color: var(--gray-400); text-decoration: none; }
.topbar-breadcrumb a:hover { color: var(--gray-700); }

.topbar-right { display: flex; align-items: center; gap: 12px; }
.topbar-badge {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 5px 12px;
    background: var(--red-light);
    border-radius: 20px;
    color: var(--red);
    font-size: 0.72rem;
    font-weight: 500;
}

.content { padding: 28px; flex: 1; }

/* ── Cards / Panels ── */
.card {
    background: var(--white);
    border: 1px solid var(--gray-200);
    border-radius: 8px;
    overflow: hidden;
}
.card-header {
    padding: 16px 20px;
    border-bottom: 1px solid var(--gray-200);
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.card-title { font-weight: 600; font-size: 0.875rem; color: var(--gray-900); }
.card-body { padding: 20px; }

/* ── Stats grid ── */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 24px;
}
.stat-card {
    background: var(--white);
    border: 1px solid var(--gray-200);
    border-radius: 8px;
    padding: 18px 20px;
    display: flex;
    flex-direction: column;
    gap: 6px;
}
.stat-label { font-size: 0.72rem; font-weight: 500; color: var(--gray-400); text-transform: uppercase; letter-spacing: 0.05em; }
.stat-value { font-size: 1.6rem; font-weight: 600; color: var(--gray-900); line-height: 1; }
.stat-sub { font-size: 0.72rem; color: var(--gray-400); }
.stat-icon {
    width: 36px; height: 36px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 4px;
}
.stat-icon.red { background: var(--red-light); color: var(--red); }
.stat-icon.blue { background: #eff6ff; color: #3b82f6; }
.stat-icon.green { background: #f0fdf4; color: #22c55e; }
.stat-icon.orange { background: #fff7ed; color: #f97316; }
.stat-icon.purple { background: #faf5ff; color: #a855f7; }

/* ── Table ── */
.table-wrap { overflow-x: auto; }
table { width: 100%; border-collapse: collapse; }
thead th {
    padding: 10px 16px;
    text-align: left;
    font-size: 0.72rem;
    font-weight: 600;
    color: var(--gray-400);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    background: var(--gray-50);
    border-bottom: 1px solid var(--gray-200);
    white-space: nowrap;
}
tbody td {
    padding: 12px 16px;
    border-bottom: 1px solid var(--gray-100);
    font-size: 0.83rem;
    color: var(--gray-700);
    vertical-align: middle;
}
tbody tr:last-child td { border-bottom: none; }
tbody tr:hover td { background: var(--gray-50); }

/* ── Buttons ── */
.btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 0.8rem;
    font-weight: 500;
    cursor: pointer;
    text-decoration: none;
    border: 1px solid transparent;
    transition: all 0.15s;
    white-space: nowrap;
}
.btn-primary { background: var(--red); color: white; border-color: var(--red); }
.btn-primary:hover { background: #c00500; border-color: #c00500; color: white; }
.btn-secondary { background: var(--white); color: var(--gray-700); border-color: var(--gray-200); }
.btn-secondary:hover { background: var(--gray-50); color: var(--gray-900); }
.btn-danger { background: #fef2f2; color: #dc2626; border-color: #fecaca; }
.btn-danger:hover { background: #dc2626; color: white; border-color: #dc2626; }
.btn-sm { padding: 5px 10px; font-size: 0.75rem; }
.btn-icon { padding: 6px; }

/* ── Forms ── */
.form-grid { display: grid; gap: 18px; }
.form-grid-2 { grid-template-columns: 1fr 1fr; }
.form-grid-3 { grid-template-columns: 1fr 1fr 1fr; }
.form-group { display: flex; flex-direction: column; gap: 5px; }
.form-group.full { grid-column: 1 / -1; }
label { font-size: 0.78rem; font-weight: 500; color: var(--gray-700); }
label span { color: var(--gray-400); font-weight: 400; }
input[type="text"],
input[type="number"],
input[type="email"],
input[type="date"],
input[type="url"],
input[type="password"],
input[type="color"],
select,
textarea {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid var(--gray-200);
    border-radius: 6px;
    font-size: 0.83rem;
    font-family: 'Inter', sans-serif;
    color: var(--gray-900);
    background: var(--white);
    transition: border-color 0.15s, box-shadow 0.15s;
    outline: none;
}
input:focus, select:focus, textarea:focus {
    border-color: var(--red);
    box-shadow: 0 0 0 3px rgba(225,6,0,0.08);
}
textarea { resize: vertical; min-height: 80px; }
input[type="color"] { height: 38px; padding: 2px 6px; cursor: pointer; }
.form-hint { font-size: 0.72rem; color: var(--gray-400); }
.form-error { font-size: 0.72rem; color: #dc2626; }

/* ── Badges ── */
.badge {
    display: inline-flex;
    align-items: center;
    padding: 2px 8px;
    border-radius: 20px;
    font-size: 0.7rem;
    font-weight: 500;
}
.badge-green  { background: #f0fdf4; color: #16a34a; }
.badge-red    { background: #fef2f2; color: #dc2626; }
.badge-yellow { background: #fefce8; color: #ca8a04; }
.badge-gray   { background: var(--gray-100); color: var(--gray-500); }
.badge-blue   { background: #eff6ff; color: #2563eb; }

/* ── Alert ── */
.alert {
    padding: 12px 16px;
    border-radius: 6px;
    font-size: 0.83rem;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #16a34a; }
.alert-error   { background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; }

/* ── Color dot ── */
.color-dot {
    display: inline-block;
    width: 12px; height: 12px;
    border-radius: 50%;
    border: 1px solid rgba(0,0,0,0.1);
    flex-shrink: 0;
}

/* ── Page header ── */
.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
}
.page-title { font-size: 1.1rem; font-weight: 600; color: var(--gray-900); }
.page-sub   { font-size: 0.78rem; color: var(--gray-400); margin-top: 2px; }

/* ── Pagination ── */
.pagination-wrap { padding: 14px 20px; border-top: 1px solid var(--gray-200); }
.pagination-wrap nav { display: flex; justify-content: end; }

/* ── Responsive ── */
@media (max-width: 1024px) {
    .stats-grid { grid-template-columns: repeat(2, 1fr); }
    .form-grid-3 { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 768px) {
    .sidebar { transform: translateX(-100%); }
    .main { margin-left: 0; }
    .form-grid-2, .form-grid-3 { grid-template-columns: 1fr; }
}
</style>
</head>
<body>

{{-- Sidebar --}}
<aside class="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
        <div class="sidebar-logo-icon">F1</div>
        <div>
            <div class="sidebar-logo-text">F1 Store</div>
            <div class="sidebar-logo-sub">Admin Panel</div>
        </div>
    </a>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Overview</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
            Dashboard
        </a>

        <div class="nav-section-label">Catalogue</div>
        <a href="{{ route('admin.products.index') }}" class="nav-item {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M20 7H4a1 1 0 00-1 1v11a1 1 0 001 1h16a1 1 0 001-1V8a1 1 0 00-1-1z"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/></svg>
            Products
        </a>
        <a href="{{ route('admin.categories.index') }}" class="nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M3 7h18M3 12h18M3 17h18"/></svg>
            Categories
        </a>
        <a href="{{ route('admin.brands.index') }}" class="nav-item {{ request()->routeIs('admin.brands.*') ? 'active' : '' }}">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="9"/><path d="M12 8v4l3 3"/></svg>
            Brands
        </a>

        <div class="nav-section-label">Racing</div>
        <a href="{{ route('admin.teams.index') }}" class="nav-item {{ request()->routeIs('admin.teams.*') ? 'active' : '' }}">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
            Teams
        </a>
        <a href="{{ route('admin.drivers.index') }}" class="nav-item {{ request()->routeIs('admin.drivers.*') ? 'active' : '' }}">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
            Drivers
        </a>
        <a href="{{ route('admin.car-models.index') }}" class="nav-item {{ request()->routeIs('admin.car-models.*') ? 'active' : '' }}">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M5 17H3a2 2 0 01-2-2V9a2 2 0 012-2h2l2-3h8l2 3h2a2 2 0 012 2v6a2 2 0 01-2 2h-2"/><circle cx="7" cy="17" r="2"/><circle cx="17" cy="17" r="2"/></svg>
            Car Models
        </a>

        <div class="nav-section-label">Operations</div>
        <a href="{{ route('admin.orders.index') }}" class="nav-item {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            Orders
        </a>
        <a href="{{ route('admin.inventory.index') }}" class="nav-item {{ request()->routeIs('admin.inventory.*') ? 'active' : '' }}">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            Inventory
        </a>
        <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
            Users
        </a>
        <a href="{{ route('admin.car-requests.index') }}" class="nav-item {{ request()->routeIs('admin.car-requests.*') ? 'active' : '' }}">
    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"/><path d="M12 12h.01M12 16h.01"/></svg>
    Car Requests
</a>
<a href="{{ route('admin.car-orders.index') }}" class="nav-item {{ request()->routeIs('admin.car-orders.*') ? 'active' : '' }}">
    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M5 17H3a2 2 0 01-2-2V9a2 2 0 012-2h2l2-3h8l2 3h2a2 2 0 012 2v6a2 2 0 01-2 2h-2"/><circle cx="7" cy="17" r="2"/><circle cx="17" cy="17" r="2"/></svg>
    Car Orders
</a>
    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="sidebar-avatar">{{ strtoupper(substr(auth()->user()->full_name ?? 'A', 0, 1)) }}</div>
            <div class="sidebar-user-info">
                <div class="sidebar-user-name">{{ auth()->user()->full_name ?? 'Admin' }}</div>
                <div class="sidebar-user-role">Administrator</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9"/></svg>
                Sign out
            </button>
        </form>
    </div>
</aside>

{{-- Main --}}
<div class="main">
    <div class="topbar">
        <div>
            <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
            <div class="topbar-breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Admin</a>
                @yield('breadcrumb')
            </div>
        </div>
        <div class="topbar-right">
            <a href="{{ url('/') }}" class="btn btn-secondary btn-sm" target="_blank">
                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3"/></svg>
                View Site
            </a>
        </div>
    </div>

    <div class="content">
        @if(session('success'))
        <div class="alert alert-success">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-error">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
            {{ session('error') }}
        </div>
        @endif

        @yield('content')
    </div>
</div>

</body>
</html>
