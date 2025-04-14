<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <title>VTUBIZ | Reset Password</title>
    <meta charset="utf-8" />
    <meta name="description" content="Home of affordable data plans and instant digital services." />
    <meta name="keywords" content="VTUBIZ" />
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
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet"> --}}
    <link href="assets/googlefonts/ubuntu.css" rel="stylesheet">


    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->

    <!--Begin::Google Tag Manager -->

    <!--End::Google Tag Manager -->
</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
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

    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Page bg image-->
        <style>
            body {
                background-image: url('/assets/media/auth/bg4.jpg');
            }

            [data-bs-theme="dark"] body {
                background-image: url('/assets/media/auth/bg4-dark.jpg');
            }
        </style>
        <!--end::Page bg image-->

        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-column-fluid flex-lg-row">
            <!--begin::Aside-->
            <div class="d-flex flex-center w-lg-50 pt-15 pt-lg-0 px-10">
                <!--begin::Aside-->
                <div class="d-flex flex-center flex-lg-start flex-column">
                    <!--begin::Logo-->
                    <a href="/" class="mb-7">
                        <img src="{{ asset('assets/img/logo/vtulogo.png') }}" srcset="{{ asset('assets/img/logo/vtulogo.png') }}"
                            width='140px' height='35px' alt="">

                        {{-- <img alt="Logo" src="/assets/media/logos/ct_white.png" style='width:150px;height:40px' /> --}}
                    </a>
                    <!--end::Logo-->

                    <!--begin::Title-->
                    <h2 class="text-white fw-normal m-0">
                        Reset Your Password
                    </h2>
                    <!--end::Title-->
                </div>
                <!--begin::Aside-->
            </div>
            <!--begin::Aside-->

            <!--begin::Body-->
            <div class="d-flex flex-center w-lg-50 p-10">
                <!--begin::Card-->
                <div class="card rounded-3 w-md-550px">
                    <!--begin::Card body-->
                    <div class="card-body d-flex flex-column p-10 p-lg-20 pb-lg-10">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-center flex-column-fluid pb-15 pb-lg-20">

                            <!--begin::Form-->
                            <div id='app'>
                                <div>
                                    <form class="form w-100" action='{{ route("password.email") }}' method='post'>
                                        @csrf
                                        <div class="text-center mb-10">
                                            <h1 class="text-dark mb-3 fs-3">Forgot Password</h1>
                                            <div class="text-dark fw-semibold fs-6">
                                                Enter your email to reset your password.
                                            </div>
                                        </div>

                                        @if(session('status'))
                                        <div class="alert alert-success d-flex align-items-center p-5 mb-10">
                                            <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span class="path2"></span></i>
                                            <div class="d-flex flex-column">
                                                <h4 class="mb-1 text-success">Success</h4>
                                                <span>{{ session('status') }}</span>
                                            </div>
                                        </div>
                                        @endif

                                        @if($errors->any())
                                        <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                                            <i class="ki-duotone ki-shield-cross fs-2hx text-danger me-4"><span class="path1"></span><span class="path2"></span></i>
                                            <div class="d-flex flex-column">
                                                <h4 class="mb-1 text-danger">Error</h4>
                                                <span>{{ $errors->first() }}</span>
                                            </div>
                                        </div>
                                        @endif

                                        <div class="fv-row mb-10">
                                            <!-- <label class="form-label fw-bolder text-gray-900 fs-6">Email</label> -->
                                            <input type="email" class="form-control form-control-solid"
                                                name="email"
                                                id="email"
                                                autocomplete="off"
                                                placeholder="Enter your email address"
                                                required />
                                        </div>

                                        <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                                            <button type="submit" class="btn btn-primary me-4">
                                                <span class="indicator-label">Submit</span>
                                            </button>
                                            <a href="{{ route('login') }}" class="btn btn-light">Cancel</a>
                                        </div>
                                    </form>

                                </div>
                                {{-- <login-component></login-component> --}}
                            </div>
                            <!--end::Form-->

                        </div>
                        <!--end::Wrapper-->


                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Root-->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{asset('cdn/sweetalert.min.js')}}" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('cdn/jquery-3.6.0.js')}}" crossorigin="anonymous"></script>
    {{-- <script src="{{ asset('assets/js/professionallocker.js')}}"></script> --}}


</body>
<!--end::Body-->

<!-- Mirrored from preview.keenthemes.com/metronic8/demo34/authentication/layouts/creative/sign-in.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 Feb 2023 08:11:23 GMT -->

</html>