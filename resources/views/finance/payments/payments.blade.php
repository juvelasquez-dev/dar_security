<?php
// resources/views/finance/payments/index.php
// Standalone PHP/HTML — no layout extension
?>
<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payments — Finance — E-Agraryo Merkado</title>
    <link rel="icon" href="{{ asset('images/dar-logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/dar-logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* ─── Design Tokens ─────────────────────────────────── */
        :root {
            --green-900:  #0d3b1e;
            --green-800:  #145228;
            --green-700:  #1a6932;
            --green-600:  #1f803c;
            --green-500:  #268f44;
            --green-200:  #b7e5c4;
            --green-100:  #e8f5ec;
            --green-50:   #f4fbf6;
            --gold:       #c8922a;
            --gold-light: #fdf3e0;
            --gold-mid:   #f5d08a;
            --gray-50:    #f8f9fa;
            --gray-100:   #f1f3f5;
            --gray-200:   #e9ecef;
            --gray-400:   #adb5bd;
            --gray-600:   #6c757d;
            --gray-800:   #343a40;
            --text-main:  #1a2332;
            --text-muted: #64748b;
            --shadow-sm:  0 2px 8px rgba(13,59,30,0.06);
            --shadow-md:  0 6px 24px rgba(13,59,30,0.10);
            --radius:     14px;
            --radius-sm:  9px;
            --sidebar-w:  260px;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'DM Sans', system-ui, sans-serif;
            background: var(--gray-100);
            color: var(--text-main);
            min-height: 100vh;
        }

        /* ─── Navbar ────────────────────────────────────────── */
        .top-navbar {
            background: var(--green-900);
            height: 62px;
            display: flex; align-items: center; padding: 0 1.5rem;
            position: fixed; top: 0; left: 0; right: 0;
            z-index: 1040; box-shadow: 0 2px 12px rgba(0,0,0,0.22);
        }

        .navbar-brand-area {
            display: flex; align-items: center; gap: 0.65rem;
            text-decoration: none; flex-shrink: 0;
        }
        .navbar-brand-area img { height: 38px; filter: brightness(1.15); }

        .navbar-system-title {
            font-family: 'DM Serif Display', serif; font-size: 1.18rem;
            color: #fff; letter-spacing: 0.01em; line-height: 1.15;
        }
        .navbar-system-sub {
            font-size: 0.68rem; color: var(--green-200);
            letter-spacing: 0.06em; text-transform: uppercase; font-weight: 500;
        }

        .navbar-page-badge {
            background: rgba(200,146,42,0.18); border: 1px solid rgba(200,146,42,0.35);
            color: var(--gold-mid); font-size: 0.72rem; font-weight: 600;
            letter-spacing: 0.05em; text-transform: uppercase;
            padding: 3px 10px; border-radius: 20px; margin-left: 1rem;
        }

        .navbar-divider { width: 1px; height: 28px; background: rgba(255,255,255,0.12); margin: 0 1.25rem; }

        .navbar-right { margin-left: auto; display: flex; align-items: center; gap: 0.75rem; }

        .nav-icon-btn {
            background: none; border: none; color: rgba(255,255,255,0.75);
            font-size: 1.15rem; cursor: pointer; padding: 6px 8px; border-radius: 8px;
            position: relative; transition: color 0.18s, background 0.18s;
        }
        .nav-icon-btn:hover { color: #fff; background: rgba(255,255,255,0.08); }

        .nav-notif-dot {
            position: absolute; top: 5px; right: 6px; width: 8px; height: 8px;
            background: var(--gold); border-radius: 50%; border: 2px solid var(--green-900);
        }

        .user-pill {
            display: flex; align-items: center; gap: 0.5rem;
            background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12);
            border-radius: 30px; padding: 5px 12px 5px 6px;
            cursor: pointer; transition: background 0.18s; text-decoration: none;
        }
        .user-pill:hover { background: rgba(255,255,255,0.14); }

        .user-avatar { width: 30px; height: 30px; border-radius: 50%; object-fit: cover; border: 1.5px solid rgba(255,255,255,0.25); }
        .user-pill-name { font-size: 0.82rem; font-weight: 500; color: #fff; }
        .user-pill-role { font-size: 0.65rem; color: var(--green-200); }

        /* ─── Sidebar ───────────────────────────────────────── */
        .sidebar {
            position: fixed; top: 62px; left: 0; bottom: 0;
            width: var(--sidebar-w); background: #fff;
            border-right: 1px solid var(--gray-200); overflow-y: auto;
            z-index: 1030; display: flex; flex-direction: column;
            box-shadow: var(--shadow-sm); transition: transform 0.28s cubic-bezier(.4,0,.2,1);
        }
        .sidebar-inner { padding: 1.5rem 1rem; flex: 1; display: flex; flex-direction: column; }

        .sidebar-section-label {
            font-size: 0.65rem; font-weight: 700; letter-spacing: 0.1em;
            text-transform: uppercase; color: var(--gray-400); padding: 0 0.5rem;
            margin: 1.4rem 0 0.5rem;
        }
        .sidebar-section-label:first-child { margin-top: 0; }

        .sidebar-link {
            display: flex; align-items: center; gap: 0.65rem;
            padding: 0.56rem 0.75rem; border-radius: var(--radius-sm);
            font-size: 0.875rem; font-weight: 500; color: var(--gray-600);
            text-decoration: none; transition: all 0.18s; margin-bottom: 2px; position: relative;
        }
        .sidebar-link i { font-size: 1rem; width: 20px; text-align: center; flex-shrink: 0; }
        .sidebar-link:hover { background: var(--green-100); color: var(--green-700); }
        .sidebar-link.active { background: var(--green-100); color: var(--green-700); font-weight: 600; }
        .sidebar-link.active::before {
            content: ''; position: absolute; left: -3px; top: 20%; bottom: 20%;
            width: 4px; background: var(--green-600); border-radius: 4px;
        }

        .sidebar-logout { margin-top: auto; padding-top: 1rem; border-top: 1px solid var(--gray-200); }
        .sidebar-logout .sidebar-link { color: #c0392b; }
        .sidebar-logout .sidebar-link:hover { background: #fdf2f2; color: #c0392b; }

        .sidebar-office-chip {
            background: var(--green-50); border: 1px solid var(--green-200);
            border-radius: var(--radius-sm); padding: 0.65rem 0.85rem; margin-bottom: 1rem;
        }
        .sidebar-office-chip .office-label { font-size: 0.62rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--green-600); }
        .sidebar-office-chip .office-name { font-size: 0.82rem; font-weight: 600; color: var(--green-900); margin-top: 1px; }

        /* ─── Page Wrapper ──────────────────────────────────── */
        .page-wrapper {
            margin-left: var(--sidebar-w); margin-top: 62px;
            min-height: calc(100vh - 62px); padding: 2rem 2rem 3rem;
        }

        /* ─── Page Header ───────────────────────────────────── */
        .page-header {
            display: flex; align-items: flex-start; justify-content: space-between;
            margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;
        }
        .page-header-title {
            font-family: 'DM Serif Display', serif; font-size: 1.6rem;
            color: var(--green-900); margin: 0 0 2px; line-height: 1.2;
        }
        .page-header-sub { font-size: 0.85rem; color: var(--text-muted); margin: 0; }

        /* ─── Stat Cards ────────────────────────────────────── */
        .stat-card {
            background: #fff; border-radius: var(--radius); box-shadow: var(--shadow-sm);
            padding: 1.2rem 1.4rem; display: flex; align-items: center; gap: 1rem;
            transition: box-shadow 0.22s, transform 0.22s;
            border: 1px solid var(--gray-200); height: 100%;
        }
        .stat-card:hover { box-shadow: var(--shadow-md); transform: translateY(-3px); }

        .section-title a:hover { text-decoration: underline; }

    @include('partials.idle-timer')

</body>
</html>
        /* ─── Table Card ────────────────────────────────────── */
        .table-card {
            background: #fff; border-radius: var(--radius);
            box-shadow: var(--shadow-sm); border: 1px solid var(--gray-200); overflow: hidden;
        }
        .table-card-header {
            padding: 1rem 1.5rem 0.9rem; border-bottom: 1px solid var(--gray-200);
            display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.5rem;
        }
        .table-card-title { font-size: 0.9rem; font-weight: 700; color: var(--text-main); margin: 0; display: flex; align-items: center; gap: 0.45rem; }
        .table-card-title i { color: var(--green-600); }

        .table-responsive { overflow-x: auto; }

        .fin-table { width: 100%; border-collapse: collapse; font-size: 0.84rem; }
        .fin-table thead th {
            background: var(--green-50); color: var(--green-800); font-weight: 700;
            font-size: 0.72rem; letter-spacing: 0.05em; text-transform: uppercase;
            padding: 0.7rem 1.1rem; border-bottom: 1px solid var(--green-200); white-space: nowrap;
        }
        .fin-table tbody tr { border-bottom: 1px solid var(--gray-100); transition: background 0.14s; }
        .fin-table tbody tr:last-child { border-bottom: none; }
        .fin-table tbody tr:hover { background: var(--gray-50); }
        .fin-table td { padding: 0.78rem 1.1rem; vertical-align: middle; color: var(--text-main); }

        .payment-ref {
            font-family: 'Courier New', monospace; font-weight: 700;
            font-size: 0.82rem; color: var(--green-700);
        }
        .order-ref { font-family: 'Courier New', monospace; font-size: 0.78rem; color: var(--text-muted); }
        .name-cell { font-weight: 600; color: var(--green-800); }
        .name-cell small { display: block; font-weight: 400; font-size: 0.72rem; color: var(--text-muted); margin-top: 1px; }
        .amount-cell { font-weight: 700; color: var(--green-800); font-size: 0.88rem; }

        /* ─── Status Badges ─────────────────────────────────── */
        .status-badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 3px 10px; border-radius: 20px; font-size: 0.72rem; font-weight: 600;
        }
        .status-dot { width: 6px; height: 6px; border-radius: 50%; display: inline-block; background: currentColor; }

        .status-paid       { background: var(--green-100); color: var(--green-700); }
        .status-pending    { background: var(--gold-light); color: var(--gold); }
        .status-cancelled  { background: #fdecea; color: #c0392b; }
        .status-processing { background: #e0f7f5; color: #0d8a7e; }
        .status-completed  { background: #e8f0fe; color: #1a73e8; }
        .status-partial    { background: #f3e8ff; color: #7c3aed; }
        .status-refunded   { background: #fff3cd; color: #856404; }
        .status-overdue    { background: #fdecea; color: #c0392b; }
        .status-verified   { background: var(--green-100); color: var(--green-700); }
        .status-rejected   { background: #fdecea; color: #c0392b; }
        .status-forverification { background: #e8f0fe; color: #1a73e8; }

        /* ─── Method Badge ──────────────────────────────────── */
        .method-badge {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 2px 9px; border-radius: 6px; font-size: 0.72rem; font-weight: 600;
            background: var(--gray-100); color: var(--gray-600);
        }

        /* ─── Proof Thumbnail ───────────────────────────────── */
        .proof-thumb {
            width: 34px; height: 34px; border-radius: 6px;
            object-fit: cover; border: 1px solid var(--gray-200); cursor: pointer;
            transition: transform 0.15s; display: block;
        }
        .proof-thumb:hover { transform: scale(1.1); }

        .no-proof { font-size: 0.72rem; color: var(--gray-400); font-style: italic; }

        /* ─── Verify / Reject Action Buttons ────────────────── */
        .btn-verify {
            background: var(--green-100); color: var(--green-700); border: none;
            font-size: 0.75rem; border-radius: 7px; font-weight: 600;
            padding: 4px 11px; display: inline-flex; align-items: center; gap: 4px;
            cursor: pointer; transition: background 0.15s;
        }
        .btn-verify:hover { background: #d0ebd8; color: var(--green-900); }

        .btn-reject {
            background: #fdecea; color: #c0392b; border: none;
            font-size: 0.75rem; border-radius: 7px; font-weight: 600;
            padding: 4px 11px; display: inline-flex; align-items: center; gap: 4px;
            cursor: pointer; transition: background 0.15s;
        }
        .btn-reject:hover { background: #fbd8d4; }

        .btn-card-action {
            background: var(--green-100); color: var(--green-700); border: none;
            font-size: 0.78rem; border-radius: 8px; font-weight: 600; padding: 5px 12px;
            text-decoration: none; display: inline-flex; align-items: center; gap: 4px;
            transition: background 0.15s; white-space: nowrap; cursor: pointer;
        }
        .btn-card-action:hover { background: #d0ebd8; color: var(--green-900); }

        /* ─── Overdue highlight ─────────────────────────────── */
        .row-overdue { background: #fff8f8 !important; }
        .row-overdue:hover { background: #fdf0f0 !important; }

        /* ─── Pagination ────────────────────────────────────── */
        .pagination-wrap {
            padding: 12px 20px; border-top: 1px solid var(--gray-100);
            display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.5rem;
        }
        .pagination-info { font-size: 0.78rem; color: var(--text-muted); }

        /* ─── Empty State ───────────────────────────────────── */
        .empty-state { text-align: center; padding: 3.5rem 1rem; color: var(--gray-400); }
        .empty-state i { font-size: 2.5rem; display: block; margin-bottom: 0.75rem; }
        .empty-state p { font-size: 0.85rem; margin: 0; }

        /* ─── Chart Card ────────────────────────────────────── */
        .chart-card {
            background: #fff; border-radius: var(--radius);
            box-shadow: var(--shadow-sm); border: 1px solid var(--gray-200); overflow: hidden;
        }
        .chart-card-header {
            padding: 1rem 1.5rem 0.9rem; border-bottom: 1px solid var(--gray-200);
            display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.5rem;
        }

        /* ─── Payment Detail Offcanvas ──────────────────────── */
        .offcanvas { width: 540px !important; }
        .offcanvas-header { background: var(--green-900); color: #fff; padding: 1.1rem 1.5rem; }
        .offcanvas-header .btn-close { filter: invert(1) brightness(2); }

        .detail-section { border-bottom: 1px solid var(--gray-200); padding: 1.1rem 1.5rem; }
        .detail-section:last-child { border-bottom: none; }
        .detail-section-title { font-size: 0.7rem; font-weight: 700; letter-spacing: 0.09em; text-transform: uppercase; color: var(--gray-400); margin-bottom: 0.75rem; }
        .detail-row { display: flex; justify-content: space-between; align-items: flex-start; gap: 1rem; font-size: 0.83rem; margin-bottom: 0.5rem; }
        .detail-row:last-child { margin-bottom: 0; }
        .detail-key { color: var(--text-muted); flex-shrink: 0; font-weight: 500; }
        .detail-val { color: var(--text-main); font-weight: 600; text-align: right; }

        .detail-ref {
            font-family: 'Courier New', monospace; font-size: 1rem;
            font-weight: 700; color: var(--green-700);
        }

        .proof-preview {
            width: 100%; border-radius: 10px; object-fit: cover;
            border: 1px solid var(--gray-200); max-height: 260px; cursor: zoom-in;
        }

        .proof-placeholder {
            background: var(--gray-100); border-radius: 10px; border: 1px dashed var(--gray-400);
            height: 120px; display: flex; flex-direction: column; align-items: center; justify-content: center;
            color: var(--gray-400); font-size: 0.82rem; gap: 0.4rem;
        }
        .proof-placeholder i { font-size: 1.8rem; }

        /* ─── Verify Modal ──────────────────────────────────── */
        .modal-header-green { background: var(--green-900); color: #fff; }
        .modal-header-red   { background: #c0392b; color: #fff; }
        .modal-header-green .btn-close,
        .modal-header-red   .btn-close { filter: invert(1) brightness(2); }

        /* ─── Mobile ────────────────────────────────────────── */
        .mobile-sidebar-toggle { display: none; background: none; border: none; color: #fff; font-size: 1.3rem; margin-right: 0.75rem; cursor: pointer; }

        @media (max-width: 991.98px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .page-wrapper { margin-left: 0; padding: 1.25rem 1rem 3rem; }
            .mobile-sidebar-toggle { display: block; }
            .navbar-page-badge { display: none; }
            .offcanvas { width: 100vw !important; }
            .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.4); z-index: 1029; }
            .sidebar-overlay.show { display: block; }
        }

        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb { background: var(--gray-200); border-radius: 4px; }
    </style>
</head>
<body>

<!-- ── Top Navbar ──────────────────────────────────────── -->
<header class="top-navbar">
    <button class="mobile-sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
        <i class="bi bi-list"></i>
    </button>

    <a class="navbar-brand-area" href="{{ route('finance.dashboard') }}">
        <img src="{{ asset('images/dar-logo.png') }}" alt="DAR Logo">
        <div>
            <div class="navbar-system-title">E-Agraryo Merkado</div>
            <div class="navbar-system-sub">DAR Region V</div>
        </div>
    </a>

    <span class="navbar-page-badge">
        <i class="bi bi-currency-exchange me-1"></i> Finance Admin
    </span>

    <div class="navbar-right">
        <div class="dropdown">
            <button class="nav-icon-btn" data-bs-toggle="dropdown" aria-label="Notifications">
                <i class="bi bi-bell"></i>
                <span class="nav-notif-dot"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="min-width:280px; border-radius:12px; margin-top:8px;">
                <li class="px-3 py-2 border-bottom"><span class="fw-bold" style="font-size:.82rem;">Notifications</span></li>
                <li>
                    <a class="dropdown-item py-2" href="#" style="font-size:.82rem;">
                        <i class="bi bi-credit-card text-success me-2"></i> New payment received
                        <div class="text-muted" style="font-size:.72rem; padding-left:1.4rem;">Just now</div>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item py-2" href="#" style="font-size:.82rem;">
                        <i class="bi bi-exclamation-triangle text-warning me-2"></i> Pending payment overdue
                        <div class="text-muted" style="font-size:.72rem; padding-left:1.4rem;">2 hours ago</div>
                    </a>
                </li>
                <li class="border-top">
                    <a class="dropdown-item text-center py-2" href="{{ route('finance.activity-logs') }}" style="font-size:.78rem; color:var(--green-700);">View all notifications</a>
                </li>
            </ul>
        </div>

        <div class="navbar-divider d-none d-sm-block"></div>

        <div class="dropdown">
            <a class="user-pill dropdown-toggle" href="#" data-bs-toggle="dropdown">
                <img class="user-avatar"
                     src="{{ optional(auth()->user())->avatar ?: 'https://ui-avatars.com/api/?name=' . urlencode(optional(auth()->user())->name ?? 'Finance Admin') . '&background=1a6932&color=fff&rounded=true&size=64' }}"
                     alt="User avatar">
                <div class="d-none d-md-block" style="line-height:1.2;">
                    <div class="user-pill-name">{{ optional(auth()->user())->name ?? 'Finance Admin' }}</div>
                    <div class="user-pill-role">Admin / Finance</div>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="border-radius:12px; margin-top:8px; min-width:200px;">
                <li class="px-3 py-2 border-bottom">
                    <div class="fw-bold" style="font-size:.83rem;">{{ optional(auth()->user())->name ?? 'Finance Admin' }}</div>
                    <div class="text-muted" style="font-size:.72rem;">{{ optional(auth()->user())->email ?? '' }}</div>
                </li>
                <li><a class="dropdown-item py-2" href="{{ route('finance.profile') }}" style="font-size:.84rem;"><i class="bi bi-person me-2 text-muted"></i>Profile</a></li>
                <li class="border-top">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item py-2 text-danger" type="submit" style="font-size:.84rem;"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>

<!-- ── Sidebar Overlay (mobile) ────────────────────────── -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- ── Sidebar ─────────────────────────────────────────── -->
<aside class="sidebar" id="mainSidebar">
    <div class="sidebar-inner">
        <div class="sidebar-office-chip">
            <div class="office-label">Role</div>
            <div class="office-name">Finance Admin</div>
        </div>

        <span class="sidebar-section-label">Main Menu</span>

        <a href="{{ route('finance.dashboard') }}" class="sidebar-link {{ request()->routeIs('finance.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a href="{{ route('finance.orders.index') }}" class="sidebar-link {{ request()->routeIs('finance.orders.*') ? 'active' : '' }}">
            <i class="bi bi-bag-check"></i> Orders
        </a>
        <a href="{{ route('finance.payments.index') }}" class="sidebar-link {{ request()->routeIs('finance.payments.*') ? 'active' : '' }}">
            <i class="bi bi-credit-card-2-front"></i> Payments
        </a>
        <a href="{{ route('finance.revenue.index') }}" class="sidebar-link {{ request()->routeIs('finance.revenue.*') ? 'active' : '' }}">
            <i class="bi bi-graph-up-arrow"></i> Revenue Monitoring
        </a>

        <span class="sidebar-section-label">Sales Report</span>
        <a href="{{ route('finance.reports.sales') }}" class="sidebar-link {{ request()->routeIs('finance.reports.*') ? 'active' : '' }}">
            <i class="bi bi-bar-chart-line"></i> Sales Report
        </a>

        <span class="sidebar-section-label">System</span>
        <a href="{{ route('finance.activity-logs') }}" class="sidebar-link {{ request()->routeIs('finance.activity-logs') ? 'active' : '' }}">
            <i class="bi bi-clock-history"></i> Activity Logs
        </a>

        <div class="sidebar-logout">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-link w-100 text-start border-0 bg-transparent" style="cursor:pointer;">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- ── Main Content ─────────────────────────────────────── -->
<main class="page-wrapper">

    <!-- Page Header -->
    <div class="page-header">
        <div>
            <h1 class="page-header-title">
                <i class="bi bi-credit-card-2-front me-2" style="color:var(--green-600); font-size:1.3rem;"></i>
                Payments
            </h1>
            <p class="page-header-sub">
                Verify, monitor, and manage all payment transactions across <strong>E-Agraryo Merkado</strong>.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <a href="#" class="btn-export" style="background:var(--green-50);color:var(--green-700);border:1px solid var(--green-200);" id="printBtn">
                <i class="bi bi-printer"></i> Print
            </a>
            <a href="#" class="btn-export" id="exportBtn">
                <i class="bi bi-download"></i> Export CSV
            </a>
        </div>
    </div>

    <!-- ── Summary Cards ──────────────────────────────── -->
    <div class="row g-3 mb-4">

        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-green">
                    <i class="bi bi-cash-stack"></i>
                </div>
                <div>
                    <div class="stat-value" style="font-size:1.4rem;">₱{{ number_format($totalCollected ?? 0, 2) }}</div>
                    <p class="stat-label">Total Collected</p>
                    <span class="stat-trend up"><i class="bi bi-database"></i> All paid</span>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-gold">
                    <i class="bi bi-hourglass-split"></i>
                </div>
                <div>
                    <div class="stat-value" style="font-size:1.4rem;">₱{{ number_format($totalPending ?? 0, 2) }}</div>
                    <p class="stat-label">Pending Payments</p>
                    <span class="stat-trend down"><i class="bi bi-exclamation-circle"></i> Awaiting</span>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-blue">
                    <i class="bi bi-clock-history"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $forVerification ?? '—' }}</div>
                    <p class="stat-label">For Verification</p>
                    <span class="stat-trend neutral"><i class="bi bi-arrow-right-circle"></i> Needs review</span>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-red">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $overdueCount ?? '—' }}</div>
                    <p class="stat-label">Overdue</p>
                    <span class="stat-trend down"><i class="bi bi-arrow-up-short"></i> Action needed</span>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-teal">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $verifiedCount ?? '—' }}</div>
                    <p class="stat-label">Verified Payments</p>
                    <span class="stat-trend up"><i class="bi bi-shield-check"></i> Confirmed</span>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-purple">
                    <i class="bi bi-patch-minus-fill"></i>
                </div>
                <div>
                    <div class="stat-value" style="font-size:1.4rem;">₱{{ number_format($totalPartial ?? 0, 2) }}</div>
                    <p class="stat-label">Partial Payments</p>
                    <span class="stat-trend neutral"><i class="bi bi-dash-circle"></i> Balance due</span>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-green">
                    <i class="bi bi-calendar2-check-fill"></i>
                </div>
                <div>
                    <div class="stat-value" style="font-size:1.4rem;">₱{{ number_format($monthlyCollected ?? 0, 2) }}</div>
                    <p class="stat-label">This Month</p>
                    <span class="stat-trend up"><i class="bi bi-arrow-up-short"></i> {{ now()->format('M Y') }}</span>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-red">
                    <i class="bi bi-x-circle-fill"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $rejectedCount ?? '—' }}</div>
                    <p class="stat-label">Rejected Proofs</p>
                    <span class="stat-trend down"><i class="bi bi-x-circle"></i> Invalid</span>
                </div>
            </div>
        </div>

    </div>

    <!-- ── Charts Row ──────────────────────────────────── -->
    <div class="row g-4 mb-4">

        <!-- Monthly Collections Bar Chart -->
        <div class="col-lg-8">
            <div class="section-title">
                <div class="section-title-bar"></div>
                Monthly Collections — {{ now()->year }}
            </div>
            <div class="chart-card">
                <div class="chart-card-header">
                    <span style="font-size:.88rem; font-weight:700;">Collected vs Pending per Month</span>
                    <select class="form-select form-select-sm w-auto" style="font-size:.77rem;">
                        <option>{{ now()->year }}</option>
                        <option>{{ now()->year - 1 }}</option>
                    </select>
                </div>
                <div class="p-4" style="height:270px; position:relative;">
                    <canvas id="collectionsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Payment Method Donut -->
        <div class="col-lg-4">
            <div class="section-title">
                <div class="section-title-bar"></div>
                By Payment Method
            </div>
            <div class="chart-card">
                <div class="chart-card-header">
                    <span style="font-size:.84rem; font-weight:700;">Method Breakdown</span>
                </div>
                <div class="p-3" style="height:180px; position:relative;">
                    <canvas id="methodDonut"></canvas>
                </div>
                <div class="px-4 pb-3 d-flex flex-wrap gap-2 justify-content-center">
                    <span class="method-badge"><i class="bi bi-phone"></i> GCash</span>
                    <span class="method-badge"><i class="bi bi-bank2"></i> Bank Transfer</span>
                    <span class="method-badge"><i class="bi bi-cash"></i> Cash</span>
                    <span class="method-badge"><i class="bi bi-credit-card"></i> Maya</span>
                </div>
            </div>
        </div>

    </div>

    <!-- ── Status Tabs ────────────────────────────────── -->
    <div class="tab-pill-wrap">
        <a href="{{ route('finance.payments.index') }}"
           class="tab-pill {{ !request('status') ? 'active' : '' }}">
            All <span class="tab-pill-count">{{ $totalPayments ?? 0 }}</span>
        </a>
        <a href="{{ route('finance.payments.index', ['status' => 'for_verification']) }}"
           class="tab-pill {{ request('status') === 'for_verification' ? 'active' : '' }}">
            <i class="bi bi-clock"></i> For Verification
            <span class="tab-pill-count">{{ $forVerification ?? 0 }}</span>
        </a>
        <a href="{{ route('finance.payments.index', ['status' => 'verified']) }}"
           class="tab-pill {{ request('status') === 'verified' ? 'active' : '' }}">
            <i class="bi bi-shield-check"></i> Verified
            <span class="tab-pill-count">{{ $verifiedCount ?? 0 }}</span>
        </a>
        <a href="{{ route('finance.payments.index', ['status' => 'paid']) }}"
           class="tab-pill {{ request('status') === 'paid' ? 'active' : '' }}">
            <i class="bi bi-check-circle"></i> Paid
            <span class="tab-pill-count">{{ $paidCount ?? 0 }}</span>
        </a>
        <a href="{{ route('finance.payments.index', ['status' => 'partial']) }}"
           class="tab-pill {{ request('status') === 'partial' ? 'active' : '' }}">
            <i class="bi bi-patch-minus"></i> Partial
            <span class="tab-pill-count">{{ $partialCount ?? 0 }}</span>
        </a>
        <a href="{{ route('finance.payments.index', ['status' => 'overdue']) }}"
           class="tab-pill {{ request('status') === 'overdue' ? 'active' : '' }}">
            <i class="bi bi-exclamation-triangle"></i> Overdue
            <span class="tab-pill-count">{{ $overdueCount ?? 0 }}</span>
        </a>
        <a href="{{ route('finance.payments.index', ['status' => 'rejected']) }}"
           class="tab-pill {{ request('status') === 'rejected' ? 'active' : '' }}">
            <i class="bi bi-x-circle"></i> Rejected
            <span class="tab-pill-count">{{ $rejectedCount ?? 0 }}</span>
        </a>
    </div>

    <!-- ── Filter Bar ──────────────────────────────────── -->
    <form method="GET" action="{{ route('finance.payments.index') }}" id="filterForm">
        <input type="hidden" name="status" value="{{ request('status') }}">
        <div class="filter-bar">
            <span class="filter-label"><i class="bi bi-funnel me-1"></i>Filters</span>

            <select name="date_range" class="filter-select" onchange="document.getElementById('filterForm').submit()">
                <option value="">All Time</option>
                <option value="today"      {{ request('date_range') === 'today'      ? 'selected' : '' }}>Today</option>
                <option value="this_week"  {{ request('date_range') === 'this_week'  ? 'selected' : '' }}>This Week</option>
                <option value="this_month" {{ request('date_range') === 'this_month' ? 'selected' : '' }}>This Month</option>
                <option value="last_month" {{ request('date_range') === 'last_month' ? 'selected' : '' }}>Last Month</option>
                <option value="this_year"  {{ request('date_range') === 'this_year'  ? 'selected' : '' }}>This Year</option>
            </select>

            <select name="method" class="filter-select" onchange="document.getElementById('filterForm').submit()">
                <option value="">All Methods</option>
                <option value="gcash"         {{ request('method') === 'gcash'         ? 'selected' : '' }}>GCash</option>
                <option value="bank_transfer"  {{ request('method') === 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                <option value="cash"           {{ request('method') === 'cash'           ? 'selected' : '' }}>Cash</option>
                <option value="maya"           {{ request('method') === 'maya'           ? 'selected' : '' }}>Maya</option>
            </select>

            <select name="arbo_id" class="filter-select" onchange="document.getElementById('filterForm').submit()">
                <option value="">All ARBOs</option>
                @foreach($arbos ?? [] as $arbo)
                <option value="{{ $arbo->id }}" {{ request('arbo_id') == $arbo->id ? 'selected' : '' }}>{{ $arbo->name }}</option>
                @endforeach
            </select>

            <div class="search-wrap">
                <i class="bi bi-search"></i>
                <input type="text" name="search" class="search-input"
                       placeholder="Search ref no., ARBO…"
                       value="{{ request('search') }}"
                       onchange="document.getElementById('filterForm').submit()">
            </div>

            <select name="sort" class="filter-select" onchange="document.getElementById('filterForm').submit()">
                <option value="newest"     {{ request('sort', 'newest') === 'newest'      ? 'selected' : '' }}>Newest First</option>
                <option value="oldest"     {{ request('sort') === 'oldest'                ? 'selected' : '' }}>Oldest First</option>
                <option value="amount_desc"{{ request('sort') === 'amount_desc'           ? 'selected' : '' }}>Amount ↓</option>
                <option value="amount_asc" {{ request('sort') === 'amount_asc'            ? 'selected' : '' }}>Amount ↑</option>
            </select>

            @if(request()->hasAny(['search','date_range','method','arbo_id','sort']))
            <a href="{{ route('finance.payments.index') }}" class="filter-select text-decoration-none" style="color:#c0392b;background:#fdecea;border-color:#fbd8d4;">
                <i class="bi bi-x-circle me-1"></i> Clear
            </a>
            @endif
        </div>
    </form>

    <!-- ── Payments Table ─────────────────────────────── -->
    <div class="table-card">
        <div class="table-card-header">
            <h6 class="table-card-title">
                <i class="bi bi-credit-card-2-front"></i>
                Payment Records
                @if(isset($payments) && method_exists($payments, 'total'))
                <span style="font-size:.72rem;font-weight:400;color:var(--text-muted);margin-left:6px;">
                    {{ number_format($payments->total()) }} records
                </span>
                @endif
            </h6>
            <span style="font-size:.73rem;color:var(--text-muted);" id="tableDate"></span>
        </div>

        <div class="table-responsive">
            <table class="fin-table">
                <thead>
                    <tr>
                        <th>Ref No.</th>
                        <th>Order No.</th>
                        <th>Payer (ARBO)</th>
                        <th>Payee (ARBO)</th>
                        <th>Method</th>
                        <th>Amount</th>
                        <th>Balance Due</th>
                        <th>Status</th>
                        <th>Proof</th>
                        <th>Verified By</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payments ?? [] as $payment)
                    @php
                        $ps      = strtolower($payment->status ?? 'pending');
                        $isOver  = $ps === 'overdue';
                    @endphp
                    <tr class="payment-row {{ $isOver ? 'row-overdue' : '' }}"
                        style="cursor:pointer;"
                        data-id="{{ $payment->id ?? 0 }}"
                        data-ref="{{ $payment->reference_no ?? '' }}"
                        data-order-no="{{ $payment->order_no ?? '' }}"
                        data-payer="{{ $payment->payer_name ?? '—' }}"
                        data-payer-arbo="{{ $payment->payer_arbo ?? '' }}"
                        data-payee="{{ $payment->payee_arbo ?? '—' }}"
                        data-method="{{ $payment->payment_method ?? '—' }}"
                        data-amount="{{ number_format($payment->amount ?? 0, 2) }}"
                        data-balance="{{ number_format($payment->balance ?? 0, 2) }}"
                        data-status="{{ $ps }}"
                        data-proof="{{ $payment->proof_url ?? '' }}"
                        data-verified-by="{{ $payment->verified_by ?? '' }}"
                        data-verified-at="{{ isset($payment->verified_at) ? \Carbon\Carbon::parse($payment->verified_at)->format('M d, Y h:i A') : '' }}"
                        data-notes="{{ $payment->notes ?? '' }}"
                        data-date="{{ isset($payment->created_at) ? \Carbon\Carbon::parse($payment->created_at)->format('M d, Y h:i A') : '—' }}">

                        <td><span class="payment-ref">{{ $payment->reference_no ?? 'REF-00000' }}</span></td>

                        <td>
                            <a href="{{ route('finance.orders.index', ['search' => $payment->order_no ?? '']) }}"
                               class="order-ref" onclick="event.stopPropagation();">
                                #{{ $payment->order_no ?? '—' }}
                            </a>
                        </td>

                        <td class="name-cell">
                            {{ $payment->payer_name ?? '—' }}
                            <small>{{ $payment->payer_arbo ?? '' }}</small>
                        </td>

                        <td style="font-size:.83rem;">{{ $payment->payee_arbo ?? '—' }}</td>

                        <td>
                            @php
                                $method = strtolower($payment->payment_method ?? 'cash');
                                $methodIcons = ['gcash'=>'phone','bank_transfer'=>'bank2','cash'=>'cash','maya'=>'credit-card'];
                                $methodIcon  = $methodIcons[$method] ?? 'credit-card';
                            @endphp
                            <span class="method-badge">
                                <i class="bi bi-{{ $methodIcon }}"></i>
                                {{ ucwords(str_replace('_', ' ', $method)) }}
                            </span>
                        </td>

                        <td class="amount-cell">₱{{ number_format($payment->amount ?? 0, 2) }}</td>

                        <td style="font-size:.83rem;">
                            @if(($payment->balance ?? 0) > 0)
                                <span style="color:#c0392b;font-weight:700;">₱{{ number_format($payment->balance, 2) }}</span>
                            @else
                                <span style="color:var(--green-600);font-weight:600;">Settled</span>
                            @endif
                        </td>

                        <td>
                            @php
                                $statusMap = ['paid'=>'paid','pending'=>'pending','partial'=>'partial','overdue'=>'overdue','verified'=>'verified','rejected'=>'rejected','for_verification'=>'forverification','cancelled'=>'cancelled'];
                                $psCls     = $statusMap[$ps] ?? 'pending';
                                $psLabel   = ucwords(str_replace('_', ' ', $ps));
                            @endphp
                            <span class="status-badge status-{{ $psCls }}">
                                <span class="status-dot"></span> {{ $psLabel }}
                            </span>
                        </td>

                        <td>
                            @if($payment->proof_url ?? null)
                                <img src="{{ $payment->proof_url }}" alt="Proof" class="proof-thumb" onclick="event.stopPropagation(); openProofModal('{{ $payment->proof_url }}')">
                            @else
                                <span class="no-proof">None</span>
                            @endif
                        </td>

                        <td style="font-size:.78rem;color:var(--text-muted);">
                            {{ $payment->verified_by ?? '—' }}
                            @if($payment->verified_at ?? null)
                            <small class="d-block">{{ \Carbon\Carbon::parse($payment->verified_at)->format('M d') }}</small>
                            @endif
                        </td>

                        <td style="font-size:.78rem;color:var(--text-muted);white-space:nowrap;">
                            {{ isset($payment->created_at) ? \Carbon\Carbon::parse($payment->created_at)->format('M d, Y') : '—' }}
                        </td>

                        <td onclick="event.stopPropagation();">
                            <div class="d-flex gap-1 flex-wrap">
                                <!-- View Detail -->
                                <button type="button" class="btn-card-action view-detail-btn" data-row-id="{{ $payment->id ?? 0 }}">
                                    <i class="bi bi-eye-fill"></i>
                                </button>

                                <!-- Verify / Reject — Finance has Full access on Transaction Mgmt -->
                                @if(in_array($ps, ['for_verification', 'pending']))
                                <button type="button" class="btn-verify verify-btn"
                                        data-id="{{ $payment->id ?? 0 }}"
                                        data-ref="{{ $payment->reference_no ?? '' }}">
                                    <i class="bi bi-shield-check"></i> Verify
                                </button>
                                <button type="button" class="btn-reject reject-btn"
                                        data-id="{{ $payment->id ?? 0 }}"
                                        data-ref="{{ $payment->reference_no ?? '' }}">
                                    <i class="bi bi-x-circle"></i> Reject
                                </button>
                                @endif

                                <!-- Print Receipt -->
                                <button type="button" class="btn-card-action print-receipt-btn"
                                        data-id="{{ $payment->id ?? 0 }}"
                                        title="Print Receipt">
                                    <i class="bi bi-printer"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="12">
                            <div class="empty-state">
                                <i class="bi bi-credit-card-fill"></i>
                                <p>No payments found{{ request('search') ? ' matching "' . e(request('search')) . '"' : '' }}.</p>
                                @if(request()->hasAny(['search','date_range','method','arbo_id']))
                                <a href="{{ route('finance.payments.index') }}" class="btn-card-action mt-2 d-inline-flex">
                                    <i class="bi bi-arrow-counterclockwise"></i> Clear Filters
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(isset($payments) && method_exists($payments, 'links') && $payments->lastPage() > 1)
        <div class="pagination-wrap">
            <span class="pagination-info">
                Showing {{ $payments->firstItem() ?? 0 }}–{{ $payments->lastItem() ?? 0 }} of {{ number_format($payments->total()) }} payments
            </span>
            {{ $payments->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>

</main>

<!-- ── Payment Detail Offcanvas ───────────────────────── -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="paymentDetailOffcanvas">
    <div class="offcanvas-header">
        <div>
            <h6 class="mb-0" style="color:#fff;font-size:.82rem;letter-spacing:.06em;text-transform:uppercase;">Payment Details</h6>
            <div class="detail-ref mt-1" id="detailRef">REF-00000</div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-0" style="overflow-y:auto;">

        <!-- Payment Info -->
        <div class="detail-section">
            <div class="detail-section-title">Transaction Info</div>
            <div class="detail-row"><span class="detail-key">Order No.</span><span class="detail-val" id="dOrderNo">—</span></div>
            <div class="detail-row"><span class="detail-key">Payer</span><span class="detail-val" id="dPayer">—</span></div>
            <div class="detail-row"><span class="detail-key">Payer ARBO</span><span class="detail-val" id="dPayerArbo">—</span></div>
            <div class="detail-row"><span class="detail-key">Payee ARBO</span><span class="detail-val" id="dPayee">—</span></div>
            <div class="detail-row"><span class="detail-key">Date Submitted</span><span class="detail-val" id="dDate">—</span></div>
        </div>

        <!-- Financials -->
        <div class="detail-section">
            <div class="detail-section-title">Financials</div>
            <div class="detail-row"><span class="detail-key">Amount Paid</span><span class="detail-val amount-cell" id="dAmount">—</span></div>
            <div class="detail-row"><span class="detail-key">Balance Due</span><span class="detail-val" id="dBalance">—</span></div>
            <div class="detail-row"><span class="detail-key">Method</span><span class="detail-val" id="dMethod">—</span></div>
            <div class="detail-row"><span class="detail-key">Status</span><span class="detail-val" id="dStatus">—</span></div>
        </div>

        <!-- Verification -->
        <div class="detail-section">
            <div class="detail-section-title">Verification</div>
            <div class="detail-row"><span class="detail-key">Verified By</span><span class="detail-val" id="dVerifiedBy">—</span></div>
            <div class="detail-row"><span class="detail-key">Verified At</span><span class="detail-val" id="dVerifiedAt">—</span></div>
        </div>

        <!-- Proof of Payment -->
        <div class="detail-section">
            <div class="detail-section-title">Proof of Payment</div>
            <div id="dProofWrap">
                <div class="proof-placeholder">
                    <i class="bi bi-image"></i>
                    <span>No proof uploaded</span>
                </div>
            </div>
        </div>

        <!-- Notes -->
        <div class="detail-section" id="dNotesWrap" style="display:none;">
            <div class="detail-section-title">Notes / Remarks</div>
            <p id="dNotes" style="font-size:.83rem;color:var(--text-main);margin:0;"></p>
        </div>

        <!-- Offcanvas Actions -->
        <div class="detail-section d-flex gap-2 flex-wrap" id="dActionsWrap">
            <button type="button" class="btn-verify offcanvas-verify-btn">
                <i class="bi bi-shield-check"></i> Verify Payment
            </button>
            <button type="button" class="btn-reject offcanvas-reject-btn">
                <i class="bi bi-x-circle"></i> Reject
            </button>
            <button type="button" class="btn-card-action offcanvas-print-btn">
                <i class="bi bi-printer"></i> Print Receipt
            </button>
        </div>

    </div>
</div>

<!-- ── Proof Image Modal ──────────────────────────────── -->
<div class="modal fade" id="proofModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 bg-transparent shadow-none">
            <div class="modal-body p-2 text-center">
                <img id="proofModalImg" src="" alt="Payment Proof" style="max-width:100%;border-radius:12px;max-height:80vh;object-fit:contain;">
            </div>
        </div>
    </div>
</div>

<!-- ── Verify Confirmation Modal ──────────────────────── -->
<div class="modal fade" id="verifyModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-green">
                <h5 class="modal-title" style="font-size:.95rem;"><i class="bi bi-shield-check me-2"></i>Verify Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p style="font-size:.88rem;margin-bottom:.75rem;">
                    You are about to <strong>verify</strong> payment reference:
                </p>
                <div style="background:var(--green-50);border:1px solid var(--green-200);border-radius:8px;padding:.75rem 1rem;">
                    <span class="payment-ref" id="verifyModalRef">REF-00000</span>
                </div>
                <p style="font-size:.82rem;color:var(--text-muted);margin-top:.75rem;">
                    This will mark the payment as <strong>Verified</strong> and update the order's payment status. This action is logged.
                </p>
                <div class="mt-3">
                    <label style="font-size:.82rem;font-weight:600;margin-bottom:4px;display:block;">Remarks (optional)</label>
                    <textarea id="verifyRemarks" class="form-control form-control-sm" rows="2" placeholder="Add a note…" style="border-radius:8px;font-size:.82rem;"></textarea>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Cancel</button>
                <form id="verifyForm" method="POST" action="">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="action" value="verify">
                    <input type="hidden" name="remarks" id="verifyRemarksHidden">
                    <button type="submit" class="btn btn-sm" style="background:var(--green-700);color:#fff;border-radius:8px;font-weight:600;">
                        <i class="bi bi-shield-check me-1"></i> Confirm Verify
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ── Reject Confirmation Modal ──────────────────────── -->
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-red">
                <h5 class="modal-title" style="font-size:.95rem;"><i class="bi bi-x-circle me-2"></i>Reject Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p style="font-size:.88rem;margin-bottom:.75rem;">
                    You are about to <strong>reject</strong> payment reference:
                </p>
                <div style="background:#fdecea;border:1px solid #fbd8d4;border-radius:8px;padding:.75rem 1rem;">
                    <span class="payment-ref" style="color:#c0392b;" id="rejectModalRef">REF-00000</span>
                </div>
                <div class="mt-3">
                    <label style="font-size:.82rem;font-weight:600;margin-bottom:4px;display:block;">Reason for Rejection <span class="text-danger">*</span></label>
                    <textarea id="rejectReason" class="form-control form-control-sm" rows="3" placeholder="State the reason for rejection…" style="border-radius:8px;font-size:.82rem;" required></textarea>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Cancel</button>
                <form id="rejectForm" method="POST" action="">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="action" value="reject">
                    <input type="hidden" name="reason" id="rejectReasonHidden">
                    <button type="submit" id="rejectSubmitBtn" class="btn btn-sm" style="background:#c0392b;color:#fff;border-radius:8px;font-weight:600;">
                        <i class="bi bi-x-circle me-1"></i> Confirm Reject
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('swal'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const _swal = @json(session('swal'));
        if (typeof Swal !== 'undefined' && _swal) Swal.fire(_swal);
    });
</script>
@endif

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ── Date Label ─────────────────────────────────────
    const tbl = document.getElementById('tableDate');
    if (tbl) tbl.textContent = new Date().toLocaleDateString('en-PH', { year:'numeric', month:'long', day:'numeric' });

    // ── Mobile Sidebar ─────────────────────────────────
    const toggle  = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('mainSidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const openSidebar  = () => { sidebar.classList.add('show'); overlay.classList.add('show'); document.body.style.overflow = 'hidden'; };
    const closeSidebar = () => { sidebar.classList.remove('show'); overlay.classList.remove('show'); document.body.style.overflow = ''; };
    if (toggle)  toggle.addEventListener('click', openSidebar);
    if (overlay) overlay.addEventListener('click', closeSidebar);

    // ── Collections Bar Chart ──────────────────────────
    const colCtx = document.getElementById('collectionsChart');
    if (colCtx) {
        const labels    = {!! json_encode($chartLabels   ?? ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']) !!};
        const collected = {!! json_encode($chartCollected ?? [38000,52000,31000,87000,70000,81000,97000,64000,108000,91000,126000,135000]) !!};
        const pending   = {!! json_encode($chartPending   ?? [8000,12000,7000,15000,10000,9000,11000,13000,9000,14000,12000,8000]) !!};

        new Chart(colCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels,
                datasets: [
                    {
                        label: 'Collected (₱)',
                        data: collected,
                        backgroundColor: 'rgba(31,128,60,0.75)',
                        borderColor: 'rgba(31,128,60,1)',
                        borderWidth: 1, borderRadius: 6,
                    },
                    {
                        label: 'Pending (₱)',
                        data: pending,
                        backgroundColor: 'rgba(200,146,42,0.65)',
                        borderColor: 'rgba(200,146,42,1)',
                        borderWidth: 1, borderRadius: 6,
                    }
                ]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom', labels: { font: { size: 11 }, boxWidth: 12, padding: 14 } },
                    tooltip: {
                        callbacks: { label: c => ` ${c.dataset.label}: ₱${Number(c.raw).toLocaleString('en-PH', { minimumFractionDigits: 2 })}` },
                        backgroundColor: '#0d3b1e', titleColor: '#f5d08a', bodyColor: '#fff', padding: 10, cornerRadius: 8,
                    }
                },
                scales: {
                    x: { grid: { display: false }, ticks: { font: { size: 11 }, color: '#94a3b8' } },
                    y: {
                        grid: { color: '#f1f3f5' },
                        ticks: { font: { size: 11 }, color: '#94a3b8', callback: v => '₱' + (v >= 1000 ? (v/1000).toFixed(0)+'k' : v) },
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // ── Method Donut ───────────────────────────────────
    const methodCtx = document.getElementById('methodDonut');
    if (methodCtx) {
        const methodData = {!! json_encode($methodBreakdown ?? ['gcash'=>45,'bank_transfer'=>30,'cash'=>15,'maya'=>10]) !!};
        new Chart(methodCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['GCash', 'Bank Transfer', 'Cash', 'Maya'],
                datasets: [{
                    data: [
                        methodData.gcash        ?? 0,
                        methodData.bank_transfer ?? 0,
                        methodData.cash          ?? 0,
                        methodData.maya          ?? 0,
                    ],
                    backgroundColor: [
                        'rgba(31,128,60,0.82)',
                        'rgba(26,115,232,0.82)',
                        'rgba(200,146,42,0.82)',
                        'rgba(124,58,237,0.82)',
                    ],
                    borderColor: '#fff', borderWidth: 3, hoverOffset: 5,
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false, cutout: '65%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(ctx) {
                                const total = ctx.dataset.data.reduce((a,b) => a+b, 0);
                                const pct   = total > 0 ? ((ctx.raw/total)*100).toFixed(1) : 0;
                                return ` ${ctx.label}: ${ctx.raw}% (${pct}%)`;
                            }
                        }
                    }
                }
            }
        });
    }

    // ── Status badge helper ────────────────────────────
    function statusBadge(status) {
        const map = {
            paid: 'status-paid', pending: 'status-pending', partial: 'status-partial',
            overdue: 'status-overdue', verified: 'status-verified', rejected: 'status-rejected',
            for_verification: 'status-forverification', cancelled: 'status-cancelled',
        };
        const cls   = map[status] || 'status-pending';
        const label = status.replace(/_/g,' ').replace(/\b\w/g, c => c.toUpperCase());
        return `<span class="status-badge ${cls}"><span class="status-dot"></span> ${label}</span>`;
    }

    // ── Detail Offcanvas ───────────────────────────────
    const detailOffcanvas = new bootstrap.Offcanvas(document.getElementById('paymentDetailOffcanvas'));
    let currentPaymentId = null;

    function openDetail(row) {
        const d = row.dataset;
        currentPaymentId = d.id;

        document.getElementById('detailRef').textContent     = d.ref      || 'REF-00000';
        document.getElementById('dOrderNo').textContent      = '#' + (d.orderNo || '—');
        document.getElementById('dPayer').textContent        = d.payer    || '—';
        document.getElementById('dPayerArbo').textContent    = d.payerArbo|| '—';
        document.getElementById('dPayee').textContent        = d.payee    || '—';
        document.getElementById('dDate').textContent         = d.date     || '—';
        document.getElementById('dAmount').textContent       = '₱' + (d.amount || '0.00');
        document.getElementById('dBalance').innerHTML        = parseFloat((d.balance || '0').replace(/,/g,'')) > 0
            ? `<span style="color:#c0392b;font-weight:700;">₱${d.balance}</span>`
            : `<span style="color:var(--green-600);">Settled</span>`;
        document.getElementById('dMethod').textContent       = d.method   || '—';
        document.getElementById('dStatus').innerHTML         = statusBadge(d.status || 'pending');
        document.getElementById('dVerifiedBy').textContent   = d.verifiedBy || '—';
        document.getElementById('dVerifiedAt').textContent   = d.verifiedAt || '—';

        // Proof
        const proofWrap = document.getElementById('dProofWrap');
        if (d.proof) {
            proofWrap.innerHTML = `<img src="${d.proof}" alt="Proof of Payment" class="proof-preview" onclick="openProofModal('${d.proof}')">`;
        } else {
            proofWrap.innerHTML = `<div class="proof-placeholder"><i class="bi bi-image"></i><span>No proof uploaded</span></div>`;
        }

        // Notes
        const notesWrap = document.getElementById('dNotesWrap');
        if (d.notes) {
            notesWrap.style.display = '';
            document.getElementById('dNotes').textContent = d.notes;
        } else {
            notesWrap.style.display = 'none';
        }

        // Show/hide verify & reject in offcanvas
        const actionsWrap = document.getElementById('dActionsWrap');
        const verifiable = ['for_verification', 'pending'].includes(d.status || '');
        document.querySelector('.offcanvas-verify-btn').style.display = verifiable ? '' : 'none';
        document.querySelector('.offcanvas-reject-btn').style.display = verifiable ? '' : 'none';

        // Wire offcanvas buttons
        document.querySelector('.offcanvas-verify-btn').onclick = () => {
            detailOffcanvas.hide();
            openVerifyModal(d.id, d.ref);
        };
        document.querySelector('.offcanvas-reject-btn').onclick = () => {
            detailOffcanvas.hide();
            openRejectModal(d.id, d.ref);
        };
        document.querySelector('.offcanvas-print-btn').onclick = () => {
            window.open(`{{ url('finance/payments') }}/${d.id}/receipt`, '_blank');
        };

        detailOffcanvas.show();
    }

    // Row click
    document.querySelectorAll('.payment-row').forEach(row => {
        row.addEventListener('click', () => openDetail(row));
    });

    // View detail btn
    document.querySelectorAll('.view-detail-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            openDetail(this.closest('tr'));
        });
    });

    // ── Verify / Reject Modals ─────────────────────────
    const verifyModal = new bootstrap.Modal(document.getElementById('verifyModal'));
    const rejectModal = new bootstrap.Modal(document.getElementById('rejectModal'));

    function openVerifyModal(id, ref) {
        document.getElementById('verifyModalRef').textContent = ref || 'REF-00000';
        document.getElementById('verifyForm').action = `/finance/payments/${id}/status`;
        document.getElementById('verifyRemarks').value = '';
        verifyModal.show();
    }

    function openRejectModal(id, ref) {
        document.getElementById('rejectModalRef').textContent = ref || 'REF-00000';
        document.getElementById('rejectForm').action = `/finance/payments/${id}/status`;
        document.getElementById('rejectReason').value = '';
        rejectModal.show();
    }

    document.querySelectorAll('.verify-btn').forEach(btn => {
        btn.addEventListener('click', e => { e.stopPropagation(); openVerifyModal(btn.dataset.id, btn.dataset.ref); });
    });

    document.querySelectorAll('.reject-btn').forEach(btn => {
        btn.addEventListener('click', e => { e.stopPropagation(); openRejectModal(btn.dataset.id, btn.dataset.ref); });
    });

    // Transfer remarks/reason to hidden inputs on submit
    document.getElementById('verifyForm').addEventListener('submit', function() {
        document.getElementById('verifyRemarksHidden').value = document.getElementById('verifyRemarks').value;
    });

    document.getElementById('rejectForm').addEventListener('submit', function(e) {
        const reason = document.getElementById('rejectReason').value.trim();
        if (!reason) { e.preventDefault(); document.getElementById('rejectReason').focus(); return; }
        document.getElementById('rejectReasonHidden').value = reason;
    });

    // Print receipt
    document.querySelectorAll('.print-receipt-btn').forEach(btn => {
        btn.addEventListener('click', e => {
            e.stopPropagation();
            window.open(`{{ url('finance/payments') }}/${btn.dataset.id}/receipt`, '_blank');
        });
    });

    // ── Export ─────────────────────────────────────────
    document.getElementById('exportBtn')?.addEventListener('click', function(e) {
        e.preventDefault();
        const params = new URLSearchParams(window.location.search);
        params.set('export', 'csv');
        window.location.href = '{{ route('finance.payments.index') }}?' + params.toString();
    });

    document.getElementById('printBtn')?.addEventListener('click', function(e) {
        e.preventDefault();
        window.print();
    });

});

// Global proof modal opener
function openProofModal(src) {
    const img = document.getElementById('proofModalImg');
    if (img) img.src = src;
    const modal = new bootstrap.Modal(document.getElementById('proofModal'));
    modal.show();
}
</script>

<!-- Inactivity Warning Modal + Logout Script -->
<form id="inactivityLogoutForm" method="POST" action="{{ route('logout') }}" style="display:none;">@csrf</form>

<div class="modal fade" id="inactivityWarningModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-4">
                <h5 class="mb-2">You're about to be signed out</h5>
                <p class="mb-3">For your security, you'll be logged out in <strong id="idleCountdown">10</strong> seconds due to inactivity.</p>
                <button id="idleStayBtn" type="button" class="btn btn-success">Stay signed in</button>
            </div>
        </div>
    </div>
</div>

<script>
(function(){
    const INACTIVITY_MS = 15 * 60 * 1000;
    const WARNING_MS    = 10 * 1000;
    let lastActivity = Date.now(), performedLogout = false, warningShown = false,
        countdownInterval = null, modalInstance = null;

    function getCsrf(){
        const form = document.getElementById('inactivityLogoutForm');
        const t = form ? form.querySelector('input[name="_token"]') : null;
        return t ? t.value : (document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '');
    }

    async function performLogout(){
        if (performedLogout) return; performedLogout = true;
        try { await fetch('{{ route('logout') }}', { method:'POST', credentials:'same-origin', body: new URLSearchParams({ _token: getCsrf() }) }); } catch(e){}
        setTimeout(() => { window.location = '/login'; }, 200);
    }

    function showWarning(){
        if (warningShown || performedLogout) return; warningShown = true;
        const modalEl = document.getElementById('inactivityWarningModal');
        const countEl = document.getElementById('idleCountdown');
        if (!modalInstance) modalInstance = new bootstrap.Modal(modalEl, { backdrop:'static', keyboard:false });
        modalInstance.show();
        let seconds = Math.ceil(WARNING_MS/1000);
        if (countEl) countEl.textContent = seconds;
        countdownInterval = setInterval(() => {
            seconds -= 1;
            if (countEl) countEl.textContent = Math.max(0, seconds);
            if (seconds <= 0) { clearInterval(countdownInterval); countdownInterval = null; performLogout(); }
        }, 1000);
    }

    function hideWarning(){
        if (!warningShown) return; warningShown = false;
        if (countdownInterval) { clearInterval(countdownInterval); countdownInterval = null; }
        if (modalInstance) modalInstance.hide();
        const countEl = document.getElementById('idleCountdown');
        if (countEl) countEl.textContent = Math.ceil(WARNING_MS/1000);
    }

    function markActivity(e){
        if (e && e.isTrusted === false) return;
        if (performedLogout) return;
        lastActivity = Date.now();
        if (warningShown) hideWarning();
    }

    ['click','mousemove','keydown','touchstart','scroll'].forEach(evt => window.addEventListener(evt, markActivity, { passive:true }));
    document.getElementById('idleStayBtn')?.addEventListener('click', markActivity);
    setInterval(() => {
        if (Date.now() - lastActivity >= INACTIVITY_MS - WARNING_MS && !warningShown && !performedLogout) showWarning();
    }, 1000);
})();
</script>

</body>
</html>