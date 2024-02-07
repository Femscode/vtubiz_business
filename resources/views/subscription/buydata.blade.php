@extends('dashboard.master1')

@section('header')
@endsection 

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Container-->
    <div  id="kt_app_content" class="app-content  flex-column-fluid ">
        <!--begin::Profile Account Information-->
        <div id='app' class="row">
            <!--begin::Aside-->
          
            <!--end::Aside-->
            <!--begin::Content-->
            <div class='col-md-12'>
                <div class='card '>
                    <div class='alert alert-primary'>
                        <p style='font-weight:100'>You can now buy data in bulk, create custom recipient groups (like staff or
                            family),
                            and purchase data for every group member at once with a single click. Click <a
                                style='color:red' href='/data_group'>here to try it out!</a></p>
                    </div>
                </div>
            </div>
         <buydata-component :user='{{ $user  }}' :company='{{ $company }}' :beneficiaries='{{ $beneficiaries }}'></buydata-component>
            <!--end::Content-->
        </div>
        <!--end::Profile Account Information-->
    </div>
    <!--end::Container-->
</div>
@endsection 

@section('script')
<script>
    $(document).ready(function() {

        @if (session('message'))
        Swal.fire('Success!',"{{ session('message') }}",'success');
    @endif
        $("#u_amount").on('input',function() {
        var amount = parseInt($("#u_amount").val()) * 100;
      
       
        if(parseInt($("#u_amount").val()) < 2500) {
            $("#amount").val((amount) + (0.05 * amount));
          
        }
        else {
            $("#amount").val((amount) + (0.05 * amount) +10000);
          
          
        }
        
        // alert($("#u_amount").val() * 100)
    })
    })

</script>
@endsection