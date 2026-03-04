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

    .user-avatar { width: 45px; height: 45px; border-radius: 50%; background: var(--primary-dark); color: white; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1rem; }
    .btn-action { width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; background: #f1f5f9; color: var(--text-secondary); transition: all 0.2s; border: none; }
    .btn-action:hover { background: var(--primary-dark); color: white; }
</style>
@endsection

@section('content')
<div class="page-header mb-5">
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h1>User Management</h1>
            <p class="text-muted">Total Platform Users: <span class="fw-bold text-dark">{{ number_format($allusers) }}</span></p>
        </div>
        <div class="d-flex gap-2">
            <a href="/manager/user_records" class="btn btn-outline-primary rounded-pill px-4">User Statistics</a>
            <a href="/manager/new_users" class="btn btn-primary rounded-pill px-4">Add New User</a>
        </div>
    </div>
</div>

<div class="table-card">
    <div class="search-group">
        <i class="fa-solid fa-magnifying-glass search-icon"></i>
        <input type="text" id="searchTable" placeholder="Search users by name, email or phone...">
    </div>

    <div class="table-responsive">
        <table class="datatable modern-table">
            <thead>
                <tr>
                    <th>User Profile</th>
                    <th>Contact</th>
                    <th>Wallet Balance</th>
                    <th>Total Spent</th>
                    <th>Bank Details</th>
                    <th>Joined</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            <div class="user-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                            <div>
                                <div class="fw-bold" style="color: var(--primary-dark)">{{ $user->name }}</div>
                                <div class="text-xs text-muted">{{ $user->email }}</div>
                                <div class="text-xs text-success">{{ $user->brand->brand_name ?? 'VTUBIZ' }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="text-muted small">{{ $user->phone }}</div>
                        <a href="https://wa.me/234{{ substr($user->phone, 1) }}" class="text-xs text-success fw-bold"><i class="fa-brands fa-whatsapp"></i> WhatsApp</a>
                    </td>
                    <td>
                        <div class="fw-bold text-dark">₦{{ number_format($user->balance, 2) }}</div>
                    </td>
                    <td>
                        <div class="fw-bold text-primary">₦{{ number_format($user->total_spent, 2) }}</div>
                    </td>
                    <td class="text-xs">
                        <div class="fw-medium">{{ $user->bank_name ?? 'No Bank' }}</div>
                        <div class="text-muted">{{ $user->account_no ?? 'No Account' }}</div>
                    </td>
                    <td class="text-xs text-muted">
                        {{ $user->created_at->format('d M, Y') }}
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn-action" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis-vertical"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm">
                                <li><a class="dropdown-item" href="/manager/user_transaction/{{ $user->uuid }}"><i class="fa-solid fa-list-check me-2"></i> Transactions</a></li>
                                <li><hr class="dropdown-divider"></li>
                                @if($user->upgrade == 0)
                                    <li><a class="dropdown-item" onclick="return confirm('Upgrade this user?')" href="/upgrade_user/{{ $user->uuid }}"><i class="fa-solid fa-arrow-up text-success me-2"></i> Upgrade User</a></li>
                                @else 
                                    <li><a class="dropdown-item text-danger" onclick="return confirm('Degrade this user?')" href="/upgrade_user/{{ $user->uuid }}"><i class="fa-solid fa-arrow-down me-2"></i> Degrade User</a></li>
                                @endif
                                <li><a class="dropdown-item" onclick="return confirm('Reset password?')" href="/reset_password/{{ $user->uuid }}"><i class="fa-solid fa-key me-2"></i> Reset Password</a></li>
                                <li><a class="dropdown-item" onclick="return confirm('Reset PIN?')" href="/reset_pin/{{ $user->uuid }}"><i class="fa-solid fa-shield-halved me-2"></i> Reset PIN</a></li>
                            </ul>
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