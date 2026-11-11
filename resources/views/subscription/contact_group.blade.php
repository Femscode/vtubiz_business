@extends('dashboard.master1')

@php
    $countNumbers = function ($contacts) {
        return collect(preg_split('/[\s,]+/', (string) $contacts))->filter()->count();
    };
@endphp

@section('header')
<style>
    .src {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .src .choice {
        margin: 0;
        position: relative;
    }

    .src .choice input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .grp-numbers {
        color: var(--text-secondary);
        font-size: .78rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 420px;
    }
</style>
@endsection

@section('content')
<div class="pg">
    <a href="/bulksms" class="pg-back"><i class="fa-solid fa-arrow-left"></i> Bulk SMS</a>
    <div class="pg-head">
        <div>
            <h1>Contact <em>groups</em></h1>
            <p>Save lists of numbers to reuse in bulk SMS.</p>
        </div>
    </div>

    <div class="grid-v side-main">
        <div class="panel">
            <div class="panel-head"><h3>New group</h3></div>
            <form method="post" action="/saveAdminContact" enctype="multipart/form-data">
                @csrf
                <div class="f-group">
                    <label class="f-label" for="grp_name">Group name</label>
                    <input type="text" id="grp_name" name="name" class="f-input" placeholder="e.g. Customers" required>
                </div>

                <div class="f-group">
                    <label class="f-label">Add contacts by</label>
                    <div class="src">
                        <label class="choice" for="manual_input">
                            <input type="radio" name="contact_type" id="manual_input" value="manual_input" checked>
                            <span class="ic t-blue"><i class="fa-solid fa-keyboard"></i></span>
                            <span><b>Typing</b></span>
                        </label>
                        <label class="choice" for="import_csv">
                            <input type="radio" name="contact_type" id="import_csv" value="import_file">
                            <span class="ic t-green"><i class="fa-solid fa-file-arrow-up"></i></span>
                            <span><b>Upload</b></span>
                        </label>
                    </div>
                </div>

                <div class="f-group" id="manual_input_field">
                    <textarea name="contacts" class="f-input" id="contact_field" style="min-height:130px" placeholder="08012345678, 08098765432"></textarea>
                    <div class="f-hint"><span id="contact_count">0</span>&nbsp;numbers</div>
                </div>
                <div class="f-group" id="import_field" style="display:none">
                    <input accept=".xls, .xlsx, .csv" type="file" class="f-input" name="import_file">
                    <div class="f-hint"><i class="fa-solid fa-circle-info"></i> CSV or Excel, one number per row.</div>
                </div>

                <button type="submit" class="btn-v dark block">Save group</button>
            </form>
        </div>

        <div class="panel panel-flush">
            <div class="panel-head">
                <h3>Saved groups <span class="badge-v neutral" style="font-family:'DM Sans'">{{ count($contacts) }}</span></h3>
            </div>

            @if(count($contacts))
                <div class="list-v" style="padding: 8px 24px 12px">
                    @foreach($contacts as $contact)
                        <div class="item">
                            <span class="ic t-purple" style="width:40px;height:40px;border-radius:12px;display:grid;place-items:center;flex-shrink:0"><i class="fa-solid fa-address-book"></i></span>
                            <div style="flex:1;min-width:0">
                                <b style="font-weight:600">{{ $contact->name }}</b>
                                <div class="grp-numbers">{{ $countNumbers($contact->contacts) }} numbers · {{ $contact->contacts }}</div>
                            </div>
                            <a onclick="return confirm('Delete this group?')" class="btn-v danger icon" href="/delete_group/{{ $contact->id }}" title="Delete" aria-label="Delete group"><i class="fa-regular fa-trash-can"></i></a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-v">
                    <div class="ic"><i class="fa-solid fa-address-book"></i></div>
                    <b>No groups yet</b>
                    <span>Create your first group on the left.</span>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    (function () {
        var manual = document.getElementById('manual_input');
        var upload = document.getElementById('import_csv');
        var manualField = document.getElementById('manual_input_field');
        var importField = document.getElementById('import_field');
        function sync() {
            manualField.style.display = manual.checked ? '' : 'none';
            importField.style.display = upload.checked ? '' : 'none';
        }
        manual.addEventListener('change', sync);
        upload.addEventListener('change', sync);

        // Normalise typed numbers into a comma-separated list and count them
        var field = document.getElementById('contact_field');
        var count = document.getElementById('contact_count');
        field.addEventListener('input', function () {
            var text = field.value.replace(/[^0-9,\n ]/g, '').replace(/[\n ]+/g, ',').replace(/,+/g, ',');
            field.value = text;
            count.textContent = text.split(',').filter(function (n) { return n.trim() !== ''; }).length;
        });
    })();
</script>
@endsection
