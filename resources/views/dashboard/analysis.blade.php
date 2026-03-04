@extends('dashboard.master1')

@section('header')
<style>
    .analysis-header {
        margin-bottom: var(--space-lg);
    }
    .analysis-header h1 {
        font-family: 'Fraunces', serif;
        font-size: 2.2rem;
        color: var(--primary-dark);
        margin-bottom: 8px;
    }
</style>
@endsection 

@section('content')
<div class="analysis-header">
    <h1>Transaction Analysis</h1>
    <p class="text-muted">Gain insights into your spending habits and transaction volume.</p>
</div>

<div id='app' class="row">
    <div class="col-12">
        <my-analysis :this_year='{{ $this_year }}' :this_month='{{ $this_month }}' :phone="{{ $phone }}" :total_price_by_restaurant='{{ $total_price_by_restaurant }}' :total_price='{{ $total_price }}' :user='{{ $user  }}'></my-analysis>
    </div>
</div>
@endsection 

@section('script')
<script>
    $(document).ready(function() {
        @if (session('message'))
            Swal.fire({ icon: 'success', title: 'Success!', text: "{{ session('message') }}", confirmButtonColor: '#0F3548' });
        @endif
    });
</script>
@endsection
