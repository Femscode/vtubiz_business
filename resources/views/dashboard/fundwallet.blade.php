@extends('dashboard.master1')

@php
    $recentDeposits = \App\Models\Transaction::where('user_id', $user->id)
        ->where('type', 'credit')
        ->latest()
        ->take(4)
        ->get();
    $naira = "font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,sans-serif";
@endphp

@section('header')
<style>
    /* ---------- Amount entry ---------- */
    .amt-entry {
        display: block;
        width: 100%;
        margin: 0;
        background: #FAFAF8;
        border: 1.5px solid rgba(11, 22, 37, .08);
        border-radius: 22px;
        padding: 22px 22px 18px;
        transition: border-color .2s, background .2s, box-shadow .2s;
        cursor: text;
    }

    .amt-entry:focus-within {
        background: #fff;
        border-color: var(--primary-dark);
        box-shadow: 0 0 0 5px rgba(0, 31, 63, .06);
    }

    .amt-entry .lbl {
        font-size: .76rem;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: var(--text-light);
    }

    .amt-row {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-top: 6px;
    }

    .amt-row .cur {
        font-size: 2.2rem;
        font-weight: 600;
        color: var(--text-light);
        line-height: 1;
        transition: color .2s;
    }

    .amt-entry:focus-within .cur,
    .amt-entry.has-value .cur {
        color: var(--ink);
    }

    #app .amt-row input {
        flex: 1;
        min-width: 0;
        border: 0 !important;
        background: transparent !important;
        outline: none !important;
        box-shadow: none !important;
        padding: 0 !important;
        font-family: 'Fraunces', serif !important;
        font-size: 2.8rem !important;
        font-weight: 400;
        letter-spacing: -.02em;
        color: var(--ink);
        line-height: 1.1;
        font-variant-numeric: tabular-nums;
        -moz-appearance: textfield;
    }

    #app .amt-row input::placeholder {
        color: #C9CCD3;
    }

    .amt-row input::-webkit-outer-spin-button,
    .amt-row input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .quick {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 8px;
        margin-top: 14px;
    }

    .quick .chip-v {
        padding: 9px 4px;
        text-align: center;
        font-variant-numeric: tabular-nums;
    }

    .quick .chip-v.on {
        background: var(--primary-dark);
        border-color: var(--primary-dark);
        color: #fff;
    }

    /* ---------- Method tiles ---------- */
    .methods {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .method {
        position: relative;
        display: flex;
        flex-direction: column;
        gap: 12px;
        padding: 16px;
        border: 1.5px solid var(--line);
        border-radius: 18px;
        cursor: pointer;
        transition: border-color .15s, box-shadow .15s, background .15s;
        background: #fff;
    }

    .method:hover {
        border-color: rgba(0, 31, 63, .25);
    }

    .method input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .method .ic {
        width: 42px;
        height: 42px;
        border-radius: 13px;
        display: grid;
        place-items: center;
        font-size: 1rem;
    }

    .method b {
        display: block;
        font-size: .95rem;
        color: var(--ink);
    }

    .method small {
        color: var(--text-secondary);
        font-size: .8rem;
        line-height: 1.4;
    }

    .method .tick {
        position: absolute;
        top: 14px;
        right: 14px;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        border: 1.5px solid var(--line);
        display: grid;
        place-items: center;
        font-size: .65rem;
        color: transparent;
        transition: all .15s;
    }

    .method:has(input:checked) {
        border-color: var(--primary-dark);
        background: #FBFAF7;
        box-shadow: 0 0 0 4px rgba(0, 31, 63, .06);
    }

    .method:has(input:checked) .tick {
        background: var(--primary-dark);
        border-color: var(--primary-dark);
        color: #fff;
    }

    /* ---------- Summary ---------- */
    .sum {
        border-top: 1px dashed var(--line);
        margin-top: 20px;
        padding-top: 16px;
    }

    .sum .kv {
        padding: 6px 0;
        border: 0;
        font-size: .9rem;
    }

    .sum .kv.total span:last-child {
        font-family: 'Fraunces', serif;
        font-weight: 500;
        font-size: 1.25rem;
    }

    /* ---------- Bank card ---------- */
    .bank-card {
        position: relative;
        overflow: hidden;
        border-radius: 24px;
        padding: 24px;
        color: #fff;
        aspect-ratio: 1.6 / 1;
        min-height: 220px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        background:
            radial-gradient(120% 90% at 100% 100%, rgba(251, 145, 41, .55) 0%, rgba(251, 145, 41, 0) 55%),
            radial-gradient(90% 70% at 0% 0%, rgba(47, 128, 237, .25) 0%, rgba(47, 128, 237, 0) 60%),
            linear-gradient(150deg, #062b52 0%, var(--primary-dark) 50%, #00142a 100%);
        box-shadow: 0 30px 60px -28px rgba(0, 31, 63, .75);
        isolation: isolate;
    }

    .bank-card::after {
        content: "";
        position: absolute;
        width: 420px;
        height: 420px;
        right: -180px;
        top: -200px;
        border-radius: 50%;
        border: 1px solid rgba(255, 255, 255, .08);
        box-shadow: 0 0 0 50px rgba(255, 255, 255, .02), 0 0 0 51px rgba(255, 255, 255, .06);
        z-index: -1;
    }

    .bc-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .bc-chip {
        width: 42px;
        height: 32px;
        border-radius: 7px;
        background: linear-gradient(135deg, #f8d58a, #c9973d);
        position: relative;
        overflow: hidden;
    }

    .bc-chip::before,
    .bc-chip::after {
        content: "";
        position: absolute;
        background: rgba(0, 0, 0, .18);
    }

    .bc-chip::before {
        left: 0;
        right: 0;
        top: 50%;
        height: 1px;
    }

    .bc-chip::after {
        top: 0;
        bottom: 0;
        left: 50%;
        width: 1px;
    }

    .bc-bank {
        font-weight: 700;
        font-size: .9rem;
        letter-spacing: .02em;
        text-align: right;
        max-width: 60%;
        line-height: 1.25;
    }

    .bc-label {
        font-size: .7rem;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, .6);
        font-weight: 600;
    }

    .bc-number {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-top: 4px;
    }

    .bc-number span {
        font-family: 'Fraunces', serif;
        font-size: clamp(1.6rem, 4.4vw, 2.1rem);
        letter-spacing: .08em;
        font-variant-numeric: tabular-nums;
        white-space: nowrap;
    }

    .bc-copy {
        border: 0;
        background: rgba(255, 255, 255, .14);
        color: #fff;
        border-radius: 999px;
        padding: 7px 12px;
        font-size: .76rem;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        gap: 6px;
        align-items: center;
        flex-shrink: 0;
        backdrop-filter: blur(6px);
    }

    .bc-copy:hover {
        background: rgba(255, 255, 255, .24);
    }

    .bc-name {
        font-weight: 600;
        font-size: .95rem;
        text-transform: uppercase;
        letter-spacing: .03em;
        word-break: break-word;
    }

    .perks {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 8px;
        margin-top: 14px;
    }

    .perks div {
        background: var(--surface);
        border: 1px solid var(--line);
        border-radius: 14px;
        padding: 10px;
        text-align: center;
        font-size: .76rem;
        font-weight: 600;
        color: #374151;
    }

    .perks i {
        display: block;
        font-size: .95rem;
        margin-bottom: 5px;
        color: var(--accent-green);
    }

    /* Generate-account empty card */
    .gen-card {
        border: 1.5px dashed rgba(0, 31, 63, .2);
        border-radius: 24px;
        padding: 26px;
        text-align: center;
        background:
            radial-gradient(80% 60% at 50% 0%, rgba(251, 145, 41, .08), transparent 70%),
            var(--surface);
    }

    .gen-card .ic {
        width: 58px;
        height: 58px;
        border-radius: 18px;
        margin: 0 auto 14px;
        display: grid;
        place-items: center;
        font-size: 1.3rem;
    }

    .gen-card h3 {
        font-family: 'Fraunces', serif;
        font-weight: 500;
        font-size: 1.25rem;
        margin: 0 0 6px;
    }

    .gen-card p {
        color: var(--text-secondary);
        font-size: .9rem;
        margin: 0 auto 18px;
        max-width: 320px;
    }

    .gen-card form {
        text-align: left;
        margin-top: 4px;
    }

    /* Recent deposits */
    .dep .item {
        padding: 12px 0;
    }

    .dep .ic {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        display: grid;
        place-items: center;
        flex-shrink: 0;
        font-size: .85rem;
    }

    .dep b {
        display: block;
        font-weight: 600;
        font-size: .88rem;
    }

    .dep small {
        color: var(--text-secondary);
        font-size: .76rem;
    }

    .dep .amt {
        margin-left: auto;
        text-align: right;
        font-weight: 700;
        font-size: .9rem;
        color: var(--accent-green);
        white-space: nowrap;
        font-variant-numeric: tabular-nums;
    }

    .side-stack {
        display: flex;
        flex-direction: column;
        gap: 20px;
        min-width: 0;
    }

    @media (max-width: 600px) {
        .amt-entry {
            padding: 18px 16px 14px;
        }

        #app .amt-row input {
            font-size: 2.3rem !important;
        }

        .amt-row .cur {
            font-size: 1.8rem;
        }

        .quick {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .quick .chip-v:nth-child(n+4) {
            display: none;
        }

        .methods {
            grid-template-columns: 1fr;
        }

        .method {
            flex-direction: row;
            align-items: center;
            padding: 14px;
        }

        .method .tick {
            top: 50%;
            transform: translateY(-50%);
        }

        .bank-card {
            aspect-ratio: auto;
            min-height: 200px;
            padding: 20px;
        }
    }
</style>
@endsection

@section('content')
<div class="pg">
    <div class="pg-head">
        <div>
            <h1>Add <em>money</em></h1>
            <p>Top up your wallet in seconds.</p>
        </div>
    </div>

    <div class="grid-v main-side">
        <!-- ===== Pay online ===== -->
        <div class="panel">
            <form method="POST" action="{{ route('checkout', ['subdomain']) }}" id="fundForm">
                @csrf

                <label class="amt-entry" id="amtEntry" for="u_amount">
                    <span class="lbl">Amount</span>
                    <span class="amt-row">
                        <span class="cur" style="{{ $naira }}">₦</span>
                        <input required name="amount" type="number" min="100" step="1" inputmode="numeric" id="u_amount" placeholder="0" autocomplete="off">
                    </span>
                </label>

                <div class="quick">
                    @foreach([1000, 2000, 5000, 10000, 20000] as $amt)
                        <button type="button" class="chip-v" data-amount="{{ $amt }}"><span style="{{ $naira }}">₦</span>{{ number_format($amt) }}</button>
                    @endforeach
                </div>

                <div class="f-label" style="margin:24px 0 10px">Pay with</div>
                <div class="methods">
                    <label class="method" for="transferOption">
                        <input required type="radio" name="type" value="transfer" id="transferOption" checked>
                        <span class="ic t-blue"><i class="fa-solid fa-building-columns"></i></span>
                        <span><b>Bank transfer</b><small>Get a one-time account to pay into</small></span>
                        <span class="tick"><i class="fa-solid fa-check"></i></span>
                    </label>
                    <label class="method" for="cardOption">
                        <input required type="radio" name="type" value="card" id="cardOption">
                        <span class="ic t-purple"><i class="fa-regular fa-credit-card"></i></span>
                        <span><b>Card or USSD</b><small>Pay securely with Paystack</small></span>
                        <span class="tick"><i class="fa-solid fa-check"></i></span>
                    </label>
                </div>

                <div class="sum">
                    <div class="kv"><span>Amount</span><span id="sumAmount">—</span></div>
                    <div class="kv"><span>Estimated charge</span><span id="show_charge">—</span></div>
                    <div class="kv"><span>Method</span><span id="sumMethod">Bank transfer</span></div>
                </div>

                <button type="submit" class="btn-v dark block" id="fundBtn" style="margin-top:16px" disabled>
                    Continue <i class="fa-solid fa-arrow-right"></i>
                </button>
                <div class="f-hint" style="justify-content:center;margin-top:12px">
                    <i class="fa-solid fa-lock"></i> Payments are encrypted and processed securely.
                </div>
            </form>
        </div>

        <!-- ===== Personal account + recent ===== -->
        <div class="side-stack">
            @if($user->account_no)
                <div>
                    <div class="bank-card">
                        <div class="bc-top">
                            <span class="bc-chip"></span>
                            <span class="bc-bank">{{ $user->bank_name }}</span>
                        </div>
                        <div>
                            <div class="bc-label">Account number</div>
                            <div class="bc-number">
                                <span id="accNo">{{ $user->account_no }}</span>
                                <button type="button" class="bc-copy" onclick="copyToClipboard('accNo', this)"><i class="fa-regular fa-copy"></i> Copy</button>
                            </div>
                        </div>
                        <div>
                            <div class="bc-label">Account name</div>
                            <div class="bc-name">{{ $user->account_name }}</div>
                        </div>
                    </div>
                    <div class="perks">
                        <div><i class="fa-solid fa-circle-check"></i>Instant credit</div>
                        <div><i class="fa-solid fa-coins"></i>Low charges</div>
                        <div><i class="fa-regular fa-clock"></i>24/7</div>
                    </div>
                    <p class="f-hint" style="justify-content:center;margin-top:12px;text-align:center">
                        Transfer from any bank app. Your wallet is credited automatically.
                    </p>
                </div>
            @else
                <div class="gen-card">
                    <div class="ic t-blue"><i class="fa-solid fa-building-columns"></i></div>
                    <h3>Get your own account number</h3>
                    <p>A permanent account just for your wallet. Transfer anytime and get credited automatically.</p>

                    <button type="button" class="btn-v orange block" id="showBvn"><i class="fa-solid fa-plus"></i> Generate account</button>

                    <div id="bvnfield" style="display:none">
                        <form method="POST" action="/generatePermanentAccount">
                            @csrf
                            <div class="f-group">
                                <label class="f-label" for="bvn">BVN</label>
                                <input type="text" inputmode="numeric" pattern="[0-9]{11}" maxlength="11" id="bvn" name="bvn" class="f-input" placeholder="11-digit BVN" required>
                                <div class="f-hint"><i class="fa-solid fa-shield-halved"></i> Used only to verify your identity.</div>
                            </div>
                            <button type="submit" class="btn-v dark block">Verify &amp; generate</button>
                        </form>
                    </div>
                </div>
            @endif

            <div class="panel dep">
                <div class="panel-head" style="margin-bottom:4px">
                    <h3>Recent deposits</h3>
                    <a href="/mytransactions" class="btn-v light xs">See all</a>
                </div>
                @if($recentDeposits->isEmpty())
                    <div class="empty-v" style="padding:24px 8px 8px">
                        <div class="ic"><i class="fa-solid fa-arrow-down"></i></div>
                        <span>Your deposits will show here.</span>
                    </div>
                @else
                    <div class="list-v">
                        @foreach($recentDeposits as $dep)
                            <div class="item">
                                <span class="ic t-green"><i class="fa-solid fa-arrow-down"></i></span>
                                <div style="min-width:0">
                                    <b>{{ $dep->title }}</b>
                                    <small>{{ $dep->created_at->format('M d · h:i A') }}</small>
                                </div>
                                <div class="amt">
                                    +<span style="{{ $naira }}">₦</span>{{ number_format((float) $dep->amount, 2) }}
                                    <div>
                                        @if($dep->status == 1)
                                            <span class="badge-v ok" style="font-size:.66rem;padding:2px 8px">Success</span>
                                        @elseif($dep->status == 2)
                                            <span class="badge-v pend" style="font-size:.66rem;padding:2px 8px">Pending</span>
                                        @else
                                            <span class="badge-v fail" style="font-size:.66rem;padding:2px 8px">Failed</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function copyToClipboard(elementId, btn) {
        var text = document.getElementById(elementId).innerText.trim();
        var done = function () {
            if (btn) {
                var old = btn.innerHTML;
                btn.innerHTML = '<i class="fa-solid fa-check"></i> Copied';
                setTimeout(function () { btn.innerHTML = old; }, 1500);
            }
        };
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(text).then(done);
        } else {
            var t = document.createElement('textarea');
            t.value = text; document.body.appendChild(t); t.select();
            document.execCommand('copy'); document.body.removeChild(t); done();
        }
    }

    (function () {
        var amount = document.getElementById('u_amount');
        var entry = document.getElementById('amtEntry');
        var charge = document.getElementById('show_charge');
        var sumAmount = document.getElementById('sumAmount');
        var sumMethod = document.getElementById('sumMethod');
        var btn = document.getElementById('fundBtn');
        var chips = document.querySelectorAll('[data-amount]');
        var naira = '<span style="font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,sans-serif">₦</span>';

        function fmt(n) {
            return n.toLocaleString('en-NG', { maximumFractionDigits: 2 });
        }

        function update() {
            var price = parseFloat(amount.value) || 0;
            entry.classList.toggle('has-value', price > 0);
            chips.forEach(function (c) {
                c.classList.toggle('on', parseFloat(c.getAttribute('data-amount')) === price);
            });

            if (price > 0) {
                var c = price <= 1000 ? 25 : (price < 5000 ? 50 : 100);
                sumAmount.innerHTML = naira + fmt(price);
                charge.innerHTML = naira + c;
            } else {
                sumAmount.textContent = '—';
                charge.textContent = '—';
            }

            var method = document.querySelector('input[name="type"]:checked');
            sumMethod.textContent = method && method.value === 'card' ? 'Card or USSD' : 'Bank transfer';
            btn.disabled = !(price >= 100 && method);
            btn.innerHTML = price >= 100
                ? '<span>Add ' + naira + fmt(price) + '</span> <i class="fa-solid fa-arrow-right"></i>'
                : (price > 0 ? '<span>Minimum is ' + naira + '100</span>' : 'Continue <i class="fa-solid fa-arrow-right"></i>');
        }

        amount.addEventListener('input', update);
        document.querySelectorAll('input[name="type"]').forEach(function (r) {
            r.addEventListener('change', update);
        });
        chips.forEach(function (chip) {
            chip.addEventListener('click', function () {
                amount.value = chip.getAttribute('data-amount');
                update();
                amount.focus();
            });
        });

        var show = document.getElementById('showBvn');
        if (show) {
            show.addEventListener('click', function () {
                show.style.display = 'none';
                document.getElementById('bvnfield').style.display = 'block';
                document.getElementById('bvn').focus();
            });
        }

        update();
    })();
</script>
@endsection
