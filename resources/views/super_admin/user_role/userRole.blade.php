<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Roles Management — E-Agraryo Merkado</title>
    <link rel="icon" href="{{ asset('images/dar-logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/dar-logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
            top: 0;
            left: 0;
            right: 0;
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
            top: 62px;
            left: 0;
            bottom: 0;
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
            top: 20%;
            bottom: 20%;
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

        .sidebar-logout .sidebar-link {
            color: #c0392b;
        }

        .sidebar-logout .sidebar-link:hover {
            background: #fdf2f2;
            color: #c0392b;
        }

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

        /* ─── Sidebar Scrollbar ─────────────────────────────── */
        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb { background: var(--gray-200); border-radius: 4px; }

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

        .header-actions {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            flex-wrap: wrap;
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
            padding: 1.2rem 1.3rem;
            display: flex;
            align-items: center;
            gap: 0.9rem;
            transition: box-shadow 0.22s, transform 0.22s;
            border: 1px solid var(--gray-200);
            height: 100%;
        }

        .stat-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-3px);
        }

        .stat-icon-wrap {
            width: 46px;
            height: 46px;
            border-radius: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .stat-icon-green   { background: var(--green-100); color: var(--green-700); }
        .stat-icon-gold    { background: var(--gold-light); color: var(--gold); }
        .stat-icon-blue    { background: #e8f0fe; color: #1a73e8; }
        .stat-icon-teal    { background: #e0f7f5; color: #0d8a7e; }
        .stat-icon-red     { background: #fdecea; color: #c0392b; }

        .stat-value {
            font-size: 1.7rem;
            font-weight: 700;
            color: var(--text-main);
            line-height: 1;
            margin-bottom: 3px;
        }

        .stat-label {
            font-size: 0.78rem;
            font-weight: 500;
            color: var(--text-muted);
            margin: 0;
        }

        /* ─── Filter Card ───────────────────────────────────── */
        .filter-card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            padding: 1.2rem 1.4rem;
        }

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

        .user-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.84rem;
        }

        .user-table thead th {
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

        .user-table tbody tr {
            border-bottom: 1px solid var(--gray-100);
            transition: background 0.14s;
        }

        .user-table tbody tr:last-child { border-bottom: none; }
        .user-table tbody tr:hover { background: var(--gray-50); }

        .user-table td {
            padding: 0.75rem 1.1rem;
            vertical-align: middle;
            color: var(--text-main);
        }

        .cell-id {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-muted);
            font-family: monospace;
            letter-spacing: 0.03em;
        }

        .cell-name {
            font-weight: 600;
            color: var(--green-800);
        }

        .cell-name small {
            display: block;
            font-weight: 400;
            font-size: 0.72rem;
            color: var(--text-muted);
            margin-top: 1px;
        }

        /* ─── Role Badges ───────────────────────────────────── */
        .role-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.71rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .role-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
        }

        .role-super_admin { background: #f0ebff; color: #6f42c1; }
        .role-super_admin .role-dot { background: #6f42c1; }

        .role-pbd         { background: #e8f0fe; color: #1a73e8; }
        .role-pbd         .role-dot { background: #1a73e8; }

        .role-finance     { background: var(--gold-light); color: var(--gold); }
        .role-finance     .role-dot { background: var(--gold); }

        .role-arbo        { background: #e0f7f5; color: #0d8a7e; }
        .role-arbo        .role-dot { background: #0d8a7e; }

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

        .status-active   { background: var(--green-100); color: var(--green-700); }
        .status-inactive { background: #fdecea; color: #c0392b; }

        .status-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            display: inline-block;
        }

        .status-active   .status-dot { background: var(--green-600); }
        .status-inactive .status-dot { background: #c0392b; }

        /* ─── Action Buttons ────────────────────────────────── */
        .action-btn {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 3px 9px;
            border-radius: 6px;
            font-size: 0.72rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: opacity 0.16s, transform 0.16s;
            white-space: nowrap;
        }

        .action-btn:hover { opacity: 0.82; transform: translateY(-1px); }

        .btn-view       { background: var(--green-100); color: var(--green-700); }
        .btn-edit       { background: #e8f0fe; color: #1a73e8; }
        .btn-deactivate { background: #fdecea; color: #c0392b; }
        .btn-activate   { background: var(--green-100); color: var(--green-600); }

        /* ─── Empty State ───────────────────────────────────── */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 2.5rem;
            color: var(--gray-400);
            margin-bottom: 0.75rem;
            display: block;
        }

        /* ─── Side Card (Activity) ──────────────────────────── */
        .side-card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            overflow: hidden;
            height: 100%;
        }

        .side-card-header {
            padding: 1.1rem 1.5rem 0.9rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .side-card-title {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--text-main);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.45rem;
        }

        .side-card-title i { color: var(--green-600); }

        /* ─── Activity Log ──────────────────────────────────── */
        .activity-log {
            list-style: none;
            padding: 0; margin: 0;
        }

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

        .activity-dot {
            width: 32px; height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .ad-green  { background: var(--green-100); color: var(--green-700); }
        .ad-gold   { background: var(--gold-light); color: var(--gold); }
        .ad-blue   { background: #e8f0fe; color: #1a73e8; }
        .ad-red    { background: #fdecea; color: #c0392b; }

        .activity-title {
            font-size: 0.83rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 1px;
        }

        .activity-meta {
            font-size: 0.73rem;
            color: var(--text-muted);
        }

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

        .sidebar-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 1029;
        }

        @media (max-width: 991.98px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .sidebar-overlay.show { display: block; }
            .page-wrapper { margin-left: 0; padding: 1.25rem 1rem 3rem; }
            .mobile-sidebar-toggle { display: block; }
            .navbar-page-badge { display: none; }
        }

        /* ─── Modal polish ──────────────────────────────────── */
        .modal-content {
            border: none;
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
        }

        .modal-header {
            border-bottom: 1px solid var(--gray-200);
            padding: 1.15rem 1.5rem;
        }

        .modal-footer {
            border-top: 1px solid var(--gray-200);
            padding: 0.9rem 1.5rem;
        }

        .modal-body { padding: 1.5rem; }

        .form-control, .form-select {
            font-size: 0.86rem;
            border-color: var(--gray-200);
            transition: border-color 0.18s, box-shadow 0.18s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--green-500);
            box-shadow: 0 0 0 3px rgba(31,128,60,0.12);
        }

        .form-label {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 0.35rem;
        }
    </style>
</head>
<body>

@php
    $authUser = auth()->user();
    $authFullName = $authUser
        ? trim(($authUser->first_name ?? '') . ' ' . ($authUser->last_name ?? ''))
        : 'Super Admin';
    $avatarUrl = 'https://ui-avatars.com/api/?name=' . urlencode($authFullName) . '&background=1a6932&color=fff&rounded=true&size=64';
@endphp

<!-- ── Top Navbar ──────────────────────────────────────── -->
<header class="top-navbar">
    <!-- Mobile toggle -->
    <button class="mobile-sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
        <i class="bi bi-list"></i>
    </button>

    <!-- Brand -->
    <a class="navbar-brand-area" href="{{ url('/dashboard') }}">
        <img src="{{ asset('images/dar-logo.png') }}" alt="DAR Logo">
        <div>
            <div class="navbar-system-title">E-Agraryo Merkado</div>
            <div class="navbar-system-sub">DAR Region V</div>
        </div>
    </a>

    <span class="navbar-page-badge"><i class="bi bi-shield-fill-check me-1"></i> Super Admin</span>

    <!-- Right actions -->
    <div class="navbar-right">
        <!-- Notifications -->
        <div class="dropdown">
            <button class="nav-icon-btn" data-bs-toggle="dropdown" aria-label="Notifications">
                <i class="bi bi-bell"></i>
                <span class="nav-notif-dot"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="min-width:280px; border-radius:12px; margin-top:8px;">
                <li class="px-3 py-2 border-bottom">
                    <span class="fw-bold" style="font-size:.82rem;">Notifications</span>
                </li>
                <li>
                    <a class="dropdown-item py-2" href="#" style="font-size:.82rem;">
                        <i class="bi bi-person-plus text-success me-2"></i> New user registered
                        <div class="text-muted" style="font-size:.72rem; padding-left:1.4rem;">2 hours ago</div>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item py-2" href="#" style="font-size:.82rem;">
                        <i class="bi bi-building text-primary me-2"></i> Branch updated
                        <div class="text-muted" style="font-size:.72rem; padding-left:1.4rem;">5 hours ago</div>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item py-2" href="#" style="font-size:.82rem;">
                        <i class="bi bi-cart-check text-warning me-2"></i> Order completed
                        <div class="text-muted" style="font-size:.72rem; padding-left:1.4rem;">Yesterday</div>
                    </a>
                </li>
                <li class="border-top">
                    <a class="dropdown-item text-center py-2" href="#" style="font-size:.78rem; color: var(--green-700);">View all notifications</a>
                </li>
            </ul>
        </div>

        <div class="navbar-divider d-none d-sm-block"></div>

        <!-- User Dropdown -->
        <div class="dropdown">
            <a class="user-pill dropdown-toggle" href="#" data-bs-toggle="dropdown">
                <img class="user-avatar" src="{{ $avatarUrl }}" alt="User avatar">
                <div class="d-none d-md-block" style="line-height:1.2;">
                    <div class="user-pill-name">{{ $authFullName }}</div>
                    <div class="user-pill-role">Super Admin</div>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="border-radius:12px; margin-top:8px; min-width:200px;">
                <li class="px-3 py-2 border-bottom">
                    <div class="fw-bold" style="font-size:.83rem;">{{ $authFullName }}</div>
                    <div class="text-muted" style="font-size:.72rem;">{{ auth()->user()->email ?? '' }}</div>
                </li>
                <li><a class="dropdown-item py-2" href="{{ url('/profile') }}" style="font-size:.84rem;"><i class="bi bi-person me-2 text-muted"></i>Profile</a></li>
                <li><a class="dropdown-item py-2" href="{{ url('/settings') }}" style="font-size:.84rem;"><i class="bi bi-gear me-2 text-muted"></i>System Settings</a></li>
                <li class="border-top">
                    <form method="POST" action="{{ url('/logout') }}">
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

        <!-- Role chip -->
        <div class="sidebar-office-chip">
            <div class="office-label">Role</div>
            <div class="office-name">Super Admin</div>
        </div>

        <!-- Main menu -->
        <span class="sidebar-section-label">Main Menu</span>

        <a href="{{ url('/dashboard') }}" class="sidebar-link">
            <i class="bi bi-speedometer2"></i>
            Dashboard
        </a>

        <a href="{{ url('/roles') }}" class="sidebar-link active">
            <i class="bi bi-person-badge"></i>
            User Roles
        </a>

        <a href="{{ url('/branches') }}" class="sidebar-link">
            <i class="bi bi-building"></i>
            PBD Management
            <span class="sidebar-link-badge">8</span>
        </a>

        <a href="{{ url('/logs') }}" class="sidebar-link">
            <i class="bi bi-clock-history"></i>
            Activity Logs
        </a>

        <span class="sidebar-section-label">Sales Report</span>

        <a href="{{ url('/reports') }}" class="sidebar-link">
            <i class="bi bi-bar-chart-line"></i>
            Sales Report
        </a>

        <span class="sidebar-section-label">System</span>

        <a href="{{ url('/settings') }}" class="sidebar-link">
            <i class="bi bi-gear"></i>
            Settings
        </a>

        <!-- Logout -->
        <div class="sidebar-logout">
            <form method="POST" action="{{ url('/logout') }}">
                @csrf
                <button type="submit" class="sidebar-link w-100 text-start border-0 bg-transparent">
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
            <h1 class="page-header-title">User Roles Management</h1>
            <p class="page-header-sub">
                Manage system users, assigned roles, and access levels across E-Agraryo Merkado.
            </p>
        </div>

        <div class="header-actions">
            <button type="button"
                    class="btn fw-semibold d-flex align-items-center gap-2"
                    data-bs-toggle="modal"
                    data-bs-target="#addUserModal"
                    style="background:var(--green-600); color:#fff; border-radius:10px; border:none; font-size:.84rem;">
                <i class="bi bi-person-plus-fill"></i> Add User
            </button>

            <a href="#"
               class="btn fw-semibold d-flex align-items-center gap-2"
               style="background:#fff; color:var(--green-700); border-radius:10px; border:1px solid var(--gray-200); font-size:.84rem;">
                <i class="bi bi-download"></i> Export List
            </a>

            <div class="header-date-chip">
                <i class="bi bi-calendar3"></i>
                <span id="currentDate"></span>
            </div>
        </div>
    </div>

    <!-- ── Alerts ──────────────────────────────────────── -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3 border-0 shadow-sm mb-4">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 shadow-sm mb-4">
            <div class="fw-semibold mb-1"><i class="bi bi-exclamation-triangle-fill me-2"></i>Please fix the following:</div>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li style="font-size:.84rem;">{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- ── Stat Cards ─────────────────────────────────── -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-4 col-xl-2">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-green"><i class="bi bi-people-fill"></i></div>
                <div>
                    <div class="stat-value">{{ $totalUsers ?? 0 }}</div>
                    <p class="stat-label">Total Users</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-gold"><i class="bi bi-shield-lock-fill"></i></div>
                <div>
                    <div class="stat-value">{{ $totalSuperAdmins ?? 0 }}</div>
                    <p class="stat-label">Super Admins</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-blue"><i class="bi bi-building-fill-gear"></i></div>
                <div>
                    <div class="stat-value">{{ $totalCarposAdmins ?? 0 }}</div>
                    <p class="stat-label">Admin CARPOS</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-teal"><i class="bi bi-person-badge-fill"></i></div>
                <div>
                    <div class="stat-value">{{ $totalArboAdmins ?? 0 }}</div>
                    <p class="stat-label">ARBO Admins</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-green"><i class="bi bi-shop"></i></div>
                <div>
                    <div class="stat-value">{{ $totalSellers ?? 0 }}</div>
                    <p class="stat-label">Sellers</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-4 col-xl-2">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-red"><i class="bi bi-bag-check-fill"></i></div>
                <div>
                    <div class="stat-value">{{ $totalBuyers ?? 0 }}</div>
                    <p class="stat-label">Buyers</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ── Filters ────────────────────────────────────── -->
    <div class="filter-card mb-4">
        <form method="GET" action="{{ route('super_admin.user_roles.index') }}">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Search</label>
                    <input type="text"
                           name="search"
                           class="form-control"
                           placeholder="Name, email, or username"
                           value="{{ request('search') }}"
                           style="border-radius:8px;">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" style="border-radius:8px;">
                        <option value="">All Roles</option>
                        <option value="super_admin" {{ request('role') === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                        <option value="pbd"         {{ request('role') === 'pbd'         ? 'selected' : '' }}>PBD</option>
                        <option value="finance"     {{ request('role') === 'finance'     ? 'selected' : '' }}>Finance</option>
                        <option value="arbo"        {{ request('role') === 'arbo'        ? 'selected' : '' }}>Arbo</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" style="border-radius:8px;">
                        <option value="">All Status</option>
                        <option value="active"   {{ request('status') === 'active'   ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-success flex-fill" style="border-radius:8px;">
                        <i class="bi bi-search"></i>
                    </button>
                    <a href="{{ route('super_admin.user_roles.index') }}" class="btn btn-outline-secondary flex-fill" style="border-radius:8px;">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- ── Table + Activity ───────────────────────────── -->
    <div class="row g-4">

        <!-- Users Table -->
        <div class="col-xl-8">
            <div class="table-card">
                <div class="table-card-header">
                    <h6 class="table-card-title">
                        <i class="bi bi-people-fill"></i>
                        System Users
                    </h6>
                </div>

                <div class="table-responsive">
                    <table class="user-table">
                        <thead>
                            <tr>
                                <th>User ID</th>
                                <th>Full Name</th>
                                <th>Email / Username</th>
                                <th>Role</th>
                                <th>Assigned Office</th>
                                <th>Status</th>
                                <th>Date Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                            @php
                                $fullName  = trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? ''));
                                $roleSlug  = $user->role->slug ?? '';
                                $roleLabel = $user->role->name ?? ucwords(str_replace('_', ' ', $roleSlug));
                            @endphp
                            <tr>
                                <td class="cell-id">USR-{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</td>
                                <td class="cell-name">
                                    {{ $fullName }}
                                    <small>{{ $user->username ?? '—' }}</small>
                                </td>
                                <td style="font-size:.82rem;">{{ $user->email ?? '—' }}</td>
                                <td>
                                    <span class="role-badge role-{{ $roleSlug }}">
                                        <span class="role-dot"></span>
                                        {{ $roleLabel }}
                                    </span>
                                </td>
                                <td style="font-size:.82rem; color:var(--text-muted);">
                                    {{ $user->province->name ?? '—' }}
                                </td>
                                <td>
                                    @if($user->status === 'active')
                                        <span class="status-badge status-active"><span class="status-dot"></span> Active</span>
                                    @else
                                        <span class="status-badge status-inactive"><span class="status-dot"></span> Inactive</span>
                                    @endif
                                </td>
                                <td style="font-size:.78rem; color:var(--text-muted);">
                                    {{ optional($user->created_at)->format('M d, Y') }}
                                </td>
                                <td>
                                    <div class="d-flex gap-1 flex-wrap">
                                        <a href="#" class="action-btn btn-view">
                                            <i class="bi bi-eye-fill"></i> View
                                        </a>
                                        <a href="#" class="action-btn btn-edit">
                                            <i class="bi bi-pencil-fill"></i> Edit
                                        </a>
                                        @if($user->status === 'active')
                                            <button type="button"
                                                    class="action-btn btn-deactivate"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#statusModal"
                                                    data-id="{{ $user->id }}"
                                                    data-name="{{ $fullName }}"
                                                    data-action="deactivate">
                                                <i class="bi bi-slash-circle-fill"></i> Deactivate
                                            </button>
                                        @else
                                            <button type="button"
                                                    class="action-btn btn-activate"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#statusModal"
                                                    data-id="{{ $user->id }}"
                                                    data-name="{{ $fullName }}"
                                                    data-action="activate">
                                                <i class="bi bi-check-circle-fill"></i> Activate
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <div class="empty-state">
                                        <i class="bi bi-people-fill"></i>
                                        <div class="fw-semibold mb-1">No users found</div>
                                        <div class="small mb-3">Try adjusting the filters or add a new user.</div>
                                        <button type="button"
                                                class="btn btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#addUserModal"
                                                style="background:var(--green-600); color:#fff; border-radius:8px; border:none;">
                                            <i class="bi bi-person-plus-fill me-1"></i> Add User
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                @if(method_exists($users, 'links'))
                    <div class="px-4 py-3 border-top d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <div class="text-muted" style="font-size:.78rem;">
                            Showing {{ $users->firstItem() ?? 0 }}–{{ $users->lastItem() ?? 0 }} of {{ $users->total() ?? 0 }} users
                        </div>
                        {{ $users->withQueryString()->links('pagination::bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Activity Log -->
        <div class="col-xl-4">
            <div class="side-card">
                <div class="side-card-header">
                    <h6 class="side-card-title">
                        <i class="bi bi-clock-history"></i>
                        Recent Role Changes
                    </h6>
                </div>
                <ul class="activity-log">
                    <li class="activity-item">
                        <div class="activity-dot ad-blue"><i class="bi bi-person-plus-fill"></i></div>
                        <div>
                            <div class="activity-title">New user account created</div>
                            <div class="activity-meta">A new Admin CARPOS user was added · 1 hour ago</div>
                        </div>
                    </li>
                    <li class="activity-item">
                        <div class="activity-dot ad-green"><i class="bi bi-check-circle-fill"></i></div>
                        <div>
                            <div class="activity-title">User reactivated</div>
                            <div class="activity-meta">Seller account restored · 3 hours ago</div>
                        </div>
                    </li>
                    <li class="activity-item">
                        <div class="activity-dot ad-gold"><i class="bi bi-pencil-fill"></i></div>
                        <div>
                            <div class="activity-title">Role updated</div>
                            <div class="activity-meta">Buyer changed to ARBO Admin · Yesterday</div>
                        </div>
                    </li>
                    <li class="activity-item">
                        <div class="activity-dot ad-red"><i class="bi bi-slash-circle-fill"></i></div>
                        <div>
                            <div class="activity-title">User deactivated</div>
                            <div class="activity-meta">Inactive buyer account disabled · Yesterday</div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</main>

<!-- ── Add User Modal ──────────────────────────────────── -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('super_admin.user_roles.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="addUserModalLabel">
                        <i class="bi bi-person-plus-fill me-2" style="color:var(--green-600);"></i>
                        Add User
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name" class="form-control" required style="border-radius:8px;" value="{{ old('first_name') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Middle Name</label>
                            <input type="text" name="middle_name" class="form-control" style="border-radius:8px;" value="{{ old('middle_name') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control" required style="border-radius:8px;" value="{{ old('last_name') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" style="border-radius:8px;" value="{{ old('email') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Contact Number</label>
                            <input type="text" name="contact_number" class="form-control" style="border-radius:8px;" value="{{ old('contact_number') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" required style="border-radius:8px;" value="{{ old('username') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required style="border-radius:8px;">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required style="border-radius:8px;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Role</label>
                            <select name="role" id="roleSelect" class="form-select" required style="border-radius:8px;">
                                <option value="">Select role</option>
                                <option value="super_admin" {{ old('role') === 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                                <option value="pbd"         {{ old('role') === 'pbd'         ? 'selected' : '' }}>PBD</option>
                                <option value="finance"     {{ old('role') === 'finance'     ? 'selected' : '' }}>Finance</option>
                                <option value="arbo"        {{ old('role') === 'arbo'        ? 'selected' : '' }}>Arbo</option>
                            </select>
                        </div>
                        <div class="col-md-6" id="pbdRegionWrapper" style="{{ old('role') ? '' : 'display:none;' }}">
                            <label class="form-label">Province</label>
                            <select name="province_id" id="pbdRegionSelect" class="form-select" style="border-radius:8px;">
                                <option value="">Select province</option>
                                @foreach($provinces as $prov)
                                    <option value="{{ $prov->id }}" {{ old('province_id') == $prov->id ? 'selected' : '' }}>{{ $prov->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required style="border-radius:8px;">
                                <option value="active"   {{ old('status', 'active') === 'active'   ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius:8px;">
                        Cancel
                    </button>
                    <button type="submit"
                            class="btn fw-semibold"
                            style="background:var(--green-600); color:#fff; border-radius:8px; border:none;">
                        <i class="bi bi-check-circle-fill me-1"></i> Save User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ── Status Modal ────────────────────────────────────── -->
<div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="statusModalLabel">Update User Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="statusForm" method="POST" action="#">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <p class="mb-2" style="font-size:.88rem;">Are you sure you want to update the status of:</p>
                    <p class="fw-semibold mb-3" id="statusUserName"></p>
                    <div class="alert alert-warning mb-0" style="border-radius:10px; font-size:.84rem;">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        This action will affect the user's access to the system.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius:8px;">Cancel</button>
                    <button type="submit" id="statusSubmitBtn" class="btn btn-danger" style="border-radius:8px;">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ── Current Date ──────────────────────────────────────
    const dateEl = document.getElementById('currentDate');
    if (dateEl) {
        const now = new Date();
        dateEl.textContent = now.toLocaleDateString('en-PH', {
            weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
        });
    }

    // ── Mobile Sidebar Toggle ─────────────────────────────
    const toggle  = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('mainSidebar');
    const overlay = document.getElementById('sidebarOverlay');

    function openSidebar() {
        sidebar.classList.add('show');
        overlay.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
        document.body.style.overflow = '';
    }

    if (toggle)  toggle.addEventListener('click', openSidebar);
    if (overlay) overlay.addEventListener('click', closeSidebar);

    // ── Status Modal ──────────────────────────────────────
    const statusModal = document.getElementById('statusModal');
    if (statusModal) {
        statusModal.addEventListener('show.bs.modal', function (event) {
            const button   = event.relatedTarget;
            const userId   = button.getAttribute('data-id');
            const userName = button.getAttribute('data-name');
            const action   = button.getAttribute('data-action');

            document.getElementById('statusUserName').textContent = userName;

            const submitBtn = document.getElementById('statusSubmitBtn');
            if (action === 'activate') {
                submitBtn.textContent = 'Activate User';
                submitBtn.className = 'btn btn-success';
                submitBtn.style.borderRadius = '8px';
            } else {
                submitBtn.textContent = 'Deactivate User';
                submitBtn.className = 'btn btn-danger';
                submitBtn.style.borderRadius = '8px';
            }

            document.getElementById('statusForm').action = '/super-admin/user-roles/' + userId + '/' + action;
        });
    }

    // ── Re-open add modal on validation errors ────────────
    @if($errors->any())
        const addUserModal = new bootstrap.Modal(document.getElementById('addUserModal'));
        addUserModal.show();
    @endif

    // ── SweetAlert flash ─────────────────────────────────
    @if(session('swal'))
        const _swal = @json(session('swal'));
        if (typeof Swal !== 'undefined' && _swal) {
            Swal.fire(_swal);
        }
    @endif

});
    </script>

<!-- Branches slide-over panel (loaded via AJAX) -->
<style>
    #branchesPanel{position:fixed;top:62px;right:0;bottom:0;width:420px;max-width:92%;background:#fff;box-shadow:-12px 0 34px rgba(0,0,0,0.12);transform:translateX(100%);transition:transform .28s ease-in-out;z-index:2050;overflow:auto}
    #branchesPanel.open{transform:translateX(0)}
    #branchesPanelHeader{display:flex;align-items:center;justify-content:space-between;padding:12px 14px;border-bottom:1px solid #f1f1f1}
    #branchesPanelContent{padding:14px}
</style>
<div id="branchesPanel" aria-hidden="true">
    <div id="branchesPanelHeader">
        <strong>Branches</strong>
        <button id="branchesPanelClose" class="btn btn-sm btn-outline-secondary">Close</button>
    </div>
    <div id="branchesPanelContent">Loading…</div>
</div>
<script>
document.addEventListener('click', function(e){
    var btn = e.target.closest && e.target.closest('.open-branches-panel');
    if(!btn) return;
    e.preventDefault();
    var url = btn.getAttribute('data-href') || btn.getAttribute('href');
    openBranchesPanel(url);
});
function openBranchesPanel(url){
    var panel = document.getElementById('branchesPanel');
    var content = document.getElementById('branchesPanelContent');
    if(!panel||!content) return;
    panel.classList.add('open'); panel.setAttribute('aria-hidden','false');
    content.innerHTML = 'Loading…';
    fetch(url, {headers:{'X-Requested-With':'XMLHttpRequest'}})
        .then(r=>r.text())
        .then(html=>{
            var m = html.match(/<main[\s\S]*?>[\s\S]*?<\/main>/i);
            if(m) content.innerHTML = m[0]; else content.innerHTML = html;
        }).catch(()=>{ content.innerHTML = '<div class="p-3 text-danger">Failed to load branches.</div>'; });
}
document.addEventListener('DOMContentLoaded', function(){
    var close = document.getElementById('branchesPanelClose');
    if(close) close.addEventListener('click', function(){ var p=document.getElementById('branchesPanel'); if(p){ p.classList.remove('open'); p.setAttribute('aria-hidden','true'); }});
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function(){
    var role = document.getElementById('roleSelect');
    var wrapper = document.getElementById('pbdRegionWrapper');
    var region = document.getElementById('pbdRegionSelect');

    function toggleRegion(){
        if(!role || !wrapper) return;
        // Show province selector for any selected role (not only 'pbd')
        if(role.value){
            wrapper.style.display = '';
            if(region) region.setAttribute('required','required');
        } else {
            wrapper.style.display = 'none';
            if(region){ region.removeAttribute('required'); region.value = ''; }
        }
    }

    if(role){
        role.addEventListener('change', toggleRegion);
        // initial state
        toggleRegion();
    }
});
</script>

</body>
</html>