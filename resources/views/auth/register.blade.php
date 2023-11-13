<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <title>VTUBIZ | Registration</title>
    <meta charset="utf-8" />
    <meta name="description" content="Payment Portal For CT_Taste" />
    <meta name="keywords" content="Quick pay with CT_Taste" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="CT_Taste" />
    <meta property="og:url" content="https://cttaste.com" />
    <meta property="og:site_name" content="CT_Taste" />
    <link rel="shortcut icon" href="assets/media/logos/fav_01.png" />

    @laravelPWA
    <!--begin::Fonts(mandatory for all pages)-->

    <link rel="stylesheet" href="assets/googlefonts/inter.css" />
    <!--end::Fonts-->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    {{-- <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet"> --}}
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

	if ( document.documentElement ) {
		if ( document.documentElement.hasAttribute("data-bs-theme-mode")) {
			themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
		} else {
			if ( localStorage.getItem("data-bs-theme") !== null ) {
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
                        <img src="{{ asset('assets/img/logo/vtulogo.png') }}" srcset="{{ asset('assets/img/logo/vtulogo.png') }}" width='140px' height='35px' alt="">
          
                    </a>
                    <!--end::Logo-->

                    <!--begin::Title-->
                    <h2 class="text-white fw-normal m-0">
                        Register A VTUBIZ Account
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
                                    <!--begin::Heading-->
                                    <form method='post' action='{{ route("register") }}'>@csrf
                                      <div class="text-center mb-11">
                                        <!--begin::Title-->
                                        <!-- <img class="mx-auto h-100px h-lg-150px  theme-light-show" src="https://preview.keenthemes.com/metronic8/demo1/assets/media/illustrations/sigma-1/3.png" alt=""> -->
                                        <h1 class="text-dark fw-bolder mb-3">Sign Up</h1>
                                        @if($errors->any())
                                        <div class="alert alert-danger">
                                          <p><strong>Opps Something went wrong</strong></p>
                                          <ul>
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                          </ul>
                                        </div>
                                        @endif
                                      </div>
                                      <!--begin::Heading-->
                                
                                      <!--begin::Input group--->
                                      <div class="fv-row mb-3">
                                        <!--begin::Email-->
                                        <input
                                          autocomplete=""
                                          id="user_name"
                                          placeholder="Full name"
                                          type="text"
                                          class="form-control"
                                          required
                                          name="name"
                                        />
                                
                                        <!--end::Email-->
                                      </div>
                                      <div class="fv-row mb-3">
                                        <!--begin::Email-->
                                        <input
                                          autocomplete=""
                                          id="company_id"
                                          type="text"
                                         
                                          class="form-control"
                                          required
                                          placeholder="Brandname/Username"
                                          name="brand_name"
                                        />
                                
                                        <!--end::Email-->
                                      </div>
                                      <div class="fv-row mb-3">
                                        <!--begin::Email-->
                                        <input
                                          autocomplete=""
                                          id="user_phone"
                                          placeholder="Phone number"
                                          type="number"
                                          class="form-control"
                                          required
                                          name="phone"
                                        />
                                
                                        <!--end::Email-->
                                      </div>
                                      <div class="fv-row mb-3">
                                        <!--begin::Email-->
                                        <input
                                          type="email"
                                          id="email"
                                          placeholder="Email address"
                                          class="form-control bg-transparent"
                                          name='email'
                                          required
                                        />
                                
                                        <!--end::Email-->
                                      </div>
                                
                                      <!--end::Input group--->
                                      <div class="fv-row mb-3">
                                        <!--begin::Password-->
                                        <input
                                          type="password"
                                          id="password"
                                          placeholder="Password"
                                          autocomplete=""
                                         name='password'
                                          class="form-control bg-transparent"
                                          required
                                        />
                                        <!--end::Password-->
                                      </div>
                                
                                      <div class="fv-row mb-3">
                                        <!--begin::Password-->
                                        <input
                                          id="password_confirmation"
                                          type="password"
                                          class="form-control"
                                          name="password_confirmation"
                                          required
                                          autocomplete=""
                                          @input="confirmPassword"
                                          placeholder="Confirm password"
                                        />
                                        <!--end::Password-->
                                      </div>
                                      <div style='display:none' id='match_alert' class="alert alert-success">
                                        Password matched
                                      </div>
                                      <!--end::Input group--->
                                
                                      <!--begin::Wrapper-->
                                
                                      <!--begin::Submit button-->
                                      <div class="d-grid mb-10">
                                        <button
                                          disabled
                                          id='sign_up'
                                          type="submit"
                                          class="btn btn-primary"
                                        >
                                          Sign Up
                                        </button>
                                      </div>
                                      <!--end::Submit button-->
                                
                                      <!--begin::Sign up-->
                                    </form>
                                    <div class="text-gray-500 text-center fw-semibold fs-6">
                                      Already registered?
                                
                                      <a href="/login" class="link-success"> Sign In </a>
                                    </div>
                                  </div>
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
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="{{asset('cdn/sweetalert.min.js')}}" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('cdn/jquery-3.6.0.js')}}" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            
          $("#password, #password_confirmation").on("input", function () {
            var password = $("#password").val();
            var passwordConfirmation = $("#password_confirmation").val();
      
            if (password === passwordConfirmation && password.length >= 5) {
                $("#match_alert").show()
                $("#sign_up").prop("disabled", false);
                console.log('matched')
          
            } else {
                $("#match_alert").hide()
                $("#sign_up").prop("disabled", true);
                console.log('Unmathed')
          
            }
          });
      
         
        });
        </script>

</body>
</html>