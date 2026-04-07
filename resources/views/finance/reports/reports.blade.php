<?php
// resources/views/finance/reports/sales.php
// Standalone PHP/HTML — no layout extension
?>
<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sales Report — Finance — E-Agraryo Merkado</title>
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

        /* ─── Print overrides ───────────────────────────────── */
        @media print {
            .top-navbar, .sidebar, .sidebar-overlay,
            .no-print, #inactivityWarningModal { display: none !important; }
            .page-wrapper { margin-left: 0 !important; margin-top: 0 !important; padding: 0 !important; }
            .print-header { display: block !important; }
            .table-card, .chart-card, .stat-card { box-shadow: none !important; border: 1px solid #dee2e6 !important; }
            body { background: #fff !important; }
            .fin-table thead th { background: #e8f5ec !important; -webkit-print-color-adjust: exact; }
        }
        .print-header { display: none; }

        /* ─── Navbar ────────────────────────────────────────── */
        .top-navbar {
            background: var(--green-900);
            height: 62px;
            display: flex; align-items: center; padding: 0 1.5rem;
            position: fixed; top: 0; left: 0; right: 0;
            z-index: 1040; box-shadow: 0 2px 12px rgba(0,0,0,0.22);
        }
        .navbar-brand-area { display: flex; align-items: center; gap: 0.65rem; text-decoration: none; flex-shrink: 0; }
        .navbar-brand-area img { height: 38px; filter: brightness(1.15); }
        .navbar-system-title { font-family: 'DM Serif Display', serif; font-size: 1.18rem; color: #fff; letter-spacing: 0.01em; line-height: 1.15; }
        .navbar-system-sub { font-size: 0.68rem; color: var(--green-200); letter-spacing: 0.06em; text-transform: uppercase; font-weight: 500; }
        .navbar-page-badge { background: rgba(200,146,42,0.18); border: 1px solid rgba(200,146,42,0.35); color: var(--gold-mid); font-size: 0.72rem; font-weight: 600; letter-spacing: 0.05em; text-transform: uppercase; padding: 3px 10px; border-radius: 20px; margin-left: 1rem; }
        .navbar-divider { width: 1px; height: 28px; background: rgba(255,255,255,0.12); margin: 0 1.25rem; }
        .navbar-right { margin-left: auto; display: flex; align-items: center; gap: 0.75rem; }
        .nav-icon-btn { background: none; border: none; color: rgba(255,255,255,0.75); font-size: 1.15rem; cursor: pointer; padding: 6px 8px; border-radius: 8px; position: relative; transition: color 0.18s, background 0.18s; }
        .nav-icon-btn:hover { color: #fff; background: rgba(255,255,255,0.08); }
        .nav-notif-dot { position: absolute; top: 5px; right: 6px; width: 8px; height: 8px; background: var(--gold); border-radius: 50%; border: 2px solid var(--green-900); }
        .user-pill { display: flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); border-radius: 30px; padding: 5px 12px 5px 6px; cursor: pointer; transition: background 0.18s; text-decoration: none; }
        .user-pill:hover { background: rgba(255,255,255,0.14); }
        .user-avatar { width: 30px; height: 30px; border-radius: 50%; object-fit: cover; border: 1.5px solid rgba(255,255,255,0.25); }
        .user-pill-name { font-size: 0.82rem; font-weight: 500; color: #fff; }
        .user-pill-role { font-size: 0.65rem; color: var(--green-200); }

        /* ─── Sidebar ───────────────────────────────────────── */
        .sidebar { position: fixed; top: 62px; left: 0; bottom: 0; width: var(--sidebar-w); background: #fff; border-right: 1px solid var(--gray-200); overflow-y: auto; z-index: 1030; display: flex; flex-direction: column; box-shadow: var(--shadow-sm); transition: transform 0.28s cubic-bezier(.4,0,.2,1); }
        .sidebar-inner { padding: 1.5rem 1rem; flex: 1; display: flex; flex-direction: column; }
        .sidebar-section-label { font-size: 0.65rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--gray-400); padding: 0 0.5rem; margin: 1.4rem 0 0.5rem; }
        .sidebar-section-label:first-child { margin-top: 0; }
        .sidebar-link { display: flex; align-items: center; gap: 0.65rem; padding: 0.56rem 0.75rem; border-radius: var(--radius-sm); font-size: 0.875rem; font-weight: 500; color: var(--gray-600); text-decoration: none; transition: all 0.18s; margin-bottom: 2px; position: relative; }
        .sidebar-link i { font-size: 1rem; width: 20px; text-align: center; flex-shrink: 0; }
        .sidebar-link:hover { background: var(--green-100); color: var(--green-700); }
        .sidebar-link.active { background: var(--green-100); color: var(--green-700); font-weight: 600; }
        .sidebar-link.active::before { content: ''; position: absolute; left: -3px; top: 20%; bottom: 20%; width: 4px; background: var(--green-600); border-radius: 4px; }
        .sidebar-logout { margin-top: auto; padding-top: 1rem; border-top: 1px solid var(--gray-200); }
        .sidebar-logout .sidebar-link { color: #c0392b; }
        .sidebar-logout .sidebar-link:hover { background: #fdf2f2; color: #c0392b; }
        .sidebar-office-chip { background: var(--green-50); border: 1px solid var(--green-200); border-radius: var(--radius-sm); padding: 0.65rem 0.85rem; margin-bottom: 1rem; }
        .sidebar-office-chip .office-label { font-size: 0.62rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--green-600); }
        .sidebar-office-chip .office-name { font-size: 0.82rem; font-weight: 600; color: var(--green-900); margin-top: 1px; }

        /* ─── Page Wrapper ──────────────────────────────────── */
        .page-wrapper { margin-left: var(--sidebar-w); margin-top: 62px; min-height: calc(100vh - 62px); padding: 2rem 2rem 3rem; }

        /* ─── Page Header ───────────────────────────────────── */
        .page-header { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem; }
        .page-header-title { font-family: 'DM Serif Display', serif; font-size: 1.6rem; color: var(--green-900); margin: 0 0 2px; line-height: 1.2; }
        .page-header-sub { font-size: 0.85rem; color: var(--text-muted); margin: 0; }

        /* ─── Report Scope Banner ───────────────────────────── */
        .scope-banner {
            background: linear-gradient(135deg, var(--green-900) 0%, var(--green-700) 100%);
            border-radius: var(--radius);
            padding: 1.4rem 1.8rem;
            margin-bottom: 1.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
            position: relative;
            overflow: hidden;
        }
        .scope-banner::after {
            content: '';
            position: absolute;
            right: -40px; top: -40px;
            width: 180px; height: 180px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
        }
        .scope-banner-label { font-size: 0.7rem; font-weight: 700; letter-spacing: 0.1em; text-transform: uppercase; color: var(--green-200); margin-bottom: 2px; }
        .scope-banner-value { font-family: 'DM Serif Display', serif; font-size: 1.35rem; color: #fff; line-height: 1.2; }
        .scope-banner-meta { font-size: 0.75rem; color: rgba(255,255,255,0.65); margin-top: 2px; }
        .scope-divider { width: 1px; height: 44px; background: rgba(255,255,255,0.15); }

        /* ─── Stat Cards ────────────────────────────────────── */
        .stat-card { background: #fff; border-radius: var(--radius); box-shadow: var(--shadow-sm); padding: 1.2rem 1.4rem; display: flex; align-items: center; gap: 1rem; transition: box-shadow 0.22s, transform 0.22s; border: 1px solid var(--gray-200); height: 100%; }
        .stat-card:hover { box-shadow: var(--shadow-md); transform: translateY(-3px); }
        .stat-icon-wrap { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0; }
        .stat-icon-green  { background: var(--green-100); color: var(--green-700); }
        .stat-icon-gold   { background: var(--gold-light); color: var(--gold); }
        .stat-icon-blue   { background: #e8f0fe; color: #1a73e8; }
        .stat-icon-teal   { background: #e0f7f5; color: #0d8a7e; }
        .stat-icon-red    { background: #fdecea; color: #c0392b; }
        .stat-icon-indigo { background: #eef0ff; color: #4f46e5; }
        .stat-value { font-size: 1.75rem; font-weight: 700; color: var(--text-main); line-height: 1; margin-bottom: 3px; }
        .stat-label { font-size: 0.79rem; font-weight: 500; color: var(--text-muted); margin: 0; }
        .stat-trend { font-size: 0.72rem; font-weight: 600; display: inline-flex; align-items: center; gap: 3px; margin-top: 4px; }
        .stat-trend.up { color: var(--green-600); }
        .stat-trend.down { color: #dc3545; }
        .stat-trend.neutral { color: var(--gray-400); }

        /* ─── Section Title ─────────────────────────────────── */
        .section-title { font-size: 0.95rem; font-weight: 700; color: var(--text-main); margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem; }
        .section-title-bar { width: 4px; height: 18px; background: var(--green-600); border-radius: 3px; }

        /* ─── Filter / Date Range Bar ───────────────────────── */
        .report-filter-bar {
            background: #fff; border-radius: var(--radius); border: 1px solid var(--gray-200);
            box-shadow: var(--shadow-sm); padding: 1.1rem 1.4rem; margin-bottom: 1.5rem;
            display: flex; align-items: flex-end; gap: 1rem; flex-wrap: wrap;
        }
        .filter-group { display: flex; flex-direction: column; gap: 4px; }
        .filter-group label { font-size: 0.72rem; font-weight: 700; letter-spacing: 0.05em; text-transform: uppercase; color: var(--gray-600); }
        .filter-select, .filter-input {
            font-size: 0.82rem; border-radius: 8px; border: 1px solid var(--gray-200);
            padding: 7px 10px; color: var(--text-main); background: var(--gray-50);
            transition: border-color 0.18s; height: 36px;
        }
        .filter-select:focus, .filter-input:focus { border-color: var(--green-500); outline: none; box-shadow: 0 0 0 3px rgba(31,128,60,0.1); }
        .filter-input { min-width: 140px; }

        .btn-generate {
            background: var(--green-700); color: #fff; border: none; border-radius: 8px;
            font-size: 0.83rem; font-weight: 700; padding: 0 18px; height: 36px;
            display: inline-flex; align-items: center; gap: 6px;
            cursor: pointer; transition: background 0.18s; white-space: nowrap;
        }
        .btn-generate:hover { background: var(--green-800); color: #fff; }

        .btn-export-sm {
            background: var(--gray-50); color: var(--gray-600); border: 1px solid var(--gray-200);
            border-radius: 8px; font-size: 0.8rem; font-weight: 600; padding: 0 13px; height: 36px;
            display: inline-flex; align-items: center; gap: 5px;
            cursor: pointer; transition: all 0.18s; text-decoration: none; white-space: nowrap;
        }
        .btn-export-sm:hover { background: var(--green-100); border-color: var(--green-200); color: var(--green-700); }

        /* ─── Chart Card ────────────────────────────────────── */
        .chart-card { background: #fff; border-radius: var(--radius); box-shadow: var(--shadow-sm); border: 1px solid var(--gray-200); overflow: hidden; }
        .chart-card-header { padding: 1rem 1.5rem 0.9rem; border-bottom: 1px solid var(--gray-200); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.5rem; }
        .chart-card-title { font-size: 0.9rem; font-weight: 700; color: var(--text-main); margin: 0; }

        /* ─── Table Card ────────────────────────────────────── */
        .table-card { background: #fff; border-radius: var(--radius); box-shadow: var(--shadow-sm); border: 1px solid var(--gray-200); overflow: hidden; }
        .table-card-header { padding: 1rem 1.5rem 0.9rem; border-bottom: 1px solid var(--gray-200); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.5rem; }
        .table-card-title { font-size: 0.9rem; font-weight: 700; color: var(--text-main); margin: 0; display: flex; align-items: center; gap: 0.45rem; }
        .table-card-title i { color: var(--green-600); }
        .table-responsive { overflow-x: auto; }

        .fin-table { width: 100%; border-collapse: collapse; font-size: 0.84rem; }
        .fin-table thead th { background: var(--green-50); color: var(--green-800); font-weight: 700; font-size: 0.72rem; letter-spacing: 0.05em; text-transform: uppercase; padding: 0.7rem 1.1rem; border-bottom: 1px solid var(--green-200); white-space: nowrap; }
        .fin-table tbody tr { border-bottom: 1px solid var(--gray-100); transition: background 0.14s; }
        .fin-table tbody tr:last-child { border-bottom: none; }
        .fin-table tbody tr:hover { background: var(--gray-50); }
        .fin-table td { padding: 0.75rem 1.1rem; vertical-align: middle; color: var(--text-main); }
        .fin-table tfoot tr { border-top: 2px solid var(--green-200); background: var(--green-50); }
        .fin-table tfoot td { padding: 0.8rem 1.1rem; font-weight: 700; color: var(--green-900); font-size: 0.85rem; }

        /* ─── Summary row ───────────────────────────────────── */
        .subtotal-row { background: var(--green-50) !important; }
        .subtotal-row td { font-weight: 700; color: var(--green-800) !important; font-size: 0.83rem; border-top: 1px solid var(--green-200); }

        /* ─── Cell Styles ───────────────────────────────────── */
        .name-cell { font-weight: 600; color: var(--green-800); }
        .name-cell small { display: block; font-weight: 400; font-size: 0.72rem; color: var(--text-muted); margin-top: 1px; }
        .amount-cell { font-weight: 700; color: var(--green-800); font-size: 0.88rem; }
        .order-no { font-family: 'Courier New', monospace; font-weight: 700; font-size: 0.82rem; color: var(--green-700); }

        /* ─── Province Badge ────────────────────────────────── */
        .province-badge { font-size: 0.7rem; font-weight: 600; padding: 2px 8px; border-radius: 6px; background: var(--green-50); color: var(--green-700); border: 1px solid var(--green-200); white-space: nowrap; }

        /* ─── Status Badges ─────────────────────────────────── */
        .status-badge { display: inline-flex; align-items: center; gap: 5px; padding: 3px 10px; border-radius: 20px; font-size: 0.72rem; font-weight: 600; }
        .status-dot { width: 6px; height: 6px; border-radius: 50%; display: inline-block; background: currentColor; }
        .status-paid       { background: var(--green-100); color: var(--green-700); }
        .status-pending    { background: var(--gold-light); color: var(--gold); }
        .status-cancelled  { background: #fdecea; color: #c0392b; }
        .status-partial    { background: #f3e8ff; color: #7c3aed; }
        .status-completed  { background: #e8f0fe; color: #1a73e8; }

        /* ─── Rev Bar ───────────────────────────────────────── */
        .rev-bar { height: 5px; background: var(--gray-200); border-radius: 4px; overflow: hidden; margin-top: 4px; }
        .rev-bar-fill { height: 100%; border-radius: 4px; background: linear-gradient(90deg, var(--green-600), var(--green-500)); }

        /* ─── Growth ────────────────────────────────────────── */
        .growth-badge { display: inline-flex; align-items: center; gap: 3px; font-size: 0.72rem; font-weight: 700; padding: 2px 8px; border-radius: 20px; }
        .growth-up   { background: var(--green-100); color: var(--green-700); }
        .growth-down { background: #fdecea; color: #c0392b; }
        .growth-flat { background: var(--gray-100); color: var(--gray-600); }

        /* ─── Tab Pills ─────────────────────────────────────── */
        .tab-pill-wrap { display: flex; gap: 0.4rem; flex-wrap: wrap; margin-bottom: 1.25rem; }
        .tab-pill { padding: 6px 16px; border-radius: 20px; font-size: 0.78rem; font-weight: 600; cursor: pointer; border: 1.5px solid var(--gray-200); background: #fff; color: var(--gray-600); transition: all 0.18s; text-decoration: none; display: inline-flex; align-items: center; gap: 5px; }
        .tab-pill:hover { border-color: var(--green-400); color: var(--green-700); }
        .tab-pill.active { background: var(--green-700); border-color: var(--green-700); color: #fff; }

        /* ─── Edit Notice (Finance has Edit on Module 8) ─────── */
        .edit-notice {
            background: var(--green-50); border: 1px solid var(--green-200);
            border-radius: var(--radius-sm); padding: 0.6rem 1rem;
            font-size: 0.78rem; color: var(--green-800);
            display: flex; align-items: center; gap: 0.5rem;
            margin-bottom: 1.25rem;
        }

        /* ─── Pagination ────────────────────────────────────── */
        .pagination-wrap { padding: 12px 20px; border-top: 1px solid var(--gray-100); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.5rem; }
        .pagination-info { font-size: 0.78rem; color: var(--text-muted); }

        /* ─── Empty State ───────────────────────────────────── */
        .empty-state { text-align: center; padding: 3.5rem 1rem; color: var(--gray-400); }
        .empty-state i { font-size: 2.5rem; display: block; margin-bottom: 0.75rem; }
        .empty-state p { font-size: 0.85rem; margin: 0; }

        /* ─── Edit Cell ─────────────────────────────────────── */
        .btn-edit-sm {
            background: var(--gold-light); color: var(--gold); border: 1px solid var(--gold-mid);
            font-size: 0.73rem; border-radius: 7px; font-weight: 600;
            padding: 3px 10px; display: inline-flex; align-items: center; gap: 4px;
            cursor: pointer; transition: background 0.15s; white-space: nowrap;
        }
        .btn-edit-sm:hover { background: var(--gold-mid); color: #7a5a10; }

        .btn-card-action { background: var(--green-100); color: var(--green-700); border: none; font-size: 0.78rem; border-radius: 8px; font-weight: 600; padding: 5px 12px; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; transition: background 0.15s; white-space: nowrap; cursor: pointer; }
        .btn-card-action:hover { background: #d0ebd8; color: var(--green-900); }

        /* ─── Mobile ────────────────────────────────────────── */
        .mobile-sidebar-toggle { display: none; background: none; border: none; color: #fff; font-size: 1.3rem; margin-right: 0.75rem; cursor: pointer; }

        @media (max-width: 991.98px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.show { transform: translateX(0); }
            .page-wrapper { margin-left: 0; padding: 1.25rem 1rem 3rem; }
            .mobile-sidebar-toggle { display: block; }
            .navbar-page-badge { display: none; }
            .sidebar-overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.4); z-index: 1029; }
            .sidebar-overlay.show { display: block; }
            .scope-divider { display: none; }
        }

        @media (max-width: 575.98px) { .stat-value { font-size: 1.4rem; } }

        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb { background: var(--gray-200); border-radius: 4px; }

        /* ─── Edit Modal ────────────────────────────────────── */
        .modal-header-gold { background: var(--gold); color: #fff; }
        .modal-header-gold .btn-close { filter: invert(1) brightness(2); }
    </style>
</head>
<body>

<!-- ── Top Navbar ──────────────────────────────────────── -->
<header class="top-navbar no-print">
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
    <span class="navbar-page-badge"><i class="bi bi-currency-exchange me-1"></i> Finance Admin</span>
    <div class="navbar-right">
        <div class="dropdown">
            <button class="nav-icon-btn" data-bs-toggle="dropdown" aria-label="Notifications">
                <i class="bi bi-bell"></i><span class="nav-notif-dot"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="min-width:280px; border-radius:12px; margin-top:8px;">
                <li class="px-3 py-2 border-bottom"><span class="fw-bold" style="font-size:.82rem;">Notifications</span></li>
                <li><a class="dropdown-item py-2" href="#" style="font-size:.82rem;"><i class="bi bi-bar-chart-line text-success me-2"></i> Monthly sales report ready <div class="text-muted" style="font-size:.72rem; padding-left:1.4rem;">Just now</div></a></li>
                <li><a class="dropdown-item py-2" href="#" style="font-size:.82rem;"><i class="bi bi-exclamation-triangle text-warning me-2"></i> Pending payment overdue <div class="text-muted" style="font-size:.72rem; padding-left:1.4rem;">2 hours ago</div></a></li>
                <li class="border-top"><a class="dropdown-item text-center py-2" href="{{ route('finance.activity-logs') }}" style="font-size:.78rem; color:var(--green-700);">View all notifications</a></li>
            </ul>
        </div>
        <div class="navbar-divider d-none d-sm-block"></div>
        <div class="dropdown">
            <a class="user-pill dropdown-toggle" href="#" data-bs-toggle="dropdown">
                <img class="user-avatar" src="{{ optional(auth()->user())->avatar ?: 'https://ui-avatars.com/api/?name=' . urlencode(optional(auth()->user())->name ?? 'Finance Admin') . '&background=1a6932&color=fff&rounded=true&size=64' }}" alt="User avatar">
                <div class="d-none d-md-block" style="line-height:1.2;">
                    <div class="user-pill-name">{{ optional(auth()->user())->name ?? 'Finance Admin' }}</div>
                    <div class="user-pill-role">Admin / Finance</div>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="border-radius:12px; margin-top:8px; min-width:200px;">
                <li class="px-3 py-2 border-bottom">
                    <div class="fw-bold" style="font-size:.83rem;">{{ optional(auth()->user())->name ?? 'Finance Admin' }}</div>
                    <div class="text-muted" style="font-size:.72rem;">{{ optional(auth()->user())->email ?? '' }}</div>
                </li>
                <li><a class="dropdown-item py-2" href="{{ route('finance.profile') }}" style="font-size:.84rem;"><i class="bi bi-person me-2 text-muted"></i>Profile</a></li>
                <li class="border-top">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item py-2 text-danger" type="submit" style="font-size:.84rem;"><i class="bi bi-box-arrow-right me-2"></i>Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>

<div class="sidebar-overlay no-print" id="sidebarOverlay"></div>

<!-- ── Sidebar ─────────────────────────────────────────── -->
<aside class="sidebar no-print" id="mainSidebar">
    <div class="sidebar-inner">
        <div class="sidebar-office-chip">
            <div class="office-label">Role</div>
            <div class="office-name">Finance Admin</div>
        </div>
        <span class="sidebar-section-label">Main Menu</span>
        <a href="{{ route('finance.dashboard') }}" class="sidebar-link {{ request()->routeIs('finance.dashboard') ? 'active' : '' }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a href="{{ route('finance.orders.index') }}" class="sidebar-link {{ request()->routeIs('finance.orders.*') ? 'active' : '' }}"><i class="bi bi-bag-check"></i> Orders</a>
        <a href="{{ route('finance.payments.index') }}" class="sidebar-link {{ request()->routeIs('finance.payments.*') ? 'active' : '' }}"><i class="bi bi-credit-card-2-front"></i> Payments</a>
        <a href="{{ route('finance.revenue.index') }}" class="sidebar-link {{ request()->routeIs('finance.revenue.*') ? 'active' : '' }}"><i class="bi bi-graph-up-arrow"></i> Revenue Monitoring</a>
        <span class="sidebar-section-label">Sales Report</span>
        <a href="{{ route('finance.reports.sales') }}" class="sidebar-link {{ request()->routeIs('finance.reports.*') ? 'active' : '' }}"><i class="bi bi-bar-chart-line"></i> Sales Report</a>
        <span class="sidebar-section-label">System</span>
        <a href="{{ route('finance.activity-logs') }}" class="sidebar-link {{ request()->routeIs('finance.activity-logs') ? 'active' : '' }}"><i class="bi bi-clock-history"></i> Activity Logs</a>
        <div class="sidebar-logout">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-link w-100 text-start border-0 bg-transparent" style="cursor:pointer;"><i class="bi bi-box-arrow-right"></i> Logout</button>
            </form>
        </div>
    </div>
</aside>

<!-- ── Main Content ─────────────────────────────────────── -->
<main class="page-wrapper">

    <!-- Print Header (hidden on screen) -->
    <div class="print-header mb-4">
        <div style="display:flex;align-items:center;gap:1rem;border-bottom:2px solid #0d3b1e;padding-bottom:1rem;margin-bottom:1rem;">
            <div>
                <div style="font-family:'DM Serif Display',serif;font-size:1.4rem;color:#0d3b1e;">E-Agraryo Merkado — Sales Report</div>
                <div style="font-size:0.8rem;color:#64748b;">DAR Region V &middot; Finance Division &middot; Generated: <span id="printDate"></span></div>
            </div>
        </div>
    </div>

    <!-- Page Header -->
    <div class="page-header no-print">
        <div>
            <h1 class="page-header-title">
                <i class="bi bi-bar-chart-line me-2" style="color:var(--green-600); font-size:1.3rem;"></i>
                Sales Report
            </h1>
            <p class="page-header-sub">
                Consolidated sales data — edit-enabled for Finance (Module 8).
                Covers all ARBO transactions across DAR Region V provinces.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <a href="#" class="btn-export-sm" id="exportCsvBtn"><i class="bi bi-filetype-csv"></i> Export CSV</a>
            <a href="#" class="btn-export-sm" id="exportPdfBtn"><i class="bi bi-file-earmark-pdf"></i> Export PDF</a>
            <a href="#" class="btn-export-sm" id="exportXlsBtn"><i class="bi bi-file-earmark-excel"></i> Export Excel</a>
            <button class="btn-generate" id="printBtn"><i class="bi bi-printer"></i> Print Report</button>
        </div>
    </div>

    <!-- ── Edit Access Notice ──────────────────────────── -->
    <div class="edit-notice no-print">
        <i class="bi bi-pencil-square" style="color:var(--green-600);font-size:1rem;flex-shrink:0;"></i>
        <span>
            Finance has <strong>Edit access</strong> on Sales Revenue Reports (Module 8).
            You may update figures, add remarks, and adjust consolidated entries directly from this page.
        </span>
    </div>

    <!-- ── Report Scope Banner ─────────────────────────── -->
    <div class="scope-banner mb-4">
        <div>
            <div class="scope-banner-label">Report Period</div>
            <div class="scope-banner-value" id="bannerPeriod">
                {{ isset($reportFrom) && isset($reportTo)
                    ? \Carbon\Carbon::parse($reportFrom)->format('M d, Y') . ' — ' . \Carbon\Carbon::parse($reportTo)->format('M d, Y')
                    : now()->startOfMonth()->format('M d, Y') . ' — ' . now()->format('M d, Y') }}
            </div>
            <div class="scope-banner-meta">DAR Region V &middot; All Provinces &middot; All ARBOs</div>
        </div>
        <div class="scope-divider"></div>
        <div>
            <div class="scope-banner-label">Total Sales</div>
            <div class="scope-banner-value">₱{{ number_format($reportTotalSales ?? 0, 2) }}</div>
            <div class="scope-banner-meta">{{ number_format($reportTotalOrders ?? 0) }} orders consolidated</div>
        </div>
        <div class="scope-divider"></div>
        <div>
            <div class="scope-banner-label">Total Collected</div>
            <div class="scope-banner-value">₱{{ number_format($reportTotalCollected ?? 0, 2) }}</div>
            <div class="scope-banner-meta">Paid &amp; verified payments only</div>
        </div>
        <div class="scope-divider"></div>
        <div>
            <div class="scope-banner-label">Outstanding Balance</div>
            <div class="scope-banner-value" style="color:var(--gold-mid);">₱{{ number_format($reportTotalBalance ?? 0, 2) }}</div>
            <div class="scope-banner-meta">Pending &amp; partial payments</div>
        </div>
    </div>

    <!-- ── Date Range / Filter Form ───────────────────── -->
    <form method="GET" action="{{ route('finance.reports.sales') }}" id="reportForm" class="no-print">
        <div class="report-filter-bar">
            <div class="filter-group">
                <label>Report Type</label>
                <select name="report_type" class="filter-select" style="min-width:140px;">
                    <option value="summary"   {{ request('report_type','summary') === 'summary'   ? 'selected':'' }}>Summary</option>
                    <option value="detailed"  {{ request('report_type')           === 'detailed'  ? 'selected':'' }}>Detailed</option>
                    <option value="by_arbo"   {{ request('report_type')           === 'by_arbo'   ? 'selected':'' }}>By ARBO</option>
                    <option value="by_province"{{ request('report_type')          === 'by_province'? 'selected':'' }}>By Province</option>
                    <option value="by_product"{{ request('report_type')           === 'by_product' ? 'selected':'' }}>By Product</option>
                </select>
            </div>
            <div class="filter-group">
                <label>From</label>
                <input type="date" name="from" class="filter-input"
                       value="{{ request('from', now()->startOfMonth()->format('Y-m-d')) }}">
            </div>
            <div class="filter-group">
                <label>To</label>
                <input type="date" name="to" class="filter-input"
                       value="{{ request('to', now()->format('Y-m-d')) }}">
            </div>
            <div class="filter-group">
                <label>Province</label>
                <select name="province" class="filter-select">
                    <option value="">All Provinces</option>
                    @foreach(['Albay','Camarines Sur','Camarines Norte','Catanduanes','Masbate','Sorsogon'] as $prov)
                    <option value="{{ $prov }}" {{ request('province') === $prov ? 'selected':'' }}>{{ $prov }}</option>
                    @endforeach
                </select>
            </div>
            <div class="filter-group">
                <label>Payment Status</label>
                <select name="payment_status" class="filter-select">
                    <option value="">All</option>
                    <option value="paid"    {{ request('payment_status') === 'paid'    ? 'selected':'' }}>Paid</option>
                    <option value="pending" {{ request('payment_status') === 'pending' ? 'selected':'' }}>Pending</option>
                    <option value="partial" {{ request('payment_status') === 'partial' ? 'selected':'' }}>Partial</option>
                </select>
            </div>
            <div class="filter-group">
                <label>ARBO</label>
                <select name="arbo_id" class="filter-select" style="min-width:160px;">
                    <option value="">All ARBOs</option>
                    @foreach($arbos ?? [] as $arbo)
                    <option value="{{ $arbo->id }}" {{ request('arbo_id') == $arbo->id ? 'selected':'' }}>{{ $arbo->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn-generate"><i class="bi bi-arrow-clockwise"></i> Generate</button>
            @if(request()->hasAny(['from','to','province','payment_status','arbo_id','report_type']))
            <a href="{{ route('finance.reports.sales') }}" class="btn-export-sm" style="color:#c0392b;background:#fdecea;border-color:#fbd8d4;">
                <i class="bi bi-x-circle"></i> Reset
            </a>
            @endif
        </div>
    </form>

    <!-- ── KPI Summary Cards ───────────────────────────── -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-xl-2">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-green" style="width:42px;height:42px;font-size:1.1rem;">
                    <i class="bi bi-bag-fill"></i>
                </div>
                <div>
                    <div class="stat-value" style="font-size:1.4rem;">{{ number_format($reportTotalOrders ?? 0) }}</div>
                    <p class="stat-label">Total Orders</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-2">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-gold" style="width:42px;height:42px;font-size:1.1rem;">
                    <i class="bi bi-cash-stack"></i>
                </div>
                <div>
                    <div class="stat-value" style="font-size:1.1rem;">₱{{ number_format($reportTotalSales ?? 0, 0) }}</div>
                    <p class="stat-label">Gross Sales</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-2">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-teal" style="width:42px;height:42px;font-size:1.1rem;">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div>
                    <div class="stat-value" style="font-size:1.1rem;">₱{{ number_format($reportTotalCollected ?? 0, 0) }}</div>
                    <p class="stat-label">Collected</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-2">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-red" style="width:42px;height:42px;font-size:1.1rem;">
                    <i class="bi bi-hourglass-split"></i>
                </div>
                <div>
                    <div class="stat-value" style="font-size:1.1rem;">₱{{ number_format($reportTotalBalance ?? 0, 0) }}</div>
                    <p class="stat-label">Outstanding</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-2">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-blue" style="width:42px;height:42px;font-size:1.1rem;">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div>
                    <div class="stat-value" style="font-size:1.4rem;">{{ $reportActiveArbos ?? '—' }}</div>
                    <p class="stat-label">Active ARBOs</p>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-2">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-indigo" style="width:42px;height:42px;font-size:1.1rem;">
                    <i class="bi bi-calculator-fill"></i>
                </div>
                <div>
                    <div class="stat-value" style="font-size:1.1rem;">₱{{ number_format($reportAvgOrder ?? 0, 0) }}</div>
                    <p class="stat-label">Avg. Order</p>
                </div>
            </div>
        </div>
    </div>

    <!-- ── Charts Row ──────────────────────────────────── -->
    <div class="row g-4 mb-4">

        <!-- Daily Sales Trend -->
        <div class="col-lg-8">
            <div class="section-title">
                <div class="section-title-bar"></div>
                Daily Sales Trend
            </div>
            <div class="chart-card">
                <div class="chart-card-header">
                    <span class="chart-card-title">Sales &amp; Collections — Selected Period</span>
                    <div class="d-flex gap-3" style="font-size:.75rem;">
                        <span style="display:flex;align-items:center;gap:5px;"><span style="width:12px;height:3px;background:var(--green-600);border-radius:2px;display:inline-block;"></span>Gross Sales</span>
                        <span style="display:flex;align-items:center;gap:5px;"><span style="width:12px;height:3px;background:var(--gold);border-radius:2px;display:inline-block;"></span>Collected</span>
                    </div>
                </div>
                <div class="p-4" style="height:270px; position:relative;">
                    <canvas id="dailySalesChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Sales by Province Donut -->
        <div class="col-lg-4">
            <div class="section-title">
                <div class="section-title-bar"></div>
                Sales by Province
            </div>
            <div class="chart-card">
                <div class="chart-card-header">
                    <span class="chart-card-title">Province Split</span>
                </div>
                <div class="p-3" style="height:210px; position:relative;">
                    <canvas id="provinceSalesDonut"></canvas>
                </div>
                <div class="px-3 pb-3 d-flex flex-column gap-1" style="font-size:.73rem;">
                    @php
                        $provSales = $provinceSales ?? [
                            ['name'=>'Albay',          'value'=>540000,'color'=>'rgba(31,128,60,0.85)'],
                            ['name'=>'Camarines Sur',  'value'=>320000,'color'=>'rgba(200,146,42,0.85)'],
                            ['name'=>'Sorsogon',       'value'=>210000,'color'=>'rgba(26,115,232,0.85)'],
                            ['name'=>'Camarines Norte','value'=>180000,'color'=>'rgba(124,58,237,0.85)'],
                            ['name'=>'Catanduanes',    'value'=>95000, 'color'=>'rgba(13,138,126,0.85)'],
                            ['name'=>'Masbate',        'value'=>75000, 'color'=>'rgba(192,57,43,0.85)'],
                        ];
                        $grandTotal = collect($provSales)->sum('value') ?: 1;
                    @endphp
                    @foreach($provSales as $ps)
                    @php $pct = round((is_array($ps) ? $ps['value'] : $ps->value) / $grandTotal * 100, 1); @endphp
                    <div style="display:flex;align-items:center;justify-content:space-between;">
                        <span style="display:flex;align-items:center;gap:6px;">
                            <span style="width:10px;height:10px;border-radius:50%;background:{{ is_array($ps) ? $ps['color'] : $ps->color }};display:inline-block;flex-shrink:0;"></span>
                            {{ is_array($ps) ? $ps['name'] : $ps->name }}
                        </span>
                        <span style="font-weight:700;color:var(--text-main);">{{ $pct }}%</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    <!-- ── Report View Tabs ────────────────────────────── -->
    <div class="tab-pill-wrap no-print">
        <a href="{{ route('finance.reports.sales', array_merge(request()->query(), ['view'=>'summary'])) }}"
           class="tab-pill {{ request('view','summary') === 'summary' ? 'active' : '' }}">
            <i class="bi bi-table"></i> Summary
        </a>
        <a href="{{ route('finance.reports.sales', array_merge(request()->query(), ['view'=>'by_arbo'])) }}"
           class="tab-pill {{ request('view') === 'by_arbo' ? 'active' : '' }}">
            <i class="bi bi-buildings"></i> By ARBO
        </a>
        <a href="{{ route('finance.reports.sales', array_merge(request()->query(), ['view'=>'by_province'])) }}"
           class="tab-pill {{ request('view') === 'by_province' ? 'active' : '' }}">
            <i class="bi bi-geo-alt"></i> By Province
        </a>
        <a href="{{ route('finance.reports.sales', array_merge(request()->query(), ['view'=>'by_product'])) }}"
           class="tab-pill {{ request('view') === 'by_product' ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> By Product
        </a>
        <a href="{{ route('finance.reports.sales', array_merge(request()->query(), ['view'=>'transactions'])) }}"
           class="tab-pill {{ request('view') === 'transactions' ? 'active' : '' }}">
            <i class="bi bi-receipt-cutoff"></i> All Transactions
        </a>
    </div>

    <!-- ══════════════════════════════════════════════════
         VIEW: SUMMARY (default)
    ══════════════════════════════════════════════════════ -->
    @if(request('view','summary') === 'summary')

    <!-- Monthly Summary Table -->
    <div class="section-title">
        <div class="section-title-bar"></div>
        Monthly Sales Summary — {{ now()->year }}
    </div>

    <div class="table-card mb-4">
        <div class="table-card-header">
            <h6 class="table-card-title">
                <i class="bi bi-calendar-month"></i>
                Month-by-Month Breakdown
            </h6>
            <button type="button" class="btn-edit-sm" data-bs-toggle="modal" data-bs-target="#editSummaryModal">
                <i class="bi bi-pencil"></i> Edit Report
            </button>
        </div>
        <div class="table-responsive">
            <table class="fin-table">
                <thead>
                    <tr>
                        <th>Month</th>
                        <th>No. of Orders</th>
                        <th>Gross Sales</th>
                        <th>Collected</th>
                        <th>Outstanding</th>
                        <th>Cancelled</th>
                        <th>Avg. Order Value</th>
                        <th>Growth (MoM)</th>
                        <th>Remarks</th>
                        <th class="no-print"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $monthlySummary = $monthlySummary ?? collect([
                            (object)['month'=>'January',  'orders'=>48, 'gross'=>192000,'collected'=>165000,'outstanding'=>27000,'cancelled'=>3,'avg'=>4000,'growth'=>0,    'remarks'=>''],
                            (object)['month'=>'February', 'orders'=>55, 'gross'=>231000,'collected'=>218000,'outstanding'=>13000,'cancelled'=>2,'avg'=>4200,'growth'=>20.3,  'remarks'=>''],
                            (object)['month'=>'March',    'orders'=>39, 'gross'=>156000,'collected'=>140000,'outstanding'=>16000,'cancelled'=>4,'avg'=>4000,'growth'=>-32.5, 'remarks'=>'Q1 close'],
                            (object)['month'=>'April',    'orders'=>82, 'gross'=>369000,'collected'=>350000,'outstanding'=>19000,'cancelled'=>1,'avg'=>4500,'growth'=>136.5, 'remarks'=>'Harvest season'],
                            (object)['month'=>'May',      'orders'=>74, 'gross'=>333000,'collected'=>310000,'outstanding'=>23000,'cancelled'=>2,'avg'=>4500,'growth'=>-9.8,  'remarks'=>''],
                            (object)['month'=>'June',     'orders'=>88, 'gross'=>396000,'collected'=>375000,'outstanding'=>21000,'cancelled'=>0,'avg'=>4500,'growth'=>18.9,  'remarks'=>''],
                            (object)['month'=>'July',     'orders'=>103,'gross'=>463500,'collected'=>430000,'outstanding'=>33500,'cancelled'=>2,'avg'=>4500,'growth'=>17.0,  'remarks'=>'Mid-year peak'],
                            (object)['month'=>'August',   'orders'=>72, 'gross'=>324000,'collected'=>300000,'outstanding'=>24000,'cancelled'=>3,'avg'=>4500,'growth'=>-30.0, 'remarks'=>''],
                            (object)['month'=>'September','orders'=>0,  'gross'=>0,     'collected'=>0,     'outstanding'=>0,    'cancelled'=>0,'avg'=>0,   'growth'=>0,     'remarks'=>''],
                            (object)['month'=>'October',  'orders'=>0,  'gross'=>0,     'collected'=>0,     'outstanding'=>0,    'cancelled'=>0,'avg'=>0,   'growth'=>0,     'remarks'=>''],
                            (object)['month'=>'November', 'orders'=>0,  'gross'=>0,     'collected'=>0,     'outstanding'=>0,    'cancelled'=>0,'avg'=>0,   'growth'=>0,     'remarks'=>''],
                            (object)['month'=>'December', 'orders'=>0,  'gross'=>0,     'collected'=>0,     'outstanding'=>0,    'cancelled'=>0,'avg'=>0,   'growth'=>0,     'remarks'=>''],
                        ]);
                    @endphp
                    @foreach($monthlySummary as $row)
                    <tr {{ $row->orders == 0 ? 'style="color:var(--gray-400);"' : '' }}>
                        <td style="font-weight:600;">{{ $row->month }}</td>
                        <td>{{ $row->orders > 0 ? number_format($row->orders) : '—' }}</td>
                        <td class="{{ $row->gross > 0 ? 'amount-cell' : '' }}">
                            {{ $row->gross > 0 ? '₱' . number_format($row->gross, 2) : '—' }}
                        </td>
                        <td style="font-weight:600; color:var(--green-700);">
                            {{ $row->collected > 0 ? '₱' . number_format($row->collected, 2) : '—' }}
                        </td>
                        <td style="font-weight:600; color:{{ $row->outstanding > 0 ? '#c0392b' : 'var(--gray-400)' }};">
                            {{ $row->outstanding > 0 ? '₱' . number_format($row->outstanding, 2) : '—' }}
                        </td>
                        <td style="color:{{ $row->cancelled > 0 ? '#c0392b' : 'var(--gray-400)' }}; font-weight:600;">
                            {{ $row->cancelled > 0 ? $row->cancelled : '—' }}
                        </td>
                        <td>{{ $row->avg > 0 ? '₱' . number_format($row->avg, 2) : '—' }}</td>
                        <td>
                            @if($row->growth > 0)
                                <span class="growth-badge growth-up"><i class="bi bi-arrow-up-short"></i>+{{ $row->growth }}%</span>
                            @elseif($row->growth < 0)
                                <span class="growth-badge growth-down"><i class="bi bi-arrow-down-short"></i>{{ $row->growth }}%</span>
                            @else
                                <span style="color:var(--gray-400);font-size:.78rem;">—</span>
                            @endif
                        </td>
                        <td style="font-size:.78rem;color:var(--text-muted);">
                            {{ $row->remarks ?: '—' }}
                        </td>
                        <td class="no-print">
                            @if($row->orders > 0)
                            <button type="button" class="btn-edit-sm open-row-edit"
                                    data-month="{{ $row->month }}"
                                    data-remarks="{{ $row->remarks ?? '' }}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td>TOTAL (YTD)</td>
                        <td>{{ number_format($monthlySummary->sum('orders')) }}</td>
                        <td>₱{{ number_format($monthlySummary->sum('gross'), 2) }}</td>
                        <td>₱{{ number_format($monthlySummary->sum('collected'), 2) }}</td>
                        <td>₱{{ number_format($monthlySummary->sum('outstanding'), 2) }}</td>
                        <td>{{ $monthlySummary->sum('cancelled') }}</td>
                        <td colspan="3"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    @endif

    <!-- ══════════════════════════════════════════════════
         VIEW: BY ARBO
    ══════════════════════════════════════════════════════ -->
    @if(request('view') === 'by_arbo')

    <div class="section-title">
        <div class="section-title-bar"></div>
        Sales Report — By ARBO
    </div>

    <div class="table-card mb-4">
        <div class="table-card-header">
            <h6 class="table-card-title"><i class="bi bi-buildings"></i> ARBO Sales Breakdown</h6>
            <button type="button" class="btn-edit-sm no-print" data-bs-toggle="modal" data-bs-target="#editSummaryModal">
                <i class="bi bi-pencil"></i> Edit Report
            </button>
        </div>
        <div class="table-responsive">
            <table class="fin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ARBO Name</th>
                        <th>Province</th>
                        <th>Orders</th>
                        <th>Gross Sales</th>
                        <th>Collected</th>
                        <th>Outstanding</th>
                        <th>Share</th>
                        <th>Growth</th>
                        <th>Remarks</th>
                        <th class="no-print"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $arboSales = $arboSales ?? collect([
                            (object)['rank'=>1,'arbo'=>'Kilusang Samahan ng Magsasaka','province'=>'Albay','orders'=>142,'gross'=>540000,'collected'=>505000,'outstanding'=>35000,'share'=>34.1,'growth'=>12.4,'remarks'=>''],
                            (object)['rank'=>2,'arbo'=>'Bagong Araw Farmers Coop','province'=>'Camarines Sur','orders'=>98,'gross'=>320000,'collected'=>295000,'outstanding'=>25000,'share'=>20.2,'growth'=>-3.1,'remarks'=>''],
                            (object)['rank'=>3,'arbo'=>'Lakbay Ani Producers Assoc.','province'=>'Sorsogon','orders'=>76,'gross'=>210000,'collected'=>198000,'outstanding'=>12000,'share'=>13.3,'growth'=>8.7,'remarks'=>''],
                            (object)['rank'=>4,'arbo'=>'Malinao Organic Growers','province'=>'Camarines Norte','orders'=>60,'gross'=>180000,'collected'=>165000,'outstanding'=>15000,'share'=>11.4,'growth'=>0,'remarks'=>''],
                            (object)['rank'=>5,'arbo'=>'Catanduanes Upland ARBO','province'=>'Catanduanes','orders'=>34,'gross'=>95000,'collected'=>88000,'outstanding'=>7000,'share'=>6.0,'growth'=>21.0,'remarks'=>''],
                            (object)['rank'=>6,'arbo'=>'Masbate Coastal Producers','province'=>'Masbate','orders'=>28,'gross'=>75000,'collected'=>68000,'outstanding'=>7000,'share'=>4.7,'growth'=>-7.5,'remarks'=>''],
                        ]);
                        $arboGrand = $arboSales->sum('gross') ?: 1;
                    @endphp
                    @foreach($arboSales as $row)
                    <tr>
                        <td style="font-weight:800;color:var(--gold);font-size:.8rem;">{{ $row->rank }}</td>
                        <td class="name-cell">{{ $row->arbo }}</td>
                        <td><span class="province-badge">{{ $row->province }}</span></td>
                        <td style="font-weight:600;">{{ number_format($row->orders) }}</td>
                        <td>
                            <div class="amount-cell">₱{{ number_format($row->gross, 2) }}</div>
                            <div class="rev-bar" style="width:100px;">
                                <div class="rev-bar-fill" style="width:{{ ($row->gross/$arboGrand)*100 }}%;"></div>
                            </div>
                        </td>
                        <td style="font-weight:600;color:var(--green-700);">₱{{ number_format($row->collected, 2) }}</td>
                        <td style="font-weight:600;color:{{ $row->outstanding>0?'#c0392b':'var(--green-600)' }};">
                            {{ $row->outstanding > 0 ? '₱'.number_format($row->outstanding,2) : 'Settled' }}
                        </td>
                        <td style="font-weight:700;">{{ $row->share }}%</td>
                        <td>
                            @if($row->growth > 0) <span class="growth-badge growth-up"><i class="bi bi-arrow-up-short"></i>+{{ $row->growth }}%</span>
                            @elseif($row->growth < 0) <span class="growth-badge growth-down"><i class="bi bi-arrow-down-short"></i>{{ $row->growth }}%</span>
                            @else <span class="growth-badge growth-flat"><i class="bi bi-dash"></i>0%</span>
                            @endif
                        </td>
                        <td style="font-size:.78rem;color:var(--text-muted);">{{ $row->remarks ?: '—' }}</td>
                        <td class="no-print">
                            <button type="button" class="btn-edit-sm open-row-edit"
                                    data-month="{{ $row->arbo }}" data-remarks="{{ $row->remarks ?? '' }}">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">GRAND TOTAL</td>
                        <td>{{ number_format($arboSales->sum('orders')) }}</td>
                        <td>₱{{ number_format($arboSales->sum('gross'), 2) }}</td>
                        <td>₱{{ number_format($arboSales->sum('collected'), 2) }}</td>
                        <td>₱{{ number_format($arboSales->sum('outstanding'), 2) }}</td>
                        <td>100%</td>
                        <td colspan="3"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    @endif

    <!-- ══════════════════════════════════════════════════
         VIEW: BY PROVINCE
    ══════════════════════════════════════════════════════ -->
    @if(request('view') === 'by_province')

    <div class="section-title">
        <div class="section-title-bar"></div>
        Sales Report — By Province
    </div>

    <div class="table-card mb-4">
        <div class="table-card-header">
            <h6 class="table-card-title"><i class="bi bi-geo-alt-fill"></i> Province Sales Breakdown</h6>
            <button type="button" class="btn-edit-sm no-print" data-bs-toggle="modal" data-bs-target="#editSummaryModal">
                <i class="bi bi-pencil"></i> Edit Report
            </button>
        </div>
        <div class="table-responsive">
            <table class="fin-table">
                <thead>
                    <tr>
                        <th>Province</th>
                        <th>ARBOs Active</th>
                        <th>Orders</th>
                        <th>Gross Sales</th>
                        <th>Collected</th>
                        <th>Outstanding</th>
                        <th>Revenue Share</th>
                        <th>Avg. Order</th>
                        <th>Growth</th>
                        <th>Remarks</th>
                        <th class="no-print"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $provData = $provinceBreakdown ?? collect([
                            (object)['province'=>'Albay',          'arbos'=>8,'orders'=>142,'gross'=>540000,'collected'=>505000,'outstanding'=>35000,'share'=>34.1,'avg'=>3803,'growth'=>12.4,'remarks'=>''],
                            (object)['province'=>'Camarines Sur',  'arbos'=>6,'orders'=>98, 'gross'=>320000,'collected'=>295000,'outstanding'=>25000,'share'=>20.2,'avg'=>3265,'growth'=>-3.1,'remarks'=>''],
                            (object)['province'=>'Sorsogon',       'arbos'=>4,'orders'=>76, 'gross'=>210000,'collected'=>198000,'outstanding'=>12000,'share'=>13.3,'avg'=>2763,'growth'=>8.7, 'remarks'=>''],
                            (object)['province'=>'Camarines Norte','arbos'=>3,'orders'=>60, 'gross'=>180000,'collected'=>165000,'outstanding'=>15000,'share'=>11.4,'avg'=>3000,'growth'=>0,   'remarks'=>''],
                            (object)['province'=>'Catanduanes',    'arbos'=>2,'orders'=>34, 'gross'=>95000, 'collected'=>88000, 'outstanding'=>7000, 'share'=>6.0, 'avg'=>2794,'growth'=>21.0,'remarks'=>''],
                            (object)['province'=>'Masbate',        'arbos'=>2,'orders'=>28, 'gross'=>75000, 'collected'=>68000, 'outstanding'=>7000, 'share'=>4.7, 'avg'=>2678,'growth'=>-7.5,'remarks'=>''],
                        ]);
                    @endphp
                    @foreach($provData as $row)
                    <tr>
                        <td><span class="province-badge" style="font-size:.8rem;padding:3px 10px;">{{ $row->province }}</span></td>
                        <td style="font-weight:600;">{{ $row->arbos }}</td>
                        <td style="font-weight:600;">{{ number_format($row->orders) }}</td>
                        <td class="amount-cell">₱{{ number_format($row->gross, 2) }}</td>
                        <td style="font-weight:600;color:var(--green-700);">₱{{ number_format($row->collected, 2) }}</td>
                        <td style="font-weight:600;color:{{ $row->outstanding>0?'#c0392b':'var(--green-600)' }};">
                            {{ $row->outstanding > 0 ? '₱'.number_format($row->outstanding,2) : 'Settled' }}
                        </td>
                        <td>
                            <div style="font-weight:700;">{{ $row->share }}%</div>
                            <div class="rev-bar" style="width:80px;margin-top:4px;">
                                <div class="rev-bar-fill" style="width:{{ $row->share * 2.5 }}%;"></div>
                            </div>
                        </td>
                        <td>₱{{ number_format($row->avg, 2) }}</td>
                        <td>
                            @if($row->growth > 0) <span class="growth-badge growth-up"><i class="bi bi-arrow-up-short"></i>+{{ $row->growth }}%</span>
                            @elseif($row->growth < 0) <span class="growth-badge growth-down"><i class="bi bi-arrow-down-short"></i>{{ $row->growth }}%</span>
                            @else <span class="growth-badge growth-flat"><i class="bi bi-dash"></i>0%</span>
                            @endif
                        </td>
                        <td style="font-size:.78rem;color:var(--text-muted);">{{ $row->remarks ?: '—' }}</td>
                        <td class="no-print">
                            <button type="button" class="btn-edit-sm open-row-edit"
                                    data-month="{{ $row->province }}" data-remarks="{{ $row->remarks ?? '' }}">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td>GRAND TOTAL</td>
                        <td>{{ $provData->sum('arbos') }}</td>
                        <td>{{ number_format($provData->sum('orders')) }}</td>
                        <td>₱{{ number_format($provData->sum('gross'), 2) }}</td>
                        <td>₱{{ number_format($provData->sum('collected'), 2) }}</td>
                        <td>₱{{ number_format($provData->sum('outstanding'), 2) }}</td>
                        <td>100%</td>
                        <td colspan="4"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    @endif

    <!-- ══════════════════════════════════════════════════
         VIEW: BY PRODUCT
    ══════════════════════════════════════════════════════ -->
    @if(request('view') === 'by_product')

    <div class="section-title">
        <div class="section-title-bar"></div>
        Sales Report — By Product / Category
    </div>

    <div class="table-card mb-4">
        <div class="table-card-header">
            <h6 class="table-card-title"><i class="bi bi-box-seam"></i> Product Category Breakdown</h6>
            <button type="button" class="btn-edit-sm no-print" data-bs-toggle="modal" data-bs-target="#editSummaryModal">
                <i class="bi bi-pencil"></i> Edit Report
            </button>
        </div>
        <div class="table-responsive">
            <table class="fin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Category</th>
                        <th>Units Sold</th>
                        <th>No. of Orders</th>
                        <th>Gross Sales</th>
                        <th>Avg. Unit Price</th>
                        <th>Revenue Share</th>
                        <th>Top ARBO Seller</th>
                        <th>Growth</th>
                        <th class="no-print"></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $productData = $productBreakdown ?? collect([
                            (object)['rank'=>1,'category'=>'Rice / Grains',    'units'=>8420,'orders'=>142,'gross'=>280000,'avg_price'=>33.25, 'share'=>27.9,'top_arbo'=>'Kilusang Samahan',   'growth'=>5.2],
                            (object)['rank'=>2,'category'=>'Vegetables',       'units'=>5310,'orders'=>98, 'gross'=>175000,'avg_price'=>32.96, 'share'=>17.4,'top_arbo'=>'Bagong Araw Farmers', 'growth'=>-2.1],
                            (object)['rank'=>3,'category'=>'Fruits',           'units'=>3890,'orders'=>76, 'gross'=>142000,'avg_price'=>36.50, 'share'=>14.1,'top_arbo'=>'Catanduanes Upland',  'growth'=>9.8],
                            (object)['rank'=>4,'category'=>'Livestock / Poultry','units'=>640,'orders'=>60,'gross'=>98000, 'avg_price'=>153.13,'share'=>9.8, 'top_arbo'=>'Malinao Organic',      'growth'=>0],
                            (object)['rank'=>5,'category'=>'Fishery Products', 'units'=>2200,'orders'=>34, 'gross'=>64000, 'avg_price'=>29.09, 'share'=>6.4, 'top_arbo'=>'Masbate Coastal',     'growth'=>15.3],
                            (object)['rank'=>6,'category'=>'Processed / Value-Added','units'=>1100,'orders'=>28,'gross'=>47000,'avg_price'=>42.73,'share'=>4.7,'top_arbo'=>'Lakbay Ani Producers','growth'=>33.0],
                        ]);
                        $prodGrand = $productData->sum('gross') ?: 1;
                    @endphp
                    @foreach($productData as $row)
                    <tr>
                        <td style="font-weight:800;color:var(--gold);font-size:.8rem;">{{ $row->rank }}</td>
                        <td class="name-cell">{{ $row->category }}</td>
                        <td style="font-weight:600;">{{ number_format($row->units) }}</td>
                        <td style="font-weight:600;">{{ number_format($row->orders) }}</td>
                        <td>
                            <div class="amount-cell">₱{{ number_format($row->gross, 2) }}</div>
                            <div class="rev-bar" style="width:100px;">
                                <div class="rev-bar-fill" style="width:{{ ($row->gross/$prodGrand)*100 }}%;"></div>
                            </div>
                        </td>
                        <td style="font-size:.83rem;font-weight:600;">₱{{ number_format($row->avg_price, 2) }}</td>
                        <td style="font-weight:700;">{{ $row->share }}%</td>
                        <td style="font-size:.78rem;color:var(--green-700);font-weight:600;">{{ $row->top_arbo }}</td>
                        <td>
                            @if($row->growth > 0) <span class="growth-badge growth-up"><i class="bi bi-arrow-up-short"></i>+{{ $row->growth }}%</span>
                            @elseif($row->growth < 0) <span class="growth-badge growth-down"><i class="bi bi-arrow-down-short"></i>{{ $row->growth }}%</span>
                            @else <span class="growth-badge growth-flat"><i class="bi bi-dash"></i>0%</span>
                            @endif
                        </td>
                        <td class="no-print">
                            <button type="button" class="btn-edit-sm"><i class="bi bi-pencil"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2">GRAND TOTAL</td>
                        <td>{{ number_format($productData->sum('units')) }}</td>
                        <td>{{ number_format($productData->sum('orders')) }}</td>
                        <td>₱{{ number_format($productData->sum('gross'), 2) }}</td>
                        <td colspan="5"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    @endif

    <!-- ══════════════════════════════════════════════════
         VIEW: ALL TRANSACTIONS
    ══════════════════════════════════════════════════════ -->
    @if(request('view') === 'transactions')

    <div class="section-title">
        <div class="section-title-bar"></div>
        All Transactions — Detailed Ledger
    </div>

    <div class="table-card mb-4">
        <div class="table-card-header">
            <h6 class="table-card-title">
                <i class="bi bi-receipt-cutoff"></i>
                Transaction Ledger
                @if(isset($transactions) && method_exists($transactions, 'total'))
                <span style="font-size:.72rem;font-weight:400;color:var(--text-muted);margin-left:6px;">{{ number_format($transactions->total()) }} records</span>
                @endif
            </h6>
            <span style="font-size:.73rem;color:var(--text-muted);" id="tableDate"></span>
        </div>
        <div class="table-responsive">
            <table class="fin-table">
                <thead>
                    <tr>
                        <th>Order No.</th>
                        <th>Date</th>
                        <th>Buyer ARBO</th>
                        <th>Seller ARBO</th>
                        <th>Province</th>
                        <th>Products</th>
                        <th>Gross Amount</th>
                        <th>Payment Status</th>
                        <th>Collected</th>
                        <th>Balance</th>
                        <th>Ref No.</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions ?? [] as $txn)
                    <tr>
                        <td><span class="order-no">#{{ $txn->order_no ?? '—' }}</span></td>
                        <td style="font-size:.78rem;white-space:nowrap;color:var(--text-muted);">
                            {{ isset($txn->created_at) ? \Carbon\Carbon::parse($txn->created_at)->format('M d, Y') : '—' }}
                        </td>
                        <td class="name-cell">{{ $txn->buyer_arbo ?? '—' }}</td>
                        <td style="font-size:.83rem;">{{ $txn->seller_arbo ?? '—' }}</td>
                        <td><span class="province-badge">{{ $txn->province ?? '—' }}</span></td>
                        <td style="font-size:.78rem;max-width:140px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $txn->products ?? '—' }}</td>
                        <td class="amount-cell">₱{{ number_format($txn->amount ?? 0, 2) }}</td>
                        <td>
                            @php
                                $ps = strtolower($txn->payment_status ?? 'pending');
                                $psMap = ['paid'=>'paid','pending'=>'pending','partial'=>'partial','cancelled'=>'cancelled'];
                                $psCls = $psMap[$ps] ?? 'pending';
                            @endphp
                            <span class="status-badge status-{{ $psCls }}">
                                <span class="status-dot"></span> {{ ucfirst($ps) }}
                            </span>
                        </td>
                        <td style="font-weight:600;color:var(--green-700);">₱{{ number_format($txn->collected ?? 0, 2) }}</td>
                        <td style="font-weight:600;color:{{ ($txn->balance ?? 0) > 0 ? '#c0392b' : 'var(--green-600)' }};">
                            {{ ($txn->balance ?? 0) > 0 ? '₱'.number_format($txn->balance,2) : 'Settled' }}
                        </td>
                        <td style="font-family:'Courier New',monospace;font-size:.78rem;color:var(--text-muted);">{{ $txn->reference_no ?? '—' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="11">
                            <div class="empty-state">
                                <i class="bi bi-receipt-cutoff"></i>
                                <p>No transactions found for the selected period.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(isset($transactions) && method_exists($transactions, 'links') && $transactions->lastPage() > 1)
        <div class="pagination-wrap no-print">
            <span class="pagination-info">Showing {{ $transactions->firstItem() ?? 0 }}–{{ $transactions->lastItem() ?? 0 }} of {{ number_format($transactions->total()) }}</span>
            {{ $transactions->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>

    @endif

</main>

<!-- ── Edit Report Modal ───────────────────────────────── -->
<div class="modal fade" id="editSummaryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header modal-header-gold">
                <h5 class="modal-title" style="font-size:.95rem;">
                    <i class="bi bi-pencil-square me-2"></i> Edit Sales Report Entry
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('finance.reports.sales.update') ?? '#' }}" id="editReportForm">
                @csrf
                @method('PATCH')
                <input type="hidden" name="entry_key" id="editEntryKey">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" style="font-size:.82rem;font-weight:600;">Entry</label>
                        <input type="text" class="form-control form-control-sm" id="editEntryLabel" readonly
                               style="background:var(--gray-50);border-radius:8px;font-size:.82rem;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size:.82rem;font-weight:600;">Adjusted Gross Sales (₱)</label>
                        <input type="number" name="adjusted_gross" id="editGross" step="0.01" min="0"
                               class="form-control form-control-sm" placeholder="Leave blank to keep original"
                               style="border-radius:8px;font-size:.82rem;">
                        <div class="form-text" style="font-size:.72rem;">Finance can adjust consolidated figures for corrections or allied costs.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size:.82rem;font-weight:600;">Adjustment Reason</label>
                        <select name="adjustment_reason" class="form-select form-select-sm" style="border-radius:8px;font-size:.82rem;">
                            <option value="">Select reason…</option>
                            <option>Returned goods deduction</option>
                            <option>Allied cost adjustment</option>
                            <option>Data correction / encoding error</option>
                            <option>Consolidation update</option>
                            <option>Other</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-size:.82rem;font-weight:600;">Remarks / Notes</label>
                        <textarea name="remarks" id="editRemarks" class="form-control form-control-sm" rows="3"
                                  placeholder="Add a note for this entry…"
                                  style="border-radius:8px;font-size:.82rem;"></textarea>
                    </div>
                    <div style="background:var(--gold-light);border:1px solid var(--gold-mid);border-radius:8px;padding:.65rem 1rem;font-size:.75rem;color:#7a5a10;">
                        <i class="bi bi-info-circle me-1"></i>
                        All edits are logged in the Activity Log and traceable by the RO V Super Admin (Audit Logs — Module 9).
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm" style="background:var(--gold);color:#fff;border-radius:8px;font-weight:700;padding:6px 18px;">
                        <i class="bi bi-save me-1"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

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

    // ── Date Labels ────────────────────────────────────
    const now = new Date();
    const dateStr = now.toLocaleDateString('en-PH', { year:'numeric', month:'long', day:'numeric' });
    const tbl = document.getElementById('tableDate');
    if (tbl) tbl.textContent = dateStr;
    const pd = document.getElementById('printDate');
    if (pd) pd.textContent = dateStr;

    // ── Mobile Sidebar ─────────────────────────────────
    const toggle  = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('mainSidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const openSidebar  = () => { sidebar.classList.add('show'); overlay.classList.add('show'); document.body.style.overflow='hidden'; };
    const closeSidebar = () => { sidebar.classList.remove('show'); overlay.classList.remove('show'); document.body.style.overflow=''; };
    if (toggle)  toggle.addEventListener('click', openSidebar);
    if (overlay) overlay.addEventListener('click', closeSidebar);

    // ── Daily Sales Line Chart ─────────────────────────
    const dailyCtx = document.getElementById('dailySalesChart');
    if (dailyCtx) {
        const dailyLabels = {!! json_encode($dailyLabels ?? ['Jul 1','Jul 2','Jul 3','Jul 4','Jul 5','Jul 6','Jul 7','Jul 8','Jul 9','Jul 10','Jul 11','Jul 12','Jul 13','Jul 14','Jul 15','Jul 16','Jul 17','Jul 18']) !!};
        const dailySales  = {!! json_encode($dailySales  ?? [18000,22000,15000,31000,27000,19000,42000,38000,25000,29000,33000,41000,36000,28000,45000,52000,39000,47000]) !!};
        const dailyColl   = {!! json_encode($dailyCollected ?? [15000,20000,13000,28000,25000,17000,39000,35000,22000,26000,30000,38000,32000,25000,41000,48000,36000,44000]) !!};

        new Chart(dailyCtx.getContext('2d'), {
            type: 'line',
            data: {
                labels: dailyLabels,
                datasets: [
                    {
                        label: 'Gross Sales',
                        data: dailySales,
                        borderColor: 'rgba(31,128,60,1)',
                        backgroundColor: 'rgba(31,128,60,0.07)',
                        borderWidth: 2.5, fill: true, tension: 0.4,
                        pointRadius: 3, pointBackgroundColor: '#fff',
                        pointBorderColor: 'rgba(31,128,60,1)', pointBorderWidth: 2,
                        pointHoverRadius: 5,
                    },
                    {
                        label: 'Collected',
                        data: dailyColl,
                        borderColor: 'rgba(200,146,42,0.9)',
                        backgroundColor: 'transparent',
                        borderWidth: 2, borderDash: [5, 3], fill: false, tension: 0.4,
                        pointRadius: 3, pointBackgroundColor: '#fff',
                        pointBorderColor: 'rgba(200,146,42,0.9)', pointBorderWidth: 2,
                        pointHoverRadius: 5,
                    }
                ]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: { label: c => ` ${c.dataset.label}: ₱${Number(c.raw).toLocaleString('en-PH',{minimumFractionDigits:2})}` },
                        backgroundColor: '#0d3b1e', titleColor: '#f5d08a', bodyColor: '#fff',
                        padding: 10, cornerRadius: 8,
                    }
                },
                scales: {
                    x: { grid:{display:false}, ticks:{font:{size:10}, color:'#94a3b8', maxRotation:45, minRotation:30} },
                    y: {
                        grid:{color:'#f1f3f5'},
                        ticks:{font:{size:11}, color:'#94a3b8', callback: v => '₱'+(v>=1000?(v/1000).toFixed(0)+'k':v)},
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // ── Province Sales Donut ───────────────────────────
    const provCtx = document.getElementById('provinceSalesDonut');
    if (provCtx) {
        const provLabels = {!! json_encode(isset($provinceSales) ? collect($provinceSales)->pluck('name')->toArray() : ['Albay','Camarines Sur','Sorsogon','Camarines Norte','Catanduanes','Masbate']) !!};
        const provData   = {!! json_encode(isset($provinceSales) ? collect($provinceSales)->pluck('value')->toArray() : [540000,320000,210000,180000,95000,75000]) !!};
        const provColors = ['rgba(31,128,60,0.85)','rgba(200,146,42,0.85)','rgba(26,115,232,0.85)','rgba(124,58,237,0.85)','rgba(13,138,126,0.85)','rgba(192,57,43,0.85)'];

        new Chart(provCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: provLabels,
                datasets: [{ data: provData, backgroundColor: provColors, borderColor: '#fff', borderWidth: 3, hoverOffset: 6 }]
            },
            options: {
                responsive: true, maintainAspectRatio: false, cutout: '65%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(ctx) {
                                const total = ctx.dataset.data.reduce((a,b)=>a+b,0);
                                const pct = total > 0 ? ((ctx.raw/total)*100).toFixed(1) : 0;
                                return ` ${ctx.label}: ₱${ctx.raw.toLocaleString()} (${pct}%)`;
                            }
                        }
                    }
                }
            }
        });
    }

    // ── Edit Modal: Row Buttons ────────────────────────
    const editModal  = new bootstrap.Modal(document.getElementById('editSummaryModal'));
    document.querySelectorAll('.open-row-edit').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            document.getElementById('editEntryLabel').value  = this.dataset.month || '';
            document.getElementById('editEntryKey').value    = this.dataset.month || '';
            document.getElementById('editRemarks').value     = this.dataset.remarks || '';
            document.getElementById('editGross').value       = '';
            editModal.show();
        });
    });

    // ── Export Buttons ─────────────────────────────────
    function exportWith(type) {
        const params = new URLSearchParams(window.location.search);
        params.set('export', type);
        window.location.href = '{{ route('finance.reports.sales') }}?' + params.toString();
    }
    document.getElementById('exportCsvBtn')?.addEventListener('click', e => { e.preventDefault(); exportWith('csv'); });
    document.getElementById('exportXlsBtn')?.addEventListener('click', e => { e.preventDefault(); exportWith('xlsx'); });
    document.getElementById('exportPdfBtn')?.addEventListener('click', e => { e.preventDefault(); exportWith('pdf'); });
    document.getElementById('printBtn')?.addEventListener('click', function(e) { e.preventDefault(); window.print(); });

    // ── Quick-select date shortcuts ────────────────────
    // (Shortcut pills can be wired here if needed)

});
</script>

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
    const INACTIVITY_MS = 15 * 60 * 1000;
    const WARNING_MS    = 10 * 1000;
    let lastActivity = Date.now(), performedLogout = false, warningShown = false,
        countdownInterval = null, modalInstance = null;

    function getCsrf(){
        const form = document.getElementById('inactivityLogoutForm');
        const t = form ? form.querySelector('input[name="_token"]') : null;
        return t ? t.value : (document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '');
    }

    async function performLogout(){
        if (performedLogout) return; performedLogout = true;
        try { await fetch('{{ route('logout') }}', { method:'POST', credentials:'same-origin', body: new URLSearchParams({ _token: getCsrf() }) }); } catch(e){}
        setTimeout(() => { window.location = '/login'; }, 200);
    }

    function showWarning(){
        if (warningShown || performedLogout) return; warningShown = true;
        const modalEl = document.getElementById('inactivityWarningModal');
        const countEl = document.getElementById('idleCountdown');
        if (!modalInstance) modalInstance = new bootstrap.Modal(modalEl, { backdrop:'static', keyboard:false });
        modalInstance.show();
        let seconds = Math.ceil(WARNING_MS / 1000);
        if (countEl) countEl.textContent = seconds;
        countdownInterval = setInterval(() => {
            seconds -= 1;
            if (countEl) countEl.textContent = Math.max(0, seconds);
            if (seconds <= 0) { clearInterval(countdownInterval); countdownInterval = null; performLogout(); }
        }, 1000);
    }

    function hideWarning(){
        if (!warningShown) return; warningShown = false;
        if (countdownInterval) { clearInterval(countdownInterval); countdownInterval = null; }
        if (modalInstance) modalInstance.hide();
        const countEl = document.getElementById('idleCountdown');
        if (countEl) countEl.textContent = Math.ceil(WARNING_MS / 1000);
    }

    function markActivity(e){
        if (e && e.isTrusted === false) return;
        if (performedLogout) return;
        lastActivity = Date.now();
        if (warningShown) hideWarning();
    }

    ['click','mousemove','keydown','touchstart','scroll'].forEach(evt =>
        window.addEventListener(evt, markActivity, { passive: true })
    );
    document.getElementById('idleStayBtn')?.addEventListener('click', markActivity);

    setInterval(() => {
        if (Date.now() - lastActivity >= INACTIVITY_MS - WARNING_MS && !warningShown && !performedLogout) showWarning();
    }, 1000);
})();
</script>

</body>
</html>