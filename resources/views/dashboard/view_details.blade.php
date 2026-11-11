@extends('dashboard.master1')

@section('content')
<div class="pg pg-narrow">
    <a href="/bulksms_transactions" class="pg-back"><i class="fa-solid fa-arrow-left"></i> SMS history</a>
    <div class="pg-head">
        <div>
            <h1>SMS <em>details</em></h1>
            <p>{{ date('M d, Y · h:i A', strtotime($transaction->created_at)) }}</p>
        </div>
        <span class="badge-v {{ $transaction->status == 1 ? 'ok' : 'fail' }}">{{ $transaction->status == 1 ? 'Sent' : 'Failed' }}</span>
    </div>

    <div class="panel">
        <div class="kv"><span>Sender name</span><span>{{ $transaction->sender_name }}</span></div>
        <div class="kv"><span>Amount charged</span><span>₦{{ number_format((float) $transaction->amount, 2) }}</span></div>
        <div class="kv"><span>Title</span><span>{{ $transaction->title }}</span></div>
        <div class="kv"><span>Details</span><span>{{ $transaction->description }}</span></div>

        <div style="margin-top:18px">
            <div class="f-label">Message</div>
            <div class="note-v" style="white-space:pre-wrap">{{ $transaction->message }}</div>
        </div>
        <div style="margin-top:18px">
            <div class="f-label">Recipients</div>
            <div class="note-v" style="word-break:break-word;font-size:.84rem">{{ $transaction->recipient }}</div>
        </div>
    </div>
</div>
@endsection
