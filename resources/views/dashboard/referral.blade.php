@extends('dashboard.master1')

@php
    $refLink = 'https://vtubiz.com/register?referral_code=' . $user->brand_name;
    $waLink = function ($phone) {
        $digits = preg_replace('/\D+/', '', (string) $phone);
        return 'https://wa.me/' . (str_starts_with($digits, '234') ? $digits : '234' . ltrim($digits, '0'));
    };
    $shareText = rawurlencode('Buy cheap data, airtime and pay bills on VTUBIZ. Sign up with my link: ' . $refLink);
@endphp

@section('header')
<style>
    .ref-link-v {
        display: flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, .08);
        border: 1px dashed rgba(255, 255, 255, .25);
        border-radius: 14px;
        padding: 6px 6px 6px 14px;
        margin: 18px 0 14px;
    }

    .ref-link-v span {
        flex: 1;
        min-width: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        font-size: .88rem;
        color: rgba(255, 255, 255, .85);
    }

    .hero-v h2 {
        font-family: 'Fraunces', serif;
        font-weight: 400;
        font-size: 1.8rem;
        color: #fff;
        margin: 8px 0 6px;
        line-height: 1.15;
    }

    .hero-v h2 em {
        color: var(--brand-orange);
    }

    .hero-v p {
        color: rgba(255, 255, 255, .7);
        font-size: .92rem;
        margin: 0;
        max-width: 420px;
    }

    .earn-card {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .earn-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }

    .earn-row div {
        background: #FAFAF8;
        border-radius: 16px;
        padding: 14px 16px;
    }

    .earn-row small {
        display: block;
        font-size: .76rem;
        color: var(--text-secondary);
        font-weight: 600;
        margin-bottom: 4px;
    }

    .earn-row b {
        font-family: 'Fraunces', serif;
        font-weight: 500;
        font-size: 1.55rem;
        color: var(--ink);
    }
</style>
@endsection

@section('content')
<div class="pg">
    <div class="pg-head">
        <div>
            <h1>Refer &amp; <em>earn</em></h1>
            <p>Invite friends and earn on every purchase they make.</p>
        </div>
    </div>

    <div class="grid-v main-side" style="margin-bottom:20px">
        <div class="hero-v">
            <div class="k">Your referral link</div>
            <h2>Earn <em>5%</em> on every purchase.</h2>
            <p>Share your link. When friends sign up and buy, you get a cut of each purchase.</p>

            <div class="ref-link-v">
                <span id="referralUrl">{{ $refLink }}</span>
                <button type="button" class="btn-v sm" style="background:#fff;color:var(--primary-dark)" id="copyBtn2"><i class="fa-regular fa-copy"></i> Copy</button>
            </div>
            <a href="https://wa.me/?text={{ $shareText }}" target="_blank" rel="noopener" class="btn-v sm" style="background:#25D366;color:#fff"><i class="fa-brands fa-whatsapp"></i> Share on WhatsApp</a>
        </div>

        <div class="panel earn-card">
            <div class="earn-row">
                <div><small>Referrals</small><b>{{ number_format(count($users)) }}</b></div>
                <div><small>Earnings</small><b>₦{{ number_format((float) $earnings) }}</b></div>
            </div>
            <a onclick="return confirm('Move your earnings to your wallet?')" href="/remitearning" class="btn-v dark block {{ (float) $earnings > 0 ? '' : 'disabled' }}"
                @if((float) $earnings <= 0) style="pointer-events:none;opacity:.45" aria-disabled="true" @endif>
                <i class="fa-solid fa-arrow-down"></i> Move to wallet
            </a>
            <div class="f-hint" style="justify-content:center;margin:0">Earnings are added to your main wallet balance.</div>
        </div>
    </div>

    <div class="panel panel-flush">
        <div class="panel-head">
            <h3>People you referred</h3>
        </div>
        @if(count($users))
            <div class="tbl-wrap" style="margin-top:16px">
                <table class="tbl stack">
                    <thead>
                        <tr>
                            <th>Friend</th>
                            <th>You earned</th>
                            <th class="end">Contact</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $ref)
                            <tr>
                                <td class="lead">
                                    <div class="cell-main">
                                        <span class="ic t-ink" style="font-family:'Fraunces',serif;font-weight:600">{{ strtoupper(substr($ref->name, 0, 1)) }}</span>
                                        <div><b>{{ $ref->name }}</b><small>{{ $ref->phone }}</small></div>
                                    </div>
                                </td>
                                <td data-label="You earned" class="num" style="color:var(--accent-green)">₦{{ number_format((float) $ref->earnings, 2) }}</td>
                                <td data-label="Contact">
                                    <div class="row-actions">
                                        <a href="{{ $waLink($ref->phone) }}" target="_blank" rel="noopener" class="btn-v success xs"><i class="fa-brands fa-whatsapp"></i> Message</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-v">
                <div class="ic"><i class="fa-solid fa-user-plus"></i></div>
                <b>No referrals yet</b>
                <span>Share your link to start earning.</span>
            </div>
        @endif
    </div>
</div>
@endsection

@section('script')
<script>
    (function () {
        var btn = document.getElementById('copyBtn2');
        btn.addEventListener('click', function () {
            var text = document.getElementById('referralUrl').innerText.trim();
            var done = function () {
                btn.innerHTML = '<i class="fa-solid fa-check"></i> Copied';
                setTimeout(function () { btn.innerHTML = '<i class="fa-regular fa-copy"></i> Copy'; }, 1600);
            };
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(done);
            } else {
                var t = document.createElement('textarea');
                t.value = text; document.body.appendChild(t); t.select();
                document.execCommand('copy'); document.body.removeChild(t); done();
            }
        });
    })();
</script>
@endsection
