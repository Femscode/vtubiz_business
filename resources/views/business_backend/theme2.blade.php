<!DOCTYPE html>
<html class="no-js" lang="en">


<!-- Mirrored from runwebrun.com/startbox/home-01.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Jul 2022 14:43:32 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <title>{{ $user->brand_name }} | Home </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Startbox">
    <meta name="author" content="RunWebRun">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"><!-- Favicon-->
    <link rel="icon" type="image/png" href="{{ asset('brand_images/'.$user->logo) }}"><!-- Fonts-->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&amp;display=swap">
    <!-- Style-->
    <!-- build:css -->
    <link rel="stylesheet" href="{{ asset('theme4/assets/vendors/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('theme4/assets/vendors/css/swiper-bundle.css')}}">
    <link rel="stylesheet" href="{{ asset('theme4/assets/css/main.css')}}"><!-- endbuild -->
    <!-- jQuery-->
    <script src="{{ asset('theme4/assets/vendors/js/jquery.min.js')}}"></script>
</head>

<body class=" has-topbar">
    <!-- Header-->
    <!-- Navbar top-->
    <nav class="navbar navbar-expand-lg navbar-top  bg-white">
        <div class="container"><a class="navbar-brand" href="">
            @if($user->logo !== null)
            <img class="rounded-circle header-profile-user"
            src="https://vtubiz.com/public/brand_images/{{ $user->logo}}" style='width:50px;height:50px' />
           @else
            <h2>{{ $user->brand_name }}</h2>
            @endif
            </a><a class="navbar-toggle order-4 popup-inline"
                href="#navbar-mobile-style-1"><span></span><span></span><span></span></a>
            <ul class="nav navbar-nav order-2 ms-auto nav-no-opacity">
                <li class="nav-item "><a class="nav-link" href="#"><span>Home</span></a></li>
                <li class="nav-item "><a class="nav-link" href="#about_us"><span>About Us</span></a></li>
                <li class="nav-item "><a class="nav-link" href="#services"><span>Services</span></a></li>
                <li class="nav-item "><a class="nav-link" href="#data_prices"><span>Data Prices</span></a></li>
                <li class="nav-item "><a class="nav-link" href="https://wa.me/234{{ substr($user->phone,1) }}"><span>Contact Us</span></a></li>



            </ul><!-- Button-->
            <a class="btn d-none d-sm-inline-flex btn btn-sm btn-accent-1 ms-auto ms-lg-60 me-30 me-lg-0 order-2 order-lg-3"
                href="/register" target="_self">Create Account</a>
        </div>
    </nav><!-- Navbar mobile-->
    <div class="navbar navbar-mobile navbar-mobile-style-1 bg-white mfp-hide" id="navbar-mobile-style-1">
        <div class="navbar-wrapper">
            <div class="navbar-head"><a class="navbar-brand d-block d-md-none" href="">
                <h2>{{ $user->brand_name }}</h2>           
            </a><a class="navbar-toggle popup-modal-dismiss"
                    href="#"><span></span><span></span><span></span></a></div>
            <div class="navbar-body">
                <ul class="nav navbar-nav navbar-nav-collapse">
                    <li class="nav-item "><a class="nav-link" href="#"><span>Home</span></a></li>
                    <li class="nav-item "><a class="nav-link" href="#about_us"><span>About Us</span></a></li>
                    <li class="nav-item "><a class="nav-link" href="#services"><span>Services</span></a></li>
                    <li class="nav-item "><a class="nav-link" href="#services"><span>Data Prices</span></a></li>
                    <li class="nav-item "><a class="nav-link" href="https://wa.me/234{{ substr($user->phone,1) }}"><span>Contact Us</span></a></li>



                </ul><!-- Button-->
                <a class="btn d-none d-sm-inline-flex btn btn-sm btn-accent-1 ms-auto ms-lg-60 me-30 me-lg-0 order-2 order-lg-3"
                    href="/register" target="_self">Create Account</a>

            </div>
            <div class="navbar-footer">
                <!-- Contacts-->
                <ul class="list-group borderless font-size-15">
                    <li class="list-group-item">Email: <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></li>
                    <li class="list-group-item">Phone: <a href="tel:{{ $user->phone }}">{{ $user->phone }}</a></li>
                </ul><!-- Social-->
                <ul class="nav nav-gap-sm navbar-nav nav-social mt-30 nav-no-opacity">
                    <li class="nav-item"><a class="nav-link" href="{{ $user->facebook }}"><svg
                                xmlns="http://www.w3.org/2000/svg" width="8" height="15" fill="none">
                                <path fill="currentColor"
                                    d="M5.93 3.08h1.128V.974A13.651 13.651 0 0 0 5.416.882c-1.626 0-2.74 1.096-2.74 3.11v1.853H.882v2.353h1.794v5.92h2.2v-5.92h1.721l.274-2.353H4.875v-1.62c0-.68.171-1.146 1.056-1.146Z" />
                            </svg></a></li>

                    <li class="nav-item"><a class="nav-link" href="{{ $user->twitter }}"><svg
                                xmlns="http://www.w3.org/2000/svg" width="16" height="13" fill="none">
                                <path fill="currentColor"
                                    d="M13.986 3.445c.01.133.01.266.01.4 0 4.064-3.093 8.746-8.747 8.746a8.687 8.687 0 0 1-4.72-1.38c.247.029.485.038.742.038 1.437 0 2.76-.485 3.816-1.313a3.08 3.08 0 0 1-2.874-2.132 3.251 3.251 0 0 0 1.39-.057A3.075 3.075 0 0 1 1.137 4.73v-.038c.41.228.886.37 1.39.39a3.072 3.072 0 0 1-1.37-2.56c0-.571.152-1.095.418-1.552a8.738 8.738 0 0 0 6.34 3.217 3.47 3.47 0 0 1-.077-.704A3.073 3.073 0 0 1 10.912.409c.885 0 1.685.37 2.246.97A6.052 6.052 0 0 0 15.11.637a3.066 3.066 0 0 1-1.352 1.694 6.164 6.164 0 0 0 1.77-.476 6.609 6.609 0 0 1-1.542 1.59Z" />
                            </svg></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ $user->instagram }}"><svg
                                xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none">
                                <path fill="currentColor"
                                    d="M7.504 4.13c-1.88 0-3.395 1.504-3.395 3.367s1.516 3.366 3.395 3.366 3.394-1.503 3.394-3.366c0-1.863-1.515-3.366-3.394-3.366Zm0 5.556a2.202 2.202 0 0 1-2.207-2.189A2.2 2.2 0 0 1 7.504 5.31 2.2 2.2 0 0 1 9.71 7.497a2.202 2.202 0 0 1-2.207 2.189Zm4.325-5.693a.787.787 0 0 1-.792.785.787.787 0 0 1-.792-.785c0-.433.355-.785.792-.785.437 0 .792.352.792.785Zm2.248.797c-.05-1.052-.293-1.983-1.07-2.75-.774-.769-1.713-1.009-2.774-1.061C9.14.917 5.864.917 4.771.979c-1.058.05-1.997.29-2.774 1.057-.777.768-1.016 1.7-1.07 2.751-.062 1.084-.062 4.333 0 5.417.05 1.052.293 1.983 1.07 2.751.777.768 1.713 1.008 2.774 1.06 1.093.062 4.37.062 5.462 0 1.061-.05 2-.29 2.775-1.06.774-.768 1.016-1.7 1.069-2.75.062-1.085.062-4.331 0-5.415Zm-1.412 6.577a2.225 2.225 0 0 1-1.259 1.248c-.871.343-2.94.264-3.902.264-.963 0-3.034.076-3.903-.264a2.225 2.225 0 0 1-1.259-1.248c-.345-.864-.265-2.915-.265-3.87 0-.955-.077-3.009.265-3.87a2.225 2.225 0 0 1 1.259-1.248c.872-.343 2.94-.264 3.903-.264.963 0 3.034-.076 3.902.264.58.228 1.025.67 1.259 1.248.346.864.266 2.915.266 3.87 0 .955.08 3.009-.266 3.87Z" />
                            </svg></a></li>

                </ul>
            </div>
        </div>
    </div><!-- Topbar-->
    <div class="navbar navbar-topbar navbar-expand-xl navbar-dark navbar-absolute top-0 d-none d-xl-flex">
        <div class="container">
            <!-- Language switcher-->

            <ul class="nav navbar-nav nav-gap-xl nav-contacts nav-no-opacity">
                <li class="nav-item"><a class="nav-link" href="tel:{{ $user->phone }}"><svg
                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none">
                            <path fill="currentColor"
                                d="M16 11.98v2.408a1.604 1.604 0 0 1-1.094 1.527 1.613 1.613 0 0 1-.66.079 15.941 15.941 0 0 1-6.943-2.465A15.672 15.672 0 0 1 2.476 8.71a15.869 15.869 0 0 1-2.47-6.96A1.603 1.603 0 0 1 .96.136C1.163.047 1.384 0 1.607 0h2.414A1.61 1.61 0 0 1 5.63 1.381c.102.77.29 1.528.563 2.256a1.603 1.603 0 0 1-.362 1.694l-1.022 1.02a12.86 12.86 0 0 0 4.827 4.817l1.022-1.02a1.61 1.61 0 0 1 1.697-.36c.73.271 1.489.46 2.26.561A1.61 1.61 0 0 1 16 11.98Z" />
                        </svg>{{ $user->phone }}</a></li>
                <li class="nav-item"><a class="nav-link" href="mailto:{{ $user->email }}"><svg
                            xmlns="http://www.w3.org/2000/svg" width="14" height="11" fill="none">
                            <path fill="currentColor" d="M14 0H0l7 4.583L14 0Z" />
                            <path fill="currentColor"
                                d="M14 9.821V2L7 6.5 0 2v7.821C0 10.47.63 11 1.4 11h11.2c.77 0 1.4-.53 1.4-1.179Z" />
                        </svg>{{ $user->email }}</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="12"
                            height="14" fill="none">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="M6 14s6-3.818 6-8.273a5.598 5.598 0 0 0-1.757-4.05A6.148 6.148 0 0 0 6 0a6.148 6.148 0 0 0-4.243 1.677A5.598 5.598 0 0 0 0 5.727C0 10.182 6 14 6 14Zm2-8a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"
                                clip-rule="evenodd" />
                        </svg>{{ $user->address }}</a></li>
            </ul><!-- Socials-->
            <ul class="nav nav-gap-sm navbar-nav nav-social ms-auto nav-no-opacity align-items-center">
                <li class="nav-item"><a class="nav-link" href="{{ $user->facebook }}"><svg
                            xmlns="http://www.w3.org/2000/svg" width="7" height="14" fill="none">
                            <path fill="currentColor"
                                d="M5.535 2.71h1.053V.748A12.741 12.741 0 0 0 5.055.66c-1.518 0-2.557 1.023-2.557 2.903v1.73H.823v2.195h1.675v5.525h2.053V7.488h1.607l.255-2.195H4.551V3.78c0-.635.159-1.07.984-1.07Z" />
                        </svg></a></li>

                <li class="nav-item"><a class="nav-link" href="{{ $user->twitter }}"><svg
                            xmlns="http://www.w3.org/2000/svg" width="15" height="12" fill="none">
                            <path fill="currentColor"
                                d="M12.854 2.986c.009.124.009.248.009.373 0 3.793-2.887 8.163-8.164 8.163a8.108 8.108 0 0 1-4.406-1.288c.23.027.453.036.693.036a5.746 5.746 0 0 0 3.562-1.226 2.874 2.874 0 0 1-2.683-1.99 3.035 3.035 0 0 0 1.297-.053 2.87 2.87 0 0 1-2.3-2.816v-.036a2.89 2.89 0 0 0 1.296.365A2.867 2.867 0 0 1 .88 2.124c0-.533.142-1.022.391-1.448a8.156 8.156 0 0 0 5.916 3.002 3.239 3.239 0 0 1-.07-.657c0-1.581 1.278-2.87 2.869-2.87.826 0 1.572.347 2.096.907a5.65 5.65 0 0 0 1.821-.693 2.862 2.862 0 0 1-1.261 1.581 5.751 5.751 0 0 0 1.652-.444 6.169 6.169 0 0 1-1.44 1.484Z" />
                        </svg></a></li>
                <li class="nav-item"><a class="nav-link" href="{{ $user->instagram }}"><svg
                            xmlns="http://www.w3.org/2000/svg" width="14" height="13" fill="none">
                            <path fill="currentColor"
                                d="M7.004 3.692c-1.754 0-3.169 1.403-3.169 3.142 0 1.74 1.415 3.142 3.169 3.142 1.753 0 3.168-1.403 3.168-3.142 0-1.739-1.415-3.142-3.168-3.142Zm0 5.185a2.055 2.055 0 0 1-2.06-2.043c0-1.126.924-2.042 2.06-2.042 1.136 0 2.06.916 2.06 2.042a2.055 2.055 0 0 1-2.06 2.043Zm4.036-5.313c0 .407-.33.733-.739.733a.734.734 0 0 1-.739-.733c0-.405.331-.733.74-.733.407 0 .738.328.738.733Zm2.099.744c-.047-.982-.273-1.852-.998-2.568-.723-.716-1.6-.94-2.59-.99-1.02-.057-4.078-.057-5.098 0-.987.047-1.864.27-2.59.987-.724.717-.948 1.586-.997 2.568-.058 1.011-.058 4.044 0 5.056.047.981.273 1.85.998 2.567.725.717 1.6.94 2.589.99 1.02.058 4.078.058 5.098 0 .99-.046 1.867-.27 2.59-.99.722-.716.948-1.586.998-2.567.058-1.012.058-4.042 0-5.053Zm-1.318 6.138a2.077 2.077 0 0 1-1.175 1.165c-.813.32-2.744.246-3.642.246-.9 0-2.832.071-3.643-.246a2.076 2.076 0 0 1-1.175-1.165c-.322-.806-.248-2.72-.248-3.612 0-.891-.071-2.808.248-3.612a2.077 2.077 0 0 1 1.175-1.165c.814-.32 2.744-.246 3.643-.246.898 0 2.831-.071 3.642.246.54.213.957.626 1.175 1.165.322.807.248 2.72.248 3.612 0 .891.074 2.808-.248 3.612Z" />
                        </svg></a></li>

            </ul>
        </div>
    </div><!-- Main-->
    <div class="content-wrap ">
        <div class="pt-180 pb-130 shape-parent">
            <div class="background">
                <div class="background-image jarallax" data-jarallax data-speed="0.8"><img class="jarallax-img"
                        loading="lazy" src="{{ asset('theme4/assets/img/root/call-to-action-1920x1080.jpg')}}" alt="">
                </div>
                <div class="background-color" style="--background-color: #481FA0;"></div>
            </div><!-- Shape-->
            <div class="shape justify-content-center mt-80"><img loading="lazy"
                    src="{{ asset('theme4/assets/img/root/home-2-shape-962x296.png')}}" alt="" width="962" height="296">
            </div><!-- Shape-->
            <div class="shape justify-content-start align-items-end"><img loading="lazy"
                    src="{{ asset('theme4/assets/img/root/home-2-shape-562x587.png')}}" alt="" width="562" height="587">
            </div><!-- Shape-->
            <div class="shape justify-content-end align-items-center"><img loading="lazy"
                    src="{{ asset('theme4/assets/img/root/home-2-shape-247x430.png')}}" alt="" width="247" height="430">
            </div>
            <div class="container text-center">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h1 class="text-white mb-30 px-lg-30">{{ $user->heading_1 ??"Top-Up, Pay Bills, Stay Connected"
                            }}</h1>
                        <p class="fw-medium font-size-18 text-white mb-45">{{ $user->subheading_1 ?? "Explore a World of
                            Convenience"}}.</p><!-- Button--><a class="btn btn-accent-1" href="/register"
                            target="_self">Get Started
                        </a>
                    </div>
                </div>
            </div>
            {{-- <div class="container mt-75">
                <!-- Slider-->
                <div class="swiper" data-swiper-slides="1" data-swiper-breakpoints="828:2, 1024:3" data-swiper-gap="30"
                    data-swiper-grabcursor="true" data-show="startbox">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide pt-15">
                                <div data-filters="branding">
                                    <!-- Portfolio--><a
                                        class="card card-portfolio  image-link overflow-hidden lift rounded-4"
                                        href="assets/img/home-2-slider-1-900x830.jpg"><span class="card-img"
                                            data-img-height style="--img-height: 92%;"><img loading="lazy"
                                                src="{{ asset('theme4/assets/img/home-2-slider-1-900x830.jpg')}}"
                                                alt=""></span></a>
                                </div>
                            </div>
                            <div class="swiper-slide pt-15">
                                <div data-filters="branding">
                                    <!-- Portfolio--><a
                                        class="card card-portfolio  image-link overflow-hidden lift rounded-4"
                                        href="assets/img/home-2-slider-2-900x830.jpg"><span class="card-img"
                                            data-img-height style="--img-height: 92%;"><img loading="lazy"
                                                src="{{ asset('theme4/assets/img/home-2-slider-2-900x830.jpg')}}"
                                                alt=""></span></a>
                                </div>
                            </div>
                            <div class="swiper-slide pt-15">
                                <div data-filters="branding">
                                    <!-- Portfolio--><a
                                        class="card card-portfolio  image-link overflow-hidden lift rounded-4"
                                        href="assets/img/home-2-slider-3-900x830.jpg"><span class="card-img"
                                            data-img-height style="--img-height: 92%;"><img loading="lazy"
                                                src="{{ asset('theme4/assets/img/home-2-slider-3-900x830.jpg')}}"
                                                alt=""></span></a>
                                </div>
                            </div>
                            <div class="swiper-slide pt-15">
                                <div data-filters="branding">
                                    <!-- Portfolio--><a
                                        class="card card-portfolio  image-link overflow-hidden lift rounded-4"
                                        href="assets/img/home-2-slider-4-900x830.jpg"><span class="card-img"
                                            data-img-height style="--img-height: 92%;"><img loading="lazy"
                                                src="{{ asset('theme4/assets/img/home-2-slider-4-900x830.jpg')}}"
                                                alt=""></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-button-prev swiper-button-position-1 swiper-button-white shadow"><svg
                            xmlns="http://www.w3.org/2000/svg" width="20" height="14" fill="none">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="m3.96 6.15 5.08-4.515L7.91.365.445 7l7.465 6.635 1.13-1.27L3.96 7.85h15.765v-1.7H3.96Z"
                                clip-rule="evenodd" />
                        </svg></div>
                    <div class="swiper-button-next swiper-button-position-1 swiper-button-white shadow"><svg
                            xmlns="http://www.w3.org/2000/svg" width="20" height="14" fill="none">
                            <path fill="currentColor" fill-rule="evenodd"
                                d="m16.21 6.15-5.08-4.515 1.13-1.27L19.725 7l-7.465 6.635-1.13-1.27 5.08-4.515H.445v-1.7H16.21Z"
                                clip-rule="evenodd" />
                        </svg></div>
                </div>
            </div> --}}
        </div>
        <div class="pt-120 pb-130">
            <div class="container" id='about_us'>
                <div class="row">
                    <div class="col-lg-12"><span class="badge bg-light text-dark mb-20" data-show="startbox">About
                            Us</span></div>
                </div>
                <div class="row gy-40">
                    <div class="col-lg-5">
                        <h2 class="m-0" data-show="startbox" data-show-delay="100"><span class="highlight">Here is what
                                we do.</span></h2>
                    </div>
                    <div class="col-lg-6 offset-lg-1">
                        <p class="m-0" data-show="startbox" data-show-delay="200">{{ $user->about_us ?? "We absolutely
                            provide a comprehensive platform for all your data, airtime, electricity, and cable
                            subscription needs. Our mission is to empower your digital lifestyle through affordability,
                            automation, and lightning-fast transactions." }}.</p>
                    </div>
                </div>
            </div>
            <div class="container mt-120">
                <div class="row gy-30">
                    <div class="col-12 col-lg-6" data-show="startbox">
                        <!-- Service line-->
                        <div class="service-line lift position-relative rounded-3">
                            <div class="service-line-icon text-accent-1">
                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Communication/Active-call.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
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
                            <div class="service-line-body ms-40">
                                <h4 class="service-line-title m-0">Airtime Top Up</h4><a href='/airtime'
                                    class="service-line-arrow stretched-link" href="service-single.html"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="20" height="14" fill="none">
                                        <path stroke="currentColor" stroke-width="1.7"
                                            d="M0 7h18m0 0-6.75-6M18 7l-6.75 6" />
                                    </svg></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6" data-show="startbox" data-show-delay="100">
                        <!-- Service line-->
                        <div class="service-line lift position-relative rounded-3">
                            <div class="service-line-icon text-accent-1">
                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Devices/LTE2.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
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
                            <div class="service-line-body ms-40">
                                <h4 class="service-line-title m-0">Affordable Data Plans</h4><a href='/data'
                                    class="service-line-arrow stretched-link" href="service-single.html"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="20" height="14" fill="none">
                                        <path stroke="currentColor" stroke-width="1.7"
                                            d="M0 7h18m0 0-6.75-6M18 7l-6.75 6" />
                                    </svg></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6" data-show="startbox">
                        <!-- Service line-->
                        <div class="service-line lift position-relative rounded-3">
                            <div class="service-line-icon text-accent-1">
                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Devices/TV2.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M3,5 L21,5 C21.5522847,5 22,5.44771525 22,6 L22,17 C22,17.5522847 21.5522847,18 21,18 L3,18 C2.44771525,18 2,17.5522847 2,17 L2,6 C2,5.44771525 2.44771525,5 3,5 Z M9.632,10.066 L11.032,10.066 L11.032,9.044 L7.035,9.044 L7.035,10.066 L8.435,10.066 L8.435,14 L9.632,14 L9.632,10.066 Z M14.935,14 L16.846,9.044 L15.523,9.044 L14.382,12.558 L14.354,12.558 L13.206,9.044 L11.862,9.044 L13.738,14 L14.935,14 Z"
                                                fill="#000000" />
                                            <rect fill="#000000" opacity="0.3" x="3" y="19" width="18" height="1"
                                                rx="0.5" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </div>
                            <div class="service-line-body ms-40">
                                <h4 class="service-line-title m-0">Cable Subscription</h4><a href='/cable'
                                    class="service-line-arrow stretched-link" href="service-single.html"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="20" height="14" fill="none">
                                        <path stroke="currentColor" stroke-width="1.7"
                                            d="M0 7h18m0 0-6.75-6M18 7l-6.75 6" />
                                    </svg></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6" data-show="startbox" data-show-delay="100">
                        <!-- Service line-->
                        <div class="service-line lift position-relative rounded-3">
                            <div class="service-line-icon text-accent-1">
                                <span class="svg-icon svg-icon-primary svg-icon-2x">
                                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Layout/Layout-top-panel-6.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <rect fill="#000000" x="2" y="5" width="19" height="4" rx="1" />
                                            <rect fill="#000000" opacity="0.3" x="2" y="11" width="19" height="10"
                                                rx="1" />
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </div>
                            <div class="service-line-body ms-40">
                                <h4 class="service-line-title m-0">Exam Result Checker</h4><a href='/examination'
                                    class="service-line-arrow stretched-link" href="service-single.html"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="20" height="14" fill="none">
                                        <path stroke="currentColor" stroke-width="1.7"
                                            d="M0 7h18m0 0-6.75-6M18 7l-6.75 6" />
                                    </svg></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6" data-show="startbox" data-show-delay="100">
                        <!-- Service line-->
                        <div class="service-line lift position-relative rounded-3">
                            <div class="service-line-icon text-accent-1">
                                <span class="svg-icon svg-icon-primary svg-icon-4x">
                                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Communication/Group-chat.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
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
                            <div class="service-line-body ms-40">
                                <h4 class="service-line-title m-0">Bulk SMS</h4><a href='bulksms'
                                    class="service-line-arrow stretched-link" href="service-single.html"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="20" height="14" fill="none">
                                        <path stroke="currentColor" stroke-width="1.7"
                                            d="M0 7h18m0 0-6.75-6M18 7l-6.75 6" />
                                    </svg></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6" data-show="startbox" data-show-delay="100">
                        <!-- Service line-->
                        <div class="service-line lift position-relative rounded-3">
                            <div class="service-line-icon text-accent-1">
                                <span class="svg-icon svg-icon-primary svg-icon-4x">
                                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Home/Bulb1.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
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
                            <div class="service-line-body ms-40">
                                <h4 class="service-line-title m-0">Pay For Light Bills</h4><a href='/electricity'
                                    class="service-line-arrow stretched-link" href="service-single.html"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="20" height="14" fill="none">
                                        <path stroke="currentColor" stroke-width="1.7"
                                            d="M0 7h18m0 0-6.75-6M18 7l-6.75 6" />
                                    </svg></a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <div class="bg-gray-light shape-parent">
            <!-- Shape-->
            <div class="shape justify-content-end align-items-start"><img loading="lazy"
                    src="{{ asset('theme4/assets/img/root/home-2-shape-390x294.png')}}" alt="" width="390" height="294">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 position-relative stretch-column to-left py-240">
                        <div class="background">
                            <div class="background-image jarallax" data-jarallax data-speed="0.8"><img
                                    class="jarallax-img" loading="lazy"
                                    src="{{ asset('theme4/assets/img/home-2-900x770.jpg')}}" alt=""></div>
                        </div>
                    </div>
                    <div class="col-lg-6 position-relative pt-120 pb-130">
                        <div class="ps-lg-100">
                            <h3 class="mb-30" data-show="startbox">{{ $user->heading_2 ?? "Top Up Airtime, Data, Cable
                                Subscriptions, and More, All at Your Convenience." }}</h3>
                            <p class="mb-40" data-show="startbox" data-show-delay="100">{{ $user->sub_heading_2 ??
                                "Simplify Your Digital Transactions" }}.</p>
                            <div data-show="startbox" data-show-delay="200">
                                <!-- Button--><a class="btn btn-accent-1 btn-link btn-clean" href="#"
                                    target="_self">Learn more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-120 pb-130">
            <div class="container">
                <div class="row mb-90">
                    <div class="col-lg-6 offset-lg-3 text-center"><span class="badge bg-light text-dark mb-20"
                            data-show="startbox">Features</span>
                        <h2 class="m-0" data-show="startbox" data-show-delay="100">What Made Us Stand Out?</h2>
                    </div>
                </div>
                <div class="row gy-45">


                    <div class="col-lg-4">
                        <!-- Item-->
                        <div class="d-flex" data-show="startbox">
                            <div class="flex-shrink-0">
                                <div class="circle-icon text-white bg-accent-1 mt-10"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="29" height="27" fill="none">
                                        <path fill="currentColor"
                                            d="m14.5 0 4.48 8.886L29 10.32l-7.25 6.913L23.461 27 14.5 22.386 5.539 27l1.711-9.767L0 10.32l10.02-1.434L14.5 0Z" />
                                    </svg></div>
                            </div>
                            <div class="flex-grow-1 ms-40">
                                <div class="h3 m-0">Everything Automated</div>
                                {{-- <div class="h6 mb-15">Years of exeperience</div> --}}
                                <p class="font-size-15 m-0">Payment and Purchases fully Automated.</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <!-- Item-->
                        <div class="d-flex" data-show="startbox">
                            <div class="flex-shrink-0">
                                <div class="circle-icon text-white bg-accent-1 mt-10"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="29" height="27" fill="none">
                                        <path fill="currentColor"
                                            d="m14.5 0 4.48 8.886L29 10.32l-7.25 6.913L23.461 27 14.5 22.386 5.539 27l1.711-9.767L0 10.32l10.02-1.434L14.5 0Z" />
                                    </svg></div>
                            </div>
                            <div class="flex-grow-1 ms-40">
                                <div class="h3 m-0">Redo Transaction</div>
                                {{-- <div class="h6 mb-15">Years of exeperience</div> --}}
                                <p class="font-size-15 m-0">Experience hassle-free transaction retries with our
                                    one-click Transaction Redo feature.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <!-- Item-->
                        <div class="d-flex" data-show="startbox">
                            <div class="flex-shrink-0">
                                <div class="circle-icon text-white bg-accent-1 mt-10"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="29" height="27" fill="none">
                                        <path fill="currentColor"
                                            d="m14.5 0 4.48 8.886L29 10.32l-7.25 6.913L23.461 27 14.5 22.386 5.539 27l1.711-9.767L0 10.32l10.02-1.434L14.5 0Z" />
                                    </svg></div>
                            </div>
                            <div class="flex-grow-1 ms-40">
                                <div class="h3 m-0">Bulk Purchase</div>
                                {{-- <div class="h6 mb-15">Years of exeperience</div> --}}
                                <p class="font-size-15 m-0">Simplify bulk purchases with our streamlined process.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <!-- Item-->
                        <div class="d-flex" data-show="startbox">
                            <div class="flex-shrink-0">
                                <div class="circle-icon text-white bg-accent-1 mt-10"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="29" height="27" fill="none">
                                        <path fill="currentColor"
                                            d="m14.5 0 4.48 8.886L29 10.32l-7.25 6.913L23.461 27 14.5 22.386 5.539 27l1.711-9.767L0 10.32l10.02-1.434L14.5 0Z" />
                                    </svg></div>
                            </div>
                            <div class="flex-grow-1 ms-40">
                                <div class="h3 m-0">Add Up Beneficiaries</div>
                                {{-- <div class="h6 mb-15">Years of exeperience</div> --}}
                                <p class="font-size-15 m-0">Simplify future purchases by saving contacts, decoder
                                    numbers, and meter numbers with our 'Add Up Beneficiaries' feature.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <!-- Item-->
                        <div class="d-flex" data-show="startbox">
                            <div class="flex-shrink-0">
                                <div class="circle-icon text-white bg-accent-1 mt-10"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="29" height="27" fill="none">
                                        <path fill="currentColor"
                                            d="m14.5 0 4.48 8.886L29 10.32l-7.25 6.913L23.461 27 14.5 22.386 5.539 27l1.711-9.767L0 10.32l10.02-1.434L14.5 0Z" />
                                    </svg></div>
                            </div>
                            <div class="flex-grow-1 ms-40">
                                <div class="h3 m-0">Schedule For Later Purchase</div>
                                {{-- <div class="h6 mb-15">Years of exeperience</div> --}}
                                <p class="font-size-15 m-0">Plan your purchases ahead with our 'Schedule for Later
                                    Purchase' feature.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <!-- Item-->
                        <div class="d-flex" data-show="startbox">
                            <div class="flex-shrink-0">
                                <div class="circle-icon text-white bg-accent-1 mt-10"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="29" height="27" fill="none">
                                        <path fill="currentColor"
                                            d="m14.5 0 4.48 8.886L29 10.32l-7.25 6.913L23.461 27 14.5 22.386 5.539 27l1.711-9.767L0 10.32l10.02-1.434L14.5 0Z" />
                                    </svg></div>
                            </div>
                            <div class="flex-grow-1 ms-40">
                                <div class="h3 m-0">24/7 Support System</div>
                                {{-- <div class="h6 mb-15">Years of exeperience</div> --}}
                                <p class="font-size-15 m-0">Count on our 24/7 support system for assistance anytime you
                                    need it.</p>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
        <div class="pt-120 pb-130 bg-linear-gradient">
            <div class="container">
                <div class="row mb-90">
                    <div class="col-lg-6 offset-lg-3 text-center px-lg-50">
                        <h2 class="mb-25 px-lg-10" data-show="startbox">Our Data Plans</h2>
                    </div>
                </div>
                <div class="row" id='data_prices'>
                    <div class="col-md-6 col-lg-3">
                        <div class="block-pricing">
                            <div class="pricing-table">
                                <div class="section-title">
                                    <img src="https://www.steadysub.com/frontend/img/mtn.png"
                                        class="rounded mx-auto d-block"
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
                                <div class="table_btn"> <a href="/buydata" style='color:white;background:#F01F4B'
                                        class="btn btn-success mx-auto d-block"><i class="bi bi-cart"></i>Purchase
                                        Now</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="block-pricing">
                            <div class="pricing-table">
                                <br>
                                <div class="section-title">
                                    <img src="https://www.steadysub.com/frontend/img/glo.png"
                                        class="rounded mx-auto d-block"
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
                                <div class="table_btn"> <a href="/buydata" style='color:white;background:#F01F4B'
                                        class="btn btn-success mx-auto d-block"><i class="bi bi-cart"></i>Purchase
                                        Now</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="block-pricing">
                            <div class="pricing-table">
                                <br>
                                <div class="section-title">
                                    <img src="https://www.steadysub.com/frontend/img/airtel.png"
                                        class="rounded mx-auto d-block"
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
                                <div class="table_btn"> <a href="/buydata" style='color:white;background:#F01F4B'
                                        class="btn btn-success mx-auto d-block"><i class="bi bi-cart"></i>Purchase
                                        Now</a></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <div class="block-pricing">
                            <div class="pricing-table">
                                <br>
                                <div class="section-title">
                                    <img src="https://www.steadysub.com/frontend/img/9mobile.png"
                                        class="rounded mx-auto d-block"
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
                                <div class="table_btn"> <a href="/buydata" style='color:white;background:#F01F4B'
                                        class="btn btn-success mx-auto d-block"><i class="bi bi-cart"></i>Purchase
                                        Now</a></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="pt-120 pb-130 position-relative">
            <div class="background">
                <div class="background-image jarallax" data-jarallax data-speed="0.8"><img class="jarallax-img"
                        loading="lazy" src="{{ asset('theme4/assets/img/root/contact-form-1920x1080.jpg')}}" alt="">
                </div>
                <div class="background-color" style="--background-color: #481FA0; opacity: .9;"></div>
            </div>
            <div class="container text-center">
                <h2 class="mb-80 text-white" data-show="startbox">Have a question?</h2>

                <!-- Button--><a href='https://wa.me/234{{ substr($user->phone,1) }}' class="btn btn-accent-1">Get In Touch</a>

            </div>
        </div>
    </div><!-- Footer-->
    <footer class="bg-dark text-white pt-120 pb-100 footerNext">
        <div class="container">
            <div class="row gy-50">
                <div class="col-12 col-lg-3"><a class="d-block mb-30" href="#">
                    @if($user->logo !== null)
                    <img class="rounded-circle header-profile-user"
                    src="https://vtubiz.com/public/brand_images/{{ $user->logo}}" style='width:50px;height:50px' />
                   @else
                    <h2 class='text-white'>{{ $user->brand_name }}</h2>
                    @endif

                    </a>
                    <ul class="nav text-white align-items-center mb-20 nav-gap-md nav-no-opacity">
                        <li class="nav-item"><a class="nav-link" href="{{ $user->facebook }}"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="8" height="17" fill="none">
                                    <path fill="currentColor"
                                        d="M6.318 2.8h1.391V.202A16.842 16.842 0 0 0 5.683.088c-2.006 0-3.38 1.353-3.38 3.837v2.287H.089v2.902h2.214v7.303h2.713V9.114H7.14l.338-2.902H5.016v-2c0-.839.21-1.413 1.302-1.413Z" />
                                </svg></a></li>

                        <li class="nav-item"><a class="nav-link" href="{{ $user->twitter }}"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="none">
                                    <path fill="currentColor"
                                        d="M17.477 4.484c.012.165.012.329.012.493 0 5.014-3.817 10.792-10.792 10.792-2.149 0-4.145-.623-5.824-1.703.305.035.599.047.916.047a7.596 7.596 0 0 0 4.709-1.62 3.8 3.8 0 0 1-3.547-2.63c.235.034.47.058.717.058.34 0 .68-.047.998-.13A3.793 3.793 0 0 1 1.625 6.07v-.047a3.82 3.82 0 0 0 1.714.482 3.79 3.79 0 0 1-1.691-3.159c0-.704.188-1.35.517-1.914a10.781 10.781 0 0 0 7.82 3.97 4.282 4.282 0 0 1-.094-.87c0-2.09 1.691-3.793 3.793-3.793 1.092 0 2.079.458 2.771 1.198a7.466 7.466 0 0 0 2.408-.916c-.282.88-.881 1.62-1.668 2.09a7.604 7.604 0 0 0 2.184-.587 8.153 8.153 0 0 1-1.902 1.961Z" />
                                </svg></a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ $user->instagram }}"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="none">
                                    <path fill="currentColor"
                                        d="M8.788 4.097C6.47 4.097 4.6 5.95 4.6 8.25c0 2.298 1.87 4.153 4.188 4.153 2.318 0 4.188-1.855 4.188-4.153 0-2.3-1.87-4.153-4.188-4.153Zm0 6.853c-1.498 0-2.723-1.211-2.723-2.7 0-1.49 1.221-2.7 2.723-2.7 1.502 0 2.723 1.21 2.723 2.7 0 1.489-1.225 2.7-2.723 2.7Zm5.336-7.023a.97.97 0 0 1-.977.968.97.97 0 0 1-.976-.968c0-.535.437-.969.976-.969.54 0 .977.434.977.969Zm2.774.983c-.062-1.298-.36-2.447-1.32-3.394C14.624.569 13.465.272 12.156.207c-1.349-.076-5.39-.076-6.74 0C4.113.27 2.954.565 1.995 1.512 1.035 2.46.74 3.61.674 4.906c-.076 1.338-.076 5.346 0 6.683.063 1.298.361 2.447 1.32 3.394.959.947 2.114 1.244 3.423 1.309 1.348.076 5.39.076 6.739 0 1.308-.062 2.468-.358 3.422-1.309.956-.947 1.254-2.096 1.32-3.394.076-1.337.076-5.342 0-6.68Zm-1.742 8.114a2.745 2.745 0 0 1-1.553 1.54c-1.075.423-3.627.325-4.815.325-1.188 0-3.743.095-4.815-.325a2.746 2.746 0 0 1-1.552-1.54c-.427-1.066-.329-3.596-.329-4.774 0-1.179-.094-3.712.329-4.775a2.745 2.745 0 0 1 1.552-1.54C5.048 1.512 7.6 1.61 8.788 1.61c1.188 0 3.743-.094 4.815.325a2.745 2.745 0 0 1 1.553 1.54c.426 1.066.328 3.596.328 4.775 0 1.178.098 3.712-.328 4.774Z" />
                                </svg></a></li>

                    </ul>
                    <p class="font-size-13 text-muted m-0">© 2023 Powered by VTUBIZ.</p>
                </div>
                <div class="col-2 d-none d-lg-block"></div>
                <div class="col-12 col-lg-7">
                    <div class="row gy-50">
                        <div class="col-6 col-md-4">
                            <h6 class="display-6 text-white mb-20">Services</h6>
                            <ul class="nav flex-column text-white nav-opacity nav-gap-sm">
                                <li class="nav-item"><a class="nav-link" href="/airtime">Airtime Top-Up</a></li>
                                <li class="nav-item"><a class="nav-link" href="/data">Data Purchase</a></li>
                                <li class="nav-item"><a class="nav-link" href="/cable">Cable Subscription</a></li>
                                <li class="nav-item"><a class="nav-link" href="/electricity">Pay Light Bills</a></li>
                                <li class="nav-item"><a class="nav-link" href="/bulksms">Bulk SMS</a></li>
                                <li class="nav-item"><a class="nav-link" href="/examination">Exam Result Checkers</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-md-4">
                            <h6 class="display-6 text-white mb-20">About</h6>
                            <ul class="nav flex-column text-white nav-opacity nav-gap-sm">
                                <li class="nav-item"><a class="nav-link" href="#about_us">About us</a></li>
                                <li class="nav-item"><a class="nav-link" href="#services">Our Services</a></li>
                                <li class="nav-item"><a class="nav-link" href="#contact_us">Contact us</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-md-4">
                            <h6 class="display-6 text-white mb-20">Contact</h6>
                            <ul class="nav flex-column text-white nav-opacity nav-gap-sm">
                                <li class="nav-item"><a class="nav-link" href="tel:{{ $user->phone }}">{{ $user->phone
                                        }}</a></li>

                                <li class="nav-item"><a class="nav-link" href="mailto:{{ $user->email }}">{{
                                        $user->email }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer><!-- Vendors-->
    <!-- build:js -->
    <script src="{{ asset('theme4/assets/vendors/js/bootstrap.js')}}"></script>
    <script src="{{ asset('theme4/assets/vendors/js/imagesloaded.pkgd.js')}}"></script>
    <script src="{{ asset('theme4/assets/vendors/js/isotope.pkgd.js')}}"></script>
    <script src="{{ asset('theme4/assets/vendors/js/jarallax.js')}}"></script>
    <script src="{{ asset('theme4/assets/vendors/js/jarallax-element.js')}}"></script>
    <script src="{{ asset('theme4/assets/vendors/js/jquery.countdown.js')}}"></script>
    <script src="{{ asset('theme4/assets/vendors/js/jquery.magnific-popup.js')}}"></script>
    <script src="{{ asset('theme4/assets/vendors/js/ofi.js')}}"></script>
    <script src="{{ asset('theme4/assets/vendors/js/jquery.inview.js')}}"></script>
    <script src="{{ asset('theme4/assets/vendors/js/swiper-bundle.js')}}"></script>
    <script src="{{ asset('theme4/assets/vendors/js/gist-embed.min.js')}}"></script>
    <script src="{{ asset('theme4/assets/js/helpers.js')}}"></script>
    <script src="{{ asset('theme4/assets/js/controllers/show-on-scroll.js')}}"></script>
    <script src="{{ asset('theme4/assets/js/controllers/countdown.js')}}"></script>
    <script src="{{ asset('theme4/assets/js/controllers/isotope.js')}}"></script>
    <script src="{{ asset('theme4/assets/js/controllers/navbar.js')}}"></script>
    <script src="{{ asset('theme4/assets/js/controllers/stretch-column.js')}}"></script>
    <script src="{{ asset('theme4/assets/js/controllers/swiper.js')}}"></script>
    <script src="{{ asset('theme4/assets/js/controllers/others.js')}}"></script><!-- endbuild -->
</body>


<!-- Mirrored from runwebrun.com/startbox/home-01.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Jul 2022 14:43:53 GMT -->

</html>