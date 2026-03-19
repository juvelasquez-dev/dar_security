<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sales Reports — E-Agraryo Merkado</title>
    <link rel="icon" href="{{ asset('images/dar-logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/dar-logo.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.2/dist/chart.umd.min.js"></script>

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
            display: flex; align-items: center;
            padding: 0 1.5rem;
            position: fixed; top: 0; left: 0; right: 0;
            z-index: 1040;
            box-shadow: 0 2px 12px rgba(0,0,0,0.22);
        }
        .navbar-brand-area { display: flex; align-items: center; gap: 0.65rem; text-decoration: none; flex-shrink: 0; }
        .navbar-brand-area img { height: 38px; filter: brightness(1.15); }
        .navbar-system-title { font-family: 'DM Serif Display', serif; font-size: 1.18rem; color: #fff; letter-spacing: 0.01em; line-height: 1.15; }
        .navbar-system-sub   { font-size: 0.68rem; color: var(--green-200); letter-spacing: 0.06em; text-transform: uppercase; font-weight: 500; }
        .navbar-page-badge {
            background: rgba(200,146,42,0.18); border: 1px solid rgba(200,146,42,0.35);
            color: var(--gold-mid); font-size: 0.72rem; font-weight: 600;
            letter-spacing: 0.05em; text-transform: uppercase;
            padding: 3px 10px; border-radius: 20px; margin-left: 1rem;
        }
        .navbar-divider { width: 1px; height: 28px; background: rgba(255,255,255,0.12); margin: 0 1.25rem; }
        .navbar-right   { margin-left: auto; display: flex; align-items: center; gap: 0.75rem; }
        .nav-icon-btn {
            background: none; border: none; color: rgba(255,255,255,0.75);
            font-size: 1.15rem; cursor: pointer; padding: 6px 8px; border-radius: 8px;
            position: relative; transition: color 0.18s, background 0.18s;
        }
        .nav-icon-btn:hover { color: #fff; background: rgba(255,255,255,0.08); }
        .nav-notif-dot { position: absolute; top: 5px; right: 6px; width: 8px; height: 8px; background: var(--gold); border-radius: 50%; border: 2px solid var(--green-900); }
        .user-pill {
            display: flex; align-items: center; gap: 0.5rem;
            background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12);
            border-radius: 30px; padding: 5px 12px 5px 6px;
            cursor: pointer; transition: background 0.18s; text-decoration: none;
        }
        .user-pill:hover { background: rgba(255,255,255,0.14); }
        .user-avatar    { width: 30px; height: 30px; border-radius: 50%; object-fit: cover; border: 1.5px solid rgba(255,255,255,0.25); }
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
            text-decoration: none; transition: all 0.18s;
            margin-bottom: 2px; position: relative;
            border: none; background: transparent; width: 100%; text-align: left;
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
        .page-header-title { font-family: 'DM Serif Display', serif; font-size: 1.6rem; color: var(--green-900); margin: 0 0 2px; line-height: 1.2; }
        .page-header-sub   { font-size: 0.85rem; color: var(--text-muted); margin: 0; }
        .breadcrumb-custom { font-size: 0.75rem; color: var(--gray-400); margin-bottom: 0.3rem; display: flex; align-items: center; gap: 0.35rem; }
        .breadcrumb-custom a { color: var(--green-600); text-decoration: none; font-weight: 500; }
        .breadcrumb-custom a:hover { text-decoration: underline; }

        /* ─── Buttons ───────────────────────────────────────── */
        .btn-green-primary {
            background: var(--green-800); color: #fff; border: none; border-radius: var(--radius-sm);
            font-size: 0.83rem; font-weight: 600; padding: 0.5rem 1.1rem;
            display: inline-flex; align-items: center; gap: 0.4rem;
            cursor: pointer; transition: background 0.18s, transform 0.18s, box-shadow 0.18s; text-decoration: none;
        }
        .btn-green-primary:hover { background: var(--green-700); color: #fff; transform: translateY(-1px); box-shadow: var(--shadow-sm); }
        .btn-green-outline {
            background: transparent; color: var(--green-700); border: 1.5px solid var(--green-600);
            border-radius: var(--radius-sm); font-size: 0.83rem; font-weight: 600; padding: 0.48rem 1.1rem;
            display: inline-flex; align-items: center; gap: 0.4rem;
            cursor: pointer; transition: all 0.18s; text-decoration: none;
        }
        .btn-green-outline:hover { background: var(--green-100); color: var(--green-800); }

        /* ─── Stat Cards ────────────────────────────────────── */
        .stat-card {
            background: #fff; border-radius: var(--radius); box-shadow: var(--shadow-sm);
            padding: 1.4rem 1.5rem; display: flex; align-items: center; gap: 1rem;
            transition: box-shadow 0.22s, transform 0.22s;
            border: 1px solid var(--gray-200); height: 100%;
        }
        .stat-card:hover { box-shadow: var(--shadow-md); transform: translateY(-4px); }
        .stat-icon-wrap { width: 52px; height: 52px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.35rem; flex-shrink: 0; }
        .stat-icon-green { background: var(--green-100); color: var(--green-700); }
        .stat-icon-gold  { background: var(--gold-light); color: var(--gold); }
        .stat-icon-blue  { background: #e8f0fe; color: #1a73e8; }
        .stat-icon-teal  { background: #e0f7f5; color: #0d8a7e; }
        .stat-value  { font-size: 1.75rem; font-weight: 700; color: var(--text-main); line-height: 1; margin-bottom: 3px; }
        .stat-label  { font-size: 0.82rem; font-weight: 500; color: var(--text-muted); margin: 0; }
        .stat-sub    { font-size: 0.72rem; color: var(--gray-400); margin-top: 3px; }
        .stat-trend  { font-size: 0.72rem; font-weight: 600; display: inline-flex; align-items: center; gap: 3px; margin-top: 4px; }
        .stat-trend.up   { color: var(--green-600); }
        .stat-trend.down { color: #dc3545; }

        /* ─── Section Title ─────────────────────────────────── */
        .section-title { font-size: 0.95rem; font-weight: 700; color: var(--text-main); margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem; }
        .section-title-bar { width: 4px; height: 18px; background: var(--green-600); border-radius: 3px; flex-shrink: 0; }

        /* ─── Chart Card ────────────────────────────────────── */
        .chart-card { background: #fff; border-radius: var(--radius); box-shadow: var(--shadow-sm); border: 1px solid var(--gray-200); overflow: hidden; }
        .chart-card-header {
            padding: 1.1rem 1.5rem 0.9rem; border-bottom: 1px solid var(--gray-200);
            display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.5rem;
        }
        .chart-card-title { font-size: 0.9rem; font-weight: 700; color: var(--text-main); margin: 0; display: flex; align-items: center; gap: 0.45rem; }
        .chart-card-title i { color: var(--green-600); }
        .chart-filter-select {
            font-size: 0.77rem; border-radius: var(--radius-sm); border: 1.5px solid var(--gray-200);
            padding: 4px 10px; color: var(--text-main); background: var(--gray-50);
            transition: border-color 0.18s; cursor: pointer;
        }
        .chart-filter-select:focus { border-color: var(--green-600); outline: none; }

        /* ─── Table Card ────────────────────────────────────── */
        .table-card { background: #fff; border-radius: var(--radius); box-shadow: var(--shadow-sm); border: 1px solid var(--gray-200); overflow: hidden; }
        .table-card-header {
            background: var(--green-900); padding: 0.95rem 1.5rem;
            display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.5rem;
        }
        .table-card-title { font-size: 0.9rem; font-weight: 700; color: #fff; margin: 0; display: flex; align-items: center; gap: 0.45rem; }
        .table-card-title i { color: var(--gold-mid); }
        .table-record-pill { background: rgba(255,255,255,0.13); color: rgba(255,255,255,0.88); font-size: 0.72rem; font-weight: 600; padding: 3px 10px; border-radius: 20px; }
        .arbo-table { width: 100%; border-collapse: collapse; font-size: 0.84rem; }
        .arbo-table thead th {
            background: var(--green-50); color: var(--green-800);
            font-weight: 700; font-size: 0.72rem; letter-spacing: 0.05em; text-transform: uppercase;
            padding: 0.75rem 1.1rem; border-bottom: 1px solid var(--green-200); white-space: nowrap;
        }
        .arbo-table tbody tr { border-bottom: 1px solid var(--gray-100); transition: background 0.14s; }
        .arbo-table tbody tr:last-child { border-bottom: none; }
        .arbo-table tbody tr:hover { background: var(--gray-50); }
        .arbo-table td { padding: 0.8rem 1.1rem; vertical-align: middle; color: var(--text-main); }

        .rank-badge { width: 26px; height: 26px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 0.72rem; font-weight: 800; }
        .rank-1 { background: #fdf3e0; color: var(--gold); border: 1.5px solid var(--gold-mid); }
        .rank-2 { background: var(--gray-100); color: var(--gray-600); border: 1.5px solid var(--gray-200); }
        .rank-3 { background: #fdecea; color: #c0392b; border: 1.5px solid #f9c9c5; }
        .rank-n { background: var(--green-50); color: var(--green-700); border: 1.5px solid var(--green-200); }

        .revenue-bar-wrap { min-width: 100px; }
        .revenue-bar { height: 6px; background: var(--gray-200); border-radius: 4px; overflow: hidden; margin-top: 3px; }
        .revenue-bar-fill { height: 100%; border-radius: 4px; background: var(--green-600); }

        /* ─── Status Badges ─────────────────────────────────── */
        .status-badge { display: inline-flex; align-items: center; gap: 5px; padding: 3px 10px; border-radius: 20px; font-size: 0.72rem; font-weight: 600; white-space: nowrap; }
        .status-dot   { width: 6px; height: 6px; border-radius: 50%; display: inline-block; }
        .s-completed  { background: var(--green-100); color: var(--green-700); }
        .s-completed  .status-dot { background: var(--green-600); }
        .s-pending    { background: var(--gold-light); color: #8a6000; }
        .s-pending    .status-dot { background: var(--gold); }
        .s-cancelled  { background: #fdecea; color: #c0392b; }
        .s-cancelled  .status-dot { background: #c0392b; }
        .s-processing { background: #e8f0fe; color: #1a73e8; }
        .s-processing .status-dot { background: #1a73e8; }

        /* ─── Side Card ─────────────────────────────────────── */
        .side-card { background: #fff; border-radius: var(--radius); box-shadow: var(--shadow-sm); border: 1px solid var(--gray-200); overflow: hidden; height: 100%; }
        .side-card-header { background: var(--green-900); padding: 0.85rem 1.25rem; }
        .side-card-header h6 { font-size: 0.88rem; font-weight: 700; color: #fff; margin: 0; display: flex; align-items: center; gap: 0.4rem; }
        .side-card-header h6 i { color: var(--gold-mid); }
        .side-card-header p { margin: 0.2rem 0 0; font-size: 0.72rem; color: rgba(255,255,255,0.55); }

        /* ─── Activity Feed ─────────────────────────────────── */
        .activity-item { display: flex; align-items: flex-start; gap: 0.75rem; padding: 0.85rem 1.1rem; border-bottom: 1px solid var(--gray-100); transition: background 0.14s; }
        .activity-item:last-child { border-bottom: none; }
        .activity-item:hover { background: var(--gray-50); }
        .activity-dot { width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; flex-shrink: 0; margin-top: 0.05rem; }
        .ad-green { background: var(--green-100); color: var(--green-700); }
        .ad-gold  { background: var(--gold-light); color: var(--gold); }
        .ad-blue  { background: #e8f0fe; color: #1a73e8; }
        .ad-red   { background: #fdecea; color: #c0392b; }
        .ad-teal  { background: #e0f7f5; color: #0d8a7e; }
        .activity-title { font-size: 0.83rem; font-weight: 600; color: var(--text-main); margin-bottom: 1px; }
        .activity-meta  { font-size: 0.72rem; color: var(--text-muted); }

        /* ─── Donut Summary ─────────────────────────────────── */
        .donut-stat-row { display: flex; align-items: center; gap: 0.75rem; padding: 0.65rem 0; border-bottom: 1px solid var(--gray-100); }
        .donut-stat-row:last-child { border-bottom: none; }
        .donut-dot      { width: 10px; height: 10px; border-radius: 50%; flex-shrink: 0; }
        .donut-stat-label { font-size: 0.82rem; color: var(--text-muted); flex: 1; }
        .donut-stat-val   { font-size: 0.83rem; font-weight: 700; color: var(--text-main); }

        /* ─── KPI Row ───────────────────────────────────────── */
        .kpi-card { background: #fff; border-radius: var(--radius); box-shadow: var(--shadow-sm); border: 1px solid var(--gray-200); padding: 1.1rem 1.25rem; display: flex; flex-direction: column; gap: 0.35rem; height: 100%; }
        .kpi-label    { font-size: 0.72rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.06em; }
        .kpi-value    { font-size: 1.55rem; font-weight: 700; color: var(--green-800); line-height: 1; }
        .kpi-sub      { font-size: 0.72rem; color: var(--gray-400); }
        .kpi-bar-track { height: 5px; background: var(--gray-200); border-radius: 4px; overflow: hidden; margin-top: 4px; }
        .kpi-bar-fill  { height: 100%; border-radius: 4px; }

        .order-mono { font-family: 'Courier New', monospace; font-size: 0.78rem; font-weight: 700; color: var(--green-800); }

        /* ─── Mobile Sidebar ────────────────────────────────── */
        .mobile-sidebar-toggle { display: none; background: none; border: none; color: #fff; font-size: 1.3rem; margin-right: 0.75rem; cursor: pointer; }

        @media (max-width: 991.98px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .page-wrapper { margin-left: 0; padding: 1.25rem 1rem 3rem; }
            .mobile-sidebar-toggle { display: block; }
            .navbar-page-badge { display: none; }
            .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.4); z-index: 1029; }
            .sidebar-overlay.show { display: block; }
        }

        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb { background: var(--gray-200); border-radius: 4px; }

        @media print {
            .top-navbar, .sidebar, .sidebar-overlay { display: none !important; }
            .page-wrapper { margin-left: 0 !important; margin-top: 0 !important; padding: 0 !important; }
            .stat-card, .chart-card, .table-card, .side-card { box-shadow: none !important; border: 1px solid #ddd !important; }
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

            <a href="{{ url('/logs') }}" class="sidebar-link">
                <i class="bi bi-clock-history"></i>
                Activity Logs
            </a>

            <span class="sidebar-section-label">Sales Report</span>

            <a href="{{ url('/reports') }}" class="sidebar-link active">
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
                <div class="breadcrumb-custom mb-1">
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                    <i class="bi bi-chevron-right" style="font-size:.6rem;"></i>
                    <span>Sales Reports</span>
                </div>
                <h1 class="page-header-title">
                    <i class="bi bi-bar-chart-line-fill me-2" style="color:var(--gold);font-size:1.3rem;vertical-align:middle;"></i>
                    Sales & Marketplace Reports
                </h1>
                <p class="page-header-sub">Monitor marketplace performance, transactions, and revenue for this ARBO organization.</p>
            </div>
            <div class="d-flex gap-2 flex-wrap align-items-start">
                <div class="d-flex align-items-center gap-2">
                    <select class="chart-filter-select" id="reportPeriodSelect" style="padding:6px 12px;font-size:.82rem;">
                        <option value="monthly">Monthly</option>
                        <option value="quarterly">Quarterly</option>
                        <option value="yearly">Yearly</option>
                    </select>
                </div>
                <button class="btn-green-outline" onclick="window.print()">
                    <i class="bi bi-printer"></i> Print Summary
                </button>
                <button class="btn-green-primary">
                    <i class="bi bi-download"></i> Export Report
                </button>
            </div>
        </div>

        <!-- ── Summary Stat Cards ── -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon-wrap stat-icon-green"><i class="bi bi-currency-exchange"></i></div>
                    <div>
                        <div class="stat-value">₱ {{ number_format($totalSales ?? 124580, 2) }}</div>
                        <p class="stat-label">Total Sales Revenue</p>
                        <div class="stat-trend up"><i class="bi bi-arrow-up-short"></i> +14.2% vs last month</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon-wrap stat-icon-blue"><i class="bi bi-receipt-cutoff"></i></div>
                    <div>
                        <div class="stat-value">{{ $totalOrders ?? 0 }}</div>
                        <p class="stat-label">Total Orders</p>
                        <div class="stat-trend up"><i class="bi bi-arrow-up-short"></i> +8 this month</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon-wrap stat-icon-teal"><i class="bi bi-check2-circle"></i></div>
                    <div>
                        <div class="stat-value">{{ $completedOrders ?? 0 }}</div>
                        <p class="stat-label">Completed Orders</p>
                        <div class="stat-sub">Successfully fulfilled</div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon-wrap stat-icon-gold"><i class="bi bi-hourglass-split"></i></div>
                    <div>
                        <div class="stat-value">{{ $pendingOrders ?? 0 }}</div>
                        <p class="stat-label">Pending Orders</p>
                        <div class="stat-trend down"><i class="bi bi-arrow-down-short"></i> Need attention</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ── KPI Mini-Row ── -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="kpi-card">
                    <div class="kpi-label">Avg. Order Value</div>
                    <div class="kpi-value">₱{{ number_format($avgOrderValue ?? 1248.50, 0) }}</div>
                    <div class="kpi-bar-track"><div class="kpi-bar-fill" style="width:72%;background:var(--green-600);"></div></div>
                    <div class="kpi-sub">72% of ₱1,750 target</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="kpi-card">
                    <div class="kpi-label">Order Fulfillment Rate</div>
                    <div class="kpi-value">{{ $fulfillmentRate ?? '91' }}%</div>
                    <div class="kpi-bar-track"><div class="kpi-bar-fill" style="width:91%;background:#0d8a7e;"></div></div>
                    <div class="kpi-sub">Above 85% benchmark</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="kpi-card">
                    <div class="kpi-label">Active Sellers</div>
                    <div class="kpi-value">{{ $activeSellers ?? 18 }}</div>
                    <div class="kpi-bar-track"><div class="kpi-bar-fill" style="width:75%;background:var(--gold);"></div></div>
                    <div class="kpi-sub">of {{ $totalSellers ?? 24 }} registered</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="kpi-card">
                    <div class="kpi-label">Active Products</div>
                    <div class="kpi-value">{{ $activeProducts ?? 43 }}</div>
                    <div class="kpi-bar-track"><div class="kpi-bar-fill" style="width:74%;background:#1a73e8;"></div></div>
                    <div class="kpi-sub">of {{ $totalProducts ?? 58 }} listed</div>
                </div>
            </div>
        </div>

        <!-- ── Charts Row ── -->
        <div class="row g-4 mb-4">
            <!-- Sales Trend Line Chart -->
            <div class="col-lg-8">
                <div class="chart-card">
                    <div class="chart-card-header">
                        <h6 class="chart-card-title"><i class="bi bi-graph-up-arrow"></i> Sales Trend — Monthly Revenue</h6>
                        <select class="chart-filter-select" id="salesChartPeriod">
                            <option value="6m" selected>Last 6 months</option>
                            <option value="12m">Last 12 months</option>
                            <option value="ytd">Year to Date</option>
                        </select>
                    </div>
                    <div class="p-4" style="height:280px;position:relative;">
                        <canvas id="salesTrendChart"></canvas>
                    </div>
                </div>
            </div>
            <!-- Order Status Donut -->
            <div class="col-lg-4">
                <div class="chart-card h-100">
                    <div class="chart-card-header">
                        <h6 class="chart-card-title"><i class="bi bi-pie-chart-fill"></i> Order Status Breakdown</h6>
                    </div>
                    <div class="px-4 pt-3" style="height:200px;position:relative;">
                        <canvas id="orderStatusChart"></canvas>
                    </div>
                    <div class="px-4 pb-4 pt-2">
                        @php
                            $donutStats = [
                                ['label'=>'Completed',  'val'=>$completedOrders ?? 20, 'color'=>'var(--green-600)'],
                                ['label'=>'Processing', 'val'=>8,                       'color'=>'#1a73e8'],
                                ['label'=>'Pending',    'val'=>$pendingOrders ?? 12,    'color'=>'var(--gold)'],
                                ['label'=>'Cancelled',  'val'=>$cancelledOrders ?? 3,   'color'=>'#c0392b'],
                            ];
                            $donutTotal = array_sum(array_column($donutStats, 'val'));
                        @endphp
                        @foreach($donutStats as $ds)
                        <div class="donut-stat-row">
                            <div class="donut-dot" style="background:{{ $ds['color'] }};"></div>
                            <span class="donut-stat-label">{{ $ds['label'] }}</span>
                            <span class="donut-stat-val">{{ $ds['val'] }}</span>
                            <span style="font-size:.7rem;color:var(--text-muted);margin-left:.35rem;">
                                ({{ $donutTotal > 0 ? round(($ds['val'] / $donutTotal) * 100) : 0 }}%)
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- ── Bar Chart Row ── -->
        <div class="row g-4 mb-4">
            <div class="col-12">
                <div class="chart-card">
                    <div class="chart-card-header">
                        <h6 class="chart-card-title"><i class="bi bi-bar-chart-fill"></i> Orders Volume by Month</h6>
                        <select class="chart-filter-select" id="orderBarPeriod">
                            <option value="6m" selected>Last 6 months</option>
                            <option value="12m">Last 12 months</option>
                        </select>
                    </div>
                    <div class="p-4" style="height:220px;position:relative;">
                        <canvas id="orderVolumeChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- ── Top Products + Recent Sales ── -->
        <div class="row g-4 mb-4">
            <!-- Top Selling Products -->
            <div class="col-lg-6">
                <div class="section-title"><div class="section-title-bar"></div>Top Selling Products</div>
                <div class="table-card">
                    <div class="table-card-header">
                        <h6 class="table-card-title"><i class="bi bi-trophy-fill"></i> Best Performing Products</h6>
                        <span class="table-record-pill">This Month</span>
                    </div>
                    <div class="table-responsive">
                        <table class="arbo-table">
                            <thead>
                                <tr>
                                    <th>#</th><th>Product Name</th><th>Seller</th>
                                    <th class="text-center">Units Sold</th><th>Revenue</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $topProducts = $topProducts ?? [
                                        ['name'=>'Premium White Rice',      'sku'=>'GRN-001','seller'=>'Juan dela Cruz',  'units'=>'280 kg',   'revenue'=>14560],
                                        ['name'=>'Bangus Fry (Fingerlings)','sku'=>'FRM-001','seller'=>'Juan dela Cruz',  'units'=>'4,500 pcs','revenue'=>36000],
                                        ['name'=>'Fresh Coconut (Whole)',   'sku'=>'FRT-001','seller'=>'Pedro Reyes',     'units'=>'320 pcs',  'revenue'=>11200],
                                        ['name'=>'Native Chicken (Live)',   'sku'=>'LST-001','seller'=>'Luz Villanueva',  'units'=>'42 heads', 'revenue'=>15960],
                                        ['name'=>'Processed Coconut Oil',   'sku'=>'PRC-001','seller'=>'Elena Torres',    'units'=>'58 pcs',   'revenue'=>12180],
                                    ];
                                    $maxRev = max(array_column($topProducts, 'revenue'));
                                @endphp
                                @foreach($topProducts as $idx => $product)
                                <tr>
                                    <td>
                                        <span class="rank-badge {{ $idx === 0 ? 'rank-1' : ($idx === 1 ? 'rank-2' : ($idx === 2 ? 'rank-3' : 'rank-n')) }}">{{ $idx + 1 }}</span>
                                    </td>
                                    <td>
                                        <div style="font-weight:600;font-size:.83rem;color:var(--green-800);">{{ $product['name'] }}</div>
                                        <div style="font-size:.7rem;color:var(--text-muted);font-family:'Courier New',monospace;">SKU: {{ $product['sku'] }}</div>
                                    </td>
                                    <td style="font-size:.81rem;">{{ $product['seller'] }}</td>
                                    <td class="text-center"><span style="font-size:.82rem;font-weight:600;color:var(--green-700);">{{ $product['units'] }}</span></td>
                                    <td>
                                        <div class="revenue-bar-wrap">
                                            <div style="font-size:.82rem;font-weight:700;color:var(--green-800);">₱{{ number_format($product['revenue']) }}</div>
                                            <div class="revenue-bar"><div class="revenue-bar-fill" style="width:{{ $maxRev > 0 ? round(($product['revenue'] / $maxRev) * 100) : 0 }}%;"></div></div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Recent Sales Transactions -->
            <div class="col-lg-6">
                <div class="section-title"><div class="section-title-bar"></div>Recent Sales</div>
                <div class="table-card">
                    <div class="table-card-header">
                        <h6 class="table-card-title"><i class="bi bi-clock-history"></i> Latest Transactions</h6>
                        <a href="{{ url('/arbo/orders') }}" style="font-size:.75rem;color:var(--gold-mid);text-decoration:none;font-weight:600;">
                            View All <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="arbo-table">
                            <thead>
                                <tr><th>Order ID</th><th>Buyer</th><th>Amount</th><th class="text-center">Status</th><th>Date</th></tr>
                            </thead>
                            <tbody>
                                @php
                                    $recentSales = $recentSales ?? [
                                        ['id'=>'ORD-2024-048','buyer'=>'Ana Reyes',     'product'=>'White Rice + Corn',  'amount'=>660,  'status'=>'pending',    'date'=>'Jun 15'],
                                        ['id'=>'ORD-2024-047','buyer'=>'Felix Soriano', 'product'=>'Native Chicken',     'amount'=>760,  'status'=>'processing', 'date'=>'Jun 15'],
                                        ['id'=>'ORD-2024-046','buyer'=>'Divina Magno',  'product'=>'Vegetables Bundle',  'amount'=>1250, 'status'=>'completed',  'date'=>'Jun 14'],
                                        ['id'=>'ORD-2024-045','buyer'=>'Marites Lim',   'product'=>'White Rice 25kg',    'amount'=>1300, 'status'=>'completed',  'date'=>'Jun 14'],
                                        ['id'=>'ORD-2024-044','buyer'=>'Marco Bautista','product'=>'Bangus Fry',         'amount'=>4000, 'status'=>'completed',  'date'=>'Jun 13'],
                                        ['id'=>'ORD-2024-042','buyer'=>'Ronald Cruz',   'product'=>'Abaca Fiber',        'amount'=>1900, 'status'=>'cancelled',  'date'=>'Jun 12'],
                                    ];
                                    $statusBadge = ['completed'=>'s-completed','pending'=>'s-pending','cancelled'=>'s-cancelled','processing'=>'s-processing'];
                                    $statusLabel = ['completed'=>'Completed','pending'=>'Pending','cancelled'=>'Cancelled','processing'=>'Processing'];
                                @endphp
                                @foreach($recentSales as $sale)
                                <tr>
                                    <td><span class="order-mono">{{ $sale['id'] }}</span></td>
                                    <td>
                                        <div style="font-size:.82rem;font-weight:500;">{{ $sale['buyer'] }}</div>
                                        <div style="font-size:.7rem;color:var(--text-muted);">{{ $sale['product'] }}</div>
                                    </td>
                                    <td><span style="font-weight:700;font-size:.88rem;color:var(--green-800);">₱{{ number_format($sale['amount']) }}</span></td>
                                    <td class="text-center">
                                        <span class="status-badge {{ $statusBadge[$sale['status']] ?? 's-pending' }}">
                                            <span class="status-dot"></span>
                                            {{ $statusLabel[$sale['status']] ?? ucfirst($sale['status']) }}
                                        </span>
                                    </td>
                                    <td style="font-size:.8rem;color:var(--text-muted);">{{ $sale['date'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- ── Bottom Row: Category Breakdown + Activity ── -->
        <div class="row g-4">

            <!-- Sales by Category -->
            <div class="col-lg-4">
                <div class="section-title"><div class="section-title-bar"></div>Sales by Category</div>
                <div class="chart-card">
                    <div class="chart-card-header">
                        <h6 class="chart-card-title"><i class="bi bi-tag-fill"></i> Revenue per Category</h6>
                    </div>
                    <div class="p-4" style="height:220px;position:relative;">
                        <canvas id="categoryChart"></canvas>
                    </div>
                    <div class="px-4 pb-3">
                        @php
                            $catBreakdown = [
                                ['cat'=>'Grains / Rice',   'pct'=>34, 'color'=>'#a07000'],
                                ['cat'=>'Livestock',       'pct'=>28, 'color'=>'#e07b2a'],
                                ['cat'=>'Fruits',          'pct'=>16, 'color'=>'#b03060'],
                                ['cat'=>'Vegetables',      'pct'=>12, 'color'=>'#1a6932'],
                                ['cat'=>'Processed Goods', 'pct'=>10, 'color'=>'#1a73e8'],
                            ];
                        @endphp
                        @foreach($catBreakdown as $cb)
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div style="width:10px;height:10px;border-radius:50%;background:{{ $cb['color'] }};flex-shrink:0;"></div>
                            <span style="font-size:.78rem;color:var(--text-muted);flex:1;">{{ $cb['cat'] }}</span>
                            <div style="flex:1;"><div style="height:4px;background:var(--gray-200);border-radius:4px;overflow:hidden;"><div style="height:100%;border-radius:4px;background:{{ $cb['color'] }};width:{{ $cb['pct'] }}%;"></div></div></div>
                            <span style="font-size:.78rem;font-weight:700;color:var(--text-main);min-width:30px;text-align:right;">{{ $cb['pct'] }}%</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Seller Performance -->
            <div class="col-lg-4">
                <div class="section-title"><div class="section-title-bar"></div>Seller Performance</div>
                <div class="side-card">
                    <div class="side-card-header">
                        <h6><i class="bi bi-person-workspace"></i> Top Sellers by Revenue</h6>
                        <p>Current month ranking</p>
                    </div>
                    <div class="px-3 py-2">
                        @php
                            $topSellers = [
                                ['name'=>'Juan dela Cruz', 'rev'=>50560,'orders'=>18,'pct'=>100],
                                ['name'=>'Pedro Reyes',    'rev'=>31850,'orders'=>14,'pct'=>63],
                                ['name'=>'Luz Villanueva', 'rev'=>22440,'orders'=>11,'pct'=>44],
                                ['name'=>'Maria Santos',   'rev'=>18200,'orders'=>9, 'pct'=>36],
                                ['name'=>'Elena Torres',   'rev'=>12180,'orders'=>6, 'pct'=>24],
                            ];
                        @endphp
                        @foreach($topSellers as $si => $ts)
                        <div class="py-2" style="{{ !$loop->last ? 'border-bottom:1px solid var(--gray-100)' : '' }};">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <div style="width:22px;height:22px;border-radius:50%;background:{{ $si===0 ? 'var(--gold-light)' : 'var(--green-50)' }};border:1.5px solid {{ $si===0 ? 'var(--gold-mid)' : 'var(--green-200)' }};display:flex;align-items:center;justify-content:center;font-size:.68rem;font-weight:800;color:{{ $si===0 ? 'var(--gold)' : 'var(--green-700)' }};flex-shrink:0;">{{ $si+1 }}</div>
                                <div style="flex:1;"><div style="font-size:.82rem;font-weight:600;color:var(--green-800);">{{ $ts['name'] }}</div></div>
                                <div style="text-align:right;">
                                    <div style="font-size:.82rem;font-weight:700;color:var(--green-800);">₱{{ number_format($ts['rev']) }}</div>
                                    <div style="font-size:.68rem;color:var(--text-muted);">{{ $ts['orders'] }} orders</div>
                                </div>
                            </div>
                            <div style="height:4px;background:var(--gray-200);border-radius:4px;overflow:hidden;">
                                <div style="height:100%;border-radius:4px;background:{{ $si===0 ? 'var(--gold)' : 'var(--green-600)' }};width:{{ $ts['pct'] }}%;transition:width .4s;"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Marketplace Activity -->
            <div class="col-lg-4">
                <div class="section-title"><div class="section-title-bar"></div>Marketplace Activity</div>
                <div class="side-card">
                    <div class="side-card-header">
                        <h6><i class="bi bi-clock-history"></i> Recent Events</h6>
                        <p>Live marketplace activity log</p>
                    </div>
                    <div>
                        <div class="activity-item">
                            <div class="activity-dot ad-gold"><i class="bi bi-cart-plus-fill"></i></div>
                            <div>
                                <div class="activity-title">New order — Ana Reyes #ORD-2024-048</div>
                                <div class="activity-meta"><i class="bi bi-clock me-1"></i>Just now &bull; ₱660.00</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-dot ad-green"><i class="bi bi-check2-circle"></i></div>
                            <div>
                                <div class="activity-title">Order completed — Marites Lim #045</div>
                                <div class="activity-meta"><i class="bi bi-clock me-1"></i>1 hr ago &bull; ₱1,300.00</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-dot ad-blue"><i class="bi bi-box-seam-fill"></i></div>
                            <div>
                                <div class="activity-title">Product added — Bangus Fry by Juan</div>
                                <div class="activity-meta"><i class="bi bi-clock me-1"></i>2 hrs ago &bull; SKU: FRM-001</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-dot ad-teal"><i class="bi bi-person-plus-fill"></i></div>
                            <div>
                                <div class="activity-title">Seller registered — Carlos Mendoza</div>
                                <div class="activity-meta"><i class="bi bi-clock me-1"></i>3 hrs ago &bull; Fiber Crops</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-dot ad-green"><i class="bi bi-cash-coin"></i></div>
                            <div>
                                <div class="activity-title">Payment received — Felix Soriano #047</div>
                                <div class="activity-meta"><i class="bi bi-clock me-1"></i>4 hrs ago &bull; ₱760.00 via GCash</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-dot ad-red"><i class="bi bi-x-circle-fill"></i></div>
                            <div>
                                <div class="activity-title">Order cancelled — Ronald Cruz #042</div>
                                <div class="activity-meta"><i class="bi bi-clock me-1"></i>Yesterday &bull; Refund processed</div>
                            </div>
                        </div>
                    </div>
                    <div style="padding:.65rem 1.1rem;background:var(--gray-50);border-top:1px solid var(--gray-200);text-align:center;">
                        <a href="{{ url('/arbo/orders') }}" style="font-size:.78rem;color:var(--green-700);font-weight:600;text-decoration:none;">
                            View All Activity <i class="bi bi-arrow-right ms-1"></i>
                        </a>
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

        // ── Chart.js Defaults ──
        Chart.defaults.font.family = "'DM Sans', system-ui, sans-serif";
        Chart.defaults.font.size   = 12;
        Chart.defaults.color       = '#64748b';

        const monthlySalesData  = {!! json_encode($monthlySales  ?? [12000, 15000, 18000, 20000, 17000, 22000]) !!};
        const monthlyOrdersData = {!! json_encode($monthlyOrders ?? [22, 28, 35, 40, 33, 48]) !!};
        const monthlyLabels     = {!! json_encode($monthlyLabels ?? ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun']) !!};
        const completedOrders   = {{ $completedOrders ?? 20 }};
        const processingOrders  = 8;
        const pendingOrders     = {{ $pendingOrders   ?? 12 }};
        const cancelledOrders   = {{ $cancelledOrders ?? 3  }};

        // 1. Sales Trend Line Chart
        const salesCtx = document.getElementById('salesTrendChart');
        if (salesCtx) {
            new Chart(salesCtx.getContext('2d'), {
                type: 'line',
                data: {
                    labels: monthlyLabels,
                    datasets: [{
                        label: 'Revenue (₱)', data: monthlySalesData,
                        borderColor: '#1f803c', backgroundColor: 'rgba(31,128,60,0.08)',
                        borderWidth: 2.5, tension: 0.42, fill: true,
                        pointBackgroundColor: '#fff', pointBorderColor: '#1f803c',
                        pointBorderWidth: 2.5, pointRadius: 5, pointHoverRadius: 7,
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { display: false }, tooltip: { mode: 'index', intersect: false, callbacks: { label: ctx => ' ₱' + ctx.raw.toLocaleString() } } },
                    scales: { x: { grid: { display: false } }, y: { beginAtZero: true, ticks: { callback: val => '₱' + (val >= 1000 ? (val/1000).toFixed(0) + 'k' : val) } } }
                }
            });
        }

        // 2. Order Status Donut
        const donutCtx = document.getElementById('orderStatusChart');
        if (donutCtx) {
            new Chart(donutCtx.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['Completed', 'Processing', 'Pending', 'Cancelled'],
                    datasets: [{
                        data: [completedOrders, processingOrders, pendingOrders, cancelledOrders],
                        backgroundColor: ['rgba(31,128,60,0.85)', 'rgba(26,115,232,0.85)', 'rgba(200,146,42,0.85)', 'rgba(192,57,43,0.85)'],
                        borderColor: '#fff', borderWidth: 3, hoverOffset: 6,
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false, cutout: '70%',
                    plugins: { legend: { display: false }, tooltip: { callbacks: { label: ctx => { const total = ctx.dataset.data.reduce((a,b) => a+b, 0); const pct = ((ctx.raw/total)*100).toFixed(1); return ` ${ctx.label}: ${ctx.raw} (${pct}%)`; } } } }
                }
            });
        }

        // 3. Order Volume Bar Chart
        const barCtx = document.getElementById('orderVolumeChart');
        if (barCtx) {
            new Chart(barCtx.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: monthlyLabels,
                    datasets: [{ label: 'Orders', data: monthlyOrdersData, backgroundColor: 'rgba(200,146,42,0.7)', borderColor: 'rgba(200,146,42,1)', borderWidth: 1, borderRadius: 8, borderSkipped: false }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { display: false }, tooltip: { mode: 'index', intersect: false } },
                    scales: { x: { grid: { display: false } }, y: { beginAtZero: true, ticks: { stepSize: 10 } } }
                }
            });
        }

        // 4. Category Horizontal Bar
        const catCtx = document.getElementById('categoryChart');
        if (catCtx) {
            new Chart(catCtx.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: ['Grains', 'Livestock', 'Fruits', 'Vegetables', 'Processed'],
                    datasets: [{ data: [34, 28, 16, 12, 10], backgroundColor: ['rgba(160,112,0,0.75)', 'rgba(224,123,42,0.75)', 'rgba(176,48,96,0.75)', 'rgba(26,105,50,0.75)', 'rgba(26,115,232,0.75)'], borderRadius: 6, borderSkipped: false }]
                },
                options: {
                    indexAxis: 'y', responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { display: false }, tooltip: { callbacks: { label: ctx => ` ${ctx.raw}% of total revenue` } } },
                    scales: { x: { beginAtZero: true, max: 40, ticks: { callback: val => val + '%' }, grid: { display: false } }, y: { grid: { display: false } } }
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