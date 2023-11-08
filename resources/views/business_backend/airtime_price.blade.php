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
                        <h5>Airtime Prices</h5>
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
                        <h3 class="card-label">Data Prices
                        </h3>
                    </div>

                </div>
                <div class="card-body">
                    <form method='post' action='{{ route("save_admin_airtime") }}' >@csrf
                        <tbody>

                    <table class="datatable table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Network & Plan</th>
                               
                                <th scope="col">Actual rate </th>
                                <th scope="col">Airtime rate</th>

                            </tr>
                        </thead>
                      
                                @foreach($airtimes as $key => $airtime)

                                <tr>

                                 
                                    <td class='d-flex'>
                                        @if($airtime->network == 1)
                                        <span class='btn btn-warning'>MTN</span>
                                        @elseif($airtime->network == 2)
                                        <span class='btn btn-secondary'>GLO</span>
                                        @elseif($airtime->network == 3)
                                        <span class='btn btn-danger'>AIRTEL</span>
                                        @else
                                        <span class='btn btn-primary'>9MOBILE</span>
                                        @endif
                                    </td>
                                    <td><input readonly readonly name='actual_price'
                                           class='form-control'
                                            value="{{ $airtime->airtime_price }}" />
                                            <input type='hidden' name='id[]' value='{{ $airtime->id }}'/>
                                            <p>For NGN100, your customer is meant to be charged NGN{{ 100 - (($airtime->airtime_price/100) * 100) }}</p>
                                    </td>
                                        
                                    <td><input name='admin_price[]'
                                            class='form-control' min="1"
                                            value="{{ $airtime->admin_price }}" />
                                        <p @if($airtime->admin_price < $airtime->airtime_price) class='text-success' @else class='text-danger' @endif>For NGN100, your customer will now be charged NGN{{ 100 - (($airtime->admin_price/100) * 100) }}</p>
                                        </td>


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