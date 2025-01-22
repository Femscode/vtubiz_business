@extends('dashboard.master1')

@section('header')
<style>
    .credit-card {
        background: linear-gradient(to right, #fb9129, #155724);
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        color: white;
        width: 100%;
        max-width: 400px;
        margin: 20px auto;
        padding: 20px;
        text-align: left;
    }

    .credit-card .label {
        font-size: 14px;
        font-weight: 600;
        color: #f8f9fa;
        margin-bottom: 4px;
    }

    .credit-card .value {
        font-size: 18px;
        font-weight: bold;
        color: #ffffff;
    }

    .alert-info {
        border: 2px dotted grey;
        background: #eaf7ff;
        color: #31708f;
    }

    .form-control {
        border-radius: 8px;
        margin-bottom: 10px;
    }

    .btn-success {
        background-color: #28a745;
        border: none;
        border-radius: 6px;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: bold;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    .text-center .section-title {
        font-size: 20px;
        font-weight: bold;
        color: #555;
    }

    .section-heading {
        color: #6c757d;
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .section-subtext {
        color: #6c757d;
        font-size: 14px;
        margin-bottom: 20px;
    }
</style>
@endsection

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- Begin: Card -->
                <div class="card card-custom">
                    <div class="card-body">
                        <!-- Heading -->
                        <div class="text-center my-4">
                            <span class="section-title">-- ACCOUNT FUNDING --</span>
                        </div>

                        <div class="alert alert-info">
                            Automatic funding is currently unavailable. Kindly send your funds to the account number below.
                        </div>

                        <!-- Funding Form -->
                        <form method="POST" action="{{ route('manualpayment', ['subdomain']) }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                            @csrf
                            <div class="credit-card">
                                <div class="section-heading">Bank Account Details</div>
                                <div>
                                    <div class="label">Account Number:</div>
                                    <div class="value">9058744473</div>
                                </div>
                                <div>
                                    <div class="label">Bank Name:</div>
                                    <div class="value">MONIEPOINT</div>
                                </div>
                                <div>
                                    <div class="label">Account Name:</div>
                                    <div class="value">CTHOSTEL PRODUCTS AND SERVICES</div>
                                </div>
                            </div>

                            <div>
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" id="amount" name="amount" class="form-control" placeholder="Enter the amount you sent" required />
                            </div>
                            <button type="submit" class="btn btn-success btn-sm mt-2">Message Admin to Confirm Payment</button>
                        </form>
                    </div>
                </div>
                <!-- End: Card -->
            </div>
        </div>
    </div>
</div>
@endsection
