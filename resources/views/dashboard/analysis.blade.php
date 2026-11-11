@extends('dashboard.master1')

@section('content')
<div class="pg">
    <div class="pg-head">
        <div>
            <h1>Spending <em>insights</em></h1>
            <p>See where your money goes, month by month.</p>
        </div>
    </div>

    <div class="panel">
        <my-analysis :this_year='{{ $this_year }}' :this_month='{{ $this_month }}' :phone="{{ $phone }}" :total_price_by_restaurant='{{ $total_price_by_restaurant }}' :total_price='{{ $total_price }}' :user='{{ $user  }}'></my-analysis>
    </div>
</div>
@endsection
