<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard - VTUBIZ</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,600&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">

    <style>
        :root {
            --primary-dark: #0F3548;
            --primary-light: #1a4a5e;
            --accent-orange: #fb9129;
            --accent-green: #27ae60;
            --accent-blue: #2f80ed;
            --accent-pink: #eb5757;
            --surface: #FFFFFF;
            --background: #F8F9FA;
            --text-main: #1A1A1A;
            --text-secondary: #666666;
            --text-light: #999999;
            --sidebar-width: 280px;
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 24px;
            --radius-pill: 999px;
            --shadow-card: 0 10px 30px rgba(0,0,0,0.04);
            --space-lg: 40px;
            --space-md: 24px;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--background);
            color: var(--text-main);
            overflow-x: hidden;
        }

        .serif { font-family: 'Fraunces', serif; }

        /* Sidebar Styling */
        #sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: var(--primary-dark);
            color: white;
            z-index: 1000;
            transition: all 0.3s ease;
            padding: var(--space-md);
            overflow-y: auto;
        }

        .sidebar-logo {
            padding: 0 15px 30px;
            font-family: 'Fraunces', serif;
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--accent-orange);
        }

        .nav-section-title {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: rgba(255,255,255,0.4);
            margin: 25px 15px 15px;
            font-weight: 700;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            border-radius: var(--radius-md);
            margin-bottom: 5px;
            transition: all 0.2s;
            font-weight: 500;
        }

        .nav-item i {
            width: 24px;
            margin-right: 12px;
            font-size: 1.1rem;
        }

        .nav-item:hover, .nav-item.active {
            background: rgba(255,255,255,0.1);
            color: white;
        }

        .nav-item.active {
            background: var(--accent-orange);
            color: var(--primary-dark);
        }

        /* Main Content Styling */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        .top-navbar {
            padding: 20px var(--space-lg);
            background: transparent;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .content-area {
            padding: 0 var(--space-lg) var(--space-lg);
        }

        /* Responsive */
        @media (max-width: 991px) {
            #sidebar { left: calc(-1 * var(--sidebar-width)); }
            #sidebar.show { left: 0; }
            .main-wrapper { margin-left: 0; }
            .content-area { padding: 0 20px 20px; }
        }

        /* Utility Classes */
        .card-modern {
            background: var(--surface);
            border-radius: var(--radius-lg);
            padding: var(--space-md);
            box-shadow: var(--shadow-card);
            border: none;
        }

        .btn-modern {
            border-radius: var(--radius-pill);
            padding: 10px 24px;
            font-weight: 600;
            transition: all 0.2s;
        }
    </style>
    @yield('header')
</head>
<body>

    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-logo">VTUBIZ</div>
        
        <div class="nav-section-title">Overview</div>
        <a href="/manager" class="nav-item {{ Request::is('manager') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-pie"></i>
            <span>Dashboard</span>
        </a>

        <div class="nav-section-title">Transactions</div>
        <a href="/manager/purchase_records" class="nav-item {{ Request::is('manager/purchase_records') || Request::is('manager/purchase_records_graph') ? 'active' : '' }}">
            <i class="fa-solid fa-shopping-cart"></i>
            <span>Purchase Records</span>
        </a>
        <a href="/manager/transactions" class="nav-item {{ Request::is('manager/transactions') || Request::is('manager/user_transaction/*') ? 'active' : '' }}">
            <i class="fa-solid fa-list-ul"></i>
            <span>All Transactions</span>
        </a>
        <a href="/manager/duplicate_transactions" class="nav-item {{ Request::is('manager/transactions') || Request::is('manager/user_transaction/*') ? 'active' : '' }}">
            <i class="fa-solid fa-list-ul"></i>
            <span>Pending Transactions</span>
        </a>
        <a href="/manager/payment_transactions" class="nav-item {{ Request::is('manager/payment_transactions') ? 'active' : '' }}">
            <i class="fa-solid fa-tags"></i>    
            <span>Payment/Funding</span>
        </a>

        <div class="nav-section-title">Users</div>
        <a href="/manager/user_management" class="nav-item {{ Request::is('manager/user_management') ? 'active' : '' }}">
            <i class="fa-solid fa-users"></i>
            <span>User Management</span>
        </a>
        <a href="/manager/new_users" class="nav-item {{ Request::is('manager/new_users') ? 'active' : '' }}">
            <i class="fa-solid fa-user-plus"></i>
            <span>New Users</span>
        </a>

        <div class="nav-section-title">Notifications</div>
      
        <a href="/manager/notifications" class="nav-item {{ Request::is('manager/notifications') ? 'active' : '' }}">
            <i class="fa-solid fa-bell"></i>
            <span>Notifications</span>
        </a>

        <div class="nav-section-title">Other</div>
        <a href="/manager/admin_blog" class="nav-item {{ Request::is('manager/admin_blog') || Request::is('manager/create_blog') || Request::is('manager/editblog/*') ? 'active' : '' }}">
            <i class="fa-solid fa-newspaper"></i>
            <span>Blog</span>
        </a>
        <a href="/dashboard" class="nav-item">
            <i class="fa-solid fa-arrow-left"></i>
            <span>User Dashboard</span>
        </a>
        <a href="/logout" class="nav-item text-danger">
            <i class="fa-solid fa-right-from-bracket"></i>
            <span>Logout</span>
        </a>
    </nav>

    <!-- Main Wrapper -->
    <div class="main-wrapper">
        <div class="top-navbar">
            <button class="btn d-lg-none" onclick="toggleSidebar()">
                <i class="fa-solid fa-bars-staggered fs-4"></i>
            </button>
            <div class="ms-auto d-flex align-items-center gap-3">
                <div class="text-end d-none d-sm-block">
                    <div class="fw-bold">{{ $user->name }}</div>
                    <div class="text-muted small">Manager Account</div>
                </div>
                <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 45px; height: 45px;">
                    <i class="fa-solid fa-user-tie text-primary"></i>
                </div>
            </div>
        </div>

        <div class="content-area">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
        }

        $(document).ready(function() {
            // Global DataTable defaults
            $.extend(true, $.fn.dataTable.defaults, {
                language: {
                    search: "",
                    searchPlaceholder: "Search records..."
                }
            });
        });
    </script>
    @yield('script')
</body>
</html>