{{--
    Shared layout for Data Group and Airtime Group lists.
    Expects: $groups, $cfg = [
        kind, title, titleEm, subtitle, icon, tone, createAction, placeholder,
        recipientsUrl, historyUrl, deleteUrl, rechargeUrl, successLoose (bool)
    ]
--}}
@section('header')
<style>
    .grp-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 18px;
    }

    .grp {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    .grp-top {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .grp-top .ic {
        width: 46px;
        height: 46px;
        border-radius: 14px;
        display: grid;
        place-items: center;
        flex-shrink: 0;
        font-size: 1.05rem;
    }

    .grp-top h3 {
        font-family: 'Fraunces', serif;
        font-weight: 500;
        font-size: 1.15rem;
        margin: 0;
        color: var(--ink);
        word-break: break-word;
    }

    .grp-top small {
        color: var(--text-secondary);
        font-size: .82rem;
    }

    .grp-total {
        background: #FAFAF8;
        border-radius: 14px;
        padding: 14px 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .grp-total small {
        color: var(--text-secondary);
        font-size: .8rem;
        font-weight: 600;
    }

    .grp-total b {
        font-family: 'Fraunces', serif;
        font-weight: 500;
        font-size: 1.35rem;
        color: var(--ink);
    }

    .grp-actions {
        display: flex;
        gap: 8px;
        margin-top: auto;
    }

    .grp-actions .grow {
        flex: 1;
    }
</style>
@endsection

@section('content')
<div class="pg">
    <div class="pg-head">
        <div>
            <h1>{{ $cfg['title'] }} <em>{{ $cfg['titleEm'] }}</em></h1>
            <p>{{ $cfg['subtitle'] }}</p>
        </div>
        <div class="pg-actions">
            <button type="button" class="btn-v orange" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-plus"></i> New group</button>
        </div>
    </div>

    @if(count($groups))
        <div class="grp-grid">
            @foreach($groups as $group)
                @php $total = $group->recipient->sum('amount'); @endphp
                <div class="panel grp">
                    <div class="grp-top">
                        <span class="ic {{ $cfg['tone'] }}"><i class="fa-solid {{ $cfg['icon'] }}"></i></span>
                        <div style="min-width:0">
                            <h3>{{ $group->name }}</h3>
                            <small>{{ count($group->recipient) }} {{ \Illuminate\Support\Str::plural('recipient', count($group->recipient)) }}</small>
                        </div>
                    </div>

                    <div class="grp-total">
                        <small>Per recharge</small>
                        <b>₦{{ number_format((float) $total) }}</b>
                    </div>

                    <div class="grp-actions">
                        <button type="button" class="btn-v dark sm grow recharge" data-group_id="{{ $group->uid }}" data-total_amount="{{ number_format((float) $total) }}"
                            {{ count($group->recipient) ? '' : 'disabled' }}>
                            <i class="fa-solid fa-rotate"></i> Recharge
                        </button>
                        <a href="{{ $cfg['recipientsUrl'] }}/{{ $group->uid }}" class="btn-v light sm grow"><i class="fa-solid fa-users"></i> Recipients</a>
                        <a href="{{ $cfg['historyUrl'] }}/{{ $group->uid }}" class="btn-v light icon" title="History" aria-label="History"><i class="fa-solid fa-clock-rotate-left"></i></a>
                        <a href="{{ $cfg['deleteUrl'] }}/{{ $group->uid }}" class="btn-v danger icon" title="Delete" aria-label="Delete group"
                            onclick="return confirm('Delete this group?')"><i class="fa-regular fa-trash-can"></i></a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="panel">
            <div class="empty-v">
                <div class="ic"><i class="fa-solid {{ $cfg['icon'] }}"></i></div>
                <b>No groups yet</b>
                <span>Group people together and top them all up with one tap.</span><br>
                <button type="button" class="btn-v dark" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-plus"></i> Create a group</button>
            </div>
        </div>
    @endif
</div>

<!-- Create group modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel">New {{ strtolower($cfg['kind']) }} group</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="{{ $cfg['createAction'] }}">
                @csrf
                <div class="modal-body">
                    <label class="f-label" for="group_name">Group name</label>
                    <input type="text" id="group_name" class="f-input" name="name" placeholder="{{ $cfg['placeholder'] }}" required />
                    <div class="f-hint">You'll add recipients after creating the group.</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-v light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-v dark">Create group</button>
                </div>
            </form>
        </div>
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
                title: 'Recharge group',
                text: 'Total: ₦' + totalAmount,
                input: "password",
                inputPlaceholder: "4-digit PIN",
                inputAttributes: {
                    inputmode: "numeric",
                    maxlength: 4,
                    style: "text-align:center; font-size:24px; letter-spacing: 15px",
                },
                showCancelButton: true,
                confirmButtonText: 'Recharge',
                confirmButtonColor: '#001f3f',
                inputValidator: (value) => {
                    if (!/^\d{4}$/.test(value)) {
                        return "Please enter a 4-digit PIN";
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Processing bulk purchase...",
                        didOpen: () => { Swal.showLoading(); },
                        allowOutsideClick: false
                    });
                    let fd = new FormData();
                    fd.append("group_id", groupId);
                    fd.append("pin", result.value);
                    axios.post("{{ $cfg['rechargeUrl'] }}", fd)
                        .then((response) => {
                            if (response.data.success == true || response.success == {!! $cfg['successLoose'] ? "'true'" : 'true' !!}) {
                                Swal.fire({
                                    icon: "success",
                                    title: "Purchase successful!",
                                    text: "Check the group history for confirmation."
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
        });
    });
</script>
@endsection
