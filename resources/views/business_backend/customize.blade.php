@extends('business_backend.master')
@section('header')
@endsection
@section('content')
<div class="modal fade" name="kt_modal_invite_friends2" tabindex="-1" aria-hidden="true">
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
                    <form method='post' name='update_category' class="form fv-plugins-bootstrap5 fv-plugins-framework">
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
                            <input type='hidden' name='edit_id' />
                            <input required type="text" name='edit_category_name'
                                class="form-control form-control-solid" value="E.g Drinks, Swallow, Cakes" name="name"
                                value="">


                        </div>

                        <div class="text-center pt-15">
                            <button type="reset" name="kt_modal_new_card_cancel"
                                class="btn btn-light me-3">Discard</button>
                            <button type="submit" name="kt_modal_new_card_submit" class="btn btn-primary">
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
                <h4 class="mb-sm-0 font-size-18">Customize your theme, {{ $user->brand_name }}</h4>
            </div>





        </div>
    </div>
    <!-- end page title -->

    <div class="row">

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
                                    <a href='https://wa.me/2349058744473?text=Hi,%20I%20will%20like%20to%20make%20my%20payment%20for%20last%20week%20({{ count($last_week_orders) }}%20Orders).'
                                        style='color:#721c24' class="fw-medium">Last Week Orders</a>
                                    <h4 style='color:#721c24' class="mb-0">{{ count($last_week_orders) }}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-md rounded-circle bg-success">
                                        <a href='https://wa.me/2349058744473?text=Hi,%20I%20will%20like%20to%20make%20my%20payment%20for%20last%20week%20({{ count($last_week_orders) }}%20Orders).'
                                            style='cursor:pointer' class="avatar-title">
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
                                    <a href='https://wa.me/2349058744473?text=Hi,%20I%20will%20like%20to%20make%20my%20payment%20for%20last%20month%20({{ count($last_month_orders) }}%20Orders).'
                                        style='color:#721c24' class="fw-medium">Last Month Orders</a>
                                    <h4 style='color:#721c24' class="mb-0">{{ count($last_month_orders) }}</h4>
                                </div>

                                <div class="flex-shrink-0 align-self-center">
                                    <div class="mini-stat-icon avatar-md rounded-circle bg-success">
                                        <a href='https://wa.me/2349058744473?text=Hi,%20I%20will%20like%20to%20make%20my%20payment%20for%20last%20month%20({{ count($last_month_orders) }}%20Orders).'
                                            style='cursor:pointer' class="avatar-title">
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

            </div>
            <!-- end row -->

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Website Fields</h4>

                    <form method='post' action='{{ route("update_customization") }}' enctype='multipart/form-data'>@csrf
                        <div class="row">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="brand_color" class="form-label">Brand Color</label>
                                    <input type="color" class="form-control" name="brand_color"
                                        value="{{ $user->brand_color ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="font family" class="form-label">Brand Font Family</label>
                                    <select value='{{ $user->font_family }}' name="font_family" class="form-control">
                                        
                                        <option style="font-family: Arial, sans-serif;" value="Arial, sans-serif" selected>{{ $user->font_family ?? "" }}
                                        </option>
                                        <option style="font-family: Arial, sans-serif;" value="Arial, sans-serif">Arial
                                        </option>
                                        <option style="font-family: Helvetica, sans-serif;"
                                            value="Helvetica, sans-serif">Helvetica</option>
                                        <option style="font-family: 'Times New Roman', serif;"
                                            value="Times New Roman, serif">Times New Roman</option>
                                        <option style="font-family: Georgia, serif;" value="Georgia, serif">Georgia
                                        </option>
                                        <option style="font-family: 'Courier New', monospace;"
                                            value="Courier New, monospace">Courier New</option>
                                        <option style="font-family: Verdana, sans-serif;" value="Verdana, sans-serif">
                                            Verdana</option>
                                        <option style="font-family: Tahoma, sans-serif;" value="Tahoma, sans-serif">
                                            Tahoma</option>
                                        <option style="font-family: 'Trebuchet MS', sans-serif;"
                                            value="Trebuchet MS, sans-serif">Trebuchet MS</option>
                                        <option style="font-family: Impact, sans-serif;" value="Impact, sans-serif">
                                            Impact</option>
                                        <option style="font-family: 'Palatino Linotype', serif;"
                                            value="Palatino Linotype, serif">Palatino Linotype</option>
                                        <option style="font-family: 'Lucida Sans Unicode', sans-serif;"
                                            value="Lucida Sans Unicode, sans-serif">Lucida Sans Unicode</option>
                                        <option style="font-family: Arial Black, sans-serif;"
                                            value="Arial Black, sans-serif">Arial Black</option>
                                        <option style="font-family: 'Book Antiqua', serif;" value="Book Antiqua, serif">
                                            Book Antiqua</option>
                                        <option style="font-family: 'Comic Sans MS', cursive;"
                                            value="Comic Sans MS, cursive">Comic Sans MS</option>
                                        <option style="font-family: Impact, sans-serif;" value="Impact, sans-serif">
                                            Impact</option>
                                        <option style="font-family: 'Lucida Console', monospace;"
                                            value="Lucida Console, monospace">Lucida Console</option>
                                        <option style="font-family: 'Lucida Sans', sans-serif;"
                                            value="Lucida Sans, sans-serif">Lucida Sans</option>
                                        <option style="font-family: 'Tahoma', sans-serif;" value="Tahoma, sans-serif">
                                            Tahoma</option>
                                        <option style="font-family: 'Verdana', sans-serif;" value="Verdana, sans-serif">
                                            Verdana</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="heading" class="form-label">Heading 1</label>
                            <input type="text" class="form-control" name="heading_1" value="{{ $user->heading_1 ?? "
                                Top-Up, Pay Bills, Stay Connected" }}">
                        </div>
                        <div class="mb-3">
                            <label for="heading" class="form-label">Heading 2</label>
                            <input type="text" class="form-control" name="heading_2" value="{{ $user->heading_2 ?? "
                               Top Up Airtime, Data, Cable Subscriptions, and More, All at Your Convenience." }}">
                        </div>
                        <div class="mb-3">
                            <label for="heading" class="form-label">Sub Heading 1</label>
                            <input type="text" class="form-control" name="sub_heading_1"
                                value="{{ $user->sub_heading_1 ?? "Explore a World of Convenience" }}">
                        </div>
                        <div class="mb-3">
                            <label for="heading" class="form-label">Sub Heading 2</label>
                            <input type="text" class="form-control" name="sub_heading_2"
                                value="{{ $user->sub_heading_2 ?? "Simplify Your Digital Transactions" }}">
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image 1</label>
                                    <input type="file" class="form-control" name="image_1"
                                        value="{{ $user->email ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Image 2</label>
                                    <input type="file" class="form-control" name="image_2"
                                        value="{{ $user->phone ?? ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="heading" class="form-label">About Us</label>
                            <input type="text" class="form-control" name="about_us" value="{{ $user->about_us ?? " We
                                provide a comprehensive platform for all your data, airtime, electricity, and cable
                                subscription needs. Our mission is to empower your digital lifestyle through
                                affordability, automation, and lightning-fast transactions." }}">
                        </div>
                        <div class="mb-3">
                            <label for="heading" class="form-label">Description</label>
                            <input type="text" class="form-control" name="description"
                                value="{{ $user->description ?? "" }}">
                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email"
                                        value="{{ $user->email ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Contact Phone</label>
                                    <input type="phone" class="form-control" name="phone"
                                        value="{{ $user->phone ?? ''}}">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Office Address</label>
                            <input type="text" class="form-control" name="address" value="{{ $user->address ?? "" }}">
                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="instagram" class="form-label">Instagram Link</label>
                                    <input type="text" class="form-control" name="instagram"
                                        value="{{ $user->instagram ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="facebook" class="form-label">Facebook Link</label>
                                    <input type="text" class="form-control" name="facebook"
                                        value="{{ $user->facebook ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="twitter" class="form-label">Twitter Link</label>
                                    <input type="text" class="form-control" name="twitter"
                                        value="{{ $user->twitter ?? '' }}">
                                </div>
                            </div>
                        </div>


                        <div class='text-right'>
                            <button type="submit" name='submit_type' value='reset' class="btn btn-danger w-md ">Reset To Default</button>
                            <button type="submit" name='submit_type' value='save' class="btn btn-primary w-md ">Save & Preview</button>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card overflow-hidden">
                <div class="bg-secondary bg-soft">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-primary p-3">
                                <div class='row'>
                                    <div class='col-md-12'>
                                        <h5 style="color:#640f11">Preview Display</h5>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="position-relative mb-3">
                            <iframe src="http://127.0.0.1:8050/theme_preview/{{ $id }}" width="800" height="600" frameborder="0" class="img-thumbnail"></iframe>
                           
                        </div>
                        <div class="col-5 align-self-end">
                           
  
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                      

                        <div class="col-sm-12">
                            <div class="pt-4">

                                <div class="row">
                                    <h6>Your Website Link:
                                        <div class="input-group">
                                            <input name='link-to-copy' type="text" class="form-control"
                                                value="https://cttaste.com/{{ $user->slug }}">
                                            <div class="input-group-append">
                                                <button name='copy-link' style='background:#ebab21'
                                                    class="btn btn-primary" type="button"><i
                                                        class='fa fa-copy'></i></button>
                                            </div>
                                        </div>


                                    </h6>

                                </div>
                                <div class='card col-md-12 p-2 m-2 bg-light-success'>
                                    <a target='_blank' href="/theme_preview/{{ $id }}" class="btn btn-secondary">Click here for full preview</a>
                                
                                </div>
                            </div>
                        </div>
                    </div>
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
                                            <input class="form-check-input" type="checkbox" name="transactionCheck01">
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
                                            <input class="form-check-input" type="checkbox" name="transactionCheck02">
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
    @if (session('success'))
     $(document).ready(function() {
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


        Toast.fire({
                        icon: 'success',
                        title: '{{ session("success") }}'
                        }) 
           
        @endif
                    })
</script>

@endsection

@endsection