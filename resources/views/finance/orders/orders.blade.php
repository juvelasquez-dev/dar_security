<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Finance — Orders</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
        /* ─── Design Tokens + Base (copied from dashboard) ───────────────────────── */
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
            --shadow-lg:  0 16px 48px rgba(13,59,30,0.13);
            --radius:     14px;
            --radius-sm:  9px;
            --sidebar-w:  260px;
        }

        /* Base box-sizing and body from dashboard design */
        *, *::before, *::after { box-sizing: border-box; }

        body {
            font-family: 'DM Sans', system-ui, sans-serif;
            background: var(--gray-100);
            color: var(--text-main);
            min-height: 100vh;
        }

        /* ─── Navbar base from dashboard (ensures consistent look) */
        .top-navbar {
            background: var(--green-900);
            height: 62px;
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1040;
            box-shadow: 0 2px 12px rgba(0,0,0,0.22);
        }

        .navbar-brand-area { display: flex; align-items: center; gap: 0.65rem; text-decoration: none; flex-shrink: 0; }

        .navbar-brand-area img { height: 38px; filter: brightness(1.15); }

        .navbar-system-title { font-family: 'DM Serif Display', serif; font-size: 1.18rem; color: #fff; letter-spacing: 0.01em; line-height: 1.15; }

        .navbar-system-sub { font-size: 0.68rem; color: var(--green-200); letter-spacing: 0.06em; text-transform: uppercase; font-weight: 500; }

        .nav-icon-btn { background: none; border: none; color: rgba(255,255,255,0.75); font-size: 1.15rem; cursor: pointer; padding: 6px 8px; border-radius: 8px; position: relative; transition: color 0.18s, background 0.18s; }

        .nav-icon-btn:hover { color: #fff; background: rgba(255,255,255,0.08); }

        .user-pill { display: flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); border-radius: 30px; padding: 5px 12px 5px 6px; cursor: pointer; transition: background 0.18s; text-decoration: none; }

        /* ─── Sidebar base */
        .sidebar { position: fixed; top: 62px; left: 0; bottom: 0; width: var(--sidebar-w); background: #fff; border-right: 1px solid var(--gray-200); overflow-y: auto; z-index: 1030; display: flex; flex-direction: column; box-shadow: var(--shadow-sm); transition: transform 0.28s cubic-bezier(.4,0,.2,1); }

        .sidebar-inner { padding: 1.5rem 1rem; flex: 1; display: flex; flex-direction: column; }

        /* ─── Keep existing view-specific styles below (unchanged) */

        .navbar-page-badge {
            background: rgba(200,146,42,0.18);
            border: 1px solid rgba(200,146,42,0.35);
            color: var(--gold-mid);
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            padding: 3px 10px;
            border-radius: 20px;
            margin-left: 1rem;
        }

        .navbar-divider {
            width: 1px; height: 28px;
            background: rgba(255,255,255,0.12);
            margin: 0 1.25rem;
        }

        .navbar-right {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .nav-icon-btn {
            background: none; border: none;
            color: rgba(255,255,255,0.75);
        }
        .sidebar-office-chip .office-name {
            font-size: 0.82rem; font-weight: 600; color: var(--green-900); margin-top: 1px;
        }

        /* ─── Page Wrapper ──────────────────────────────────── */
        .page-wrapper {
            margin-left: var(--sidebar-w);
            margin-top: 62px;
            min-height: calc(100vh - 62px);
            padding: 2rem 2rem 3rem;
        }

        /* ─── Page Header ───────────────────────────────────── */
        .page-header {
            display: flex; align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;
        }
        .page-header-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.6rem; color: var(--green-900);
            margin: 0 0 2px; line-height: 1.2;
        }
        .page-header-sub { font-size: 0.85rem; color: var(--text-muted); margin: 0; }

        /* ─── Summary Stat Cards ────────────────────────────── */
        .stat-card {
            background: #fff; border-radius: var(--radius);
            box-shadow: var(--shadow-sm); padding: 1.2rem 1.4rem;
            display: flex; align-items: center; gap: 1rem;
            transition: box-shadow 0.22s, transform 0.22s;
            border: 1px solid var(--gray-200); height: 100%;
        }
        .stat-card:hover { box-shadow: var(--shadow-md); transform: translateY(-3px); }

        .stat-icon-wrap {
            width: 48px; height: 48px; border-radius: 11px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.25rem; flex-shrink: 0;
        }
        .stat-icon-green  { background: var(--green-100); color: var(--green-700); }
        .stat-icon-gold   { background: var(--gold-light); color: var(--gold); }
        .stat-icon-blue   { background: #e8f0fe; color: #1a73e8; }
        .stat-icon-teal   { background: #e0f7f5; color: #0d8a7e; }
        .stat-icon-red    { background: #fdecea; color: #c0392b; }
        .stat-icon-indigo { background: #eef0ff; color: #4f46e5; }

        .stat-value { font-size: 1.8rem; font-weight: 700; color: var(--text-main); line-height: 1; margin-bottom: 3px; }
        .stat-label { font-size: 0.8rem; font-weight: 500; color: var(--text-muted); margin: 0; }

        /* ─── Filter Bar ────────────────────────────────────── */
        .filter-bar {
            background: #fff; border-radius: var(--radius);
            border: 1px solid var(--gray-200); box-shadow: var(--shadow-sm);
            padding: 1rem 1.25rem; margin-bottom: 1.25rem;
            display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap;
        }

        .filter-label {
            font-size: 0.75rem; font-weight: 700; color: var(--gray-600);
            letter-spacing: 0.05em; text-transform: uppercase;
            white-space: nowrap; margin-right: 0.25rem;
        }

        .filter-select {
            font-size: 0.82rem; border-radius: 8px; border: 1px solid var(--gray-200);
            padding: 6px 10px; color: var(--text-main); background: var(--gray-50);
            transition: border-color 0.18s;
        }
        .filter-select:focus { border-color: var(--green-500); outline: none; box-shadow: 0 0 0 3px rgba(31,128,60,0.1); }

        .search-wrap { position: relative; flex: 1; min-width: 180px; max-width: 320px; }
        .search-wrap i { position: absolute; left: 10px; top: 50%; transform: translateY(-50%); color: var(--gray-400); font-size: 0.85rem; }
        .search-input {
            width: 100%; padding: 7px 10px 7px 30px;
            border: 1px solid var(--gray-200); border-radius: 8px;
            font-size: 0.82rem; background: var(--gray-50);
            transition: border-color 0.18s;
        }
        .search-input:focus { border-color: var(--green-500); outline: none; box-shadow: 0 0 0 3px rgba(31,128,60,0.1); }
        .search-input::placeholder { color: var(--gray-400); }

        .btn-export {
            background: var(--green-700); color: #fff;
            border: none; border-radius: 8px; font-size: 0.82rem;
            font-weight: 600; padding: 7px 14px;
            display: inline-flex; align-items: center; gap: 5px;
            cursor: pointer; transition: background 0.18s; text-decoration: none;
            margin-left: auto;
        }
        .btn-export:hover { background: var(--green-800); color: #fff; }

        /* ─── Tab Pills ─────────────────────────────────────── */
        .tab-pill-wrap {
            display: flex; gap: 0.4rem; flex-wrap: wrap; margin-bottom: 1rem;
        }

        .tab-pill {
            padding: 6px 16px; border-radius: 20px;
            font-size: 0.78rem; font-weight: 600; cursor: pointer;
            border: 1.5px solid var(--gray-200); background: #fff;
            color: var(--gray-600); transition: all 0.18s; text-decoration: none;
            display: inline-flex; align-items: center; gap: 5px;
        }
        .tab-pill:hover { border-color: var(--green-400); color: var(--green-700); }
        .tab-pill.active { background: var(--green-700); border-color: var(--green-700); color: #fff; }
        .tab-pill-count {
            background: rgba(255,255,255,0.25); border-radius: 10px;
            padding: 1px 6px; font-size: 0.7rem; font-weight: 700;
        }
        .tab-pill:not(.active) .tab-pill-count { background: var(--gray-100); color: var(--gray-600); }

        /* ─── Table Card ────────────────────────────────────── */
        .table-card {
            background: #fff; border-radius: var(--radius);
            box-shadow: var(--shadow-sm); border: 1px solid var(--gray-200);
            overflow: hidden;
        }

        .table-card-header {
            padding: 1rem 1.5rem 0.9rem;
            border-bottom: 1px solid var(--gray-200);
            display: flex; align-items: center;
            justify-content: space-between; flex-wrap: wrap; gap: 0.5rem;
        }

        .table-card-title {
            font-size: 0.9rem; font-weight: 700;
            color: var(--text-main); margin: 0;
            display: flex; align-items: center; gap: 0.45rem;
        }
        .table-card-title i { color: var(--green-600); }

        .table-responsive { overflow-x: auto; }

        .fin-table { width: 100%; border-collapse: collapse; font-size: 0.84rem; }

        .fin-table thead th {
            background: var(--green-50); color: var(--green-800);
            font-weight: 700; font-size: 0.72rem;
            letter-spacing: 0.05em; text-transform: uppercase;
            padding: 0.7rem 1.1rem;
            border-bottom: 1px solid var(--green-200); white-space: nowrap;
        }

        .fin-table thead th.sortable { cursor: pointer; user-select: none; }
        .fin-table thead th.sortable:hover { background: var(--green-100); }
        .fin-table thead th .sort-icon { margin-left: 4px; color: var(--gray-400); font-size: 0.65rem; }
        .fin-table thead th.sort-asc .sort-icon::before { content: '▲'; color: var(--green-600); }
        .fin-table thead th.sort-desc .sort-icon::before { content: '▼'; color: var(--green-600); }

        .fin-table tbody tr { border-bottom: 1px solid var(--gray-100); transition: background 0.14s; }
        .fin-table tbody tr:last-child { border-bottom: none; }
        .fin-table tbody tr:hover { background: var(--gray-50); }

        .fin-table td { padding: 0.78rem 1.1rem; vertical-align: middle; color: var(--text-main); }

        .order-no {
            font-family: 'Courier New', monospace; font-weight: 700;
            font-size: 0.82rem; color: var(--green-700);
        }

        .name-cell { font-weight: 600; color: var(--green-800); }
        .name-cell small { display: block; font-weight: 400; font-size: 0.72rem; color: var(--text-muted); margin-top: 1px; }

        .amount-cell { font-weight: 700; color: var(--green-800); font-size: 0.88rem; }

        /* ─── Status Badges ─────────────────────────────────── */
        .status-badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 3px 10px; border-radius: 20px;
            font-size: 0.72rem; font-weight: 600;
        }
        .status-dot { width: 6px; height: 6px; border-radius: 50%; display: inline-block; background: currentColor; }

        .status-paid       { background: var(--green-100); color: var(--green-700); }
        .status-pending    { background: var(--gold-light); color: var(--gold); }
        .status-cancelled  { background: #fdecea; color: #c0392b; }
        .status-processing { background: #e0f7f5; color: #0d8a7e; }
        .status-completed  { background: #e8f0fe; color: #1a73e8; }
        .status-partial    { background: #f3e8ff; color: #7c3aed; }
        .status-shipped    { background: #fff3e0; color: #e65100; }
        .status-delivered  { background: #e8f5e9; color: #2e7d32; }

        /* ─── View Button ───────────────────────────────────── */
        .btn-card-action {
            background: var(--green-100); color: var(--green-700);
            border: none; font-size: 0.78rem; border-radius: 8px;
            font-weight: 600; padding: 5px 12px; text-decoration: none;
            display: inline-flex; align-items: center; gap: 4px;
            transition: background 0.15s; white-space: nowrap;
        }
        .btn-card-action:hover { background: #d0ebd8; color: var(--green-900); }

        /* ─── Pagination ────────────────────────────────────── */
        .pagination-wrap {
            padding: 12px 20px; border-top: 1px solid var(--gray-100);
            display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.5rem;
        }
        .pagination-info { font-size: 0.78rem; color: var(--text-muted); }

        /* ─── Empty State ───────────────────────────────────── */
        .empty-state {
            text-align: center; padding: 3.5rem 1rem;
            color: var(--gray-400);
        }
        .empty-state i { font-size: 2.5rem; display: block; margin-bottom: 0.75rem; }
        .empty-state p { font-size: 0.85rem; margin: 0; }

        /* ─── Read-only Notice ──────────────────────────────── */
        .readonly-notice {
            background: var(--gold-light);
            border: 1px solid var(--gold-mid);
            border-radius: var(--radius-sm);
            padding: 0.6rem 1rem;
            font-size: 0.78rem;
            color: #7a5a10;
            display: flex; align-items: center; gap: 0.5rem;
            margin-bottom: 1.25rem;
        }

        /* ─── Order Detail Offcanvas ────────────────────────── */
        .offcanvas { width: 520px !important; }

        .offcanvas-header {
            background: var(--green-900); color: #fff;
            padding: 1.1rem 1.5rem;
        }
        .offcanvas-header .btn-close { filter: invert(1) brightness(2); }

        .detail-section {
            border-bottom: 1px solid var(--gray-200);
            padding: 1.1rem 1.5rem;
        }
        .detail-section:last-child { border-bottom: none; }

        .detail-section-title {
            font-size: 0.7rem; font-weight: 700; letter-spacing: 0.09em;
            text-transform: uppercase; color: var(--gray-400); margin-bottom: 0.75rem;
        }

        .detail-row {
            display: flex; justify-content: space-between;
            align-items: flex-start; gap: 1rem;
            font-size: 0.83rem; margin-bottom: 0.5rem;
        }
        .detail-row:last-child { margin-bottom: 0; }
        .detail-key { color: var(--text-muted); flex-shrink: 0; font-weight: 500; }
        .detail-val { color: var(--text-main); font-weight: 600; text-align: right; }

        .detail-order-no {
            font-family: 'Courier New', monospace; font-size: 1rem;
            font-weight: 700; color: var(--green-700);
        }

        .timeline { list-style: none; padding: 0; margin: 0; }
        .timeline-item { display: flex; gap: 0.85rem; margin-bottom: 0.85rem; }
        .timeline-item:last-child { margin-bottom: 0; }
        .timeline-dot-wrap { display: flex; flex-direction: column; align-items: center; }
        .timeline-dot {
            width: 10px; height: 10px; border-radius: 50%;
            background: var(--green-600); border: 2px solid #fff;
            box-shadow: 0 0 0 2px var(--green-200); flex-shrink: 0; margin-top: 3px;
        }
        .timeline-dot.pending { background: var(--gold); box-shadow: 0 0 0 2px var(--gold-mid); }
        .timeline-dot.cancelled { background: #c0392b; box-shadow: 0 0 0 2px #fbd8d4; }
        .timeline-line { width: 1px; flex: 1; background: var(--gray-200); margin: 3px 0; min-height: 18px; }
        .timeline-content { flex: 1; min-width: 0; }
        .timeline-event { font-size: 0.82rem; font-weight: 600; color: var(--text-main); }
        .timeline-time { font-size: 0.72rem; color: var(--text-muted); }

        .items-table { width: 100%; font-size: 0.82rem; border-collapse: collapse; }
        .items-table th { color: var(--gray-600); font-weight: 600; font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.04em; padding-bottom: 0.5rem; border-bottom: 1px solid var(--gray-200); }
        .items-table td { padding: 0.5rem 0; border-bottom: 1px solid var(--gray-100); }
        .items-table tr:last-child td { border-bottom: none; }

        /* ─── Mobile ────────────────────────────────────────── */
        .mobile-sidebar-toggle {
            display: none; background: none; border: none;
            color: #fff; font-size: 1.3rem; margin-right: 0.75rem; cursor: pointer;
        }

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

        <!-- Notifications -->
        <div class="dropdown">
            <button class="nav-icon-btn" data-bs-toggle="dropdown" aria-label="Notifications">
                <i class="bi bi-bell"></i>
                <span class="nav-notif-dot"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0"
                style="min-width:280px; border-radius:12px; margin-top:8px;">
                <li class="px-3 py-2 border-bottom">
                    <span class="fw-bold" style="font-size:.82rem;">Notifications</span>
                </li>
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
                <li>
                    <a class="dropdown-item py-2" href="#" style="font-size:.82rem;">
                        <i class="bi bi-bag-check text-primary me-2"></i> New ARBO order placed
                        <div class="text-muted" style="font-size:.72rem; padding-left:1.4rem;">Yesterday</div>
                    </a>
                </li>
                <li class="border-top">
                    <a class="dropdown-item text-center py-2"
                       href="{{ route('finance.activity-logs') }}"
                       style="font-size:.78rem; color:var(--green-700);">
                        View all notifications
                    </a>
                </li>
            </ul>
        </div>

        <div class="navbar-divider d-none d-sm-block"></div>

        <!-- User Dropdown -->
        <div class="dropdown">
            <a class="user-pill dropdown-toggle" href="#" data-bs-toggle="dropdown">
                <img class="user-avatar"
                     src="{{ optional(auth()->user())->avatar
                            ?: 'https://ui-avatars.com/api/?name=' . urlencode(optional(auth()->user())->name ?? 'Finance Admin') . '&background=1a6932&color=fff&rounded=true&size=64' }}"
                     alt="User avatar">
                <div class="d-none d-md-block" style="line-height:1.2;">
                    <div class="user-pill-name">{{ optional(auth()->user())->name ?? 'Finance Admin' }}</div>
                    <div class="user-pill-role">Admin / Finance</div>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0"
                style="border-radius:12px; margin-top:8px; min-width:200px;">
                <li class="px-3 py-2 border-bottom">
                    <div class="fw-bold" style="font-size:.83rem;">{{ optional(auth()->user())->name ?? 'Finance Admin' }}</div>
                    <div class="text-muted" style="font-size:.72rem;">{{ optional(auth()->user())->email ?? '' }}</div>
                </li>
                <li>
                    <a class="dropdown-item py-2" href="{{ route('finance.profile') }}" style="font-size:.84rem;">
                        <i class="bi bi-person me-2 text-muted"></i>Profile
                    </a>
                </li>
                <li class="border-top">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item py-2 text-danger" type="submit" style="font-size:.84rem;">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </button>
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

        <a href="{{ route('finance.dashboard') }}"
           class="sidebar-link {{ request()->routeIs('finance.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <a href="{{ route('finance.orders.index') }}"
           class="sidebar-link {{ request()->routeIs('finance.orders.*') ? 'active' : '' }}">
            <i class="bi bi-bag-check"></i> Orders
        </a>

        <a href="{{ route('finance.payments.index') }}"
           class="sidebar-link {{ request()->routeIs('finance.payments.*') ? 'active' : '' }}">
            <i class="bi bi-credit-card-2-front"></i> Payments
        </a>

        <a href="{{ route('finance.revenue.index') }}"
           class="sidebar-link {{ request()->routeIs('finance.revenue.*') ? 'active' : '' }}">
            <i class="bi bi-graph-up-arrow"></i> Revenue Monitoring
        </a>

        <span class="sidebar-section-label">Sales Report</span>

        <a href="{{ route('finance.reports.sales') }}"
           class="sidebar-link {{ request()->routeIs('finance.reports.*') ? 'active' : '' }}">
            <i class="bi bi-bar-chart-line"></i> Sales Report
        </a>

        <span class="sidebar-section-label">System</span>

        <a href="{{ route('finance.activity-logs') }}"
           class="sidebar-link {{ request()->routeIs('finance.activity-logs') ? 'active' : '' }}">
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
                <i class="bi bi-bag-check me-2" style="color:var(--green-600); font-size:1.3rem;"></i>
                Orders
            </h1>
            <p class="page-header-sub">
                View and monitor all ARBO purchase orders across <strong>E-Agraryo Merkado</strong>.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('finance.reports.sales') }}" class="btn-export" style="background:var(--green-50);color:var(--green-700);border:1px solid var(--green-200);">
                <i class="bi bi-bar-chart-line"></i> Sales Report
            </a>
            <a href="#" class="btn-export ms-2" id="exportBtn">
                <i class="bi bi-download"></i> Export CSV
            </a>
        </div>
    </div>

    <!-- Read-only notice for Finance role -->
    <div class="readonly-notice">
        <i class="bi bi-info-circle-fill"></i>
        <span>Finance role has <strong>view-only</strong> access to orders. To process or modify orders, contact the ARBO or PBDD admin.</span>
    </div>

    <!-- ── Summary Cards ──────────────────────────────── -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-green">
                    <i class="bi bi-bag-fill"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $totalOrders ?? '—' }}</div>
                    <p class="stat-label">Total Orders</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-blue">
                    <i class="bi bi-arrow-repeat"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $processingOrders ?? '—' }}</div>
                    <p class="stat-label">Processing</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-teal">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $completedOrders ?? '—' }}</div>
                    <p class="stat-label">Completed</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-red">
                    <i class="bi bi-x-circle-fill"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $cancelledOrders ?? '—' }}</div>
                    <p class="stat-label">Cancelled</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ── Status Tabs ────────────────────────────────── -->
    <div class="tab-pill-wrap">
        <a href="{{ route('finance.orders.index') }}"
           class="tab-pill {{ !request('status') ? 'active' : '' }}">
            All
            <span class="tab-pill-count">{{ $totalOrders ?? 0 }}</span>
        </a>
        <a href="{{ route('finance.orders.index', ['status' => 'processing']) }}"
           class="tab-pill {{ request('status') === 'processing' ? 'active' : '' }}">
            <i class="bi bi-arrow-repeat"></i> Processing
            <span class="tab-pill-count">{{ $processingOrders ?? 0 }}</span>
        </a>
        <a href="{{ route('finance.orders.index', ['status' => 'completed']) }}"
           class="tab-pill {{ request('status') === 'completed' ? 'active' : '' }}">
            <i class="bi bi-check-circle"></i> Completed
            <span class="tab-pill-count">{{ $completedOrders ?? 0 }}</span>
        </a>
        <a href="{{ route('finance.orders.index', ['status' => 'pending']) }}"
           class="tab-pill {{ request('status') === 'pending' ? 'active' : '' }}">
            <i class="bi bi-hourglass-split"></i> Pending
            <span class="tab-pill-count">{{ $pendingOrders ?? 0 }}</span>
        </a>
        <a href="{{ route('finance.orders.index', ['status' => 'cancelled']) }}"
           class="tab-pill {{ request('status') === 'cancelled' ? 'active' : '' }}">
            <i class="bi bi-x-circle"></i> Cancelled
            <span class="tab-pill-count">{{ $cancelledOrders ?? 0 }}</span>
        </a>
    </div>

    <!-- ── Filter Bar ──────────────────────────────────── -->
    <form method="GET" action="{{ route('finance.orders.index') }}" id="filterForm">
        <input type="hidden" name="status" value="{{ request('status') }}">
        <div class="filter-bar">
            <span class="filter-label"><i class="bi bi-funnel me-1"></i>Filters</span>

            <!-- Date Range -->
            <select name="date_range" class="filter-select" onchange="document.getElementById('filterForm').submit()">
                <option value="">All Time</option>
                <option value="today"     {{ request('date_range') === 'today'     ? 'selected' : '' }}>Today</option>
                <option value="this_week" {{ request('date_range') === 'this_week' ? 'selected' : '' }}>This Week</option>
                <option value="this_month"{{ request('date_range') === 'this_month'? 'selected' : '' }}>This Month</option>
                <option value="last_month"{{ request('date_range') === 'last_month'? 'selected' : '' }}>Last Month</option>
                <option value="this_year" {{ request('date_range') === 'this_year' ? 'selected' : '' }}>This Year</option>
            </select>

            <!-- Payment Status -->
            <select name="payment_status" class="filter-select" onchange="document.getElementById('filterForm').submit()">
                <option value="">All Payments</option>
                <option value="paid"      {{ request('payment_status') === 'paid'      ? 'selected' : '' }}>Paid</option>
                <option value="pending"   {{ request('payment_status') === 'pending'   ? 'selected' : '' }}>Pending</option>
                <option value="partial"   {{ request('payment_status') === 'partial'   ? 'selected' : '' }}>Partial</option>
                <option value="cancelled" {{ request('payment_status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>

            <!-- ARBO Filter -->
            <select name="arbo_id" class="filter-select" onchange="document.getElementById('filterForm').submit()">
                <option value="">All ARBOs</option>
                @foreach($arbos ?? [] as $arbo)
                <option value="{{ $arbo->id }}" {{ request('arbo_id') == $arbo->id ? 'selected' : '' }}>
                    {{ $arbo->name }}
                </option>
                @endforeach
            </select>

            <!-- Search -->
            <div class="search-wrap">
                <i class="bi bi-search"></i>
                <input type="text" name="search" class="search-input"
                       placeholder="Search order no., ARBO…"
                       value="{{ request('search') }}"
                       onchange="document.getElementById('filterForm').submit()">
            </div>

            <!-- Sort -->
            <select name="sort" class="filter-select" onchange="document.getElementById('filterForm').submit()">
                <option value="newest" {{ request('sort', 'newest') === 'newest' ? 'selected' : '' }}>Newest First</option>
                <option value="oldest" {{ request('sort') === 'oldest'           ? 'selected' : '' }}>Oldest First</option>
                <option value="amount_desc" {{ request('sort') === 'amount_desc' ? 'selected' : '' }}>Amount ↓</option>
                <option value="amount_asc"  {{ request('sort') === 'amount_asc'  ? 'selected' : '' }}>Amount ↑</option>
            </select>

            @if(request()->hasAny(['search','date_range','payment_status','arbo_id','sort']))
            <a href="{{ route('finance.orders.index') }}" class="filter-select text-decoration-none" style="color:#c0392b;background:#fdecea;border-color:#fbd8d4;">
                <i class="bi bi-x-circle me-1"></i> Clear
            </a>
            @endif
        </div>
    </form>

    <!-- ── Orders Table ────────────────────────────────── -->
    <div class="table-card">
        <div class="table-card-header">
            <h6 class="table-card-title">
                <i class="bi bi-receipt-cutoff"></i>
                Order List
                @if($orders->total() ?? false)
                <span style="font-size:.72rem;font-weight:400;color:var(--text-muted);margin-left:6px;">
                    {{ number_format($orders->total()) }} records
                </span>
                @endif
            </h6>
            <span style="font-size:.73rem;color:var(--text-muted);" id="tableDate"></span>
        </div>

        <div class="table-responsive">
            <table class="fin-table">
                <thead>
                    <tr>
                        <th class="sortable" data-col="order_no">
                            Order No <span class="sort-icon"></span>
                        </th>
                        <th>Buyer (ARBO)</th>
                        <th>Seller (ARBO)</th>
                        <th>Products</th>
                        <th class="sortable" data-col="amount">
                            Amount <span class="sort-icon"></span>
                        </th>
                        <th>Payment</th>
                        <th>Order Status</th>
                        <th>Delivery</th>
                        <th class="sortable" data-col="created_at">
                            Date <span class="sort-icon"></span>
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders ?? [] as $order)
                    <tr class="order-row" style="cursor:pointer;"
                        data-id="{{ $order->id ?? 0 }}"
                        data-order-no="{{ $order->order_no ?? '' }}"
                        data-buyer="{{ $order->buyer_name ?? '—' }}"
                        data-buyer-arbo="{{ $order->buyer_arbo ?? '' }}"
                        data-seller="{{ $order->seller_arbo ?? '—' }}"
                        data-amount="{{ number_format($order->amount ?? 0, 2) }}"
                        data-payment-status="{{ $order->payment_status ?? 'pending' }}"
                        data-order-status="{{ $order->order_status ?? 'processing' }}"
                        data-delivery="{{ $order->delivery_status ?? 'pending' }}"
                        data-date="{{ isset($order->created_at) ? \Carbon\Carbon::parse($order->created_at)->format('M d, Y h:i A') : '—' }}"
                        data-products="{{ $order->products_summary ?? '' }}"
                        data-notes="{{ $order->notes ?? '' }}">

                        <td><span class="order-no">#{{ $order->order_no ?? 'ORD-00000' }}</span></td>

                        <td class="name-cell">
                            {{ $order->buyer_name ?? '—' }}
                            <small>{{ $order->buyer_arbo ?? '' }}</small>
                        </td>

                        <td style="font-size:.83rem;color:var(--text-main);">
                            {{ $order->seller_arbo ?? '—' }}
                        </td>

                        <td style="font-size:.78rem;max-width:160px;">
                            <span style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
                                {{ $order->products_summary ?? '—' }}
                            </span>
                        </td>

                        <td class="amount-cell">₱{{ number_format($order->amount ?? 0, 2) }}</td>

                        <td>
                            @php
                                $ps    = strtolower($order->payment_status ?? 'pending');
                                $psMap = ['paid'=>'paid','pending'=>'pending','partial'=>'partial','cancelled'=>'cancelled'];
                                $psCls = $psMap[$ps] ?? 'pending';
                            @endphp
                            <span class="status-badge status-{{ $psCls }}">
                                <span class="status-dot"></span> {{ ucfirst($ps) }}
                            </span>
                        </td>

                        <td>
                            @php
                                $os    = strtolower($order->order_status ?? 'processing');
                                $osMap = ['completed'=>'completed','processing'=>'processing','cancelled'=>'cancelled','pending'=>'pending'];
                                $osCls = $osMap[$os] ?? 'processing';
                            @endphp
                            <span class="status-badge status-{{ $osCls }}">
                                <span class="status-dot"></span> {{ ucfirst($os) }}
                            </span>
                        </td>

                        <td>
                            @php
                                $ds    = strtolower($order->delivery_status ?? 'pending');
                                $dsMap = ['delivered'=>'delivered','shipped'=>'shipped','pending'=>'pending','cancelled'=>'cancelled','processing'=>'processing'];
                                $dsCls = $dsMap[$ds] ?? 'pending';
                            @endphp
                            <span class="status-badge status-{{ $dsCls }}">
                                <span class="status-dot"></span> {{ ucfirst($ds) }}
                            </span>
                        </td>

                        <td style="font-size:.78rem;color:var(--text-muted);white-space:nowrap;">
                            {{ isset($order->created_at) ? \Carbon\Carbon::parse($order->created_at)->format('M d, Y') : '—' }}
                        </td>

                        <td>
                            <button type="button" class="btn-card-action view-detail-btn"
                                    data-id="{{ $order->id ?? 0 }}"
                                    onclick="event.stopPropagation();">
                                <i class="bi bi-eye-fill"></i> View
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10">
                            <div class="empty-state">
                                <i class="bi bi-inbox-fill"></i>
                                <p>No orders found{{ request('search') ? ' matching "' . e(request('search')) . '"' : '' }}.</p>
                                @if(request()->hasAny(['search','date_range','payment_status','arbo_id']))
                                <a href="{{ route('finance.orders.index') }}" class="btn-card-action mt-2 d-inline-flex">
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

        <!-- Pagination -->
        @if(isset($orders) && method_exists($orders, 'links') && $orders->lastPage() > 1)
        <div class="pagination-wrap">
            <span class="pagination-info">
                Showing {{ $orders->firstItem() ?? 0 }}–{{ $orders->lastItem() ?? 0 }}
                of {{ number_format($orders->total()) }} orders
            </span>
            {{ $orders->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>

</main>

<!-- ── Order Detail Offcanvas ─────────────────────────── -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="orderDetailOffcanvas" aria-labelledby="orderDetailLabel">
    <div class="offcanvas-header">
        <div>
            <h6 class="mb-0" id="orderDetailLabel" style="color:#fff;font-size:.82rem;letter-spacing:.06em;text-transform:uppercase;">Order Details</h6>
            <div class="detail-order-no mt-1" id="detailOrderNo">#ORD-00000</div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body p-0" style="overflow-y:auto;">

        <!-- Overview -->
        <div class="detail-section">
            <div class="detail-section-title">Overview</div>
            <div class="detail-row">
                <span class="detail-key">Buyer</span>
                <span class="detail-val" id="detailBuyer">—</span>
            </div>
            <div class="detail-row">
                <span class="detail-key">Buyer ARBO</span>
                <span class="detail-val" id="detailBuyerArbo">—</span>
            </div>
            <div class="detail-row">
                <span class="detail-key">Seller ARBO</span>
                <span class="detail-val" id="detailSeller">—</span>
            </div>
            <div class="detail-row">
                <span class="detail-key">Date Placed</span>
                <span class="detail-val" id="detailDate">—</span>
            </div>
        </div>

        <!-- Financials -->
        <div class="detail-section">
            <div class="detail-section-title">Financials</div>
            <div class="detail-row">
                <span class="detail-key">Total Amount</span>
                <span class="detail-val amount-cell" id="detailAmount">—</span>
            </div>
            <div class="detail-row">
                <span class="detail-key">Payment Status</span>
                <span class="detail-val" id="detailPayment">—</span>
            </div>
        </div>

        <!-- Status -->
        <div class="detail-section">
            <div class="detail-section-title">Fulfillment</div>
            <div class="detail-row">
                <span class="detail-key">Order Status</span>
                <span class="detail-val" id="detailOrderStatus">—</span>
            </div>
            <div class="detail-row">
                <span class="detail-key">Delivery Status</span>
                <span class="detail-val" id="detailDelivery">—</span>
            </div>
        </div>

        <!-- Products -->
        <div class="detail-section">
            <div class="detail-section-title">Products Ordered</div>
            <div id="detailProducts" style="font-size:.83rem;color:var(--text-main);">—</div>
        </div>

        <!-- Order Timeline -->
        <div class="detail-section">
            <div class="detail-section-title">Order Timeline</div>
            <ul class="timeline" id="detailTimeline">
                <li class="timeline-item">
                    <div class="timeline-dot-wrap">
                        <div class="timeline-dot"></div>
                        <div class="timeline-line"></div>
                    </div>
                    <div class="timeline-content">
                        <div class="timeline-event">Order Placed</div>
                        <div class="timeline-time" id="tlPlaced">—</div>
                    </div>
                </li>
                <li class="timeline-item">
                    <div class="timeline-dot-wrap">
                        <div class="timeline-dot pending" id="tlDotPayment"></div>
                        <div class="timeline-line"></div>
                    </div>
                    <div class="timeline-content">
                        <div class="timeline-event">Payment</div>
                        <div class="timeline-time" id="tlPayment">Awaiting payment confirmation</div>
                    </div>
                </li>
                <li class="timeline-item">
                    <div class="timeline-dot-wrap">
                        <div class="timeline-dot pending" id="tlDotDelivery"></div>
                    </div>
                    <div class="timeline-content">
                        <div class="timeline-event">Delivery</div>
                        <div class="timeline-time" id="tlDelivery">Pending shipment</div>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Notes -->
        <div class="detail-section" id="detailNotesWrap" style="display:none;">
            <div class="detail-section-title">Notes</div>
            <p id="detailNotes" style="font-size:.83rem;color:var(--text-main);margin:0;"></p>
        </div>

        <!-- Actions (Finance: view-only — link to payment) -->
        <div class="detail-section">
            <a href="#" class="btn-export d-inline-flex" id="detailPaymentLink">
                <i class="bi bi-credit-card-2-front"></i> View Payment Record
            </a>
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

    // ── Table Date Label ───────────────────────────────
    const tbl = document.getElementById('tableDate');
    if (tbl) tbl.textContent = new Date().toLocaleDateString('en-PH', { year:'numeric', month:'long', day:'numeric' });

    // ── Mobile Sidebar ─────────────────────────────────
    const toggle  = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('mainSidebar');
    const overlay = document.getElementById('sidebarOverlay');

    function openSidebar()  { sidebar.classList.add('show'); overlay.classList.add('show'); document.body.style.overflow = 'hidden'; }
    function closeSidebar() { sidebar.classList.remove('show'); overlay.classList.remove('show'); document.body.style.overflow = ''; }

    if (toggle)  toggle.addEventListener('click', openSidebar);
    if (overlay) overlay.addEventListener('click', closeSidebar);

    // ── Order Detail Offcanvas ─────────────────────────
    const detailOffcanvas = new bootstrap.Offcanvas(document.getElementById('orderDetailOffcanvas'));

    function statusBadge(status, type) {
        const map = {
            paid:        'status-paid',
            pending:     'status-pending',
            partial:     'status-partial',
            cancelled:   'status-cancelled',
            processing:  'status-processing',
            completed:   'status-completed',
            shipped:     'status-shipped',
            delivered:   'status-delivered',
        };
        const cls = map[status] || 'status-pending';
        return `<span class="status-badge ${cls}"><span class="status-dot"></span> ${status.charAt(0).toUpperCase()+status.slice(1)}</span>`;
    }

    function openDetail(row) {
        const d = row.dataset;
        document.getElementById('detailOrderNo').textContent    = '#' + (d.orderNo || 'ORD-00000');
        document.getElementById('detailBuyer').textContent      = d.buyer    || '—';
        document.getElementById('detailBuyerArbo').textContent  = d.buyerArbo|| '—';
        document.getElementById('detailSeller').textContent     = d.seller   || '—';
        document.getElementById('detailDate').textContent       = d.date     || '—';
        document.getElementById('detailAmount').textContent     = '₱' + (d.amount || '0.00');
        document.getElementById('detailPayment').innerHTML      = statusBadge(d.paymentStatus || 'pending');
        document.getElementById('detailOrderStatus').innerHTML  = statusBadge(d.orderStatus   || 'processing');
        document.getElementById('detailDelivery').innerHTML     = statusBadge(d.delivery      || 'pending');
        document.getElementById('detailProducts').textContent   = d.products || '—';

        // Timeline
        document.getElementById('tlPlaced').textContent   = d.date || '—';
        document.getElementById('tlPayment').textContent  = d.paymentStatus === 'paid' ? 'Payment confirmed' : 'Awaiting payment confirmation';
        document.getElementById('tlDelivery').textContent = d.delivery === 'delivered' ? 'Delivered' : (d.delivery === 'shipped' ? 'In transit' : 'Pending shipment');

        // Notes
        const notesWrap = document.getElementById('detailNotesWrap');
        if (d.notes) {
            notesWrap.style.display = '';
            document.getElementById('detailNotes').textContent = d.notes;
        } else {
            notesWrap.style.display = 'none';
        }

        // Payment link
        document.getElementById('detailPaymentLink').href = '/finance/payments?order_no=' + (d.orderNo || '');

        detailOffcanvas.show();
    }

    // Rows click
    document.querySelectorAll('.order-row').forEach(row => {
        row.addEventListener('click', () => openDetail(row));
    });

    // View buttons
    document.querySelectorAll('.view-detail-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const row = this.closest('tr');
            openDetail(row);
        });
    });

    // ── Export CSV ─────────────────────────────────────
    document.getElementById('exportBtn')?.addEventListener('click', function(e) {
        e.preventDefault();
        const params = new URLSearchParams(window.location.search);
        params.set('export', 'csv');
        window.location.href = '{{ route('finance.orders.index') }}?' + params.toString();
    });

});
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

    let lastActivity = Date.now();
    let performedLogout = false;
    let warningShown = false;
    let countdownInterval = null;
    let modalInstance = null;

    function getCsrf(){
        const form = document.getElementById('inactivityLogoutForm');
        const tokenInput = form ? form.querySelector('input[name="_token"]') : null;
        return tokenInput ? tokenInput.value : (document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '');
    }

    async function performLogout(){
        if (performedLogout) return; performedLogout = true;
        try {
            await fetch('{{ route('logout') }}', { method:'POST', credentials:'same-origin', body: new URLSearchParams({ _token: getCsrf() }) });
        } catch(e) {}
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

    ['click','mousemove','keydown','touchstart','scroll'].forEach(evt => {
        window.addEventListener(evt, markActivity, { passive:true });
    });

    document.getElementById('idleStayBtn')?.addEventListener('click', markActivity);

    setInterval(() => {
        if (Date.now() - lastActivity >= INACTIVITY_MS - WARNING_MS && !warningShown && !performedLogout) showWarning();
    }, 1000);
})();
</script>

@include('partials.idle-timer')

</body>
</html>
