@extends('newdashboard.master')
@section('header')
@endsection
@section('content')

<div class="app-wrapper  flex-column flex-row-fluid " id="kt_app_wrapper">

  


    <!--begin::Wrapper container-->
    <div class="app-container  container-xxl ">



        <!--begin::Main-->
        <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
            <!--begin::Content wrapper-->
            <div class="d-flex flex-column flex-column-fluid">


                <!--begin::Content-->
                <div id="kt_app_content" class="app-content  flex-column-fluid ">
                    <!--begin::Row-->
                    <div class="row g-5 g-xl-8">
                        <!--begin::Col-->
                      
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-xl-12 ps-xl-12">
                            <div class='card p-4 mb-4'>
                              

                                <form action='{{ route("reset_withdrawal") }}' method='post'> @csrf
                                    <div class="widget-content col-md-12">

                                        <p class="">Token</p>
                                        <div class="input-group mb-4">

                                            <input readonly placeholder="*******" maxlength="7" required type="text"
                                                name='token' class="form-control" value='{{ $token ?? "" }}'
                                                aria-label="Current Password">

                                        </div>
                                        <p class="">Enter Pin</p>
                                        <div class="input-group mb-4">

                                            <input required type="password" maxlength="4" name='new_pin'
                                                id='new_password' class="form-control" placeholder="****"
                                                aria-label="New Password">


                                        </div>
                                        <p class="">Confirm Pin</p>
                                        <div class="input-group mb-4">

                                            <input required type="password" maxlength="4" name='confirm_pin'
                                                id='new_password' class="form-control" placeholder="****"
                                                aria-label="New Password">


                                        </div>


                                    


                                        <div class='mb-4 p-2'>
                                            <button id='sub_btn' type="submit"
                                                class="btn btn-primary float-right">
                                                Submit
                                            </button>
                                        </div>




                                    </div>
                                </form>
                            </div>
                          
                            <!--begin::Engage widget 1-->
                            <div class="card bgi-position-y-bottom bgi-position-x-end bgi-no-repeat bgi-size-cover min-h-250px bg-body mb-5 mb-xl-8"
                                style="background-position: 100% 50px;background-size: 500px auto;background-image:url('assets/media/misc/city.png')"
                                dir="ltr">
                                <!--begin::Body-->
                                <div class="card-body d-flex flex-column justify-content-center ps-lg-12">
                                    <!--begin::Title-->
                                    <h3 class="text-dark fs-2qx fw-bold mb-7">
                                        Kindly follow our <br />
                                        social media pages.
                                    </h3>
                                    <!--end::Title-->

                                    <!--begin::Action-->
                                    <div class="m-0">
                                        <!-- Facebook -->
                                        <a class="btn btn-primary btn-sm" style="background-color: #3b5998;"
                                            href="#!" role="button"><i class="fab fa-facebook-f"></i></a>

                                        <!-- Twitter -->
                                        <a class="btn btn-primary btn-sm" style="background-color: #55acee;"
                                            href="#!" role="button"><i class="fab fa-twitter"></i></a>

                                        <!-- Instagram -->
                                        <a class="btn btn-primary btn-sm" style="background-color: #ac2bac;"
                                            href="#!" role="button"><i class="fab fa-instagram"></i></a>

                                        <!-- Linkedin -->
                                        <a class="btn btn-primary btn-sm" style="background-color: #0082ca;"
                                            href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>

                                        <!-- Youtube -->
                                        <a class="btn btn-primary btn-sm" style="background-color: #ed302f;"
                                            href="#!" role="button"><i class="fab fa-youtube"></i></a>

                                        <!-- Whatsapp -->
                                        <a class="btn btn-primary btn-sm" style="background-color: #25d366;"
                                            href="#!" role="button"><i class="fab fa-whatsapp"></i></a>
                                    </div>
                                    <!--begin::Action-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Engage widget 1-->
                            <!--begin::Row-->

                            <!--end::Row-->


                            <!--begin::Tables Widget 5-->

                            <!--end::Tables Widget 5-->
                            <!--begin::Row-->

                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Content wrapper-->


            <!--begin::Footer-->
            <div id="kt_app_footer"
                class="app-footer  d-flex flex-column flex-md-row align-items-center flex-center flex-md-stack py-2 py-lg-4 ">
                <!--begin::Copyright-->
                <div class="text-dark order-2 order-md-1">
                    <span class="text-muted fw-semibold me-1">
                        <?php echo Date('Y');?>&copy;
                    </span>
                    <a href="https://fastpay.cttaste.com/" target="_blank"
                        class="text-gray-800 text-hover-primary">Fastpay</a>
                </div>
                <!--end::Copyright-->

                <!--begin::Menu-->
                <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                    <li class="menu-item"><a href="https://keenthemes.com/" target="_blank"
                            class="menu-link px-2">About</a></li>

                    <li class="menu-item"><a href="https://devs.keenthemes.com/" target="_blank"
                            class="menu-link px-2">Support</a></li>

                    <li class="menu-item"><a href="https://1.envato.market/EA4JP" target="_blank"
                            class="menu-link px-2">Purchase</a></li>
                </ul>
                <!--end::Menu-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end:::Main-->


    </div>
    <!--end::Wrapper container-->
</div>
<!-- end row -->



<!-- end row -->
</div>
@section('script')
<script>
    $(document).ready(function() {
        @if (session('message'))
        Swal.fire('Success!',"{{ session('message') }}",'success');
    @endif
   @if (session('error'))
        Swal.fire('{{ session('error') }}',"Try reset pin again",'error');
    @endif
    })
  
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
    integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
</script>
@endsection
@endsection