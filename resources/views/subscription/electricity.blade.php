@extends('dashboard.master1')

@section('content')
<div class="pg">
    <div class="pg-head">
        <div>
            <h1>Pay <em>electricity</em></h1>
            <p>Prepaid and postpaid meters on every DisCo.</p>
        </div>
    </div>

    <div class="panel purchase-panel">
        <electricity-component :user='{{ $user  }}' :beneficiaries='{{$beneficiaries}}'></electricity-component>
    </div>
</div>
@endsection
