@extends('dashboard.master1')

@php
    $st = strtolower((string) ($response['status'] ?? ''));
    $tone = str_contains($st, 'success') || str_contains($st, 'paid') || str_contains($st, 'complete') ? 'ok' : (str_contains($st, 'pend') ? 'pend' : 'fail');
@endphp

@include('dashboard.partials.verify-style')

@section('content')
<div class="pg pg-narrow">
    <div class="pg-head">
        <div>
            <h1>Verify <em>funding</em></h1>
            <p>Didn't see a deposit? Check it with the transfer reference.</p>
        </div>
    </div>

    <div class="panel verify-search">
        <form method="post" action="{{ route('admin_check_verify_payment') ?? '' }}">
            @csrf
            <label class="f-label" for="reference">Payment reference</label>
            <div class="verify-form">
                <input type="text" value="{{ $ref ?? '' }}" id="reference" class="f-input" name="reference" placeholder="Enter the payment reference" required>
                <button type="submit" class="btn-v dark"><i class="fa-solid fa-magnifying-glass"></i> Verify</button>
            </div>
            <div class="f-hint">You'll find it on your bank's transfer receipt.</div>
        </form>
    </div>

    @if(isset($response))
        <div class="panel" style="margin-top:20px">
            <div class="result-head">
                <span class="ic t-{{ $tone === 'ok' ? 'green' : ($tone === 'pend' ? 'amber' : 'pink') }}">
                    <i class="fa-solid {{ $tone === 'ok' ? 'fa-circle-check' : ($tone === 'pend' ? 'fa-clock' : 'fa-circle-exclamation') }}"></i>
                </span>
                <div style="min-width:0">
                    <b>₦{{ number_format((float) ($response['amount'] ?? 0), 2) }}</b>
                    <small>{{ $response['id'] ?? '' }}</small>
                </div>
                <span class="badge-v {{ $tone }}" style="margin-left:auto">{{ $response['status'] ?? 'Unknown' }}</span>
            </div>
            <div class="kv"><span>Channel</span><span>{{ $response['payment_type'] ?? 'N/A' }}</span></div>
            <div class="kv"><span>Sender</span><span>{{ $response['meta']['originatorname'] ?? 'N/A' }}</span></div>
            <div class="kv"><span>Bank</span><span>{{ $response['meta']['bankname'] ?? 'N/A' }}</span></div>
            <div class="kv"><span>Account</span><span>{{ $response['meta']['originatoraccountnumber'] ?? 'N/A' }}</span></div>
            <div class="kv"><span>Date</span><span>{{ $response['created_at'] ?? '' }}</span></div>

            <div class="no-print" style="margin-top:18px">
                <button type="button" class="btn-v light" onclick="window.print()"><i class="fa-solid fa-print"></i> Print</button>
            </div>
        </div>
    @endif
</div>
@endsection
