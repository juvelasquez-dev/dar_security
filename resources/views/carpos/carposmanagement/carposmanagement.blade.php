<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ARBO Management — E-Agraryo Merkado</title>
    <link rel="icon" href="{{ asset('images/dar-logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/dar-logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* =====================================================================
           DESIGN TOKENS — from Document 8 (Admin DARPO dashboard)
           ===================================================================== */
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

        /* ── Dark green top navbar — from Doc 8 ── */
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
        .nav-icon-btn:hover { color: #fff; background: rgba(255,255,255,0.08); }

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
        .user-pill-name { font-size: 0.82rem; font-weight: 500; color: #fff; }
        .user-pill-role { font-size: 0.65rem; color: var(--green-200); }

        /* ── Fixed white sidebar — from Doc 8 ── */
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
        .sidebar-link i { font-size: 1rem; width: 20px; text-align: center; flex-shrink: 0; }
        .sidebar-link:hover { background: var(--green-100); color: var(--green-700); }
        .sidebar-link.active {
            background: var(--green-100);
            color: var(--green-700);
            font-weight: 600;
        }
        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: -3px; top: 20%; bottom: 20%;
            width: 4px;
            background: var(--green-600);
            border-radius: 4px;
        }

        .sidebar-logout {
            margin-top: auto;
            padding-top: 1rem;
            border-top: 1px solid var(--gray-200);
        }
        .sidebar-logout .sidebar-link { color: #c0392b; }
        .sidebar-logout .sidebar-link:hover { background: #fdf2f2; color: #c0392b; }

        /* Office chip — from Doc 8 */
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

        /* ── Main content area — from Doc 8 ── */
        .page-wrapper {
            margin-left: var(--sidebar-w);
            margin-top: 62px;
            min-height: calc(100vh - 62px);
            padding: 2rem 2rem 3rem;
        }

        /* ── Page header — from Doc 8 ── */
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

        /* ── Stat cards — from Doc 8 ── */
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
        .stat-card:hover { box-shadow: var(--shadow-md); transform: translateY(-4px); }

        .stat-icon-wrap {
            width: 52px; height: 52px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.35rem;
            flex-shrink: 0;
        }
        .stat-icon-green  { background: var(--green-100); color: var(--green-700); }
        .stat-icon-gold   { background: var(--gold-light); color: var(--gold); }
        .stat-icon-blue   { background: #e8f0fe; color: #1a73e8; }
        .stat-icon-red    { background: #fdecea; color: #c0392b; }

        .stat-value {
            font-size: 2rem; font-weight: 700;
            color: var(--text-main); line-height: 1; margin-bottom: 3px;
        }
        .stat-label {
            font-size: 0.82rem; font-weight: 500;
            color: var(--text-muted); margin: 0;
        }

        /* ── Section title — from Doc 8 ── */
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

        /* ── Filter card — same shadow/radius as Doc 8 cards ── */
        .filter-card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            padding: 1.25rem 1.5rem;
        }

        /* ── Table card — from Doc 8 ── */
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

        /* ── ARBO data table — green-tinted header from Doc 8 ── */
        .arbo-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.84rem;
        }
        .arbo-table thead th {
            background: var(--green-50);
            color: var(--green-800);
            font-weight: 700;
            font-size: 0.71rem;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            padding: 0.75rem 1.1rem;
            border-bottom: 1px solid var(--green-200);
            white-space: nowrap;
        }
        .arbo-table tbody tr {
            border-bottom: 1px solid var(--gray-100);
            transition: background 0.14s;
        }
        .arbo-table tbody tr:last-child { border-bottom: none; }
        .arbo-table tbody tr:hover     { background: var(--gray-50); }
        .arbo-table td {
            padding: 0.82rem 1.1rem;
            vertical-align: middle;
            color: var(--text-main);
        }
        .cell-primary       { font-weight: 600; color: var(--green-800); }
        .cell-primary small { display:block; font-weight:400; font-size:0.71rem; color:var(--text-muted); margin-top:1px; }
        .cell-id            { font-size:0.75rem; font-weight:700; color:var(--text-muted); font-family:monospace; }

        /* ── Status badges — green/gold/red from Doc 8 ── */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.72rem;
            font-weight: 600;
            white-space: nowrap;
        }
        .status-active   { background: var(--green-100); color: var(--green-700); }
        .status-pending  { background: var(--gold-light); color: var(--gold); }
        .status-inactive { background: #fdecea; color: #c0392b; }
        .status-dot { width:6px; height:6px; border-radius:50%; display:inline-block; flex-shrink:0; }
        .status-active   .status-dot { background: var(--green-600); }
        .status-pending  .status-dot { background: var(--gold); }
        .status-inactive .status-dot { background: #c0392b; }

        /* ── Action buttons ── */
        .action-btn {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            padding: 4px 9px;
            border-radius: 7px;
            font-size: 0.71rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.16s;
            white-space: nowrap;
        }
        .action-btn:hover   { opacity: 0.82; transform: translateY(-1px); }
        .btn-view           { background: var(--green-100);               color: var(--green-700); }
        .btn-edit           { background: var(--gold-light);              color: var(--gold); }
        .btn-approve        { background: var(--green-100);               color: var(--green-700); }
        .btn-deactivate     { background: #fdecea;                        color: #c0392b; }
        .btn-assign         { background: rgba(139,92,246,0.10);          color: #7c3aed; }

        /* ── Pagination — green accent ── */
        .pagination .page-link {
            border-radius: 8px !important;
            margin: 0 2px;
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--gray-600);
            border: 1px solid var(--gray-200);
        }
        .pagination .page-item.active .page-link {
            background: var(--green-600);
            border-color: var(--green-600);
            color: #fff;
        }
        .pagination .page-link:hover {
            background: var(--green-100);
            color: var(--green-700);
        }

        /* ── Activity log — from Doc 8 ── */
        .activity-log  { list-style:none; padding:0; margin:0; }
        .activity-item {
            display: flex;
            gap: 0.85rem;
            padding: 0.85rem 1.25rem;
            border-bottom: 1px solid var(--gray-100);
            align-items: flex-start;
            transition: background 0.14s;
        }
        .activity-item:last-child { border-bottom: none; }
        .activity-item:hover      { background: var(--gray-50); }
        .activity-dot-wrap { flex-shrink: 0; margin-top: 3px; }
        .activity-dot {
            width: 32px; height: 32px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.85rem;
        }
        .ad-green  { background: var(--green-100); color: var(--green-700); }
        .ad-gold   { background: var(--gold-light); color: var(--gold); }
        .ad-blue   { background: #e8f0fe; color: #1a73e8; }
        .ad-red    { background: #fdecea; color: #c0392b; }
        .ad-purple { background: rgba(139,92,246,0.10); color: #7c3aed; }
        .activity-title { font-size:0.83rem; font-weight:600; color:var(--text-main); margin-bottom:1px; }
        .activity-meta  { font-size:0.73rem; color:var(--text-muted); }

        /* ── Empty state ── */
        .empty-state { padding:3.5rem 1rem; text-align:center; color:var(--text-muted); }
        .empty-state i { font-size:2.8rem; margin-bottom:0.75rem; opacity:0.35; }

        /* ── Modal — from Doc 8 radius/shadow ── */
        .modal-header  { border-bottom: 1px solid var(--gray-200); }
        .modal-footer  { border-top:    1px solid var(--gray-200); }
        .modal-content { border: none; border-radius: var(--radius); box-shadow: var(--shadow-lg); }

        /* ── Mobile ── */
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

        /* ── Scrollbars ── */
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
    $carposUser = auth()->user();
    $authFullName = $carposUser ? trim(($carposUser->first_name ?? '') . ' ' . ($carposUser->last_name ?? '')) : ($carposUser->name ?? 'CARPOS Admin');
    if ($carposUser && ! empty($carposUser->avatar)) {
        $avatarUrl = asset('storage/' . $carposUser->avatar);
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

        <span class="navbar-page-badge"><i class="bi bi-shield-check me-1"></i> Admin CARPOS</span>

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
                            <i class="bi bi-person-plus text-success me-2"></i> New ARBO registered
                            <div class="text-muted" style="font-size:.72rem; padding-left:1.4rem;">2 hours ago</div>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item py-2" href="#" style="font-size:.82rem;">
                            <i class="bi bi-cart-check text-primary me-2"></i> Order #2041 completed
                            <div class="text-muted" style="font-size:.72rem; padding-left:1.4rem;">5 hours ago</div>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item py-2" href="#" style="font-size:.82rem;">
                            <i class="bi bi-exclamation-triangle text-warning me-2"></i> Seller account pending review
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
                    <img class="user-avatar"
                        src="{{ $avatarUrl }}"
                        alt="User avatar">
                    <div class="d-none d-md-block" style="line-height:1.2;">
                        <div class="user-pill-name">{{ optional(auth()->user())->name ?? 'Admin CARPOS' }}</div>
                        <div class="user-pill-role">Admin DARPO</div>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="border-radius:12px; margin-top:8px; min-width:200px;">
                    <li class="px-3 py-2 border-bottom">
                        <div class="fw-bold" style="font-size:.83rem;">{{ optional(auth()->user())->name ?? 'Admin CARPOS' }}</div>
                        <div class="text-muted" style="font-size:.72rem;">{{ optional(auth()->user())->email ?? '' }}</div>
                    </li>
                    <li><a class="dropdown-item py-2" href="{{ url('/admin/profile') }}" style="font-size:.84rem;"><i class="bi bi-person me-2 text-muted"></i>Profile</a></li>
                    <li><a class="dropdown-item py-2" href="{{ url('/settings') }}" style="font-size:.84rem;"><i class="bi bi-gear me-2 text-muted"></i>Settings</a></li>
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

            <!-- Office chip -->
            <div class="sidebar-office-chip">
                <div class="office-label">Assigned Office</div>
                <div class="office-name">{{ auth()->user()->office ?? 'CARPOS-PBD Office' }}</div>
            </div>

            <!-- Main menu -->
            <span class="sidebar-section-label">Main Menu</span>

            <a href="{{ url('/admin/dashboard') }}" class="sidebar-link">
                <i class="bi bi-speedometer2"></i>
                Dashboard
            </a>

            <a href="{{ url('/admin/arbos') }}" class="sidebar-link active">
                <i class="bi bi-diagram-3"></i>
                ARBO Management
                <span class="sidebar-link-badge">{{ $totalArbos ?? '0' }}</span>
            </a>

            {{-- ── Added: ARBO Admins ── --}}
            <a href="{{ url('/admin/arbo-admins') }}" class="sidebar-link">
                <i class="bi bi-person-badge"></i>
                ARBO Admins
            </a>

            {{-- ── Added: Marketplace Monitoring ── --}}
            <a href="{{ url('/admin/marketplace') }}" class="sidebar-link">
                <i class="bi bi-shop"></i>
                Marketplace Monitoring
            </a>

            <span class="sidebar-section-label">Reports</span>

            <a href="{{ url('/admin/reports') }}" class="sidebar-link">
                <i class="bi bi-bar-chart-line"></i>
                Reports
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
    <!-- =====================================================================
         MAIN CONTENT
         ===================================================================== -->
    <main class="page-wrapper">

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <h1 class="page-header-title">ARBO Organization Management</h1>
                <p class="page-header-sub">Register and manage Agrarian Reform Beneficiary Organizations (ARBOs) across DAR Region V.</p>
            </div>
            <a href="{{ url('/admin/arbos/create') }}"
               class="btn d-flex align-items-center gap-2 fw-semibold"
               style="background:var(--green-600); color:#fff; border-radius:10px; white-space:nowrap; border:none;">
                <i class="bi bi-plus-circle-fill"></i>
                Register New ARBO
            </a>
        </div>

        {{-- Flash messages --}}
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
        <div class="row g-3 mb-4">

            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon-wrap stat-icon-green">
                        <i class="bi bi-diagram-3-fill"></i>
                    </div>
                    <div>
                        <div class="stat-value">{{ $totalArbos ?? 0 }}</div>
                        <p class="stat-label">Total ARBOs</p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon-wrap stat-icon-green">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div>
                        <div class="stat-value">{{ $activeArbos ?? 0 }}</div>
                        <p class="stat-label">Active ARBOs</p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon-wrap stat-icon-gold">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                    <div>
                        <div class="stat-value">{{ $pendingArbos ?? 0 }}</div>
                        <p class="stat-label">Pending Approval</p>
                    </div>
                </div>
            </div>

            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon-wrap stat-icon-red">
                        <i class="bi bi-slash-circle-fill"></i>
                    </div>
                    <div>
                        <div class="stat-value">{{ $inactiveArbos ?? 0 }}</div>
                        <p class="stat-label">Inactive ARBOs</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- ── Search & Filter Toolbar ── -->
        <div class="mb-4">
            <div class="filter-card">
                <form method="GET" action="{{ url('/admin/arbos') }}">
                    <div class="row g-3 align-items-end">

                        <div class="col-12 col-md-4">
                            <label class="form-label fw-semibold" style="font-size:.8rem; color:var(--text-muted);">
                                Search ARBO
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="bi bi-search" style="color:var(--text-muted);"></i>
                                </span>
                                <input type="text" name="search" class="form-control border-start-0 ps-0"
                                       placeholder="ARBO name or registration no..."
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
                                <option value="pending"  {{ request('status') === 'pending'  ? 'selected' : '' }}>Pending</option>
                                <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <div class="col-12 col-md-3 d-flex gap-2">
                            <button type="submit"
                                    class="btn fw-semibold flex-fill"
                                    style="background:var(--green-600); color:#fff; border-radius:8px; border:none;">
                                <i class="bi bi-search me-1"></i> Search
                            </button>
                            <a href="{{ url('/admin/arbos') }}"
                               class="btn btn-outline-secondary fw-semibold flex-fill"
                               style="border-radius:8px;">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                            </a>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        <!-- ── ARBO Table + Activity Feed ── -->
        <div class="row g-4">

            <!-- Table -->
            <div class="col-lg-8">
                <div class="section-title">
                    <div class="section-title-bar"></div>
                    Registered ARBOs
                </div>
                <div class="table-card">
                    <div class="table-card-header">
                        <h6 class="table-card-title">
                            <i class="bi bi-diagram-3"></i>
                            Registered ARBOs
                            @if(isset($arbos))
                                <span class="badge ms-1"
                                      style="background:var(--green-100); color:var(--green-700); font-size:.68rem; border-radius:20px; padding:3px 8px;">
                                    {{ $arbos->total() ?? count($arbos) }} records
                                </span>
                            @endif
                        </h6>
                        <div class="d-flex align-items-center gap-2">
                            <select class="form-select form-select-sm w-auto" style="border-radius:8px; font-size:.78rem;">
                                <option>10 per page</option>
                                <option>25 per page</option>
                                <option>50 per page</option>
                            </select>
                            <a href="{{ url('/admin/arbos/export') }}"
                               class="btn btn-sm d-flex align-items-center gap-1"
                               style="font-size:.76rem; border-radius:8px; background:var(--green-100); color:var(--green-700); border:none; font-weight:600;">
                                <i class="bi bi-download"></i> Export
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="arbo-table">
                            <thead>
                                <tr>
                                    <th>ARBO ID</th>
                                    <th>ARBO Name</th>
                                    <th>Province</th>
                                    <th>Municipality</th>
                                    <th>Barangay</th>
                                    <th>Reg. No.</th>
                                    <th>Contact Person</th>
                                    <th>Status</th>
                                    <th>Date Registered</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                {{-- Dynamic rows --}}
                                @isset($arbos)
                                    @forelse($arbos as $arbo)
                                        <tr>
                                            <td class="cell-id">{{ $arbo->arbo_id ?? 'ARBO-' . str_pad($arbo->id, 4, '0', STR_PAD_LEFT) }}</td>
                                            <td class="cell-primary">
                                                {{ $arbo->name }}
                                                <small>{{ $arbo->type ?? 'Cooperative' }}</small>
                                            </td>
                                            <td>{{ $arbo->province }}</td>
                                            <td>{{ $arbo->municipality }}</td>
                                            <td>{{ $arbo->barangay }}</td>
                                            <td style="font-size:.78rem; font-weight:500;">{{ $arbo->registration_number ?? '—' }}</td>
                                            <td>{{ $arbo->contact_person ?? '—' }}</td>
                                            <td>
                                                @if($arbo->status === 'active')
                                                    <span class="status-badge status-active"><span class="status-dot"></span> Active</span>
                                                @elseif($arbo->status === 'pending')
                                                    <span class="status-badge status-pending"><span class="status-dot"></span> Pending</span>
                                                @else
                                                    <span class="status-badge status-inactive"><span class="status-dot"></span> Inactive</span>
                                                @endif
                                            </td>
                                            <td style="font-size:.78rem; color:var(--text-muted);">{{ \Carbon\Carbon::parse($arbo->created_at)->format('M d, Y') }}</td>
                                            <td>
                                                <div class="d-flex gap-1 flex-wrap">
                                                    <a href="{{ url('/admin/arbos/'.$arbo->id) }}" class="action-btn btn-view">
                                                        <i class="bi bi-eye-fill"></i> View
                                                    </a>
                                                    <a href="{{ url('/admin/arbos/'.$arbo->id.'/edit') }}" class="action-btn btn-edit">
                                                        <i class="bi bi-pencil-fill"></i> Edit
                                                    </a>
                                                    @if($arbo->status === 'pending')
                                                        <form method="POST" action="{{ url('/admin/arbos/'.$arbo->id.'/approve') }}" class="d-inline">
                                                            @csrf @method('PATCH')
                                                            <button type="submit" class="action-btn btn-approve">
                                                                <i class="bi bi-check-circle-fill"></i> Approve
                                                            </button>
                                                        </form>
                                                    @endif
                                                    @if($arbo->status === 'active')
                                                        <button type="button" class="action-btn btn-deactivate"
                                                                data-bs-toggle="modal" data-bs-target="#deactivateModal"
                                                                data-id="{{ $arbo->id }}" data-name="{{ $arbo->name }}">
                                                            <i class="bi bi-slash-circle-fill"></i> Deactivate
                                                        </button>
                                                    @endif
                                                    <button type="button" class="action-btn btn-assign"
                                                            data-bs-toggle="modal" data-bs-target="#assignAdminModal"
                                                            data-id="{{ $arbo->id }}" data-name="{{ $arbo->name }}">
                                                        <i class="bi bi-person-badge-fill"></i> Assign Admin
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10">
                                                <div class="empty-state">
                                                    <i class="bi bi-diagram-3 d-block"></i>
                                                    <p class="fw-semibold mb-1">No ARBOs found</p>
                                                    <p class="small">Try adjusting your filters or register a new ARBO.</p>
                                                    <a href="{{ url('/admin/arbos/create') }}"
                                                       class="btn btn-sm mt-1"
                                                       style="background:var(--green-600); color:#fff; border-radius:8px; border:none;">
                                                        <i class="bi bi-plus-circle-fill me-1"></i> Register New ARBO
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                @else

                                {{-- Static sample rows --}}
                                <tr>
                                    <td class="cell-id">ARBO-0001</td>
                                    <td class="cell-primary">Mabuhay Farmers Cooperative<small>Multi-Purpose Cooperative</small></td>
                                    <td>Camarines Sur</td><td>Naga City</td><td>Triangulo</td>
                                    <td style="font-size:.78rem;font-weight:500;">CDA-2024-0001</td>
                                    <td>Juan dela Cruz</td>
                                    <td><span class="status-badge status-active"><span class="status-dot"></span> Active</span></td>
                                    <td style="font-size:.78rem;color:var(--text-muted);">Jan 15, 2024</td>
                                    <td>
                                        <div class="d-flex gap-1 flex-wrap">
                                            <a href="#" class="action-btn btn-view"><i class="bi bi-eye-fill"></i> View</a>
                                            <a href="#" class="action-btn btn-edit"><i class="bi bi-pencil-fill"></i> Edit</a>
                                            <button class="action-btn btn-deactivate" data-bs-toggle="modal" data-bs-target="#deactivateModal" data-id="1" data-name="Mabuhay Farmers Cooperative"><i class="bi bi-slash-circle-fill"></i> Deactivate</button>
                                            <button class="action-btn btn-assign" data-bs-toggle="modal" data-bs-target="#assignAdminModal" data-id="1" data-name="Mabuhay Farmers Cooperative"><i class="bi bi-person-badge-fill"></i> Assign Admin</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cell-id">ARBO-0002</td>
                                    <td class="cell-primary">Bagong Pag-asa ARB Association<small>Farmers Association</small></td>
                                    <td>Albay</td><td>Legazpi City</td><td>Banquerohan</td>
                                    <td style="font-size:.78rem;font-weight:500;">CDA-2024-0002</td>
                                    <td>Maria Santos</td>
                                    <td><span class="status-badge status-active"><span class="status-dot"></span> Active</span></td>
                                    <td style="font-size:.78rem;color:var(--text-muted);">Feb 03, 2024</td>
                                    <td>
                                        <div class="d-flex gap-1 flex-wrap">
                                            <a href="#" class="action-btn btn-view"><i class="bi bi-eye-fill"></i> View</a>
                                            <a href="#" class="action-btn btn-edit"><i class="bi bi-pencil-fill"></i> Edit</a>
                                            <button class="action-btn btn-deactivate" data-bs-toggle="modal" data-bs-target="#deactivateModal" data-id="2" data-name="Bagong Pag-asa ARB Association"><i class="bi bi-slash-circle-fill"></i> Deactivate</button>
                                            <button class="action-btn btn-assign" data-bs-toggle="modal" data-bs-target="#assignAdminModal" data-id="2" data-name="Bagong Pag-asa ARB Association"><i class="bi bi-person-badge-fill"></i> Assign Admin</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cell-id">ARBO-0003</td>
                                    <td class="cell-primary">Pagkakaisa Farmers Association<small>Farmers Association</small></td>
                                    <td>Sorsogon</td><td>Sorsogon City</td><td>Balogo</td>
                                    <td style="font-size:.78rem;font-weight:500;">CDA-2024-0003</td>
                                    <td>Pedro Reyes</td>
                                    <td><span class="status-badge status-pending"><span class="status-dot"></span> Pending</span></td>
                                    <td style="font-size:.78rem;color:var(--text-muted);">Mar 10, 2024</td>
                                    <td>
                                        <div class="d-flex gap-1 flex-wrap">
                                            <a href="#" class="action-btn btn-view"><i class="bi bi-eye-fill"></i> View</a>
                                            <a href="#" class="action-btn btn-edit"><i class="bi bi-pencil-fill"></i> Edit</a>
                                            <button class="action-btn btn-approve"><i class="bi bi-check-circle-fill"></i> Approve</button>
                                            <button class="action-btn btn-assign" data-bs-toggle="modal" data-bs-target="#assignAdminModal" data-id="3" data-name="Pagkakaisa Farmers Association"><i class="bi bi-person-badge-fill"></i> Assign Admin</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cell-id">ARBO-0004</td>
                                    <td class="cell-primary">Catanduanes ARB Cooperative<small>Multi-Purpose Cooperative</small></td>
                                    <td>Catanduanes</td><td>Virac</td><td>Concepcion</td>
                                    <td style="font-size:.78rem;font-weight:500;">CDA-2024-0004</td>
                                    <td>Rosa Bautista</td>
                                    <td><span class="status-badge status-active"><span class="status-dot"></span> Active</span></td>
                                    <td style="font-size:.78rem;color:var(--text-muted);">Apr 22, 2024</td>
                                    <td>
                                        <div class="d-flex gap-1 flex-wrap">
                                            <a href="#" class="action-btn btn-view"><i class="bi bi-eye-fill"></i> View</a>
                                            <a href="#" class="action-btn btn-edit"><i class="bi bi-pencil-fill"></i> Edit</a>
                                            <button class="action-btn btn-deactivate" data-bs-toggle="modal" data-bs-target="#deactivateModal" data-id="4" data-name="Catanduanes ARB Cooperative"><i class="bi bi-slash-circle-fill"></i> Deactivate</button>
                                            <button class="action-btn btn-assign" data-bs-toggle="modal" data-bs-target="#assignAdminModal" data-id="4" data-name="Catanduanes ARB Cooperative"><i class="bi bi-person-badge-fill"></i> Assign Admin</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cell-id">ARBO-0005</td>
                                    <td class="cell-primary">Masbate Agrarian Reform Cooperative<small>Agrarian Reform Cooperative</small></td>
                                    <td>Masbate</td><td>Masbate City</td><td>Nursery</td>
                                    <td style="font-size:.78rem;font-weight:500;">CDA-2024-0005</td>
                                    <td>Carlos Mendoza</td>
                                    <td><span class="status-badge status-inactive"><span class="status-dot"></span> Inactive</span></td>
                                    <td style="font-size:.78rem;color:var(--text-muted);">May 08, 2024</td>
                                    <td>
                                        <div class="d-flex gap-1 flex-wrap">
                                            <a href="#" class="action-btn btn-view"><i class="bi bi-eye-fill"></i> View</a>
                                            <a href="#" class="action-btn btn-edit"><i class="bi bi-pencil-fill"></i> Edit</a>
                                            <button class="action-btn btn-assign" data-bs-toggle="modal" data-bs-target="#assignAdminModal" data-id="5" data-name="Masbate Agrarian Reform Cooperative"><i class="bi bi-person-badge-fill"></i> Assign Admin</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cell-id">ARBO-0006</td>
                                    <td class="cell-primary">CamNorte Farmers Coop<small>Multi-Purpose Cooperative</small></td>
                                    <td>Camarines Norte</td><td>Daet</td><td>Lag-on</td>
                                    <td style="font-size:.78rem;font-weight:500;">CDA-2024-0006</td>
                                    <td>Linda Pascual</td>
                                    <td><span class="status-badge status-pending"><span class="status-dot"></span> Pending</span></td>
                                    <td style="font-size:.78rem;color:var(--text-muted);">Jun 14, 2024</td>
                                    <td>
                                        <div class="d-flex gap-1 flex-wrap">
                                            <a href="#" class="action-btn btn-view"><i class="bi bi-eye-fill"></i> View</a>
                                            <a href="#" class="action-btn btn-edit"><i class="bi bi-pencil-fill"></i> Edit</a>
                                            <button class="action-btn btn-approve"><i class="bi bi-check-circle-fill"></i> Approve</button>
                                            <button class="action-btn btn-assign" data-bs-toggle="modal" data-bs-target="#assignAdminModal" data-id="6" data-name="CamNorte Farmers Coop"><i class="bi bi-person-badge-fill"></i> Assign Admin</button>
                                        </div>
                                    </td>
                                </tr>

                                @endisset

                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    @isset($arbos)
                        @if(method_exists($arbos, 'links'))
                            <div class="px-4 py-3 border-top d-flex align-items-center justify-content-between flex-wrap gap-2"
                                 style="border-color:var(--gray-200) !important;">
                                <div class="text-muted" style="font-size:.78rem;">
                                    Showing {{ $arbos->firstItem() }}–{{ $arbos->lastItem() }} of {{ $arbos->total() }} ARBOs
                                </div>
                                {{ $arbos->withQueryString()->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                    @else
                        <div class="px-4 py-3 border-top d-flex align-items-center justify-content-between flex-wrap gap-2"
                             style="border-color:var(--gray-200) !important;">
                            <div class="text-muted" style="font-size:.78rem;">Showing 1–6 of 6 ARBOs</div>
                            <nav>
                                <ul class="pagination pagination-sm mb-0">
                                    <li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                </ul>
                            </nav>
                        </div>
                    @endisset

                </div>
            </div>

            <!-- Recent Activity Feed -->
            <div class="col-lg-4">
                <div class="section-title">
                    <div class="section-title-bar"></div>
                    Recent ARBO Activity
                </div>
                <div class="table-card h-100">
                    <div class="table-card-header">
                        <h6 class="table-card-title">
                            <i class="bi bi-clock-history"></i>
                            Recent Activity
                        </h6>
                        <a href="{{ url('/admin/logs') }}"
                           style="font-size:.76rem; color:var(--green-700); text-decoration:none; font-weight:600;">
                            View All <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                    <ul class="activity-log">
                        <li class="activity-item">
                            <div class="activity-dot-wrap">
                                <div class="activity-dot ad-blue"><i class="bi bi-plus-circle-fill"></i></div>
                            </div>
                            <div>
                                <div class="activity-title">ARBO registered</div>
                                <div class="activity-meta">CamNorte Farmers Coop submitted for approval · Just now</div>
                            </div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-dot-wrap">
                                <div class="activity-dot ad-green"><i class="bi bi-check-circle-fill"></i></div>
                            </div>
                            <div>
                                <div class="activity-title">ARBO approved</div>
                                <div class="activity-meta">Catanduanes ARB Cooperative approved · 1 hr ago</div>
                            </div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-dot-wrap">
                                <div class="activity-dot ad-purple"><i class="bi bi-person-badge-fill"></i></div>
                            </div>
                            <div>
                                <div class="activity-title">ARBO admin assigned</div>
                                <div class="activity-meta">Rosa Bautista assigned to Catanduanes ARB Coop · 2 hrs ago</div>
                            </div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-dot-wrap">
                                <div class="activity-dot ad-red"><i class="bi bi-slash-circle-fill"></i></div>
                            </div>
                            <div>
                                <div class="activity-title">ARBO deactivated</div>
                                <div class="activity-meta">Masbate Agrarian Reform Coop set to inactive · 4 hrs ago</div>
                            </div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-dot-wrap">
                                <div class="activity-dot ad-green"><i class="bi bi-check-circle-fill"></i></div>
                            </div>
                            <div>
                                <div class="activity-title">ARBO approved</div>
                                <div class="activity-meta">Bagong Pag-asa ARB Association approved · 6 hrs ago</div>
                            </div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-dot-wrap">
                                <div class="activity-dot ad-gold"><i class="bi bi-pencil-fill"></i></div>
                            </div>
                            <div>
                                <div class="activity-title">ARBO profile updated</div>
                                <div class="activity-meta">Mabuhay Farmers Coop contact updated · Yesterday</div>
                            </div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-dot-wrap">
                                <div class="activity-dot ad-blue"><i class="bi bi-plus-circle-fill"></i></div>
                            </div>
                            <div>
                                <div class="activity-title">ARBO registered</div>
                                <div class="activity-meta">Pagkakaisa Farmers Association submitted · Yesterday</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </div>{{-- /row --}}

    </main>

    <!-- =====================================================================
         MODAL — Deactivate Confirmation
         ===================================================================== -->
    <div class="modal fade" id="deactivateModal" tabindex="-1" aria-labelledby="deactivateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="deactivateModalLabel">
                        <i class="bi bi-slash-circle-fill text-danger me-2"></i>Deactivate ARBO
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2">Are you sure you want to deactivate:</p>
                    <p class="fw-semibold mb-3" id="deactivateArboName" style="color:var(--text-main);"></p>
                    <div class="alert alert-warning d-flex align-items-start gap-2 mb-0" style="border-radius:10px;">
                        <i class="bi bi-exclamation-triangle-fill mt-1 flex-shrink-0"></i>
                        <div style="font-size:.84rem;">
                            Deactivating this ARBO will suspend its marketplace access and all associated
                            seller/buyer accounts. This action can be reversed by reactivating the ARBO.
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius:8px;">
                        Cancel
                    </button>
                    <form id="deactivateForm" method="POST" action="">
                        @csrf @method('PATCH')
                        <button type="submit" class="btn btn-danger fw-semibold" style="border-radius:8px;">
                            <i class="bi bi-slash-circle-fill me-1"></i> Deactivate ARBO
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- =====================================================================
         MODAL — Assign ARBO Admin
         ===================================================================== -->
    <div class="modal fade" id="assignAdminModal" tabindex="-1" aria-labelledby="assignAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="assignAdminModalLabel">
                        <i class="bi bi-person-badge-fill me-2" style="color:#7c3aed;"></i>Assign ARBO Admin
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" id="assignAdminForm" action="">
                    @csrf @method('PATCH')
                    <div class="modal-body">
                        <p class="mb-3 text-muted" style="font-size:.88rem;">
                            Assigning an admin to:
                            <span class="fw-semibold" id="assignArboName" style="color:var(--text-main);"></span>
                        </p>
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="font-size:.84rem;">Select Admin Account</label>
                            <select name="admin_id" class="form-select" required style="border-radius:8px;">
                                <option value="">— Choose an admin user —</option>
                                @isset($availableAdmins)
                                    @foreach($availableAdmins as $admin)
                                        <option value="{{ $admin->id }}">{{ $admin->name }} ({{ $admin->email }})</option>
                                    @endforeach
                                @else
                                    <option value="1">Juan dela Cruz (jdelacruz@dar.gov.ph)</option>
                                    <option value="2">Maria Santos (msantos@dar.gov.ph)</option>
                                    <option value="3">Pedro Reyes (preyes@dar.gov.ph)</option>
                                @endisset
                            </select>
                            <div class="form-text">Only unassigned ARBO admin accounts are shown.</div>
                        </div>
                        <div class="mb-0">
                            <label class="form-label fw-semibold" style="font-size:.84rem;">
                                Notes <span class="text-muted fw-normal">(optional)</span>
                            </label>
                            <textarea name="notes" class="form-control" rows="2"
                                      placeholder="Reason for assignment or remarks..."
                                      style="border-radius:8px; resize:none;"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius:8px;">
                            Cancel
                        </button>
                        <button type="submit" class="btn fw-semibold" style="background:var(--green-600); color:#fff; border-radius:8px; border:none;">
                            <i class="bi bi-person-check-fill me-1"></i> Assign Admin
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {

        // Current date
        const dateEl = document.getElementById('currentDate');
        if (dateEl) {
            dateEl.textContent = new Date().toLocaleDateString('en-PH', {
                weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
            });
        }

        // Mobile sidebar toggle
        const toggle  = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('mainSidebar');
        const overlay = document.getElementById('sidebarOverlay');

        function openSidebar()  { sidebar.classList.add('show');    overlay.classList.add('show');    document.body.style.overflow = 'hidden'; }
        function closeSidebar() { sidebar.classList.remove('show'); overlay.classList.remove('show'); document.body.style.overflow = ''; }

        if (toggle)  toggle.addEventListener('click', openSidebar);
        if (overlay) overlay.addEventListener('click', closeSidebar);

        // Deactivate modal
        const deactivateModal = document.getElementById('deactivateModal');
        if (deactivateModal) {
            deactivateModal.addEventListener('show.bs.modal', function (e) {
                const btn = e.relatedTarget;
                document.getElementById('deactivateArboName').textContent = btn.dataset.name;
                document.getElementById('deactivateForm').action = '/admin/arbos/' + btn.dataset.id + '/deactivate';
            });
        }

        // Assign admin modal
        const assignModal = document.getElementById('assignAdminModal');
        if (assignModal) {
            assignModal.addEventListener('show.bs.modal', function (e) {
                const btn = e.relatedTarget;
                document.getElementById('assignArboName').textContent = btn.dataset.name;
                document.getElementById('assignAdminForm').action = '/admin/arbos/' + btn.dataset.id + '/assign-admin';
            });
        }

    });
    </script>

</body>
</html>