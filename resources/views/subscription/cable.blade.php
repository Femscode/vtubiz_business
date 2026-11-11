@extends('dashboard.master1')

@section('content')
<div class="pg">
    <div class="pg-head">
        <div>
            <h1>Cable <em>TV</em></h1>
            <p>Renew DStv, GOtv and Startimes in seconds.</p>
        </div>
    </div>

    <div class="panel purchase-panel">
        <cable-component :user='{{ $user  }}' :beneficiaries='{{$beneficiaries}}'></cable-component>
    </div>
</div>
@endsection
