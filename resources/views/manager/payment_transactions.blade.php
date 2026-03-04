@extends('manager.master')

@section('header')
<style>
    .page-header h1 { font-family: 'Fraunces', serif; font-size: 2.2rem; color: var(--primary-dark); margin-bottom: 8px; }
    .table-card { background: white; border-radius: var(--radius-lg); padding: 30px; box-shadow: var(--shadow-card); border: none; }
    .modern-table { width: 100%; border-collapse: separate; border-spacing: 0 10px; }
    .modern-table thead th { font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: var(--text-light); padding: 10px 20px; border: none; font-weight: 700; }
    .modern-table tbody tr { background: #FDFCF8; transition: transform 0.2s ease; }
    .modern-table tbody tr:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.03); }
    .modern-table tbody td { padding: 16px 20px; font-size: 0.9rem; border: none; vertical-align: middle; }
    .modern-table tbody td:first-child { border-radius: 12px 0 0 12px; }
    .modern-table tbody td:last-child { border-radius: 0 12px 12px 0; }

    .search-group { position: relative; max-width: 400px; margin-bottom: 25px; }
    .search-group input { 
        width: 100%; padding: 12px 16px 12px 45px; border-radius: var(--radius-pill); 
        border: 1px solid rgba(0,0,0,0.08); background: #F9F9F9; transition: all 0.2s; 
    }
    .search-group input:focus { outline: none; border-color: var(--primary-dark); background: white; box-shadow: 0 0 0 4px rgba(15, 53, 72, 0.05); }
    .search-icon { position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: var(--text-light); }

    .badge-status { padding: 6px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; }
    .bg-success-light { background: rgba(39, 174, 96, 0.1); color: #27ae60; }
    .bg-danger-light { background: rgba(235, 87, 87, 0.1); color: #eb5757; }
</style>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        const oTable = $('.datatable').DataTable({
            ordering: false,
            searching: true,
            paging: true,
            pageLength: 25,
            dom: 'lrtip',
            language: {
                paginate: {
                    previous: "<i class='fa-solid fa-chevron-left'></i>",
                    next: "<i class='fa-solid fa-chevron-right'></i>"
                }
            }
        });

        $('#searchTable').on('keyup', function() {
            oTable.search(this.value).draw();
        });

        @if(session('message'))
            Swal.fire({ icon: 'success', title: 'Success!', text: "{{ session('message') }}", confirmButtonColor: '#0F3548' });
        @endif
    });
</script>
@endsection

@section('content')
<div class="page-header mb-5">
    <h1>Payment Transactions</h1>
    <p class="text-muted">Monitor and track all wallet funding activities.</p>
</div>

<div class="table-card">
    <div class="search-group">
        <i class="fa-solid fa-magnifying-glass search-icon"></i>
        <input type="text" id="searchTable" placeholder="Search by name, reference, or type...">
    </div>

    <div class="table-responsive">
        <table class="datatable modern-table">
            <thead>
                <tr>
                    <th>Reference</th>
                    <th>User Details</th>
                    <th>Details</th>
                    <th>Amount</th>
                    <th>Balance (B/A)</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $tranx)
                <tr>
                    <td class="text-xs text-muted">{{ $tranx->reference }}</td>
                    <td>
                        <div class="fw-bold" style="color: var(--primary-dark)">{{ $tranx->user->name ?? 'N/A' }}</div>
                        <div class="text-xs text-muted">{{ $tranx->user->email ?? '' }}</div>
                    </td>
                    <td class="text-xs text-muted">{{ $tranx->description }}</td>
                    <td class="fw-bold">₦{{ number_format($tranx->amount, 2) }}</td>
                    <td class="text-xs">
                        <div class="text-muted">₦{{ number_format($tranx->before) }}</div>
                        <div class="fw-medium">₦{{ number_format($tranx->after) }}</div>
                    </td>
                    <td class="text-uppercase small fw-bold">{{ $tranx->type }}</td>
                    <td>
                        <div class="mb-1 text-xs text-muted">{{ $tranx->created_at->format('d-m-Y H:i') }}</div>
                        @if($tranx->status == 1)
                            <span class="badge-status bg-success-light">Success</span>
                        @else
                            <span class="badge-status bg-danger-light">Failed</span>
                        @endif
                    </td>
                    <td>
                        <a href="/print_transaction_receipt/{{ $tranx->id }}" class="btn btn-light btn-sm rounded-pill px-3">
                            <i class="fa-solid fa-print me-1"></i> Print
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection