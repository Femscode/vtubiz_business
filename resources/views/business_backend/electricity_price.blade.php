@extends('business_backend.master')
@section('header')
@endsection
@section('content')


<div class="container-fluid">



    <div class="row">

        <div class="col-lg-12">

            <div class="row mb-3">
                <div class="col-xl-4 col-sm-6">
                    <div class="mt-2">
                        <h5>Electricity Prices</h5>
                    </div>
                </div>

            </div>

            <!-- end row -->

        </div>
    </div>

    <div class="row">

        <!--begin::Content-->
        <div class="col-md-12">
            <!--begin::Card-->
            <div class="card card-custom">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Electricity Prices
                        </h3>
                    </div>

                </div>
                <div class="card-body">
                    <form method='post' action='{{ route("save_admin_electricity") }}'>@csrf
                        <tbody>

                            <table class="datatable table table-striped">
                                <thead>
                                    <tr>
                                       

                                        <th scope="col">Actual Rate(%) </th>
                                        <th scope="col">Admin Rate(%)</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>

                                @foreach($electricities as $key => $electricity)

                                <tr>


                                  
                                    <td>
                                        <input type='hidden' name='id' value='{{ $electricity->id }}'/>
                                        <input readonly disabled name='actual_amount'
                                             class='form-control'
                                            value="{{ $electricity->actual_amount }}" />
                                            <p>For NGN1000 token, your customer is meant to be charged NGN{{ 1000 - (( $electricity->actual_amount /1000) * 100) }}</p>
                                        </td>
                                    <td><input name='real_amount' min='1'
                                             class='form-control'
                                            value="{{ $electricity->real_amount }}" />
                                            <p @if($electricity->real_amount < $electricity->actual_amount)class='text-success'  @else class='text-danger' @endif>For NGN1000 token, your customer will now be charged NGN{{ 1000 - (( $electricity->real_amount /1000) * 100) }}</p>
                                        
                                        </td>
                                            <td> <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Update</button>
                                            
                                            </td>


                                </tr>
                                @endforeach

                        </tbody>

                        </table>
                        <!--end: Datatable-->
                </div>
               
                </form>


            </div>
            <!--end::Card-->
        </div>
        <!--end::Content-->
    </div>
</div>
<!-- end row -->



<!-- end row -->
</div>
@section('script')
<script>
    $(document).ready(function() {
       
        var oTable = $('.datatable').DataTable({
            ordering: false,
            searching: true
            });   
            $('#searchTable').on('keyup', function() {
              oTable.search(this.value).draw();
            });
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
                @if (session('success'))
        Toast.fire({
                        icon: 'success',
                        title: '{{ session("success") }}'
                        }) 
           
        @endif
      

    })
</script>
@endsection
@endsection