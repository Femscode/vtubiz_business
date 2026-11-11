@extends('dashboard.master1')

@section('header')
<style>
    .pay-amount {
        text-align: center;
        padding: 6px 0 22px;
        border-bottom: 1px solid rgba(255, 255, 255, .1);
        margin-bottom: 20px;
    }

    .pay-amount .v {
        font-size: 2.6rem !important;
        margin-top: 4px;
    }

    .acct-line {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 12px;
        padding: 10px 0;
    }

    .acct-line .v {
        font-size: 1.15rem !important;
    }

    .acct-big {
        font-size: 1.9rem !important;
        letter-spacing: .05em;
        font-variant-numeric: tabular-nums;
    }

    #copyAcct {
        border: 0;
        background: #fff;
        color: var(--primary-dark);
        border-radius: 10px;
        padding: 8px 14px;
        font-weight: 600;
        font-size: .82rem;
        cursor: pointer;
        display: inline-flex;
        gap: 6px;
        align-items: center;
        flex-shrink: 0;
    }

    .timer-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(251, 145, 41, .15);
        color: #FFC27D;
        border-radius: 999px;
        padding: 7px 14px;
        font-weight: 700;
        font-size: .85rem;
        font-variant-numeric: tabular-nums;
    }

    .guide li {
        display: flex;
        gap: 10px;
        padding: 10px 0;
        border-bottom: 1px solid var(--line);
        font-size: .9rem;
        color: #374151;
    }

    .guide li:last-child {
        border-bottom: 0;
    }

    .guide li i {
        color: var(--brand-orange-2);
        margin-top: 4px;
    }
</style>
@endsection

@section('content')
<div class="pg pg-narrow" style="max-width:860px">
    <a href="/fundwallet" class="pg-back"><i class="fa-solid fa-arrow-left"></i> Fund wallet</a>
    <div class="pg-head">
        <div>
            <h1>Complete your <em>transfer</em></h1>
            <p>Send the exact amount to the account below.</p>
        </div>
    </div>

    <div class="grid-v main-side">
        <div class="hero-v">
            <div class="pay-amount">
                <div class="k">Amount to send</div>
                <div class="v">₦{{ number_format((float) $amount) }}</div>
                <div class="timer-pill" style="margin-top:12px"><i class="fa-regular fa-clock"></i> Expires in <span id="min2">30</span>:<span id="secs2">00</span></div>
            </div>

            <div class="k">Account number</div>
            <div class="acct-line" style="padding-top:4px">
                <span class="v acct-big" id="acctNo">{{ $account_no ?? 'Generating...' }}</span>
                <button type="button" id="copyAcct"><i class="fa-regular fa-copy"></i> Copy</button>
            </div>
            <div class="acct-line">
                <span class="k">Bank</span>
                <span class="v">{{ $bank_name ?? 'Generating...' }}</span>
            </div>
        </div>

        <div class="panel">
            <div class="panel-head" style="margin-bottom:6px"><h3>Before you send</h3></div>
            <ul class="guide" style="list-style:none;margin:0;padding:0">
                <li><i class="fa-solid fa-circle-check"></i><span>Send <b>exactly</b> ₦{{ number_format((float) $amount) }}.</span></li>
                <li><i class="fa-solid fa-circle-check"></i><span>The account name starts with <b>VTUBIZ</b>.</span></li>
                <li><i class="fa-solid fa-circle-check"></i><span>This account expires in <b><span id="min">30</span>m <span id="secs">0</span>s</b>.</span></li>
            </ul>
            <a href="/dashboard" class="btn-v light block" style="margin-top:16px">I've sent it · go to dashboard</a>
        </div>
    </div>
    <input type="hidden" id="expire" value="30" />
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {

        $('#copyAcct').click(function() {
            var tempTextarea = $('<textarea>');
            tempTextarea.val($('#acctNo').text());
            $('body').append(tempTextarea);
            tempTextarea.select();
            document.execCommand('copy');
            tempTextarea.remove();

            $(this).html('<i class="fa-solid fa-check"></i> Copied');
            setTimeout(() => {
                $(this).html('<i class="fa-regular fa-copy"></i> Copy');
            }, 2000);
        });

        var minutes = $("#expire").val();
        var seconds = 0;

        var countdownInterval = setInterval(function () {
            seconds--;
            if (seconds < 0) {
                seconds = 59;
                minutes--;
                if (minutes < 0) {
                    clearInterval(countdownInterval);
                    return;
                }
                $('#min').text(minutes);
                $('#min2').text(minutes);
            }
            $('#secs').text(seconds);
            $('#secs2').text(seconds < 10 ? '0' + seconds : seconds);
        }, 1000);
    });
</script>
@endsection