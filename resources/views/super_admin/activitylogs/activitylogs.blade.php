<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Activity Logs — E-Agraryo Merkado</title>
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
            display: flex; align-items: center; gap: 0.65rem;
            text-decoration: none; flex-shrink: 0;
        }
        .navbar-brand-area img { height: 38px; filter: brightness(1.15); }
        .navbar-system-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.18rem; color: #fff;
            letter-spacing: 0.01em; line-height: 1.15;
        }
        .navbar-system-sub {
            font-size: 0.68rem; color: var(--green-200);
            letter-spacing: 0.06em; text-transform: uppercase; font-weight: 500;
        }
        .navbar-page-badge {
            background: rgba(200,146,42,0.18);
            border: 1px solid rgba(200,146,42,0.35);
            color: var(--gold-mid);
            font-size: 0.72rem; font-weight: 600;
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
            position: absolute; top: 5px; right: 6px;
            width: 8px; height: 8px; background: var(--gold);
            border-radius: 50%; border: 2px solid var(--green-900);
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
            box-shadow: var(--shadow-sm);
            transition: transform 0.28s cubic-bezier(.4,0,.2,1);
        }
        .sidebar-inner { padding: 1.5rem 1rem; flex: 1; display: flex; flex-direction: column; }
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
        .sidebar-link.active { background: var(--green-100); color: var(--green-700); font-weight: 600; }
        .sidebar-link.active::before {
            content: ''; position: absolute; left: -3px; top: 20%; bottom: 20%;
            width: 4px; background: var(--green-600); border-radius: 4px;
        }
        .sidebar-link-badge {
            margin-left: auto; font-size: 0.65rem; font-weight: 700;
            background: var(--green-100); color: var(--green-700);
            padding: 2px 7px; border-radius: 20px;
        }
        .sidebar-link.active .sidebar-link-badge { background: var(--green-600); color: #fff; }
        .sidebar-logout { margin-top: auto; padding-top: 1rem; border-top: 1px solid var(--gray-200); }
        .sidebar-logout .sidebar-link { color: #c0392b; }
        .sidebar-logout .sidebar-link:hover { background: #fdf2f2; color: #c0392b; }
        .sidebar-office-chip {
            background: var(--green-50); border: 1px solid var(--green-200);
            border-radius: var(--radius-sm); padding: 0.65rem 0.85rem; margin-bottom: 1rem;
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
            min-height: calc(100vh - 62px); padding: 2rem 2rem 3rem;
        }
        .page-header {
            display: flex; align-items: flex-start; justify-content: space-between;
            margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;
        }
        .page-header-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.6rem; color: var(--green-900); margin: 0 0 2px; line-height: 1.2;
        }
        .page-header-sub { font-size: 0.85rem; color: var(--text-muted); margin: 0; }
        .page-header-actions { display: flex; gap: 0.6rem; flex-wrap: wrap; align-items: flex-start; }

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
        .si-green { background: var(--green-100); color: var(--green-700); }
        .si-gold  { background: var(--gold-light); color: var(--gold); }
        .si-blue  { background: #e8f0fe; color: #1a73e8; }
        .si-teal  { background: #e0f7f5; color: #0d8a7e; }
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
            box-shadow: var(--shadow-sm); border: 1px solid var(--gray-200); padding: 1.25rem 1.5rem;
        }

        /* ─── Table card ── */
        .table-card {
            background: #fff; border-radius: var(--radius);
            box-shadow: var(--shadow-sm); border: 1px solid var(--gray-200); overflow: hidden;
        }
        .table-card-header {
            padding: 1.1rem 1.5rem 0.9rem; border-bottom: 1px solid var(--gray-200);
            display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.5rem;
        }
        .table-card-title {
            font-size: 0.9rem; font-weight: 700; color: var(--text-main);
            margin: 0; display: flex; align-items: center; gap: 0.45rem;
        }
        .table-card-title i { color: var(--green-600); }

        /* ─── Logs table ── */
        .logs-table { width: 100%; border-collapse: collapse; font-size: 0.83rem; }
        .logs-table thead th {
            background: var(--green-50); color: var(--green-800);
            font-weight: 700; font-size: 0.70rem; letter-spacing: 0.05em;
            text-transform: uppercase; padding: 0.75rem 0.9rem;
            border-bottom: 1px solid var(--green-200); white-space: nowrap;
        }
        .logs-table tbody tr { border-bottom: 1px solid var(--gray-100); transition: background 0.14s; }
        .logs-table tbody tr:last-child { border-bottom: none; }
        .logs-table tbody tr:hover { background: var(--gray-50); }
        .logs-table td { padding: 0.75rem 0.9rem; vertical-align: middle; color: var(--text-main); }
        .cell-id   { font-size: 0.7rem; font-weight: 700; color: var(--text-muted); font-family: monospace; white-space: nowrap; }
        .cell-user { font-weight: 600; color: var(--text-main); }
        .cell-user small { display: block; font-weight: 400; font-size: 0.71rem; color: var(--text-muted); margin-top: 1px; }
        .cell-desc { font-size: 0.80rem; color: var(--text-muted); max-width: 260px; }
        .cell-time { font-size: 0.76rem; color: var(--text-muted); white-space: nowrap; }

        /* ─── Module badges ── */
        .module-badge {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 3px 9px; border-radius: 20px;
            font-size: 0.70rem; font-weight: 700; white-space: nowrap;
        }
        .mod-user        { background: var(--green-100);          color: var(--green-700); }
        .mod-admin       { background: var(--gold-light);         color: var(--gold); }
        .mod-marketplace { background: #e8f0fe;                   color: #1a73e8; }
        .mod-arbo        { background: #e0f7f5;                   color: #0d8a7e; }
        .mod-system      { background: rgba(139,92,246,0.10);     color: #7c3aed; }
        .mod-auth        { background: rgba(239,68,68,0.10);      color: #dc2626; }

        /* ─── Role pill ── */
        .role-pill {
            display: inline-flex; align-items: center;
            padding: 2px 8px; border-radius: 20px;
            font-size: 0.70rem; font-weight: 600; white-space: nowrap;
            background: var(--gray-100); color: var(--gray-600);
        }
        .role-superadmin { background: var(--green-100);          color: var(--green-700); }
        .role-carpos     { background: var(--gold-light);         color: var(--gold); }
        .role-arbo-admin { background: #e8f0fe;                   color: #1a73e8; }
        .role-seller     { background: #e0f7f5;                   color: #0d8a7e; }
        .role-buyer      { background: rgba(139,92,246,0.10);     color: #7c3aed; }

        /* ─── Action type ── */
        .action-type { display: inline-flex; align-items: center; gap: 4px; font-size: 0.72rem; font-weight: 600; white-space: nowrap; }
        .act-create     { color: var(--green-700); }
        .act-update     { color: var(--gold); }
        .act-delete     { color: #dc2626; }
        .act-login      { color: #1a73e8; }
        .act-logout     { color: var(--gray-600); }
        .act-approve    { color: var(--green-700); }
        .act-deactivate { color: #dc2626; }
        .act-assign     { color: #7c3aed; }
        .act-view       { color: #0d8a7e; }

        /* ─── Pagination ── */
        .pagination .page-link {
            border-radius: 8px !important; margin: 0 2px;
            font-size: 0.82rem; font-weight: 500;
            color: var(--gray-600); border: 1px solid var(--gray-200);
        }
        .pagination .page-item.active .page-link { background: var(--green-600); border-color: var(--green-600); color: #fff; }
        .pagination .page-link:hover { background: var(--green-100); color: var(--green-700); }

        /* ─── Critical panel ── */
        .critical-panel {
            background: #fff; border-radius: var(--radius);
            box-shadow: var(--shadow-sm); border: 1px solid var(--gray-200); overflow: hidden; height: 100%;
        }
        .critical-panel-header {
            padding: 1rem 1.25rem 0.85rem; border-bottom: 1px solid var(--gray-200);
            display: flex; align-items: center; justify-content: space-between;
        }
        .critical-panel-title {
            font-size: 0.88rem; font-weight: 700; color: var(--text-main);
            display: flex; align-items: center; gap: 0.4rem; margin: 0;
        }
        .critical-item {
            display: flex; align-items: flex-start; gap: 0.75rem;
            padding: 0.85rem 1.25rem; border-bottom: 1px solid var(--gray-100);
            transition: background 0.14s;
        }
        .critical-item:last-child { border-bottom: none; }
        .critical-item:hover { background: var(--gray-50); }
        .critical-dot {
            width: 32px; height: 32px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.85rem; flex-shrink: 0; margin-top: 1px;
        }
        .cd-red    { background: rgba(239,68,68,0.10); color: #dc2626; }
        .cd-gold   { background: var(--gold-light);    color: var(--gold); }
        .cd-green  { background: var(--green-100);     color: var(--green-700); }
        .cd-purple { background: rgba(139,92,246,0.10); color: #7c3aed; }
        .critical-item-title { font-size: 0.82rem; font-weight: 600; color: var(--text-main); margin-bottom: 1px; }
        .critical-item-meta  { font-size: 0.72rem; color: var(--text-muted); }

        /* ─── Summary cards ── */
        .summary-card {
            background: #fff; border-radius: var(--radius);
            box-shadow: var(--shadow-sm); border: 1px solid var(--gray-200);
            padding: 1rem 1.2rem; height: 100%;
        }
        .summary-card-label { font-size: 0.72rem; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase; color: var(--text-muted); margin-bottom: 0.5rem; }
        .summary-bar-row    { display: flex; align-items: center; gap: 0.6rem; margin-bottom: 0.45rem; }
        .summary-bar-label  { font-size: 0.75rem; font-weight: 500; color: var(--text-main); width: 110px; flex-shrink: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .summary-bar-track  { flex: 1; height: 6px; border-radius: 3px; background: var(--gray-200); overflow: hidden; }
        .summary-bar-fill   { height: 100%; border-radius: 3px; }
        .summary-bar-count  { font-size: 0.72rem; font-weight: 700; color: var(--text-main); min-width: 28px; text-align: right; }

        /* ─── Empty state ── */
        .empty-state { padding: 3.5rem 1rem; text-align: center; color: var(--text-muted); }
        .empty-state i { font-size: 2.8rem; margin-bottom: 0.75rem; opacity: 0.35; }

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

        @media print {
            .top-navbar, .sidebar, .sidebar-overlay, .page-header-actions,
            .filter-card, .pagination { display: none !important; }
            .page-wrapper { margin: 0; padding: 1rem; }
        }
    </style>
</head>
<body>

    <!-- ── Top Navbar ──────────────────────────────────────── -->
    <header class="top-navbar">
        <button class="mobile-sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
            <i class="bi bi-list"></i>
        </button>

        <a class="navbar-brand-area" href="{{ url('/dashboard') }}">
            <img src="{{ asset('images/dar-logo.png') }}" alt="DAR Logo">
            <div>
                <div class="navbar-system-title">E-Agraryo Merkado</div>
                <div class="navbar-system-sub">DAR Region V</div>
            </div>
        </a>

        <span class="navbar-page-badge"><i class="bi bi-shield-fill-check me-1"></i> Super Admin</span>

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
                            <i class="bi bi-exclamation-triangle text-warning me-2"></i> Suspicious login detected
                            <div class="text-muted" style="font-size:.72rem; padding-left:1.4rem;">Just now</div>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item py-2" href="#" style="font-size:.82rem;">
                            <i class="bi bi-person-x text-danger me-2"></i> Account deactivated
                            <div class="text-muted" style="font-size:.72rem; padding-left:1.4rem;">1 hour ago</div>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item py-2" href="#" style="font-size:.82rem;">
                            <i class="bi bi-building text-success me-2"></i> New PBD office added
                            <div class="text-muted" style="font-size:.72rem; padding-left:1.4rem;">3 hours ago</div>
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
                        src="{{ auth()->user()->avatar ?: 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name ?? 'Super Admin') . '&background=1a6932&color=fff&rounded=true&size=64' }}"
                        alt="User avatar">
                    <div class="d-none d-md-block" style="line-height:1.2;">
                        <div class="user-pill-name">{{ auth()->user()->name ?? 'Super Admin' }}</div>
                        <div class="user-pill-role">Super Admin</div>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="border-radius:12px; margin-top:8px; min-width:200px;">
                    <li class="px-3 py-2 border-bottom">
                        <div class="fw-bold" style="font-size:.83rem;">{{ auth()->user()->name ?? 'Super Admin' }}</div>
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

            <a href="{{ url('/roles') }}" class="sidebar-link">
                <i class="bi bi-person-badge"></i>
                User Roles
            </a>

            <a href="{{ url('/branches') }}" class="sidebar-link">
                <i class="bi bi-building"></i>
                PBD Management
                <span class="sidebar-link-badge">{{ $totalBranches ?? '8' }}</span>
            </a>

            <a href="{{ url('/logs') }}" class="sidebar-link active">
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
                <h1 class="page-header-title">Activity Logs</h1>
                <p class="page-header-sub">Monitor system-wide actions, user activity, and administrative events across E-Agraryo Merkado.</p>
            </div>
            <div class="page-header-actions">
                <button type="button" onclick="window.print()"
                        class="btn fw-semibold d-flex align-items-center gap-2"
                        style="background:var(--gray-100); color:var(--text-main); border:1px solid var(--gray-200); border-radius:10px;">
                    <i class="bi bi-printer-fill"></i> Print Logs
                </button>
                <a href="{{ url('/super-admin/activity-logs/export') }}"
                   class="btn fw-semibold d-flex align-items-center gap-2"
                   style="background:var(--gold-light); color:var(--gold); border:1px solid rgba(200,146,42,0.3); border-radius:10px;">
                    <i class="bi bi-download"></i> Export Logs
                </a>
            </div>
        </div>

        <!-- ── Summary Stat Cards ── -->
        <div class="mb-5">
            <div class="section-title">
                <div class="section-title-bar"></div>
                Today's Activity Summary
            </div>
            <div class="row g-3">
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon-wrap si-green"><i class="bi bi-journal-text"></i></div>
                        <div>
                            <div class="stat-value">{{ $totalLogsToday ?? 0 }}</div>
                            <p class="stat-label">Total Logs Today</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon-wrap si-teal"><i class="bi bi-people-fill"></i></div>
                        <div>
                            <div class="stat-value">{{ $userActions ?? 0 }}</div>
                            <p class="stat-label">User Actions</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon-wrap si-gold"><i class="bi bi-person-badge-fill"></i></div>
                        <div>
                            <div class="stat-value">{{ $adminActions ?? 0 }}</div>
                            <p class="stat-label">Admin Actions</p>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-card">
                        <div class="stat-icon-wrap si-blue"><i class="bi bi-shop-window"></i></div>
                        <div>
                            <div class="stat-value">{{ $marketplaceActions ?? 0 }}</div>
                            <p class="stat-label">Marketplace Actions</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ── Filter / Search Toolbar ── -->
        <div class="mb-4">
            <div class="filter-card">
                <form method="GET" action="{{ url('/super-admin/activity-logs') }}">
                    <div class="row g-3 align-items-end">
                        <div class="col-12 col-md-3">
                            <label class="form-label fw-semibold" style="font-size:.8rem; color:var(--text-muted);">Search Logs</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="bi bi-search" style="color:var(--text-muted);"></i>
                                </span>
                                <input type="text" name="search"
                                       class="form-control border-start-0 ps-0"
                                       placeholder="User, action, or description..."
                                       value="{{ request('search') }}"
                                       style="border-radius:0 8px 8px 0;">
                            </div>
                        </div>
                        <div class="col-6 col-md-2">
                            <label class="form-label fw-semibold" style="font-size:.8rem; color:var(--text-muted);">Module</label>
                            <select name="module" class="form-select" style="border-radius:8px;">
                                <option value="">All Modules</option>
                                <option value="user"        {{ request('module') === 'user'        ? 'selected' : '' }}>User Management</option>
                                <option value="admin"       {{ request('module') === 'admin'       ? 'selected' : '' }}>Admin Actions</option>
                                <option value="marketplace" {{ request('module') === 'marketplace' ? 'selected' : '' }}>Marketplace</option>
                                <option value="arbo"        {{ request('module') === 'arbo'        ? 'selected' : '' }}>ARBO</option>
                                <option value="auth"        {{ request('module') === 'auth'        ? 'selected' : '' }}>Authentication</option>
                                <option value="system"      {{ request('module') === 'system'      ? 'selected' : '' }}>System</option>
                            </select>
                        </div>
                        <div class="col-6 col-md-2">
                            <label class="form-label fw-semibold" style="font-size:.8rem; color:var(--text-muted);">Role</label>
                            <select name="role" class="form-select" style="border-radius:8px;">
                                <option value="">All Roles</option>
                                <option value="super_admin"  {{ request('role') === 'super_admin'  ? 'selected' : '' }}>Super Admin</option>
                                <option value="admin_carpos" {{ request('role') === 'admin_carpos' ? 'selected' : '' }}>Admin CARPOS</option>
                                <option value="arbo_admin"   {{ request('role') === 'arbo_admin'   ? 'selected' : '' }}>ARBO Admin</option>
                                <option value="seller"       {{ request('role') === 'seller'       ? 'selected' : '' }}>Seller</option>
                                <option value="buyer"        {{ request('role') === 'buyer'        ? 'selected' : '' }}>Buyer</option>
                            </select>
                        </div>
                        <div class="col-6 col-md-2">
                            <label class="form-label fw-semibold" style="font-size:.8rem; color:var(--text-muted);">Date</label>
                            <input type="date" name="date" class="form-control" value="{{ request('date') }}" style="border-radius:8px;">
                        </div>
                        <div class="col-6 col-md-3 d-flex gap-2">
                            <button type="submit"
                                    class="btn fw-semibold flex-fill"
                                    style="background:var(--green-600); color:#fff; border-radius:8px; border:none;">
                                <i class="bi bi-search me-1"></i> Search
                            </button>
                            <a href="{{ url('/super-admin/activity-logs') }}"
                               class="btn btn-outline-secondary fw-semibold flex-fill"
                               style="border-radius:8px;">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- ── Logs Table + Side Panels ── -->
        <div class="row g-4">

            <!-- Logs Table -->
            <div class="col-12 col-xl-8">
                <div class="section-title">
                    <div class="section-title-bar"></div>
                    System Activity Logs
                </div>
                <div class="table-card">
                    <div class="table-card-header">
                        <h6 class="table-card-title">
                            <i class="bi bi-journal-text"></i>
                            All Logs
                            @if(isset($logs))
                                <span class="badge ms-1"
                                      style="background:var(--green-100); color:var(--green-700); font-size:.68rem; border-radius:20px; padding:3px 8px;">
                                    {{ $logs->total() ?? count($logs) }} records
                                </span>
                            @endif
                        </h6>
                        <div class="d-flex align-items-center gap-2">
                            <select class="form-select form-select-sm w-auto" style="border-radius:8px; font-size:.78rem;">
                                <option>25 per page</option>
                                <option>50 per page</option>
                                <option>100 per page</option>
                            </select>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="logs-table">
                            <thead>
                                <tr>
                                    <th>Log ID</th>
                                    <th>User</th>
                                    <th>Role</th>
                                    <th>Module</th>
                                    <th>Action</th>
                                    <th>Description</th>
                                    <th>Date / Time</th>
                                </tr>
                            </thead>
                            <tbody>

                                @isset($logs)
                                    @forelse($logs as $log)
                                        <tr>
                                            <td class="cell-id">LOG-{{ str_pad($log->id, 6, '0', STR_PAD_LEFT) }}</td>
                                            <td class="cell-user">
                                                {{ $log->user->name ?? 'System' }}
                                                <small>{{ $log->user->email ?? '—' }}</small>
                                            </td>
                                            <td>
                                                @php $r = $log->user->role ?? 'system'; @endphp
                                                @if($r === 'super_admin')
                                                    <span class="role-pill role-superadmin">Super Admin</span>
                                                @elseif($r === 'admin_carpos')
                                                    <span class="role-pill role-carpos">Admin CARPOS</span>
                                                @elseif($r === 'arbo_admin')
                                                    <span class="role-pill role-arbo-admin">ARBO Admin</span>
                                                @elseif($r === 'seller')
                                                    <span class="role-pill role-seller">Seller</span>
                                                @elseif($r === 'buyer')
                                                    <span class="role-pill role-buyer">Buyer</span>
                                                @else
                                                    <span class="role-pill">System</span>
                                                @endif
                                            </td>
                                            <td>
                                                @php $m = $log->module ?? 'system'; @endphp
                                                @if($m === 'user')
                                                    <span class="module-badge mod-user"><i class="bi bi-person"></i> User</span>
                                                @elseif($m === 'admin')
                                                    <span class="module-badge mod-admin"><i class="bi bi-person-badge"></i> Admin</span>
                                                @elseif($m === 'marketplace')
                                                    <span class="module-badge mod-marketplace"><i class="bi bi-shop"></i> Marketplace</span>
                                                @elseif($m === 'arbo')
                                                    <span class="module-badge mod-arbo"><i class="bi bi-diagram-3"></i> ARBO</span>
                                                @elseif($m === 'auth')
                                                    <span class="module-badge mod-auth"><i class="bi bi-lock"></i> Auth</span>
                                                @else
                                                    <span class="module-badge mod-system"><i class="bi bi-gear"></i> System</span>
                                                @endif
                                            </td>
                                            <td>
                                                @php $a = strtolower($log->action ?? 'view'); @endphp
                                                @if(str_contains($a, 'creat') || str_contains($a, 'add') || str_contains($a, 'register'))
                                                    <span class="action-type act-create"><i class="bi bi-plus-circle-fill"></i> {{ ucfirst($log->action) }}</span>
                                                @elseif(str_contains($a, 'update') || str_contains($a, 'edit'))
                                                    <span class="action-type act-update"><i class="bi bi-pencil-fill"></i> {{ ucfirst($log->action) }}</span>
                                                @elseif(str_contains($a, 'delete') || str_contains($a, 'deactivat') || str_contains($a, 'remov'))
                                                    <span class="action-type act-delete"><i class="bi bi-trash-fill"></i> {{ ucfirst($log->action) }}</span>
                                                @elseif(str_contains($a, 'login') || str_contains($a, 'sign in'))
                                                    <span class="action-type act-login"><i class="bi bi-box-arrow-in-right"></i> {{ ucfirst($log->action) }}</span>
                                                @elseif(str_contains($a, 'logout') || str_contains($a, 'sign out'))
                                                    <span class="action-type act-logout"><i class="bi bi-box-arrow-right"></i> {{ ucfirst($log->action) }}</span>
                                                @elseif(str_contains($a, 'approv'))
                                                    <span class="action-type act-approve"><i class="bi bi-check-circle-fill"></i> {{ ucfirst($log->action) }}</span>
                                                @elseif(str_contains($a, 'assign'))
                                                    <span class="action-type act-assign"><i class="bi bi-person-check-fill"></i> {{ ucfirst($log->action) }}</span>
                                                @else
                                                    <span class="action-type act-view"><i class="bi bi-eye-fill"></i> {{ ucfirst($log->action) }}</span>
                                                @endif
                                            </td>
                                            <td class="cell-desc">{{ $log->description ?? '—' }}</td>
                                            <td class="cell-time">
                                                {{ \Carbon\Carbon::parse($log->created_at)->format('M d, Y') }}<br>
                                                <span style="color:var(--gray-400);">{{ \Carbon\Carbon::parse($log->created_at)->format('h:i A') }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">
                                                <div class="empty-state">
                                                    <i class="bi bi-journal-x d-block"></i>
                                                    <p class="fw-semibold mb-1">No logs found</p>
                                                    <p class="small">Try adjusting your filters or date range.</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                @else

                                <!-- Static sample rows -->
                                <tr>
                                    <td class="cell-id">LOG-000001</td>
                                    <td class="cell-user">Maria Reyes Santos<small>mrsantos@dar.gov.ph</small></td>
                                    <td><span class="role-pill role-superadmin">Super Admin</span></td>
                                    <td><span class="module-badge mod-admin"><i class="bi bi-person-badge"></i> Admin</span></td>
                                    <td><span class="action-type act-create"><i class="bi bi-plus-circle-fill"></i> Created</span></td>
                                    <td class="cell-desc">Added new PBD office: CARPOS-PBD Camarines Sur 2</td>
                                    <td class="cell-time">Jun 20, 2024<br><span style="color:var(--gray-400);">09:14 AM</span></td>
                                </tr>
                                <tr>
                                    <td class="cell-id">LOG-000002</td>
                                    <td class="cell-user">Juan dela Cruz<small>jdelacruz@dar.gov.ph</small></td>
                                    <td><span class="role-pill role-carpos">Admin CARPOS</span></td>
                                    <td><span class="module-badge mod-arbo"><i class="bi bi-diagram-3"></i> ARBO</span></td>
                                    <td><span class="action-type act-approve"><i class="bi bi-check-circle-fill"></i> Approved</span></td>
                                    <td class="cell-desc">Approved ARBO registration: Pagkakaisa Farmers Association</td>
                                    <td class="cell-time">Jun 20, 2024<br><span style="color:var(--gray-400);">09:32 AM</span></td>
                                </tr>
                                <tr>
                                    <td class="cell-id">LOG-000003</td>
                                    <td class="cell-user">Pedro Reyes<small>preyes@farmer.ph</small></td>
                                    <td><span class="role-pill role-seller">Seller</span></td>
                                    <td><span class="module-badge mod-marketplace"><i class="bi bi-shop"></i> Marketplace</span></td>
                                    <td><span class="action-type act-create"><i class="bi bi-plus-circle-fill"></i> Added</span></td>
                                    <td class="cell-desc">Listed new product: Premium White Rice — ₱52/kg</td>
                                    <td class="cell-time">Jun 20, 2024<br><span style="color:var(--gray-400);">10:05 AM</span></td>
                                </tr>
                                <tr>
                                    <td class="cell-id">LOG-000004</td>
                                    <td class="cell-user">Ana Villanueva<small>avillanueva@buyer.ph</small></td>
                                    <td><span class="role-pill role-buyer">Buyer</span></td>
                                    <td><span class="module-badge mod-marketplace"><i class="bi bi-shop"></i> Marketplace</span></td>
                                    <td><span class="action-type act-create"><i class="bi bi-plus-circle-fill"></i> Placed Order</span></td>
                                    <td class="cell-desc">Placed Order #2048 for Premium White Rice — 20 kg, ₱1,040</td>
                                    <td class="cell-time">Jun 20, 2024<br><span style="color:var(--gray-400);">10:48 AM</span></td>
                                </tr>
                                <tr>
                                    <td class="cell-id">LOG-000005</td>
                                    <td class="cell-user">Rosa Bautista<small>rbautista@arbocatanduanes.ph</small></td>
                                    <td><span class="role-pill role-arbo-admin">ARBO Admin</span></td>
                                    <td><span class="module-badge mod-user"><i class="bi bi-person"></i> User</span></td>
                                    <td><span class="action-type act-assign"><i class="bi bi-person-check-fill"></i> Assigned</span></td>
                                    <td class="cell-desc">Assigned seller account to: Carlos Mendoza — Masbate ARB Coop</td>
                                    <td class="cell-time">Jun 20, 2024<br><span style="color:var(--gray-400);">11:15 AM</span></td>
                                </tr>
                                <tr>
                                    <td class="cell-id">LOG-000006</td>
                                    <td class="cell-user">Maria Reyes Santos<small>mrsantos@dar.gov.ph</small></td>
                                    <td><span class="role-pill role-superadmin">Super Admin</span></td>
                                    <td><span class="module-badge mod-auth"><i class="bi bi-lock"></i> Auth</span></td>
                                    <td><span class="action-type act-delete"><i class="bi bi-slash-circle-fill"></i> Deactivated</span></td>
                                    <td class="cell-desc">Deactivated user account: Carlos Mendoza (cmendoza@farmer.ph)</td>
                                    <td class="cell-time">Jun 20, 2024<br><span style="color:var(--gray-400);">01:22 PM</span></td>
                                </tr>
                                <tr>
                                    <td class="cell-id">LOG-000007</td>
                                    <td class="cell-user">Linda Pascual<small>lpascual@dar.gov.ph</small></td>
                                    <td><span class="role-pill role-carpos">Admin CARPOS</span></td>
                                    <td><span class="module-badge mod-arbo"><i class="bi bi-diagram-3"></i> ARBO</span></td>
                                    <td><span class="action-type act-create"><i class="bi bi-plus-circle-fill"></i> Registered</span></td>
                                    <td class="cell-desc">Registered new ARBO: CamNorte Farmers Coop — Daet, Camarines Norte</td>
                                    <td class="cell-time">Jun 20, 2024<br><span style="color:var(--gray-400);">02:05 PM</span></td>
                                </tr>
                                <tr>
                                    <td class="cell-id">LOG-000008</td>
                                    <td class="cell-user">Juan dela Cruz<small>jdelacruz@dar.gov.ph</small></td>
                                    <td><span class="role-pill role-carpos">Admin CARPOS</span></td>
                                    <td><span class="module-badge mod-user"><i class="bi bi-person"></i> User</span></td>
                                    <td><span class="action-type act-update"><i class="bi bi-pencil-fill"></i> Updated</span></td>
                                    <td class="cell-desc">Updated contact information for ARBO: Bagong Pag-asa ARB Association</td>
                                    <td class="cell-time">Jun 20, 2024<br><span style="color:var(--gray-400);">03:44 PM</span></td>
                                </tr>
                                <tr>
                                    <td class="cell-id">LOG-000009</td>
                                    <td class="cell-user">Pedro Reyes<small>preyes@farmer.ph</small></td>
                                    <td><span class="role-pill role-seller">Seller</span></td>
                                    <td><span class="module-badge mod-auth"><i class="bi bi-lock"></i> Auth</span></td>
                                    <td><span class="action-type act-login"><i class="bi bi-box-arrow-in-right"></i> Login</span></td>
                                    <td class="cell-desc">Successful login from IP 112.201.45.88 — Sorsogon City</td>
                                    <td class="cell-time">Jun 20, 2024<br><span style="color:var(--gray-400);">04:10 PM</span></td>
                                </tr>
                                <tr>
                                    <td class="cell-id">LOG-000010</td>
                                    <td class="cell-user">Maria Reyes Santos<small>mrsantos@dar.gov.ph</small></td>
                                    <td><span class="role-pill role-superadmin">Super Admin</span></td>
                                    <td><span class="module-badge mod-system"><i class="bi bi-gear"></i> System</span></td>
                                    <td><span class="action-type act-update"><i class="bi bi-pencil-fill"></i> Updated</span></td>
                                    <td class="cell-desc">Updated system settings: marketplace commission rate changed to 3.5%</td>
                                    <td class="cell-time">Jun 20, 2024<br><span style="color:var(--gray-400);">05:00 PM</span></td>
                                </tr>

                                @endisset

                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @isset($logs)
                        @if(method_exists($logs, 'links'))
                            <div class="px-4 py-3 border-top d-flex align-items-center justify-content-between flex-wrap gap-2"
                                 style="border-color:var(--gray-200) !important;">
                                <div class="text-muted" style="font-size:.78rem;">
                                    Showing {{ $logs->firstItem() }}–{{ $logs->lastItem() }} of {{ $logs->total() }} logs
                                </div>
                                {{ $logs->withQueryString()->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                    @else
                        <div class="px-4 py-3 border-top d-flex align-items-center justify-content-between flex-wrap gap-2"
                             style="border-color:var(--gray-200) !important;">
                            <div class="text-muted" style="font-size:.78rem;">Showing 1–10 of 10 logs</div>
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

            <!-- Right column: Critical Actions + Activity Summary -->
            <div class="col-12 col-xl-4 d-flex flex-column gap-4">

                <!-- Critical Actions Panel -->
                <div>
                    <div class="section-title">
                        <div class="section-title-bar" style="background:#dc2626;"></div>
                        Recent Critical Actions
                    </div>
                    <div class="critical-panel">
                        <div class="critical-panel-header">
                            <h6 class="critical-panel-title">
                                <i class="bi bi-exclamation-triangle-fill text-danger"></i>
                                Requires Attention
                            </h6>
                            <span class="badge" style="background:#fdecea; color:#dc2626; font-size:.68rem; border-radius:20px; padding:3px 8px;">
                                3 flagged
                            </span>
                        </div>
                        <div class="critical-item">
                            <div class="critical-dot cd-red"><i class="bi bi-slash-circle-fill"></i></div>
                            <div>
                                <div class="critical-item-title">Account deactivated by Super Admin</div>
                                <div class="critical-item-meta">Carlos Mendoza · cmendoza@farmer.ph · 1:22 PM today</div>
                            </div>
                        </div>
                        <div class="critical-item">
                            <div class="critical-dot cd-red"><i class="bi bi-exclamation-circle-fill"></i></div>
                            <div>
                                <div class="critical-item-title">Failed login attempt detected</div>
                                <div class="critical-item-meta">Unknown IP: 45.33.180.12 · 3 attempts · 4:58 PM today</div>
                            </div>
                        </div>
                        <div class="critical-item">
                            <div class="critical-dot cd-gold"><i class="bi bi-flag-fill"></i></div>
                            <div>
                                <div class="critical-item-title">Product flagged for review</div>
                                <div class="critical-item-meta">Rice (SKU: GRN-001) · Seller: Pedro Reyes · 11:47 AM today</div>
                            </div>
                        </div>
                        <div class="critical-item">
                            <div class="critical-dot cd-purple"><i class="bi bi-gear-fill"></i></div>
                            <div>
                                <div class="critical-item-title">System settings modified</div>
                                <div class="critical-item-meta">Maria Reyes Santos · Commission rate updated · 5:00 PM today</div>
                            </div>
                        </div>
                        <div class="critical-item">
                            <div class="critical-dot cd-green"><i class="bi bi-check-circle-fill"></i></div>
                            <div>
                                <div class="critical-item-title">ARBO approved successfully</div>
                                <div class="critical-item-meta">Pagkakaisa Farmers Association · Juan dela Cruz · 9:32 AM today</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Activity Summary by Module -->
                <div>
                    <div class="section-title">
                        <div class="section-title-bar"></div>
                        Activity by Module
                    </div>
                    <div class="summary-card">
                        <div class="summary-card-label">Today's breakdown</div>
                        @php
                            $modules = [
                                ['label' => 'Marketplace',    'count' => 38, 'max' => 50, 'color' => '#1a73e8'],
                                ['label' => 'User Mgmt',      'count' => 22, 'max' => 50, 'color' => 'var(--green-600)'],
                                ['label' => 'ARBO',           'count' => 18, 'max' => 50, 'color' => '#0d8a7e'],
                                ['label' => 'Admin Actions',  'count' => 14, 'max' => 50, 'color' => 'var(--gold)'],
                                ['label' => 'Authentication', 'count' => 11, 'max' => 50, 'color' => '#dc2626'],
                                ['label' => 'System',         'count' =>  5, 'max' => 50, 'color' => '#7c3aed'],
                            ];
                        @endphp
                        @foreach($modules as $mod)
                            <div class="summary-bar-row">
                                <div class="summary-bar-label">{{ $mod['label'] }}</div>
                                <div class="summary-bar-track">
                                    <div class="summary-bar-fill"
                                         style="width:{{ round(($mod['count']/$mod['max'])*100) }}%; background:{{ $mod['color'] }};"></div>
                                </div>
                                <div class="summary-bar-count">{{ $mod['count'] }}</div>
                            </div>
                        @endforeach
                        <div class="mt-3 pt-3" style="border-top:1px solid var(--gray-200);">
                            <div class="d-flex justify-content-between align-items-center">
                                <span style="font-size:.75rem; color:var(--text-muted); font-weight:500;">Total Today</span>
                                <span style="font-size:.9rem; font-weight:700; color:var(--green-700);">108 actions</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Most Active Users -->
                <div>
                    <div class="section-title">
                        <div class="section-title-bar"></div>
                        Most Active Users Today
                    </div>
                    <div class="summary-card">
                        <div class="summary-card-label">By action count</div>
                        @php
                            $activeUsers = [
                                ['name' => 'Maria R. Santos', 'role' => 'Super Admin',  'count' => 24, 'class' => 'role-superadmin'],
                                ['name' => 'Juan dela Cruz',  'role' => 'Admin CARPOS', 'count' => 18, 'class' => 'role-carpos'],
                                ['name' => 'Rosa Bautista',   'role' => 'ARBO Admin',   'count' => 15, 'class' => 'role-arbo-admin'],
                                ['name' => 'Pedro Reyes',     'role' => 'Seller',       'count' => 11, 'class' => 'role-seller'],
                                ['name' => 'Ana Villanueva',  'role' => 'Buyer',        'count' =>  9, 'class' => 'role-buyer'],
                            ];
                        @endphp
                        @foreach($activeUsers as $u)
                            <div class="summary-bar-row" style="align-items:center;">
                                <div style="width:130px; flex-shrink:0;">
                                    <div style="font-size:.77rem; font-weight:600; color:var(--text-main);">{{ $u['name'] }}</div>
                                    <span class="role-pill {{ $u['class'] }}" style="font-size:.63rem; padding:1px 6px;">{{ $u['role'] }}</span>
                                </div>
                                <div class="summary-bar-track">
                                    <div class="summary-bar-fill"
                                         style="width:{{ round(($u['count']/24)*100) }}%; background:var(--green-600);"></div>
                                </div>
                                <div class="summary-bar-count">{{ $u['count'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>

    </main>

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

    });
    </script>

</body>
</html>