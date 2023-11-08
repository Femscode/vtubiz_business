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
                        <h5>Bulk SMS Prices</h5>
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
                        <h3 class="card-label">Bulk SMS Price
                        </h3>
                    </div>

                </div>
                <div class="card-body">
                    <form method='post' action='{{ route("save_admin_bulksms") }}'>@csrf
                        <tbody>

                            <table class="datatable table table-striped">
                                <thead>
                                    <tr>


                                        <th scope="col">Actual Price </th>
                                        <th scope="col">Admin Price</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>

                              

                                <tr>



                                    <td>
                                        <input type='hidden' name='id' value='' />
                                        <input readonly disabled name='actual_amount' class='form-control'
                                            value="3.8" />
                                    </td>
                                    <td><input name='real_amount' class='form-control @if($user->bulksms_price > 3.8) text-success @else text-danger @endif'
                                            value="{{ $user->bulksms_price }}" /></td>
                                    <td> <button type="submit" class="btn btn-primary"
                                            id="kt_account_profile_details_submit">Update</button></td>


                                </tr>
                             

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