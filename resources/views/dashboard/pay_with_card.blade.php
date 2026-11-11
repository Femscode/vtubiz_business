@extends('dashboard.master1')

@section('header')
<script src="https://checkout.flutterwave.com/v3.js"></script>
@endsection

@section('content')
<div class="pg pg-narrow" style="max-width:520px">
    <a href="/fundwallet" class="pg-back"><i class="fa-solid fa-arrow-left"></i> Fund wallet</a>

    <div class="hero-v" style="text-align:center;padding:34px 26px">
        <div class="k">You're adding</div>
        <div class="v" style="font-size:2.8rem;margin:8px 0 6px">₦{{ number_format((float) $amount, 2) }}</div>
        <div style="color:rgba(255,255,255,.65);font-size:.9rem">to your VTUBIZ wallet</div>
    </div>

    <div class="panel" style="margin-top:16px;text-align:center">
        <input id="phone" value="{{ $user->phone }}" type="hidden" />
        <input id="name" value="{{ $user->name }}" type="hidden" />
        <input id="email" value="{{ $user->email }}" type="hidden" />
        <input id="amount" value="{{ $amount }}" type="hidden" />
        <input id="redirect_url" value="{{ $callback_url }}" type="hidden" />
        <input id="public_key" value="{{ $public_key }}" type="hidden" />

        <button type="button" class="btn-v dark block" onclick="makePayment()"><i class="fa-regular fa-credit-card"></i> Pay with card or USSD</button>
        <div class="f-hint" style="justify-content:center;margin-top:14px"><i class="fa-solid fa-lock"></i> Secured by Flutterwave. We never see your card details.</div>
    </div>
</div>
@endsection

@section('script')
<script>
    const phone = $("#phone").val();
    const email = $("#email").val();
    const name = $("#name").val();
    const amount = $("#amount").val();
    const public_key = $("#public_key").val();
    const redirect_url = $("#redirect_url").val();

    function makePayment() {
        FlutterwaveCheckout({
            public_key: public_key,
            tx_ref: "titanic-" + Math.floor(Math.random() * 1000000000),
            amount: amount,
            currency: "NGN",
            payment_options: "card, mobilemoneyghana, ussd",
            redirect_url: redirect_url,
            customer: {
                email: email,
                phone_number: phone,
                name: name,
            },
            customizations: {
                title: "VTUBIZ Checkout",
                description: "Fast and Easy Payment",
                logo: "https://vtubiz.com/assets/img/logo/vtulogo.png",
            },
        });
    }
</script>
@endsection
