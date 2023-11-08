@extends('business_backend.master')
@section('header')
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
                <!--begin::Heading-->

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
                                    </label>
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
      
    })

</script>
@endsection
@endsection