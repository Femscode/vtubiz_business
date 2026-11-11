@php
    $active = $active ?? '';
    $nameParts = explode(' ', trim($user->name));
    $initials = strtoupper(substr($nameParts[0] ?? '', 0, 1) . substr($nameParts[1] ?? '', 0, 1));
    // Which sidebar item is current: URL first, then the controller's $active as a fallback.
    $navMap = [
        'dashboard' => ['dashboard'],
        'fundwallet' => ['fundwallet', 'user-fundwallet', 'manualpayment*', 'pay_with_card*', 'withdraw*'],
        'transfer' => ['transfer*'],
        'transaction' => ['mytransactions*', 'pending_transactions*', 'view_details*', 'print_transaction_receipt*'],
        'data_group' => ['data_group*', 'premium-data_group*', 'data_recipient*', 'premium-data_recipient*', 'group_transactions*', 'premium-group_transactions*'],
        'airtime_group' => ['airtime_group*', 'premium-airtime_group*', 'airtime_recipient*', 'premium-airtime_recipients*', 'group_airtime_transactions*', 'premium-group_airtime_transactions*'],
        'data' => ['data', 'premium-data'],
        'airtime' => ['airtime', 'premium-airtime'],
        'cable' => ['cable', 'premium-cable'],
        'electricity' => ['electricity', 'premium-electricity'],
        'examination' => ['examination', 'premium-examination'],
        'giveaway' => ['my-giveaway*', 'create-giveaway*', 'giveaway_participant*', 'giveaway_transactions*', 'add_question*'],
        'bulksms' => ['bulksms*', 'premium-bulksms*', 'contact_group*', 'premium-contact_group*'],
        'referral' => ['my-referral*'],
        'verify_purchase' => ['premium-verify_purchase*', 'verify_purchase*', 'premium-check_verify_purchase*', 'check_verify_purchase*'],
        'verify_payment' => ['verify_payment*', 'premium-verify_payment*', 'check_verify_payment*', 'premium-check_verify_payment*'],
        'profile' => ['profile*', 'my-profile*', 'change-password*', 'change_password*', 'change-pin*', 'user-change-pin*', 'resetpin*', 'reset-pin*'],
    ];
    $currentNav = null;
    foreach ($navMap as $navKey => $navPaths) {
        foreach ($navPaths as $navPath) {
            if (request()->is($navPath)) { $currentNav = $navKey; break 2; }
        }
    }
    $currentNav = $currentNav ?? $active;
    $isActive = function ($key, $paths = []) use ($currentNav) {
        return $currentNav === $key;
    };
    // Page announcements set by controllers ($notification = page notice, $dod = deal of the day).
    $announcements = collect([
        isset($notification) && is_object($notification) ? ['kind' => 'notice', 'item' => $notification] : null,
        isset($dod) && is_object($dod) ? ['kind' => 'deal', 'item' => $dod] : null,
    ])->filter()->map(function ($a) {
        $a['key'] = $a['kind'] . '-' . ($a['item']->id ?? 0) . '-' . md5(($a['item']->title ?? '') . '|' . ($a['item']->description ?? '') . '|' . ($a['item']->updated_at ?? ''));
        return $a;
    })->values();
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <title>VTUBIZ | Dashboard</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta name="description" content="Top Up, Pay Bills, Stay Connected." />
    <meta name="theme-color" content="#001f3f">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/fav_01.png') }}" />

    @laravelPWA

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,500;9..144,600&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Global Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />

    <style>
        :root {
            --bg-color: #F7F6F2;
            --primary-dark: #001f3f;
            --ink: #0B1625;
            --surface: #FFFFFF;
            --text-main: #141A23;
            --text-secondary: #6B7280;
            --text-light: #A0A6B1;
            --line: rgba(11, 22, 37, 0.07);

            --brand-orange: #FB9129;
            --brand-orange-2: #FF7A00;

            --accent-blue: #2F80ED;
            --accent-pink: #EB5757;
            --accent-yellow: #F2C94C;
            --accent-green: #1F9D57;
            --accent-purple: #8B5CF6;

            --radius-lg: 24px;
            --radius-md: 16px;
            --radius-sm: 12px;
            --radius-pill: 999px;

            --space-xs: 8px;
            --space-sm: 16px;
            --space-md: 24px;
            --space-lg: 32px;
            --space-xl: 48px;

            --shadow-card: 0 1px 2px rgba(11, 22, 37, 0.04), 0 8px 24px rgba(11, 22, 37, 0.04);
            --shadow-hover: 0 2px 4px rgba(11, 22, 37, 0.04), 0 16px 36px rgba(11, 22, 37, 0.08);
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.04);

            --sidebar-w: 268px;
            --topbar-h: 72px;
            --tabbar-h: 68px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            height: 100vh;
            height: 100dvh;
            display: flex;
            overflow: hidden;
            -webkit-font-smoothing: antialiased;
        }

        .serif {
            font-family: 'Fraunces', serif;
            font-weight: 500;
            letter-spacing: -0.01em;
        }

        .dashboard-container {
            display: flex;
            width: 100%;
            height: 100%;
            position: relative;
        }

        /* ---------- Sidebar ---------- */
        .sidebar {
            width: var(--sidebar-w);
            background: var(--surface);
            border-right: 1px solid var(--line);
            padding: 22px 16px 16px;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            transition: transform 0.3s cubic-bezier(.2, .8, .2, 1);
            z-index: 1000;
        }

        .brand {
            display: flex;
            align-items: center;
            padding: 4px 12px 22px;
            text-decoration: none;
        }

        .brand-logo {
            height: 30px;
            width: auto;
            object-fit: contain;
        }

        .nav-menu {
            display: flex;
            flex-direction: column;
            gap: 2px;
            flex: 1;
            overflow-y: auto;
            padding: 0 2px 12px 0;
            scrollbar-width: thin;
        }

        .nav-menu::-webkit-scrollbar {
            width: 4px;
        }

        .nav-menu::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.06);
            border-radius: 10px;
        }

        .nav-section-title {
            font-size: 0.68rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: var(--text-light);
            margin: 18px 12px 6px;
            font-weight: 700;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 10px 12px;
            border-radius: 12px;
            text-decoration: none;
            color: #4B5563;
            font-weight: 500;
            transition: background 0.15s ease, color 0.15s ease;
            gap: 12px;
            font-size: 0.92rem;
            position: relative;
        }

        .nav-item i {
            width: 20px;
            text-align: center;
            font-size: 0.98rem;
            color: #9AA1AD;
            transition: color 0.15s ease;
        }

        .nav-item:hover {
            background-color: #F4F4F1;
            color: var(--ink);
        }

        .nav-item:hover i {
            color: var(--ink);
        }

        .nav-item.active {
            background: var(--primary-dark);
            color: #fff;
            font-weight: 600;
        }

        .nav-item.active i {
            color: var(--brand-orange);
        }

        .nav-item.danger:hover {
            background: #FEF2F2;
            color: #B91C1C;
        }

        .nav-item.danger:hover i {
            color: #B91C1C;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            border-radius: 16px;
            background: #F7F6F2;
            margin-top: 10px;
            text-decoration: none;
            color: inherit;
            transition: background 0.15s;
        }

        .user-profile:hover {
            background: #EFEDE7;
            color: inherit;
        }

        .user-profile .chev {
            margin-left: auto;
            color: var(--text-light);
            font-size: 0.8rem;
        }

        .avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #FFB45E, var(--brand-orange-2));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Fraunces', serif;
            color: #fff;
            font-weight: 600;
            font-size: 0.95rem;
            flex-shrink: 0;
        }

        .user-info {
            min-width: 0;
        }

        .user-info .u-name {
            font-weight: 600;
            font-size: 0.88rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-info .u-role {
            font-size: 0.74rem;
            color: var(--text-secondary);
        }

        /* ---------- Main ---------- */
        .main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            position: relative;
            min-width: 0;
        }

        .top-navbar {
            height: var(--topbar-h);
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 0 28px;
            background: rgba(247, 246, 242, 0.85);
            backdrop-filter: saturate(180%) blur(12px);
            -webkit-backdrop-filter: saturate(180%) blur(12px);
            border-bottom: 1px solid var(--line);
            position: relative;
            z-index: 900;
        }

        .top-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .top-left .m-logo {
            display: none;
        }

        .top-left .m-logo img {
            height: 26px;
        }

        .top-date {
            font-size: 0.88rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .hamburger {
            display: none;
            background: var(--surface);
            border: 1px solid var(--line);
            width: 40px;
            height: 40px;
            border-radius: 12px;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--ink);
            font-size: 1rem;
        }

        .top-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .bal-chip {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 6px 6px 6px 14px;
            border-radius: var(--radius-pill);
            background: var(--surface);
            border: 1px solid var(--line);
            text-decoration: none;
            color: var(--ink);
            font-weight: 600;
            font-size: 0.9rem;
            font-variant-numeric: tabular-nums;
            transition: box-shadow .2s;
        }

        .bal-chip:hover {
            color: var(--ink);
            box-shadow: var(--shadow-card);
        }

        .bal-chip .plus {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: var(--primary-dark);
            color: #fff;
            display: grid;
            place-items: center;
            font-size: 0.75rem;
        }

        .icon-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--surface);
            border: 1px solid var(--line);
            display: grid;
            place-items: center;
            color: var(--ink);
            text-decoration: none;
            transition: box-shadow .2s;
        }

        .icon-btn:hover {
            color: var(--ink);
            box-shadow: var(--shadow-card);
        }

        .menu-wrap {
            position: relative;
        }

        .avatar-btn {
            border: 0;
            background: none;
            padding: 0;
            cursor: pointer;
            border-radius: 50%;
        }

        .avatar-btn .avatar {
            width: 40px;
            height: 40px;
        }

        .pop-menu {
            position: absolute;
            right: 0;
            top: calc(100% + 10px);
            width: 240px;
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 18px;
            box-shadow: 0 20px 50px -12px rgba(11, 22, 37, .25);
            padding: 8px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(6px);
            transition: all .18s ease;
            z-index: 1100;
        }

        .pop-menu.open {
            opacity: 1;
            visibility: visible;
            transform: none;
        }

        .pop-head {
            padding: 10px 12px 12px;
            border-bottom: 1px solid var(--line);
            margin-bottom: 6px;
        }

        .pop-head b {
            display: block;
            font-size: .92rem;
        }

        .pop-head small {
            color: var(--text-secondary);
            font-size: .78rem;
        }

        .pop-menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            color: #374151;
            text-decoration: none;
            font-size: .9rem;
            font-weight: 500;
        }

        .pop-menu a i {
            width: 18px;
            color: #9AA1AD;
        }

        .pop-menu a:hover {
            background: #F4F4F1;
            color: var(--ink);
        }

        .pop-menu a.danger:hover {
            background: #FEF2F2;
            color: #B91C1C;
        }

        .content-area {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            min-width: 0;
            padding: 20px;
            scroll-behavior: smooth;
        }

        /* Sidebar overlay for mobile */
        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(11, 22, 37, 0.45);
            backdrop-filter: blur(4px);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility .3s;
        }

        body.sidebar-open .sidebar-overlay {
            opacity: 1;
            visibility: visible;
        }

        #fixedbutton {
            position: fixed;
            bottom: 28px;
            right: 28px;
            height: 54px;
            width: 54px;
            z-index: 800;
            border-radius: 50%;
            box-shadow: 0 12px 24px -8px rgba(37, 211, 102, .55);
            transition: transform 0.2s;
        }

        #fixedbutton:hover {
            transform: scale(1.08);
        }

        /* ---------- Mobile tab bar ---------- */
        .tabbar {
            display: none;
        }

        @media (max-width: 991px) {
            .sidebar {
                position: fixed;
                left: 0;
                top: 0;
                height: 100%;
                transform: translateX(-100%);
                box-shadow: 20px 0 50px -20px rgba(0, 0, 0, .3);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .top-navbar {
                padding: 0 16px;
                height: 64px;
            }

            .hamburger {
                display: flex;
            }

            .top-left .m-logo {
                display: inline-flex;
            }

            .top-date,
            .bal-chip .bal-label {
                display: none;
            }

            .top-right .icon-btn.support {
                display: none;
            }

            .content-area {
                padding: 16px 16px calc(var(--tabbar-h) + 24px + env(safe-area-inset-bottom));
            }

            .tabbar {
                display: grid;
                grid-template-columns: repeat(5, 1fr);
                position: fixed;
                left: 12px;
                right: 12px;
                bottom: calc(10px + env(safe-area-inset-bottom));
                height: var(--tabbar-h);
                background: rgba(11, 22, 37, 0.94);
                backdrop-filter: blur(14px);
                -webkit-backdrop-filter: blur(14px);
                border-radius: 22px;
                z-index: 950;
                padding: 0 6px;
                box-shadow: 0 18px 40px -12px rgba(0, 0, 0, .45);
            }

            .tab-item {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 4px;
                color: rgba(255, 255, 255, .55);
                text-decoration: none;
                font-size: .68rem;
                font-weight: 600;
                background: none;
                border: 0;
                font-family: inherit;
                cursor: pointer;
            }

            .tab-item i {
                font-size: 1.05rem;
            }

            .tab-item.active,
            .tab-item:hover {
                color: #fff;
            }

            .tab-item.active i {
                color: var(--brand-orange);
            }

            .tab-item.fund .fund-dot {
                width: 44px;
                height: 44px;
                margin-top: -22px;
                border-radius: 50%;
                background: var(--brand-orange);
                color: #fff;
                display: grid;
                place-items: center;
                box-shadow: 0 10px 20px -6px rgba(251, 145, 41, .7);
                border: 4px solid var(--bg-color);
            }

            .tab-item.fund .fund-dot i {
                color: #fff;
                font-size: .95rem;
            }

            #fixedbutton {
                bottom: calc(var(--tabbar-h) + 24px + env(safe-area-inset-bottom));
                right: 18px;
                width: 48px;
                height: 48px;
            }
        }

        /* Custom Scrollbar for Content */
        .content-area::-webkit-scrollbar {
            width: 8px;
        }

        .content-area::-webkit-scrollbar-track {
            background: var(--bg-color);
        }

        .content-area::-webkit-scrollbar-thumb {
            background: #DDDBD4;
            border-radius: 10px;
        }

        .content-area::-webkit-scrollbar-thumb:hover {
            background: #CFCCC4;
        }

        /* ---------- Global Modal Styles ---------- */
        .modal-content {
            border-radius: var(--radius-lg);
            border: none;
            box-shadow: 0 30px 60px -12px rgba(11, 22, 37, 0.25);
            overflow: hidden;
        }

        .modal-header {
            border-bottom: 1px solid var(--line);
            padding: var(--space-md) var(--space-lg);
            background: #FBFAF7;
        }

        .modal-header h4,
        .modal-header h5 {
            font-family: 'Fraunces', serif;
            color: var(--primary-dark);
            margin-bottom: 0;
            font-weight: 600;
        }

        .modal-body {
            padding: var(--space-lg);
            font-family: 'DM Sans', sans-serif;
        }

        .modal-footer {
            border-top: 1px solid var(--line);
            padding: var(--space-md) var(--space-lg);
            background: #FBFAF7;
        }

        .btn-close:focus {
            box-shadow: none;
        }

        .modal-body label {
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 8px;
            display: block;
            font-size: 0.9rem;
        }

        .modal-body .form-control {
            border-radius: var(--radius-md);
            padding: 12px 16px;
            border: 1px solid rgba(0, 0, 0, 0.08);
            background: #F9F9F7;
            transition: all 0.2s;
        }

        .modal-body .form-control:focus {
            border-color: var(--primary-dark);
            background: white;
            box-shadow: 0 0 0 4px rgba(0, 31, 63, 0.06);
        }

        /* ---------- Global Vue component overrides ---------- */
        #app input.form-control,
        #app select.form-control,
        #app select.form-select,
        #app textarea.form-control {
            border-radius: 14px !important;
            padding: 14px 18px !important;
            border: 1.5px solid rgba(11, 22, 37, 0.08) !important;
            background: #FAFAF8 !important;
            font-family: 'DM Sans', sans-serif !important;
            font-size: 1rem !important;
            transition: all 0.2s ease !important;
            box-shadow: none !important;
        }

        #app input.form-control:focus,
        #app select.form-control:focus,
        #app select.form-select:focus,
        #app textarea.form-control:focus {
            border-color: var(--primary-dark) !important;
            background: white !important;
            box-shadow: 0 0 0 4px rgba(0, 31, 63, 0.06) !important;
            outline: none !important;
        }

        #app .btn-primary {
            background-color: var(--primary-dark);
            border: none !important;
            border-radius: var(--radius-pill) !important;
            padding: 12px 24px !important;
            font-weight: 600 !important;
            font-family: 'DM Sans', sans-serif !important;
            transition: transform 0.1s ease, background .2s !important;
        }

        #app .btn-primary:hover {
            background-color: #00152b;
        }

        #app .btn-primary:active {
            transform: scale(0.98) !important;
        }

        #app .btn-success {
            background-color: var(--accent-green) !important;
            border: none !important;
            border-radius: var(--radius-pill) !important;
            padding: 12px 24px !important;
            font-weight: 600 !important;
        }

        #app .card {
            border: 1px solid var(--line) !important;
            border-radius: var(--radius-lg) !important;
            box-shadow: var(--shadow-card) !important;
            background: var(--surface);
        }

        #app .wallet-card {
            background: var(--primary-dark) !important;
            background-image:
                radial-gradient(circle at 85% 110%, rgba(251, 145, 41, 0.45) 0%, transparent 45%),
                radial-gradient(circle at 0% 0%, rgba(47, 128, 237, 0.18) 0%, transparent 40%) !important;
            border: 0 !important;
        }

        #app .referral-card {
            background: linear-gradient(145deg, #0B1625 0%, #001f3f 100%);
        }

        #app label:not(.choice):not(.check-v):not(.f-label):not(.chip-v):not(.method):not(.amt-entry) {
            font-weight: 600 !important;
            color: var(--primary-dark) !important;
            margin-bottom: 10px !important;
            font-size: 0.9rem !important;
            display: block !important;
        }

        .service-card-wrapper {
            background: var(--surface);
            border-radius: var(--radius-lg);
            padding: 20px;
            box-shadow: var(--shadow-card);
            border: 1px solid var(--line);
            width: 100%;
        }

        .service-header {
            text-align: center;
            margin-bottom: var(--space-xl);
        }

        /* SweetAlert polish */
        .swal2-popup {
            border-radius: 24px !important;
            font-family: 'DM Sans', sans-serif !important;
        }

        .swal2-styled.swal2-confirm {
            border-radius: 999px !important;
            padding: 10px 26px !important;
        }
        @media (max-width: 420px) {
            .top-navbar {
                padding: 0 12px;
                gap: 8px;
            }

            .top-left {
                gap: 8px;
                min-width: 0;
            }

            .top-left .m-logo img {
                height: 22px;
            }

            .hamburger,
            .avatar-btn .avatar {
                width: 36px;
                height: 36px;
            }

            .bal-chip {
                padding: 4px 4px 4px 10px;
                font-size: .8rem;
                gap: 6px;
            }

            .bal-chip .plus {
                width: 24px;
                height: 24px;
            }

            .content-area {
                padding-left: 12px;
                padding-right: 12px;
            }

            .tabbar {
                left: 8px;
                right: 8px;
            }
        }

        html,
        body {
            max-width: 100%;
            overflow-x: hidden;
        }
    </style>
    @include('dashboard.partials.ui')
    @yield('header')
</head>

<body>
    <div id="app" class="dashboard-container">
        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay" onclick="toggleSidebar(false)"></div>

        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar" aria-label="Main navigation">
            <a href="/dashboard" class="brand">
                <img src="{{ asset('assets/img/logo/vtulogo.png') }}" alt="VTUBIZ" class="brand-logo">
            </a>

            <div class="nav-menu">
                <a href="/dashboard" class="nav-item {{ $isActive('dashboard', ['dashboard']) ? 'active' : '' }}">
                    <i class="fa-solid fa-house"></i><span>Overview</span>
                </a>
                <a href="/fundwallet" class="nav-item {{ $isActive('fundwallet', ['fundwallet']) ? 'active' : '' }}">
                    <i class="fa-solid fa-wallet"></i><span>Fund Wallet</span>
                </a>
                <a href="/transfer" class="nav-item {{ $isActive('transfer', ['transfer']) ? 'active' : '' }}">
                    <i class="fa-solid fa-paper-plane"></i><span>Transfer</span>
                </a>
                <a href="/mytransactions" class="nav-item {{ $isActive('transaction', ['mytransactions']) ? 'active' : '' }}">
                    <i class="fa-solid fa-clock-rotate-left"></i><span>Transactions</span>
                </a>

                <div class="nav-section-title">Pay &amp; Top up</div>
                <a href="/data" class="nav-item {{ $isActive('data', ['data']) ? 'active' : '' }}">
                    <i class="fa-solid fa-wifi"></i><span>Buy Data</span>
                </a>
                <a href="/airtime" class="nav-item {{ $isActive('airtime', ['airtime']) ? 'active' : '' }}">
                    <i class="fa-solid fa-phone"></i><span>Buy Airtime</span>
                </a>
                <a href="/cable" class="nav-item {{ $isActive('cable', ['cable']) ? 'active' : '' }}">
                    <i class="fa-solid fa-tv"></i><span>TV Subscription</span>
                </a>
                <a href="/electricity" class="nav-item {{ $isActive('electricity', ['electricity']) ? 'active' : '' }}">
                    <i class="fa-solid fa-lightbulb"></i><span>Electricity</span>
                </a>
                <a href="/examination" class="nav-item {{ $isActive('examination', ['examination']) ? 'active' : '' }}">
                    <i class="fa-solid fa-graduation-cap"></i><span>Exam Pins</span>
                </a>

                <div class="nav-section-title">Groups</div>
                <a href="/data_group" class="nav-item {{ $isActive('data_group', ['data_group*']) ? 'active' : '' }}">
                    <i class="fa-solid fa-layer-group"></i><span>Data Group</span>
                </a>
                <a href="/airtime_group" class="nav-item {{ $isActive('airtime_group', ['airtime_group*']) ? 'active' : '' }}">
                    <i class="fa-solid fa-user-group"></i><span>Airtime Group</span>
                </a>

                <div class="nav-section-title">Grow</div>
                <a href="/my-giveaway" class="nav-item {{ $isActive('giveaway', ['my-giveaway*']) ? 'active' : '' }}">
                    <i class="fa-solid fa-gift"></i><span>Giveaways</span>
                </a>
                <a href="/bulksms" class="nav-item {{ $isActive('bulksms', ['bulksms*']) ? 'active' : '' }}">
                    <i class="fa-solid fa-message"></i><span>Bulk SMS</span>
                </a>
                <a href="/my-referral" class="nav-item {{ $isActive('referral', ['my-referral*']) ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i><span>Referrals</span>
                </a>

                <div class="nav-section-title">Support</div>
                <a href="/premium-verify_purchase" class="nav-item {{ $isActive('verify_purchase', ['premium-verify_purchase*']) ? 'active' : '' }}">
                    <i class="fa-solid fa-magnifying-glass-dollar"></i><span>Verify Purchase</span>
                </a>
                <a href="/verify_payment" class="nav-item {{ $isActive('verify_payment', ['verify_payment*']) ? 'active' : '' }}">
                    <i class="fa-solid fa-receipt"></i><span>Verify Funding</span>
                </a>

                <div class="nav-section-title">Account</div>
                <a href="/profile" class="nav-item {{ $isActive('profile', ['profile']) ? 'active' : '' }}">
                    <i class="fa-solid fa-user-gear"></i><span>Profile &amp; Security</span>
                </a>
                <a href="/logout" class="nav-item danger" onclick="return confirm('Are you sure you want to sign out?')">
                    <i class="fa-solid fa-right-from-bracket"></i><span>Sign Out</span>
                </a>
            </div>

            <a href="/profile" class="user-profile">
                <div class="avatar">{{ $initials }}</div>
                <div class="user-info">
                    <div class="u-name">{{ $user->name }}</div>
                    <div class="u-role">{{ ucfirst($user->user_type) }}</div>
                </div>
                <i class="fa-solid fa-chevron-right chev"></i>
            </a>
        </nav>

        <!-- Main Content -->
        <div class="main-wrapper">
            <header class="top-navbar">
                <div class="top-left">
                    <button class="hamburger" type="button" aria-label="Open menu" onclick="toggleSidebar()">
                        <i class="fa-solid fa-bars-staggered"></i>
                    </button>
                    <a href="/dashboard" class="m-logo"><img src="{{ asset('assets/img/logo/vtulogo.png') }}" alt="VTUBIZ"></a>
                    <span class="top-date">{{ now()->format('l, F j') }}</span>
                </div>

                <div class="top-right">
                    <a href="/fundwallet" class="bal-chip" title="Fund wallet">
                        <span><span class="bal-label" style="color:var(--text-secondary);font-weight:500">Balance&nbsp;</span>₦{{ number_format((float) $user->balance, 2) }}</span>
                        <span class="plus"><i class="fa-solid fa-plus"></i></span>
                    </a>
                    <a href="https://wa.me/2349058744473" target="_blank" rel="noopener" class="icon-btn support" title="Support">
                        <i class="fa-regular fa-comment-dots"></i>
                    </a>
                    <div class="menu-wrap">
                        <button class="avatar-btn" type="button" aria-label="Account menu" onclick="toggleMenu(event)">
                            <div class="avatar">{{ $initials }}</div>
                        </button>
                        <div class="pop-menu" id="accountMenu">
                            <div class="pop-head">
                                <b>{{ $user->name }}</b>
                                <small>{{ $user->email }}</small>
                            </div>
                            <a href="/profile"><i class="fa-solid fa-user-gear"></i> Profile &amp; Security</a>
                            <a href="/my-referral"><i class="fa-solid fa-users"></i> Referrals</a>
                            <a href="/mytransactions"><i class="fa-solid fa-clock-rotate-left"></i> Transactions</a>
                            <a href="/logout" class="danger" onclick="return confirm('Are you sure you want to sign out?')"><i class="fa-solid fa-right-from-bracket"></i> Sign Out</a>
                        </div>
                    </div>
                </div>
            </header>

            <div class="content-area">
                @include('dashboard.partials.announcement-ribbon')
                @yield('content')
            </div>

            <a href="https://wa.me/2349058744473" target="_blank" rel="noopener" aria-label="Chat on WhatsApp">
                <img src="{{ asset('assets/media/logos/whatsapp.png') }}" alt="whatsapp" id="fixedbutton">
            </a>
        </div>

        <!-- Mobile tab bar -->
        <nav class="tabbar" aria-label="Quick navigation">
            <a href="/dashboard" class="tab-item {{ $isActive('dashboard', ['dashboard']) ? 'active' : '' }}"><i class="fa-solid fa-house"></i>Home</a>
            <a href="/data" class="tab-item {{ $isActive('data', ['data']) ? 'active' : '' }}"><i class="fa-solid fa-wifi"></i>Data</a>
            <a href="/fundwallet" class="tab-item fund"><span class="fund-dot"><i class="fa-solid fa-plus"></i></span>Fund</a>
            <a href="/airtime" class="tab-item {{ $isActive('airtime', ['airtime']) ? 'active' : '' }}"><i class="fa-solid fa-phone"></i>Airtime</a>
            <button type="button" class="tab-item" onclick="toggleSidebar()"><i class="fa-solid fa-grip"></i>More</button>
        </nav>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function toggleSidebar(force) {
            var sidebar = document.getElementById('sidebar');
            var open = typeof force === 'boolean' ? force : !sidebar.classList.contains('show');
            sidebar.classList.toggle('show', open);
            document.body.classList.toggle('sidebar-open', open);
        }

        function toggleMenu(e) {
            e.stopPropagation();
            document.getElementById('accountMenu').classList.toggle('open');
        }

        document.addEventListener('click', function(event) {
            var menu = document.getElementById('accountMenu');
            if (menu && !menu.contains(event.target)) menu.classList.remove('open');
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                toggleSidebar(false);
                var menu = document.getElementById('accountMenu');
                if (menu) menu.classList.remove('open');
            }
        });

        // Handle Session Messages
        @if(session('message'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{{ session('message') }}",
            confirmButtonColor: '#001f3f'
        });
        @endif

        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#001f3f'
        });
        @endif

        @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: "{{ session('error') }}",
            confirmButtonColor: '#001f3f'
        });
        @endif

    </script>

    {{-- Announcements modal: included after app.js so Vue has already mounted the ribbon it toggles --}}
    @include('dashboard.partials.announcements')

    @yield('script')
</body>

</html>
