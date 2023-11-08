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
                <h4 class="mb-sm-0 font-size-18">REQUEST FOR A CUSTOMIZED DOMAIN.</h4>
            </div>



            @if($user->approve == 0)
            <div class="alert alert-info" role="alert">

                Not okay with <b>https://{{ strtolower($user->brand_name) }}.vtubiz.com</b>? Get your own domain now, to be integrated within six(6) hours after submiting request.<br>
               

            </div>
            @endif

        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-6">
            <div class="card overflow-hidden">
                <div class="bg-secondary bg-soft">
                    <div class="row">
                        <div class="col-12">
                            <div class="text-primary p-3">
                                <div class='row'>
                                    <div class='col-md-6'>
                                        <h5 style="color:#640f11">Search Domain</h5>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">


                        <div class="col-sm-12">
                            <div class="pt-4">

                                <div class="row">

                                    <div class="input-group">
                                        <input placeholder="Type the domain you want" id='link-to-copy' type="text"
                                            class="form-control">
                                        <div class="input-group-append">
                                            <button id='copy-link' style='background:#ebab21' class="btn btn-primary"
                                                type="button">Search</button>
                                        </div>
                                    </div>

                                    <div style='display:none' class="alert alert-success mt-4 p-4" id='available' role="alert">
                                        <h4 class="alert-heading">Domain Available😊💃!</h4>
                                        <table class='table m-0'>
                                            <tr>
                                                <th>Price</th>
                                                <th id='price'>NGN</th>
                                            </tr>
                                            <tr>
                                                <th>Integration Time</th>
                                                <th>Six(6) Hours</th>
                                            </tr>
                                           

                                        </table>
                                        <a id='getdomain' class='btn btn-success' href='#'>Get Domain</a>
                                    </div>
                                    <div style='display:none' class="alert alert-danger mt-4 p-4" id='not_available' role="alert">
                                        <h4 class="alert-heading">Domain Not Available😡😢!</h4>
                                        <p>Check below for similar domain suggestions</p>
                                    </div>




                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </div>
        <div class="col-xl-6">

            <!-- end row -->

            <div class="card">
                <div class="card-body">
                    <div class='row'>
                        <div class="card-title col-md-8">Domain Suggestions</div>


                    </div>
                    <div class="table-responsive dataTables_length" id='datatable_length'>
                        <table id='datatable' class="table table-bordered dt-responsive nowrap w-100 align-middle mb-0">
                            <thead>
                                <tr class="fw-bolder text-muted">

                                    <th>Domain</th>
                                   

                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody id='search_food_tbody'>
                                <tr>
                                </tr>
                                
                                
                            </tbody>
                        </table>
                        <div style='display:none' id='loading' class='alert alert-info'>Loading suggestions, please wait...</div>
                    </div>
                    <!-- end table-responsive -->
                </div>
            </div>
        </div>
    </div>
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
                
                $("#copy-link").click(function() {
                    var domain = $("#link-to-copy").val()
                    console.log(domain, 'the domain')
                    if(domain.length >= 5) {
                        Swal.fire({
                              title: "Checking for domain availability, please wait...",
                              // html: '<div class="text-center"><i class="fa fa-spinner fa-spin fa-3x"></i></div>',
                              showConfirmButton: false,
                              allowOutsideClick: false,
                              allowEscapeKey: false,
                              didOpen: () => {
                                Swal.showLoading();
                              },
                            });
                        let fd = new FormData();
                            fd.append("domain", domain);
                          
                           
                           
                        axios.post('check_domain',fd)
                            .then(function(response) {
                                Swal.close()
                                console.log(response, response.data, response.data.available, 'all')
                                if(response.data.available == false) {
                                    $("#not_available").show()
                                    $("#available").hide()
                                    $("#loading").show()
                                    $("#search_food_tbody").show()

                                    //another axios to suggest new domains
                                    axios.post('domain_suggestion',fd)
                                                    .then(function(response) {
                                                        Swal.close()
                                                        console.log(response, response.data, 'new_all')
                                                        const tableBody = $('#datatable tbody');
                                                        $("#loading").hide()
                                                        response.data.forEach(function(item) {
                                                            const newRow = $('<tr>'); // Create a new table row
                                                            
                                                            // Create table cells and populate them with data
                                                            const domainCell = $('<td>').text(item.domain); // Create a cell for the 'domain' property
                                                            
                                                            // Append cells to the row
                                                            newRow.append(domainCell);
                                                            
                                                            // Append the row to the table body
                                                            tableBody.append(newRow);
                                                          });
                                                      
                                                    
                                                    })
                                                    .catch(function(error) {
                                                        // Handle errors here
                                                       console.log(error.message,'the error message')
                                                    });

                            //end axios suggest
                                }
                                else {
                                    $("#not_available").hide()
                                    $("#available").show()
                                    $("#price").text('NGN'+response.data.price * 1000 +10000)
                                    $("#search_food_tbody").hide()
                                    $('#getdomain').attr('href', 'https://wa.me/2349058744473/?text="Hi,%20I%20will%20like%20to%20use%20a%20customized%20domain%20for%20my%20VTUBIZ%20account.%20aDomain%20name:'+domain+'%20Price:%20'+response.data.price * 1000 +10000);
                                }
                                // Handle the successful response here
                            
                            })
                            .catch(function(error) {
                                // Handle errors here
                               console.log(error.message,'the error message')
                            });
            

                    }
                    else {
                        Toast.fire('Invalid domain')
                    }

                
        
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