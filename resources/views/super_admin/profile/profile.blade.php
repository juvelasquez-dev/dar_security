<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile — E-Agraryo Merkado</title>
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

        .navbar-divider {
            width: 1px; height: 28px;
            background: rgba(255,255,255,0.12);
            margin: 0 1.25rem;
        }

        .navbar-right {
            margin-left: auto; display: flex;
            align-items: center; gap: 0.75rem;
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
            cursor: pointer; transition: background 0.18s;
            text-decoration: none;
        }

        .user-pill:hover { background: rgba(255,255,255,0.14); }

        .user-avatar {
            width: 30px; height: 30px; border-radius: 50%;
            object-fit: cover; border: 1.5px solid rgba(255,255,255,0.25);
        }

        .user-pill-name { font-size: 0.82rem; font-weight: 500; color: #fff; }
        .user-pill-role { font-size: 0.65rem; color: var(--green-200); }

        /* ─── Sidebar ───────────────────────────────────────── */
        .sidebar {
            position: fixed; top: 62px; left: 0; bottom: 0;
            width: var(--sidebar-w);
            background: #fff; border-right: 1px solid var(--gray-200);
            overflow-y: auto; z-index: 1030;
            display: flex; flex-direction: column;
            box-shadow: var(--shadow-sm);
            transition: transform 0.28s cubic-bezier(.4,0,.2,1);
        }

        .sidebar-inner {
            padding: 1.5rem 1rem; flex: 1;
            display: flex; flex-direction: column;
        }

        .sidebar-section-label {
            font-size: 0.65rem; font-weight: 700;
            letter-spacing: 0.1em; text-transform: uppercase;
            color: var(--gray-400); padding: 0 0.5rem;
            margin: 1.4rem 0 0.5rem;
        }

        .sidebar-section-label:first-child { margin-top: 0; }

        .sidebar-link {
            display: flex; align-items: center; gap: 0.65rem;
            padding: 0.56rem 0.75rem; border-radius: var(--radius-sm);
            font-size: 0.875rem; font-weight: 500;
            color: var(--gray-600); text-decoration: none;
            transition: all 0.18s; margin-bottom: 2px;
            position: relative;
        }

        .sidebar-link i { font-size: 1rem; width: 20px; text-align: center; flex-shrink: 0; }

        .sidebar-link:hover { background: var(--green-100); color: var(--green-700); }

        .sidebar-link.active {
            background: var(--green-100); color: var(--green-700); font-weight: 600;
        }

        .sidebar-link.active::before {
            content: ''; position: absolute; left: -3px;
            top: 20%; bottom: 20%; width: 4px;
            background: var(--green-600); border-radius: 4px;
        }

        .sidebar-link-badge {
            margin-left: auto; font-size: 0.65rem; font-weight: 700;
            background: var(--green-100); color: var(--green-700);
            padding: 2px 7px; border-radius: 20px;
        }

        .sidebar-link.active .sidebar-link-badge { background: var(--green-600); color: #fff; }

        .sidebar-logout {
            margin-top: auto; padding-top: 1rem;
            border-top: 1px solid var(--gray-200);
        }

        .sidebar-logout .sidebar-link { color: #c0392b; }
        .sidebar-logout .sidebar-link:hover { background: #fdf2f2; color: #c0392b; }

        .sidebar-office-chip {
            background: var(--green-50); border: 1px solid var(--green-200);
            border-radius: var(--radius-sm); padding: 0.65rem 0.85rem; margin-bottom: 1rem;
        }

        .sidebar-office-chip .office-label {
            font-size: 0.62rem; font-weight: 700;
            letter-spacing: 0.1em; text-transform: uppercase; color: var(--green-600);
        }

        .sidebar-office-chip .office-name {
            font-size: 0.82rem; font-weight: 600; color: var(--green-900); margin-top: 1px;
        }

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
            display: flex; align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;
        }

        .page-header-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.6rem; color: var(--green-900);
            margin: 0 0 2px; line-height: 1.2;
        }

        .page-header-sub {
            font-size: 0.85rem; color: var(--text-muted); margin: 0;
        }

        .header-date-chip {
            background: #fff; border: 1px solid var(--gray-200);
            border-radius: var(--radius-sm); padding: 6px 14px;
            font-size: 0.78rem; color: var(--gray-600);
            display: flex; align-items: center; gap: 6px;
            box-shadow: var(--shadow-sm); white-space: nowrap;
        }

        /* ─── Profile Cover ─────────────────────────────────── */
        .profile-cover-card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .profile-cover-banner {
            height: 140px;
            background: linear-gradient(135deg, var(--green-900) 0%, var(--green-700) 50%, var(--green-500) 100%);
            position: relative;
            overflow: hidden;
        }

        .profile-cover-banner::before {
            content: '';
            position: absolute; inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .profile-cover-body {
            padding: 0 1.75rem 1.5rem;
            display: flex;
            align-items: flex-end;
            gap: 1.25rem;
            flex-wrap: wrap;
        }

        .profile-avatar-wrap {
            margin-top: -48px;
            flex-shrink: 0;
            position: relative;
        }

        .profile-avatar-img {
            width: 96px; height: 96px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: var(--shadow-md);
        }

        .profile-avatar-badge {
            position: absolute; bottom: 4px; right: 4px;
            width: 22px; height: 22px;
            background: var(--green-600);
            border: 2px solid #fff;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.6rem; color: #fff;
        }

        .profile-cover-info {
            padding-top: 0.75rem;
            flex: 1;
            min-width: 200px;
        }

        .profile-cover-name {
            font-family: 'DM Serif Display', serif;
            font-size: 1.35rem;
            color: var(--green-900);
            margin: 0 0 2px;
        }

        .profile-cover-meta {
            font-size: 0.82rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
            margin-top: 4px;
        }

        .profile-cover-meta span {
            display: flex; align-items: center; gap: 4px;
        }

        .profile-cover-actions {
            margin-left: auto;
            display: flex;
            gap: 0.5rem;
            padding-top: 0.75rem;
        }

        /* ─── Info Cards ────────────────────────────────────── */
        .info-card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            overflow: hidden;
            height: 100%;
        }

        .info-card-header {
            padding: 1rem 1.5rem 0.85rem;
            border-bottom: 1px solid var(--gray-200);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .info-card-title {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--text-main);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.45rem;
        }

        .info-card-title i { color: var(--green-600); }

        .info-card-body { padding: 1.4rem 1.5rem; }

        .info-field { margin-bottom: 1.15rem; }
        .info-field:last-child { margin-bottom: 0; }

        .info-field-label {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 3px;
        }

        .info-field-value {
            font-size: 0.88rem;
            font-weight: 500;
            color: var(--text-main);
        }

        .info-field-value.placeholder {
            color: var(--gray-400);
            font-style: italic;
        }

        /* ─── Role Badge ────────────────────────────────────── */
        .role-badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 3px 10px; border-radius: 20px;
            font-size: 0.71rem; font-weight: 600; white-space: nowrap;
        }

        .role-dot { width: 6px; height: 6px; border-radius: 50%; }

        .role-super_admin { background: #f0ebff; color: #6f42c1; }
        .role-super_admin .role-dot { background: #6f42c1; }
        .role-pbd { background: #e8f0fe; color: #1a73e8; }
        .role-pbd .role-dot { background: #1a73e8; }
        .role-finance { background: var(--gold-light); color: var(--gold); }
        .role-finance .role-dot { background: var(--gold); }
        .role-arbo { background: #e0f7f5; color: #0d8a7e; }
        .role-arbo .role-dot { background: #0d8a7e; }

        .status-badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 3px 10px; border-radius: 20px;
            font-size: 0.72rem; font-weight: 600;
        }

        .status-active { background: var(--green-100); color: var(--green-700); }
        .status-inactive { background: #fdecea; color: #c0392b; }

        .status-dot {
            width: 6px; height: 6px; border-radius: 50%; display: inline-block;
        }

        .status-active .status-dot { background: var(--green-600); }
        .status-inactive .status-dot { background: #c0392b; }

        /* ─── Activity Timeline ─────────────────────────────── */
        .timeline { list-style: none; padding: 0; margin: 0; }

        .timeline-item {
            display: flex; gap: 0.85rem;
            padding: 0.85rem 0;
            border-bottom: 1px solid var(--gray-100);
            align-items: flex-start;
        }

        .timeline-item:last-child { border-bottom: none; }

        .timeline-dot {
            width: 32px; height: 32px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.85rem; flex-shrink: 0; margin-top: 1px;
        }

        .td-green { background: var(--green-100); color: var(--green-700); }
        .td-gold  { background: var(--gold-light); color: var(--gold); }
        .td-blue  { background: #e8f0fe; color: #1a73e8; }
        .td-red   { background: #fdecea; color: #c0392b; }

        .timeline-title { font-size: 0.83rem; font-weight: 600; color: var(--text-main); margin-bottom: 1px; }
        .timeline-meta  { font-size: 0.73rem; color: var(--text-muted); }

        /* ─── Edit Form ─────────────────────────────────────── */
        .form-control, .form-select {
            font-size: 0.86rem;
            border-color: var(--gray-200);
            border-radius: 8px !important;
            transition: border-color 0.18s, box-shadow 0.18s;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--green-500);
            box-shadow: 0 0 0 3px rgba(31,128,60,0.12);
        }

        .form-label { font-size: 0.82rem; font-weight: 600; color: var(--text-main); margin-bottom: 0.35rem; }

        /* ─── Divider ───────────────────────────────────────── */
        .section-divider {
            font-size: 0.7rem; font-weight: 700;
            letter-spacing: 0.1em; text-transform: uppercase;
            color: var(--text-muted);
            padding-bottom: 0.5rem;
            border-bottom: 1px solid var(--gray-200);
            margin-bottom: 1.1rem;
        }

        /* ─── Password Strength ─────────────────────────────── */
        .strength-bar { height: 4px; border-radius: 4px; background: var(--gray-200); overflow: hidden; margin-top: 6px; }
        .strength-fill { height: 100%; border-radius: 4px; width: 0; transition: width 0.3s, background 0.3s; }

        /* ─── Mobile ────────────────────────────────────────── */
        .mobile-sidebar-toggle {
            display: none; background: none; border: none;
            color: #fff; font-size: 1.3rem;
            margin-right: 0.75rem; cursor: pointer;
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
            .profile-cover-actions { width: 100%; }
        }

        /* ─── Modal ─────────────────────────────────────────── */
        .modal-content { border: none; border-radius: var(--radius); box-shadow: var(--shadow-lg); }
        .modal-header { border-bottom: 1px solid var(--gray-200); padding: 1.15rem 1.5rem; }
        .modal-footer { border-top: 1px solid var(--gray-200); padding: 0.9rem 1.5rem; }
        .modal-body { padding: 1.5rem; }
    </style>
</head>
<body>

@php
    $authUser   = auth()->user();
    $authFullName = $authUser
        ? trim(($authUser->first_name ?? '') . ' ' . ($authUser->last_name ?? ''))
        : 'Super Admin';
    $avatarUrl  = 'https://ui-avatars.com/api/?name=' . urlencode($authFullName) . '&background=1a6932&color=fff&rounded=true&size=128';
    $roleSlug   = $authUser->role->slug ?? 'super_admin';
    $roleLabel  = $authUser->role->name ?? ucwords(str_replace('_', ' ', $roleSlug));
@endphp

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

    <span class="navbar-page-badge"><i class="bi bi-person-circle me-1"></i> My Profile</span>

    <div class="navbar-right">
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
                <li class="border-top">
                    <a class="dropdown-item text-center py-2" href="#" style="font-size:.78rem; color:var(--green-700);">View all notifications</a>
                </li>
            </ul>
        </div>

        <div class="navbar-divider d-none d-sm-block"></div>

        <div class="dropdown">
            <a class="user-pill dropdown-toggle" href="#" data-bs-toggle="dropdown">
                <img class="user-avatar" src="{{ $avatarUrl }}" alt="User avatar">
                <div class="d-none d-md-block" style="line-height:1.2;">
                    <div class="user-pill-name">{{ $authFullName }}</div>
                    <div class="user-pill-role">{{ $roleLabel }}</div>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="border-radius:12px; margin-top:8px; min-width:200px;">
                <li class="px-3 py-2 border-bottom">
                    <div class="fw-bold" style="font-size:.83rem;">{{ $authFullName }}</div>
                    <div class="text-muted" style="font-size:.72rem;">{{ $authUser->email ?? '' }}</div>
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

<!-- ── Sidebar Overlay ─────────────────────────────────── -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- ── Sidebar ─────────────────────────────────────────── -->
<aside class="sidebar" id="mainSidebar">
    <div class="sidebar-inner">
        <div class="sidebar-office-chip">
            <div class="office-label">Role</div>
            <div class="office-name">{{ $roleLabel }}</div>
        </div>

        <span class="sidebar-section-label">Main Menu</span>

        <a href="{{ url('/dashboard') }}" class="sidebar-link">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a href="{{ url('/roles') }}" class="sidebar-link">
            <i class="bi bi-person-badge"></i> User Roles
        </a>
        <a href="{{ url('/branches') }}" class="sidebar-link">
            <i class="bi bi-building"></i> PBD Management
            <span class="sidebar-link-badge">8</span>
        </a>
        <a href="{{ url('/logs') }}" class="sidebar-link">
            <i class="bi bi-clock-history"></i> Activity Logs
        </a>

        <span class="sidebar-section-label">Sales Report</span>
        <a href="{{ url('/reports') }}" class="sidebar-link">
            <i class="bi bi-bar-chart-line"></i> Sales Report
        </a>

        <span class="sidebar-section-label">Account</span>
        <a href="{{ url('/profile') }}" class="sidebar-link active">
            <i class="bi bi-person-circle"></i> My Profile
        </a>
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
            <h1 class="page-header-title">My Profile</h1>
            <p class="page-header-sub">View and manage your account information and preferences.</p>
        </div>
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <div class="header-date-chip">
                <i class="bi bi-calendar3"></i>
                <span id="currentDate"></span>
            </div>
        </div>
    </div>

    <!-- Alerts -->
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 shadow-sm mb-4">
            <div class="fw-semibold mb-1"><i class="bi bi-exclamation-triangle-fill me-2"></i>Please fix the following:</div>
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li style="font-size:.84rem;">{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- ── Profile Cover ─────────────────────────────────── -->
    <div class="profile-cover-card">
        <div class="profile-cover-banner"></div>
        <div class="profile-cover-body">
            <div class="profile-avatar-wrap">
                <img class="profile-avatar-img" src="{{ $avatarUrl }}" alt="{{ $authFullName }}">
                <span class="profile-avatar-badge"><i class="bi bi-check-lg"></i></span>
            </div>
            <div class="profile-cover-info">
                <h2 class="profile-cover-name">{{ $authFullName }}</h2>
                <div class="profile-cover-meta">
                    <span>
                        <span class="role-badge role-{{ $roleSlug }}">
                            <span class="role-dot"></span>
                            {{ $roleLabel }}
                        </span>
                    </span>
                    <span><i class="bi bi-envelope" style="color:var(--green-600);"></i> {{ $authUser->email ?? '—' }}</span>
                    @if($authUser->province ?? null)
                        <span><i class="bi bi-geo-alt" style="color:var(--green-600);"></i> {{ $authUser->province->name }}</span>
                    @endif
                    <span>
                        <span class="status-badge status-{{ $authUser->status ?? 'active' }}">
                            <span class="status-dot"></span>
                            {{ ucfirst($authUser->status ?? 'active') }}
                        </span>
                    </span>
                </div>
            </div>
            <div class="profile-cover-actions">
                <button type="button"
                        class="btn btn-sm fw-semibold d-flex align-items-center gap-2"
                        data-bs-toggle="modal" data-bs-target="#editProfileModal"
                        style="background:var(--green-600); color:#fff; border-radius:8px; border:none; font-size:.82rem;">
                    <i class="bi bi-pencil-fill"></i> Edit Profile
                </button>
                <button type="button"
                        class="btn btn-sm fw-semibold d-flex align-items-center gap-2"
                        data-bs-toggle="modal" data-bs-target="#changePasswordModal"
                        style="background:#fff; color:var(--green-700); border:1px solid var(--gray-200); border-radius:8px; font-size:.82rem;">
                    <i class="bi bi-shield-lock-fill"></i> Change Password
                </button>
            </div>
        </div>
    </div>

    <!-- ── Profile Details ───────────────────────────────── -->
    <div class="row g-4">

        <!-- Personal Info -->
        <div class="col-lg-4">
            <div class="info-card">
                <div class="info-card-header">
                    <h6 class="info-card-title"><i class="bi bi-person-fill"></i> Personal Information</h6>
                </div>
                <div class="info-card-body">
                    <div class="info-field">
                        <div class="info-field-label">First Name</div>
                        <div class="info-field-value">{{ $authUser->first_name ?? '—' }}</div>
                    </div>
                    <div class="info-field">
                        <div class="info-field-label">Middle Name</div>
                        <div class="info-field-value {{ !($authUser->middle_name ?? null) ? 'placeholder' : '' }}">
                            {{ $authUser->middle_name ?? 'Not provided' }}
                        </div>
                    </div>
                    <div class="info-field">
                        <div class="info-field-label">Last Name</div>
                        <div class="info-field-value">{{ $authUser->last_name ?? '—' }}</div>
                    </div>
                    <div class="info-field">
                        <div class="info-field-label">Username</div>
                        <div class="info-field-value">{{ $authUser->username ?? '—' }}</div>
                    </div>
                    <div class="info-field">
                        <div class="info-field-label">Contact Number</div>
                        <div class="info-field-value {{ !($authUser->contact_number ?? null) ? 'placeholder' : '' }}">
                            {{ $authUser->contact_number ?? 'Not provided' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Account Info -->
        <div class="col-lg-4">
            <div class="info-card">
                <div class="info-card-header">
                    <h6 class="info-card-title"><i class="bi bi-shield-fill-check"></i> Account Details</h6>
                </div>
                <div class="info-card-body">
                    <div class="info-field">
                        <div class="info-field-label">User ID</div>
                        <div class="info-field-value" style="font-family:monospace; font-size:.82rem; color:var(--text-muted);">
                            USR-{{ str_pad($authUser->id ?? 0, 4, '0', STR_PAD_LEFT) }}
                        </div>
                    </div>
                    <div class="info-field">
                        <div class="info-field-label">Email Address</div>
                        <div class="info-field-value">{{ $authUser->email ?? '—' }}</div>
                    </div>
                    <div class="info-field">
                        <div class="info-field-label">Assigned Role</div>
                        <div class="info-field-value">
                            <span class="role-badge role-{{ $roleSlug }}">
                                <span class="role-dot"></span>{{ $roleLabel }}
                            </span>
                        </div>
                    </div>
                    <div class="info-field">
                        <div class="info-field-label">Assigned Province</div>
                        <div class="info-field-value {{ !($authUser->province ?? null) ? 'placeholder' : '' }}">
                            {{ $authUser->province->name ?? 'Not assigned' }}
                        </div>
                    </div>
                    <div class="info-field">
                        <div class="info-field-label">Account Status</div>
                        <div class="info-field-value">
                            <span class="status-badge status-{{ $authUser->status ?? 'active' }}">
                                <span class="status-dot"></span>
                                {{ ucfirst($authUser->status ?? 'active') }}
                            </span>
                        </div>
                    </div>
                    <div class="info-field">
                        <div class="info-field-label">Member Since</div>
                        <div class="info-field-value">
                            {{ optional($authUser->created_at)->format('F d, Y') ?? '—' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="col-lg-4">
            <div class="info-card">
                <div class="info-card-header">
                    <h6 class="info-card-title"><i class="bi bi-clock-history"></i> Recent Activity</h6>
                </div>
                <div class="info-card-body p-0">
                    <ul class="timeline px-0">
                        <li class="timeline-item px-4">
                            <div class="timeline-dot td-green"><i class="bi bi-box-arrow-in-right"></i></div>
                            <div>
                                <div class="timeline-title">Logged in</div>
                                <div class="timeline-meta">Just now · Web Browser</div>
                            </div>
                        </li>
                        <li class="timeline-item px-4">
                            <div class="timeline-dot td-blue"><i class="bi bi-pencil-fill"></i></div>
                            <div>
                                <div class="timeline-title">Profile updated</div>
                                <div class="timeline-meta">2 days ago</div>
                            </div>
                        </li>
                        <li class="timeline-item px-4">
                            <div class="timeline-dot td-gold"><i class="bi bi-shield-lock-fill"></i></div>
                            <div>
                                <div class="timeline-title">Password changed</div>
                                <div class="timeline-meta">1 week ago</div>
                            </div>
                        </li>
                        <li class="timeline-item px-4">
                            <div class="timeline-dot td-green"><i class="bi bi-person-check-fill"></i></div>
                            <div>
                                <div class="timeline-title">Account activated</div>
                                <div class="timeline-meta">{{ optional($authUser->created_at)->format('M d, Y') ?? '—' }}</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</main>

<!-- ── Edit Profile Modal ──────────────────────────────── -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="editProfileModalLabel">
                        <i class="bi bi-pencil-fill me-2" style="color:var(--green-600);"></i>
                        Edit Profile
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="section-divider">Personal Details</div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name" class="form-control" required value="{{ old('first_name', $authUser->first_name ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Middle Name</label>
                            <input type="text" name="middle_name" class="form-control" value="{{ old('middle_name', $authUser->middle_name ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control" required value="{{ old('last_name', $authUser->last_name ?? '') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $authUser->email ?? '') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Contact Number</label>
                            <input type="text" name="contact_number" class="form-control" value="{{ old('contact_number', $authUser->contact_number ?? '') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" required value="{{ old('username', $authUser->username ?? '') }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius:8px;">Cancel</button>
                    <button type="submit" class="btn fw-semibold" style="background:var(--green-600); color:#fff; border-radius:8px; border:none;">
                        <i class="bi bi-check-circle-fill me-1"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ── Change Password Modal ───────────────────────────── -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('profile.password') }}">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="changePasswordModalLabel">
                        <i class="bi bi-shield-lock-fill me-2" style="color:var(--green-600);"></i>
                        Change Password
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label">Current Password</label>
                            <input type="password" name="current_password" class="form-control" required placeholder="Enter current password">
                        </div>
                        <div class="col-12">
                            <label class="form-label">New Password</label>
                            <input type="password" name="password" id="newPassword" class="form-control" required placeholder="Enter new password" oninput="checkStrength(this.value)">
                            <div class="strength-bar mt-1"><div class="strength-fill" id="strengthFill"></div></div>
                            <div id="strengthLabel" class="mt-1" style="font-size:.72rem; color:var(--text-muted);"></div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required placeholder="Re-enter new password">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius:8px;">Cancel</button>
                    <button type="submit" class="btn fw-semibold" style="background:var(--green-600); color:#fff; border-radius:8px; border:none;">
                        <i class="bi bi-check-circle-fill me-1"></i> Update Password
                    </button>
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

    // Current Date
    const dateEl = document.getElementById('currentDate');
    if (dateEl) {
        dateEl.textContent = new Date().toLocaleDateString('en-PH', {
            weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
        });
    }

    // Mobile Sidebar
    const toggle  = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('mainSidebar');
    const overlay = document.getElementById('sidebarOverlay');

    function openSidebar()  { sidebar.classList.add('show'); overlay.classList.add('show'); document.body.style.overflow = 'hidden'; }
    function closeSidebar() { sidebar.classList.remove('show'); overlay.classList.remove('show'); document.body.style.overflow = ''; }

    if (toggle)  toggle.addEventListener('click', openSidebar);
    if (overlay) overlay.addEventListener('click', closeSidebar);

    // Re-open modal on validation error
    @if($errors->any())
        new bootstrap.Modal(document.getElementById('editProfileModal')).show();
    @endif

    // SweetAlert flash
    @if(session('swal'))
        const _swal = @json(session('swal'));
        if (typeof Swal !== 'undefined' && _swal) Swal.fire(_swal);
    @endif
});

// Password strength meter
function checkStrength(val) {
    const fill  = document.getElementById('strengthFill');
    const label = document.getElementById('strengthLabel');
    if (!fill || !label) return;

    let score = 0;
    if (val.length >= 8)              score++;
    if (/[A-Z]/.test(val))            score++;
    if (/[0-9]/.test(val))            score++;
    if (/[^A-Za-z0-9]/.test(val))     score++;

    const levels = [
        { w: '25%',  bg: '#e74c3c', text: 'Weak' },
        { w: '50%',  bg: '#e67e22', text: 'Fair' },
        { w: '75%',  bg: '#f1c40f', text: 'Good' },
        { w: '100%', bg: '#27ae60', text: 'Strong' },
    ];

    const lv = levels[Math.max(0, score - 1)];
    fill.style.width      = val ? lv.w  : '0';
    fill.style.background = val ? lv.bg : '';
    label.textContent     = val ? lv.text : '';
}
</script>

</body>
</html>