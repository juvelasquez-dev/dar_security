<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage CARPOS — E-Agraryo Merkado</title>
    <link rel="icon" href="{{ asset('images/dar-logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
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
            --gray-300:   #dee2e6;
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
            font-size: 1.15rem; cursor: pointer; padding: 6px 8px;
            border-radius: 8px; position: relative;
            transition: color 0.18s, background 0.18s; text-decoration: none;
        }
        .nav-icon-btn:hover { color: #fff; background: rgba(255,255,255,0.08); }

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
            position: fixed; top: 62px; left: 0; bottom: 0;
            width: var(--sidebar-w); background: #fff;
            border-right: 1px solid var(--gray-200);
            overflow-y: auto; z-index: 1030;
            display: flex; flex-direction: column;
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
        .sidebar-logout { margin-top: auto; padding-top: 1rem; border-top: 1px solid var(--gray-200); }
        .sidebar-logout .sidebar-link { color: #c0392b; }
        .sidebar-logout .sidebar-link:hover { background: #fdf2f2; color: #c0392b; }
        .sidebar-office-chip {
            background: var(--green-50); border: 1px solid var(--green-200);
            border-radius: var(--radius-sm); padding: 0.65rem 0.85rem; margin-bottom: 1rem;
        }
        .sidebar-office-chip .office-label { font-size: 0.62rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--green-600); }
        .sidebar-office-chip .office-name { font-size: 0.82rem; font-weight: 600; color: var(--green-900); margin-top: 1px; }

        /* ─── Page ──────────────────────────────────────────── */
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
        .page-breadcrumb {
            display: flex; align-items: center; gap: 0.4rem;
            font-size: 0.78rem; color: var(--text-muted); margin-bottom: 0.35rem;
        }
        .page-breadcrumb a { color: var(--green-700); text-decoration: none; font-weight: 500; }
        .page-breadcrumb a:hover { text-decoration: underline; }
        .page-breadcrumb i { font-size: 0.65rem; color: var(--gray-400); }

        /* ─── Stat Cards ────────────────────────────────────── */
        .stat-card {
            background: #fff; border-radius: var(--radius);
            box-shadow: var(--shadow-sm); padding: 1.2rem 1.4rem;
            display: flex; align-items: center; gap: 1rem;
            border: 1px solid var(--gray-200); height: 100%;
            transition: box-shadow 0.22s, transform 0.22s;
        }
        .stat-card:hover { box-shadow: var(--shadow-md); transform: translateY(-3px); }
        .stat-icon-wrap {
            width: 48px; height: 48px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.25rem; flex-shrink: 0;
        }
        .stat-icon-green { background: var(--green-100); color: var(--green-700); }
        .stat-icon-gold  { background: var(--gold-light); color: var(--gold); }
        .stat-icon-blue  { background: #e8f0fe; color: #1a73e8; }
        .stat-icon-red   { background: #fdecea; color: #c0392b; }
        .stat-value { font-size: 1.8rem; font-weight: 700; color: var(--text-main); line-height: 1; margin-bottom: 2px; }
        .stat-label { font-size: 0.8rem; font-weight: 500; color: var(--text-muted); margin: 0; }

        /* ─── Toolbar ───────────────────────────────────────── */
        .toolbar {
            background: #fff; border-radius: var(--radius);
            box-shadow: var(--shadow-sm); border: 1px solid var(--gray-200);
            padding: 1rem 1.25rem;
            display: flex; align-items: center; gap: 0.75rem;
            flex-wrap: wrap; margin-bottom: 1.25rem;
        }
        .search-wrap { position: relative; flex: 1; min-width: 220px; }
        .search-wrap i { position: absolute; left: 0.85rem; top: 50%; transform: translateY(-50%); color: var(--gray-400); font-size: 0.9rem; }
        .search-input {
            font-family: 'DM Sans', sans-serif; font-size: 0.855rem;
            border: 1.5px solid var(--gray-200); border-radius: var(--radius-sm);
            padding: 0.52rem 0.85rem 0.52rem 2.3rem;
            color: var(--text-main); width: 100%; transition: border-color 0.18s, box-shadow 0.18s;
        }
        .search-input:focus { border-color: var(--green-500); box-shadow: 0 0 0 3px rgba(31,128,60,0.1); outline: none; }
        .search-input::placeholder { color: var(--gray-400); }

        .filter-select {
            font-family: 'DM Sans', sans-serif; font-size: 0.845rem;
            border: 1.5px solid var(--gray-200); border-radius: var(--radius-sm);
            padding: 0.52rem 2rem 0.52rem 0.85rem;
            color: var(--text-main); background: #fff; cursor: pointer;
            transition: border-color 0.18s; min-width: 160px;
        }
        .filter-select:focus { border-color: var(--green-500); box-shadow: 0 0 0 3px rgba(31,128,60,0.1); outline: none; }

        .btn-primary-green {
            background: linear-gradient(135deg, var(--green-700), var(--green-500));
            color: #fff; border: none;
            padding: 0.54rem 1.2rem; border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif; font-size: 0.845rem; font-weight: 600;
            cursor: pointer; display: inline-flex; align-items: center; gap: 0.45rem;
            text-decoration: none; white-space: nowrap;
            box-shadow: 0 2px 10px rgba(31,128,60,0.2);
            transition: opacity 0.18s, transform 0.18s;
        }
        .btn-primary-green:hover { opacity: 0.9; transform: translateY(-1px); color: #fff; }

        .btn-outline-sm {
            background: #fff; color: var(--gray-600);
            border: 1.5px solid var(--gray-200); padding: 0.5rem 1rem;
            border-radius: var(--radius-sm); font-family: 'DM Sans', sans-serif;
            font-size: 0.82rem; font-weight: 600; cursor: pointer;
            display: inline-flex; align-items: center; gap: 0.4rem;
            transition: all 0.15s; text-decoration: none; white-space: nowrap;
        }
        .btn-outline-sm:hover { background: var(--gray-100); border-color: var(--gray-300); color: var(--gray-800); }

        /* ─── Table Card ────────────────────────────────────── */
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

        .arbo-table { width: 100%; border-collapse: collapse; font-size: 0.84rem; }
        .arbo-table thead th {
            background: var(--green-50); color: var(--green-800);
            font-weight: 700; font-size: 0.72rem; letter-spacing: 0.05em;
            text-transform: uppercase; padding: 0.7rem 1.1rem;
            border-bottom: 1px solid var(--green-200); white-space: nowrap;
        }
        .arbo-table tbody tr { border-bottom: 1px solid var(--gray-100); transition: background 0.14s; }
        .arbo-table tbody tr:last-child { border-bottom: none; }
        .arbo-table tbody tr:hover { background: var(--gray-50); }
        .arbo-table td { padding: 0.78rem 1.1rem; vertical-align: middle; color: var(--text-main); }

        .user-cell { display: flex; align-items: center; gap: 0.65rem; }
        .user-avatar-sm {
            width: 34px; height: 34px; border-radius: 50%;
            object-fit: cover; flex-shrink: 0;
            border: 1.5px solid var(--green-200);
        }
        .user-name { font-weight: 600; color: var(--green-800); font-size: 0.855rem; }
        .user-email { font-size: 0.72rem; color: var(--text-muted); margin-top: 1px; }

        .branch-chip {
            display: inline-flex; align-items: center; gap: 5px;
            background: var(--green-50); color: var(--green-700);
            border: 1px solid var(--green-200);
            padding: 3px 10px; border-radius: 20px;
            font-size: 0.72rem; font-weight: 600;
        }

        .status-badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 3px 10px; border-radius: 20px;
            font-size: 0.72rem; font-weight: 600;
        }
        .status-active   { background: var(--green-100); color: var(--green-700); }
        .status-inactive { background: #fdecea; color: #c0392b; }
        .status-pending  { background: var(--gold-light); color: var(--gold); }
        .status-dot { width: 6px; height: 6px; border-radius: 50%; display: inline-block; }
        .status-active   .status-dot { background: var(--green-600); }
        .status-inactive .status-dot { background: #c0392b; }
        .status-pending  .status-dot { background: var(--gold); }

        /* ─── Action Buttons ────────────────────────────────── */
        .action-btn {
            background: none; border: 1.5px solid transparent;
            padding: 5px 9px; border-radius: 7px;
            font-size: 0.85rem; cursor: pointer;
            transition: all 0.15s; line-height: 1;
            display: inline-flex; align-items: center;
        }
        .action-btn-edit  { color: #1a73e8; }
        .action-btn-edit:hover  { background: #e8f0fe; border-color: #1a73e8; }
        .action-btn-view  { color: var(--green-700); }
        .action-btn-view:hover  { background: var(--green-100); border-color: var(--green-500); }
        .action-btn-deactivate { color: var(--gold); }
        .action-btn-deactivate:hover { background: var(--gold-light); border-color: var(--gold); }
        .action-btn-delete { color: #c0392b; }
        .action-btn-delete:hover { background: #fdecea; border-color: #c0392b; }

        /* ─── Empty State ───────────────────────────────────── */
        .empty-state {
            text-align: center; padding: 4rem 2rem;
            color: var(--text-muted);
        }
        .empty-state i { font-size: 2.5rem; color: var(--gray-300); margin-bottom: 1rem; display: block; }
        .empty-state h6 { font-size: 0.9rem; font-weight: 600; color: var(--gray-600); margin-bottom: 0.35rem; }
        .empty-state p { font-size: 0.8rem; margin: 0; }

        /* ─── Pagination ────────────────────────────────────── */
        .pagination-wrap {
            padding: 1rem 1.25rem;
            border-top: 1px solid var(--gray-200);
            display: flex; align-items: center; justify-content: space-between;
            flex-wrap: wrap; gap: 0.75rem;
        }
        .pagination-info { font-size: 0.78rem; color: var(--text-muted); }
        .pagination { margin: 0; gap: 3px; }
        .page-link {
            font-family: 'DM Sans', sans-serif; font-size: 0.8rem; font-weight: 500;
            color: var(--green-700); border: 1.5px solid var(--gray-200);
            border-radius: var(--radius-sm) !important; padding: 0.38rem 0.7rem;
            transition: all 0.15s;
        }
        .page-link:hover { background: var(--green-100); border-color: var(--green-300, #7ecfa0); color: var(--green-700); }
        .page-item.active .page-link { background: var(--green-600); border-color: var(--green-600); color: #fff; }
        .page-item.disabled .page-link { color: var(--gray-400); }

        /* ─── Modal ─────────────────────────────────────────── */
        .modal-content { border: none; border-radius: var(--radius); overflow: hidden; }
        .modal-header-green {
            background: linear-gradient(135deg, var(--green-900), var(--green-700));
            padding: 1.25rem 1.5rem;
            display: flex; align-items: center; justify-content: space-between;
        }
        .modal-header-green .modal-title { font-family: 'DM Serif Display', serif; font-size: 1.1rem; color: #fff; margin: 0; }
        .modal-header-green .btn-close { filter: invert(1); opacity: 0.7; }
        .modal-header-green .btn-close:hover { opacity: 1; }
        .modal-body { padding: 1.5rem; }
        .modal-footer { padding: 1rem 1.5rem; border-top: 1px solid var(--gray-200); gap: 0.5rem; }

        .detail-row { display: flex; gap: 1rem; margin-bottom: 1rem; }
        .detail-label { font-size: 0.73rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; color: var(--gray-400); margin-bottom: 2px; }
        .detail-value { font-size: 0.875rem; font-weight: 500; color: var(--text-main); }

        /* ─── Mobile ─────────────────────────────────────────── */
        .mobile-sidebar-toggle {
            display: none; background: none; border: none; color: #fff;
            font-size: 1.3rem; margin-right: 0.75rem; cursor: pointer;
        }
        .sidebar-overlay {
            display: none; position: fixed; inset: 0;
            background: rgba(0,0,0,0.4); z-index: 1029;
        }

        @media (max-width: 991.98px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .sidebar-overlay.show { display: block; }
            .page-wrapper { margin-left: 0; padding: 1.25rem 1rem 3rem; }
            .mobile-sidebar-toggle { display: block; }
            .navbar-page-badge { display: none; }
        }

        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb { background: var(--gray-200); border-radius: 4px; }
    </style>
</head>
<body>

    <!-- ── Top Navbar ──────────────────────────────────────── -->
    <header class="top-navbar">
        <button class="mobile-sidebar-toggle" id="sidebarToggle"><i class="bi bi-list"></i></button>
        <a class="navbar-brand-area" href="{{ url('/dashboard') }}">
            <img src="{{ asset('images/dar-logo.png') }}" alt="DAR Logo">
            <div>
                <div class="navbar-system-title">E-Agraryo Merkado</div>
                <div class="navbar-system-sub">DAR Region V</div>
            </div>
        </a>
        <span class="navbar-page-badge"><i class="bi bi-shield-fill-check me-1"></i> Super Admin</span>
        <div class="navbar-right">
            <div class="dropdown">
                <button class="nav-icon-btn" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="min-width:280px; border-radius:12px; margin-top:8px;">
                    <li class="px-3 py-2 border-bottom"><span class="fw-bold" style="font-size:.82rem;">Notifications</span></li>
                    <li><a class="dropdown-item py-2" href="#" style="font-size:.82rem;"><i class="bi bi-person-plus text-success me-2"></i>New user registered <div class="text-muted" style="font-size:.72rem; padding-left:1.4rem;">2 hours ago</div></a></li>
                    <li class="border-top"><a class="dropdown-item text-center py-2" href="#" style="font-size:.78rem; color:var(--green-700);">View all</a></li>
                </ul>
            </div>
            <div class="navbar-divider d-none d-sm-block"></div>
            <div class="dropdown">
                <a class="user-pill dropdown-toggle" href="#" data-bs-toggle="dropdown">
                    <img class="user-avatar" src="{{ auth()->user()->avatar ?: 'https://ui-avatars.com/api/?name='.urlencode(auth()->user()->name ?? 'Super Admin').'&background=1a6932&color=fff&rounded=true&size=64' }}" alt="avatar">
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

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- ── Sidebar ─────────────────────────────────────────── -->
    <aside class="sidebar" id="mainSidebar">
        <div class="sidebar-inner">
            <div class="sidebar-office-chip">
                <div class="office-label">Role</div>
                <div class="office-name">Super Admin</div>
            </div>
            <span class="sidebar-section-label">Main Menu</span>
            <a href="{{ url('/dashboard') }}" class="sidebar-link"><i class="bi bi-speedometer2"></i> Dashboard</a>
            <a href="{{ url('/roles') }}" class="sidebar-link"><i class="bi bi-person-badge"></i> User Roles</a>
            <a href="{{ url('/branches') }}" class="sidebar-link active"><i class="bi bi-building"></i> Branches <span class="sidebar-link-badge">8</span></a>
            <a href="{{ url('/marketplace') }}" class="sidebar-link"><i class="bi bi-shop"></i> ARBOS Marketplace</a>
            <a href="{{ url('/orders') }}" class="sidebar-link"><i class="bi bi-cart-check"></i> Orders</a>
            <a href="{{ url('/logs') }}" class="sidebar-link"><i class="bi bi-clock-history"></i> Activity Logs</a>
            <span class="sidebar-section-label">Reports</span>
            <a href="{{ url('/reports') }}" class="sidebar-link"><i class="bi bi-bar-chart-line"></i> Reports</a>
            <span class="sidebar-section-label">System</span>
            <a href="{{ url('/settings') }}" class="sidebar-link"><i class="bi bi-gear"></i> Settings</a>
            <div class="sidebar-logout">
                <form method="POST" action="{{ url('/logout') }}">
                    @csrf
                    <button type="submit" class="sidebar-link w-100 text-start border-0 bg-transparent">
                        <i class="bi bi-box-arrow-right"></i> Logout
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- ── Main Content ─────────────────────────────────────── -->
    <main class="page-wrapper">

        <!-- Header -->
        <div class="page-header">
            <div>
                <div class="page-breadcrumb">
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                    <i class="bi bi-chevron-right"></i>
                    <span>Manage CARPOS</span>
                </div>
                <h1 class="page-header-title">Manage CARPOS Admins</h1>
                <p class="page-header-sub">View, edit, and manage all registered CARPOS-PBD administrators across branches.</p>
            </div>
            <a href="{{ url('/carpos/register') }}" class="btn-primary-green">
                <i class="bi bi-person-plus-fill"></i> Register New Admin
            </a>
        </div>

        <!-- Stat Cards -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon-wrap stat-icon-green"><i class="bi bi-people-fill"></i></div>
                    <div>
                        <div class="stat-value">{{ $totalCarpos ?? '—' }}</div>
                        <p class="stat-label">Total CARPOS Admins</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon-wrap stat-icon-gold"><i class="bi bi-person-check-fill"></i></div>
                    <div>
                        <div class="stat-value">{{ $activeCarpos ?? '—' }}</div>
                        <p class="stat-label">Active</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon-wrap stat-icon-blue"><i class="bi bi-building-fill"></i></div>
                    <div>
                        <div class="stat-value">8</div>
                        <p class="stat-label">Branches Covered</p>
                    </div>
                </div>
            </div>
            <div class="col-6 col-xl-3">
                <div class="stat-card">
                    <div class="stat-icon-wrap stat-icon-red"><i class="bi bi-person-x-fill"></i></div>
                    <div>
                        <div class="stat-value">{{ $inactiveCarpos ?? '—' }}</div>
                        <p class="stat-label">Inactive</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Toolbar -->
        <div class="toolbar">
            <div class="search-wrap">
                <i class="bi bi-search"></i>
                <input type="text" class="search-input" id="searchInput" placeholder="Search by name, email, or branch…">
            </div>
            <select class="filter-select" id="branchFilter">
                <option value="">All Branches</option>
                <option value="Regional Office">Regional Office</option>
                <option value="Albay">Albay</option>
                <option value="Catanduanes">Catanduanes</option>
                <option value="Camarines Sur 1">Camarines Sur 1</option>
                <option value="Camarines Sur 2">Camarines Sur 2</option>
                <option value="Masbate">Masbate</option>
                <option value="Sorsogon">Sorsogon</option>
                <option value="Camarines Norte">Camarines Norte</option>
            </select>
            <select class="filter-select" id="statusFilter">
                <option value="">All Status</option>
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
                <option value="Pending">Pending</option>
            </select>
            <button class="btn-outline-sm" id="exportBtn">
                <i class="bi bi-download"></i> Export
            </button>
        </div>

        <!-- Table Card -->
        <div class="table-card">
            <div class="table-card-header">
                <h6 class="table-card-title">
                    <i class="bi bi-person-badge-fill"></i>
                    CARPOS Administrators
                </h6>
                <span style="font-size:.78rem; color:var(--text-muted);" id="recordCount">
                    Showing <strong id="shownCount">—</strong> of <strong id="totalCount">—</strong> records
                </span>
            </div>

            <div class="table-responsive">
                <table class="arbo-table" id="carposTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Administrator</th>
                            <th>Contact</th>
                            <th>Branch</th>
                            <th>Status</th>
                            <th>Registered</th>
                            <th style="text-align:center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse($carposAdmins ?? [] as $index => $admin)
                        <tr data-name="{{ strtolower($admin->name) }}" data-email="{{ strtolower($admin->email) }}" data-branch="{{ $admin->branch }}" data-status="{{ $admin->status }}">
                            <td style="color:var(--text-muted); font-size:.78rem;">{{ $index + 1 }}</td>
                            <td>
                                <div class="user-cell">
                                    <img class="user-avatar-sm"
                                        src="{{ $admin->avatar ?: 'https://ui-avatars.com/api/?name='.urlencode($admin->name).'&background=1a6932&color=fff&rounded=true&size=64' }}"
                                        alt="{{ $admin->name }}">
                                    <div>
                                        <div class="user-name">{{ $admin->name }}</div>
                                        <div class="user-email">{{ $admin->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td style="font-size:.82rem;">{{ $admin->contact ?? '—' }}</td>
                            <td>
                                <span class="branch-chip">
                                    <i class="bi bi-building" style="font-size:.7rem;"></i>
                                    {{ $admin->branch ?? '—' }}
                                </span>
                            </td>
                            <td>
                                @if($admin->status === 'Active')
                                    <span class="status-badge status-active"><span class="status-dot"></span> Active</span>
                                @elseif($admin->status === 'Inactive')
                                    <span class="status-badge status-inactive"><span class="status-dot"></span> Inactive</span>
                                @else
                                    <span class="status-badge status-pending"><span class="status-dot"></span> Pending</span>
                                @endif
                            </td>
                            <td style="font-size:.8rem; color:var(--text-muted);">{{ $admin->created_at ? $admin->created_at->format('M d, Y') : '—' }}</td>
                            <td style="text-align:center;">
                                <div style="display:flex; gap:4px; justify-content:center;">
                                    <button class="action-btn action-btn-view" title="View Details"
                                        onclick="viewAdmin({{ json_encode(['name'=>$admin->name,'email'=>$admin->email,'contact'=>$admin->contact,'branch'=>$admin->branch,'status'=>$admin->status,'address'=>$admin->address,'created_at'=>$admin->created_at?->format('M d, Y')]) }})">
                                        <i class="bi bi-eye-fill"></i>
                                    </button>
                                    <a href="{{ url('/carpos/'.$admin->id.'/edit') }}" class="action-btn action-btn-edit" title="Edit">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <button class="action-btn action-btn-deactivate" title="Toggle Status"
                                        onclick="toggleStatus({{ $admin->id }}, '{{ $admin->status }}')">
                                        <i class="bi bi-toggle-{{ $admin->status === 'Active' ? 'on' : 'off' }}"></i>
                                    </button>
                                    <button class="action-btn action-btn-delete" title="Delete"
                                        onclick="confirmDelete({{ $admin->id }}, '{{ addslashes($admin->name) }}')">
                                        <i class="bi bi-trash3-fill"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr id="emptyRow">
                            <td colspan="7">
                                <div class="empty-state">
                                    <i class="bi bi-people"></i>
                                    <h6>No CARPOS Admins Found</h6>
                                    <p>No administrators have been registered yet. <a href="{{ url('/carpos/register') }}" style="color:var(--green-700); font-weight:600;">Register one now →</a></p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if(isset($carposAdmins) && $carposAdmins->hasPages())
            <div class="pagination-wrap">
                <div class="pagination-info">
                    Showing {{ $carposAdmins->firstItem() }}–{{ $carposAdmins->lastItem() }} of {{ $carposAdmins->total() }} administrators
                </div>
                <nav>
                    <ul class="pagination pagination-sm">
                        <li class="page-item {{ $carposAdmins->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $carposAdmins->previousPageUrl() }}"><i class="bi bi-chevron-left"></i></a>
                        </li>
                        @foreach($carposAdmins->links()->elements[0] as $page => $url)
                        <li class="page-item {{ $carposAdmins->currentPage() == $page ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                        @endforeach
                        <li class="page-item {{ $carposAdmins->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $carposAdmins->nextPageUrl() }}"><i class="bi bi-chevron-right"></i></a>
                        </li>
                    </ul>
                </nav>
            </div>
            @endif
        </div>
    </main>

    <!-- ── View Admin Modal ─────────────────────────────────── -->
    <div class="modal fade" id="viewModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header-green">
                    <h5 class="modal-title"><i class="bi bi-person-badge-fill me-2"></i>Admin Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div style="display:flex; align-items:center; gap:1rem; margin-bottom:1.5rem;">
                        <img id="modalAvatar" src="" alt="avatar" style="width:56px;height:56px;border-radius:50%;object-fit:cover;border:2px solid var(--green-200);">
                        <div>
                            <div style="font-size:1rem;font-weight:700;color:var(--green-900);" id="modalName"></div>
                            <div style="font-size:.78rem;color:var(--text-muted);" id="modalEmail"></div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="detail-label">Contact</div>
                            <div class="detail-value" id="modalContact">—</div>
                        </div>
                        <div class="col-6">
                            <div class="detail-label">Branch</div>
                            <div class="detail-value" id="modalBranch">—</div>
                        </div>
                        <div class="col-6">
                            <div class="detail-label">Status</div>
                            <div class="detail-value" id="modalStatus">—</div>
                        </div>
                        <div class="col-6">
                            <div class="detail-label">Registered</div>
                            <div class="detail-value" id="modalDate">—</div>
                        </div>
                        <div class="col-12">
                            <div class="detail-label">Address</div>
                            <div class="detail-value" id="modalAddress">—</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-outline-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ── Delete Confirm Modal ─────────────────────────────── -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center" style="padding:2rem 1.5rem;">
                    <div style="width:54px;height:54px;border-radius:50%;background:#fdecea;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;font-size:1.5rem;color:#c0392b;">
                        <i class="bi bi-trash3-fill"></i>
                    </div>
                    <h6 style="font-weight:700;margin-bottom:.35rem;">Delete Admin?</h6>
                    <p style="font-size:.82rem;color:var(--text-muted);margin-bottom:1.25rem;">
                        You are about to remove <strong id="deleteAdminName"></strong>. This action cannot be undone.
                    </p>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <div style="display:flex;gap:.5rem;justify-content:center;">
                            <button type="button" class="btn-outline-sm" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" style="background:#c0392b;color:#fff;border:none;padding:.52rem 1.2rem;border-radius:var(--radius-sm);font-family:'DM Sans',sans-serif;font-size:.845rem;font-weight:600;cursor:pointer;">
                                Yes, Delete
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {

        // ── Sidebar toggle ────────────────────────────────────
        const toggle  = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('mainSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        if (toggle)  toggle.addEventListener('click',  () => { sidebar.classList.add('show'); overlay.classList.add('show'); document.body.style.overflow='hidden'; });
        if (overlay) overlay.addEventListener('click', () => { sidebar.classList.remove('show'); overlay.classList.remove('show'); document.body.style.overflow=''; });

        // ── Live search + filter ──────────────────────────────
        const searchInput  = document.getElementById('searchInput');
        const branchFilter = document.getElementById('branchFilter');
        const statusFilter = document.getElementById('statusFilter');
        const rows = document.querySelectorAll('#tableBody tr[data-name]');
        const shownCount = document.getElementById('shownCount');
        const totalCount = document.getElementById('totalCount');
        totalCount.textContent = rows.length;

        function applyFilters() {
            const q      = searchInput.value.toLowerCase();
            const branch = branchFilter.value.toLowerCase();
            const status = statusFilter.value.toLowerCase();
            let shown = 0;
            rows.forEach(row => {
                const name   = row.dataset.name  || '';
                const email  = row.dataset.email || '';
                const rb     = (row.dataset.branch || '').toLowerCase();
                const rs     = (row.dataset.status || '').toLowerCase();
                const match  = (!q      || name.includes(q) || email.includes(q) || rb.includes(q))
                             && (!branch || rb === branch)
                             && (!status || rs === status);
                row.style.display = match ? '' : 'none';
                if (match) shown++;
            });
            shownCount.textContent = shown;
        }

        if (rows.length) {
            shownCount.textContent = rows.length;
            searchInput.addEventListener('input', applyFilters);
            branchFilter.addEventListener('change', applyFilters);
            statusFilter.addEventListener('change', applyFilters);
        }
    });

    // ── View Admin Modal ──────────────────────────────────────
    function viewAdmin(data) {
        document.getElementById('modalName').textContent    = data.name    || '—';
        document.getElementById('modalEmail').textContent   = data.email   || '—';
        document.getElementById('modalContact').textContent = data.contact || '—';
        document.getElementById('modalBranch').textContent  = data.branch  || '—';
        document.getElementById('modalStatus').textContent  = data.status  || '—';
        document.getElementById('modalDate').textContent    = data.created_at || '—';
        document.getElementById('modalAddress').textContent = data.address  || '—';
        document.getElementById('modalAvatar').src =
            'https://ui-avatars.com/api/?name=' + encodeURIComponent(data.name) + '&background=1a6932&color=fff&rounded=true&size=128';
        new bootstrap.Modal(document.getElementById('viewModal')).show();
    }

    // ── Delete Confirm Modal ──────────────────────────────────
    function confirmDelete(id, name) {
        document.getElementById('deleteAdminName').textContent = name;
        document.getElementById('deleteForm').action = '/carpos/' + id;
        new bootstrap.Modal(document.getElementById('deleteModal')).show();
    }

    // ── Toggle Status (AJAX-ready) ────────────────────────────
    function toggleStatus(id, currentStatus) {
        if (!confirm('Toggle status for this admin?')) return;
        fetch('/carpos/' + id + '/toggle-status', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.content || '', 'Accept': 'application/json' }
        }).then(r => r.json()).then(() => location.reload()).catch(() => location.reload());
    }
    </script>

</body>
</html>