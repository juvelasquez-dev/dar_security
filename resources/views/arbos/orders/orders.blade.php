<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Management — E-Agraryo Merkado</title>
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
            width: 1px; height: 28px;
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
            background: none; border: none;
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
            display: flex; align-items: center; gap: 0.5rem;
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
            display: flex; align-items: center; gap: 0.65rem;
            padding: 0.56rem 0.75rem;
            border-radius: var(--radius-sm);
            font-size: 0.875rem; font-weight: 500;
            color: var(--gray-600);
            text-decoration: none;
            transition: all 0.18s;
            margin-bottom: 2px;
            position: relative;
            border: none; background: transparent;
            width: 100%; text-align: left;
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

        .sidebar-link-badge {
            margin-left: auto;
            font-size: 0.65rem; font-weight: 700;
            background: var(--green-100);
            color: var(--green-700);
            padding: 2px 7px;
            border-radius: 20px;
        }

        .sidebar-link.active .sidebar-link-badge { background: var(--green-600); color: #fff; }

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
            font-size: 0.62rem; font-weight: 700;
            letter-spacing: 0.1em; text-transform: uppercase;
            color: var(--green-600);
        }

        .sidebar-office-chip .office-name {
            font-size: 0.82rem; font-weight: 600;
            color: var(--green-900); margin-top: 1px;
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

        .page-header-sub { font-size: 0.85rem; color: var(--text-muted); margin: 0; }

        .breadcrumb-custom {
            font-size: 0.75rem; color: var(--gray-400);
            margin-bottom: 0.3rem;
            display: flex; align-items: center; gap: 0.35rem;
        }

        .breadcrumb-custom a { color: var(--green-600); text-decoration: none; font-weight: 500; }
        .breadcrumb-custom a:hover { text-decoration: underline; }

        /* ─── Buttons ───────────────────────────────────────── */
        .btn-green-primary {
            background: var(--green-800); color: #fff;
            border: none; border-radius: var(--radius-sm);
            font-size: 0.83rem; font-weight: 600;
            padding: 0.5rem 1.1rem;
            display: inline-flex; align-items: center; gap: 0.4rem;
            cursor: pointer;
            transition: background 0.18s, transform 0.18s, box-shadow 0.18s;
            text-decoration: none;
        }

        .btn-green-primary:hover {
            background: var(--green-700); color: #fff;
            transform: translateY(-1px); box-shadow: var(--shadow-sm);
        }

        .btn-green-outline {
            background: transparent; color: var(--green-700);
            border: 1.5px solid var(--green-600);
            border-radius: var(--radius-sm);
            font-size: 0.83rem; font-weight: 600;
            padding: 0.48rem 1.1rem;
            display: inline-flex; align-items: center; gap: 0.4rem;
            cursor: pointer; transition: all 0.18s; text-decoration: none;
        }

        .btn-green-outline:hover { background: var(--green-100); color: var(--green-800); }

        /* ─── Stat Cards ────────────────────────────────────── */
        .stat-card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            padding: 1.4rem 1.5rem;
            display: flex; align-items: center; gap: 1rem;
            transition: box-shadow 0.22s, transform 0.22s;
            border: 1px solid var(--gray-200);
            height: 100%;
        }

        .stat-card:hover { box-shadow: var(--shadow-md); transform: translateY(-4px); }

        .stat-icon-wrap {
            width: 52px; height: 52px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.35rem; flex-shrink: 0;
        }

        .stat-icon-green  { background: var(--green-100); color: var(--green-700); }
        .stat-icon-gold   { background: var(--gold-light); color: var(--gold); }
        .stat-icon-blue   { background: #e8f0fe; color: #1a73e8; }
        .stat-icon-red    { background: #fdecea; color: #c0392b; }

        .stat-value { font-size: 2rem; font-weight: 700; color: var(--text-main); line-height: 1; margin-bottom: 3px; }
        .stat-label { font-size: 0.82rem; font-weight: 500; color: var(--text-muted); margin: 0; }
        .stat-sub   { font-size: 0.72rem; color: var(--gray-400); margin-top: 3px; }

        /* ─── Section Title ─────────────────────────────────── */
        .section-title {
            font-size: 0.95rem; font-weight: 700;
            color: var(--text-main);
            margin-bottom: 1rem;
            display: flex; align-items: center; gap: 0.5rem;
        }

        .section-title-bar {
            width: 4px; height: 18px;
            background: var(--green-600);
            border-radius: 3px; flex-shrink: 0;
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
            font-size: 0.75rem; font-weight: 700;
            color: var(--green-800); letter-spacing: 0.03em;
            margin-bottom: 0.3rem; display: block;
        }

        .filter-input {
            font-size: 0.83rem;
            border-radius: var(--radius-sm);
            border: 1.5px solid var(--gray-200);
            padding: 0.45rem 0.85rem;
            color: var(--text-main); background: #fff;
            transition: border-color 0.18s, box-shadow 0.18s;
            width: 100%;
        }

        .filter-input:focus {
            border-color: var(--green-600);
            box-shadow: 0 0 0 3px rgba(31,128,60,0.10);
            outline: none;
        }

        .btn-filter {
            background: var(--green-700); color: #fff;
            border: none; border-radius: var(--radius-sm);
            font-size: 0.83rem; font-weight: 600;
            padding: 0.45rem 1rem;
            display: inline-flex; align-items: center; gap: 0.35rem;
            cursor: pointer; transition: background 0.18s;
        }

        .btn-filter:hover { background: var(--green-900); color: #fff; }

        .btn-reset-filter {
            background: var(--gray-100); color: var(--gray-600);
            border: 1.5px solid var(--gray-200);
            border-radius: var(--radius-sm);
            font-size: 0.83rem; font-weight: 600;
            padding: 0.43rem 1rem;
            display: inline-flex; align-items: center; gap: 0.35rem;
            cursor: pointer; transition: background 0.18s;
            text-decoration: none;
        }

        .btn-reset-filter:hover { background: var(--gray-200); color: var(--gray-800); }

        /* ─── Tab Pills ─────────────────────────────────────── */
        .status-tabs {
            display: flex;
            gap: 0.35rem;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        .status-tab {
            border: 1.5px solid var(--gray-200);
            background: #fff;
            border-radius: 30px;
            padding: 5px 16px;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--gray-600);
            cursor: pointer;
            transition: all 0.18s;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }

        .status-tab:hover { border-color: var(--green-600); color: var(--green-700); background: var(--green-50); }

        .status-tab.active {
            background: var(--green-800);
            border-color: var(--green-800);
            color: #fff;
        }

        .tab-count {
            background: rgba(255,255,255,0.2);
            border-radius: 20px;
            padding: 0 6px;
            font-size: 0.68rem;
            font-weight: 700;
        }

        .status-tab:not(.active) .tab-count {
            background: var(--gray-200);
            color: var(--gray-600);
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
            background: var(--green-900);
            padding: 0.95rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .table-card-title {
            font-size: 0.9rem; font-weight: 700;
            color: #fff; margin: 0;
            display: flex; align-items: center; gap: 0.45rem;
        }

        .table-card-title i { color: var(--gold-mid); }

        .table-record-pill {
            background: rgba(255,255,255,0.13);
            color: rgba(255,255,255,0.88);
            font-size: 0.72rem; font-weight: 600;
            padding: 3px 10px; border-radius: 20px;
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

        /* ─── Order Number ──────────────────────────────────── */
        .order-no {
            font-family: 'Courier New', monospace;
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--green-800);
        }

        /* ─── Buyer Cell ────────────────────────────────────── */
        .buyer-avatar-sm {
            width: 30px; height: 30px;
            border-radius: 50%;
            background: linear-gradient(135deg, #1a5276, #2980b9);
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 0.68rem; font-weight: 700;
            flex-shrink: 0;
        }

        /* ─── Product Chips ─────────────────────────────────── */
        .product-chip {
            display: inline-flex; align-items: center; gap: 3px;
            background: var(--green-50);
            border: 1px solid var(--green-200);
            border-radius: 6px;
            padding: 2px 7px;
            font-size: 0.7rem; font-weight: 600;
            color: var(--green-800);
            white-space: nowrap;
            margin: 1px;
        }

        .product-chip-more {
            background: var(--gray-100);
            color: var(--gray-600);
            border: 1px solid var(--gray-200);
        }

        /* ─── Amount Cell ───────────────────────────────────── */
        .amount-val {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--green-800);
        }

        /* ─── Status Badges ─────────────────────────────────── */
        .status-badge {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 3px 10px; border-radius: 20px;
            font-size: 0.72rem; font-weight: 600;
            white-space: nowrap;
        }

        .status-dot { width: 6px; height: 6px; border-radius: 50%; display: inline-block; }

        /* Order Status */
        .ord-pending    { background: var(--gold-light); color: #8a6000; }
        .ord-pending    .status-dot { background: var(--gold); }
        .ord-processing { background: #e8f0fe; color: #1a73e8; }
        .ord-processing .status-dot { background: #1a73e8; }
        .ord-completed  { background: var(--green-100); color: var(--green-700); }
        .ord-completed  .status-dot { background: var(--green-600); }
        .ord-cancelled  { background: #fdecea; color: #c0392b; }
        .ord-cancelled  .status-dot { background: #c0392b; }
        .ord-shipped    { background: #e0f7f5; color: #0d8a7e; }
        .ord-shipped    .status-dot { background: #0d8a7e; }

        /* Payment Status */
        .pay-pending { background: var(--gold-light); color: #8a6000; }
        .pay-pending .status-dot { background: var(--gold); }
        .pay-paid    { background: var(--green-100); color: var(--green-700); }
        .pay-paid    .status-dot { background: var(--green-600); }
        .pay-failed  { background: #fdecea; color: #c0392b; }
        .pay-failed  .status-dot { background: #c0392b; }
        .pay-refunded { background: #f3e8ff; color: #7c3aed; }
        .pay-refunded .status-dot { background: #7c3aed; }

        /* ─── Table Action Buttons ──────────────────────────── */
        .tbl-action-btn {
            font-size: 0.72rem; font-weight: 600;
            padding: 0.27rem 0.65rem;
            border-radius: 6px; border: none;
            cursor: pointer;
            transition: all 0.16s;
            display: inline-flex; align-items: center; gap: 0.25rem;
        }

        .btn-view-tbl        { background: #e8f0fe; color: #1a73e8; }
        .btn-view-tbl:hover  { background: #d1e4fc; }
        .btn-print-tbl       { background: var(--gray-100); color: var(--gray-600); }
        .btn-print-tbl:hover { background: var(--gray-200); }
        .btn-upd-tbl         { background: var(--green-100); color: var(--green-700); }
        .btn-upd-tbl:hover   { background: var(--green-200); }

        /* ─── Pagination ────────────────────────────────────── */
        .pagination-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.8rem 1.2rem;
            border-top: 1px solid var(--gray-200);
            font-size: 0.78rem; color: var(--text-muted);
            flex-wrap: wrap; gap: 0.5rem;
        }

        .custom-pagination .page-link {
            font-size: 0.78rem; color: var(--green-700);
            border-color: var(--gray-200);
            padding: 0.3rem 0.65rem;
            border-radius: 6px !important; margin: 0 1px;
        }

        .custom-pagination .page-item.active .page-link {
            background: var(--green-700); border-color: var(--green-700); color: #fff;
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

        .side-card-header { background: var(--green-900); padding: 0.85rem 1.25rem; }
        .side-card-header h6 {
            font-size: 0.88rem; font-weight: 700; color: #fff;
            margin: 0; display: flex; align-items: center; gap: 0.4rem;
        }
        .side-card-header h6 i { color: var(--gold-mid); }
        .side-card-header p { margin: 0.2rem 0 0; font-size: 0.72rem; color: rgba(255,255,255,0.55); }

        .qa-row {
            display: flex; align-items: center; gap: 0.75rem;
            padding: 0.85rem 1.1rem;
            border: none; background: transparent; width: 100%;
            text-align: left; font-size: 0.83rem; color: var(--text-main);
            font-weight: 500; border-bottom: 1px solid var(--gray-100);
            transition: background 0.16s; cursor: pointer; text-decoration: none;
        }

        .qa-row:hover { background: var(--green-50); color: var(--green-800); }
        .qa-row:last-child { border-bottom: none; }

        .qa-icon-wrap {
            width: 36px; height: 36px; border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.95rem; flex-shrink: 0;
        }

        /* ─── Activity Feed ─────────────────────────────────── */
        .activity-item {
            display: flex; align-items: flex-start; gap: 0.75rem;
            padding: 0.85rem 1.1rem;
            border-bottom: 1px solid var(--gray-100);
            transition: background 0.14s;
        }

        .activity-item:last-child { border-bottom: none; }
        .activity-item:hover { background: var(--gray-50); }

        .activity-dot {
            width: 32px; height: 32px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.85rem; flex-shrink: 0; margin-top: 0.05rem;
        }

        .ad-green  { background: var(--green-100); color: var(--green-700); }
        .ad-gold   { background: var(--gold-light); color: var(--gold); }
        .ad-blue   { background: #e8f0fe; color: #1a73e8; }
        .ad-red    { background: #fdecea; color: #c0392b; }
        .ad-teal   { background: #e0f7f5; color: #0d8a7e; }
        .ad-purple { background: #f3e8ff; color: #7c3aed; }

        .activity-title { font-size: 0.83rem; font-weight: 600; color: var(--text-main); margin-bottom: 1px; }
        .activity-meta  { font-size: 0.72rem; color: var(--text-muted); }

        /* ─── Order Detail Modal ────────────────────────────── */
        .modal-content { border-radius: var(--radius); border: none; box-shadow: var(--shadow-lg); }

        .modal-header-dark {
            background: var(--green-900); color: #fff;
            border-radius: calc(var(--radius) - 1px) calc(var(--radius) - 1px) 0 0;
            padding: 1rem 1.5rem;
        }

        .modal-header-dark .btn-close { filter: invert(1) brightness(1.5); }
        .modal-header-dark h5 { font-size: 0.95rem; font-weight: 700; color: #fff; margin: 0; }

        .modal-section-label {
            font-size: 0.68rem; font-weight: 700; color: var(--gray-400);
            letter-spacing: 0.1em; text-transform: uppercase;
            margin-bottom: 0.75rem; padding-bottom: 0.4rem;
            border-bottom: 1px solid var(--gray-200);
        }

        .order-detail-hero {
            background: linear-gradient(135deg, var(--green-50) 0%, #e8f5ec 100%);
            border-radius: 10px;
            padding: 1.25rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }

        .order-hero-icon {
            width: 56px; height: 56px; border-radius: 14px;
            background: var(--green-100);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem; color: var(--green-700);
            border: 2px solid var(--green-200); flex-shrink: 0;
        }

        .view-detail-row {
            display: flex; justify-content: space-between;
            padding: 0.5rem 0; border-bottom: 1px solid var(--gray-100); font-size: 0.83rem;
        }

        .view-detail-row:last-child { border-bottom: none; }
        .view-detail-label { color: var(--text-muted); font-weight: 600; font-size: 0.78rem; }
        .view-detail-value { color: var(--green-800); font-weight: 500; text-align: right; }

        /* Order Items Table in Modal */
        .order-items-table {
            width: 100%; border-collapse: collapse; font-size: 0.82rem;
        }

        .order-items-table thead th {
            background: var(--green-50);
            color: var(--green-800);
            font-size: 0.7rem; font-weight: 700;
            letter-spacing: 0.05em; text-transform: uppercase;
            padding: 0.55rem 0.85rem;
            border-bottom: 1px solid var(--green-200);
        }

        .order-items-table tbody td {
            padding: 0.65rem 0.85rem;
            border-bottom: 1px solid var(--gray-100);
            vertical-align: middle;
        }

        .order-items-table tbody tr:last-child td { border-bottom: none; }

        /* Status Update Select */
        .modal-form-input {
            font-size: 0.83rem; border-radius: var(--radius-sm);
            border: 1.5px solid var(--gray-200);
            padding: 0.48rem 0.85rem; color: var(--text-main); width: 100%;
            transition: border-color 0.18s, box-shadow 0.18s;
        }

        .modal-form-input:focus {
            border-color: var(--green-600);
            box-shadow: 0 0 0 3px rgba(31,128,60,0.10); outline: none;
        }

        /* ─── Mobile ────────────────────────────────────────── */
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

    <span class="navbar-page-badge"><i class="bi bi-shop me-1"></i> ARBO Marketplace</span>

    <div class="navbar-right">
        <button class="nav-icon-btn" title="Search"><i class="bi bi-search"></i></button>

        <div class="dropdown">
            <button class="nav-icon-btn" data-bs-toggle="dropdown" aria-label="Notifications">
                <i class="bi bi-bell"></i>
                <span class="nav-notif-dot"></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="min-width:280px;border-radius:12px;margin-top:8px;">
                <li class="px-3 py-2 border-bottom"><span class="fw-bold" style="font-size:.82rem;">Notifications</span></li>
                <li>
                    <a class="dropdown-item py-2" href="#" style="font-size:.82rem;">
                        <i class="bi bi-cart-plus text-success me-2"></i> New order received — #ORD-2024-048
                        <div class="text-muted" style="font-size:.72rem;padding-left:1.4rem;">Just now</div>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item py-2" href="#" style="font-size:.82rem;">
                        <i class="bi bi-cash text-primary me-2"></i> Payment received — #ORD-2024-046
                        <div class="text-muted" style="font-size:.72rem;padding-left:1.4rem;">1 hour ago</div>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item py-2" href="#" style="font-size:.82rem;">
                        <i class="bi bi-x-circle text-danger me-2"></i> Order cancelled — #ORD-2024-041
                        <div class="text-muted" style="font-size:.72rem;padding-left:1.4rem;">2 hours ago</div>
                    </a>
                </li>
                <li class="border-top">
                    <a class="dropdown-item text-center py-2" href="#" style="font-size:.78rem;color:var(--green-700);">View all notifications</a>
                </li>
            </ul>
        </div>

        <div class="navbar-divider d-none d-sm-block"></div>

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
                <span>Order Management</span>
            </div>
            <h1 class="page-header-title">
                <i class="bi bi-cart-check-fill me-2" style="color:var(--gold);font-size:1.3rem;vertical-align:middle;"></i>
                Order Management
            </h1>
            <p class="page-header-sub">Monitor incoming orders, transaction status, and buyer purchase activity within the marketplace.</p>
        </div>
        <div class="d-flex gap-2 flex-wrap align-items-start">
            <button class="btn-green-outline" onclick="window.print()">
                <i class="bi bi-printer"></i> Print Summary
            </button>
            <button class="btn-green-primary">
                <i class="bi bi-download"></i> Export Orders
            </button>
        </div>
    </div>

    <!-- ── Summary Stat Cards ──────────────────────────────── -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-green">
                    <i class="bi bi-receipt-cutoff"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $totalOrders ?? 0 }}</div>
                    <p class="stat-label">Total Orders</p>
                    <div class="stat-sub">All transactions</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-gold">
                    <i class="bi bi-hourglass-split"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $pendingOrders ?? 0 }}</div>
                    <p class="stat-label">Pending Orders</p>
                    <div class="stat-sub">Awaiting processing</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-blue">
                    <i class="bi bi-check2-circle"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $completedOrders ?? 0 }}</div>
                    <p class="stat-label">Completed Orders</p>
                    <div class="stat-sub">Successfully fulfilled</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-red">
                    <i class="bi bi-x-circle-fill"></i>
                </div>
                <div>
                    <div class="stat-value">{{ $cancelledOrders ?? 0 }}</div>
                    <p class="stat-label">Cancelled Orders</p>
                    <div class="stat-sub">Voided transactions</div>
                </div>
            </div>
        </div>
    </div>

    <!-- ── Filter Section ──────────────────────────────────── -->
    <div class="filter-card mb-3">
        <form method="GET" action="{{ url('/arbo/orders') }}">
            <div class="row g-2 align-items-end">
                <div class="col-12 col-md-4">
                    <label class="filter-label">Search Orders</label>
                    <div class="input-group" style="flex-wrap:nowrap;">
                        <span class="input-group-text" style="background:var(--gray-100);border:1.5px solid var(--gray-200);border-right:none;border-radius:var(--radius-sm) 0 0 var(--radius-sm);color:var(--gray-400);">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="filter-input"
                               style="border-radius:0 var(--radius-sm) var(--radius-sm) 0;border-left:none;"
                               placeholder="Order number, buyer name, product..."
                               name="search" value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <label class="filter-label">Order Status</label>
                    <select class="filter-input" name="order_status">
                        <option value="">All Status</option>
                        <option value="pending"    {{ request('order_status')=='pending'    ?'selected':'' }}>Pending</option>
                        <option value="processing" {{ request('order_status')=='processing' ?'selected':'' }}>Processing</option>
                        <option value="shipped"    {{ request('order_status')=='shipped'    ?'selected':'' }}>Shipped</option>
                        <option value="completed"  {{ request('order_status')=='completed'  ?'selected':'' }}>Completed</option>
                        <option value="cancelled"  {{ request('order_status')=='cancelled'  ?'selected':'' }}>Cancelled</option>
                    </select>
                </div>
                <div class="col-6 col-md-2">
                    <label class="filter-label">Payment Status</label>
                    <select class="filter-input" name="payment_status">
                        <option value="">All Payments</option>
                        <option value="pending"  {{ request('payment_status')=='pending'  ?'selected':'' }}>Pending</option>
                        <option value="paid"     {{ request('payment_status')=='paid'     ?'selected':'' }}>Paid</option>
                        <option value="failed"   {{ request('payment_status')=='failed'   ?'selected':'' }}>Failed</option>
                        <option value="refunded" {{ request('payment_status')=='refunded' ?'selected':'' }}>Refunded</option>
                    </select>
                </div>
                <div class="col-6 col-md-2">
                    <label class="filter-label">Date Range</label>
                    <select class="filter-input" name="date_range">
                        <option value="">All Time</option>
                        <option value="today"   {{ request('date_range')=='today'   ?'selected':'' }}>Today</option>
                        <option value="week"    {{ request('date_range')=='week'    ?'selected':'' }}>This Week</option>
                        <option value="month"   {{ request('date_range')=='month'   ?'selected':'' }}>This Month</option>
                        <option value="quarter" {{ request('date_range')=='quarter' ?'selected':'' }}>This Quarter</option>
                    </select>
                </div>
                <div class="col-6 col-md-2 d-flex gap-2">
                    <button type="submit" class="btn-filter w-100">
                        <i class="bi bi-funnel-fill"></i> Filter
                    </button>
                    <a href="{{ url('/arbo/orders') }}" class="btn-reset-filter w-100">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- ── Status Quick-Tabs ────────────────────────────────── -->
    <div class="status-tabs mb-1">
        <button class="status-tab active">
            All Orders <span class="tab-count">{{ $totalOrders ?? 48 }}</span>
        </button>
        <button class="status-tab">
            <i class="bi bi-hourglass-split"></i> Pending <span class="tab-count">{{ $pendingOrders ?? 12 }}</span>
        </button>
        <button class="status-tab">
            <i class="bi bi-arrow-repeat"></i> Processing <span class="tab-count">8</span>
        </button>
        <button class="status-tab">
            <i class="bi bi-truck"></i> Shipped <span class="tab-count">5</span>
        </button>
        <button class="status-tab">
            <i class="bi bi-check2-circle"></i> Completed <span class="tab-count">{{ $completedOrders ?? 20 }}</span>
        </button>
        <button class="status-tab">
            <i class="bi bi-x-circle"></i> Cancelled <span class="tab-count">{{ $cancelledOrders ?? 3 }}</span>
        </button>
    </div>

    <!-- ── Orders Table ─────────────────────────────────────── -->
    <div class="table-card mb-4">
        <div class="table-card-header">
            <h6 class="table-card-title">
                <i class="bi bi-table"></i> Order Records
            </h6>
            <span class="table-record-pill">Showing 1–10 of {{ $totalOrders ?? 48 }} orders</span>
        </div>

        <div class="table-responsive">
            <table class="arbo-table">
                <thead>
                    <tr>
                        <th>Order No.</th>
                        <th>Buyer</th>
                        <th>Products</th>
                        <th>Total Amount</th>
                        <th class="text-center">Order Status</th>
                        <th class="text-center">Payment</th>
                        <th>Order Date</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Replace with @foreach($orders as $order) in production --}}
                    @php
                        $sampleOrders = [
                            [
                                'no'      => 'ORD-2024-048',
                                'buyer'   => 'Ana Reyes',
                                'init'    => 'AR',
                                'products'=> ['White Rice (10kg)', 'Corn (5kg)'],
                                'amount'  => '₱ 660.00',
                                'o_stat'  => 'pending',
                                'p_stat'  => 'pending',
                                'date'    => 'Jun 15, 2024',
                                'time'    => '10:22 AM',
                            ],
                            [
                                'no'      => 'ORD-2024-047',
                                'buyer'   => 'Felix Soriano',
                                'init'    => 'FS',
                                'products'=> ['Native Chicken (2 heads)'],
                                'amount'  => '₱ 760.00',
                                'o_stat'  => 'processing',
                                'p_stat'  => 'paid',
                                'date'    => 'Jun 15, 2024',
                                'time'    => '9:04 AM',
                            ],
                            [
                                'no'      => 'ORD-2024-046',
                                'buyer'   => 'Divina Magno',
                                'init'    => 'DM',
                                'products'=> ['Vegetables Bundle', 'Coconut Oil (500ml)', '+1 more'],
                                'amount'  => '₱ 1,250.00',
                                'o_stat'  => 'shipped',
                                'p_stat'  => 'paid',
                                'date'    => 'Jun 14, 2024',
                                'time'    => '3:45 PM',
                            ],
                            [
                                'no'      => 'ORD-2024-045',
                                'buyer'   => 'Marites Lim',
                                'init'    => 'ML',
                                'products'=> ['White Rice (25kg)'],
                                'amount'  => '₱ 1,300.00',
                                'o_stat'  => 'completed',
                                'p_stat'  => 'paid',
                                'date'    => 'Jun 14, 2024',
                                'time'    => '1:10 PM',
                            ],
                            [
                                'no'      => 'ORD-2024-044',
                                'buyer'   => 'Marco Bautista',
                                'init'    => 'MB',
                                'products'=> ['Bangus Fry (500 pcs)'],
                                'amount'  => '₱ 4,000.00',
                                'o_stat'  => 'completed',
                                'p_stat'  => 'paid',
                                'date'    => 'Jun 13, 2024',
                                'time'    => '11:30 AM',
                            ],
                            [
                                'no'      => 'ORD-2024-043',
                                'buyer'   => 'Ana Reyes',
                                'init'    => 'AR',
                                'products'=> ['Fresh Coconut (10 pcs)', 'Banana (5kg)'],
                                'amount'  => '₱ 475.00',
                                'o_stat'  => 'pending',
                                'p_stat'  => 'pending',
                                'date'    => 'Jun 13, 2024',
                                'time'    => '8:55 AM',
                            ],
                            [
                                'no'      => 'ORD-2024-042',
                                'buyer'   => 'Ronald Cruz',
                                'init'    => 'RC',
                                'products'=> ['Abaca Fiber (20kg)'],
                                'amount'  => '₱ 1,900.00',
                                'o_stat'  => 'cancelled',
                                'p_stat'  => 'refunded',
                                'date'    => 'Jun 12, 2024',
                                'time'    => '2:20 PM',
                            ],
                            [
                                'no'      => 'ORD-2024-041',
                                'buyer'   => 'Bernard Tan',
                                'init'    => 'BT',
                                'products'=> ['Native Pork (5kg)', 'Chicken (3 heads)', '+1 more'],
                                'amount'  => '₱ 2,540.00',
                                'o_stat'  => 'completed',
                                'p_stat'  => 'paid',
                                'date'    => 'Jun 12, 2024',
                                'time'    => '10:15 AM',
                            ],
                            [
                                'no'      => 'ORD-2024-040',
                                'buyer'   => 'Carla Domingo',
                                'init'    => 'CD',
                                'products'=> ['Brown Rice (10kg)'],
                                'amount'  => '₱ 650.00',
                                'o_stat'  => 'processing',
                                'p_stat'  => 'paid',
                                'date'    => 'Jun 11, 2024',
                                'time'    => '4:30 PM',
                            ],
                            [
                                'no'      => 'ORD-2024-039',
                                'buyer'   => 'Felix Soriano',
                                'init'    => 'FS',
                                'products'=> ['String Beans (3kg)', 'Coconut (20 pcs)'],
                                'amount'  => '₱ 835.00',
                                'o_stat'  => 'completed',
                                'p_stat'  => 'paid',
                                'date'    => 'Jun 11, 2024',
                                'time'    => '9:40 AM',
                            ],
                        ];

                        $orderStatusBadge   = ['pending'=>'ord-pending','processing'=>'ord-processing','completed'=>'ord-completed','cancelled'=>'ord-cancelled','shipped'=>'ord-shipped'];
                        $orderStatusLabel   = ['pending'=>'Pending','processing'=>'Processing','completed'=>'Completed','cancelled'=>'Cancelled','shipped'=>'Shipped'];
                        $paymentStatusBadge = ['pending'=>'pay-pending','paid'=>'pay-paid','failed'=>'pay-failed','refunded'=>'pay-refunded'];
                        $paymentStatusLabel = ['pending'=>'Pending','paid'=>'Paid','failed'=>'Failed','refunded'=>'Refunded'];
                    @endphp

                    @foreach($sampleOrders as $order)
                    <tr>
                        <td>
                            <span class="order-no">{{ $order['no'] }}</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="buyer-avatar-sm">{{ $order['init'] }}</div>
                                <div>
                                    <div style="font-size:.83rem;font-weight:600;color:var(--green-800);">{{ $order['buyer'] }}</div>
                                    <div style="font-size:.7rem;color:var(--text-muted);">Marketplace Buyer</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="d-flex flex-wrap gap-1">
                                @foreach(array_slice($order['products'], 0, 2) as $prod)
                                    <span class="product-chip {{ strpos($prod, '+') !== false ? 'product-chip-more' : '' }}">
                                        {{ $prod }}
                                    </span>
                                @endforeach
                                @if(count($order['products']) > 2)
                                    <span class="product-chip product-chip-more">+{{ count($order['products']) - 2 }} more</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <span class="amount-val">{{ $order['amount'] }}</span>
                        </td>
                        <td class="text-center">
                            <span class="status-badge {{ $orderStatusBadge[$order['o_stat']] ?? 'ord-pending' }}">
                                <span class="status-dot"></span>
                                {{ $orderStatusLabel[$order['o_stat']] ?? ucfirst($order['o_stat']) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <span class="status-badge {{ $paymentStatusBadge[$order['p_stat']] ?? 'pay-pending' }}">
                                <span class="status-dot"></span>
                                {{ $paymentStatusLabel[$order['p_stat']] ?? ucfirst($order['p_stat']) }}
                            </span>
                        </td>
                        <td>
                            <div style="font-size:.82rem;font-weight:500;">{{ $order['date'] }}</div>
                            <div style="font-size:.7rem;color:var(--text-muted);">{{ $order['time'] }}</div>
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-1 justify-content-center flex-wrap">
                                <button class="tbl-action-btn btn-view-tbl"
                                        data-bs-toggle="modal"
                                        data-bs-target="#viewOrderModal"
                                        title="View Order Details">
                                    <i class="bi bi-eye-fill"></i> View
                                </button>
                                <button class="tbl-action-btn btn-print-tbl" title="Print Order">
                                    <i class="bi bi-printer-fill"></i> Print
                                </button>
                                <button class="tbl-action-btn btn-upd-tbl"
                                        data-bs-toggle="modal"
                                        data-bs-target="#updateStatusModal"
                                        title="Update Status">
                                    <i class="bi bi-arrow-repeat"></i> Update
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="pagination-bar">
            <div>Showing <strong>1–10</strong> of <strong>{{ $totalOrders ?? 48 }}</strong> orders</div>
            <nav aria-label="Orders pagination">
                <ul class="pagination mb-0 custom-pagination">
                    <li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
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
                    <h6><i class="bi bi-lightning-charge-fill"></i> Order Management</h6>
                    <p>Shortcuts for common order tasks</p>
                </div>
                <div>
                    <button class="qa-row">
                        <div class="qa-icon-wrap" style="background:var(--gold-light);color:var(--gold);">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                        <div>
                            <div style="font-weight:600;font-size:.83rem;">View Pending Orders</div>
                            <div style="font-size:.72rem;color:var(--text-muted);">{{ $pendingOrders ?? 12 }} orders awaiting processing</div>
                        </div>
                        <i class="bi bi-chevron-right ms-auto" style="font-size:.72rem;color:var(--gray-400);"></i>
                    </button>
                    <button class="qa-row">
                        <div class="qa-icon-wrap" style="background:var(--green-100);color:var(--green-700);">
                            <i class="bi bi-check2-circle"></i>
                        </div>
                        <div>
                            <div style="font-weight:600;font-size:.83rem;">View Completed Orders</div>
                            <div style="font-size:.72rem;color:var(--text-muted);">{{ $completedOrders ?? 20 }} orders fulfilled</div>
                        </div>
                        <i class="bi bi-chevron-right ms-auto" style="font-size:.72rem;color:var(--gray-400);"></i>
                    </button>
                    <button class="qa-row">
                        <div class="qa-icon-wrap" style="background:#e8f0fe;color:#1a73e8;">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                        <div>
                            <div style="font-weight:600;font-size:.83rem;">Monitor Buyer Transactions</div>
                            <div style="font-size:.72rem;color:var(--text-muted);">Buyer activity and purchase trends</div>
                        </div>
                        <i class="bi bi-chevron-right ms-auto" style="font-size:.72rem;color:var(--gray-400);"></i>
                    </button>
                    <button class="qa-row" onclick="window.print()">
                        <div class="qa-icon-wrap" style="background:var(--gray-100);color:var(--gray-600);">
                            <i class="bi bi-printer-fill"></i>
                        </div>
                        <div>
                            <div style="font-weight:600;font-size:.83rem;">Print Daily Summary</div>
                            <div style="font-size:.72rem;color:var(--text-muted);">Print today's order report</div>
                        </div>
                        <i class="bi bi-chevron-right ms-auto" style="font-size:.72rem;color:var(--gray-400);"></i>
                    </button>
                    <button class="qa-row">
                        <div class="qa-icon-wrap" style="background:#f3e8ff;color:#7c3aed;">
                            <i class="bi bi-download"></i>
                        </div>
                        <div>
                            <div style="font-weight:600;font-size:.83rem;">Export Order List</div>
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
                Recent Order Activity
            </div>
            <div class="side-card">
                <div class="side-card-header">
                    <h6><i class="bi bi-clock-history"></i> Activity Log</h6>
                    <p>Latest order events in your ARBO marketplace</p>
                </div>
                <div>
                    <div class="activity-item">
                        <div class="activity-dot ad-gold"><i class="bi bi-cart-plus-fill"></i></div>
                        <div style="flex:1;">
                            <div class="activity-title">New order placed — Ana Reyes (#ORD-2024-048)</div>
                            <div class="activity-meta"><i class="bi bi-clock me-1"></i>Just now &bull; White Rice + Corn &bull; ₱ 660.00</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot ad-green"><i class="bi bi-cash-coin"></i></div>
                        <div style="flex:1;">
                            <div class="activity-title">Payment received — Divina Magno (#ORD-2024-046)</div>
                            <div class="activity-meta"><i class="bi bi-clock me-1"></i>1 hour ago &bull; ₱ 1,250.00 confirmed</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot ad-teal"><i class="bi bi-truck"></i></div>
                        <div style="flex:1;">
                            <div class="activity-title">Order shipped — Divina Magno (#ORD-2024-046)</div>
                            <div class="activity-meta"><i class="bi bi-clock me-1"></i>2 hours ago &bull; Status: Processing → Shipped</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot ad-blue"><i class="bi bi-check2-circle"></i></div>
                        <div style="flex:1;">
                            <div class="activity-title">Order completed — Marites Lim (#ORD-2024-045)</div>
                            <div class="activity-meta"><i class="bi bi-clock me-1"></i>Yesterday, 4:30 PM &bull; White Rice 25 kg &bull; ₱ 1,300.00</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot ad-red"><i class="bi bi-x-circle-fill"></i></div>
                        <div style="flex:1;">
                            <div class="activity-title">Order cancelled — Ronald Cruz (#ORD-2024-042)</div>
                            <div class="activity-meta"><i class="bi bi-clock me-1"></i>Yesterday, 2:20 PM &bull; Reason: Buyer requested cancellation</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot ad-purple"><i class="bi bi-arrow-return-left"></i></div>
                        <div style="flex:1;">
                            <div class="activity-title">Refund processed — Ronald Cruz (#ORD-2024-042)</div>
                            <div class="activity-meta"><i class="bi bi-clock me-1"></i>Yesterday, 3:00 PM &bull; ₱ 1,900.00 refunded</div>
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

<!-- ── View Order Modal ───────────────────────────────────── -->
<div class="modal fade" id="viewOrderModal" tabindex="-1" aria-labelledby="viewOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header modal-header-dark">
                <h5 class="modal-title" id="viewOrderModalLabel">
                    <i class="bi bi-receipt-cutoff me-2"></i>Order Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">

                <!-- Order Hero -->
                <div class="order-detail-hero">
                    <div class="order-hero-icon">
                        <i class="bi bi-cart-check-fill"></i>
                    </div>
                    <div style="flex:1;">
                        <div style="font-size:1.1rem;font-weight:700;color:var(--green-900);">Order #ORD-2024-047</div>
                        <div style="font-size:.78rem;color:var(--text-muted);">Felix Soriano &bull; Marketplace Buyer</div>
                        <div class="mt-2 d-flex gap-2 flex-wrap">
                            <span class="status-badge ord-processing"><span class="status-dot"></span>Processing</span>
                            <span class="status-badge pay-paid"><span class="status-dot"></span>Paid</span>
                        </div>
                    </div>
                    <div class="text-end">
                        <div style="font-size:.7rem;color:var(--text-muted);font-weight:600;text-transform:uppercase;letter-spacing:.5px;">Order Total</div>
                        <div style="font-size:1.25rem;font-weight:700;color:var(--green-800);">₱ 760.00</div>
                        <div style="font-size:.7rem;color:var(--text-muted);margin-top:.2rem;">Jun 15, 2024 · 9:04 AM</div>
                    </div>
                </div>

                <div class="row g-3">
                    <!-- Buyer Info -->
                    <div class="col-md-6">
                        <div class="modal-section-label">Buyer Information</div>
                        <div class="view-detail-row">
                            <span class="view-detail-label">Full Name</span>
                            <span class="view-detail-value">Felix Soriano</span>
                        </div>
                        <div class="view-detail-row">
                            <span class="view-detail-label">Contact Number</span>
                            <span class="view-detail-value">09168887890</span>
                        </div>
                        <div class="view-detail-row">
                            <span class="view-detail-label">Delivery Address</span>
                            <span class="view-detail-value">Libmanan, Camarines Sur</span>
                        </div>
                        <div class="view-detail-row">
                            <span class="view-detail-label">Username</span>
                            <span class="view-detail-value" style="font-family:'Courier New',monospace;">@fsoriano</span>
                        </div>
                    </div>

                    <!-- Order Info -->
                    <div class="col-md-6">
                        <div class="modal-section-label">Order Information</div>
                        <div class="view-detail-row">
                            <span class="view-detail-label">Order Number</span>
                            <span class="view-detail-value" style="font-family:'Courier New',monospace;">ORD-2024-047</span>
                        </div>
                        <div class="view-detail-row">
                            <span class="view-detail-label">Order Date</span>
                            <span class="view-detail-value">Jun 15, 2024 · 9:04 AM</span>
                        </div>
                        <div class="view-detail-row">
                            <span class="view-detail-label">Payment Method</span>
                            <span class="view-detail-value">GCash</span>
                        </div>
                        <div class="view-detail-row">
                            <span class="view-detail-label">Reference No.</span>
                            <span class="view-detail-value" style="font-family:'Courier New',monospace;">GC-20240615-9872</span>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="col-12">
                        <div class="modal-section-label">Order Items</div>
                        <div style="border:1px solid var(--gray-200);border-radius:var(--radius-sm);overflow:hidden;">
                            <table class="order-items-table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Seller</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-center">Unit Price</th>
                                        <th class="text-right" style="text-align:right;">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div style="font-weight:600;font-size:.83rem;color:var(--green-800);">Native Chicken (Live)</div>
                                            <div style="font-size:.7rem;color:var(--text-muted);">SKU: LST-001</div>
                                        </td>
                                        <td style="font-size:.8rem;">Luz Villanueva</td>
                                        <td class="text-center" style="font-size:.82rem;font-weight:600;">2 heads</td>
                                        <td class="text-center" style="font-size:.82rem;font-weight:600;">₱380.00</td>
                                        <td style="text-align:right;font-weight:700;color:var(--green-800);font-size:.88rem;">₱760.00</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" style="text-align:right;padding:.65rem .85rem;font-size:.78rem;color:var(--text-muted);font-weight:600;border-top:1px solid var(--gray-200);">
                                            Delivery Fee
                                        </td>
                                        <td style="text-align:right;padding:.65rem .85rem;font-size:.82rem;border-top:1px solid var(--gray-200);">₱0.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="text-align:right;padding:.65rem .85rem;font-size:.88rem;font-weight:700;color:var(--green-900);background:var(--green-50);border-top:1px solid var(--green-200);">
                                            Order Total
                                        </td>
                                        <td style="text-align:right;padding:.65rem .85rem;font-size:1rem;font-weight:700;color:var(--green-800);background:var(--green-50);border-top:1px solid var(--green-200);">
                                            ₱760.00
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border-top:1px solid var(--gray-200);padding:.9rem 1.5rem;">
                <button class="btn-reset-filter" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Close
                </button>
                <button class="btn-reset-filter" onclick="window.print()">
                    <i class="bi bi-printer"></i> Print
                </button>
                <button class="btn-green-primary"
                        data-bs-toggle="modal"
                        data-bs-target="#updateStatusModal"
                        data-bs-dismiss="modal">
                    <i class="bi bi-arrow-repeat"></i> Update Status
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ── Update Status Modal ────────────────────────────────── -->
<div class="modal fade" id="updateStatusModal" tabindex="-1" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width:480px;">
        <div class="modal-content">
            <div class="modal-header modal-header-dark">
                <h5 class="modal-title" id="updateStatusModalLabel">
                    <i class="bi bi-arrow-repeat me-2"></i>Update Order Status
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="#">
                    @csrf
                    @method('PUT')

                    <!-- Order reference -->
                    <div style="background:var(--green-50);border:1px solid var(--green-200);border-radius:var(--radius-sm);padding:.85rem 1rem;margin-bottom:1.25rem;">
                        <div style="font-size:.7rem;color:var(--text-muted);font-weight:600;text-transform:uppercase;letter-spacing:.5px;margin-bottom:.2rem;">Updating Order</div>
                        <div style="font-family:'Courier New',monospace;font-size:.9rem;font-weight:700;color:var(--green-800);">ORD-2024-047</div>
                        <div style="font-size:.78rem;color:var(--text-muted);margin-top:.15rem;">Felix Soriano &bull; ₱ 760.00</div>
                    </div>

                    <div class="modal-section-label">Order Status</div>
                    <div class="mb-3">
                        <label style="font-size:.78rem;font-weight:700;color:var(--green-800);display:block;margin-bottom:.35rem;">New Order Status <span class="text-danger">*</span></label>
                        <select class="modal-form-input" name="order_status" required>
                            <option value="">Select new status</option>
                            <option value="pending">Pending</option>
                            <option value="processing" selected>Processing</option>
                            <option value="shipped">Shipped</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    <div class="modal-section-label">Payment Status</div>
                    <div class="mb-3">
                        <label style="font-size:.78rem;font-weight:700;color:var(--green-800);display:block;margin-bottom:.35rem;">Payment Status</label>
                        <select class="modal-form-input" name="payment_status">
                            <option value="pending">Pending</option>
                            <option value="paid" selected>Paid</option>
                            <option value="failed">Failed</option>
                            <option value="refunded">Refunded</option>
                        </select>
                    </div>

                    <div>
                        <label style="font-size:.78rem;font-weight:700;color:var(--green-800);display:block;margin-bottom:.35rem;">Remarks / Notes</label>
                        <textarea class="modal-form-input" name="remarks" rows="3" placeholder="Optional notes for this status update..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="border-top:1px solid var(--gray-200);padding:.9rem 1.5rem;">
                <button class="btn-reset-filter" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Cancel
                </button>
                <button class="btn-green-primary">
                    <i class="bi bi-check-circle-fill"></i> Save Status
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ── Mobile Sidebar ── */
    const toggle  = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('mainSidebar');
    const overlay = document.getElementById('sidebarOverlay');

    function openSidebar()  { sidebar.classList.add('show'); overlay.classList.add('show'); document.body.style.overflow = 'hidden'; }
    function closeSidebar() { sidebar.classList.remove('show'); overlay.classList.remove('show'); document.body.style.overflow = ''; }

    if (toggle)  toggle.addEventListener('click', openSidebar);
    if (overlay) overlay.addEventListener('click', closeSidebar);

    /* ── Status Tabs ── */
    document.querySelectorAll('.status-tab').forEach(function (tab) {
        tab.addEventListener('click', function () {
            document.querySelectorAll('.status-tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });
});
</script>
</body>
</html>