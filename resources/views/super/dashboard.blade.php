@extends('super.master')

@section('header')
<style>
    .dash-header h1 {
        font-family: 'Fraunces', serif;
        font-size: 2.2rem;
        color: var(--primary-dark);
        margin-bottom: 8px;
    }
    .stat-card {
        background: white;
        border-radius: var(--radius-lg);
        padding: 24px;
        box-shadow: var(--shadow-card);
        height: 100%;
        border: 1px solid rgba(0,0,0,0.02);
        transition: transform 0.2s;
    }
    .stat-card:hover { transform: translateY(-5px); }
    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
        font-size: 1.2rem;
    }
    .bg-soft-orange { background: rgba(251, 145, 41, 0.1); color: var(--accent-orange); }
    .bg-soft-blue { background: rgba(47, 128, 237, 0.1); color: var(--accent-blue); }
    .bg-soft-green { background: rgba(39, 174, 96, 0.1); color: var(--accent-green); }
    .bg-soft-pink { background: rgba(235, 87, 87, 0.1); color: var(--accent-pink); }
    
    .stat-label { font-size: 0.85rem; color: var(--text-secondary); font-weight: 500; margin-bottom: 4px; }
    .stat-value { font-family: 'Fraunces', serif; font-size: 1.6rem; font-weight: 600; color: var(--primary-dark); }

    .recent-table-card {
        background: white;
        border-radius: var(--radius-lg);
        padding: 30px;
        box-shadow: var(--shadow-card);
    }
    .modern-table { width: 100%; border-collapse: separate; border-spacing: 0 8px; }
    .modern-table thead th { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 1px; color: var(--text-light); padding: 10px 15px; border: none; }
    .modern-table tbody tr { background: #FDFCF8; border-radius: 12px; }
    .modern-table tbody td { padding: 15px; font-size: 0.85rem; border: none; vertical-align: middle; }
    .modern-table tbody td:first-child { border-radius: 12px 0 0 12px; }
    .modern-table tbody td:last-child { border-radius: 0 12px 12px 0; }
</style>
@endsection

@section('content')
<div class="dash-header mb-5 d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3">
    <div>
        <h1>Super Admin Overview</h1>
        <p class="text-muted">Global platform performance and profit analytics.</p>
    </div>
    
    <div class="filter-section">
        <form action="{{ route('superadmin.dashboard') }}" method="GET" id="filterForm" class="d-flex flex-wrap gap-2 justify-content-md-end">
            <div class="input-group input-group-sm" style="width: auto;">
                <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-filter text-muted"></i></span>
                <select name="filter" id="filterSelect" class="form-select border-start-0 ps-0" style="min-width: 150px;">
                    <option value="this_week" {{ $current_filter == 'this_week' ? 'selected' : '' }}>This Week</option>
                    <option value="last_week" {{ $current_filter == 'last_week' ? 'selected' : '' }}>Last Week</option>
                    <option value="this_month" {{ $current_filter == 'this_month' ? 'selected' : '' }}>This Month</option>
                    <option value="last_month" {{ $current_filter == 'last_month' ? 'selected' : '' }}>Last Month</option>
                    <option value="this_year" {{ $current_filter == 'this_year' ? 'selected' : '' }}>This Year</option>
                    <option value="custom" {{ $current_filter == 'custom' ? 'selected' : '' }}>Custom Range</option>
                </select>
            </div>
            
            <div id="customDateRange" class="d-flex gap-2 {{ $current_filter == 'custom' ? '' : 'd-none' }}">
                <input type="date" name="start_date" value="{{ $start_date }}" class="form-control form-control-sm" placeholder="Start Date">
                <input type="date" name="end_date" value="{{ $end_date }}" class="form-control form-control-sm" placeholder="End Date">
                <button type="submit" class="btn btn-sm btn-primary rounded-pill px-3">Apply</button>
            </div>
        </form>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon bg-soft-blue">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="stat-label">Total Users</div>
            <div class="stat-value">{{ number_format($total_users) }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon bg-soft-orange">
                <i class="fa-solid fa-wallet"></i>
            </div>
            <div class="stat-label">Total Wallet Balance</div>
            <div class="stat-value">₦{{ number_format($total_balance, 2) }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon bg-soft-green">
                <i class="fa-solid fa-chart-line"></i>
            </div>
            <div class="stat-label">Total Spent (Users)</div>
            <div class="stat-value">₦{{ number_format($total_spent, 2) }}</div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="stat-card">
            <div class="stat-icon bg-soft-pink">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
            <div class="stat-label">Total Successful Purchases</div>
            <div class="stat-value">{{ number_format($total_purchases) }}</div>
        </div>
    </div>
</div>

<div class="dash-header mb-4 mt-5">
    <h3 class="serif">Profit Analytics</h3>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="stat-card" style="border-left: 4px solid var(--accent-orange)">
            <div class="stat-label">Net Platform Profit</div>
            <div class="stat-value text-dark">₦{{ number_format($total_profit, 2) }}</div>
            <div class="text-muted small mt-2">Combined net earnings across all services</div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="stat-card">
            <div class="row text-center">
                <div class="col-md-3 border-end">
                    <div class="stat-label">Data</div>
                    <div class="fw-bold text-dark">₦{{ number_format($data_profit, 2) }}</div>
                </div>
                <div class="col-md-3 border-end">
                    <div class="stat-label">Cable</div>
                    <div class="fw-bold text-dark">₦{{ number_format($cable_profit, 2) }}</div>
                </div>
                <div class="col-md-3 border-end">
                    <div class="stat-label">Electricity</div>
                    <div class="fw-bold text-dark">₦{{ number_format($electricity_profit, 2) }}</div>
                </div>
                <div class="col-md-3">
                    <div class="stat-label">Exam Pin</div>
                    <div class="fw-bold text-dark">₦{{ number_format($exam_profit, 2) }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-6">
        <div class="stat-card">
            <div class="stat-label">Total Purchase Volume</div>
            <div class="stat-value" style="color: var(--accent-green)">₦{{ number_format($total_purchases_amount, 2) }}</div>
            <div class="text-muted small mt-2">Aggregated successful transaction amounts</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="stat-card">
            <div class="stat-label">Total Funding Volume</div>
            <div class="stat-value" style="color: var(--accent-blue)">₦{{ number_format($total_funding, 2) }}</div>
            <div class="text-muted small mt-2">Aggregated successful funding amounts</div>
        </div>
    </div>
</div>

<div class="recent-table-card">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="serif mb-0">Recent Platform Activity</h4>
        <a href="/superadmin" class="btn btn-sm btn-outline-primary rounded-pill px-3">View All Purchases</a>
    </div>
    
    <div class="table-responsive">
        <table class="modern-table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Service</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $tranx)
                <tr>
                    <td>
                        <div class="fw-bold">{{ $tranx->user->name ?? 'Unknown' }}</div>
                        <div class="text-muted text-xs">{{ $tranx->user->phone ?? 'N/A' }}</div>
                    </td>
                    <td>{{ $tranx->title }}</td>
                    <td class="fw-bold">₦{{ number_format($tranx->amount, 2) }}</td>
                    <td>
                        @if($tranx->status == 1)
                            <span class="badge rounded-pill bg-success-subtle text-success px-3">Success</span>
                        @elseif($tranx->status == 2)
                            <span class="badge rounded-pill bg-warning-subtle text-warning px-3">Pending</span>
                        @else
                            <span class="badge rounded-pill bg-danger-subtle text-danger px-3">Failed</span>
                        @endif
                    </td>
                    <td class="text-muted">{{ $tranx->created_at->format('M d, h:i A') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#filterSelect').on('change', function() {
            const val = $(this).val();
            if (val === 'custom') {
                $('#customDateRange').removeClass('d-none');
            } else {
                $('#customDateRange').addClass('d-none');
                $('#filterForm').submit();
            }
        });
    });
</script>
@endsection