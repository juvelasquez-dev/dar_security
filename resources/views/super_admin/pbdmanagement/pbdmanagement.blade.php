<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PBD Management — E-Agraryo Merkado</title>
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
        .navbar-brand-area img { height: 38px; filter: brightness(1.15); }
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
            font-size: 1.15rem; cursor: pointer;
            padding: 6px 8px; border-radius: 8px;
            position: relative;
            transition: color 0.18s, background 0.18s;
        }
        .nav-icon-btn:hover { color: #fff; background: rgba(255,255,255,0.08); }
        .nav-notif-dot {
            position: absolute; top: 5px; right: 6px;
            width: 8px; height: 8px;
            background: var(--gold); border-radius: 50%;
            border: 2px solid var(--green-900);
        }
        .user-pill {
            display: flex; align-items: center; gap: 0.5rem;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 30px; padding: 5px 12px 5px 6px;
            cursor: pointer; transition: background 0.18s; text-decoration: none;
        }
        .user-pill:hover { background: rgba(255,255,255,0.14); }
        .user-avatar { width: 30px; height: 30px; border-radius: 50%; object-fit: cover; border: 1.5px solid rgba(255,255,255,0.25); }
        .user-pill-name { font-size: 0.82rem; font-weight: 500; color: #fff; }
        .user-pill-role { font-size: 0.65rem; color: var(--green-200); }

        /* ─── Sidebar ───────────────────────────────────────── */
        .sidebar {
            position: fixed;
            top: 62px; left: 0; bottom: 0;
            width: var(--sidebar-w);
            background: #fff;
            border-right: 1px solid var(--gray-200);
            overflow-y: auto;
            z-index: 1030;
            display: flex; flex-direction: column;
            box-shadow: var(--shadow-sm);
            transition: transform 0.28s cubic-bezier(.4,0,.2,1);
        }
        .sidebar-inner {
            padding: 1.5rem 1rem;
            flex: 1;
            display: flex; flex-direction: column;
        }
        .sidebar-section-label {
            font-size: 0.65rem; font-weight: 700; letter-spacing: 0.1em;
            text-transform: uppercase; color: var(--gray-400);
            padding: 0 0.5rem; margin: 1.4rem 0 0.5rem;
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
        .sidebar-link.active {
            background: var(--green-100); color: var(--green-700); font-weight: 600;
        }
        .sidebar-link.active::before {
            content: ''; position: absolute;
            left: -3px; top: 20%; bottom: 20%;
            width: 4px; background: var(--green-600); border-radius: 4px;
        }
        .sidebar-link-badge {
            margin-left: auto;
            font-size: 0.65rem; font-weight: 700;
            background: var(--green-100); color: var(--green-700);
            padding: 2px 7px; border-radius: 20px;
        }
        .sidebar-link.active .sidebar-link-badge {
            background: var(--green-600); color: #fff;
        }
        .sidebar-logout { margin-top: auto; padding-top: 1rem; border-top: 1px solid var(--gray-200); }
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
            font-size: 0.62rem; font-weight: 700; letter-spacing: 0.1em;
            text-transform: uppercase; color: var(--green-600);
        }
        .sidebar-office-chip .office-name {
            font-size: 0.82rem; font-weight: 600; color: var(--green-900); margin-top: 1px;
        }

        /* ─── Main Content ──────────────────────────────────── */
        .page-wrapper {
            margin-left: var(--sidebar-w); margin-top: 62px;
            min-height: calc(100vh - 62px);
            padding: 2rem 2rem 3rem;
        }

        /* ─── Page header ── */
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
        .page-header-actions { display: flex; gap: 0.6rem; flex-wrap: wrap; }

        /* ─── Stat cards ── */
        .stat-card {
            background: #fff; border-radius: var(--radius);
            box-shadow: var(--shadow-sm); padding: 1.25rem 1.4rem;
            display: flex; align-items: center; gap: 0.9rem;
            transition: box-shadow 0.22s, transform 0.22s;
            border: 1px solid var(--gray-200); height: 100%;
        }
        .stat-card:hover { box-shadow: var(--shadow-md); transform: translateY(-4px); }
        .stat-icon-wrap {
            width: 50px; height: 50px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem; flex-shrink: 0;
        }
        .si-green  { background: var(--green-100); color: var(--green-700); }
        .si-gold   { background: var(--gold-light); color: var(--gold); }
        .si-blue   { background: #e8f0fe; color: #1a73e8; }
        .si-red    { background: #fdecea; color: #c0392b; }
        .stat-value { font-size: 1.85rem; font-weight: 700; color: var(--text-main); line-height: 1; margin-bottom: 2px; }
        .stat-label { font-size: 0.78rem; font-weight: 500; color: var(--text-muted); margin: 0; }

        /* ─── Section title ── */
        .section-title {
            font-size: 0.95rem; font-weight: 700; color: var(--text-main);
            margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;
        }
        .section-title-bar { width: 4px; height: 18px; background: var(--green-600); border-radius: 3px; }

        /* ─── Filter card ── */
        .filter-card {
            background: #fff; border-radius: var(--radius);
            box-shadow: var(--shadow-sm); border: 1px solid var(--gray-200);
            padding: 1.25rem 1.5rem;
        }

        /* ─── Table card ── */
        .table-card {
            background: #fff; border-radius: var(--radius);
            box-shadow: var(--shadow-sm); border: 1px solid var(--gray-200); overflow: hidden;
        }
        .table-card-header {
            padding: 1.1rem 1.5rem 0.9rem;
            border-bottom: 1px solid var(--gray-200);
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 0.5rem;
        }
        .table-card-title {
            font-size: 0.9rem; font-weight: 700; color: var(--text-main);
            margin: 0; display: flex; align-items: center; gap: 0.45rem;
        }
        .table-card-title i { color: var(--green-600); }

        /* ─── Data table ── */
        .offices-table { width: 100%; border-collapse: collapse; font-size: 0.84rem; }
        .offices-table thead th {
            background: var(--green-50); color: var(--green-800);
            font-weight: 700; font-size: 0.71rem; letter-spacing: 0.05em;
            text-transform: uppercase; padding: 0.75rem 1rem;
            border-bottom: 1px solid var(--green-200); white-space: nowrap;
        }
        .offices-table tbody tr { border-bottom: 1px solid var(--gray-100); transition: background 0.14s; }
        .offices-table tbody tr:last-child { border-bottom: none; }
        .offices-table tbody tr:hover { background: var(--gray-50); }
        .offices-table td { padding: 0.8rem 1rem; vertical-align: middle; color: var(--text-main); }
        .cell-id    { font-size: 0.72rem; font-weight: 700; color: var(--text-muted); font-family: monospace; }
        .cell-name  { font-weight: 600; color: var(--text-main); }
        .cell-name small { display: block; font-weight: 400; font-size: 0.71rem; color: var(--text-muted); margin-top: 1px; }
        .cell-admin { font-size: 0.82rem; }
        .cell-admin .no-admin {
            display: inline-flex; align-items: center; gap: 4px;
            font-size: 0.71rem; color: var(--gold); font-weight: 600;
            background: var(--gold-light); padding: 2px 8px; border-radius: 20px;
        }

        /* ─── Status badges ── */
        .status-badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 3px 10px; border-radius: 20px;
            font-size: 0.72rem; font-weight: 600; white-space: nowrap;
        }
        .status-active   { background: var(--green-100); color: var(--green-700); }
        .status-inactive { background: #fdecea; color: #c0392b; }
        .status-dot { width: 6px; height: 6px; border-radius: 50%; display: inline-block; flex-shrink: 0; }
        .status-active   .status-dot { background: var(--green-600); }
        .status-inactive .status-dot { background: #c0392b; }

        /* ─── Province badge ── */
        .province-badge {
            display: inline-flex; align-items: center;
            padding: 3px 9px; border-radius: 20px;
            font-size: 0.71rem; font-weight: 600;
            background: var(--green-50); color: var(--green-800);
            border: 1px solid var(--green-200);
            white-space: nowrap;
        }

        /* ─── Action buttons ── */
        .action-btn {
            display: inline-flex; align-items: center; gap: 3px;
            padding: 4px 9px; border-radius: 7px;
            font-size: 0.71rem; font-weight: 600;
            border: none; cursor: pointer; text-decoration: none;
            transition: all 0.16s; white-space: nowrap;
        }
        .action-btn:hover { opacity: 0.82; transform: translateY(-1px); }
        .btn-view       { background: var(--green-100);  color: var(--green-700); }
        .btn-edit       { background: var(--gold-light); color: var(--gold); }
        .btn-assign     { background: #e8f0fe;           color: #1a73e8; }
        .btn-deactivate { background: #fdecea;           color: #c0392b; }
        .btn-activate   { background: var(--green-100);  color: var(--green-700); }

        /* ─── Pagination ── */
        .pagination .page-link {
            border-radius: 8px !important; margin: 0 2px;
            font-size: 0.82rem; font-weight: 500;
            color: var(--gray-600); border: 1px solid var(--gray-200);
        }
        .pagination .page-item.active .page-link { background: var(--green-600); border-color: var(--green-600); color: #fff; }
        .pagination .page-link:hover { background: var(--green-100); color: var(--green-700); }

        /* ─── Empty state ── */
        .empty-state { padding: 3.5rem 1rem; text-align: center; color: var(--text-muted); }
        .empty-state i { font-size: 2.8rem; margin-bottom: 0.75rem; opacity: 0.35; }

        /* ─── Modal ── */
        .modal-header { border-bottom: 1px solid var(--gray-200); }
        .modal-footer { border-top: 1px solid var(--gray-200); }
        .modal-content { border: none; border-radius: var(--radius); box-shadow: var(--shadow-lg); }

        /* ─── Coverage summary cards ── */
        .coverage-card {
            background: #fff; border-radius: var(--radius);
            box-shadow: var(--shadow-sm); border: 1px solid var(--gray-200);
            padding: 1.1rem 1.25rem; height: 100%;
            transition: box-shadow 0.22s, transform 0.22s;
        }
        .coverage-card:hover { box-shadow: var(--shadow-md); transform: translateY(-3px); }
        .coverage-card-header { display: flex; align-items: center; gap: 0.6rem; margin-bottom: 0.75rem; }
        .coverage-icon {
            width: 36px; height: 36px; border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem; flex-shrink: 0;
        }
        .coverage-title { font-size: 0.82rem; font-weight: 700; color: var(--text-main); margin: 0; }
        .coverage-sub   { font-size: 0.72rem; color: var(--text-muted); margin: 0; }
        .coverage-stat  { font-size: 1.5rem; font-weight: 700; color: var(--green-700); line-height: 1; }
        .coverage-bar   { height: 5px; border-radius: 3px; background: var(--gray-200); margin-top: 0.5rem; overflow: hidden; }
        .coverage-bar-fill { height: 100%; border-radius: 3px; background: var(--green-600); }

        /* ─── Mobile Sidebar ────────────────────────────────── */
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
            .sidebar-overlay {
                display: none; position: fixed; inset: 0;
                background: rgba(0,0,0,0.4); z-index: 1029;
            }
            .sidebar-overlay.show { display: block; }
        }
        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb { background: var(--gray-200); border-radius: 4px; }
        .table-responsive::-webkit-scrollbar { height: 4px; }
        .table-responsive::-webkit-scrollbar-track { background: transparent; }
        .table-responsive::-webkit-scrollbar-thumb { background: rgba(107,114,128,0.25); border-radius: 4px; }
    </style>
</head>
<body>

@php
        $authUser = auth()->user();
        $authFullName = $authUser
            ? trim(($authUser->first_name ?? $authUser->name ?? '') . ' ' . ($authUser->last_name ?? ''))
            : 'Super Admin';
        $roleSlug = $authUser->role->slug ?? 'super_admin';
        $roleLabel = $authUser->role->name ?? ucwords(str_replace('_', ' ', $roleSlug));

        if ($authUser && ! empty($authUser->avatar)) {
            $avatarUrl = asset('storage/' . $authUser->avatar);
        } else {
            $avatarUrl = 'https://ui-avatars.com/api/?name=' . urlencode($authFullName) . '&background=1a6932&color=fff&rounded=true&size=64';
        }
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

        <a href="{{ url('/roles') }}" class="sidebar-link ">
            <i class="bi bi-person-badge"></i>
            User Roles
        </a>

        <a href="{{ url('/branches') }}" class="sidebar-link active">
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
                <h1 class="page-header-title">PBD Management</h1>
                <p class="page-header-sub">Manage Program Beneficiaries Development offices and assigned CARPOS administrators.</p>
            </div>
            <div class="page-header-actions">
                <button type="button"
                        class="btn fw-semibold d-flex align-items-center gap-2"
                        style="background:var(--gold-light); color:var(--gold); border:1px solid rgba(200,146,42,0.3); border-radius:10px;"
                        data-bs-toggle="modal" data-bs-target="#assignAdminModal">
                    <i class="bi bi-person-check-fill"></i> Assign Admin
                </button>
                <a href="{{ url('/super-admin/pbd-management/create') }}"
                   class="btn fw-semibold d-flex align-items-center gap-2"
                   style="background:var(--green-600); color:#fff; border-radius:10px; border:none;">
                    <i class="bi bi-plus-circle-fill"></i> Add PBD Office
                </a>
            </div>
        </div>

        <!-- Flash messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3 mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-3 mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- ── Summary Stat Cards ── -->
        <div class="mb-5">
            <div class="section-title">
                <div class="section-title-bar"></div>
                Overview
            </div>
            <div class="row g-3">
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon-wrap si-green"><i class="bi bi-building-fill"></i></div>
                        <div>
                            <div class="stat-value">{{ $totalOffices ?? 0 }}</div>
                            <p class="stat-label">Total Offices</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon-wrap si-green"><i class="bi bi-check-circle-fill"></i></div>
                        <div>
                            <div class="stat-value">{{ $activeOffices ?? 0 }}</div>
                            <p class="stat-label">Active Offices</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon-wrap si-gold"><i class="bi bi-person-badge-fill"></i></div>
                        <div>
                            <div class="stat-value">{{ $assignedAdmins ?? 0 }}</div>
                            <p class="stat-label">Assigned Admins</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon-wrap si-red"><i class="bi bi-slash-circle-fill"></i></div>
                        <div>
                            <div class="stat-value">{{ $inactiveOffices ?? 0 }}</div>
                            <p class="stat-label">Inactive Offices</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ── Admin Coverage Summary ── -->
        <div class="mb-5">
            <div class="section-title">
                <div class="section-title-bar"></div>
                Admin Coverage by Province
            </div>
            <div class="row g-3">
                @php
                    $provinces = [
                        ['name' => 'Camarines Sur',   'covered' => 2, 'total' => 2, 'icon' => 'si-green'],
                        ['name' => 'Camarines Norte',  'covered' => 1, 'total' => 1, 'icon' => 'si-green'],
                        ['name' => 'Albay',            'covered' => 1, 'total' => 1, 'icon' => 'si-green'],
                        ['name' => 'Sorsogon',         'covered' => 0, 'total' => 1, 'icon' => 'si-red'],
                        ['name' => 'Catanduanes',      'covered' => 1, 'total' => 1, 'icon' => 'si-green'],
                        ['name' => 'Masbate',          'covered' => 0, 'total' => 1, 'icon' => 'si-red'],
                    ];
                @endphp
                @foreach($provinces as $prov)
                    @php
                        $pct = $prov['total'] > 0 ? round(($prov['covered'] / $prov['total']) * 100) : 0;
                        $covered = $prov['covered'] > 0;
                    @endphp
                    <div class="col-6 col-md-4 col-xl-2">
                        <div class="coverage-card">
                            <div class="coverage-card-header">
                                <div class="coverage-icon {{ $prov['icon'] }}">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                                <div>
                                    <p class="coverage-title">{{ $prov['name'] }}</p>
                                    <p class="coverage-sub">{{ $prov['covered'] }}/{{ $prov['total'] }} admins</p>
                                </div>
                            </div>
                            <div class="coverage-stat" style="{{ $covered ? 'color:var(--green-700)' : 'color:#c0392b' }}">
                                {{ $pct }}%
                            </div>
                            <div class="coverage-bar">
                                <div class="coverage-bar-fill"
                                     style="width:{{ $pct }}%; background:{{ $covered ? 'var(--green-600)' : '#c0392b' }};"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- ── Filter / Search Toolbar ── -->
        <div class="mb-4">
            <div class="filter-card">
                <form method="GET" action="{{ url('/super-admin/pbd-management') }}">
                    <div class="row g-3 align-items-end">
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-semibold" style="font-size:.8rem; color:var(--text-muted);">Search Office</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="bi bi-search" style="color:var(--text-muted);"></i>
                                </span>
                                <input type="text" name="search"
                                       class="form-control border-start-0 ps-0"
                                       placeholder="Office name, admin, or ID..."
                                       value="{{ request('search') }}"
                                       style="border-radius:0 8px 8px 0;">
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label fw-semibold" style="font-size:.8rem; color:var(--text-muted);">Province</label>
                            <select name="province" class="form-select" style="border-radius:8px;">
                                <option value="">All Provinces</option>
                                <option value="Camarines Sur"   {{ request('province') === 'Camarines Sur'   ? 'selected' : '' }}>Camarines Sur</option>
                                <option value="Camarines Norte" {{ request('province') === 'Camarines Norte' ? 'selected' : '' }}>Camarines Norte</option>
                                <option value="Albay"           {{ request('province') === 'Albay'           ? 'selected' : '' }}>Albay</option>
                                <option value="Sorsogon"        {{ request('province') === 'Sorsogon'        ? 'selected' : '' }}>Sorsogon</option>
                                <option value="Catanduanes"     {{ request('province') === 'Catanduanes'     ? 'selected' : '' }}>Catanduanes</option>
                                <option value="Masbate"         {{ request('province') === 'Masbate'         ? 'selected' : '' }}>Masbate</option>
                            </select>
                        </div>
                        <div class="col-6 col-md-2">
                            <label class="form-label fw-semibold" style="font-size:.8rem; color:var(--text-muted);">Status</label>
                            <select name="status" class="form-select" style="border-radius:8px;">
                                <option value="">All Status</option>
                                <option value="active"   {{ request('status') === 'active'   ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-3 d-flex gap-2">
                            <button type="submit"
                                    class="btn fw-semibold flex-fill"
                                    style="background:var(--green-600); color:#fff; border-radius:8px; border:none;">
                                <i class="bi bi-search me-1"></i> Search
                            </button>
                            <a href="{{ url('/super-admin/pbd-management') }}"
                               class="btn btn-outline-secondary fw-semibold flex-fill"
                               style="border-radius:8px;">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- ── Offices Table ── -->
        <div class="mb-5">
            <div class="section-title">
                <div class="section-title-bar"></div>
                PBD / CARPOS Offices
            </div>
            <div class="table-card">
                <div class="table-card-header">
                    <h6 class="table-card-title">
                        <i class="bi bi-building"></i>
                        Registered Offices
                        @if(isset($offices))
                            <span class="badge ms-1"
                                  style="background:var(--green-100); color:var(--green-700); font-size:.68rem; border-radius:20px; padding:3px 8px;">
                                {{ $offices->total() ?? count($offices) }} records
                            </span>
                        @endif
                    </h6>
                    <div class="d-flex align-items-center gap-2">
                        <select class="form-select form-select-sm w-auto" style="border-radius:8px; font-size:.78rem;">
                            <option>10 per page</option>
                            <option>25 per page</option>
                            <option>50 per page</option>
                        </select>
                        <a href="{{ url('/super-admin/pbd-management/export') }}"
                           class="btn btn-sm d-flex align-items-center gap-1"
                           style="font-size:.76rem; border-radius:8px; background:var(--green-100); color:var(--green-700); border:none; font-weight:600;">
                            <i class="bi bi-download"></i> Export
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="offices-table">
                        <thead>
                            <tr>
                                <th>Office ID</th>
                                <th>Office Name</th>
                                <th>Province</th>
                                <th>Assigned Admin</th>
                                <th>Contact Number</th>
                                <th>Status</th>
                                <th>Date Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @isset($offices)
                                @forelse($offices as $office)
                                    <tr>
                                        <td class="cell-id">PBD-{{ str_pad($office->id, 4, '0', STR_PAD_LEFT) }}</td>
                                        <td class="cell-name">
                                            {{ $office->name }}
                                            <small>{{ $office->address ?? '—' }}</small>
                                        </td>
                                        <td><span class="province-badge">{{ $office->province }}</span></td>
                                        <td class="cell-admin">
                                            @if($office->admin)
                                                {{ $office->admin->name }}
                                            @else
                                                <span class="no-admin"><i class="bi bi-exclamation-circle"></i> Unassigned</span>
                                            @endif
                                        </td>
                                        <td style="font-size:.82rem;">{{ $office->contact_number ?? '—' }}</td>
                                        <td>
                                            @if($office->status === 'active')
                                                <span class="status-badge status-active"><span class="status-dot"></span> Active</span>
                                            @else
                                                <span class="status-badge status-inactive"><span class="status-dot"></span> Inactive</span>
                                            @endif
                                        </td>
                                        <td style="font-size:.78rem; color:var(--text-muted);">
                                            {{ \Carbon\Carbon::parse($office->created_at)->format('M d, Y') }}
                                        </td>
                                        <td>
                                            <div class="d-flex gap-1 flex-wrap">
                                                <a href="{{ url('/super-admin/pbd-management/'.$office->id) }}" class="action-btn btn-view">
                                                    <i class="bi bi-eye-fill"></i> View
                                                </a>
                                                <a href="{{ url('/super-admin/pbd-management/'.$office->id.'/edit') }}" class="action-btn btn-edit">
                                                    <i class="bi bi-pencil-fill"></i> Edit
                                                </a>
                                                <button type="button" class="action-btn btn-assign"
                                                    data-bs-toggle="modal" data-bs-target="#assignAdminModal"
                                                    data-id="{{ $office->id }}"
                                                    data-name="{{ $office->name }}"
                                                    data-admin-id="{{ $office->admin->id ?? '' }}">
                                                    <i class="bi bi-person-check-fill"></i> Assign Admin
                                                </button>
                                                @if($office->status === 'active')
                                                    <button type="button" class="action-btn btn-deactivate"
                                                            data-bs-toggle="modal" data-bs-target="#toggleModal"
                                                            data-id="{{ $office->id }}"
                                                            data-name="{{ $office->name }}"
                                                            data-action="deactivate">
                                                        <i class="bi bi-slash-circle-fill"></i> Deactivate
                                                    </button>
                                                @else
                                                    <button type="button" class="action-btn btn-activate"
                                                            data-bs-toggle="modal" data-bs-target="#toggleModal"
                                                            data-id="{{ $office->id }}"
                                                            data-name="{{ $office->name }}"
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
                                                <i class="bi bi-building d-block"></i>
                                                <p class="fw-semibold mb-1">No offices found</p>
                                                <p class="small">Try adjusting your filters or add a new PBD office.</p>
                                                <a href="{{ url('/super-admin/pbd-management/create') }}"
                                                   class="btn btn-sm mt-1"
                                                   style="background:var(--green-600); color:#fff; border-radius:8px; border:none;">
                                                    <i class="bi bi-plus-circle-fill me-1"></i> Add PBD Office
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            @else

                            <!-- Static sample rows -->
                            <tr>
                                <td class="cell-id">PBD-0001</td>
                                <td class="cell-name">CARPOS-PBD Regional Office<small>Panganiban Drive, Naga City</small></td>
                                <td><span class="province-badge">Camarines Sur</span></td>
                                <td class="cell-admin">Maria Reyes Santos</td>
                                <td style="font-size:.82rem;">(054) 472-1234</td>
                                <td><span class="status-badge status-active"><span class="status-dot"></span> Active</span></td>
                                <td style="font-size:.78rem; color:var(--text-muted);">Jan 05, 2024</td>
                                <td>
                                    <div class="d-flex gap-1 flex-wrap">
                                        <a href="#" class="action-btn btn-view"><i class="bi bi-eye-fill"></i> View</a>
                                        <a href="#" class="action-btn btn-edit"><i class="bi bi-pencil-fill"></i> Edit</a>
                                        <button class="action-btn btn-assign" data-bs-toggle="modal" data-bs-target="#assignAdminModal" data-id="1" data-name="CARPOS-PBD Regional Office"><i class="bi bi-person-check-fill"></i> Assign Admin</button>
                                        <button class="action-btn btn-deactivate" data-bs-toggle="modal" data-bs-target="#toggleModal" data-id="1" data-name="CARPOS-PBD Regional Office" data-action="deactivate"><i class="bi bi-slash-circle-fill"></i> Deactivate</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell-id">PBD-0002</td>
                                <td class="cell-name">CARPOS-PBD Albay<small>Legazpi City, Albay</small></td>
                                <td><span class="province-badge">Albay</span></td>
                                <td class="cell-admin">Juan dela Cruz</td>
                                <td style="font-size:.82rem;">(052) 481-5678</td>
                                <td><span class="status-badge status-active"><span class="status-dot"></span> Active</span></td>
                                <td style="font-size:.78rem; color:var(--text-muted);">Jan 12, 2024</td>
                                <td>
                                    <div class="d-flex gap-1 flex-wrap">
                                        <a href="#" class="action-btn btn-view"><i class="bi bi-eye-fill"></i> View</a>
                                        <a href="#" class="action-btn btn-edit"><i class="bi bi-pencil-fill"></i> Edit</a>
                                        <button class="action-btn btn-assign" data-bs-toggle="modal" data-bs-target="#assignAdminModal" data-id="2" data-name="CARPOS-PBD Albay"><i class="bi bi-person-check-fill"></i> Assign Admin</button>
                                        <button class="action-btn btn-deactivate" data-bs-toggle="modal" data-bs-target="#toggleModal" data-id="2" data-name="CARPOS-PBD Albay" data-action="deactivate"><i class="bi bi-slash-circle-fill"></i> Deactivate</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell-id">PBD-0003</td>
                                <td class="cell-name">CARPOS-PBD Catanduanes<small>Virac, Catanduanes</small></td>
                                <td><span class="province-badge">Catanduanes</span></td>
                                <td class="cell-admin">Rosa Bautista</td>
                                <td style="font-size:.82rem;">(053) 811-9012</td>
                                <td><span class="status-badge status-active"><span class="status-dot"></span> Active</span></td>
                                <td style="font-size:.78rem; color:var(--text-muted);">Feb 03, 2024</td>
                                <td>
                                    <div class="d-flex gap-1 flex-wrap">
                                        <a href="#" class="action-btn btn-view"><i class="bi bi-eye-fill"></i> View</a>
                                        <a href="#" class="action-btn btn-edit"><i class="bi bi-pencil-fill"></i> Edit</a>
                                        <button class="action-btn btn-assign" data-bs-toggle="modal" data-bs-target="#assignAdminModal" data-id="3" data-name="CARPOS-PBD Catanduanes"><i class="bi bi-person-check-fill"></i> Assign Admin</button>
                                        <button class="action-btn btn-deactivate" data-bs-toggle="modal" data-bs-target="#toggleModal" data-id="3" data-name="CARPOS-PBD Catanduanes" data-action="deactivate"><i class="bi bi-slash-circle-fill"></i> Deactivate</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell-id">PBD-0004</td>
                                <td class="cell-name">CARPOS-PBD Camarines Sur 1<small>Naga City, Camarines Sur</small></td>
                                <td><span class="province-badge">Camarines Sur</span></td>
                                <td class="cell-admin">Linda Pascual</td>
                                <td style="font-size:.82rem;">(054) 473-3456</td>
                                <td><span class="status-badge status-active"><span class="status-dot"></span> Active</span></td>
                                <td style="font-size:.78rem; color:var(--text-muted);">Feb 18, 2024</td>
                                <td>
                                    <div class="d-flex gap-1 flex-wrap">
                                        <a href="#" class="action-btn btn-view"><i class="bi bi-eye-fill"></i> View</a>
                                        <a href="#" class="action-btn btn-edit"><i class="bi bi-pencil-fill"></i> Edit</a>
                                        <button class="action-btn btn-assign" data-bs-toggle="modal" data-bs-target="#assignAdminModal" data-id="4" data-name="CARPOS-PBD Camarines Sur 1"><i class="bi bi-person-check-fill"></i> Assign Admin</button>
                                        <button class="action-btn btn-deactivate" data-bs-toggle="modal" data-bs-target="#toggleModal" data-id="4" data-name="CARPOS-PBD Camarines Sur 1" data-action="deactivate"><i class="bi bi-slash-circle-fill"></i> Deactivate</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell-id">PBD-0005</td>
                                <td class="cell-name">CARPOS-PBD Sorsogon<small>Sorsogon City, Sorsogon</small></td>
                                <td><span class="province-badge">Sorsogon</span></td>
                                <td class="cell-admin"><span class="no-admin"><i class="bi bi-exclamation-circle"></i> Unassigned</span></td>
                                <td style="font-size:.82rem;">(056) 211-7890</td>
                                <td><span class="status-badge status-active"><span class="status-dot"></span> Active</span></td>
                                <td style="font-size:.78rem; color:var(--text-muted);">Mar 05, 2024</td>
                                <td>
                                    <div class="d-flex gap-1 flex-wrap">
                                        <a href="#" class="action-btn btn-view"><i class="bi bi-eye-fill"></i> View</a>
                                        <a href="#" class="action-btn btn-edit"><i class="bi bi-pencil-fill"></i> Edit</a>
                                        <button class="action-btn btn-assign" data-bs-toggle="modal" data-bs-target="#assignAdminModal" data-id="5" data-name="CARPOS-PBD Sorsogon"><i class="bi bi-person-check-fill"></i> Assign Admin</button>
                                        <button class="action-btn btn-deactivate" data-bs-toggle="modal" data-bs-target="#toggleModal" data-id="5" data-name="CARPOS-PBD Sorsogon" data-action="deactivate"><i class="bi bi-slash-circle-fill"></i> Deactivate</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell-id">PBD-0006</td>
                                <td class="cell-name">CARPOS-PBD Masbate<small>Masbate City, Masbate</small></td>
                                <td><span class="province-badge">Masbate</span></td>
                                <td class="cell-admin"><span class="no-admin"><i class="bi bi-exclamation-circle"></i> Unassigned</span></td>
                                <td style="font-size:.82rem;">(056) 333-1122</td>
                                <td><span class="status-badge status-inactive"><span class="status-dot"></span> Inactive</span></td>
                                <td style="font-size:.78rem; color:var(--text-muted);">Apr 14, 2024</td>
                                <td>
                                    <div class="d-flex gap-1 flex-wrap">
                                        <a href="#" class="action-btn btn-view"><i class="bi bi-eye-fill"></i> View</a>
                                        <a href="#" class="action-btn btn-edit"><i class="bi bi-pencil-fill"></i> Edit</a>
                                        <button class="action-btn btn-assign" data-bs-toggle="modal" data-bs-target="#assignAdminModal" data-id="6" data-name="CARPOS-PBD Masbate"><i class="bi bi-person-check-fill"></i> Assign Admin</button>
                                        <button class="action-btn btn-activate" data-bs-toggle="modal" data-bs-target="#toggleModal" data-id="6" data-name="CARPOS-PBD Masbate" data-action="activate"><i class="bi bi-check-circle-fill"></i> Activate</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="cell-id">PBD-0007</td>
                                <td class="cell-name">CARPOS-PBD Camarines Norte<small>Daet, Camarines Norte</small></td>
                                <td><span class="province-badge">Camarines Norte</span></td>
                                <td class="cell-admin">Pedro Reyes</td>
                                <td style="font-size:.82rem;">(054) 440-3344</td>
                                <td><span class="status-badge status-active"><span class="status-dot"></span> Active</span></td>
                                <td style="font-size:.78rem; color:var(--text-muted);">May 20, 2024</td>
                                <td>
                                    <div class="d-flex gap-1 flex-wrap">
                                        <a href="#" class="action-btn btn-view"><i class="bi bi-eye-fill"></i> View</a>
                                        <a href="#" class="action-btn btn-edit"><i class="bi bi-pencil-fill"></i> Edit</a>
                                        <button class="action-btn btn-assign" data-bs-toggle="modal" data-bs-target="#assignAdminModal" data-id="7" data-name="CARPOS-PBD Camarines Norte"><i class="bi bi-person-check-fill"></i> Assign Admin</button>
                                        <button class="action-btn btn-deactivate" data-bs-toggle="modal" data-bs-target="#toggleModal" data-id="7" data-name="CARPOS-PBD Camarines Norte" data-action="deactivate"><i class="bi bi-slash-circle-fill"></i> Deactivate</button>
                                    </div>
                                </td>
                            </tr>

                            @endisset

                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @isset($offices)
                    @if(method_exists($offices, 'links'))
                        <div class="px-4 py-3 border-top d-flex align-items-center justify-content-between flex-wrap gap-2"
                             style="border-color:var(--gray-200) !important;">
                            <div class="text-muted" style="font-size:.78rem;">
                                Showing {{ $offices->firstItem() }}–{{ $offices->lastItem() }} of {{ $offices->total() }} offices
                            </div>
                            {{ $offices->withQueryString()->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                @else
                    <div class="px-4 py-3 border-top d-flex align-items-center justify-content-between flex-wrap gap-2"
                         style="border-color:var(--gray-200) !important;">
                        <div class="text-muted" style="font-size:.78rem;">Showing 1–7 of 7 offices</div>
                        <nav>
                            <ul class="pagination pagination-sm mb-0">
                                <li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                            </ul>
                        </nav>
                    </div>
                @endisset

            </div>
        </div>

    </main>

    <!-- ── Modal — Assign Admin ─────────────────────────────── -->
    <div class="modal fade" id="assignAdminModal" tabindex="-1" aria-labelledby="assignAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="assignAdminModalLabel">
                        <i class="bi bi-person-check-fill me-2" style="color:var(--green-600);"></i>Assign CARPOS Admin
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" id="assignAdminForm" action="">
                    @csrf @method('PATCH')
                    <div class="modal-body">
                        <p class="mb-3 text-muted" style="font-size:.88rem;">
                            Assigning an admin to:
                            <span class="fw-semibold" id="assignOfficeName" style="color:var(--text-main);"></span>
                        </p>
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="font-size:.84rem;">Select Admin Account</label>
                            <select name="admin_id" class="form-select" required style="border-radius:8px;">
                                <option value="">— Choose a CARPOS Admin —</option>
                                    @isset($availableAdmins)
                                        @foreach($availableAdmins as $admin)
                                            @php $assignedTo = $admin->province?->name ?? '' ; @endphp
                                            <option value="{{ $admin->id }}" data-assigned-to="{{ $assignedTo }}">{{ $admin->name }} ({{ $admin->email }}){{ $assignedTo ? ' — Assigned: '.$assignedTo : '' }}</option>
                                        @endforeach
                                    @else
                                    <option value="1">Maria Reyes Santos (mrsantos@dar.gov.ph)</option>
                                    <option value="2">Juan dela Cruz (jdelacruz@dar.gov.ph)</option>
                                    <option value="3">Linda Pascual (lpascual@dar.gov.ph)</option>
                                    <option value="4">Pedro Reyes (preyes@dar.gov.ph)</option>
                                @endisset
                            </select>
                                <input type="hidden" name="confirm_reassign" id="confirmReassignInput" value="0">
                            <div class="form-text">Only Admin CARPOS accounts are listed.</div>
                        </div>
                        <div class="mb-0">
                            <label class="form-label fw-semibold" style="font-size:.84rem;">
                                Remarks <span class="text-muted fw-normal">(optional)</span>
                            </label>
                            <textarea name="remarks" class="form-control" rows="2"
                                      placeholder="Reason for assignment..."
                                      style="border-radius:8px; resize:none;"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius:8px;">Cancel</button>
                        <button type="submit" class="btn fw-semibold"
                                style="background:var(--green-600); color:#fff; border-radius:8px; border:none;">
                            <i class="bi bi-person-check-fill me-1"></i> Assign Admin
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

        <!-- ── Modal — Confirm Reassign ───────────────────── -->
        <div class="modal fade" id="confirmReassignModal" tabindex="-1" aria-labelledby="confirmReassignModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="confirmReassignModalLabel">
                            <i class="bi bi-exclamation-triangle-fill me-2 text-warning"></i> Confirm Reassignment
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p id="confirmReassignMessage" class="mb-3" style="font-size:.95rem;"></p>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="confirmDontAsk" />
                            <label class="form-check-label" for="confirmDontAsk">Don't ask again for this session</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="confirmReassignCancel">Cancel</button>
                        <button type="button" class="btn fw-semibold" id="confirmReassignBtn" style="background:var(--green-600); color:#fff; border-radius:8px; border:none;">
                            <i class="bi bi-person-check-fill me-1"></i> Reassign Admin
                        </button>
                    </div>
                </div>
            </div>
        </div>

    <!-- ── Modal — Activate / Deactivate Confirmation ──────── -->
    <div class="modal fade" id="toggleModal" tabindex="-1" aria-labelledby="toggleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="toggleModalLabel">
                        <span id="modalIcon"></span>
                        <span id="modalTitle">Confirm Action</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2" id="modalMessage">Are you sure you want to perform this action on:</p>
                    <p class="fw-semibold mb-3" id="modalOfficeName" style="color:var(--text-main);"></p>
                    <div class="alert d-flex align-items-start gap-2 mb-0" id="modalAlert" style="border-radius:10px;">
                        <i class="mt-1 flex-shrink-0" id="modalAlertIcon"></i>
                        <div style="font-size:.84rem;" id="modalAlertText"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius:8px;">Cancel</button>
                    <form id="toggleForm" method="POST" action="">
                        @csrf @method('PATCH')
                        <button type="submit" class="btn fw-semibold" id="modalSubmitBtn" style="border-radius:8px;">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {

        // ── Mobile Sidebar Toggle ─────────────────────────────
        const toggle  = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('mainSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        function openSidebar()  { sidebar.classList.add('show');    overlay.classList.add('show');    document.body.style.overflow = 'hidden'; }
        function closeSidebar() { sidebar.classList.remove('show'); overlay.classList.remove('show'); document.body.style.overflow = ''; }
        if (toggle)  toggle.addEventListener('click', openSidebar);
        if (overlay) overlay.addEventListener('click', closeSidebar);

        // ── Assign admin modal ────────────────────────────────
        const assignModal = document.getElementById('assignAdminModal');
        if (assignModal) {
            assignModal.addEventListener('show.bs.modal', function (e) {
                const btn = e.relatedTarget;
                if (!btn) return;
                const id   = btn.dataset.id;
                const name = btn.dataset.name;
                if (name) document.getElementById('assignOfficeName').textContent = name;
                if (id)   document.getElementById('assignAdminForm').action = '/super-admin/pbd-management/' + id + '/assign-admin';

                // Pre-select the currently assigned admin if present
                const adminId = btn.dataset.adminId || '';
                const select = document.querySelector('#assignAdminForm select[name="admin_id"]');
                if (select) {
                    // reset
                    select.value = '';
                    if (adminId) select.value = adminId;
                }
            });
        }

        // When submitting the assign form, if the selected admin is assigned to another province,
        // show a confirmation prompt and set hidden `confirm_reassign` accordingly.
        const assignForm = document.getElementById('assignAdminForm');
        if (assignForm) {
            const confirmModalEl = document.getElementById('confirmReassignModal');
            const confirmModal = confirmModalEl ? new bootstrap.Modal(confirmModalEl) : null;
            const confirmMsg = document.getElementById('confirmReassignMessage');
            const confirmBtn = document.getElementById('confirmReassignBtn');
            const confirmCancel = document.getElementById('confirmReassignCancel');
            const dontAskCheckbox = document.getElementById('confirmDontAsk');

            assignForm.addEventListener('submit', function (evt) {
                const select = assignForm.querySelector('select[name="admin_id"]');
                const hidden = document.getElementById('confirmReassignInput');
                if (!select) return;
                const opt = select.options[select.selectedIndex];
                if (!opt || !opt.value) return;
                const assignedTo = opt.dataset.assignedTo || '';
                const targetName = document.getElementById('assignOfficeName')?.textContent || '';

                if (assignedTo && assignedTo.trim() !== '' && assignedTo.trim() !== targetName.trim()) {
                    // prevent immediate submit and show modal
                    evt.preventDefault();
                    if (confirmMsg) confirmMsg.textContent = 'The selected user is already assigned to ' + assignedTo + '. Do you want to reassign to ' + targetName + '?';
                    if (confirmModal) confirmModal.show();

                    // wire confirm button to submit the form with the hidden flag
                    const onConfirm = function () {
                        if (hidden) hidden.value = '1';
                        // optional: remember preference (session) - not persisted beyond page load
                        if (dontAskCheckbox && dontAskCheckbox.checked) {
                            sessionStorage.setItem('pbd_confirm_reassign_skip', '1');
                        }
                        if (confirmModal) confirmModal.hide();
                        // remove handlers to avoid duplicate binding
                        confirmBtn.removeEventListener('click', onConfirm);
                        confirmCancel.removeEventListener('click', onCancel);
                        assignForm.submit();
                    };

                    const onCancel = function () {
                        if (confirmModal) confirmModal.hide();
                        confirmBtn.removeEventListener('click', onConfirm);
                        confirmCancel.removeEventListener('click', onCancel);
                    };

                    confirmBtn.addEventListener('click', onConfirm);
                    confirmCancel.addEventListener('click', onCancel);

                    return false;
                }

                // If user previously opted to skip confirmation in this session, set hidden and allow
                if (sessionStorage.getItem('pbd_confirm_reassign_skip') === '1') {
                    if (hidden) hidden.value = '1';
                }

                return true;
            });
        }

        // ── Toggle (activate/deactivate) modal ───────────────
        const toggleModal = document.getElementById('toggleModal');
        if (toggleModal) {
            toggleModal.addEventListener('show.bs.modal', function (e) {
                const btn    = e.relatedTarget;
                const id     = btn.dataset.id;
                const name   = btn.dataset.name;
                const action = btn.dataset.action;

                document.getElementById('modalOfficeName').textContent = name;
                document.getElementById('toggleForm').action = '/super-admin/pbd-management/' + id + '/' + action;

                if (action === 'deactivate') {
                    document.getElementById('modalIcon').innerHTML     = '<i class="bi bi-slash-circle-fill text-danger me-2"></i>';
                    document.getElementById('modalTitle').textContent  = 'Deactivate Office';
                    document.getElementById('modalMessage').textContent = 'Are you sure you want to deactivate:';
                    document.getElementById('modalAlert').className    = 'alert alert-warning d-flex align-items-start gap-2 mb-0';
                    document.getElementById('modalAlertIcon').className = 'bi bi-exclamation-triangle-fill mt-1 flex-shrink-0';
                    document.getElementById('modalAlertText').textContent = "Deactivating this office will suspend all associated CARPOS Admin access for this location. This action can be reversed at any time.";
                    const sb = document.getElementById('modalSubmitBtn');
                    sb.className = 'btn btn-danger fw-semibold';
                    sb.style.borderRadius = '8px';
                    sb.innerHTML = '<i class="bi bi-slash-circle-fill me-1"></i> Deactivate';
                } else {
                    document.getElementById('modalIcon').innerHTML     = '<i class="bi bi-check-circle-fill text-success me-2"></i>';
                    document.getElementById('modalTitle').textContent  = 'Activate Office';
                    document.getElementById('modalMessage').textContent = 'Are you sure you want to activate:';
                    document.getElementById('modalAlert').className    = 'alert alert-success d-flex align-items-start gap-2 mb-0';
                    document.getElementById('modalAlertIcon').className = 'bi bi-check-circle-fill mt-1 flex-shrink-0';
                    document.getElementById('modalAlertText').textContent = "Activating this office will restore CARPOS Admin access for this location and resume normal operations.";
                    const sb = document.getElementById('modalSubmitBtn');
                    sb.className = 'btn fw-semibold';
                    sb.style.cssText = 'border-radius:8px; background:var(--green-600); color:#fff; border:none;';
                    sb.innerHTML = '<i class="bi bi-check-circle-fill me-1"></i> Activate';
                }
            });
        }

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

</body>
</html>