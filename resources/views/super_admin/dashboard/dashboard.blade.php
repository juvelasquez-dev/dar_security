<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Super Admin Dashboard — E-Agraryo Merkado</title>
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
            width: 52px;
            height: 52px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            flex-shrink: 0;
        }

        .stat-icon-green   { background: var(--green-100); color: var(--green-700); }
        .stat-icon-gold    { background: var(--gold-light); color: var(--gold); }
        .stat-icon-blue    { background: #e8f0fe; color: #1a73e8; }
        .stat-icon-teal    { background: #e0f7f5; color: #0d8a7e; }

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
        .stat-trend.neutral { color: var(--gray-600); }

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
            width: 4px;
            height: 18px;
            background: var(--green-600);
            border-radius: 3px;
        }

        /* ─── Quick Action / Feature Cards ─────────────────── */
        .feature-card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            padding: 1.35rem 1.4rem;
            display: flex;
            flex-direction: column;
            height: 100%;
            transition: box-shadow 0.22s, transform 0.22s;
        }

        .feature-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-3px);
        }

        .feature-icon {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            color: #fff;
            margin-bottom: 0.9rem;
            flex-shrink: 0;
        }

        .feature-card h6 {
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 0.35rem;
        }

        .feature-card p {
            font-size: 0.79rem;
            color: var(--text-muted);
            margin: 0;
            flex: 1;
            line-height: 1.5;
        }

        /* ─── Branch Cards ──────────────────────────────────── */
        .branch-card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            padding: 1.2rem 1.15rem;
            display: flex;
            flex-direction: column;
            height: 100%;
            transition: box-shadow 0.22s, transform 0.22s;
        }

        .branch-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-3px);
            border-color: var(--green-200);
        }

        .branch-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--green-100);
            color: var(--green-700);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            margin-bottom: 0.75rem;
        }

        .branch-card h6 {
            font-size: 0.84rem;
            font-weight: 700;
            color: var(--green-900);
            margin-bottom: 0.2rem;
        }

        .branch-card p {
            font-size: 0.73rem;
            color: var(--text-muted);
            margin: 0 0 0.75rem;
            flex: 1;
        }

        /* ─── Chart Cards ───────────────────────────────────── */
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

        .arbo-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.84rem;
        }

        .arbo-table thead th {
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

        .arbo-table tbody tr {
            border-bottom: 1px solid var(--gray-100);
            transition: background 0.14s;
        }

        .arbo-table tbody tr:last-child { border-bottom: none; }
        .arbo-table tbody tr:hover { background: var(--gray-50); }

        .arbo-table td {
            padding: 0.75rem 1.1rem;
            vertical-align: middle;
            color: var(--text-main);
        }

        .arbo-name-cell {
            font-weight: 600;
            color: var(--green-800);
        }

        .arbo-name-cell small {
            display: block;
            font-weight: 400;
            font-size: 0.72rem;
            color: var(--text-muted);
            margin-top: 1px;
        }

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
        .status-pending  { background: var(--gold-light); color: var(--gold); }
        .status-inactive { background: #fdecea; color: #c0392b; }

        .status-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            display: inline-block;
        }

        .status-active   .status-dot { background: var(--green-600); }
        .status-pending  .status-dot { background: var(--gold); }
        .status-inactive .status-dot { background: #c0392b; }

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

        .activity-dot-wrap { flex-shrink: 0; margin-top: 3px; }

        .activity-dot {
            width: 32px; height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
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

        /* ─── Scrollbar ─────────────────────────────────────── */
        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb { background: var(--gray-200); border-radius: 4px; }
    </style>
</head>
<body>

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
                    {{-- <img class="user-avatar"
                        src="{{ auth()->user()->avatar ?: 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name ?? 'Super Admin') . '&background=1a6932&color=fff&rounded=true&size=64' }}"
                        alt="User avatar"> --}}
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

            <a href="{{ url('/dashboard') }}" class="sidebar-link active">
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

            {{-- ARBOS Marketplace and Orders links removed as requested --}}

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
                <h1 class="page-header-title">Super Admin Dashboard</h1>
                <p class="page-header-sub">
                    Monitor and manage all aspects of <strong>E-Agraryo Merkado</strong> — analytics, user roles, branches, and ARBOS marketplace.
                </p>
            </div>
            <div class="header-date-chip">
                <i class="bi bi-calendar3"></i>
                <span id="currentDate"></span>
            </div>
        </div>

        <!-- ── Summary Stat Cards ─────────────────────────── -->
        <div class="row g-3 mb-4">
            <!-- Total Branches -->
            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon-wrap stat-icon-green">
                        <i class="bi bi-building-fill"></i>
                    </div>
                    <div>
                        <div class="stat-value">{{ $totalBranches ?? '8' }}</div>
                        <p class="stat-label">Branches</p>
                        <span class="stat-trend neutral"><i class="bi bi-check-circle"></i> All active</span>
                    </div>
                </div>
            </div>

            <!-- CARPOS Admins -->
            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon-wrap stat-icon-gold">
                        <i class="bi bi-person-badge-fill"></i>
                    </div>
                    <div>
                        <div class="stat-value">{{ $totalAdmins ?? '—' }}</div>
                        <p class="stat-label">CARPOS Admins</p>
                        <span class="stat-trend up"><i class="bi bi-arrow-up-short"></i> +1 this month</span>
                    </div>
                </div>
            </div>

            <!-- Market Users -->
            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon-wrap stat-icon-blue">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div>
                        <div class="stat-value">{{ $totalMarketUsers ?? '—' }}</div>
                        <p class="stat-label">Market Users</p>
                        <span class="stat-trend up"><i class="bi bi-arrow-up-short"></i> +17 this month</span>
                    </div>
                </div>
            </div>

            <!-- Transactions -->
            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon-wrap stat-icon-teal">
                        <i class="bi bi-cart-check-fill"></i>
                    </div>
                    <div>
                        <div class="stat-value">{{ $totalTransactions ?? '—' }}</div>
                        <p class="stat-label">Transactions</p>
                        <span class="stat-trend up"><i class="bi bi-arrow-up-short"></i> +24 this month</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- ── CARPOS-PBD Branches ────────────────────────── -->
        <div class="mb-4">
            <div class="section-title">
                <div class="section-title-bar"></div>
                CARPOS-PBD Branches
            </div>
            <div class="row g-3">
                @php
                    $branches = [
                        ['name' => 'Regional Office', 'desc' => 'Manage regional operations',  'slug' => 'regional-office'],
                        ['name' => 'Albay',           'desc' => 'Albay province branch',        'slug' => 'albay'],
                        ['name' => 'Catanduanes',     'desc' => 'Catanduanes province branch',  'slug' => 'catanduanes'],
                        ['name' => 'Camarines Sur 1', 'desc' => 'Camarines Sur 1 branch',       'slug' => 'camarines-sur-1'],
                        ['name' => 'Camarines Sur 2', 'desc' => 'Camarines Sur 2 branch',       'slug' => 'camarines-sur-2'],
                        ['name' => 'Masbate',         'desc' => 'Masbate province branch',      'slug' => 'masbate'],
                        ['name' => 'Sorsogon',        'desc' => 'Sorsogon province branch',     'slug' => 'sorsogon'],
                        ['name' => 'Camarines Norte', 'desc' => 'Camarines Norte branch',       'slug' => 'camarines-norte'],
                    ];
                @endphp

                @foreach($branches as $branch)
                <div class="col-6 col-md-3">
                    <div class="branch-card">
                        <div class="branch-icon"><i class="bi bi-building"></i></div>
                        <h6>{{ $branch['name'] }}</h6>
                        <p>{{ $branch['desc'] }}</p>
                        <a href="{{ url('/branches/' . $branch['slug']) }}"
                           class="btn btn-sm w-100 mt-auto"
                           style="background: var(--green-100); color: var(--green-700); border:none; border-radius:8px; font-size:.77rem; font-weight:600;">
                            Manage <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- ── Analytics + Activity ──────────────────────── -->
        <div class="row g-4">

            <!-- Charts Column -->
            <div class="col-lg-8">
                <div class="section-title">
                    <div class="section-title-bar"></div>
                    Analytics Overview
                </div>

                <!-- User Growth Chart -->
                <div class="chart-card mb-4">
                    <div class="chart-card-header">
                        <span style="font-size:.88rem; font-weight:700;">User Growth</span>
                        <select class="form-select form-select-sm w-auto" style="font-size:.77rem;" id="userGrowthTimeframe">
                            <option value="7">Last 7 days</option>
                            <option value="30" selected>Last 30 days</option>
                            <option value="90">Last 90 days</option>
                            <option value="365">Last 12 months</option>
                        </select>
                    </div>
                    <div class="p-4" style="height: 260px; position:relative;">
                        <canvas id="userGrowthChart"></canvas>
                    </div>
                </div>

                <!-- Transactions Chart -->
                <div class="chart-card">
                    <div class="chart-card-header">
                        <span style="font-size:.88rem; font-weight:700;">Marketplace Transactions</span>
                        <select class="form-select form-select-sm w-auto" style="font-size:.77rem;" id="transactionTimeframe">
                            <option value="7">Last 7 days</option>
                            <option value="30" selected>Last 30 days</option>
                            <option value="90">Last 90 days</option>
                            <option value="365">Last 12 months</option>
                        </select>
                    </div>
                    <div class="p-4" style="height: 260px; position:relative;">
                        <canvas id="transactionChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Right Column: Activity Log -->
            <div class="col-lg-4">
                <div class="section-title">
                    <div class="section-title-bar"></div>
                    Recent Activity
                </div>
                <div class="table-card">
                    <ul class="activity-log">
                        <li class="activity-item">
                            <div class="activity-dot-wrap">
                                <div class="activity-dot ad-green"><i class="bi bi-person-check"></i></div>
                            </div>
                            <div>
                                <div class="activity-title">New user registered</div>
                                <div class="activity-meta">Admin: Ana Villanueva · Just now</div>
                            </div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-dot-wrap">
                                <div class="activity-dot ad-blue"><i class="bi bi-building"></i></div>
                            </div>
                            <div>
                                <div class="activity-title">Branch updated</div>
                                <div class="activity-meta">Albay branch · 1 hr ago</div>
                            </div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-dot-wrap">
                                <div class="activity-dot ad-gold"><i class="bi bi-cart-check"></i></div>
                            </div>
                            <div>
                                <div class="activity-title">Order #2048 completed</div>
                                <div class="activity-meta">Buyer: Jose Ramos · 3 hrs ago</div>
                            </div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-dot-wrap">
                                <div class="activity-dot ad-red"><i class="bi bi-exclamation-circle"></i></div>
                            </div>
                            <div>
                                <div class="activity-title">Seller account flagged</div>
                                <div class="activity-meta">Pedro Reyes · 5 hrs ago</div>
                            </div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-dot-wrap">
                                <div class="activity-dot ad-green"><i class="bi bi-shop"></i></div>
                            </div>
                            <div>
                                <div class="activity-title">ARBO registered</div>
                                <div class="activity-meta">Masbate ARB Coop · Yesterday</div>
                            </div>
                        </li>
                        <li class="activity-item">
                            <div class="activity-dot-wrap">
                                <div class="activity-dot ad-blue"><i class="bi bi-gear"></i></div>
                            </div>
                            <div>
                                <div class="activity-title">System settings updated</div>
                                <div class="activity-meta">Super Admin · Yesterday</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

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

        // ── User Growth Chart ─────────────────────────────────
        const ugCtx = document.getElementById('userGrowthChart');
        if (ugCtx) {
            new Chart(ugCtx.getContext('2d'), {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'New Users',
                        data: [12, 28, 35, 62, 58, 85],
                        borderColor: 'rgba(31,128,60,1)',
                        backgroundColor: 'rgba(31,128,60,0.10)',
                        borderWidth: 2.5,
                        tension: 0.38,
                        fill: true,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: 'rgba(31,128,60,1)',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top', align: 'end' },
                        tooltip: { mode: 'index', intersect: false }
                    },
                    scales: {
                        x: { grid: { display: false } },
                        y: { beginAtZero: true }
                    }
                }
            });
        }

        // ── Transactions Chart ────────────────────────────────
        const txCtx = document.getElementById('transactionChart');
        if (txCtx) {
            new Chart(txCtx.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Transactions',
                        data: [98, 145, 172, 210, 198, 245],
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
                        legend: { position: 'top', align: 'end' },
                        tooltip: { mode: 'index', intersect: false }
                    },
                    scales: {
                        x: { grid: { display: false } },
                        y: { beginAtZero: true }
                    }
                }
            });
        }

    });
    </script>

</body>
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
</html>