<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Agraryo Merkado — Fresh From Bicol's Farms</title>
    <link rel="icon" href="{{ asset('images/dar-logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* ─── Design Tokens ─────────────────────────────────── */
        :root {
            --green-950:  #071f10;
            --green-900:  #0d3b1e;
            --green-800:  #145228;
            --green-700:  #1a6932;
            --green-600:  #1f803c;
            --green-500:  #268f44;
            --green-400:  #3aab58;
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
            --gray-500:   #6c757d;
            --gray-600:   #495057;
            --gray-800:   #343a40;
            --text-main:  #1a2332;
            --text-muted: #64748b;
            --shadow-sm:  0 2px 8px rgba(13,59,30,0.07);
            --shadow-md:  0 6px 24px rgba(13,59,30,0.11);
            --shadow-lg:  0 16px 48px rgba(13,59,30,0.14);
            --radius:     14px;
            --radius-sm:  9px;
            --radius-xs:  6px;
        }

        *, *::before, *::after { box-sizing: border-box; }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'DM Sans', system-ui, sans-serif;
            background: var(--gray-100);
            color: var(--text-main);
            min-height: 100vh;
        }

        /* ─── TOP ANNOUNCEMENT BAR ──────────────────────────── */
        .announcement-bar {
            background: var(--green-950);
            color: var(--green-200);
            font-size: 0.75rem;
            font-weight: 500;
            text-align: center;
            padding: 7px 1rem;
            letter-spacing: 0.02em;
        }

        .announcement-bar a {
            color: var(--gold-mid);
            text-decoration: none;
            font-weight: 600;
            margin-left: 4px;
        }

        .announcement-bar a:hover { text-decoration: underline; }

        /* ─── TOP NAVBAR ────────────────────────────────────── */
        .top-navbar {
            background: var(--green-900);
            height: 64px;
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            position: sticky;
            top: 0;
            z-index: 1040;
            box-shadow: 0 2px 16px rgba(0,0,0,0.28);
            gap: 1rem;
        }

        .navbar-brand-area {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            text-decoration: none;
            flex-shrink: 0;
        }

        .navbar-brand-area img { height: 38px; }

        .navbar-system-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.15rem;
            color: #fff;
            line-height: 1.1;
        }

        .navbar-system-sub {
            font-size: 0.65rem;
            color: var(--green-200);
            letter-spacing: 0.06em;
            text-transform: uppercase;
            font-weight: 500;
        }

        /* Search */
        .navbar-search {
            flex: 1;
            max-width: 480px;
            position: relative;
        }

        .navbar-search input {
            width: 100%;
            background: rgba(255,255,255,0.1);
            border: 1.5px solid rgba(255,255,255,0.15);
            border-radius: 30px;
            padding: 8px 46px 8px 18px;
            font-size: 0.84rem;
            color: #fff;
            outline: none;
            font-family: 'DM Sans', sans-serif;
            transition: background 0.18s, border-color 0.18s;
        }

        .navbar-search input::placeholder { color: rgba(255,255,255,0.45); }
        .navbar-search input:focus { background: rgba(255,255,255,0.14); border-color: rgba(255,255,255,0.35); }

        .navbar-search .search-btn {
            position: absolute;
            right: 6px; top: 50%;
            transform: translateY(-50%);
            background: var(--green-500);
            border: none; border-radius: 50%;
            width: 32px; height: 32px;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 0.85rem; cursor: pointer;
            transition: background 0.18s;
        }

        .navbar-search .search-btn:hover { background: var(--green-400); }

        /* Nav right */
        .navbar-right {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-icon-btn {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.1);
            color: rgba(255,255,255,0.8);
            font-size: 1rem;
            cursor: pointer;
            padding: 7px 9px;
            border-radius: 10px;
            position: relative;
            transition: all 0.18s;
            text-decoration: none;
            display: inline-flex; align-items: center;
        }

        .nav-icon-btn:hover { color: #fff; background: rgba(255,255,255,0.14); }

        .nav-badge {
            position: absolute;
            top: -4px; right: -4px;
            min-width: 18px; height: 18px;
            background: var(--gold);
            border-radius: 10px;
            border: 2px solid var(--green-900);
            font-size: 0.62rem; font-weight: 700;
            color: #fff;
            display: flex; align-items: center; justify-content: center;
            padding: 0 3px;
        }

        .nav-divider { width: 1px; height: 24px; background: rgba(255,255,255,0.12); margin: 0 0.25rem; }

        .btn-signin {
            background: transparent;
            border: 1.5px solid rgba(255,255,255,0.3);
            color: rgba(255,255,255,0.9);
            border-radius: 10px;
            padding: 7px 16px;
            font-size: 0.82rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.18s;
            font-family: 'DM Sans', sans-serif;
        }

        .btn-signin:hover { background: rgba(255,255,255,0.1); border-color: rgba(255,255,255,0.5); color: #fff; }

        .btn-sell {
            background: var(--gold);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 7px 16px;
            font-size: 0.82rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.18s;
            font-family: 'DM Sans', sans-serif;
            white-space: nowrap;
        }

        .btn-sell:hover { background: #b07c22; }

        /* Mobile toggle */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: #fff;
            font-size: 1.4rem;
            cursor: pointer;
            margin-right: 0.5rem;
        }

        /* ─── CATEGORY NAV ──────────────────────────────────── */
        .cat-nav {
            background: var(--green-800);
            padding: 0 1.5rem;
            display: flex;
            gap: 0;
            overflow-x: auto;
            scrollbar-width: none;
        }

        .cat-nav::-webkit-scrollbar { display: none; }

        .cat-nav-item {
            padding: 11px 16px;
            font-size: 0.8rem;
            font-weight: 600;
            color: rgba(255,255,255,0.65);
            cursor: pointer;
            white-space: nowrap;
            border-bottom: 2.5px solid transparent;
            transition: all 0.18s;
            display: flex;
            align-items: center;
            gap: 5px;
            text-decoration: none;
        }

        .cat-nav-item:hover { color: #fff; background: rgba(255,255,255,0.06); }
        .cat-nav-item.active { color: #fff; border-bottom-color: var(--gold); }
        .cat-nav-item .cat-icon { font-size: 0.9rem; }

        /* ─── HERO BANNER ───────────────────────────────────── */
        .hero {
            background: var(--green-900);
            padding: 0;
            overflow: hidden;
            position: relative;
        }

        .hero-inner {
            max-width: 1200px;
            margin: 0 auto;
            padding: 3rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 2rem;
            position: relative;
            z-index: 1;
        }

        .hero-bg-pattern {
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(circle at 20% 50%, rgba(38,143,68,0.18) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(200,146,42,0.1) 0%, transparent 40%);
            pointer-events: none;
        }

        .hero-text { flex: 1; }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(200,146,42,0.15);
            border: 1px solid rgba(200,146,42,0.3);
            color: var(--gold-mid);
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 30px;
            margin-bottom: 1rem;
        }

        .hero-title {
            font-family: 'DM Serif Display', serif;
            font-size: 2.4rem;
            color: #fff;
            line-height: 1.15;
            margin-bottom: 0.85rem;
        }

        .hero-title em {
            font-style: italic;
            color: var(--gold-mid);
        }

        .hero-desc {
            font-size: 0.95rem;
            color: rgba(255,255,255,0.65);
            line-height: 1.7;
            margin-bottom: 1.5rem;
            max-width: 440px;
        }

        .hero-ctas {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
            margin-bottom: 2rem;
        }

        .btn-hero-primary {
            background: var(--green-500);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 11px 24px;
            font-size: 0.9rem;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: background 0.18s, transform 0.18s;
            font-family: 'DM Sans', sans-serif;
        }

        .btn-hero-primary:hover { background: var(--green-400); transform: translateY(-1px); }

        .btn-hero-outline {
            background: transparent;
            color: rgba(255,255,255,0.85);
            border: 1.5px solid rgba(255,255,255,0.3);
            border-radius: 10px;
            padding: 10px 22px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.18s;
            font-family: 'DM Sans', sans-serif;
        }

        .btn-hero-outline:hover { background: rgba(255,255,255,0.08); color: #fff; }

        .hero-trust {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .trust-item {
            display: flex;
            flex-direction: column;
        }

        .trust-val {
            font-family: 'DM Serif Display', serif;
            font-size: 1.6rem;
            color: #fff;
            line-height: 1;
        }

        .trust-lbl {
            font-size: 0.72rem;
            color: rgba(255,255,255,0.5);
            margin-top: 2px;
            font-weight: 500;
        }

        .hero-image-side {
            flex-shrink: 0;
            width: 300px;
            display: none;
        }

        /* ─── PROMO STRIP ───────────────────────────────────── */
        .promo-strip {
            background: var(--gold-light);
            border-bottom: 1px solid var(--gold-mid);
            padding: 10px 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .promo-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--green-800);
        }

        .promo-item i { color: var(--gold); font-size: 1rem; }

        /* ─── PAGE WRAPPER ──────────────────────────────────── */
        .page-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1.75rem 1.5rem 4rem;
        }

        /* ─── SECTION HEADER ────────────────────────────────── */
        .section-hd {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.1rem;
        }

        .section-hd-title {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-main);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-hd-title::before {
            content: '';
            display: block;
            width: 4px;
            height: 18px;
            background: var(--green-600);
            border-radius: 3px;
        }

        .see-all-btn {
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--green-700);
            background: none;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 0;
        }

        .see-all-btn:hover { color: var(--green-900); text-decoration: underline; }

        /* ─── FILTER BAR ────────────────────────────────────── */
        .filter-bar {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-bottom: 1.25rem;
        }

        .filter-pill {
            background: #fff;
            border: 1.5px solid var(--gray-200);
            border-radius: 30px;
            padding: 5px 14px;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--gray-500);
            cursor: pointer;
            transition: all 0.18s;
            white-space: nowrap;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .filter-pill:hover { border-color: var(--green-600); color: var(--green-700); background: var(--green-50); }
        .filter-pill.active { background: var(--green-800); border-color: var(--green-800); color: #fff; }

        .sort-select {
            margin-left: auto;
            background: #fff;
            border: 1.5px solid var(--gray-200);
            border-radius: var(--radius-sm);
            padding: 5px 12px;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--gray-600);
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            outline: none;
        }

        .sort-select:focus { border-color: var(--green-600); }

        /* ─── PRODUCT CARDS GRID ────────────────────────────── */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(195px, 1fr));
            gap: 1rem;
        }

        /* ─── PRODUCT CARD ──────────────────────────────────── */
        .product-card {
            background: #fff;
            border-radius: var(--radius);
            border: 1px solid var(--gray-200);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-md);
        }

        /* Image */
        .prod-img-wrap {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .prod-img-wrap img {
            width: 100%; height: 100%;
            object-fit: cover;
        }

        .prod-img-icon { font-size: 3.8rem; }

        .bg-grains   { background: linear-gradient(135deg, #fdf5e0, #f5e8b0); }
        .bg-veggies  { background: linear-gradient(135deg, #e8f5ec, #c5e8ce); }
        .bg-fruits   { background: linear-gradient(135deg, #fce4ec, #f7c0d0); }
        .bg-livestock{ background: linear-gradient(135deg, #fff3e0, #ffd8a8); }
        .bg-fiber    { background: linear-gradient(135deg, #e0f7f5, #abe5de); }
        .bg-processed{ background: linear-gradient(135deg, #e8f0fe, #bdd0f7); }

        /* Badges */
        .prod-badge-wrap {
            position: absolute;
            top: 9px; left: 9px;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .prod-badge {
            font-size: 0.62rem;
            font-weight: 700;
            padding: 3px 9px;
            border-radius: 20px;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            display: inline-block;
        }

        .badge-hot      { background: #fdecea; color: #c0392b; }
        .badge-new      { background: var(--green-100); color: var(--green-700); }
        .badge-sale     { background: var(--gold-light); color: #a07000; }
        .badge-organic  { background: #e0f7f5; color: #0d8a7e; }

        /* Fav button */
        .prod-fav-btn {
            position: absolute;
            top: 9px; right: 9px;
            width: 30px; height: 30px;
            background: rgba(255,255,255,0.9);
            border: 1px solid var(--gray-200);
            border-radius: 50%;
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 0.9rem;
            transition: all 0.18s;
            backdrop-filter: blur(4px);
        }

        .prod-fav-btn:hover { background: #fff; transform: scale(1.1); }
        .prod-fav-btn.faved { color: #e74c3c; }

        /* Sold-out overlay */
        .sold-out-overlay {
            position: absolute; inset: 0;
            background: rgba(255,255,255,0.55);
            display: flex; align-items: center; justify-content: center;
        }

        .sold-out-stamp {
            border: 2.5px solid #7c3aed;
            color: #7c3aed;
            font-size: 0.7rem;
            font-weight: 900;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 6px;
            transform: rotate(-14deg);
            background: rgba(255,255,255,0.9);
        }

        /* Quick-add hover overlay */
        .prod-hover-bar {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            background: linear-gradient(to top, rgba(13,59,30,0.88), transparent);
            padding: 0.6rem;
            display: flex;
            justify-content: center;
            gap: 0.4rem;
            opacity: 0;
            transition: opacity 0.2s;
        }

        .product-card:hover .prod-hover-bar { opacity: 1; }

        .hover-btn {
            border: none;
            border-radius: 7px;
            font-size: 0.72rem;
            font-weight: 700;
            padding: 6px 12px;
            cursor: pointer;
            display: inline-flex; align-items: center; gap: 4px;
            transition: transform 0.15s;
            font-family: 'DM Sans', sans-serif;
        }

        .hover-btn:hover { transform: translateY(-1px); }
        .hbtn-view { background: rgba(255,255,255,0.92); color: var(--green-800); }
        .hbtn-add  { background: var(--green-500); color: #fff; }
        .hbtn-add.added { background: var(--gold); }

        /* Body */
        .prod-body {
            padding: 0.85rem 0.95rem 0.75rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .prod-seller-row {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.72rem;
            color: var(--text-muted);
            margin-bottom: 3px;
        }

        .seller-dot {
            width: 6px; height: 6px;
            background: var(--green-500);
            border-radius: 50%;
            flex-shrink: 0;
        }

        .prod-name {
            font-size: 0.87rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 3px;
            line-height: 1.35;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .prod-location {
            font-size: 0.7rem;
            color: var(--gray-400);
            margin-bottom: 7px;
            display: flex;
            align-items: center;
            gap: 3px;
        }

        .prod-price {
            font-size: 1.08rem;
            font-weight: 700;
            color: var(--green-800);
            line-height: 1;
        }

        .prod-price .unit {
            font-size: 0.72rem;
            font-weight: 400;
            color: var(--text-muted);
        }

        .prod-orig-price {
            font-size: 0.75rem;
            color: var(--gray-400);
            text-decoration: line-through;
            margin-left: 4px;
        }

        .low-stock-warn {
            font-size: 0.68rem;
            color: #c0392b;
            font-weight: 700;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 3px;
        }

        /* Footer */
        .prod-footer {
            border-top: 1px solid var(--gray-100);
            padding: 0.55rem 0.95rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.5rem;
        }

        .prod-rating {
            display: flex;
            align-items: center;
            gap: 3px;
            font-size: 0.72rem;
            font-weight: 600;
            color: var(--gold);
        }

        .prod-rating span {
            color: var(--text-muted);
            font-weight: 400;
        }

        .btn-add-cart {
            background: var(--green-700);
            color: #fff;
            border: none;
            border-radius: var(--radius-xs);
            padding: 5px 12px;
            font-size: 0.72rem;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 4px;
            transition: background 0.18s;
            font-family: 'DM Sans', sans-serif;
            white-space: nowrap;
        }

        .btn-add-cart:hover { background: var(--green-900); }
        .btn-add-cart.added { background: var(--gold); }

        /* ─── SELLER CARDS ──────────────────────────────────── */
        .sellers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(170px, 1fr));
            gap: 1rem;
        }

        .seller-card {
            background: #fff;
            border: 1px solid var(--gray-200);
            border-radius: var(--radius);
            padding: 1.25rem 1rem;
            text-align: center;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: var(--shadow-sm);
        }

        .seller-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-md); }

        .seller-avatar {
            width: 56px; height: 56px;
            border-radius: 50%;
            background: var(--green-100);
            border: 3px solid var(--green-200);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--green-800);
            margin: 0 auto 0.75rem;
        }

        .seller-name-text {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 2px;
        }

        .seller-location {
            font-size: 0.7rem;
            color: var(--text-muted);
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 3px;
        }

        .seller-meta {
            display: flex;
            justify-content: center;
            gap: 1.25rem;
        }

        .seller-meta-val {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--green-800);
        }

        .seller-meta-lbl {
            font-size: 0.65rem;
            color: var(--text-muted);
            font-weight: 500;
        }

        .seller-verified {
            display: inline-flex;
            align-items: center;
            gap: 3px;
            font-size: 0.65rem;
            font-weight: 700;
            color: var(--green-700);
            background: var(--green-100);
            border-radius: 20px;
            padding: 2px 8px;
            margin-top: 0.6rem;
        }

        /* ─── PROMOTIONAL BANNERS ───────────────────────────── */
        .promo-cards-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1rem;
            margin-bottom: 1.75rem;
        }

        .promo-card {
            border-radius: var(--radius);
            overflow: hidden;
            padding: 1.5rem;
            position: relative;
            min-height: 130px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .promo-card-1 { background: linear-gradient(135deg, var(--green-900) 0%, var(--green-700) 100%); }
        .promo-card-2 { background: linear-gradient(135deg, #4a1b0c 0%, #993c1d 100%); }
        .promo-card-3 { background: linear-gradient(135deg, #04342c 0%, #0f6e56 100%); }

        .promo-card-tag {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.6);
            margin-bottom: 4px;
        }

        .promo-card-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.2rem;
            color: #fff;
            line-height: 1.25;
            margin-bottom: 6px;
        }

        .promo-card-sub {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.6);
            margin-bottom: 0.85rem;
        }

        .promo-card-btn {
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.3);
            color: #fff;
            border-radius: 7px;
            padding: 6px 14px;
            font-size: 0.75rem;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            font-family: 'DM Sans', sans-serif;
            transition: background 0.18s;
            align-self: flex-start;
        }

        .promo-card-btn:hover { background: rgba(255,255,255,0.25); }

        .promo-card-deco {
            position: absolute;
            right: 1rem; top: 50%;
            transform: translateY(-50%);
            font-size: 4rem;
            opacity: 0.12;
        }

        /* ─── DELIVERY NOTICE BAR ───────────────────────────── */
        .delivery-bar {
            background: #fff;
            border: 1px solid var(--gray-200);
            border-radius: var(--radius);
            padding: 0.85rem 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 1.75rem;
            box-shadow: var(--shadow-sm);
        }

        .delivery-items {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            flex: 1;
        }

        .delivery-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .delivery-icon {
            width: 38px; height: 38px;
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .di-green { background: var(--green-100); color: var(--green-700); }
        .di-gold  { background: var(--gold-light); color: var(--gold); }
        .di-blue  { background: #e8f0fe; color: #1a73e8; }

        .delivery-item-title {
            font-size: 0.82rem;
            font-weight: 700;
            color: var(--text-main);
        }

        .delivery-item-sub {
            font-size: 0.7rem;
            color: var(--text-muted);
        }

        /* ─── CART DRAWER ───────────────────────────────────── */
        .cart-overlay {
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.45);
            z-index: 1050;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s;
        }

        .cart-overlay.show { opacity: 1; pointer-events: all; }

        .cart-drawer {
            position: fixed;
            top: 0; right: 0; bottom: 0;
            width: 380px;
            max-width: 100vw;
            background: #fff;
            z-index: 1060;
            display: flex;
            flex-direction: column;
            box-shadow: -4px 0 32px rgba(0,0,0,0.18);
            transform: translateX(100%);
            transition: transform 0.28s cubic-bezier(0.4,0,0.2,1);
        }

        .cart-drawer.open { transform: translateX(0); }

        .cart-header {
            background: var(--green-900);
            padding: 1.1rem 1.4rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .cart-header h3 {
            font-size: 0.95rem;
            font-weight: 700;
            color: #fff;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .cart-header h3 .cart-count-chip {
            background: var(--gold);
            color: #fff;
            font-size: 0.65rem;
            border-radius: 12px;
            padding: 2px 7px;
        }

        .btn-close-cart {
            background: rgba(255,255,255,0.12);
            border: none;
            color: rgba(255,255,255,0.8);
            border-radius: 8px;
            width: 32px; height: 32px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; font-size: 1rem;
            transition: background 0.18s;
        }

        .btn-close-cart:hover { background: rgba(255,255,255,0.2); color: #fff; }

        .cart-body {
            flex: 1;
            overflow-y: auto;
            padding: 1.25rem;
        }

        .cart-empty {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--text-muted);
        }

        .cart-empty i { font-size: 3rem; opacity: 0.2; margin-bottom: 0.75rem; color: var(--green-700); }
        .cart-empty p { font-size: 0.85rem; }

        .cart-item {
            display: flex;
            gap: 0.85rem;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--gray-100);
        }

        .cart-item:last-child { border-bottom: none; margin-bottom: 0; }

        .cart-item-img {
            width: 58px; height: 58px;
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .cart-item-info { flex: 1; min-width: 0; }

        .cart-item-name {
            font-size: 0.83rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 1px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .cart-item-seller {
            font-size: 0.7rem;
            color: var(--text-muted);
            margin-bottom: 6px;
        }

        .cart-item-price {
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--green-800);
        }

        .cart-qty-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 6px;
        }

        .qty-btn {
            width: 26px; height: 26px;
            border-radius: 7px;
            border: 1.5px solid var(--gray-200);
            background: var(--gray-50);
            cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem;
            color: var(--text-main);
            transition: all 0.16s;
            font-weight: 600;
        }

        .qty-btn:hover { border-color: var(--green-600); color: var(--green-700); background: var(--green-50); }

        .qty-num {
            font-size: 0.85rem;
            font-weight: 700;
            min-width: 22px;
            text-align: center;
        }

        .btn-remove-item {
            background: none;
            border: none;
            color: var(--gray-400);
            cursor: pointer;
            font-size: 0.72rem;
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 3px;
            transition: color 0.16s;
        }

        .btn-remove-item:hover { color: #c0392b; }

        .cart-footer {
            border-top: 1px solid var(--gray-200);
            padding: 1.25rem;
        }

        .cart-summary-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.82rem;
            margin-bottom: 5px;
            color: var(--text-muted);
        }

        .cart-summary-row.total {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-main);
            margin-top: 8px;
            padding-top: 8px;
            border-top: 1px solid var(--gray-200);
        }

        .cart-summary-row .free-delivery {
            color: var(--green-600);
            font-weight: 700;
        }

        .free-del-notice {
            background: var(--green-100);
            color: var(--green-700);
            font-size: 0.72rem;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 7px;
            margin-bottom: 0.85rem;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .btn-checkout {
            width: 100%;
            background: var(--green-900);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 13px;
            font-size: 0.9rem;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.18s;
            font-family: 'DM Sans', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 0.85rem;
        }

        .btn-checkout:hover { background: var(--green-950); }

        .btn-continue-shopping {
            width: 100%;
            background: transparent;
            color: var(--green-700);
            border: 1.5px solid var(--green-600);
            border-radius: 10px;
            padding: 10px;
            font-size: 0.83rem;
            font-weight: 600;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            margin-top: 0.5rem;
            transition: all 0.18s;
        }

        .btn-continue-shopping:hover { background: var(--green-100); }

        /* ─── TOAST ─────────────────────────────────────────── */
        .toast-wrap {
            position: fixed;
            bottom: 1.5rem;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2000;
            display: flex;
            flex-direction: column;
            gap: 8px;
            align-items: center;
            pointer-events: none;
        }

        .toast-msg {
            background: var(--green-900);
            color: #fff;
            padding: 10px 20px;
            border-radius: 30px;
            font-size: 0.82rem;
            font-weight: 600;
            box-shadow: 0 4px 16px rgba(0,0,0,0.2);
            display: flex;
            align-items: center;
            gap: 7px;
            animation: toastIn 0.22s ease, toastOut 0.22s ease 2.2s forwards;
        }

        @keyframes toastIn  { from { opacity:0; transform: translateY(12px); } to { opacity:1; transform: translateY(0); } }
        @keyframes toastOut { from { opacity:1; } to { opacity:0; } }

        /* ─── PRODUCT DETAIL MODAL ──────────────────────────── */
        .modal-content { border-radius: var(--radius); border: none; box-shadow: var(--shadow-lg); }

        .modal-header-green {
            background: var(--green-900);
            border-radius: calc(var(--radius) - 1px) calc(var(--radius) - 1px) 0 0;
            padding: 1rem 1.5rem;
        }

        .modal-header-green .btn-close { filter: invert(1) brightness(1.5); }
        .modal-header-green h5 { color: #fff; font-size: 0.95rem; font-weight: 700; margin: 0; }

        .modal-prod-img-wrap {
            aspect-ratio: 4/3;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--radius-sm);
            overflow: hidden;
            margin-bottom: 1rem;
        }

        .modal-prod-img-wrap img {
            width: 100%; height: 100%;
            object-fit: cover;
        }

        .modal-prod-icon { font-size: 6rem; }

        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--gray-100);
            font-size: 0.83rem;
        }

        .detail-row:last-child { border-bottom: none; }
        .detail-label { color: var(--text-muted); font-weight: 600; font-size: 0.76rem; }
        .detail-value { color: var(--green-800); font-weight: 600; text-align: right; }

        /* ─── FOOTER ─────────────────────────────────────────── */
        .site-footer {
            background: var(--green-950);
            color: rgba(255,255,255,0.65);
            padding: 2.5rem 1.5rem;
            margin-top: 2rem;
        }

        .footer-inner {
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-top {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-brand-col .footer-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.1rem;
            color: #fff;
            margin-bottom: 0.5rem;
        }

        .footer-desc { font-size: 0.78rem; line-height: 1.7; max-width: 280px; }

        .footer-col-title {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: rgba(255,255,255,0.4);
            margin-bottom: 0.75rem;
        }

        .footer-links { list-style: none; padding: 0; margin: 0; }
        .footer-links li { margin-bottom: 0.45rem; }
        .footer-links a { color: rgba(255,255,255,0.55); text-decoration: none; font-size: 0.8rem; transition: color 0.16s; }
        .footer-links a:hover { color: #fff; }

        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.08);
            padding-top: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.75rem;
            font-size: 0.75rem;
        }

        /* ─── MOBILE ─────────────────────────────────────────── */
        @media (max-width: 991px) {
            .hero-title { font-size: 1.8rem; }
            .footer-top { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 767px) {
            .mobile-menu-btn { display: block; }
            .navbar-search { display: none; }
            .navbar-search.mobile-show {
                display: flex;
                position: fixed;
                top: 64px; left: 0; right: 0;
                background: var(--green-900);
                padding: 10px 16px;
                z-index: 1039;
                max-width: 100%;
            }
            .hero-inner { padding: 2rem 1.25rem; }
            .hero-title { font-size: 1.6rem; }
            .hero-trust { gap: 1.25rem; }
            .products-grid { grid-template-columns: repeat(2, 1fr); gap: 0.7rem; }
            .sellers-grid { grid-template-columns: repeat(2, 1fr); }
            .footer-top { grid-template-columns: 1fr 1fr; }
            .cart-drawer { width: 100%; max-width: 100vw; }
            .promo-cards-row { grid-template-columns: 1fr; }
        }

        @media (max-width: 400px) {
            .products-grid { grid-template-columns: 1fr 1fr; gap: 0.5rem; }
        }

        /* ─── LOADING SKELETON ───────────────────────────────── */
        @keyframes shimmer {
            0% { background-position: -500px 0; }
            100% { background-position: 500px 0; }
        }

        .skeleton {
            background: linear-gradient(90deg, var(--gray-200) 25%, var(--gray-100) 50%, var(--gray-200) 75%);
            background-size: 500px 100%;
            animation: shimmer 1.2s infinite;
            border-radius: 6px;
        }
    </style>
</head>
<body>

<!-- ── Announcement Bar ─────────────────────────────────── -->
<div class="announcement-bar">
    <i class="bi bi-megaphone-fill me-1"></i>
    Free delivery on orders over <strong>₱500</strong> in select areas of Camarines Sur &amp; Albay.
    <a href="#">Learn more →</a>
</div>

<!-- ── Top Navbar ───────────────────────────────────────── -->
<header class="top-navbar">
    <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Menu">
        <i class="bi bi-list"></i>
    </button>

    <a href="{{ url('/') }}" class="navbar-brand-area">
        <img src="{{ asset('images/dar-logo.png') }}" alt="DAR">
        <div>
            <div class="navbar-system-title">E-Agraryo Merkado</div>
            <div class="navbar-system-sub">DAR Region V</div>
        </div>
    </a>

    <div class="navbar-search" id="searchBar">
        <input type="text"
               id="searchInput"
               placeholder="Search products, sellers, locations..."
               oninput="handleSearch()"
               autocomplete="off">
        <button class="search-btn" aria-label="Search"><i class="bi bi-search"></i></button>
    </div>

    <div class="navbar-right">
        <a href="#" class="nav-icon-btn d-none d-md-inline-flex" title="Wishlist">
            <i class="bi bi-heart"></i>
            <span class="nav-badge" id="wishlistCount" style="display:none;">0</span>
        </a>

        <button class="nav-icon-btn" id="cartToggleBtn" onclick="toggleCart()" title="Cart">
            <i class="bi bi-cart3"></i>
            <span class="nav-badge" id="cartBadge">0</span>
        </button>

        <div class="nav-divider d-none d-md-block"></div>

        <button class="btn-signin d-none d-md-block" onclick="showToast('Sign in coming soon!')">
            Sign In
        </button>

        <button class="btn-sell" onclick="window.location.href='{{ url('/arbo/products') }}'">
            <i class="bi bi-shop me-1"></i> Sell
        </button>
    </div>
</header>

<!-- ── Mobile Search Bar ─────────────────────────────────── -->
<div class="navbar-search d-md-none" id="mobileSearchBar" style="display:none!important;position:fixed;top:64px;left:0;right:0;background:var(--green-900);padding:10px 16px;z-index:1039;gap:0;flex-direction:row;">
    <input type="text" placeholder="Search products..." oninput="handleSearch()" style="flex:1;background:rgba(255,255,255,0.1);border:1.5px solid rgba(255,255,255,0.2);border-radius:30px 0 0 30px;padding:8px 16px;color:#fff;font-size:0.84rem;font-family:'DM Sans',sans-serif;outline:none;">
    <button class="search-btn" style="border-radius:0 30px 30px 0;position:static;transform:none;margin-left:-1px;" aria-label="Search"><i class="bi bi-search"></i></button>
</div>

<!-- ── Category Nav ──────────────────────────────────────── -->
<nav class="cat-nav" id="catNav" role="navigation" aria-label="Product categories">
    <a href="#" class="cat-nav-item active" data-cat="all" onclick="selectCategory(this,'all');return false;">
        <span class="cat-icon">🏪</span> All Products
    </a>
    <a href="#" class="cat-nav-item" data-cat="grains" onclick="selectCategory(this,'grains');return false;">
        <span class="cat-icon">🌾</span> Grains &amp; Rice
    </a>
    <a href="#" class="cat-nav-item" data-cat="veggies" onclick="selectCategory(this,'veggies');return false;">
        <span class="cat-icon">🥦</span> Vegetables
    </a>
    <a href="#" class="cat-nav-item" data-cat="fruits" onclick="selectCategory(this,'fruits');return false;">
        <span class="cat-icon">🍌</span> Fruits
    </a>
    <a href="#" class="cat-nav-item" data-cat="livestock" onclick="selectCategory(this,'livestock');return false;">
        <span class="cat-icon">🐓</span> Livestock
    </a>
    <a href="#" class="cat-nav-item" data-cat="fiber" onclick="selectCategory(this,'fiber');return false;">
        <span class="cat-icon">🌿</span> Fiber Crops
    </a>
    <a href="#" class="cat-nav-item" data-cat="processed" onclick="selectCategory(this,'processed');return false;">
        <span class="cat-icon">🫙</span> Processed Goods
    </a>
    <a href="#" class="cat-nav-item" data-cat="sellers" onclick="selectCategory(this,'sellers');return false;">
        <span class="cat-icon">👨‍🌾</span> Browse Sellers
    </a>
</nav>

<!-- ── Hero Banner ───────────────────────────────────────── -->
<section class="hero" aria-label="Hero banner">
    <div class="hero-bg-pattern" aria-hidden="true"></div>
    <div class="hero-inner">
        <div class="hero-text">
            <div class="hero-eyebrow">
                <i class="bi bi-patch-check-fill"></i> Verified ARB Farmers
            </div>
            <h1 class="hero-title">
                Fresh From Bicol's Farms,<br>
                <em>Straight to Your Table</em>
            </h1>
            <p class="hero-desc">
                Buy directly from agrarian reform beneficiaries across Region V.
                Fair prices, fresher produce, and a stronger farming community.
            </p>
            <div class="hero-ctas">
                <button class="btn-hero-primary" onclick="document.getElementById('productsSection').scrollIntoView({behavior:'smooth'})">
                    <i class="bi bi-bag-heart-fill"></i> Shop Now
                </button>
                <button class="btn-hero-outline" onclick="selectCategory(document.querySelector('[data-cat=sellers]'),'sellers')">
                    <i class="bi bi-people-fill"></i> Meet the Farmers
                </button>
            </div>
            <div class="hero-trust">
                <div class="trust-item">
                    <div class="trust-val">240+</div>
                    <div class="trust-lbl">Products</div>
                </div>
                <div class="trust-item">
                    <div class="trust-val">58</div>
                    <div class="trust-lbl">Verified Sellers</div>
                </div>
                <div class="trust-item">
                    <div class="trust-val">4.8★</div>
                    <div class="trust-lbl">Avg. Rating</div>
                </div>
                <div class="trust-item">
                    <div class="trust-val">1,200+</div>
                    <div class="trust-lbl">Orders Completed</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ── Main Page Content ─────────────────────────────────── -->
<div class="page-wrapper">

    <!-- Promo Cards -->
    <div class="promo-cards-row" id="promoSection">
        <div class="promo-card promo-card-1">
            <div>
                <div class="promo-card-tag">Featured Deal</div>
                <div class="promo-card-title">Harvest Season<br>Rice &amp; Grains</div>
                <div class="promo-card-sub">Freshly milled white &amp; brown rice from Nabua</div>
            </div>
            <button class="promo-card-btn" onclick="selectCategory(document.querySelector('[data-cat=grains]'),'grains')">
                Shop Grains <i class="bi bi-arrow-right"></i>
            </button>
            <span class="promo-card-deco" aria-hidden="true">🌾</span>
        </div>
        <div class="promo-card promo-card-2">
            <div>
                <div class="promo-card-tag">Limited Stock</div>
                <div class="promo-card-title">Native Livestock<br>Direct from Farm</div>
                <div class="promo-card-sub">Native chicken, pork, and bangus fry</div>
            </div>
            <button class="promo-card-btn" onclick="selectCategory(document.querySelector('[data-cat=livestock]'),'livestock')">
                Shop Livestock <i class="bi bi-arrow-right"></i>
            </button>
            <span class="promo-card-deco" aria-hidden="true">🐔</span>
        </div>
        <div class="promo-card promo-card-3">
            <div>
                <div class="promo-card-tag">New Arrivals</div>
                <div class="promo-card-title">Organic Veggies<br>Weekly Fresh Picks</div>
                <div class="promo-card-sub">Bundles, sitaw, and seasonal greens</div>
            </div>
            <button class="promo-card-btn" onclick="selectCategory(document.querySelector('[data-cat=veggies]'),'veggies')">
                Shop Veggies <i class="bi bi-arrow-right"></i>
            </button>
            <span class="promo-card-deco" aria-hidden="true">🥦</span>
        </div>
    </div>

    <!-- Delivery / Trust Bar -->
    <div class="delivery-bar">
        <div class="delivery-items">
            <div class="delivery-item">
                <div class="delivery-icon di-green"><i class="bi bi-truck"></i></div>
                <div>
                    <div class="delivery-item-title">Free Delivery</div>
                    <div class="delivery-item-sub">On orders over ₱500</div>
                </div>
            </div>
            <div class="delivery-item">
                <div class="delivery-icon di-gold"><i class="bi bi-patch-check-fill"></i></div>
                <div>
                    <div class="delivery-item-title">Verified Farmers</div>
                    <div class="delivery-item-sub">All sellers DAR-accredited</div>
                </div>
            </div>
            <div class="delivery-item d-none d-md-flex">
                <div class="delivery-icon di-blue"><i class="bi bi-shield-check"></i></div>
                <div>
                    <div class="delivery-item-title">Secure Payments</div>
                    <div class="delivery-item-sub">GCash, cash on delivery</div>
                </div>
            </div>
            <div class="delivery-item d-none d-lg-flex">
                <div class="delivery-icon di-green"><i class="bi bi-arrow-counterclockwise"></i></div>
                <div>
                    <div class="delivery-item-title">Easy Returns</div>
                    <div class="delivery-item-sub">Quality guarantee within 24h</div>
                </div>
            </div>
        </div>
    </div>

    <!-- ── Products Section ─────────────────────────────────── -->
    <section id="productsSection">
        <div class="section-hd">
            <h2 class="section-hd-title" id="sectionTitle">Featured Products</h2>
            <div class="d-flex align-items-center gap-2">
                <span style="font-size:0.78rem;color:var(--text-muted);">
                    Showing <strong id="visibleCount">12</strong> products
                </span>
                <button class="see-all-btn">See all <i class="bi bi-arrow-right"></i></button>
            </div>
        </div>

        <!-- Filters -->
        <div class="filter-bar">
            <button class="filter-pill active" onclick="filterBy(this,'all')">All</button>
            <button class="filter-pill" onclick="filterBy(this,'new')">
                <i class="bi bi-stars"></i> New Arrivals
            </button>
            <button class="filter-pill" onclick="filterBy(this,'hot')">
                <i class="bi bi-fire"></i> Best Sellers
            </button>
            <button class="filter-pill" onclick="filterBy(this,'sale')">
                <i class="bi bi-tag-fill"></i> On Sale
            </button>
            <button class="filter-pill" onclick="filterBy(this,'lowstock')">
                <i class="bi bi-exclamation-circle"></i> Almost Gone
            </button>
            <select class="sort-select" id="sortSelect" onchange="sortProducts(this.value)">
                <option value="">Sort by</option>
                <option value="price_asc">Price: Low to High</option>
                <option value="price_desc">Price: High to Low</option>
                <option value="rating">Top Rated</option>
                <option value="sold">Most Sold</option>
            </select>
        </div>

        <div class="products-grid" id="productsGrid"></div>
    </section>

    <!-- ── Sellers Section ─────────────────────────────────── -->
    <section id="sellersSection" style="display:none;">
        <div class="section-hd">
            <h2 class="section-hd-title">Our Verified Sellers</h2>
            <span style="font-size:0.78rem;color:var(--text-muted);">6 farmers</span>
        </div>
        <div class="sellers-grid" id="sellersGrid"></div>
    </section>

</div><!-- /.page-wrapper -->

<!-- ── Site Footer ───────────────────────────────────────── -->
<footer class="site-footer" aria-label="Site footer">
    <div class="footer-inner">
        <div class="footer-top">
            <div class="footer-brand-col">
                <div class="footer-title">E-Agraryo Merkado</div>
                <p class="footer-desc">
                    A DAR Region V digital marketplace connecting agrarian reform beneficiaries
                    directly with buyers across Bicol Region.
                </p>
                <div class="mt-3" style="font-size:0.75rem;color:rgba(255,255,255,0.35);">
                    Department of Agrarian Reform — Region V
                </div>
            </div>
            <div>
                <div class="footer-col-title">Marketplace</div>
                <ul class="footer-links">
                    <li><a href="#">Browse Products</a></li>
                    <li><a href="#">New Arrivals</a></li>
                    <li><a href="#">Best Sellers</a></li>
                    <li><a href="#">Promotions</a></li>
                    <li><a href="#">All Sellers</a></li>
                </ul>
            </div>
            <div>
                <div class="footer-col-title">Sellers</div>
                <ul class="footer-links">
                    <li><a href="{{ url('/arbo/dashboard') }}">Seller Dashboard</a></li>
                    <li><a href="{{ url('/arbo/products') }}">Manage Products</a></li>
                    <li><a href="{{ url('/arbo/orders') }}">View Orders</a></li>
                    <li><a href="#">Seller Guide</a></li>
                </ul>
            </div>
            <div>
                <div class="footer-col-title">Help</div>
                <ul class="footer-links">
                    <li><a href="#">How to Order</a></li>
                    <li><a href="#">Delivery Info</a></li>
                    <li><a href="#">Returns Policy</a></li>
                    <li><a href="#">Contact Us</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <div>© {{ date('Y') }} E-Agraryo Merkado — Department of Agrarian Reform, Region V</div>
            <div style="display:flex;gap:1rem;">
                <a href="#" style="color:rgba(255,255,255,0.35);text-decoration:none;font-size:0.72rem;">Privacy Policy</a>
                <a href="#" style="color:rgba(255,255,255,0.35);text-decoration:none;font-size:0.72rem;">Terms of Use</a>
            </div>
        </div>
    </div>
</footer>

<!-- ══════════════════════════════════════════════════════════
     CART DRAWER
══════════════════════════════════════════════════════════ -->
<div class="cart-overlay" id="cartOverlay" onclick="toggleCart()"></div>

<aside class="cart-drawer" id="cartDrawer" aria-label="Shopping cart">
    <div class="cart-header">
        <h3>
            <i class="bi bi-cart3"></i> Your Cart
            <span class="cart-count-chip" id="cartCountChip">0</span>
        </h3>
        <button class="btn-close-cart" onclick="toggleCart()" aria-label="Close cart">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>
    <div class="cart-body" id="cartBody"></div>
    <div class="cart-footer" id="cartFooter"></div>
</aside>

<!-- ── Product Detail Modal ──────────────────────────────── -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header modal-header-green">
                <h5 class="modal-title" id="productModalLabel">
                    <i class="bi bi-box-seam-fill me-2"></i>
                    <span id="modalProductName">Product Details</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="modalBody"></div>
            <div class="modal-footer" style="padding: 0.9rem 1.5rem; border-top: 1px solid var(--gray-200);">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i>Close
                </button>
                <button type="button" class="btn btn-sm" id="modalAddBtn"
                        style="background:var(--green-700);color:#fff;border:none;font-weight:700;"
                        onclick="modalAddToCart()">
                    <i class="bi bi-cart-plus me-1"></i> Add to Cart
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ── Toast Container ───────────────────────────────────── -->
<div class="toast-wrap" id="toastWrap" aria-live="polite"></div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<script>
/* ══════════════════════════════════════════════════════════
   DATA
══════════════════════════════════════════════════════════ */
const PRODUCTS = [
    {id:1,  name:'Premium White Rice',         seller:'Juan dela Cruz',  loc:'Nabua, CamSur',      price:52,   unit:'per kg',     cat:'grains',   bg:'bg-grains',   icon:'🌾', rating:4.8, sold:1280, stock:240, tag:'hot',   desc:'High-quality white rice freshly milled from the fields of Nabua, Camarines Sur. Free from foreign materials, clean, and well-sorted. Available in 5 kg and 25 kg sacks.'},
    {id:2,  name:'Yellow Corn (Dried)',         seller:'Maria Santos',    loc:'Pili, CamSur',       price:28,   unit:'per kg',     cat:'grains',   bg:'bg-grains',   icon:'🌽', rating:4.5, sold:640,  stock:85,  tag:'',      desc:'Dried yellow corn from Pili, suitable for feeds, grits, and processing. Sundried and cleaned.'},
    {id:3,  name:'Fresh Coconut (Whole)',        seller:'Pedro Reyes',     loc:'Siruma, CamSur',     price:35,   unit:'per piece',  cat:'fruits',   bg:'bg-fruits',   icon:'🥥', rating:4.7, sold:500,  stock:500, tag:'hot',   desc:'Freshly harvested whole coconuts from Siruma. Great for cooking, buko juice, and copra production.'},
    {id:4,  name:'Organic Vegetables Bundle',   seller:'Rosa Bautista',   loc:'Naga City',          price:120,  unit:'per bundle', cat:'veggies',  bg:'bg-veggies',  icon:'🥦', rating:4.6, sold:90,   stock:12,  tag:'new',   desc:'Seasonal organic vegetable bundle featuring kangkong, pechay, ampalaya, and more. Harvested fresh every delivery day.'},
    {id:5,  name:'Abaca Fiber (Raw)',            seller:'Carlos Mendoza',  loc:'Caramoan, CamSur',   price:95,   unit:'per kg',     cat:'fiber',    bg:'bg-fiber',    icon:'🌿', rating:4.3, sold:320,  stock:180, tag:'',      desc:'Raw abaca fiber from Caramoan, one of the finest in the region. Suitable for rope, textile, and paper industries.'},
    {id:6,  name:'Native Chicken (Live)',        seller:'Luz Villanueva',  loc:'Buhi, CamSur',       price:380,  unit:'per head',   cat:'livestock',bg:'bg-livestock',icon:'🐔', rating:4.9, sold:210,  stock:45,  tag:'hot',   desc:'Free-range native chicken raised in Buhi, CamSur. Known for superior taste and quality. Sold live, minimum order 2 heads.'},
    {id:7,  name:'Processed Coconut Oil',        seller:'Elena Torres',    loc:'Iriga, CamSur',      price:210,  unit:'per 500ml',  cat:'processed',bg:'bg-processed',icon:'🫙', rating:4.6, sold:180,  stock:0,   tag:'',      desc:'Virgin coconut oil cold-pressed from fresh coconuts in Iriga. All-natural, no additives, ideal for cooking and health use.'},
    {id:8,  name:'Bangus Fry (Fingerlings)',     seller:'Juan dela Cruz',  loc:'Nabua, CamSur',      price:8,    unit:'per piece',  cat:'livestock',bg:'bg-livestock',icon:'🐟', rating:4.4, sold:3200, stock:3200,tag:'sale',  desc:'Healthy bangus fingerlings for pond or cage culture. Minimum order 100 pieces. Sold from accredited fish hatchery.'},
    {id:9,  name:'Sitaw (String Beans)',         seller:'Maria Santos',    loc:'Pili, CamSur',       price:45,   unit:'per kg',     cat:'veggies',  bg:'bg-veggies',  icon:'🫘', rating:4.5, sold:320,  stock:60,  tag:'new',   desc:'Fresh string beans harvested from Pili. Tender, crispy, and ideal for sautéed dishes and soups.'},
    {id:10, name:'Cavendish Banana',             seller:'Pedro Reyes',     loc:'Siruma, CamSur',     price:25,   unit:'per kg',     cat:'fruits',   bg:'bg-fruits',   icon:'🍌', rating:4.7, sold:800,  stock:200, tag:'',      desc:'Ripe Cavendish bananas from Siruma. Sweet and firm, great for fresh eating, smoothies, and baking.'},
    {id:11, name:'Brown Rice (Unmilled)',         seller:'Carlos Mendoza',  loc:'Caramoan, CamSur',   price:65,   unit:'per kg',     cat:'grains',   bg:'bg-grains',   icon:'🌾', rating:4.2, sold:120,  stock:8,   tag:'sale',  desc:'Nutritious unmilled brown rice retaining its bran layer. Rich in fiber and natural nutrients. Limited stock.'},
    {id:12, name:'Native Pork (Dressed)',         seller:'Rosa Bautista',   loc:'Naga City',          price:280,  unit:'per kg',     cat:'livestock',bg:'bg-livestock',icon:'🥩', rating:4.8, sold:580,  stock:35,  tag:'hot',   desc:'Dressed native pork from organically raised hogs in Naga. Superior flavor and texture compared to commercial pork.'},
    {id:13, name:'Pili Nuts (Shelled)',           seller:'Carlos Mendoza',  loc:'Caramoan, CamSur',   price:320,  unit:'per 250g',   cat:'processed',bg:'bg-processed',icon:'🫘', rating:4.9, sold:240,  stock:90,  tag:'new',   desc:'Premium shelled pili nuts from Camarines Sur — the pili nut capital of the world. Sweet, creamy, and perfect for snacking.'},
    {id:14, name:'Dragon Fruit',                  seller:'Luz Villanueva',  loc:'Buhi, CamSur',       price:85,   unit:'per kg',     cat:'fruits',   bg:'bg-fruits',   icon:'🐉', rating:4.6, sold:190,  stock:75,  tag:'new',   desc:'Fresh red dragon fruit grown in Buhi. Rich in antioxidants, Vitamin C, and fiber. Available weekly.'},
    {id:15, name:'Coconut Vinegar',               seller:'Elena Torres',    loc:'Iriga, CamSur',      price:95,   unit:'per liter',  cat:'processed',bg:'bg-processed',icon:'🫙', rating:4.5, sold:310,  stock:120, tag:'',      desc:'Naturally fermented coconut vinegar from Iriga. Sour, pure, and perfect for pickling and dipping sauces.'},
    {id:16, name:'Kangkong (Water Spinach)',      seller:'Rosa Bautista',   loc:'Naga City',          price:30,   unit:'per bundle', cat:'veggies',  bg:'bg-veggies',  icon:'🥬', rating:4.3, sold:430,  stock:100, tag:'',      desc:'Fresh kangkong bundles, ideal for adobo, sinigang, or ginisa. Harvested in the morning and delivered same day.'},
];

const SELLERS = [
    {name:'Juan dela Cruz', loc:'Nabua, CamSur',      products:8,  rating:4.8, reviews:182, initials:'JD', since:'2021'},
    {name:'Maria Santos',   loc:'Pili, CamSur',       products:6,  rating:4.7, reviews:145, initials:'MS', since:'2022'},
    {name:'Pedro Reyes',    loc:'Siruma, CamSur',     products:5,  rating:4.6, reviews:108, initials:'PR', since:'2022'},
    {name:'Rosa Bautista',  loc:'Naga City',          products:7,  rating:4.9, reviews:213, initials:'RB', since:'2020'},
    {name:'Carlos Mendoza', loc:'Caramoan, CamSur',   products:4,  rating:4.5, reviews:97,  initials:'CM', since:'2023'},
    {name:'Luz Villanueva', loc:'Buhi, CamSur',       products:3,  rating:4.8, reviews:76,  initials:'LV', since:'2023'},
    {name:'Elena Torres',   loc:'Iriga, CamSur',      products:4,  rating:4.6, reviews:131, initials:'ET', since:'2021'},
];

/* ══════════════════════════════════════════════════════════
   STATE
══════════════════════════════════════════════════════════ */
let cart         = JSON.parse(localStorage.getItem('eam_cart') || '[]');
let wishlist     = JSON.parse(localStorage.getItem('eam_wish') || '[]');
let activeCat    = 'all';
let activeFilter = 'all';
let currentSort  = '';
let modalProduct = null;

/* ══════════════════════════════════════════════════════════
   RENDER PRODUCTS
══════════════════════════════════════════════════════════ */
function getFilteredProducts() {
    let list = [...PRODUCTS];
    if (activeCat !== 'all') list = list.filter(p => p.cat === activeCat);
    if (activeFilter === 'new')      list = list.filter(p => p.tag === 'new');
    else if (activeFilter === 'hot') list = list.filter(p => p.tag === 'hot');
    else if (activeFilter === 'sale')list = list.filter(p => p.tag === 'sale');
    else if (activeFilter === 'lowstock') list = list.filter(p => p.stock > 0 && p.stock < 20);
    const q = (document.getElementById('searchInput')?.value || '').trim().toLowerCase();
    if (q) list = list.filter(p =>
        p.name.toLowerCase().includes(q) ||
        p.seller.toLowerCase().includes(q) ||
        p.loc.toLowerCase().includes(q) ||
        p.cat.toLowerCase().includes(q)
    );
    if (currentSort === 'price_asc')  list.sort((a,b) => a.price - b.price);
    if (currentSort === 'price_desc') list.sort((a,b) => b.price - a.price);
    if (currentSort === 'rating')     list.sort((a,b) => b.rating - a.rating);
    if (currentSort === 'sold')       list.sort((a,b) => b.sold - a.sold);
    return list;
}

function renderProducts() {
    const list = getFilteredProducts();
    const grid = document.getElementById('productsGrid');
    document.getElementById('visibleCount').textContent = list.length;

    if (!list.length) {
        grid.innerHTML = `
            <div style="grid-column:1/-1;text-align:center;padding:3rem 1rem;color:var(--text-muted);">
                <i class="bi bi-search" style="font-size:2.5rem;opacity:0.2;display:block;margin-bottom:0.75rem;"></i>
                <p style="font-size:0.88rem;">No products found. Try a different search or category.</p>
            </div>`;
        return;
    }

    grid.innerHTML = list.map(p => {
        const inCart    = cart.find(i => i.id === p.id);
        const inWish    = wishlist.includes(p.id);
        const isOos     = p.stock === 0;
        const isLow     = p.stock > 0 && p.stock < 20;
        const pct       = p.stock > 0 ? Math.min(100, Math.round((p.stock / Math.max(p.stock * 1.5, 100)) * 100)) : 0;
        const tagMap    = { hot:'badge-hot', new:'badge-new', sale:'badge-sale', organic:'badge-organic' };
        const tagLabel  = { hot:'🔥 Hot', new:'✨ New', sale:'💚 Sale', organic:'🌿 Organic' };

        return `
        <article class="product-card" role="article" aria-label="${p.name}">
            <div class="prod-img-wrap ${p.bg}" onclick="openProductModal(${p.id})">
                <span class="prod-img-icon" aria-hidden="true">${p.icon}</span>

                <div class="prod-badge-wrap">
                    ${p.tag ? `<span class="prod-badge ${tagMap[p.tag]}">${tagLabel[p.tag]}</span>` : ''}
                    ${isLow ? '<span class="prod-badge" style="background:#fdecea;color:#c0392b;">⚠ Low Stock</span>' : ''}
                </div>

                <button class="prod-fav-btn ${inWish ? 'faved' : ''}"
                        onclick="toggleWishlist(event,${p.id},this)"
                        aria-label="${inWish ? 'Remove from wishlist' : 'Add to wishlist'}">
                    ${inWish ? '❤️' : '🤍'}
                </button>

                ${isOos ? `
                <div class="sold-out-overlay" aria-label="Sold out">
                    <div class="sold-out-stamp">Sold Out</div>
                </div>` : ''}

                <div class="prod-hover-bar">
                    <button class="hover-btn hbtn-view" onclick="openProductModal(${p.id})">
                        <i class="bi bi-eye-fill"></i> View
                    </button>
                    ${!isOos ? `
                    <button class="hover-btn hbtn-add ${inCart ? 'added' : ''}"
                            onclick="addToCart(event,${p.id},this)">
                        ${inCart ? '<i class="bi bi-check-circle-fill"></i> Added' : '<i class="bi bi-cart-plus-fill"></i> Add'}
                    </button>` : ''}
                </div>
            </div>

            <div class="prod-body" onclick="openProductModal(${p.id})" style="cursor:pointer;">
                <div class="prod-seller-row">
                    <span class="seller-dot" aria-hidden="true"></span>
                    <span>${p.seller}</span>
                </div>
                <div class="prod-name">${p.name}</div>
                <div class="prod-location">
                    <i class="bi bi-geo-alt-fill" aria-hidden="true"></i> ${p.loc}
                </div>
                <div class="prod-price">
                    ₱${p.price.toLocaleString()}
                    <span class="unit">${p.unit}</span>
                </div>
                ${isLow ? `<div class="low-stock-warn"><i class="bi bi-exclamation-triangle-fill"></i> Only ${p.stock} left!</div>` : ''}
            </div>

            <div class="prod-footer">
                <div class="prod-rating" aria-label="Rating: ${p.rating} out of 5">
                    <i class="bi bi-star-fill" aria-hidden="true"></i>
                    ${p.rating}
                    <span>(${(p.sold / 10).toFixed(0)})</span>
                </div>
                ${!isOos ? `
                <button class="btn-add-cart ${inCart ? 'added' : ''}"
                        onclick="addToCart(event,${p.id},this)"
                        aria-label="Add ${p.name} to cart">
                    ${inCart ? '<i class="bi bi-check2"></i> Added' : '<i class="bi bi-cart-plus"></i> Add'}
                </button>` : ''}
            </div>
        </article>`;
    }).join('');
}

/* ══════════════════════════════════════════════════════════
   RENDER SELLERS
══════════════════════════════════════════════════════════ */
function renderSellers() {
    document.getElementById('sellersGrid').innerHTML = SELLERS.map(s => `
        <article class="seller-card" onclick="filterBySeller('${s.name}')">
            <div class="seller-avatar" aria-hidden="true">${s.initials}</div>
            <div class="seller-name-text">${s.name}</div>
            <div class="seller-location">
                <i class="bi bi-geo-alt-fill" aria-hidden="true"></i> ${s.loc}
            </div>
            <div class="seller-meta">
                <div>
                    <div class="seller-meta-val">${s.products}</div>
                    <div class="seller-meta-lbl">Products</div>
                </div>
                <div>
                    <div class="seller-meta-val">⭐ ${s.rating}</div>
                    <div class="seller-meta-lbl">Rating</div>
                </div>
                <div>
                    <div class="seller-meta-val">${s.reviews}</div>
                    <div class="seller-meta-lbl">Reviews</div>
                </div>
            </div>
            <div class="seller-verified">
                <i class="bi bi-patch-check-fill"></i> DAR Verified
            </div>
        </article>`).join('');
}

/* ══════════════════════════════════════════════════════════
   CATEGORY / FILTER / SORT
══════════════════════════════════════════════════════════ */
function selectCategory(el, cat) {
    document.querySelectorAll('.cat-nav-item').forEach(n => n.classList.remove('active'));
    if (el) el.classList.add('active');
    activeCat = cat;

    const prodSec   = document.getElementById('productsSection');
    const sellerSec = document.getElementById('sellersSection');
    const promoSec  = document.getElementById('promoSection');

    if (cat === 'sellers') {
        prodSec.style.display   = 'none';
        sellerSec.style.display = 'block';
        promoSec.style.display  = 'none';
        renderSellers();
    } else {
        prodSec.style.display   = 'block';
        sellerSec.style.display = 'none';
        promoSec.style.display  = 'grid';
        const titles = {
            all:'Featured Products', grains:'Grains & Rice',
            veggies:'Vegetables', fruits:'Fruits',
            livestock:'Livestock & Aquatic', fiber:'Fiber Crops', processed:'Processed Goods'
        };
        document.getElementById('sectionTitle').textContent = titles[cat] || 'Products';
        renderProducts();
    }
}

function filterBy(btn, val) {
    document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('active'));
    btn.classList.add('active');
    activeFilter = val;
    renderProducts();
}

function sortProducts(val) {
    currentSort = val;
    renderProducts();
}

function handleSearch() {
    renderProducts();
}

function filterBySeller(name) {
    activeCat = 'all';
    document.querySelectorAll('.cat-nav-item').forEach(n => n.classList.remove('active'));
    document.querySelector('[data-cat="all"]').classList.add('active');
    document.getElementById('productsSection').style.display = 'block';
    document.getElementById('sellersSection').style.display  = 'none';
    document.getElementById('promoSection').style.display    = 'grid';
    document.getElementById('sectionTitle').textContent = name + "'s Products";
    document.getElementById('searchInput').value = name;
    handleSearch();
    document.getElementById('productsSection').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

/* ══════════════════════════════════════════════════════════
   CART
══════════════════════════════════════════════════════════ */
function saveCart() {
    localStorage.setItem('eam_cart', JSON.stringify(cart));
    updateCartBadge();
    renderCart();
}

function updateCartBadge() {
    const total = cart.reduce((s,i) => s + i.qty, 0);
    const badge = document.getElementById('cartBadge');
    const chip  = document.getElementById('cartCountChip');
    badge.textContent = total;
    chip.textContent  = total;
    badge.style.display = total > 0 ? '' : '';
}

function addToCart(e, id, btnEl) {
    if (e) e.stopPropagation();
    const p = PRODUCTS.find(x => x.id === id);
    if (!p || p.stock === 0) return;

    const existing = cart.find(i => i.id === id);
    if (existing) {
        existing.qty++;
    } else {
        cart.push({ id: p.id, name: p.name, seller: p.seller, price: p.price, unit: p.unit, icon: p.icon, bg: p.bg, qty: 1, stock: p.stock });
    }

    saveCart();
    showToast(`<i class="bi bi-cart-check-fill"></i> ${p.name} added to cart`);

    /* Update all matching buttons */
    document.querySelectorAll(`.btn-add-cart, .hover-btn.hbtn-add`).forEach(btn => {
        if (btn.onclick && btn.onclick.toString().includes(`addToCart(event,${id}`)) {
            btn.classList.add('added');
            btn.innerHTML = btn.classList.contains('btn-add-cart')
                ? '<i class="bi bi-check2"></i> Added'
                : '<i class="bi bi-check-circle-fill"></i> Added';
        }
    });
}

function changeQty(id, delta) {
    const i = cart.find(x => x.id === id);
    if (!i) return;
    i.qty += delta;
    if (i.qty <= 0) {
        cart = cart.filter(x => x.id !== id);
        renderProducts(); /* refresh add buttons */
    }
    saveCart();
}

function removeFromCart(id) {
    cart = cart.filter(x => x.id !== id);
    saveCart();
    renderProducts();
    showToast('<i class="bi bi-trash3"></i> Item removed');
}

function toggleCart() {
    const drawer  = document.getElementById('cartDrawer');
    const overlay = document.getElementById('cartOverlay');
    drawer.classList.toggle('open');
    overlay.classList.toggle('show');
    if (drawer.classList.contains('open')) renderCart();
    document.body.style.overflow = drawer.classList.contains('open') ? 'hidden' : '';
}

function renderCart() {
    const body   = document.getElementById('cartBody');
    const footer = document.getElementById('cartFooter');

    if (!cart.length) {
        body.innerHTML = `
            <div class="cart-empty">
                <i class="bi bi-cart3 d-block"></i>
                <p>Your cart is empty.<br>Browse products and start shopping!</p>
            </div>`;
        footer.innerHTML = '';
        return;
    }

    body.innerHTML = cart.map(i => `
        <div class="cart-item">
            <div class="cart-item-img ${i.bg}" aria-hidden="true">${i.icon}</div>
            <div class="cart-item-info">
                <div class="cart-item-name">${i.name}</div>
                <div class="cart-item-seller">by ${i.seller}</div>
                <div class="cart-item-price">₱${(i.price * i.qty).toLocaleString()}</div>
                <div class="cart-qty-row">
                    <button class="qty-btn" onclick="changeQty(${i.id},-1)" aria-label="Decrease quantity">−</button>
                    <span class="qty-num" aria-label="Quantity: ${i.qty}">${i.qty}</span>
                    <button class="qty-btn" onclick="changeQty(${i.id},1)" aria-label="Increase quantity">+</button>
                    <button class="btn-remove-item" onclick="removeFromCart(${i.id})" aria-label="Remove ${i.name}">
                        <i class="bi bi-trash3"></i> Remove
                    </button>
                </div>
            </div>
        </div>`).join('');

    const subtotal = cart.reduce((s,i) => s + i.price * i.qty, 0);
    const delivery = subtotal >= 500 ? 0 : 50;
    const total    = subtotal + delivery;

    footer.innerHTML = `
        ${delivery === 0 ? `
        <div class="free-del-notice">
            <i class="bi bi-truck"></i> You qualify for free delivery!
        </div>` : `
        <div style="background:var(--gold-light);border-radius:7px;padding:5px 10px;font-size:0.72rem;color:#a07000;font-weight:600;margin-bottom:0.85rem;display:flex;align-items:center;gap:5px;">
            <i class="bi bi-info-circle"></i> Add ₱${(500 - subtotal).toLocaleString()} more for free delivery
        </div>`}
        <div class="cart-summary-row"><span>Subtotal</span><span>₱${subtotal.toLocaleString()}</span></div>
        <div class="cart-summary-row">
            <span>Delivery</span>
            <span class="${delivery === 0 ? 'free-delivery' : ''}">
                ${delivery === 0 ? 'FREE' : '₱' + delivery}
            </span>
        </div>
        <div class="cart-summary-row total"><span>Total</span><span>₱${total.toLocaleString()}</span></div>
        <button class="btn-checkout" onclick="proceedToCheckout()">
            <i class="bi bi-lock-fill"></i> Proceed to Checkout
        </button>
        <button class="btn-continue-shopping" onclick="toggleCart()">
            <i class="bi bi-arrow-left me-1"></i> Continue Shopping
        </button>`;
}

function proceedToCheckout() {
    const total = cart.reduce((s,i) => s + i.price * i.qty, 0);
    showToast('<i class="bi bi-bag-check-fill"></i> Checkout coming soon!');
}

/* ══════════════════════════════════════════════════════════
   WISHLIST
══════════════════════════════════════════════════════════ */
function toggleWishlist(e, id, btn) {
    e.stopPropagation();
    const idx = wishlist.indexOf(id);
    if (idx === -1) {
        wishlist.push(id);
        btn.classList.add('faved');
        btn.innerHTML = '❤️';
        btn.setAttribute('aria-label', 'Remove from wishlist');
        showToast('<i class="bi bi-heart-fill"></i> Added to wishlist');
    } else {
        wishlist.splice(idx, 1);
        btn.classList.remove('faved');
        btn.innerHTML = '🤍';
        btn.setAttribute('aria-label', 'Add to wishlist');
        showToast('<i class="bi bi-heart"></i> Removed from wishlist');
    }
    localStorage.setItem('eam_wish', JSON.stringify(wishlist));
    const wCount = document.getElementById('wishlistCount');
    if (wCount) {
        wCount.textContent = wishlist.length;
        wCount.style.display = wishlist.length > 0 ? '' : 'none';
    }
}

/* ══════════════════════════════════════════════════════════
   PRODUCT MODAL
══════════════════════════════════════════════════════════ */
function openProductModal(id) {
    const p = PRODUCTS.find(x => x.id === id);
    if (!p) return;
    modalProduct = p;

    document.getElementById('modalProductName').textContent = p.name;
    const addBtn = document.getElementById('modalAddBtn');
    addBtn.disabled = p.stock === 0;
    addBtn.innerHTML = p.stock === 0
        ? '<i class="bi bi-x-circle me-1"></i> Out of Stock'
        : '<i class="bi bi-cart-plus me-1"></i> Add to Cart';

    const inCart = cart.find(i => i.id === id);
    if (inCart) {
        addBtn.innerHTML = '<i class="bi bi-check-circle-fill me-1"></i> Already in Cart';
    }

    const pct = p.max ? Math.round((p.stock / p.max) * 100) : Math.min(100, Math.round((p.stock / (p.stock + 50)) * 100));
    const stockColor = p.stock === 0 ? '#7c3aed' : (p.stock < 20 ? '#c0392b' : 'var(--green-600)');

    document.getElementById('modalBody').innerHTML = `
        <div class="row g-3">
            <div class="col-md-5">
                <div class="modal-prod-img-wrap ${p.bg}">
                    <span class="modal-prod-icon" aria-hidden="true">${p.icon}</span>
                </div>
                <div style="display:flex;gap:0.4rem;flex-wrap:wrap;">
                    ${p.tag ? `<span class="prod-badge badge-${p.tag === 'hot' ? 'hot' : p.tag === 'new' ? 'new' : 'sale'}">${p.tag === 'hot' ? '🔥 Hot Seller' : p.tag === 'new' ? '✨ New Arrival' : '💚 On Sale'}</span>` : ''}
                    ${p.stock === 0 ? '<span class="prod-badge" style="background:#f3e8ff;color:#7c3aed;">Out of Stock</span>' : ''}
                    ${p.stock > 0 && p.stock < 20 ? '<span class="prod-badge badge-hot">⚠ Low Stock</span>' : ''}
                </div>
            </div>
            <div class="col-md-7">
                <div style="margin-bottom:0.75rem;">
                    <div style="font-size:1.25rem;font-weight:700;color:var(--green-900);line-height:1.25;margin-bottom:4px;">${p.name}</div>
                    <div style="font-size:0.78rem;color:var(--text-muted);margin-bottom:8px;">
                        <i class="bi bi-shop me-1"></i> ${p.seller} &bull;
                        <i class="bi bi-geo-alt-fill me-1"></i> ${p.loc}
                    </div>
                    <div style="font-size:1.5rem;font-weight:700;color:var(--green-800);">
                        ₱${p.price.toLocaleString()} <span style="font-size:0.82rem;font-weight:400;color:var(--text-muted);">${p.unit}</span>
                    </div>
                </div>

                <div style="margin-bottom:1rem;">
                    <div style="font-size:0.72rem;font-weight:700;color:var(--gray-400);letter-spacing:0.06em;text-transform:uppercase;margin-bottom:0.5rem;">Description</div>
                    <p style="font-size:0.83rem;color:var(--text-muted);line-height:1.65;margin:0;">${p.desc}</p>
                </div>

                <div style="margin-bottom:0.75rem;">
                    <div style="font-size:0.72rem;font-weight:700;color:var(--gray-400);letter-spacing:0.06em;text-transform:uppercase;margin-bottom:0.5rem;">Stock Status</div>
                    <div style="height:6px;background:var(--gray-200);border-radius:4px;overflow:hidden;margin-bottom:4px;">
                        <div style="height:100%;width:${pct}%;background:${stockColor};border-radius:4px;transition:width 0.4s;"></div>
                    </div>
                    <div style="font-size:0.72rem;color:var(--text-muted);">
                        ${p.stock === 0 ? '<strong style="color:#7c3aed;">Out of stock</strong>' : `<strong>${p.stock.toLocaleString()}</strong> units available`}
                    </div>
                </div>

                <div class="detail-row"><span class="detail-label">Category</span><span class="detail-value">${p.cat.charAt(0).toUpperCase() + p.cat.slice(1)}</span></div>
                <div class="detail-row"><span class="detail-label">Buyer Rating</span><span class="detail-value" style="color:var(--gold);">⭐ ${p.rating} / 5.0</span></div>
                <div class="detail-row"><span class="detail-label">Units Sold</span><span class="detail-value">${p.sold.toLocaleString()}</span></div>
            </div>
        </div>`;

    new bootstrap.Modal(document.getElementById('productModal')).show();
}

function modalAddToCart() {
    if (!modalProduct || modalProduct.stock === 0) return;
    addToCart(null, modalProduct.id, null);
    document.getElementById('modalAddBtn').innerHTML = '<i class="bi bi-check-circle-fill me-1"></i> Added to Cart';
}

/* ══════════════════════════════════════════════════════════
   TOAST
══════════════════════════════════════════════════════════ */
function showToast(msg) {
    const wrap = document.getElementById('toastWrap');
    const el   = document.createElement('div');
    el.className = 'toast-msg';
    el.innerHTML = msg;
    wrap.appendChild(el);
    setTimeout(() => el.remove(), 2600);
}

/* ══════════════════════════════════════════════════════════
   MOBILE SEARCH TOGGLE
══════════════════════════════════════════════════════════ */
document.getElementById('mobileMenuBtn').addEventListener('click', function() {
    const msb = document.getElementById('mobileSearchBar');
    const visible = msb.style.getPropertyValue('display') !== 'none!important' && msb.style.display === 'flex';
    msb.style.cssText = visible ? 'display:none!important;' : 'display:flex!important;position:fixed;top:64px;left:0;right:0;background:var(--green-900);padding:10px 16px;z-index:1039;gap:0;';
});

/* ══════════════════════════════════════════════════════════
   INIT
══════════════════════════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', function() {
    renderProducts();
    updateCartBadge();

    /* Restore wishlist badge */
    const wCount = document.getElementById('wishlistCount');
    if (wCount && wishlist.length > 0) {
        wCount.textContent = wishlist.length;
        wCount.style.display = '';
    }
});
</script>
</body>
</html>