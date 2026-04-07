<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile — E-Agraryo Merkado</title>
    <link rel="icon" href="{{ asset('images/dar-logo.png') }}" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --green-900:#0d3b1e; --green-800:#145228; --green-700:#1a6932;
            --green-600:#1f803c; --green-500:#268f44; --green-400:#3aaa58;
            --green-200:#b7e5c4; --green-100:#e8f5ec; --green-50:#f4fbf6;
            --gold:#c8922a; --gold-light:#fdf3e0; --gold-mid:#f5d08a;
            --gray-50:#f8f9fa; --gray-100:#f1f3f5; --gray-200:#e9ecef;
            --gray-300:#dee2e6; --gray-400:#adb5bd; --gray-600:#6c757d;
            --text-main:#1a2332; --text-muted:#64748b;
            --shadow-sm:0 2px 8px rgba(13,59,30,0.06);
            --shadow-md:0 6px 24px rgba(13,59,30,0.10);
            --shadow-lg:0 16px 48px rgba(13,59,30,0.14);
            --radius:14px; --radius-sm:9px; --sidebar-w:260px;
        }
        *,*::before,*::after{box-sizing:border-box}
        body{font-family:'DM Sans',system-ui,sans-serif;background:var(--gray-100);color:var(--text-main);min-height:100vh}

        /* Animations */
        @keyframes fadeUp{from{opacity:0;transform:translateY(18px)}to{opacity:1;transform:translateY(0)}}
        @keyframes scaleIn{from{opacity:0;transform:scale(0.92)}to{opacity:1;transform:scale(1)}}
        @keyframes pulseRing{0%{box-shadow:0 0 0 0 rgba(31,128,60,.35)}70%{box-shadow:0 0 0 10px rgba(31,128,60,0)}100%{box-shadow:0 0 0 0 rgba(31,128,60,0)}}
        .fade-up{animation:fadeUp .45s ease both}
        .fade-up-d1{animation-delay:.07s}.fade-up-d2{animation-delay:.14s}
        .fade-up-d3{animation-delay:.21s}.fade-up-d4{animation-delay:.28s}
        .scale-in{animation:scaleIn .38s cubic-bezier(.34,1.56,.64,1) both}

        /* Navbar */
        .top-navbar{background:var(--green-900);height:62px;display:flex;align-items:center;padding:0 1.5rem;position:fixed;top:0;left:0;right:0;z-index:1040;box-shadow:0 2px 16px rgba(0,0,0,.25)}
        .navbar-brand-area{display:flex;align-items:center;gap:.65rem;text-decoration:none;flex-shrink:0}
        .navbar-brand-area img{height:38px;filter:brightness(1.15)}
        .navbar-system-title{font-family:'DM Serif Display',serif;font-size:1.18rem;color:#fff;letter-spacing:.01em;line-height:1.15}
        .navbar-system-sub{font-size:.68rem;color:var(--green-200);letter-spacing:.06em;text-transform:uppercase;font-weight:500}
        .navbar-page-badge{background:rgba(200,146,42,.18);border:1px solid rgba(200,146,42,.35);color:var(--gold-mid);font-size:.72rem;font-weight:600;letter-spacing:.05em;text-transform:uppercase;padding:3px 10px;border-radius:20px;margin-left:1rem}
        .navbar-divider{width:1px;height:28px;background:rgba(255,255,255,.12);margin:0 1.25rem}
        .navbar-right{margin-left:auto;display:flex;align-items:center;gap:.75rem}
        .nav-icon-btn{background:none;border:none;color:rgba(255,255,255,.75);font-size:1.15rem;cursor:pointer;padding:6px 8px;border-radius:8px;position:relative;transition:color .18s,background .18s}
        .nav-icon-btn:hover{color:#fff;background:rgba(255,255,255,.08)}
        .nav-notif-dot{position:absolute;top:5px;right:6px;width:8px;height:8px;background:var(--gold);border-radius:50%;border:2px solid var(--green-900)}
        .user-pill{display:flex;align-items:center;gap:.5rem;background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);border-radius:30px;padding:5px 12px 5px 6px;cursor:pointer;transition:background .18s;text-decoration:none}
        .user-pill:hover{background:rgba(255,255,255,.14)}
        .user-avatar{width:30px;height:30px;border-radius:50%;object-fit:cover;border:1.5px solid rgba(255,255,255,.25)}
        .user-pill-name{font-size:.82rem;font-weight:500;color:#fff}
        .user-pill-role{font-size:.65rem;color:var(--green-200)}

        /* Sidebar */
        .sidebar{position:fixed;top:62px;left:0;bottom:0;width:var(--sidebar-w);background:#fff;border-right:1px solid var(--gray-200);overflow-y:auto;z-index:1030;display:flex;flex-direction:column;box-shadow:var(--shadow-sm);transition:transform .28s cubic-bezier(.4,0,.2,1)}
        .sidebar-inner{padding:1.5rem 1rem;flex:1;display:flex;flex-direction:column}
        .sidebar-section-label{font-size:.65rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--gray-400);padding:0 .5rem;margin:1.4rem 0 .5rem}
        .sidebar-section-label:first-child{margin-top:0}
        .sidebar-link{display:flex;align-items:center;gap:.65rem;padding:.56rem .75rem;border-radius:var(--radius-sm);font-size:.875rem;font-weight:500;color:var(--gray-600);text-decoration:none;transition:all .18s;margin-bottom:2px;position:relative}
        .sidebar-link i{font-size:1rem;width:20px;text-align:center;flex-shrink:0}
        .sidebar-link:hover{background:var(--green-100);color:var(--green-700)}
        .sidebar-link.active{background:var(--green-100);color:var(--green-700);font-weight:600}
        .sidebar-link.active::before{content:'';position:absolute;left:-3px;top:20%;bottom:20%;width:4px;background:var(--green-600);border-radius:4px}
        .sidebar-link-badge{margin-left:auto;font-size:.65rem;font-weight:700;background:var(--green-100);color:var(--green-700);padding:2px 7px;border-radius:20px}
        .sidebar-link.active .sidebar-link-badge{background:var(--green-600);color:#fff}
        .sidebar-logout{margin-top:auto;padding-top:1rem;border-top:1px solid var(--gray-200)}
        .sidebar-logout .sidebar-link{color:#c0392b}
        .sidebar-logout .sidebar-link:hover{background:#fdf2f2}
        .sidebar-office-chip{background:var(--green-50);border:1px solid var(--green-200);border-radius:var(--radius-sm);padding:.65rem .85rem;margin-bottom:1rem}
        .sidebar-office-chip .office-label{font-size:.62rem;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:var(--green-600)}
        .sidebar-office-chip .office-name{font-size:.82rem;font-weight:600;color:var(--green-900);margin-top:1px}
        .sidebar::-webkit-scrollbar{width:4px}
        .sidebar::-webkit-scrollbar-thumb{background:var(--gray-200);border-radius:4px}

        /* Page */
        .page-wrapper{margin-left:var(--sidebar-w);margin-top:62px;min-height:calc(100vh - 62px);padding:2rem 2rem 4rem}
        .page-header{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:2rem;flex-wrap:wrap;gap:1rem}
        .page-header-title{font-family:'DM Serif Display',serif;font-size:1.6rem;color:var(--green-900);margin:0 0 2px;line-height:1.2}
        .page-header-sub{font-size:.85rem;color:var(--text-muted);margin:0}
        .header-date-chip{background:#fff;border:1px solid var(--gray-200);border-radius:var(--radius-sm);padding:6px 14px;font-size:.78rem;color:var(--gray-600);display:flex;align-items:center;gap:6px;box-shadow:var(--shadow-sm);white-space:nowrap}
        .section-title{font-size:.95rem;font-weight:700;color:var(--text-main);margin-bottom:1rem;display:flex;align-items:center;gap:.5rem}
        .section-title-bar{width:4px;height:18px;background:var(--green-600);border-radius:3px}

        /* Profile Hero */
        .profile-hero{background:#fff;border-radius:var(--radius);box-shadow:var(--shadow-md);border:1px solid var(--gray-200);overflow:hidden;margin-bottom:1.75rem}
        .profile-hero-banner{height:160px;position:relative;overflow:hidden;background:linear-gradient(135deg,var(--green-900) 0%,var(--green-700) 45%,var(--green-500) 100%)}
        .profile-hero-banner::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 120px 120px at 85% -20%,rgba(200,146,42,.18) 0%,transparent 70%),radial-gradient(ellipse 80px 80px at 10% 110%,rgba(255,255,255,.07) 0%,transparent 70%)}
        .profile-hero-banner::after{content:'';position:absolute;inset:0;background:url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.035'%3E%3Cpath d='M0 0h40v40H0zm40 40h40v40H40z'/%3E%3C/g%3E%3C/svg%3E")}
        .hero-gold-stripe{position:absolute;bottom:0;left:0;right:0;height:3px;background:linear-gradient(90deg,transparent,var(--gold),var(--gold-mid),var(--gold),transparent);opacity:.7;z-index:1}
        .profile-hero-body{padding:0 2rem 1.75rem;display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:1rem}
        .profile-left{display:flex;align-items:flex-end;gap:1.25rem;flex-wrap:wrap}
        .profile-avatar-wrap{margin-top:-52px;position:relative;flex-shrink:0}
        .profile-avatar-img{width:104px;height:104px;border-radius:50%;object-fit:cover;border:4px solid #fff;box-shadow:0 6px 20px rgba(13,59,30,.22);transition:transform .3s,box-shadow .3s}
        .profile-avatar-img:hover{transform:scale(1.04);box-shadow:0 10px 28px rgba(13,59,30,.28)}
        .profile-avatar-edit{position:absolute;bottom:4px;right:4px;width:28px;height:28px;border-radius:50%;background:var(--green-600);border:2.5px solid #fff;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:background .18s,transform .18s;animation:pulseRing 2.5s ease-out 1.5s 3}
        .profile-avatar-edit:hover{background:var(--green-700);transform:scale(1.1)}
        .profile-avatar-edit i{font-size:.65rem;color:#fff}
        .profile-hero-info{padding-top:.85rem}
        .profile-hero-name{font-family:'DM Serif Display',serif;font-size:1.5rem;color:var(--green-900);margin:0 0 5px;line-height:1.2}
        .profile-hero-meta{display:flex;align-items:center;gap:.5rem;flex-wrap:wrap;margin-bottom:.5rem}
        .role-pill{display:inline-flex;align-items:center;gap:4px;background:var(--green-100);color:var(--green-700);font-size:.72rem;font-weight:700;padding:3px 10px;border-radius:20px}
        .org-pill{display:inline-flex;align-items:center;gap:4px;background:var(--gold-light);color:var(--gold);font-size:.72rem;font-weight:600;padding:3px 10px;border-radius:20px}
        .profile-hero-tagline{font-size:.82rem;color:var(--text-muted);margin:0}
        .profile-hero-actions{display:flex;gap:.6rem;flex-wrap:wrap;padding-top:.85rem;align-items:center}

        /* Buttons */
        .btn-green{background:var(--green-600);color:#fff;border:none;padding:9px 20px;border-radius:var(--radius-sm);font-size:.83rem;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:6px;transition:background .18s,box-shadow .18s,transform .15s;text-decoration:none;letter-spacing:.01em}
        .btn-green:hover{background:var(--green-700);color:#fff;box-shadow:0 5px 16px rgba(31,128,60,.28);transform:translateY(-1px)}
        .btn-green:active{transform:translateY(0)}
        .btn-outline-green{background:#fff;color:var(--green-700);border:1.5px solid var(--green-200);padding:8px 18px;border-radius:var(--radius-sm);font-size:.83rem;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:6px;transition:all .18s;text-decoration:none}
        .btn-outline-green:hover{background:var(--green-50);border-color:var(--green-500);color:var(--green-800);transform:translateY(-1px)}
        .btn-ghost{background:none;color:var(--text-muted);border:none;padding:8px 14px;border-radius:var(--radius-sm);font-size:.83rem;font-weight:500;cursor:pointer;display:inline-flex;align-items:center;gap:6px;transition:all .18s;text-decoration:none}
        .btn-ghost:hover{background:var(--gray-100);color:var(--text-main)}

        /* Mini Stats */
        .mini-stat{background:#fff;border-radius:var(--radius);box-shadow:var(--shadow-sm);border:1px solid var(--gray-200);padding:1.1rem 1.3rem;display:flex;align-items:center;gap:.9rem;transition:box-shadow .22s,transform .22s,border-color .22s;position:relative;overflow:hidden}
        .mini-stat::after{content:'';position:absolute;top:0;left:0;right:0;height:3px;opacity:0;transition:opacity .22s;border-radius:var(--radius) var(--radius) 0 0}
        .mini-stat:hover{box-shadow:var(--shadow-md);transform:translateY(-4px);border-color:var(--green-200)}
        .mini-stat:hover::after{opacity:1}
        .ms-ga::after{background:var(--green-600)}.ms-ta::after{background:#0d8a7e}.ms-ba::after{background:#1a73e8}.ms-oa::after{background:var(--gold)}
        .mini-stat-icon{width:46px;height:46px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:1.2rem;flex-shrink:0}
        .ms-green{background:var(--green-100);color:var(--green-700)}.ms-teal{background:#e0f7f5;color:#0d8a7e}.ms-blue{background:#e8f0fe;color:#1a73e8}.ms-gold{background:var(--gold-light);color:var(--gold)}
        .mini-stat-value{font-size:1.65rem;font-weight:700;color:var(--text-main);line-height:1;margin-bottom:2px}
        .mini-stat-label{font-size:.76rem;color:var(--text-muted);font-weight:500}

        /* Tab nav */
        .profile-tabs{display:flex;gap:4px;background:#fff;border:1px solid var(--gray-200);border-radius:var(--radius);padding:5px;box-shadow:var(--shadow-sm);margin-bottom:1.5rem;overflow-x:auto}
        .profile-tab{display:flex;align-items:center;gap:7px;padding:9px 18px;border-radius:var(--radius-sm);font-size:.84rem;font-weight:600;color:var(--text-muted);background:none;border:none;cursor:pointer;transition:all .2s;white-space:nowrap;flex-shrink:0;text-decoration:none}
        .profile-tab i{font-size:.95rem}
        .profile-tab:hover{background:var(--green-50);color:var(--green-700)}
        .profile-tab.active{background:var(--green-600);color:#fff;box-shadow:0 3px 10px rgba(31,128,60,.22)}

        /* Info Card */
        .info-card{background:#fff;border-radius:var(--radius);box-shadow:var(--shadow-sm);border:1px solid var(--gray-200);overflow:hidden}
        .info-card-header{padding:1.1rem 1.5rem .9rem;border-bottom:1px solid var(--gray-100);display:flex;align-items:center;justify-content:space-between;gap:.5rem}
        .info-card-title{font-size:.88rem;font-weight:700;color:var(--text-main);margin:0;display:flex;align-items:center;gap:.45rem}
        .info-card-title i{color:var(--green-600)}
        .info-card-body{padding:1.25rem 1.5rem}

        /* Info Row */
        .info-row{display:flex;align-items:flex-start;gap:.85rem;padding:.75rem 0;border-bottom:1px solid var(--gray-100)}
        .info-row:last-child{border-bottom:none;padding-bottom:0}
        .info-row-icon{width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:.92rem;flex-shrink:0;margin-top:1px}
        .ir-green{background:var(--green-100);color:var(--green-700)}.ir-gold{background:var(--gold-light);color:var(--gold)}.ir-blue{background:#e8f0fe;color:#1a73e8}.ir-teal{background:#e0f7f5;color:#0d8a7e}
        .info-row-label{font-size:.7rem;color:var(--text-muted);font-weight:600;margin-bottom:3px;text-transform:uppercase;letter-spacing:.04em}
        .info-row-value{font-size:.88rem;font-weight:600;color:var(--text-main)}
        .info-row-value a{color:var(--green-700);text-decoration:none}.info-row-value a:hover{text-decoration:underline}

        /* Timeline */
        .timeline{list-style:none;padding:0;margin:0}
        .timeline-item{display:flex;gap:.9rem;padding:.9rem 1.5rem;border-bottom:1px solid var(--gray-100);align-items:flex-start;transition:background .14s}
        .timeline-item:last-child{border-bottom:none}
        .timeline-item:hover{background:var(--gray-50)}
        .timeline-dot{width:34px;height:34px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:.88rem;flex-shrink:0}
        .td-green{background:var(--green-100);color:var(--green-700)}.td-gold{background:var(--gold-light);color:var(--gold)}.td-blue{background:#e8f0fe;color:#1a73e8}.td-teal{background:#e0f7f5;color:#0d8a7e}
        .timeline-title{font-size:.84rem;font-weight:600;color:var(--text-main);margin-bottom:2px}
        .timeline-meta{font-size:.73rem;color:var(--text-muted)}

        /* Badges */
        .status-badge{display:inline-flex;align-items:center;gap:5px;padding:3px 10px;border-radius:20px;font-size:.72rem;font-weight:600}
        .status-active{background:var(--green-100);color:var(--green-700)}.status-pending{background:var(--gold-light);color:var(--gold)}.status-inactive{background:#fdecea;color:#c0392b}.status-completed{background:#e8f0fe;color:#1a73e8}
        .status-dot{width:6px;height:6px;border-radius:50%;display:inline-block}
        .status-active .status-dot{background:var(--green-600)}.status-pending .status-dot{background:var(--gold)}.status-inactive .status-dot{background:#c0392b}.status-completed .status-dot{background:#1a73e8}

        /* Forms */
        .form-label-custom{font-size:.73rem;font-weight:700;color:var(--text-muted);margin-bottom:5px;display:block;text-transform:uppercase;letter-spacing:.055em}
        .form-control-custom{border:1.5px solid var(--gray-200);border-radius:var(--radius-sm);padding:10px 14px;font-size:.875rem;font-family:'DM Sans',sans-serif;color:var(--text-main);background:#fff;width:100%;transition:border-color .18s,box-shadow .18s;outline:none}
        .form-control-custom:focus{border-color:var(--green-500);box-shadow:0 0 0 3px rgba(31,128,60,.1)}
        .form-control-custom::placeholder{color:var(--gray-400)}
        .form-control-custom:disabled{background:var(--gray-50);color:var(--gray-600)}
        textarea.form-control-custom{resize:vertical;min-height:90px;line-height:1.55}
        .form-hint{font-size:.72rem;color:var(--text-muted);margin-top:4px}
        .form-section-divider{border:none;border-top:1px solid var(--gray-100);margin:1.25rem 0}
        .input-pw-wrap{position:relative}
        .input-pw-wrap .form-control-custom{padding-right:44px}
        .pw-toggle{position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;color:var(--gray-400);cursor:pointer;font-size:1rem;padding:0;display:flex;align-items:center;transition:color .18s}
        .pw-toggle:hover{color:var(--green-700)}
        .pw-strength-bar{height:4px;border-radius:4px;background:var(--gray-200);margin-top:6px;overflow:hidden}
        .pw-strength-fill{height:100%;border-radius:4px;transition:width .35s ease,background .35s;width:0%}

        /* Avatar upload */
        .avatar-upload-zone{border:2px dashed var(--gray-300);border-radius:var(--radius);padding:1.5rem;text-align:center;cursor:pointer;transition:border-color .2s,background .2s;display:block}
        .avatar-upload-zone:hover{border-color:var(--green-400);background:var(--green-50)}
        .avatar-upload-zone i{font-size:1.8rem;color:var(--gray-400);margin-bottom:.5rem;display:block;transition:color .2s}
        .avatar-upload-zone:hover i{color:var(--green-600)}
        .avatar-upload-zone p{font-size:.8rem;color:var(--text-muted);margin:0}
        .avatar-upload-zone strong{color:var(--green-700)}

        /* Security score */
        .security-score-ring{width:80px;height:80px;flex-shrink:0;position:relative;display:flex;align-items:center;justify-content:center}
        .security-score-ring svg{position:absolute;top:0;left:0}
        .security-score-num{font-size:1.3rem;font-weight:700;color:var(--green-700)}
        .security-score-label{font-size:.62rem;color:var(--text-muted);font-weight:600;text-transform:uppercase;letter-spacing:.04em}

        /* Toggle */
        .toggle-switch{position:relative;display:inline-block;width:44px;height:24px;flex-shrink:0}
        .toggle-switch input{opacity:0;width:0;height:0}
        .toggle-slider{position:absolute;cursor:pointer;inset:0;background:var(--gray-300);border-radius:24px;transition:background .25s}
        .toggle-slider::before{content:'';position:absolute;height:18px;width:18px;left:3px;bottom:3px;background:#fff;border-radius:50%;transition:transform .25s;box-shadow:0 1px 3px rgba(0,0,0,.15)}
        .toggle-switch input:checked+.toggle-slider{background:var(--green-600)}
        .toggle-switch input:checked+.toggle-slider::before{transform:translateX(20px)}

        /* Notif prefs */
        .notif-pref-row{display:flex;align-items:center;justify-content:space-between;padding:.8rem 0;border-bottom:1px solid var(--gray-100);gap:1rem}
        .notif-pref-row:last-child{border-bottom:none;padding-bottom:0}
        .notif-pref-label{font-size:.84rem;font-weight:600;color:var(--text-main);margin-bottom:2px}
        .notif-pref-sub{font-size:.73rem;color:var(--text-muted)}

        /* Tip item */
        .tip-item{display:flex;gap:.65rem;align-items:flex-start;padding:.55rem 0;border-bottom:1px solid var(--gray-100)}
        .tip-item:last-child{border-bottom:none}
        .tip-icon{width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0}
        .tip-text{font-size:.8rem;color:var(--text-muted);margin:0;padding-top:4px}

        /* Tab panels */
        .tab-panel{display:none}
        .tab-panel.active{display:block;animation:fadeUp .35s ease both}

        /* Mobile */
        .mobile-sidebar-toggle{display:none;background:none;border:none;color:#fff;font-size:1.3rem;margin-right:.75rem;cursor:pointer}
        @media(max-width:991.98px){
            .sidebar{transform:translateX(-100%)}.sidebar.show{transform:translateX(0)}
            .page-wrapper{margin-left:0;padding:1.25rem 1rem 3rem}
            .mobile-sidebar-toggle{display:block}.navbar-page-badge{display:none}
            .sidebar-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.4);z-index:1029}
            .sidebar-overlay.show{display:block}
        }
        @media(max-width:575.98px){
            .profile-hero-body{padding:0 1.25rem 1.25rem}
            .profile-tabs{gap:2px;padding:4px}
            .profile-tab{padding:8px 12px;font-size:.78rem}
        }
    </style>
</head>
<body>

<!-- Navbar -->
<header class="top-navbar">
    <button class="mobile-sidebar-toggle" id="sidebarToggle"><i class="bi bi-list"></i></button>
    <a class="navbar-brand-area" href="{{ url('/arbo/dashboard') }}">
        <img src="{{ asset('images/dar-logo.png') }}" alt="DAR Logo">
        <div>
            <div class="navbar-system-title">E-Agraryo Merkado</div>
            <div class="navbar-system-sub">DAR Region V</div>
        </div>
    </a>
    <span class="navbar-page-badge"><i class="bi bi-person me-1"></i> Profile</span>
    <div class="navbar-right">
        <div class="dropdown">
            <button class="nav-icon-btn" data-bs-toggle="dropdown"><i class="bi bi-bell"></i><span class="nav-notif-dot"></span></button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" style="min-width:280px;border-radius:12px;margin-top:8px;">
                <li class="px-3 py-2 border-bottom"><span class="fw-bold" style="font-size:.82rem;">Notifications</span></li>
                <li><a class="dropdown-item py-2" href="#" style="font-size:.82rem;"><i class="bi bi-cart-plus text-success me-2"></i>New order received<div class="text-muted" style="font-size:.72rem;padding-left:1.4rem;">Just now</div></a></li>
                <li><a class="dropdown-item py-2" href="#" style="font-size:.82rem;"><i class="bi bi-box-seam text-primary me-2"></i>Seller added product<div class="text-muted" style="font-size:.72rem;padding-left:1.4rem;">1 hour ago</div></a></li>
                <li class="border-top"><a class="dropdown-item text-center py-2" href="#" style="font-size:.78rem;color:var(--green-700);">View all notifications</a></li>
            </ul>
        </div>
        <div class="navbar-divider d-none d-sm-block"></div>
        <div class="dropdown">
            <a class="user-pill dropdown-toggle" href="#" data-bs-toggle="dropdown">
                <img class="user-avatar" src="{{ optional(auth()->user())->avatar ?: 'https://ui-avatars.com/api/?name='.urlencode(optional(auth()->user())->name ?? 'ARBO Admin').'&background=1a6932&color=fff&rounded=true&size=64' }}" alt="avatar">
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

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Sidebar -->
<aside class="sidebar" id="mainSidebar">
    <div class="sidebar-inner">
        <div class="sidebar-office-chip">
            <div class="office-label">ARBO Organization</div>
            <div class="office-name">{{ optional(auth()->user())->arbo_name ?? 'Your ARBO' }}</div>
        </div>
        <span class="sidebar-section-label">Main Menu</span>
        <a href="{{ url('/arbo/dashboard') }}" class="sidebar-link"><i class="bi bi-speedometer2"></i>Dashboard</a>
        
        <span class="sidebar-section-label">Marketplace</span>
        <a href="{{ url('/arbo/products') }}" class="sidebar-link"><i class="bi bi-box-seam"></i>Products<span class="sidebar-link-badge">{{ $totalProducts ?? '0' }}</span></a>
        <a href="{{ url('/arbo/orders') }}" class="sidebar-link"><i class="bi bi-cart-check"></i>Orders<span class="sidebar-link-badge">{{ $totalOrders ?? '0' }}</span></a>
        <span class="sidebar-section-label">Reports</span>
        <a href="{{ url('/arbo/reports') }}" class="sidebar-link"><i class="bi bi-bar-chart-line"></i>Sales Reports</a>
        <span class="sidebar-section-label">Account</span>
        <a href="{{ url('/arbo/profile') }}" class="sidebar-link active"><i class="bi bi-person"></i>Profile</a>
        <div class="sidebar-logout">
            <form method="POST" action="{{ url('/logout') }}">
                @csrf
                <button type="submit" class="sidebar-link w-100 text-start border-0 bg-transparent"><i class="bi bi-box-arrow-right"></i>Logout</button>
            </form>
        </div>
    </div>
</aside>

<!-- Main -->
<main class="page-wrapper">

    <div class="page-header fade-up">
        <div>
            <h1 class="page-header-title">My Profile</h1>
            <p class="page-header-sub">View and manage your account details, security settings, and preferences.</p>
        </div>
        <div class="header-date-chip"><i class="bi bi-calendar3"></i><span id="currentDate"></span></div>
    </div>

    <!-- Profile Hero -->
    <div class="profile-hero fade-up fade-up-d1">
        <div class="profile-hero-banner">
            <div class="hero-gold-stripe"></div>
        </div>
        <div class="profile-hero-body">
            <div class="profile-left">
                <div class="profile-avatar-wrap scale-in">
                    <img class="profile-avatar-img" id="avatarPreview"
                        src="{{ optional(auth()->user())->avatar ?: 'https://ui-avatars.com/api/?name='.urlencode(optional(auth()->user())->name ?? 'ARBO Admin').'&background=1a6932&color=fff&rounded=true&size=200' }}"
                        alt="Profile photo">
                    <div class="profile-avatar-edit" onclick="switchTab('photo')" title="Change photo">
                        <i class="bi bi-camera-fill"></i>
                    </div>
                </div>
                <div class="profile-hero-info">
                    <h2 class="profile-hero-name">{{ optional(auth()->user())->name ?? 'ARBO Admin' }}</h2>
                    <div class="profile-hero-meta">
                        <span class="role-pill"><i class="bi bi-shield-fill-check"></i> ARBO Admin</span>
                        <span class="org-pill"><i class="bi bi-building"></i> {{ optional(auth()->user())->arbo_name ?? 'ARBO Org' }}</span>
                        <span class="status-badge status-active"><span class="status-dot"></span> Active</span>
                    </div>
                    <p class="profile-hero-tagline">
                        <i class="bi bi-geo-alt me-1" style="color:var(--green-500)"></i>DAR Region V — Bicol &nbsp;·&nbsp;
                        <i class="bi bi-envelope me-1" style="color:var(--green-500)"></i>{{ optional(auth()->user())->email ?? 'admin@agraryo.gov.ph' }}
                    </p>
                </div>
            </div>
            <div class="profile-hero-actions">
                <button class="btn-outline-green" onclick="switchTab('overview')"><i class="bi bi-eye"></i> Overview</button>
                <button class="btn-green" onclick="switchTab('edit')"><i class="bi bi-pencil"></i> Edit Profile</button>
            </div>
        </div>
    </div>

    <!-- Mini Stats -->
    <div class="row g-3 mb-4 fade-up fade-up-d2">
        <div class="col-6 col-md-3">
            <div class="mini-stat ms-ga">
                <div class="mini-stat-icon ms-green"><i class="bi bi-shop-window"></i></div>
                <div><div class="mini-stat-value">{{ $totalSellers ?? '—' }}</div><div class="mini-stat-label">Sellers Managed</div></div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="mini-stat ms-ta">
                <div class="mini-stat-icon ms-teal"><i class="bi bi-people-fill"></i></div>
                <div><div class="mini-stat-value">{{ $totalBuyers ?? '—' }}</div><div class="mini-stat-label">Buyers Registered</div></div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="mini-stat ms-ba">
                <div class="mini-stat-icon ms-blue"><i class="bi bi-box-seam-fill"></i></div>
                <div><div class="mini-stat-value">{{ $totalProducts ?? '—' }}</div><div class="mini-stat-label">Products Listed</div></div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="mini-stat ms-oa">
                <div class="mini-stat-icon ms-gold"><i class="bi bi-cart-check-fill"></i></div>
                <div><div class="mini-stat-value">{{ $totalOrders ?? '—' }}</div><div class="mini-stat-label">Orders Processed</div></div>
            </div>
        </div>
    </div>

    <!-- Tab Nav -->
    <div class="profile-tabs fade-up fade-up-d3">
        <button class="profile-tab active" id="tab-overview"      onclick="switchTab('overview')"><i class="bi bi-person-circle"></i> Overview</button>
        <button class="profile-tab"        id="tab-edit"          onclick="switchTab('edit')"><i class="bi bi-pencil-square"></i> Edit Profile</button>
        <button class="profile-tab"        id="tab-security"      onclick="switchTab('security')"><i class="bi bi-shield-lock"></i> Security</button>
        <button class="profile-tab"        id="tab-photo"         onclick="switchTab('photo')"><i class="bi bi-camera"></i> Photo</button>
        <button class="profile-tab"        id="tab-notifications" onclick="switchTab('notifications')"><i class="bi bi-bell"></i> Notifications</button>
    </div>

    <!-- TAB: Overview -->
    <div class="tab-panel active" id="panel-overview">
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="section-title"><div class="section-title-bar"></div>Personal Details</div>
                <div class="info-card mb-3">
                    <div class="info-card-header">
                        <h6 class="info-card-title"><i class="bi bi-person-fill"></i> Personal Information</h6>
                        <button class="btn-ghost" style="font-size:.78rem;padding:5px 10px;" onclick="switchTab('edit')"><i class="bi bi-pencil me-1"></i>Edit</button>
                    </div>
                    <div class="info-card-body">
                        <div class="info-row">
                            <div class="info-row-icon ir-green"><i class="bi bi-person-fill"></i></div>
                            <div><div class="info-row-label">Full Name</div><div class="info-row-value">{{ optional(auth()->user())->name ?? '—' }}</div></div>
                        </div>
                        <div class="info-row">
                            <div class="info-row-icon ir-blue"><i class="bi bi-envelope-fill"></i></div>
                            <div><div class="info-row-label">Email Address</div><div class="info-row-value"><a href="mailto:{{ optional(auth()->user())->email }}">{{ optional(auth()->user())->email ?? '—' }}</a></div></div>
                        </div>
                        <div class="info-row">
                            <div class="info-row-icon ir-teal"><i class="bi bi-telephone-fill"></i></div>
                            <div><div class="info-row-label">Phone Number</div><div class="info-row-value">{{ optional(auth()->user())->phone ?? '—' }}</div></div>
                        </div>
                        <div class="info-row">
                            <div class="info-row-icon ir-gold"><i class="bi bi-geo-alt-fill"></i></div>
                            <div><div class="info-row-label">Address</div><div class="info-row-value">{{ optional(auth()->user())->address ?? '—' }}</div></div>
                        </div>
                        <div class="info-row">
                            <div class="info-row-icon ir-green"><i class="bi bi-calendar2-check"></i></div>
                            <div><div class="info-row-label">Member Since</div><div class="info-row-value">{{ optional(auth()->user())->created_at ? \Carbon\Carbon::parse(auth()->user()->created_at)->format('F d, Y') : '—' }}</div></div>
                        </div>
                    </div>
                </div>
                <div class="section-title"><div class="section-title-bar"></div>ARBO Organization</div>
                <div class="info-card">
                    <div class="info-card-header">
                        <h6 class="info-card-title"><i class="bi bi-building"></i> Organization Details</h6>
                    </div>
                    <div class="info-card-body">
                        <div class="info-row">
                            <div class="info-row-icon ir-green"><i class="bi bi-building-fill"></i></div>
                            <div><div class="info-row-label">ARBO Name</div><div class="info-row-value">{{ optional(auth()->user())->arbo_name ?? '—' }}</div></div>
                        </div>
                        <div class="info-row">
                            <div class="info-row-icon ir-blue"><i class="bi bi-hash"></i></div>
                            <div><div class="info-row-label">ARBO Code</div><div class="info-row-value">{{ optional(auth()->user())->arbo_code ?? '—' }}</div></div>
                        </div>
                        <div class="info-row">
                            <div class="info-row-icon ir-gold"><i class="bi bi-map-fill"></i></div>
                            <div><div class="info-row-label">Region</div><div class="info-row-value">DAR Region V — Bicol</div></div>
                        </div>
                        <div class="info-row">
                            <div class="info-row-icon ir-teal"><i class="bi bi-shield-fill-check"></i></div>
                            <div><div class="info-row-label">Role</div><div class="info-row-value">ARBO Administrator</div></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="section-title"><div class="section-title-bar"></div>Recent Activity</div>
                <div class="info-card">
                    <div class="info-card-header">
                        <h6 class="info-card-title"><i class="bi bi-clock-history"></i> Activity Log</h6>
                        <a href="{{ url('/arbo/reports') }}" class="btn-ghost" style="font-size:.78rem;padding:5px 10px;"><i class="bi bi-arrow-right me-1"></i>Reports</a>
                    </div>
                    <ul class="timeline">
                        <li class="timeline-item">
                            <div class="timeline-dot td-green"><i class="bi bi-cart-check-fill"></i></div>
                            <div style="flex:1"><div class="timeline-title">Order #2047 marked as completed</div><div class="timeline-meta">Buyer: Ana Cruz · 1 hour ago</div></div>
                            <span class="status-badge status-completed" style="flex-shrink:0"><span class="status-dot"></span>Done</span>
                        </li>
                        <li class="timeline-item">
                            <div class="timeline-dot td-blue"><i class="bi bi-box-seam-fill"></i></div>
                            <div style="flex:1"><div class="timeline-title">Product listing approved — White Rice</div><div class="timeline-meta">Seller: Juan dela Cruz · 2 hours ago</div></div>
                            <span class="status-badge status-active" style="flex-shrink:0"><span class="status-dot"></span>Live</span>
                        </li>
                        <li class="timeline-item">
                            <div class="timeline-dot td-teal"><i class="bi bi-person-fill-add"></i></div>
                            <div><div class="timeline-title">New buyer registered</div><div class="timeline-meta">Mark Lim · 3 hours ago</div></div>
                        </li>
                        <li class="timeline-item">
                            <div class="timeline-dot td-gold"><i class="bi bi-pencil-fill"></i></div>
                            <div><div class="timeline-title">Updated Yellow Corn price</div><div class="timeline-meta">Seller: Maria Santos · Yesterday</div></div>
                        </li>
                        <li class="timeline-item">
                            <div class="timeline-dot td-green"><i class="bi bi-person-plus-fill"></i></div>
                            <div><div class="timeline-title">New seller onboarded — Ana Villanueva</div><div class="timeline-meta">ARBO Admin · 2 days ago</div></div>
                        </li>
                        <li class="timeline-item">
                            <div class="timeline-dot td-blue"><i class="bi bi-bar-chart-fill"></i></div>
                            <div><div class="timeline-title">Monthly sales report generated</div><div class="timeline-meta">February 2026 · 3 days ago</div></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- TAB: Edit Profile -->
    <div class="tab-panel" id="panel-edit">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="info-card">
                    <div class="info-card-header">
                        <h6 class="info-card-title"><i class="bi bi-pencil-square"></i> Update Personal Information</h6>
                    </div>
                    <div class="info-card-body">
                        <form method="POST" action="{{ url('/arbo/profile/update') }}">
                            @csrf @method('PUT')
                            <p style="font-size:.78rem;color:var(--text-muted);margin-bottom:1.25rem;">Fields marked <span style="color:#c0392b;">*</span> are required.</p>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label-custom">Full Name <span style="color:#c0392b">*</span></label>
                                    <input type="text" name="name" class="form-control-custom" value="{{ optional(auth()->user())->name }}" placeholder="Juan dela Cruz" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom">Email Address <span style="color:#c0392b">*</span></label>
                                    <input type="email" name="email" class="form-control-custom" value="{{ optional(auth()->user())->email }}" placeholder="you@example.com" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom">Phone Number</label>
                                    <input type="text" name="phone" class="form-control-custom" value="{{ optional(auth()->user())->phone }}" placeholder="+63 9XX XXX XXXX">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom">ARBO Name</label>
                                    <input type="text" name="arbo_name" class="form-control-custom" value="{{ optional(auth()->user())->arbo_name }}" placeholder="Your ARBO organization">
                                </div>
                                <div class="col-12">
                                    <label class="form-label-custom">Complete Address</label>
                                    <input type="text" name="address" class="form-control-custom" value="{{ optional(auth()->user())->address }}" placeholder="Barangay, Municipality, Province">
                                </div>
                            </div>
                            <hr class="form-section-divider">
                            <p style="font-size:.78rem;font-weight:700;color:var(--text-muted);text-transform:uppercase;letter-spacing:.05em;margin-bottom:.85rem;">ARBO Information</p>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label-custom">ARBO Code</label>
                                    <input type="text" name="arbo_code" class="form-control-custom" value="{{ optional(auth()->user())->arbo_code }}" placeholder="e.g. ARB-RV-001">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom">Region</label>
                                    <input type="text" class="form-control-custom" value="DAR Region V — Bicol" disabled>
                                </div>
                                <div class="col-12">
                                    <label class="form-label-custom">Bio / Description</label>
                                    <textarea name="bio" class="form-control-custom" placeholder="Brief description about yourself or your ARBO...">{{ optional(auth()->user())->bio }}</textarea>
                                    <div class="form-hint">Visible on your public ARBO profile.</div>
                                </div>
                            </div>
                            <div class="d-flex gap-2 mt-4 flex-wrap">
                                <button type="submit" class="btn-green"><i class="bi bi-check-lg"></i> Save Changes</button>
                                <button type="reset" class="btn-outline-green"><i class="bi bi-arrow-counterclockwise"></i> Reset</button>
                                <button type="button" class="btn-ghost" onclick="switchTab('overview')">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="info-card">
                    <div class="info-card-header"><h6 class="info-card-title"><i class="bi bi-lightbulb-fill"></i> Profile Tips</h6></div>
                    <div class="info-card-body" style="padding-top:.85rem;padding-bottom:.85rem;">
                        <div class="tip-item">
                            <div class="tip-icon" style="background:var(--green-100)"><i class="bi bi-check2" style="color:var(--green-600);font-size:.85rem"></i></div>
                            <p class="tip-text">Use your full legal name as registered with DAR.</p>
                        </div>
                        <div class="tip-item">
                            <div class="tip-icon" style="background:var(--green-100)"><i class="bi bi-check2" style="color:var(--green-600);font-size:.85rem"></i></div>
                            <p class="tip-text">Keep your phone number updated for order notifications.</p>
                        </div>
                        <div class="tip-item">
                            <div class="tip-icon" style="background:var(--gold-light)"><i class="bi bi-exclamation" style="color:var(--gold);font-size:.9rem"></i></div>
                            <p class="tip-text">Changing your email requires re-verification before you can log in.</p>
                        </div>
                        <div class="tip-item">
                            <div class="tip-icon" style="background:#e8f0fe"><i class="bi bi-info" style="color:#1a73e8;font-size:.9rem"></i></div>
                            <p class="tip-text">Your ARBO code is assigned by DAR. Contact support if it's incorrect.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TAB: Security -->
    <div class="tab-panel" id="panel-security">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="section-title"><div class="section-title-bar"></div>Change Password</div>
                <div class="info-card">
                    <div class="info-card-header"><h6 class="info-card-title"><i class="bi bi-lock-fill"></i> Update Password</h6></div>
                    <div class="info-card-body">
                        <form method="POST" action="{{ url('/arbo/profile/password') }}">
                            @csrf @method('PUT')
                            <div style="margin-bottom:1.1rem">
                                <label class="form-label-custom">Current Password</label>
                                <div class="input-pw-wrap">
                                    <input type="password" name="current_password" id="pw_current" class="form-control-custom" placeholder="Enter current password">
                                    <button type="button" class="pw-toggle" onclick="togglePw('pw_current',this)"><i class="bi bi-eye"></i></button>
                                </div>
                            </div>
                            <div style="margin-bottom:1.1rem">
                                <label class="form-label-custom">New Password</label>
                                <div class="input-pw-wrap">
                                    <input type="password" name="password" id="pw_new" class="form-control-custom" placeholder="At least 8 characters" oninput="updatePwStrength(this.value)">
                                    <button type="button" class="pw-toggle" onclick="togglePw('pw_new',this)"><i class="bi bi-eye"></i></button>
                                </div>
                                <div class="pw-strength-bar"><div class="pw-strength-fill" id="pwStrengthFill"></div></div>
                                <div class="form-hint" id="pwStrengthLabel">Enter a new password</div>
                            </div>
                            <div style="margin-bottom:1.1rem">
                                <label class="form-label-custom">Confirm New Password</label>
                                <div class="input-pw-wrap">
                                    <input type="password" name="password_confirmation" id="pw_confirm" class="form-control-custom" placeholder="Repeat new password">
                                    <button type="button" class="pw-toggle" onclick="togglePw('pw_confirm',this)"><i class="bi bi-eye"></i></button>
                                </div>
                            </div>
                            <button type="submit" class="btn-green"><i class="bi bi-lock"></i> Update Password</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="section-title"><div class="section-title-bar"></div>Security Settings</div>
                <div class="info-card mb-3">
                    <div class="info-card-header"><h6 class="info-card-title"><i class="bi bi-shield-check"></i> Security Score</h6></div>
                    <div class="info-card-body">
                        <div style="display:flex;align-items:center;gap:1.25rem">
                            <div class="security-score-ring">
                                <svg width="80" height="80" viewBox="0 0 80 80">
                                    <circle cx="40" cy="40" r="33" fill="none" stroke="var(--gray-200)" stroke-width="7"/>
                                    <circle cx="40" cy="40" r="33" fill="none" stroke="var(--green-500)" stroke-width="7"
                                        stroke-dasharray="207.3" stroke-dashoffset="62" stroke-linecap="round"
                                        transform="rotate(-90 40 40)"/>
                                </svg>
                                <div style="text-align:center">
                                    <div class="security-score-num">70</div>
                                    <div class="security-score-label">/ 100</div>
                                </div>
                            </div>
                            <div>
                                <p style="font-size:.88rem;font-weight:700;color:var(--green-800);margin:0 0 4px">Good</p>
                                <p style="font-size:.78rem;color:var(--text-muted);margin:0">Enable 2FA and update your password regularly to improve your security score.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="info-card mb-3">
                    <div class="info-card-header">
                        <h6 class="info-card-title"><i class="bi bi-phone-fill"></i> Two-Factor Authentication</h6>
                        <span class="status-badge status-pending"><span class="status-dot"></span>Disabled</span>
                    </div>
                    <div class="info-card-body">
                        <div style="display:flex;align-items:center;justify-content:space-between;gap:1rem">
                            <div>
                                <p style="font-size:.84rem;font-weight:600;margin:0 0 3px">Enable 2FA</p>
                                <p style="font-size:.76rem;color:var(--text-muted);margin:0">Adds an extra layer of security via SMS or authenticator app.</p>
                            </div>
                            <label class="toggle-switch">
                                <input type="checkbox" id="twoFaToggle">
                                <span class="toggle-slider"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="info-card">
                    <div class="info-card-header"><h6 class="info-card-title"><i class="bi bi-activity"></i> Login Sessions</h6></div>
                    <div class="info-card-body" style="padding-top:.75rem;padding-bottom:.75rem">
                        <div class="info-row" style="padding:.55rem 0">
                            <div class="info-row-icon ir-green"><i class="bi bi-laptop"></i></div>
                            <div style="flex:1">
                                <div class="info-row-label">Current Session</div>
                                <div class="info-row-value" style="font-size:.82rem">Windows · Chrome · Naga, Camarines Sur</div>
                            </div>
                            <span class="status-badge status-active" style="flex-shrink:0"><span class="status-dot"></span>Active</span>
                        </div>
                        <div class="info-row" style="padding:.55rem 0">
                            <div class="info-row-icon ir-blue"><i class="bi bi-phone"></i></div>
                            <div style="flex:1">
                                <div class="info-row-label">Mobile</div>
                                <div class="info-row-value" style="font-size:.82rem">Android · Chrome · 2 days ago</div>
                            </div>
                        </div>
                        <div style="margin-top:.85rem">
                            <button class="btn-outline-green" style="font-size:.78rem;padding:6px 14px;color:#c0392b;border-color:#fbc4c1">
                                <i class="bi bi-box-arrow-right"></i> Revoke Other Sessions
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TAB: Photo -->
    <div class="tab-panel" id="panel-photo">
        <div class="row g-4 justify-content-center">
            <div class="col-lg-6">
                <div class="info-card">
                    <div class="info-card-header"><h6 class="info-card-title"><i class="bi bi-camera-fill"></i> Profile Photo</h6></div>
                    <div class="info-card-body">
                        <div style="display:flex;flex-direction:column;align-items:center;gap:1.25rem;margin-bottom:1.5rem">
                            <img id="photoPreviewLarge"
                                src="{{ optional(auth()->user())->avatar ?: 'https://ui-avatars.com/api/?name='.urlencode(optional(auth()->user())->name ?? 'ARBO Admin').'&background=1a6932&color=fff&rounded=true&size=200' }}"
                                style="width:120px;height:120px;border-radius:50%;object-fit:cover;border:4px solid #fff;box-shadow:var(--shadow-md)" alt="Preview">
                            <div style="text-align:center">
                                <p style="font-size:.84rem;font-weight:600;margin:0 0 3px">{{ optional(auth()->user())->name ?? 'ARBO Admin' }}</p>
                                <p style="font-size:.75rem;color:var(--text-muted);margin:0">ARBO Administrator</p>
                            </div>
                        </div>
                        <form method="POST" action="{{ url('/arbo/profile/photo') }}" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <label class="avatar-upload-zone" for="photoInput">
                                <i class="bi bi-cloud-arrow-up"></i>
                                <p><strong>Click to upload</strong> or drag & drop</p>
                                <p style="font-size:.72rem;margin-top:3px">PNG, JPG or WEBP — max 2MB</p>
                            </label>
                            <input type="file" id="photoInput" name="avatar" accept="image/*" style="display:none" onchange="previewPhoto(this)">
                            <div class="d-flex gap-2 mt-3">
                                <button type="submit" class="btn-green"><i class="bi bi-cloud-upload"></i> Upload Photo</button>
                                <button type="button" class="btn-outline-green" onclick="removePhoto()"><i class="bi bi-trash"></i> Remove</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TAB: Notifications -->
    <div class="tab-panel" id="panel-notifications">
        <div class="row g-4">
            <div class="col-lg-7">
                <div class="info-card">
                    <div class="info-card-header"><h6 class="info-card-title"><i class="bi bi-bell-fill"></i> Notification Preferences</h6></div>
                    <div class="info-card-body">
                        <div class="notif-pref-row">
                            <div><div class="notif-pref-label">New Orders</div><div class="notif-pref-sub">Notify me when a buyer places a new order</div></div>
                            <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-slider"></span></label>
                        </div>
                        <div class="notif-pref-row">
                            <div><div class="notif-pref-label">New Seller Registration</div><div class="notif-pref-sub">Notify me when a new seller joins</div></div>
                            <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-slider"></span></label>
                        </div>
                        <div class="notif-pref-row">
                            <div><div class="notif-pref-label">New Buyer Registration</div><div class="notif-pref-sub">Notify me when a buyer creates an account</div></div>
                            <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-slider"></span></label>
                        </div>
                        <div class="notif-pref-row">
                            <div><div class="notif-pref-label">Low Stock Alerts</div><div class="notif-pref-sub">Notify me when product stock is running low</div></div>
                            <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-slider"></span></label>
                        </div>
                        <div class="notif-pref-row">
                            <div><div class="notif-pref-label">Product Approval Requests</div><div class="notif-pref-sub">Notify when a seller submits a product for review</div></div>
                            <label class="toggle-switch"><input type="checkbox"><span class="toggle-slider"></span></label>
                        </div>
                        <div class="notif-pref-row">
                            <div><div class="notif-pref-label">Weekly Sales Summary</div><div class="notif-pref-sub">Weekly email summary of marketplace activity</div></div>
                            <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-slider"></span></label>
                        </div>
                        <div class="notif-pref-row">
                            <div><div class="notif-pref-label">System Announcements</div><div class="notif-pref-sub">Important updates from DAR Region V</div></div>
                            <label class="toggle-switch"><input type="checkbox" checked><span class="toggle-slider"></span></label>
                        </div>
                        <div style="margin-top:1.25rem">
                            <button class="btn-green"><i class="bi bi-check-lg"></i> Save Preferences</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="info-card">
                    <div class="info-card-header"><h6 class="info-card-title"><i class="bi bi-envelope-fill"></i> Email Delivery</h6></div>
                    <div class="info-card-body">
                        <div class="info-row">
                            <div class="info-row-icon ir-blue"><i class="bi bi-envelope-at-fill"></i></div>
                            <div><div class="info-row-label">Notification Email</div><div class="info-row-value">{{ optional(auth()->user())->email ?? '—' }}</div></div>
                        </div>
                        <div class="info-row">
                            <div class="info-row-icon ir-teal"><i class="bi bi-clock-fill"></i></div>
                            <div style="flex:1">
                                <div class="info-row-label">Digest Frequency</div>
                                <div class="info-row-value">
                                    <select class="form-control-custom" style="padding:6px 10px;margin-top:3px">
                                        <option>Immediately</option>
                                        <option selected>Daily digest</option>
                                        <option>Weekly digest</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const el = document.getElementById('currentDate');
    if (el) el.textContent = new Date().toLocaleDateString('en-PH', {weekday:'long',year:'numeric',month:'long',day:'numeric'});

    const toggle  = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('mainSidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const open  = () => { sidebar.classList.add('show'); overlay.classList.add('show'); document.body.style.overflow='hidden'; };
    const close = () => { sidebar.classList.remove('show'); overlay.classList.remove('show'); document.body.style.overflow=''; };
    if (toggle)  toggle.addEventListener('click', open);
    if (overlay) overlay.addEventListener('click', close);
});

function switchTab(name) {
    document.querySelectorAll('.profile-tab').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    const btn   = document.getElementById('tab-' + name);
    const panel = document.getElementById('panel-' + name);
    if (btn)   btn.classList.add('active');
    if (panel) { panel.classList.add('active'); }
}

function togglePw(id, btn) {
    const input = document.getElementById(id);
    const icon  = btn.querySelector('i');
    input.type  = input.type === 'password' ? 'text' : 'password';
    icon.className = input.type === 'text' ? 'bi bi-eye-slash' : 'bi bi-eye';
}

function updatePwStrength(val) {
    const fill  = document.getElementById('pwStrengthFill');
    const label = document.getElementById('pwStrengthLabel');
    let score = 0;
    if (val.length >= 8) score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;
    const levels = [
        {pct:'0%',   color:'var(--gray-300)', text:'Enter a new password'},
        {pct:'25%',  color:'#dc3545',         text:'Weak — too short'},
        {pct:'50%',  color:'var(--gold)',      text:'Fair — add numbers or symbols'},
        {pct:'75%',  color:'#1a73e8',          text:'Good — almost there!'},
        {pct:'100%', color:'var(--green-600)', text:'Strong password ✓'},
    ];
    const l = levels[score];
    fill.style.width = l.pct;
    fill.style.background = l.color;
    label.textContent = l.text;
    label.style.color = score === 0 ? 'var(--text-muted)' : l.color;
}

function previewPhoto(input) {
    if (!input.files || !input.files[0]) return;
    const url = URL.createObjectURL(input.files[0]);
    document.getElementById('photoPreviewLarge').src = url;
    document.getElementById('avatarPreview').src = url;
}
function removePhoto() {
    const fallback = 'https://ui-avatars.com/api/?name=ARBO+Admin&background=1a6932&color=fff&rounded=true&size=200';
    document.getElementById('photoPreviewLarge').src = fallback;
    document.getElementById('avatarPreview').src = fallback;
}
</script>
</body>
</html>