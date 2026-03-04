@extends('dashboard.master1')
@section('header')
<style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Fraunces:opsz,wght@9..144,300;9..144,400;9..144,600&display=swap');

    :root {
        --bg-color: #FDFCF8; 
        --primary-dark: #0F3548; 
        --surface: #FFFFFF;
        --text-main: #1A1A1A;
        --text-secondary: #6B6B6B;
        --text-light: #9CA3AF;
        
        --accent-blue: #2F80ED;
        --accent-pink: #EB5757;
        --accent-yellow: #F2C94C;
        --accent-green: #27AE60;
        --accent-purple: #9B51E0;

        --radius-lg: 24px;
        --radius-md: 16px;
        --radius-sm: 12px;
        --radius-pill: 999px;

        --space-xs: 8px;
        --space-sm: 16px;
        --space-md: 24px;
        --space-lg: 32px;
        --space-xl: 48px;

        --shadow-card: 0 8px 24px rgba(15, 53, 72, 0.04);
        --shadow-hover: 0 12px 32px rgba(15, 53, 72, 0.08);
        --shadow-sm: 0 2px 4px rgba(0,0,0,0.02);
    }

    .dashboard-body {
        font-family: 'DM Sans', sans-serif;
        background-color: var(--bg-color);
        color: var(--text-main);
        -webkit-font-smoothing: antialiased;
        min-height: 100vh;
        padding-bottom: 50px;
    }

    .serif { font-family: 'Fraunces', serif; font-weight: 600; }
    .text-sm { font-size: 0.875rem; }
    .text-xs { font-size: 0.75rem; }
    .text-muted { color: var(--text-secondary) !important; }

    .main-content {
        padding: var(--space-lg) 0;
        position: relative;
        overflow-x: hidden;
    }

    .main-content::before {
        content: '';
        position: absolute;
        top: -100px;
        right: -100px;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(235, 87, 87, 0.03) 0%, rgba(253, 252, 248, 0) 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .dash-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: var(--space-lg);
    }

    .dash-header h1 {
        font-family: 'Fraunces', serif;
        font-size: 2.5rem;
        color: var(--primary-dark);
        font-weight: 500;
        letter-spacing: -0.5px;
        margin-bottom: 5px;
    }

    .date-badge {
        background-color: var(--surface);
        padding: 8px 16px;
        border-radius: var(--radius-pill);
        box-shadow: var(--shadow-sm);
        color: var(--text-secondary);
        font-size: 0.875rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: 1.8fr 1fr;
        gap: var(--space-lg);
    }

    .left-col, .right-col {
        display: flex;
        flex-direction: column;
        gap: var(--space-lg);
    }

    .card {
        background: var(--surface);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        box-shadow: var(--shadow-card);
        position: relative;
        overflow: hidden;
        border: none;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: var(--space-md);
        background: transparent;
        padding: 0;
        border: none;
    }

    .card-title {
        font-family: 'Fraunces', serif;
        font-size: 1.25rem;
        color: var(--primary-dark);
        margin: 0;
    }

    .wallet-card {
        background: var(--primary-dark);
        color: white;
        padding: var(--space-xl) var(--space-lg);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        background-image: 
            radial-gradient(circle at 10% 20%, rgba(47, 128, 237, 0.2) 0%, transparent 20%),
            radial-gradient(circle at 90% 80%, rgba(235, 87, 87, 0.2) 0%, transparent 20%);
    }

    .balance-label {
        opacity: 0.8;
        font-size: 0.9rem;
        margin-bottom: var(--space-xs);
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .balance-amount {
        font-family: 'Fraunces', serif;
        font-size: 3.5rem;
        font-weight: 400;
        margin-bottom: var(--space-md);
        position: relative;
        z-index: 1;
        color: white;
    }

    .oval-decoration {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(-2deg);
        width: 110%;
        height: 120%;
        border: 1px solid rgba(255,255,255,0.15);
        border-radius: 50%;
        pointer-events: none;
        z-index: 0;
    }

    .action-row {
        display: flex;
        gap: var(--space-sm);
        position: relative;
        z-index: 1;
    }

    .btn-dash {
        padding: 12px 24px;
        border-radius: var(--radius-pill);
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: transform 0.1s ease, background 0.2s;
        font-family: 'DM Sans', sans-serif;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-dash:active { transform: scale(0.98); }

    .btn-dash-primary {
        background-color: var(--surface);
        color: var(--primary-dark);
    }
    .btn-dash-primary:hover { background-color: #f8f9fa; color: var(--primary-dark); }

    .btn-dash-outline {
        background-color: transparent;
        border: 1px solid rgba(255,255,255,0.3);
        color: white;
    }
    .btn-dash-outline:hover { background-color: rgba(255,255,255,0.1); color: white; }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: var(--space-md);
    }

    .service-card {
        background: var(--surface);
        border-radius: var(--radius-md);
        padding: var(--space-md);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: var(--space-sm);
        text-decoration: none;
        color: var(--text-main);
        border: 1px solid rgba(0,0,0,0.03);
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .service-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-hover);
        border-color: rgba(0,0,0,0.06);
        color: var(--primary-dark);
    }

    .icon-circle {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
        position: relative;
    }
    
    .icon-data { background-color: rgba(47, 128, 237, 0.1); color: var(--accent-blue); }
    .icon-airtime { background-color: rgba(242, 201, 76, 0.15); color: #D4A017; } 
    .icon-cable { background-color: rgba(235, 87, 87, 0.1); color: var(--accent-pink); }
    .icon-elec { background-color: rgba(39, 174, 96, 0.1); color: var(--accent-green); }
    .icon-exam { background-color: rgba(155, 81, 224, 0.1); color: var(--accent-purple); }
    .icon-sms { background-color: rgba(15, 53, 72, 0.05); color: var(--primary-dark); }

    .service-name { font-weight: 500; font-size: 0.9rem; }

    .transaction-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 0;
        border-bottom: 1px solid rgba(0,0,0,0.04);
    }

    .transaction-item:last-child { border-bottom: none; }

    .t-left { display: flex; align-items: center; gap: 16px; }

    .t-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        background: #F8F8F8;
        color: var(--text-secondary);
    }

    .t-info h4 { font-size: 0.95rem; font-weight: 500; margin-bottom: 4px; color: var(--text-main); }
    .t-date { font-size: 0.8rem; color: var(--text-secondary); }
    .t-amount { font-weight: 600; font-feature-settings: "tnum"; font-variant-numeric: tabular-nums; }

    .amount-pos { color: var(--accent-green); }
    .amount-neg { color: var(--text-main); }

    .referral-card {
        background: linear-gradient(145deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%) !important;
        color: white;
        text-align: center;
        border: none;
    }

    .referral-icon-wrap {
        width: 52px;
        height: 52px;
        background: rgba(255,255,255,0.12);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto var(--space-sm);
    }

    .referral-code-box {
        background: rgba(255,255,255,0.1);
        border: 1px dashed rgba(255,255,255,0.3);
        border-radius: var(--radius-sm);
        padding: 10px 16px;
        margin: var(--space-sm) 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }

    .referral-code { font-family: 'Fraunces', serif; font-size: 1.15rem; letter-spacing: 3px; font-weight: 600; }

    .copy-btn {
        background: rgba(255,255,255,0.15);
        border: none;
        border-radius: 8px;
        color: white;
        padding: 6px 12px;
        font-size: 0.75rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
    }
    .copy-btn:hover { background: rgba(255,255,255,0.25); }

    .referral-stats {
        display: flex;
        justify-content: space-around;
        margin: var(--space-sm) 0;
        padding: var(--space-sm) 0;
        border-top: 1px solid rgba(255,255,255,0.1);
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .ref-stat-val { font-family: 'Fraunces', serif; font-size: 1.4rem; font-weight: 600; }
    .ref-stat-label { font-size: 0.72rem; opacity: 0.65; margin-top: 2px; }

    .btn-referral {
        background-color: var(--accent-yellow);
        color: var(--primary-dark);
        width: 100%;
        margin-top: var(--space-sm);
        font-weight: 700;
        text-decoration: none;
    }
    .btn-referral:hover { background-color: #e5bd3b; color: var(--primary-dark); }

    .upgrade-card {
        background-color: #663259;
        background-image: url(https://preview.keenthemes.com/metronic/theme/html/demo2/dist/assets/media/svg/patterns/taieri.svg);
        background-position: calc(100% + 0.5rem) 100%;
        background-size: auto 100%;
        background-repeat: no-repeat;
        color: white;
        padding: var(--space-lg);
        border-radius: var(--radius-lg);
        margin-bottom: var(--space-lg);
    }

    .upgrade-card h4 { font-family: 'Fraunces', serif; font-size: 1.5rem; margin-bottom: var(--space-sm); color: white; }

    .notification-alert {
        background: #FFF9E6;
        border: 1px dashed var(--accent-yellow);
        border-radius: var(--radius-md);
        padding: var(--space-md);
        margin-bottom: var(--space-lg);
        color: var(--primary-dark);
        font-weight: 400;
        line-height: 1.6;
    }

    @media (max-width: 991px) {
        .dashboard-grid { 
            display: flex;
            flex-direction: column;
            gap: var(--space-lg);
        }
        .left-col, .right-col {
            display: contents;
        }

        /* Mobile display order: Wallet -> Services -> Referral -> Activity */
        .wallet-card { order: 1; }
        .quick-services-container { order: 2; }
        .referral-card { order: 3; }
        .recent-activity-card { order: 4; }

        .dash-header h1 { font-size: 2rem; }
    }

    @media (max-width: 600px) {
        .services-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
@endsection

@section('content')
<div class="dashboard-body">
    <div class="app-container container-xxl">
        <main class="main-content">
            <header class="dash-header">
                <div>
                    <h1>Hello, {{ explode(' ', $user->name)[0] }}.</h1>
                    <p class="text-muted">Pay bills and top up instantly.</p>
                </div>
                <div class="date-badge">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    {{ date('F d, Y') }}
                </div>
            </header>

            @if(isset($notification2))
            <div class="notification-alert">
                {!! $notification2->description !!}
            </div>
            @endif

            @if($user->user_type == 'customer' || $user->user_type =='user')
            <div class="upgrade-card">
                <h4>Get your own VTU Website today!</h4>
                <p style="opacity: 0.9; margin-bottom: var(--space-md);">Get yourself a VTU website and sell all products like we do, all for NGN45,000.</p>
                <a onclick='return confirmUpgrade()' href="/upgrade/{{ $user->id }}" class="btn btn-success btn-sm font-weight-bold px-6 py-3">
                    Upgrade Now
                </a>
            </div>
            @endif

            <div class="dashboard-grid">
                <!-- Left Column -->
                <div class="left-col">
                    <!-- Quick Services -->
                    <div class="quick-services-container">
                        <h3 class="serif" style="margin-bottom: var(--space-md); color: var(--primary-dark);">Quick Services</h3>
                        <div class="services-grid">
                            <a href="/data" class="service-card">
                                <div class="icon-circle icon-data">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.55a11 11 0 0 1 14.08 0"></path><path d="M1.42 9a16 16 0 0 1 21.16 0"></path><path d="M8.53 16.11a6 6 0 0 1 6.95 0"></path><line x1="12" y1="20" x2="12.01" y2="20"></line></svg>
                                </div>
                                <span class="service-name">Buy Data</span>
                            </a>
                            <a href="/airtime" class="service-card">
                                <div class="icon-circle icon-airtime">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                </div>
                                <span class="service-name">Airtime</span>
                            </a>
                            <a href="/cable" class="service-card">
                                <div class="icon-circle icon-cable">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="15" rx="2" ry="2"></rect><polyline points="17 2 12 7 7 2"></polyline></svg>
                                </div>
                                <span class="service-name">Cable TV</span>
                            </a>
                            <a href="/electricity" class="service-card">
                                <div class="icon-circle icon-elec">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                                </div>
                                <span class="service-name">Electricity</span>
                            </a>
                            <a href="/examination" class="service-card">
                                <div class="icon-circle icon-exam">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2L2 7l10 5 10-5-10-5z"></path><path d="M2 17l10 5 10-5"></path><path d="M2 12l10 5 10-5"></path></svg>
                                </div>
                                <span class="service-name">Exam Pins</span>
                            </a>
                            <a href="/bulksms" class="service-card">
                                <div class="icon-circle icon-sms">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                                </div>
                                <span class="service-name">Bulk SMS</span>
                            </a>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="card recent-activity-card">
                        <div class="card-header">
                            <h3 class="card-title">Recent Activity</h3>
                            <a href="/mytransactions" class="text-sm" style="color: var(--accent-blue); text-decoration: none; font-weight: 500;">View All</a>
                        </div>
                        <div class="transactions-list">
                            @forelse($transactions as $trans)
                            <div class="transaction-item">
                                <div class="t-left">
                                    <div class="t-icon">
                                        @if(Str::contains($trans->title, 'Data'))
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12.55a11 11 0 0 1 14.08 0"></path><path d="M1.42 9a16 16 0 0 1 21.16 0"></path></svg>
                                        @elseif(Str::contains($trans->title, 'Airtime'))
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                        @else
                                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                        @endif
                                    </div>
                                    <div class="t-info">
                                        <h4>{{ $trans->title }}</h4>
                                        <span class="t-date">{{ $trans->created_at->format('M d, h:i A') }}</span>
                                    </div>
                                </div>
                                <div class="t-amount {{ $trans->type == 'credit' ? 'amount-pos' : 'amount-neg' }}">
                                    {{ $trans->type == 'credit' ? '+' : '-' }} ₦{{ number_format($trans->amount, 2) }}
                                </div>
                            </div>
                            @empty
                            <div class="text-center py-5 text-muted">No recent transactions found.</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="right-col">
                    <!-- Wallet Card -->
                    <div class="card wallet-card">
                        <div class="oval-decoration"></div>
                        <span class="balance-label">Total Balance</span>
                        <h2 class="balance-amount">₦{{ number_format($user->balance, 2) }}</h2>
                        <div class="action-row">
                            <a href="/fundwallet" class="btn-dash btn-dash-primary">Fund Wallet</a>
                            <a href="/mytransactions" class="btn-dash btn-dash-outline">History</a>
                        </div>
                    </div>

                    <!-- Referral Card -->
                    <div class="card referral-card">
                        <div class="referral-icon-wrap">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                        </div>
                        <div style="font-size:0.72rem; opacity:0.6; letter-spacing:1.5px; text-transform:uppercase; margin-bottom:4px;">Refer &amp; Earn</div>
                        <p style="font-size:0.8rem; opacity:0.7; margin-bottom: var(--space-sm);">Share your code and earn when friends on every purchase they make.</p>
                        <div class="referral-code-box">
                            <span class="referral-code" id="refCode">https://vtubiz.com/register?referral_code={{ $user->brand_name }}</span>
                            <button class="copy-btn" onclick="copyRefCode()">Copy</button>
                        </div>
                        <div class="referral-stats">
                            <div>
                                <div class="ref-stat-val">{{ \App\Models\User::where('referred_by', $user->brand_name)->count() }}</div>
                                <div class="ref-stat-label">Referrals</div>
                            </div>
                            <div style="width:1px; background:rgba(255,255,255,0.1);"></div>
                            <div>
                                <div class="ref-stat-val">₦{{ number_format($earnings ?? 0) }}</div>
                                <div class="ref-stat-label">Earned</div>
                            </div>
                        </div>
                        <a href="/my-referral" class="btn-dash btn-referral">Invite Friends</a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection

@section('script')
<script>
    function copyRefCode() {
        const code = document.getElementById('refCode').innerText;
        navigator.clipboard.writeText(code).then(() => {
            const btn = document.querySelector('.copy-btn');
            btn.textContent = 'Copied!';
            setTimeout(() => btn.textContent = 'Copy', 1500);
        });
    }

    function confirmUpgrade() {
        Swal.fire({
            title: 'Upgrade to Business Account',
            html: `
                <div style="text-align: left;">
                    <p>Business account benefits:</p>
                    <ul style="margin-bottom: 15px;">
                        <li>A VTU website</li>
                        <li>Sell all products like we do</li>
                        <li>Customizing your own data prices</li>
                        <li>Email marketing tools</li>
                    </ul>
                    <p style="color: #EB5757; font-weight: 600;">Upgrade Fee: ₦45,000</p>
                </div>
            `,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#0F3548',
            cancelButtonColor: '#EB5757',
            confirmButtonText: 'Yes, upgrade!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/upgrade/{{ $user->id }}";
            }
        });
        return false;
    }
</script>
@endsection
