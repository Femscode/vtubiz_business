<!DOCTYPE html>
<html lang="en">
<head>
    <title>VTUBIZ | Dashboard</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Top Up, Pay Bills, Stay Connected." />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/fav_01.png') }}" />

    @laravelPWA

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,600&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Global Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    
    <style>
        :root {
            --bg-color: #FDFCF8; 
            --primary-dark: #001f3f; 
            --surface: #FFFFFF;
            --text-main: #1A1A1A;
            --text-secondary: #6B6B6B;
            --text-light: #9CA3AF;
            
            --accent-blue: #2F80ED;
            --accent-pink: #EB5757;
            --accent-yellow: #F2C94C;
            --accent-green: #27AE60;
            --accent-purple: #9B51E0;

            --radius-lg: 24px;
            --radius-md: 16px;
            --radius-sm: 12px;
            --radius-pill: 999px;

            --space-xs: 8px;
            --space-sm: 16px;
            --space-md: 24px;
            --space-lg: 32px;
            --space-xl: 48px;

            --shadow-card: 0 8px 24px rgba(15, 53, 72, 0.04);
            --shadow-hover: 0 12px 32px rgba(15, 53, 72, 0.08);
            --shadow-sm: 0 2px 4px rgba(0,0,0,0.02);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            height: 100vh;
            display: flex;
            overflow: hidden;
            -webkit-font-smoothing: antialiased;
        }

        .dashboard-container { display: flex; width: 100%; height: 100%; position: relative; }

        /* Sidebar Styles */
        .sidebar {
            width: 260px;
            background-color: var(--surface);
            border-right: 1px solid rgba(0,0,0,0.03);
            padding: var(--space-lg) var(--space-md);
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            transition: transform 0.3s ease;
            z-index: 1000;
        }

        .brand {
            font-family: 'Fraunces', serif;
            font-size: 1.5rem;
            color: var(--primary-dark);
            margin-bottom: var(--space-xl);
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .brand-logo {
            height: 35px;
            width: auto;
            object-fit: contain;
        }

        .nav-menu {
            display: flex;
            flex-direction: column;
            gap: 4px;
            flex: 1;
            overflow-y: auto;
            padding-right: 4px;
        }

        .nav-menu::-webkit-scrollbar { width: 4px; }
        .nav-menu::-webkit-scrollbar-thumb { background: rgba(0,0,0,0.05); border-radius: 10px; }

        .nav-section-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-light);
            margin: 20px 16px 8px;
            font-weight: 700;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            border-radius: var(--radius-pill);
            text-decoration: none;
            color: var(--text-secondary);
            font-weight: 500;
            transition: all 0.2s ease;
            gap: 12px;
            font-size: 0.95rem;
        }

        .nav-item i { width: 20px; text-align: center; font-size: 1.1rem; }

        .nav-item:hover { background-color: #f8f9fa; color: var(--primary-dark); }

        .nav-item.active {
            background-color: var(--primary-dark);
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(15, 53, 72, 0.15);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 16px;
            border-top: 1px solid rgba(0,0,0,0.05);
            margin-top: 20px;
            text-decoration: none;
            color: inherit;
        }

        .avatar {
            width: 40px;
            height: 40px;
            background-color: var(--accent-yellow);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Fraunces', serif;
            color: var(--primary-dark);
            font-weight: 700;
            flex-shrink: 0;
        }

        /* Main Content Styles */
        .main-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            position: relative;
        }

        .top-navbar {
            height: 70px;
            background: transparent;
            display: none; /* Only visible on mobile */
            align-items: center;
            padding: 0 var(--space-md);
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        .hamburger {
            background: var(--surface);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: var(--shadow-sm);
            color: var(--primary-dark);
            font-size: 1.2rem;
        }

        .content-area {
            flex: 1;
            overflow-y: auto;
            /* padding: var(--space-lg); */
            padding: 20px;
        }

        /* Sidebar overlay for mobile */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 53, 72, 0.4);
            backdrop-filter: blur(4px);
            z-index: 999;
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        #fixedbutton {
            position: fixed;
            bottom: 30px;
            right: 30px;
            height: 55px;
            width: 55px;
            z-index: 800;
            transition: transform 0.2s;
        }
        #fixedbutton:hover { transform: scale(1.1); }

        @media (max-width: 991px) {
            .sidebar {
                position: fixed;
                left: 0;
                top: 0;
                height: 100%;
                transform: translateX(-100%);
            }
            .sidebar.show { transform: translateX(0); }
            .sidebar.show + .sidebar-overlay { display: block; opacity: 1; }
            .top-navbar { display: flex; }
        }

        /* Custom Scrollbar for Content */
        .content-area::-webkit-scrollbar { width: 8px; }
        .content-area::-webkit-scrollbar-track { background: var(--bg-color); }
        .content-area::-webkit-scrollbar-thumb { background: #e0e0e0; border-radius: 10px; }
        .content-area::-webkit-scrollbar-thumb:hover { background: #d0d0d0; }

        /* Global Modal Styles */
        .modal-content {
            border-radius: var(--radius-lg);
            border: none;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .modal-header {
            border-bottom: 1px solid rgba(0,0,0,0.03);
            padding: var(--space-md) var(--space-lg);
            background: #FDFCF8;
        }
        .modal-header h4, .modal-header h5 {
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
            border-top: 1px solid rgba(0,0,0,0.03);
            padding: var(--space-md) var(--space-lg);
            background: #FDFCF8;
        }
        .btn-close:focus { box-shadow: none; }

        /* Global Form Labels & Inputs for Modals */
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
            border: 1px solid rgba(0,0,0,0.08);
            background: #F9F9F9;
            transition: all 0.2s;
        }
        .modal-body .form-control:focus {
            border-color: var(--primary-dark);
            background: white;
            box-shadow: 0 0 0 4px rgba(15, 53, 72, 0.05);
        }

        /* Global Vue Component Overrides to match Fintech UI */
        #app input.form-control, 
        #app select.form-control, 
        #app textarea.form-control {
            border-radius: var(--radius-md) !important;
            padding: 14px 18px !important;
            border: 1px solid rgba(0,0,0,0.08) !important;
            background: #F9F9F9 !important;
            font-family: 'DM Sans', sans-serif !important;
            font-size: 1rem !important;
            transition: all 0.2s ease !important;
            box-shadow: none !important;
        }

        #app input.form-control:focus, 
        #app select.form-control:focus {
            border-color: var(--primary-dark) !important;
            background: white !important;
            box-shadow: 0 0 0 4px rgba(15, 53, 72, 0.05) !important;
            outline: none !important;
        }

        #app .btn-primary {
            background-color: var(--primary-dark);
            border: none !important;
            border-radius: var(--radius-pill) !important;
            padding: 12px 24px !important;
            font-weight: 600 !important;
            font-family: 'DM Sans', sans-serif !important;
            transition: transform 0.1s ease !important;
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
            border: none !important;
            border-radius: var(--radius-lg) !important;
            box-shadow: var(--shadow-card) !important;
            background: var(--surface);
        }

        #app .wallet-card {
            background: var(--primary-dark) !important;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(47, 128, 237, 0.2) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(235, 87, 87, 0.2) 0%, transparent 20%) !important;
        }

        #app .referral-card {
            background: linear-gradient(145deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%) ;
        }

        #app label {
            font-weight: 700 !important;
            color: var(--primary-dark) !important;
            margin-bottom: 10px !important;
            font-size: 0.9rem !important;
            display: block !important;
        }

        .service-card-wrapper {
            background: var(--surface);
            border-radius: var(--radius-lg);
            /* padding: var(--space-xl) var(--space-lg); */
            padding: 15px;
            box-shadow: var(--shadow-hover);
            border: 1px solid rgba(0,0,0,0.02);
            width: 100%;
        }

        .service-header {
            text-align: center;
            margin-bottom: var(--space-xl);
        }
    </style>
    @yield('header')
</head>

<body>
    <div id="app" class="dashboard-container">
        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <a href="/dashboard" class="brand">
                <img src="{{ asset('assets/img/logo/vtulogo.png') }}" alt="VTUBIZ" class="brand-logo">
            </a>

            <div class="nav-menu">
                <a href="/dashboard" class="nav-item {{ $active == 'dashboard' ? 'active' : '' }}">
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                </a>
                
                <a href="/fundwallet" class="nav-item {{ $active == 'fundwallet' ? 'active' : '' }}">
                    <i class="fa-solid fa-wallet"></i>
                    <span>Fund Wallet</span>
                </a>

                <a href="/transfer" class="nav-item {{ $active == 'transfer' ? 'active' : '' }}">
                    <i class="fa-solid fa-paper-plane"></i>
                    <span>Transfer</span>
                </a>

                <div class="nav-section-title">Services</div>
                
                <a href="/data" class="nav-item">
                    <i class="fa-solid fa-wifi"></i>
                    <span>Buy Data</span>
                </a>
                
                <a href="/airtime" class="nav-item">
                    <i class="fa-solid fa-phone"></i>
                    <span>Buy Airtime</span>
                </a>
                
                <a href="/cable" class="nav-item">
                    <i class="fa-solid fa-tv"></i>
                    <span>TV Subscription</span>
                </a>
                
                <a href="/electricity" class="nav-item">
                    <i class="fa-solid fa-bolt"></i>
                    <span>Electricity Bill</span>
                </a>
                
                <a href="/examination" class="nav-item">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <span>Exam Pins</span>
                </a>

                <div class="nav-section-title">Groups</div>

                <a href="/data_group" class="nav-item">
                    <i class="fa-solid fa-layer-group"></i>
                    <span>Data Group</span>
                </a>

                <a href="/airtime_group" class="nav-item">
                    <i class="fa-solid fa-people-group"></i>
                    <span>Airtime Group</span>
                </a>

                <div class="nav-section-title">Business</div>

                <a href="/my-giveaway" class="nav-item">
                    <i class="fa-solid fa-gift"></i>
                    <span>Create Giveaway</span>
                </a>

                <a href="/bulksms" class="nav-item">
                    <i class="fa-solid fa-message"></i>
                    <span>Bulk SMS</span>
                </a>

                <a href="/my-referral" class="nav-item">
                    <i class="fa-solid fa-users"></i>
                    <span>Referral Program</span>
                </a>

                <div class="nav-section-title">Support</div>

                <a href="/premium-verify_purchase" class="nav-item">
                    <i class="fa-solid fa-magnifying-glass-dollar"></i>
                    <span>Verify Purchase</span>
                </a>

                <a href="/verify_payment" class="nav-item">
                    <i class="fa-solid fa-receipt"></i>
                    <span>Verify Payment Funding</span>
                </a>

                <div class="nav-section-title">History</div>

                <a href="/mytransactions" class="nav-item {{ $active == 'transaction' ? 'active' : '' }}">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    <span>Transactions</span>
                </a>

                <div class="nav-section-title">Account</div>

                <a href="/profile" class="nav-item {{ $active == 'profile' ? 'active' : '' }}">
                    <i class="fa-solid fa-user-gear"></i>
                    <span>My Profile</span>
                </a>

                <a href="/logout" class="nav-item" onclick="return confirm('Are you sure you want to sign out?')">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Sign Out</span>
                </a>
            </div>

            <a href="/profile" class="user-profile">
                <div class="avatar">{{ substr($user->name, 0, 1) }}{{ substr(explode(' ', $user->name)[1] ?? '', 0, 1) }}</div>
                <div class="user-info">
                    <div style="font-weight:600; font-size: 0.9rem;">{{ $user->name }}</div>
                    <div style="font-size: 0.75rem; color: var(--text-secondary);">{{ ucfirst($user->user_type) }}</div>
                </div>
            </a>
        </nav>

        <!-- Main Content -->
        <div class="main-wrapper">
            <!-- Mobile Top Navbar -->
            <div class="top-navbar">
                <button class="hamburger" onclick="toggleSidebar()">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="serif" style="color: var(--primary-dark); font-size: 1.2rem;">
                    <img src="{{ asset('assets/img/logo/vtulogo.png') }}" alt="vtubiz" style="height: 30px;">
                </div>
                <div style="width: 40px;"></div> <!-- Spacer -->
            </div>

            <div class="content-area">
                @yield('content')
            </div>
            
            <a href="https://wa.me/2349058744473">
                <img src="{{ asset('assets/media/logos/whatsapp.png') }}" alt="whatsapp" id="fixedbutton">
            </a>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const hamburger = document.querySelector('.hamburger');
            const overlay = document.querySelector('.sidebar-overlay');
            
            if (window.innerWidth <= 991) {
                if (sidebar.classList.contains('show') && 
                    !sidebar.contains(event.target) && 
                    !hamburger.contains(event.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });

        // Handle Session Messages
        @if(session('message'))
            Swal.fire({ icon: 'success', title: 'Success!', text: "{{ session('message') }}", confirmButtonColor: '#0F3548' });
        @endif

        @if(session('success'))
            Swal.fire({ icon: 'success', title: 'Success!', text: "{{ session('success') }}", confirmButtonColor: '#0F3548' });
        @endif

        @if(session('error'))
            Swal.fire({ icon: 'error', title: 'Error!', text: "{{ session('error') }}", confirmButtonColor: '#0F3548' });
        @endif

        // Handle Notifications
        @if(isset($notification))
            Swal.fire({
                title: '',
                html: `
                    <img src="{{ asset('assets/img/not.jpg') }}" style="width: 100%; max-height: 150px; object-fit: cover; border-radius: 12px; margin-bottom: 15px;">
                    <h2 style="font-family: 'Fraunces', serif; font-weight: bold; margin-bottom: 10px;">{{ $notification->title }}</h2>
                    <div style="font-size: 14px; color: #666; line-height: 1.6;">{!! $notification->description !!}</div>
                `,
                showCloseButton: true,
                showConfirmButton: false,
                customClass: { popup: 'modern-swal-popup' }
            });
        @endif

        @if(isset($dod))
            Swal.fire({
                title: '',
                html: `
                    <img src="{{ asset('assets/img/discount.jpg') }}" style="width: 100%; max-height: 150px; object-fit: cover; border-radius: 12px; margin-bottom: 15px;">
                    <h2 style="font-family: 'Fraunces', serif; font-weight: bold; margin-bottom: 10px;">{{ $dod->title }}</h2>
                    <div style="font-size: 18px; font-weight: 600; color: var(--primary-dark);">{!! $dod->description !!}</div>
                `,
                showCloseButton: true,
                showConfirmButton: false,
                customClass: { popup: 'modern-swal-popup' }
            });
        @endif
    </script>

    @yield('script')
</body>
</html>
