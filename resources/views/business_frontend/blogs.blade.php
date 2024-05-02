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
  {{-- <link href="https://fonts.googleapis.com/css2?family=Grandstander:wght@400&display=swap" rel="stylesheet"> --}}

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
              <h3 class="text-black fs-30 mb-0">  <img src="{{ asset('assets/img/logo/vtulogo.png') }}"  width='100px' height='25px'  alt="" /></h3>
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
      {{-- <nav class="navbar navbar-expand-lg center-nav transparent navbar-light">
        <div class="container flex-lg-row flex-nowrap align-items-center">
          <div class="navbar-brand w-100">
            <a href="#">
              <h1>VTUBIZ</h1>
            </a>
          </div>
          <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
            <div class="offcanvas-header d-lg-none">
              <h3 class="text-black fs-30 mb-0">VTUBIZ</h3>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
            </div>
            <div class="offcanvas-body ms-lg-auto d-flex flex-column h-100">
              <ul class="navbar-nav">

                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Business Account</a>
                  <ul class="dropdown-menu">
                    <li class="dropdown dropdown-submenu dropend"><a class="dropdown-item dropdown-toggle" href="#"
                        data-bs-toggle="dropdown">Our Products</a>
                      <ul class="dropdown-menu">
                        <li class="nav-item"><a class="dropdown-item">Airtime</a></li>
                        <li class="nav-item"><a class="dropdown-item">Data Subscription</a></li>
                        <li class="nav-item"><a class="dropdown-item">Cable(Tv) Subscription</a></li>
                        <li class="nav-item"><a class="dropdown-item">Electricity Subscription</a></li>
                        <li class="nav-item"><a class="dropdown-item">Exams Result Checkers</a></li>
                        <li class="nav-item"><a class="dropdown-item">Bulk SMS</a></li>
                      </ul>
                    </li>
                    <li class="dropdown dropdown-submenu dropend"><a class="dropdown-item dropdown-toggle" href="#"
                        data-bs-toggle="dropdown">Main Features</a>
                      <ul class="dropdown-menu">
                        <li class="nav-item"><a class="dropdown-item" href="about.html">Automated Purchase</a></li>
                        <li class="nav-item"><a class="dropdown-item" href="about2.html">Transaction Redo</a></li>
                        <li class="nav-item"><a class="dropdown-item" href="about2.html">Bulk Purchases</a></li>
                        <li class="nav-item"><a class="dropdown-item" href="about2.html">Schedule For Later Purchase</a>
                        </li>
                        <li class="nav-item"><a class="dropdown-item" href="about2.html">Add Up Beneficiaries</a></li>
                      </ul>
                    </li>
                    <li class="dropdown dropdown-submenu dropend"><a class="dropdown-item dropdown-toggle" href="#"
                        data-bs-toggle="dropdown">User Management</a>
                      <ul class="dropdown-menu">
                        <li class="nav-item"><a class="dropdown-item" href="shop.html">Manage User Purchase
                            Transactions</a></li>
                        <li class="nav-item"><a class="dropdown-item" href="shop.html">Manage User Payment
                            Transactions</a></li>
                        <li class="nav-item"><a class="dropdown-item" href="shop2.html">Track Customer's Preference</a>
                        </li>
                      </ul>
                    </li>
                    <li class="dropdown dropdown-submenu dropend"><a class="dropdown-item dropdown-toggle" href="#"
                        data-bs-toggle="dropdown">Price Management</a>
                      <ul class="dropdown-menu">
                        <li class="nav-item"><a class="dropdown-item" href="contact.html">Set Your Own Price</a></li>
                        <li class="nav-item"><a class="dropdown-item" href="contact3.html">Review Prices</a></li>
                      </ul>
                    </li>
                    <li class="dropdown dropdown-submenu dropend"><a class="dropdown-item dropdown-toggle" href="#"
                        data-bs-toggle="dropdown">Theme Management</a>
                      <ul class="dropdown-menu">
                        <li class="nav-item"><a class="dropdown-item" href="contact.html">Select Theme That Suite Your
                            Brand</a></li>
                        <li class="nav-item"><a class="dropdown-item" href="contact3.html">Customize Your Theme</a></li>
                        <li class="nav-item"><a class="dropdown-item" href="contact2.html">Build Your Team From
                            Scratch</a></li>
                      </ul>
                    </li>
                    <li class="dropdown dropdown-submenu dropend"><a class="dropdown-item dropdown-toggle" href="#"
                        data-bs-toggle="dropdown">Strategized Marketing</a>
                      <ul class="dropdown-menu">
                        <li class="nav-item"><a class="dropdown-item" href="career.html">Email Marketing</a></li>
                        <li class="nav-item"><a class="dropdown-item" href="career-job.html">Social Media Marketing</a>
                        </li>
                      </ul>
                    </li>

                    <li class="nav-item"><a class="dropdown-item" href="pricing.html">About Us</a></li>

                  </ul>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Personal Account.</a>
                  <div class="dropdown-menu dropdown-lg">
                    <div class="dropdown-lg-content">
                      <div>
                        <h6 class="dropdown-header">Free Subdomains</h6>
                        <ul class="list-unstyled">
                          <li><a class="dropdown-item" href="projects.html">Fully Customized</a></li>
                          <li><a class="dropdown-item" href="projects2.html">Represent Your Brand</a></li>
                      </div>
                      <!-- /.column -->
                      <div>
                        <h6 class="dropdown-header">Paid Domain</h6>
                        <ul class="list-unstyled">
                          <li><a class="dropdown-item" href="single-project.html">Search For Available Domain Names</a>
                          </li>
                          <li><a class="dropdown-item" href="single-project2.html">Get Prices For Selected Domain
                              Names</a></li>
                          <li><a class="dropdown-item" href="single-project3.html">Choose Domain name</a></li>
                          <li><a class="dropdown-item" href="single-project3.html">Make it Live in just six(6) Hours</a>
                          </li>
                        </ul>
                      </div>
                      <!-- /.column -->
                    </div>
                    <!-- /auto-column -->
                  </div>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Login</a>
                  <ul class="dropdown-menu">
                    <li class="nav-item"><a class="dropdown-item" href="blog.html">Personal Account Login
                        plans</a></li>
                    <li class="nav-item"><a class="dropdown-item" href="blog2.html">Business Account Login
                      </a></li>


                  </ul>
                </li>


              </ul>
              <!-- /.navbar-nav -->
              <div class="offcanvas-footer d-lg-none">
                <div>
                  <a href="cdn-cgi/l/email-protection.html#15737c6766613b79746661557078747c793b767a78"
                    class="link-inverse"><span class="__cf_email__"
                      data-cfemail="fc95929a93bc99919d9590d29f9391">[email&#160;protected]</span></a>
                  <br /> 00 (123) 456 78 90 <br />
                  <nav class="nav social social-white mt-4">
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-facebook-f"></i></a>
                    <a href="#"><i class="fa fa-dribbble"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-youtube"></i></a>
                  </nav>
                  <!-- /.social -->
                </div>
              </div>
              <!-- /.offcanvas-footer -->
            </div>
            <!-- /.offcanvas-body -->
          </div>
          <!-- /.navbar-collapse -->

          <!-- /.navbar-other -->
        </div>
        <!-- /.container -->
      </nav> --}}
      <!-- /.navbar -->
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

    <section class="section-frame overflow-hidden">
        <div class="wrapper bg-soft-primary">
          <div class="container py-12 py-md-16 text-center">
            <div class="row">
              <div class="col-md-7 col-lg-6 col-xl-5 mx-auto">
                <h1 class="display-1 mb-3">VTUBIZ BLOG</h1>
                <p class="lead px-lg-5 px-xxl-8 mb-1">Welcome to our blog. Here you can find vital informations about the <b>VTU world</b>, our latest news and business articles.</p>
              </div>
              <!-- /column -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.container -->
        </div>
        <!-- /.wrapper -->
      </section>
    <!-- /header -->
    <section class="wrapper bg-light">
        <div class="container py-14 py-md-16">
          <div class="row gx-lg-8 gx-xl-12">
            <div class="col-lg-8">
              <div class="blog classic-view">
                @foreach($blogs as $blog)
                <article class="post">
                  <div class="card">
                    <figure class="card-img-top overlay overlay-1 hover-scale"><a href="/blog/{{ $blog->uid }}"><img src="http://vtubiz.com/public/blog_display_image/{{ $blog->image }}" alt="" /></a>
                      <figcaption>
                        <h5 class="from-top mb-0">Read More</h5>
                      </figcaption>
                    </figure>
                    <div class="card-body">
                      <div class="post-header">
                        <div class="post-category text-line">
                          <a href="#" class="hover" rel="category">{{ $blog->category }}</a>
                        </div>
                        <!-- /.post-category -->
                        <h2 class="post-title mt-1 mb-0"><a class="link-dark" href="/blog/{{ $blog->uid }}">{{ $blog->title }}</a></h2>
                      </div>
                      <!-- /.post-header -->
                      <div class="post-content">
                        <p>{!! Str::limit($blog->description,300) !!}.</p>
                      </div>
                      <!-- /.post-content -->
                    </div>
                    <!--/.card-body -->
                    <div class="card-footer">
                      <ul class="post-meta d-flex mb-0">
                        <li class="post-date"><i class="fa fa-calendar-alt"></i><span>{{ date('jS F, Y', strtotime($blog->created_at)) }}</span></li>
                        <li class="post-author"><a href="#"><i class="fa fa-user"></i><span>By Admin</span></a></li>
                        {{-- <li class="post-comments"><a href="#"><i class="fa fa-comment"></i>3<span> Comments</span></a></li>
                        <li class="post-likes ms-auto"><a href="#"><i class="fa fa-heart"></i>3</a></li> --}}
                      </ul>
                      <!-- /.post-meta -->
                    </div>
                    <!-- /.card-footer -->
                  </div>
                  <!-- /.card -->
                </article>
                @endforeach
              </div>
          
              <nav class="d-flex" aria-label="pagination">
                <ul class="pagination">
                 {!! $blogs->links() !!}
                </ul>
                <!-- /.pagination -->
              </nav>
              <!-- /nav -->
            </div>
            <!-- /column -->
            <aside class="col-lg-4 sidebar mt-8 mt-lg-6">
              <div class="widget">
                <form class="search-form">
                  <div class="form-floating mb-0">
                    <input id="search-form" type="text" class="form-control" placeholder="Search">
                    <label for="search-form">Search</label>
                  </div>
                </form>
                <!-- /.search-form -->
              </div>
              <!-- /.widget -->
              <div class="widget">
                <h4 class="widget-title mb-3">About Us</h4>
                <p>We provide a comprehensive platform for all your data, airtime, electricity, and cable subscription needs. Our mission is to empower your digital lifestyle through affordability, automation, and lightning-fast transactions.</p>
                {{-- <nav class="nav social">
                  <a href="#"><i class="uil uil-twitter"></i></a>
                  <a href="#"><i class="uil uil-facebook-f"></i></a>
                  <a href="#"><i class="uil uil-dribbble"></i></a>
                  <a href="#"><i class="uil uil-instagram"></i></a>
                  <a href="#"><i class="uil uil-youtube"></i></a>
                </nav> --}}
                <!-- /.social -->
              </div>
              <!-- /.widget -->
              <div class="widget">
                <h4 class="widget-title mb-3">Popular Posts</h4>
                <ul class="image-list">
                    @foreach($popular as $pop)
                  <li>
                    <figure class="rounded"><a href="/blog/{{ $pop->uid }}"><img src="http://vtubiz.com/public/blog_display_image/{{ $pop->image }}" alt="" /></a></figure>
                    <div class="post-content">
                      <h6 class="mb-2"> <a class="link-dark" href="/blog/{{ $pop->uid }}">{{ $pop->title }}</a> </h6>
                      <ul class="post-meta">
                        <li class="post-date"><i class="uil uil-calendar-alt"></i><span>{{ date('jS F, Y', strtotime($pop->created_at)) }}                        </span></li>
                        {{-- <li class="post-comments"><a href="#"><i class="uil uil-comment"></i>3</a></li> --}}
                      </ul>
                      <!-- /.post-meta -->
                    </div>
                  </li>
                  @endforeach
                </ul>
                <!-- /.image-list -->
              </div>
              <!-- /.widget -->
             
              <!-- /.widget -->
              <div class="widget">
                <h4 class="widget-title mb-3">Tags</h4>
                <ul class="list-unstyled tag-list">
                  <li><a href="#" class="btn btn-soft-ash btn-sm rounded-pill">Data Subscription</a></li>
                  <li><a href="#" class="btn btn-soft-ash btn-sm rounded-pill">Airtime Purchase</a></li>
                  <li><a href="#" class="btn btn-soft-ash btn-sm rounded-pill">Bulk SMS</a></li>
                  <li><a href="#" class="btn btn-soft-ash btn-sm rounded-pill">Tv(Cable) Subscription</a></li>
                  <li><a href="#" class="btn btn-soft-ash btn-sm rounded-pill">Light Bills Payment</a></li>
                  <li><a href="#" class="btn btn-soft-ash btn-sm rounded-pill">Bulk Purchases</a></li>
                  <li><a href="#" class="btn btn-soft-ash btn-sm rounded-pill">Purchases 4 Companies</a></li>
                  <li><a href="#" class="btn btn-soft-ash btn-sm rounded-pill">Exam Result Checkers</a></li>
                </ul>
              </div>
              <!-- /.widget -->
           
              <!-- /.widget -->
            </aside>
            <!-- /column .sidebar -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container -->
      </section>
   
    <section class="wrapper bg-light angled upper-end lower-end">
      <div class="container py-14 pt-md-14 pb-md-18">
       
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
              <?php echo Date('Y');?> VTUBIZ. <br class="d-none d-lg-block" />All rights reserved.
            </p>
            <a class='btn btn-secondary' href='https://www.instagram.com/vtubiz/'>Follow us on Instagram</a>
            {{-- <nav class="nav social social-white">
              <a href="#"><i class="fa fa-twitter"></i></a>
              <a href="#"><i class="fa fa-facebook-f"></i></a>
              <a href="#"><i class="fa fa-dribbble"></i></a>
              <a href="#"><i class="fa fa-instagram"></i></a>
              <a href="#"><i class="fa fa-youtube"></i></a>
            </nav> --}}
            <!-- /.social -->
          </div>
          <!-- /.widget -->
        </div>
        <!-- /column -->
        <div class="col-md-4 col-lg-3">
          <div class="widget">
            <h4 class="widget-title text-white mb-3">Get in Touch</h4>
            <address class="pe-xl-15 pe-xxl-17">No 1, Igbelowowa Street, Kobape, Ogun State</address>
            <a href="mailto:support@vtubiz.com"><span class="__cf_email__">hello@vtubiz.com</span></a><br /> 234 905
            8744 473
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
              <li><a href="#">Terms of Use</a></li>
              <li><a href="#">Privacy Policy</a></li>
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
  <script src='/assets/js/professionallocker.js'></script>

</body>


<!-- Mirrored from sandbox.elemisthemes.com/demo1.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 May 2022 20:49:01 GMT -->

</html>