<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <title>VTUBIZ | Dashboard</title>
    <meta charset="utf-8" />
    <meta name="description" content="Top Up, Pay Bills, Stay Connected." />
    <meta name="keywords" content="Top Up, Pay Bills, Stay Connected." />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="VTUBIZ" />
    <meta property="og:url" content="https://vtubiz.com" />
    <meta property="og:site_name" content="VTUBIZ" />
    <link rel="shortcut icon" href="assets/media/logos/fav_01.png" />


    @laravelPWA
    <!--begin::Fonts(mandatory for all pages)-->

    <link rel="stylesheet" href="assets/googlefonts/inter.css" />
    <!--end::Fonts-->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    {{--
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <link href="assets/googlefonts/ubuntu.css" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Ubuntu&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <!-- //google ads -->
     <meta name="google-adsense-account" content="ca-pub-9520357947525167">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9520357947525167"
     crossorigin="anonymous"></script>
    <style>
        #fixedbutton {
            position: fixed;
            bottom: 20px;
            right: 20px;
            height: 50px;
            width: 50px;
        }

        .progress-container {
            display: flex;
            justify-content: space-between;
            position: relative;
            margin: 10px 0;
        }

        .progress-step {
            text-align: center;
            width: 20%;
            position: relative;
        }

        .progress-circle {
            width: 40px;
            height: 40px;
            color: black;
            background-color: #ddd;
            border-radius: 50%;
            margin: 0 auto;
            line-height: 40px;
            font-weight: bold;
            font-size: 14px;
        }

        .progress-line {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 4px;
            background-color: #ddd;
            z-index: -1;
            transform: translateX(-50%);
        }

        .progress-step.active .progress-circle {
            background-color: black;
            color: #fff;
        }

        .progress-step.active+.progress-line {
            background-color: #28a745;
        }

        .progress-step-title {
            margin-top: 10px;
            font-size: 14px;
            font-weight: 600;
        }

        /* Styling for the <p> element */
        .message {
            background-color: #343a40;
            /* Dark background */
            color: #fff;
            /* White text */
            padding: 10px 15px;
            /* Padding around the text */
            border-radius: 5px;
            /* Rounded corners */
            text-align: center;
            /* Center the text */
            margin-top: 20px;
            /* Space above the message */
            font-size: 15px;
            font-family: 'Lato', sans-serif;
        }
    </style>
    @yield('header')
</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_app_body" data-kt-app-header-fixed-mobile="true" data-kt-app-toolbar-enabled="true" class="app-default">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;

        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }

            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }

            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
    <!--Begin::Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FS8GGP" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!--End::Google Tag Manager (noscript) -->


    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page  flex-column flex-column-fluid " id="kt_app_page">


            <!--begin::Header-->
            <div id="kt_app_header" class="app-header " data-kt-sticky="true"
                data-kt-sticky-activate="{default: false, lg: true}" data-kt-sticky-name="app-header-sticky"
                data-kt-sticky-offset="{default: false, lg: '300px'}">

                <!--begin::Header container-->
                <div style='background:#ebebeb'
                    class="app-container container-xxl d-flex align-items-stretch justify-content-between "
                    id="kt_app_header_container">
                    <!--begin::Header mobile toggle-->
                    <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show sidebar menu">
                        <div class="btn btn-icon btn-active-color-primary w-35px h-35px" id="kt_app_header_menu_toggle">
                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                            <span class="svg-icon svg-icon-2"><svg width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                                        fill="currentColor" />
                                    <path opacity="0.3"
                                        d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                    </div>
                    <!--end::Header mobile toggle-->

                    <!--begin::Logo-->
                    <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0 me-lg-18">
                        <a href="https://vtubiz.com">
                            <img alt="Logo" src="{{ asset('assets/img/logo/vtulogo.png')}}" class="h-25px d-sm-none" />
                            <img alt="Logo" src="{{ asset('assets/img/logo/vtulogo.png')}}"
                                class="h-25px d-none d-sm-block" />
                        </a>
                    </div>
                    <!--end::Logo-->

                    <!--begin::Header wrapper-->
                    <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1"
                        id="kt_app_header_wrapper">

                        <!--begin::Menu wrapper-->
                        <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true"
                            data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}"
                            data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start"
                            data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true"
                            data-kt-swapper-mode="{default: 'append', lg: 'prepend'}"
                            data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}">
                            <!--begin::Menu-->
                            <div class=" menu  
            menu-rounded 
            menu-active-bg 
            menu-state-primary 
            menu-column 
            menu-lg-row 
            menu-title-gray-700 
            menu-icon-gray-500 
            menu-arrow-gray-500 
            menu-bullet-gray-500 
            my-5 my-lg-0 align-items-stretch fw-semibold px-2 px-lg-0
        " id="kt_app_header_menu" data-kt-menu="true">
                                <!--begin:Menu item-->
                                <a href='/dashboard'
                                    class="menu-item @if($active == 'dashboard') here show menu-here-bg @endif  me-0 me-lg-2">
                                    <!--begin:Menu link--><span class="menu-link"><span
                                            class="menu-title">Dashboard</span><span
                                            class="menu-arrow d-lg-none"></span></span>
                                    <!--end:Menu link-->
                                    <!--begin:Menu sub-->

                                    <!--end:Menu sub-->
                                </a>
                                <!--end:Menu item-->
                                <!--begin:Menu item-->
                                <a href='/transfer'
                                    class="menu-item  @if($active == 'transfer') here show menu-here-bg @endif menu-lg-down-accordion me-0 me-lg-2">
                                    <!--begin:Menu link--><span class="menu-link"><span class="menu-title">Make
                                            Transfer</span></span>

                                </a>


                                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                    data-kt-menu-placement="bottom-start"
                                    class="menu-item  @if($active == 'self_service') here show menu-here-bg @endif menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
                                    <!--begin:Menu link--><span class="menu-link"><span class="menu-title">Personal
                                            Purchase</span><span class="menu-arrow "></span></span>
                                    <!--end:Menu link-->
                                    <!--begin:Menu sub-->
                                    <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px"
                                        style="">
                                        <!--begin:Menu item-->
                                        <div class="menu-item">
                                            <!--begin:Menu link--><a class="menu-link" href="/data"
                                                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                                                data-bs-placement="right" data-kt-initialized="1"><span
                                                    class="menu-title">Buy Data
                                                </span></a>

                                        </div>
                                        <!-- <div class="menu-item">
                                            <a class="menu-link" href="/airtime"
                                                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                                                data-bs-placement="right" data-kt-initialized="1"><span
                                                    class="menu-title">Buy Airtime
                                                </span></a>

                                        </div> -->
                                        <div class="menu-item">
                                            <!--begin:Menu link--><a class="menu-link" href="/cable"
                                                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                                                data-bs-placement="right" data-kt-initialized="1"><span
                                                    class="menu-title">Tv Subscription
                                                </span></a>

                                        </div>
                                        <div class="menu-item">
                                            <!--begin:Menu link--><a class="menu-link" href="/electricity"
                                                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                                                data-bs-placement="right" data-kt-initialized="1"><span
                                                    class="menu-title">Electricity Bill
                                                </span></a>

                                        </div>
                                        <div class="menu-item">
                                            <!--begin:Menu link--><a class="menu-link" href="/examination"
                                                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                                                data-bs-placement="right" data-kt-initialized="1"><span
                                                    class="menu-title">Exam Result Checker
                                                </span></a>

                                        </div>



                                    </div>
                                    <!--end:Menu sub-->
                                </div>

                                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                    data-kt-menu-placement="bottom-start"
                                    class="menu-item  @if($active == 'self_service') here show menu-here-bg @endif menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
                                    <!--begin:Menu link--><span class="menu-link"><span class="menu-title">Group
                                            Purchase</span><span class="menu-arrow "></span></span>
                                    <!--end:Menu link-->
                                    <!--begin:Menu sub-->
                                    <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px"
                                        style="">
                                        <!--begin:Menu item-->
                                        <div class="menu-item">
                                            <!--begin:Menu link--><a class="menu-link" href="/airtime_group"
                                                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                                                data-bs-placement="right" data-kt-initialized="1"><span
                                                    class="menu-title">Airtime
                                                    Group</span></a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item">
                                            <!--begin:Menu link--><a class="menu-link" href="/data_group"
                                                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                                                data-bs-placement="right" data-kt-initialized="1"><span
                                                    class="menu-title">Data
                                                    Group</span></a>
                                            <!--end:Menu link-->
                                        </div>


                                    </div>
                                    <!--end:Menu sub-->
                                </div>
                                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                    data-kt-menu-placement="bottom-start"
                                    class="menu-item  @if($active == 'self_service') here show menu-here-bg @endif menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
                                    <!--begin:Menu link--><span class="menu-link"><span class="menu-title">Bulk
                                            SMS</span><span class="menu-arrow "></span></span>
                                    <!--end:Menu link-->
                                    <!--begin:Menu sub-->
                                    <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px"
                                        style="">
                                        <!--begin:Menu item-->
                                        <div class="menu-item">
                                            <!--begin:Menu link--><a class="menu-link" href="/bulksms"
                                                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                                                data-bs-placement="right" data-kt-initialized="1"><span
                                                    class="menu-title">Send Bulk
                                                    SMS</span></a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item">
                                            <!--begin:Menu link--><a class="menu-link" href="/contact_group"
                                                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                                                data-bs-placement="right" data-kt-initialized="1"><span
                                                    class="menu-title">Bulk SMS Contact
                                                    Groups</span></a>
                                            <!--end:Menu link-->
                                        </div>
                                        <div class="menu-item">
                                            <!--begin:Menu link--><a class="menu-link" href="/bulksms_transactions"
                                                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                                                data-bs-placement="right" data-kt-initialized="1"><span
                                                    class="menu-title">Bulk SMS
                                                    Records</span></a>
                                            <!--end:Menu link-->
                                        </div>

                                    </div>
                                    <!--end:Menu sub-->
                                </div>


                                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                    data-kt-menu-placement="bottom-start"
                                    class="menu-item  @if($active == 'self_service') here show menu-here-bg @endif menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
                                    <!--begin:Menu link--><span class="menu-link"><span class="menu-title">Self
                                            Service</span><span class="menu-arrow "></span></span>
                                    <!--end:Menu link-->
                                    <!--begin:Menu sub-->
                                    <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px"
                                        style="">
                                        <!--begin:Menu item-->
                                        <div class="menu-item">
                                            <!--begin:Menu link--><a class="menu-link" href="/verify_purchase"
                                                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                                                data-bs-placement="right" data-kt-initialized="1"><span
                                                    class="menu-title">Verify Purchase
                                                    Transactions</span></a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item">
                                            <!--begin:Menu link--><a class="menu-link" href="verify_payment"
                                                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                                                data-bs-placement="right" data-kt-initialized="1"><span
                                                    class="menu-title">Verify Payment
                                                    Transactions</span></a>
                                            <!--end:Menu link-->
                                        </div>

                                    </div>
                                    <!--end:Menu sub-->
                                </div>
                                <div class="menu-item">
                                    <!--begin:Menu link--><a class="menu-link" href="/my-giveaway"
                                        data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                                        data-bs-placement="right" data-kt-initialized="1"><span
                                            class="menu-title">Create Giveaways
                                        </span></a>

                                </div>
                                <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                    data-kt-menu-placement="bottom-start"
                                    class="menu-item  @if($active == 'transactions') here show menu-here-bg @endif menu-lg-down-accordion menu-sub-lg-down-indention me-0 me-lg-2">
                                    <!--begin:Menu link--><span class="menu-link"><span class="menu-title">Transactions</span><span class="menu-arrow "></span></span>
                                    <!--end:Menu link-->
                                    <!--begin:Menu sub-->
                                    <div class="menu-sub menu-sub-lg-down-accordion menu-sub-lg-dropdown px-lg-2 py-lg-4 w-lg-200px"
                                        style="">
                                        <!--begin:Menu item-->
                                        <div class="menu-item">
                                            <!--begin:Menu link--><a class="menu-link" href="/mytransactions"
                                                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                                                data-bs-placement="right" data-kt-initialized="1"><span
                                                    class="menu-title">My Transactions</span></a>
                                            <!--end:Menu link-->
                                        </div>
                                        <!--end:Menu item-->
                                        <!--begin:Menu item-->
                                        <div class="menu-item">
                                            <!--begin:Menu link--><a class="menu-link" href="pending_transactions"
                                                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                                                data-bs-placement="right" data-kt-initialized="1"><span
                                                    class="menu-title">Pending Transactions
                                                </span></a>
                                            <!--end:Menu link-->
                                        </div>

                                    </div>
                                    <!--end:Menu sub-->
                                </div>



                            </div>
                            <!--end::Menu-->
                        </div>
                        <!--end::Menu wrapper-->


                        <!--begin::Navbar-->
                        <div class="app-navbar flex-shrink-0">


                            <!--begin::User menu-->
                            <div class="app-navbar-item ms-5" id="kt_header_user_menu_toggle">
                                <!--begin::Menu wrapper-->
                                <div class="cursor-pointer symbol symbol-35px symbol-md-40px"
                                    data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                                    data-kt-menu-placement="bottom-end">
                                    <div style='background:#fff' class="p-5 symbol symbol-50px me-5 fa fa-user">

                                    </div>
                                </div>

                                <!--begin::User account menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                                    data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content d-flex align-items-center px-3">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-50px me-5 fa fa-user">

                                            </div>
                                            <!--end::Avatar-->

                                            <!--begin::Username-->
                                            <div class="d-flex flex-column">
                                                <div class=" d-flex align-items-center fs-5">
                                                    {{ $user->name }} <span
                                                        class="badge badge-light-success  fs-8 px-2 py-1 ms-2">Regular</span>
                                                </div>

                                                <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">
                                                    {{ $user->email }} </a>
                                            </div>
                                            <!--end::Username-->
                                        </div>
                                    </div>
                                    <!--end::Menu item-->

                                    <!--begin::Menu separator-->
                                    <div class="separator my-2"></div>
                                    <!--end::Menu separator-->

                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5">
                                        <a href="/profile" class="menu-link px-5">
                                            My Profile
                                        </a>
                                    </div>
                                    <!--end::Menu item-->

                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5">
                                        <a href="/transactions" class="menu-link px-5">
                                            <span class="menu-text">My Transactions</span>
                                            <span class="menu-badge">
                                                <span class="badge badge-light-danger badge-circle  fs-7">New</span>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="menu-item px-5">
                                        <a href="/pending_transactions" class="menu-link px-5">
                                            <span class="menu-text">Pending Transactions</span>

                                        </a>
                                    </div>
                                    <div class="menu-item px-5">
                                        <a href="/change-pin" class="menu-link px-5">
                                            <span class="menu-text">Pin Settings</span>
                                            <span class="menu-badge">
                                            </span>
                                        </a>
                                    </div>
                                    <div class="menu-item px-5">
                                        <a href="/change-password" class="menu-link px-5">
                                            <span class="menu-text">Change Password</span>
                                            <span class="menu-badge">
                                            </span>
                                        </a>
                                    </div>
                                    <!--end::Menu item-->



                                    <!--begin::Menu separator-->
                                    <div class="separator my-2"></div>
                                    <!--end::Menu separator-->

                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                                        data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                                        <a href="#" class="menu-link px-5">
                                            <span class="menu-title position-relative">
                                                Mode

                                                <span class="ms-5 position-absolute translate-middle-y top-50 end-0">
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen060.svg-->
                                                    <span class="svg-icon theme-light-show svg-icon-2"><svg width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M11.9905 5.62598C10.7293 5.62574 9.49646 5.9995 8.44775 6.69997C7.39903 7.40045 6.58159 8.39619 6.09881 9.56126C5.61603 10.7263 5.48958 12.0084 5.73547 13.2453C5.98135 14.4823 6.58852 15.6185 7.48019 16.5104C8.37186 17.4022 9.50798 18.0096 10.7449 18.2557C11.9818 18.5019 13.2639 18.3757 14.429 17.8931C15.5942 17.4106 16.5901 16.5933 17.2908 15.5448C17.9915 14.4962 18.3655 13.2634 18.3655 12.0023C18.3637 10.3119 17.6916 8.69129 16.4964 7.49593C15.3013 6.30056 13.6808 5.62806 11.9905 5.62598Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M22.1258 10.8771H20.627C20.3286 10.8771 20.0424 10.9956 19.8314 11.2066C19.6204 11.4176 19.5018 11.7038 19.5018 12.0023C19.5018 12.3007 19.6204 12.5869 19.8314 12.7979C20.0424 13.0089 20.3286 13.1274 20.627 13.1274H22.1258C22.4242 13.1274 22.7104 13.0089 22.9214 12.7979C23.1324 12.5869 23.2509 12.3007 23.2509 12.0023C23.2509 11.7038 23.1324 11.4176 22.9214 11.2066C22.7104 10.9956 22.4242 10.8771 22.1258 10.8771Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M11.9905 19.4995C11.6923 19.5 11.4064 19.6187 11.1956 19.8296C10.9848 20.0405 10.8663 20.3265 10.866 20.6247V22.1249C10.866 22.4231 10.9845 22.7091 11.1953 22.9199C11.4062 23.1308 11.6922 23.2492 11.9904 23.2492C12.2886 23.2492 12.5746 23.1308 12.7854 22.9199C12.9963 22.7091 13.1147 22.4231 13.1147 22.1249V20.6247C13.1145 20.3265 12.996 20.0406 12.7853 19.8296C12.5745 19.6187 12.2887 19.5 11.9905 19.4995Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M4.49743 12.0023C4.49718 11.704 4.37865 11.4181 4.16785 11.2072C3.95705 10.9962 3.67119 10.8775 3.37298 10.8771H1.87445C1.57603 10.8771 1.28984 10.9956 1.07883 11.2066C0.867812 11.4176 0.749266 11.7038 0.749266 12.0023C0.749266 12.3007 0.867812 12.5869 1.07883 12.7979C1.28984 13.0089 1.57603 13.1274 1.87445 13.1274H3.37299C3.6712 13.127 3.95706 13.0083 4.16785 12.7973C4.37865 12.5864 4.49718 12.3005 4.49743 12.0023Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M11.9905 4.50058C12.2887 4.50012 12.5745 4.38141 12.7853 4.17048C12.9961 3.95954 13.1147 3.67361 13.1149 3.3754V1.87521C13.1149 1.57701 12.9965 1.29103 12.7856 1.08017C12.5748 0.869313 12.2888 0.750854 11.9906 0.750854C11.6924 0.750854 11.4064 0.869313 11.1955 1.08017C10.9847 1.29103 10.8662 1.57701 10.8662 1.87521V3.3754C10.8664 3.67359 10.9849 3.95952 11.1957 4.17046C11.4065 4.3814 11.6923 4.50012 11.9905 4.50058Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M18.8857 6.6972L19.9465 5.63642C20.0512 5.53209 20.1343 5.40813 20.1911 5.27163C20.2479 5.13513 20.2772 4.98877 20.2774 4.84093C20.2775 4.69309 20.2485 4.54667 20.192 4.41006C20.1355 4.27344 20.0526 4.14932 19.948 4.04478C19.8435 3.94024 19.7194 3.85734 19.5828 3.80083C19.4462 3.74432 19.2997 3.71531 19.1519 3.71545C19.0041 3.7156 18.8577 3.7449 18.7212 3.80167C18.5847 3.85845 18.4607 3.94159 18.3564 4.04633L17.2956 5.10714C17.1909 5.21147 17.1077 5.33543 17.0509 5.47194C16.9942 5.60844 16.9649 5.7548 16.9647 5.90264C16.9646 6.05048 16.9936 6.19689 17.0501 6.33351C17.1066 6.47012 17.1895 6.59425 17.294 6.69878C17.3986 6.80332 17.5227 6.88621 17.6593 6.94272C17.7959 6.99923 17.9424 7.02824 18.0902 7.02809C18.238 7.02795 18.3844 6.99865 18.5209 6.94187C18.6574 6.88509 18.7814 6.80195 18.8857 6.6972Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M18.8855 17.3073C18.7812 17.2026 18.6572 17.1195 18.5207 17.0627C18.3843 17.006 18.2379 16.9767 18.0901 16.9766C17.9423 16.9764 17.7959 17.0055 17.6593 17.062C17.5227 17.1185 17.3986 17.2014 17.2941 17.3059C17.1895 17.4104 17.1067 17.5345 17.0501 17.6711C16.9936 17.8077 16.9646 17.9541 16.9648 18.1019C16.9649 18.2497 16.9942 18.3961 17.0509 18.5326C17.1077 18.6691 17.1908 18.793 17.2955 18.8974L18.3563 19.9582C18.4606 20.0629 18.5846 20.146 18.721 20.2027C18.8575 20.2595 19.0039 20.2887 19.1517 20.2889C19.2995 20.289 19.4459 20.26 19.5825 20.2035C19.7191 20.147 19.8432 20.0641 19.9477 19.9595C20.0523 19.855 20.1351 19.7309 20.1916 19.5943C20.2482 19.4577 20.2772 19.3113 20.277 19.1635C20.2769 19.0157 20.2476 18.8694 20.1909 18.7329C20.1341 18.5964 20.051 18.4724 19.9463 18.3681L18.8855 17.3073Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M5.09528 17.3072L4.0345 18.368C3.92972 18.4723 3.84655 18.5963 3.78974 18.7328C3.73294 18.8693 3.70362 19.0156 3.70346 19.1635C3.7033 19.3114 3.7323 19.4578 3.78881 19.5944C3.84532 19.7311 3.92822 19.8552 4.03277 19.9598C4.13732 20.0643 4.26147 20.1472 4.3981 20.2037C4.53473 20.2602 4.68117 20.2892 4.82902 20.2891C4.97688 20.2889 5.12325 20.2596 5.25976 20.2028C5.39627 20.146 5.52024 20.0628 5.62456 19.958L6.68536 18.8973C6.79007 18.7929 6.87318 18.6689 6.92993 18.5325C6.98667 18.396 7.01595 18.2496 7.01608 18.1018C7.01621 17.954 6.98719 17.8076 6.93068 17.671C6.87417 17.5344 6.79129 17.4103 6.68676 17.3058C6.58224 17.2012 6.45813 17.1183 6.32153 17.0618C6.18494 17.0053 6.03855 16.9763 5.89073 16.9764C5.74291 16.9766 5.59657 17.0058 5.46007 17.0626C5.32358 17.1193 5.19962 17.2024 5.09528 17.3072Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M5.09541 6.69715C5.19979 6.8017 5.32374 6.88466 5.4602 6.94128C5.59665 6.9979 5.74292 7.02708 5.89065 7.02714C6.03839 7.0272 6.18469 6.99815 6.32119 6.94164C6.45769 6.88514 6.58171 6.80228 6.68618 6.69782C6.79064 6.59336 6.87349 6.46933 6.93 6.33283C6.9865 6.19633 7.01556 6.05003 7.01549 5.9023C7.01543 5.75457 6.98625 5.60829 6.92963 5.47184C6.87301 5.33539 6.79005 5.21143 6.6855 5.10706L5.6247 4.04626C5.5204 3.94137 5.39643 3.8581 5.25989 3.80121C5.12335 3.74432 4.97692 3.71493 4.82901 3.71472C4.68109 3.71452 4.53458 3.7435 4.39789 3.80001C4.26119 3.85652 4.13699 3.93945 4.03239 4.04404C3.9278 4.14864 3.84487 4.27284 3.78836 4.40954C3.73185 4.54624 3.70287 4.69274 3.70308 4.84066C3.70329 4.98858 3.73268 5.135 3.78957 5.27154C3.84646 5.40808 3.92974 5.53205 4.03462 5.63635L5.09541 6.69715Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                    <!--begin::Svg Icon | path: icons/duotune/general/gen061.svg-->
                                                    <span class="svg-icon theme-dark-show svg-icon-2"><svg width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M19.0647 5.43757C19.3421 5.43757 19.567 5.21271 19.567 4.93534C19.567 4.65796 19.3421 4.43311 19.0647 4.43311C18.7874 4.43311 18.5625 4.65796 18.5625 4.93534C18.5625 5.21271 18.7874 5.43757 19.0647 5.43757Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M20.0692 9.48884C20.3466 9.48884 20.5714 9.26398 20.5714 8.98661C20.5714 8.70923 20.3466 8.48438 20.0692 8.48438C19.7918 8.48438 19.567 8.70923 19.567 8.98661C19.567 9.26398 19.7918 9.48884 20.0692 9.48884Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M12.0335 20.5714C15.6943 20.5714 18.9426 18.2053 20.1168 14.7338C20.1884 14.5225 20.1114 14.289 19.9284 14.161C19.746 14.034 19.5003 14.0418 19.3257 14.1821C18.2432 15.0546 16.9371 15.5156 15.5491 15.5156C12.2257 15.5156 9.48884 12.8122 9.48884 9.48886C9.48884 7.41079 10.5773 5.47137 12.3449 4.35752C12.5342 4.23832 12.6 4.00733 12.5377 3.79251C12.4759 3.57768 12.2571 3.42859 12.0335 3.42859C7.32556 3.42859 3.42857 7.29209 3.42857 12C3.42857 16.7079 7.32556 20.5714 12.0335 20.5714Z"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M13.0379 7.47998C13.8688 7.47998 14.5446 8.15585 14.5446 8.98668C14.5446 9.26428 14.7693 9.48891 15.0469 9.48891C15.3245 9.48891 15.5491 9.26428 15.5491 8.98668C15.5491 8.15585 16.225 7.47998 17.0558 7.47998C17.3334 7.47998 17.558 7.25535 17.558 6.97775C17.558 6.70015 17.3334 6.47552 17.0558 6.47552C16.225 6.47552 15.5491 5.76616 15.5491 4.93534C15.5491 4.65774 15.3245 4.43311 15.0469 4.43311C14.7693 4.43311 14.5446 4.65774 14.5446 4.93534C14.5446 5.76616 13.8688 6.47552 13.0379 6.47552C12.7603 6.47552 12.5357 6.70015 12.5357 6.97775C12.5357 7.25535 12.7603 7.47998 13.0379 7.47998Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </span>
                                            </span>
                                        </a>

                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-muted menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                                            data-kt-menu="true" data-kt-element="theme-mode-menu">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3 my-0">
                                                <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                                    data-kt-value="light">
                                                    <span class="menu-icon" data-kt-element="icon">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen060.svg-->
                                                        <span class="svg-icon svg-icon-3"><svg width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M11.9905 5.62598C10.7293 5.62574 9.49646 5.9995 8.44775 6.69997C7.39903 7.40045 6.58159 8.39619 6.09881 9.56126C5.61603 10.7263 5.48958 12.0084 5.73547 13.2453C5.98135 14.4823 6.58852 15.6185 7.48019 16.5104C8.37186 17.4022 9.50798 18.0096 10.7449 18.2557C11.9818 18.5019 13.2639 18.3757 14.429 17.8931C15.5942 17.4106 16.5901 16.5933 17.2908 15.5448C17.9915 14.4962 18.3655 13.2634 18.3655 12.0023C18.3637 10.3119 17.6916 8.69129 16.4964 7.49593C15.3013 6.30056 13.6808 5.62806 11.9905 5.62598Z"
                                                                    fill="currentColor" />
                                                                <path
                                                                    d="M22.1258 10.8771H20.627C20.3286 10.8771 20.0424 10.9956 19.8314 11.2066C19.6204 11.4176 19.5018 11.7038 19.5018 12.0023C19.5018 12.3007 19.6204 12.5869 19.8314 12.7979C20.0424 13.0089 20.3286 13.1274 20.627 13.1274H22.1258C22.4242 13.1274 22.7104 13.0089 22.9214 12.7979C23.1324 12.5869 23.2509 12.3007 23.2509 12.0023C23.2509 11.7038 23.1324 11.4176 22.9214 11.2066C22.7104 10.9956 22.4242 10.8771 22.1258 10.8771Z"
                                                                    fill="currentColor" />
                                                                <path
                                                                    d="M11.9905 19.4995C11.6923 19.5 11.4064 19.6187 11.1956 19.8296C10.9848 20.0405 10.8663 20.3265 10.866 20.6247V22.1249C10.866 22.4231 10.9845 22.7091 11.1953 22.9199C11.4062 23.1308 11.6922 23.2492 11.9904 23.2492C12.2886 23.2492 12.5746 23.1308 12.7854 22.9199C12.9963 22.7091 13.1147 22.4231 13.1147 22.1249V20.6247C13.1145 20.3265 12.996 20.0406 12.7853 19.8296C12.5745 19.6187 12.2887 19.5 11.9905 19.4995Z"
                                                                    fill="currentColor" />
                                                                <path
                                                                    d="M4.49743 12.0023C4.49718 11.704 4.37865 11.4181 4.16785 11.2072C3.95705 10.9962 3.67119 10.8775 3.37298 10.8771H1.87445C1.57603 10.8771 1.28984 10.9956 1.07883 11.2066C0.867812 11.4176 0.749266 11.7038 0.749266 12.0023C0.749266 12.3007 0.867812 12.5869 1.07883 12.7979C1.28984 13.0089 1.57603 13.1274 1.87445 13.1274H3.37299C3.6712 13.127 3.95706 13.0083 4.16785 12.7973C4.37865 12.5864 4.49718 12.3005 4.49743 12.0023Z"
                                                                    fill="currentColor" />
                                                                <path
                                                                    d="M11.9905 4.50058C12.2887 4.50012 12.5745 4.38141 12.7853 4.17048C12.9961 3.95954 13.1147 3.67361 13.1149 3.3754V1.87521C13.1149 1.57701 12.9965 1.29103 12.7856 1.08017C12.5748 0.869313 12.2888 0.750854 11.9906 0.750854C11.6924 0.750854 11.4064 0.869313 11.1955 1.08017C10.9847 1.29103 10.8662 1.57701 10.8662 1.87521V3.3754C10.8664 3.67359 10.9849 3.95952 11.1957 4.17046C11.4065 4.3814 11.6923 4.50012 11.9905 4.50058Z"
                                                                    fill="currentColor" />
                                                                <path
                                                                    d="M18.8857 6.6972L19.9465 5.63642C20.0512 5.53209 20.1343 5.40813 20.1911 5.27163C20.2479 5.13513 20.2772 4.98877 20.2774 4.84093C20.2775 4.69309 20.2485 4.54667 20.192 4.41006C20.1355 4.27344 20.0526 4.14932 19.948 4.04478C19.8435 3.94024 19.7194 3.85734 19.5828 3.80083C19.4462 3.74432 19.2997 3.71531 19.1519 3.71545C19.0041 3.7156 18.8577 3.7449 18.7212 3.80167C18.5847 3.85845 18.4607 3.94159 18.3564 4.04633L17.2956 5.10714C17.1909 5.21147 17.1077 5.33543 17.0509 5.47194C16.9942 5.60844 16.9649 5.7548 16.9647 5.90264C16.9646 6.05048 16.9936 6.19689 17.0501 6.33351C17.1066 6.47012 17.1895 6.59425 17.294 6.69878C17.3986 6.80332 17.5227 6.88621 17.6593 6.94272C17.7959 6.99923 17.9424 7.02824 18.0902 7.02809C18.238 7.02795 18.3844 6.99865 18.5209 6.94187C18.6574 6.88509 18.7814 6.80195 18.8857 6.6972Z"
                                                                    fill="currentColor" />
                                                                <path
                                                                    d="M18.8855 17.3073C18.7812 17.2026 18.6572 17.1195 18.5207 17.0627C18.3843 17.006 18.2379 16.9767 18.0901 16.9766C17.9423 16.9764 17.7959 17.0055 17.6593 17.062C17.5227 17.1185 17.3986 17.2014 17.2941 17.3059C17.1895 17.4104 17.1067 17.5345 17.0501 17.6711C16.9936 17.8077 16.9646 17.9541 16.9648 18.1019C16.9649 18.2497 16.9942 18.3961 17.0509 18.5326C17.1077 18.6691 17.1908 18.793 17.2955 18.8974L18.3563 19.9582C18.4606 20.0629 18.5846 20.146 18.721 20.2027C18.8575 20.2595 19.0039 20.2887 19.1517 20.2889C19.2995 20.289 19.4459 20.26 19.5825 20.2035C19.7191 20.147 19.8432 20.0641 19.9477 19.9595C20.0523 19.855 20.1351 19.7309 20.1916 19.5943C20.2482 19.4577 20.2772 19.3113 20.277 19.1635C20.2769 19.0157 20.2476 18.8694 20.1909 18.7329C20.1341 18.5964 20.051 18.4724 19.9463 18.3681L18.8855 17.3073Z"
                                                                    fill="currentColor" />
                                                                <path
                                                                    d="M5.09528 17.3072L4.0345 18.368C3.92972 18.4723 3.84655 18.5963 3.78974 18.7328C3.73294 18.8693 3.70362 19.0156 3.70346 19.1635C3.7033 19.3114 3.7323 19.4578 3.78881 19.5944C3.84532 19.7311 3.92822 19.8552 4.03277 19.9598C4.13732 20.0643 4.26147 20.1472 4.3981 20.2037C4.53473 20.2602 4.68117 20.2892 4.82902 20.2891C4.97688 20.2889 5.12325 20.2596 5.25976 20.2028C5.39627 20.146 5.52024 20.0628 5.62456 19.958L6.68536 18.8973C6.79007 18.7929 6.87318 18.6689 6.92993 18.5325C6.98667 18.396 7.01595 18.2496 7.01608 18.1018C7.01621 17.954 6.98719 17.8076 6.93068 17.671C6.87417 17.5344 6.79129 17.4103 6.68676 17.3058C6.58224 17.2012 6.45813 17.1183 6.32153 17.0618C6.18494 17.0053 6.03855 16.9763 5.89073 16.9764C5.74291 16.9766 5.59657 17.0058 5.46007 17.0626C5.32358 17.1193 5.19962 17.2024 5.09528 17.3072Z"
                                                                    fill="currentColor" />
                                                                <path
                                                                    d="M5.09541 6.69715C5.19979 6.8017 5.32374 6.88466 5.4602 6.94128C5.59665 6.9979 5.74292 7.02708 5.89065 7.02714C6.03839 7.0272 6.18469 6.99815 6.32119 6.94164C6.45769 6.88514 6.58171 6.80228 6.68618 6.69782C6.79064 6.59336 6.87349 6.46933 6.93 6.33283C6.9865 6.19633 7.01556 6.05003 7.01549 5.9023C7.01543 5.75457 6.98625 5.60829 6.92963 5.47184C6.87301 5.33539 6.79005 5.21143 6.6855 5.10706L5.6247 4.04626C5.5204 3.94137 5.39643 3.8581 5.25989 3.80121C5.12335 3.74432 4.97692 3.71493 4.82901 3.71472C4.68109 3.71452 4.53458 3.7435 4.39789 3.80001C4.26119 3.85652 4.13699 3.93945 4.03239 4.04404C3.9278 4.14864 3.84487 4.27284 3.78836 4.40954C3.73185 4.54624 3.70287 4.69274 3.70308 4.84066C3.70329 4.98858 3.73268 5.135 3.78957 5.27154C3.84646 5.40808 3.92974 5.53205 4.03462 5.63635L5.09541 6.69715Z"
                                                                    fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                    <span class="menu-title">
                                                        Light
                                                    </span>
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3 my-0">
                                                <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                                    data-kt-value="dark">
                                                    <span class="menu-icon" data-kt-element="icon">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen061.svg-->
                                                        <span class="svg-icon svg-icon-3"><svg width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M19.0647 5.43757C19.3421 5.43757 19.567 5.21271 19.567 4.93534C19.567 4.65796 19.3421 4.43311 19.0647 4.43311C18.7874 4.43311 18.5625 4.65796 18.5625 4.93534C18.5625 5.21271 18.7874 5.43757 19.0647 5.43757Z"
                                                                    fill="currentColor" />
                                                                <path
                                                                    d="M20.0692 9.48884C20.3466 9.48884 20.5714 9.26398 20.5714 8.98661C20.5714 8.70923 20.3466 8.48438 20.0692 8.48438C19.7918 8.48438 19.567 8.70923 19.567 8.98661C19.567 9.26398 19.7918 9.48884 20.0692 9.48884Z"
                                                                    fill="currentColor" />
                                                                <path
                                                                    d="M12.0335 20.5714C15.6943 20.5714 18.9426 18.2053 20.1168 14.7338C20.1884 14.5225 20.1114 14.289 19.9284 14.161C19.746 14.034 19.5003 14.0418 19.3257 14.1821C18.2432 15.0546 16.9371 15.5156 15.5491 15.5156C12.2257 15.5156 9.48884 12.8122 9.48884 9.48886C9.48884 7.41079 10.5773 5.47137 12.3449 4.35752C12.5342 4.23832 12.6 4.00733 12.5377 3.79251C12.4759 3.57768 12.2571 3.42859 12.0335 3.42859C7.32556 3.42859 3.42857 7.29209 3.42857 12C3.42857 16.7079 7.32556 20.5714 12.0335 20.5714Z"
                                                                    fill="currentColor" />
                                                                <path
                                                                    d="M13.0379 7.47998C13.8688 7.47998 14.5446 8.15585 14.5446 8.98668C14.5446 9.26428 14.7693 9.48891 15.0469 9.48891C15.3245 9.48891 15.5491 9.26428 15.5491 8.98668C15.5491 8.15585 16.225 7.47998 17.0558 7.47998C17.3334 7.47998 17.558 7.25535 17.558 6.97775C17.558 6.70015 17.3334 6.47552 17.0558 6.47552C16.225 6.47552 15.5491 5.76616 15.5491 4.93534C15.5491 4.65774 15.3245 4.43311 15.0469 4.43311C14.7693 4.43311 14.5446 4.65774 14.5446 4.93534C14.5446 5.76616 13.8688 6.47552 13.0379 6.47552C12.7603 6.47552 12.5357 6.70015 12.5357 6.97775C12.5357 7.25535 12.7603 7.47998 13.0379 7.47998Z"
                                                                    fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                    <span class="menu-title">
                                                        Dark
                                                    </span>
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3 my-0">
                                                <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                                    data-kt-value="system">
                                                    <span class="menu-icon" data-kt-element="icon">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen062.svg-->
                                                        <span class="svg-icon svg-icon-3"><svg width="24" height="24"
                                                                viewBox="0 0 24 24" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M1.34375 3.9463V15.2178C1.34375 16.119 2.08105 16.8563 2.98219 16.8563H8.65093V19.4594H6.15702C5.38853 19.4594 4.75981 19.9617 4.75981 20.5757V21.6921H19.2403V20.5757C19.2403 19.9617 18.6116 19.4594 17.8431 19.4594H15.3492V16.8563H21.0179C21.919 16.8563 22.6562 16.119 22.6562 15.2178V3.9463C22.6562 3.04516 21.9189 2.30786 21.0179 2.30786H2.98219C2.08105 2.30786 1.34375 3.04516 1.34375 3.9463ZM12.9034 9.9016C13.241 9.98792 13.5597 10.1216 13.852 10.2949L15.0393 9.4353L15.9893 10.3853L15.1297 11.5727C15.303 11.865 15.4366 12.1837 15.523 12.5212L16.97 12.7528V13.4089H13.9851C13.9766 12.3198 13.0912 11.4394 12 11.4394C10.9089 11.4394 10.0235 12.3198 10.015 13.4089H7.03006V12.7528L8.47712 12.5211C8.56345 12.1836 8.69703 11.8649 8.87037 11.5727L8.0107 10.3853L8.96078 9.4353L10.148 10.2949C10.4404 10.1215 10.759 9.98788 11.0966 9.9016L11.3282 8.45467H12.6718L12.9034 9.9016ZM16.1353 7.93758C15.6779 7.93758 15.3071 7.56681 15.3071 7.1094C15.3071 6.652 15.6779 6.28122 16.1353 6.28122C16.5926 6.28122 16.9634 6.652 16.9634 7.1094C16.9634 7.56681 16.5926 7.93758 16.1353 7.93758ZM2.71385 14.0964V3.90518C2.71385 3.78023 2.81612 3.67796 2.94107 3.67796H21.0589C21.1839 3.67796 21.2861 3.78023 21.2861 3.90518V14.0964C15.0954 14.0964 8.90462 14.0964 2.71385 14.0964Z"
                                                                    fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                    <span class="menu-title">
                                                        System
                                                    </span>
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->

                                    </div>


                                    <!--begin::Menu item-->
                                    {{-- <div class="menu-item px-5 my-1">
                                        <a href="#" class="menu-link px-5">
                                            Be a vendor
                                        </a>
                                    </div> --}}
                                    <!--end::Menu item-->

                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5">
                                        <a href="/logout" onclick='return confirm("Are you sure you want to sign out?")'
                                            class="menu-link px-5">
                                            Sign Out
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::User account menu-->

                                <!--end::Menu wrapper-->
                            </div>
                            <!--end::User menu-->

                            <!--begin::Header menu toggle-->
                            <!--end::Header menu toggle-->
                        </div>
                        <!--end::Navbar-->
                    </div>
                    <!--end::Header wrapper-->
                </div>
                <!--end::Header container-->
            </div>
            <!--end::Header-->
            <!--begin::Wrapper-->
            <div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">

                <!--begin::Toolbar-->
                <div style='background:url({{ asset('/assets/media/auth/bg3.jpg') }});background-size:cover;width:100%' class="app-toolbar  py-6 ">
                    <!-- <div style='background:url({{ asset('assets/img/bg7.jpg')}});background-size:cover' id="kt_app_toolbar" class="app-toolbar py-6 "> -->

                    <!--begin::Toolbar container-->
                    <div id="kt_app_toolbar_container" class="app-container  container-xxl d-flex align-items-start ">
                        <!--begin::Toolbar container-->
                        <div class="d-flex flex-column flex-row-fluid">
                            <!--begin::Toolbar wrapper-->
                            <div class="d-flex align-items-center pt-1">

                                <!--begin::Breadcrumb-->
                                <ul class="breadcrumb breadcrumb-separatorless fw-semibold">

                                    <!--begin::Item-->
                                    <li class="breadcrumb-item text-white  lh-1">
                                        <a href="https://vtubiz.com" class="text-white">
                                            <i class="fonticon-home text-gray-700  fs-3"></i>
                                        </a>
                                    </li>
                                    <!--end::Item-->

                                    <!--begin::Item-->
                                    <li class="breadcrumb-item">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr071.svg-->
                                        <span class="svg-icon svg-icon-4 svg-icon-white-700 mx-n1"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </li>
                                    <!--end::Item-->


                                    <!--begin::Item-->
                                    <a href='https://vtubiz.com' class="breadcrumb-item text-white  lh-1">
                                        vtubiz.com</a>
                                    <li class="breadcrumb-item">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr071.svg-->
                                        <span class="svg-icon svg-icon-4 svg-icon-white-700 mx-n1"><svg width="24"
                                                height="24" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </li>
                                    <a class="breadcrumb-item text-white  lh-1">
                                        {{$user->name}}</a>



                                </ul>
                                <!--end::Breadcrumb-->

                            </div>
                            <!--end::Toolbar wrapper--->

                            <!--begin::Toolbar wrapper--->
                            <div class="d-flex flex-stack flex-wrap flex-lg-nowrap gap-4 gap-lg-10 pt-13 pb-6">

                                <!--begin::Page title-->
                                <div class="page-title me-5">
                                    <!--begin::Title-->

                                    <h1 style=" 'Lato', sans-serif;"
                                        class="page-heading d-flex text-white fw-bold fs-2 flex-column justify-content-center my-0 mb-2">
                                        @if($user->created_at->isToday())
                                        Thanks for joining us, {{ $user->name }}.<br>
                                        @else
                                        Welcome back, {{ $user->name }}.
                                        @endif
                                        <!--begin::Description-->
                                        <div class="card-title d-flex flex-column mt-4">
                                            <!--begin::Info-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Currency-->
                                                <span style='color:#ddd !important'
                                                    class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">₦</span>
                                                <!--end::Currency-->

                                                <!--begin::Amount-->

                                                <span style='color:#ddd; font-weight:700 !important'
                                                    class="fs-2hx er me-2 lh-1 ls-n2">{{ number_format($user->balance,2)
                                                    }}</span>
                                                <!--end::Amount-->

                                                <!--begin::Badge-->
                                                <a href='/my-referral' class="badge badge-light-dark fs-base">
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect id="bound" x="0" y="0" width="24" height="24" />
                                                            <rect id="Rectangle-2" fill="#000000" opacity="0.3" x="2" y="4" width="20" height="5" rx="1" />
                                                            <path d="M5,7 L8,7 L8,21 L7,21 C5.8954305,21 5,20.1045695 5,19 L5,7 Z M19,7 L19,19 C19,20.1045695 18.1045695,21 17,21 L11,21 L11,7 L19,7 Z" id="Combined-Shape" fill="#000000" />
                                                        </g>
                                                    </svg>
                                                    Referral Earnings:
                                                    <!--end::Svg Icon-->
                                                    ₦{{ number_format($earnings ?? 0) }}
                                                </a>

                                                <!--end::Badge-->
                                            </div>

                                            <div class='d-flex'>
                                                <a class='btn btn-dark btn-sm' style='margin-right:8px'
                                                    href='/fundwallet'>Fund Wallet</a>

                                            </div>
                                            <!--end::Info-->

                                            <!--begin::Subtitle-->

                                            <!-- <div class="container my-1">
                                                <div class="progress-container">
                                                    <div class="progress-step @if($user->total_spent < 10000) active @endif">
                                                        <div class="progress-circle">1</div>
                                                        <div class="progress-step-title">Starter</div>
                                                        <div class="progress-line"></div>
                                                    </div>
                                                    <div class="progress-step @if($user->total_spent >= 10000 && $user->total_spent < 50000) active @endif">
                                                        <div class="progress-circle">2</div>
                                                        <div class="progress-step-title">Enthusiast</div>
                                                        <div class="progress-line"></div>
                                                    </div>
                                                    <div class="progress-step @if($user->total_spent >= 50000 && $user->total_spent < 200000) active @endif">
                                                        <div class="progress-circle">3</div>
                                                        <div class="progress-step-title">Loyal</div>
                                                        <div class="progress-line"></div>
                                                    </div>
                                                    <div class="progress-step @if($user->total_spent >= 200000 && $user->total_spent < 500000) active @endif">
                                                        <div class="progress-circle">4</div>
                                                        <div class="progress-step-title">Pro</div>
                                                        <div class="progress-line"></div>
                                                    </div>
                                                    <div class="progress-step @if($user->total_spent >= 500000 && $user->total_spent < 1000000) active @endif">
                                                        <div class="progress-circle">5</div>
                                                        <div class="progress-step-title">Elite</div>
                                                    </div>
            
                                                    <div class="progress-step @if($user->total_spent >= 1000000) active @endif">
                                                        <div class="progress-circle">6</div>
                                                        <div class="progress-step-title">Legend</div>
                                                    </div>
                                                </div>
                                                @if($user->total_spent < 10000)
                                                    <p class="message">Perform a transaction worth ₦{{ number_format(10000 - $user->total_spent) }} to reach the next level!
                                                    <a href='/benefits' style='color:#28a745;'>Click here</a> to view benefits of each level.
                                                    </p>
                                                    @elseif($user->total_spent >= 10000 && $user->total_spent < 50000)
                                                        <p class="message">Perform a transaction worth ₦{{ number_format(50000 - $user->total_spent) }} to reach the next level!
                                                        <a href='/benefits' style='color:#28a745;'>Click here</a> to view benefits of each level.
                                                        </p>
                                                        @elseif($user->total_spent >= 50000 && $user->total_spent < 200000)
                                                            <p class="message">Perform a transaction worth ₦{{ number_format(200000 - $user->total_spent) }} to reach the next level!
                                                            <a href='/benefits' style='color:#28a745;'>Click here</a> to view benefits of each level.
                                                            </p>
                                                            @elseif($user->total_spent >= 200000 && $user->total_spent < 500000)
                                                                <p class="message">Perform a transaction worth ₦{{ number_format(500000 - $user->total_spent) }} to reach the next level!
                                                                <a href='/benefits' style='color:#28a745;'>Click here</a> to view benefits of each level.
                                                                </p>
                                                                @elseif($user->total_spent >= 500000 && $user->total_spent < 1000000)
                                                                    <p class="message">Perform a transaction worth ₦{{ number_format(1000000 - $user->total_spent) }} to reach the next level!
                                                                    <a href='/benefits' style='color:#28a745;'>Click here</a> to view benefits of each level.
                                                                    </p>
                                                                    @else
                                                                    <p class="message">Congratulations! You have reached the Legend level.
                                                                        <a href='/benefits' style='color:#28a745;'>Click here</a> to view benefits of your level.
                                                                    </p>
                                                                    @endif
                                            </div> -->
<p class="message">Join our Whatsapp community for freebies, discounts and product availability updates. <a href='https://chat.whatsapp.com/CpR9IBMUE5xFyJJwhK2KzD'>Click here</a> to join.</p>
                                            <!--end::Subtitle-->
                                        </div>




                                        <!--end::Description-->
                                    </h1>

                                </div>
                                <!--end::Page title-->
                                <!--begin::Stats-->




                                <!--end::Stats-->
                            </div>
                            <!--end::Toolbar wrapper--->
                        </div>
                        <!--end::Toolbar container--->
                    </div>
                    <!--end::Toolbar container-->
                </div>
                <!--end::Toolbar-->


                <!--begin::Wrapper container-->
                <div style='background:url({{ asset('/assets/img/wbg1.jpg') }});background-size:cover;' class="app-container  container-xxl ">

                    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">

                        <!--begin::Main-->
                        @yield('content')
                        <!--end:::Main-->
                        <a href="https://wa.me/2349058744473"><img src="{{asset('assets/media/logos/whatsapp.png')}}"
                                alt='whatsapp' id="fixedbutton"></a>

                    </div>
                    <div id="kt_app_footer"
                        class="app-footer  d-flex flex-column flex-md-row align-items-center flex-center flex-md-stack py-2 py-lg-4 ">
                        <!--begin::Copyright-->
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted fw-semibold me-1">
                                <?php echo Date('Y'); ?> &copy;
                            </span>
                            <a target="_blank" class="text-gray-800 text-hover-primary">
                                @if($user->user_type == 'customer')
                                VTUBIZ
                                @else
                                {{ $company->brand_name ?? "VTUBIZ" }}
                                @endif
                            </a>
                        </div>
                        <!--end::Copyright-->

                        <!--begin::Menu-->
                        <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                            <li class="menu-item"><a href="https://keenthemes.com/" target="_blank"
                                    class="menu-link px-2">About</a>
                            </li>

                            <li class="menu-item"><a href="https://devs.keenthemes.com/" target="_blank"
                                    class="menu-link px-2">Support</a></li>

                            <li class="menu-item"><a
                                    href="https://wa.me/2349058744473?text='Hi,%20I%20will%20like%20to%20invest%20in%20CT_Taste"
                                    target="_blank" class="menu-link px-2">Invest</a></li>
                        </ul>
                        <!--end::Menu-->
                    </div>


                </div>
                <!--end::Wrapper container-->
            </div>
            <!--end::Wrapper-->


        </div>
        <!--end::Page-->
    </div>
    <!--end::App-->




    <!--end::Modal - Sitemap-->
    <!--end::Engage modals-->
    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
        <span class="svg-icon"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
                    fill="currentColor" />
                <path
                    d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                    fill="currentColor" />
            </svg>
        </span>
        <!--end::Svg Icon-->
    </div>


    <script src="{{ mix('js/app.js') }}"></script>
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
    <!-- <script src="{{ url('js/app.js') }}"></script> -->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js')}}"></script>
    <!--end::Global Javascript Bundle-->

    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <!--end::Vendors Javascript-->

    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{ asset('assets/js/widgets.bundle.js')}}"></script>
    <script src="{{ asset('assets/js/custom/widgets.js')}}"></script>
    <script src="{{ asset('assets/js/custom/apps/chat/chat.js')}}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/new-target.js')}}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/create-app.js')}}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/users-search.js')}}"></script>
    <!--end::Custom Javascript-->
    {{-- <script src='/assets/js/professionallocker.js'></script> --}}
    <!--end::Javascript-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.4/datatables.min.css" />

    {{--
    <link rel='stylesheet' href='https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css' /> --}}
    <script>
        // var oTable = $('.datatable').DataTable();   //using Capital D, which is mandatory to retrieve "api" datatables' object, latest jquery Datatable
        //    $('#myInput').keyup(function(){
        //          oTable.search($(this).val()).draw() ;
        //    });
        @if(session('message'))
        Swal.fire('Success!', "{{ session('message') }}", 'success');
        @endif
        @if(isset($notification))


        Swal.fire({
            title: '',
            html: `
        <img src="{{ asset('assets/img/not.jpg') }}" style="width: 70%; max-height: 100px; object-fit: cover; border-radius: 10px;">
        <h2 style="font-weight: bold; text-align: center; margin-top: 10px;">{{ $notification->title }}</h2>
        <p style="text-align: center;font-size: 14px; color: #888;">{!!   $notification->description !!}</p>
      `,
            showCloseButton: true,
            showConfirmButton: false,
            customClass: {
                popup: 'custom-sweetalert',
                content: 'custom-sweetalert-content',
                closeButton: 'custom-sweetalert-close'
            }
        });

        // Swal.fire(
        //         '{{ $notification->title }}',
        //         '{{ $notification->description }}',
        //         'info'
        // )
        @endif

        @if(isset($dod))

        Swal.fire({
            title: '',
            html: `
        <img src="{{ asset('assets/img/discount.jpg') }}" style="width: 100%; max-height: 200px; object-fit: cover; border-radius: 10px;">
        <h2 style="font-weight: bold; text-align: center; margin-top: 10px;">{{ $dod->title }}</h2>
        <p style="text-align: center;font-size: 24px; color: #888;"><b>{!!   $dod->description !!}</b></p>
      `,
            showCloseButton: true,
            showConfirmButton: false,
            customClass: {
                popup: 'custom-sweetalert',
                content: 'custom-sweetalert-content',
                closeButton: 'custom-sweetalert-close'
            }
        });


        @endif

        @if(session('message'))
        Swal.fire({
            icon: 'success',
            title: '{{ session("message") }}'
        })

        @endif

        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: '{{ session("success") }}'
        })

        @endif

        @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: '{{ session("error") }}'
        })

        @endif
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    @yield('script')

</body>
<!--end::Body-->

<!-- Mirrored from preview.keenthemes.com/metronic8/demo34/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 Feb 2023 08:02:15 GMT -->

</html>