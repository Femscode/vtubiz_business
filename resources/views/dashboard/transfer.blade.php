@extends('dashboard.master1')

@section('header')
<style>
    /* Re-layout the legacy TransferComponent markup (rendered inside .xfer) */
    #app .xfer .card {
        border: 0 !important;
        box-shadow: none !important;
        background: transparent !important;
        border-radius: 0 !important;
    }

    .xfer .col-md-12,
    .xfer .card-body {
        padding: 0 !important;
    }

    .xfer .card-body>.row:first-child {
        display: none;
    }

    .xfer .form-group.row {
        display: block;
        margin: 0 0 18px !important;
    }

    .xfer .form-group.row>* {
        width: 100% !important;
        max-width: 100% !important;
        flex: none !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    .xfer .form-group.row>h6 {
        font-weight: 600;
        font-size: .86rem;
        color: #2B3445;
        margin-bottom: 8px !important;
    }

    .xfer .form-group.row>.col-md-3:empty {
        display: none;
    }

    #app .xfer input.form-control[readonly] {
        background: #F3F3F0 !important;
        color: var(--ink) !important;
        font-weight: 600 !important;
    }

    #app .xfer .btn-success {
        width: 100% !important;
        background: var(--primary-dark) !important;
        padding: 15px 22px !important;
        font-size: .98rem !important;
        margin-top: 6px !important;
    }

    #app .xfer .btn-success:disabled {
        opacity: .45;
    }
</style>
@endsection

@section('content')
<div class="pg">
    <div class="pg-head">
        <div>
            <h1>Send <em>money</em></h1>
            <p>Transfer instantly to any VTUBIZ user.</p>
        </div>
    </div>

    <div class="grid-v main-side">
        <div class="panel">
            <div class="panel-head">
                <div>
                    <h3>Transfer details</h3>
                    <p>Enter the recipient's account ID (their registered phone number).</p>
                </div>
            </div>
            <div class="xfer">
                <transfer-component :user='{{ $user }}'></transfer-component>
            </div>
        </div>

        <div>
            <div class="hero-v">
                <div class="k">Available balance</div>
                <div class="v" style="font-size:2rem;margin-top:8px">₦{{ number_format((float) $user->balance, 2) }}</div>
                <a href="/fundwallet" class="btn-v sm" style="background:#fff;color:var(--primary-dark);margin-top:18px">
                    <i class="fa-solid fa-plus"></i> Fund wallet
                </a>
            </div>

            <div class="note-v info" style="margin-top:16px">
                <i class="fa-solid fa-circle-info"></i>
                <div>Check the account name before you send. Transfers between VTUBIZ wallets are instant and can't be reversed.</div>
            </div>
        </div>
    </div>
</div>
@endsection
