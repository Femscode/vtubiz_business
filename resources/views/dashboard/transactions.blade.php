@extends('dashboard.master1')

@section('header')
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<style>
    .transactions-header {
        margin-bottom: var(--space-lg);
    }
    .transactions-header h1 {
        font-family: 'Fraunces', serif;
        font-size: 2.2rem;
        color: var(--primary-dark);
        margin-bottom: 8px;
    }
    .transactions-card {
        background: var(--surface);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        box-shadow: var(--shadow-card);
    }
    .stat-card-modern {
        background: white;
        border-radius: var(--radius-md);
        padding: 20px;
        box-shadow: var(--shadow-card);
        border: 1px solid rgba(0,0,0,0.03);
        height: 100%;
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .stat-icon-wrap {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }
    .bg-light-success { background: rgba(39, 174, 96, 0.1); color: #27ae60; }
    .bg-light-danger { background: rgba(235, 87, 87, 0.1); color: #eb5757; }
    .stat-label { font-size: 0.8rem; color: var(--text-secondary); margin-bottom: 2px; text-transform: uppercase; letter-spacing: 0.5px; }
    .stat-amount { font-family: 'Fraunces', serif; font-size: 1.5rem; font-weight: 600; color: var(--primary-dark); }
    
    .search-input-group {
        position: relative;
        max-width: 400px;
        margin-bottom: var(--space-md);
    }
    .search-input-group input {
        width: 100%;
        padding: 12px 16px 12px 45px;
        border-radius: var(--radius-pill);
        border: 1px solid rgba(0,0,0,0.08);
        background: #F9F9F9;
        font-family: 'DM Sans', sans-serif;
        transition: all 0.2s ease;
    }
    .search-input-group input:focus {
        outline: none;
        border-color: var(--primary-dark);
        background: white;
        box-shadow: 0 0 0 4px rgba(15, 53, 72, 0.05);
    }
    .search-icon {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-light);
    }
    .modern-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
    }
    .modern-table thead th {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-light);
        padding: 10px 20px;
        font-weight: 700;
        border: none;
    }
    .modern-table tbody tr {
        background: #FDFCF8;
        transition: transform 0.2s ease;
    }
    .modern-table tbody tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    }
    .modern-table tbody td {
        padding: 16px 20px;
        font-size: 0.9rem;
        vertical-align: middle;
        border: none;
    }
    .modern-table tbody td:first-child { border-radius: 12px 0 0 12px; }
    .modern-table tbody td:last-child { border-radius: 0 12px 12px 0; }
    
    .badge-modern {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        display: inline-block;
    }
    .badge-success { background: rgba(39, 174, 96, 0.1); color: var(--accent-green); }
    .badge-warning { background: rgba(242, 201, 76, 0.15); color: #D4A017; }
    .badge-danger { background: rgba(235, 87, 87, 0.1); color: var(--accent-pink); }
    
    .amount-val { font-family: 'Fraunces', serif; font-weight: 600; font-size: 1rem; }
    .amount-credit { color: var(--accent-green); }
    .amount-debit { color: var(--text-main); }
    
    .btn-action-modern {
        padding: 8px 16px;
        border-radius: var(--radius-pill);
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-verify { background: rgba(47, 128, 237, 0.1); color: var(--accent-blue); }
    .btn-print { background: rgba(39, 174, 96, 0.1); color: var(--accent-green); }
    
    @media (max-width: 991px) {
        .modern-table thead { display: none; }
        .modern-table tbody td { display: block; padding: 10px 20px; text-align: right; border-bottom: 1px solid rgba(0,0,0,0.02); }
        .modern-table tbody td:last-child { border-bottom: none; }
        .modern-table tbody td::before { content: attr(data-label); float: left; font-weight: 700; color: var(--text-light); }
    }
</style>
@endsection

@section('content')
<div class="transactions-header">
    <h1>My Transactions</h1>
    <p class="text-muted">A complete history of all your platform activities.</p>
</div>

@php
    $total_funding = $transactions->where('type', 'credit')->where('status', 1)->sum('amount');
    $total_spent = $transactions->where('type', 'debit')->where('status', 1)->sum('amount');
@endphp

<div class="row g-4 mb-5">
    <div class="col-md-6">
        <div class="stat-card-modern">
            <div class="stat-icon-wrap bg-light-success">
                <i class="fa-solid fa-arrow-down"></i>
            </div>
            <div>
                <div class="stat-label">Total Funding</div>
                <div class="stat-amount">₦{{ number_format($total_funding, 2) }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="stat-card-modern">
            <div class="stat-icon-wrap bg-light-danger">
                <i class="fa-solid fa-arrow-up"></i>
            </div>
            <div>
                <div class="stat-label">Total Spent</div>
                <div class="stat-amount">₦{{ number_format($total_spent, 2) }}</div>
            </div>
        </div>
    </div>
</div>

<div class="transactions-card">
    <div class="search-input-group">
        <i class="fa-solid fa-magnifying-glass search-icon"></i>
        <input type="text" id="searchTable" placeholder="Search by title, reference, or description...">
    </div>

    <div class="table-responsive">
        <table class="datatable modern-table">
            <thead>
                <tr>
                    <th>Details</th>
                    <th>Reference</th>
                    <th>Amount</th>
                    <th>Balance</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <input style='visibility:hidden; display:none;' value='{{ $user->balance }}' id='user_amount' />
                @foreach($transactions as $tranx)
                <tr>
                    <td data-label="Details">
                        <div style="font-weight: 600; color: var(--primary-dark);">{{ $tranx->title }}</div>
                        <div class="text-xs text-muted">{{ $tranx->description }}</div>
                        @if(($tranx->title == "Data Purchase" || $tranx->title == "Airtime Purchase" || $tranx->title == "Electricity Payment") && $tranx->status == 1 && $tranx->redo == 1)
                            <a data-transaction_id="{{ $tranx->id }}" data-title="{{ $tranx->title }}"
                               data-amount="{{ $tranx->amount }}" data-description='{{ $tranx->description }}'
                               class='redo text-xs mt-1 d-inline-block' style="color: var(--accent-blue); cursor: pointer; text-decoration: underline;">Redo Transaction</a>
                        @endif
                    </td>
                    <td data-label="Reference" class="text-xs text-muted">{{ $tranx->reference }}</td>
                    <td data-label="Amount">
                        <span class="amount-val {{ $tranx->type == 'credit' ? 'amount-credit' : 'amount-debit' }}">
                            {{ $tranx->type == 'credit' ? '+' : '-' }} ₦{{ number_format($tranx->amount, 2) }}
                        </span>
                    </td>
                    <td data-label="Balance" class="text-xs">
                        <div class="text-muted">Prev: ₦{{ number_format($tranx->before, 2) }}</div>
                        <div style="font-weight: 500;">Later: ₦{{ number_format($tranx->after, 2) }}</div>
                    </td>
                    <td data-label="Status">
                        @if($tranx->status == 1)
                            <span class='badge-modern badge-success'>Success</span>
                        @elseif($tranx->status == 2)
                            <span class='badge-modern badge-warning'>Pending</span>
                        @else
                            <span class='badge-modern badge-danger'>Failed</span>
                        @endif
                    </td>
                    <td data-label="Date" class="text-xs text-muted">
                        {{ Date('M d, Y', strtotime($tranx->created_at)) }}<br>
                        {{ Date('h:i A', strtotime($tranx->created_at)) }}
                    </td>
                    <td data-label="Action">
                        <div class="d-flex gap-2 justify-content-end">
                            <a href='/premium-verify_purchase/{{ $tranx->reference }}' class='btn-action-modern btn-verify'>Verify</a>
                            <a href='/print_transaction_receipt/{{ $tranx->id }}' class='btn-action-modern btn-print'>Print</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
<!-- DataTables JS -->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        var oTable = $('.datatable').DataTable({
            ordering: false,
            searching: true,
            paging: true,
            pageLength: 25,
            lengthChange: true,
            info: true,
            dom: '<"top"f>rt<"bottom"ip><"clear">', // Added default search back but hidden via CSS if needed
            language: {
                search: "",
                searchPlaceholder: "Search transactions..."
            }
        });

        // Hide the default search box created by DataTable since we have a custom one
        $('.dataTables_filter').hide();

        $('#searchTable').on('keyup', function() {
            oTable.search(this.value).draw();
        });

        @if (session('message'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('message') }}",
                confirmButtonColor: '#0F3548'
            });
        @endif

        $("body").on('click', '.redo', function() {
            var description = $(this).data('description');
            var transaction_id = $(this).data('transaction_id');
            var amount = $(this).data('amount');
            var user_balance = $("#user_amount").val();

            if (parseFloat(user_balance) >= parseFloat(amount)) {
                Swal.fire({
                    title: "Redo Transaction",
                    text: "You are about to redo: " + description,
                    icon: "warning",
                    input: "password",
                    inputPlaceholder: "Enter your 4-digit PIN",
                    inputAttributes: {
                        inputmode: "numeric",
                        maxlength: 4,
                        style: "text-align:center; font-size:24px; letter-spacing: 15px",
                    },
                    showCancelButton: true,
                    confirmButtonColor: "#0F3548",
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
                                    Swal.fire({
                                        icon: "error",
                                        title: "Error",
                                        text: response.data.message
                                    });
                                }
                            })
                            .catch((error) => {
                                Swal.fire("Error", error.message, "error");
                            });
                    }
                });
            } else {
                Swal.fire({
                    title: 'Insufficient Balance',
                    icon: 'info',
                    html: 'You need to fund your wallet to redo this transaction. <br><br><a href="/fundwallet" class="btn btn-primary" style="background:#0F3548; border:none; padding:10px 20px; border-radius:20px; color:white; text-decoration:none;">Fund Wallet</a>',
                    showConfirmButton: false
                });
            }
        });
    });
</script>
@endsection
