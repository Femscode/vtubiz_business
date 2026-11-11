@extends('dashboard.master1')

@php
    $waLink = function ($phone) {
        $digits = preg_replace('/\D+/', '', (string) $phone);
        return 'https://wa.me/' . (str_starts_with($digits, '234') ? $digits : '234' . ltrim($digits, '0'));
    };
    $credited = collect($transactions)->where('status', 1)->count();
@endphp

@section('content')
<div class="pg">
    <a href="/giveaway_participant/{{ $giveaway->slug }}" class="pg-back"><i class="fa-solid fa-arrow-left"></i> {{ $giveaway->name }}</a>
    <div class="pg-head">
        <div>
            <h1>Prize <em>payouts</em></h1>
            <p>{{ $giveaway->name }} · worth ₦{{ number_format((float) $giveaway->estimated_amount) }}</p>
        </div>
    </div>

    <div class="stats-v">
        <div class="stat-v">
            <div class="k"><i class="t-blue fa-solid fa-users"></i> Winners</div>
            <div class="v">{{ count($transactions) }}</div>
        </div>
        <div class="stat-v">
            <div class="k"><i class="t-green fa-solid fa-circle-check"></i> Credited</div>
            <div class="v">{{ $credited }}</div>
        </div>
    </div>

    <div class="panel panel-flush">
        <div class="panel-head">
            <h3>Payouts</h3>
            <div class="search-v" style="max-width:280px">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="searchTable" placeholder="Search">
            </div>
        </div>

        @if(count($transactions))
            <div class="tbl-wrap" style="margin-top:16px">
                <table class="tbl stack" id="payTable">
                    <thead>
                        <tr>
                            <th>Winner</th>
                            <th>Paid to</th>
                            <th>Status</th>
                            <th class="end">Contact</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $tranx)
                            <tr>
                                <td class="lead"><b>{{ $tranx->name }}</b></td>
                                <td data-label="Paid to">
                                    @if($tranx->type == 'cash')
                                        <span>{{ $tranx->account_no }} · {{ $tranx->bank_name }}</span>
                                        <div class="muted">{{ $tranx->account_name }}</div>
                                    @else
                                        <span>{{ $tranx->phone }}</span>
                                    @endif
                                </td>
                                <td data-label="Status">
                                    @if($tranx->status == 1)
                                        <span class="badge-v ok">Credited</span>
                                    @else
                                        <span class="badge-v pend">Pending</span>
                                    @endif
                                </td>
                                <td data-label="Contact">
                                    <div class="row-actions">
                                        <a class="btn-v success xs" href="{{ $waLink($tranx->phone) }}" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> Message</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-v">
                <div class="ic"><i class="fa-solid fa-trophy"></i></div>
                <b>No payouts yet</b>
                <span>Winners will appear here once they claim.</span>
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
            document.querySelectorAll('#payTable tbody tr').forEach(function (tr) {
                tr.style.display = !q || tr.innerText.toLowerCase().indexOf(q) !== -1 ? '' : 'none';
            });
        });
    })();
</script>
@endsection
