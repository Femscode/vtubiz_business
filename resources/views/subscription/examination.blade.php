@extends('dashboard.master1')

@section('content')
<div class="pg">
    <div class="pg-head">
        <div>
            <h1>Exam <em>pins</em></h1>
            <p>WAEC, NECO and NABTEB result checkers.</p>
        </div>
    </div>

    <div class="panel purchase-panel">
        <examination-component :user='{{ $user  }}' :examinations='{{ $examinations }}' :company='{{ $company }}'></examination-component>
    </div>
</div>
@endsection
