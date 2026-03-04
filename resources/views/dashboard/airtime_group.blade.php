@extends('dashboard.master1')

@section('header')
<style>
    .group-header {
        margin-bottom: var(--space-lg);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .group-header h1 {
        font-family: 'Fraunces', serif;
        font-size: 2.2rem;
        color: var(--primary-dark);
        margin-bottom: 8px;
    }
    .group-card {
        background: var(--surface);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        box-shadow: var(--shadow-card);
    }
    .btn-create {
        background: var(--primary-dark);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: var(--radius-pill);
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.1s;
    }
    .btn-create:hover { color: white; opacity: 0.9; }
    
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
    }
    .modern-table tbody tr {
        background: #FDFCF8;
        transition: transform 0.2s;
    }
    .modern-table tbody td {
        padding: 16px 20px;
        font-size: 0.9rem;
        vertical-align: middle;
    }
    .modern-table tbody td:first-child { border-radius: 12px 0 0 12px; }
    .modern-table tbody td:last-child { border-radius: 0 12px 12px 0; }

    .btn-action-sm {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        margin-right: 4px;
        border: none;
    }
    .btn-primary-sm { background: rgba(47, 128, 237, 0.1); color: var(--accent-blue); }
    .btn-success-sm { background: rgba(39, 174, 96, 0.1); color: var(--accent-green); }
    .btn-info-sm { background: rgba(15, 53, 72, 0.05); color: var(--primary-dark); }
    .btn-danger-sm { background: rgba(235, 87, 87, 0.1); color: var(--accent-pink); }
</style>
@endsection

@section('content')
<div class="group-header">
    <div>
        <h1>Airtime Group</h1>
        <p class="text-muted">Manage your airtime groups and perform bulk recharges.</p>
    </div>
    <button class='btn-create' data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="fa-solid fa-plus me-2"></i> Create Group
    </button>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 id="exampleModalLabel">Create Airtime Group</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method='post' action='/createAirtimeGroup'>@csrf
                <div class="modal-body">
                    <label>Group Name</label>
                    <input type='text' class='form-control' name='name' placeholder='e.g. Family Members, Team A' required />
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" style="border-radius: 20px;" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-create">Create Group</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="group-card">
    <div class="table-responsive">
        <table class='modern-table'>
            <thead>
                <tr>
                    <th>Group Name</th>
                    <th>Recipients</th>
                    <th>Total Amount</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($airtime_groups as $group)
                <tr>
                    <td style="font-weight: 600; color: var(--primary-dark);">{{ $group->name }}</td>
                    <td>
                        <span class="badge" style="background: rgba(15, 53, 72, 0.05); color: var(--primary-dark); border-radius: 10px; padding: 4px 10px;">
                            {{ count($group->recipient) }} Users
                        </span>
                    </td>
                    <td style="font-family: 'Fraunces', serif; font-weight: 600;">₦{{ number_format($group->recipient->sum('amount')) }}</td>
                    <td>
                        <div class="d-flex justify-content-end gap-1">
                            <a href='/premium-airtime_recipients/{{ $group->uid }}' class='btn-action-sm btn-primary-sm'>Recipients</a>
                            <a data-group_id='{{ $group->uid }}' data-total_amount="{{ number_format($group->recipient->sum('amount')) }}" class='recharge btn-action-sm btn-success-sm' style="cursor: pointer;">Recharge</a>
                            <a href='/premium-group_airtime_transactions/{{ $group->uid }}' class='btn-action-sm btn-info-sm'>History</a>
                            <a onclick="return confirm('Are you sure you want to delete this group?')" href='/delete_airtime_group/{{ $group->uid }}' class='btn-action-sm btn-danger-sm'>Delete</a>
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
        $(".recharge").click(function() {
            const totalAmount = $(this).data('total_amount');
            const groupId = $(this).data('group_id');
            
            Swal.fire({
                title: 'Confirm Bulk Recharge',
                text: 'Total Amount: ₦' + totalAmount,
                icon: 'question',
                input: "password",
                inputPlaceholder: "Enter 4-digit PIN",
                inputAttributes: {
                    inputmode: "numeric",
                    maxlength: 4,
                    style: "text-align:center; font-size:24px; letter-spacing: 15px",
                },
                showCancelButton: true,
                confirmButtonText: 'Proceed',
                confirmButtonColor: '#0F3548',
                cancelButtonColor: '#EB5757',
                inputValidator: (value) => {
                    if (!/^\d{4}$/.test(value)) {
                        return "Please enter a 4-digit PIN";
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Making bulk purchase...",
                        didOpen: () => { Swal.showLoading(); },
                        allowOutsideClick: false
                    });

                    let fd = new FormData();
                    fd.append("group_id", groupId);
                    fd.append("pin", result.value);
                    
                    axios.post("/recharge_airtime_group", fd)
                        .then((response) => {
                            if (response.data.success == true || response.success == 'true') {
                                Swal.fire({
                                    icon: "success",
                                    title: "Purchase Successful!",
                                    text: "Check transactions to confirm."
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
        });

        @if (session('success'))
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000
            });
        @endif
    });
</script>
@endsection
