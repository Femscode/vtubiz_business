@extends('dashboard.master1')

@php
    $questionCount = collect($tests)->sum(fn ($t) => count($t->questions));
    $title = $giveaway->name ?? ($tests[0]->name ?? 'Giveaway');
    $letters = ['A', 'B', 'C', 'D'];
@endphp

@section('header')
<style>
    .q-card+.q-card {
        margin-top: 14px;
    }

    .q-head {
        display: flex;
        gap: 12px;
        align-items: flex-start;
        margin-bottom: 14px;
    }

    .q-num {
        width: 32px;
        height: 32px;
        border-radius: 10px;
        background: var(--primary-dark);
        color: #fff;
        font-weight: 700;
        font-size: .85rem;
        display: grid;
        place-items: center;
        flex-shrink: 0;
    }

    .q-head h3 {
        font-size: 1rem;
        font-weight: 600;
        color: var(--ink);
        margin: 5px 0 0;
        flex: 1;
        line-height: 1.45;
    }

    .q-opts {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 8px;
    }

    .q-opt {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 11px 14px;
        border-radius: 12px;
        background: #FAFAF8;
        border: 1.5px solid transparent;
        font-size: .9rem;
    }

    .q-opt .l {
        width: 24px;
        height: 24px;
        border-radius: 8px;
        background: #fff;
        border: 1px solid var(--line);
        font-size: .74rem;
        font-weight: 700;
        display: grid;
        place-items: center;
        flex-shrink: 0;
    }

    .q-opt.correct {
        background: #EEF9F2;
        border-color: #A7E3BF;
        color: #1F6B41;
        font-weight: 600;
    }

    .q-opt.correct .l {
        background: var(--accent-green);
        border-color: var(--accent-green);
        color: #fff;
    }

    .opt-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
    }

    .opt-row .f-input {
        flex: 1;
    }

    .opt-row label {
        display: inline-flex !important;
        align-items: center;
        gap: 6px;
        font-size: .8rem !important;
        font-weight: 600 !important;
        color: var(--text-secondary) !important;
        margin: 0 !important;
        white-space: nowrap;
        cursor: pointer;
    }

    .opt-row input[type=radio] {
        width: 18px;
        height: 18px;
        accent-color: var(--accent-green);
    }

    @media (max-width: 600px) {
        .q-opts {
            grid-template-columns: minmax(0, 1fr);
        }
    }
</style>
@endsection

@section('content')
<div class="pg pg-narrow" style="max-width:900px">
    <a href="/my-giveaway" class="pg-back"><i class="fa-solid fa-arrow-left"></i> My giveaways</a>
    <div class="pg-head">
        <div>
            <h1>Quiz <em>questions</em></h1>
            <p>{{ $title }} · {{ $questionCount }} {{ \Illuminate\Support\Str::plural('question', $questionCount) }}</p>
        </div>
        <div class="pg-actions">
            <button type="button" class="btn-v orange" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="fa-solid fa-plus"></i> Add question</button>
        </div>
    </div>

    @if($questionCount === 0)
        <div class="panel">
            <div class="empty-v">
                <div class="ic"><i class="fa-solid fa-circle-question"></i></div>
                <b>No questions yet</b>
                <span>Add at least one question to activate your giveaway link.</span><br>
                <button type="button" class="btn-v dark" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="fa-solid fa-plus"></i> Add your first question</button>
            </div>
        </div>
    @else
        @php $n = 0; @endphp
        @foreach($tests as $test)
            @foreach($test->questions as $ques)
                @php $n++; @endphp
                <div class="panel q-card">
                    <div class="q-head">
                        <span class="q-num">{{ $n }}</span>
                        <h3>{{ $ques->question }}</h3>
                        <a onclick="return confirm('Delete this question?')" class="btn-v danger icon" href="/delete_question/{{ $ques->id }}" title="Delete" aria-label="Delete question"><i class="fa-regular fa-trash-can"></i></a>
                    </div>
                    <div class="q-opts">
                        @foreach($ques->answers as $answer)
                            <div class="q-opt {{ $answer->is_correct ? 'correct' : '' }}">
                                <span class="l">{{ $letters[$loop->index] ?? $loop->iteration }}</span>
                                <span style="flex:1;min-width:0">{{ $answer->answer }}</span>
                                @if($answer->is_correct)<i class="fa-solid fa-check"></i>@endif
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endforeach
    @endif
</div>

<!-- Add question modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">New question</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('storequestion') }}" method="POST">
                @csrf
                <input name="test" type="hidden" value="{{ $giveaway->id }}" />
                <div class="modal-body">
                    <div class="f-group">
                        <label class="f-label" for="q_question">Question</label>
                        <input id="q_question" class="f-input" name="question" placeholder="e.g. What is the capital of Nigeria?" required />
                    </div>
                    <label class="f-label">Options <span style="color:var(--text-light);font-weight:500">· tick the correct one</span></label>
                    @for($i = 0; $i < 4; $i++)
                        <div class="opt-row">
                            <input type="text" name="options[]" class="f-input" placeholder="Option {{ $letters[$i] }}" required>
                            <label><input required type="radio" name="correct_answer" value="{{ $i }}"> Correct</label>
                        </div>
                    @endfor
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-v light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-v dark">Save question</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
