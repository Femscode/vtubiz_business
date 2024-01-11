<!DOCTYPE html>

<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <title>VTUBIZ | {{ $giveaway->name }}</title>
    <meta charset="utf-8" />
    <meta name="description" content="Let's Bite Back!" />
    <meta name="keywords" content="Let's Bite Back!" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="https://vtubiz.com" />
    <link rel="canonical" href="https://vtubiz.com/" />
    <link rel="shortcut icon" href="https://cttaste.com/assets/images/fav_01.png" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style2.bundle.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <!--Begin::Google Tag Manager -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Grandstander:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap">

    <link href="assets/googlefonts/ubuntu.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />

    <style>
        body,
        html {
            height: 100%;
        }

        body {
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            background-image: radial-gradient(circle, #ffffff, #aaaaaa);
        }

        canvas {
            position: fixed;
            top: 0;
            bottom: 0;
            z-index: 1;
        }

        h1 {
            font-size: 30px;
            text-align: center;
            width: 60%;
            margin: 0 auto;
            padding-top: 10%;
            font-family: 'Grandstander', cursive;
        }

        h2 {
            font-size: 20px;
            text-align: center;
            width: 60%;
            margin: 0 auto;
            padding-top: 10%;
            color: #ebab21;
            font-family: 'Grandstander', cursive;
        }
        td {
            font-size: 15px !important;

        }


        p {
            font-size: 20px;
            text-align: center;
            width: 50%;
            margin: 1em auto 0;
            color: red;
            font-family: 'Grandstander', cursive;
        }


        .collection {
            position: fixed;
            z-index: 1000;
            width: auto;
            bottom: 0;
            right: 0;
            margin: 15px;
            padding: 0;
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
        }

        .collection a {
            display: inline-block;
            background: #fff;
            opacity: 0.4;
            transition: opacity 0.7s;
            margin-left: 5px;
            padding: 5px;
            text-decoration: none;
            text-transform: uppercase;
            font-weight: bold;
            color: #000;
        }
     
 
        .collection a:hover {
            opacity: 1;
        }

        .splash-container {
            display: inline-block;
            position: relative;
        }

        .splash-container::before {
            content: 'Win';
            display: block;
            background: linear-gradient(135deg, #ff6600, #ffcc00);
            color: white;
            padding: 5px 10px;
            border-radius: 10px;
            font-weight: bold;
            position: absolute;
            top: -10px;
            left: -10px;
            z-index: -1;
        }
     

        .confetti-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            /* Prevent interaction with confetti */
            z-index: 9999;
            /* Place confetti above everything */

        }

        .confetti {
            width: 10px;
            height: 10px;
            position: absolute;
            background: #98FB98;
            animation: confetti-fall 3s ease-out infinite;
        }

        @keyframes confetti-fall {
            0% {
                transform: translateY(0);
                opacity: 1;
            }

            35% {

                background: red;
                opacity: 0.7;
            }

            70% {

                background: #ebab21;
                opacity: 0.35;
            }

            100% {
                transform: translateY(100vh);
                opacity: 0;
            }
        }
    </style>
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&amp;l=' + l : '';
            j.async = true;
            j.src = '../../../../../../www.googletagmanager.com/gtm5445.html?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5FS8GGP');
    </script>
    <!--End::Google Tag Manager -->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" style='background:#191970' class="header-tablet-and-mobile-fixed">


    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->

        <div class="page d-flex flex-row flex-column-fluid">
            <div style='padding-left:0px !important' class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">

                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <!--begin::Container-->
                    <img src='https://preview.keenthemes.com/metronic8/demo1/assets/media/illustrations/unitedpalms-1/5.png'
                        class="mx-auto h-150px h-lg-250px  theme-light-show" />
                    {{-- <img
                        src='https://preview.keenthemes.com/metronic8/demo1/assets/media/illustrations/unitedpalms-1/20.png' />
                    --}}
                    <h1 class='text-white text-center'>{{ $giveaway->name }}</h1>
                    <div style='padding-top:10px' class="container-xxl" id="kt_content_container">
                        <!--begin::Form-->
                        <!-- <form id="kt_ecommerce_edit_order_form" class="form d-flex flex-column flex-lg-row" data-kt-redirect="listing.html"> -->

                        <!--begin::Aside column-->
                        <div class="col-md-12 flex-lg-row-auto mt-12 p-4">
                            <!--begin::Order details-->
                            <div class="card card-flush py-4 bg-dark text-white">
                                <!--begin::Card header-->
                                <div class="card-header" style='display:block'>
                                    <div class="card-title">
                                        <h2 class='text-white'>Giveaway by {{ $giveaway->user->name }}</h2>
                                    </div>
                                  
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="d-flex flex-column gap-10">
                                        <!--begin::Input group-->
                                        <div class="fv-row text-center">
                                            <!--begin::Label-->
                                            <!--end::Label-->
                                            @if($rand_no == 'xxx')
                                            <div class="fw-bolder fs-3 text-center" ><span style="font-size:30px;font-family: 'Courier New', Courier, monospace;" id='counter2'>
                                                Give away ended, you came late.😢</span></div>

                                            @else 
                                            <div class="fw-bolder fs-3 text-center" ><span style="font-size:30px;font-family: 'Courier New', Courier, monospace;" id='counter2'>
                                            {{ $rand_no }}</span></div>
                                            <input id='rand_no' value='{{ $rand_no }}' type='hidden'/>
                                            @endif
                                            <label class="form-label" style='color:#ebab21'>Your Lucky Number</label>

                                           <br>
                                           @if($won == 1)
                                            <div class="badge badge-light-dark p-4">Congratulations, You Won.<br> Today is indeed your lucky day!</div><br>
                                            <a href='/claim_giveaway/{{ $giveaway->id }}/{{ $participant->user_id }}/{{ $rand_no }}' class='btn btn-success'>Click Here To Claim Your Giveaway Price</a>
                                            @else 
                                            <div class="badge badge-light-dark p-4">Opps, You didn't win the giveaway, so sorry about that!</div><br>
                                            <label class="form-label" style='color:#ebab21'>Giveaway Status</label><br>
                                            <p>Do you know that you can as well create your own giveaway?</p>
                                            <p>Click <a href='https://vtubiz.com/register'>here</a> to register and create yours.</p>
                                            @endif
                                          
                                            <!--end::Input-->
                                           

                                        </div>

                                    </div>
                                </div>
                                <!--end::Card header-->
                            </div>
                            <!--end::Order details-->
                        </div>
                        <!--end::Aside column-->
                        <!--begin::Main column-->
                        <div class='row'>
                            <div class='col-md-12'>
                                <div class="d-flex flex-column flex-lg-row-fluid p-8 ">

                                    <div class="card card-flush py-4 bg-dark">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2 class='text-white'>Winners So Far ({{ count($lucky_winners) }} out of {{ $giveaway->no_of_winners }})</h2>
                                            </div>

                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="d-flex flex-column gap-10">
                                                <!--begin::Input group-->

                                                <!--end::Input group-->
                                                <!--begin::Separator-->
                                                <div class="separator"></div>
                                                <table class="table table-dark table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" class='p-4'>#</th>
                                                            <th scope="col" class='p-4'>Winner Name</th>
                                                            <th scope="col" class='p-4'>Lucky Number</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($lucky_winners as $key => $winner)
                                                        <tr>
                                                            <td scope="col" class='p-4'>{{ ++$key }}</td>
                                                            <td scope="col" class='p-4'>{{ $winner->name }}</td>
                                                            <td scope="col" class='p-4'>{{ $winner->lucky_number }}</td>
                                                           
                                                        </tr>
                                                        @endforeach


                                                    </tbody>
                                                </table>

                                                <!--end::Table-->
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                    </div>


                                </div>
                            </div>
                         
                        </div>

                        <!--end::Form-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Content-->
                <!--begin::Footer-->
                <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                    <!--begin::Container-->
                    <div class="container-xxl d-flex flex-column flex-md-row flex-stack">
                        <!--begin::Copyright-->
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-gray-400 fw-bold me-1">Powered By </span>
                            <a href="https://vtubiz.com/" target="_blank"
                                class="text-muted text-hover-primary fw-bold me-2 fs-6">VTUBIZ</a>
                        </div>
                        <!--end::Copyright-->
                        <!--begin::Menu-->
                        <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
                            <li class="menu-item">
                                <a href="https://cthostel.com/" target="_blank" class="menu-link px-2">CTHostel</a>
                            </li>
                            <li class="menu-item">
                                <a href="https://vtubiz.com" target="_blank" class="menu-link px-2">VTUBIZ</a>
                            </li>
                            <li class="menu-item">
                                <a href="https://cttaste.com" target="_blank" class="menu-link px-2">CTTaste</a>
                            </li>
                        </ul>
                        <!--end::Menu-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->
    <!--begin::Drawers-->
    <!--begin::Activities drawer-->


    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
        <span class="svg-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
                    fill="black" />
                <path
                    d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                    fill="black" />
            </svg>
        </span>
        <!--end::Svg Icon-->
    </div>
  
    <script>
        var hostUrl = "assets/index.html";
    </script>
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js')}}"></script>
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
    <script src="{{ asset('assets/js/widgets.bundle.js')}}"></script>
    <script src="{{ asset('assets/js/custom/widgets.js')}}"></script>
    <script src="{{ asset('assets/js/custom/apps/chat/chat.js')}}"></script>
    <script src="{{ asset('assets/js/custom/intro.js')}}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/users-search.js')}}"></script>
    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
    <script src="{{asset('admin/cdn/sweetalert.min.js')}}" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
    <script src="{{asset('admin/cdn/jquery-3.6.0.js')}}" crossorigin="anonymous"></script>


    <script>
       
        $(document).ready(function() {
            Swal.fire({
       
        html:
          '<p class="animate__animated animate__bounce animate__delay-1s" style="color:black">You are now a participant, click OK to see if you win.</p><br><b></b>',
        width: 600,
        padding: '3em',
        color: '#716add',
        background: '#fff ', // Set a solid background color
        showClass: {
          popup: 'animate__animated animate__jackInTheBox'
        },
        hideClass: {
          popup: 'animate__animated animate__flipOutY'
        },
        backdrop: `
                        rgba(0,0,123,0.4)
                        url("/assets/images/ballon.png")
                        left top
                        repeat

                      `,
        didOpen: () => {
          // Create and append confetti elements
          const confettiContainer = document.createElement('div');
          confettiContainer.classList.add('confetti-container');
          document.body.appendChild(confettiContainer);

          for (let i = 0; i < 50; i++) {
            const confetti = document.createElement('div');
            confetti.classList.add('confetti');
            confetti.style.left = Math.random() * 100 + 'vw';
            confetti.style.animationDuration = Math.random() * 2 + 1 + 's';
            confettiContainer.appendChild(confetti);
          }
        },
        willClose: () => {
          // Remove confetti elements when the SweetAlert is closed
          const confettiContainer = document.querySelector('.confetti-container');
          if (confettiContainer) {
            confettiContainer.remove();
          }
          startCounter()
        }
      });
        function startCounter() {     
       
        var counterElement2 = document.getElementById('counter2');
       
        count_num2 = $("#rand_no").val()
      

        var count = 0;
        var totalTime = 100; // 10 seconds in milliseconds
         var delay2 = Math.floor(totalTime / count_num2); // Adjust delay based on total time and count number
        var startTime = performance.now();
        function updateCounter2() {
            var currentTime = performance.now();
            var elapsed = currentTime - startTime;
            var progress = Math.min(1, elapsed / totalTime);
            count = Math.floor(progress * count_num2);            

            counterElement2.innerText = count;
            if (progress < 1) {
                requestAnimationFrame(updateCounter2);
            }
           
        }

    
       
        updateCounter2();
    }
  

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
          // Function to create confetti elements
function createConfetti() {
  const confettiContainer = document.createElement('div');
  confettiContainer.classList.add('confetti-container');
  document.body.appendChild(confettiContainer);

  for (let i = 0; i < 50; i++) {
    const confetti = document.createElement('div');
    confetti.classList.add('confetti');
    confetti.style.left = Math.random() * 100 + 'vw';
    confetti.style.animationDuration = Math.random() * 2 + 1 + 's';
    confettiContainer.appendChild(confetti);
  }

  // Optionally return the container element if you need to manipulate it later
  return confettiContainer;
}

// Function to remove confetti elements
function removeConfetti(confettiContainer) {
  if (confettiContainer) {
    confettiContainer.remove();
  }
}

const confettiContainer = createConfetti();


          })
    </script>
</body>

</html>