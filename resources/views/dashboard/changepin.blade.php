@extends('dashboard.master1')
@section('content')
<div class="d-flex flex-column flex-column-fluid">


    <!--begin::Content-->
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <!--begin::Row-->
        <div class="row g-5 g-xl-8">
            <!--begin::Col-->
            <div class="col-xl-4">

                <!--begin::Misc Widget 1-->
                <div class="row mb-5 mb-xl-8 g-5 g-xl-8">

                <form action='{{ route("change_pin_status") }}' method='post'> @csrf
                        <div class="widget-content col-md-12 card p-4 m-4">
                            <h1>Disable/Enable Pin Validation</h1>
                            <p class="">Current Pin</p>
                            <div class="input-group mb-4">

                                <input placeholder="****" maxlength="4" required type="password"
                                    name='current_pin' class="form-control"
                                    aria-label="Current Password">

                            </div>
                         

                            @if($user->pin_status == 1)
                            <div class='mb-4 p-2'>
                                <button id='sub_btn' type="submit"
                                    class="btn btn-danger float-right">
                                    Disable
                                </button>
                            </div>
                            @else 
                            <div class='mb-4 p-2'>
                                <button id='sub_btn' type="submit"
                                    class="btn btn-primary float-right">
                                    Enable
                                </button>
                            </div>
                            @endif




                        </div>
                    </form>
              

                </div>


            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xl-8 ps-xl-12">
                <div class='card p-4 mb-4'>

                    <form action='{{ route("resetpin") }}' method='post'> @csrf
                        <div class="widget-content col-md-12">

                            <p class="">Current Pin</p>
                            <div class="input-group mb-4">

                                <input placeholder="****" maxlength="4" required type="password"
                                    name='current_pin' class="form-control"
                                    aria-label="Current Password">

                            </div>
                            <p class="">New Pin</p>
                            <div class="input-group mb-4">

                                <input required type="password" maxlength="4" name='new_pin'
                                    id='new_password' class="form-control" placeholder="****"
                                    aria-label="New Password">


                            </div>
                            <p class="">Confirm New Pin</p>
                            <div class="input-group mb-4">

                                <input required type="password" maxlength="4" name='confirm_pin'
                                    id='new_password' class="form-control" placeholder="****"
                                    aria-label="New Password">


                            </div>


                            <p>Forgot your pin? click <a style='color:red;cursor:pointer'
                                    id='reset_pin'>here</a> to reset pin.</p>



                            <div class='mb-4 p-2'>
                                <button id='sub_btn' type="submit"
                                    class="btn btn-primary float-right">
                                    Change
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
@endsection
@section('script')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        @if(session('message'))
        Swal.fire('Success!', "{{ session('message') }}", 'success');
        @endif
        @if(session('error'))
        Swal.fire('Incorrect Pin!', "{{ session('error') }}", 'error');
        @endif
        $("#reset_pin").click(function() {
            Swal.fire({
                title: 'You are about to reset your pin?',
                text: 'A token will be sent to your email, copy the token to reset your pin!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, reset',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Sending your token, please wait...')
                    $.ajax({
                        type: 'POST',
                        url: "{{route('forgot-pin')}}",

                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            console.log(data)
                            location.href = 'https://vtubiz.com/reset-pin-with-token';
                        },
                        error: function(data) {
                            console.log(data)
                            Swal.close()

                            Swal.fire('Opps!', 'Something went wrong, please try again later', 'error')
                        }
                    })
                }
            })
        })
    })
</script>
@endsection