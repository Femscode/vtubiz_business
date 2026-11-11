{{-- Shared transaction history for a data or airtime group. Expects: $group, $transactions, $back, $backLabel, $icon, $tone --}}
@section('content')
<div class="pg">
    <a href="{{ $back }}" class="pg-back"><i class="fa-solid fa-arrow-left"></i> {{ $backLabel }}</a>
    <div class="pg-head">
        <div>
            <h1>{{ $group->name }}</h1>
            <p>Purchases made for this group.</p>
        </div>
    </div>

    <div class="stats-v">
        <div class="stat-v">
            <div class="k"><i class="t-blue fa-solid fa-receipt"></i> Purchases</div>
            <div class="v">{{ count($transactions) }}</div>
        </div>
        <div class="stat-v">
            <div class="k"><i class="t-green fa-solid fa-circle-check"></i> Successful</div>
            <div class="v">{{ collect($transactions)->where('status', 1)->count() }}</div>
        </div>
        <div class="stat-v">
            <div class="k"><i class="t-pink fa-solid fa-arrow-up"></i> Spent</div>
            <div class="v">₦{{ number_format((float) collect($transactions)->where('status', 1)->sum('amount'), 2) }}</div>
        </div>
    </div>

    <div class="panel panel-flush">
        @if(count($transactions))
            <div class="tbl-wrap">
                <table class="tbl stack">
                    <thead>
                        <tr>
                            <th>Purchase</th>
                            <th>Amount</th>
                            <th>Balance after</th>
                            <th>Status</th>
                            <th class="end"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $tranx)
                            <tr>
                                <td class="lead">
                                    <div class="cell-main">
                                        <span class="ic {{ $tone }}"><i class="fa-solid {{ $icon }}"></i></span>
                                        <div style="max-width:440px">
                                            <b>{{ $tranx->title }}</b>
                                            <small>{{ $tranx->description }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td data-label="Amount" class="num">₦{{ number_format((float) $tranx->amount, 2) }}</td>
                                <td data-label="Balance after">
                                    <span class="num">₦{{ number_format((float) $tranx->after) }}</span>
                                    <div class="muted">from ₦{{ number_format((float) $tranx->before) }}</div>
                                </td>
                                <td data-label="Status">
                                    @if($tranx->status == 1)
                                        <span class="badge-v ok">Success</span>
                                    @elseif($tranx->status == 2)
                                        <span class="badge-v pend">Pending</span>
                                    @else
                                        <span class="badge-v fail">Failed</span>
                                    @endif
                                </td>
                                <td data-label="">
                                    <div class="row-actions">
                                        <a href="/premium-verify_purchase/{{ $tranx->reference }}" class="btn-v light xs"><i class="fa-solid fa-magnifying-glass"></i> Verify</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-v">
                <div class="ic"><i class="fa-solid fa-receipt"></i></div>
                <b>No purchases yet</b>
                <span>Recharge this group to see its history here.</span><br>
                <a href="{{ $back }}" class="btn-v dark">Back to groups</a>
            </div>
        @endif
    </div>
</div>
@endsection
