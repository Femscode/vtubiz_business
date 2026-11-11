@extends('dashboard.master1')

@section('content')
<div class="pg">
    <div class="pg-head">
        <div>
            <h1>Buy <em>data</em></h1>
            <p>Cheap data plans on every network, delivered instantly.</p>
        </div>
    </div>

    <buydata-component
        :user='{{ json_encode($user->only(['id', 'company_id', 'balance'])) }}'
        :beneficiaries='{{ $beneficiaries }}'
    ></buydata-component>
</div>
@endsection
