@extends('dashboard.master1')

@php
    $firstName = explode(' ', trim($user->name))[0];
    $hour = (int) now()->format('G');
    $greeting = $hour < 12 ? 'Good morning' : ($hour < 17 ? 'Good afternoon' : 'Good evening');

    $balance = number_format((float) $user->balance, 2);
    [$balWhole, $balKobo] = explode('.', $balance);

    $referralLink = 'https://vtubiz.com/register?referral_code=' . $user->brand_name;
    $referralCount = $referral_count ?? \App\Models\User::where('referred_by', $user->brand_name)->count();

    $txMeta = function ($trans) {
        $t = strtolower($trans->title);
        if ($trans->type === 'credit') return ['fa-arrow-down', 'tx-green'];
        if (str_contains($t, 'data')) return ['fa-wifi', 'tx-blue'];
        if (str_contains($t, 'airtime')) return ['fa-phone', 'tx-amber'];
        if (str_contains($t, 'electric')) return ['fa-lightbulb', 'tx-yellow'];
        if (str_contains($t, 'cable') || str_contains($t, 'tv')) return ['fa-tv', 'tx-pink'];
        if (str_contains($t, 'exam') || str_contains($t, 'waec') || str_contains($t, 'neco')) return ['fa-graduation-cap', 'tx-purple'];
        if (str_contains($t, 'sms')) return ['fa-message', 'tx-ink'];
        if (str_contains($t, 'transfer')) return ['fa-paper-plane', 'tx-ink'];
        return ['fa-arrow-up', 'tx-ink'];
    };
@endphp

@section('header')
<style>
    .db-actions {
        display: flex;
        gap: 10px;
        flex-shrink: 0;
    }

    .db,
    .db * {
        min-width: 0;
    }

    .db {
        width: 100%;
        max-width: 1240px;
        margin: 0 auto;
        padding: 12px 8px 40px;
    }

    /* ---------- Header ---------- */
    .db-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 16px;
        margin-bottom: 26px;
    }

    .db-head .hello {
        color: var(--text-secondary);
        font-size: .95rem;
        margin-bottom: 2px;
    }

    .db-head h1 {
        font-family: 'Fraunces', serif;
        font-weight: 400;
        font-size: clamp(2rem, 3.4vw, 2.75rem);
        letter-spacing: -0.02em;
        color: var(--ink);
        line-height: 1.1;
    }

    .db-head h1 em {
        color: var(--brand-orange-2);
    }

    .db-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 11px 20px;
        border-radius: 999px;
        font-weight: 600;
        font-size: .9rem;
        text-decoration: none;
        transition: transform .15s, box-shadow .2s, background .2s;
        border: 1px solid transparent;
        white-space: nowrap;
    }

    .db-btn:hover {
        transform: translateY(-1px);
    }

    .db-btn-dark {
        background: var(--primary-dark);
        color: #fff;
    }

    .db-btn-dark:hover {
        color: #fff;
        box-shadow: 0 12px 24px -12px rgba(0, 31, 63, .6);
    }

    .db-btn-ghost {
        background: var(--surface);
        border-color: var(--line);
        color: var(--ink);
    }

    .db-btn-ghost:hover {
        color: var(--ink);
        box-shadow: var(--shadow-card);
    }

    /* ---------- Notice ---------- */
    .db-notice {
        display: flex;
        gap: 14px;
        align-items: flex-start;
        background: #FFF8EE;
        border: 1px solid #FBE3C4;
        border-radius: 18px;
        padding: 16px 18px;
        margin-bottom: 24px;
        color: #5B3A12;
        font-size: .93rem;
        line-height: 1.6;
    }

    .db-notice .ic {
        width: 36px;
        height: 36px;
        border-radius: 12px;
        background: var(--brand-orange);
        color: #fff;
        display: grid;
        place-items: center;
        flex-shrink: 0;
    }

    .db-notice p:last-child {
        margin-bottom: 0;
    }

    /* ---------- Grid ---------- */
    .db-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.6fr) minmax(0, 1fr);
        gap: 24px;
        align-items: start;
    }

    .db-col {
        display: flex;
        flex-direction: column;
        gap: 24px;
        min-width: 0;
    }

    .db-card {
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: 24px;
        padding: 24px;
        box-shadow: var(--shadow-card);
    }

    .db-card-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
    }

    .db-card-head h3 {
        font-family: 'Fraunces', serif;
        font-weight: 500;
        font-size: 1.2rem;
        color: var(--ink);
        margin: 0;
    }

    .db-link {
        font-size: .86rem;
        font-weight: 600;
        color: var(--ink);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .db-link:hover {
        color: var(--brand-orange-2);
    }

    /* ---------- Balance card ---------- */
    .bal {
        position: relative;
        overflow: hidden;
        border-radius: 28px;
        padding: 30px 30px 26px;
        color: #fff;
        background: linear-gradient(150deg, #04284d 0%, var(--primary-dark) 45%, #00162d 100%);
        isolation: isolate;
        box-shadow: 0 30px 60px -30px rgba(0, 31, 63, .7);
    }

    .bal::before {
        content: "";
        position: absolute;
        width: 420px;
        height: 420px;
        right: -140px;
        bottom: -220px;
        border-radius: 50%;
        background: radial-gradient(circle at 40% 40%, #ffcf99 0%, var(--brand-orange) 30%, rgba(180, 65, 10, .6) 55%, transparent 72%);
        filter: blur(6px);
        opacity: .9;
        z-index: -1;
    }

    .bal::after {
        content: "";
        position: absolute;
        width: 640px;
        height: 640px;
        right: -260px;
        bottom: -330px;
        border-radius: 50%;
        border: 1px solid rgba(255, 255, 255, .08);
        box-shadow: 0 0 0 70px rgba(255, 255, 255, .015), 0 0 0 71px rgba(255, 255, 255, .06);
        z-index: -1;
    }

    .bal-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .bal-label {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-size: .82rem;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, .65);
        font-weight: 600;
    }

    .eye {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 0;
        background: rgba(255, 255, 255, .1);
        color: #fff;
        cursor: pointer;
        font-size: .8rem;
    }

    .eye:hover {
        background: rgba(255, 255, 255, .18);
    }

    .bal-tag {
        font-size: .76rem;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 999px;
        background: rgba(255, 255, 255, .08);
        border: 1px solid rgba(255, 255, 255, .12);
        color: rgba(255, 255, 255, .85);
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .bal-tag i {
        color: #4ADE80;
        font-size: .55rem;
    }

    .bal-amount {
        font-family: 'Fraunces', serif;
        font-weight: 400;
        font-size: clamp(2.6rem, 5vw, 3.6rem);
        letter-spacing: -0.025em;
        line-height: 1;
        margin: 22px 0 30px;
        font-variant-numeric: tabular-nums;
        color: #fff;
    }

    .bal-amount .cur {
        font-size: .55em;
        vertical-align: .55em;
        margin-right: 4px;
        color: rgba(255, 255, 255, .7);
    }

    .bal-amount .kobo {
        font-size: .45em;
        color: rgba(255, 255, 255, .55);
    }

    .bal-amount .masked {
        display: none;
        letter-spacing: .1em;
    }

    .bal.hidden .bal-amount .real {
        display: none;
    }

    .bal.hidden .bal-amount .masked {
        display: inline;
    }

    .bal-actions {
        display: flex;
        gap: 22px;
    }

    .bal-action {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        color: rgba(255, 255, 255, .85);
        font-size: .8rem;
        font-weight: 600;
    }

    .bal-action span.c {
        width: 52px;
        height: 52px;
        border-radius: 18px;
        display: grid;
        place-items: center;
        background: rgba(255, 255, 255, .1);
        border: 1px solid rgba(255, 255, 255, .14);
        font-size: 1.05rem;
        color: #fff;
        transition: background .2s, transform .15s;
        backdrop-filter: blur(6px);
    }

    .bal-action.primary span.c {
        background: #fff;
        color: var(--primary-dark);
        border-color: #fff;
    }

    .bal-action:hover {
        color: #fff;
    }

    .bal-action:hover span.c {
        transform: translateY(-2px);
        background: rgba(255, 255, 255, .18);
    }

    .bal-action.primary:hover span.c {
        background: #fff;
    }

    /* ---------- Stats ---------- */
    .stats {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
    }

    .stat {
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: 20px;
        padding: 18px 20px;
        box-shadow: var(--shadow-card);
    }

    .stat .k {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: .8rem;
        color: var(--text-secondary);
        font-weight: 500;
        margin-bottom: 10px;
    }

    .stat .k i {
        width: 26px;
        height: 26px;
        border-radius: 8px;
        display: grid;
        place-items: center;
        font-size: .72rem;
    }

    .stat .v {
        font-family: 'Fraunces', serif;
        font-size: 1.5rem;
        font-weight: 500;
        color: var(--ink);
        letter-spacing: -0.01em;
        font-variant-numeric: tabular-nums;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* ---------- Services ---------- */
    .svc-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 12px;
    }

    .svc {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 14px;
        padding: 16px;
        border-radius: 18px;
        background: #FAFAF8;
        border: 1px solid transparent;
        text-decoration: none;
        color: var(--ink);
        transition: background .2s, border-color .2s, transform .15s, box-shadow .2s;
    }

    .svc:hover {
        background: #fff;
        border-color: var(--line);
        transform: translateY(-2px);
        box-shadow: var(--shadow-hover);
        color: var(--ink);
    }

    .svc .ic {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        display: grid;
        place-items: center;
        font-size: 1rem;
    }

    .svc b {
        font-weight: 600;
        font-size: .9rem;
        display: block;
    }

    .svc small {
        color: var(--text-secondary);
        font-size: .76rem;
    }

    .tx-blue {
        background: #EAF2FF;
        color: #2563EB;
    }

    .tx-amber {
        background: #FFF4E5;
        color: #EA7A0C;
    }

    .tx-yellow {
        background: #FEF7D7;
        color: #B88A00;
    }

    .tx-pink {
        background: #FFECEF;
        color: #E11D48;
    }

    .tx-purple {
        background: #F1ECFF;
        color: #7C3AED;
    }

    .tx-green {
        background: #E7F7EE;
        color: #1F9D57;
    }

    .tx-ink {
        background: #EEF0F3;
        color: var(--ink);
    }

    .tx-teal {
        background: #E3F6F4;
        color: #0F8C80;
    }

    /* ---------- Activity ---------- */
    .tx-list {
        display: flex;
        flex-direction: column;
    }

    .tx {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 13px 0;
        border-bottom: 1px solid var(--line);
    }

    .tx:last-child {
        border-bottom: 0;
        padding-bottom: 0;
    }

    .tx:first-child {
        padding-top: 0;
    }

    .tx .ic {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        display: grid;
        place-items: center;
        flex-shrink: 0;
        font-size: .92rem;
    }

    .tx-info {
        min-width: 0;
        flex: 1;
    }

    .tx-info b {
        display: block;
        font-weight: 600;
        font-size: .9rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .tx-info small {
        color: var(--text-secondary);
        font-size: .77rem;
    }

    .tx-right {
        text-align: right;
        flex-shrink: 0;
    }

    .tx-amt {
        font-weight: 700;
        font-size: .92rem;
        font-variant-numeric: tabular-nums;
        display: block;
    }

    .tx-amt.pos {
        color: var(--accent-green);
    }

    .pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: .68rem;
        font-weight: 700;
        margin-top: 3px;
    }

    .pill::before {
        content: "";
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }

    .pill.ok {
        color: #1F9D57;
    }

    .pill.pend {
        color: #D97706;
    }

    .pill.fail {
        color: #DC2626;
    }

    .empty {
        text-align: center;
        padding: 26px 10px 10px;
        color: var(--text-secondary);
    }

    .empty .ic {
        width: 56px;
        height: 56px;
        border-radius: 18px;
        background: #F4F4F1;
        display: grid;
        place-items: center;
        margin: 0 auto 12px;
        font-size: 1.2rem;
        color: var(--text-light);
    }

    .empty b {
        display: block;
        color: var(--ink);
        margin-bottom: 4px;
    }

    /* ---------- Referral ---------- */
    .ref {
        position: relative;
        overflow: hidden;
        background: #FBF7F0;
        border: 1px solid #F1E6D3;
        border-radius: 24px;
        padding: 24px;
    }

    .ref::after {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        right: -60px;
        top: -60px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(251, 145, 41, .25), transparent 70%);
    }

    .ref-top {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 8px;
        position: relative;
    }

    .ref-top .ic {
        width: 42px;
        height: 42px;
        border-radius: 14px;
        background: var(--primary-dark);
        color: var(--brand-orange);
        display: grid;
        place-items: center;
    }

    .ref h3 {
        font-family: 'Fraunces', serif;
        font-weight: 500;
        font-size: 1.2rem;
        margin: 0;
        color: var(--ink);
    }

    .ref p {
        color: #6B5E4B;
        font-size: .88rem;
        margin: 6px 0 16px;
        position: relative;
    }

    .ref-link {
        display: flex;
        align-items: center;
        gap: 8px;
        background: #fff;
        border: 1px dashed #E3CFAE;
        border-radius: 14px;
        padding: 6px 6px 6px 14px;
        position: relative;
    }

    .ref-link span {
        flex: 1;
        min-width: 0;
        font-size: .82rem;
        color: var(--text-secondary);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .copy-btn {
        border: 0;
        background: var(--primary-dark);
        color: #fff;
        font-weight: 600;
        font-size: .78rem;
        padding: 9px 14px;
        border-radius: 10px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        flex-shrink: 0;
        transition: background .2s;
    }

    .copy-btn.done {
        background: var(--accent-green);
    }

    .ref-stats {
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
        gap: 12px;
        margin-top: 16px;
        position: relative;
    }

    .ref-stats div {
        background: #fff;
        border-radius: 14px;
        padding: 12px 14px;
    }

    .ref-stats b {
        font-family: 'Fraunces', serif;
        font-size: 1.35rem;
        font-weight: 500;
        display: block;
        color: var(--ink);
    }

    .ref-stats small {
        color: var(--text-secondary);
        font-size: .75rem;
    }

    .ref .db-link {
        margin-top: 16px;
        position: relative;
    }

    /* ---------- Responsive ---------- */
    @media (max-width: 1199px) {
        .svc-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (max-width: 991px) {
        .db {
            padding: 4px 0 20px;
        }

        .db-grid {
            display: flex;
            flex-direction: column;
            align-items: stretch;
            gap: 20px;
        }

        .db-grid > .db-col > * {
            width: 100%;
            max-width: 100%;
        }

        .db-col {
            display: contents;
        }

        .o-1 {
            order: 1;
        }

        .o-2 {
            order: 2;
        }

        .o-3 {
            order: 3;
        }

        .o-4 {
            order: 4;
        }

        .o-5 {
            order: 5;
        }

        .db-head .db-actions {
            display: none;
        }
    }

    @media (max-width: 600px) {
        .db-head {
            margin-bottom: 18px;
        }

        .bal {
            padding: 24px 22px 22px;
            border-radius: 24px;
        }

        .bal-amount {
            margin: 18px 0 24px;
        }

        .bal-actions {
            justify-content: space-between;
            gap: 8px;
        }

        .stats {
            grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
            gap: 12px;
        }

        .stats .stat:last-child {
            grid-column: 1 / -1;
        }

        .stat {
            padding: 14px;
        }

        .stat .v {
            font-size: clamp(1rem, 4.6vw, 1.25rem);
        }

        .db-card {
            padding: 20px 18px;
            border-radius: 22px;
        }

        .svc-grid {
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 6px;
        }

        .svc {
            align-items: center;
            text-align: center;
            padding: 12px 4px;
            gap: 8px;
            background: transparent;
        }

        .svc:hover {
            box-shadow: none;
            transform: none;
            border-color: transparent;
        }

        .svc .ic {
            width: 50px;
            height: 50px;
            border-radius: 16px;
            font-size: 1.1rem;
        }

        .svc b {
            font-size: .74rem;
            font-weight: 600;
        }

        .svc small {
            display: none;
        }
    }
    @media (max-width: 600px) {
        .bal::before {
            width: 260px;
            height: 260px;
            right: -110px;
            bottom: -150px;
            opacity: .75;
        }

        .bal::after {
            width: 420px;
            height: 420px;
            right: -190px;
            bottom: -230px;
        }

        .db-head h1 {
            font-size: 2rem;
        }

        .bal-top {
            flex-wrap: wrap;
            gap: 8px;
        }

        .bal-amount {
            font-size: clamp(2.1rem, 11vw, 2.8rem);
            word-break: break-all;
        }

        .bal-action {
            flex: 1;
            font-size: .74rem;
        }

        .bal-action span.c {
            width: 48px;
            height: 48px;
            border-radius: 16px;
        }

        .stat .k {
            font-size: .74rem;
        }

        .tx {
            gap: 10px;
        }

        .tx .ic {
            width: 38px;
            height: 38px;
            border-radius: 12px;
        }

        .tx-amt {
            font-size: .84rem;
        }

        .ref {
            padding: 20px 18px;
        }
    }

    @media (max-width: 380px) {
        .svc-grid {
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 2px;
        }

        .svc .ic {
            width: 44px;
            height: 44px;
            border-radius: 14px;
        }

        .svc b {
            font-size: .68rem;
        }

        .bal-action span.c {
            width: 44px;
            height: 44px;
        }

    }

    @media (max-width: 340px) {
        .stats {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="db">

    <header class="db-head">
        <div>
            <p class="hello">{{ $greeting }},</p>
            <h1>{{ $firstName }}<em>.</em></h1>
        </div>
        <div class="db-actions">
            <a href="/mytransactions" class="db-btn db-btn-ghost"><i class="fa-solid fa-clock-rotate-left"></i> History</a>
            <a href="/fundwallet" class="db-btn db-btn-dark"><i class="fa-solid fa-plus"></i> Fund wallet</a>
        </div>
    </header>

    @if(isset($notification2))
    <div class="db-notice">
        <span class="ic"><i class="fa-solid fa-bullhorn"></i></span>
        <div>{!! $notification2->description !!}</div>
    </div>
    @endif

    <div class="db-grid">
        <!-- Left -->
        <div class="db-col">

            <section class="bal o-1" id="balCard">
                <div class="bal-top">
                    <span class="bal-label">
                        Wallet balance
                        <button type="button" class="eye" id="eyeBtn" aria-label="Hide balance" onclick="toggleBalance()"><i class="fa-regular fa-eye"></i></button>
                    </span>
                    <span class="bal-tag"><i class="fa-solid fa-circle"></i> {{ ucfirst($user->user_type) }}</span>
                </div>

                <div class="bal-amount">
                    <span class="real"><span class="cur">₦</span>{{ $balWhole }}<span class="kobo">.{{ $balKobo }}</span></span>
                    <span class="masked"><span class="cur">₦</span>••••••</span>
                </div>

                <div class="bal-actions">
                    <a href="/fundwallet" class="bal-action primary"><span class="c"><i class="fa-solid fa-plus"></i></span>Fund</a>
                    <a href="/transfer" class="bal-action"><span class="c"><i class="fa-solid fa-paper-plane"></i></span>Transfer</a>
                    <a href="/data" class="bal-action"><span class="c"><i class="fa-solid fa-wifi"></i></span>Data</a>
                    <a href="/mytransactions" class="bal-action"><span class="c"><i class="fa-solid fa-receipt"></i></span>History</a>
                </div>
            </section>

            <section class="stats o-3">
                <div class="stat">
                    <div class="k"><i class="tx-pink fa-solid fa-arrow-up"></i> Spent this month</div>
                    <div class="v">₦{{ number_format((float) ($month_spent ?? 0)) }}</div>
                </div>
                <div class="stat">
                    <div class="k"><i class="tx-green fa-solid fa-arrow-down"></i> Funded this month</div>
                    <div class="v">₦{{ number_format((float) ($month_funded ?? 0)) }}</div>
                </div>
                <div class="stat">
                    <div class="k"><i class="tx-blue fa-solid fa-bag-shopping"></i> Purchases</div>
                    <div class="v">{{ number_format($month_count ?? 0) }}</div>
                </div>
            </section>

            <section class="db-card o-2">
                <div class="db-card-head">
                    <h3>Pay &amp; top up</h3>
                </div>
                <div class="svc-grid">
                    <a href="/data" class="svc"><span class="ic tx-blue"><i class="fa-solid fa-wifi"></i></span><span><b>Data</b><small>All networks</small></span></a>
                    <a href="/airtime" class="svc"><span class="ic tx-amber"><i class="fa-solid fa-phone"></i></span><span><b>Airtime</b><small>Instant top-up</small></span></a>
                    <a href="/electricity" class="svc"><span class="ic tx-yellow"><i class="fa-solid fa-lightbulb"></i></span><span><b>Electricity</b><small>Prepaid &amp; postpaid</small></span></a>
                    <a href="/cable" class="svc"><span class="ic tx-pink"><i class="fa-solid fa-tv"></i></span><span><b>Cable TV</b><small>DStv, GOtv, Startimes</small></span></a>
                    <a href="/examination" class="svc"><span class="ic tx-purple"><i class="fa-solid fa-graduation-cap"></i></span><span><b>Exam Pins</b><small>WAEC, NECO</small></span></a>
                    <a href="/bulksms" class="svc"><span class="ic tx-ink"><i class="fa-solid fa-message"></i></span><span><b>Bulk SMS</b><small>Reach many</small></span></a>
                    <a href="/data_group" class="svc"><span class="ic tx-teal"><i class="fa-solid fa-layer-group"></i></span><span><b>Groups</b><small>Buy for many</small></span></a>
                    <a href="/my-giveaway" class="svc"><span class="ic tx-green"><i class="fa-solid fa-gift"></i></span><span><b>Giveaway</b><small>Reward people</small></span></a>
                </div>
            </section>
        </div>

        <!-- Right -->
        <div class="db-col">
            <section class="db-card o-4">
                <div class="db-card-head">
                    <h3>Recent activity</h3>
                    <a href="/mytransactions" class="db-link">See all <i class="fa-solid fa-arrow-right"></i></a>
                </div>

                <div class="tx-list">
                    @forelse($transactions as $trans)
                        @php [$icon, $tone] = $txMeta($trans); @endphp
                        <div class="tx">
                            <span class="ic {{ $tone }}"><i class="fa-solid {{ $icon }}"></i></span>
                            <div class="tx-info">
                                <b>{{ $trans->title }}</b>
                                <small>{{ $trans->created_at->format('M d · h:i A') }}</small>
                            </div>
                            <div class="tx-right">
                                <span class="tx-amt {{ $trans->type == 'credit' ? 'pos' : '' }}">
                                    {{ $trans->type == 'credit' ? '+' : '−' }}₦{{ number_format((float) $trans->amount, 2) }}
                                </span>
                                @if($trans->status == 1)
                                    <span class="pill ok">Success</span>
                                @elseif($trans->status == 2)
                                    <span class="pill pend">Pending</span>
                                @else
                                    <span class="pill fail">Failed</span>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="empty">
                            <div class="ic"><i class="fa-solid fa-receipt"></i></div>
                            <b>No transactions yet</b>
                            <small>Your purchases will show up here.</small>
                        </div>
                    @endforelse
                </div>
            </section>

            <section class="ref o-5">
                <div class="ref-top">
                    <span class="ic"><i class="fa-solid fa-gift"></i></span>
                    <h3>Refer &amp; earn</h3>
                </div>
                <p>Earn on every purchase your friends make.</p>

                <div class="ref-link">
                    <span id="refCode">{{ $referralLink }}</span>
                    <button type="button" class="copy-btn" onclick="copyRefCode(this)"><i class="fa-regular fa-copy"></i> Copy</button>
                </div>

                <div class="ref-stats">
                    <div><b>{{ number_format($referralCount) }}</b><small>Referrals</small></div>
                    <div><b>₦{{ number_format((float) ($earnings ?? 0)) }}</b><small>Earned</small></div>
                </div>

                <a href="/my-referral" class="db-link">View referral program <i class="fa-solid fa-arrow-right"></i></a>
            </section>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function copyRefCode(btn) {
        var text = document.getElementById('refCode').innerText;
        var done = function () {
            btn.classList.add('done');
            btn.innerHTML = '<i class="fa-solid fa-check"></i> Copied';
            setTimeout(function () {
                btn.classList.remove('done');
                btn.innerHTML = '<i class="fa-regular fa-copy"></i> Copy';
            }, 1600);
        };
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(text).then(done);
        } else {
            var t = document.createElement('textarea');
            t.value = text;
            document.body.appendChild(t);
            t.select();
            document.execCommand('copy');
            document.body.removeChild(t);
            done();
        }
    }

    function toggleBalance(init) {
        var card = document.getElementById('balCard');
        var btn = document.getElementById('eyeBtn');
        if (!card || !btn) return;
        var hidden = init === undefined ? !card.classList.contains('hidden') : init;
        card.classList.toggle('hidden', hidden);
        btn.innerHTML = hidden ? '<i class="fa-regular fa-eye-slash"></i>' : '<i class="fa-regular fa-eye"></i>';
        btn.setAttribute('aria-label', hidden ? 'Show balance' : 'Hide balance');
        try { localStorage.setItem('vtubiz_hide_balance', hidden ? '1' : '0'); } catch (e) {}
    }

    (function () {
        var pref = '0';
        try { pref = localStorage.getItem('vtubiz_hide_balance') || '0'; } catch (e) {}
        // Run after Vue has mounted #app so our DOM references are current.
        window.addEventListener('load', function () { toggleBalance(pref === '1'); });
    })();
</script>
@endsection
