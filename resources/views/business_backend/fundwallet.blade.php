@extends('business_backend.master')
@section('header')
<style>
    /* General Styling */
    body {
        font-family: Arial, sans-serif;
    }

    .credit-card {
        background: linear-gradient(to right, #fb9129, #155724);
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        width: 100%;
        max-width: 400px;
        margin: 20px auto;
        color: white;
        padding: 20px;
    }

    .card {
        border: none;
        background: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .btn-lg {
        background-color: #28a745;
        color: white;
        font-size: 1.1rem;
        padding: 10px 20px;
        border-radius: 8px;
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-lg:hover {
        background-color: #218838;
    }

    .form-control {
        border: 1px solid #ced4da;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 15px;
        font-size: 1rem;
    }

    .text-gray-500 {
        color: #6c757d;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
        border-radius: 5px;
        padding: 20px;
        margin-top: 20px;
    }

    .alert-success h2 {
        font-size: 1.5rem;
    }

    #bvnfield {
        margin-top: 10px;
        display: none;
    }
</style>
@endsection

@section('content')
<div class="container mt-4">
    <div class="text-center mb-4">
        <h2 class="text-gray-500 fw-bold">-- ACCOUNT FUNDING --</h2>
    </div>
    
    <!-- Funding Form -->
    <div class="card mb-4">
        <form method="POST" action="{{ route('checkout', ['subdomain']) }}" accept-charset="UTF-8" class="form-horizontal">
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

            <button type="submit" class="btn btn-lg btn-block mt-4">
                <i class="fa fa-plus-circle"></i> Fund Wallet
            </button>
        </form>
    </div>

    <!-- Or Divider -->
    <div class="text-center mb-4">
        <h4>-------------- Or --------------</h4>
    </div>

    <!-- Virtual Account Details -->
    @if($user->account_no)
    <div class="credit-card">
        <h4>Transfer to Your Virtual Account</h4>
        <p><strong>Acct. No:</strong> {{ $user->account_no }}</p>
        <p><strong>Bank Name:</strong> {{ $user->bank_name }}</p>
        <p><strong>Account Name:</strong> {{ $user->account_name }}</p>
    </div>
    @else
    <div class="alert alert-success">
        <h2>Get Your Permanent Virtual Account!</h2>
        <ol>
            <li>Send any amount anytime</li>
            <li>Enjoy lower charges</li>
            <li>Experience faster funding transactions</li>
        </ol>
        <a id="showBvn" style="cursor: pointer; color: #007bff;">Click here to generate your permanent virtual account →</a>
        <div id="bvnfield">
            <form method="POST" action="/generatePermanentAccount">
                @csrf
                <input type="number" name="bvn" placeholder="Enter Your BVN" class="form-control d-inline-block" style="width: auto;">
                <button type="submit" class="btn btn-success d-inline-block">Generate</button>
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
            $("#bvnfield").toggle();
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
