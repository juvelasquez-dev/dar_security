<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Agraryo Merkado — DAR Region V</title>

    <link rel="icon" href="{{ asset('images/dar-logo.png') }}" type="image/png">
    <link rel="apple-touch-icon" href="{{ asset('images/dar-logo.png') }}">
    <meta name="description" content="E-Agraryo Merkado — The digital agrarian marketplace for ARBOs, sellers, and buyers in DAR Region V (Bicol).">
    <meta name="theme-color" content="#0d3b1e">
    <meta property="og:title" content="E-Agraryo Merkado — DAR Region V">
    <meta property="og:description" content="Empowering Agrarian Reform Beneficiary Organizations across Bicol with a unified digital marketplace.">
    <meta property="og:image" content="{{ asset('images/dar-logo.png') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --green-900: #0d3b1e;
            --green-800: #145228;
            --green-700: #1a6932;
            --green-600: #1f803c;
            --green-500: #268f44;
            --green-200: #b7e5c4;
            --green-100: #e8f5ec;
            --green-50:  #f4fbf6;
            --gold:      #c8922a;
            --gold-light:#fdf3e0;
            --gold-mid:  #f5d08a;
            --radius:    14px;
            --radius-sm: 9px;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            color: #1a2332;
            background: #fff;
            line-height: 1.6;
        }

        /* ── Navbar ── */
        .site-nav {
            background: var(--green-900);
            position: sticky; top: 0; z-index: 1040;
            box-shadow: 0 2px 12px rgba(0,0,0,0.2);
        }
        .site-nav .navbar-brand {
            display: flex; align-items: center; gap: .7rem;
            text-decoration: none;
        }
        .site-nav .navbar-brand img { height: 38px; filter: brightness(1.15); }
        .site-nav .brand-name { font-size: 1rem; font-weight: 700; color: #fff; line-height: 1.2; }
        .site-nav .brand-sub  { font-size: .6rem; color: var(--green-200); letter-spacing: .08em; text-transform: uppercase; }

        .site-nav .nav-link {
            color: rgba(255,255,255,0.78) !important;
            font-size: .875rem; font-weight: 500;
            padding: .45rem .85rem !important;
            border-radius: 8px;
            transition: color .18s, background .18s;
        }
        .site-nav .nav-link:hover { color: #fff !important; background: rgba(255,255,255,0.08); }

        .btn-nav-signin {
            background: rgba(200,146,42,0.18);
            border: 1px solid rgba(200,146,42,0.4);
            color: var(--gold-mid) !important;
            font-size: .82rem; font-weight: 600;
            padding: .42rem 1.1rem !important;
            border-radius: 20px;
            transition: background .18s;
        }
        .btn-nav-signin:hover { background: rgba(200,146,42,0.28) !important; color: #fff !important; }

        .navbar-toggler {
            border-color: rgba(255,255,255,0.25);
        }
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255,255,255,0.75%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* ── Hero ── */
        .hero-section {
            background: var(--green-900);
            position: relative;
            overflow: hidden;
            padding: 5.5rem 0 5rem;
        }
        .hero-section::before {
            content: '';
            position: absolute; top: -140px; right: -140px;
            width: 520px; height: 520px; border-radius: 50%;
            background: rgba(31,128,60,0.2); pointer-events: none;
        }
        .hero-section::after {
            content: '';
            position: absolute; bottom: -100px; left: -80px;
            width: 380px; height: 380px; border-radius: 50%;
            background: rgba(200,146,42,0.1); pointer-events: none;
        }
        .hero-label {
            display: inline-flex; align-items: center; gap: .5rem;
            background: rgba(200,146,42,0.18);
            border: 1px solid rgba(200,146,42,0.35);
            color: var(--gold-mid); font-size: .73rem; font-weight: 600;
            letter-spacing: .06em; text-transform: uppercase;
            padding: 4px 12px; border-radius: 20px; margin-bottom: 1.25rem;
        }
        .hero-title {
            font-size: clamp(2rem, 4vw, 2.9rem);
            font-weight: 700; color: #fff; line-height: 1.18;
            margin-bottom: 1.1rem;
        }
        .hero-title span { color: var(--gold-mid); }
        .hero-desc {
            font-size: .95rem; color: rgba(255,255,255,0.7);
            max-width: 500px; line-height: 1.75; margin-bottom: 2rem;
        }
        .btn-hero-primary {
            background: var(--gold);
            border: none; color: #fff;
            font-size: .9rem; font-weight: 600;
            padding: .72rem 1.8rem; border-radius: var(--radius-sm);
            transition: background .2s, transform .15s, box-shadow .2s;
            text-decoration: none; display: inline-block;
        }
        .btn-hero-primary:hover {
            background: #b07a20; color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(200,146,42,0.3);
        }
        .btn-hero-outline {
            background: rgba(255,255,255,0.08);
            border: 1.5px solid rgba(255,255,255,0.25);
            color: #fff; font-size: .9rem; font-weight: 500;
            padding: .72rem 1.8rem; border-radius: var(--radius-sm);
            transition: background .2s; text-decoration: none; display: inline-block;
        }
        .btn-hero-outline:hover { background: rgba(255,255,255,0.15); color: #fff; }

        .hero-stat-row { display: flex; gap: 2.5rem; flex-wrap: wrap; margin-top: 2.5rem; }
        .hero-stat-item .value { font-size: 1.65rem; font-weight: 700; color: #fff; line-height: 1; }
        .hero-stat-item .label { font-size: .75rem; color: rgba(255,255,255,0.55); margin-top: 3px; }

        /* Hero card */
        .hero-card {
            background: #fff; border-radius: var(--radius);
            box-shadow: 0 20px 60px rgba(0,0,0,0.25);
            overflow: hidden; position: relative; z-index: 2;
        }
        .hero-card-header {
            background: var(--green-800);
            padding: .85rem 1.25rem;
            display: flex; align-items: center; gap: .6rem;
        }
        .hero-card-header .dot { width: 10px; height: 10px; border-radius: 50%; }
        .hero-card-body { padding: 1.5rem; }
        .mini-stat {
            background: var(--green-50); border-radius: var(--radius-sm);
            border: 1px solid var(--green-200);
            padding: .85rem 1rem; text-align: center;
        }
        .mini-stat .val { font-size: 1.5rem; font-weight: 700; color: var(--green-900); line-height: 1; }
        .mini-stat .lbl { font-size: .72rem; color: #64748b; margin-top: 3px; }
        .mini-arbo-row {
            display: flex; align-items: center; justify-content: space-between;
            padding: .55rem 0; border-bottom: 1px solid #f1f3f5; font-size: .8rem;
        }
        .mini-arbo-row:last-child { border-bottom: none; }
        .mini-badge {
            font-size: .65rem; font-weight: 600; padding: 2px 8px; border-radius: 20px;
        }
        .mb-active   { background: var(--green-100); color: var(--green-700); }
        .mb-pending  { background: var(--gold-light); color: var(--gold); }

        /* ── Section shared ── */
        .section-eyebrow {
            font-size: .7rem; font-weight: 700; letter-spacing: .12em;
            text-transform: uppercase; color: var(--green-600);
            display: flex; align-items: center; gap: .4rem; margin-bottom: .6rem;
        }
        .section-eyebrow::before {
            content: ''; width: 18px; height: 3px;
            background: var(--green-600); border-radius: 2px; display: block;
        }
        .section-title {
            font-size: clamp(1.4rem, 3vw, 1.9rem); font-weight: 700;
            color: var(--green-900); line-height: 1.22;
        }
        .section-desc { font-size: .9rem; color: #64748b; max-width: 520px; }

        /* ── Stats Strip ── */
        .stats-strip {
            background: var(--green-900);
            padding: 2.5rem 0;
        }
        .stat-strip-item { text-align: center; }
        .stat-strip-item .val {
            font-size: 2.2rem; font-weight: 700; color: #fff; line-height: 1;
        }
        .stat-strip-item .lbl { font-size: .78rem; color: var(--green-200); margin-top: 5px; }
        .stat-strip-divider {
            width: 1px; background: rgba(255,255,255,0.12);
            align-self: stretch; margin: .5rem 0;
        }

        /* ── Features / Services ── */
        .features-section { background: #f8f9fa; padding: 5rem 0; }
        .feature-card {
            background: #fff; border-radius: var(--radius);
            border: 1px solid #e9ecef;
            box-shadow: 0 2px 10px rgba(13,59,30,0.06);
            padding: 1.75rem 1.5rem;
            transition: box-shadow .22s, transform .22s;
            height: 100%;
        }
        .feature-card:hover { box-shadow: 0 10px 32px rgba(13,59,30,0.12); transform: translateY(-4px); }
        .feature-icon-wrap {
            width: 54px; height: 54px; border-radius: 13px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; margin-bottom: 1.1rem;
        }
        .fi-green  { background: var(--green-100); color: var(--green-700); }
        .fi-gold   { background: var(--gold-light); color: var(--gold); }
        .fi-blue   { background: #e8f0fe; color: #1a73e8; }
        .fi-teal   { background: #e0f7f5; color: #0d8a7e; }
        .fi-purple { background: #f3e8ff; color: #7c3aed; }
        .fi-red    { background: #fdecea; color: #c0392b; }
        .feature-card h5 { font-size: .95rem; font-weight: 700; color: var(--green-900); margin-bottom: .4rem; }
        .feature-card p  { font-size: .82rem; color: #64748b; margin: 0; }

        /* ── Branches ── */
        .branches-section { padding: 5rem 0; }
        .branch-card {
            background: #fff; border-radius: var(--radius);
            border: 1px solid #e9ecef;
            box-shadow: 0 2px 10px rgba(13,59,30,0.06);
            padding: 1.25rem 1rem;
            text-align: center;
            transition: box-shadow .22s, transform .22s;
            height: 100%;
        }
        .branch-card:hover { box-shadow: 0 8px 26px rgba(13,59,30,0.1); transform: translateY(-3px); }
        .branch-icon-wrap {
            width: 44px; height: 44px; border-radius: 11px;
            background: var(--green-100); color: var(--green-700);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.1rem; margin: 0 auto .75rem;
        }
        .branch-card h6 { font-size: .87rem; font-weight: 700; color: var(--green-900); margin: 0 0 3px; }
        .branch-card p  { font-size: .73rem; color: #64748b; margin: 0; }

        /* ── Announcements ── */
        .announcements-section { background: #f8f9fa; padding: 5rem 0; }
        .announcement-card {
            background: #fff; border-radius: var(--radius);
            border: 1px solid #e9ecef;
            box-shadow: 0 2px 10px rgba(13,59,30,0.06);
            padding: 1.4rem 1.5rem;
            display: flex; gap: 1rem; align-items: flex-start;
            transition: box-shadow .2s;
            text-decoration: none; color: inherit;
        }
        .announcement-card:hover { box-shadow: 0 8px 26px rgba(13,59,30,0.1); }
        .ann-icon {
            width: 40px; height: 40px; border-radius: 10px;
            background: var(--green-100); color: var(--green-700);
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem; flex-shrink: 0; margin-top: 2px;
        }
        .ann-date { font-size: .7rem; color: #94a3b8; font-weight: 500; margin-bottom: 3px; }
        .ann-title { font-size: .9rem; font-weight: 700; color: var(--green-900); margin-bottom: 4px; }
        .ann-desc  { font-size: .8rem; color: #64748b; margin: 0; }

        /* ── Mission ── */
        .mission-section { padding: 5rem 0; }
        .mission-card {
            background: var(--green-900); border-radius: var(--radius);
            padding: 2.5rem 2rem; color: #fff; height: 100%;
        }
        .mission-card h4 { font-size: 1.15rem; font-weight: 700; color: #fff; margin-bottom: .75rem; }
        .mission-card p  { font-size: .85rem; color: rgba(255,255,255,0.7); line-height: 1.7; margin: 0; }
        .check-list { list-style: none; padding: 0; margin: 1rem 0 0; }
        .check-list li {
            font-size: .83rem; color: rgba(255,255,255,0.75);
            display: flex; align-items: flex-start; gap: .5rem; margin-bottom: .5rem;
        }
        .check-list li i { color: var(--gold-mid); margin-top: 2px; flex-shrink: 0; }

        /* ── Contact ── */
        .contact-section {
            background: var(--green-900);
            padding: 4rem 0;
        }
        .contact-info-item {
            display: flex; align-items: flex-start; gap: .75rem;
            margin-bottom: 1rem;
        }
        .contact-info-item .ci-icon {
            width: 36px; height: 36px; border-radius: 9px;
            background: rgba(255,255,255,0.1); color: var(--gold-mid);
            display: flex; align-items: center; justify-content: center;
            font-size: .9rem; flex-shrink: 0;
        }
        .contact-info-item .ci-label { font-size: .68rem; color: var(--green-200); margin-bottom: 1px; }
        .contact-info-item .ci-value { font-size: .85rem; color: #fff; font-weight: 500; }

        /* ── CTA Banner ── */
        .cta-banner {
            background: linear-gradient(135deg, var(--green-800), var(--green-900));
            border-radius: var(--radius);
            padding: 2.5rem 2rem;
            border: 1px solid rgba(255,255,255,0.08);
        }

        /* ── Footer ── */
        footer {
            background: #0a2e17;
            padding: 2rem 0;
            color: rgba(255,255,255,0.4);
            font-size: .78rem;
        }
        footer a { color: var(--green-200); text-decoration: none; }
        footer a:hover { color: #fff; }

        /* ── Smooth scroll ── */
        html { scroll-behavior: smooth; }

        @media (max-width: 767.98px) {
            .hero-section { padding: 3.5rem 0 3rem; }
            .hero-stat-row { gap: 1.5rem; }
            .stat-strip-divider { display: none; }
        }
    </style>
</head>
<body>

    <!-- ── Navbar ── -->
    <nav class="navbar navbar-expand-lg site-nav py-0" style="min-height:62px;">
        <div class="container">
            <a class="navbar-brand py-3" href="{{ url('/') }}">
                <img src="{{ asset('images/dar-logo.png') }}" alt="DAR Logo">
                <div>
                    <div class="brand-name">E-Agraryo Merkado</div>
                    <div class="brand-sub">DAR Region V</div>
                </div>
            </a>

            <button class="navbar-toggler border-0 py-2" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-1">
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#branches">Branches</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#announcements">Announcements</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item ms-2">
                        <a class="nav-link btn-nav-signin" href="{{ url('/login') }}">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Sign In
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ── Hero ── -->
    <section class="hero-section">
        <div class="container" style="position:relative; z-index:2;">
            <div class="row align-items-center g-5">

                <!-- Left -->
                <div class="col-lg-6">
                    <div class="hero-label">
                        <i class="bi bi-shield-fill-check"></i>
                        DAR Region V — Bicol
                    </div>
                    <h1 class="hero-title">
                        The Digital <span>Agrarian</span><br>Marketplace
                    </h1>
                    <p class="hero-desc">
                        Empowering Agrarian Reform Beneficiary Organizations across Bicol with a unified platform for training and trade — access our <strong>E-Learning</strong> courses or join the <strong>E-Agraryo Marketplace</strong> to buy and sell agricultural products.
                    </p>

                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ url('/login') }}?area=elearning" class="btn-hero-primary">
                            <i class="bi bi-journal-bookmark me-2"></i> E-Learning
                        </a>
                        <a href="{{ url('/login') }}?area=marketplace" class="btn-hero-outline">
                            <i class="bi bi-shop me-2"></i> E-Agraryo Marketplace
                        </a>
                        <a href="#services" class="btn-hero-outline">
                            Learn More <i class="bi bi-arrow-down ms-1"></i>
                        </a>
                    </div>

                    <div class="hero-stat-row">
                        <div class="hero-stat-item">
                            <div class="value">8</div>
                            <div class="label">CARPOS Offices</div>
                        </div>
                        <div class="hero-stat-item">
                            <div class="value">{{ $totalArbos ?? '50+' }}</div>
                            <div class="label">Registered ARBOs</div>
                        </div>
                        <div class="hero-stat-item">
                            <div class="value">{{ $totalSellers ?? '100+' }}</div>
                            <div class="label">Active Sellers</div>
                        </div>
                        <div class="hero-stat-item">
                            <div class="value">{{ $totalBuyers ?? '200+' }}</div>
                            <div class="label">Buyers</div>
                        </div>
                    </div>
                </div>

                <!-- Right: Dashboard preview card -->
                <div class="col-lg-6">
                    <div class="hero-card">
                        <div class="hero-card-header">
                            <span class="dot" style="background:#ff5f57;"></span>
                            <span class="dot" style="background:#ffbd2e;"></span>
                            <span class="dot" style="background:#28c840;"></span>
                            <span style="font-size:.72rem; color:rgba(255,255,255,0.6); margin-left:.5rem;">Admin CARPOS Dashboard</span>
                        </div>
                        <div class="hero-card-body">
                            <div class="row g-2 mb-3">
                                <div class="col-6"><div class="mini-stat"><div class="val" style="color:var(--green-700);">{{ $totalArbos ?? '12' }}</div><div class="lbl">Total ARBOs</div></div></div>
                                <div class="col-6"><div class="mini-stat"><div class="val" style="color:var(--gold);">{{ $totalArboAdmins ?? '8' }}</div><div class="lbl">ARBO Admins</div></div></div>
                                <div class="col-6"><div class="mini-stat"><div class="val" style="color:#1a73e8;">{{ $totalSellers ?? '24' }}</div><div class="lbl">Sellers</div></div></div>
                                <div class="col-6"><div class="mini-stat"><div class="val" style="color:#0d8a7e;">{{ $totalBuyers ?? '61' }}</div><div class="lbl">Buyers</div></div></div>
                            </div>
                            <div style="font-size:.72rem; font-weight:700; text-transform:uppercase; letter-spacing:.07em; color:#94a3b8; margin-bottom:.5rem;">Recent ARBOs</div>
                            <div class="mini-arbo-row">
                                <div>
                                    <div style="font-weight:600; font-size:.82rem; color:var(--green-900);">Mabuhay Farmers Coop</div>
                                    <div style="font-size:.7rem; color:#94a3b8;">Camarines Sur · Naga City</div>
                                </div>
                                <span class="mini-badge mb-active">Active</span>
                            </div>
                            <div class="mini-arbo-row">
                                <div>
                                    <div style="font-weight:600; font-size:.82rem; color:var(--green-900);">Bagong Pag-asa ARB</div>
                                    <div style="font-size:.7rem; color:#94a3b8;">Albay · Legazpi City</div>
                                </div>
                                <span class="mini-badge mb-active">Active</span>
                            </div>
                            <div class="mini-arbo-row">
                                <div>
                                    <div style="font-weight:600; font-size:.82rem; color:var(--green-900);">Pagkakaisa Farmers Assoc.</div>
                                    <div style="font-size:.7rem; color:#94a3b8;">Sorsogon · Sorsogon City</div>
                                </div>
                                <span class="mini-badge mb-pending">Pending</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ── Stats Strip ── -->
    <div class="stats-strip">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-6 col-md-3">
                    <div class="stat-strip-item">
                        <div class="val">8</div>
                        <div class="lbl">CARPOS-PBD Offices</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-strip-item">
                        <div class="val">{{ $totalArbos ?? '50+' }}</div>
                        <div class="lbl">Registered ARBOs</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-strip-item">
                        <div class="val">{{ $totalSellers ?? '100+' }}</div>
                        <div class="lbl">Marketplace Sellers</div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stat-strip-item">
                        <div class="val">{{ $totalBuyers ?? '200+' }}</div>
                        <div class="lbl">Registered Buyers</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ── Services ── -->
    <section id="services" class="features-section">
        <div class="container">
            <div class="text-center mb-5">
                <div class="section-eyebrow justify-content-center">Platform Features</div>
                <h2 class="section-title">Everything Your ARBO Needs</h2>
                <p class="section-desc mx-auto mt-2">A complete digital ecosystem for agrarian reform beneficiary organizations to register, trade, and grow.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon-wrap fi-green"><i class="bi bi-diagram-3-fill"></i></div>
                        <h5>ARBO Management</h5>
                        <p>Register and manage Agrarian Reform Beneficiary Organizations. Track membership, activity, and compliance per CARPOS office.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon-wrap fi-gold"><i class="bi bi-shop-window"></i></div>
                        <h5>Marketplace for Sellers</h5>
                        <p>ARB members can list and sell agricultural products directly to buyers through a managed digital marketplace.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon-wrap fi-blue"><i class="bi bi-bag-check-fill"></i></div>
                        <h5>Buyer Access</h5>
                        <p>Buyers can browse, order, and transact with verified ARB sellers. Full order tracking and transaction history available.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon-wrap fi-teal"><i class="bi bi-bar-chart-line-fill"></i></div>
                        <h5>Analytics & Reports</h5>
                        <p>Comprehensive reporting for CARPOS admins and Super Admin — track user growth, transactions, and marketplace performance.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon-wrap fi-purple"><i class="bi bi-shield-lock-fill"></i></div>
                        <h5>Role-Based Access</h5>
                        <p>Separate dashboards for Super Admin, CARPOS Admin, ARBO Admin, Sellers, and Buyers — each with tailored permissions.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="feature-card">
                        <div class="feature-icon-wrap fi-red"><i class="bi bi-bell-fill"></i></div>
                        <h5>Activity Monitoring</h5>
                        <p>Real-time activity logs, notifications for new registrations, orders, flagged products, and pending approvals.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── Branches ── -->
    <section id="branches" class="branches-section">
        <div class="container">
            <div class="text-center mb-5">
                <div class="section-eyebrow justify-content-center">Coverage</div>
                <h2 class="section-title">CARPOS-PBD Offices</h2>
                <p class="section-desc mx-auto mt-2">E-Agraryo Merkado covers all eight CARPOS-PBD offices across Bicol Region under DAR Region V.</p>
            </div>

            <div class="row g-3">
                @php
                    $branches = [
                        ['name' => 'Regional Office',  'desc' => 'DAR Region V HQ',        'slug' => 'regional-office'],
                        ['name' => 'Albay',             'desc' => 'Albay province',           'slug' => 'albay'],
                        ['name' => 'Catanduanes',       'desc' => 'Catanduanes province',     'slug' => 'catanduanes'],
                        ['name' => 'Camarines Sur 1',   'desc' => 'Cam. Sur 1st district',    'slug' => 'camarines-sur-1'],
                        ['name' => 'Camarines Sur 2',   'desc' => 'Cam. Sur 2nd district',    'slug' => 'camarines-sur-2'],
                        ['name' => 'Masbate',           'desc' => 'Masbate province',         'slug' => 'masbate'],
                        ['name' => 'Sorsogon',          'desc' => 'Sorsogon province',        'slug' => 'sorsogon'],
                        ['name' => 'Camarines Norte',   'desc' => 'Camarines Norte province', 'slug' => 'camarines-norte'],
                    ];
                @endphp

                @foreach($branches as $branch)
                <div class="col-6 col-md-3">
                    <div class="branch-card">
                        <div class="branch-icon-wrap"><i class="bi bi-building"></i></div>
                        <h6>{{ $branch['name'] }}</h6>
                        <p>{{ $branch['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- ── About / Mission ── -->
    <section id="about" class="announcements-section">
        <div class="container">
            <div class="row g-4 align-items-stretch">

                <div class="col-lg-5">
                    <div class="section-eyebrow">About Us</div>
                    <h2 class="section-title mb-3">Mission & Vision</h2>
                    <p style="font-size:.9rem; color:#64748b; line-height:1.75;">
                       Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.
                    </p>
                    <p style="font-size:.9rem; color:#64748b; line-height:1.75;">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </p>
                </div>

                <div class="col-lg-7">
                    <div class="row g-3 h-100">
                        <div class="col-md-6">
                            <div class="mission-card">
                                <h4><i class="bi bi-bullseye me-2" style="color:var(--gold-mid);"></i>Mission</h4>
                                <p>To implement agrarian reform programs that promote social justice and rural development in Region V through transparent, accountable services.</p>
                                <ul class="check-list mt-3">
                                    <li><i class="bi bi-check-circle-fill"></i> Transparent land distribution</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Empowerment through support</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Sustainable rural development</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mission-card" style="background:var(--green-800);">
                                <h4><i class="bi bi-eye me-2" style="color:var(--gold-mid);"></i>Vision</h4>
                                <p>A digitally empowered agrarian reform community where ARBOs actively participate in a fair and competitive marketplace.</p>
                                <ul class="check-list mt-3">
                                    <li><i class="bi bi-check-circle-fill"></i> Inclusive agricultural trade</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Data-driven oversight</li>
                                    <li><i class="bi bi-check-circle-fill"></i> Connected ARBO network</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ── Announcements ── -->
    <section id="announcements" class="features-section">
        <div class="container">
            <div class="text-center mb-5">
                <div class="section-eyebrow justify-content-center">Latest Updates</div>
                <h2 class="section-title">Announcements</h2>
                <p class="section-desc mx-auto mt-2">Latest news and advisories from DAR Regional Office No. 5.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="d-flex flex-column gap-3">

                        <a href="#" class="announcement-card">
                            <div class="ann-icon"><i class="bi bi-megaphone-fill"></i></div>
                            <div>
                                <div class="ann-date"><i class="bi bi-calendar3 me-1"></i> March 1, 2026</div>
                                <div class="ann-title">E-Agraryo Merkado Platform Launch</div>
                                <div class="ann-desc">The E-Agraryo Merkado digital marketplace is now live for all registered ARBOs under DAR Region V. ARBO admins may now onboard sellers and begin listing agricultural products.</div>
                            </div>
                        </a>

                        <a href="#" class="announcement-card">
                            <div class="ann-icon"><i class="bi bi-calendar-event-fill"></i></div>
                            <div>
                                <div class="ann-date"><i class="bi bi-calendar3 me-1"></i> February 20, 2026</div>
                                <div class="ann-title">ARBO Registration Drive — Q1 2026</div>
                                <div class="ann-desc">CARPOS offices are now accepting ARBO registration applications for Q1 2026. Qualified organizations are encouraged to register and join the E-Agraryo Merkado platform.</div>
                            </div>
                        </a>

                        <a href="#" class="announcement-card">
                            <div class="ann-icon"><i class="bi bi-award-fill"></i></div>
                            <div>
                                <div class="ann-date"><i class="bi bi-calendar3 me-1"></i> February 10, 2026</div>
                                <div class="ann-title">Livelihood Support Workshops for ARB Sellers</div>
                                <div class="ann-desc">Capacity-building workshops for agrarian reform beneficiaries on product listing, digital marketing, and marketplace participation to be held across all provinces.</div>
                            </div>
                        </a>

                        <a href="#" class="announcement-card">
                            <div class="ann-icon"><i class="bi bi-info-circle-fill"></i></div>
                            <div>
                                <div class="ann-date"><i class="bi bi-calendar3 me-1"></i> January 28, 2026</div>
                                <div class="ann-title">Land Titling Schedule — Bicol Region</div>
                                <div class="ann-desc">Schedule for upcoming land titling activities across municipalities has been released. Beneficiaries are advised to coordinate with their respective CARPOS offices.</div>
                            </div>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── Contact ── -->
    <section id="contact" class="contact-section">
        <div class="container">
            <div class="row g-5 align-items-start">

                <div class="col-lg-5">
                    <div class="section-eyebrow" style="color:var(--green-200);">Get in Touch</div>
                    <h2 class="section-title mb-3" style="color:#fff;">Contact Us</h2>
                    <p style="font-size:.88rem; color:rgba(255,255,255,0.65); line-height:1.75; margin-bottom:2rem;">
                        Reach out to DAR Regional Office No. 5 for inquiries about ARBO registration, marketplace access, or beneficiary services.
                    </p>

                    <div class="contact-info-item">
                        <div class="ci-icon"><i class="bi bi-geo-alt-fill"></i></div>
                        <div>
                            <div class="ci-label">Address</div>
                            <div class="ci-value">Rawis, Legazpi City, Albay</div>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="ci-icon"><i class="bi bi-telephone-fill"></i></div>
                        <div>
                            <div class="ci-label">Phone</div>
                            <div class="ci-value">(052) 481-0000</div>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="ci-icon"><i class="bi bi-envelope-fill"></i></div>
                        <div>
                            <div class="ci-label">Email</div>
                            <div class="ci-value">info@darro5.gov.ph</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="cta-banner">
                        <div class="row align-items-center g-4">
                            <div class="col-md-7">
                                <div style="font-size:.7rem; font-weight:700; letter-spacing:.1em; text-transform:uppercase; color:var(--gold-mid); margin-bottom:.5rem;">Ready to get started?</div>
                                <h4 style="color:#fff; font-weight:700; margin-bottom:.5rem;">Access E-Agraryo Merkado</h4>
                                <p style="font-size:.85rem; color:rgba(255,255,255,0.65); margin:0;">Sign in to manage your ARBO, list products, or browse the marketplace. Staff may also log in directly.</p>
                            </div>
                            <div class="col-md-5 d-flex flex-column gap-2">
                                <div class="d-flex gap-2">
                                    <a href="{{ url('/login') }}?area=elearning" class="btn-hero-outline text-center" style="font-size:.85rem;">
                                        <i class="bi bi-journal-bookmark me-2"></i> E-Learning
                                    </a>

                                    <a href="{{ url('/login') }}?area=marketplace" class="btn-hero-primary text-center">
                                        <i class="bi bi-shop me-2"></i> E-Agraryo Marketplace
                                    </a>
                                </div>
                                <a href="mailto:info@darro5.gov.ph" class="btn-hero-outline text-center" style="font-size:.85rem;">
                                    <i class="bi bi-envelope me-2"></i> Email Us
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ── Footer ── -->
    <footer>
        <div class="container">
            <div class="row align-items-center g-3">
                <div class="col-md-6">
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <img src="{{ asset('images/dar-logo.png') }}" alt="" style="height:28px; opacity:.7; filter:grayscale(1) brightness(2);">
                        <span style="color:rgba(255,255,255,0.5); font-weight:500;">E-Agraryo Merkado</span>
                    </div>
                    <div>© {{ date('Y') }} Department of Agrarian Reform — Regional Office No. 5. All rights reserved.</div>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="{{ url('/login') }}" class="me-3">Staff Login</a>
                    <a href="#contact">Contact</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <!-- Inactivity warning modal -->
    <div class="modal fade" id="inactivityWarningModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">You're about to be signed out</h5>
          </div>
          <div class="modal-body">
            <p>You have been inactive. You will be automatically logged out in <strong id="inactivity-countdown">10</strong> seconds.</p>
          </div>
          <div class="modal-footer">
            <button type="button" id="staySignedInBtn" class="btn btn-primary">Stay signed in</button>
            <button type="button" id="logoutNowBtn" class="btn btn-secondary">Log out now</button>
          </div>
        </div>
      </div>
    </div>

    <script>
        (function(){
            // Overall inactivity and warning timings
                    const INACTIVITY_MS = 15 * 60 * 1000; // 15 minutes
            const WARNING_MS = 10 * 1000;    // 10 seconds warning countdown
                const DEBUG_IDLE = true; // set false to disable debug logs

            let idleTimer = null;
            let warningTimeout = null;
            let countdownInterval = null;
            let performedLogout = false;
            let lastActivity = Date.now();
            let warningShown = false;

            const modalEl = document.getElementById('inactivityWarningModal');
            const countdownEl = document.getElementById('inactivity-countdown');
            const stayBtn = document.getElementById('staySignedInBtn');
            const logoutNowBtn = document.getElementById('logoutNowBtn');
            const bsModal = modalEl ? new bootstrap.Modal(modalEl, {backdrop: 'static', keyboard: false}) : null;

            function getCsrfToken(){
                const m = document.querySelector('meta[name="csrf-token"]');
                return m ? m.getAttribute('content') : '';
            }

            async function performLogout(){
                if(performedLogout) return;
                performedLogout = true;
                    if (DEBUG_IDLE) console.log('[idle] performLogout()', new Date().toISOString());
                const token = getCsrfToken();
                try {
                    // send token as form-encoded body to avoid preflight OPTIONS
                    await fetch("{{ route('logout') }}", {
                        method: 'POST',
                        credentials: 'same-origin',
                        body: new URLSearchParams({ _token: token || '' })
                    });
                } catch (e) {
                    // ignore network errors
                }

                // fallback redirect (server will have logged out if request succeeded)
                window.location.href = "{{ url('/login') }}";
            }

            function clearWarningTimers(){
                if(warningTimeout) { clearTimeout(warningTimeout); warningTimeout = null; }
                if(countdownInterval) { clearInterval(countdownInterval); countdownInterval = null; }
                warningShown = false;
            }

            function showWarning(){
                if(!bsModal) return performLogout();
                // set initial countdown display
                let secondsLeft = Math.ceil(WARNING_MS / 1000);
                countdownEl.textContent = secondsLeft;
                bsModal.show();
                // Prevent immediate re-trigger while warning is active by bumping lastActivity
                // Use WARNING_MS so we only postpone re-trigger for the warning duration
                lastActivity = Date.now() + WARNING_MS;
                warningShown = true;
                    if (DEBUG_IDLE) console.log('[idle] showWarning() secondsLeft=', secondsLeft, 'lastActivity=', new Date(lastActivity).toISOString());

                // start countdown interval
                countdownInterval = setInterval(() => {
                    secondsLeft--;
                    if(secondsLeft <= 0){
                        if(countdownEl) countdownEl.textContent = 0;
                        // stop the interval
                        clearInterval(countdownInterval); countdownInterval = null;
                        // prevent the scheduled timeout from also firing
                        if(warningTimeout) { clearTimeout(warningTimeout); warningTimeout = null; }
                        if(bsModal) bsModal.hide();
                        performLogout();
                    } else {
                        countdownEl.textContent = secondsLeft;
                    }
                }, 1000);

                // schedule automatic logout after warning period as a backup (will be cleared when countdown reaches 0)
                warningTimeout = setTimeout(() => {
                    // if interval didn't already trigger, perform logout now
                    if(countdownInterval) { clearInterval(countdownInterval); countdownInterval = null; }
                    if(bsModal) bsModal.hide();
                    warningTimeout = null;
                    performLogout();
                }, WARNING_MS);
            }

            function hideWarning(){
                if(bsModal) bsModal.hide();
                clearWarningTimers();
            }

            function markActivity(e){
                if (e && e.isTrusted === false) return;
                lastActivity = Date.now();
                    if (DEBUG_IDLE) console.log('[idle] markActivity() lastActivity=', new Date(lastActivity).toISOString(), 'isTrusted=', e ? e.isTrusted : 'n/a');
            }

            // Periodic check to trigger the warning based on lastActivity
            setInterval(() => {
                if (warningShown) return;
                if (performedLogout) return;
                const idle = Date.now() - lastActivity;
                if (idle >= Math.max(0, INACTIVITY_MS - WARNING_MS)) {
                    showWarning();
                }
            }, 1000);

            ['mousemove','keydown','mousedown','touchstart','scroll'].forEach(evt => {
                document.addEventListener(evt, markActivity, { passive: true });
            });

            // Helper to reset activity and hide warning
            function resetIdleTimer(){
                markActivity();
                hideWarning();
            }

            // Stay signed in button
            if(stayBtn){
                stayBtn.addEventListener('click', () => {
                    resetIdleTimer();
                });
            }

            // Immediate logout button
            if(logoutNowBtn){
                logoutNowBtn.addEventListener('click', () => {
                    clearWarningTimers();
                    if(bsModal) bsModal.hide();
                    performLogout();
                });
            }

            // start the idle timer immediately
            // start the idle timer immediately
            resetIdleTimer();
        })();
    </script>

    <!-- Hidden logout form (fallback) -->
    <form id="inactivityLogoutForm" method="POST" action="{{ route('logout') }}" style="display:none;">
        @csrf
    </form>
</body>
</html>
