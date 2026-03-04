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
    
    .btn-action-modern {
        padding: 8px 16px;
        border-radius: var(--radius-pill);
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
        display: inline-block;
    }
    .btn-success-custom { background: rgba(39, 174, 96, 0.1); color: var(--accent-green); border: none; }
    .btn-info-custom { background: rgba(47, 128, 237, 0.1); color: var(--accent-blue); border: none; }
    
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
    <h1>Pending Transactions</h1>
    <p class="text-muted">Review and manage your transactions awaiting confirmation.</p>
</div>

<div class="transactions-card">
    <div class="search-input-group">
        <i class="fa-solid fa-magnifying-glass search-icon"></i>
        <input type="text" id="searchTable" placeholder="Search pending transactions...">
    </div>

    <div class="table-responsive">
        <table class="datatable modern-table">
            <thead>
                <tr>
                    <th>Details</th>
                    <th>Amount</th>
                    <th>Date & Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $tranx)
                <tr>
                    <td data-label="Details" style="font-weight: 500; color: var(--primary-dark);">
                        {{ $tranx->details }}
                    </td>
                    <td data-label="Amount" style="font-family: 'Fraunces', serif; font-weight: 600;">
                        ₦{{ number_format($tranx->amount) }}
                    </td>
                    <td data-label="Date & Time" class="text-xs text-muted">
                        {{ Date('M d, Y', strtotime($tranx->created_at)) }} | {{ Date('h:i A', strtotime($tranx->created_at)) }}
                    </td>
                    <td data-label="Action">
                        <div class="d-flex gap-2 justify-content-end">
                            <a href='admin_delete_duplicate/confirm/{{ $tranx->id }}' 
                               onclick="return confirm('Confirm the success of this transaction?')" 
                               class='btn-action-modern btn-success-custom'>Confirm</a>
                            <a href='https://wa.me/2349058744473' 
                               class='btn-action-modern btn-info-custom'>Complain</a>
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
<script>
    $(document).ready(function() {
        var oTable = $('.datatable').DataTable({
            ordering: false,
            searching: true,
            dom: 'lrtip'
        });

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
    });
</script>
@endsection
