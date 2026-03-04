@extends('dashboard.master1')

@section('header')
@endsection 

@section('content')
<div class="service-header">
    <h1>Electricity</h1>
    <p class="text-muted">Pay your electricity bills for all distribution companies nationwide.</p>
</div>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="service-card-wrapper">
            <electricity-component :user='{{ $user  }}' :beneficiaries = '{{$beneficiaries}}'></electricity-component>
        </div>
    </div>
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