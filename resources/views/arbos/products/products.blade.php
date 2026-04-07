<!doctype html>
<html lang="en" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Management — E-Agraryo Merkado</title>
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
        .stat-icon-teal   { background: #e0f7f5; color: #0d8a7e; }
        .stat-icon-red    { background: #fdecea; color: #c0392b; }
        .stat-icon-gold   { background: var(--gold-light); color: var(--gold); }

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

        /* ─── Filter / Toolbar ──────────────────────────────── */
        .toolbar-card {
            background: #fff;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--gray-200);
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
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

        /* ─── View Toggle ───────────────────────────────────── */
        .view-toggle {
            display: flex;
            background: var(--gray-100);
            border-radius: 8px;
            padding: 3px;
            gap: 2px;
        }

        .view-toggle-btn {
            border: none; background: transparent;
            padding: 5px 10px;
            border-radius: 6px;
            color: var(--gray-400);
            cursor: pointer;
            font-size: 0.95rem;
            transition: all 0.18s;
        }

        .view-toggle-btn.active {
            background: #fff;
            color: var(--green-700);
            box-shadow: 0 1px 4px rgba(0,0,0,0.1);
        }

        .view-toggle-btn:hover:not(.active) { color: var(--green-600); }

        /* ─── Category Pills ────────────────────────────────── */
        .cat-pills {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-bottom: 1.25rem;
        }

        .cat-pill {
            border: 1.5px solid var(--gray-200);
            background: #fff;
            border-radius: 30px;
            padding: 4px 14px;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--gray-600);
            cursor: pointer;
            transition: all 0.18s;
            white-space: nowrap;
        }

        .cat-pill:hover { border-color: var(--green-600); color: var(--green-700); background: var(--green-50); }

        .cat-pill.active {
            background: var(--green-800);
            border-color: var(--green-800);
            color: #fff;
        }

        /* ─── PRODUCT CARD GRID ─────────────────────────────── */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(210px, 1fr));
            gap: 1rem;
        }

        /* ─── Product Card ──────────────────────────────────── */
        .product-card {
            background: #fff;
            border-radius: var(--radius);
            border: 1px solid var(--gray-200);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            transition: box-shadow 0.22s, transform 0.22s;
            cursor: pointer;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-4px);
        }

        /* Image Area */
        .product-card-img {
            width: 100%;
            aspect-ratio: 1 / 1;
            background: var(--gray-100);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .product-card-img .product-img-icon {
            font-size: 3.5rem;
            opacity: 0.18;
        }

        .product-card-img img {
            width: 100%; height: 100%;
            object-fit: cover;
        }

        /* Color-coded image bg per category */
        .img-bg-grains    { background: linear-gradient(135deg, #fdf5e0 0%, #faeab5 100%); }
        .img-bg-veggies   { background: linear-gradient(135deg, #e8f5ec 0%, #c8e6c9 100%); }
        .img-bg-fruits    { background: linear-gradient(135deg, #fce4ec 0%, #f8bbd0 100%); }
        .img-bg-livestock { background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%); }
        .img-bg-fiber     { background: linear-gradient(135deg, #e0f7f5 0%, #b2dfdb 100%); }
        .img-bg-processed { background: linear-gradient(135deg, #e8f0fe 0%, #bbdefb 100%); }

        .product-card-img .product-img-icon {
            font-size: 4rem;
        }

        /* Status ribbon */
        .card-ribbon {
            position: absolute;
            top: 10px; left: 0;
            font-size: 0.65rem;
            font-weight: 700;
            padding: 3px 10px 3px 8px;
            border-radius: 0 20px 20px 0;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            line-height: 1;
        }

        .ribbon-active   { background: var(--green-600); color: #fff; }
        .ribbon-pending  { background: var(--gold); color: #fff; }
        .ribbon-inactive { background: #c0392b; color: #fff; }
        .ribbon-soldout  { background: #7c3aed; color: #fff; }

        /* Seller badge top-right */
        .card-seller-badge {
            position: absolute;
            top: 10px; right: 10px;
            background: rgba(255,255,255,0.92);
            border: 1px solid var(--gray-200);
            border-radius: 20px;
            padding: 2px 8px;
            font-size: 0.62rem;
            font-weight: 700;
            color: var(--green-800);
            backdrop-filter: blur(4px);
            white-space: nowrap;
            max-width: 100px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Wishlist / action hover overlay */
        .card-overlay {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            background: linear-gradient(to top, rgba(13,59,30,0.85) 0%, transparent 100%);
            display: flex;
            align-items: flex-end;
            justify-content: center;
            gap: 0.4rem;
            padding: 0.75rem 0.6rem;
            opacity: 0;
            transition: opacity 0.22s;
        }

        .product-card:hover .card-overlay { opacity: 1; }

        .overlay-btn {
            border: none;
            border-radius: 8px;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 0.35rem 0.7rem;
            cursor: pointer;
            display: inline-flex; align-items: center; gap: 0.25rem;
            transition: all 0.16s;
            white-space: nowrap;
        }

        .ov-view  { background: rgba(255,255,255,0.95); color: var(--green-800); }
        .ov-view:hover  { background: #fff; }
        .ov-edit  { background: var(--green-600); color: #fff; }
        .ov-edit:hover  { background: var(--green-700); }

        /* Body */
        .product-card-body {
            padding: 0.85rem 0.9rem 0.7rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-card-name {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-main);
            line-height: 1.35;
            margin-bottom: 0.25rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-card-sku {
            font-size: 0.68rem;
            color: var(--gray-400);
            font-family: 'Courier New', monospace;
            margin-bottom: 0.55rem;
        }

        .product-card-price {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--green-800);
            line-height: 1;
            margin-bottom: 0.25rem;
        }

        .product-card-price span {
            font-size: 0.72rem;
            font-weight: 400;
            color: var(--text-muted);
        }

        /* Category tag */
        .product-card-cat {
            display: inline-flex; align-items: center; gap: 3px;
            font-size: 0.68rem; font-weight: 700;
            padding: 2px 8px; border-radius: 20px;
            margin-bottom: 0.6rem;
            width: fit-content;
        }

        .cat-grains    { background: #fdf5e0; color: #a07000; }
        .cat-veggies   { background: var(--green-100); color: var(--green-700); }
        .cat-fruits    { background: #fdecea; color: #b03060; }
        .cat-livestock { background: #fff3e0; color: #e07b2a; }
        .cat-fiber     { background: #e0f7f5; color: #0d8a7e; }
        .cat-processed { background: #e8f0fe; color: #1a73e8; }

        /* Footer: stock + quick actions */
        .product-card-footer {
            border-top: 1px solid var(--gray-100);
            padding: 0.6rem 0.9rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.5rem;
        }

        .stock-mini {
            display: flex;
            flex-direction: column;
            gap: 2px;
            flex: 1;
        }

        .stock-mini-bar {
            height: 4px;
            background: var(--gray-200);
            border-radius: 4px;
            overflow: hidden;
        }

        .stock-mini-fill { height: 100%; border-radius: 4px; }
        .stock-high .stock-mini-fill { background: var(--green-600); }
        .stock-med  .stock-mini-fill { background: var(--gold); }
        .stock-low  .stock-mini-fill { background: #dc3545; }
        .stock-none .stock-mini-fill { background: #7c3aed; }

        .stock-mini-label {
            font-size: 0.67rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .card-arch-btn {
            border: 1px solid var(--gray-200);
            background: transparent;
            border-radius: 6px;
            padding: 3px 7px;
            font-size: 0.68rem;
            font-weight: 600;
            color: var(--gray-400);
            cursor: pointer;
            transition: all 0.16s;
            white-space: nowrap;
            display: flex; align-items: center; gap: 3px;
        }

        .card-arch-btn:hover { border-color: #c0392b; color: #c0392b; background: #fdecea; }
        .card-activ-btn:hover { border-color: var(--green-600); color: var(--green-700); background: var(--green-100); }

        /* Sold-out overlay on card image */
        .soldout-overlay {
            position: absolute; inset: 0;
            background: rgba(255,255,255,0.55);
            display: flex; align-items: center; justify-content: center;
        }

        .soldout-stamp {
            border: 3px solid #7c3aed;
            color: #7c3aed;
            font-size: 0.72rem;
            font-weight: 900;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 6px;
            transform: rotate(-15deg);
            background: rgba(255,255,255,0.9);
        }

        /* ─── Pagination Bar ────────────────────────────────── */
        .pagination-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem 0 0;
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
        }

        .side-card-header { background: var(--green-900); padding: 0.85rem 1.25rem; }
        .side-card-header h6 { font-size: 0.88rem; font-weight: 700; color: #fff; margin: 0; display: flex; align-items: center; gap: 0.4rem; }
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
            font-size: 0.85rem; flex-shrink: 0;
        }

        .ad-green  { background: var(--green-100); color: var(--green-700); }
        .ad-gold   { background: var(--gold-light); color: var(--gold); }
        .ad-blue   { background: #e8f0fe; color: #1a73e8; }
        .ad-red    { background: #fdecea; color: #c0392b; }
        .ad-teal   { background: #e0f7f5; color: #0d8a7e; }
        .ad-purple { background: #f3e8ff; color: #7c3aed; }

        .activity-title { font-size: 0.83rem; font-weight: 600; color: var(--text-main); margin-bottom: 1px; }
        .activity-meta  { font-size: 0.72rem; color: var(--text-muted); }

        /* ─── Modals ────────────────────────────────────────── */
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

        .modal-form-label {
            font-size: 0.78rem; font-weight: 700; color: var(--green-800);
            margin-bottom: 0.3rem; display: block;
        }

        .modal-form-input {
            font-size: 0.83rem; border-radius: var(--radius-sm);
            border: 1.5px solid var(--gray-200);
            padding: 0.48rem 0.85rem; color: var(--text-main); width: 100%;
            transition: border-color 0.18s, box-shadow 0.18s;
        }

        .modal-form-input:focus {
            border-color: var(--green-600);
            box-shadow: 0 0 0 3px rgba(31,128,60,0.10);
            outline: none;
        }

        /* View modal hero */
        .product-view-hero {
            background: linear-gradient(135deg, var(--green-50) 0%, #e8f5ec 100%);
            border-radius: 10px; padding: 1.25rem;
            display: flex; align-items: center; gap: 1rem; margin-bottom: 1.25rem;
        }

        .product-hero-icon {
            width: 60px; height: 60px; border-radius: 14px;
            background: var(--green-100);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.65rem; color: var(--green-700);
            border: 2px solid var(--green-200); flex-shrink: 0;
        }

        .view-detail-row {
            display: flex; justify-content: space-between;
            padding: 0.5rem 0; border-bottom: 1px solid var(--gray-100); font-size: 0.83rem;
        }

        .view-detail-row:last-child { border-bottom: none; }
        .view-detail-label { color: var(--text-muted); font-weight: 600; font-size: 0.78rem; }
        .view-detail-value { color: var(--green-800); font-weight: 500; text-align: right; }

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
            .products-grid { grid-template-columns: repeat(2, 1fr); }
        }

        @media (max-width: 575px) {
            .products-grid { grid-template-columns: repeat(2, 1fr); gap: 0.6rem; }
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
                        <i class="bi bi-exclamation-triangle text-warning me-2"></i> Low stock: Organic Vegetables
                        <div class="text-muted" style="font-size:.72rem;padding-left:1.4rem;">1 hour ago</div>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item py-2" href="#" style="font-size:.82rem;">
                        <i class="bi bi-box-seam text-success me-2"></i> New product listed by Juan dela Cruz
                        <div class="text-muted" style="font-size:.72rem;padding-left:1.4rem;">2 hours ago</div>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item py-2" href="#" style="font-size:.82rem;">
                        <i class="bi bi-clock text-primary me-2"></i> 3 products pending approval
                        <div class="text-muted" style="font-size:.72rem;padding-left:1.4rem;">Yesterday</div>
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
                <span>Product Management</span>
            </div>
            <h1 class="page-header-title">
                <i class="bi bi-box-seam-fill me-2" style="color:var(--gold);font-size:1.3rem;vertical-align:middle;"></i>
                Product Management
            </h1>
            <p class="page-header-sub">Manage marketplace product listings, stock, and pricing under this ARBO organization.</p>
        </div>
        <div class="d-flex gap-2 flex-wrap align-items-start">
            <button class="btn-green-outline">
                <i class="bi bi-download"></i> Export List
            </button>
            <button class="btn-green-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                <i class="bi bi-plus-circle-fill"></i> Add Product
            </button>
        </div>
    </div>

    <!-- ── Summary Stat Cards ──────────────────────────────── -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-green"><i class="bi bi-box-seam-fill"></i></div>
                <div>
                    <div class="stat-value">{{ $totalProducts ?? 0 }}</div>
                    <p class="stat-label">Total Products</p>
                    <div class="stat-sub">All listed items</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-teal"><i class="bi bi-check-circle-fill"></i></div>
                <div>
                    <div class="stat-value">{{ $activeProducts ?? 0 }}</div>
                    <p class="stat-label">Active Products</p>
                    <div class="stat-sub">Visible to buyers</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-red"><i class="bi bi-exclamation-triangle-fill"></i></div>
                <div>
                    <div class="stat-value">{{ $outOfStockProducts ?? 0 }}</div>
                    <p class="stat-label">Out of Stock</p>
                    <div class="stat-sub">Need restocking</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-icon-wrap stat-icon-gold"><i class="bi bi-clock-history"></i></div>
                <div>
                    <div class="stat-value">{{ $pendingProducts ?? 0 }}</div>
                    <p class="stat-label">Pending Review</p>
                    <div class="stat-sub">Awaiting approval</div>
                </div>
            </div>
        </div>
    </div>

    <!-- ── Filter Toolbar ──────────────────────────────────── -->
    <div class="toolbar-card">
        <form method="GET" action="{{ url('/arbo/products') }}">
            <div class="row g-2 align-items-end">
                <div class="col-12 col-md-4">
                    <label class="filter-label">Search Products</label>
                    <div class="input-group" style="flex-wrap:nowrap;">
                        <span class="input-group-text" style="background:var(--gray-100);border:1.5px solid var(--gray-200);border-right:none;border-radius:var(--radius-sm) 0 0 var(--radius-sm);color:var(--gray-400);">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="filter-input"
                               style="border-radius:0 var(--radius-sm) var(--radius-sm) 0;border-left:none;"
                               placeholder="Product name, SKU, seller..."
                               name="search" value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <label class="filter-label">Category</label>
                    <select class="filter-input" name="category">
                        <option value="">All Categories</option>
                        <option value="grains"    {{ request('category')=='grains'    ?'selected':'' }}>Grains / Rice</option>
                        <option value="veggies"   {{ request('category')=='veggies'   ?'selected':'' }}>Vegetables</option>
                        <option value="fruits"    {{ request('category')=='fruits'    ?'selected':'' }}>Fruits</option>
                        <option value="livestock" {{ request('category')=='livestock' ?'selected':'' }}>Livestock</option>
                        <option value="fiber"     {{ request('category')=='fiber'     ?'selected':'' }}>Fiber Crops</option>
                        <option value="processed" {{ request('category')=='processed' ?'selected':'' }}>Processed Goods</option>
                    </select>
                </div>
                <div class="col-6 col-md-2">
                    <label class="filter-label">Status</label>
                    <select class="filter-input" name="status">
                        <option value="">All Status</option>
                        <option value="active"   {{ request('status')=='active'   ?'selected':'' }}>Active</option>
                        <option value="pending"  {{ request('status')=='pending'  ?'selected':'' }}>Pending</option>
                        <option value="soldout"  {{ request('status')=='soldout'  ?'selected':'' }}>Out of Stock</option>
                        <option value="inactive" {{ request('status')=='inactive' ?'selected':'' }}>Inactive</option>
                    </select>
                </div>
                <div class="col-6 col-md-2">
                    <label class="filter-label">Seller</label>
                    <select class="filter-input" name="seller">
                        <option value="">All Sellers</option>
                        <option>Juan dela Cruz</option>
                        <option>Maria Santos</option>
                        <option>Pedro Reyes</option>
                        <option>Rosa Bautista</option>
                        <option>Carlos Mendoza</option>
                        <option>Luz Villanueva</option>
                    </select>
                </div>
                <div class="col-6 col-md-2 d-flex gap-2">
                    <button type="submit" class="btn-filter w-100">
                        <i class="bi bi-funnel-fill"></i> Filter
                    </button>
                    <a href="{{ url('/arbo/products') }}" class="btn-reset-filter w-100">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- ── Category Pills + View Toggle ────────────────────── -->
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
        <div class="cat-pills">
            <button class="cat-pill active" onclick="filterCat(this,'all')">All</button>
            <button class="cat-pill" onclick="filterCat(this,'grains')"><i class="bi bi-box-seam me-1"></i>Grains</button>
            <button class="cat-pill" onclick="filterCat(this,'veggies')"><i class="bi bi-flower2 me-1"></i>Vegetables</button>
            <button class="cat-pill" onclick="filterCat(this,'fruits')"><i class="bi bi-tree me-1"></i>Fruits</button>
            <button class="cat-pill" onclick="filterCat(this,'livestock')"><i class="bi bi-egg me-1"></i>Livestock</button>
            <button class="cat-pill" onclick="filterCat(this,'fiber')"><i class="bi bi-layers me-1"></i>Fiber Crops</button>
            <button class="cat-pill" onclick="filterCat(this,'processed')"><i class="bi bi-droplet-fill me-1"></i>Processed</button>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span style="font-size:.78rem;color:var(--text-muted);">
                <strong id="visibleCount">8</strong> of {{ $totalProducts ?? 58 }} products
            </span>
            <div class="view-toggle">
                <button class="view-toggle-btn active" id="gridViewBtn" title="Grid view" onclick="setView('grid')">
                    <i class="bi bi-grid-3x3-gap-fill"></i>
                </button>
                <button class="view-toggle-btn" id="listViewBtn" title="List view" onclick="setView('list')">
                    <i class="bi bi-list-ul"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- ── Product Cards Grid ───────────────────────────────── -->
    @php
        $sampleProducts = [
            ['id'=>'PRD-2024-001','name'=>'Premium White Rice','sku'=>'SKU: GRN-001','cat'=>'Grains / Rice','cat_key'=>'grains','seller'=>'Juan dela Cruz','price'=>'₱52.00','unit'=>'per kg','stock'=>240,'max'=>300,'level'=>'high','status'=>'active','icon'=>'bi-box-seam','img_bg'=>'img-bg-grains'],
            ['id'=>'PRD-2024-002','name'=>'Yellow Corn (Dried)','sku'=>'SKU: GRN-002','cat'=>'Grains / Rice','cat_key'=>'grains','seller'=>'Maria Santos','price'=>'₱28.00','unit'=>'per kg','stock'=>85,'max'=>200,'level'=>'med','status'=>'active','icon'=>'bi-box-seam','img_bg'=>'img-bg-grains'],
            ['id'=>'PRD-2024-003','name'=>'Fresh Coconut (Whole)','sku'=>'SKU: FRT-001','cat'=>'Fruits','cat_key'=>'fruits','seller'=>'Pedro Reyes','price'=>'₱35.00','unit'=>'per piece','stock'=>500,'max'=>500,'level'=>'high','status'=>'active','icon'=>'bi-tree','img_bg'=>'img-bg-fruits'],
            ['id'=>'PRD-2024-004','name'=>'Organic Vegetables Bundle','sku'=>'SKU: VEG-001','cat'=>'Vegetables','cat_key'=>'veggies','seller'=>'Rosa Bautista','price'=>'₱120.00','unit'=>'per bundle','stock'=>12,'max'=>80,'level'=>'low','status'=>'pending','icon'=>'bi-flower2','img_bg'=>'img-bg-veggies'],
            ['id'=>'PRD-2024-005','name'=>'Abaca Fiber (Raw)','sku'=>'SKU: FBR-001','cat'=>'Fiber Crops','cat_key'=>'fiber','seller'=>'Carlos Mendoza','price'=>'₱95.00','unit'=>'per kg','stock'=>180,'max'=>300,'level'=>'med','status'=>'inactive','icon'=>'bi-layers','img_bg'=>'img-bg-fiber'],
            ['id'=>'PRD-2024-006','name'=>'Native Chicken (Live)','sku'=>'SKU: LST-001','cat'=>'Livestock','cat_key'=>'livestock','seller'=>'Luz Villanueva','price'=>'₱380.00','unit'=>'per head','stock'=>45,'max'=>100,'level'=>'med','status'=>'active','icon'=>'bi-egg','img_bg'=>'img-bg-livestock'],
            ['id'=>'PRD-2024-007','name'=>'Processed Coconut Oil','sku'=>'SKU: PRC-001','cat'=>'Processed Goods','cat_key'=>'processed','seller'=>'Elena Torres','price'=>'₱210.00','unit'=>'per 500ml','stock'=>0,'max'=>60,'level'=>'none','status'=>'soldout','icon'=>'bi-droplet-fill','img_bg'=>'img-bg-processed'],
            ['id'=>'PRD-2024-008','name'=>'Bangus Fry (Fingerlings)','sku'=>'SKU: FRM-001','cat'=>'Livestock','cat_key'=>'livestock','seller'=>'Juan dela Cruz','price'=>'₱8.00','unit'=>'per piece','stock'=>3200,'max'=>5000,'level'=>'high','status'=>'active','icon'=>'bi-water','img_bg'=>'img-bg-livestock'],
            ['id'=>'PRD-2024-009','name'=>'Sitaw (String Beans)','sku'=>'SKU: VEG-002','cat'=>'Vegetables','cat_key'=>'veggies','seller'=>'Maria Santos','price'=>'₱45.00','unit'=>'per kg','stock'=>60,'max'=>150,'level'=>'med','status'=>'active','icon'=>'bi-flower2','img_bg'=>'img-bg-veggies'],
            ['id'=>'PRD-2024-010','name'=>'Ripe Cavendish Banana','sku'=>'SKU: FRT-002','cat'=>'Fruits','cat_key'=>'fruits','seller'=>'Pedro Reyes','price'=>'₱25.00','unit'=>'per kg','stock'=>200,'max'=>400,'level'=>'high','status'=>'active','icon'=>'bi-tree','img_bg'=>'img-bg-fruits'],
            ['id'=>'PRD-2024-011','name'=>'Brown Rice (Unmilled)','sku'=>'SKU: GRN-003','cat'=>'Grains / Rice','cat_key'=>'grains','seller'=>'Carlos Mendoza','price'=>'₱65.00','unit'=>'per kg','stock'=>8,'max'=>200,'level'=>'low','status'=>'pending','icon'=>'bi-box-seam','img_bg'=>'img-bg-grains'],
            ['id'=>'PRD-2024-012','name'=>'Native Pork (Dressed)','sku'=>'SKU: LST-002','cat'=>'Livestock','cat_key'=>'livestock','seller'=>'Rosa Bautista','price'=>'₱280.00','unit'=>'per kg','stock'=>35,'max'=>80,'level'=>'med','status'=>'active','icon'=>'bi-egg','img_bg'=>'img-bg-livestock'],
        ];

        $catClass = ['grains'=>'cat-grains','veggies'=>'cat-veggies','fruits'=>'cat-fruits','livestock'=>'cat-livestock','fiber'=>'cat-fiber','processed'=>'cat-processed'];
        $ribbonClass = ['active'=>'ribbon-active','pending'=>'ribbon-pending','inactive'=>'ribbon-inactive','soldout'=>'ribbon-soldout'];
        $ribbonLabel = ['active'=>'Active','pending'=>'Pending','inactive'=>'Inactive','soldout'=>'Sold Out'];
    @endphp

    <div class="products-grid" id="productsGrid">
        @foreach($sampleProducts as $p)
        @php $pct = $p['max'] > 0 ? min(100, round(($p['stock'] / $p['max']) * 100)) : 0; @endphp
        <div class="product-card" data-cat="{{ $p['cat_key'] }}" data-status="{{ $p['status'] }}">

            <!-- Image Area -->
            <div class="product-card-img {{ $p['img_bg'] }}">
                {{-- Replace with <img src="{{ asset('storage/'.$p['image']) }}" ...> when real images exist --}}
                <i class="bi {{ $p['icon'] }} product-img-icon" style="color: {{ in_array($p['cat_key'], ['grains']) ? '#a07000' : (in_array($p['cat_key'],['veggies']) ? '#1a6932' : (in_array($p['cat_key'],['fruits']) ? '#b03060' : (in_array($p['cat_key'],['livestock']) ? '#e07b2a' : (in_array($p['cat_key'],['fiber']) ? '#0d8a7e' : '#1a73e8')))) }};opacity:0.45;"></i>

                <!-- Status Ribbon -->
                <div class="card-ribbon {{ $ribbonClass[$p['status']] ?? 'ribbon-inactive' }}">
                    {{ $ribbonLabel[$p['status']] ?? $p['status'] }}
                </div>

                <!-- Seller Badge -->
                <div class="card-seller-badge" title="{{ $p['seller'] }}">
                    <i class="bi bi-shop me-1"></i>{{ $p['seller'] }}
                </div>

                <!-- Sold Out Stamp -->
                @if($p['status'] === 'soldout')
                <div class="soldout-overlay">
                    <div class="soldout-stamp">Sold Out</div>
                </div>
                @endif

                <!-- Hover Overlay Actions -->
                <div class="card-overlay">
                    <button class="overlay-btn ov-view"
                            data-bs-toggle="modal"
                            data-bs-target="#viewProductModal"
                            title="View Details">
                        <i class="bi bi-eye-fill"></i> View
                    </button>
                    <button class="overlay-btn ov-edit"
                            data-bs-toggle="modal"
                            data-bs-target="#editProductModal"
                            title="Edit Product">
                        <i class="bi bi-pencil-fill"></i> Edit
                    </button>
                </div>
            </div>

            <!-- Card Body -->
            <div class="product-card-body">
                <div class="product-card-cat {{ $catClass[$p['cat_key']] ?? 'cat-other' }}">
                    {{ $p['cat'] }}
                </div>
                <div class="product-card-name">{{ $p['name'] }}</div>
                <div class="product-card-sku">{{ $p['sku'] }}</div>
                <div class="product-card-price">
                    {{ $p['price'] }} <span>{{ $p['unit'] }}</span>
                </div>
            </div>

            <!-- Card Footer: Stock + Archive -->
            <div class="product-card-footer">
                <div class="stock-mini stock-{{ $p['level'] }}">
                    <div class="stock-mini-bar">
                        <div class="stock-mini-fill" style="width:{{ $pct }}%"></div>
                    </div>
                    <span class="stock-mini-label">
                        Stock: {{ number_format($p['stock']) }}
                        @if($p['level']==='low' && $p['stock']>0)
                            &bull; <span style="color:#dc3545;font-weight:700;">Low</span>
                        @elseif($p['stock']==0)
                            &bull; <span style="color:#7c3aed;font-weight:700;">Out</span>
                        @endif
                    </span>
                </div>
                @if($p['status']==='active')
                    <button class="card-arch-btn" title="Archive product">
                        <i class="bi bi-archive"></i> Archive
                    </button>
                @else
                    <button class="card-arch-btn card-activ-btn" title="Activate product">
                        <i class="bi bi-check-circle"></i> Activate
                    </button>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="pagination-bar">
        <div>Showing <strong>1–12</strong> of <strong>{{ $totalProducts ?? 58 }}</strong> products</div>
        <nav aria-label="Products pagination">
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

    <!-- ── Bottom Two-Column Section ───────────────────────── -->
    <div class="row g-4 mt-1">

        <!-- Quick Actions -->
        <div class="col-md-4">
            <div class="section-title">
                <div class="section-title-bar"></div>
                Quick Actions
            </div>
            <div class="side-card">
                <div class="side-card-header">
                    <h6><i class="bi bi-lightning-charge-fill"></i> Product Management</h6>
                    <p>Shortcuts for common product tasks</p>
                </div>
                <div>
                    <button class="qa-row" data-bs-toggle="modal" data-bs-target="#addProductModal">
                        <div class="qa-icon-wrap" style="background:var(--green-100);color:var(--green-700);">
                            <i class="bi bi-plus-circle-fill"></i>
                        </div>
                        <div>
                            <div style="font-weight:600;font-size:.83rem;">Add New Product</div>
                            <div style="font-size:.72rem;color:var(--text-muted);">List a new item to the marketplace</div>
                        </div>
                        <i class="bi bi-chevron-right ms-auto" style="font-size:.72rem;color:var(--gray-400);"></i>
                    </button>
                    <button class="qa-row">
                        <div class="qa-icon-wrap" style="background:var(--gold-light);color:var(--gold);">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <div>
                            <div style="font-weight:600;font-size:.83rem;">Review Pending Listings</div>
                            <div style="font-size:.72rem;color:var(--text-muted);">{{ $pendingProducts ?? 3 }} products awaiting approval</div>
                        </div>
                        <i class="bi bi-chevron-right ms-auto" style="font-size:.72rem;color:var(--gray-400);"></i>
                    </button>
                    <button class="qa-row">
                        <div class="qa-icon-wrap" style="background:#fdecea;color:#c0392b;">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                        </div>
                        <div>
                            <div style="font-weight:600;font-size:.83rem;">Check Low Stock Products</div>
                            <div style="font-size:.72rem;color:var(--text-muted);">{{ $outOfStockProducts ?? 5 }} items need restocking</div>
                        </div>
                        <i class="bi bi-chevron-right ms-auto" style="font-size:.72rem;color:var(--gray-400);"></i>
                    </button>
                    <button class="qa-row">
                        <div class="qa-icon-wrap" style="background:#e8f0fe;color:#1a73e8;">
                            <i class="bi bi-shop-window"></i>
                        </div>
                        <div>
                            <div style="font-weight:600;font-size:.83rem;">View Seller Products</div>
                            <div style="font-size:.72rem;color:var(--text-muted);">Browse products per seller</div>
                        </div>
                        <i class="bi bi-chevron-right ms-auto" style="font-size:.72rem;color:var(--gray-400);"></i>
                    </button>
                    <button class="qa-row">
                        <div class="qa-icon-wrap" style="background:#f3e8ff;color:#7c3aed;">
                            <i class="bi bi-download"></i>
                        </div>
                        <div>
                            <div style="font-weight:600;font-size:.83rem;">Export Product List</div>
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
                Recent Product Activity
            </div>
            <div class="side-card">
                <div class="side-card-header">
                    <h6><i class="bi bi-clock-history"></i> Activity Log</h6>
                    <p>Latest product-related events in your ARBO marketplace</p>
                </div>
                <div>
                    <div class="activity-item">
                        <div class="activity-dot ad-green"><i class="bi bi-plus-circle-fill"></i></div>
                        <div style="flex:1;">
                            <div class="activity-title">Juan dela Cruz listed a new product — Bangus Fry</div>
                            <div class="activity-meta"><i class="bi bi-clock me-1"></i>30 minutes ago &bull; SKU: FRM-001 &bull; Livestock</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot ad-gold"><i class="bi bi-pencil-fill"></i></div>
                        <div style="flex:1;">
                            <div class="activity-title">Maria Santos updated Yellow Corn listing</div>
                            <div class="activity-meta"><i class="bi bi-clock me-1"></i>2 hours ago &bull; Price updated: ₱25 → ₱28 per kg</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot ad-blue"><i class="bi bi-check-circle-fill"></i></div>
                        <div style="flex:1;">
                            <div class="activity-title">Organic Vegetables Bundle approved and activated</div>
                            <div class="activity-meta"><i class="bi bi-clock me-1"></i>4 hours ago &bull; Status: Pending → Active &bull; Rosa Bautista</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot ad-teal"><i class="bi bi-arrow-up-circle-fill"></i></div>
                        <div style="flex:1;">
                            <div class="activity-title">Stock updated — Premium White Rice</div>
                            <div class="activity-meta"><i class="bi bi-clock me-1"></i>Yesterday, 3:45 PM &bull; Restocked: 150 → 240 kg</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot ad-purple"><i class="bi bi-x-circle-fill"></i></div>
                        <div style="flex:1;">
                            <div class="activity-title">Processed Coconut Oil marked as Out of Stock</div>
                            <div class="activity-meta"><i class="bi bi-clock me-1"></i>Yesterday, 11:20 AM &bull; Stock reached zero &bull; Elena Torres</div>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-dot ad-red"><i class="bi bi-archive-fill"></i></div>
                        <div style="flex:1;">
                            <div class="activity-title">Abaca Fiber listing archived</div>
                            <div class="activity-meta"><i class="bi bi-clock me-1"></i>2 days ago &bull; Archived by ARBO Admin &bull; Carlos Mendoza</div>
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
    </div>
</main>

<!-- ══════════════════════════════════════════════════════════
     MODALS
══════════════════════════════════════════════════════════ -->

<!-- ── Add Product Modal ──────────────────────────────────── -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header modal-header-dark">
                <h5 class="modal-title" id="addProductModalLabel">
                    <i class="bi bi-plus-circle-fill me-2"></i>Add New Product
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="{{ url('/arbo/products') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-section-label">Product Information</div>
                    <div class="row g-3 mb-3">
                        <div class="col-12">
                            <label class="modal-form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" class="modal-form-input" name="name" placeholder="Enter product name" required>
                        </div>
                        <div class="col-md-6">
                            <label class="modal-form-label">Category <span class="text-danger">*</span></label>
                            <select class="modal-form-input" name="category" required>
                                <option value="">Select category</option>
                                <option>Grains / Rice</option>
                                <option>Vegetables</option>
                                <option>Fruits</option>
                                <option>Livestock</option>
                                <option>Fiber Crops</option>
                                <option>Processed Goods</option>
                                <option>Others</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="modal-form-label">Seller <span class="text-danger">*</span></label>
                            <select class="modal-form-input" name="seller_id" required>
                                <option value="">Select seller</option>
                                <option>Maria Santos</option>
                                <option>Juan dela Cruz</option>
                                <option>Pedro Reyes</option>
                                <option>Rosa Bautista</option>
                                <option>Carlos Mendoza</option>
                                <option>Luz Villanueva</option>
                                <option>Elena Torres</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="modal-form-label">Product Description</label>
                            <textarea class="modal-form-input" name="description" rows="3" placeholder="Quality, origin, packaging details..."></textarea>
                        </div>
                    </div>

                    <div class="modal-section-label">Pricing & Stock</div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="modal-form-label">Price <span class="text-danger">*</span></label>
                            <div class="input-group" style="flex-wrap:nowrap;">
                                <span class="input-group-text" style="background:var(--gray-100);border:1.5px solid var(--gray-200);border-right:none;border-radius:var(--radius-sm) 0 0 var(--radius-sm);font-size:.83rem;">₱</span>
                                <input type="number" class="modal-form-input" style="border-radius:0 var(--radius-sm) var(--radius-sm) 0;border-left:none;" name="price" placeholder="0.00" step="0.01" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="modal-form-label">Unit of Measure <span class="text-danger">*</span></label>
                            <select class="modal-form-input" name="unit" required>
                                <option value="">Select unit</option>
                                <option>per kg</option>
                                <option>per piece</option>
                                <option>per bundle</option>
                                <option>per sack</option>
                                <option>per liter</option>
                                <option>per 500ml</option>
                                <option>per head</option>
                                <option>per tray</option>
                                <option>per dozen</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="modal-form-label">Available Stock <span class="text-danger">*</span></label>
                            <input type="number" class="modal-form-input" name="stock" placeholder="e.g. 100" min="0" required>
                        </div>
                    </div>

                    <div class="modal-section-label">Media & Publishing</div>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="modal-form-label">Product Photo</label>
                            <input type="file" class="modal-form-input" name="photo" accept="image/*" style="padding:.38rem .85rem;">
                            <div style="font-size:.72rem;color:var(--text-muted);margin-top:.3rem;">JPG, PNG, or WEBP. Max 2MB. Recommended: 800×800 px.</div>
                        </div>
                        <div class="col-md-6">
                            <label class="modal-form-label">SKU / Product Code</label>
                            <input type="text" class="modal-form-input" name="sku" placeholder="e.g. GRN-001 (auto-generated if blank)">
                        </div>
                        <div class="col-12">
                            <label class="modal-form-label">Initial Status</label>
                            <div class="d-flex gap-3 mt-1 flex-wrap">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="addStatActive" value="active" checked>
                                    <label class="form-check-label" style="font-size:.83rem;" for="addStatActive">Active — visible to buyers</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" id="addStatPending" value="pending">
                                    <label class="form-check-label" style="font-size:.83rem;" for="addStatPending">Pending Review</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="border-top:1px solid var(--gray-200);padding:.9rem 1.5rem;">
                <button class="btn-reset-filter" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Cancel</button>
                <button class="btn-green-primary"><i class="bi bi-check-circle-fill"></i> Save Product</button>
            </div>
        </div>
    </div>
</div>

<!-- ── View Product Modal ─────────────────────────────────── -->
<div class="modal fade" id="viewProductModal" tabindex="-1" aria-labelledby="viewProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header modal-header-dark">
                <h5 class="modal-title" id="viewProductModalLabel">
                    <i class="bi bi-box-seam-fill me-2"></i>Product Details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="product-view-hero">
                    <div class="product-hero-icon"><i class="bi bi-box-seam-fill"></i></div>
                    <div style="flex:1;">
                        <div style="font-size:1.1rem;font-weight:700;color:var(--green-900);">Premium White Rice</div>
                        <div style="font-size:.78rem;color:var(--text-muted);">SKU: GRN-001 &bull; Grains / Rice &bull; Juan dela Cruz</div>
                        <div class="mt-2 d-flex gap-2 flex-wrap">
                            <span style="background:var(--green-100);color:var(--green-700);font-size:.72rem;font-weight:700;padding:3px 10px;border-radius:20px;display:inline-flex;align-items:center;gap:5px;">
                                <span style="width:6px;height:6px;border-radius:50%;background:var(--green-600);display:inline-block;"></span>Active
                            </span>
                            <span class="cat-badge cat-grains" style="font-size:.72rem;">Grains / Rice</span>
                        </div>
                    </div>
                    <div class="text-end">
                        <div style="font-size:.7rem;color:var(--text-muted);font-weight:600;text-transform:uppercase;letter-spacing:.5px;">Product ID</div>
                        <div style="font-family:'Courier New',monospace;font-size:.82rem;color:var(--green-800);font-weight:700;">PRD-2024-001</div>
                        <div style="font-size:.7rem;color:var(--text-muted);margin-top:.25rem;">Listed: Jan 10, 2024</div>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="modal-section-label">Pricing & Stock</div>
                        <div class="view-detail-row"><span class="view-detail-label">Unit Price</span><span class="view-detail-value" style="font-size:.95rem;font-weight:700;color:var(--green-800);">₱52.00 per kg</span></div>
                        <div class="view-detail-row"><span class="view-detail-label">Current Stock</span><span class="view-detail-value">240 kg</span></div>
                        <div class="view-detail-row"><span class="view-detail-label">Total Units Sold</span><span class="view-detail-value">1,280 kg</span></div>
                        <div class="view-detail-row"><span class="view-detail-label">Total Revenue</span><span class="view-detail-value" style="color:var(--green-800);font-weight:700;">₱66,560.00</span></div>
                    </div>
                    <div class="col-md-6">
                        <div class="modal-section-label">Seller & Classification</div>
                        <div class="view-detail-row"><span class="view-detail-label">Seller</span><span class="view-detail-value">Juan dela Cruz</span></div>
                        <div class="view-detail-row"><span class="view-detail-label">Category</span><span class="view-detail-value">Grains / Rice</span></div>
                        <div class="view-detail-row"><span class="view-detail-label">Origin</span><span class="view-detail-value">Nabua, Camarines Sur</span></div>
                        <div class="view-detail-row"><span class="view-detail-label">Buyer Rating</span><span class="view-detail-value" style="color:var(--gold);font-weight:700;"><i class="bi bi-star-fill me-1"></i>4.8 / 5.0</span></div>
                    </div>
                    <div class="col-12">
                        <div class="modal-section-label">Performance Overview</div>
                        <div class="row g-2 text-center">
                            <div class="col-3"><div style="background:var(--green-50);border:1px solid var(--green-200);border-radius:10px;padding:.75rem;"><div style="font-size:1.25rem;font-weight:700;color:var(--green-800);">38</div><div style="font-size:.68rem;color:var(--text-muted);font-weight:600;">Orders</div></div></div>
                            <div class="col-3"><div style="background:var(--green-50);border:1px solid var(--green-200);border-radius:10px;padding:.75rem;"><div style="font-size:1.25rem;font-weight:700;color:var(--green-800);">36</div><div style="font-size:.68rem;color:var(--text-muted);font-weight:600;">Fulfilled</div></div></div>
                            <div class="col-3"><div style="background:var(--gold-light);border:1px solid var(--gold-mid);border-radius:10px;padding:.75rem;"><div style="font-size:1.25rem;font-weight:700;color:var(--gold);">4.8</div><div style="font-size:.68rem;color:var(--text-muted);font-weight:600;">Rating</div></div></div>
                            <div class="col-3"><div style="background:var(--green-50);border:1px solid var(--green-200);border-radius:10px;padding:.75rem;"><div style="font-size:1.25rem;font-weight:700;color:var(--green-800);">95%</div><div style="font-size:.68rem;color:var(--text-muted);font-weight:600;">Fill Rate</div></div></div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="modal-section-label">Description</div>
                        <p style="font-size:.83rem;color:var(--text-muted);margin:0;line-height:1.7;">High-quality white rice harvested from the farm fields of Nabua, Camarines Sur. Freshly milled, clean, and free from foreign materials. Suitable for direct consumption and bulk distribution. Packaging available in 5 kg and 25 kg sacks.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border-top:1px solid var(--gray-200);padding:.9rem 1.5rem;">
                <button class="btn-reset-filter" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Close</button>
                <button style="background:#fdecea;color:#c0392b;border:none;border-radius:6px;font-size:.81rem;font-weight:600;padding:.44rem .95rem;display:inline-flex;align-items:center;gap:.3rem;cursor:pointer;">
                    <i class="bi bi-archive-fill"></i> Archive
                </button>
                <button class="btn-green-primary" data-bs-toggle="modal" data-bs-target="#editProductModal" data-bs-dismiss="modal">
                    <i class="bi bi-pencil-fill"></i> Edit Product
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ── Edit Product Modal ─────────────────────────────────── -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header modal-header-dark">
                <h5 class="modal-title" id="editProductModalLabel">
                    <i class="bi bi-pencil-square me-2"></i>Edit Product
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form method="POST" action="#" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="modal-section-label">Product Information</div>
                    <div class="row g-3 mb-3">
                        <div class="col-12">
                            <label class="modal-form-label">Product Name</label>
                            <input type="text" class="modal-form-input" name="name" value="Premium White Rice">
                        </div>
                        <div class="col-md-6">
                            <label class="modal-form-label">Category</label>
                            <select class="modal-form-input" name="category">
                                <option selected>Grains / Rice</option>
                                <option>Vegetables</option><option>Fruits</option>
                                <option>Livestock</option><option>Fiber Crops</option>
                                <option>Processed Goods</option><option>Others</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="modal-form-label">Seller</label>
                            <select class="modal-form-input" name="seller_id">
                                <option selected>Juan dela Cruz</option>
                                <option>Maria Santos</option><option>Pedro Reyes</option>
                                <option>Rosa Bautista</option><option>Carlos Mendoza</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="modal-form-label">Product Description</label>
                            <textarea class="modal-form-input" name="description" rows="3">High-quality white rice harvested from the farm fields of Nabua, Camarines Sur.</textarea>
                        </div>
                    </div>
                    <div class="modal-section-label">Pricing & Stock</div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="modal-form-label">Price</label>
                            <div class="input-group" style="flex-wrap:nowrap;">
                                <span class="input-group-text" style="background:var(--gray-100);border:1.5px solid var(--gray-200);border-right:none;border-radius:var(--radius-sm) 0 0 var(--radius-sm);font-size:.83rem;">₱</span>
                                <input type="number" class="modal-form-input" style="border-radius:0 var(--radius-sm) var(--radius-sm) 0;border-left:none;" name="price" value="52" step="0.01">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="modal-form-label">Unit of Measure</label>
                            <select class="modal-form-input" name="unit">
                                <option selected>per kg</option><option>per piece</option>
                                <option>per bundle</option><option>per sack</option>
                                <option>per liter</option><option>per head</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="modal-form-label">Available Stock</label>
                            <input type="number" class="modal-form-input" name="stock" value="240">
                        </div>
                    </div>
                    <div class="modal-section-label">Publishing Status</div>
                    <div class="d-flex gap-3 flex-wrap mt-1">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="editStatActive" value="active" checked>
                            <label class="form-check-label" style="font-size:.83rem;" for="editStatActive">Active</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="editStatPending" value="pending">
                            <label class="form-check-label" style="font-size:.83rem;" for="editStatPending">Pending</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="editStatInactive" value="inactive">
                            <label class="form-check-label" style="font-size:.83rem;" for="editStatInactive">Inactive</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="border-top:1px solid var(--gray-200);padding:.9rem 1.5rem;">
                <button class="btn-reset-filter" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i> Cancel</button>
                <button class="btn-green-primary"><i class="bi bi-check-circle-fill"></i> Save Changes</button>
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
});

/* ── Category Pill Filter ── */
function filterCat(btn, cat) {
    // Update pill active state
    document.querySelectorAll('.cat-pill').forEach(p => p.classList.remove('active'));
    btn.classList.add('active');

    // Show/hide cards
    const cards = document.querySelectorAll('#productsGrid .product-card');
    let visible = 0;
    cards.forEach(card => {
        const match = cat === 'all' || card.dataset.cat === cat;
        card.style.display = match ? '' : 'none';
        if (match) visible++;
    });
    document.getElementById('visibleCount').textContent = visible;
}

/* ── View Toggle (Grid / List) ── */
function setView(mode) {
    const grid = document.getElementById('productsGrid');
    const gridBtn = document.getElementById('gridViewBtn');
    const listBtn = document.getElementById('listViewBtn');

    if (mode === 'grid') {
        grid.style.gridTemplateColumns = '';
        grid.querySelectorAll('.product-card').forEach(c => {
            c.style.flexDirection = '';
            c.style.maxHeight = '';
        });
        gridBtn.classList.add('active');
        listBtn.classList.remove('active');
    } else {
        // List view: single column, horizontal card layout
        grid.style.gridTemplateColumns = '1fr';
        grid.querySelectorAll('.product-card').forEach(c => {
            c.style.flexDirection = 'row';
            c.style.maxHeight = '120px';
        });
        gridBtn.classList.remove('active');
        listBtn.classList.add('active');
    }
}
</script>
</body>
</html>