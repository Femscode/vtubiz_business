@extends('dashboard.master1')
@section('content')
<div class="d-flex flex-column flex-column-fluid">


    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <!--begin::Card-->
        <div class="card card-custom">
            <!--begin::Header-->
            <div class="card-header py-3">
                <div class="card-title align-items-start flex-column">
                    <h3 class="card-label font-weight-bolder text-dark">My Referrals</h3>
                </div>

            </div>
            <!--end::Header-->
            <!--begin::Form-->

            <div class="card-body">


                <div class="card card-dashed bg-light-secondary flex-row flex-stack flex-wrap p-6 m-2">
                    <!--begin::Info-->
                    <div class="d-flex flex-column p-2 m-2">
                        <!--begin::Owner-->

                        <!--end::Owner-->

                        <!--begin::Wrapper-->
                        <div class="d-flex align-items-center">
                           
                            <div>
                                <p class='bg bg-light-primary p-2'>Earn an enticing 5% cashback on every purchase made by users you refer!</p>
                                <div class="fs-6 fw-semibold text-gray-600">
                                    Copy & Share Your Referral Link :</div>
                                <div class="fs-6 fw-light">
                                 
                                    <i id='acctNo'>https://vtubiz.com/register?referral_code={{ $user->brand_name }}</i>
                                    {{-- <input class='form-control' value='https://vtubiz.com/'/> --}}

                                    <a style='cursor:pointer' id='copyAcct'>
                                        <i class='bi-clipboard m-2'>
                                        </i>
                                    </a>
                                </div>

                                <div class="form-group row mb-2">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Total Referrals:</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <button type="button" class="btn btn-light-primary font-weight-bold btn-sm">{{ count($users) }}</button>
                                       
                                     </div>
                                </div>
                                <div class="form-group row mb-2">
                                    <label class="col-xl-3 col-lg-3 col-form-label">Total Earnings:</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <button type="button" class="btn btn-light-success font-weight-bold btn-sm">NGN {{ number_format($earnings) }}</button>
                                        <a href="/remitearning" class="btn btn-success font-weight-bold btn-sm">Remit Earnings</a>
                                       
                                     </div>
                                </div>
                               
                              
                                {{-- <span class='text-danger'>Please transfer only the exact amount above!</span> --}}
                            </div>
                           
                        </div>
                       
                    </div>

                </div>

                <div class="row">

                    <!--begin::Content-->
                    <div class="col-md-12">
                        <!--begin::Card-->
                        <div class="card card-custom">
                          
                            <div class="card-body">
            
                                <div style='overflow-x:auto;max-width: 100%'>
                                    <table style='width:100%' class="datatable table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
            
                                                <th scope="col">Earnings </th>
                                               
                                                <th scope="col">Actions</th>
            
                                            </tr>
                                        </thead>
            
                                        @foreach($users as $key => $user)
            
                                        <tr>
            
            
                                            <td>
                                                {{ $user->name }}<br><i> {{ $user->phone }}</i>
                                            </td>
                    
                                            <td>
                                                NGN{{ number_format($user->spent,2) }}
                                            </td>
                                            <td>
                                                <a class='btn btn-warning btn-sm'  href='https://wa.me/234/{{ substr($user->phone,0,1) }}'>Message</a>
                                              
                                               
                                            </td>
            
            
            
            
                                        </tr>
                                        @endforeach
            
                                        </tbody>
            
                                    </table>
                                    <!--end: Datatable-->
                                </div>
            
            
            
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Content-->
                    </div>
                </div>


            </div>

        </div>
        <!--end::Card-->
    </div>
</div>
@endsection
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
        @if (session('message'))
        Swal.fire('Success!',"{{ session('message') }}",'success');
    @endif
   @if (session('error'))
        Swal.fire('Incorrect Pin!',"{{ session('error') }}",'error');
    @endif

    $('#copyAcct').click(function() {
      // Select the input field content
      var tempTextarea = $('<textarea>');
            
            // Set its value to the content of acctNo
            tempTextarea.val($('#acctNo').text());
            
            // Append it to the body and select its content
            $('body').append(tempTextarea);
            tempTextarea.select();
            
            // Copy the selected text to the clipboard
            document.execCommand('copy');
            
            // Remove the temporary textarea
            tempTextarea.remove();

      // You can add a visual feedback if needed, for example, change the icon color or show a tooltip
     
      $("#copyAcct").text('Copied')

      // Optionally, revert the icon color after a short delay
      setTimeout(function() {
        $('#copyAcct').html('<i class="bi-clipboard"></i>'); // Revert to the original color (empty string removes inline style)
      }, 1000); // Adjust the delay as needed
    });
    $("#reset_pin").click(function() {
        Swal.fire({
title: 'You are about to reset your pin?',
text: 'A token will be sent to your email, copy the token to reset your pin!',
icon: 'warning',
showCancelButton: true,
confirmButtonText: 'Yes, reset',
cancelButtonText: 'Cancel'
}).then((result) => {
if (result.isConfirmed) {
   Swal.fire('Sending your token, please wait...')
        $.ajax({
       type: 'POST',
       url: "{{route('forgot-pin')}}",
      
       cache: false,
       contentType: false,
       processData: false,
       success: function(data) {
          console.log(data)
          location.href = 'http://127.0.0.1:8000/reset-pin-with-token';
       },
       error: function(data) {
           console.log(data)
           Swal.close()
          
           Swal.fire('Opps!', 'Something went wrong, please try again later', 'error')
       }
   })
}
})
    })
    })
  
</script>
@endsection