@extends('dashboard.master1')

@section('header')
<script src="https://checkout.flutterwave.com/v3.js"></script>
<style>
    .payment-card {
        background: white;
        border-radius: var(--radius-lg);
        padding: 40px;
        box-shadow: var(--shadow-card);
        max-width: 500px;
        margin: 40px auto;
        text-align: center;
        border: 1px solid rgba(0,0,0,0.05);
    }
    .payment-icon {
        width: 80px;
        height: 80px;
        background: rgba(251, 145, 41, 0.1);
        color: var(--accent-orange);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        margin: 0 auto 24px;
    }
    .payment-title {
        font-family: 'Fraunces', serif;
        font-size: 1.8rem;
        color: var(--primary-dark);
        margin-bottom: 12px;
    }
    .payment-amount {
        font-family: 'Fraunces', serif;
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--accent-green);
        margin: 20px 0;
    }
    .payment-desc {
        color: var(--text-secondary);
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: 32px;
    }
    .btn-payment {
        background: var(--primary-dark);
        color: white;
        border: none;
        padding: 16px 32px;
        border-radius: var(--radius-pill);
        font-weight: 700;
        font-size: 1.1rem;
        width: 100%;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
    }
    .btn-payment:hover {
        background: var(--primary-light);
        transform: translateY(-2px);
        color: white;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="payment-card">
        <div class="payment-icon">
            <i class="fa-solid fa-credit-card"></i>
        </div>
        <h2 class="payment-title">Card Payment</h2>
        <p class="payment-desc">You are about to fund your wallet securely via Flutterwave.</p>
        
        <div class="payment-amount">
            ₦{{ number_format($amount, 2) }}
        </div>

        <input id='phone' value='{{ $user->phone }}' type='hidden' />
        <input id='name' value='{{ $user->name }}' type='hidden' />
        <input id='email' value='{{ $user->email }}' type='hidden' />
        <input id='amount' value='{{ $amount }}' type='hidden' />
        <input id='redirect_url' value='{{ $callback_url }}' type='hidden' />
        <input id='public_key' value='{{ $public_key }}' type='hidden' />

        <button class="btn btn-payment" onclick="makePayment()">
            <span>Proceed to Payment</span>
            <i class="fa-solid fa-arrow-right"></i>
        </button>
        
        <div class="mt-4">
            <img src="https://flutterwave.com/images/flutterwave-badge.png" alt="Flutterwave Secured" style="height: 30px; opacity: 0.7;">
        </div>
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
