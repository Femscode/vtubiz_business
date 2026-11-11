@extends('dashboard.master1')

@php
    $total_funding = $transactions->where('type', 'credit')->where('status', 1)->sum('amount');
    $total_spent = $transactions->where('type', 'debit')->where('status', 1)->sum('amount');
    $total_count = $transactions->count();

    $txMeta = function ($trans) {
        $t = strtolower($trans->title);
        if ($trans->type === 'credit') return ['fa-arrow-down', 't-green'];
        if (str_contains($t, 'data')) return ['fa-wifi', 't-blue'];
        if (str_contains($t, 'airtime')) return ['fa-phone', 't-amber'];
        if (str_contains($t, 'electric')) return ['fa-lightbulb', 't-yellow'];
        if (str_contains($t, 'cable') || str_contains($t, 'tv')) return ['fa-tv', 't-pink'];
        if (str_contains($t, 'exam') || str_contains($t, 'waec') || str_contains($t, 'neco')) return ['fa-graduation-cap', 't-purple'];
        if (str_contains($t, 'sms')) return ['fa-message', 't-ink'];
        if (str_contains($t, 'transfer')) return ['fa-paper-plane', 't-ink'];
        return ['fa-arrow-up', 't-ink'];
    };
@endphp

@section('header')
<style>
    .tx-toolbar {
        padding: 18px 24px;
        border-bottom: 1px solid var(--line);
    }

    .tx-desc {
        max-width: 420px;
    }

    .tx-ref {
        font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
        font-size: .72rem;
        color: var(--text-light);
    }

    .redo {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        margin-top: 6px;
        font-size: .76rem;
        font-weight: 600;
        color: var(--brand-orange-2);
        cursor: pointer;
    }

    .redo:hover {
        color: var(--ink);
    }

    .amt.pos {
        color: var(--accent-green);
    }

    /* DataTables chrome */
    .dataTables_wrapper .bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        padding: 16px 24px;
        border-top: 1px solid var(--line);
    }

    .dataTables_info {
        font-size: .82rem;
        color: var(--text-secondary);
        padding: 0 !important;
    }

    .dataTables_paginate {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .dataTables_paginate .pagination {
        margin: 0 !important;
    }

    .dataTables_paginate .paginate_button,
    .dataTables_paginate .page-link {
        border: 1px solid var(--line) !important;
        border-radius: 10px !important;
        padding: 6px 12px !important;
        font-size: .82rem;
        font-weight: 600;
        color: var(--ink) !important;
        background: #fff !important;
        cursor: pointer;
        min-width: 36px;
        text-align: center;
    }

    .dataTables_paginate .paginate_button.current,
    .dataTables_paginate .active .page-link {
        background: var(--primary-dark) !important;
        border-color: var(--primary-dark) !important;
        color: #fff !important;
    }

    .dataTables_paginate .disabled,
    .dataTables_paginate .paginate_button.disabled {
        opacity: .4;
        pointer-events: none;
    }

    .dataTables_empty {
        text-align: center;
        padding: 40px 16px !important;
        color: var(--text-secondary);
    }

    @media (max-width: 767px) {
        .tx-toolbar {
            padding: 16px;
        }

        .tx-desc {
            max-width: none;
        }

        .dataTables_wrapper .bottom {
            justify-content: center;
            padding: 14px 16px;
        }
    }
</style>
@endsection

@section('content')
<div class="pg">
    <div class="pg-head">
        <div>
            <h1>Transaction <em>history</em></h1>
            <p>Everything that moved through your wallet.</p>
        </div>
        <div class="pg-actions">
            <a href="/fundwallet" class="btn-v dark"><i class="fa-solid fa-plus"></i> Fund wallet</a>
        </div>
    </div>

    <div class="stats-v">
        <div class="stat-v">
            <div class="k"><i class="t-green fa-solid fa-arrow-down"></i> Total funded</div>
            <div class="v">₦{{ number_format((float) $total_funding, 2) }}</div>
        </div>
        <div class="stat-v">
            <div class="k"><i class="t-pink fa-solid fa-arrow-up"></i> Total spent</div>
            <div class="v">₦{{ number_format((float) $total_spent, 2) }}</div>
        </div>
        <div class="stat-v">
            <div class="k"><i class="t-blue fa-solid fa-receipt"></i> Transactions</div>
            <div class="v">{{ number_format($total_count) }}</div>
        </div>
    </div>

    <div class="panel panel-flush">
        <div class="tx-toolbar toolbar-v">
            <div class="search-v">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="searchTable" placeholder="Search title, reference or description">
            </div>
            <div class="seg" id="statusFilter">
                <button type="button" class="active" data-status="">All</button>
                <button type="button" data-status="Success">Success</button>
                <button type="button" data-status="Pending">Pending</button>
                <button type="button" data-status="Failed">Failed</button>
            </div>
        </div>

        <input type="hidden" value="{{ $user->balance }}" id="user_amount" />

        <div class="tbl-wrap">
            <table class="tbl stack datatable">
                <thead>
                    <tr>
                        <th>Transaction</th>
                        <th>Amount</th>
                        <th>Balance after</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $tranx)
                        @php [$icon, $tone] = $txMeta($tranx); @endphp
                        <tr>
                            <td class="lead">
                                <div class="cell-main">
                                    <span class="ic {{ $tone }}"><i class="fa-solid {{ $icon }}"></i></span>
                                    <div class="tx-desc">
                                        <b>{{ $tranx->title }}</b>
                                        <small>{{ $tranx->description }}</small>
                                        <span class="tx-ref">{{ $tranx->reference }}</span>
                                        @if(($tranx->title == "Data Purchase" || $tranx->title == "Airtime Purchase" || $tranx->title == "Electricity Payment") && $tranx->status == 1 && $tranx->redo == 1)
                                            <div>
                                                <a data-transaction_id="{{ $tranx->id }}" data-title="{{ $tranx->title }}"
                                                    data-amount="{{ $tranx->amount }}" data-description="{{ $tranx->description }}"
                                                    class="redo"><i class="fa-solid fa-rotate-right"></i> Redo</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td data-label="Amount" class="num amt {{ $tranx->type == 'credit' ? 'pos' : '' }}">
                                {{ $tranx->type == 'credit' ? '+' : '−' }}₦{{ number_format((float) $tranx->amount, 2) }}
                            </td>
                            <td data-label="Balance after">
                                <span class="num">₦{{ number_format((float) $tranx->after, 2) }}</span>
                                <div class="muted">from ₦{{ number_format((float) $tranx->before, 2) }}</div>
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
                            <td data-label="Date">
                                <span style="white-space:nowrap">{{ date('M d, Y', strtotime($tranx->created_at)) }}</span>
                                <div class="muted">{{ date('h:i A', strtotime($tranx->created_at)) }}</div>
                            </td>
                            <td data-label="Actions">
                                <div class="row-actions" style="flex-wrap:nowrap">
                                    <a href="/premium-verify_purchase/{{ $tranx->reference }}" class="btn-v light icon" title="Verify" aria-label="Verify"><i class="fa-solid fa-magnifying-glass"></i></a>
                                    <a href="/print_transaction_receipt/{{ $tranx->id }}" class="btn-v light icon" title="Receipt" aria-label="Receipt"><i class="fa-solid fa-receipt"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        var oTable = $('.datatable').DataTable({
            ordering: false,
            searching: true,
            paging: true,
            pageLength: 25,
            lengthChange: false,
            info: true,
            autoWidth: false,
            dom: 'rt<"bottom"ip>',
            language: {
                emptyTable: "No transactions yet.",
                zeroRecords: "No transactions match your search.",
                info: "_START_–_END_ of _TOTAL_",
                infoEmpty: "0 results",
                infoFiltered: "",
                paginate: { previous: "‹", next: "›" }
            }
        });

        $('#searchTable').on('keyup', function() {
            oTable.search(this.value).draw();
        });

        // Status filter (column 3)
        $('#statusFilter button').on('click', function() {
            $('#statusFilter button').removeClass('active');
            $(this).addClass('active');
            var status = $(this).data('status');
            oTable.column(3).search(status || '').draw();
        });

        $("body").on('click', '.redo', function() {
            var description = $(this).data('description');
            var transaction_id = $(this).data('transaction_id');
            var amount = $(this).data('amount');
            var user_balance = $("#user_amount").val();

            if (parseFloat(user_balance) >= parseFloat(amount)) {
                Swal.fire({
                    title: "Redo transaction",
                    text: description,
                    input: "password",
                    inputPlaceholder: "4-digit PIN",
                    inputAttributes: {
                        inputmode: "numeric",
                        maxlength: 4,
                        style: "text-align:center; font-size:24px; letter-spacing: 15px",
                    },
                    showCancelButton: true,
                    confirmButtonColor: "#001f3f",
                    confirmButtonText: "Confirm",
                    inputValidator: (value) => {
                        if (!/^\d{4}$/.test(value)) {
                            return "Please enter a 4-digit PIN";
                        }
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Processing...",
                            didOpen: () => { Swal.showLoading(); },
                            allowOutsideClick: false
                        });
                        let fd = new FormData();
                        fd.append("transaction_id", transaction_id);
                        fd.append("pin", result.value);
                        axios.post("/redo_transaction", fd)
                            .then((response) => {
                                if (response.data.success == "true") {
                                    Swal.fire({
                                        icon: "success",
                                        title: "Success!",
                                        text: "Transaction processed successfully."
                                    }).then(() => { location.reload(); });
                                } else {
                                    Swal.fire({ icon: "error", title: "Error", text: response.data.message });
                                }
                            })
                            .catch((error) => {
                                Swal.fire("Error", error.message, "error");
                            });
                    }
                });
            } else {
                Swal.fire({
                    title: 'Insufficient balance',
                    icon: 'info',
                    html: 'Fund your wallet to redo this transaction.<br><br><a href="/fundwallet" style="background:#001f3f;padding:10px 22px;border-radius:999px;color:#fff;text-decoration:none;font-weight:600">Fund wallet</a>',
                    showConfirmButton: false
                });
            }
        });
    });
</script>
@endsection
