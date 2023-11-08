@extends('newdashboard.master')
@section('header')
@endsection
@section('content')


<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">GET PAID THROUGH <a href='https://fastpay.cttaste.com'>FASTPAY <i class='fa fa-bolt'></i></a>  </h4>

                
              
            </div>
        </div>
    </div>
    <!-- end page title -->


    <div class="checkout-tabs">
        <div class="row">
            <div class="col-lg-2">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-gen-ques-tab" data-bs-toggle="pill" href="#v-pills-gen-ques"
                        role="tab" aria-controls="v-pills-gen-ques" aria-selected="true">
                        <i class="bx bx-question-mark d-block check-nav-icon mt-4 mb-2"></i>
                        <p class="fw-bold mb-4">Getting Started</p>
                    </a>
                    <a class="nav-link" id="v-pills-privacy-tab" data-bs-toggle="pill" href="#v-pills-privacy"
                        role="tab" aria-controls="v-pills-privacy" aria-selected="false">
                        <i class="bx bx-check-shield d-block check-nav-icon mt-4 mb-2"></i>
                        <p class="fw-bold mb-4">How it works</p>
                    </a>
                    <a class="nav-link" id="v-pills-support-tab" data-bs-toggle="pill" href="#v-pills-support"
                        role="tab" aria-controls="v-pills-support" aria-selected="false">
                        <i class="bx bx-support d-block check-nav-icon mt-4 mb-2"></i>
                        <p class="fw-bold mb-4">Support</p>
                    </a>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade active show" id="v-pills-gen-ques" role="tabpanel"
                                aria-labelledby="v-pills-gen-ques-tab">
                                <h4 class="card-title mb-5">Getting Started</h4>
                                <div class="faq-box d-flex mb-4">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-help-circle font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">Activate Online Payment.</h5>
                                        <p class="text-muted">Receiving payment online allows your customers to pay you
                                            instantly before or after getting to your DM. This will eliminate the time taken for confirmation delay.
                                    </div>
                                </div>
                                <div class="faq-box d-flex mb-4">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-help-circle font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">Set Up Withdrawal Pin</h5>
                                        <p class="text-muted">Payment received online from your customers can be withdrawn at any time to any
                                            account, but first, you will need to set up your transaction pin. Click <a
                                                href='#' class='set_withdraw'>here</a> to set up your withdrawal pin.</p>
                                                <a class='set_withdraw btn btn-success btn-sm'>Set Withdrawal Pin</a>
                                    </div>
                                </div>
                                <div class="faq-box d-flex mb-4">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-help-circle font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">Withdraw Funds</h5>
                                        <p class="text-muted">Withdraw funds of any amount (as low as NGN100) at any
                                            given time.</p>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="v-pills-privacy" role="tabpanel"
                                aria-labelledby="v-pills-privacy-tab">
                                <h4 class="card-title mb-5">How it works?</h4>

                                <div class="faq-box d-flex mb-4">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-help-circle font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">How do customers pay?</h5>
                                        <p class="text-muted">Your customers now have two(2) options to pay you, paying to your bank account after getting to your DM or making a payment online directly before or after getting to your DM. This will require them to create a <a href='https://fastpay.cttaste.com'>fastpay account</a> with us and fund their wallet.</p>
                                    </div>
                                </div>
                                <div class="faq-box d-flex mb-4">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-help-circle font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">How can I know if customers have made online payments?</h5>
                                        <p class="text-muted">
                                            When a new order is received in your DM, it includes a payment link. When this link is clicked, it provides the payment status of the order. <br>Moreover, when your customers click the link, they will be redirected to a payment page instead, where they can conveniently make an online payment.

Additionally, you can effortlessly check the payment status of each order without leaving WhatsApp. The payment status will be displayed at the top of the order message, similar to how the price confirmation works.
                                        </p>
                                    </div>
                                </div>
                                <div class="faq-box d-flex mb-4">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-help-circle font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">Why is the online payment better than the direct payment?</h5>
                                        <p class="text-muted">This new payment option offers several advantages. Firstly, it enables you to track and record the way your customers make payments, ensuring accurate financial records. Secondly, it provides your customers with an alternative method of payment in case any issues arise with direct transfers.
                                            Also, it enables you to know the payment status of every order without leaving your WhatsApp, thereby making the ordering process more faster!
                                        </p>
                                    </div>
                                </div>
                            
                            </div>
                            <div class="tab-pane fade" id="v-pills-support" role="tabpanel"
                                aria-labelledby="v-pills-support-tab">
                                <h4 class="card-title mb-5">Support</h4>

                                <div class="faq-box d-flex mb-4">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-help-circle font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">Still have some questions?</h5>
                                        <p class="text-muted">In case you have questions and suggestions, click <a href='https://wa.me/2349058744473'> here </a> to chat directly with us on whatsapp.</p>
                                    </div>
                                </div>
                                {{-- <div class="faq-box d-flex mb-4">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-help-circle font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">Where does it come from?</h5>
                                        <p class="text-muted">Everyone realizes why a new common language would be
                                            desirable one could refuse to pay expensive translators.</p>
                                    </div>
                                </div> --}}

                                {{-- <div class="faq-box d-flex">
                                    <div class="flex-shrink-0 me-3 faq-icon">
                                        <i class="bx bx-help-circle font-size-20 text-success"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="font-size-15">What is Lorem Ipsum?</h5>
                                        <p class="text-muted">New common language will be more simple and regular than
                                            the existing European languages. It will be as simple as occidental.</p>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

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



                $(".set_withdraw").click(function() {
                    Swal.fire({
                           title: 'Set Withdrawal Pin?',
                           text: 'A mail will be sent to your registered email to set up your pin',
                           icon: 'info',
                           showCancelButton: true,
                           confirmButtonColor: '#3085d6',
                           cancelButtonColor: '#d33',
                           confirmButtonText: 'Yes proceed',
                         }).then((result) => {
                           if (result.isConfirmed) {
                            Swal.fire({
                                title: "Sending withdrawal pin setup mail, please wait...",
                                // html: '<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>',
                                showConfirmButton: false,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                },
                                });
                                 var fd = new FormData;
                                        $.ajax({
                                    type: 'POST',
                                    url: "{{route('withdrawal_pin')}}",
                                    data: fd,
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    success: function($data) {
                                        console.log('the data', $data)
                                        Swal.close()
                                    Swal.fire('Success', 'A mail has been sent to your registered email address to complete the process','success')
                                    

                                    },
                                    error: function(data) {
                                        console.log(data)
                                        Swal.close()
                                        Swal.fire('Opps!', 'Error encoutered, contact the administrator', 'error')
                                    }
                                })
                                            }
                                            });
                                    
                                        // Swal.fire('Withdrawal pin process has been sent to your mail, check mail to proceed.')
                                    })
                // Swal.fire('nice')

        $("#update_profile").on("submit", async function(e) {
            e.preventDefault();
            Swal.fire('Updating profile, please wait...')
            var image = $('#image')[0].files;
            var fd = new FormData;
            fd.append('name', $("#name").val());
            fd.append('firstname', $("#firstname").val());
            fd.append('lastname', $("#lastname").val());
            fd.append('phone', $("#phone").val());
            fd.append('email', $("#email").val());
            fd.append('school', $("#school").val());
            fd.append('opening_hour', $("#opening_hour").val());
            fd.append('closing_hour', $("#closing_hour").val());
            console.log(image[0],'tje image')
            if(image[0] != undefined) {
            fd.append('image', image[0]);
            }
            console.log(fd)
            $.ajax({
                type: 'POST',
                url: "{{route('updateprofile')}}",
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                success: function($data) {
                    console.log('the data', $data)
                    Swal.close()
                    Toast.fire({
                        icon: 'success',
                        title: 'Withdrawal mail sent!'
                        }) 
                
                window.location.reload()

                },
                error: function(data) {
                    console.log(data)
                    Swal.close()
                    Swal.fire('Opps!', 'Error encoutered, contact the administrator', 'error')
                }
            })

        })


    })
</script>
@endsection
@endsection