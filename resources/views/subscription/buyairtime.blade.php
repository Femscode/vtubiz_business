@extends('dashboard.master1')

@section('content')
<div class="pg">
    <div class="pg-head">
        <div>
            <h1>Buy <em>airtime</em></h1>
            <p>Instant top-up on MTN, Glo, Airtel and 9mobile.</p>
        </div>
    </div>

    <buyairtime-component
        :user='{{ json_encode($user->only(['id', 'company_id', 'balance'])) }}'
        :beneficiaries='{{ $beneficiaries }}'
    ></buyairtime-component>
</div>
@endsection
