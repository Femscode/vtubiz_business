<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
	<title>{{ $giveaway->name }}</title>
	<meta charset="utf-8" />
	<meta name="description" content="Fun Giveaway By VTUBIZ" />
	<meta name="keywords" content="Fun Giveaway By VTUBIZ" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="shortcut icon" href="https://cttaste.com/assets/img/fav_01.png">

	<link rel="shortcut icon" href="assets/img/logo-01.png" />
	<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{ asset('homepage/style.css') }}">
	<link rel="stylesheet" href="{{ asset('cdn/bootstrap.min.css')}}">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Cabin:wght@700&family=Mooli&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Grandstander:wght@700&display=swap" rel="stylesheet">

	<style>
        body {
            text-align:center;
        }
		.bg {
			animation: slide 1s ease-in-out infinite alternate;
			background-image: linear-gradient(-90deg, #ebab21 35%, #e9ebee 50%);
			bottom: 0;
			left: -50%;
			opacity: .5;
			position: fixed;
			right: -50%;
			top: 0;
			z-index: -1;
		}

		.card-name-sticker {
			position: absolute;
			top: 0;
			left: 0;
			background-color: #ebab21;
			color: #640f11;
			padding: 4px 8px;
			font-size: 12px;
			border-top-left-radius: 4px;
			border-bottom-right-radius: 4px;

		}

		.card-bottom-right-sticker {
			position: absolute;
			bottom: 0;
			right: 0;
			padding: 4px 8px;
			font-size: 12px;
			border-top-left-radius: 4px;
			border-bottom-right-radius: 4px;

		}


		.bg2 {
			animation-direction: alternate-reverse;
			animation-duration: 2s;
		}

		.bg3 {
			animation-duration: 2s;
		}

		@keyframes slide {
			0% {
				transform: translateX(-25%);
			}

			100% {
				transform: translateX(25%);
			}
		}
	</style>
</head>

<body id="kt_body" style='background-color:#fff;background-repeat:repeat;background-size:cover;background-position:center center;background-image: url({{ asset("assets/img/ubg5.jpg")}})'
	class="header-tablet-and-mobile-fixed aside-fixed aside-secondary-disabled">


	<div>
		<header class="">
			<div class="container">



				<nav>
                    <br><br>
					<div class='m-4'>
						<a href="#">
							{{-- <i class="fa fa-mobile-alt"></i> --}}
							<img src="{{ asset('assets/img/logo/vtulogo.png')}}" width="200" height='50' alt='logo' class='lazyload'>
						</a>
					</div>
					
				</nav>
				<div class="animate__animated animate__swing rounded hero-text">
					{{-- <img src='assets/img/frontal.avif' style='width:200px;height:150px' /> --}}
					@if(Session::has('message'))
					<div class='alert alert-danger'>
						{{ Session::get('message') }}
					</div>
					@endif
					<h1 class="bold-place;"><span class="bold-place" style="font-family: 'Grandstander', cursive;color:black">{{ $giveaway->name }}</span></h1>
                    <h4 style="font-family: 'Grandstander', cursive;color:black">Enjoy a giveaway of <span style='color:#FF0000'>{{ $giveaway->winner_price }} of Data</span> from {{ $giveaway->user->name }}!</h4>
					<br><div class='mt-4 col-md-12'>
						<label style='background:#fff3cd;color:#856404;border-left-color:#856404;border-left-width:5px'
							{{--
							class="btn btn-outline btn-warning-dashed btn-outline-default p-7 d-flex align-items-center mb-0"
							--}} class="btn btn-outline btn-warning-dashed btn-outline-default align-items-center mb-0"
							for="kt_modal_two_factor_authentication_option_1">


							<span class="d-block text-start">
								<!--<span class="fw-bolder d-block fs-3" style='color:#721c24'>NOTICE !!!</span>-->
								<span class="fs-6" style='color:#856404'>
									Input your name and phone number to continue
									<br>
									<div class='col-md-12'>
										<form action='/saveGiveAwayContacts' method='post'>@csrf


											<div class="mt-2">
                                                <input type='hidden' name='user_id' value='{{ $userId }}'/>
                                                <input type='hidden' name='giveaway_id' value='{{ $giveaway->id }}'/>
												<input required class='m-2 form-control shadow-none'
													type="text" name='name' placeholder="Enter name">
												<input required class='m-2 form-control shadow-none' id='search_changeschool'
													type="number" name='phone' placeholder="09000000000">
												<div class="m-2 input-group-append">
													<button type='submit'
														style='border:0px solid #fff;background:#856404'
														class="btn btn-primary m-auto" type="button">Enter Contest <i
                                                        class='fa fa-arrow-right text-white'></i></button>
												</div>
											</div>
										</form>
									</div>


								</span>
							</span>
						</label><br><br><br>
						<h4 class="bold-place;"><span class="bold-place" style="font-family: 'Grandstander', cursive">
							This giveaway have a maximum number of {{ $giveaway->part_no }} participant, join now to be amoung the {{ $giveaway->no_of_winners }} lucky winners.🎉🎉 </span></h4><br><br><br><br><br><br><br><br><br><br><br>
					</div>
					{{-- <img src='assets/img/frontal.avif' style='width:300px;height:200px' /> --}}

					{{-- <img style='width:100%;margin:0' src='/assets/img/cfonfetti.png' alt='playing emojis' />
					--}}

					</form>
				</div>
			</div>


		</header>



	</div>

	<!--begin::Javascript-->
	<script>
		var hostUrl = "assets/index.html";
	</script>
	<!--begin::Global Javascript Bundle(used by all pages)-->
	<script src="assets/plugins/global/plugins.bundle.js"></script>
	<script src="assets/js/scripts.bundle.js"></script>

	<script src="assets/js/custom/modals/select-location.html"></script>
	<script src="assets/js/widgets.bundle.js"></script>
	<script src="assets/js/custom/widgets.js"></script>
	<script src="assets/js/custom/apps/chat/chat.js"></script>
	<script src="assets/js/custom/intro.js"></script>
	<script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>
	<script src="assets/js/custom/utilities/modals/select-location.js"></script>
	<script src="assets/js/custom/utilities/modals/users-search.js"></script>
	<script src="assets/js/lazysizes.min.js" async></script>

	{{-- <script src='/assets/js/professionallocker.js'></script> --}}
	
</body>

</html>