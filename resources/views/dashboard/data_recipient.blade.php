@extends('dashboard.master1')
@section('header')
<style>
    .recipient-header {
        margin-bottom: var(--space-lg);
    }
    .recipient-header h1 {
        font-family: 'Fraunces', serif;
        font-size: 2.2rem;
        color: var(--primary-dark);
        margin-bottom: 8px;
    }
    .recipient-card {
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
    
    .btn-action-modern {
        padding: 8px 16px;
        border-radius: var(--radius-pill);
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-add { background: var(--primary-dark); color: white !important; }
    .btn-initiate { background: rgba(47, 128, 237, 0.1); color: var(--accent-blue) !important; }
    .btn-delete { background: rgba(235, 87, 87, 0.1); color: var(--accent-pink) !important; border: none; }
</style>
@endsection

@section('content')
<div class="recipient-header">
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h1>{{ $group->name }}</h1>
            <p class="text-muted">Total Group Value: <span class="text-dark font-weight-bold">₦{{ number_format($recipients->sum('amount')) }}</span></p>
        </div>
        <div class="d-flex gap-2">
            <a class='btn-action-modern btn-initiate' href='/data_group'>← Initiate Purchase</a>
            <button class='btn-action-modern btn-add' data-bs-toggle="modal" data-bs-target="#exampleModal">Add Recipient</button>
        </div>
    </div>
</div>

<div class="recipient-card">
    <div class="table-responsive">
        <table id='myTable' class='modern-table'>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Plan</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recipients as $reci)
                <tr>
                    <td><div style="font-weight: 600; color: var(--primary-dark);">{{ $reci->name }}</div></td>
                    <td><div class="text-muted">{{ $reci->phone }}</div></td>
                    <td><span class="badge" style="background: rgba(47, 128, 237, 0.1); color: var(--accent-blue); border-radius: 20px; padding: 6px 12px;">{{ $reci->plan_name }}</span></td>
                    <td style="font-family: 'Fraunces', serif; font-weight: 600; color: var(--primary-dark);">₦{{number_format($reci->amount) }}</td>
                    <td>
                        <a onclick='return confirm("Are you sure you want to delete this recipient?")' href='/delete_recipient/{{ $reci->uid }}'
                            class='btn-action-modern btn-delete'>Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Recipient</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id='create_form'>@csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Name</label>
                        <input id='name' type='text' class='form-control' name='name' placeholder='e.g My Mum' required />
                    </div>
                    <input id='group_id' type='hidden' value='{{ $group->id }}' />
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Phone Number</label>
                        <input id='phone' oninput="fetchNetwork()" type='number' class='form-control' name='phone' placeholder='08XXXXXXXXX' required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Network</label>
                        <select required onchange="fetchPlan()" id="network" class="form-control">
                            <option value="">Select Network</option>
                            <option value="1">MTN</option>
                            <option value="2">GLO</option>
                            <option value="3">AIRTEL</option>
                            <option value="4">9MOBILE</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label font-weight-bold">Plan</label>
                        <select id='plan_id' required class="form-control">
                            <option value="">-- Select Plan --</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary btn-sm rounded-pill" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary btn-sm rounded-pill px-5">Create Recipient</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function() {
        // Initialize DataTable
        // var oTable = $('#myTable').DataTable({
        //     ordering: false,
        //     searching: true,
        //     paging: true,
        //     pageLength: 25,
        //     info: true
        // });

        // Form submission for creating recipient
        $("#create_form").on("submit", function(e) {
            e.preventDefault();
            createRecipient();
        });

        function createRecipient() {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });

            Swal.fire({
                title: "Processing...",
                didOpen: () => { Swal.showLoading(); },
                allowOutsideClick: false
            });
            
            let fd = new FormData();
            fd.append("name", $("#name").val());
            fd.append("phone", $("#phone").val());
            fd.append("network", $("#network").val());
            fd.append("plan_id", $("#plan_id").val());
            fd.append("group_id", $("#group_id").val());
            fd.append("plan_name", $("#plan_id option:selected").text());
            
            axios.post("/saveRecipient", fd)
                .then((response) => {
                    Swal.close();
                    Toast.fire({
                        icon: "success",
                        title: "Recipient Added Successfully!",
                    }).then(() => {
                        window.location.reload();
                    });
                })
                .catch((error) => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: error.response?.data?.message || error.message
                    });
                });
        }
    });

    function fetchNetwork() {
        var phone = $("#phone").val();
        if (phone.length >= 10 && phone.length <= 12) {
            axios.get("/fetchnetwork/" + phone)
                .then((response) => {
                    if (response.data !== 0) {
                        $("#network").val(response.data);
                        fetchPlan();
                    }
                });
        }
    }

    function fetchPlan() {
        var network = $("#network").val();
        if (network) {
            $.get("/fetchplan/" + network, function (response) {
                if (response !== false) {
                    var selectField = $("#plan_id");
                    selectField.empty();
                    selectField.append('<option value="">-- Select Plan --</option>');
                    response.forEach(function (item) {
                        var option = $("<option></option>")
                            .attr("value", item.plan_id)
                            .text(item.plan_name);
                        selectField.append(option);
                    });
                }
            });
        }
    }
</script>
@endsection

