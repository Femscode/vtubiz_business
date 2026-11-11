@extends('dashboard.master1')

@section('content')
<div class="pg pg-narrow">
    <a href="/fundwallet" class="pg-back"><i class="fa-solid fa-arrow-left"></i> Fund wallet</a>
    <div class="pg-head">
        <div>
            <h1>Manual <em>funding</em></h1>
            <p>Automatic funding is unavailable right now. Pay into the account below.</p>
        </div>
    </div>

    <div class="grid-v cols-2">
        <div class="hero-v">
            <div class="k">Account number</div>
            <div class="v" style="font-size:2rem;letter-spacing:.04em;margin:6px 0 16px" id="manualAcct">9058744473</div>
            <div class="k">Bank</div>
            <div class="v" style="margin:4px 0 14px">MONIEPOINT</div>
            <div class="k">Account name</div>
            <div class="v" style="font-size:1.1rem;margin-top:4px">CTHOSTEL PRODUCTS AND SERVICES</div>
        </div>

        <div class="panel">
            <div class="panel-head">
                <div>
                    <h3>Tell us what you sent</h3>
                    <p>We'll confirm it and credit your wallet.</p>
                </div>
            </div>
            <form method="POST" action="{{ route('manualpayment', ['subdomain']) }}">
                @csrf
                <div class="f-group">
                    <label class="f-label" for="amount">Amount sent</label>
                    <div class="f-affix">
                        <span class="pre">₦</span>
                        <input type="number" id="amount" name="amount" class="f-input f-input-lg" placeholder="0" required />
                    </div>
                </div>
                <button type="submit" class="btn-v dark block"><i class="fa-solid fa-paper-plane"></i> Notify admin</button>
            </form>
        </div>
    </div>
</div>
@endsection
