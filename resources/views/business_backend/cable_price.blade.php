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
                        <h5>Data Prices</h5>
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
                        <h3 class="card-label">Cable Prices
                        </h3>
                    </div>

                </div>
                <div class="card-body">
                    <form method='post' action='{{ route("save_admin_cable") }}' >@csrf
                        <tbody>

                    <table class="datatable table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Network & Plan</th>
                               
                                <th scope="col">Actual Price </th>
                                <th scope="col">Admin Price</th>

                            </tr>
                        </thead>
                      
                                @foreach($cables as $key => $cable)

                                <tr>

                                 
                                    <td class='d-flex'>
                                        <input type='hidden' name='id[]' value='{{ $cable->id }}'/>
                                        <input name='plan_name[]'
                                            class='form-control' value="{{ $cable->plan_name }}" /></td>
                                    <td><input readonly disabled name='cable_price[]'
                                          class='form-control'
                                            value="{{ $cable->real_price }}" /></td>
                                    <td><input name='admin_price[]'
                                           class='form-control @if($cable->admin_price > $cable->real_price) text-success @else text-danger @endif'
                                            value="{{ $cable->admin_price }}" /></td>


                                </tr>
                                @endforeach

                            </tbody>
                            
                    </table>
                    <!--end: Datatable-->
                </div>
                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Update</button>
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