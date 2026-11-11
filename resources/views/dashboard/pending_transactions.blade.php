@extends('dashboard.master1')

@section('content')
<div class="pg">
    <a href="/mytransactions" class="pg-back"><i class="fa-solid fa-arrow-left"></i> Transactions</a>
    <div class="pg-head">
        <div>
            <h1>Pending <em>transactions</em></h1>
            <p>Purchases waiting for confirmation from the network.</p>
        </div>
    </div>

    <div class="note-v warn" style="margin-bottom:20px">
        <i class="fa-solid fa-circle-info"></i>
        <div>If the recipient has received their value, tap <b>Confirm</b>. If not, tap <b>Report</b> and we'll look into it.</div>
    </div>

    <div class="panel panel-flush">
        <div class="panel-head">
            <h3>Awaiting confirmation <span class="badge-v pend" style="font-family:'DM Sans'">{{ count($transactions) }}</span></h3>
            @if(count($transactions))
                <div class="search-v" style="max-width:280px">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="searchTable" placeholder="Search">
                </div>
            @endif
        </div>

        @if(count($transactions))
            <div class="tbl-wrap" style="margin-top:16px">
                <table class="tbl stack" id="pendTable">
                    <thead>
                        <tr>
                            <th>Details</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th class="end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $tranx)
                            <tr>
                                <td class="lead">
                                    <div class="cell-main">
                                        <span class="ic t-amber"><i class="fa-regular fa-clock"></i></span>
                                        <div style="max-width:460px"><b>{{ $tranx->details }}</b></div>
                                    </div>
                                </td>
                                <td data-label="Amount" class="num">₦{{ number_format((float) $tranx->amount) }}</td>
                                <td data-label="Date">
                                    <span style="white-space:nowrap">{{ date('M d, Y', strtotime($tranx->created_at)) }}</span>
                                    <div class="muted">{{ date('h:i A', strtotime($tranx->created_at)) }}</div>
                                </td>
                                <td data-label="Actions">
                                    <div class="row-actions" style="flex-wrap:nowrap">
                                        <a href="/admin_delete_duplicate/confirm/{{ $tranx->id }}" onclick="return confirm('Confirm this transaction was successful?')" class="btn-v success xs"><i class="fa-solid fa-check"></i> Confirm</a>
                                        <a href="https://wa.me/2349058744473" target="_blank" rel="noopener" class="btn-v light xs"><i class="fa-regular fa-flag"></i> Report</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-v">
                <div class="ic"><i class="fa-solid fa-circle-check"></i></div>
                <b>All clear</b>
                <span>You have no pending transactions.</span>
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
            document.querySelectorAll('#pendTable tbody tr').forEach(function (tr) {
                tr.style.display = !q || tr.innerText.toLowerCase().indexOf(q) !== -1 ? '' : 'none';
            });
        });
    })();
</script>
@endsection
