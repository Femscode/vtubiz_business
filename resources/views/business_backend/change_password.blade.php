@extends('business_backend.master')
@section('header')
@endsection
@section('content')


<div class="container-fluid">

    <div class="col-xl-12 ps-xl-12">
        <div class='card p-4 mb-4'>

            <form action='{{ route("admin_resetpassword") }}' method='post'> @csrf
                <div class="widget-content col-md-12">
                  
                    <p class="">Current Password</p>
                    <div class="input-group mb-4">
                      
                        <input  placeholder="**********"  required type="password" name='current_password' class="form-control"
                        aria-label="Current Password">

                    </div>
                    <p class="">New Password</p>
                    <div class="input-group mb-4">
                    
                        <input required type="password" minlength='8' name='new_password' id='new_password' class="form-control"
                        placeholder="**********" aria-label="New Password">
                      

                    </div>
                    <p class="">Confirm New Password</p>
                    <div class="input-group mb-4">
                    
                        <input required type="password" minlength='8' name='confirm_password' id='new_password' class="form-control"
                        placeholder="**********" aria-label="New Password">
                      

                    </div>


                    <p>Forgot your password? click <a style='color:red' href='/forgot-password'>here</a> to reset password.</p>

                    

                    <div class='mb-4 p-2'>
                    <button id='sub_btn' type="submit" class="btn btn-primary float-right">
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
</div>
<!-- end row -->



<!-- end row -->
</div>
@section('script')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                })

                @if (session('message'))
                Toast.fire({
                        icon: 'success',
                        title: '{{ session("message") }}'
                        }) 
           
        @endif

        @if (session('error'))
                Toast.fire({
                        icon: 'error',
                        title: '{{ session("error") }}'
                        }) 
           
        @endif

    


    })
</script>
@endsection
@endsection