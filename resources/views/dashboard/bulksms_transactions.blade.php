@extends('dashboard.master1')

@php
    $sent = collect($transactions)->where('status', 1);
@endphp

@section('header')
<style>
    .sms-desc {
        max-width: 460px;
    }

    .sms-desc small {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection

@section('content')
<div class="pg">
    <a href="/bulksms" class="pg-back"><i class="fa-solid fa-arrow-left"></i> Bulk SMS</a>
    <div class="pg-head">
        <div>
            <h1>SMS <em>history</em></h1>
            <p>Every bulk message you've sent or scheduled.</p>
        </div>
        <div class="pg-actions">
            <a href="/bulksms" class="btn-v dark"><i class="fa-solid fa-paper-plane"></i> New message</a>
        </div>
    </div>

    <div class="stats-v">
        <div class="stat-v">
            <div class="k"><i class="t-blue fa-solid fa-message"></i> Campaigns</div>
            <div class="v">{{ count($transactions) }}</div>
        </div>
        <div class="stat-v">
            <div class="k"><i class="t-green fa-solid fa-circle-check"></i> Delivered</div>
            <div class="v">{{ $sent->count() }}</div>
        </div>
        <div class="stat-v">
            <div class="k"><i class="t-pink fa-solid fa-arrow-up"></i> Spent</div>
            <div class="v">₦{{ number_format((float) $sent->sum('amount'), 2) }}</div>
        </div>
    </div>

    <div class="panel panel-flush">
        <div class="panel-head">
            <h3>Messages</h3>
            <div class="search-v" style="max-width:280px">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="searchTable" placeholder="Search sender or message">
            </div>
        </div>

        @if(count($transactions))
            <div class="tbl-wrap" style="margin-top:16px">
                <table class="tbl stack" id="smsTable">
                    <thead>
                        <tr>
                            <th>Message</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th class="end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $tranx)
                            <tr>
                                <td class="lead">
                                    <div class="cell-main">
                                        <span class="ic t-ink"><i class="fa-solid fa-message"></i></span>
                                        <div class="sms-desc">
                                            <b>{{ $tranx->sender ?: $tranx->title }}</b>
                                            <small>{{ $tranx->description }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Amount" class="num">₦{{ number_format((float) $tranx->amount, 2) }}</td>
                                <td data-label="Status">
                                    @if($tranx->status == 1)
                                        <span class="badge-v ok">Sent</span>
                                    @else
                                        <span class="badge-v fail">Failed</span>
                                    @endif
                                </td>
                                <td data-label="Date">
                                    <span style="white-space:nowrap">{{ optional($tranx->created_at)->format('M d, Y') }}</span>
                                    <div class="muted">{{ optional($tranx->created_at)->format('h:i A') }}</div>
                                </td>
                                <td data-label="Actions">
                                    <div class="row-actions" style="flex-wrap:nowrap">
                                        @if($tranx->status == 1)
                                            <a href="/print_transaction_receipt/{{ $tranx->id }}" class="btn-v light icon" title="Receipt" aria-label="Receipt"><i class="fa-solid fa-receipt"></i></a>
                                        @else
                                            <a onclick="return confirm('Resend this SMS?')" href="/resend_sms/{{ $tranx->id }}" class="btn-v light xs"><i class="fa-solid fa-rotate-right"></i> Resend</a>
                                        @endif
                                        <a href="/view_details/{{ $tranx->id }}" class="btn-v light icon" title="Details" aria-label="Details"><i class="fa-solid fa-eye"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-v">
                <div class="ic"><i class="fa-solid fa-message"></i></div>
                <b>No messages yet</b>
                <span>Your bulk SMS history will show here.</span><br>
                <a href="/bulksms" class="btn-v dark">Send your first SMS</a>
            </div>
        @endif
    </div>
</div>
@endsection

@section('script')
<script>
    (function () {
        var input = document.getElementById('searchTable');
        if (!input) return;
        input.addEventListener('input', function () {
            var q = input.value.trim().toLowerCase();
            document.querySelectorAll('#smsTable tbody tr').forEach(function (tr) {
                tr.style.display = !q || tr.innerText.toLowerCase().indexOf(q) !== -1 ? '' : 'none';
            });
        });
    })();
</script>
@endsection
