<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Seller Management — E-Agraryo Merkado</title>
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
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
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

        /* ─── Page Wrapper ──────────────────────────────────── */
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

        .breadcrumb-custom {
            font-size: 0.75rem;
            color: var(--gray-400);
            margin-bottom: 0.3rem;
            display: flex;
            align-items: center;
            gap: 0.35rem;
        }

        .breadcrumb-custom a {
            color: var(--green-600);
            text-decoration: none;
            font-weight: 500;
        }

        .breadcrumb-custom a:hover { text-decoration: underline; }

        /* ─── Buttons ───────────────────────────────────────── */
        .btn-green-primary {
            background: var(--green-800);
            color: #fff;
            border: none;
            border-radius: var(--radius-sm);
            font-size: 0.83rem;
            font-weight: 600;
            padding: 0.5rem 1.1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            cursor: pointer;
            transition: background 0.18s, transform 0.18s, box-shadow 0.18s;
            text-decoration: none;
        }

        .btn-green-primary:hover {
            background: var(--green-700);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        .btn-green-outline {
            background: transparent;
            color: var(--green-700);
            border: 1.5px solid var(--green-600);
            border-radius: var(--radius-sm);
            font-size: 0.83rem;
            font-weight: 600;
            padding: 0.48rem 1.1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            cursor: pointer;
            transition: all 0.18s;
            text-decoration: none;
        }

        .btn-green-outline:hover {
            background: var(--green-100);
            color: var(--green-800);
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
        .stat-icon-teal   { background: #e0f7f5; color: #0d8a7e; }
        .stat-icon-orange { background: #fff3e0; color: #e07b2a; }
        .stat-icon-gold   { background: var(--gold-light); color: var(--gold); }

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

        .stat-sub {
            font-size: 0.72rem;
            color: var(--gray-400);
            margin-top: 3px;
        }

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
            flex-shrink: 0;
        }

        /* ─── Filter Card ───────────────────────────────────── */
        .filter-card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            padding: 1.1rem 1.5rem;
            margin-bottom: 1.25rem;
        }

        .filter-label {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--green-800);
            letter-spacing: 0.03em;
            margin-bottom: 0.3rem;
            display: block;
        }

        .filter-input {
            font-size: 0.83rem;
            border-radius: var(--radius-sm);
            border: 1.5px solid var(--gray-200);
            padding: 0.45rem 0.85rem;
            color: var(--text-main);
            background: #fff;
            transition: border-color 0.18s, box-shadow 0.18s;
            width: 100%;
        }

        .filter-input:focus {
            border-color: var(--green-600);
            box-shadow: 0 0 0 3px rgba(31,128,60,0.10);
            outline: none;
        }

        .btn-filter {
            background: var(--green-700);
            color: #fff;
            border: none;
            border-radius: var(--radius-sm);
            font-size: 0.83rem;
            font-weight: 600;
            padding: 0.45rem 1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            cursor: pointer;
            transition: background 0.18s;
        }

        .btn-filter:hover { background: var(--green-900); color: #fff; }

        .btn-reset-filter {
            background: var(--gray-100);
            color: var(--gray-600);
            border: 1.5px solid var(--gray-200);
            border-radius: var(--radius-sm);
            font-size: 0.83rem;
            font-weight: 600;
            padding: 0.43rem 1rem;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            cursor: pointer;
            transition: background 0.18s;
            text-decoration: none;
        }

        .btn-reset-filter:hover { background: var(--gray-200); color: var(--gray-800); }

        /* ─── Table Card ────────────────────────────────────── */
        .table-card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            overflow: hidden;
        }

        .table-card-header {
            background: var(--green-900);
            padding: 0.95rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .table-card-title {
            font-size: 0.9rem;
            font-weight: 700;
            color: #fff;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.45rem;
        }

        .table-card-title i { color: var(--gold-mid); }

        .table-record-pill {
            background: rgba(255,255,255,0.13);
            color: rgba(255,255,255,0.88);
            font-size: 0.72rem;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
        }

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
            padding: 0.75rem 1.1rem;
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
            padding: 0.8rem 1.1rem;
            vertical-align: middle;
            color: var(--text-main);
        }

        /* ─── Seller Avatar ─────────────────────────────────── */
        .seller-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--green-700), var(--green-500));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 0.78rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        /* ─── Name Cell ─────────────────────────────────────── */
        .name-cell-primary {
            font-weight: 600;
            font-size: 0.84rem;
            color: var(--green-800);
        }

        .name-cell-sub {
            font-size: 0.71rem;
            color: var(--text-muted);
            margin-top: 1px;
        }

        /* ─── ID Mono ───────────────────────────────────────── */
        .id-mono {
            font-family: 'Courier New', monospace;
            font-size: 0.74rem;
            color: var(--gray-600);
            font-weight: 600;
        }

        /* ─── Product Count Badge ───────────────────────────── */
        .product-count-badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            background: #e8f0fe;
            color: #1a73e8;
            font-size: 0.71rem;
            font-weight: 700;
            padding: 3px 9px;
            border-radius: 20px;
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
        .status-inactive { background: #fdecea; color: #c0392b; }
        .status-pending  { background: var(--gold-light); color: var(--gold); }

        .status-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            display: inline-block;
        }

        .status-active   .status-dot { background: var(--green-600); }
        .status-inactive .status-dot { background: #c0392b; }
        .status-pending  .status-dot { background: var(--gold); }

        /* ─── Table Action Buttons ──────────────────────────── */
        .tbl-action-btn {
            font-size: 0.72rem;
            font-weight: 600;
            padding: 0.27rem 0.65rem;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: all 0.16s;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .btn-view-tbl        { background: #e8f0fe; color: #1a73e8; }
        .btn-view-tbl:hover  { background: #d1e4fc; }
        .btn-edit-tbl        { background: var(--green-100); color: var(--green-700); }
        .btn-edit-tbl:hover  { background: var(--green-200); }
        .btn-deact-tbl       { background: #fdecea; color: #c0392b; }
        .btn-deact-tbl:hover { background: #f9c9c5; }
        .btn-activ-tbl       { background: var(--green-100); color: var(--green-700); }
        .btn-activ-tbl:hover { background: var(--green-200); }

        /* ─── Pagination ────────────────────────────────────── */
        .pagination-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.8rem 1.2rem;
            border-top: 1px solid var(--gray-200);
            font-size: 0.78rem;
            color: var(--text-muted);
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .custom-pagination .page-link {
            font-size: 0.78rem;
            color: var(--green-700);
            border-color: var(--gray-200);
            padding: 0.3rem 0.65rem;
            border-radius: 6px !important;
            margin: 0 1px;
        }

        .custom-pagination .page-item.active .page-link {
            background: var(--green-700);
            border-color: var(--green-700);
            color: #fff;
        }

        .custom-pagination .page-link:hover { background: var(--green-100); }

        /* ─── Side Card ─────────────────────────────────────── */
        .side-card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            overflow: hidden;
            height: 100%;
        }

        .side-card-header {
            background: var(--green-900);
            padding: 0.85rem 1.25rem;
        }

        .side-card-header h6 {
            font-size: 0.88rem;
            font-weight: 700;
            color: #fff;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        .side-card-header h6 i { color: var(--gold-mid); }

        .side-card-header p {
            margin: 0.2rem 0 0;
            font-size: 0.72rem;
            color: rgba(255,255,255,0.55);
        }

        /* ─── Quick Action Row ──────────────────────────────── */
        .qa-row {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.85rem 1.1rem;
            border: none;
            background: transparent;
            width: 100%;
            text-align: left;
            font-size: 0.83rem;
            color: var(--text-main);
            font-weight: 500;
            border-bottom: 1px solid var(--gray-100);
            transition: background 0.16s;
            cursor: pointer;
            text-decoration: none;
        }

        .qa-row:hover { background: var(--green-50); color: var(--green-800); }
        .qa-row:last-child { border-bottom: none; }

        .qa-icon-wrap {
            width: 36px; height: 36px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
            flex-shrink: 0;
        }

        /* ─── Activity Feed ─────────────────────────────────── */
        .activity-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            padding: 0.85rem 1.1rem;
            border-bottom: 1px solid var(--gray-100);
            transition: background 0.14s;
        }

        .activity-item:last-child { border-bottom: none; }
        .activity-item:hover { background: var(--gray-50); }

        .activity-dot-wrap { flex-shrink: 0; margin-top: 0.05rem; }

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
        .ad-teal   { background: #e0f7f5; color: #0d8a7e; }

        .activity-title {
            font-size: 0.83rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 1px;
        }

        .activity-meta {
            font-size: 0.72rem;
            color: var(--text-muted);
        }

        /* ─── Modals ────────────────────────────────────────── */
        .modal-content {
            border-radius: var(--radius);
            border: none;
            box-shadow: var(--shadow-lg);
        }

        .modal-header-dark {
            background: var(--green-900);
            color: #fff;
            border-radius: calc(var(--radius) - 1px) calc(var(--radius) - 1px) 0 0;
            padding: 1rem 1.5rem;
        }

        .modal-header-dark .btn-close { filter: invert(1) brightness(1.5); }

        .modal-header-dark h5 {
            font-size: 0.95rem;
            font-weight: 700;
            color: #fff;
            margin: 0;
        }

        .modal-section-label {
            font-size: 0.68rem;
            font-weight: 700;
            color: var(--gray-400);
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 0.75rem;
            padding-bottom: 0.4rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .modal-form-label {
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--green-800);
            margin-bottom: 0.3rem;
            display: block;
        }

        .modal-form-input {
            font-size: 0.83rem;
            border-radius: var(--radius-sm);
            border: 1.5px solid var(--gray-200);
            padding: 0.48rem 0.85rem;
            color: var(--text-main);
            width: 100%;
            transition: border-color 0.18s, box-shadow 0.18s;
        }

        .modal-form-input:focus {
            border-color: var(--green-600);
            box-shadow: 0 0 0 3px rgba(31,128,60,0.10);
            outline: none;
        }

        /* ─── View Modal Hero ───────────────────────────────── */
        .seller-view-hero {
            background: linear-gradient(135deg, var(--green-50) 0%, #e8f5ec 100%);
            border-radius: 10px;
            padding: 1.25rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }

        .seller-hero-avatar {
            width: 60px; height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--green-800), var(--green-600));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.4rem;
            font-weight: 700;
            border: 3px solid var(--gold);
            flex-shrink: 0;
        }

        .view-detail-row {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--gray-100);
            font-size: 0.83rem;
        }

        .view-detail-row:last-child { border-bottom: none; }
        .view-detail-label { color: var(--text-muted); font-weight: 600; font-size: 0.78rem; }
        .view-detail-value { color: var(--green-800); font-weight: 500; text-align: right; }

        /* ─── Mobile ────────────────────────────────────────── */
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

<!-- ══════════════════════ TOP NAVBAR ══════════════════════ -->
<header class="top-navbar">
    <button class="mobile-sidebar-toggle" id="sidebarToggle" aria-label="Toggle sidebar">
        <i class="bi bi-list"></i>
    </button>

    <a class="navbar-brand-area" href="{{ url('/arbo/dashboard') }}">
        <img src="{{ asset('images/dar-logo.png') }}" alt="DAR Logo">
        <div>
            <div class="navbar-system-title">E-Agraryo Merkado</div>
            <div class="navbar-system-sub">DAR Region V</div>
        </div>
    </a>

    <span class="navbar-page-badge"><i class="bi bi-shop me-1"></i> ARBO Admin</span>

    <div class="navbar-right">
        <button class="nav-icon-btn" title="Search">
            <i class="bi bi-search"></i>
        </button>

        <!-- Notifications -->
        <div class="dropdown">
            <button class="nav-icon-btn" data-bs-toggle="dropdown" aria-label="Notifications">
                <i class="bi bi-bell"></i>
                <span class="nav-notif-dot"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="min-width:280px;border-radius:12px;margin-top:8px;">
                <li class="px-3 py-2 border-bottom">
                    <span class="fw-bold" style="font-size:.82rem;">Notifications</span>
                </li>
                <li>
                    <a class="dropdown-item py-2" href="#" style="font-size:.82rem;">
                        <i class="bi bi-person-plus text-success me-2"></i> New seller registered
                        <div class="text-muted" style="font-size:.72rem;padding-left:1.4rem;">2 hours ago</div>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item py-2" href="#" style="font-size:.82rem;">
                        <i class="bi bi-exclamation-circle text-warning me-2"></i> Seller account pending review
                        <div class="text-muted" style="font-size:.72rem;padding-left:1.4rem;">4 hours ago</div>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item py-2" href="#" style="font-size:.82rem;">
                        <i class="bi bi-box-seam text-primary me-2"></i> New product listed
                        <div class="text-muted" style="font-size:.72rem;padding-left:1.4rem;">Yesterday</div>
                    </a>
                </li>
                <li class="border-top">
                    <a class="dropdown-item text-center py-2" href="#" style="font-size:.78rem;color:var(--green-700);">View all notifications</a>
                </li>
            </ul>
        </div>

        <div class="navbar-divider d-none d-sm-block"></div>

        <!-- User Dropdown -->
        <div class="dropdown">
            <a class="user-pill dropdown-toggle" href="#" data-bs-toggle="dropdown">
                <img class="user-avatar"
                    src="{{ optional(auth()->user())->avatar ?: 'https://ui-avatars.com/api/?name=' . urlencode(optional(auth()->user())->name ?? 'ARBO Admin') . '&background=1a6932&color=fff&rounded=true&size=64' }}"
                    alt="User avatar">
                <div class="d-none d-md-block" style="line-height:1.2;">
                    <div class="user-pill-name">{{ optional(auth()->user())->name ?? 'ARBO Admin' }}</div>
                    <div class="user-pill-role">ARBO Admin</div>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="border-radius:12px;margin-top:8px;min-width:200px;">
                <li class="px-3 py-2 border-bottom">
                    <div class="fw-bold" style="font-size:.83rem;">{{ optional(auth()->user())->name ?? 'ARBO Admin' }}</div>
                    <div class="text-muted" style="font-size:.72rem;">{{ optional(auth()->user())->email ?? '' }}</div>
                </li>
                <li><a class="dropdown-item py-2" href="{{ url('/arbo/profile') }}" style="font-size:.84rem;"><i class="bi bi-person me-2 text-muted"></i>Profile</a></li>
                <li><a class="dropdown-item py-2" href="{{ url('/arbo/settings') }}" style="font-size:.84rem;"><i class="bi bi-gear me-2 text-muted"></i>Settings</a></li>
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

<!-- ══════════════════════ SIDEBAR OVERLAY ══════════════════ -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- ══════════════════════ SIDEBAR ══════════════════════════ -->
<aside class="sidebar" id="mainSidebar">
    <div class="sidebar-inner">

        <div class="sidebar-office-chip">
            <div class="office-label">ARBO Organization</div>
            <div class="office-name">{{ optional(auth()->user())->arbo_name ?? 'Your ARBO' }}</div>
        </div>

        <span class="sidebar-section-label">Main Menu</span>

        <a href="{{ url('/arbo/dashboard') }}" class="sidebar-link {{ request()->is('arbo/dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <a href="{{ url('/arbo/sellers') }}" class="sidebar-link {{ request()->is('arbo/sellers*') ? 'active' : '' }}">
            <i class="bi bi-shop"></i> Sellers
            <span class="sidebar-link-badge">{{ $totalSellers ?? '0' }}</span>
        </a>

        <a href="{{ url('/arbo/buyers') }}" class="sidebar-link {{ request()->is('arbo/buyers*') ? 'active' : '' }}">
            <i class="bi bi-bag"></i> Buyers
            <span class="sidebar-link-badge">{{ $totalBuyers ?? '0' }}</span>
        </a>

        <span class="sidebar-section-label">Marketplace</span>

        <a href="{{ url('/arbo/products') }}" class="sidebar-link {{ request()->is('arbo/products*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Products
            <span class="sidebar-link-badge">{{ $totalProducts ?? '0' }}</span>
        </a>

        <a href="{{ url('/arbo/orders') }}" class="sidebar-link {{ request()->is('arbo/orders*') ? 'active' : '' }}">
            <i class="bi bi-cart-check"></i> Orders
            <span class="sidebar-link-badge">{{ $totalOrders ?? '0' }}</span>
        </a>

        <span class="sidebar-section-label">Reports</span>

        <a href="{{ url('/arbo/reports') }}" class="sidebar-link {{ request()->is('arbo/reports*') ? 'active' : '' }}">
            <i class="bi bi-bar-chart-line"></i> Sales Reports
        </a>

        <span class="sidebar-section-label">Account</span>

        <a href="{{ url('/arbo/profile') }}" class="sidebar-link {{ request()->is('arbo/profile*') ? 'active' : '' }}">
            <i class="bi bi-person"></i> Profile
        </a>

        <div class="sidebar-logout">
            <form method="POST" action="{{ url('/logout') }}">
                @csrf
                <button type="submit" class="sidebar-link w-100 text-start">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- ══════════════════════ MAIN CONTENT ═════════════════════ -->
<main class="page-wrapper">

    <!-- ── Page Header ─────────────────────────────────────── -->
    <div class="page-header">
        <div>
            <div class="breadcrumb-custom mb-1">
                <a href="{{ url('/arbo/dashboard') }}">Dashboard</a>
                <i class="bi bi-chevron-right" style="font-size:.6rem;"></i>
                <span>Seller Management</span>
            </div>
            <h1 class="page-header-title">
                <i class="bi bi-shop-window me-2" style="color:var(--gold);font-size:1.3rem;vertical-align:middle;"></i>
                Seller Management
            </h1>
            <p class="page-header-sub">Manage farmer and seller accounts under this ARBO organization.</p>
        </div>
        <div class="d-flex gap-2 flex-wrap align-items-start">
            <button class="btn-green-outline">
                <i class="bi bi-download"></i> Export List
            </button>
            <button class="btn-green-primary" data-bs-toggle="modal" data-bs-target="#addSellerModal">
                <i class="bi bi-plus-circle-fill"></i> Add Seller
            </button>
        </div>
    </div>

    <!-- ── Summary Stat Cards ──────────────────────────────── -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-green">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $totalSellers ?? 0 }}</div>
                    <p class="stat-label">Total Sellers</p>
                    <div class="stat-sub">Registered accounts</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-teal">
                    <i class="bi bi-person-check-fill"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $activeSellers ?? 0 }}</div>
                    <p class="stat-label">Active Sellers</p>
                    <div class="stat-sub">Currently active</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-orange">
                    <i class="bi bi-person-dash-fill"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $inactiveSellers ?? 0 }}</div>
                    <p class="stat-label">Inactive Sellers</p>
                    <div class="stat-sub">Need review</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-gold">
                    <i class="bi bi-box-seam-fill"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $sellersWithProducts ?? 0 }}</div>
                    <p class="stat-label">With Products</p>
                    <div class="stat-sub">Have active listings</div>
                </div>
            </div>
        </div>
    </div>

    <!-- ── Filter / Search ─────────────────────────────────── -->
    <div class="filter-card mb-3">
        <form method="GET" action="{{ url('/arbo/sellers') }}">
            <div class="row g-2 align-items-end">
                <div class="col-12 col-md-4">
                    <label class="filter-label">Search Sellers</label>
                    <div class="input-group" style="flex-wrap:nowrap;">
                        <span class="input-group-text" style="background:var(--gray-100);border:1.5px solid var(--gray-200);border-right:none;border-radius:var(--radius-sm) 0 0 var(--radius-sm);font-size:.85rem;color:var(--gray-400);">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text"
                               class="filter-input"
                               style="border-radius:0 var(--radius-sm) var(--radius-sm) 0;border-left:none;"
                               placeholder="Name, contact number, username..."
                               name="search"
                               value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <label class="filter-label">Status</label>
                    <select class="filter-input" name="status">
                        <option value="">All Status</option>
                        <option value="active"   {{ request('status') == 'active'   ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="pending"  {{ request('status') == 'pending'  ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>
                <div class="col-6 col-md-2">
                    <label class="filter-label">Products</label>
                    <select class="filter-input" name="has_products">
                        <option value="">All</option>
                        <option value="yes" {{ request('has_products') == 'yes' ? 'selected' : '' }}>With Products</option>
                        <option value="no"  {{ request('has_products') == 'no'  ? 'selected' : '' }}>No Products</option>
                    </select>
                </div>
                <div class="col-6 col-md-2">
                    <label class="filter-label">Commodity</label>
                    <select class="filter-input" name="commodity">
                        <option value="">All Types</option>
                        <option value="vegetables" {{ request('commodity') == 'vegetables' ? 'selected' : '' }}>Vegetables</option>
                        <option value="fruits"     {{ request('commodity') == 'fruits'     ? 'selected' : '' }}>Fruits</option>
                        <option value="grains"     {{ request('commodity') == 'grains'     ? 'selected' : '' }}>Rice / Grains</option>
                        <option value="livestock"  {{ request('commodity') == 'livestock'  ? 'selected' : '' }}>Livestock</option>
                        <option value="processed"  {{ request('commodity') == 'processed'  ? 'selected' : '' }}>Processed Goods</option>
                    </select>
                </div>
                <div class="col-6 col-md-2 d-flex gap-2">
                    <button type="submit" class="btn-filter w-100">
                        <i class="bi bi-funnel-fill"></i> Filter
                    </button>
                    <a href="{{ url('/arbo/sellers') }}" class="btn-reset-filter w-100">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- ── Sellers Table ────────────────────────────────────── -->
    <div class="table-card mb-4">
        <div class="table-card-header">
            <h6 class="table-card-title">
                <i class="bi bi-table"></i> Registered Sellers
            </h6>
            <span class="table-record-pill">Showing 1–8 of {{ $totalSellers ?? 24 }} records</span>
        </div>

        <div class="table-responsive">
            <table class="arbo-table">
                <thead>
                    <tr>
                        <th>Seller ID</th>
                        <th>Full Name</th>
                        <th>Contact Number</th>
                        <th>Username</th>
                        <th>Address</th>
                        <th class="text-center">Products</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Replace with @foreach($sellers as $seller) in production --}}
                    @php
                        $sampleSellers = [
                            ['id'=>'SLR-2024-001','name'=>'Maria Santos',    'initials'=>'MS','contact'=>'09171234567','username'=>'msantos',    'address'=>'Baao, Camarines Sur',     'products'=>12,'status'=>'active'],
                            ['id'=>'SLR-2024-002','name'=>'Juan dela Cruz',   'initials'=>'JC','contact'=>'09189876543','username'=>'jdelacruz',  'address'=>'Nabua, Camarines Sur',    'products'=>7, 'status'=>'active'],
                            ['id'=>'SLR-2024-003','name'=>'Rosa Almeda',      'initials'=>'RA','contact'=>'09205551234','username'=>'ralmeda',     'address'=>'Iriga City, Cam. Sur',    'products'=>0, 'status'=>'inactive'],
                            ['id'=>'SLR-2024-004','name'=>'Pedro Reyes',      'initials'=>'PR','contact'=>'09278887890','username'=>'preyes',      'address'=>'Bula, Camarines Sur',     'products'=>5, 'status'=>'active'],
                            ['id'=>'SLR-2024-005','name'=>'Luz Villanueva',   'initials'=>'LV','contact'=>'09123334455','username'=>'lvillanueva', 'address'=>'Naga City, Cam. Sur',     'products'=>21,'status'=>'active'],
                            ['id'=>'SLR-2024-006','name'=>'Carlos Mendoza',   'initials'=>'CM','contact'=>'09354567890','username'=>'cmendoza',    'address'=>'Libmanan, Cam. Sur',      'products'=>3, 'status'=>'pending'],
                            ['id'=>'SLR-2024-007','name'=>'Elena Torres',     'initials'=>'ET','contact'=>'09261112233','username'=>'etorres',     'address'=>'Pili, Camarines Sur',     'products'=>9, 'status'=>'active'],
                            ['id'=>'SLR-2024-008','name'=>'Roberto Alcantara','initials'=>'RA','contact'=>'09499998877','username'=>'ralcantara',  'address'=>'Ocampo, Camarines Sur',   'products'=>0, 'status'=>'inactive'],
                        ];
                    @endphp

                    @foreach($sampleSellers as $seller)
                    <tr>
                        <td>
                            <span class="id-mono">{{ $seller['id'] }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="seller-avatar">{{ $seller['initials'] }}</div>
                                <div>
                                    <div class="name-cell-primary">{{ $seller['name'] }}</div>
                                    <div class="name-cell-sub">Farmer / Seller</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span style="font-size:.83rem;">
                                <i class="bi bi-telephone-fill me-1" style="font-size:.7rem;color:var(--green-600);"></i>
                                {{ $seller['contact'] }}
                            </span>
                        </td>
                        <td>
                            <span style="font-family:'Courier New',monospace;font-size:.8rem;color:var(--green-700);">
                                @{{ $seller['username'] }}
                            </span>
                        </td>
                        <td>
                            <span style="font-size:.82rem;color:var(--text-muted);">
                                <i class="bi bi-geo-alt-fill me-1" style="font-size:.7rem;color:#c0392b;"></i>
                                {{ $seller['address'] }}
                            </span>
                        </td>
                        <td class="text-center">
                            <span class="product-count-badge">
                                <i class="bi bi-box"></i> {{ $seller['products'] }}
                            </span>
                        </td>
                        <td class="text-center">
                            @if($seller['status'] === 'active')
                                <span class="status-badge status-active"><span class="status-dot"></span>Active</span>
                            @elseif($seller['status'] === 'inactive')
                                <span class="status-badge status-inactive"><span class="status-dot"></span>Inactive</span>
                            @else
                                <span class="status-badge status-pending"><span class="status-dot"></span>Pending</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-1 justify-content-center flex-wrap">
                                <button class="tbl-action-btn btn-view-tbl"
                                        data-bs-toggle="modal"
                                        data-bs-target="#viewSellerModal"
                                        title="View Details">
                                    <i class="bi bi-eye-fill"></i> View
                                </button>
                                <button class="tbl-action-btn btn-edit-tbl"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editSellerModal"
                                        title="Edit Seller">
                                    <i class="bi bi-pencil-fill"></i> Edit
                                </button>
                                @if($seller['status'] === 'active')
                                    <button class="tbl-action-btn btn-deact-tbl" title="Deactivate">
                                        <i class="bi bi-slash-circle-fill"></i> Deactivate
                                    </button>
                                @else
                                    <button class="tbl-action-btn btn-activ-tbl" title="Activate">
                                        <i class="bi bi-check-circle-fill"></i> Activate
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-bar">
            <div>Showing <strong>1–8</strong> of <strong>{{ $totalSellers ?? 24 }}</strong> sellers</div>
            <nav aria-label="Sellers pagination">
                <ul class="pagination mb-0 custom-pagination">
                    <li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
            </nav>
        </div>
    </div>

    <!-- ── Bottom Two-Column Section ───────────────────────── -->
    <div class="row g-4">

        <!-- Quick Actions -->
        <div class="col-md-4">
            <div class="section-title">
                <div class="section-title-bar"></div>
                Quick Actions
            </div>
            <div class="side-card">
                <div class="side-card-header">
                    <h6><i class="bi bi-lightning-charge-fill"></i> Seller Management</h6>
                    <p>Shortcuts for common seller tasks</p>
                </div>
                <div>
                    <button class="qa-row" data-bs-toggle="modal" data-bs-target="#addSellerModal">
                        <div class="qa-icon-wrap" style="background:var(--green-100);color:var(--green-700);">
                            <i class="bi bi-person-plus-fill"></i>
                        </div>
                        <div>
                            <div style="font-weight:600;font-size:.83rem;">Register New Seller</div>
                            <div style="font-size:.72rem;color:var(--text-muted);">Add a new farmer/seller account</div>
                        </div>
                        <i class="bi bi-chevron-right ms-auto" style="font-size:.72rem;color:var(--gray-400);"></i>
                    </button>
                    <button class="qa-row">
                        <div class="qa-icon-wrap" style="background:#fdecea;color:#c0392b;">
                            <i class="bi bi-person-dash-fill"></i>
                        </div>
                        <div>
                            <div style="font-weight:600;font-size:.83rem;">Review Inactive Sellers</div>
                            <div style="font-size:.72rem;color:var(--text-muted);">{{ $inactiveSellers ?? 3 }} accounts need attention</div>
                        </div>
                        <i class="bi bi-chevron-right ms-auto" style="font-size:.72rem;color:var(--gray-400);"></i>
                    </button>
                    <button class="qa-row">
                        <div class="qa-icon-wrap" style="background:#e8f0fe;color:#1a73e8;">
                            <i class="bi bi-box-seam-fill"></i>
                        </div>
                        <div>
                            <div style="font-weight:600;font-size:.83rem;">View Seller Products</div>
                            <div style="font-size:.72rem;color:var(--text-muted);">Browse all product listings</div>
                        </div>
                        <i class="bi bi-chevron-right ms-auto" style="font-size:.72rem;color:var(--gray-400);"></i>
                    </button>
                    <button class="qa-row">
                        <div class="qa-icon-wrap" style="background:var(--gold-light);color:var(--gold);">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <div>
                            <div style="font-weight:600;font-size:.83rem;">Monitor Seller Performance</div>
                            <div style="font-size:.72rem;color:var(--text-muted);">View sales and activity reports</div>
                        </div>
                        <i class="bi bi-chevron-right ms-auto" style="font-size:.72rem;color:var(--gray-400);"></i>
                    </button>
                    <button class="qa-row">
                        <div class="qa-icon-wrap" style="background:#f3e8ff;color:#7c3aed;">
                            <i class="bi bi-download"></i>
                        </div>
                        <div>
                            <div style="font-weight:600;font-size:.83rem;">Export Seller List</div>
                            <div style="font-size:.72rem;color:var(--text-muted);">Download as PDF or Excel</div>
                        </div>
                        <i class="bi bi-chevron-right ms-auto" style="font-size:.72rem;color:var(--gray-400);"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="col-md-8">
            <div class="section-title">
                <div class="section-title-bar"></div>
                Recent Seller Activity
            </div>
            <div class="side-card">
                <div class="side-card-header">
                    <h6><i class="bi bi-clock-history"></i> Activity Log</h6>
                    <p>Latest events from seller accounts in your ARBO</p>
                </div>
                <div>
                    <div class="activity-item">
                        <div class="activity-dot-wrap">
                            <div class="activity-dot ad-green"><i class="bi bi-person-plus-fill"></i></div>
                        </div>
                        <div style="flex:1;">
                            <div class="activity-title">New seller registered — Maria Santos</div>
                            <div class="activity-meta"><i class="bi bi-clock me-1"></i>2 hours ago &bull; <span style="background:var(--green-100);color:var(--green-700);font-size:.68rem;font-weight:700;padding:1px 7px;border-radius:20px;">Active</span></div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot-wrap">
                            <div class="activity-dot ad-blue"><i class="bi bi-box-seam-fill"></i></div>
                        </div>
                        <div style="flex:1;">
                            <div class="activity-title">Luz Villanueva posted 3 new products</div>
                            <div class="activity-meta"><i class="bi bi-clock me-1"></i>4 hours ago &bull; Vegetables Category</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot-wrap">
                            <div class="activity-dot ad-gold"><i class="bi bi-pencil-fill"></i></div>
                        </div>
                        <div style="flex:1;">
                            <div class="activity-title">Pedro Reyes updated profile information</div>
                            <div class="activity-meta"><i class="bi bi-clock me-1"></i>Yesterday, 3:15 PM &bull; Contact &amp; Address updated</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot-wrap">
                            <div class="activity-dot ad-red"><i class="bi bi-slash-circle-fill"></i></div>
                        </div>
                        <div style="flex:1;">
                            <div class="activity-title">Roberto Alcantara account deactivated</div>
                            <div class="activity-meta"><i class="bi bi-clock me-1"></i>Yesterday, 10:45 AM &bull; Reason: Inactive for 90 days</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot-wrap">
                            <div class="activity-dot ad-green"><i class="bi bi-check-circle-fill"></i></div>
                        </div>
                        <div style="flex:1;">
                            <div class="activity-title">Carlos Mendoza account approved</div>
                            <div class="activity-meta"><i class="bi bi-clock me-1"></i>2 days ago &bull; Status changed: Pending → Active</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot-wrap">
                            <div class="activity-dot ad-teal"><i class="bi bi-bag-check-fill"></i></div>
                        </div>
                        <div style="flex:1;">
                            <div class="activity-title">Juan dela Cruz fulfilled 2 orders</div>
                            <div class="activity-meta"><i class="bi bi-clock me-1"></i>2 days ago &bull; Orders #ORD-1023, #ORD-1024</div>
                        </div>
                    </div>
                </div>
                <div style="padding:.65rem 1.1rem;background:var(--gray-50);border-top:1px solid var(--gray-200);text-align:center;">
                    <a href="#" style="font-size:.78rem;color:var(--green-700);font-weight:600;text-decoration:none;">
                        View All Activity Logs <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>{{-- /row --}}
</main>

<!-- ══════════════════════════════════════════════════════════
     MODALS
══════════════════════════════════════════════════════════ -->

<!-- ── Add Seller Modal ───────────────────────────────────── -->
<div class="modal fade" id="addSellerModal" tabindex="-1" aria-labelledby="addSellerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header modal-header-dark">
                <h5 class="modal-title" id="addSellerModalLabel">
                    <i class="bi bi-person-plus-fill me-2"></i>Register New Seller
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ url('/arbo/sellers') }}">
                    @csrf
                    <div class="modal-section-label">Personal Information</div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="modal-form-label">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="modal-form-input" name="first_name" placeholder="Enter first name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="modal-form-label">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="modal-form-input" name="last_name" placeholder="Enter last name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="modal-form-label">Contact Number <span class="text-danger">*</span></label>
                            <input type="text" class="modal-form-input" name="contact" placeholder="09XXXXXXXXX" required>
                        </div>
                        <div class="col-md-6">
                            <label class="modal-form-label">Email Address</label>
                            <input type="email" class="modal-form-input" name="email" placeholder="seller@email.com">
                        </div>
                        <div class="col-12">
                            <label class="modal-form-label">Complete Address <span class="text-danger">*</span></label>
                            <input type="text" class="modal-form-input" name="address" placeholder="Barangay, Municipality, Province" required>
                        </div>
                    </div>

                    <div class="modal-section-label">Account Credentials</div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="modal-form-label">Username <span class="text-danger">*</span></label>
                            <div class="input-group" style="flex-wrap:nowrap;">
                                <span class="input-group-text" style="background:var(--gray-100);border:1.5px solid var(--gray-200);border-right:none;border-radius:var(--radius-sm) 0 0 var(--radius-sm);font-size:.83rem;">@</span>
                                <input type="text" class="modal-form-input" style="border-radius:0 var(--radius-sm) var(--radius-sm) 0;border-left:none;" name="username" placeholder="username" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="modal-form-label">Initial Password <span class="text-danger">*</span></label>
                            <input type="password" class="modal-form-input" name="password" placeholder="Min. 8 characters" required>
                        </div>
                    </div>

                    <div class="modal-section-label">Farm / Seller Information</div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="modal-form-label">Farm / Business Name</label>
                            <input type="text" class="modal-form-input" name="farm_name" placeholder="Optional farm or business name">
                        </div>
                        <div class="col-md-6">
                            <label class="modal-form-label">Commodity Type</label>
                            <select class="modal-form-input" name="commodity">
                                <option value="">Select commodity</option>
                                <option>Vegetables</option>
                                <option>Fruits</option>
                                <option>Rice / Grains</option>
                                <option>Livestock</option>
                                <option>Fiber Crops</option>
                                <option>Processed Goods</option>
                                <option>Others</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="modal-form-label">Initial Account Status</label>
                            <div class="d-flex gap-3 mt-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="addStatusActive" value="active" checked>
                                    <label class="form-check-label" style="font-size:.83rem;" for="addStatusActive">Active</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="addStatusPending" value="pending">
                                    <label class="form-check-label" style="font-size:.83rem;" for="addStatusPending">Pending Verification</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="border-top:1px solid var(--gray-200);padding:.9rem 1.5rem;">
                <button class="btn-reset-filter" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Cancel
                </button>
                <button class="btn-green-primary">
                    <i class="bi bi-check-circle-fill"></i> Register Seller
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ── View Seller Modal ──────────────────────────────────── -->
<div class="modal fade" id="viewSellerModal" tabindex="-1" aria-labelledby="viewSellerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header modal-header-dark">
                <h5 class="modal-title" id="viewSellerModalLabel">
                    <i class="bi bi-person-badge-fill me-2"></i>Seller Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <!-- Profile Hero -->
                <div class="seller-view-hero">
                    <div class="seller-hero-avatar">MS</div>
                    <div style="flex:1;">
                        <div style="font-size:1.1rem;font-weight:700;color:var(--green-900);">Maria Santos</div>
                        <div style="font-size:.78rem;color:var(--text-muted);">@msantos &bull; Farmer / Seller</div>
                        <div class="mt-2 d-flex gap-2 flex-wrap">
                            <span class="status-badge status-active"><span class="status-dot"></span>Active</span>
                            <span class="product-count-badge"><i class="bi bi-box"></i> 12 Products</span>
                        </div>
                    </div>
                    <div class="text-end">
                        <div style="font-size:.7rem;color:var(--text-muted);font-weight:600;text-transform:uppercase;letter-spacing:.5px;">Seller ID</div>
                        <div style="font-family:'Courier New',monospace;font-size:.82rem;color:var(--green-800);font-weight:700;">SLR-2024-001</div>
                        <div style="font-size:.7rem;color:var(--text-muted);margin-top:.25rem;">Joined: Jan 15, 2024</div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="modal-section-label">Contact Information</div>
                        <div class="view-detail-row">
                            <span class="view-detail-label">Phone Number</span>
                            <span class="view-detail-value">09171234567</span>
                        </div>
                        <div class="view-detail-row">
                            <span class="view-detail-label">Email Address</span>
                            <span class="view-detail-value">msantos@email.com</span>
                        </div>
                        <div class="view-detail-row">
                            <span class="view-detail-label">Address</span>
                            <span class="view-detail-value">Baao, Camarines Sur</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="modal-section-label">Farm Information</div>
                        <div class="view-detail-row">
                            <span class="view-detail-label">Farm Name</span>
                            <span class="view-detail-value">Santos Farm</span>
                        </div>
                        <div class="view-detail-row">
                            <span class="view-detail-label">Commodity</span>
                            <span class="view-detail-value">Vegetables</span>
                        </div>
                        <div class="view-detail-row">
                            <span class="view-detail-label">Total Sales</span>
                            <span class="view-detail-value" style="color:var(--green-800);font-weight:700;">₱ 14,250.00</span>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="modal-section-label">Performance Overview</div>
                        <div class="row g-2 text-center">
                            <div class="col-3">
                                <div style="background:var(--green-50);border:1px solid var(--green-200);border-radius:10px;padding:.75rem;">
                                    <div style="font-size:1.25rem;font-weight:700;color:var(--green-800);">12</div>
                                    <div style="font-size:.68rem;color:var(--text-muted);font-weight:600;">Products</div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div style="background:var(--green-50);border:1px solid var(--green-200);border-radius:10px;padding:.75rem;">
                                    <div style="font-size:1.25rem;font-weight:700;color:var(--green-800);">38</div>
                                    <div style="font-size:.68rem;color:var(--text-muted);font-weight:600;">Orders</div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div style="background:var(--gold-light);border:1px solid var(--gold-mid);border-radius:10px;padding:.75rem;">
                                    <div style="font-size:1.25rem;font-weight:700;color:var(--gold);">4.8</div>
                                    <div style="font-size:.68rem;color:var(--text-muted);font-weight:600;">Rating</div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div style="background:var(--green-50);border:1px solid var(--green-200);border-radius:10px;padding:.75rem;">
                                    <div style="font-size:1.25rem;font-weight:700;color:var(--green-800);">95%</div>
                                    <div style="font-size:.68rem;color:var(--text-muted);font-weight:600;">Fulfillment</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border-top:1px solid var(--gray-200);padding:.9rem 1.5rem;">
                <button class="btn-reset-filter" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Close
                </button>
                <button class="tbl-action-btn btn-deact-tbl" style="padding:.44rem .95rem;font-size:.81rem;">
                    <i class="bi bi-slash-circle-fill"></i> Deactivate
                </button>
                <button class="btn-green-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#editSellerModal"
                        data-bs-dismiss="modal">
                    <i class="bi bi-pencil-fill"></i> Edit Seller
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ── Edit Seller Modal ──────────────────────────────────── -->
<div class="modal fade" id="editSellerModal" tabindex="-1" aria-labelledby="editSellerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header modal-header-dark">
                <h5 class="modal-title" id="editSellerModalLabel">
                    <i class="bi bi-pencil-square me-2"></i>Edit Seller Information
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="#" >
                    @csrf
                    @method('PUT')

                    <div class="modal-section-label">Personal Information</div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="modal-form-label">First Name</label>
                            <input type="text" class="modal-form-input" name="first_name" value="Maria">
                        </div>
                        <div class="col-md-6">
                            <label class="modal-form-label">Last Name</label>
                            <input type="text" class="modal-form-input" name="last_name" value="Santos">
                        </div>
                        <div class="col-md-6">
                            <label class="modal-form-label">Contact Number</label>
                            <input type="text" class="modal-form-input" name="contact" value="09171234567">
                        </div>
                        <div class="col-md-6">
                            <label class="modal-form-label">Email Address</label>
                            <input type="email" class="modal-form-input" name="email" value="msantos@email.com">
                        </div>
                        <div class="col-12">
                            <label class="modal-form-label">Complete Address</label>
                            <input type="text" class="modal-form-input" name="address" value="Baao, Camarines Sur">
                        </div>
                    </div>

                    <div class="modal-section-label">Farm / Seller Information</div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="modal-form-label">Farm / Business Name</label>
                            <input type="text" class="modal-form-input" name="farm_name" value="Santos Farm">
                        </div>
                        <div class="col-md-6">
                            <label class="modal-form-label">Commodity Type</label>
                            <select class="modal-form-input" name="commodity">
                                <option selected>Vegetables</option>
                                <option>Fruits</option>
                                <option>Rice / Grains</option>
                                <option>Livestock</option>
                                <option>Fiber Crops</option>
                                <option>Processed Goods</option>
                                <option>Others</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-section-label">Account Status</div>
                    <div class="d-flex gap-3 flex-wrap mt-1">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="editStatusActive" value="active" checked>
                            <label class="form-check-label" style="font-size:.83rem;" for="editStatusActive">Active</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="editStatusInactive" value="inactive">
                            <label class="form-check-label" style="font-size:.83rem;" for="editStatusInactive">Inactive</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="editStatusPending" value="pending">
                            <label class="form-check-label" style="font-size:.83rem;" for="editStatusPending">Pending</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="border-top:1px solid var(--gray-200);padding:.9rem 1.5rem;">
                <button class="btn-reset-filter" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Cancel
                </button>
                <button class="btn-green-primary">
                    <i class="bi bi-check-circle-fill"></i> Save Changes
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggle  = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('mainSidebar');
        const overlay = document.getElementById('sidebarOverlay');

        function openSidebar()  {
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
    });
</script>
</body>
</html>