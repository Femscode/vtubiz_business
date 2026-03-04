@extends('dashboard.master1')

@section('header')
<style>
    .fund-header {
        margin-bottom: var(--space-lg);
    }
    .fund-header h1 {
        font-family: 'Fraunces', serif;
        font-size: 2.2rem;
        color: var(--primary-dark);
        margin-bottom: 8px;
    }
    .fund-grid {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: var(--space-lg);
    }
    .fund-card {
        background: var(--surface);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        box-shadow: var(--shadow-card);
        height: 100%;
    }
    .method-title {
        font-family: 'Fraunces', serif;
        font-size: 1.25rem;
        color: var(--primary-dark);
        margin-bottom: var(--space-md);
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .form-control-custom {
        width: 100%;
        padding: 14px 18px;
        border-radius: var(--radius-md);
        border: 1px solid rgba(0,0,0,0.08);
        background: #F9F9F9;
        font-family: 'DM Sans', sans-serif;
        font-size: 1.1rem;
        transition: all 0.2s ease;
        margin-bottom: 15px;
    }
    .form-control-custom:focus {
        outline: none;
        border-color: var(--primary-dark);
        background: white;
        box-shadow: 0 0 0 4px rgba(15, 53, 72, 0.05);
    }
    .payment-option {
        border: 1px solid rgba(0,0,0,0.05);
        border-radius: var(--radius-md);
        padding: 15px;
        margin-bottom: 12px;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        gap: 15px;
        background: #FDFCF8;
    }
    .payment-option:hover {
        border-color: var(--accent-blue);
        background: white;
    }
    .payment-option input[type="radio"] {
        width: 20px;
        height: 20px;
        accent-color: var(--primary-dark);
    }
    .option-info h5 {
        margin: 0;
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--primary-dark);
    }
    .option-info p {
        margin: 0;
        font-size: 0.8rem;
        color: var(--text-secondary);
    }
    .btn-fund {
        background: var(--primary-dark);
        color: white;
        border: none;
        padding: 16px;
        border-radius: var(--radius-pill);
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.1s ease;
        width: 100%;
        margin-top: 10px;
        font-size: 1rem;
    }
    .btn-fund:active { transform: scale(0.98); }

    .virtual-account-card {
        background: var(--primary-dark);
        color: white;
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        position: relative;
        overflow: hidden;
        margin-bottom: var(--space-md);
    }
    .virtual-account-card::after {
        content: '';
        position: absolute;
        top: -20%;
        right: -10%;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 70%);
        border-radius: 50%;
    }
    .account-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        opacity: 0.7;
        margin-bottom: 4px;
    }
    .account-value {
        font-family: 'Fraunces', serif;
        font-size: 1.4rem;
        margin-bottom: 15px;
    }
    .copy-icon {
        cursor: pointer;
        margin-left: 8px;
        font-size: 0.9rem;
        opacity: 0.8;
    }
    .copy-icon:hover { opacity: 1; }

    .benefit-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255,255,255,0.1);
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.7rem;
        margin-right: 8px;
        margin-bottom: 8px;
    }

    .generate-alert {
        background: #FFF9E6;
        border: 1px dashed var(--accent-yellow);
        border-radius: var(--radius-md);
        padding: var(--space-md);
        color: var(--primary-dark);
    }

    @media (max-width: 991px) {
        .fund-grid { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
<div class="fund-header">
    <h1>Fund Your Wallet</h1>
    <p class="text-muted">Choose a preferred method to add money to your account.</p>
</div>

<div class="fund-grid">
    <!-- Left Col: Online Payment -->
    <div class="left-col">
        <div class="fund-card">
            <div class="method-title">
                Instant Funding
            </div>
            
            <form method="POST" action="{{ route('checkout', ['subdomain']) }}">
                @csrf
                <label class="form-label">Enter Amount (₦)</label>
                <input required name="amount" type="number" min="100" id="u_amount" class="form-control-custom" placeholder="Min. ₦100">
                <div id="show_charge" style="font-size: 0.85rem; color: var(--accent-pink); margin-top: -10px; margin-bottom: 20px; font-weight: 500;"></div>

                <label class="form-label">Select Payment Method</label>
                
                <label class="payment-option" for="transferOption">
                    <input required type="radio" name="type" value="transfer" id="transferOption">
                    <div class="option-info">
                        <h5>Automatic Bank Transfer</h5>
                        <p>Pay to a unique dynamic account number</p>
                    </div>
                </label>

                <label class="payment-option" for="cardOption">
                    <input required type="radio" name="type" value="card" id="cardOption">
                    <div class="option-info">
                        <h5>Pay With Card / USSD</h5>
                        <p>Instant funding via Paystack</p>
                    </div>
                </label>

                <button type="submit" class="btn-fund">Continue to Payment</button>
            </form>
        </div>
    </div>

    <!-- Right Col: Virtual Account -->
    <div class="right-col">
        <div class="fund-card">
            <div class="method-title">
                <i class="fa-solid fa-university" style="color: var(--accent-blue);"></i>
                Bank Transfer
            </div>

            @if($user->account_no)
                <div class="virtual-account-card">
                    <div class="row">
                        <div class="col-12">
                            <div class="account-label">Bank Name</div>
                            <div class="account-value">{{ $user->bank_name }}</div>
                        </div>
                        <div class="col-12">
                            <div class="account-label">Account Number</div>
                            <div class="account-value">
                                <span id="accNo">{{ $user->account_no }}</span>
                                <i class="fa-regular fa-copy copy-icon" onclick="copyToClipboard('accNo')"></i>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="account-label">Account Name</div>
                            <div class="account-value">{{ $user->account_name }}</div>
                        </div>
                    </div>
                    
                    <div style="margin-top: 10px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 15px;">
                        <div class="benefit-tag"><i class="fa-solid fa-check"></i> Instant Credit</div>
                        <div class="benefit-tag"><i class="fa-solid fa-check"></i> Low Charges</div>
                        <div class="benefit-tag"><i class="fa-solid fa-check"></i> 24/7 Available</div>
                    </div>
                </div>
                <p class="text-xs text-muted" style="text-align: center;">Funds transferred to this account will reflect in your wallet instantly.</p>
            @else
                <div class="generate-alert">
                    <h5 class="serif" style="margin-bottom: 10px;">Get a Personal Virtual Account</h5>
                    <p class="text-sm" style="margin-bottom: 15px; opacity: 0.8;">Generate a permanent bank account dedicated to your wallet for faster and easier funding.</p>
                    
                    <button class="btn-fund" id="showBvn" style="background: var(--accent-yellow); color: var(--primary-dark);">Generate Account Now</button>
                    
                    <div id="bvnfield" style="display: none; margin-top: 20px;">
                        <form method="POST" action="/generatePermanentAccount">
                            @csrf
                            <label class="form-label">Enter BVN</label>
                            <input type="number" name="bvn" class="form-control-custom" placeholder="Your 11-digit BVN" required>
                            <p class="text-xs text-muted mb-3"><i class="fa-solid fa-shield-halved"></i> Your BVN is only used for identity verification.</p>
                            <button type="submit" class="btn-fund">Verify & Generate</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function copyToClipboard(elementId) {
        const text = document.getElementById(elementId).innerText;
        navigator.clipboard.writeText(text).then(() => {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Copied to clipboard',
                showConfirmButton: false,
                timer: 1500
            });
        });
    }

    $(document).ready(function() {
        @if (session('message'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('message') }}",
                confirmButtonColor: '#0F3548'
            });
        @endif

        $("#showBvn").on('click', function() {
            $(this).fadeOut(200, function() {
                $("#bvnfield").slideDown();
            });
        });

        $("#u_amount").on('input', function() {
            let price = $(this).val();
            let charges = 0;

            if (price > 0) {
                if (price <= 1000) {
                    charges = 25;
                } else if (price < 5000) {
                    charges = 50;
                } else {
                    charges = 100;
                }
                $("#show_charge").html('<i class="fa-solid fa-circle-info"></i> Estimated Charge: ₦' + charges);
            } else {
                $("#show_charge").text("");
            }
        });
    });
</script>
@endsection
