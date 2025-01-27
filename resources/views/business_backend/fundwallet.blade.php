@extends('business_backend.master')

@section('header')
<style>
    /* Global Styles */
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f5f6fa;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 450px;
        margin: 0 auto;
        padding: 20px;
    }

    .text-center {
        text-align: center;
    }

    .card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-bottom: 20px;
    }

    .credit-card {
        background: linear-gradient(to right, #e2e3e5, #e2e3e5);
        color: #fff;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        margin-bottom: 20px;
    }

    .credit-card h4 {
        margin-bottom: 10px;
        font-size: 1.2rem;
        font-weight: bold;
    }

    .credit-card p {
        margin: 5px 0;
        font-size: 1rem;
    }

    .btn {
        background-color: #383d41;
        color: #fff;
        font-size: 1.1rem;
        border: none;
        border-radius: 8px;
        padding: 12px 20px;
        width: 100%;
        text-transform: uppercase;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #383d41;
    }

    .form-control {
        border: 1px solid #ced4da;
        border-radius: 8px;
        padding: 12px;
        font-size: 1rem;
        margin-bottom: 20px;
    }

    .form-check-label {
        font-size: 1rem;
    }

    .divider {
        text-align: center;
        color: #6c757d;
        margin: 20px 0;
        position: relative;
    }

    .divider::before, .divider::after {
        content: "";
        display: block;
        width: 40%;
        height: 1px;
        background: #ddd;
        position: absolute;
        top: 50%;
    }

    .divider::before {
        left: 0;
    }

    .divider::after {
        right: 0;
    }

    .alert {
        background: #e9f7ef;
        border: 1px solid #28a745;
        border-radius: 8px;
        padding: 15px;
        margin-top: 20px;
        color: #155724;
    }

    #bvnfield {
        display: none;
        margin-top: 10px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <!-- Page Title -->
    <div class="text-center mb-4">
        <h2 class="fw-bold" style="color: #383d41;">Account Funding</h2>
    </div>

    <!-- Funding Form -->
    <div class="card">
        <form method="POST" action="{{ route('checkout', ['subdomain']) }}" accept-charset="UTF-8">
            @csrf
            <input required name="amount" type="number" min="100" id="u_amount" class="form-control" placeholder="Enter Amount">
            <span class="text-danger" id="show_charge"></span>

            <div class="mt-3">
                <div class="form-check">
                    <input required type="radio" name="type" value="transfer" class="form-check-input" id="transferOption">
                    <label class="form-check-label" for="transferOption">Automatic Bank Transfer</label>
                </div>
                <div class="form-check">
                    <input required type="radio" name="type" value="card" class="form-check-input" id="cardOption">
                    <label class="form-check-label" for="cardOption">Pay With Credit Card</label>
                </div>
            </div>

            <button type="submit" class="btn mt-4">Fund Wallet</button>
        </form>
    </div>

    <!-- Divider -->
    <div class="divider">Or</div>

    <!-- Virtual Account Details -->
    @if($user->account_no)
    <div class="credit-card">
        <h4>Transfer to Your Virtual Account</h4>
        <p><strong>Acct. No:</strong> {{ $user->account_no }}</p>
        <p><strong>Bank Name:</strong> {{ $user->bank_name }}</p>
        <p><strong>Account Name:</strong> {{ $user->account_name }}</p>
    </div>
    @else
    <div class="alert">
        <h4>Get Your Permanent Virtual Account!</h4>
        <ul>
            <li>Send any amount anytime</li>
            <li>Enjoy lower charges</li>
            <li>Experience faster funding transactions</li>
        </ul>
        <a id="showBvn" style="cursor: pointer; color: #383d41;">Click <span style="color:red">here</span> to generate your permanent virtual account &rarr;</a>
        <div id="bvnfield">
            <form method="POST" action="/generatePermanentAccount">
                @csrf
                <input type="number" name="bvn" placeholder="Enter Your BVN" class="form-control">
                <button type="submit" class="btn mt-2">Generate</button>
            </form>
        </div>
    </div>
    @endif
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        // Show success alert if session message exists
        @if (session('message'))
        Swal.fire('Success!', "{{ session('message') }}", 'success');
        @endif

        // Toggle BVN field visibility
        $("#showBvn").on('click', function() {
            $("#bvnfield").slideToggle();
        });

        // Calculate charges on amount input
        $("#u_amount").on('input', function() {
            let price = $("#u_amount").val();
            let charges;

            if (price <= 1000) {
                charges = 25;
            } else if (price < 5000) {
                charges = 50;
            } else {
                charges = 100;
            }
            $("#show_charge").text("Charges: NGN " + charges);
        });
    });
</script>
@endsection
