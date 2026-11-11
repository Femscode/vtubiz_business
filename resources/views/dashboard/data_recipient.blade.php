@extends('dashboard.master1')

@section('content')
<div class="pg">
    <a href="/data_group" class="pg-back"><i class="fa-solid fa-arrow-left"></i> Data groups</a>
    <div class="pg-head">
        <div>
            <h1>{{ $group->name }}</h1>
            <p>{{ count($recipients) }} {{ \Illuminate\Support\Str::plural('recipient', count($recipients)) }} · ₦{{ number_format((float) $recipients->sum('amount')) }} per recharge</p>
        </div>
        <div class="pg-actions">
            <a class="btn-v ghost" href="/data_group"><i class="fa-solid fa-rotate"></i> Recharge group</a>
            <button type="button" class="btn-v dark" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-user-plus"></i> Add recipient</button>
        </div>
    </div>

    <div class="panel panel-flush">
        @if(count($recipients))
            <div class="tbl-wrap">
                <table id="myTable" class="tbl stack">
                    <thead>
                        <tr>
                            <th>Recipient</th>
                            <th>Plan</th>
                            <th>Amount</th>
                            <th class="end"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recipients as $reci)
                            <tr>
                                <td class="lead">
                                    <div class="cell-main">
                                        <span class="ic t-blue"><i class="fa-solid fa-wifi"></i></span>
                                        <div><b>{{ $reci->name }}</b><small>{{ $reci->phone }}</small></div>
                                    </div>
                                </td>
                                <td data-label="Plan"><span class="badge-v neutral">{{ $reci->plan_name }}</span></td>
                                <td data-label="Amount" class="num">₦{{ number_format((float) $reci->amount) }}</td>
                                <td data-label="">
                                    <div class="row-actions">
                                        <a onclick="return confirm('Remove this recipient?')" href="/delete_recipient/{{ $reci->uid }}" class="btn-v danger icon" title="Remove" aria-label="Remove recipient"><i class="fa-regular fa-trash-can"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-v">
                <div class="ic"><i class="fa-solid fa-users"></i></div>
                <b>No recipients yet</b>
                <span>Add the people you want to top up together.</span><br>
                <button type="button" class="btn-v dark" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-user-plus"></i> Add recipient</button>
            </div>
        @endif
    </div>
</div>

<!-- Add recipient modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add recipient</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id='create_form'>
                @csrf
                <div class="modal-body">
                    <input id="group_id" type="hidden" value="{{ $group->id }}" />
                    <div class="f-group">
                        <label class="f-label" for="name">Name</label>
                        <input id="name" type="text" class="f-input" name="name" placeholder="e.g. Mum" required />
                    </div>
                    <div class="f-row">
                        <div class="f-group">
                            <label class="f-label" for="phone">Phone number</label>
                            <input id="phone" oninput="fetchNetwork()" type="tel" inputmode="numeric" class="f-input" name="phone" placeholder="08012345678" required />
                        </div>
                        <div class="f-group">
                            <label class="f-label" for="network">Network</label>
                            <select required onchange="fetchPlan()" id="network" class="f-input">
                                <option value="">Select</option>
                                <option value="1">MTN</option>
                                <option value="2">GLO</option>
                                <option value="3">AIRTEL</option>
                                <option value="4">9MOBILE</option>
                            </select>
                        </div>
                    </div>
                    <div class="f-group" style="margin-bottom:0">
                        <label class="f-label" for="plan_id">Plan</label>
                        <select id="plan_id" required class="f-input">
                            <option value="">Select network first</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-v light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-v dark">Add recipient</button>
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

