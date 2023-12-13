<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from freshcart.codescandy.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 13 Aug 2023 16:09:35 GMT -->

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta content="Codescandy" name="author">
  <title>{{ $user->brand_name }} | VTUBIZ </title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Lato&family=Mooli&family=Roboto:wght@300&family=Ubuntu&display=swap"
    rel="stylesheet">

  <link href="{{ asset('theme1/assets/libs/slick-carousel/slick/slick.css') }}" rel="stylesheet" />
  <link href="{{ asset('theme1/assets/libs/slick-carousel/slick/slick-theme.css') }}" rel="stylesheet" />
  <link href="{{ asset('theme1/assets/libs/tiny-slider/dist/tiny-slider.css') }}" rel="stylesheet">

  <!-- Favicon icon-->
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('brand_images/'.$user->logo) }}">


  <!-- Libs CSS -->
  <link href="{{ asset('theme1/assets/libs/bootstrap-icons/font/bootstrap-icons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('theme1/assets/libs/feather-webfont/dist/feather-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('theme1/assets/libs/simplebar/dist/simplebar.min.css') }}" rel="stylesheet">


  <!-- Theme CSS -->
  <link rel="stylesheet" href="{{ asset('theme1/assets/css/theme.min.css') }}">
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-M8S4MT3EYG"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-M8S4MT3EYG');
  </script>

</head>

<body>

  <div class="border-bottom ">
    <div class="bg-light py-1">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-12 text-center text-md-start"><span> Super Value Deals - Save more on {{
              $user->brand_name }}
            </span>
          </div>

        </div>
      </div>
    </div>


    <nav style='background:#fff3cd' class="navbar navbar-expand-lg navbar-light navbar-default py-0 pb-lg-4 "
      aria-label="Offcanvas navbar large">
      <div class="container">


        <div class="offcanvas offcanvas-start" tabindex="-1" id="navbar-default" aria-labelledby="navbar-defaultLabel">

          <div class="offcanvas-body mt-4">

            <div class="dropdown me-3 d-none d-lg-block">
              <button class="btn btn-warning px-6 " type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                aria-expanded="false">
                <span class="me-1">
                  @if($user->logo !== null)
            <img class="rounded-circle header-profile-user"
            src="https://vtubiz.com/public/brand_images/{{ $user->logo}}" style='width:50px;height:50px' />
           @else
            <h2>{{ $user->brand_name }}</h2>
            @endif
                </span>
              </button>

            </div>
            <div class="">
              <ul class="navbar-nav align-items-center ">

                <li class="nav-item">
                  <a style='font-size:15px !important' class="nav-link " href="#"><b>
                      Home</b>
                  </a>
                </li>
                <li class="nav-item w-100 w-lg-auto">
                  <a class="nav-link" style='font-size:15px !important' href="#data_prices"><b>
                      Data Prices</b>
                  </a>
                </li>
                <li class="nav-item w-100 w-lg-auto">
                  <a class="nav-link" style='font-size:15px !important' href="#electricity_prices"><b>
                      Electricity Prices</b>
                  </a>
                </li>

                <li class="nav-item w-100 w-lg-auto">
                  <a class="nav-link" style='font-size:20px !important'
                    href="https://wa.me/234{{ substr($user->phone,1) }}"><b>
                      Contact Us</b>
                  </a>
                </li>
                <li class="nav-item w-100 w-lg-auto">
                  <a class="nav-link" style='font-size:20px !important' href="/register"><b>
                      Register/Login</b>
                  </a>
                </li>

              </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>


  </div>


  <main>
    <section class="mt-8">
      <div class="container">
        <div class="hero-slider ">
          <div @if($user->image_1 !== null )
            style="background: url({{ asset('website_images/'.$user->image_1) }})no-repeat; background-size: cover;
            border-radius: .5rem; background-position: center;">
            @else
            style="background: url({{ asset('assets/media/logos/fastpay_bg_2.jpg') }})no-repeat; background-size: cover;
            border-radius: .5rem; background-position: center;">
            @endif
            {{-- style="background: url({{ asset('assets/media/logos/fastpay_bg_2.jpg') }})no-repeat; background-size:
            cover; border-radius: .5rem; background-position: center;"> --}}
            <div class="ps-lg-12 py-lg-16 col-xxl-5 col-md-7 py-14 px-8 text-xs-center">
              <span class="badge text-bg-warning">{{ $user->description ?? $user->brand_name }}</span>

              <h2 style='font-family:{{ $user->font_family }}; color:{{ $user->brand_color }}'
                class=" display-5 fw-bold mt-4">{{ $user->heading_1 ?? "Top-Up, Pay Bills, Stay Connected." }} </h2>
              <p class="lead">{{ $user->sub_heading_1 ?? "Top Up Airtime, Data, Cable Subscriptions, and More, All at
                Your Convenience." }}</p>
              <a href="/login" class="btn btn-dark mt-3">Get Started <i
                  class="feather-icon icon-arrow-right ms-1"></i></a>
            </div>

          </div>
          <div @if($user->image_2 !== null )
            style="background: url({{ asset('website_images/'.$user->image_2) }})no-repeat; background-size: cover;
            border-radius: .5rem; background-position: center;">
            @else
            style="background: url({{ asset('assets/media/logos/fastpay_bg_2.jpg') }})no-repeat; background-size: cover;
            border-radius: .5rem; background-position: center;">
            @endif
            <div class="ps-lg-12 py-lg-16 col-xxl-5 col-md-7 py-14 px-8 text-xs-center">
              <span class="badge text-bg-warning">{{ $user->description ?? $user->brand_name }}</span>
              <h2 style='font-family:{{ $user->font_family }}; color:{{ $user->brand_color }}'
                class=" display-5 fw-bold mt-4">{{ $user->heading_2 ?? "Explore a World of Convenience." }}</h2>
              <p class='lead'>
                {{ $user->sub_heading_2 ?? "Simplify Your Digital Transactions" }}
              </p>
              <a href="/register" class="btn btn-dark mt-3">Get Started <i
                  class="feather-icon icon-arrow-right ms-1"></i></a>
            </div>

          </div>

        </div>
      </div>
    </section>





    <!-- Category Section Start-->
    <section class="mb-lg-10 mt-lg-14 my-8">
      <div class="container">
        <div class="row">
          <div class="col-12 mb-6">

            <h3 style='font-family:{{ $user->font_family }}; color:{{ $user->brand_color }}' class="mb-0 text-center">
              Our Services</h3>

          </div>
        </div>
        <div class="category-slider ">

          <div class="item"> <a href="/airtime" class="text-decoration-none text-inherit">
              <div class="card bg-light mb-6 border-0">
                <!-- card body -->
                <div class="card-body p-4">
                  <div class="mb-4">
                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                      <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Communication/Active-call.svg--><svg
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <rect x="0" y="0" width="24" height="24" />
                          <path
                            d="M13.0799676,14.7839934 L15.2839934,12.5799676 C15.8927139,11.9712471 16.0436229,11.0413042 15.6586342,10.2713269 L15.5337539,10.0215663 C15.1487653,9.25158901 15.2996742,8.3216461 15.9083948,7.71292558 L18.6411989,4.98012149 C18.836461,4.78485934 19.1530435,4.78485934 19.3483056,4.98012149 C19.3863063,5.01812215 19.4179321,5.06200062 19.4419658,5.11006808 L20.5459415,7.31801948 C21.3904962,9.0071287 21.0594452,11.0471565 19.7240871,12.3825146 L13.7252616,18.3813401 C12.2717221,19.8348796 10.1217008,20.3424308 8.17157288,19.6923882 L5.75709327,18.8875616 C5.49512161,18.8002377 5.35354162,18.5170777 5.4408655,18.2551061 C5.46541191,18.1814669 5.50676633,18.114554 5.56165376,18.0596666 L8.21292558,15.4083948 C8.8216461,14.7996742 9.75158901,14.6487653 10.5215663,15.0337539 L10.7713269,15.1586342 C11.5413042,15.5436229 12.4712471,15.3927139 13.0799676,14.7839934 Z"
                            fill="#000000" />
                          <path
                            d="M14.1480759,6.00715131 L13.9566988,7.99797396 C12.4781389,7.8558405 11.0097207,8.36895892 9.93933983,9.43933983 C8.8724631,10.5062166 8.35911588,11.9685602 8.49664195,13.4426352 L6.50528978,13.6284215 C6.31304559,11.5678496 7.03283934,9.51741319 8.52512627,8.02512627 C10.0223249,6.52792766 12.0812426,5.80846733 14.1480759,6.00715131 Z M14.4980938,2.02230302 L14.313049,4.01372424 C11.6618299,3.76737046 9.03000738,4.69181803 7.1109127,6.6109127 C5.19447112,8.52735429 4.26985715,11.1545872 4.51274152,13.802405 L2.52110319,13.985098 C2.22450978,10.7517681 3.35562581,7.53777247 5.69669914,5.19669914 C8.04101739,2.85238089 11.2606138,1.72147333 14.4980938,2.02230302 Z"
                            fill="#000000" fill-rule="nonzero" opacity="0.3" />
                        </g>
                      </svg>
                      <!--end::Svg Icon-->
                    </span>
                  </div>
                  <h4>Airtime Top Up</h4>
                  <p class="mb-4">Top Up your airtime at a discounted price and enjoy more call time.</p>
                  <!-- btn -->

                </div>

              </div>
            </a></div>
          <div class="item"> <a href="/data" class="text-decoration-none text-inherit">
              <div class="card bg-light mb-6 border-0">
                <!-- card body -->
                <div class="card-body p-4">
                  <div class="mb-4">
                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                      <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Devices/LTE2.svg--><svg
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <rect x="0" y="0" width="24" height="24" />
                          <path
                            d="M16.4508979,17.4029496 L15.1784978,15.8599014 C16.324501,14.9149052 17,13.5137472 17,12 C17,10.4912085 16.3289582,9.09418404 15.1893841,8.14910121 L16.466112,6.60963188 C18.0590936,7.93073905 19,9.88958759 19,12 C19,14.1173586 18.0528606,16.0819686 16.4508979,17.4029496 Z M19.0211112,20.4681628 L17.7438102,18.929169 C19.7927036,17.2286725 21,14.7140097 21,12 C21,9.28974232 19.7960666,6.77820732 17.7520315,5.07766256 L19.031149,3.54017812 C21.5271817,5.61676443 23,8.68922234 23,12 C23,15.3153667 21.523074,18.3916375 19.0211112,20.4681628 Z M7.54910207,17.4029496 C5.94713944,16.0819686 5,14.1173586 5,12 C5,9.88958759 5.94090645,7.93073905 7.53388797,6.60963188 L8.81061588,8.14910121 C7.67104182,9.09418404 7,10.4912085 7,12 C7,13.5137472 7.67549895,14.9149052 8.82150222,15.8599014 L7.54910207,17.4029496 Z M4.9788888,20.4681628 C2.47692603,18.3916375 1,15.3153667 1,12 C1,8.68922234 2.47281829,5.61676443 4.96885102,3.54017812 L6.24796852,5.07766256 C4.20393339,6.77820732 3,9.28974232 3,12 C3,14.7140097 4.20729644,17.2286725 6.25618985,18.929169 L4.9788888,20.4681628 Z"
                            fill="#000000" fill-rule="nonzero" opacity="0.3" />
                          <path
                            d="M11,14.2919782 C10.1170476,13.9061998 9.5,13.0251595 9.5,12 C9.5,10.6192881 10.6192881,9.5 12,9.5 C13.3807119,9.5 14.5,10.6192881 14.5,12 C14.5,13.0251595 13.8829524,13.9061998 13,14.2919782 L13,20 C13,20.5522847 12.5522847,21 12,21 C11.4477153,21 11,20.5522847 11,20 L11,14.2919782 Z"
                            fill="#000000" />
                        </g>
                      </svg>
                      <!--end::Svg Icon-->
                    </span>
                  </div>
                  <h4>Affordable Data Plans</h4>
                  <p class="mb-4">Enjoy the internet with our cheap data plans</p>
                  <!-- btn -->

                </div>

              </div>
            </a></div>
          <div class="item"> <a href="/cable" class="text-decoration-none text-inherit">
              <div class="card bg-light mb-6 border-0">
                <!-- card body -->
                <div class="card-body p-4">
                  <div class="mb-4">
                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                      <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Devices/TV2.svg--><svg
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <rect x="0" y="0" width="24" height="24" />
                          <path
                            d="M3,5 L21,5 C21.5522847,5 22,5.44771525 22,6 L22,17 C22,17.5522847 21.5522847,18 21,18 L3,18 C2.44771525,18 2,17.5522847 2,17 L2,6 C2,5.44771525 2.44771525,5 3,5 Z M9.632,10.066 L11.032,10.066 L11.032,9.044 L7.035,9.044 L7.035,10.066 L8.435,10.066 L8.435,14 L9.632,14 L9.632,10.066 Z M14.935,14 L16.846,9.044 L15.523,9.044 L14.382,12.558 L14.354,12.558 L13.206,9.044 L11.862,9.044 L13.738,14 L14.935,14 Z"
                            fill="#000000" />
                          <rect fill="#000000" opacity="0.3" x="3" y="19" width="18" height="1" rx="0.5" />
                        </g>
                      </svg>
                      <!--end::Svg Icon-->
                    </span>
                  </div>
                  <h4>Cable(Tv) Subscription</h4>
                  <p class="mb-4">Streamline Your Entertainment with our Cable Subscription Plans
                    without.</p>
                  <!-- btn -->

                </div>

              </div>
            </a></div>
          <div class="item"> <a href="/electricity" class="text-decoration-none text-inherit">
              <div class="card bg-light mb-6 border-0">
                <!-- card body -->
                <div class="card-body p-4">
                  <div class="mb-4">
                    <span class="svg-icon svg-icon-primary svg-icon-4x">
                      <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Home/Bulb1.svg--><svg
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <rect x="0" y="0" width="24" height="24" />
                          <circle fill="#000000" opacity="0.3" cx="12" cy="9" r="8" />
                          <path
                            d="M14.5297296,11 L9.46184488,11 L11.9758349,17.4645458 L14.5297296,11 Z M10.5679953,19.3624463 L6.53815512,9 L17.4702704,9 L13.3744964,19.3674279 L11.9759405,18.814912 L10.5679953,19.3624463 Z"
                            fill="#000000" fill-rule="nonzero" opacity="0.3" />
                          <path
                            d="M10,22 L14,22 L14,22 C14,23.1045695 13.1045695,24 12,24 L12,24 C10.8954305,24 10,23.1045695 10,22 Z"
                            fill="#000000" opacity="0.3" />
                          <path
                            d="M9,20 C8.44771525,20 8,19.5522847 8,19 C8,18.4477153 8.44771525,18 9,18 C8.44771525,18 8,17.5522847 8,17 C8,16.4477153 8.44771525,16 9,16 L15,16 C15.5522847,16 16,16.4477153 16,17 C16,17.5522847 15.5522847,18 15,18 C15.5522847,18 16,18.4477153 16,19 C16,19.5522847 15.5522847,20 15,20 C15.5522847,20 16,20.4477153 16,21 C16,21.5522847 15.5522847,22 15,22 L9,22 C8.44771525,22 8,21.5522847 8,21 C8,20.4477153 8.44771525,20 9,20 Z"
                            fill="#000000" />
                        </g>
                      </svg>
                      <!--end::Svg Icon-->
                    </span>
                  </div>
                  <h4>Pay Light Bills</h4>
                  <p class="mb-4">Light Up Your Building with Effortless Bill Payments.</p>
                  <!-- btn -->

                </div>

              </div>
            </a></div>
          <div class="item">
            <a href="/examination" class="text-decoration-none text-inherit">
              <div class="card bg-light mb-6 border-0">
                <!-- card body -->
                <div class="card-body p-4">
                  <div class="mb-4">
                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                      <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Layout/Layout-top-panel-6.svg--><svg
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <rect x="0" y="0" width="24" height="24" />
                          <rect fill="#000000" x="2" y="5" width="19" height="4" rx="1" />
                          <rect fill="#000000" opacity="0.3" x="2" y="11" width="19" height="10" rx="1" />
                        </g>
                      </svg>
                      <!--end::Svg Icon-->
                    </span>
                  </div>
                  <h4>Exam Result Checker</h4>
                  <p class="mb-4">Easily Access Your Exam Results at a giveaway prices.</p>
                  <!-- btn -->

                </div>

              </div>
            </a>
          </div>
          <div class="item">
            <a href="/bulksms" class="text-decoration-none text-inherit">
              <div class="card bg-light mb-6 border-0">
                <!-- card body -->
                <div class="card-body p-4">
                  <div class="mb-4">
                    <span class="svg-icon svg-icon-primary svg-icon-4x">
                      <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Communication/Group-chat.svg--><svg
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                          <rect x="0" y="0" width="24" height="24" />
                          <path
                            d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z"
                            fill="#000000" />
                          <path
                            d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z"
                            fill="#000000" opacity="0.3" />
                        </g>
                      </svg>
                      <!--end::Svg Icon-->
                    </span>
                  </div>
                  <h4>Bulk SMS</h4>
                  <p class="mb-4">Reach Your Audience Seamlessly with our Bulk SMS packages.</p>
                  <!-- btn -->

                </div>

              </div>
            </a>
          </div>
        </div>


      </div>
    </section>

    <section class="mt-lg-14 mt-4 bg-light-warning pt-4"
      style='border:5px solid #856404;border-left:0px;border-right:0px'>
      <!-- container -->


      <div class="container">
        <!-- row -->


        <div class="row d-flex align-items-center mb-8 p-4">
          <div class="col-12 col-md-12 col-lg-8"><a href="#!">
              <!-- img -->
              <div class="img-zoom">
                <img src="../assets/images/blog/blog-large.jpg" alt="" class="img-fluid w-100">
              </div>
            </a></div>
          <!-- text -->
          <div class="col-12 col-md-12 col-lg-4">
            <div class="ps-lg-8 mt-8 mt-lg-0">
              <h2 class="mb-3" style='font-family:{{ $user->font_family }}; color:{{ $user->brand_color ??"#856404" }}'>
                <a href="#!" class="text-inherit">About Us</a>
              </h2>
              <p class="mb-0 lead">{{ $user->about_us ?? "We provide a comprehensive
                platform for all your data, airtime, electricity, and cable subscription needs. Our mission is to
                empower your digital lifestyle through affordability, automation, and lightning-fast transactions.
                " }}</p>
            </div>
          </div>

        </div>
      </div>
    </section>
    <!-- Category Section End-->
    <section id="data_prices" class="team">
      <div class="container">
        <h2 class='text-center mt-4'>Data Prices</h2>


        <div class="row">
          <div class="col-md-6 col-lg-3">
            <div class="block-pricing">
              <div class="pricing-table">
                <div class="section-title">
                  <img src="https://www.steadysub.com/frontend/img/mtn.png" class="rounded mx-auto d-block"
                    style="height:50px;width:50px;padding:5px;border:2px solid #EC4D37;border-radius:2px">
                  <div class="mx-auto d-block text-center">MTN DATA PLANS</div>
                </div>

                <table class="table table-striped">
                  <tbody>
                    @foreach($mtn as $data)
                    <tr>
                      <td>{{ $data->plan_name }}</td>
                      <td><b>₦{{ number_format($data->data_price) }}</b></td>
                    </tr>
                    @endforeach


                  </tbody>
                </table>
                <div class="table_btn"> <a href="/buydata" class="btn btn-warning mx-auto d-block">Purchase Now</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="block-pricing">
              <div class="pricing-table">
                <br>
                <div class="section-title">
                  <img src="https://www.steadysub.com/frontend/img/glo.png" class="rounded mx-auto d-block"
                    style="height:50px;width:50px;padding:5px;border:2px solid #EC4D37;border-radius:2px">
                  <div class="mx-auto d-block text-center">GLO DATA PLANS</div>
                </div>



                <table class="table table-striped">
                  <tbody>
                    @foreach($glo as $data)
                    <tr>
                      <td>{{ $data->plan_name }}</td>
                      <td><b>₦{{ number_format($data->data_price) }}</b></td>
                    </tr>
                    @endforeach


                  </tbody>
                </table>
                <div class="table_btn"> <a href="/buydata" class="btn btn-warning mx-auto d-block">Purchase Now</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="block-pricing">
              <div class="pricing-table">
                <br>
                <div class="section-title">
                  <img src="https://www.steadysub.com/frontend/img/airtel.png" class="rounded mx-auto d-block"
                    style="height:50px;width:50px;padding:5px;border:2px solid #EC4D37;border-radius:2px">
                  <div class="mx-auto d-block text-center">AIRTEL DATA PLANS</div>
                </div>



                <table class="table table-striped">
                  <tbody>
                    @foreach($airtel as $data)
                    <tr>
                      <td>{{ $data->plan_name }}</td>
                      <td><b>₦{{ number_format($data->data_price) }}</b></td>
                    </tr>
                    @endforeach


                  </tbody>
                </table>
                <div class="table_btn"> <a href="/buydata" class="btn btn-warning mx-auto d-block">Purchase Now</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 col-lg-3">
            <div class="block-pricing">
              <div class="pricing-table">
                <br>
                <div class="section-title">
                  <img src="https://www.steadysub.com/frontend/img/9mobile.png" class="rounded mx-auto d-block"
                    style="height:50px;width:50px;padding:5px;border:2px solid #EC4D37;border-radius:2px">
                  <div class="mx-auto d-block text-center">9MOBILE DATA PLANS</div>
                </div>



                <table class="table table-striped">
                  <tbody>
                    @foreach($nmobile as $data)
                    <tr>
                      <td>{{ $data->plan_name }}</td>
                      <td><b>₦{{ number_format($data->data_price) }}</b></td>
                    </tr>
                    @endforeach


                  </tbody>
                </table>
                <div class="table_btn"> <a href="/buydata" class="btn btn-warning mx-auto d-block"><i
                      class="bi bi-cart"></i>Purchase Now</a></div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>

    <section class="my-lg-14 my-8 bg-light-warning" style='border:5px solid #856404;border-left:0px;border-right:0px'>
      <div class="container ">

        <div class="row gy-50 gx-50">
          <div class="col-12 col-md-6 col-lg-4" data-show="startbox">
            <!-- Process step-->
            <div class="process-step ">
              <div class="process-number h1 large-heading m-0 text-black">01</div>
              <div class="process-body pt-10 ms-30"><a class="process-title h4 text-black" href="#">Everything
                  Automated</a>
                <p class="process-text text-black">Payment and Purchases fully Automated.
                </p>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4" data-show="startbox" data-show-delay="100">
            <!-- Process step-->
            <div class="process-step ">
              <div class="process-number h1 large-heading m-0 text-black">02</div>
              <div class="process-body pt-10 ms-30"><a class="process-title h4 text-black" href="#">Transaction Redo</a>
                <p class="process-text text-black">Experience hassle-free transaction retries with our one-click
                  Transaction Redo feature.</p>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4" data-show="startbox" data-show-delay="200">
            <!-- Process step-->
            <div class="process-step ">
              <div class="process-number h1 large-heading m-0 text-black">03</div>
              <div class="process-body pt-10 ms-30"><a class="process-title h4 text-black" href="#">Bulk Purchase</a>
                <p class="process-text text-black">Simplify bulk purchases with our streamlined process.
                </p>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4" data-show="startbox" data-show-delay="200">
            <!-- Process step-->
            <div class="process-step ">
              <div class="process-number h1 large-heading m-0 text-black">04</div>
              <div class="process-body pt-10 ms-30"><a class="process-title h4 text-black" href="#">Schedule For Later
                  Purchase</a>
                <p class="process-text text-black">Plan your purchases ahead with our 'Schedule for Later Purchase'
                  feature.
                </p>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4" data-show="startbox" data-show-delay="200">
            <!-- Process step-->
            <div class="process-step ">
              <div class="process-number h1 large-heading m-0 text-black">05</div>
              <div class="process-body pt-10 ms-30"><a class="process-title h4 text-black" href="#">Add Up
                  Beneficiaries</a>
                <p class="process-text text-black">Simplify future purchases by saving contacts, decoder numbers, and
                  meter numbers with our 'Add Up Beneficiaries' feature.
                </p>
              </div>
            </div>
          </div>
          <div class="col-12 col-md-6 col-lg-4" data-show="startbox" data-show-delay="200">
            <!-- Process step-->
            <div class="process-step ">
              <div class="process-number h1 large-heading m-0 text-black">06</div>
              <div class="process-body pt-10 ms-30"><a class="process-title h4 text-black" href="#">24/7 Support
                  System</a>
                <p class="process-text text-black">Count on our 24/7 support system for assistance anytime you need it.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>



  <!-- footer -->
  <footer class="footer">
    <div class="container">
      <div class="row g-4 py-4">

        <div class="col-12 col-md-12 col-lg-8">
          <div class="row g-4">
            <div class='col-md-6'>
              <span class="me-1">
                {{-- <img class="rounded-circle header-profile-user" src="{{ asset('brand_images/'.$user->logo) }}"
                  style='width:50px;height:50px' /> --}}
                  @if($user->logo !== null)
            <img class="rounded-circle header-profile-user"
            src="https://vtubiz.com/public/brand_images/{{ $user->logo}}" style='width:50px;height:50px' />
           @else
            <h2>{{ $user->brand_name }}</h2>
            @endif
              </span>
            </div>
            <div class="col-6 col-sm-6 col-md-3">
              <h6 class="mb-4">Get to know us</h6>
              <!-- list -->
              <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="#about_us" class="nav-link">About Us</a></li>
                <li class="nav-item mb-2"><a href="#data_prices" class="nav-link">Data Prices</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Help Center</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Our Value</a></li>
              </ul>
            </div>
            <div class="col-6 col-sm-6 col-md-3">
              <h6 class="mb-4">For Consumers</h6>
              <ul class="nav flex-column">
                <!-- list -->
                <li class="nav-item mb-2"><a href="/data" class="nav-link">Buy Data</a></li>
                <li class="nav-item mb-2"><a href="/airtime" class="nav-link">Airtime Purchase</a></li>
                <li class="nav-item mb-2"><a href="/cable" class="nav-link">Tv(Cable) Subscription</a></li>
                <li class="nav-item mb-2"><a href="/electricity" class="nav-link">Pay Light Bills</a></li>
                <li class="nav-item mb-2"><a href="/bulksms" class="nav-link">Bulk SMS</a></li>
                <li class="nav-item mb-2"><a href="/examination" class="nav-link">Exam Result Checker</a></li>
              </ul>
            </div>
            <div class="col-6 col-sm-6 col-md-3">
              <h6 class="mb-4">Contact Us</h6>
              <ul class="nav flex-column">
                <!-- list -->

                <li class="nav-item mb-2"><a href="#!" class="nav-link">Contact Phone : {{ $user->phone }}</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Email : {{ $user->email }}</a></li>
              </ul>
            </div>

          </div>
        </div>
      </div>
      {{-- <div class="border-top py-4">
        <div class="row align-items-center">
          <div class="col-lg-5 text-lg-start text-center mb-2 mb-lg-0">
            <ul class="list-inline mb-0">
              <li class="list-inline-item text-dark">Top Partner of VTUBIZ</li>

            </ul>
          </div>
          <div class="col-lg-7 mt-4 mt-md-0">
            <ul class="list-inline mb-0 text-lg-end text-center">
              <li class="list-inline-item mb-2 mb-md-0 text-dark">Want a VTU Website like this?</li>
              <li class="list-inline-item ms-4">
                <a href="#!"> <img src="assets/images/appbutton/appstore-btn.svg" alt="" style="width: 140px;"></a>
              </li>
              <li class="list-inline-item">
                <a href="#!"> <img src="assets/images/appbutton/googleplay-btn.svg" alt="" style="width: 140px;"></a>
              </li>
            </ul>
          </div>
        </div>

      </div> --}}
      <div class="border-top py-4">
        <div class="row align-items-center">
          <div class="col-md-6"><span class="small text-muted">© {{ $user->brand_name }} <span id="copyright"> -
                <script>
                  document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
                </script>
              </span> All rights reserved. Powered by <a href="https://vtubiz.com/">VTUBIZ</a>.</span></div>
          <div class="col-md-6">
            <ul class="list-inline text-md-end mb-0 small mt-3 mt-md-0">
              <li class="list-inline-item text-muted">Follow us on</li>
              <li class="list-inline-item me-1">
                <a href="{{ $user->facebook ?? 'https://facebook.com/vtubiz' }}" class="btn btn-xs btn-social btn-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-facebook" viewBox="0 0 16 16">
                    <path
                      d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                  </svg></a>
              </li>
              <li class="list-inline-item me-1">
                <a href="{{ $user->twitter ?? 'https://twitter.com/vtubiz' }}" class="btn btn-xs btn-social btn-icon">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-twitter" viewBox="0 0 16 16">
                    <path
                      d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                  </svg></a>
              </li>
              <li class="list-inline-item">
                <a href="{{ $user->instagram ?? 'https://instagram.com/vtubiz' }}"
                  class="btn btn-xs btn-social btn-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                    fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                    <path
                      d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                  </svg></a>
              </li>
            </ul>
          </div>
        </div>

      </div>
    </div>
  </footer>

  <!-- Javascript-->

  <!-- Libs JS -->
  <script src="{{ asset('theme1/assets/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{ asset('theme1/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('theme1/assets/libs/simplebar/dist/simplebar.min.js')}}"></script>

  <!-- Theme JS -->
  <script src="{{ asset('theme1/assets/js/theme.min.js')}}"></script>
  <script src="{{ asset('theme1/assets/libs/jquery-countdown/dist/jquery.countdown.min.js')}}"></script>
  <script src="{{ asset('theme1/assets/js/vendors/countdown.js')}}"></script>
  <script src="{{ asset('theme1/assets/libs/slick-carousel/slick/slick.min.js')}}"></script>
  <script src="{{ asset('theme1/assets/js/vendors/slick-slider.js')}}"></script>
  <script src="{{ asset('theme1/assets/libs/tiny-slider/dist/min/tiny-slider.js')}}"></script>
  <script src="{{ asset('theme1/assets/js/vendors/tns-slider.js')}}"></script>
  <script src="{{ asset('theme1/assets/js/vendors/zoom.js')}}"></script>
  <script src="{{ asset('theme1/assets/js/vendors/increment-value.js')}}"></script>



</body>


<!-- Mirrored from freshcart.codescandy.com/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 13 Aug 2023 16:10:34 GMT -->

</html>