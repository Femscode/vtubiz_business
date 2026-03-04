<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Top Up, Pay Bills, Stay Connected!">
  <meta name="keywords" content="Build your own professional VTU website for free">
  <meta name="author" content="elemis">
  <title>VTUBIZ | HOME </title>
  <link rel="shortcut icon" href="assets/media/logos/fav_01.png" />

  <link rel="stylesheet" href="frontpage/assets/css/plugins.css">
  <link rel="stylesheet" href="frontpage/assets/css/style.css">
  <link rel="stylesheet" href="frontpage/assets/css/colors/yellow.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  {{--
  <link rel="preload" href="frontpage/assets/css/fonts/thicccboi.css" as="style" onload="this.rel='stylesheet'"> --}}
  {{--
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> --}}
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">

  <meta name="google-adsense-account" content="ca-pub-9520357947525167">

  <!-- //google ads -->
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9520357947525167"
    crossorigin="anonymous"></script>

  <style>
    :root {
      --bg-page: #FFFFFF; 
      --bg-card: #F8F9FA; 
      --text-primary: #000000; 
      --text-secondary: #555555; 
      --radius-xl: 32px; 
      --radius-lg: 24px; 
      --radius-md: 16px; 
      --radius-sm: 8px; 
      --font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif; 
      --h1-weight: 800; 
      --h1-tracking: -0.04em; 
      --shadow-float: 0 20px 40px -5px rgba(0, 0, 0, 0.06), 0 8px 16px -8px rgba(0, 0, 0, 0.04); 
      --shadow-hover: 0 30px 60px -10px rgba(0, 0, 0, 0.12), 0 12px 24px -8px rgba(0, 0, 0, 0.06); 
      --color-data: #EDFCF2; 
      --icon-data: #16A34A; 
      --color-airtime: #FFF7ED; 
      --icon-airtime: #EA580C; 
      --color-tv: #F5F3FF; 
      --icon-tv: #7C3AED; 
      --color-power: #FEFCE8; 
      --icon-power: #CA8A04; 
      --color-accent: #000000; 
      --h1-size: 3.5rem;
    }

    .pricing.card {
      height: 100%;
      display: flex;
      flex-direction: column;
      border-radius: 15px;
      transition: transform 0.3s ease;
    }

    .pricing.card:hover {
      transform: translateY(-10px);
    }

    .pricing .card-body {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
    }

    .plan-list-container {
      height: 300px;
      overflow-y: auto;
      margin-top: 1.5rem;
      margin-bottom: 1.5rem;
      padding-right: 10px;
    }

    /* Custom Scrollbar */
    .plan-list-container::-webkit-scrollbar {
      width: 4px;
    }

    .plan-list-container::-webkit-scrollbar-track {
      background: #f1f1f1;
    }

    .plan-list-container::-webkit-scrollbar-thumb {
      background: #3f78e0;
      border-radius: 10px;
    }

    .plan-list-container::-webkit-scrollbar-thumb:hover {
      background: #3464bc;
    }

    .icon-list.bullet-soft-primary li {
      padding-left: 1.5rem;
      margin-bottom: 0.75rem;
    }

    .icon-list.bullet-soft-primary i {
      font-size: 1.1rem;
      top: 0.2rem;
    }

    /* Avatar Group Styles */
    .avatar-group {
      display: flex;
      align-items: center;
    }

    .avatar {
      width: 2rem;
      height: 2rem;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 2px solid #fff;
      font-size: 0.75rem;
      font-weight: 700;
    }

    .bg-soft-primary {
      background-color: rgba(63, 120, 224, 0.1) !important;
    }

    .bg-soft-success {
      background-color: rgba(68, 187, 164, 0.1) !important;
    }

    .bg-soft-info {
      background-color: rgba(84, 168, 221, 0.1) !important;
    }

    .text-primary {
      color: #3f78e0 !important;
    }

    .text-success {
      color: #44bba4 !important;
    }

    .text-info {
      color: #54a8dd !important;
    }

    .lift {
      transition: all 0.2s ease-in-out;
    }

    .lift:hover {
      transform: translateY(-3px);
      box-shadow: 0 0.5rem 1.5rem rgba(30, 34, 40, 0.1);
    }

    /* Floating Card Styles */
    .hero-card-container {
      position: relative;
      height: 450px;
      width: 100%;
      max-width: 500px;
      margin: 0 auto;
    }

    .hero-card {
      border-radius: 20px;
      background: #fff;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
      cursor: pointer;
      width: 100%;
      height: 100%;
    }

    .hero-card:hover {
      z-index: 50 !important;
      transform: scale(1.1) translateY(-10px) !important;
      box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
    }

    .hero-card-wrapper {
      position: absolute;
    }

    .wrapper-main {
      width: 320px;
      height: 400px;
      top: 0;
      left: 0;
      z-index: 1;
    }

    .hero-card-main {
      overflow: hidden;
      background: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      border: 12px solid #fff;
    }

    .wrapper-success {
      width: 250px;
      top: 10%;
      right: -15%;
      z-index: 3;
    }

    .hero-card-success {
      padding: 24px;
      border: 1px solid rgba(0, 0, 0, 0.03);
    }

    .wrapper-wallet {
      width: 260px;
      bottom: -5%;
      left: -15%;
      z-index: 4;
    }

    .hero-card-wallet {
      padding: 24px;
      background: #000;
      color: #fff;
    }
    /* Product Section Redesign */
    .products-box {
      background: #f6f7f9;
      border-radius: 40px;
      padding: 80px 60px;
      margin: 0 auto;
      max-width: 1100px;
    }
    @media (max-width: 768px) {
      .products-box {
        padding: 40px 20px;
        border-radius: 24px;
      }
      .product-card {
        padding: 20px;
      }
    }
    .product-card {
      background: #fff;
      border-radius: 24px;
      padding: 30px;
      height: 100%;
      border: 1px solid rgba(0,0,0,0.02);
      transition: all 0.3s ease;
      text-align: left !important;
    }
    .product-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }
    .product-icon-box {
      width: 50px;
      height: 50px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 25px;
      font-size: 1.5rem;
    }
    .bg-soft-green { background: #eef9f6; color: #44bba4; }
    .bg-soft-purple { background: #f3f0ff; color: #7048e8; }
    .bg-soft-yellow { background: #fff9db; color: #fab005; }
    .bg-soft-orange { background: #fff4e6; color: #fd7e14; }
    .bg-soft-blue-alt { background: #e7f5ff; color: #228be6; }
    
    .product-card h4 {
      font-weight: 700;
      margin-bottom: 12px;
      color: #000;
    }
    .product-card p {
      color: #6c757d;
      font-size: 0.95rem;
      line-height: 1.6;
    }
    
    /* Business Section Redesign */
    .reseller-section {
      display: flex;
      align-items: center;
      gap: 60px;
      padding: 40px 0 80px 0;
    }
    .reseller-card {
      background: #000;
      color: #fff;
      border-radius: var(--radius-xl);
      padding: 64px;
      position: relative;
      overflow: hidden;
      min-height: 500px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      flex: 1;
      font-family: var(--font-family);
    }
    .reseller-card .blob {
      position: absolute;
      width: 300px;
      height: 300px;
      border-radius: 50%;
      filter: blur(80px);
      z-index: 1;
    }
    .blob-1 {
      background: rgba(63, 120, 224, 0.25);
      top: -100px;
      right: -100px;
    }
    .blob-2 {
      background: rgba(251, 145, 41, 0.15);
      bottom: -100px;
      left: -100px;
    }
    .reseller-content {
      position: relative;
      z-index: 2;
    }
    .reseller-content h2 {
      font-size: 2.0rem;
      font-weight: var(--h1-weight);
      letter-spacing: var(--h1-tracking);
      line-height: 1.1;
      margin-bottom: 24px;
      color: #fff;
    }
    .reseller-content .price-tag {
      background: rgba(255, 255, 255, 0.1);
      color: #10B981;
      padding: 6px 16px;
      border-radius: 50px;
      font-size: 0.85rem;
      font-weight: 700;
      display: inline-block;
      margin-bottom: 24px;
    }
    .reseller-content .btn {
      background: white;
      color: black;
      align-self: flex-start;
      border-radius: 50px;
      padding: 14px 32px;
      font-weight: 700;
      text-decoration: none;
      transition: transform 0.2s ease;
    }
    .reseller-content .btn:hover {
      transform: translateY(-2px);
    }
    
    .pricing-info {
      flex: 0 0 400px;
      padding: 20px;
    }
    .pricing-info .price-tag-large {
      font-size: 64px;
      font-weight: 800;
      letter-spacing: -0.04em;
      color: #000;
      line-height: 1;
      margin-bottom: 8px;
    }
    .pricing-info .price-sub {
      font-size: 20px;
      color: var(--text-secondary);
      margin-bottom: 32px;
    }
    .pricing-info ul {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 16px;
      padding: 0;
    }
    .pricing-info li {
      display: flex;
      align-items: center;
      gap: 12px;
      font-weight: 500;
      color: #333;
    }

    @media (max-width: 991px) {
      .reseller-section { flex-direction: column; gap: 40px; }
      .pricing-info { flex: 1; width: 100%; padding: 0; }
      .reseller-card { padding: 40px; min-height: auto; }
    }

    .hero-card-wallet .token-badge {
      background: rgba(255, 255, 255, 0.15);
      color: #fff;
      padding: 4px 12px;
      border-radius: 50px;
      font-size: 0.75rem;
      font-weight: 700;
      display: inline-block;
      margin-bottom: 10px;
    }

    .hero-card-wallet .amount {
      font-size: 1.5rem;
      font-weight: 700;
      color: #fff;
    }

    .hero-card-main img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 12px;
    }

    .success-icon {
      width: 40px;
      height: 40px;
      background: #eef9f6;
      color: #44bba4;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 15px;
    }

    .text-gradient-1 {
      color: #fb9129;
    }

    .text-gradient-2 {
      color: #3f78e0;
    }

    .text-gradient-3 {
      color: #44bba4;
    }

    .btn-dark-hero {
      background: #000;
      color: #fff;
      border: none;
    }

    .btn-dark-hero:hover {
      background: #333;
      color: #fff;
    }

    @media (max-width: 991px) {
      .hero-card-container {
        height: 350px;
        margin-top: 3rem;
        max-width: 260px;
      }
      .wrapper-main { 
        width: 200px; 
        height: 280px; 
        left: 50%; 
        margin-left: -100px;
      }
      .wrapper-success { 
        width: 150px; 
        top: 10%; 
        right: -20%; 
      }
      .wrapper-wallet { 
        width: 160px; 
        bottom: 5%; 
        left: -20%; 
      }
      /* Compact content for mobile cards */
      .hero-card-success, .hero-card-wallet {
        padding: 15px !important;
      }
      .hero-card h5 { font-size: 0.9rem !important; }
      .hero-card p { font-size: 0.75rem !important; }
      .hero-card .amount { font-size: 1.1rem !important; }
      .hero-card .token-badge { padding: 2px 8px !important; font-size: 0.65rem !important; }
      .success-icon { width: 30px !important; height: 30px !important; margin-bottom: 8px !important; }
    }

  /* Network Heading Styles */
  .network-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 1px solid rgba(0,0,0,0.05);
  }
  .network-icon {
    width: 45px;
    height: 45px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    font-weight: 800;
    color: #fff;
  }
  .network-mtn { background: #ffcc00; color: #000 !important; }
  .network-glo { background: #00853f; }
  .network-airtel { background: #ff0000; }
  .network-nmobile { background: #006666; }
  
  .network-info h4 {
    margin-bottom: 2px;
    font-weight: 700;
    font-size: 1.1rem;
  }
  .network-info .badge {
    font-size: 0.65rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 4px 8px;
  }
</style>
</head>

<body>
  <div class="content-wrapper">
    <header class="wrapper bg-soft-primary">
      <nav class="navbar navbar-expand-lg center-nav transparent navbar-light">
        <div class="container flex-lg-row flex-nowrap align-items-center">
          <div class="navbar-brand w-100">
            <a href="#">
              <img src="{{ asset('assets/img/logo/vtulogo.png') }}" srcset="{{ asset('assets/img/logo/vtulogo.png') }}"
                width='100px' height='25px' alt="">
              {{-- <h4>VTUBIZ</h4> --}}
            </a>
          </div>
          <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start" style="visibility: hidden;"
            aria-hidden="true">
            <div class="offcanvas-header d-lg-none">
              <h3 class="text-black fs-30 mb-0"> <img src="{{ asset('assets/img/logo/vtulogo.png') }}" width='100px' height='25px' alt="" /></h3>
              <button type="button" class="fa fa-close" style=' display: inline-block;
              padding: 5px 7px;
              font-size: 16px;
              font-weight: bold;
              text-align: center;
              text-decoration: none;
              border:0px solid white;
              border-radius: 3px;             
              cursor: pointer;' data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
            </div>
            <div class="offcanvas-body ms-lg-auto d-flex flex-column h-100">
              <ul class="navbar-nav">

                <li class="nav-item dropdown">
                  <a class="nav-link" href="#" data-bs-toggle="dropdown">Our Products <i class='fa fa-angle-down'></i></a>
                  <ul class="dropdown-menu">

                    <li class="dropdown-item"><a href='/data'>Affordable Dataplans</a></li>
                    <li class="dropdown-item"><a href='/airtime'>Airtime Top Up</a></li>
                    <li class="dropdown-item"><a href='/cable'>Cable Subscription</a></li>
                    <li class="dropdown-item"><a href='/electricity'>Pay Light Bills</a></li>
                    <li class="dropdown-item"><a href='/examination'>Exam Result Checkers</a></li>
                    <li class="dropdown-item"><a href='/bulksms'>Bulk SMS</a></li>
                  </ul>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link" href="#" data-bs-toggle="dropdown">Our Features <i class='fa fa-angle-down'></i></a>
                  <ul class="dropdown-menu">

                    <li class="dropdown-item">Transaction Redo</li>
                    <li class="dropdown-item">Save Beneficiary</li>
                    <li class="dropdown-item">Bulk/Group Purchase</li>
                    <li class="dropdown-item">Schedule Purchase</li>
                    <li class="dropdown-item">Offline Purchase</li>
                    <li class="dropdown-item">Self Service</li>
                  </ul>
                </li>

                <li class="nav-item dropdown">
                  <a class="nav-link" href="/blogs">Our Blog</a>

                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link" href="#" data-bs-toggle="dropdown">Login <i class='fa fa-angle-down'></i></a>
                  <ul class="dropdown-menu">
                    <li class="nav-item"><a class="dropdown-item" href="/login">Login
                      </a></li>
                    <li class="nav-item"><a class="dropdown-item" href="/register">Register
                      </a></li>


                  </ul>
                </li>


              </ul>
              <!-- /.navbar-nav -->
              <div class="offcanvas-footer d-lg-none">
                <div>
                  <a href="mailto:support@vtubiz.com" class="link-inverse"><span
                      class="__cf_email__">support@vtubiz.com</span></a>
                  <br /> (234) 905 8744 473 <br />
                  {{-- <nav class="nav social social-white mt-4">
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-facebook-f"></i></a>
                    <a href="#"><i class="fa fa-dribbble"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-youtube"></i></a>
                  </nav> --}}
                  <!-- /.social -->
                </div>
              </div>
              <!-- /.offcanvas-footer -->
            </div>
            <!-- /.offcanvas-body -->
          </div>
          <!-- /.navbar-collapse -->
          <div class="navbar-other w-100 d-flex ms-auto">
            <ul class="navbar-nav flex-row align-items-center ms-auto">

              <li class="nav-item"><a class="nav-link" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-info">About
                  Us →</a></li>
              <li class="nav-item d-lg-none">
                <button class="hamburger offcanvas-nav-btn"><span></span></button>
              </li>
            </ul>
            <!-- /.navbar-nav -->
          </div>
          <!-- /.navbar-other -->
        </div>
        <!-- /.container -->
      </nav>

      <div class="offcanvas offcanvas-end text-inverse" id="offcanvas-info" data-bs-scroll="true">
        <div class="offcanvas-header">
          <h3 class="text-white fs-30 mb-0">VTUBIZ</h3>
          <button type="button" class="fa fa-close" style=' display: inline-block;
              padding: 5px 7px;
              font-size: 16px;
              font-weight: bold;
              text-align: center;
              text-decoration: none;
              border:0px solid white;
              border-radius: 3px;             
              cursor: pointer;' data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
        </div>
        <div class="offcanvas-body pb-6">
          <div class="widget mb-8">
            <p>We provide a comprehensive platform for all your data, airtime, electricity, and cable subscription
              needs. Our mission is to empower your digital lifestyle through affordability, automation, and
              lightning-fast transactions.</p>
          </div>
          <!-- /.widget -->
          <div class="widget mb-8">
            <h4 class="widget-title text-white mb-3">Contact Info</h4>
            <address> No 1, Igbelowowa Street, Kobape <br /> Abeokuta, Ogun State </address>
            <a href="mailto:support@vtubiz.com"><span class="__cf_email__">support@vtubiz.com</span></a><br />(234) 905
            8744 473
          </div>
          <!-- /.widget -->
          <div class="widget mb-8">
            <h4 class="widget-title text-white mb-3">Learn More</h4>
            <ul class="list-unstyled">
              <li><a href="#">Our Story</a></li>
              <li><a href="#">Terms of Use</a></li>
              <li><a href="#">Privacy Policy</a></li>
              <li><a href="#">Contact Us</a></li>
            </ul>
          </div>
          <!-- /.widget -->
          <div class="widget">
            <h4 class="widget-title text-white mb-3">Follow Us</h4>
            {{-- <nav class="nav social">
              <a href="#"><i class="fa fa-twitter"></i></a>
              <a href="#"><i class="fa fa-facebook"></i></a>             
              <a href="#"><i class="fa fa-instagram"></i></a>
            </nav> --}}
            <!-- /.social -->
          </div>
          <!-- /.widget -->
        </div>
        <!-- /.offcanvas-body -->
      </div>
      <!-- /.offcanvas -->
    </header>
    <!-- /header -->
    <section class="wrapper bg-light">
      <div class="container pt-10 pt-md-14 pb-8 pb-md-10">
        <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-center">
          <div class="col-md-10 offset-md-1 offset-lg-0 col-lg-6 text-center text-lg-start">
            <h1 class="display-1 mb-4 mx-md-n5 mx-lg-0 fw-bolder" style="font-size: clamp(2.5rem, 5vw, 4.2rem); line-height: 1.05; color: #001f3f; letter-spacing: -2px;">
              Top Up,
              <span style="color: #fb9129;">Pay Bills,</span>
              Stay Connected Always.
            </h1>
            <!-- <h1 class="display-1 mb-4 mx-md-n5 mx-lg-0 fw-bolder" style="font-size: clamp(2.5rem, 5vw, 4.2rem); line-height: 1.05; color: #001f3f; letter-spacing: -2px;">
              Never run out of <br>
              airtime, <span style="color: #fb9129;">data</span> or <br>
              electricity again.
            </h1> -->
            <p class="lead fs-lg mb-7 pe-xxl-10" style="max-width: 500px; line-height: 1.6;">
              The smartest way to buy data, pay electricity bills, and renew subscriptions. Fast, secure, and instant.
            </p>
            <div class="d-flex justify-content-center justify-content-lg-start gap-3 flex-wrap">
              <a href='/register' class="btn btn-lg btn-dark-hero rounded-pill px-6 lift">Get Started</a>
              <a href='/login' class="btn btn-lg btn-outline-dark rounded-pill px-6 lift">Login</a>
            </div>
          </div>
          <!-- /column -->

          <div class="col-lg-6">
            <div class="hero-card-container">
              <!-- Main Product Card -->
              <div class="rellax hero-card-wrapper wrapper-main" data-rellax-speed="0.5">
                <div class="hero-card hero-card-main shadow-xl">
                  <img src="{{ asset('assets/img/Work_7.jpg') }}" alt="VTUBIZ App Interface">
                </div>
              </div>

              <!-- Success Notification Card -->
              <div class="rellax hero-card-wrapper wrapper-success" data-rellax-speed="1.2">
                <div class="hero-card hero-card-success shadow-lg">
                  <div class="success-icon">
                    <i class="fa fa-lightbulb"></i>
                  </div>
                  <h5 class="mb-1 fw-bold">Electricity Token</h5>
                  <p class="fs-14 mb-0 text-muted">Same money. More light. ⚡
                     <!-- <br>Why your bank dey give you small units? -->
                    </p>
                </div>
              </div>

              <!-- Data Subscription Card -->
              <div class="rellax hero-card-wrapper wrapper-wallet" data-rellax-speed="-0.5">
                <div class="hero-card hero-card-wallet shadow-xl">
                  <span class="token-badge"><i class="fa fa-mobile-alt me-1"></i> Special Offer On MTN</span>
                  <div class="amount mb-1">11GB for ₦3,450</div>
                  <p class="fs-13 mb-0 opacity-75">Enjoy 7 Days of connectivity.</p>
                  <div class="mt-2 fs-12 text-success fw-bold">
                    <i class="fa fa-clock me-1"></i> Delivered Instantly
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-light">
      <div class="container pt-4 pt-md-6 pb-6 pb-md-8">
        <div class="products-box">
          <div class="row text-center mb-10">
            <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-2">
              <h2 class="display-3 mb-4 fw-bold" style="color: #000; letter-spacing: -1px;">Everything you need.</h2>
              <p class="lead fs-lg text-muted">One platform for all your daily digital utility payments.</p>
            </div>
            <!-- /column -->
          </div>
          <!-- /.row -->
          <div class="position-relative">
            <div class="row gx-md-5 gy-5 text-center justify-content-center">
              <div class="col-md-6 col-xl-4">
                <div class="product-card shadow-sm">
                  <div class="product-icon-box bg-soft-green">
                    <i class="fa fa-wifi"></i>
                  </div>
                  <h4>Airtime Top-Up</h4>
                  <p>Buy airtime and get more value for your money. Fast top-up, better rates, no dulling.</p>
                </div>
              </div>
              <!--/column -->
              <div class="col-md-6 col-xl-4">
                <div class="product-card shadow-sm">
                  <div class="product-icon-box bg-soft-blue-alt">
                    <i class="fa fa-signal"></i>
                  </div>
                  <h4>Affordable Data Plans</h4>
                  <p>Browse, stream, and chat with cheap data that lasts longer. Stay online without draining your pocket.</p>
                </div>
              </div>
              <!--/column -->
              <div class="col-md-6 col-xl-4">
                <div class="product-card shadow-sm">
                  <div class="product-icon-box bg-soft-purple">
                    <i class="fa fa-tv"></i>
                  </div>
                  <h4>Tv(Cable) Subscriptions</h4>
                  <p>Renew your cable in seconds and never miss your favorite shows. Easy payment. Instant activation.</p>
                </div>
              </div>
              <!--/column -->
              <div class="col-md-6 col-xl-4">
                <div class="product-card shadow-sm">
                  <div class="product-icon-box bg-soft-yellow">
                    <i class="fa fa-bolt"></i>
                  </div>
                  <h4>Electricity Token</h4>
                  <p>Pay for light and get more units for your money. Recharge your meter fast and enjoy longer power.</p>
                </div>
              </div>
              <!--/column -->
              <div class="col-md-6 col-xl-4">
                <div class="product-card shadow-sm">
                  <div class="product-icon-box bg-soft-orange">
                    <i class="fa fa-graduation-cap"></i>
                  </div>
                  <h4>Exam Result Checkers</h4>
                  <p>Check your results instantly at giveaway prices. No queues. No stress. Just results.</p>
                </div>
              </div>
              <!--/column -->
              <div class="col-md-6 col-xl-4">
                <div class="product-card shadow-sm">
                  <div class="product-icon-box bg-soft-green">
                    <i class="fa fa-comment-dots"></i>
                  </div>
                  <h4>Bulk SMS</h4>
                  <p>Send your message to thousands in one click. Perfect for business, promos, and announcements.</p>
                </div>
              </div>
              <!--/column -->
            </div>
            <!--/.row -->
          </div>
          <!-- /.position-relative -->
        </div>
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-gradient-primary">
      <div class="container pt-8 pb-4 pt-md-10 pb-md-6">
        <div class="position-relative">
          <div class="row text-center">
            <div class="col-lg-8 col-xl-7 col-xxl-6 mx-auto">
              <h2 class="fs-16 text-uppercase text-muted mb-3">Our Features</h2>
              <h3 class="display-4 mb-10 px-md-13 px-lg-4 px-xl-0">Get to know our amazing features that made us stand
                out.</h3>
            </div>
            <!-- /column -->
          </div>
          <!-- /.row -->
          <div class="position-relative">
            <div class="shape bg-dot blue rellax w-16 h-17" data-rellax-speed="1"
              style="bottom: 0.5rem; right: -1.7rem; z-index: 0;"></div>
            <div class="shape rounded-circle bg-line red rellax w-16 h-16" data-rellax-speed="1"
              style="top: 0.5rem; left: -1.7rem; z-index: 0;"></div>
            <div class="row grid-view gy-6 gy-xl-0">
              <div class="col-md-6 col-xl-3">
                <div class="card shadow-lg">
                  <div class="card-body">

                    <h4 class="mb-1">Transaction Redo</h4>

                    <p class="mb-2">Experience hassle-free transaction retries with a single click.</p>

                    <!-- /.social -->
                  </div>
                  <!--/.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!--/column -->
              <div class="col-md-6 col-xl-3">
                <div class="card shadow-lg">
                  <div class="card-body">

                    <h4 class="mb-1">Group Purchases</h4>

                    <p class="mb-2">Create as many group as you want, and initiate a purchase in one click.</p>

                    <!-- /.social -->
                  </div>
                  <!--/.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!--/column -->
              <div class="col-md-6 col-xl-3">
                <div class="card shadow-lg">
                  <div class="card-body">

                    <h4 class="mb-1">Schedule For Later Purchases</h4>

                    <p class="mb-2">Plan your purchase ahead, even when you are offline, we keep you connected!</p>

                  </div>
                  <!--/.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!--/column -->
              <div class="col-md-6 col-xl-3">
                <div class="card shadow-lg">
                  <div class="card-body">
                    {{-- <img class="rounded-circle w-15 mb-4" src="assets/img/avatars/te4.jpg"
                      srcset="./assets/img/avatars/te4@2x.jpg 2x" alt="" /> --}}
                    <h4 class="mb-1">Save Up Beneficiaries</h4>

                    <p class="mb-2">Simplified future purchases by saving contacts, meter & decoder's number.</p>

                  </div>
                  <!--/.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!--/column -->
            </div>
            <!--/.row -->
          </div>
          <!-- /.position-relative -->
        </div>
        <!-- /div -->
      </div>
      <!-- /.container -->
    </section>

    <section id='free_vtu' class="wrapper bg-light">
      <div class="container">
        <div class="reseller-section">
          <div class="reseller-card">
            <div class="blob blob-1"></div>
            <div class="blob blob-2"></div>
            
            <div class="reseller-content">
              <span class="price-tag">Best Value</span>
              <h2>Start your own <br>VTU Business.</h2>
              <p style="font-size: 1.25rem; opacity: 0.8; margin-bottom: 40px; max-width: 450px;">
                Get a fully functional VTU portal with your own branding, domain, and admin panel. Automate your income today.
              </p>
              <a href="/business" class="btn">Get Started Now</a>
            </div>
          </div>

          <div class="pricing-info">
            <div class="price-tag-large">₦45,000</div>
            <p class="price-sub">One-time setup fee.</p>
            
            <ul>
              <li>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                Custom Domain Name
              </li>
              <li>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                Admin Dashboard
              </li>
              <li>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                API Access
              </li>
              <li>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#10B981" stroke-width="3"><polyline points="20 6 9 17 4 12"></polyline></svg>
                Unlimited Transactions
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- /.container -->
    </section>

    <section class="wrapper bg-gradient-reverse-primary">
      <div class="container pt-8 pb-4 pt-md-10 pb-md-6">
        <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-center">
          <div class="col-lg-5">
            <h2 class="fs-16 text-uppercase text-muted mb-3 mt-lg-n6">Our Community</h2>
            <img src='https://preview.keenthemes.com/metronic8/demo1/assets/media/illustrations/unitedpalms-1/17.png'
              style='width:350px;height:250px' />

            {{-- <img src="{{ asset('assets/img/illustrations/i5.png') }}" style='width:300px;height:200px' /> --}}
            <h3 class="display-4 mb-5">Don't take our word for it. See what customers are saying about us.</h3>
            {{-- <p>Experience our service through the eyes of our satisfied customers. Discover what real users have to
              say
              about their VTU website creation journey with us.</p> --}}
            {{-- <a href="#" class="btn btn-primary rounded-pill mt-3">All Testimonials</a> --}}
          </div>
          <div class="col-lg-7">
            <div class="row gx-md-5 gy-5">
              <div class="col-md-6 col-xl-6 align-self-end">
                <div class="card shadow-lg">
                  <div class="card-body">
                    <blockquote class="icon mb-0">
                      <p style='font-size:12px'>“VTUBIZ has simplified the way I handle my transactions. The option to
                        schedule purchases is a game-changer, and the bulk SMS feature is a bonus. It's fast, efficient,
                        reliable, and a must-have for anyone looking for convenience in their daily transactions.”</p>
                      <div class="blockquote-details">
                        <div class="info p-0">
                          <h5 class="mb-1">Patrick Mercy</h5>
                          {{-- <a style='font-size:12px;color:red' href='https://my.vtubiz.com'>amusan.vtubiz.com</a>
                          --}}
                        </div>
                      </div>
                    </blockquote>
                  </div>
                  <!--/.card-body -->
                </div>
                <!--/.card -->
              </div>
              <!--/column -->
              <div class="col-md-6 align-self-end">
                <div class="card shadow-lg">
                  <div class="card-body">
                    <blockquote class="icon mb-0">
                      <p style='font-size:12px'>“Kudos to VTUBIZ! The platform's innovative features like saving
                        beneficiaries and group/bulk purchase have made it my go-to for all things related to airtime,
                        data, bills, and more. It's user-friendly, reliable, and simply the best in the business!”</p>
                      <div class="blockquote-details">
                        <div class="info p-0">
                          <h5 class="mb-1">Fasanya Victor</h5>
                          {{-- <a style='font-size:12px;color:red'
                            href='https://my.vtubiz.com'>Dee-enterprises.vtubiz.cam</a> --}}
                        </div>
                      </div>
                    </blockquote>
                  </div>
                  <!--/.card-body -->
                </div>
                <!--/.card -->
              </div>
              <!--/column -->
              <div class="col-md-6 col-xl-5 offset-xl-1">
                <div class="card shadow-lg">
                  <div class="card-body">
                    <blockquote class="icon mb-0">
                      <p style='font-size:12px'>“As a reseller, partnering with VTUBIZ has significantly boosted my
                        revenue. The wide array of services, coupled with features like transaction redo and bulk
                        purchase, has set my business apart. It's not just a platform; it's a reseller's key to
                        success!”</p>
                      <div class="blockquote-details">
                        <div class="info p-0">
                          <h5 class="mb-1">Amusan Sanya</h5>
                          {{-- <a style='font-size:12px;color:red' href='https://my.vtubiz.com'>tupac.vtubiz.com</a>
                          --}}
                        </div>
                      </div>
                    </blockquote>
                  </div>
                  <!--/.card-body -->
                </div>
                <!--/.card -->
              </div>
              <!--/column -->
              <div class="col-md-6 align-self-start">
                <div class="card shadow-lg">
                  <div class="card-body">
                    <blockquote class="icon mb-0">
                      <p style='font-size:12px'>“Exceptional service! VTUBIZ ability to save beneficiaries and
                        facilitate group purchases has made life so much easier. Now, I can manage all my transactions
                        in one place without any hassle.”</p>
                      <div class="blockquote-details">
                        <div class="info p-0">
                          <h5 class="mb-1">Somoye Hayinke Oluwatoba</h5>
                          {{-- <a style='font-size:12px;color:red' href='https://my.vtubiz.com'>Igwetech.vtubiz.com</a>
                          --}}
                        </div>
                      </div>
                    </blockquote>
                  </div>
                  <!--/.card-body -->
                </div>
                <!--/.card -->
              </div>
              <!--/column -->
            </div>
            <!--/.row -->
          </div>
          <!--/column -->

          <!--/column -->
        </div>
        <!--/.row -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->
    <section class="wrapper bg-light angled upper-end lower-end">
      <div class="container pt-8 pb-4 pt-md-10 pb-md-6">
        <div class="row gy-6 mb-14 mb-md-18">

          <!--/column -->
          <div class="col-lg-12 pricing-wrapper">
            <div class="pricing-switcher-wrapper switcher justify-content-start justify-content-lg-end">
              {{-- <h2>Our Data Pricing</h2> --}}
            </div>
            <div class="row gy-6 position-relative mt-5">

              <div class="col-md-3">
                <div class="pricing card shadow-lg">
                  <div class="card-body pb-12">

                    <!--/.prices -->
                    <div class="network-header">
                      <div class="network-icon network-mtn">M</div>
                      <div class="network-info">
                        <h4 class="card-title">MTN Data</h4>
                        <span class="badge bg-soft-primary text-primary">Best Network</span>
                      </div>
                    </div>
                    <div class="plan-list-container">
                      <ul class="icon-list bullet-soft-primary mt-0 mb-0">
                        @foreach($mtn as $data)
                        <li><i class="fa fa-check fs-21"></i><span><strong>₦{{ number_format($data->data_price) }}</strong> ~ {{ $data->plan_name }} </span></li>
                        @endforeach
                      </ul>
                    </div>
                    <a href="/login" class="btn btn-primary rounded-pill mt-auto">Choose Plan</a>
                  </div>
                  <!--/.card-body -->
                </div>
                <!--/.pricing -->
              </div>
              <!--/column -->
              <div class="col-md-3 popular">
                <div class="pricing card shadow-lg border-primary border-2">
                  <div class="card-body pb-12">

                    <!--/.prices -->
                    <div class="network-header">
                      <div class="network-icon network-glo">G</div>
                      <div class="network-info">
                        <h4 class="card-title">Glo Data</h4>
                        <span class="badge bg-soft-success text-success">Most Popular</span>
                      </div>
                    </div>
                    <div class="plan-list-container">
                      <ul class="icon-list bullet-soft-primary mt-0 mb-0">
                        @foreach($glo as $data)
                        <li><i class="fa fa-check fs-21"></i><span><strong>₦{{ number_format($data->data_price) }}</strong> ~ {{ $data->plan_name }} </span></li>
                        @endforeach
                      </ul>
                    </div>
                    <a href="/login" class="btn btn-primary rounded-pill mt-auto">Choose Plan</a>
                  </div>
                  <!--/.card-body -->
                </div>
                <!--/.pricing -->
              </div>
              <div class="col-md-3">
                <div class="pricing card shadow-lg">
                  <div class="card-body pb-12">

                    <!--/.prices -->
                    <div class="network-header">
                      <div class="network-icon network-airtel">A</div>
                      <div class="network-info">
                        <h4 class="card-title">Airtel Data</h4>
                        <span class="badge bg-soft-danger text-danger">Fast Speed</span>
                      </div>
                    </div>
                    <div class="plan-list-container">
                      <ul class="icon-list bullet-soft-primary mt-0 mb-0">
                        @foreach($airtel as $data)
                        <li><i class="fa fa-check fs-21"></i><span><strong>₦{{ number_format($data->data_price) }}</strong> ~ {{ $data->plan_name }} </span></li>
                        @endforeach
                      </ul>
                    </div>
                    <a href="/login" class="btn btn-primary rounded-pill mt-auto">Choose Plan</a>
                  </div>
                  <!--/.card-body -->
                </div>
                <!--/.pricing -->
              </div>
              <!--/column -->
              <div class="col-md-3 popular">
                <div class="pricing card shadow-lg">
                  <div class="card-body pb-12">

                    <!--/.prices -->
                    <div class="network-header">
                      <div class="network-icon network-nmobile">9</div>
                      <div class="network-info">
                        <h4 class="card-title">9Mobile</h4>
                        <span class="badge bg-soft-info text-info">Affordable</span>
                      </div>
                    </div>
                    <div class="plan-list-container">
                      <ul class="icon-list bullet-soft-primary mt-0 mb-0">
                        @foreach($nmobile as $data)
                        <li><i class="fa fa-check fs-21"></i><span><strong>₦{{ number_format($data->data_price) }}</strong> ~ {{ $data->plan_name }} </span></li>
                        @endforeach
                      </ul>
                    </div>
                    <a href="/login" class="btn btn-primary rounded-pill mt-auto">Choose Plan</a>
                  </div>
                  <!--/.card-body -->
                </div>
                <!--/.pricing -->
              </div>
              <!--/column -->
            </div>
            <!--/.row -->
          </div>
          <!--/column -->
        </div>
        <!--/.row -->

        <!--/.row -->
        <div class="">
          <div class="row col-md-12  align-items-center">

            <div class="col-4 col-md-4">
              <figure class="px-5 px-md-0 px-lg-2 px-xl-3 px-xxl-4"><img
                  src="{{ asset('assets/img/cttaste_logo.png') }}" alt="" />
              </figure>
            </div>

            <div class="col-4 col-md-4">
              <figure class="px-5 px-md-0 px-lg-2 px-xl-3 px-xxl-4"><img
                  src="{{ asset('assets/img/cthostel_logo.png') }}" alt="" />
              </figure>
            </div>
            <!--/column -->

            <!--/column -->
            <div class="col-4 col-md-4">
              <figure class="px-5 px-md-0 px-lg-2 px-xl-3 px-xxl-4">
                <img src="{{ asset('assets/img/logo/vtulogo.png') }}" alt="" />
              </figure>
            </div>

          </div>
          <!--/.row -->
        </div>
        <!-- /div -->
      </div>
      <!-- /.container -->
    </section>
    <!-- /section -->
  </div>
  <!-- /.content-wrapper -->
  <footer style='background:#001f3f' class="text-inverse">
    <div class="container pt-7 pt-md-7 pb-3 pb-md-5">
      <div class="d-lg-flex flex-row align-items-lg-center">
        <h3 class="display-4 mb-6 mb-lg-0 pe-lg-20 pe-xl-22 pe-xxl-25 text-white">Join our community today to stay
          updated with our services.</h3>
        <a href="#" class="btn btn-primary rounded-pill mb-0 text-nowrap">Join Now</a>
      </div>
      <!--/div -->
      <hr class="mt-11 mb-12" />
      <div class="row gy-6 gy-lg-0">
        <div class="col-md-4 col-lg-3">
          <div class="widget">
            <img class="mb-4" height='30px' width='100px' src="{{ asset('assets/img/logo/vtulogo.png') }}"
              srcset="{{ asset('assets/img/logo/vtulogo.png') }}" alt="" />
            <p class="mb-4">©
              <?php echo Date('Y'); ?> VTUBIZ. <br class="d-none d-lg-block" />All rights reserved.
            </p>
            <a class='btn btn-secondary' href='https://www.instagram.com/vtubiz/'>Follow us on Instagram</a>

          </div>
          <!-- /.widget -->
        </div>
        <!-- /column -->
        <div class="col-md-4 col-lg-3">
          <div class="widget">
            <h4 class="widget-title text-white mb-3">Get in Touch</h4>
            <address class="pe-xl-15 pe-xxl-17">No 1, Igbelowowa Street, Kobape, Ogun State</address>
            <a href="mailto:support@vtubiz.com"><span class="__cf_email__">hello@vtubiz.com</span></a>
            <br /><a href='tel:+2349058744473'>+2349058744473</a>,
            <a hret="tel:+2349058744473">+2349058744473</a>
          </div>
          <!-- /.widget -->
        </div>
        <!-- /column -->
        <div class="col-md-4 col-lg-3">
          <div class="widget">
            <h4 class="widget-title text-white mb-3">Company</h4>
            <ul class="list-unstyled  mb-0">
              <li><a href="#">About Us</a></li>
              <li><a href="#">Our Products</a></li>
              <li><a href="#">Our Products</a></li>
              <li><a href="/terms-of-service">Terms of Use</a></li>
              <li><a href="/privacy-policy">Privacy Policy</a></li>
            </ul>
          </div>
          <!-- /.widget -->
        </div>
        <!-- /column -->
        <div class="col-md-12 col-lg-3">
          <div class="widget">
            <h4 class="widget-title text-white mb-3">Our Newsletter</h4>
            <p class="mb-5">Subscribe to our newsletter to get our news & deals delivered to you.</p>
            <div class="newsletter-wrapper">
              <!-- Begin Mailchimp Signup Form -->
              <div id="mc_embed_signup2">
                <form action="#" method="post" name="mc-embedded-subscribe-form" class="validate dark-fields"
                  target="_blank" novalidate>
                  <div id="mc_embed_signup_scroll2">
                    <div class="mc-field-group input-group form-floating">
                      <input type="email" value="" name="EMAIL" class="required email form-control"
                        placeholder="Email Address" id="mce-EMAIL2">
                      <label for="mce-EMAIL2">Email Address</label>
                      <input type="submit" value="Join" name="subscribe" id="mc-embedded-subscribe2"
                        class="btn btn-primary ">
                    </div>
                    <div id="mce-responses2" class="clear">
                      <div class="response" id="mce-error-response2" style="display:none"></div>
                      <div class="response" id="mce-success-response2" style="display:none"></div>
                    </div>
                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text"
                        name="b_ddc180777a163e0f9f66ee014_4b1bcfa0bc" tabindex="-1" value=""></div>
                    <div class="clear"></div>
                  </div>
                </form>
              </div>
              <!--End mc_embed_signup-->
            </div>
            <!-- /.newsletter-wrapper -->
          </div>
          <!-- /.widget -->
        </div>
        <!-- /column -->
      </div>
      <!--/.row -->
    </div>
    <!-- /.container -->
  </footer>
  <div class="progress-wrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
      <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
  </div>
  <script data-cfasync="false" src="frontpage/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
  <script src="frontpage/assets/js/plugins.js"></script>
  <script src="frontpage/assets/js/theme.js"></script>
  <!-- <script src='/assets/js/professionallocker.js'></script> -->

</body>

</html>