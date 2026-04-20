<?php
// resources/views/finance/revenue/index.php
// Standalone PHP/HTML — no layout extension
?>
<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Revenue Monitoring — Finance — E-Agraryo Merkado</title>
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
            left: -3px;
            top: 20%; bottom: 20%;
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
            width: 52px; height: 52px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            flex-shrink: 0;
        }

        .stat-icon-green  { background: var(--green-100); color: var(--green-700); }
        .stat-icon-gold   { background: var(--gold-light); color: var(--gold); }
        .stat-icon-blue   { background: #e8f0fe; color: #1a73e8; }
        .stat-icon-teal   { background: #e0f7f5; color: #0d8a7e; }
        .stat-icon-red    { background: #fdecea; color: #c0392b; }
        .stat-icon-indigo { background: #eef0ff; color: #4f46e5; }

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

        .stat-trend.up     { color: var(--green-600); }
        .stat-trend.down   { color: #dc3545; }
        .stat-trend.neutral { color: var(--gray-400); }

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
            width: 4px; height: 18px;
            background: var(--green-600);
            border-radius: 3px;
        }

        .section-title a {
            margin-left: auto;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--green-600);
            text-decoration: none;
        }

        .section-title a:hover { text-decoration: underline; }

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

        .fin-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.84rem;
        }

        .fin-table thead th {
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

        .fin-table thead th.sortable { cursor: pointer; }
        .fin-table thead th.sortable:hover { color: var(--green-600); }

        .fin-table tbody tr {
            border-bottom: 1px solid var(--gray-100);
            transition: background 0.14s;
        }

        .fin-table tbody tr:last-child { border-bottom: none; }
        .fin-table tbody tr:hover { background: var(--gray-50); }

        .fin-table td {
            padding: 0.75rem 1.1rem;
            vertical-align: middle;
            color: var(--text-main);
        }

        .name-cell { font-weight: 600; color: var(--green-800); }
        .name-cell small { display: block; font-weight: 400; font-size: 0.72rem; color: var(--text-muted); margin-top: 1px; }

        .amount-cell { font-weight: 700; color: var(--green-800); font-size: 0.88rem; }

        /* ─── Revenue mini bar ──────────────────────────────── */
        .rev-bar {
            height: 5px;
            background: var(--gray-200);
            border-radius: 4px;
            overflow: hidden;
            margin-top: 4px;
        }
        .rev-bar-fill { height: 100%; border-radius: 4px; background: var(--green-600); opacity: .75; }

        /* ─── Chart Card ────────────────────────────────────── */
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

        .chart-card-title {
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--text-main);
        }

        /* ─── Btn ───────────────────────────────────────────── */
        .btn-card-action {
            background: var(--green-100);
            color: var(--green-700);
            border: none;
            font-size: 0.78rem;
            border-radius: 8px;
            font-weight: 600;
            padding: 5px 12px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            transition: background 0.15s;
            cursor: pointer;
        }
        .btn-card-action:hover { background: #d0ebd8; color: var(--green-900); }

        /* ─── Export Button ─────────────────────────────────── */
        .btn-export {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 14px;
            border-radius: var(--radius-sm);
            font-size: 0.8rem;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: opacity 0.15s, box-shadow 0.15s;
            background: var(--green-900);
            color: #fff;
            border: none;
        }
        .btn-export:hover { opacity: 0.88; box-shadow: var(--shadow-sm); color: #fff; }

        /* ─── Rank Badge ────────────────────────────────────── */
        .rank-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px; height: 28px;
            border-radius: 50%;
            font-size: 0.78rem;
            font-weight: 700;
        }
        .rank-1 { background: #fdf3e0; color: #c8922a; border: 2px solid var(--gold); }
        .rank-2 { background: #f0f4f8; color: #64748b; border: 2px solid #94a3b8; }
        .rank-3 { background: #fdf2ec; color: #b45309; border: 2px solid #d97706; }
        .rank-n { background: var(--gray-100); color: var(--gray-600); border: 1px solid var(--gray-200); }

        /* ─── Growth Badge ──────────────────────────────────── */
        .growth-badge {
            display: inline-flex;
            align-items: center;
            gap: 2px;
            padding: 3px 9px;
            border-radius: 20px;
            font-size: 0.73rem;
            font-weight: 700;
        }
        .growth-up   { background: var(--green-100); color: var(--green-700); }
        .growth-down { background: #fdecea; color: #c0392b; }
        .growth-flat { background: var(--gray-100); color: var(--gray-600); }

        /* ─── Province Badge ────────────────────────────────── */
        .province-badge {
            background: #e8f0fe;
            color: #1a73e8;
            font-size: 0.7rem;
            font-weight: 600;
            padding: 3px 9px;
            border-radius: 20px;
        }

        /* ─── Tab Pills ─────────────────────────────────────── */
        .tab-pill-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
            margin-bottom: 1rem;
        }

        .tab-pill {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 0.78rem;
            font-weight: 600;
            text-decoration: none;
            color: var(--gray-600);
            background: #fff;
            border: 1px solid var(--gray-200);
            transition: all 0.18s;
        }

        .tab-pill:hover {
            background: var(--green-100);
            color: var(--green-700);
            border-color: var(--green-200);
        }

        .tab-pill.active {
            background: var(--green-700);
            color: #fff;
            border-color: var(--green-700);
        }

        /* ─── Compare Pill ──────────────────────────────────── */
        .compare-pill {
            background: var(--green-50);
            border: 1px solid var(--green-200);
            border-radius: var(--radius-sm);
            padding: 0.55rem 1rem;
            font-size: 0.78rem;
            color: var(--green-800);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }
        .compare-pill i { color: var(--green-600); flex-shrink: 0; }

        /* ─── Filter Bar ────────────────────────────────────── */
        .filter-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            align-items: center;
            background: #fff;
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-sm);
            padding: 0.65rem 1rem;
            margin-bottom: 1.25rem;
            box-shadow: var(--shadow-sm);
        }

        .filter-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.06em;
            margin-right: 0.25rem;
        }

        .filter-select {
            font-size: 0.78rem;
            padding: 5px 10px;
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-sm);
            color: var(--text-main);
            background: var(--gray-50);
            cursor: pointer;
            transition: border-color 0.15s;
            outline: none;
        }

        .filter-select:focus { border-color: var(--green-500); }

        .search-wrap {
            position: relative;
            margin-left: auto;
        }

        .search-wrap i {
            position: absolute;
            left: 9px; top: 50%;
            transform: translateY(-50%);
            color: var(--gray-400);
            font-size: 0.85rem;
            pointer-events: none;
        }

        .search-input {
            padding: 5px 10px 5px 28px;
            font-size: 0.78rem;
            border: 1px solid var(--gray-200);
            border-radius: var(--radius-sm);
            width: 200px;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
            background: var(--gray-50);
        }

        .search-input:focus {
            border-color: var(--green-500);
            box-shadow: 0 0 0 3px rgba(31,128,60,0.08);
        }

        /* ─── Empty State ───────────────────────────────────── */
        .empty-state {
            text-align: center;
            padding: 3rem;
            color: var(--gray-400);
        }
        .empty-state i { font-size: 2.5rem; display: block; margin-bottom: 0.5rem; }
        .empty-state p { font-size: 0.85rem; margin: 0; }

        /* ─── Pagination ────────────────────────────────────── */
        .pagination-wrap {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.85rem 1.5rem;
            border-top: 1px solid var(--gray-100);
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        .pagination-info { font-size: 0.78rem; color: var(--text-muted); }

        /* ─── Offcanvas (ARBO Detail) ───────────────────────── */
        .offcanvas {
            width: 380px !important;
        }

        .offcanvas-header {
            background: var(--green-900);
            padding: 1.2rem 1.5rem;
            border-bottom: none;
        }

        .offcanvas-header .btn-close {
            filter: invert(1) brightness(1.5);
        }

        .detail-section {
            padding: 1.1rem 1.5rem;
            border-bottom: 1px solid var(--gray-100);
        }

        .detail-section:last-child { border-bottom: none; }

        .detail-section-title {
            font-size: 0.68rem;
            font-weight: 700;
            letter-spacing: 0.09em;
            text-transform: uppercase;
            color: var(--gray-400);
            margin-bottom: 0.75rem;
        }

        .detail-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.35rem 0;
            border-bottom: 1px dashed var(--gray-100);
        }

        .detail-row:last-child { border-bottom: none; }

        .detail-key {
            font-size: 0.78rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .detail-val {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--text-main);
            text-align: right;
        }

        /* ─── ARBO Row clickable ────────────────────────────── */
        .arbo-row { cursor: pointer; }

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
            .search-wrap { margin-left: 0; }
            .search-input { width: 100%; }
            .offcanvas { width: 100% !important; }
        }

        @media (max-width: 575.98px) {
            .stat-value { font-size: 1.5rem; }
            .page-header { flex-direction: column; }
        }

        /* ─── Scrollbar ─────────────────────────────────────── */
        .sidebar::-webkit-scrollbar { width: 4px; }
        .sidebar::-webkit-scrollbar-track { background: transparent; }
        .sidebar::-webkit-scrollbar-thumb { background: var(--gray-200); border-radius: 4px; }

        /* ─── Print Styles ──────────────────────────────────── */
        @media print {
            .top-navbar, .sidebar, .sidebar-overlay,
            .filter-bar, .tab-pill-wrap, .btn-export,
            .btn-card-action, .chart-card { display: none !important; }
            .page-wrapper { margin: 0; padding: 1rem; }
            .table-card { box-shadow: none; border: 1px solid #ccc; }
        }
    </style>
</head>
<body>
@php
    $userFullName = trim((optional(auth()->user())->first_name ?? '') . ' ' . (optional(auth()->user())->last_name ?? ''));
    if ($userFullName === '') { $userFullName = null; }
@endphp

<!-- ── Top Navbar ──────────────────────────────────────── -->
<header class="top-navbar">
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

    <span class="navbar-page-badge">
        <i class="bi bi-currency-exchange me-1"></i> Finance Admin
    </span>

    <div class="navbar-right">

        <!-- Notifications -->
        <div class="dropdown">
            <button class="nav-icon-btn" data-bs-toggle="dropdown" aria-label="Notifications">
                <i class="bi bi-bell"></i>
                <span class="nav-notif-dot"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0"
                style="min-width:280px; border-radius:12px; margin-top:8px;">
                <li class="px-3 py-2 border-bottom">
                    <span class="fw-bold" style="font-size:.82rem;">Notifications</span>
                </li>
                <li>
                    <a class="dropdown-item py-2" href="#" style="font-size:.82rem;">
                        <i class="bi bi-graph-up text-success me-2"></i> Revenue milestone reached
                        <div class="text-muted" style="font-size:.72rem; padding-left:1.4rem;">Just now</div>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item py-2" href="#" style="font-size:.82rem;">
                        <i class="bi bi-exclamation-triangle text-warning me-2"></i> ARBO with zero revenue this month
                        <div class="text-muted" style="font-size:.72rem; padding-left:1.4rem;">3 hours ago</div>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item py-2" href="#" style="font-size:.82rem;">
                        <i class="bi bi-bag-check text-primary me-2"></i> New ARBO order placed
                        <div class="text-muted" style="font-size:.72rem; padding-left:1.4rem;">Yesterday</div>
                    </a>
                </li>
                <li class="border-top">
                    <a class="dropdown-item text-center py-2"
                       href="{{ route('finance.activity-logs') }}"
                       style="font-size:.78rem; color:var(--green-700);">
                        View all notifications
                    </a>
                </li>
            </ul>
        </div>

        <div class="navbar-divider d-none d-sm-block"></div>

        <!-- User Dropdown -->
        <div class="dropdown">
            <a class="user-pill dropdown-toggle" href="#" data-bs-toggle="dropdown">
                <img class="user-avatar"
                    src="{{ optional(auth()->user())->avatar ? asset('storage/' . optional(auth()->user())->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($userFullName ?? 'Finance Admin') . '&background=1a6932&color=fff&rounded=true&size=64' }}"
                    alt="User avatar">
                <div class="d-none d-md-block" style="line-height:1.2;">
                    <div class="user-pill-name">{{ $userFullName ?? 'Finance Admin' }}</div>
                    <div class="user-pill-role">Admin / Finance</div>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0"
                style="border-radius:12px; margin-top:8px; min-width:200px;">
                <li class="px-3 py-2 border-bottom">
                    <div class="fw-bold" style="font-size:.83rem;">{{ $userFullName ?? 'Finance Admin' }}</div>
                    <div class="text-muted" style="font-size:.72rem;">{{ optional(auth()->user())->email ?? '' }}</div>
                </li>
                <li>
                    <a class="dropdown-item py-2" href="{{ route('finance.profile') }}" style="font-size:.84rem;">
                        <i class="bi bi-person me-2 text-muted"></i>Profile
                    </a>
                </li>
                <li class="border-top">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="dropdown-item py-2 text-danger" type="submit" style="font-size:.84rem;">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </button>
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

        <div class="sidebar-office-chip">
            <div class="office-label">Role</div>
            <div class="office-name">Finance Admin</div>
        </div>

        <span class="sidebar-section-label">Main Menu</span>

        <a href="{{ route('finance.dashboard') }}"
           class="sidebar-link {{ request()->routeIs('finance.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a href="{{ route('finance.orders.index') }}"
           class="sidebar-link {{ request()->routeIs('finance.orders.*') ? 'active' : '' }}">
            <i class="bi bi-bag-check"></i> Orders
        </a>
        <a href="{{ route('finance.payments.index') }}"
           class="sidebar-link {{ request()->routeIs('finance.payments.*') ? 'active' : '' }}">
            <i class="bi bi-credit-card-2-front"></i> Payments
        </a>
        <a href="{{ route('finance.revenue.index') }}"
           class="sidebar-link {{ request()->routeIs('finance.revenue.*') ? 'active' : '' }}">
            <i class="bi bi-graph-up-arrow"></i> Revenue Monitoring
        </a>

        <span class="sidebar-section-label">Sales Report</span>

        <a href="{{ route('finance.reports.sales') }}"
           class="sidebar-link {{ request()->routeIs('finance.reports.*') ? 'active' : '' }}">
            <i class="bi bi-bar-chart-line"></i> Sales Report
        </a>

        <span class="sidebar-section-label">System</span>

        <a href="{{ route('finance.activity-logs') }}"
           class="sidebar-link {{ request()->routeIs('finance.activity-logs') ? 'active' : '' }}">
            <i class="bi bi-clock-history"></i> Activity Logs
        </a>

        <div class="sidebar-logout">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-link w-100 text-start border-0 bg-transparent" style="cursor:pointer;">
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
            <h1 class="page-header-title">
                <i class="bi bi-graph-up-arrow me-2" style="color:var(--green-600); font-size:1.3rem;"></i>
                Revenue Monitoring
            </h1>
            <p class="page-header-sub">
                Consolidated sales revenue tracking and analysis across all ARBO transactions —
                <strong>{{ now()->format('F Y') }}</strong>.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <a href="{{ route('finance.reports.sales') }}"
               class="btn-export" style="background:var(--green-50);color:var(--green-700);border:1px solid var(--green-200);">
                <i class="bi bi-bar-chart-line"></i> Sales Report
            </a>
            <a href="#" class="btn-export" id="exportBtn">
                <i class="bi bi-download"></i> Export CSV
            </a>
            <a href="#" class="btn-export" style="background:var(--gold);border:none;" id="printBtn">
                <i class="bi bi-printer"></i> Print
            </a>
        </div>
    </div>

    <!-- ── KPI Summary Cards ───────────────────────────── -->
    <div class="row g-3 mb-4">

        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-gold">
                    <i class="bi bi-cash-stack"></i>
                </div>
                <div>
                    <div class="stat-value" style="font-size:1.5rem;">
                        ₱{{ number_format($totalRevenue ?? 0, 2) }}
                    </div>
                    <p class="stat-label">Total Revenue (All-time)</p>
                    <span class="stat-trend up"><i class="bi bi-database"></i> Cumulative</span>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-green">
                    <i class="bi bi-calendar2-check-fill"></i>
                </div>
                <div>
                    <div class="stat-value" style="font-size:1.5rem;">
                        ₱{{ number_format($monthlyRevenue ?? 0, 2) }}
                    </div>
                    <p class="stat-label">This Month Revenue</p>
                    <span class="stat-trend {{ ($monthlyGrowth ?? 0) >= 0 ? 'up' : 'down' }}">
                        <i class="bi bi-arrow-{{ ($monthlyGrowth ?? 0) >= 0 ? 'up' : 'down' }}-short"></i>
                        {{ number_format(abs($monthlyGrowth ?? 0), 1) }}% vs last month
                    </span>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-teal">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>
                <div>
                    <div class="stat-value" style="font-size:1.5rem;">
                        ₱{{ number_format($quarterlyRevenue ?? 0, 2) }}
                    </div>
                    <p class="stat-label">This Quarter Revenue</p>
                    <span class="stat-trend up">
                        <i class="bi bi-calendar3"></i>
                        Q{{ ceil(now()->month / 3) }} {{ now()->year }}
                    </span>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-blue">
                    <i class="bi bi-calendar-year"></i>
                </div>
                <div>
                    <div class="stat-value" style="font-size:1.5rem;">
                        ₱{{ number_format($yearlyRevenue ?? 0, 2) }}
                    </div>
                    <p class="stat-label">This Year Revenue</p>
                    <span class="stat-trend {{ ($yearlyGrowth ?? 0) >= 0 ? 'up' : 'down' }}">
                        <i class="bi bi-arrow-{{ ($yearlyGrowth ?? 0) >= 0 ? 'up' : 'down' }}-short"></i>
                        {{ number_format(abs($yearlyGrowth ?? 0), 1) }}% vs last year
                    </span>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-green">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $activeArbos ?? '—' }}</div>
                    <p class="stat-label">Active ARBOs</p>
                    <span class="stat-trend up"><i class="bi bi-check-circle"></i> With revenue</span>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-gold">
                    <i class="bi bi-trophy-fill"></i>
                </div>
                <div>
                    <div class="stat-value" style="font-size:1.1rem; line-height:1.3;">
                        {{ Str::limit($topArbo ?? 'N/A', 18) }}
                    </div>
                    <p class="stat-label">Top Revenue ARBO</p>
                    <span class="stat-trend up">
                        <i class="bi bi-star-fill"></i>
                        ₱{{ number_format($topArboRevenue ?? 0, 0) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-indigo">
                    <i class="bi bi-bag-fill"></i>
                </div>
                <div>
                    <div class="stat-value">{{ number_format($totalTransactions ?? 0) }}</div>
                    <p class="stat-label">Total Transactions</p>
                    <span class="stat-trend neutral"><i class="bi bi-receipt"></i> All-time orders</span>
                </div>
            </div>
        </div>

        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-teal">
                    <i class="bi bi-calculator-fill"></i>
                </div>
                <div>
                    <div class="stat-value" style="font-size:1.5rem;">
                        ₱{{ number_format($avgOrderValue ?? 0, 2) }}
                    </div>
                    <p class="stat-label">Avg. Order Value</p>
                    <span class="stat-trend neutral"><i class="bi bi-dash-circle"></i> Per transaction</span>
                </div>
            </div>
        </div>

    </div>

    <!-- ── Charts Row ──────────────────────────────────── -->
    <div class="row g-4 mb-4">

        <!-- Revenue Trend Line Chart -->
        <div class="col-lg-8">
            <div class="section-title">
                <div class="section-title-bar"></div>
                Revenue Trend — {{ now()->year }}
            </div>
            <div class="chart-card">
                <div class="chart-card-header">
                    <span class="chart-card-title">Monthly Revenue vs Target</span>
                    <div class="d-flex align-items-center gap-2">
                        <select class="form-select form-select-sm w-auto" style="font-size:.77rem;" id="yearSelect">
                            <option value="{{ now()->year }}" selected>{{ now()->year }}</option>
                            <option value="{{ now()->year - 1 }}">{{ now()->year - 1 }}</option>
                        </select>
                    </div>
                </div>
                <div class="p-4" style="height:290px; position:relative;">
                    <canvas id="revenueTrendChart"></canvas>
                </div>
                <div class="px-4 pb-3 d-flex gap-3 flex-wrap" style="font-size:.78rem;">
                    <span style="display:flex;align-items:center;gap:6px;">
                        <span style="width:14px;height:4px;background:var(--green-600);border-radius:2px;display:inline-block;"></span>
                        Actual Revenue
                    </span>
                    <span style="display:flex;align-items:center;gap:6px;">
                        <span style="width:14px;height:4px;background:var(--gold);border-radius:2px;display:inline-block;"></span>
                        Target
                    </span>
                </div>
            </div>
        </div>

        <!-- Revenue by Province Donut -->
        <div class="col-lg-4">
            <div class="section-title">
                <div class="section-title-bar"></div>
                Revenue by Province
            </div>
            <div class="chart-card">
                <div class="chart-card-header">
                    <span class="chart-card-title">Province Breakdown</span>
                    <span style="font-size:.72rem;color:var(--text-muted);">{{ now()->format('M Y') }}</span>
                </div>
                <div class="p-3" style="height:220px; position:relative;">
                    <canvas id="provinceDonut"></canvas>
                </div>
                <div class="px-3 pb-3 d-flex flex-column gap-1" id="provinceLegend">
                    @php
                        $provinces = $provinceRevenue ?? [
                            ['name' => 'Albay',         'revenue' => 540000, 'color' => '#1f803c'],
                            ['name' => 'Camarines Sur',  'revenue' => 320000, 'color' => '#c8922a'],
                            ['name' => 'Sorsogon',       'revenue' => 210000, 'color' => '#1a73e8'],
                            ['name' => 'Camarines Norte','revenue' => 180000, 'color' => '#7c3aed'],
                            ['name' => 'Catanduanes',    'revenue' => 95000,  'color' => '#0d8a7e'],
                            ['name' => 'Masbate',        'revenue' => 75000,  'color' => '#c0392b'],
                        ];
                    @endphp
                    @foreach($provinces as $prov)
                    <div style="display:flex;align-items:center;justify-content:space-between;font-size:.73rem;">
                        <span style="display:flex;align-items:center;gap:6px;">
                            <span style="width:10px;height:10px;border-radius:50%;background:{{ is_array($prov) ? $prov['color'] : $prov->color }};display:inline-block;flex-shrink:0;"></span>
                            {{ is_array($prov) ? $prov['name'] : $prov->name }}
                        </span>
                        <span style="font-weight:700;color:var(--text-main);">
                            ₱{{ number_format(is_array($prov) ? $prov['revenue'] : $prov->revenue, 0) }}
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    <!-- ── Secondary Charts Row ───────────────────────── -->
    <div class="row g-4 mb-4">

        <!-- Revenue by Category Bar Chart -->
        <div class="col-lg-6">
            <div class="section-title">
                <div class="section-title-bar"></div>
                Revenue by Product Category
            </div>
            <div class="chart-card">
                <div class="chart-card-header">
                    <span class="chart-card-title">Category Breakdown</span>
                    <select class="form-select form-select-sm w-auto" style="font-size:.77rem;">
                        <option>This Month</option>
                        <option>This Quarter</option>
                        <option>This Year</option>
                    </select>
                </div>
                <div class="p-4" style="height:240px; position:relative;">
                    <canvas id="categoryChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Quarter-over-Quarter Comparison -->
        <div class="col-lg-6">
            <div class="section-title">
                <div class="section-title-bar"></div>
                Quarter-over-Quarter Comparison
            </div>
            <div class="chart-card">
                <div class="chart-card-header">
                    <span class="chart-card-title">QoQ Revenue Performance</span>
                    <span style="font-size:.72rem;color:var(--text-muted);">{{ now()->year }}</span>
                </div>
                <div class="p-4" style="height:240px; position:relative;">
                    <canvas id="qoqChart"></canvas>
                </div>
            </div>
        </div>

    </div>

    <!-- ── Period Filter + ARBO Revenue Table ─────────── -->
    <div class="section-title">
        <div class="section-title-bar"></div>
        ARBO Revenue Breakdown
        <a href="{{ route('finance.reports.sales') }}">Full Sales Report →</a>
    </div>

    <!-- Period Tab Pills -->
    <div class="tab-pill-wrap">
        <a href="{{ route('finance.revenue.index') }}"
           class="tab-pill {{ !request('period') ? 'active' : '' }}">
            All Time
        </a>
        <a href="{{ route('finance.revenue.index', ['period' => 'this_month']) }}"
           class="tab-pill {{ request('period') === 'this_month' ? 'active' : '' }}">
            <i class="bi bi-calendar-month"></i> This Month
        </a>
        <a href="{{ route('finance.revenue.index', ['period' => 'last_month']) }}"
           class="tab-pill {{ request('period') === 'last_month' ? 'active' : '' }}">
            Last Month
        </a>
        <a href="{{ route('finance.revenue.index', ['period' => 'this_quarter']) }}"
           class="tab-pill {{ request('period') === 'this_quarter' ? 'active' : '' }}">
            <i class="bi bi-calendar3"></i> This Quarter
        </a>
        <a href="{{ route('finance.revenue.index', ['period' => 'this_year']) }}"
           class="tab-pill {{ request('period') === 'this_year' ? 'active' : '' }}">
            <i class="bi bi-calendar-year"></i> {{ now()->year }}
        </a>
        <a href="{{ route('finance.revenue.index', ['period' => 'last_year']) }}"
           class="tab-pill {{ request('period') === 'last_year' ? 'active' : '' }}">
            {{ now()->year - 1 }}
        </a>
    </div>

    <!-- Comparison Notice -->
    @php $activeLabel = match(request('period')) {
        'this_month'   => now()->format('F Y'),
        'last_month'   => now()->subMonth()->format('F Y'),
        'this_quarter' => 'Q' . ceil(now()->month / 3) . ' ' . now()->year,
        'this_year'    => 'Year ' . now()->year,
        'last_year'    => 'Year ' . (now()->year - 1),
        default        => 'All Time',
    }; @endphp
    <div class="compare-pill">
        <i class="bi bi-info-circle-fill"></i>
        Showing revenue data for <strong>{{ $activeLabel }}</strong>.
        Finance can edit Sales Revenue Reports (Module 8 — Edit access).
    </div>

    <!-- Filter Bar -->
    <form method="GET" action="{{ route('finance.revenue.index') }}" id="filterForm">
        <input type="hidden" name="period" value="{{ request('period') }}">
        <div class="filter-bar">
            <span class="filter-label"><i class="bi bi-funnel me-1"></i>Filters</span>

            <select name="province" class="filter-select" onchange="document.getElementById('filterForm').submit()">
                <option value="">All Provinces</option>
                @foreach(['Albay','Camarines Sur','Camarines Norte','Catanduanes','Masbate','Sorsogon'] as $prov)
                <option value="{{ $prov }}" {{ request('province') === $prov ? 'selected' : '' }}>{{ $prov }}</option>
                @endforeach
            </select>

            <select name="category" class="filter-select" onchange="document.getElementById('filterForm').submit()">
                <option value="">All Categories</option>
                @foreach($categories ?? [] as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>

            <select name="sort" class="filter-select" onchange="document.getElementById('filterForm').submit()">
                <option value="revenue_desc" {{ request('sort', 'revenue_desc') === 'revenue_desc' ? 'selected' : '' }}>Revenue ↓</option>
                <option value="revenue_asc"  {{ request('sort') === 'revenue_asc'                  ? 'selected' : '' }}>Revenue ↑</option>
                <option value="orders_desc"  {{ request('sort') === 'orders_desc'                  ? 'selected' : '' }}>Orders ↓</option>
                <option value="name_asc"     {{ request('sort') === 'name_asc'                     ? 'selected' : '' }}>ARBO Name A–Z</option>
                <option value="growth_desc"  {{ request('sort') === 'growth_desc'                  ? 'selected' : '' }}>Growth ↓</option>
            </select>

            <div class="search-wrap">
                <i class="bi bi-search"></i>
                <input type="text" name="search" class="search-input"
                       placeholder="Search ARBO name…"
                       value="{{ request('search') }}"
                       onchange="document.getElementById('filterForm').submit()">
            </div>

            @if(request()->hasAny(['province','category','sort','search']))
            <a href="{{ route('finance.revenue.index', ['period' => request('period')]) }}"
               class="filter-select text-decoration-none" style="color:#c0392b;background:#fdecea;border-color:#fbd8d4;">
                <i class="bi bi-x-circle me-1"></i> Clear
            </a>
            @endif
        </div>
    </form>

    <!-- ── ARBO Revenue Table ─────────────────────────── -->
    <div class="table-card">
        <div class="table-card-header">
            <h6 class="table-card-title">
                <i class="bi bi-buildings"></i>
                ARBO Revenue Leaderboard
                @if(isset($arboRevenue) && method_exists($arboRevenue, 'total'))
                <span style="font-size:.72rem;font-weight:400;color:var(--text-muted);margin-left:6px;">
                    {{ number_format($arboRevenue->total()) }} ARBOs
                </span>
                @endif
            </h6>
            <span style="font-size:.73rem;color:var(--text-muted);" id="tableDate"></span>
        </div>

        <div class="table-responsive">
            <table class="fin-table">
                <thead>
                    <tr>
                        <th style="width:50px;">Rank</th>
                        <th class="sortable">ARBO Name</th>
                        <th>Province</th>
                        <th class="sortable">Total Orders</th>
                        <th class="sortable">Revenue (Period)</th>
                        <th>Revenue Share</th>
                        <th class="sortable">Growth</th>
                        <th>Avg. Order</th>
                        <th>Last Transaction</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $arboRows = $arboRevenue ?? collect([
                            (object)['id'=>1,'arbo_name'=>'Kilusang Samahan ng Magsasaka','province'=>'Albay','total_orders'=>142,'revenue'=>540000,'growth'=>12.4,'avg_order'=>3803.80,'last_txn'=>'2025-07-18'],
                            (object)['id'=>2,'arbo_name'=>'Bagong Araw Farmers Coop','province'=>'Camarines Sur','total_orders'=>98,'revenue'=>320000,'growth'=>-3.1,'avg_order'=>3265.30,'last_txn'=>'2025-07-17'],
                            (object)['id'=>3,'arbo_name'=>'Lakbay Ani Producers Assoc.','province'=>'Sorsogon','total_orders'=>76,'revenue'=>210000,'growth'=>8.7,'avg_order'=>2763.15,'last_txn'=>'2025-07-15'],
                            (object)['id'=>4,'arbo_name'=>'Malinao Organic Growers','province'=>'Camarines Norte','total_orders'=>60,'revenue'=>180000,'growth'=>0,'avg_order'=>3000.00,'last_txn'=>'2025-07-14'],
                            (object)['id'=>5,'arbo_name'=>'Catanduanes Upland ARBO','province'=>'Catanduanes','total_orders'=>34,'revenue'=>95000,'growth'=>21.0,'avg_order'=>2794.11,'last_txn'=>'2025-07-12'],
                            (object)['id'=>6,'arbo_name'=>'Masbate Coastal Producers','province'=>'Masbate','total_orders'=>28,'revenue'=>75000,'growth'=>-7.5,'avg_order'=>2678.57,'last_txn'=>'2025-07-10'],
                        ]);
                        $maxRevenue  = collect($arboRows)->max('revenue') ?: 1;
                        $totalRevAll = collect($arboRows)->sum('revenue') ?: 1;
                    @endphp

                    @forelse($arboRows as $index => $arbo)
                    @php
                        $rank    = $index + 1;
                        $rankCls = match($rank) { 1 => 'rank-1', 2 => 'rank-2', 3 => 'rank-3', default => 'rank-n' };
                        $revPct  = ($arbo->revenue / $maxRevenue) * 100;
                        $sharePct = ($arbo->revenue / $totalRevAll) * 100;
                        $growth  = $arbo->growth ?? 0;
                    @endphp
                    <tr class="arbo-row"
                        data-id="{{ $arbo->id ?? $index }}"
                        data-name="{{ $arbo->arbo_name ?? '—' }}"
                        data-province="{{ $arbo->province ?? '—' }}"
                        data-orders="{{ number_format($arbo->total_orders ?? 0) }}"
                        data-revenue="₱{{ number_format($arbo->revenue ?? 0, 2) }}"
                        data-share="{{ number_format($sharePct, 1) }}%"
                        data-growth="{{ $growth }}"
                        data-avg="₱{{ number_format($arbo->avg_order ?? 0, 2) }}"
                        data-last="{{ isset($arbo->last_txn) ? \Carbon\Carbon::parse($arbo->last_txn)->format('M d, Y') : '—' }}">

                        <td style="text-align:center;">
                            <span class="rank-badge {{ $rankCls }}">{{ $rank }}</span>
                        </td>

                        <td class="name-cell">
                            {{ $arbo->arbo_name ?? '—' }}
                            <small>{{ $arbo->municipality ?? '' }}</small>
                        </td>

                        <td>
                            <span class="province-badge">{{ $arbo->province ?? '—' }}</span>
                        </td>

                        <td style="font-weight:600; font-size:.85rem;">
                            {{ number_format($arbo->total_orders ?? 0) }}
                        </td>

                        <td>
                            <div class="amount-cell">₱{{ number_format($arbo->revenue ?? 0, 2) }}</div>
                            <div class="rev-bar" style="width:120px;">
                                <div class="rev-bar-fill" style="width:{{ $revPct }}%;"></div>
                            </div>
                        </td>

                        <td style="font-size:.83rem;">
                            <div style="font-weight:700;color:var(--text-main);">{{ number_format($sharePct, 1) }}%</div>
                            <div style="font-size:.7rem;color:var(--text-muted);">of total</div>
                        </td>

                        <td>
                            @if($growth > 0)
                                <span class="growth-badge growth-up">
                                    <i class="bi bi-arrow-up-short"></i> +{{ $growth }}%
                                </span>
                            @elseif($growth < 0)
                                <span class="growth-badge growth-down">
                                    <i class="bi bi-arrow-down-short"></i> {{ $growth }}%
                                </span>
                            @else
                                <span class="growth-badge growth-flat">
                                    <i class="bi bi-dash"></i> 0%
                                </span>
                            @endif
                        </td>

                        <td style="font-size:.83rem; font-weight:600; color:var(--text-main);">
                            ₱{{ number_format($arbo->avg_order ?? 0, 2) }}
                        </td>

                        <td style="font-size:.78rem;color:var(--text-muted);white-space:nowrap;">
                            {{ isset($arbo->last_txn) ? \Carbon\Carbon::parse($arbo->last_txn)->format('M d, Y') : '—' }}
                        </td>

                        <td>
                            <button type="button" class="btn-card-action view-arbo-btn"
                                    onclick="event.stopPropagation();">
                                <i class="bi bi-eye-fill"></i> View
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10">
                            <div class="empty-state">
                                <i class="bi bi-buildings"></i>
                                <p>No ARBO revenue data found.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if(isset($arboRevenue) && method_exists($arboRevenue, 'links') && $arboRevenue->lastPage() > 1)
        <div class="pagination-wrap">
            <span class="pagination-info">
                Showing {{ $arboRevenue->firstItem() ?? 0 }}–{{ $arboRevenue->lastItem() ?? 0 }}
                of {{ number_format($arboRevenue->total()) }} ARBOs
            </span>
            {{ $arboRevenue->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>

</main>

<!-- ── ARBO Revenue Detail Offcanvas ──────────────────── -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="arboDetailOffcanvas">
    <div class="offcanvas-header">
        <div>
            <h6 class="mb-0" style="color:#fff;font-size:.82rem;letter-spacing:.06em;text-transform:uppercase;">ARBO Revenue Detail</h6>
            <div style="font-size:1rem;font-weight:700;color:var(--gold-mid);margin-top:3px;" id="detailArboName">—</div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body p-0" style="overflow-y:auto;">

        <!-- Overview -->
        <div class="detail-section">
            <div class="detail-section-title">Overview</div>
            <div class="detail-row"><span class="detail-key">Province</span><span class="detail-val" id="dProvince">—</span></div>
            <div class="detail-row"><span class="detail-key">Total Orders</span><span class="detail-val" id="dOrders">—</span></div>
            <div class="detail-row"><span class="detail-key">Last Transaction</span><span class="detail-val" id="dLastTxn">—</span></div>
        </div>

        <!-- Revenue Figures -->
        <div class="detail-section">
            <div class="detail-section-title">Revenue Summary</div>
            <div class="detail-row"><span class="detail-key">Period Revenue</span><span class="detail-val amount-cell" id="dRevenue">—</span></div>
            <div class="detail-row"><span class="detail-key">Revenue Share</span><span class="detail-val" id="dShare">—</span></div>
            <div class="detail-row"><span class="detail-key">Avg. Order Value</span><span class="detail-val" id="dAvg">—</span></div>
            <div class="detail-row">
                <span class="detail-key">Growth vs Prior Period</span>
                <span class="detail-val" id="dGrowth">—</span>
            </div>
        </div>

        <!-- ARBO Mini Chart -->
        <div class="detail-section">
            <div class="detail-section-title">Monthly Revenue (Last 6 months)</div>
            <div style="height:130px;position:relative;">
                <canvas id="arboMiniChart"></canvas>
            </div>
        </div>

        <!-- Actions -->
        <div class="detail-section d-flex gap-2 flex-wrap">
            <a href="#" class="btn-card-action" id="dViewOrders">
                <i class="bi bi-bag-check"></i> View Orders
            </a>
            <a href="#" class="btn-card-action" id="dViewPayments">
                <i class="bi bi-credit-card"></i> View Payments
            </a>
            <a href="{{ route('finance.reports.sales') }}" class="btn-card-action">
                <i class="bi bi-bar-chart-line"></i> Sales Report
            </a>
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

    // ── Date Label ─────────────────────────────────────
    const tbl = document.getElementById('tableDate');
    if (tbl) tbl.textContent = new Date().toLocaleDateString('en-PH', { year:'numeric', month:'long', day:'numeric' });

    // ── Mobile Sidebar ─────────────────────────────────
    const toggle  = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('mainSidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const openSidebar  = () => { sidebar.classList.add('show'); overlay.classList.add('show'); document.body.style.overflow = 'hidden'; };
    const closeSidebar = () => { sidebar.classList.remove('show'); overlay.classList.remove('show'); document.body.style.overflow = ''; };
    if (toggle)  toggle.addEventListener('click', openSidebar);
    if (overlay) overlay.addEventListener('click', closeSidebar);

    // ── Revenue Trend Line Chart ───────────────────────
    const trendCtx = document.getElementById('revenueTrendChart');
    if (trendCtx) {
        const labels  = {!! json_encode($chartLabels   ?? ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']) !!};
        const actual  = {!! json_encode($chartActual   ?? [42000,58000,37000,91000,76000,88000,103000,72000,115000,99000,134000,142000]) !!};
        const target  = {!! json_encode($chartTarget   ?? [80000,80000,80000,80000,80000,80000,80000,80000,80000,80000,80000,80000]) !!};

        new Chart(trendCtx.getContext('2d'), {
            type: 'line',
            data: {
                labels,
                datasets: [
                    {
                        label: 'Actual Revenue',
                        data: actual,
                        borderColor: 'rgba(31,128,60,1)',
                        backgroundColor: 'rgba(31,128,60,0.08)',
                        borderWidth: 2.5,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        pointBackgroundColor: '#fff',
                        pointBorderColor: 'rgba(31,128,60,1)',
                        pointBorderWidth: 2,
                        pointHoverRadius: 6,
                    },
                    {
                        label: 'Target',
                        data: target,
                        borderColor: 'rgba(200,146,42,0.8)',
                        backgroundColor: 'transparent',
                        borderWidth: 1.5,
                        borderDash: [6, 4],
                        fill: false,
                        tension: 0,
                        pointRadius: 0,
                    }
                ]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: c => ` ${c.dataset.label}: ₱${Number(c.raw).toLocaleString('en-PH', { minimumFractionDigits: 2 })}`
                        },
                        backgroundColor: '#0d3b1e', titleColor: '#f5d08a', bodyColor: '#fff',
                        padding: 10, cornerRadius: 8,
                    }
                },
                scales: {
                    x: { grid: { display: false }, ticks: { font: { size: 11 }, color: '#94a3b8' } },
                    y: {
                        grid: { color: '#f1f3f5' },
                        ticks: { font: { size: 11 }, color: '#94a3b8', callback: v => '₱' + (v >= 1000 ? (v/1000).toFixed(0)+'k' : v) },
                        beginAtZero: true,
                    }
                }
            }
        });
    }

    // ── Province Donut ─────────────────────────────────
    const provCtx = document.getElementById('provinceDonut');
    if (provCtx) {
        const provData   = {!! json_encode(isset($provinceRevenue) ? collect($provinceRevenue)->pluck('revenue')->toArray() : [540000,320000,210000,180000,95000,75000]) !!};
        const provLabels = {!! json_encode(isset($provinceRevenue) ? collect($provinceRevenue)->pluck('name')->toArray()    : ['Albay','Camarines Sur','Sorsogon','Camarines Norte','Catanduanes','Masbate']) !!};
        const provColors = ['rgba(31,128,60,0.85)','rgba(200,146,42,0.85)','rgba(26,115,232,0.85)','rgba(124,58,237,0.85)','rgba(13,138,126,0.85)','rgba(192,57,43,0.85)'];

        new Chart(provCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: provLabels,
                datasets: [{
                    data: provData,
                    backgroundColor: provColors,
                    borderColor: '#fff', borderWidth: 3, hoverOffset: 6,
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false, cutout: '65%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(ctx) {
                                const total = ctx.dataset.data.reduce((a,b) => a+b, 0);
                                const pct = total > 0 ? ((ctx.raw/total)*100).toFixed(1) : 0;
                                return ` ${ctx.label}: ₱${ctx.raw.toLocaleString()} (${pct}%)`;
                            }
                        }
                    }
                }
            }
        });
    }

    // ── Category Bar Chart ─────────────────────────────
    const catCtx = document.getElementById('categoryChart');
    if (catCtx) {
        const catLabels = {!! json_encode($categoryLabels ?? ['Rice/Grains','Vegetables','Fruits','Livestock','Fishery','Processed']) !!};
        const catData   = {!! json_encode($categoryData   ?? [280000,175000,142000,98000,64000,47000]) !!};

        new Chart(catCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: catLabels,
                datasets: [{
                    label: 'Revenue (₱)',
                    data: catData,
                    backgroundColor: [
                        'rgba(31,128,60,0.80)','rgba(200,146,42,0.80)','rgba(26,115,232,0.80)',
                        'rgba(124,58,237,0.80)','rgba(13,138,126,0.80)','rgba(192,57,43,0.80)',
                    ],
                    borderRadius: 7, borderSkipped: false,
                }]
            },
            options: {
                responsive: true, maintainAspectRatio: false, indexAxis: 'y',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: { label: c => ` ₱${Number(c.raw).toLocaleString('en-PH', { minimumFractionDigits: 2 })}` },
                        backgroundColor: '#0d3b1e', titleColor: '#f5d08a', bodyColor: '#fff',
                        padding: 10, cornerRadius: 8,
                    }
                },
                scales: {
                    x: {
                        grid: { color: '#f1f3f5' },
                        ticks: { font:{size:10}, color:'#94a3b8', callback: v => '₱'+(v>=1000?(v/1000).toFixed(0)+'k':v) },
                        beginAtZero: true
                    },
                    y: { grid: { display: false }, ticks: { font:{size:11}, color:'#4b5563' } }
                }
            }
        });
    }

    // ── QoQ Grouped Bar Chart ──────────────────────────
    const qoqCtx = document.getElementById('qoqChart');
    if (qoqCtx) {
        const qoqLabels  = {!! json_encode($qoqLabels  ?? ['Q1','Q2','Q3','Q4']) !!};
        const qoqCurrent = {!! json_encode($qoqCurrent ?? [320000,458000,410000,0]) !!};
        const qoqPrior   = {!! json_encode($qoqPrior   ?? [280000,390000,370000,420000]) !!};

        new Chart(qoqCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: qoqLabels,
                datasets: [
                    {
                        label: 'This Year',
                        data: qoqCurrent,
                        backgroundColor: 'rgba(31,128,60,0.80)',
                        borderRadius: 6,
                    },
                    {
                        label: 'Prior Year',
                        data: qoqPrior,
                        backgroundColor: 'rgba(200,146,42,0.65)',
                        borderRadius: 6,
                    }
                ]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: {
                    legend: { position:'bottom', labels:{ font:{size:11}, boxWidth:12, padding:14 } },
                    tooltip: {
                        callbacks: { label: c => ` ${c.dataset.label}: ₱${Number(c.raw).toLocaleString('en-PH', {minimumFractionDigits:2})}` },
                        backgroundColor: '#0d3b1e', titleColor: '#f5d08a', bodyColor: '#fff',
                        padding: 10, cornerRadius: 8,
                    }
                },
                scales: {
                    x: { grid:{display:false}, ticks:{font:{size:12}, color:'#4b5563'} },
                    y: {
                        grid:{color:'#f1f3f5'},
                        ticks:{font:{size:11}, color:'#94a3b8', callback: v => '₱'+(v>=1000?(v/1000).toFixed(0)+'k':v)},
                        beginAtZero: true
                    }
                }
            }
        });
    }

    // ── ARBO Detail Offcanvas ──────────────────────────
    const arboOffcanvas = new bootstrap.Offcanvas(document.getElementById('arboDetailOffcanvas'));
    let arboMiniChart = null;

    function openArboDetail(row) {
        const d = row.dataset;

        document.getElementById('detailArboName').textContent = d.name || '—';
        document.getElementById('dProvince').textContent      = d.province || '—';
        document.getElementById('dOrders').textContent        = d.orders || '—';
        document.getElementById('dLastTxn').textContent       = d.last || '—';
        document.getElementById('dRevenue').textContent       = d.revenue || '—';
        document.getElementById('dShare').textContent         = d.share || '—';
        document.getElementById('dAvg').textContent           = d.avg || '—';

        // Growth badge
        const growth = parseFloat(d.growth || 0);
        let growthHtml = '';
        if (growth > 0)      growthHtml = `<span class="growth-badge growth-up"><i class="bi bi-arrow-up-short"></i> +${growth}%</span>`;
        else if (growth < 0) growthHtml = `<span class="growth-badge growth-down"><i class="bi bi-arrow-down-short"></i> ${growth}%</span>`;
        else                 growthHtml = `<span class="growth-badge growth-flat"><i class="bi bi-dash"></i> 0%</span>`;
        document.getElementById('dGrowth').innerHTML = growthHtml;

        // Links
        document.getElementById('dViewOrders').href   = `{{ url('finance/orders') }}?arbo_id=${d.id}`;
        document.getElementById('dViewPayments').href = `{{ url('finance/payments') }}?arbo_id=${d.id}`;

        // Mini sparkline
        if (arboMiniChart) { arboMiniChart.destroy(); arboMiniChart = null; }
        const miniCtx = document.getElementById('arboMiniChart');
        if (miniCtx) {
            const miniData = [42000, 58000, 37000, 91000, 76000, 88000];
            arboMiniChart = new Chart(miniCtx.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: ['Feb','Mar','Apr','May','Jun','Jul'],
                    datasets: [{
                        data: miniData,
                        backgroundColor: 'rgba(31,128,60,0.7)',
                        borderRadius: 5,
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend:{display:false}, tooltip:{
                        callbacks:{ label: c => ` ₱${Number(c.raw).toLocaleString()}` },
                        backgroundColor:'#0d3b1e', bodyColor:'#fff', padding:8, cornerRadius:6,
                    }},
                    scales: {
                        x: { grid:{display:false}, ticks:{font:{size:10}, color:'#94a3b8'} },
                        y: { display:false, beginAtZero:true }
                    }
                }
            });
        }

        arboOffcanvas.show();
    }

    // Row click
    document.querySelectorAll('.arbo-row').forEach(row => {
        row.addEventListener('click', () => openArboDetail(row));
    });

    // View buttons
    document.querySelectorAll('.view-arbo-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            openArboDetail(this.closest('tr'));
        });
    });

    // ── Export CSV ─────────────────────────────────────
    document.getElementById('exportBtn')?.addEventListener('click', function(e) {
        e.preventDefault();
        const params = new URLSearchParams(window.location.search);
        params.set('export', 'csv');
        window.location.href = '{{ route('finance.revenue.index') }}?' + params.toString();
    });

    document.getElementById('printBtn')?.addEventListener('click', function(e) {
        e.preventDefault();
        window.print();
    });

});
</script>

{{-- ✅ IDLE TIMER --}}
@include('partials.idle-timer')

</body>
</html>