<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="{{ $blog->title }}">
  <meta name="keywords" content="{{ $blog->title }}">
  <meta name="author" content="elemis">
  <title>VTUBIZ | HOME </title>
  <link rel="shortcut icon" href="assets/media/logos/fav_01.png" />

  <link rel="stylesheet" href="{{ asset('frontpage/assets/css/plugins.css')}}">
  <link rel="stylesheet" href="{{ asset('frontpage/assets/css/style.css')}}">
  <link rel="stylesheet" href="{{ asset('frontpage/assets/css/colors/yellow.css')}}">
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

    <section class="wrapper bg-soft-primary">
        <div class="container pt-10 pb-19 pt-md-14 pb-md-20 text-center">
          <div class="row">
            <div class="col-md-10 col-xl-8 mx-auto">
              <div class="post-header">
                <div class="post-category text-line">
                  <a href="#" class="hover" rel="category">{{ $blog->category }}</a>
                </div>
                <!-- /.post-category -->
                <h1 class="display-1 mb-4">{{ $blog->title }}</h1>
                <ul class="post-meta mb-5">
                  <li class="post-date"><i class="uil uil-calendar-alt"></i><span>{{ date('jS F, Y', strtotime($blog->created_at)) }}</span></li>
                  <li class="post-author"><a href="#"><i class="uil uil-user"></i><span>By Admin</span></a></li>
                  {{-- <li class="post-comments"><a href="#"><i class="uil uil-comment"></i>3<span> Comments</span></a></li>
                  <li class="post-likes"><a href="#"><i class="uil uil-heart-alt"></i>3<span> Likes</span></a></li> --}}
                </ul>
                <!-- /.post-meta -->
              </div>
              <!-- /.post-header -->
            </div>
            <!-- /column -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container -->
      </section>
      <!-- /section -->
      <section class="wrapper bg-light">
        <div class="container pb-14 pb-md-16">
          <div class="row">
            <div class="col-lg-10 mx-auto">
              <div class="blog single mt-n17">
                <div class="card">
                  <figure class="card-img-top"><img src="{{ asset("blog_display_image/".$blog->image) }}" alt="" /></figure>
                  <div class="card-body">
                    <div class="classic-view">
                      <article class="post">
                        <div class="post-content mb-2">
                          <h2 class="h1 mb-4">{{ $blog->title }}</h2>
                          <p>{!! $blog->description !!}.</p>
                       
                          <!-- /.row -->
                          <blockquote class="fs-lg my-2">
                            <p>Sign up at <a href="https://vtubiz.com/">vtubiz.com</a> today, for <del>free</del> cheap subscriptions.</p>
                            <footer class="blockquote-footer"><a href='https://vtubiz.com'>VTUBIZ.COM</a></footer>
                          </blockquote>
                           </div>
                        <!-- /.post-content -->
                        <div class="post-footer d-md-flex flex-md-row justify-content-md-between align-items-center mt-8">
                          <div>
                            <ul class="list-unstyled tag-list mb-0">
                              <li><a href="#" class="btn btn-soft-ash btn-sm rounded-pill mb-0">{{ $blog->category }}</a></li>
                             
                            </ul>
                          </div>
                          <div class="mb-0 mb-md-2">
                            <div class="dropdown share-dropdown btn-group">
                              <button class="btn btn-sm btn-red rounded-pill btn-icon btn-icon-start dropdown-toggle mb-0 me-0" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="uil uil-share-alt"></i> Share </button>
                              <div class="dropdown-menu">
                                <a class="dropdown-item" href="#"><i class="uil uil-twitter"></i>Twitter</a>
                                <a class="dropdown-item" href="#"><i class="uil uil-facebook-f"></i>Facebook</a>
                                <a class="dropdown-item" href="#"><i class="uil uil-linkedin"></i>Linkedin</a>
                              </div>
                              <!--/.dropdown-menu -->
                            </div>
                            <!--/.share-dropdown -->
                          </div>
                        </div>
                        <!-- /.post-footer -->
                      </article>
                      <!-- /.post -->
                    </div>
                    <!-- /.classic-view -->
                    <hr />
                    <hr />
                    <h3 class="mb-6">You Might Also Like</h3>
                    <div class="swiper-container blog grid-view mb-16" data-margin="30" data-dots="true" data-items-md="2" data-items-xs="1">
                      <div class="swiper">
                        <div class="swiper-wrapper">
                        @foreach($related as $blog)
                          <div class="swiper-slide">
                            <article>
                              <figure class="overlay overlay-1 hover-scale rounded mb-5"><a href="/blog/{{ $blog->uid }}"> <img style='height:150px;width:250px' src="{{ asset("blog_display_image/".$blog->image) }}" alt="" /></a>
                                <figcaption>
                                  <h5 class="from-top mb-0">Read More</h5>
                                </figcaption>
                              </figure>
                              <div class="post-header">
                                <div class="post-category text-line">
                                  <a href="/blog/{{ $blog->uid }}" class="hover" rel="category">{{ $blog->category }}</a>
                                </div>
                                <!-- /.post-category -->
                                <h2 class="post-title h3 mt-1 mb-3"><a class="link-dark" href="/blog/{{ $blog->uid }}">{{ Str::limit($blog->title,30) }}</a></h2>
                              </div>
                              <!-- /.post-header -->
                              <div class="post-footer">
                                <ul class="post-meta mb-0">
                                  <li class="post-date"><i class="fa fa-calendar-alt"></i><span>{{ date('jS F, Y', strtotime($blog->created_at)) }}</span></li>
                                  {{-- <li class="post-comments"><a href="#"><i class="uil uil-comment"></i>4</a></li> --}}
                                </ul>
                                <!-- /.post-meta -->
                              </div>
                              <!-- /.post-footer -->
                            </article>
                            <!-- /article -->
                          </div>
                        @endforeach
                          <!--/.swiper-slide -->
                        </div>
                        <!--/.swiper-wrapper -->
                      </div>
                      <!-- /.swiper -->
                    </div>
                    <!-- /.swiper-container -->
                    <hr />
                    <div id="comments">
                      <h3 class="mb-6">{{ count($comments) }} Comments</h3>
                      <ol id="singlecomments" class="commentlist">
                        @foreach($comments as $comment)
                        <li class="comment">
                          <div class="comment-header d-md-flex align-items-center">
                            <div class="d-flex align-items-center">
                              <figure class="user-avatar"><i class='fa fa-user'></i></figure>
                              <div>
                                <h6 class="comment-author"><a href="#" class="link-dark">{{ $comment->name }}</a></h6>
                                <ul class="post-meta">
                                  <li><i class="fa fa-calendar-alt"></i>{{ date('jS F, Y', strtotime($comment->created_at)) }}</li>
                                </ul>
                                <!-- /.post-meta -->
                              </div>
                              <!-- /div -->
                            </div>
                            <!-- /div -->
                            <div class="mt-3 mt-md-0 ms-auto">
                              <a href="#" class="btn btn-soft-ash btn-sm rounded-pill btn-icon btn-icon-start mb-0"><i class="fa fa-comments"></i> Reply</a>
                            </div>
                            <!-- /div -->
                          </div>
                          <!-- /.comment-header -->
                          <p>{{ $comment->message }}</p>
                        </li>
                        @endforeach
                     
                      </ol>
                    </div>
                    <!-- /#comments -->
                    <hr />
                    <h3 class="mb-3">Would you like to share your thoughts?</h3>
                    <p class="mb-7">Your email address will not be published. Required fields are marked *</p>
                    <form class="comment-form" method='post' action='/saveComment'>@csrf
                      <div class="form-floating mb-4">
                        <input type='hidden' name='blog_id' value='{{ $blog->uid }}'/>
                        <input required type="text" name='name' class="form-control" placeholder="Name*" id="c-name">
                        <label for="c-name">Name *</label>
                      </div>
                      <div class="form-floating mb-4">
                        <input required type="email" name='email' class="form-control" placeholder="Email*" id="c-email">
                        <label for="c-email">Email*</label>
                      </div>
                      <div class="form-floating mb-4">
                        <input required type="number" name='phone' class="form-control" placeholder="Phone number" id="c-web">
                        <label for="c-web">Phone *</label>
                      </div>
                      <div class="form-floating mb-4">
                        <textarea required  name='message' class="form-control" placeholder="Comment" style="height: 150px"></textarea>
                        <label>Comment *</label>
                      </div>
                      <button type="submit" class="btn btn-primary rounded-pill mb-0">Submit</button>
                    </form>
                    <!-- /.comment-form -->
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.blog -->
            </div>
            <!-- /column -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container -->
      </section>
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
  <script src="{{ asset('frontpage/assets/js/plugins.js')}}"></script>
  <script src="{{ asset('frontpage/assets/js/theme.js')}}"></script>
  {{-- <script src='{{ asset('assets/js/professionallocker.js')}}'></script> --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>
   
      @if (session('message'))
                swal({
                        icon: 'success',
                        title: '{{ session("message") }}'
                        }) 
           
        @endif

        @if (session('error'))
                swal({
                        icon: 'error',
                        title: '{{ session("error") }}'
                        }) 
           
        @endif
  </script>

</body>


<!-- Mirrored from sandbox.elemisthemes.com/demo1.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 12 May 2022 20:49:01 GMT -->

</html>