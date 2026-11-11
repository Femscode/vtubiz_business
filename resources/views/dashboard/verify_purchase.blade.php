@extends('dashboard.master1')

@php
    $st = strtolower((string) ($response['status'] ?? ''));
    $tone = str_contains($st, 'success') || str_contains($st, 'deliver') || str_contains($st, 'complete') ? 'ok' : (str_contains($st, 'pend') || str_contains($st, 'process') ? 'pend' : 'fail');
@endphp

@include('dashboard.partials.verify-style')

@section('content')
<div class="pg pg-narrow">
    <div class="pg-head">
        <div>
            <h1>Verify <em>purchase</em></h1>
            <p>Check the delivery status of any purchase with its reference.</p>
        </div>
    </div>

    <div class="panel verify-search">
        <form method="post" action="{{ route('check_verify_purchase') }}">
            @csrf
            <label class="f-label" for="reference">Transaction reference</label>
            <div class="verify-form">
                <input type="text" value="{{ $ref ?? '' }}" id="reference" class="f-input" name="reference" placeholder="e.g. buy_data_ANBe3EC" required>
                <button type="submit" class="btn-v dark"><i class="fa-solid fa-magnifying-glass"></i> Verify</button>
            </div>
            <div class="f-hint">Find the reference under each item on your <a href="/mytransactions" style="font-weight:600">transactions</a> page.</div>
        </form>
    </div>

    @if(isset($response))
        <div class="panel" style="margin-top:20px">
            <div class="result-head">
                <span class="ic t-{{ $tone === 'ok' ? 'green' : ($tone === 'pend' ? 'amber' : 'pink') }}">
                    <i class="fa-solid {{ $tone === 'ok' ? 'fa-circle-check' : ($tone === 'pend' ? 'fa-clock' : 'fa-circle-exclamation') }}"></i>
                </span>
                <div style="min-width:0">
                    <b>Verification result</b>
                    <small>{{ $response['reference_no'] ?? '' }}</small>
                </div>
                <span class="badge-v {{ $tone }}" style="margin-left:auto">{{ $response['status'] ?? 'Unknown' }}</span>
            </div>

            @if(isset($response['network']))
                <div class="kv"><span>Network</span><span>{{ $response['network'] }}</span></div>
                <div class="kv"><span>Phone number</span><span>{{ $response['mobileno'] }}</span></div>
                <div class="kv"><span>Plan</span><span>{{ $response['dataplan'] }}</span></div>
            @elseif(isset($response['company']))
                <div class="kv"><span>Provider</span><span>{{ $response['company'] }}</span></div>
                <div class="kv"><span>Meter / IUC</span><span>{{ $response['meterno'] ?? $response['iucno'] ?? '' }}</span></div>
                @if(!empty($response['token']))
                    <div class="kv"><span>Token</span><span style="font-family:ui-monospace,monospace">{{ $response['token'] }}</span></div>
                @endif
            @endif
            @if(!empty($response['message']))
                <div class="kv"><span>Response</span><span>{{ $response['message'] }}</span></div>
            @endif

            <div class="no-print" style="margin-top:18px">
                <button type="button" class="btn-v light" onclick="window.print()"><i class="fa-solid fa-print"></i> Print</button>
            </div>
        </div>
    @endif
</div>
@endsection
