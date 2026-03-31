<?php
// resources/views/finance/dashboard/dashboard.php
// Standalone PHP/HTML — no layout extension
?>
<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Finance Dashboard — E-Agraryo Merkado</title>
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
            --shadow-lg:  0 16px 48px rgba(13,59,30,0.13);
            --radius:     14px;
            --radius-sm:  9px;
            --sidebar-w:  260px;
        }

        /* ─── Base ──────────────────────────────────────────── */
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
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 1040;
            box-shadow: 0 2px 12px rgba(0,0,0,0.22);
        }

        .navbar-brand-area {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            text-decoration: none;
            flex-shrink: 0;
        }

        .navbar-brand-area img {
            height: 38px;
            filter: brightness(1.15);
        }

        .navbar-system-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.18rem;
            color: #fff;
            letter-spacing: 0.01em;
            line-height: 1.15;
        }

        .navbar-system-sub {
            font-size: 0.68rem;
            color: var(--green-200);
            letter-spacing: 0.06em;
            text-transform: uppercase;
            font-weight: 500;
        }

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
            width: 1px;
            height: 28px;
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
            background: none;
            border: none;
            color: rgba(255,255,255,0.75);
            font-size: 1.15rem;
            cursor: pointer;
            padding: 6px 8px;
            border-radius: 8px;
            position: relative;
            transition: color 0.18s, background 0.18s;
        }

        .nav-icon-btn:hover {
            color: #fff;
            background: rgba(255,255,255,0.08);
        }

        .nav-notif-dot {
            position: absolute;
            top: 5px; right: 6px;
            width: 8px; height: 8px;
            background: var(--gold);
            border-radius: 50%;
            border: 2px solid var(--green-900);
        }

        .user-pill {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 30px;
            padding: 5px 12px 5px 6px;
            cursor: pointer;
            transition: background 0.18s;
            text-decoration: none;
        }

        .user-pill:hover { background: rgba(255,255,255,0.14); }

        .user-avatar {
            width: 30px; height: 30px;
            border-radius: 50%;
            object-fit: cover;
            border: 1.5px solid rgba(255,255,255,0.25);
        }

        .user-pill-name {
            font-size: 0.82rem;
            font-weight: 500;
            color: #fff;
        }

        .user-pill-role {
            font-size: 0.65rem;
            color: var(--green-200);
        }

        /* ─── Sidebar ───────────────────────────────────────── */
        .sidebar {
            position: fixed;
            top: 62px; left: 0; bottom: 0;
            width: var(--sidebar-w);
            background: #fff;
            border-right: 1px solid var(--gray-200);
            overflow-y: auto;
            z-index: 1030;
            display: flex;
            flex-direction: column;
            box-shadow: var(--shadow-sm);
            transition: transform 0.28s cubic-bezier(.4,0,.2,1);
        }

        .sidebar-inner {
            padding: 1.5rem 1rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .sidebar-section-label {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--gray-400);
            padding: 0 0.5rem;
            margin: 1.4rem 0 0.5rem;
        }

        .sidebar-section-label:first-child { margin-top: 0; }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            padding: 0.56rem 0.75rem;
            border-radius: var(--radius-sm);
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--gray-600);
            text-decoration: none;
            transition: all 0.18s;
            margin-bottom: 2px;
            position: relative;
        }

        .sidebar-link i {
            font-size: 1rem;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }

        .sidebar-link:hover {
            background: var(--green-100);
            color: var(--green-700);
        }

        .sidebar-link.active {
            background: var(--green-100);
            color: var(--green-700);
            font-weight: 600;
        }

        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: -3px;
            top: 20%; bottom: 20%;
            width: 4px;
            background: var(--green-600);
            border-radius: 4px;
        }

        .sidebar-link-badge {
            margin-left: auto;
            font-size: 0.65rem;
            font-weight: 700;
            background: var(--green-100);
            color: var(--green-700);
            padding: 2px 7px;
            border-radius: 20px;
        }

        .sidebar-link.active .sidebar-link-badge {
            background: var(--green-600);
            color: #fff;
        }

        .sidebar-logout {
            margin-top: auto;
            padding-top: 1rem;
            border-top: 1px solid var(--gray-200);
        }

        .sidebar-logout .sidebar-link { color: #c0392b; }
        .sidebar-logout .sidebar-link:hover { background: #fdf2f2; color: #c0392b; }

        .sidebar-office-chip {
            background: var(--green-50);
            border: 1px solid var(--green-200);
            border-radius: var(--radius-sm);
            padding: 0.65rem 0.85rem;
            margin-bottom: 1rem;
        }

        .sidebar-office-chip .office-label {
            font-size: 0.62rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--green-600);
        }

        .sidebar-office-chip .office-name {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--green-900);
            margin-top: 1px;
        }

        /* ─── Main Content ──────────────────────────────────── */
        .page-wrapper {
            margin-left: var(--sidebar-w);
            margin-top: 62px;
            min-height: calc(100vh - 62px);
            padding: 2rem 2rem 3rem;
        }

        /* ─── Page Header ───────────────────────────────────── */
        .page-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .page-header-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.6rem;
            color: var(--green-900);
            margin: 0 0 2px;
            line-height: 1.2;
        }

        .page-header-sub {
            font-size: 0.85rem;
            color: var(--text-muted);
            margin: 0;
        }

        .header-date-chip {
            background: #fff;
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-sm);
            padding: 6px 14px;
            font-size: 0.78rem;
            color: var(--gray-600);
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: var(--shadow-sm);
            white-space: nowrap;
        }

        /* ─── Stat Cards ────────────────────────────────────── */
        .stat-card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            padding: 1.4rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: box-shadow 0.22s, transform 0.22s;
            border: 1px solid var(--gray-200);
            height: 100%;
        }

        .stat-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-4px);
        }

        .stat-icon-wrap {
            width: 52px; height: 52px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            flex-shrink: 0;
        }

        .stat-icon-green  { background: var(--green-100); color: var(--green-700); }
        .stat-icon-gold   { background: var(--gold-light); color: var(--gold); }
        .stat-icon-blue   { background: #e8f0fe; color: #1a73e8; }
        .stat-icon-teal   { background: #e0f7f5; color: #0d8a7e; }
        .stat-icon-red    { background: #fdecea; color: #c0392b; }
        .stat-icon-indigo { background: #eef0ff; color: #4f46e5; }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-main);
            line-height: 1;
            margin-bottom: 3px;
        }

        .stat-label {
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--text-muted);
            margin: 0;
        }

        .stat-trend {
            font-size: 0.73rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 3px;
            margin-top: 4px;
        }

        .stat-trend.up   { color: var(--green-600); }
        .stat-trend.down { color: #dc3545; }

        /* ─── Section Title ─────────────────────────────────── */
        .section-title {
            font-size: 0.95rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .section-title-bar {
            width: 4px; height: 18px;
            background: var(--green-600);
            border-radius: 3px;
        }

        .section-title a {
            margin-left: auto;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--green-600);
            text-decoration: none;
        }

        .section-title a:hover { text-decoration: underline; }

        /* ─── Table Card ────────────────────────────────────── */
        .table-card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            overflow: hidden;
        }

        .table-card-header {
            padding: 1.1rem 1.5rem 0.9rem;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .table-card-title {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--text-main);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.45rem;
        }

        .table-card-title i { color: var(--green-600); }

        .table-responsive { overflow-x: auto; }

        .fin-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.84rem;
        }

        .fin-table thead th {
            background: var(--green-50);
            color: var(--green-800);
            font-weight: 700;
            font-size: 0.72rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            padding: 0.7rem 1.1rem;
            border-bottom: 1px solid var(--green-200);
            white-space: nowrap;
        }

        .fin-table tbody tr {
            border-bottom: 1px solid var(--gray-100);
            transition: background 0.14s;
        }

        .fin-table tbody tr:last-child { border-bottom: none; }
        .fin-table tbody tr:hover { background: var(--gray-50); }

        .fin-table td {
            padding: 0.75rem 1.1rem;
            vertical-align: middle;
            color: var(--text-main);
        }

        .order-no {
            font-family: 'Courier New', monospace;
            font-weight: 700;
            font-size: 0.82rem;
            color: var(--green-700);
        }

        .name-cell { font-weight: 600; color: var(--green-800); }
        .name-cell small { display: block; font-weight: 400; font-size: 0.72rem; color: var(--text-muted); margin-top: 1px; }

        .amount-cell { font-weight: 700; color: var(--green-800); font-size: 0.88rem; }

        /* ─── Revenue mini bar ──────────────────────────────── */
        .rev-bar {
            height: 5px;
            background: var(--gray-200);
            border-radius: 4px;
            overflow: hidden;
            margin-top: 4px;
        }
        .rev-bar-fill { height: 100%; border-radius: 4px; background: var(--green-600); opacity: .75; }

        /* ─── Status Badges ─────────────────────────────────── */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 600;
        }

        .status-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            display: inline-block;
            background: currentColor;
        }

        .status-paid       { background: var(--green-100); color: var(--green-700); }
        .status-pending    { background: var(--gold-light); color: var(--gold); }
        .status-cancelled  { background: #fdecea; color: #c0392b; }
        .status-processing { background: #e0f7f5; color: #0d8a7e; }
        .status-completed  { background: #e8f0fe; color: #1a73e8; }
        .status-partial    { background: #f3e8ff; color: #7c3aed; }

        /* ─── Activity Log ──────────────────────────────────── */
        .activity-log { list-style: none; padding: 0; margin: 0; }

        .activity-item {
            display: flex;
            gap: 0.85rem;
            padding: 0.85rem 1.25rem;
            border-bottom: 1px solid var(--gray-100);
            align-items: flex-start;
            transition: background 0.14s;
        }

        .activity-item:last-child { border-bottom: none; }
        .activity-item:hover { background: var(--gray-50); }

        .activity-dot-wrap { flex-shrink: 0; margin-top: 3px; }

        .activity-dot {
            width: 32px; height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
        }

        .ad-green { background: var(--green-100); color: var(--green-700); }
        .ad-gold  { background: var(--gold-light); color: var(--gold); }
        .ad-blue  { background: #e8f0fe; color: #1a73e8; }
        .ad-teal  { background: #e0f7f5; color: #0d8a7e; }
        .ad-red   { background: #fdecea; color: #c0392b; }

        .activity-title { font-size: 0.83rem; font-weight: 600; color: var(--text-main); margin-bottom: 1px; }
        .activity-meta  { font-size: 0.73rem; color: var(--text-muted); }

        /* ─── Chart Card ────────────────────────────────────── */
        .chart-card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            overflow: hidden;
        }

        .chart-card-header {
            padding: 1.1rem 1.5rem 0.9rem;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        /* ─── Btn ───────────────────────────────────────────── */
        .btn-card-action {
            background: var(--green-100);
            color: var(--green-700);
            border: none;
            font-size: 0.78rem;
            border-radius: 8px;
            font-weight: 600;
            padding: 5px 12px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: background 0.15s;
        }
        .btn-card-action:hover { background: #d0ebd8; color: var(--green-900); }

        /* ─── Mobile Sidebar ────────────────────────────────── */
        .mobile-sidebar-toggle {
            display: none;
            background: none;
            border: none;
            color: #fff;
            font-size: 1.3rem;
            margin-right: 0.75rem;
            cursor: pointer;
        }

        @media (max-width: 991.98px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .page-wrapper { margin-left: 0; padding: 1.25rem 1rem 3rem; }
            .mobile-sidebar-toggle { display: block; }
            .navbar-page-badge { display: none; }
            .sidebar-overlay {
                display: none;
                position: fixed; inset: 0;
                background: rgba(0,0,0,0.4);
                z-index: 1029;
            }
            .sidebar-overlay.show { display: block; }
        }

        @media (max-width: 575.98px) {
            .stat-value { font-size: 1.5rem; }
        }

        /* ─── Scrollbar ─────────────────────────────────────── */
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

        <!-- Role chip — mirrors ARBO office chip -->
        <div class="sidebar-office-chip">
            <div class="office-label">Role</div>
            <div class="office-name">Finance Admin</div>
        </div>

        <span class="sidebar-section-label">Main Menu</span>

        <a href="{{ route('finance.dashboard') }}"
           class="sidebar-link {{ request()->routeIs('finance.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i>
            Dashboard
        </a>

        <a href="{{ route('finance.orders.index') }}"
           class="sidebar-link {{ request()->routeIs('finance.orders.*') ? 'active' : '' }}">
            <i class="bi bi-bag-check"></i>
            Orders
        </a>

        <a href="{{ route('finance.payments.index') }}"
           class="sidebar-link {{ request()->routeIs('finance.payments.*') ? 'active' : '' }}">
            <i class="bi bi-credit-card-2-front"></i>
            Payments
        </a>

        <a href="{{ route('finance.revenue.index') }}"
           class="sidebar-link {{ request()->routeIs('finance.revenue.*') ? 'active' : '' }}">
            <i class="bi bi-graph-up-arrow"></i>
            Revenue Monitoring
        </a>

        <span class="sidebar-section-label">Sales Report</span>

        <a href="{{ route('finance.reports.sales') }}"
           class="sidebar-link {{ request()->routeIs('finance.reports.*') ? 'active' : '' }}">
            <i class="bi bi-bar-chart-line"></i>
            Sales Report
        </a>

        <span class="sidebar-section-label">System</span>

        <a href="{{ route('finance.activity-logs') }}"
           class="sidebar-link {{ request()->routeIs('finance.activity-logs') ? 'active' : '' }}">
            <i class="bi bi-clock-history"></i>
            Activity Logs
        </a>

        <!-- Logout -->
        <div class="sidebar-logout">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-link w-100 text-start border-0 bg-transparent" style="cursor:pointer;">
                    <i class="bi bi-box-arrow-right"></i>
                    Logout
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
            <h1 class="page-header-title">Finance Dashboard</h1>
            <p class="page-header-sub">
                Monitor and manage transactions of
                <strong>E-Agraryo Merkado</strong> — orders, payments, and ARBO revenue.
            </p>
        </div>
        <div class="header-date-chip">
            <i class="bi bi-calendar3"></i>
            <span id="currentDate"></span>
        </div>
    </div>

    <!-- ── Summary Stat Cards ─────────────────────────── -->
    <div class="row g-3 mb-4">

        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-green">
                    <i class="bi bi-bag-fill"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $totalOrders ?? '—' }}</div>
                    <p class="stat-label">Total Orders</p>
                    <span class="stat-trend up"><i class="bi bi-check-circle"></i> All-time</span>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-teal">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $paidOrders ?? '—' }}</div>
                    <p class="stat-label">Paid Orders</p>
                    <span class="stat-trend up">
                        <i class="bi bi-arrow-up-short"></i>
                        @if(($totalOrders ?? 0) > 0)
                            {{ number_format(($paidOrders ?? 0) / ($totalOrders ?? 1) * 100, 1) }}% of total
                        @else
                            — of total
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-gold">
                    <i class="bi bi-hourglass-split"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $pendingPayments ?? '—' }}</div>
                    <p class="stat-label">Pending Payments</p>
                    <span class="stat-trend {{ ($pendingPayments ?? 0) > 10 ? 'down' : 'up' }}">
                        <i class="bi bi-{{ ($pendingPayments ?? 0) > 10 ? 'arrow-up-short' : 'arrow-down-short' }}"></i>
                        Needs attention
                    </span>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-red">
                    <i class="bi bi-x-circle-fill"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $cancelledOrders ?? '—' }}</div>
                    <p class="stat-label">Cancelled Orders</p>
                    <span class="stat-trend" style="color:var(--gray-400);">
                        <i class="bi bi-dash"></i> Voided
                    </span>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-gold">
                    <i class="bi bi-cash-stack"></i>
                </div>
                <div>
                    <div class="stat-value" style="font-size:1.5rem;">
                        ₱{{ number_format($totalRevenue ?? 0, 2) }}
                    </div>
                    <p class="stat-label">Total Revenue</p>
                    <span class="stat-trend up"><i class="bi bi-database"></i> Cumulative</span>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-green">
                    <i class="bi bi-calendar2-check-fill"></i>
                </div>
                <div>
                    <div class="stat-value" style="font-size:1.5rem;">
                        ₱{{ number_format($monthlyRevenue ?? 0, 2) }}
                    </div>
                    <p class="stat-label">This Month Revenue</p>
                    <span class="stat-trend up">
                        <i class="bi bi-arrow-up-short"></i> {{ now()->format('M Y') }}
                    </span>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-indigo">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $activeArboTransactions ?? '—' }}</div>
                    <p class="stat-label">Active ARBO Transactions</p>
                    <span class="stat-trend up"><i class="bi bi-arrow-left-right"></i> Live inter-ARBO</span>
                </div>
            </div>
        </div>

    </div>

    <!-- ── Revenue Chart + ARBO Breakdown ────────────── -->
    <div class="row g-4 mb-4">

        <!-- Revenue Chart -->
        <div class="col-lg-8">
            <div class="section-title">
                <div class="section-title-bar"></div>
                Monthly Revenue Trend
            </div>
            <div class="chart-card">
                <div class="chart-card-header">
                    <span style="font-size:.88rem; font-weight:700;">
                        Revenue — {{ now()->year }}
                    </span>
                    <select class="form-select form-select-sm w-auto" style="font-size:.77rem;">
                        <option>This Year</option>
                        <option>Last Year</option>
                    </select>
                </div>
                <div class="p-4" style="height:280px; position:relative;">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>

        <!-- ARBO Revenue Breakdown -->
        <div class="col-lg-4">
            <div class="section-title">
                <div class="section-title-bar"></div>
                Revenue by ARBO
                <a href="{{ route('finance.revenue.index') }}">View All →</a>
            </div>
            <div class="table-card">
                <div class="table-card-header">
                    <h6 class="table-card-title">
                        <i class="bi bi-buildings"></i>
                        ARBO Breakdown
                    </h6>
                </div>
                <div class="table-responsive">
                    <table class="fin-table">
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
                                <td style="font-weight:700;color:var(--gold);font-size:.8rem;">{{ $index + 1 }}</td>
                                <td class="name-cell">
                                    {{ $arbo->arbo_name ?? 'N/A' }}
                                    <small>{{ $arbo->region ?? '' }}</small>
                                </td>
                                <td style="font-weight:600;">{{ number_format($arbo->total_orders ?? 0) }}</td>
                                <td>
                                    <div class="amount-cell">₱{{ number_format($arbo->revenue ?? 0, 2) }}</div>
                                    @php
                                        $maxRev = collect($arboRevenue ?? [])->max('revenue') ?: 1;
                                        $pct    = (($arbo->revenue ?? 0) / $maxRev) * 100;
                                    @endphp
                                    <div class="rev-bar">
                                        <div class="rev-bar-fill" style="width:{{ $pct }}%;"></div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" style="text-align:center;padding:28px;color:var(--gray-400);">
                                    <i class="bi bi-building-slash d-block mb-1" style="font-size:1.5rem;"></i>
                                    <span style="font-size:.82rem;">No ARBO revenue data.</span>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- ── Recent Transactions ────────────────────────── -->
    <div class="mb-4">
        <div class="section-title">
            <div class="section-title-bar"></div>
            Recent Transactions
            <a href="{{ route('finance.orders.index') }}">View All Orders →</a>
        </div>
        <div class="table-card">
            <div class="table-card-header">
                <h6 class="table-card-title">
                    <i class="bi bi-receipt-cutoff"></i>
                    Order Transactions
                </h6>
                <select class="form-select form-select-sm w-auto" style="font-size:.77rem;">
                    <option>All Statuses</option>
                    <option>Paid</option>
                    <option>Pending</option>
                    <option>Processing</option>
                    <option>Cancelled</option>
                </select>
            </div>
            <div class="table-responsive">
                <table class="fin-table">
                    <thead>
                        <tr>
                            <th>Order No</th>
                            <th>Buyer (ARBO)</th>
                            <th>Seller (ARBO)</th>
                            <th>Amount</th>
                            <th>Payment Status</th>
                            <th>Order Status</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentTransactions ?? [] as $txn)
                        <tr>
                            <td><span class="order-no">#{{ $txn->order_no ?? 'ORD-00000' }}</span></td>
                            <td class="name-cell">
                                {{ $txn->buyer_name ?? '—' }}
                                <small>{{ $txn->buyer_arbo ?? '' }}</small>
                            </td>
                            <td>{{ $txn->seller_arbo ?? '—' }}</td>
                            <td class="amount-cell">₱{{ number_format($txn->amount ?? 0, 2) }}</td>
                            <td>
                                @php
                                    $ps    = strtolower($txn->payment_status ?? 'pending');
                                    $psMap = ['paid'=>'paid','pending'=>'pending','partial'=>'partial','cancelled'=>'cancelled'];
                                    $psCls = $psMap[$ps] ?? 'pending';
                                @endphp
                                <span class="status-badge status-{{ $psCls }}">
                                    <span class="status-dot"></span> {{ ucfirst($ps) }}
                                </span>
                            </td>
                            <td>
                                @php
                                    $os    = strtolower($txn->order_status ?? 'processing');
                                    $osMap = ['completed'=>'completed','processing'=>'processing','cancelled'=>'cancelled','pending'=>'pending'];
                                    $osCls = $osMap[$os] ?? 'processing';
                                @endphp
                                <span class="status-badge status-{{ $osCls }}">
                                    <span class="status-dot"></span> {{ ucfirst($os) }}
                                </span>
                            </td>
                            <td style="font-size:.78rem;color:var(--text-muted);white-space:nowrap;">
                                {{ isset($txn->created_at) ? \Carbon\Carbon::parse($txn->created_at)->format('M d, Y') : '—' }}
                            </td>
                            <td>
                                <a href="{{ route('finance.orders.show', $txn->id ?? 0) }}"
                                   class="btn-card-action">
                                    <i class="bi bi-eye-fill"></i> View
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" style="text-align:center;padding:32px;color:var(--gray-400);">
                                <i class="bi bi-inbox-fill d-block mb-2" style="font-size:1.8rem;"></i>
                                <span style="font-size:.82rem;">No transactions found.</span>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if(!empty($recentTransactions) && method_exists($recentTransactions, 'links'))
            <div style="padding:12px 20px;border-top:1px solid var(--gray-100);">
                {{ $recentTransactions->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>

    <!-- ── Analytics + Activity ──────────────────────── -->
    <div class="row g-4 mb-4">

        <!-- Revenue Donut Chart -->
        <div class="col-lg-4">
            <div class="section-title">
                <div class="section-title-bar"></div>
                Payment Breakdown
            </div>
            <div class="chart-card">
                <div class="chart-card-header">
                    <span style="font-size:.84rem; font-weight:700;">Payment Status Split</span>
                </div>
                <div class="p-4" style="height:220px; position:relative;">
                    <canvas id="paymentDonut"></canvas>
                </div>
                <div class="px-4 pb-3 d-flex flex-wrap gap-2 justify-content-center">
                    <span class="status-badge status-paid"><span class="status-dot"></span> Paid</span>
                    <span class="status-badge status-pending"><span class="status-dot"></span> Pending</span>
                    <span class="status-badge status-cancelled"><span class="status-dot"></span> Cancelled</span>
                </div>
            </div>
        </div>

        <!-- Activity Log -->
        <div class="col-lg-8">
            <div class="section-title">
                <div class="section-title-bar"></div>
                Recent Finance Activity
                <a href="{{ route('finance.activity-logs') }}">View All Logs →</a>
            </div>
            <div class="table-card">
                <div class="table-card-header">
                    <h6 class="table-card-title">
                        <i class="bi bi-clock-history"></i>
                        Activity Feed
                    </h6>
                    <span style="font-size:.73rem;color:var(--text-muted);">Last 24 hours</span>
                </div>
                <ul class="activity-log">
                    @forelse($recentActivities ?? [] as $activity)
                    <li class="activity-item">
                        <div class="activity-dot-wrap">
                            <div class="activity-dot ad-{{ $activity->type_class ?? 'blue' }}">
                                <i class="bi bi-{{ $activity->icon ?? 'bell-fill' }}"></i>
                            </div>
                        </div>
                        <div style="flex:1;min-width:0;">
                            <div class="activity-title">{{ $activity->description ?? 'Activity recorded.' }}</div>
                            <div class="activity-meta">
                                By <strong>{{ $activity->actor ?? 'System' }}</strong>
                                @if($activity->reference ?? null)
                                    &middot; <span style="font-family:'Courier New',monospace;font-weight:700;color:var(--green-700);">{{ $activity->reference }}</span>
                                @endif
                            </div>
                        </div>
                        <div style="font-size:.72rem;color:var(--gray-400);white-space:nowrap;margin-left:auto;padding-top:2px;">
                            {{ isset($activity->created_at) ? \Carbon\Carbon::parse($activity->created_at)->diffForHumans() : '—' }}
                        </div>
                    </li>
                    @empty
                    @php
                        $placeholders = [
                            ['ad-green', 'credit-card-fill',       'Payment confirmed for Order #ORD-20251',       'Finance Staff', '5m ago'],
                            ['ad-blue',  'bag-check-fill',          'New order placed by Kilusang ARBO — ₱12,400',  'System',        '28m ago'],
                            ['ad-gold',  'exclamation-circle-fill', 'Pending payment flag raised for #ORD-20248',   'Finance Staff', '51m ago'],
                            ['ad-teal',  'people-fill',             'ARBO Samahang Magsasaka verified on-platform', 'Admin',         '1h ago'],
                            ['ad-green', 'receipt',                 'Invoice generated for batch #B-0042',          'Finance Staff', '2h ago'],
                            ['ad-red',   'exclamation-circle',      'Overdue payment flagged for #ORD-20240',       'System',        '3h ago'],
                        ];
                    @endphp
                    @foreach($placeholders as $row)
                    <li class="activity-item">
                        <div class="activity-dot-wrap">
                            <div class="activity-dot {{ $row[0] }}">
                                <i class="bi bi-{{ $row[1] }}"></i>
                            </div>
                        </div>
                        <div style="flex:1;min-width:0;">
                            <div class="activity-title">{{ $row[2] }}</div>
                            <div class="activity-meta">By <strong>{{ $row[3] }}</strong></div>
                        </div>
                        <div style="font-size:.72rem;color:var(--gray-400);white-space:nowrap;margin-left:auto;padding-top:2px;">
                            {{ $row[4] }}
                        </div>
                    </li>
                    @endforeach
                    @endforelse
                </ul>
            </div>
        </div>

    </div>

</main>

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

    // ── Current Date ──────────────────────────────────────
    const dateEl = document.getElementById('currentDate');
    if (dateEl) {
        dateEl.textContent = new Date().toLocaleDateString('en-PH', {
            weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
        });
    }

    // ── Mobile Sidebar Toggle ─────────────────────────────
    const toggle  = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('mainSidebar');
    const overlay = document.getElementById('sidebarOverlay');

    function openSidebar()  { sidebar.classList.add('show'); overlay.classList.add('show'); document.body.style.overflow = 'hidden'; }
    function closeSidebar() { sidebar.classList.remove('show'); overlay.classList.remove('show'); document.body.style.overflow = ''; }

    if (toggle)  toggle.addEventListener('click', openSidebar);
    if (overlay) overlay.addEventListener('click', closeSidebar);

    // ── Revenue Bar Chart ─────────────────────────────────
    const revCtx = document.getElementById('revenueChart');
    if (revCtx) {
        const chartLabels = {!! json_encode(isset($chartLabels) ? $chartLabels : ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']) !!};
        const chartData   = {!! json_encode(isset($chartData)   ? $chartData   : [42000,58000,37000,91000,76000,88000,103000,72000,115000,99000,134000,142000]) !!};

        new Chart(revCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Revenue (₱)',
                    data: chartData,
                    backgroundColor: 'rgba(200,146,42,0.65)',
                    borderColor: 'rgba(200,146,42,1)',
                    borderWidth: 1,
                    borderRadius: 8,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: { label: c => ' ₱' + Number(c.raw).toLocaleString('en-PH', { minimumFractionDigits: 2 }) },
                        backgroundColor: '#0d3b1e', titleColor: '#f5d08a', bodyColor: '#fff',
                        padding: 10, cornerRadius: 8,
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

    // ── Payment Status Donut ──────────────────────────────
    const donutCtx = document.getElementById('paymentDonut');
    if (donutCtx) {
        const paid      = parseInt('{{ $paidOrders ?? 0 }}') || 0;
        const pending   = parseInt('{{ $pendingPayments ?? 0 }}') || 0;
        const cancelled = parseInt('{{ $cancelledOrders ?? 0 }}') || 0;

        new Chart(donutCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Paid', 'Pending', 'Cancelled'],
                datasets: [{
                    data: [paid, pending, cancelled],
                    backgroundColor: [
                        'rgba(31,128,60,0.85)',
                        'rgba(200,146,42,0.85)',
                        'rgba(192,57,43,0.85)',
                    ],
                    borderColor: '#fff',
                    borderWidth: 3,
                    hoverOffset: 6,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '68%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(ctx) {
                                const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                                const pct   = total > 0 ? ((ctx.raw / total) * 100).toFixed(1) : 0;
                                return ` ${ctx.label}: ${ctx.raw} (${pct}%)`;
                            }
                        }
                    }
                }
            }
        });
    }

});
</script>

</body>
</html>
    
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
            const DEBUG_IDLE = true;
            const INACTIVITY_MS = 15 * 60 * 1000; // 15 minutes
            const WARNING_MS = 10 * 1000; // 10 seconds

            let lastActivity = Date.now();
            let performedLogout = false;
            let warningShown = false;
            let countdownInterval = null;
            let modalInstance = null;

            function debug(...args){ if (DEBUG_IDLE) console.log('[idle]', ...args); }

            function getCsrf(){
                const form = document.getElementById('inactivityLogoutForm');
                if (!form) return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
                const tokenInput = form.querySelector('input[name="_token"]');
                return tokenInput ? tokenInput.value : (document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '');
            }

            async function performLogout(){
                if (performedLogout) return; performedLogout = true;
                debug('performLogout()', Date.now());
                const token = getCsrf();
                try {
                    await fetch('{{ route('logout') }}', { method: 'POST', credentials: 'same-origin', body: new URLSearchParams({ _token: token || '' }) });
                } catch (e) { debug('fetch logout failed', e); }
                setTimeout(()=>{ window.location = '/login'; }, 200);
            }

            function showWarning(){
                if (warningShown || performedLogout) return; warningShown = true;
                debug('showWarning()');
                lastActivity += WARNING_MS; // bump slightly to avoid immediate re-trigger
                const modalEl = document.getElementById('inactivityWarningModal');
                const countEl = document.getElementById('idleCountdown');
                if (!modalInstance) modalInstance = new bootstrap.Modal(modalEl, { backdrop: 'static', keyboard: false });
                modalInstance.show();
                let seconds = Math.ceil(WARNING_MS/1000);
                if (countEl) countEl.textContent = seconds;
                countdownInterval = setInterval(()=>{
                    seconds -= 1;
                    if (countEl) countEl.textContent = Math.max(0, seconds);
                    debug('countdown', seconds);
                    if (seconds <= 0) { clearInterval(countdownInterval); countdownInterval = null; performLogout(); }
                }, 1000);
            }

            function hideWarning(){
                if (!warningShown) return; warningShown = false;
                debug('hideWarning()');
                if (countdownInterval) { clearInterval(countdownInterval); countdownInterval = null; }
                const modalEl = document.getElementById('inactivityWarningModal');
                if (modalInstance) modalInstance.hide();
                const countEl = document.getElementById('idleCountdown'); if (countEl) countEl.textContent = Math.ceil(WARNING_MS/1000);
            }

            function markActivity(e){
                if (e && e.isTrusted === false) return; // ignore synthetic
                if (performedLogout) return;
                lastActivity = Date.now();
                debug('markActivity', lastActivity);
                if (warningShown) hideWarning();
            }

            // global activity listeners
            ['click','mousemove','keydown','touchstart','scroll'].forEach(evt=>{
                window.addEventListener(evt, markActivity, { passive: true });
            });

            document.getElementById('idleStayBtn')?.addEventListener('click', function(){ markActivity(); });

            setInterval(()=>{
                const idleMs = Date.now() - lastActivity;
                const threshold = INACTIVITY_MS - WARNING_MS;
                debug('periodic check', { idleMs, threshold });
                if (idleMs >= threshold && !warningShown && !performedLogout) showWarning();
            }, 1000);

        })();
        </script>