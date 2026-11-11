@extends('dashboard.master1')

@php
    $isRaffle = in_array($giveaway->type, ['raffle_data', 'raffle_airtime', 'raffle_cash']);
    $lucky = $giveaway->lucky_numbers ?? [];
    $luckyConfirm = $giveaway->lucky_numbers_confirm ?? [];
    $prize = trim(($giveaway->data_price ?? '') . ' ' . ($giveaway->airtime_price ?? ''));
    $waLink = function ($phone) {
        $digits = preg_replace('/\D+/', '', (string) $phone);
        return 'https://wa.me/' . (str_starts_with($digits, '234') ? $digits : '234' . ltrim($digits, '0'));
    };
@endphp

@section('content')
<div class="pg">
    <a href="/my-giveaway" class="pg-back"><i class="fa-solid fa-arrow-left"></i> My giveaways</a>
    <div class="pg-head">
        <div>
            <h1>{{ $giveaway->name }}</h1>
            <p>
                <span class="badge-v neutral">{{ $isRaffle ? 'Raffle' : 'Quiz' }}</span>
                &nbsp;Worth ₦{{ number_format((float) $giveaway->estimated_amount) }}
            </p>
        </div>
        <div class="pg-actions">
            @unless($isRaffle)
                <a href="/add_question/{{ $giveaway->slug }}" class="btn-v ghost"><i class="fa-solid fa-circle-question"></i> Questions</a>
            @endunless
            <a href="/giveaway_transactions/{{ $giveaway->slug }}" class="btn-v dark"><i class="fa-solid fa-receipt"></i> Transactions</a>
        </div>
    </div>

    <div class="stats-v">
        @if($isRaffle)
            <div class="stat-v">
                <div class="k"><i class="t-blue fa-solid fa-users"></i> Participants</div>
                <div class="v">{{ count($giveaway->all_numbers ?? []) }} / {{ $giveaway->part_no }}</div>
            </div>
            <div class="stat-v">
                <div class="k"><i class="t-green fa-solid fa-trophy"></i> Claimed</div>
                <div class="v">{{ count($lucky) - count($luckyConfirm) }} / {{ count($lucky) }}</div>
            </div>
            <div class="stat-v">
                <div class="k"><i class="t-amber fa-solid fa-gift"></i> Prize</div>
                <div class="v">{{ $prize ?: '—' }}</div>
            </div>
            <div class="stat-v">
                <div class="k"><i class="t-ink fa-solid fa-ticket"></i> Entry fee</div>
                <div class="v">₦{{ number_format((float) $giveaway->entry_fee) }}</div>
            </div>
        @else
            <div class="stat-v">
                <div class="k"><i class="t-green fa-solid fa-trophy"></i> Winners</div>
                <div class="v">{{ $giveaway->no_of_winners - $giveaway->max_winners }} / {{ $giveaway->no_of_winners }}</div>
            </div>
            <div class="stat-v">
                <div class="k"><i class="t-purple fa-solid fa-circle-question"></i> Questions</div>
                <div class="v">{{ count($giveaway->all_questions->all()) }}</div>
            </div>
            <div class="stat-v">
                <div class="k"><i class="t-blue fa-regular fa-clock"></i> Duration</div>
                <div class="v">{{ $giveaway->time }} {{ \Illuminate\Support\Str::plural('min', (int) $giveaway->time) }}</div>
            </div>
            <div class="stat-v">
                <div class="k"><i class="t-amber fa-solid fa-gift"></i> Prize</div>
                <div class="v">{{ $prize ?: '—' }}</div>
            </div>
        @endif
    </div>

    @if($isRaffle && count($lucky))
        <div class="panel" style="margin-bottom:20px">
            <div class="panel-head" style="margin-bottom:12px"><h3>Lucky numbers</h3></div>
            <div class="chips-v" style="margin:0">
                @foreach($lucky as $luk)
                    <span class="chip-v" style="cursor:default">{{ $luk }}</span>
                @endforeach
            </div>
        </div>
    @endif

    <div class="panel panel-flush">
        <div class="panel-head">
            <h3>Participants <span class="badge-v neutral" style="font-family:'DM Sans'">{{ count($participants) }}</span></h3>
            <div class="search-v" style="max-width:280px">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="searchTable" placeholder="Search name or phone">
            </div>
        </div>

        @if(count($participants))
            <div class="tbl-wrap" style="margin-top:16px">
                <table class="tbl stack" id="partTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone</th>
                            @if($isRaffle)<th>Lucky number</th>@endif
                            <th class="end">Contact</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($participants as $tranx)
                            <tr>
                                <td class="lead">
                                    <b>{{ $tranx->name }}</b>
                                    @if($tranx->is_win == 1)
                                        <span class="badge-v ok" style="margin-left:6px">Winner</span>
                                    @endif
                                </td>
                                <td data-label="Phone">{{ $tranx->phone }}</td>
                                @if($isRaffle)
                                    <td data-label="Lucky number" class="num">{{ $tranx->lucky_number }}</td>
                                @endif
                                <td data-label="Contact">
                                    <div class="row-actions">
                                        <a class="btn-v success xs" href="{{ $waLink($tranx->phone) }}" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp"></i> Message</a>
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
                <b>No participants yet</b>
                <span>Share your giveaway link to get people in.</span>
            </div>
        @endif
    </div>
</div>
@endsection

@section('script')
<script>
    (function () {
        var input = document.getElementById('searchTable');
        if (!input) return;
        input.addEventListener('input', function () {
            var q = input.value.trim().toLowerCase();
            document.querySelectorAll('#partTable tbody tr').forEach(function (tr) {
                tr.style.display = !q || tr.innerText.toLowerCase().indexOf(q) !== -1 ? '' : 'none';
            });
        });
    })();
</script>
@endsection
