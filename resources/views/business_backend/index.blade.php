@extends('business_backend.master')
@section('header')
@endsection
@section('content')
<div class="modal fade" id="kt_modal_invite_friends2" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                fill="black" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-3 mx-xl-10 pt-0 pb-1">
                <!--begin::Heading-->
                <div class="text-center mb-13">
                    <!--begin::Title-->
                    <h1 class="mb-3">Edit Category</h1>
                    <!--end::Title-->
                    <!--begin::Description-->
                    <div class="text-muted fw-bold fs-5">If you need more info, please check out
                        <a class="text-danger link-primary fw-bolder">FAQ Page</a>.
                    </div>
                    <!--end::Description-->
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-5 my-15">
                    <!--begin::Form-->
                    <form method='post' id='update_category' class="form fv-plugins-bootstrap5 fv-plugins-framework">
                        @csrf
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                                <span class="required">Category Name</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title=""
                                    data-bs-original-title="Specify a card holder's name"
                                    aria-label="Specify a card holder's name"></i>
                            </label>
                            <!--end::Label-->
                            <input type='hidden' id='edit_id' />
                            <input required type="text" id='edit_category_name' class="form-control form-control-solid"
                                placeholder="E.g Drinks, Swallow, Cakes" name="name" value="">


                        </div>

                        <div class="text-center pt-15">
                            <button type="reset" id="kt_modal_new_card_cancel"
                                class="btn btn-light me-3">Discard</button>
                            <button type="submit" id="kt_modal_new_card_submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                        <div></div>
                    </form>
                    <!--end::Form-->
                </div>


            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>


<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Welcome back, {{ $user->brand_name }}</h4>
            </div>
          


            @if($user->approve == 0)
            {{-- <div style='background:hsl(210, 90%, 95%) !important;color:#001f3f' class="alert alert-danger border-0" role="alert"> --}}
            <div class="alert alert-danger border-0" role="alert">

                Please note that for your website to go live <span style='color:#ebab21'>(SSL Secured)</span>, enjoy 5% data discounts, and other amazing features you have to upgrade your account
                 by clicking on the upgrade button below.<br>
                <a href='https://wa.me/2349058744473?text=Hi%20Admin,%20%0a--�--%0aI%20just%20finish%20setting%20up%20my%20account%20on%20VTUBIZ,%20you%20can%20check%20out%20my%20account%20profile({{$user->name}})%20for%20proper%20verification%20and%20approval.'
                    class='btn btn-danger border-0'>Upgrade</a>

            </div>
            @endif

        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-4">
            <div class="card overflow-hidden">
                <div style='background:hsl(210, 90%, 95%) !important' class="bg-secondary bg-soft">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-primary p-3">
                                <div class='row'>
                                    <div class='col-md-6'>
                                        <h5 style="color:#001f3f">NGN {{ number_format($user->balance,2) }}</h5>
                                        <p style='color:#001f3f'>Admin Balance</p>
                                    </div>
                                    <div class='col-md-6'>
                                        <a href='/transactions' style='background:#001f3f !important' class='btn btn-sm btn-info border-0'>Fund Wallet</a>
                                        <a href='/withdraw' style='background:#fb9129 !important' class='btn btn-sm btn-success border-0'>Withdraw Funds</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-5 align-self-end">
                            <img src="https://cttaste.com/api_user/assets/images/profile-img.png" alt=""
                                class="img-fluid">
                            {{-- <img src="/assets/images/circlebanner.jpg" alt="" class="img-fluid"> --}}
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="avatar-md profile-user-wid mb-4">
                                @if($user->image !== null)
                                <img src="https://cttaste.com/cttaste_files/public/profilePic/{{ $user->image }}" alt=""
                                    class="img-thumbnail rounded-circle">
                                @else
                                <img src="assets/images/banner3.jpeg" alt="" class="img-thumbnail rounded-circle">
                                @endif

                            </div>

                        </div>

                        <div class="col-sm-12">
                            <div class="pt-4">

                                <div class="row">
                                    <h6>Your Website Link:
                                        <div class="input-group">
                                            <input id='link-to-copy' type="text" class="form-control"
                                                value="{{ strtolower($user->brand_name) }}.vtubiz.com">
                                            <div class="input-group-append">
                                                <button id='copy-link' style='background:#fb9129'
                                                    class="btn btn-primary" type="button"><i
                                                        class='fa fa-copy'></i></button>
                                            </div>
                                        </div>


                                    </h6>

                                </div>
                                <div class='card col-md-12 p-2 m-2 bg-light-success'>
                                 
                                    <a href="http://{{$user->brand_name}}.localhost:8000" style='background:#001f3f' class="btn btn-warning">Preview Website</a>
                                  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    {{-- <h4 class="card-title mb-4">Social Source</h4> --}}
                    <div class="text-center">

                        <p class="font-16 text-muted mb-2"></p>
                        <h5><a href="javascript: void(0);" class="text-dark">Quick Links
                            </a></h5>
                    </div>
                    <ul class="verti-timeline list-unstyled">
                        <li class="event-list">
                            <div class="event-timeline-dot">
                                <i class="bx bx-right-arrow-circle font-size-18"></i>
                            </div>
                            <div class="d-flex">
                                <div class="flex-shrink-0 ">
                                    <a style='color:#001f3f' href='/profile' class="font-size-14">Profile <i
                                            class="bx bx-right-arrow-alt font-size-16 text-primary align-middle ms-2"></i>
                                    </a>
                                </div>

                            </div>
                        </li>
                        <li class="event-list">
                            <div class="event-timeline-dot">
                                <i class="bx bx-right-arrow-circle font-size-18"></i>
                            </div>
                            <div class="d-flex">
                                <div class="flex-shrink-0 ">
                                    <a href='checkreviews' style='color:#001f3f' class="font-size-14">Design & Theme <i
                                            class="bx bx-right-arrow-alt font-size-16 text-primary align-middle ms-2"></i>
                                    </a>
                                </div>

                            </div>
                        </li>


                        <li class="event-list">
                            <div class="event-timeline-dot">
                                <i class="bx bx-right-arrow-circle font-size-18"></i>
                            </div>
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <a style='color:#001f3f' href='/records' class="font-size-14">Records <i
                                            class="bx bx-right-arrow-alt font-size-16 text-primary align-middle ms-2"></i>
                                    </a>
                                </div>

                            </div>
                        </li>
                        <li class="event-list">
                            <div class="event-timeline-dot">
                                <i class="bx bx-right-arrow-circle font-size-18"></i>
                            </div>
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <a style='color:#001f3f' href='/delivery_locations' class="font-size-14">Customer Transactions <i
                                            class="bx bx-right-arrow-alt font-size-16 text-primary align-middle ms-2"></i>
                                    </a>
                                </div>

                            </div>
                        </li>
                        <li class="event-list">
                            <div class="event-timeline-dot">
                                <i class="bx bx-right-arrow-circle font-size-18"></i>
                            </div>
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <a style='color:#001f3f' href='/delivery_locations' class="font-size-14">Design & Theme <i
                                            class="bx bx-right-arrow-alt font-size-16 text-primary align-middle ms-2"></i>
                                    </a>

                                </div>

                            </div>
                        </li>
                        <li class="event-list">
                            <div class="event-timeline-dot">
                                <i class="bx bx-right-arrow-circle font-size-18"></i>
                            </div>
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <a style='color:#001f3f' href='/delivery_tracking' class="font-size-14">Reviews & Complaint<span
                                            class="badge rounded-pill bg-danger m-2">New</span> <i
                                            class="bx bx-right-arrow-alt font-size-16 text-primary align-middle ms-2"></i>
                                    </a>
                                </div>

                            </div>
                        </li>
                    </ul>

                </div>
            </div>


        </div>
        <div class="col-xl-8">
            <div class="row">
                @if($user->weekly_payment == 1)
                @if($user->payment_status == 1)
                <div class="col-md-4">
                    <div class="card mini-stats-wid" style='background:#d4edda;border-left: 5px solid #155724'>
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <a class="text-muted fw-medium">Last Week Orders</a>
                                    <h4 class="mb-0">{{ count($last_week_orders) }}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-md rounded-circle bg-success">
                                        <span style='background:#155724 !important' class="avatar-title bg-success">
                                            Paid
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else 
                <div class="col-md-4">
                    <div class="card mini-stats-wid" style='background:#f8d7da;border-left: 5px solid #721c24'>
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <a href='https://wa.me/2349058744473?text=Hi,%20I%20will%20like%20to%20make%20my%20payment%20for%20last%20week%20({{ count($last_week_orders) }}%20Orders).' style='color:#721c24' class="fw-medium">Last Week Orders</a>
                                    <h4 style='color:#721c24' class="mb-0">{{ count($last_week_orders) }}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-md rounded-circle bg-success">
                                        <a href='https://wa.me/2349058744473?text=Hi,%20I%20will%20like%20to%20make%20my%20payment%20for%20last%20week%20({{ count($last_week_orders) }}%20Orders).' style='cursor:pointer' class="avatar-title">
                                           Not Paid
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @elseif($user->monthly_payment == 1)


                @if($user->payment_status == 1)
                <div class="col-md-4">
                    <div class="card mini-stats-wid" style='background:#d4edda;border-left: 5px solid #155724'>
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <a class="text-muted fw-medium">Last Month Orders</a>
                                    <h4 class="mb-0">{{ count($last_month_orders) }}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-md rounded-circle bg-success">
                                        <span style='background:#155724 !important' class="avatar-title bg-success">
                                            Paid
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else 
                <div class="col-md-4">
                    <div class="card mini-stats-wid" style='background:#f8d7da;border-left: 5px solid #721c24'>
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <a href='https://wa.me/2349058744473?text=Hi,%20I%20will%20like%20to%20make%20my%20payment%20for%20last%20month%20({{ count($last_month_orders) }}%20Orders).' style='color:#721c24' class="fw-medium">Last Month Orders</a>
                                    <h4 style='color:#721c24' class="mb-0">{{ count($last_month_orders) }}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-md rounded-circle bg-success">
                                        <a href='https://wa.me/2349058744473?text=Hi,%20I%20will%20like%20to%20make%20my%20payment%20for%20last%20month%20({{ count($last_month_orders) }}%20Orders).' style='cursor:pointer' class="avatar-title">
                                           Not Paid
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endif
                <div class="col-md-4">
                    <div class="card mini-stats-wid" style='border-left:5px solid #001f3f;background-color: hsl(210, 90%, 95%)'>
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <a href='/purchase_transactions' class="text-muted fw-medium">All Transactions</a>
                                    <h4 class="mb-0">{{ count($transactions) }}</h4>
                                  
                                </div>

                                <div class="flex-shrink-0 align-self-center ">
                                    <div style='background:#001f3f !important' class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                        <span style='background:#001f3f !important' class="avatar-title rounded-circle bg-primary">
                                            <i class="bx bx-book font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mini-stats-wid"  style='border-left:5px solid #001f3f;background-color: hsl(210, 90%, 95%)'>
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <a href='/users' class="text-muted fw-medium">Total Customers</a>
                                    <h4 class="mb-0">{{ count($users) - 1 }}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div style='background:#001f3f !important' class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                        <span style='background:#001f3f !important' class="avatar-title rounded-circle bg-primary">
                                            <i class="bx bx-user font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mini-stats-wid"  style='border-left:5px solid #001f3f;background-color: hsl(210, 90%, 95%)'>
                        <div class="card-body">
                            <div class="d-flex">
                                <div  class="flex-grow-1">
                                    <a href='#' class="text-muted fw-medium">Total Customer's Balance</a>
                                    <h4 class="mb-0">NGN{{ number_format($total_user_balance - $user->balance,2) }}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div style='background:#001f3f !important' class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                                        <span style='background:#001f3f !important' class="avatar-title rounded-circle bg-primary">
                                            <i class="bx bx-wallet font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="card">
                <div class="card-body">
                    <div class='row'>
                        <div class="card-title col-md-8">Today's Transaction ({{ count($today_transactions) }})</div>

                       
                    </div>
                    <div style='overflow-x:auto;max-width: 100%' class="table-responsive dataTables_length" id='datatable_length'>
                        <table style='max-width:100%' id='datatable' class="datatable table table-bordered dt-responsive nowrap w-100 align-middle mb-0">
                            <thead>
                                <tr class="fw-bolder text-muted">
                                  
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Transaction Type</th>
                                    <th>Transaction Details</th>
                                    <th>Date</th>
                                    <th>Before/After Balance</th>

                                    {{-- <th class="min-w-120px">Price</th> --}}

                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody id='search_food_tbody'>
                                @foreach($today_transactions as $transaction)
                                @if($transaction->status == 2)
                                <tr class='alert alert-warning'>
                                    <td>{{ $transaction->user->name }}</td>
                                    <td>₦{{ number_format($transaction->amount) }}</td>
                                    <td>{{ $transaction->type }}</td>
                                    <td>{{ $transaction->description }}</td>
                                    <td>{{ $transaction->created_at }}</td>
                                    <td>Pending Schedule Transaction</td>
                                    <td> <a class='btn btn-success'>Verify</a></td>

                                </tr>

                                @else
                                <tr>
                                    <td>{{ $transaction->user->name }}</td>
                                    <td>₦{{ number_format($transaction->amount) }}</td>
                                    <td>{{ $transaction->type }}</td>
                                    <td>{{ $transaction->description }}</td>
                                    <td>{{ $transaction->created_at }}</td>
                                    <td>₦{{ number_format($transaction->admin_before) }}/₦{{ number_format($transaction->admin_after) }}</td>
                                    <td> <a class='btn btn-success'>Verify</a></td>


                                </tr>
                                @endif
                                @endforeach
                             

                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->


    <!-- end row -->

    {{-- <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Latest Transaction</h4>
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 20px;">
                                        <div class="form-check font-size-16 align-middle">
                                            <input class="form-check-input" type="checkbox" id="transactionCheck01">
                                            <label class="form-check-label" for="transactionCheck01"></label>
                                        </div>
                                    </th>
                                    <th class="align-middle">Order ID</th>
                                    <th class="align-middle">Billing Name</th>
                                    <th class="align-middle">Date</th>
                                    <th class="align-middle">Total</th>
                                    <th class="align-middle">Payment Status</th>
                                    <th class="align-middle">Payment Method</th>
                                    <th class="align-middle">View Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-check font-size-16">
                                            <input class="form-check-input" type="checkbox" id="transactionCheck02">
                                            <label class="form-check-label" for="transactionCheck02"></label>
                                        </div>
                                    </td>
                                    <td><a href="javascript: void(0);" class="text-body fw-bold">#SK2540</a> </td>
                                    <td>Neal Matthews</td>
                                    <td>
                                        07 Oct, 2019
                                    </td>
                                    <td>
                                        $400
                                    </td>
                                    <td>
                                        <span class="badge badge-pill badge-soft-success font-size-11">Paid</span>
                                    </td>
                                    <td>
                                        <i class="fab fa-cc-mastercard me-1"></i> Mastercard
                                    </td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button"
                                            class="btn btn-primary btn-sm btn-rounded waves-effect waves-light"
                                            data-bs-toggle="modal" data-bs-target=".transaction-detailModal">
                                            View Details
                                        </button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <!-- end table-responsive -->
                </div>
            </div>
        </div>
    </div> --}}
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

        var oTable = $('.datatable').DataTable({
            ordering: false,
            searching: true
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
                $("#copy-link").click(function() {
            var link = $("#link-to-copy").attr("value");
            navigator.clipboard.writeText(link).then(function() {
                Toast.fire({
                icon: 'success',
                title: 'Linked Copied'
                })
                
            });
            });

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