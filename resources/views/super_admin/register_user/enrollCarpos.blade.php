<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register CARPOS — E-Agraryo Merkado</title>
    <link rel="icon" href="{{ asset('images/dar-logo.png') }}" type="image/png">
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
            text-decoration: none;
        }

        .nav-icon-btn:hover {
            color: #fff;
            background: rgba(255,255,255,0.08);
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
            left: -3px; top: 20%; bottom: 20%;
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

        /* ─── Breadcrumb ────────────────────────────────────── */
        .page-breadcrumb {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.78rem;
            color: var(--text-muted);
            margin-bottom: 0.35rem;
        }

        .page-breadcrumb a {
            color: var(--green-700);
            text-decoration: none;
            font-weight: 500;
        }

        .page-breadcrumb a:hover { text-decoration: underline; }
        .page-breadcrumb i { font-size: 0.65rem; color: var(--gray-400); }

        /* ─── Form Card ─────────────────────────────────────── */
        .form-card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow-md);
            border: 1px solid var(--gray-200);
            overflow: hidden;
            max-width: 100%; /* Updated to make the card wider */
        }

        .form-card-header {
            background: linear-gradient(135deg, var(--green-900) 0%, var(--green-700) 100%);
            padding: 1.5rem 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .form-card-header-icon {
            width: 46px; height: 46px;
            border-radius: 12px;
            background: rgba(255,255,255,0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: #fff;
            flex-shrink: 0;
        }

        .form-card-header-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.25rem;
            color: #fff;
            margin: 0 0 2px;
            line-height: 1.2;
        }

        .form-card-header-sub {
            font-size: 0.75rem;
            color: var(--green-200);
            margin: 0;
        }

        .form-card-body {
            padding: 2rem 3rem; /* Added more padding for better spacing */
        }

        /* ─── Form Fields ───────────────────────────────────── */
        .form-section-label {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--gray-400);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-section-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--gray-200);
        }

        .form-label {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 0.4rem;
        }

        .form-label .req {
            color: #dc3545;
            margin-left: 2px;
        }

        .form-control, .form-select {
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            border: 1.5px solid var(--gray-200);
            border-radius: var(--radius-sm);
            padding: 0.58rem 0.85rem;
            color: var(--text-main);
            transition: border-color 0.18s, box-shadow 0.18s;
            background: #fff;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--green-500);
            box-shadow: 0 0 0 3px rgba(31,128,60,0.1);
            outline: none;
        }

        .form-control::placeholder { color: var(--gray-400); }

        .input-icon-wrap {
            position: relative;
        }

        .input-icon-wrap .input-icon {
            position: absolute;
            left: 0.85rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            font-size: 0.9rem;
            pointer-events: none;
        }

        .input-icon-wrap textarea ~ .input-icon {
            top: 0.75rem;
            transform: none;
        }

        .input-icon-wrap .form-control,
        .input-icon-wrap .form-select {
            padding-left: 2.4rem;
        }

        .input-icon-wrap textarea.form-control {
            padding-left: 2.4rem;
        }

        .form-hint {
            font-size: 0.73rem;
            color: var(--text-muted);
            margin-top: 0.3rem;
        }

        /* ─── Password Toggle ───────────────────────────────── */
        .password-wrap { position: relative; }

        .password-toggle {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gray-400);
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            font-size: 0.95rem;
            transition: color 0.15s;
            line-height: 1;
        }

        .password-toggle:hover { color: var(--green-600); }

        /* ─── Branch Select ─────────────────────────────────── */
        .branch-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.6rem;
        }

        .branch-option {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.6rem 0.85rem;
            border: 1.5px solid var(--gray-200);
            border-radius: var(--radius-sm);
            cursor: pointer;
            transition: all 0.15s;
            font-size: 0.82rem;
            font-weight: 500;
            color: var(--text-muted);
            user-select: none;
        }

        .branch-option:hover {
            border-color: var(--green-300, #7ecfa0);
            background: var(--green-50);
            color: var(--green-700);
        }

        .branch-option input[type="radio"] { display: none; }

        .branch-option.selected {
            border-color: var(--green-500);
            background: var(--green-100);
            color: var(--green-800);
            font-weight: 600;
        }

        .branch-option .branch-dot {
            width: 16px; height: 16px;
            border-radius: 50%;
            border: 2px solid var(--gray-300, #dee2e6);
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.15s;
        }

        .branch-option.selected .branch-dot {
            border-color: var(--green-600);
            background: var(--green-600);
        }

        .branch-option.selected .branch-dot::after {
            content: '';
            width: 6px; height: 6px;
            border-radius: 50%;
            background: #fff;
        }

        /* ─── Form Actions ──────────────────────────────────── */
        .form-actions {
            display: flex;
            gap: 0.75rem;
            align-items: center;
            padding-top: 1.5rem;
            border-top: 1px solid var(--gray-200);
            flex-wrap: wrap;
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--green-700) 0%, var(--green-500) 100%);
            color: #fff;
            border: none;
            padding: 0.65rem 1.75rem;
            border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: opacity 0.18s, transform 0.18s, box-shadow 0.18s;
            box-shadow: 0 3px 12px rgba(31,128,60,0.25);
        }

        .btn-submit:hover {
            opacity: 0.92;
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(31,128,60,0.3);
        }

        .btn-submit:active {
            transform: translateY(0);
            box-shadow: none;
        }

        .btn-cancel {
            background: var(--gray-100);
            color: var(--gray-600);
            border: 1.5px solid var(--gray-200);
            padding: 0.62rem 1.4rem;
            border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            transition: background 0.15s, border-color 0.15s;
        }

        .btn-cancel:hover {
            background: var(--gray-200);
            border-color: var(--gray-300, #dee2e6);
            color: var(--gray-800);
        }

        /* ─── Info Box ──────────────────────────────────────── */
        .info-box {
            background: var(--green-50);
            border: 1px solid var(--green-200);
            border-radius: var(--radius-sm);
            padding: 0.85rem 1rem;
            display: flex;
            gap: 0.7rem;
            align-items: flex-start;
            font-size: 0.8rem;
            color: var(--green-800);
            margin-bottom: 1.5rem;
        }

        .info-box i { color: var(--green-600); font-size: 1rem; flex-shrink: 0; margin-top: 1px; }

        /* ─── Alert / Validation ────────────────────────────── */
        .alert-field {
            font-size: 0.73rem;
            color: #dc3545;
            margin-top: 0.3rem;
            display: flex;
            align-items: center;
            gap: 4px;
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
            .branch-grid { grid-template-columns: 1fr; }
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
                <button class="nav-icon-btn" data-bs-toggle="dropdown" aria-label="Notifications">
                    <i class="bi bi-bell"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="min-width:280px; border-radius:12px; margin-top:8px;">
                    <li class="px-3 py-2 border-bottom">
                        <span class="fw-bold" style="font-size:.82rem;">Notifications</span>
                    </li>
                    <li><a class="dropdown-item py-2" href="#" style="font-size:.82rem;">
                        <i class="bi bi-person-plus text-success me-2"></i> New user registered
                        <div class="text-muted" style="font-size:.72rem; padding-left:1.4rem;">2 hours ago</div>
                    </a></li>
                    <li class="border-top">
                        <a class="dropdown-item text-center py-2" href="#" style="font-size:.78rem; color: var(--green-700);">View all</a>
                    </li>
                </ul>
            </div>

            <div class="navbar-divider d-none d-sm-block"></div>

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

    <!-- ── Sidebar Overlay ──────────────────────────────────── -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- ── Sidebar ─────────────────────────────────────────── -->
    <aside class="sidebar" id="mainSidebar">
        <div class="sidebar-inner">
            <div class="sidebar-office-chip">
                <div class="office-label">Role</div>
                <div class="office-name">Super Admin</div>
            </div>

            <span class="sidebar-section-label">Main Menu</span>

            <a href="{{ url('/dashboard') }}" class="sidebar-link">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ url('/roles') }}" class="sidebar-link">
                <i class="bi bi-person-badge"></i> User Roles
            </a>
            <a href="{{ url('/branches') }}" class="sidebar-link active">
                <i class="bi bi-building"></i> Branches
                <span class="sidebar-link-badge">8</span>
            </a>
            <a href="{{ url('/marketplace') }}" class="sidebar-link">
                <i class="bi bi-shop"></i> ARBOS Marketplace
            </a>
            <a href="{{ url('/orders') }}" class="sidebar-link">
                <i class="bi bi-cart-check"></i> Orders
            </a>
            <a href="{{ url('/logs') }}" class="sidebar-link">
                <i class="bi bi-clock-history"></i> Activity Logs
            </a>

            <span class="sidebar-section-label">Reports</span>
            <a href="{{ url('/reports') }}" class="sidebar-link">
                <i class="bi bi-bar-chart-line"></i> Reports
            </a>

            <span class="sidebar-section-label">System</span>
            <a href="{{ url('/settings') }}" class="sidebar-link">
                <i class="bi bi-gear"></i> Settings
            </a>

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

        <!-- Page Header -->
        <div class="page-header">
            <div>
                <div class="page-breadcrumb">
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                    <i class="bi bi-chevron-right"></i>
                    <a href="{{ url('/branches') }}">Branches</a>
                    <i class="bi bi-chevron-right"></i>
                    <span>Register CARPOS Admin</span>
                </div>
                <h1 class="page-header-title">Register CARPOS Admin</h1>
                <p class="page-header-sub">Enroll a new CARPOS-PBD administrator for a branch office.</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="form-card">

            <!-- Card Header -->
            <div class="form-card-header">
                <div class="form-card-header-icon">
                    <i class="bi bi-person-badge-fill"></i>
                </div>
                <div>
                    <div class="form-card-header-title">New CARPOS Admin</div>
                    <div class="form-card-header-sub">Fill in the details below to register a new administrator.</div>
                </div>
            </div>

            <!-- Card Body -->
            <div class="form-card-body">

                <div class="info-box">
                    <i class="bi bi-info-circle-fill"></i>
                    <div>The registered admin will receive an email with their login credentials. Ensure all details are accurate before submitting.</div>
                </div>

                <form action="{{ url('/carpos/register') }}" method="POST" id="registerForm">
                    @csrf

                    <!-- Personal Info -->
                    <div class="form-section-label">Personal Information</div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Full Name <span class="req">*</span></label>
                            <div class="input-icon-wrap">
                                <i class="bi bi-person input-icon"></i>
                                <input
                                    type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    id="name"
                                    name="name"
                                    placeholder="e.g. Juan dela Cruz"
                                    value="{{ old('name') }}"
                                    required
                                >
                            </div>
                            @error('name')
                                <div class="alert-field"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">Email Address <span class="req">*</span></label>
                            <div class="input-icon-wrap">
                                <i class="bi bi-envelope input-icon"></i>
                                <input
                                    type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    id="email"
                                    name="email"
                                    placeholder="e.g. juan@dar.gov.ph"
                                    value="{{ old('email') }}"
                                    required
                                >
                            </div>
                            @error('email')
                                <div class="alert-field"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="contact" class="form-label">Contact Number <span class="req">*</span></label>
                            <div class="input-icon-wrap">
                                <i class="bi bi-telephone input-icon"></i>
                                <input
                                    type="text"
                                    class="form-control @error('contact') is-invalid @enderror"
                                    id="contact"
                                    name="contact"
                                    placeholder="e.g. 09XX-XXX-XXXX"
                                    value="{{ old('contact') }}"
                                    required
                                >
                            </div>
                            @error('contact')
                                <div class="alert-field"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label">Temporary Password <span class="req">*</span></label>
                            <div class="input-icon-wrap password-wrap">
                                <i class="bi bi-lock input-icon"></i>
                                <input
                                    type="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    id="password"
                                    name="password"
                                    placeholder="Min. 8 characters"
                                    required
                                >
                                <button type="button" class="password-toggle" id="togglePassword" tabindex="-1">
                                    <i class="bi bi-eye" id="toggleIcon"></i>
                                </button>
                            </div>
                            <div class="form-hint">Admin will be prompted to change this on first login.</div>
                            @error('password')
                                <div class="alert-field"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="address" class="form-label">Office Address <span class="req">*</span></label>
                        <div class="input-icon-wrap">
                            <i class="bi bi-geo-alt input-icon"></i>
                            <textarea
                                class="form-control @error('address') is-invalid @enderror"
                                id="address"
                                name="address"
                                rows="3"
                                placeholder="Enter full office address"
                                required
                            >{{ old('address') }}</textarea>
                        </div>
                        @error('address')
                            <div class="alert-field"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Branch Assignment -->
                    <div class="form-section-label">Branch Assignment</div>

                    <div class="mb-4">
                        <label class="form-label">Assign to Branch <span class="req">*</span></label>
                        <div class="branch-grid" id="branchGrid">
                            @php
                                $branches = [
                                    'regional-office' => 'Regional Office',
                                    'albay'           => 'Albay',
                                    'catanduanes'     => 'Catanduanes',
                                    'camarines-sur-1' => 'Camarines Sur 1',
                                    'camarines-sur-2' => 'Camarines Sur 2',
                                    'masbate'         => 'Masbate',
                                    'sorsogon'        => 'Sorsogon',
                                    'camarines-norte' => 'Camarines Norte',
                                ];
                            @endphp

                            @foreach($branches as $value => $label)
                            <label class="branch-option {{ old('branch') === $value ? 'selected' : '' }}">
                                <input type="radio" name="branch" value="{{ $value }}" {{ old('branch') === $value ? 'checked' : '' }} required>
                                <span class="branch-dot"></span>
                                <i class="bi bi-building" style="font-size:.85rem; color: var(--green-600);"></i>
                                {{ $label }}
                            </label>
                            @endforeach
                        </div>
                        @error('branch')
                            <div class="alert-field mt-2"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Actions -->
                    <div class="form-actions">
                        <button type="submit" class="btn-submit">
                            <i class="bi bi-person-check-fill"></i>
                            Register Admin
                        </button>
                        <a href="{{ url('/branches') }}" class="btn-cancel">
                            <i class="bi bi-x-lg"></i>
                            Cancel
                        </a>
                        <span style="margin-left:auto; font-size:.73rem; color:var(--text-muted);">
                            <i class="bi bi-asterisk" style="font-size:.6rem; color:#dc3545;"></i> Required fields
                        </span>
                    </div>
                </form>
            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {

        // ── Mobile Sidebar ─────────────────────────────────────
        const toggle  = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('mainSidebar');
        const overlay = document.getElementById('sidebarOverlay');

        if (toggle) toggle.addEventListener('click', () => {
            sidebar.classList.add('show');
            overlay.classList.add('show');
            document.body.style.overflow = 'hidden';
        });

        if (overlay) overlay.addEventListener('click', () => {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
            document.body.style.overflow = '';
        });

        // ── Password Toggle ────────────────────────────────────
        const pwdInput  = document.getElementById('password');
        const pwdToggle = document.getElementById('togglePassword');
        const pwdIcon   = document.getElementById('toggleIcon');

        if (pwdToggle && pwdInput) {
            pwdToggle.addEventListener('click', () => {
                const isHidden = pwdInput.type === 'password';
                pwdInput.type = isHidden ? 'text' : 'password';
                pwdIcon.className = isHidden ? 'bi bi-eye-slash' : 'bi bi-eye';
            });
        }

        // ── Branch Radio Cards ─────────────────────────────────
        document.querySelectorAll('.branch-option').forEach(label => {
            label.addEventListener('click', () => {
                document.querySelectorAll('.branch-option').forEach(l => l.classList.remove('selected'));
                label.classList.add('selected');
                label.querySelector('input[type="radio"]').checked = true;
            });
        });

    });
    </script>

</body>
</html>