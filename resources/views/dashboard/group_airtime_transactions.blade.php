@extends('dashboard.master1')
@section('header')
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
    
    .btn-action-modern {
        padding: 8px 16px;
        border-radius: var(--radius-pill);
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-back { background: rgba(107, 107, 107, 0.1); color: var(--text-secondary) !important; }
    .btn-verify { background: rgba(47, 128, 237, 0.1); color: var(--accent-blue) !important; }
</style>
@endsection

@section('content')
<div class="transactions-header">
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h1>{{ $group->name }}</h1>
            <p class="text-muted">Airtime Group Transaction History</p>
        </div>
        <a class='btn-action-modern btn-back' href='/airtime_group'>← Back to Groups</a>
    </div>
</div>

<div class="transactions-card">
    <div class="table-responsive">
        <table class="datatable modern-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Amount</th>
                    <th>Details</th>
                    <th>Before/After</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $tranx)
                <tr>
                    <td>
                        <div style="font-weight: 600; color: var(--primary-dark);">{{ $tranx->title }}</div>
                        @if($tranx->title == "Airtime Purchase" && $tranx->status == 1 && $tranx->redo == 1)
                            <a data-transaction_id="{{ $tranx->id }}" data-title="{{ $tranx->title }}"
                               data-amount="{{ $tranx->amount }}" data-description='{{ $tranx->description }}'
                               class='redo text-xs d-inline-block mt-1' style="color: var(--accent-blue); cursor: pointer; text-decoration: underline;">Redo</a>
                        @endif
                    </td>
                    <td style="font-family: 'Fraunces', serif; font-weight: 600; color: var(--primary-dark);">₦{{ number_format($tranx->amount, 2) }}</td>
                    <td class="text-xs text-muted">{{ $tranx->description }}</td>
                    <td class="text-xs">
                        <div class="text-muted">₦{{ number_format($tranx->before) }}</div>
                        <div class="font-weight-bold">₦{{ number_format($tranx->after) }}</div>
                    </td>
                    <td>
                        @if($tranx->status == 1)
                            <span class='badge-modern badge-success'>Success</span>
                        @elseif($tranx->status == 2)
                            <span class='badge-modern badge-warning'>Pending</span>
                        @else
                            <span class='badge-modern badge-danger'>Failed</span>
                        @endif
                    </td>
                    <td>
                        <a href='/premium-verify_purchase/{{ $tranx->reference }}' class='btn-action-modern btn-verify'>Verify</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('script')

@endsection

@endsection