{{-- resources/views/finance/dashboard/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Finance Dashboard — E-Agraryo Merkado')

@push('styles')
<style>
    :root {
        --green-900:     #0d3b1e;
        --green-800:     #145228;
        --green-700:     #1a6932;
        --green-600:     #1f803c;
        --green-500:     #268f44;
        --green-200:     #b7e5c4;
        --green-100:     #e8f5ec;
        --green-50:      #f4fbf6;
        --gold:          #c8922a;
        --gold-light:    #fdf3e0;
        --gold-mid:      #f5d08a;
        --radius:        14px;
        --radius-sm:     9px;
        --sidebar-width: 256px;
        --topbar-height: 62px;
        --shadow-sm:     0 2px 10px rgba(13,59,30,.06);
        --shadow-md:     0 8px 26px rgba(13,59,30,.12);
        --transition:    .2s ease;
    }

    /* ── Base ─────────────────────────────────── */
    * { box-sizing: border-box; }
    body {
        font-family: 'Inter', system-ui, sans-serif;
        color: #1a2332; background: var(--green-50); line-height: 1.6;
    }
    .wrapper { display: flex; min-height: 100vh; }

    /* ── Sidebar ─────────────────────────────────── */
    .sidebar {
        width: var(--sidebar-width);
        background: var(--green-900);
        position: fixed; top: 0; left: 0; bottom: 0;
        display: flex; flex-direction: column;
        z-index: 1040;
        box-shadow: 2px 0 12px rgba(0,0,0,.2);
        transition: transform var(--transition);
    }
    .sidebar-brand {
        padding: 0 18px; height: var(--topbar-height);
        display: flex; align-items: center; gap: 10px;
        border-bottom: 1px solid rgba(255,255,255,.1);
        text-decoration: none;
    }
    .sidebar-brand-icon {
        width: 36px; height: 36px;
        background: rgba(200,146,42,.18);
        border: 1px solid rgba(200,146,42,.35);
        border-radius: var(--radius-sm);
        display: grid; place-items: center; flex-shrink: 0;
    }
    .sidebar-brand-icon i { color: var(--gold-mid); font-size: 1.05rem; }
    .sidebar-brand-text { line-height: 1.2; }
    .sidebar-brand-text .app-name { font-size: .78rem; font-weight: 700; color: #fff; letter-spacing: .05em; text-transform: uppercase; }
    .sidebar-brand-text .app-sub  { font-size: .6rem; color: var(--green-200); letter-spacing: .08em; text-transform: uppercase; }

    .sidebar-section-label {
        font-size: .62rem; font-weight: 700; letter-spacing: .12em;
        text-transform: uppercase; color: rgba(255,255,255,.35);
        padding: 18px 18px 5px;
    }
    .sidebar-nav { flex: 1; overflow-y: auto; padding-bottom: 10px; }
    .sidebar-nav::-webkit-scrollbar { width: 3px; }
    .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,.12); border-radius: 3px; }

    .nav-item-link {
        display: flex; align-items: center; gap: 11px;
        padding: 9px 18px; color: rgba(255,255,255,.72);
        text-decoration: none; font-size: .875rem; font-weight: 500;
        transition: background var(--transition), color var(--transition);
        position: relative;
    }
    .nav-item-link i { font-size: .95rem; width: 18px; text-align: center; flex-shrink: 0; }
    .nav-item-link:hover { background: rgba(255,255,255,.07); color: #fff; }
    .nav-item-link.active { background: rgba(200,146,42,.16); color: var(--gold-mid); }
    .nav-item-link.active::before {
        content: ''; position: absolute; left: 0; top: 0; bottom: 0;
        width: 3px; background: var(--gold); border-radius: 0 3px 3px 0;
    }
    .sidebar-footer { padding: 14px 18px; border-top: 1px solid rgba(255,255,255,.08); }
    .sidebar-footer .nav-item-link { border-radius: var(--radius-sm); color: rgba(255,110,110,.8); }
    .sidebar-footer .nav-item-link:hover { background: rgba(255,80,80,.1); color: #ff7070; }

    /* ── Main ─────────────────────────────────── */
    .main-content { margin-left: var(--sidebar-width); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }

    /* ── Topbar ─────────────────────────────────── */
    .topbar {
        height: var(--topbar-height); background: #fff;
        border-bottom: 1px solid #e2ece4;
        display: flex; align-items: center;
        padding: 0 24px; position: sticky; top: 0; z-index: 1030;
        box-shadow: var(--shadow-sm); gap: 14px;
    }
    .topbar-toggle { display: none; background: none; border: none; cursor: pointer; color: var(--green-700); font-size: 1.25rem; padding: 4px 6px; }
    .topbar-title { font-weight: 700; font-size: 1rem; color: var(--green-900); flex: 1; }
    .topbar-title span { color: var(--green-600); font-weight: 400; font-size: .82rem; margin-left: 6px; }
    .topbar-badge {
        display: flex; align-items: center; gap: 6px;
        background: var(--green-100); border: 1px solid var(--green-200);
        border-radius: 20px; padding: 4px 12px;
        font-size: .73rem; font-weight: 600; color: var(--green-700);
    }
    .topbar-badge i { color: var(--gold); font-size: .5rem; }
    .topbar-user { display: flex; align-items: center; gap: 9px; cursor: pointer; }
    .topbar-avatar {
        width: 34px; height: 34px; background: var(--green-800);
        border-radius: 50%; display: grid; place-items: center;
        color: var(--gold-mid); font-size: .95rem;
    }
    .topbar-user-info .user-name { font-size: .82rem; font-weight: 700; color: var(--green-900); line-height: 1.2; }
    .topbar-user-info .user-role { font-size: .68rem; color: #64748b; }

    /* ── Page body ────────────────────────────── */
    .page-body { padding: 26px; flex: 1; }
    .page-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 22px; flex-wrap: wrap; gap: 12px; }
    .page-header-left h1 { font-size: 1.35rem; font-weight: 700; color: var(--green-900); margin: 0; }
    .page-header-left p  { font-size: .8rem; color: #64748b; margin: 2px 0 0; }
    .page-header-right   { display: flex; gap: 9px; }

    .btn-dar-primary {
        background: var(--green-700); color: #fff; border: none;
        padding: 8px 17px; border-radius: var(--radius-sm);
        font-size: .82rem; font-weight: 600;
        display: inline-flex; align-items: center; gap: 6px;
        transition: background var(--transition), transform .15s, box-shadow .2s;
        text-decoration: none;
    }
    .btn-dar-primary:hover { background: var(--green-800); color: #fff; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(26,105,50,.25); }

    .btn-dar-outline {
        background: #fff; color: var(--green-700);
        border: 1.5px solid var(--green-200);
        padding: 8px 17px; border-radius: var(--radius-sm);
        font-size: .82rem; font-weight: 600;
        display: inline-flex; align-items: center; gap: 6px;
        transition: all var(--transition); text-decoration: none;
    }
    .btn-dar-outline:hover { border-color: var(--green-700); background: var(--green-100); color: var(--green-900); }

    /* ── Summary Cards ────────────────────────── */
    .summary-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 16px; margin-bottom: 26px;
    }
    .summary-card {
        background: #fff; border-radius: var(--radius);
        padding: 18px; box-shadow: var(--shadow-sm); border: 1px solid #e9ecef;
        display: flex; align-items: flex-start; gap: 13px;
        transition: box-shadow var(--transition), transform var(--transition);
        position: relative; overflow: hidden;
    }
    .summary-card:hover { box-shadow: var(--shadow-md); transform: translateY(-4px); }
    .summary-card::after {
        content: ''; position: absolute; bottom: 0; left: 0; right: 0;
        height: 3px; border-radius: 0 0 var(--radius) var(--radius);
    }
    .summary-card.green::after  { background: var(--green-600); }
    .summary-card.gold::after   { background: var(--gold); }
    .summary-card.blue::after   { background: #1a73e8; }
    .summary-card.teal::after   { background: #0d8a7e; }
    .summary-card.red::after    { background: #c0392b; }
    .summary-card.purple::after { background: #7c3aed; }
    .summary-card.indigo::after { background: #3b5fe2; }

    .sc-icon { width: 44px; height: 44px; border-radius: 13px; display: grid; place-items: center; flex-shrink: 0; font-size: 1.15rem; }
    .sc-icon.green  { background: var(--green-100); color: var(--green-700); }
    .sc-icon.gold   { background: var(--gold-light); color: var(--gold); }
    .sc-icon.blue   { background: #e8f0fe; color: #1a73e8; }
    .sc-icon.teal   { background: #e0f7f5; color: #0d8a7e; }
    .sc-icon.red    { background: #fdecea; color: #c0392b; }
    .sc-icon.purple { background: #f3e8ff; color: #7c3aed; }
    .sc-icon.indigo { background: #eaedfc; color: #3b5fe2; }

    .sc-body { flex: 1; min-width: 0; }
    .sc-label { font-size: .68rem; font-weight: 700; text-transform: uppercase; letter-spacing: .1em; color: #64748b; margin-bottom: 4px; }
    .sc-value { font-size: 1.5rem; font-weight: 700; color: var(--green-900); line-height: 1; margin-bottom: 4px; }
    .sc-sub   { font-size: .7rem; color: #94a3b8; }
    .sc-trend { font-size: .7rem; font-weight: 600; display: inline-flex; align-items: center; gap: 3px; padding: 2px 7px; border-radius: 20px; }
    .sc-trend.up   { background: var(--green-100); color: var(--green-700); }
    .sc-trend.down { background: #fdecea; color: #c0392b; }
    .sc-trend.neu  { background: #f1f5f9; color: #64748b; }

    /* ── Section heading ───────────────────────── */
    .section-heading { display: flex; align-items: center; gap: 10px; margin-bottom: 13px; }
    .section-heading h2 { font-size: .95rem; font-weight: 700; color: var(--green-900); margin: 0; }
    .section-heading .sh-line { flex: 1; height: 1px; background: #e2ece4; }
    .section-heading a { font-size: .75rem; color: var(--green-600); text-decoration: none; font-weight: 600; }
    .section-heading a:hover { text-decoration: underline; }

    /* ── Card wrapper ──────────────────────────── */
    .dar-card { background: #fff; border-radius: var(--radius); box-shadow: var(--shadow-sm); border: 1px solid #e9ecef; overflow: hidden; }
    .dar-card-header {
        padding: 13px 18px; border-bottom: 1px solid #f1f3f5;
        display: flex; align-items: center; justify-content: space-between;
        background: var(--green-50);
    }
    .dar-card-header h3 { font-size: .87rem; font-weight: 700; color: var(--green-900); margin: 0; display: flex; align-items: center; gap: 8px; }
    .dar-card-header h3 i { color: var(--gold); }

    /* ── Tables ────────────────────────────────── */
    .dar-table { width: 100%; border-collapse: collapse; font-size: .81rem; }
    .dar-table thead th {
        background: var(--green-100); color: var(--green-900);
        font-weight: 700; font-size: .68rem; text-transform: uppercase;
        letter-spacing: .08em; padding: 10px 13px; white-space: nowrap;
        border-bottom: 2px solid var(--green-200);
    }
    .dar-table tbody tr { border-bottom: 1px solid #f1f3f5; transition: background var(--transition); }
    .dar-table tbody tr:last-child { border-bottom: none; }
    .dar-table tbody tr:hover { background: var(--green-50); }
    .dar-table td { padding: 10px 13px; vertical-align: middle; color: #1a2332; }

    .badge-status { display: inline-flex; align-items: center; gap: 5px; padding: 2px 9px; border-radius: 20px; font-size: .68rem; font-weight: 600; }
    .badge-status::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: currentColor; opacity: .7; }
    .badge-status.paid       { background: var(--green-100); color: var(--green-700); }
    .badge-status.pending    { background: var(--gold-light); color: var(--gold); }
    .badge-status.cancelled  { background: #fdecea; color: #c0392b; }
    .badge-status.processing { background: #e8f0fe; color: #1a73e8; }
    .badge-status.completed  { background: #e0f7f5; color: #0d8a7e; }
    .badge-status.partial    { background: #f3e8ff; color: #7c3aed; }

    .order-no { font-family: 'Courier New', monospace; font-weight: 700; font-size: .78rem; color: var(--green-700); }

    /* ── Chart ─────────────────────────────────── */
    .chart-wrapper { padding: 18px; }
    #revenueChart  { max-height: 280px; }

    /* ── Activity feed ──────────────────────────── */
    .activity-list { list-style: none; padding: 0; margin: 0; }
    .activity-item {
        display: flex; gap: 11px; padding: 11px 18px;
        border-bottom: 1px solid #f1f3f5; transition: background var(--transition);
    }
    .activity-item:last-child { border-bottom: none; }
    .activity-item:hover { background: var(--green-50); }
    .activity-dot { width: 32px; height: 32px; border-radius: 10px; flex-shrink: 0; display: grid; place-items: center; font-size: .82rem; margin-top: 2px; }
    .activity-dot.pay   { background: var(--green-100); color: var(--green-700); }
    .activity-dot.order { background: #e8f0fe; color: #1a73e8; }
    .activity-dot.alert { background: var(--gold-light); color: var(--gold); }
    .activity-dot.arbo  { background: #e0f7f5; color: #0d8a7e; }

    .activity-body { flex: 1; min-width: 0; }
    .activity-title { font-size: .82rem; font-weight: 600; color: var(--green-900); margin-bottom: 1px; }
    .activity-meta  { font-size: .7rem; color: #64748b; }
    .activity-time  { font-size: .68rem; color: #94a3b8; white-space: nowrap; margin-top: 3px; }

    /* ── ARBO Revenue mini ────────────────────── */
    .arbo-rank { font-weight: 700; color: var(--gold); font-size: .83rem; width: 26px; text-align: center; }
    .arbo-mini-bar { height: 5px; border-radius: 3px; background: var(--green-600); opacity: .7; }

    /* ── Empty state ─────────────────────────────── */
    .empty-state { text-align: center; padding: 34px 20px; color: #94a3b8; }
    .empty-state i { font-size: 1.9rem; margin-bottom: 8px; display: block; }
    .empty-state p { font-size: .8rem; margin: 0; }

    /* ── Responsive ──────────────────────────────── */
    @media (max-width: 991.98px) {
        .sidebar { transform: translateX(-100%); }
        .sidebar.open { transform: translateX(0); }
        .sidebar-overlay { display: block !important; }
        .main-content { margin-left: 0; }
        .topbar-toggle { display: block; }
        .summary-grid { grid-template-columns: repeat(auto-fill, minmax(155px, 1fr)); }
        .page-body { padding: 16px; }
    }
    @media (max-width: 575.98px) {
        .summary-grid { grid-template-columns: 1fr 1fr; }
        .sc-value { font-size: 1.2rem; }
        .topbar-badge, .topbar-user-info { display: none; }
    }
</style>
@endpush

@section('content')

{{-- Sidebar overlay (mobile) --}}
<div class="sidebar-overlay d-none position-fixed top-0 start-0 w-100 h-100 bg-dark bg-opacity-50"
     style="z-index:1039;" id="sidebarOverlay" onclick="closeSidebar()"></div>

<div class="wrapper">

    {{-- ═══════════════ SIDEBAR ═══════════════ --}}
    <aside class="sidebar" id="sidebar">

        {{-- Brand — mirrors site-nav navbar-brand from landing page --}}
        <a href="{{ route('finance.dashboard') ?? '#' }}" class="sidebar-brand">
            <img src="{{ asset('images/dar-logo.png') }}" alt="DAR Logo"
                 style="height:30px; filter:brightness(1.15); flex-shrink:0;">
            <div>
                <div class="app-name">E-Agraryo Merkado</div>
                <div class="app-sub">Finance Portal</div>
            </div>
        </a>

        <nav class="sidebar-nav">

            <div class="sidebar-section-label">Main</div>

            <a href="{{ route('finance.dashboard') ?? '#' }}"
               class="nav-item-link {{ request()->routeIs('finance.dashboard') ? 'active' : '' }}">
                <i class="bi bi-grid-1x2-fill"></i>
                Dashboard
            </a>

            <div class="sidebar-section-label">Transactions</div>

            <a href="{{ route('finance.orders.index') ?? '#' }}"
               class="nav-item-link {{ request()->routeIs('finance.orders.*') ? 'active' : '' }}">
                <i class="bi bi-bag-check-fill"></i>
                Orders
            </a>

            <a href="{{ route('finance.payments.index') ?? '#' }}"
               class="nav-item-link {{ request()->routeIs('finance.payments.*') ? 'active' : '' }}">
                <i class="bi bi-credit-card-2-front-fill"></i>
                Payments
            </a>

            <a href="{{ route('finance.revenue.index') ?? '#' }}"
               class="nav-item-link {{ request()->routeIs('finance.revenue.*') ? 'active' : '' }}">
                <i class="bi bi-graph-up-arrow"></i>
                Revenue Monitoring
            </a>

            <div class="sidebar-section-label">Reports</div>

            <a href="{{ route('finance.reports.sales') ?? '#' }}"
               class="nav-item-link {{ request()->routeIs('finance.reports.*') ? 'active' : '' }}">
                <i class="bi bi-file-earmark-bar-graph-fill"></i>
                Sales Report
            </a>

            <a href="{{ route('finance.activity-logs') ?? '#' }}"
               class="nav-item-link {{ request()->routeIs('finance.activity-logs') ? 'active' : '' }}">
                <i class="bi bi-clock-history"></i>
                Activity Logs
            </a>

        </nav>

        <div class="sidebar-footer">
            <form method="POST" action="{{ route('logout') ?? '#' }}">
                @csrf
                <button type="submit" class="nav-item-link w-100 border-0 bg-transparent text-start">
                    <i class="bi bi-box-arrow-left"></i>
                    Logout
                </button>
            </form>
        </div>

    </aside>

    {{-- ═══════════════ MAIN ═══════════════ --}}
    <div class="main-content">

        {{-- ── Topbar — mirrors site-nav from landing page ── --}}
        <header class="topbar">
            <button class="topbar-toggle" id="sidebarToggle" onclick="openSidebar()">
                <i class="bi bi-list"></i>
            </button>

            <div class="topbar-title">
                Finance Dashboard
                <span>/ Overview</span>
            </div>

            {{-- Date badge — mirrors hero-label pill from landing page --}}
            <div class="topbar-badge d-none d-md-flex">
                <i class="bi bi-circle-fill" style="font-size:.45rem; color:var(--gold);"></i>
                {{ now()->format('F d, Y') }}
            </div>

            {{-- User — mirrors btn-nav-signin style --}}
            <div class="topbar-user ms-2">
                <div class="topbar-avatar">
                    <i class="bi bi-person-fill"></i>
                </div>
                <div class="topbar-user-info d-none d-lg-block">
                    <div class="user-name">{{ auth()->user()->name ?? 'Finance Admin' }}</div>
                    <div class="user-role">Admin / Finance</div>
                </div>
            </div>
        </header>

        {{-- ── Page Body ── --}}
        <main class="page-body">

            {{-- ── Page Header — mirrors hero-section layout (title + CTA row) ── --}}
            <div class="page-header">
                <div class="page-header-left">
                    {{-- eyebrow label mirrors hero-label pill --}}
                    <div style="display:inline-flex; align-items:center; gap:.4rem;
                                background:rgba(200,146,42,.12); border:1px solid rgba(200,146,42,.3);
                                color:var(--gold); font-size:.68rem; font-weight:700;
                                letter-spacing:.08em; text-transform:uppercase;
                                padding:3px 10px; border-radius:20px; margin-bottom:.5rem;">
                        <i class="bi bi-shield-fill-check"></i> DAR Region V — Finance
                    </div>
                    <h1><i class="bi bi-currency-exchange me-2" style="color:var(--gold);"></i>Finance Overview</h1>
                    <p>Monitor ARBO transactions, payments, and revenue — {{ now()->format('l, F d Y') }}</p>
                </div>
                <div class="page-header-right">
                    <a href="{{ route('finance.reports.sales') ?? '#' }}" class="btn-dar-outline">
                        <i class="bi bi-download"></i> Export Report
                    </a>
                    <a href="{{ route('finance.payments.index') ?? '#' }}" class="btn-dar-primary">
                        <i class="bi bi-plus-lg"></i> Record Payment
                    </a>
                </div>
            </div>

            {{-- ════════════════════════════════════
                 1. SUMMARY CARDS
                 Mirrors stats-strip / mini-stat pattern from landing page
            ════════════════════════════════════ --}}
            <div class="summary-grid">

                {{-- Total Orders --}}
                <div class="summary-card green">
                    <div class="sc-icon green"><i class="bi bi-bag-fill"></i></div>
                    <div class="sc-body">
                        <div class="sc-label">Total Orders</div>
                        <div class="sc-value">{{ number_format($totalOrders ?? 0) }}</div>
                        <div class="sc-sub">All-time orders</div>
                    </div>
                </div>

                {{-- Paid Orders --}}
                <div class="summary-card teal">
                    <div class="sc-icon teal"><i class="bi bi-check-circle-fill"></i></div>
                    <div class="sc-body">
                        <div class="sc-label">Paid Orders</div>
                        <div class="sc-value">{{ number_format($paidOrders ?? 0) }}</div>
                        <div class="sc-sub">
                            @if(($totalOrders ?? 0) > 0)
                                {{ number_format(($paidOrders ?? 0) / ($totalOrders ?? 1) * 100, 1) }}% of total
                            @else
                                —
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Pending Payments --}}
                <div class="summary-card gold">
                    <div class="sc-icon gold"><i class="bi bi-hourglass-split"></i></div>
                    <div class="sc-body">
                        <div class="sc-label">Pending Payments</div>
                        <div class="sc-value">{{ number_format($pendingPayments ?? 0) }}</div>
                        <span class="sc-trend {{ ($pendingPayments ?? 0) > 10 ? 'down' : 'up' }}">
                            <i class="bi bi-{{ ($pendingPayments ?? 0) > 10 ? 'arrow-up' : 'arrow-down' }}"></i>
                            Needs attention
                        </span>
                    </div>
                </div>

                {{-- Cancelled Orders --}}
                <div class="summary-card red">
                    <div class="sc-icon red"><i class="bi bi-x-circle-fill"></i></div>
                    <div class="sc-body">
                        <div class="sc-label">Cancelled Orders</div>
                        <div class="sc-value">{{ number_format($cancelledOrders ?? 0) }}</div>
                        <div class="sc-sub">Voided transactions</div>
                    </div>
                </div>

                {{-- Total Revenue --}}
                <div class="summary-card gold">
                    <div class="sc-icon gold"><i class="bi bi-cash-stack"></i></div>
                    <div class="sc-body">
                        <div class="sc-label">Total Revenue</div>
                        <div class="sc-value" style="font-size:1.2rem;">
                            ₱{{ number_format($totalRevenue ?? 0, 2) }}
                        </div>
                        <div class="sc-sub">Cumulative</div>
                    </div>
                </div>

                {{-- Monthly Revenue --}}
                <div class="summary-card green">
                    <div class="sc-icon green"><i class="bi bi-calendar2-check-fill"></i></div>
                    <div class="sc-body">
                        <div class="sc-label">This Month Revenue</div>
                        <div class="sc-value" style="font-size:1.2rem;">
                            ₱{{ number_format($monthlyRevenue ?? 0, 2) }}
                        </div>
                        <span class="sc-trend up">
                            <i class="bi bi-arrow-up"></i> {{ now()->format('M Y') }}
                        </span>
                    </div>
                </div>

                {{-- Active ARBO Transactions --}}
                <div class="summary-card indigo">
                    <div class="sc-icon indigo"><i class="bi bi-people-fill"></i></div>
                    <div class="sc-body">
                        <div class="sc-label">Active ARBO Transactions</div>
                        <div class="sc-value">{{ number_format($activeArboTransactions ?? 0) }}</div>
                        <div class="sc-sub">Live inter-ARBO deals</div>
                    </div>
                </div>

            </div>{{-- /summary-grid --}}


            {{-- ════════════════════════════════════
                 2. REVENUE CHART + ARBO TABLE
                 Section heading mirrors section-eyebrow pattern from landing page
            ════════════════════════════════════ --}}
            <div class="row g-4 mb-4">

                {{-- Revenue Chart --}}
                <div class="col-lg-7">
                    <div class="section-heading">
                        {{-- eyebrow mirrors .section-eyebrow from landing --}}
                        <div style="font-size:.62rem; font-weight:700; letter-spacing:.12em;
                                    text-transform:uppercase; color:var(--green-600);
                                    display:flex; align-items:center; gap:.35rem; white-space:nowrap;">
                            <span style="width:14px; height:3px; background:var(--green-600); border-radius:2px; display:block;"></span>
                            Revenue Trend
                        </div>
                        <h2>Monthly Revenue — {{ now()->year }}</h2>
                        <div class="sh-line"></div>
                    </div>
                    <div class="dar-card">
                        <div class="dar-card-header">
                            <h3><i class="bi bi-graph-up-arrow"></i> Revenue Chart</h3>
                            <span style="background:var(--green-100);color:var(--green-700);
                                         font-size:.68rem; font-weight:600; padding:2px 9px;
                                         border-radius:20px;">Chart.js</span>
                        </div>
                        <div class="chart-wrapper">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                </div>

                {{-- ARBO Revenue Table --}}
                <div class="col-lg-5">
                    <div class="section-heading">
                        <div style="font-size:.62rem; font-weight:700; letter-spacing:.12em;
                                    text-transform:uppercase; color:var(--green-600);
                                    display:flex; align-items:center; gap:.35rem; white-space:nowrap;">
                            <span style="width:14px; height:3px; background:var(--green-600); border-radius:2px; display:block;"></span>
                            ARBO Breakdown
                        </div>
                        <h2>Revenue by ARBO</h2>
                        <div class="sh-line"></div>
                        <a href="{{ route('finance.revenue.index') ?? '#' }}">View All</a>
                    </div>
                    <div class="dar-card">
                        <div class="dar-card-header">
                            <h3><i class="bi bi-buildings"></i> ARBO Breakdown</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="dar-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ARBO Name</th>
                                        <th>Orders</th>
                                        <th>Revenue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($arboRevenue ?? [] as $index => $arbo)
                                    <tr>
                                        <td><span class="arbo-rank">{{ $index + 1 }}</span></td>
                                        <td>
                                            <div style="font-weight:600; color:var(--green-900); font-size:.82rem;">{{ $arbo->arbo_name ?? 'N/A' }}</div>
                                            <div style="font-size:.7rem; color:#94a3b8;">{{ $arbo->region ?? '' }}</div>
                                        </td>
                                        <td>
                                            <span style="font-weight:600;">{{ number_format($arbo->total_orders ?? 0) }}</span>
                                        </td>
                                        <td>
                                            <div style="font-weight:700; color:var(--green-900);">
                                                ₱{{ number_format($arbo->revenue ?? 0, 2) }}
                                            </div>
                                            @php
                                                $maxRevenue = collect($arboRevenue ?? [])->max('revenue') ?: 1;
                                                $pct = (($arbo->revenue ?? 0) / $maxRevenue) * 100;
                                            @endphp
                                            <div class="arbo-mini-bar mt-1" style="width:{{ $pct }}%;"></div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4">
                                            <div class="empty-state">
                                                <i class="bi bi-building-slash"></i>
                                                <p>No ARBO revenue data available.</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>{{-- /row --}}


            {{-- ════════════════════════════════════
                 3. RECENT TRANSACTIONS
                 Section mirrors announcements-section layout from landing page
            ════════════════════════════════════ --}}
            <div class="section-heading mb-3">
                <div style="font-size:.62rem; font-weight:700; letter-spacing:.12em;
                            text-transform:uppercase; color:var(--green-600);
                            display:flex; align-items:center; gap:.35rem; white-space:nowrap;">
                    <span style="width:14px; height:3px; background:var(--green-600); border-radius:2px; display:block;"></span>
                    Transactions
                </div>
                <h2>Recent Orders</h2>
                <div class="sh-line"></div>
                <a href="{{ route('finance.orders.index') ?? '#' }}">View All</a>
            </div>

            <div class="dar-card mb-4">
                <div class="dar-card-header">
                    <h3><i class="bi bi-table"></i> Order Transactions</h3>
                    <div class="d-flex gap-2">
                        <select class="form-select form-select-sm"
                                style="width:auto; font-size:.75rem; border-color:var(--green-200);
                                       color:var(--green-900); border-radius:var(--radius-sm);">
                            <option>All Statuses</option>
                            <option>Paid</option>
                            <option>Pending</option>
                            <option>Processing</option>
                            <option>Cancelled</option>
                        </select>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="dar-table">
                        <thead>
                            <tr>
                                <th>Order No</th>
                                <th>Buyer (ARBO)</th>
                                <th>Seller (ARBO)</th>
                                <th>Amount</th>
                                <th>Payment Status</th>
                                <th>Order Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentTransactions ?? [] as $txn)
                            <tr>
                                <td>
                                    <span class="order-no">#{{ $txn->order_no ?? 'ORD-00000' }}</span>
                                </td>
                                <td>
                                    <div style="font-weight:600; font-size:.82rem;">{{ $txn->buyer_name ?? '—' }}</div>
                                    <div style="font-size:.7rem; color:#94a3b8;">{{ $txn->buyer_arbo ?? '' }}</div>
                                </td>
                                <td>
                                    <div style="font-size:.82rem;">{{ $txn->seller_arbo ?? '—' }}</div>
                                </td>
                                <td>
                                    <span style="font-weight:700; color:var(--green-900);">
                                        ₱{{ number_format($txn->amount ?? 0, 2) }}
                                    </span>
                                </td>
                                <td>
                                    @php
                                        $ps = strtolower($txn->payment_status ?? 'pending');
                                        $psMap = ['paid'=>'paid','pending'=>'pending','partial'=>'partial','cancelled'=>'cancelled'];
                                        $psCls = $psMap[$ps] ?? 'pending';
                                    @endphp
                                    <span class="badge-status {{ $psCls }}">{{ ucfirst($ps) }}</span>
                                </td>
                                <td>
                                    @php
                                        $os = strtolower($txn->order_status ?? 'processing');
                                        $osMap = ['completed'=>'completed','processing'=>'processing','cancelled'=>'cancelled','pending'=>'pending'];
                                        $osCls = $osMap[$os] ?? 'processing';
                                    @endphp
                                    <span class="badge-status {{ $osCls }}">{{ ucfirst($os) }}</span>
                                </td>
                                <td style="font-size:.75rem; color:#64748b; white-space:nowrap;">
                                    {{ isset($txn->created_at) ? \Carbon\Carbon::parse($txn->created_at)->format('M d, Y') : '—' }}
                                </td>
                                <td>
                                    <a href="{{ route('finance.orders.show', $txn->id ?? 0) ?? '#' }}"
                                       class="btn btn-sm"
                                       style="background:var(--green-100); color:var(--green-700);
                                              border:none; font-size:.7rem; padding:4px 10px;
                                              border-radius:var(--radius-sm);">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8">
                                    <div class="empty-state">
                                        <i class="bi bi-inbox-fill"></i>
                                        <p>No transactions found.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if(!empty($recentTransactions) && method_exists($recentTransactions, 'links'))
                <div style="padding:12px 18px; border-top:1px solid #f1f3f5;">
                    {{ $recentTransactions->links('pagination::bootstrap-5') }}
                </div>
                @endif
            </div>


            {{-- ════════════════════════════════════
                 4. RECENT FINANCE ACTIVITY
                 Cards mirror announcement-card style from landing page
            ════════════════════════════════════ --}}
            <div class="section-heading mb-3">
                <div style="font-size:.62rem; font-weight:700; letter-spacing:.12em;
                            text-transform:uppercase; color:var(--green-600);
                            display:flex; align-items:center; gap:.35rem; white-space:nowrap;">
                    <span style="width:14px; height:3px; background:var(--green-600); border-radius:2px; display:block;"></span>
                    Activity Feed
                </div>
                <h2>Recent Finance Activity</h2>
                <div class="sh-line"></div>
                <a href="{{ route('finance.activity-logs') ?? '#' }}">View All Logs</a>
            </div>

            <div class="dar-card mb-4">
                <div class="dar-card-header">
                    <h3><i class="bi bi-clock-history"></i> Activity Feed</h3>
                    <span style="font-size:.7rem; color:#94a3b8;">Last 24 hours</span>
                </div>
                <ul class="activity-list">
                    @forelse($recentActivities ?? [] as $activity)
                    <li class="activity-item">
                        <div class="activity-dot {{ $activity->type_class ?? 'order' }}">
                            <i class="bi bi-{{ $activity->icon ?? 'bell-fill' }}"></i>
                        </div>
                        <div class="activity-body">
                            <div class="activity-title">{{ $activity->description ?? 'Activity recorded.' }}</div>
                            <div class="activity-meta">
                                By <strong>{{ $activity->actor ?? 'System' }}</strong>
                                @if($activity->reference ?? null)
                                    &middot; Ref: <span class="order-no">{{ $activity->reference }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="activity-time">
                            {{ isset($activity->created_at) ? \Carbon\Carbon::parse($activity->created_at)->diffForHumans() : '—' }}
                        </div>
                    </li>
                    @empty
                    {{-- Fallback placeholder rows — mirrors announcement-card style --}}
                    @php
                        $placeholderActivities = [
                            ['pay',   'credit-card-fill',        'Payment confirmed for Order #ORD-20251',        'Finance Staff',  5],
                            ['order', 'bag-check-fill',          'New order placed by Kilusang ARBO — ₱12,400',   'System',         28],
                            ['alert', 'exclamation-circle-fill', 'Pending payment flag raised for #ORD-20248',    'Finance Staff',  51],
                            ['arbo',  'people-fill',             'ARBO Samahang Magsasaka verified on-platform',  'Admin',          74],
                            ['pay',   'receipt',                 'Invoice generated for batch #B-0042',           'Finance Staff',  97],
                        ];
                    @endphp
                    @foreach($placeholderActivities as $row)
                    <li class="activity-item">
                        <div class="activity-dot {{ $row[0] }}">
                            <i class="bi bi-{{ $row[1] }}"></i>
                        </div>
                        <div class="activity-body">
                            <div class="activity-title">{{ $row[2] }}</div>
                            <div class="activity-meta">By <strong>{{ $row[3] }}</strong></div>
                        </div>
                        <div class="activity-time">{{ $row[4] }}m ago</div>
                    </li>
                    @endforeach
                    @endforelse
                </ul>
            </div>

        </main>{{-- /page-body --}}

    </div>{{-- /main-content --}}

</div>{{-- /wrapper --}}
@endsection


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>
<script>
(function () {
    'use strict';

    /* ── Sidebar toggle (mobile) ─────────────── */
    window.openSidebar = function () {
        document.getElementById('sidebar').classList.add('open');
        document.getElementById('sidebarOverlay').classList.remove('d-none');
    };
    window.closeSidebar = function () {
        document.getElementById('sidebar').classList.remove('open');
        document.getElementById('sidebarOverlay').classList.add('d-none');
    };

    /* ── Revenue Chart ───────────────────────── */
    const ctx = document.getElementById('revenueChart');
    if (!ctx) return;

    // Use server-provided data if available, otherwise demo
    const chartLabels = @json($chartLabels ?? ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']);
    const chartData   = @json($chartData   ?? [42000,58000,37000,91000,76000,88000,103000,72000,115000,99000,134000,142000]);

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartLabels,
            datasets: [
                {
                    label: 'Monthly Revenue (₱)',
                    data: chartData,
                    backgroundColor: 'rgba(31,128,60,.75)',
                    borderColor: 'rgba(26,105,50,1)',
                    borderWidth: 1.5,
                    borderRadius: 6,
                    borderSkipped: false,
                    hoverBackgroundColor: 'rgba(200,146,42,.85)',
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: ctx => ' ₱' + Number(ctx.raw).toLocaleString('en-PH', {minimumFractionDigits:2})
                    },
                    backgroundColor: '#0d3b1e',
                    titleColor: '#f5d08a',
                    bodyColor: '#fff',
                    padding: 10,
                    cornerRadius: 8,
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 11 }, color: '#64748b' }
                },
                y: {
                    grid: { color: '#f1f3f5', lineWidth: 1 },
                    ticks: {
                        font: { size: 11 }, color: '#64748b',
                        callback: v => '₱' + (v >= 1000 ? (v/1000).toFixed(0) + 'k' : v)
                    },
                    beginAtZero: true
                }
            }
        }
    });
})();
</script>
@endpush