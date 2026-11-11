@extends('dashboard.master1')

@php
    $typeMeta = function ($type) {
        $isQuiz = str_starts_with($type, 'question');
        $prize = str_contains($type, 'data') ? 'Data' : (str_contains($type, 'airtime') ? 'Airtime' : 'Cash');
        $icon = $prize === 'Data' ? 'fa-wifi' : ($prize === 'Airtime' ? 'fa-phone' : 'fa-money-bill-wave');
        $tone = $prize === 'Data' ? 't-blue' : ($prize === 'Airtime' ? 't-amber' : 't-green');
        return [($isQuiz ? 'Quiz' : 'Raffle') . ' · ' . $prize, $icon, $tone, $isQuiz];
    };
@endphp

@section('header')
<style>
    .gv-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 18px;
    }

    .gv {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .gv-top {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .gv-top .ic {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        display: grid;
        place-items: center;
        flex-shrink: 0;
    }

    .gv-top h3 {
        font-family: 'Fraunces', serif;
        font-weight: 500;
        font-size: 1.15rem;
        color: var(--ink);
        margin: 0 0 2px;
        word-break: break-word;
    }

    .gv-meta {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 8px;
    }

    .gv-meta div {
        background: #FAFAF8;
        border-radius: 12px;
        padding: 10px 12px;
        min-width: 0;
    }

    .gv-meta small {
        display: block;
        font-size: .7rem;
        color: var(--text-secondary);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .06em;
    }

    .gv-meta b {
        font-size: .95rem;
        color: var(--ink);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        display: block;
    }

    .gv-actions {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin-top: auto;
    }

    .gv-actions .grow {
        flex: 1;
    }
</style>
@endsection

@section('content')
<div class="pg">
    <div class="pg-head">
        <div>
            <h1>My <em>giveaways</em></h1>
            <p>Reward your audience with data, airtime or cash.</p>
        </div>
        <div class="pg-actions">
            <a href="/create-giveaway" class="btn-v orange"><i class="fa-solid fa-plus"></i> New giveaway</a>
        </div>
    </div>

    @if($giveaway->isEmpty())
        <div class="panel">
            <div class="empty-v">
                <div class="ic"><i class="fa-solid fa-gift"></i></div>
                <b>No giveaways yet</b>
                <span>Create a raffle or quiz and share the link with your audience.</span><br>
                <a href="/create-giveaway" class="btn-v dark"><i class="fa-solid fa-plus"></i> Create giveaway</a>
            </div>
        </div>
    @else
        <div class="gv-grid">
            @foreach($giveaway as $group)
                @php
                    [$label, $icon, $tone, $isQuiz] = $typeMeta($group->type);
                    $needsQuestions = $isQuiz && count($group->all_questions->all()) == 0;
                @endphp
                <div class="panel gv">
                    <div class="gv-top">
                        <span class="ic {{ $tone }}"><i class="fa-solid {{ $icon }}"></i></span>
                        <div style="min-width:0">
                            <h3>{{ $group->name }}</h3>
                            <span class="badge-v neutral">{{ $label }}</span>
                        </div>
                    </div>

                    <div class="gv-meta">
                        <div><small>Value</small><b>₦{{ number_format((float) $group->estimated_amount) }}</b></div>
                        <div><small>Winners</small><b>{{ $group->no_of_winners ?? '—' }}</b></div>
                        <div><small>Created</small><b>{{ $group->created_at ? $group->created_at->format('M d') : '—' }}</b></div>
                    </div>

                    @if($needsQuestions)
                        <div class="note-v warn">
                            <i class="fa-solid fa-circle-info"></i>
                            <div>Add questions to activate this giveaway link.</div>
                        </div>
                    @else
                        <div class="copy-v">
                            <span id="copy_content_{{ $loop->iteration }}">https://vtubiz.com/{{ $group->slug }}</span>
                            <button type="button" class="btn-v dark xs" onclick="copyText('copy_content_{{ $loop->iteration }}', this)"><i class="fa-regular fa-copy"></i> Copy</button>
                        </div>
                    @endif

                    <div class="gv-actions">
                        @if($isQuiz)
                            <a href="/add_question/{{ $group->slug }}" class="btn-v {{ $needsQuestions ? 'orange' : 'light' }} sm grow"><i class="fa-solid fa-circle-question"></i> Questions</a>
                        @endif
                        <a href="/giveaway_participant/{{ $group->slug }}" class="btn-v light sm grow"><i class="fa-solid fa-chart-simple"></i> Details</a>
                        <a href="/delete_giveaway/{{ $group->slug }}" class="btn-v danger sm icon" title="Delete" aria-label="Delete giveaway"
                            onclick="return confirm('Delete this giveaway?')"><i class="fa-regular fa-trash-can"></i></a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

@section('script')
<script>
    function copyText(id, btn) {
        var text = document.getElementById(id).innerText.trim();
        var done = function () {
            var old = btn.innerHTML;
            btn.innerHTML = '<i class="fa-solid fa-check"></i> Copied';
            setTimeout(function () { btn.innerHTML = old; }, 1500);
        };
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(text).then(done);
        } else {
            var t = document.createElement('textarea');
            t.value = text; document.body.appendChild(t); t.select();
            document.execCommand('copy'); document.body.removeChild(t); done();
        }
    }
</script>
@endsection
