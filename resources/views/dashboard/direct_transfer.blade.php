@extends('dashboard.master1')

@section('header')
<style>
    .transfer-container {
        max-width: 800px;
        margin: 20px auto;
    }
    .guideline-card {
        background: #fff;
        border-radius: var(--radius-lg);
        padding: 30px;
        box-shadow: var(--shadow-card);
        border-left: 5px solid var(--accent-orange);
        margin-bottom: 30px;
    }
    .guideline-title {
        font-family: 'Fraunces', serif;
        font-size: 1.4rem;
        color: var(--primary-dark);
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .guideline-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .guideline-list li {
        margin-bottom: 10px;
        color: var(--text-secondary);
        display: flex;
        gap: 10px;
        font-size: 0.95rem;
    }
    .guideline-list li::before {
        content: "\f058";
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        color: var(--accent-green);
    }

    .bank-card {
        background: var(--primary-dark);
        border-radius: var(--radius-lg);
        padding: 40px;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(15, 53, 72, 0.2);
    }
    .bank-card::after {
        content: "";
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(251, 145, 41, 0.1);
        border-radius: 50%;
        z-index: 1;
    }
    .bank-details {
        position: relative;
        z-index: 2;
    }
    .detail-item {
        margin-bottom: 24px;
    }
    .detail-label {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: rgba(255,255,255,0.6);
        margin-bottom: 4px;
    }
    .detail-value {
        font-family: 'Fraunces', serif;
        font-size: 1.6rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .copy-btn {
        background: rgba(255,255,255,0.1);
        border: none;
        color: white;
        padding: 5px 12px;
        border-radius: var(--radius-sm);
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.2s;
        font-family: 'DM Sans', sans-serif;
    }
    .copy-btn:hover {
        background: var(--accent-orange);
        color: var(--primary-dark);
    }

    .timer-badge {
        background: rgba(235, 87, 87, 0.1);
        color: #eb5757;
        padding: 8px 16px;
        border-radius: var(--radius-pill);
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
    }
    .amount-highlight {
        color: var(--accent-orange);
        font-size: 2rem;
    }
</style>
@endsection

@section('content')
<div class="transfer-container">
    <div class="guideline-card">
        <h3 class="guideline-title">
            <i class="fa-solid fa-circle-info"></i>
            Bank Transfer Guidelines
        </h3>
        <ul class="guideline-list">
            <li>Transfer only the exact amount stated below.</li>
            <li>This is a temporary account that expires in 
                <span class="fw-bold text-danger"><span id="min">30</span>m <span id="secs">0</span>s</span>.
            </li>
            <li>The account name must begin with <strong>VTUBIZ</strong>.</li>
        </ul>
    </div>

    <div class="bank-card">
        <div class="bank-details">
            <div class="row">
                <div class="col-md-7">
                    <div class="detail-item">
                        <div class="detail-label">Account Number</div>
                        <div class="detail-value">
                            <span id="acctNo">{{ $account_no ?? "Generating..." }}</span>
                            <button class="copy-btn" id="copyAcct">
                                <i class="fa-regular fa-copy me-1"></i> Copy
                            </button>
                        </div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">Bank Name</div>
                        <div class="detail-value">{{ $bank_name ?? "Generating..." }}</div>
                    </div>
                </div>
                
                <div class="col-md-5 text-md-end">
                    <div class="detail-item">
                        <div class="detail-label">Amount to Pay</div>
                        <div class="detail-value justify-content-md-end amount-highlight">
                            ₦{{ number_format($amount) }}
                        </div>
                        <div class="text-white-50 small mt-1">Please transfer the exact amount</div>
                    </div>

                    <div class="timer-badge mt-3">
                        <i class="fa-solid fa-clock"></i>
                        Expires in <span id="min2">30</span>:<span id="secs2">00</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="expire" value="30"/>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        @if (session('message'))
            Swal.fire('Success!', "{{ session('message') }}", 'success');
        @endif

        $('#copyAcct').click(function() {
            var tempTextarea = $('<textarea>');
            tempTextarea.val($('#acctNo').text());
            $('body').append(tempTextarea);
            tempTextarea.select();
            document.execCommand('copy');
            tempTextarea.remove();

            $(this).html('<i class="fa-solid fa-check me-1"></i> Copied').addClass('bg-success');
            setTimeout(() => {
                $(this).html('<i class="fa-regular fa-copy me-1"></i> Copy').removeClass('bg-success');
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