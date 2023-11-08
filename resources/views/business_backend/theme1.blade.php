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
            <img class="rounded-circle header-profile-user"
            src="{{ asset('brand_images/'.$user->logo) }}" style='width:50px;height:50px' />
               </a><a class="navbar-toggle order-4 popup-inline"
                href="#navbar-mobile-style-1"><span></span><span></span><span></span></a>
            <ul class="nav navbar-nav order-2 ms-auto nav-no-opacity">
                <li class="nav-item "><a class="nav-link" href="#"><span>Home</span></a></li>
                <li class="nav-item "><a class="nav-link" href="#about_us"><span>About Us</span></a></li>
                <li class="nav-item "><a class="nav-link" href="#services"><span>Services</span></a></li>
                <li class="nav-item "><a class="nav-link" href="#data_prices"><span>Data Prices</span></a></li>
                <li class="nav-item "><a class="nav-link" href="https://wa.me/234{{ substr($user->phone,1) }}"><span>Contact Us</span></a></li>
              
                  
             
            </ul><!-- Button-->
            <a
                class="btn d-none d-sm-inline-flex btn btn-sm btn-accent-1 ms-auto ms-lg-60 me-30 me-lg-0 order-2 order-lg-3"
                href="/register" target="_self">Create Account</a>
        </div>
    </nav><!-- Navbar mobile-->
    <div class="navbar navbar-mobile navbar-mobile-style-1 bg-white mfp-hide" id="navbar-mobile-style-1">
        <div class="navbar-wrapper">
            <div class="navbar-head"><a class="navbar-brand d-block d-md-none" href="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="124" height="30" fill="none" class="dark">
                        <path fill="#fff"
                            d="M41.155 11.638c-.057-.573-.3-1.018-.732-1.335-.43-.318-1.015-.476-1.754-.476-.502 0-.926.07-1.271.213-.346.137-.611.329-.796.575-.18.246-.27.526-.27.838-.01.26.045.488.164.682.123.194.29.362.504.504.213.138.46.258.739.362.279.1.577.185.895.256l1.306.313a9.21 9.21 0 0 1 1.748.568c.53.236.99.528 1.377.873.389.346.69.753.902 1.222.218.469.33 1.006.334 1.612-.005.89-.232 1.662-.682 2.316-.445.648-1.089 1.152-1.931 1.512-.839.355-1.85.533-3.033.533-1.174 0-2.197-.18-3.068-.54-.867-.36-1.544-.892-2.032-1.598-.483-.71-.736-1.588-.76-2.635h2.976c.033.488.173.895.42 1.222a2.33 2.33 0 0 0 1 .731c.422.161.898.242 1.428.242.521 0 .973-.076 1.357-.227.388-.152.689-.363.902-.633.213-.27.32-.58.32-.93 0-.327-.098-.601-.292-.824-.19-.222-.468-.412-.838-.568a8.524 8.524 0 0 0-1.342-.426l-1.584-.398c-1.226-.298-2.195-.764-2.905-1.399s-1.063-1.49-1.058-2.564c-.005-.88.23-1.65.703-2.308.478-.658 1.134-1.172 1.967-1.541.834-.37 1.78-.554 2.841-.554 1.08 0 2.022.184 2.827.554.81.369 1.44.883 1.89 1.54.45.659.681 1.421.695 2.288h-2.947Zm10.96-.547v2.273h-6.57V11.09h6.57Zm-5.078-2.614h3.026v10.17c0 .28.042.498.128.654a.704.704 0 0 0 .355.32c.156.061.336.092.54.092.142 0 .284-.012.426-.035.142-.029.25-.05.326-.064l.476 2.251a8.515 8.515 0 0 1-.639.163 5.126 5.126 0 0 1-1.001.121c-.73.029-1.369-.069-1.918-.291a2.677 2.677 0 0 1-1.271-1.037c-.303-.469-.452-1.06-.448-1.776V8.478Zm10.16 13.729c-.696 0-1.316-.12-1.86-.362a2.996 2.996 0 0 1-1.293-1.087c-.313-.483-.47-1.084-.47-1.804 0-.606.112-1.115.335-1.527.222-.412.525-.743.909-.994.383-.251.819-.44 1.307-.568a9.96 9.96 0 0 1 1.548-.27 39.213 39.213 0 0 0 1.534-.185c.388-.062.67-.151.845-.27.175-.118.263-.293.263-.525v-.043c0-.45-.142-.798-.426-1.044-.28-.246-.677-.37-1.193-.37-.545 0-.978.121-1.3.363a1.666 1.666 0 0 0-.64.895l-2.797-.227a3.802 3.802 0 0 1 .837-1.72c.417-.487.955-.861 1.613-1.121.663-.266 1.43-.398 2.3-.398.607 0 1.187.07 1.74.213a4.554 4.554 0 0 1 1.485.66 3.21 3.21 0 0 1 1.03 1.151c.251.464.377 1.02.377 1.669V22h-2.87v-1.513h-.085a3.08 3.08 0 0 1-.703.902 3.255 3.255 0 0 1-1.058.604c-.412.142-.888.213-1.428.213Zm.867-2.088c.445 0 .838-.088 1.178-.263.342-.18.609-.421.803-.724.194-.303.291-.647.291-1.03v-1.158a1.62 1.62 0 0 1-.39.17 7.096 7.096 0 0 1-.547.136 27.1 27.1 0 0 1-.611.106l-.554.078a3.746 3.746 0 0 0-.93.249 1.488 1.488 0 0 0-.618.462c-.147.189-.22.426-.22.71 0 .412.149.727.447.944.303.213.687.32 1.15.32ZM65.688 22V11.09h2.933v1.904h.114c.199-.677.532-1.188 1.001-1.534a2.632 2.632 0 0 1 1.62-.525 4.56 4.56 0 0 1 .951.106v2.685a3.95 3.95 0 0 0-.59-.114 5.304 5.304 0 0 0-.688-.05 2.42 2.42 0 0 0-1.193.292c-.346.19-.62.454-.824.795a2.297 2.297 0 0 0-.299 1.18V22h-3.025ZM80.22 11.09v2.274h-6.57V11.09h6.57Zm-5.078-2.613h3.025v10.17c0 .28.043.498.128.654a.704.704 0 0 0 .355.32c.157.061.337.092.54.092.142 0 .284-.012.426-.035.142-.029.251-.05.327-.064l.476 2.251a8.502 8.502 0 0 1-.64.163 5.124 5.124 0 0 1-1 .121c-.73.029-1.37-.069-1.918-.291a2.676 2.676 0 0 1-1.272-1.037c-.303-.469-.452-1.06-.447-1.776V8.478ZM82.483 22V7.455h3.025v5.468h.093c.132-.293.324-.592.575-.895.256-.307.587-.563.995-.767.411-.208.923-.312 1.533-.312a4.1 4.1 0 0 1 2.202.625c.673.412 1.21 1.034 1.612 1.868.403.828.604 1.868.604 3.118 0 1.216-.196 2.244-.59 3.082-.388.833-.918 1.466-1.59 1.896a4.084 4.084 0 0 1-2.245.64c-.587 0-1.086-.098-1.498-.292a3.101 3.101 0 0 1-1.002-.731 3.713 3.713 0 0 1-.596-.902h-.135V22h-2.983Zm2.962-5.454c0 .648.09 1.214.27 1.697.18.483.44.86.78 1.13.342.264.756.397 1.244.397.492 0 .909-.135 1.25-.405.34-.275.599-.653.774-1.136.18-.488.27-1.05.27-1.683 0-.63-.088-1.184-.263-1.662-.175-.479-.433-.853-.774-1.123s-.76-.404-1.257-.404c-.493 0-.91.13-1.25.39-.337.26-.595.63-.775 1.108-.18.478-.27 1.042-.27 1.69Zm14.625 5.667c-1.103 0-2.057-.234-2.862-.703a4.812 4.812 0 0 1-1.854-1.975c-.436-.847-.653-1.83-.653-2.947 0-1.127.217-2.112.653-2.955a4.756 4.756 0 0 1 1.854-1.974c.805-.473 1.759-.71 2.862-.71 1.103 0 2.055.237 2.855.71a4.743 4.743 0 0 1 1.861 1.974c.435.843.653 1.828.653 2.955 0 1.117-.218 2.1-.653 2.947a4.8 4.8 0 0 1-1.861 1.975c-.8.469-1.752.703-2.855.703Zm.014-2.344c.502 0 .921-.142 1.257-.426.336-.289.59-.682.76-1.179.175-.497.263-1.063.263-1.697 0-.635-.088-1.2-.263-1.698-.17-.497-.424-.89-.76-1.179-.336-.288-.755-.433-1.257-.433-.507 0-.933.145-1.278.433-.341.29-.6.682-.774 1.18-.17.497-.256 1.062-.256 1.697 0 .634.085 1.2.256 1.697.175.497.433.89.774 1.18.345.283.772.425 1.278.425Zm9.46-8.778 2.003 3.814 2.053-3.814h3.103l-3.16 5.455L116.789 22h-3.09l-2.152-3.771L109.431 22h-3.125l3.238-5.454-3.125-5.455h3.125Zm10.725 11.094c-.469 0-.871-.166-1.208-.497a1.66 1.66 0 0 1-.497-1.208c0-.464.166-.862.497-1.193a1.661 1.661 0 0 1 1.208-.497c.454 0 .852.166 1.193.497.341.331.511.73.511 1.193 0 .313-.08.6-.241.86a1.832 1.832 0 0 1-.618.617 1.627 1.627 0 0 1-.845.228Z" />
                        <path fill="#F01F4B"
                            d="M19 15a9 9 0 1 1-18 0l.252.099C6.919 17.317 12.439 11.576 10 6a9 9 0 0 1 9 9Z" />
                        <circle cx="4" cy="9" r="4" fill="#FFBB38" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="124" height="31" fill="none" class="light">
                        <path fill="#17161A"
                            d="M41.155 12.475h2.947c-.042-2.593-2.173-4.382-5.412-4.382-3.189 0-5.525 1.761-5.511 4.403-.007 2.145 1.506 3.374 3.963 3.963l1.584.398c1.584.383 2.464.838 2.471 1.818-.007 1.065-1.015 1.79-2.578 1.79-1.598 0-2.748-.739-2.848-2.195h-2.976c.079 3.146 2.33 4.773 5.86 4.773 3.551 0 5.639-1.698 5.646-4.36-.007-2.423-1.832-3.708-4.36-4.277l-1.308-.312c-1.264-.291-2.322-.76-2.3-1.804 0-.938.83-1.626 2.336-1.626 1.47 0 2.372.667 2.486 1.81Zm10.96-.547h-2.052V9.314h-3.026v2.614h-1.491V14.2h1.491v5.681c-.014 2.138 1.442 3.196 3.637 3.104a5.886 5.886 0 0 0 1.64-.284l-.476-2.251c-.149.028-.468.099-.752.099-.604 0-1.023-.227-1.023-1.065V14.2h2.052v-2.273Zm5.082 11.115c1.612 0 2.656-.703 3.189-1.719h.085v1.513h2.87v-7.358c0-2.6-2.202-3.693-4.631-3.693-2.614 0-4.333 1.25-4.752 3.238l2.799.228c.206-.725.852-1.257 1.939-1.257 1.03 0 1.619.518 1.619 1.413v.043c0 .703-.746.795-2.642.98-2.16.198-4.098.923-4.098 3.359 0 2.16 1.541 3.253 3.622 3.253Zm.867-2.088c-.93 0-1.598-.433-1.598-1.264 0-.853.703-1.272 1.768-1.42.66-.093 1.74-.25 2.102-.49v1.157c0 1.143-.944 2.017-2.272 2.017Zm7.624 1.882h3.025v-6.172c0-1.342.98-2.266 2.316-2.266.419 0 .994.071 1.278.164v-2.685a4.542 4.542 0 0 0-.951-.106c-1.222 0-2.224.71-2.621 2.06h-.114v-1.904h-2.933v10.909Zm14.533-10.91h-2.053V9.315h-3.025v2.614H73.65V14.2h1.492v5.681c-.014 2.138 1.442 3.196 3.636 3.104a5.885 5.885 0 0 0 1.64-.284l-.475-2.251c-.15.028-.469.099-.753.099-.604 0-1.023-.227-1.023-1.065V14.2h2.053v-2.273Zm2.262 10.91h2.983V21.09h.135c.419.909 1.335 1.925 3.096 1.925 2.486 0 4.425-1.968 4.425-5.618 0-3.75-2.024-5.611-4.418-5.611-1.825 0-2.698 1.086-3.103 1.974h-.093V8.291h-3.025v14.546Zm2.962-5.455c0-1.946.824-3.189 2.294-3.189 1.498 0 2.294 1.3 2.294 3.19 0 1.903-.81 3.224-2.294 3.224-1.456 0-2.294-1.279-2.294-3.225Zm14.625 5.668c3.31 0 5.369-2.266 5.369-5.625 0-3.38-2.059-5.64-5.369-5.64-3.31 0-5.37 2.26-5.37 5.64 0 3.36 2.06 5.625 5.37 5.625Zm.014-2.344c-1.527 0-2.308-1.399-2.308-3.302 0-1.904.781-3.31 2.308-3.31 1.499 0 2.28 1.406 2.28 3.31 0 1.903-.781 3.302-2.28 3.302Zm9.441-8.778H106.4l3.125 5.454-3.239 5.455h3.125l2.117-3.771 2.152 3.77h3.089l-3.246-5.454 3.161-5.454h-3.104l-2.052 3.814-2.003-3.814Zm10.724 11.094c.909 0 1.698-.76 1.705-1.705-.007-.93-.796-1.69-1.705-1.69-.937 0-1.711.76-1.704 1.69a1.7 1.7 0 0 0 1.704 1.705Z" />
                        <path fill="#F01F4B"
                            d="M19 15.837a9 9 0 1 1-18 0l.252.099c5.667 2.218 11.187-3.524 8.748-9.1a9 9 0 0 1 9 9Z" />
                        <circle cx="4" cy="9.837" r="4" fill="#FFBB38" />
                    </svg></a><a class="navbar-toggle popup-modal-dismiss"
                    href="#"><span></span><span></span><span></span></a></div>
            <div class="navbar-body">
                <ul class="nav navbar-nav navbar-nav-collapse">
                    <li class="nav-item "><a class="nav-link" href="#"><span>Home</span></a></li>
                    <li class="nav-item "><a class="nav-link" href="#about_us"><span>About Us</span></a></li>
                    <li class="nav-item "><a class="nav-link" href="#services"><span>Services</span></a></li>
                    <li class="nav-item "><a class="nav-link" href="#services"><span>Data Prices</span></a></li>
                    <li class="nav-item "><a class="nav-link" href="https://wa.me/234{{ substr($user->phone,1) }}"><span>Contact Us</span></a></li>

                      
                 
                </ul><!-- Button-->
                <a
                    class="btn d-none d-sm-inline-flex btn btn-sm btn-accent-1 ms-auto ms-lg-60 me-30 me-lg-0 order-2 order-lg-3"
                    href="/register" target="_self">Create Account</a>
               
            </div>
            <div class="navbar-footer">
                <!-- Contacts-->
                <ul class="list-group borderless font-size-15">
                    <li class="list-group-item">Email: <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></li>
                    <li class="list-group-item">Phone: <a href="tel:{{ $user->phone }}">{{ $user->phone }}</a></li>
                </ul><!-- Social-->
                <ul class="nav nav-gap-sm navbar-nav nav-social mt-30 nav-no-opacity">
                    <li class="nav-item"><a class="nav-link" href="{{ $user->facebook }}"><svg xmlns="http://www.w3.org/2000/svg" width="8"
                                height="15" fill="none">
                                <path fill="currentColor"
                                    d="M5.93 3.08h1.128V.974A13.651 13.651 0 0 0 5.416.882c-1.626 0-2.74 1.096-2.74 3.11v1.853H.882v2.353h1.794v5.92h2.2v-5.92h1.721l.274-2.353H4.875v-1.62c0-.68.171-1.146 1.056-1.146Z" />
                            </svg></a></li>
                  
                    <li class="nav-item"><a class="nav-link" href="{{ $user->twitter }}"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                height="13" fill="none">
                                <path fill="currentColor"
                                    d="M13.986 3.445c.01.133.01.266.01.4 0 4.064-3.093 8.746-8.747 8.746a8.687 8.687 0 0 1-4.72-1.38c.247.029.485.038.742.038 1.437 0 2.76-.485 3.816-1.313a3.08 3.08 0 0 1-2.874-2.132 3.251 3.251 0 0 0 1.39-.057A3.075 3.075 0 0 1 1.137 4.73v-.038c.41.228.886.37 1.39.39a3.072 3.072 0 0 1-1.37-2.56c0-.571.152-1.095.418-1.552a8.738 8.738 0 0 0 6.34 3.217 3.47 3.47 0 0 1-.077-.704A3.073 3.073 0 0 1 10.912.409c.885 0 1.685.37 2.246.97A6.052 6.052 0 0 0 15.11.637a3.066 3.066 0 0 1-1.352 1.694 6.164 6.164 0 0 0 1.77-.476 6.609 6.609 0 0 1-1.542 1.59Z" />
                            </svg></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ $user->instagram }}"><svg xmlns="http://www.w3.org/2000/svg" width="15"
                                height="15" fill="none">
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
                <li class="nav-item"><a class="nav-link" href="tel:{{ $user->phone }}"><svg xmlns="http://www.w3.org/2000/svg"
                            width="16" height="16" fill="none">
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
        <div class="pt-90 pb-90 bg-dark shape-parent">
            <!-- Shape-->
            <div class="shape justify-content-start align-items-end"><img loading="lazy"
                    src="{{ asset('theme4/assets/img/root/home-1-shape-364x300.png')}}" alt="" width="364" height="300"></div>
            <div class="background start-custom">
                <div class="background-image jarallax" data-jarallax data-speed="0.8"><img class="jarallax-img"
                        loading="lazy" src="{{ asset('theme4/assets/img/root/call-to-action-1920x1080.jpg')}}" alt=""></div>
                <div class="background-color" style="--background-color: #481FA0; opacity: .9;"></div>
            </div>
            <div class="container">
                <div class="row gy-70">
                    <div class="col-lg-6 offset-lg-1 order-lg-2">
                        @if($user->image_1 !== null )
                        <img src="{{ asset('website_images/'.$user->image_1) }}" alt=""
                            style='border-radius:15px' class="img-fluid w-100">
                        @else
                        <img
                        class="w-100 rounded-4 shadow mb-lg-n210 rellax no-transform-lg" loading="lazy"
                        src="{{ asset('theme4/assets/img/home-1-900x900.jpg')}}" alt="">
                        @endif
                      
                        </div>
                    <div class="col-lg-5">
                        <h1 class="text-white mb-45"><span class="highlight">{{ $user->heading_1 ?? "Top-Up, Pay Bills, Stay Connected" }}</span>
                            </h1>
                        <p class="mb-45 font-size-18 fw-medium text-white pe-lg-30">{{ $user->subheading_1 ?? "Top Up Airtime, Data, Cable Subscriptions, and More, All at Your Convenience." }}.</p><!-- Button--><a
                            class="btn btn-accent-1" href="/register" target="_self">Get Started </a>
                    </div>
                </div>
            </div>
        </div>
        <div id='services' class="pt-120 pt-lg-210 pb-130">
            <div class="container">
                <div class="row mb-90">
                    <div class="col-lg-6 offset-lg-3 text-center"><span class="badge bg-light text-dark mb-20"
                            data-show="startbox">Our services</span>
                      
                    </div>
                </div>
                <div class="row gy-30">
                    <div class="col-12 col-md-6 col-lg-4" data-show="startbox">
                        <!-- Service box-->
                        <div class="service-box lift position-relative rounded-4 bg-gray-light text-center">
                            <!-- Circle icon-->
                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Communication/Active-call.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M13.0799676,14.7839934 L15.2839934,12.5799676 C15.8927139,11.9712471 16.0436229,11.0413042 15.6586342,10.2713269 L15.5337539,10.0215663 C15.1487653,9.25158901 15.2996742,8.3216461 15.9083948,7.71292558 L18.6411989,4.98012149 C18.836461,4.78485934 19.1530435,4.78485934 19.3483056,4.98012149 C19.3863063,5.01812215 19.4179321,5.06200062 19.4419658,5.11006808 L20.5459415,7.31801948 C21.3904962,9.0071287 21.0594452,11.0471565 19.7240871,12.3825146 L13.7252616,18.3813401 C12.2717221,19.8348796 10.1217008,20.3424308 8.17157288,19.6923882 L5.75709327,18.8875616 C5.49512161,18.8002377 5.35354162,18.5170777 5.4408655,18.2551061 C5.46541191,18.1814669 5.50676633,18.114554 5.56165376,18.0596666 L8.21292558,15.4083948 C8.8216461,14.7996742 9.75158901,14.6487653 10.5215663,15.0337539 L10.7713269,15.1586342 C11.5413042,15.5436229 12.4712471,15.3927139 13.0799676,14.7839934 Z" fill="#000000"/>
                                    <path d="M14.1480759,6.00715131 L13.9566988,7.99797396 C12.4781389,7.8558405 11.0097207,8.36895892 9.93933983,9.43933983 C8.8724631,10.5062166 8.35911588,11.9685602 8.49664195,13.4426352 L6.50528978,13.6284215 C6.31304559,11.5678496 7.03283934,9.51741319 8.52512627,8.02512627 C10.0223249,6.52792766 12.0812426,5.80846733 14.1480759,6.00715131 Z M14.4980938,2.02230302 L14.313049,4.01372424 C11.6618299,3.76737046 9.03000738,4.69181803 7.1109127,6.6109127 C5.19447112,8.52735429 4.26985715,11.1545872 4.51274152,13.802405 L2.52110319,13.985098 C2.22450978,10.7517681 3.35562581,7.53777247 5.69669914,5.19669914 C8.04101739,2.85238089 11.2606138,1.72147333 14.4980938,2.02230302 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                </g>
                            </svg><!--end::Svg Icon--></span>
                            <h4 class="service-box-title mb-15">Airtime Top-Up</h4>
                            <p class="service-box-text font-size-15 mb-30">Top Up your airtime at a discounted price and enjoy more call time.</p><a href='/airtime' class="service-box-arrow stretched-link mt-30"
                                href="service-single.html"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                    height="14" fill="none">
                                    <path stroke="currentColor" stroke-width="1.7" d="M0 7h18m0 0-6.75-6M18 7l-6.75 6">
                                    </path>
                                </svg></a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4" data-show="startbox" data-show-delay="100">
                        <!-- Service box-->
                        <div class="service-box lift position-relative rounded-4 bg-gray-light text-center">
                            <!-- Circle icon-->
                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Devices/LTE2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M16.4508979,17.4029496 L15.1784978,15.8599014 C16.324501,14.9149052 17,13.5137472 17,12 C17,10.4912085 16.3289582,9.09418404 15.1893841,8.14910121 L16.466112,6.60963188 C18.0590936,7.93073905 19,9.88958759 19,12 C19,14.1173586 18.0528606,16.0819686 16.4508979,17.4029496 Z M19.0211112,20.4681628 L17.7438102,18.929169 C19.7927036,17.2286725 21,14.7140097 21,12 C21,9.28974232 19.7960666,6.77820732 17.7520315,5.07766256 L19.031149,3.54017812 C21.5271817,5.61676443 23,8.68922234 23,12 C23,15.3153667 21.523074,18.3916375 19.0211112,20.4681628 Z M7.54910207,17.4029496 C5.94713944,16.0819686 5,14.1173586 5,12 C5,9.88958759 5.94090645,7.93073905 7.53388797,6.60963188 L8.81061588,8.14910121 C7.67104182,9.09418404 7,10.4912085 7,12 C7,13.5137472 7.67549895,14.9149052 8.82150222,15.8599014 L7.54910207,17.4029496 Z M4.9788888,20.4681628 C2.47692603,18.3916375 1,15.3153667 1,12 C1,8.68922234 2.47281829,5.61676443 4.96885102,3.54017812 L6.24796852,5.07766256 C4.20393339,6.77820732 3,9.28974232 3,12 C3,14.7140097 4.20729644,17.2286725 6.25618985,18.929169 L4.9788888,20.4681628 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                    <path d="M11,14.2919782 C10.1170476,13.9061998 9.5,13.0251595 9.5,12 C9.5,10.6192881 10.6192881,9.5 12,9.5 C13.3807119,9.5 14.5,10.6192881 14.5,12 C14.5,13.0251595 13.8829524,13.9061998 13,14.2919782 L13,20 C13,20.5522847 12.5522847,21 12,21 C11.4477153,21 11,20.5522847 11,20 L11,14.2919782 Z" fill="#000000"/>
                                </g>
                            </svg><!--end::Svg Icon--></span>
                            <h4 class="service-box-title mb-15">Affordable Data Plans</h4>
                            <p class="service-box-text font-size-15 mb-30">Enjoy the internet with our cheap data plans.</p><a href='/data' class="service-box-arrow stretched-link mt-30"
                                href="service-single.html"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                    height="14" fill="none">
                                    <path stroke="currentColor" stroke-width="1.7" d="M0 7h18m0 0-6.75-6M18 7l-6.75 6">
                                    </path>
                                </svg></a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4" data-show="startbox" data-show-delay="200">
                        <!-- Service box-->
                        <div class="service-box lift position-relative rounded-4 bg-gray-light text-center">
                            <!-- Circle icon-->
                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Devices/TV2.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M3,5 L21,5 C21.5522847,5 22,5.44771525 22,6 L22,17 C22,17.5522847 21.5522847,18 21,18 L3,18 C2.44771525,18 2,17.5522847 2,17 L2,6 C2,5.44771525 2.44771525,5 3,5 Z M9.632,10.066 L11.032,10.066 L11.032,9.044 L7.035,9.044 L7.035,10.066 L8.435,10.066 L8.435,14 L9.632,14 L9.632,10.066 Z M14.935,14 L16.846,9.044 L15.523,9.044 L14.382,12.558 L14.354,12.558 L13.206,9.044 L11.862,9.044 L13.738,14 L14.935,14 Z" fill="#000000"/>
                                    <rect fill="#000000" opacity="0.3" x="3" y="19" width="18" height="1" rx="0.5"/>
                                </g>
                            </svg><!--end::Svg Icon--></span>
                            <h4 class="service-box-title mb-15">Cable(Tv) Subscriptions</h4>
                            <p class="service-box-text font-size-15 mb-30">Streamline Your Entertainment with our Cable Subscription Plans
                                without.</p><a href='/cable' class="service-box-arrow stretched-link mt-30"
                                href="service-single.html"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                    height="14" fill="none">
                                    <path stroke="currentColor" stroke-width="1.7" d="M0 7h18m0 0-6.75-6M18 7l-6.75 6">
                                    </path>
                                </svg></a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4" data-show="startbox" data-show-delay="300">
                        <!-- Service box-->
                        <div class="service-box lift position-relative rounded-4 bg-gray-light text-center">
                            <!-- Circle icon-->
                            <span class="svg-icon svg-icon-primary svg-icon-4x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Home/Bulb1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <circle fill="#000000" opacity="0.3" cx="12" cy="9" r="8"/>
                                    <path d="M14.5297296,11 L9.46184488,11 L11.9758349,17.4645458 L14.5297296,11 Z M10.5679953,19.3624463 L6.53815512,9 L17.4702704,9 L13.3744964,19.3674279 L11.9759405,18.814912 L10.5679953,19.3624463 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                    <path d="M10,22 L14,22 L14,22 C14,23.1045695 13.1045695,24 12,24 L12,24 C10.8954305,24 10,23.1045695 10,22 Z" fill="#000000" opacity="0.3"/>
                                    <path d="M9,20 C8.44771525,20 8,19.5522847 8,19 C8,18.4477153 8.44771525,18 9,18 C8.44771525,18 8,17.5522847 8,17 C8,16.4477153 8.44771525,16 9,16 L15,16 C15.5522847,16 16,16.4477153 16,17 C16,17.5522847 15.5522847,18 15,18 C15.5522847,18 16,18.4477153 16,19 C16,19.5522847 15.5522847,20 15,20 C15.5522847,20 16,20.4477153 16,21 C16,21.5522847 15.5522847,22 15,22 L9,22 C8.44771525,22 8,21.5522847 8,21 C8,20.4477153 8.44771525,20 9,20 Z" fill="#000000"/>
                                </g>
                            </svg><!--end::Svg Icon--></span>
                            <h4 class="service-box-title mb-15">Pay Light Bills</h4>
                            <p class="service-box-text font-size-15 mb-30">Light Up Your Building with Effortless Bill Payments.</p><a href='/electricity' class="service-box-arrow stretched-link mt-30"
                                href="service-single.html"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                    height="14" fill="none">
                                    <path stroke="currentColor" stroke-width="1.7" d="M0 7h18m0 0-6.75-6M18 7l-6.75 6">
                                    </path>
                                </svg></a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4" data-show="startbox" data-show-delay="300">
                        <!-- Service box-->
                        <div class="service-box lift position-relative rounded-4 bg-gray-light text-center">
                            <!-- Circle icon-->
                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Layout/Layout-top-panel-6.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <rect fill="#000000" x="2" y="5" width="19" height="4" rx="1"/>
                                    <rect fill="#000000" opacity="0.3" x="2" y="11" width="19" height="10" rx="1"/>
                                </g>
                            </svg><!--end::Svg Icon--></span>
                            <h4 class="service-box-title mb-15">Exam Result Checkers</h4>
                            <p class="service-box-text font-size-15 mb-30">Easily Access Your Exam Results at a giveaway prices.</p><a href='/examination' class="service-box-arrow stretched-link mt-30"
                                href="service-single.html"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                    height="14" fill="none">
                                    <path stroke="currentColor" stroke-width="1.7" d="M0 7h18m0 0-6.75-6M18 7l-6.75 6">
                                    </path>
                                </svg></a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4" data-show="startbox" data-show-delay="300">
                        <!-- Service box-->
                        <div class="service-box lift position-relative rounded-4 bg-gray-light text-center">
                            <!-- Circle icon-->
                            {{-- <div class="circle-icon text-white bg-accent-2 mb-30"> --}}
                                <span class="svg-icon svg-icon-primary svg-icon-4x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo2/dist/../src/media/svg/icons/Communication/Group-chat.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z" fill="#000000"/>
                                        <path d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z" fill="#000000" opacity="0.3"/>
                                    </g>
                                </svg><!--end::Svg Icon--></span>   
                            {{-- </div> --}}
                            <h4  class="service-box-title mb-15">Bulk SMS</h4>
                            <p class="service-box-text font-size-15 mb-30">Reach Your Audience Seamlessly with our Bulk SMS packages.</p><a class="service-box-arrow stretched-link mt-30"
                                href="service-single.html"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                    height="14" fill="none">
                                    <path stroke="currentColor" stroke-width="1.7" d="M0 7h18m0 0-6.75-6M18 7l-6.75 6">
                                    </path>
                                </svg></a>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
        <div>
            <div id='about_us' class="container">
                <div class="row gy-50">
                    <div class="col-lg-5">
                        <h3 class="mb-45" data-show="startbox">About Us.</h3>
                        <p class="mb-40" data-show="startbox" data-show-delay="100">{{ $user->about_us ?? "We absolutely provide a comprehensive platform for all your data, airtime, electricity, and cable subscription needs. Our mission is to empower your digital lifestyle through affordability, automation, and lightning-fast transactions." }}</p>
                        <div data-show="startbox" data-show-delay="200">
                            <!-- Button--><a class="btn btn-accent-1 btn-link btn-clean" href="#" target="_self">Learn
                                more</a>
                        </div>
                    </div>
                    <div class="col-lg-6 offset-lg-1">
                        <div class="position-relative shape-parent mt-80">
                            <!-- Shape-->
                            <div class="shape justify-content-start mt-n40 ms-n45 text-dark" data-jarallax-element="40">
                                <svg xmlns="http://www.w3.org/2000/svg" width="86" height="85" fill="none">
                                    <path fill="currentColor" fill-rule="evenodd"
                                        d="M80.607 25.302h-.731c-.226-.173-.001-.45-.172-.65l-.504-.027c-.167.343-.285.84-.879.676-.227-.053-.046-.348-.21-.422-.347-.114-.584.077-.907.254-.42-.59-1.186-.73-1.697-1.258-.1-.406.078-.86-.237-1.256-.098-.124-.065-.51.054-.622.365-.345-.077-.698.04-.933.174-.349.036-.625.104-.894-.314-.13-.425.038-.63.253-.04-.83-.174-1.579.258-2.307l.6-.066c-.1-.364.243-.63.229-.99-.022-.594.163-1.13.465-1.615.253-.406.211-.834.218-1.28l1.073-.983.152.127c.157-.13.313-.354.512-.404.274-.068.46-.357.808-.258.244.07.524.018.787.012.22-.006.457.02.657-.05.26-.091.482-.348.74-.382.48-.064.976-.018 1.505-.018.265.504.846.624 1.31.83.569.254.838.693 1.017 1.168.181.485-.133.986-.361 1.41-.293.542-.673 1.05-1.197 1.406.381.613.73 1.2.226 1.884-.145 1.987-1.385 3.497-2.272 5.156-.235.44-.811.645-.958 1.239ZM6.124 63.859l.2-.241c-.055-.176-.234-.095-.36-.16-.208-.154.062-.442-.176-.629-.076.008-.218-.02-.272.037-.69.724-.816.423-1.428-.124-.073-.065-.11-.066-.212-.075-1.41-.123-1.957-.674-2.116-2.064-.183-.023-.24.272-.5.158-.138-.456-.717-.744-.589-1.394.027-.136-.259-.333-.4-.501.542-.452-.504-1.08.147-1.519-.014-.29-.342-.342-.404-.593-.072-.29.155-.465.23-.698.258-.813.815-1.467 1.217-2.2.34-.62 1.097-.881 1.679-1.217.313.061.413.336.628.463l.202-.513.382.556c.306-.2.094-.472.254-.687h1.54l.422.422c.538-.521.997-.108 1.481.198.64-.648 1.292.338 1.951-.031.283.312.71.472.642.985-.007.056.055.173.094.177.765.078.695.83.992 1.26-.188.468-.538.834-.912 1.182-.082.076-.16.227-.24.228-1.004.004-1.045.951-1.488 1.5-.384.476-.527 1.072-.688 1.632a6.994 6.994 0 0 0-.282 1.705c-.02.637.015 1.427-.876 1.687-.158.046-.277.247-.401.388-.213.24-.446.2-.717.068ZM28.791 48.175c.375-.162.764-.302 1.22-.281.863.038 1.732.048 2.594-.004.43-.026.873.038 1.24.134.292.076.487-.355.722-.03.192.266.498.06.729.145.26.096.48.338.823.165.154-.065-.1-.417.25-.389.683.047.284.933.853 1.1.04-.117.087-.247.136-.386.179-.035.294.15.302.22.067.57.38 1.09.316 1.682-.024.213-.056.399-.158.614-.3.635-.575 1.322-.501 2.037.045.44-.318.716-.269 1.153.043.373.203.828-.204 1.146 0 .677-.04 1.357.01 2.03.066.892-.457 1.422-1.069 1.907-.09.071-.286.01-.422.01-.17-.374-.371-.708-.355-1.285-.207.405-.312.65-.527.839-.294.258-.55.336-.86.05-.129-.12-.215-.304-.446-.285-.649.055-1.11-.301-1.486-.76-.36-.437-.916-.683-1.003-1.399-.064-.516-.52-.976-.753-1.482-.628-1.358-1.262-2.714-1.826-4.097-.273-.667.01-1.34.268-1.973.119-.29.271-.564.416-.86ZM22.87 33.667c-.033-.41.06-.85-.114-1.041-.289-.314.338-.508-.03-.75-.578.446-.551 1.28-1.089 1.752-.38-.165-.752-.343-.935-.614-.308-.053-.35.146-.545.231-.58-.324-1.286-.583-1.708-1.165-.535-.738-1.039-1.526-1.035-2.503.002-.452.038-.907-.006-1.355-.147-1.477.306-2.843.75-4.21.185-.571.492-1.088.854-1.553.257-.158.523-.053.846-.092l.467.467c.316.04.37-.405.669-.46.183-.032.253.125.368.22l.256-.233.139.402c.052.074.092.052.161-.03.507-.603 1.194-.633 1.918-.574.461.296.731.811 1.393.971.682.165.961 1.277.647 1.96-.257.559-.57 1.073-.122 1.704.125.175.104.552.004.769-.277.594-.22 1.251-.43 1.854-.196.561-.31 1.152-.53 1.702-.067.167-.147.312-.157.5-.037.7-.447 1.247-.786 1.818-.216.365-.592.214-.985.23ZM50.532 50.867l.24.205.16-.439c.703.3 1.275-.207 1.916-.326.254-.048 1.214-.208 1.462-.185.07.007.176.064.203.037.301-.309.693-.158 1.036-.236.295-.068.555.397.834.02.56.463 1.216.132 1.823.212.37.049.75.01 1.118.01l.326.325c-.083.15-.3.238-.205.485.318.22.713-.004 1.054.139.315.277.478.572.109.93-.08.078-.206.146-.232.241-.244.883-1.007.922-1.7 1.035-.712.114-1.323.44-1.877.687-.293.772.149 1.372.162 2.026.013.61-.145 1.24.199 1.834.081.142.137.478-.076.621-.352.24-.316.776-.722.925-.182.067-.401.022-.615-.139-.204-.153-.027-.477-.32-.524-.23-.036-.34.146-.442.284-.171.231-.42.214-.607.152-.257-.085-.478-.277-.715-.423-.337.403-.592-.064-.762-.169-.236-.144-.51-.26-.723-.446-.226-.197-.426-.424-.642-.633a.833.833 0 0 1-.26-.462c-.03-.143-.179-.189-.044-.418.144-.247-.303-.054-.398-.317-.381-1.048-1.051-1.962-1.473-2.998a.843.843 0 0 1-.035-.616c.221-.735.55-1.395 1.206-1.837ZM54.604 84.51c-.975-.056-.975-.056-1.134-1.114-.564.526-.564.526-1.137.676-.161-.428-.384-.845-.984-.705-.082.02-.205-.057-.282-.121-.45-.381-.624-.994-1.119-1.34.024-.732-.473-1.449-.203-2.155.286-.75.358-1.557.768-2.28.502-.884 1.043-1.717 1.813-2.458.416.041.858.02 1.096-.462l.261.232c.735-.738.922-1.884 1.828-2.464.357-.171.568.287.825.194.337-.122.557.307.871.104.273-.177.557-.074.808-.05.262.344-.377.498-.104.81.202.042.307-.32.58-.106.159.745-.103 1.419-.386 2.133-.307.774-.735 1.539-.697 2.418.014.316-.204.524-.32.772-.345.729-.587 1.49-.864 2.24-.347.944-.451 1.976-1.014 2.857-.179.279-.387.515-.606.819ZM47.369 22.139c.195-.227-.03-.502.2-.66.324-.053.572.193.55.403-.085.78.432 1.132.934 1.524.148.114.268.262.401.396.207.461-.109.823-.233 1.222-.168.118-.353.046-.532.047-.18-.096 0-.493-.387-.433-.254.088-.35.462-.352.574a3.744 3.744 0 0 1-.487 1.842c.326.704-.208 1.307-.234 1.974-.027.706-.382 1.275-.852 1.79-.199.217-.415.087-.62.168.015-.387-.463-.509-.214-1.146-.407.444-.39.913-.765.881-.602-.05-1.297-.03-1.765-.33-.452-.291-1.258-.416-1.203-1.256a.255.255 0 0 0-.09-.184c-.863-.67-.928-1.721-1.252-2.64-.26-.737-.481-1.485-.477-2.291.001-.45.464-.787.215-1.227.252-.4.719-.59.792-1.172.917.755 1.82-.173 2.694.093.2-.099.12-.283.206-.41.151-.144.353-.007.347-.005.377-.135.166-.44.416-.482.122.072.084.193.092.312.23.265.566.014.83.156l.396.397c.386-.247.455-.685.655-1.097.273.145.41.336.382.662-.03.333-.05.681.353.892ZM53.912.885c.137.215.056.397.23.471.233-.243.007-.575.14-.86l.398-.04v1.088c.209-.643 1.139-.417 1.25-1.082.172.265.432.238.692.215.229-.158 0-.435.166-.62.241-.095.497-.046.757-.029.177.235.042.506.087.758.245.261.461.567.853.642-.112.184.034.478-.027.539-.272.273-.044.743-.454.96-.38.202.073.748-.326.986.433.474-.202.885-.073 1.381.117.451.025.957.025 1.41.2.1.213-.068.316-.106.3-.018.005.344.227.387.049-.033.129-.057.15-.107.277-.657.569-1.32.386-2.057-.192-.772-.24-.78.066-1.749.087-.275-.439-.367-.082-.641.198-.152-.076-.536.252-.685-.133-.233-.169-.52-.393-.702.043-.12.137-.128.247-.135.345-.019.564.128.636.467.061.285-.104.592.089.868.138.197-.102.468.13.668.056.047.056.277.001.319-.382.295-.075.545-.018.844.055.292.089.62-.108.96-.243.418-.07.888.116 1.34.104.255.33.106.434.261-.304.375-.178.8-.171 1.18.121.137.321.106.323.081.036-.337.464-.632.121-1.01.295-.26.502-.682 1.064-.53a4.844 4.844 0 0 1-.208.735c-.084.235-.224.445-.188.71.043.306-.328.484-.23.81.1.336-.186.364-.38.514-.196.15.044.561-.277.732.184.161.376.06.565.086.191-.253.054-.611.37-.873.466-.384.401-.446.692-1.547.105-.4.309-.774.479-1.186.521.38.44.872.242 1.344-.164.396-.251.814-.383 1.2-.123.362-.058.9-.56 1.127-.34.153-.276.67-.648.83-.123-.13-.238-.293-.537-.149l.424.526c-.3.181-.559.146-.776-.14-.388.604-1.206.419-1.613.912-.354-.01-.436-.319-.67-.468l-.138.401c-.153.105-.3-.35-.503.01-.058.104-.43.089-.633.036-.159-.042-.293-.215-.416-.349-.176-.192-.438.004-.626-.14.249-.37-.061-.61-.182-.878-.173-.386-.773-.014-.96-.62-.009-.05.32-.133.2-.306-.434-.635-.22-1.47-.665-2.1-.036-.05.023-.163-.011-.219-.238-.394.612-.781.005-1.17 0-.414-.104-.864.024-1.235.198-.573.194-1.14.2-1.721 0-.07-.024-.14-.041-.235-.221-.037-.275.183-.388.285-.08.07.05.287-.238.321-.006-.943-.157-1.89.566-2.715ZM31.878 76.44c-.009.193-.008.303.1.374.312.192.375-.418.7-.184.078.025.1.08.049.13-.258.259-.646.557-.308.914.39.412-.237.565-.115.866-.355.097-.64.521-1.074.235-.089-.06-.144-.176-.373-.12-.918.724-1.463 1.812-1.883 2.933-.143.385-.395.592-.598.88-1.34-.906-1.34-.906-1.83-.683-.412-.555-.83-1.114-.765-1.87.027-.314-.068-.565-.233-.809.388-.478.065-.938-.107-1.346-.217-.512-.024-1.023-.144-1.519-.015-.063-.1-.108-.172-.178.31-.492.44-1.104 1.035-1.5.501.098 1.093-.157 1.664.126.548.273 1.176.248 1.744.42.525.16.998.492 1.529.765.479-.099.762-.541 1.124-.857.683-.035 1.355-.284 1.773-.653.562-.117 1.181.159 1.71-.26l.456.594c-.926-.196-.877-.088-2.152.5-.787.36-1.268 1.144-2.13 1.242ZM62.335 27.374l.07-.617c.07-.102.109-.082.18.002.116.14.263.236.248.466-.026.413.006.829-.01 1.242-.014.335.009.661.233.92.333.385.172.832.236 1.23-.455.408-.618.875-.726 1.442-.111.578-.09 1.196-.397 1.752-.127.23-.02.588-.02.877-.237.243-.508.442-.557.789h-.47c-.244-.244.008-.582-.16-.85-.176-.077-.389-.124-.383.153.006.297-.523.302-.11.765-.81-.172-1.397-.402-1.955-.286-.33-.042-.123-.361-.412-.484-.801-.34-1.105-.96-1.159-1.782-.064-.997.18-1.929.457-2.865.213-.715.598-1.153 1.41-1.217.736-.059 1.06-.51 1.078-1.27.007-.297 0-.594 0-.88.229-.163.228.13.342.126.3.133.397-.383.726-.178.197.144-.064.43.14.602.048-.029.142-.057.142-.087.006-.328.34-.554.266-.917-.02-.098.178-.087.288-.091.21.122.116.327.127.499.013.183.003.367.003.487.108.197.236.12.413.172ZM76.219 53.438l-.478-.177c-.075-.177-.007-.284.09-.411.177-.228.19-.48-.05-.685-.445-.381-.37-.695.012-1.11.21-.23.38-.62.174-1.031.207-.309.451.182.562.075.27-.262.564-.132.846-.156.261-.022.526-.005.79-.005h.823c.25.325.587.635.747 1.018.116.275.23.59.31.895.094.356-.428.503-.123.883.17.213.078.635.105.963.523.428 1.41.124 1.754.897l-.185.184c.123.186.44.172.507.493.035.17.082.517.342.626l-.268.558c-.047-.028-.136-.053-.14-.088-.018-.147.03-.315-.025-.443s-.201-.217-.306-.322c-.178.063-.097.242-.17.373-.255-.04-.545-.435-.753.13l-.2-.526c-.162.015-.405-.036-.503.06-.496.486-1.102.9-1.358 1.575-.197.516-.606.786-.96 1.15-.342-.222-.326-.494-.174-.685.192-.244.193-.452.052-.761-.206.228-.447.409-.567.65-.135.276-.234.521-.587.5-.227-.263-.024-.59-.129-.857-.292-.008-.167.187-.21.31-.276.195-.552.173-.755-.11-.165-.23-.226-.529-.483-.704-.19-.13-.158-.377-.096-.512.311-.672.428-1.404.641-2.103.121-.398.366-.492.765-.654ZM17.405 76.827c-.226.005-.258-.251-.454-.31l.232-.258a.244.244 0 0 0-.28-.11c-.255.072-.319.41-.628.452-.327-.02-.487-.358-.777-.506-.742-.378-1.162-1.83-.91-2.659.198-.643.19-1.276-.066-1.998.021-.102.206-.001.327-.073.254-.326-.03-.584-.153-.868.08-.318.41-.421.547-.685.335.281.634.425 1.095.257.405-.148.58.323.838.54l-.199.248c.29.24.434.007.562-.154.243-.302.159-.826.704-.944.175-.038.058-.337.072-.515.026-.349.227-.507.524-.566.32.161.004.53.27.688.522-.381.287-1.236 1.033-1.595-.211.738-.453 1.388-.574 2.06-.122.676-.801 1.211-.485 2.085.432-.862.658-1.71.96-2.538a2.16 2.16 0 0 1-.122 1.344c-.373.897-.62 1.847-.926 2.772-.165.494-.326.992-.53 1.47-.054.13-.13.235-.155.39-.13.811-.18.877-.905 1.473Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="position-absolute end-0 top-0 mt-n80" data-img-height
                                style="--img-height: 100%; width: 230px;"><img class="rounded-4" loading="lazy"
                                    src="{{ asset('theme4/assets/img/about-us-4-900x990.jpg')}}" alt=""></div>
                            <div class="me-100" data-img-height style="--img-height: 70%;" data-show="startbox"><a
                                    class="image-link" href="theme4/assets/img/about-us-3-900x630.jpg"><img
                                        class="rounded-4" loading="lazy" src="{{ asset('theme4/assets/img/about-us-3-900x630.jpg"
                                      ')}}  alt=""></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="py-100 position-relative">
            <div class="background">
                <div class="background-image jarallax" data-jarallax data-speed="0.8"><img class="jarallax-img"
                        loading="lazy" src="{{ asset('theme4/assets/img/root/process-1920x500.jpg')}}" alt=""></div>
                <div class="background-color" style="--background-color: #F01F4B; opacity: .88;"></div>
            </div>
            <div class="container overflow-hidden">
                <div class="row gy-50 gx-50">
                    <div class="col-12 col-md-6 col-lg-4" data-show="startbox">
                        <!-- Process step-->
                        <div class="process-step ">
                            <div class="process-number h1 large-heading m-0 text-white">01</div>
                            <div class="process-body pt-10 ms-30"><a class="process-title h4 text-white"
                                    href="#">Everything Automated</a>
                                <p class="process-text text-white">Payment and Purchases fully Automated.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4" data-show="startbox" data-show-delay="100">
                        <!-- Process step-->
                        <div class="process-step ">
                            <div class="process-number h1 large-heading m-0 text-white">02</div>
                            <div class="process-body pt-10 ms-30"><a class="process-title h4 text-white"
                                    href="#">Transaction Redo</a>
                                <p class="process-text text-white">Experience hassle-free transaction retries with our one-click Transaction Redo feature.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4" data-show="startbox" data-show-delay="200">
                        <!-- Process step-->
                        <div class="process-step ">
                            <div class="process-number h1 large-heading m-0 text-white">03</div>
                            <div class="process-body pt-10 ms-30"><a class="process-title h4 text-white" href="#">Bulk Purchase</a>
                                <p class="process-text text-white">Simplify bulk purchases with our streamlined process.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4" data-show="startbox" data-show-delay="200">
                        <!-- Process step-->
                        <div class="process-step ">
                            <div class="process-number h1 large-heading m-0 text-white">04</div>
                            <div class="process-body pt-10 ms-30"><a class="process-title h4 text-white" href="#">Schedule For Later Purchase</a>
                                <p class="process-text text-white">Plan your purchases ahead with our 'Schedule for Later Purchase' feature.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4" data-show="startbox" data-show-delay="200">
                        <!-- Process step-->
                        <div class="process-step ">
                            <div class="process-number h1 large-heading m-0 text-white">05</div>
                            <div class="process-body pt-10 ms-30"><a class="process-title h4 text-white" href="#">Add Up Beneficiaries<svg xmlns="http://www.w3.org/2000/svg" width="42" height="11" fill="none">
                                        <path stroke="currentColor" stroke-width="2"
                                            d="M0 5.5h40m0 0L34.6 1M40 5.5 34.6 10" />
                                    </svg></a>
                                <p class="process-text text-white">Simplify future purchases by saving contacts, decoder numbers, and meter numbers with our 'Add Up Beneficiaries' feature.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4" data-show="startbox" data-show-delay="200">
                        <!-- Process step-->
                        <div class="process-step ">
                            <div class="process-number h1 large-heading m-0 text-white">06</div>
                            <div class="process-body pt-10 ms-30"><a class="process-title h4 text-white" href="#">24/7 Support System<svg xmlns="http://www.w3.org/2000/svg" width="42" height="11" fill="none">
                                        <path stroke="currentColor" stroke-width="2"
                                            d="M0 5.5h40m0 0L34.6 1M40 5.5 34.6 10" />
                                    </svg></a>
                                <p class="process-text text-white">Count on our 24/7 support system for assistance anytime you need it.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-linear-gradient pt-120 pb-130">
            <div class="container">
                <div class="justify-content-center d-flex align-items-center" data-show="startbox">
                    <h2 class="m-0">Data Prices</h2>
                    <div class="d-inline-flex flex-column ms-20"><svg class="d-block" xmlns="http://www.w3.org/2000/svg"
                            width="84" height="15" fill="none">
                            <path fill="#FFBB38"
                                d="m8.022 0 2.48 4.937 5.543.796-4.011 3.841L12.98 15l-4.958-2.563L3.065 15l.946-5.426L0 5.734l5.544-.797L8.022 0ZM25.01 0l2.48 4.937 5.543.796-4.011 3.841.947 5.426-4.958-2.563L20.053 15 21 9.574l-4.012-3.84 5.544-.797L25.01 0ZM42 0l2.479 4.937 5.544.796-4.012 3.841.947 5.426L42 12.437 37.042 15l.947-5.426-4.011-3.84 5.543-.797L42 0ZM58.988 0l2.48 4.937 5.543.796L63 9.574 63.945 15l-4.958-2.563L54.03 15l.947-5.426-4.011-3.84 5.543-.797L58.99 0ZM75.978 0l2.479 4.937L84 5.733l-4.011 3.841.946 5.426-4.957-2.563L71.02 15l.946-5.426-4.01-3.84 5.543-.797L75.978 0Z" />
                        </svg><span class="fw-medium font-size-13">on {{ $user->brand_name }}</span></div>
                </div><!-- Slider-->
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
                                <div class="table_btn"> <a  style='color:white;background:#F01F4B' href="/buydata" class="btn btn-success mx-auto d-block"><i
                                            class="bi bi-cart"></i>Purchase Now</a></div>
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
                                <div class="table_btn"> <a href="/buydata"  style='color:white;background:#F01F4B' class="btn btn-success mx-auto d-block"><i
                                            class="bi bi-cart"></i>Purchase Now</a></div>
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
                                <div class="table_btn"> <a href="/buydata"  style='color:white;background:#F01F4B' class="btn btn-success mx-auto d-block"><i
                                            class="bi bi-cart"></i>Purchase Now</a></div>
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
                                <div class="table_btn"> <a href="/buydata" style='color:white;background:#F01F4B' class="btn btn-success mx-auto d-block"><i
                                            class="bi bi-cart"></i>Purchase Now</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-120 pb-130 overflow-hidden footerPrev">
            <div class="container">
                <div class="row align-items-center gy-90">
                    <div class="col-lg-6 shape-parent">
                        <!-- Shape-->
                        <div class="shape justify-content-start mt-n40 ms-n45 text-dark" data-jarallax-element="40"><svg
                                xmlns="http://www.w3.org/2000/svg" width="86" height="85" fill="none">
                                <path fill="currentColor" fill-rule="evenodd"
                                    d="M80.607 25.302h-.731c-.226-.173-.001-.45-.172-.65l-.504-.027c-.167.343-.285.84-.879.676-.227-.053-.046-.348-.21-.422-.347-.114-.584.077-.907.254-.42-.59-1.186-.73-1.697-1.258-.1-.406.078-.86-.237-1.256-.098-.124-.065-.51.054-.622.365-.345-.077-.698.04-.933.174-.349.036-.625.104-.894-.314-.13-.425.038-.63.253-.04-.83-.174-1.579.258-2.307l.6-.066c-.1-.364.243-.63.229-.99-.022-.594.163-1.13.465-1.615.253-.406.211-.834.218-1.28l1.073-.983.152.127c.157-.13.313-.354.512-.404.274-.068.46-.357.808-.258.244.07.524.018.787.012.22-.006.457.02.657-.05.26-.091.482-.348.74-.382.48-.064.976-.018 1.505-.018.265.504.846.624 1.31.83.569.254.838.693 1.017 1.168.181.485-.133.986-.361 1.41-.293.542-.673 1.05-1.197 1.406.381.613.73 1.2.226 1.884-.145 1.987-1.385 3.497-2.272 5.156-.235.44-.811.645-.958 1.239ZM6.124 63.859l.2-.241c-.055-.176-.234-.095-.36-.16-.208-.154.062-.442-.176-.629-.076.008-.218-.02-.272.037-.69.724-.816.423-1.428-.124-.073-.065-.11-.066-.212-.075-1.41-.123-1.957-.674-2.116-2.064-.183-.023-.24.272-.5.158-.138-.456-.717-.744-.589-1.394.027-.136-.259-.333-.4-.501.542-.452-.504-1.08.147-1.519-.014-.29-.342-.342-.404-.593-.072-.29.155-.465.23-.698.258-.813.815-1.467 1.217-2.2.34-.62 1.097-.881 1.679-1.217.313.061.413.336.628.463l.202-.513.382.556c.306-.2.094-.472.254-.687h1.54l.422.422c.538-.521.997-.108 1.481.198.64-.648 1.292.338 1.951-.031.283.312.71.472.642.985-.007.056.055.173.094.177.765.078.695.83.992 1.26-.188.468-.538.834-.912 1.182-.082.076-.16.227-.24.228-1.004.004-1.045.951-1.488 1.5-.384.476-.527 1.072-.688 1.632a6.994 6.994 0 0 0-.282 1.705c-.02.637.015 1.427-.876 1.687-.158.046-.277.247-.401.388-.213.24-.446.2-.717.068ZM28.791 48.175c.375-.162.764-.302 1.22-.281.863.038 1.732.048 2.594-.004.43-.026.873.038 1.24.134.292.076.487-.355.722-.03.192.266.498.06.729.145.26.096.48.338.823.165.154-.065-.1-.417.25-.389.683.047.284.933.853 1.1.04-.117.087-.247.136-.386.179-.035.294.15.302.22.067.57.38 1.09.316 1.682-.024.213-.056.399-.158.614-.3.635-.575 1.322-.501 2.037.045.44-.318.716-.269 1.153.043.373.203.828-.204 1.146 0 .677-.04 1.357.01 2.03.066.892-.457 1.422-1.069 1.907-.09.071-.286.01-.422.01-.17-.374-.371-.708-.355-1.285-.207.405-.312.65-.527.839-.294.258-.55.336-.86.05-.129-.12-.215-.304-.446-.285-.649.055-1.11-.301-1.486-.76-.36-.437-.916-.683-1.003-1.399-.064-.516-.52-.976-.753-1.482-.628-1.358-1.262-2.714-1.826-4.097-.273-.667.01-1.34.268-1.973.119-.29.271-.564.416-.86ZM22.87 33.667c-.033-.41.06-.85-.114-1.041-.289-.314.338-.508-.03-.75-.578.446-.551 1.28-1.089 1.752-.38-.165-.752-.343-.935-.614-.308-.053-.35.146-.545.231-.58-.324-1.286-.583-1.708-1.165-.535-.738-1.039-1.526-1.035-2.503.002-.452.038-.907-.006-1.355-.147-1.477.306-2.843.75-4.21.185-.571.492-1.088.854-1.553.257-.158.523-.053.846-.092l.467.467c.316.04.37-.405.669-.46.183-.032.253.125.368.22l.256-.233.139.402c.052.074.092.052.161-.03.507-.603 1.194-.633 1.918-.574.461.296.731.811 1.393.971.682.165.961 1.277.647 1.96-.257.559-.57 1.073-.122 1.704.125.175.104.552.004.769-.277.594-.22 1.251-.43 1.854-.196.561-.31 1.152-.53 1.702-.067.167-.147.312-.157.5-.037.7-.447 1.247-.786 1.818-.216.365-.592.214-.985.23ZM50.532 50.867l.24.205.16-.439c.703.3 1.275-.207 1.916-.326.254-.048 1.214-.208 1.462-.185.07.007.176.064.203.037.301-.309.693-.158 1.036-.236.295-.068.555.397.834.02.56.463 1.216.132 1.823.212.37.049.75.01 1.118.01l.326.325c-.083.15-.3.238-.205.485.318.22.713-.004 1.054.139.315.277.478.572.109.93-.08.078-.206.146-.232.241-.244.883-1.007.922-1.7 1.035-.712.114-1.323.44-1.877.687-.293.772.149 1.372.162 2.026.013.61-.145 1.24.199 1.834.081.142.137.478-.076.621-.352.24-.316.776-.722.925-.182.067-.401.022-.615-.139-.204-.153-.027-.477-.32-.524-.23-.036-.34.146-.442.284-.171.231-.42.214-.607.152-.257-.085-.478-.277-.715-.423-.337.403-.592-.064-.762-.169-.236-.144-.51-.26-.723-.446-.226-.197-.426-.424-.642-.633a.833.833 0 0 1-.26-.462c-.03-.143-.179-.189-.044-.418.144-.247-.303-.054-.398-.317-.381-1.048-1.051-1.962-1.473-2.998a.843.843 0 0 1-.035-.616c.221-.735.55-1.395 1.206-1.837ZM54.604 84.51c-.975-.056-.975-.056-1.134-1.114-.564.526-.564.526-1.137.676-.161-.428-.384-.845-.984-.705-.082.02-.205-.057-.282-.121-.45-.381-.624-.994-1.119-1.34.024-.732-.473-1.449-.203-2.155.286-.75.358-1.557.768-2.28.502-.884 1.043-1.717 1.813-2.458.416.041.858.02 1.096-.462l.261.232c.735-.738.922-1.884 1.828-2.464.357-.171.568.287.825.194.337-.122.557.307.871.104.273-.177.557-.074.808-.05.262.344-.377.498-.104.81.202.042.307-.32.58-.106.159.745-.103 1.419-.386 2.133-.307.774-.735 1.539-.697 2.418.014.316-.204.524-.32.772-.345.729-.587 1.49-.864 2.24-.347.944-.451 1.976-1.014 2.857-.179.279-.387.515-.606.819ZM47.369 22.139c.195-.227-.03-.502.2-.66.324-.053.572.193.55.403-.085.78.432 1.132.934 1.524.148.114.268.262.401.396.207.461-.109.823-.233 1.222-.168.118-.353.046-.532.047-.18-.096 0-.493-.387-.433-.254.088-.35.462-.352.574a3.744 3.744 0 0 1-.487 1.842c.326.704-.208 1.307-.234 1.974-.027.706-.382 1.275-.852 1.79-.199.217-.415.087-.62.168.015-.387-.463-.509-.214-1.146-.407.444-.39.913-.765.881-.602-.05-1.297-.03-1.765-.33-.452-.291-1.258-.416-1.203-1.256a.255.255 0 0 0-.09-.184c-.863-.67-.928-1.721-1.252-2.64-.26-.737-.481-1.485-.477-2.291.001-.45.464-.787.215-1.227.252-.4.719-.59.792-1.172.917.755 1.82-.173 2.694.093.2-.099.12-.283.206-.41.151-.144.353-.007.347-.005.377-.135.166-.44.416-.482.122.072.084.193.092.312.23.265.566.014.83.156l.396.397c.386-.247.455-.685.655-1.097.273.145.41.336.382.662-.03.333-.05.681.353.892ZM53.912.885c.137.215.056.397.23.471.233-.243.007-.575.14-.86l.398-.04v1.088c.209-.643 1.139-.417 1.25-1.082.172.265.432.238.692.215.229-.158 0-.435.166-.62.241-.095.497-.046.757-.029.177.235.042.506.087.758.245.261.461.567.853.642-.112.184.034.478-.027.539-.272.273-.044.743-.454.96-.38.202.073.748-.326.986.433.474-.202.885-.073 1.381.117.451.025.957.025 1.41.2.1.213-.068.316-.106.3-.018.005.344.227.387.049-.033.129-.057.15-.107.277-.657.569-1.32.386-2.057-.192-.772-.24-.78.066-1.749.087-.275-.439-.367-.082-.641.198-.152-.076-.536.252-.685-.133-.233-.169-.52-.393-.702.043-.12.137-.128.247-.135.345-.019.564.128.636.467.061.285-.104.592.089.868.138.197-.102.468.13.668.056.047.056.277.001.319-.382.295-.075.545-.018.844.055.292.089.62-.108.96-.243.418-.07.888.116 1.34.104.255.33.106.434.261-.304.375-.178.8-.171 1.18.121.137.321.106.323.081.036-.337.464-.632.121-1.01.295-.26.502-.682 1.064-.53a4.844 4.844 0 0 1-.208.735c-.084.235-.224.445-.188.71.043.306-.328.484-.23.81.1.336-.186.364-.38.514-.196.15.044.561-.277.732.184.161.376.06.565.086.191-.253.054-.611.37-.873.466-.384.401-.446.692-1.547.105-.4.309-.774.479-1.186.521.38.44.872.242 1.344-.164.396-.251.814-.383 1.2-.123.362-.058.9-.56 1.127-.34.153-.276.67-.648.83-.123-.13-.238-.293-.537-.149l.424.526c-.3.181-.559.146-.776-.14-.388.604-1.206.419-1.613.912-.354-.01-.436-.319-.67-.468l-.138.401c-.153.105-.3-.35-.503.01-.058.104-.43.089-.633.036-.159-.042-.293-.215-.416-.349-.176-.192-.438.004-.626-.14.249-.37-.061-.61-.182-.878-.173-.386-.773-.014-.96-.62-.009-.05.32-.133.2-.306-.434-.635-.22-1.47-.665-2.1-.036-.05.023-.163-.011-.219-.238-.394.612-.781.005-1.17 0-.414-.104-.864.024-1.235.198-.573.194-1.14.2-1.721 0-.07-.024-.14-.041-.235-.221-.037-.275.183-.388.285-.08.07.05.287-.238.321-.006-.943-.157-1.89.566-2.715ZM31.878 76.44c-.009.193-.008.303.1.374.312.192.375-.418.7-.184.078.025.1.08.049.13-.258.259-.646.557-.308.914.39.412-.237.565-.115.866-.355.097-.64.521-1.074.235-.089-.06-.144-.176-.373-.12-.918.724-1.463 1.812-1.883 2.933-.143.385-.395.592-.598.88-1.34-.906-1.34-.906-1.83-.683-.412-.555-.83-1.114-.765-1.87.027-.314-.068-.565-.233-.809.388-.478.065-.938-.107-1.346-.217-.512-.024-1.023-.144-1.519-.015-.063-.1-.108-.172-.178.31-.492.44-1.104 1.035-1.5.501.098 1.093-.157 1.664.126.548.273 1.176.248 1.744.42.525.16.998.492 1.529.765.479-.099.762-.541 1.124-.857.683-.035 1.355-.284 1.773-.653.562-.117 1.181.159 1.71-.26l.456.594c-.926-.196-.877-.088-2.152.5-.787.36-1.268 1.144-2.13 1.242ZM62.335 27.374l.07-.617c.07-.102.109-.082.18.002.116.14.263.236.248.466-.026.413.006.829-.01 1.242-.014.335.009.661.233.92.333.385.172.832.236 1.23-.455.408-.618.875-.726 1.442-.111.578-.09 1.196-.397 1.752-.127.23-.02.588-.02.877-.237.243-.508.442-.557.789h-.47c-.244-.244.008-.582-.16-.85-.176-.077-.389-.124-.383.153.006.297-.523.302-.11.765-.81-.172-1.397-.402-1.955-.286-.33-.042-.123-.361-.412-.484-.801-.34-1.105-.96-1.159-1.782-.064-.997.18-1.929.457-2.865.213-.715.598-1.153 1.41-1.217.736-.059 1.06-.51 1.078-1.27.007-.297 0-.594 0-.88.229-.163.228.13.342.126.3.133.397-.383.726-.178.197.144-.064.43.14.602.048-.029.142-.057.142-.087.006-.328.34-.554.266-.917-.02-.098.178-.087.288-.091.21.122.116.327.127.499.013.183.003.367.003.487.108.197.236.12.413.172ZM76.219 53.438l-.478-.177c-.075-.177-.007-.284.09-.411.177-.228.19-.48-.05-.685-.445-.381-.37-.695.012-1.11.21-.23.38-.62.174-1.031.207-.309.451.182.562.075.27-.262.564-.132.846-.156.261-.022.526-.005.79-.005h.823c.25.325.587.635.747 1.018.116.275.23.59.31.895.094.356-.428.503-.123.883.17.213.078.635.105.963.523.428 1.41.124 1.754.897l-.185.184c.123.186.44.172.507.493.035.17.082.517.342.626l-.268.558c-.047-.028-.136-.053-.14-.088-.018-.147.03-.315-.025-.443s-.201-.217-.306-.322c-.178.063-.097.242-.17.373-.255-.04-.545-.435-.753.13l-.2-.526c-.162.015-.405-.036-.503.06-.496.486-1.102.9-1.358 1.575-.197.516-.606.786-.96 1.15-.342-.222-.326-.494-.174-.685.192-.244.193-.452.052-.761-.206.228-.447.409-.567.65-.135.276-.234.521-.587.5-.227-.263-.024-.59-.129-.857-.292-.008-.167.187-.21.31-.276.195-.552.173-.755-.11-.165-.23-.226-.529-.483-.704-.19-.13-.158-.377-.096-.512.311-.672.428-1.404.641-2.103.121-.398.366-.492.765-.654ZM17.405 76.827c-.226.005-.258-.251-.454-.31l.232-.258a.244.244 0 0 0-.28-.11c-.255.072-.319.41-.628.452-.327-.02-.487-.358-.777-.506-.742-.378-1.162-1.83-.91-2.659.198-.643.19-1.276-.066-1.998.021-.102.206-.001.327-.073.254-.326-.03-.584-.153-.868.08-.318.41-.421.547-.685.335.281.634.425 1.095.257.405-.148.58.323.838.54l-.199.248c.29.24.434.007.562-.154.243-.302.159-.826.704-.944.175-.038.058-.337.072-.515.026-.349.227-.507.524-.566.32.161.004.53.27.688.522-.381.287-1.236 1.033-1.595-.211.738-.453 1.388-.574 2.06-.122.676-.801 1.211-.485 2.085.432-.862.658-1.71.96-2.538a2.16 2.16 0 0 1-.122 1.344c-.373.897-.62 1.847-.926 2.772-.165.494-.326.992-.53 1.47-.054.13-.13.235-.155.39-.13.811-.18.877-.905 1.473Z"
                                    clip-rule="evenodd" />
                            </svg></div>
                        <div class="gallery-wrapper me-lg-70" data-show="startbox">
                            <!-- Gallery item--><a class="gallery-item rounded-4 overflow-hidden"
                                href="theme4/assets/img/home-1-900x990.jpg" style="--img-height: 110%;"
                                data-img-height>
                                @if($user->image_1 !== null )
                                <img src="{{ asset('website_images/'.$user->image_2) }}" alt=""
                                    style='border-radius:15px' class="img-fluid w-100">
                                @else
                                <img loading="lazy" src="{{ asset('theme4/assets/img/home-1-900x990.jpg')}}" alt="">
                                @endif
                               
                            
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6"><span class="badge bg-light text-dark mb-20"
                            data-show="startbox">Clients</span>
                        <h3 class="mb-30" data-show="startbox" data-show-delay="100"><span class="highlight">{{ $user->heading_2 ?? "Explore a World of Convenience" }}</span></h3>
                        <p class="mb-45 me-lg-70" data-show="startbox" data-show-delay="200">{{ $user->subheading_2 ?? "Simplify Your Digital Transactions" }}.</p>
                        <div data-show="startbox" data-show-delay="300">
                            <!-- Button--><a class="btn btn-accent-1 btn-link btn-clean" href="#" target="_self">Learn
                                more</a>
                        </div>
                        {{-- //sponsors here --}}
                        {{-- <div class="row mt-50 g-15 flex-nowrap">
                            <div class="col" data-show="startbox" data-show-delay="400">
                                <!-- Brand--><a class="brand rounded-2 bg-gray-light text-dark brand-sm" href="#">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg" width="74" height="20" fill="none">
                                        <path fill="currentColor"
                                            d="M3.875 3.874V5.44c.69-1.12 1.789-1.68 3.298-1.68 1.25 0 2.261.407 3.035 1.221.774.815 1.162 1.922 1.162 3.322v6.223H8.051V8.742c0-.687-.185-1.219-.556-1.594-.37-.375-.881-.563-1.532-.563-.65 0-1.161.188-1.532.563-.37.375-.556.907-.556 1.594v5.784H.538V3.874h3.337ZM20.64 11.148c.48-.459.722-1.107.722-1.948 0-.84-.241-1.485-.722-1.937-.482-.451-1.035-.678-1.66-.678-.624 0-1.177.23-1.659.687-.48.458-.721 1.108-.721 1.947 0 .84.24 1.487.721 1.938.482.452 1.035.678 1.66.678.624 0 1.177-.229 1.659-.687Zm-5.992 1.985c-.963-1.018-1.444-2.323-1.444-3.914 0-1.59.48-2.898 1.444-3.922.962-1.025 2.137-1.537 3.523-1.537 1.385 0 2.45.503 3.19 1.508V3.874H24.7v10.653h-3.338V12.98c-.807 1.12-1.887 1.68-3.24 1.68-1.353 0-2.512-.51-3.474-1.528ZM32.057 11.759h1.19v2.767H31.55c-1.224 0-2.17-.263-2.84-.792-.67-.528-1.005-1.434-1.005-2.72V6.585H26.69v-2.71h1.015V1.277h3.338v2.596h2.185v2.711h-2.185v4.43c0 .495.337.744 1.014.744ZM42.733 3.874h3.337v10.652h-3.337v-1.565c-.69 1.12-1.79 1.68-3.299 1.68-1.249 0-2.261-.407-3.035-1.222-.774-.814-1.16-1.921-1.16-3.322V3.875h3.316V9.66c0 .687.187 1.218.557 1.593.37.377.882.564 1.532.564s1.162-.188 1.532-.564c.37-.375.556-.906.556-1.593V3.874ZM52.139 3.874V5.86c.78-1.399 1.821-2.1 3.122-2.1v3.322h-.819c-.768 0-1.343.179-1.727.535-.384.356-.576.98-.576 1.87v5.04h-3.337V3.874h3.337ZM63.517 11.148c.48-.459.722-1.107.722-1.948 0-.84-.241-1.485-.722-1.937-.482-.451-1.034-.678-1.66-.678-.624 0-1.177.23-1.658.687-.481.458-.722 1.108-.722 1.947 0 .84.24 1.487.722 1.938.481.452 1.034.678 1.659.678s1.178-.229 1.659-.687Zm-5.992 1.985c-.963-1.018-1.444-2.323-1.444-3.914 0-1.59.481-2.898 1.444-3.922.963-1.025 2.137-1.537 3.524-1.537 1.385 0 2.449.503 3.19 1.508V3.874h3.338v10.653h-3.338V12.98c-.807 1.12-1.887 1.68-3.24 1.68-1.353 0-2.51-.51-3.474-1.528ZM70.309 14.526V.4h3.337v14.126h-3.337ZM4.135 16.391v3.205h-.538V17.4l-.999 2.195h-.372L1.222 17.4v2.195H.684V16.39h.58l1.15 2.513 1.145-2.513h.576ZM7.857 19.596V16.39h.538v3.205h-.538ZM14.272 16.387h.537v3.209h-.537l-1.617-2.393v2.393h-.537v-3.209h.537l1.617 2.388v-2.388ZM20.341 16.387v.41H19.07v.973H20.2v.405H19.07v1.01h1.273v.41h-1.81v-3.208h1.81ZM24.555 16.801v1.084h.594c.204 0 .357-.048.458-.143.1-.095.15-.228.15-.399 0-.17-.05-.304-.15-.398-.101-.095-.254-.144-.458-.144h-.594Zm0 1.495v1.3h-.536V16.39h1.13c.371 0 .657.09.858.27.2.18.301.408.301.685a.923.923 0 0 1-.2.58c-.133.173-.34.285-.615.337l.867 1.333h-.655l-.82-1.3h-.33ZM30.761 18.53h1.08l-.538-1.507-.542 1.507Zm1.462 1.066-.236-.655h-1.371l-.236.655h-.56l1.172-3.209h.623l1.173 3.209h-.565ZM36.313 16.391h.538v2.803h1.108v.402h-1.646V16.39ZM49.542 16.391h.575l-.97 3.205h-.609l-.688-2.426-.73 2.426-.603.004-.93-3.209h.571l.679 2.61.735-2.61h.603l.683 2.596.684-2.596ZM54.326 18.53h1.079l-.537-1.507-.542 1.507Zm1.46 1.066-.235-.655H54.18l-.235.655h-.561l1.173-3.209h.622l1.174 3.209h-.565ZM59.708 16.801v-.41h2.285v.41h-.87v2.795h-.538V16.8h-.877ZM67.362 16.387v.41h-1.273v.973h1.131v.405H66.09v1.01h1.273v.41h-1.81v-3.208h1.81ZM71.575 16.801v1.084h.594c.204 0 .356-.048.457-.143a.522.522 0 0 0 .15-.399c0-.17-.05-.304-.15-.398-.101-.095-.254-.144-.457-.144h-.594Zm0 1.495v1.3h-.537V16.39h1.13c.371 0 .657.09.858.27.201.18.302.408.302.685a.92.92 0 0 1-.2.58c-.134.173-.34.285-.615.337l.867 1.333h-.655l-.82-1.3h-.33Z" />
                                    </svg></a>
                            </div>
                            <div class="col" data-show="startbox" data-show-delay="500">
                                <!-- Brand--><a class="brand rounded-2 bg-gray-light text-dark brand-sm" href="#"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="67" height="34" fill="none">
                                        <path fill="currentColor"
                                            d="M17.87 15.346 9.932 3.963v6.614c0 1.696.105 4.579 3.18 4.579v.19H6.415v-.19c2.907 0 3.327-2.905 3.327-4.58V3.71l-.99-1.42C7.49.613 6.669.634 6.123.591V.423h6.716l7.159 10.409v-5.66c0-1.972-.674-4.58-3.011-4.58V.423h6.38v.17c-2.611 0-3.18 2.607-3.18 4.578v10.175H17.87M36.586 11.192v4.154H24.29v-.19c.885 0 1.222-1.272 1.222-2.714V3.348c0-1.314-.295-2.756-1.222-2.756V.423h12.023v4.345h-.189c0-4.133-5.749-4.154-5.749-4.154h-.757v7.1h1.705c.021 0 2.253.065 2.485-2.5h.19v5.193h-.19c-.232-2.543-2.464-2.501-2.485-2.501h-1.705v7.25h.757s6.022.233 6.022-3.964h.19M61.832.423v.17c-.843 0-2.127.656-3.664 4.387l-3.685 10.366h-.758c-1.958-4.6-3.221-7.567-4.063-9.497l-3.37 9.497h-.758C40.228 2.86 39.954 2.31 39.954 2.31 39.238.614 38.944.635 38.397.592V.423h6.569v.17c-1.348 0-.274 2.458-.274 2.458l3.18 7.272 1.684-4.728a319.075 319.075 0 0 0-1.41-3.285C47.428.614 47.133.635 46.585.592V.423h6.57v.17c-1.347 0-.273 2.458-.273 2.458l3.159 7.293 1.894-5.364C58.463 3.476 58 .592 55.851.592V.423h5.981M23.987 18.8v.169c-.843 0-2.128.657-3.665 4.388l-3.684 10.366h-.759c-1.958-4.6-3.22-7.568-4.064-9.497l-3.369 9.497h-.758c-5.305-12.486-5.58-13.037-5.58-13.037-.715-1.695-1.01-1.674-1.557-1.717v-.17h6.57v.17c-1.349 0-.275 2.459-.275 2.459l3.18 7.271 1.684-4.728a318.702 318.702 0 0 0-1.41-3.285c-.717-1.695-1.01-1.674-1.559-1.717v-.17h6.57v.17c-1.348 0-.274 2.459-.274 2.459l3.158 7.292 1.895-5.363c.527-1.505.064-4.388-2.084-4.388v-.17h5.98ZM28.28 24.65l-1.873 4.77h3.979l-2.105-4.77Zm2.127-5.85h.106c5.327 12.295 5.684 12.994 5.684 12.994.758 1.696 1.475 1.717 1.895 1.76v.17h-7.369v-.17c1.685 0 .421-2.48.421-2.48l-.674-1.463h-4.127c-.421.976-.042 3.943 2.485 3.943v.17h-6.064v-.17c.631-.043 1.768-.212 3.39-3.943L30.407 18.8M52.935 18.8v.17c-.905 0-2.253.656-3.895 4.387l-4.148 10.366h-.61c-5.644-12.486-5.939-13.036-5.939-13.036-.758-1.696-1.074-1.675-1.663-1.718V18.8h7.011v.17c-1.453 0-.294 2.458-.294 2.458l3.264 7.313 2.169-5.384c.631-1.568.252-4.388-2.275-4.388V18.8h6.38M66.303 29.57v4.153H54.006v-.19c.885 0 1.222-1.273 1.222-2.714v-9.094c0-1.314-.296-2.756-1.222-2.756V18.8h12.023v4.345h-.19c0-4.133-5.748-4.154-5.748-4.154h-.758v7.101h1.706c.021 0 2.253.064 2.484-2.502h.19v5.194h-.19c-.23-2.543-2.463-2.502-2.484-2.502h-1.706v7.25h.758s6.022.234 6.022-3.963h.19" />
                                    </svg></a>
                            </div>
                            <div class="col" data-show="startbox" data-show-delay="600">
                                <!-- Brand--><a class="brand rounded-2 bg-gray-light text-dark brand-sm" href="#"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="70" height="39" fill="none">
                                        <path fill="currentColor"
                                            d="M4.545 14.568v3.63h2.297c.563 0 1.007-.163 1.332-.493.324-.33.487-.763.487-1.3s-.166-.978-.498-1.322c-.333-.344-.773-.515-1.321-.515H4.545Zm0 6.423v5.864H.842v-15.08h6c1.76 0 3.133.452 4.115 1.354.982.902 1.473 1.991 1.473 3.265 0 .874-.267 1.726-.801 2.557-.535.83-1.408 1.417-2.621 1.76l3.726 6.145H8.4L4.979 20.99h-.434M24.3 11.733v2.792h-5.502v3.243h4.852v2.793h-4.852v3.502H24.3v2.793h-9.206V11.732H24.3M26.229 14.568v-2.792h11.999v2.792h-4.16v12.287h-3.702V14.568h-4.137ZM43.924 14.568v3.63h2.297c.562 0 1.006-.163 1.332-.493.324-.33.486-.763.486-1.3s-.166-.978-.497-1.322c-.333-.344-.773-.515-1.321-.515h-2.297Zm0 6.423v5.864h-3.703v-15.08h6c1.76 0 3.133.452 4.115 1.354.982.902 1.473 1.991 1.473 3.265 0 .874-.267 1.726-.801 2.557-.535.83-1.41 1.417-2.622 1.76l3.726 6.145H47.78l-3.423-5.865h-.433M64.293 22.43c.73-.787 1.094-1.839 1.094-3.157 0-1.317-.365-2.37-1.094-3.158-.729-.787-1.704-1.182-2.924-1.182s-2.195.395-2.924 1.182c-.73.788-1.093 1.84-1.093 3.158 0 1.318.364 2.37 1.093 3.157.73.789 1.703 1.182 2.924 1.182 1.22 0 2.195-.393 2.924-1.181Zm-8.447 2.384c-1.51-1.46-2.264-3.307-2.264-5.54 0-2.235.755-4.079 2.264-5.532 1.508-1.455 3.358-2.181 5.545-2.181s4.029.726 5.523 2.18c1.495 1.454 2.242 3.298 2.242 5.532s-.751 4.08-2.252 5.541c-1.503 1.461-3.344 2.192-5.524 2.192s-4.026-.73-5.534-2.192M23.209 2.31V.74h6.749v1.57h-2.34v6.91h-2.082V2.31h-2.327ZM36.46.74h2.083v8.48H36.46V5.705h-3.3V9.22h-2.084V.74h2.084v3.394h3.3V.74ZM45.426.715v1.571H42.33v1.825h2.73v1.57h-2.73V7.65h3.095v1.57h-5.178V.715h5.178ZM11.949 34.51a.516.516 0 0 0-.343.111c-.089.074-.133.179-.133.316a.46.46 0 0 0 .123.334c.083.084.191.148.323.193.133.046.28.089.444.13.162.04.324.09.484.148.161.058.308.13.44.216.133.087.24.208.323.366.083.157.123.345.123.565 0 .384-.157.711-.472.986-.314.273-.73.41-1.245.41-.514 0-.928-.123-1.243-.37-.315-.245-.472-.593-.472-1.046h1.185c.03.362.217.543.56.543.16 0 .287-.042.378-.126a.413.413 0 0 0 .137-.32.429.429 0 0 0-.124-.317.89.89 0 0 0-.322-.193 5.178 5.178 0 0 0-.443-.132 4.407 4.407 0 0 1-.486-.152 2.4 2.4 0 0 1-.44-.217.917.917 0 0 1-.321-.362 1.18 1.18 0 0 1-.124-.558c0-.423.158-.76.475-1.015.316-.254.722-.38 1.215-.38.492 0 .892.11 1.196.332.303.221.462.572.475 1.05H12.45a.605.605 0 0 0-.16-.378.462.462 0 0 0-.341-.133M18.47 34.543v-.84h3.609v.84h-1.25v3.695h-1.114v-3.695H18.47ZM26.895 36.411v-2.707h1.113v2.707c0 .271.067.48.201.626.136.146.333.22.593.22.261 0 .46-.074.6-.22.139-.146.208-.355.208-.626v-2.707h1.114v2.707c0 .4-.094.746-.283 1.036-.188.291-.428.503-.716.637-.29.134-.603.2-.942.2-.53 0-.978-.163-1.342-.49-.365-.328-.546-.788-.546-1.383M36.958 37.399h.494c.426 0 .761-.129 1.004-.388.243-.258.365-.605.365-1.04 0-.435-.122-.782-.365-1.04-.243-.259-.578-.388-1.004-.388h-.494V37.4Zm.494-3.695c.73 0 1.33.209 1.798.63.47.42.704.964.704 1.634 0 .669-.234 1.215-.704 1.638-.468.422-1.068.632-1.798.632h-1.608v-4.534h1.608ZM44.826 38.238v-4.534h1.115v4.534h-1.115ZM54.042 36.908c.22-.237.33-.554.33-.95 0-.396-.11-.712-.33-.95-.219-.236-.512-.355-.88-.355-.366 0-.66.119-.878.356-.22.236-.33.553-.33.95 0 .395.11.712.33.949.219.237.512.356.879.356s.66-.119.88-.356Zm-2.54.717c-.455-.44-.682-.995-.682-1.667 0-.671.227-1.226.681-1.663.454-.437 1.01-.656 1.668-.656.659 0 1.212.22 1.661.656.45.437.675.992.675 1.663 0 .672-.226 1.228-.678 1.667-.452.44-1.005.66-1.661.66-.655 0-1.21-.22-1.665-.66Z" />
                                    </svg></a>
                            </div>
                            <div class="col" data-show="startbox" data-show-delay="700">
                                <!-- Brand--><a class="brand rounded-2 bg-gray-light text-dark brand-sm" href="#"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="73" height="29" fill="none">
                                        <path fill="currentColor"
                                            d="M.281 19.145V2.939h4.071v16.206H.282ZM8.554 17.506c-1.23-1.2-1.845-2.8-1.845-4.801 0-2.001.615-3.598 1.845-4.79 1.23-1.193 2.821-1.79 4.773-1.79 1.619 0 2.992.39 4.118 1.166 1.127.778 1.873 1.89 2.238 3.336H15.28c-.38-.77-1.004-1.154-1.868-1.154-.866 0-1.508.296-1.929.888-.42.592-.63 1.374-.63 2.344 0 .97.21 1.75.63 2.343.42.592 1.036.889 1.845.889.508 0 .905-.086 1.19-.254.286-.169.54-.47.762-.9h4.404c-.365 1.385-1.119 2.485-2.261 3.3-1.143.816-2.508 1.223-4.095 1.223-1.952 0-3.543-.6-4.773-1.8M29.706 15.105c.54-.553.81-1.354.81-2.4 0-1.047-.278-1.844-.833-2.39-.556-.546-1.215-.82-1.977-.82-.761 0-1.416.274-1.963.82-.548.546-.821 1.343-.821 2.39 0 1.046.281 1.847.844 2.4.563.555 1.226.832 1.988.832s1.412-.277 1.952-.832Zm-6.915 2.378c-1.342-1.215-2.012-2.816-2.012-4.802 0-1.985.667-3.574 2-4.767 1.333-1.192 2.984-1.789 4.951-1.789 1.968 0 3.615.597 4.94 1.79 1.325 1.192 1.988 2.78 1.988 4.766 0 1.986-.659 3.587-1.976 4.802-1.317 1.216-2.96 1.823-4.928 1.823s-3.623-.607-4.963-1.823M41.108 6.264v1.892c.841-1.354 2.182-2.031 4.023-2.031 1.524 0 2.758.492 3.703 1.477.943.986 1.415 2.325 1.415 4.017v7.526h-4.046V12.15c0-.83-.226-1.473-.678-1.928-.453-.453-1.077-.681-1.87-.681-.794 0-1.416.228-1.868.681-.453.455-.679 1.097-.679 1.928v6.995h-4.07V6.264h4.07ZM53.462 19.145V6.264h4.072v12.881h-4.072ZM57.176 4.81c-.46.446-1.023.669-1.69.669s-1.23-.223-1.69-.67a2.211 2.211 0 0 1-.69-1.65c0-.654.23-1.205.69-1.651.46-.446 1.023-.67 1.69-.67s1.23.224 1.69.67c.46.446.69.997.69 1.65 0 .654-.23 1.205-.69 1.652ZM61.736 17.506c-1.23-1.2-1.845-2.8-1.845-4.801 0-2.001.615-3.598 1.845-4.79 1.23-1.193 2.82-1.79 4.773-1.79 1.618 0 2.991.39 4.118 1.166 1.127.778 1.873 1.89 2.238 3.336h-4.404c-.381-.77-1.004-1.154-1.868-1.154-.866 0-1.508.296-1.928.888-.422.592-.632 1.374-.632 2.344 0 .97.21 1.75.632 2.343.42.592 1.035.889 1.844.889.508 0 .905-.086 1.19-.254.286-.169.54-.47.762-.9h4.404c-.365 1.385-1.119 2.485-2.261 3.3-1.143.816-2.508 1.223-4.095 1.223-1.952 0-3.543-.6-4.773-1.8M17.41 24.848v3.28h-.823v-1.85l-.786 1.85h-.612l-.785-1.85v1.85h-.824v-3.28h.944l.974 2.262.969-2.262h.944ZM22.39 24.84v.607h-1.224v.705h1.079v.608h-1.08v.761h1.225v.608h-2.048v-3.29h2.048M27.507 24.84h.824v3.289h-.824l-1.379-2.07v2.07h-.823v-3.29h.823l1.379 2.07v-2.07ZM32.406 25.432a.39.39 0 0 0-.253.08.276.276 0 0 0-.099.229c0 .1.031.18.092.24.06.061.14.108.239.14a4 4 0 0 0 .327.095c.12.029.24.064.36.107.118.041.226.094.324.156a.69.69 0 0 1 .239.264c.061.114.091.25.091.409 0 .277-.116.515-.35.712-.232.199-.539.298-.92.298-.38 0-.687-.089-.92-.267-.232-.178-.349-.43-.349-.757h.878c.022.262.16.392.414.392.118 0 .212-.03.279-.091a.296.296 0 0 0 .101-.23c0-.095-.03-.17-.092-.23a.647.647 0 0 0-.238-.14 3.687 3.687 0 0 0-.328-.096 3.44 3.44 0 0 1-.359-.11 1.833 1.833 0 0 1-.325-.156.67.67 0 0 1-.238-.261.842.842 0 0 1-.091-.405c0-.305.116-.55.35-.734.235-.184.535-.275.9-.275.364 0 .659.08.884.24.224.161.342.413.352.76h-.896a.43.43 0 0 0-.119-.273.346.346 0 0 0-.253-.097M40.338 24.848h.887l-.944 3.28h-.945l-.592-2.079-.588 2.08h-.945l-.959-3.28h.882l.588 2.36.602-2.36h.935l.578 2.321.501-2.322M45.877 24.84v.607h-1.225v.705h1.08v.608h-1.08v.761h1.225v.608h-2.049v-3.29h2.049M49.745 26.97h.8l-.4-1.168-.4 1.168Zm1.195 1.159-.188-.551h-1.215l-.187.55h-.877l1.175-3.288h1.003l1.17 3.289h-.881ZM55.257 25.456v.79h.51a.403.403 0 0 0 .297-.108.38.38 0 0 0 .109-.283.388.388 0 0 0-.11-.287.393.393 0 0 0-.295-.112h-.511Zm0 1.397v1.276h-.823v-3.28h1.334c.392 0 .697.097.915.293a.922.922 0 0 1 .328.711c0 .19-.06.375-.178.556-.119.18-.313.308-.583.384l.829 1.336h-.964l-.762-1.276h-.096" />
                                    </svg></a>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div><!-- Call to action-->
        <div class="position-relative">
            <div class="half-section-block container position-absolute top-50 start-0 end-0" data-prev-id=".footerPrev"
                data-next-id=".footerNext">
                <div class="shape-parent">
                    <div class="pt-120 pb-130 px-30 position-relative rounded-4 overflow-hidden z-index-1">
                        <div class="background">
                            <div class="background-image jarallax" data-jarallax data-speed="0.8"><img
                                    class="jarallax-img" loading="lazy"
                                    src="{{ asset('theme4/assets/img/root/call-to-action-1920x1080.jpg')}}" alt=""></div>
                            <div class="background-color" style="--background-color: #481FA0; opacity: .9;"></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 offset-lg-3 text-center">
                                <h2 class="mb-25 text-white" data-show="startbox">Have a question?</h2>
                               
                                <div data-show="startbox" data-show-delay="200">
                                    <!-- Button--><a class="btn btn-accent-1" href='https://wa.me/234{{ substr($user->phone,1) }}'
                                        target="_self">Get In Touch<svg class="ms-15 align-self-center"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 15 15">
                                            <path fill="currentColor"
                                                d="M15 11.23v2.259a1.501 1.501 0 0 1-1.026 1.432c-.199.067-.41.092-.619.073a14.944 14.944 0 0 1-6.508-2.31A14.692 14.692 0 0 1 2.32 8.166 14.877 14.877 0 0 1 .006 1.641 1.503 1.503 0 0 1 .9.13 1.51 1.51 0 0 1 1.507 0H3.77a1.51 1.51 0 0 1 1.508 1.295c.095.722.273 1.432.528 2.115a1.503 1.503 0 0 1-.34 1.588l-.957.956a12.055 12.055 0 0 0 4.525 4.516l.958-.956a1.51 1.51 0 0 1 1.591-.338 9.7 9.7 0 0 0 2.12.527 1.509 1.509 0 0 1 1.296 1.527Z" />
                                        </svg></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Footer-->
    <footer class="bg-dark text-white pt-120 pb-100 footerNext">
        <div class="container">
            <div class="row gy-50">
                <div class="col-12 col-lg-3"><a class="d-block mb-30" href="#">
                    <img class="rounded-circle header-profile-user"
                    src="{{ asset('brand_images/'.$user->logo) }}" style='width:50px;height:50px' />
                    
                </a>
                    <ul class="nav text-white align-items-center mb-20 nav-gap-md nav-no-opacity">
                        <li class="nav-item"><a class="nav-link" href="{{ $user->facebook }}"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="8" height="17" fill="none">
                                    <path fill="currentColor"
                                        d="M6.318 2.8h1.391V.202A16.842 16.842 0 0 0 5.683.088c-2.006 0-3.38 1.353-3.38 3.837v2.287H.089v2.902h2.214v7.303h2.713V9.114H7.14l.338-2.902H5.016v-2c0-.839.21-1.413 1.302-1.413Z" />
                                </svg></a></li>
                       
                        <li class="nav-item"><a class="nav-link" href="{{ $user->twitter }}"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="20" height="16" fill="none">
                                    <path fill="currentColor"
                                        d="M17.477 4.484c.012.165.012.329.012.493 0 5.014-3.817 10.792-10.792 10.792-2.149 0-4.145-.623-5.824-1.703.305.035.599.047.916.047a7.596 7.596 0 0 0 4.709-1.62 3.8 3.8 0 0 1-3.547-2.63c.235.034.47.058.717.058.34 0 .68-.047.998-.13A3.793 3.793 0 0 1 1.625 6.07v-.047a3.82 3.82 0 0 0 1.714.482 3.79 3.79 0 0 1-1.691-3.159c0-.704.188-1.35.517-1.914a10.781 10.781 0 0 0 7.82 3.97 4.282 4.282 0 0 1-.094-.87c0-2.09 1.691-3.793 3.793-3.793 1.092 0 2.079.458 2.771 1.198a7.466 7.466 0 0 0 2.408-.916c-.282.88-.881 1.62-1.668 2.09a7.604 7.604 0 0 0 2.184-.587 8.153 8.153 0 0 1-1.902 1.961Z" />
                                </svg></a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ $user->instagram }}"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="17" height="17" fill="none">
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
                                <li class="nav-item"><a class="nav-link" href="tel:{{ $user->phone }}">{{ $user->phone }}</a></li>
                              
                                <li class="nav-item"><a class="nav-link"
                                        href="mailto:{{ $user->email }}">{{ $user->email }}</a></li>
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