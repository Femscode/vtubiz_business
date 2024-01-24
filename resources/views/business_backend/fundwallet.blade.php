@extends('business_backend.master')
@section('header')
<style>
    .credit-card {
 background: linear-gradient(to right, #ff6b6b, #6078ea);
 border-radius: 10px;
 box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
 overflow: hidden;
 width: 300px;
 margin: 20px;
 color: black;
}

.card {
 border: none;
 
 color:black;
}
</style>

@endsection
@section('content')

<div class="container-fluid">


    <div class="row">
        <div class="card mb-xl-10">
            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                data-bs-target="#kt_account_profile_details" aria-expanded="true"
                aria-controls="kt_account_profile_details">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h2 class="fw-bolder m-0">Fund Wallet</h2>
                </div>
                <!--end::Card title-->
            </div>
            <!--begin::Header-->


            <!--end::Header-->
            <!--begin::Form-->

            <div class="card-body">
              
                @if($user->account_no !== null)

                <div class="credit-card justify-content-center">
                    <div style=' background: linear-gradient(to right, #ff6b6b, #6078ea);'class="card card-dashed bg-gradient-primary flex-row flex-stack flex-wrap p-6 text-black m-2">
                        <!--begin::Info-->
                        <h4>Transfer to your virtual account</h4>
                        <div class="d-flex flex-column p-2 m-2">
                
                            <div class="d-flex align-items-center">
                
                                <div>
                                    <div class="fs-6 fw-semibold">
                                        Acct. No :
                                    </div>
                                    <div class="fs-4 fw-bold"><strong>{{ $user->account_no ?? "No account generated yet!" }}</strong></div>
                                    <div class="fs-6 fw-semibold">
                                        Bank Name :
                                    </div>
                                    <div class="fs-6 fw-bold"><strong>{{ $user->bank_name ?? "No account generated yet!" }}</strong></div>
                                    <div class="fs-6 fw-semibold">
                                        Account Name :
                                    </div>
                                    <div class="fs-4 fw-bold"><strong>{{ $user->account_name }}</strong></div>
                
                                </div>
                                <!--end::Details-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                
                    </div>
                </div>

                @else

                
                <div class='alert alert-success'>
                    <h2>Get yourself a permanent virtual account!</h2>
                    <ol>
                        <li>Send any amount at anytime</li>
                        <li>Enjoy less charges</li>
                        <li>Enjoy fast funding transaction speed</li>
                    </ol>
                    <a id='showBvn' style='color:red;cursor:pointer'>Click here to generate your permanent virtual account→</a><br>
                    <div style='display:none' id='bvnfield'>
                    <form method='post' action='/generatePermanentAccount' style='display: inline-block;'>@csrf 
                        <input type='number' name='bvn' placeholder='Enter Your BVN number' class='form-control' style='display: inline-block; width: auto;'/>
                        <input type='submit' class='btn btn-success' style='display: inline-block; width: auto;'/>
                    </form>
                    </div>
                    
                </div>
                @endif

                <hr>
                <h4 class='text-center'>
                --------------Or-----------------</h4>

                <div class="py-2">
                    <form method="POST" action="{{ route('admin_checkout') }}" accept-charset="UTF-8"
                        class="form-horizontal" role="form">@csrf
                        <div class="row" style="margin-bottom:40px;">
                            <div class="col-md-12 col-md-offset-2">

                                <input required name='amount' type="number" min='100' id='u_amount' class="form-control"
                                    placeholder="Amount" aria-label="Amount">




                                <input type="hidden" name="metadata"
                                    value="{{ json_encode($array = ['phone' => $user->phone,]) }}">
                                <div>


                                    <input required type='radio' name='type' value='transfer' />
                                    <label class="form-check-label" for="Pay with bank transfer">
                                        Automatic Bank Transfer
                                    </label><br>
                                    <input required type='radio' name='type' value='card' />
                                    <label class="form-check-label" for="Pay with card">
                                        Pay With Credit Card
                                    </label>
                                </div>

                                <p class='mt-2 justify-content-center' style='display:flex;justify-content:center'>
                                    <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">
                                        <i class="fa fa-plus-circle fa-lg"></i>
                                        Fund Wallet
                                    </button>
                                </p>

                            </div>
                        </div>
                    </form>
                </div>

            </div>



            <!--end::Form-->
        </div>

    </div>

</div>



<!-- end row -->
</div>
@section('script')
<script>
    $(document).ready(function() {
       

        @if (session('message'))
        Swal.fire('Success!',"{{ session('message') }}",'success');
    @endif
    $("#showBvn").on('click', function() {
        $("#bvnfield").show()
    })
      
    })

</script>
@endsection
@endsection