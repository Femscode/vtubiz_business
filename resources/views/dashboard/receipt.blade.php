@php
    $brand = $user->brand ?? null;
    $brandName = $brand->brand_name ?? $brand->name ?? 'VTUBIZ';
    $brandLogo = ($brand && !empty($brand->brand_logo)) ? asset($brand->brand_logo) : asset('assets/img/logo/vtulogo.png');
    $status = (int) ($transaction->status ?? 0);
    $statusText = $status === 1 ? 'Successful' : ($status === 2 ? 'Processing' : 'Failed');
    $statusClass = $status === 1 ? 'status-success' : ($status === 2 ? 'status-pending' : 'status-failed');
    $statusIcon = $status === 1 ? 'fa-circle-check' : ($status === 2 ? 'fa-clock' : 'fa-circle-xmark');
    $amountFormatted = number_format((float) ($transaction->amount ?? 0), 2);
    $createdDate = !empty($transaction->created_at) ? date('d M Y, h:i A', strtotime($transaction->created_at)) : 'N/A';
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <title>{{ $brandName }} | Receipt - {{ $transaction->reference ?? 'TX' }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/fav_01.png') }}" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,600;9..40,700&family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <style>
        :root {
            --bg-page: #F4F3EE;
            --bg-card: #FFFFFF;
            --ink: #0F172A;
            --ink-muted: #64748B;
            --ink-light: #94A3B8;
            --brand-primary: #001F3F;
            --brand-accent: #FB9129;
            --border: rgba(15, 23, 42, 0.08);
            --border-light: rgba(15, 23, 42, 0.04);
            --shadow-card: 0 20px 45px -15px rgba(15, 23, 42, 0.08), 0 4px 12px -2px rgba(15, 23, 42, 0.03);

            --emerald-bg: #ECFDF5;
            --emerald-text: #047857;
            --emerald-border: #A7F3D0;

            --rose-bg: #FFF1F2;
            --rose-text: #BE123C;
            --rose-border: #FECDD3;

            --amber-bg: #FFFBEB;
            --amber-text: #B45309;
            --amber-border: #FDE68A;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }

        body {
            background-color: var(--bg-page);
            font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            color: var(--ink);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding: 24px 16px 48px;
        }

        /* Top Action Bar */
        .actions-bar {
            max-width: 520px;
            margin: 0 auto 20px;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--ink);
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            padding: 9px 15px;
            background: #FFFFFF;
            border: 1px solid var(--border);
            border-radius: 999px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
            transition: all 0.18s ease;
        }

        .back-link:hover {
            background: #F8FAFC;
            border-color: rgba(15, 23, 42, 0.16);
            transform: translateY(-1px);
        }

        .action-buttons {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-act {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: 999px;
            padding: 9px 15px;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.18s ease;
            text-decoration: none;
        }

        .btn-act.secondary {
            background: #FFFFFF;
            color: var(--ink);
            border-color: var(--border);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
        }

        .btn-act.secondary:hover {
            background: #F8FAFC;
            border-color: rgba(15, 23, 42, 0.16);
            transform: translateY(-1px);
        }

        .btn-act.primary {
            background: var(--brand-primary);
            color: #FFFFFF;
            box-shadow: 0 4px 12px rgba(0, 31, 63, 0.18);
        }

        .btn-act.primary:hover {
            opacity: 0.93;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(0, 31, 63, 0.24);
        }

        /* The Main Receipt Card */
        .receipt-card {
            background: var(--bg-card);
            max-width: 520px;
            width: 100%;
            margin: 0 auto;
            border-radius: 28px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow-card);
            position: relative;
            overflow: hidden;
        }

        /* Top Header */
        .receipt-header {
            padding: 34px 32px 20px;
            text-align: center;
        }

        .brand-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
        }

        .brand-logo {
            max-height: 44px;
            max-width: 180px;
            object-fit: contain;
        }

        .receipt-title {
            font-size: 0.76rem;
            font-weight: 700;
            letter-spacing: 0.18em;
            text-transform: uppercase;
            color: var(--ink-muted);
            margin-bottom: 6px;
        }

        .receipt-date-sub {
            font-size: 0.84rem;
            color: var(--ink-light);
        }

        /* Amount & Status Section */
        .amount-section {
            padding: 10px 32px 26px;
            text-align: center;
        }

        .amount-display {
            font-family: 'Fraunces', serif;
            font-size: 2.85rem;
            font-weight: 600;
            color: var(--ink);
            letter-spacing: -0.03em;
            line-height: 1.15;
            display: inline-flex;
            align-items: baseline;
            justify-content: center;
            gap: 2px;
            margin-bottom: 12px;
        }

        .amount-currency {
            font-family: 'DM Sans', sans-serif;
            font-size: 1.7rem;
            font-weight: 600;
            color: var(--ink-muted);
            margin-right: 2px;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 5px 14px;
            border-radius: 999px;
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        .status-success {
            background: var(--emerald-bg);
            color: var(--emerald-text);
            border: 1px solid var(--emerald-border);
        }

        .status-failed {
            background: var(--rose-bg);
            color: var(--rose-text);
            border: 1px solid var(--rose-border);
        }

        .status-pending {
            background: var(--amber-bg);
            color: var(--amber-text);
            border: 1px solid var(--amber-border);
        }

        .tx-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--ink-muted);
            margin-top: 10px;
        }

        /* Perforated Divider with Notches */
        .receipt-divider {
            position: relative;
            height: 24px;
            display: flex;
            align-items: center;
            margin: 0 -1px;
        }

        .notch-left,
        .notch-right {
            position: absolute;
            width: 22px;
            height: 22px;
            background: var(--bg-page);
            border-radius: 50%;
            top: 50%;
            transform: translateY(-50%);
            z-index: 2;
        }

        .notch-left {
            left: -11px;
            box-shadow: inset -1px 0 0 var(--border);
        }

        .notch-right {
            right: -11px;
            box-shadow: inset 1px 0 0 var(--border);
        }

        .dashed-line {
            width: 100%;
            height: 0;
            border-top: 2px dashed rgba(15, 23, 42, 0.12);
        }

        /* Detail List Rows */
        .receipt-body {
            padding: 16px 32px 28px;
        }

        .section-heading {
            font-size: 0.72rem;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--ink-light);
            margin-bottom: 14px;
        }

        .kv-row {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-light);
            gap: 16px;
        }

        .kv-row:last-child {
            border-bottom: none;
        }

        .kv-label {
            font-size: 0.86rem;
            color: var(--ink-muted);
            font-weight: 500;
            flex-shrink: 0;
        }

        .kv-value {
            font-size: 0.9rem;
            color: var(--ink);
            font-weight: 600;
            text-align: right;
            word-break: break-word;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 8px;
        }

        .ref-box {
            font-family: 'Space Mono', monospace;
            font-size: 0.84rem;
            letter-spacing: -0.02em;
            color: var(--ink);
            background: #F8FAFC;
            border: 1px solid var(--border);
            padding: 4px 10px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .copy-btn {
            background: transparent;
            border: none;
            color: var(--ink-muted);
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            font-size: 0.85rem;
            transition: all 0.15s ease;
        }

        .copy-btn:hover {
            color: var(--brand-primary);
            background: rgba(0, 31, 63, 0.05);
        }

        .type-tag {
            font-size: 0.76rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 3px 9px;
            border-radius: 6px;
            background: #F1F5F9;
            color: #475569;
        }

        .type-tag.credit {
            background: #ECFDF5;
            color: #065F46;
        }

        .type-tag.debit {
            background: #FEF2F2;
            color: #991B1B;
        }

        /* Footer & Security Seal */
        .receipt-footer {
            background: #FAF9F6;
            border-top: 1px solid var(--border);
            padding: 24px 32px;
            text-align: center;
        }

        .security-badge {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--emerald-text);
            background: #FFFFFF;
            border: 1px solid var(--emerald-border);
            padding: 6px 14px;
            border-radius: 999px;
            margin-bottom: 12px;
        }

        .barcode-container {
            margin: 12px auto 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 4px;
        }

        .barcode-svg {
            opacity: 0.7;
            max-width: 200px;
            height: 38px;
        }

        .barcode-text {
            font-family: 'Space Mono', monospace;
            font-size: 0.7rem;
            letter-spacing: 0.15em;
            color: var(--ink-light);
        }

        .footer-note {
            font-size: 0.78rem;
            color: var(--ink-muted);
            margin-top: 10px;
            line-height: 1.45;
        }

        .footer-note a {
            color: var(--brand-primary);
            text-decoration: underline;
            text-underline-offset: 2px;
        }

        /* Toast notification */
        .copy-toast {
            position: fixed;
            bottom: 24px;
            left: 50%;
            transform: translateX(-50%) translateY(30px);
            background: #0F172A;
            color: #FFFFFF;
            font-size: 0.84rem;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 999px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
            opacity: 0;
            pointer-events: none;
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .copy-toast.show {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }

        /* Print Media Styles */
        @media print {
            body {
                background: #FFFFFF !important;
                padding: 0 !important;
            }

            .no-print {
                display: none !important;
            }

            .receipt-card {
                max-width: 100% !important;
                border: 1px solid #CBD5E1 !important;
                box-shadow: none !important;
                border-radius: 0 !important;
                margin: 0 !important;
            }

            .notch-left,
            .notch-right {
                display: none !important;
            }

            .receipt-divider {
                height: 12px !important;
            }

            .dashed-line {
                border-top-color: #94A3B8 !important;
            }

            .receipt-footer {
                background: #FFFFFF !important;
            }

            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }

        @media (max-width: 540px) {
            body {
                padding: 16px 12px 36px;
            }

            .receipt-header {
                padding: 26px 20px 16px;
            }

            .amount-section {
                padding: 6px 20px 20px;
            }

            .amount-display {
                font-size: 2.35rem;
            }

            .receipt-body {
                padding: 14px 20px 22px;
            }

            .receipt-footer {
                padding: 20px 20px;
            }

            .kv-row {
                flex-direction: column;
                gap: 4px;
            }

            .kv-value {
                text-align: left;
                justify-content: flex-start;
            }
        }
    </style>
</head>
<body>

    <!-- Top Action Buttons (Hidden on Print) -->
    <div class="actions-bar no-print">
        <a href="javascript:window.history.length > 1 ? window.history.back() : window.location.href='/mytransactions'" class="back-link">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Back</span>
        </a>

        <div class="action-buttons">
            <button type="button" class="btn-act secondary" id="btnShare" onclick="shareReceipt()" title="Share Receipt">
                <i class="fa-solid fa-share-nodes"></i>
                <span>Share</span>
            </button>
            <button type="button" class="btn-act secondary" onclick="window.print()" title="Download PDF">
                <i class="fa-solid fa-arrow-down-to-bracket"></i>
                <span>PDF</span>
            </button>
            <button type="button" class="btn-act primary" onclick="window.print()" title="Print Receipt">
                <i class="fa-solid fa-print"></i>
                <span>Print</span>
            </button>
        </div>
    </div>

    <!-- The Classy Receipt Card -->
    <div class="receipt-card" id="receiptCard">

        <!-- Receipt Header -->
        <div class="receipt-header">
            <div class="brand-badge">
                <img src="{{ $brandLogo }}" alt="{{ $brandName }}" class="brand-logo" onerror="this.onerror=null; this.src='{{ asset('assets/img/logo/vtulogo.png') }}';" />
            </div>
            <div class="receipt-title">Transaction Receipt</div>
            <div class="receipt-date-sub">{{ $createdDate }}</div>
        </div>

        <!-- Amount & Status Hero -->
        <div class="amount-section">
            <div class="amount-display">
                <span class="amount-currency">₦</span><span>{{ $amountFormatted }}</span>
            </div>
            <div>
                <span class="status-pill {{ $statusClass }}">
                    <i class="fa-solid {{ $statusIcon }}"></i>
                    <span>{{ $statusText }}</span>
                </span>
            </div>
            @if(!empty($transaction->title))
                <div class="tx-title">{{ $transaction->title }}</div>
            @endif
        </div>

        <!-- Ticket Perforated Divider with Side Notches -->
        <div class="receipt-divider">
            <div class="notch-left"></div>
            <div class="dashed-line"></div>
            <div class="notch-right"></div>
        </div>

        <!-- Detail Information Rows -->
        <div class="receipt-body">
            <div class="section-heading">Transaction Details</div>

            <!-- Reference -->
            <div class="kv-row">
                <span class="kv-label">Reference</span>
                <span class="kv-value">
                    <span class="ref-box">
                        <span>{{ $transaction->reference ?? 'N/A' }}</span>
                        @if(!empty($transaction->reference))
                            <button type="button" class="copy-btn no-print" onclick="copyRef('{{ $transaction->reference }}')" title="Copy Reference">
                                <i class="fa-regular fa-copy"></i>
                            </button>
                        @endif
                    </span>
                </span>
            </div>

            <!-- Description / Service -->
            <div class="kv-row">
                <span class="kv-label">Description</span>
                <span class="kv-value">{{ $transaction->description ?? 'Transaction Record' }}</span>
            </div>

            <!-- Transaction Type -->
            <div class="kv-row">
                <span class="kv-label">Type</span>
                <span class="kv-value">
                    @php
                        $txType = strtolower($transaction->type ?? 'debit');
                        $tagClass = ($txType === 'credit') ? 'credit' : 'debit';
                    @endphp
                    <span class="type-tag {{ $tagClass }}">{{ strtoupper($transaction->type ?? 'DEBIT') }}</span>
                </span>
            </div>

            <!-- Customer Name -->
            <div class="kv-row">
                <span class="kv-label">Customer</span>
                <span class="kv-value">{{ $user->name ?? 'VTUBIZ Customer' }}</span>
            </div>

            <!-- Customer Email -->
            @if(!empty($user->email))
            <div class="kv-row">
                <span class="kv-label">Email</span>
                <span class="kv-value">{{ $user->email }}</span>
            </div>
            @endif

            <!-- Phone Number -->
            @if(!empty($user->phone))
            <div class="kv-row">
                <span class="kv-label">Phone</span>
                <span class="kv-value">{{ $user->phone }}</span>
            </div>
            @endif

            <!-- Timestamp -->
            <div class="kv-row">
                <span class="kv-label">Date & Time</span>
                <span class="kv-value">{{ $createdDate }}</span>
            </div>

            <!-- Balance Before (if available) -->
            @if(isset($transaction->before) && is_numeric($transaction->before) && (float)$transaction->before > 0)
            <div class="kv-row">
                <span class="kv-label">Wallet Before</span>
                <span class="kv-value">₦{{ number_format((float)$transaction->before, 2) }}</span>
            </div>
            @endif

            <!-- Balance After (if available) -->
            @if(isset($transaction->after) && is_numeric($transaction->after))
            <div class="kv-row">
                <span class="kv-label">Wallet After</span>
                <span class="kv-value">₦{{ number_format((float)$transaction->after, 2) }}</span>
            </div>
            @endif
        </div>

        <!-- Receipt Footer & Verification Stamp -->
        <div class="receipt-footer">
            <div class="security-badge">
                <i class="fa-solid fa-shield-halved"></i>
                <span>Verified Electronic Receipt</span>
            </div>

            <!-- Decorative Clean Barcode -->
            <div class="barcode-container">
                <svg class="barcode-svg" viewBox="0 0 200 40" preserveAspectRatio="none">
                    <!-- Clean Barcode Pattern -->
                    <rect x="0" y="0" width="3" height="40" fill="#0F172A"/>
                    <rect x="5" y="0" width="1" height="40" fill="#0F172A"/>
                    <rect x="8" y="0" width="4" height="40" fill="#0F172A"/>
                    <rect x="14" y="0" width="2" height="40" fill="#0F172A"/>
                    <rect x="18" y="0" width="1" height="40" fill="#0F172A"/>
                    <rect x="22" y="0" width="5" height="40" fill="#0F172A"/>
                    <rect x="29" y="0" width="2" height="40" fill="#0F172A"/>
                    <rect x="33" y="0" width="3" height="40" fill="#0F172A"/>
                    <rect x="38" y="0" width="1" height="40" fill="#0F172A"/>
                    <rect x="42" y="0" width="4" height="40" fill="#0F172A"/>
                    <rect x="48" y="0" width="2" height="40" fill="#0F172A"/>
                    <rect x="53" y="0" width="5" height="40" fill="#0F172A"/>
                    <rect x="60" y="0" width="1" height="40" fill="#0F172A"/>
                    <rect x="63" y="0" width="3" height="40" fill="#0F172A"/>
                    <rect x="68" y="0" width="2" height="40" fill="#0F172A"/>
                    <rect x="73" y="0" width="4" height="40" fill="#0F172A"/>
                    <rect x="80" y="0" width="1" height="40" fill="#0F172A"/>
                    <rect x="84" y="0" width="3" height="40" fill="#0F172A"/>
                    <rect x="89" y="0" width="5" height="40" fill="#0F172A"/>
                    <rect x="96" y="0" width="2" height="40" fill="#0F172A"/>
                    <rect x="100" y="0" width="1" height="40" fill="#0F172A"/>
                    <rect x="104" y="0" width="4" height="40" fill="#0F172A"/>
                    <rect x="110" y="0" width="3" height="40" fill="#0F172A"/>
                    <rect x="115" y="0" width="1" height="40" fill="#0F172A"/>
                    <rect x="118" y="0" width="5" height="40" fill="#0F172A"/>
                    <rect x="125" y="0" width="2" height="40" fill="#0F172A"/>
                    <rect x="130" y="0" width="4" height="40" fill="#0F172A"/>
                    <rect x="136" y="0" width="1" height="40" fill="#0F172A"/>
                    <rect x="140" y="0" width="3" height="40" fill="#0F172A"/>
                    <rect x="145" y="0" width="2" height="40" fill="#0F172A"/>
                    <rect x="150" y="0" width="5" height="40" fill="#0F172A"/>
                    <rect x="157" y="0" width="1" height="40" fill="#0F172A"/>
                    <rect x="160" y="0" width="4" height="40" fill="#0F172A"/>
                    <rect x="166" y="0" width="2" height="40" fill="#0F172A"/>
                    <rect x="170" y="0" width="3" height="40" fill="#0F172A"/>
                    <rect x="175" y="0" width="1" height="40" fill="#0F172A"/>
                    <rect x="178" y="0" width="4" height="40" fill="#0F172A"/>
                    <rect x="184" y="0" width="2" height="40" fill="#0F172A"/>
                    <rect x="188" y="0" width="5" height="40" fill="#0F172A"/>
                    <rect x="195" y="0" width="2" height="40" fill="#0F172A"/>
                    <rect x="198" y="0" width="2" height="40" fill="#0F172A"/>
                </svg>
                <span class="barcode-text">{{ $transaction->reference ?? 'VTUBIZ-PAYMENT' }}</span>
            </div>

            <p class="footer-note">
                Thank you for choosing {{ $brandName }}.<br>
                For questions or support, contact <a href="mailto:support@vtubiz.com">support@vtubiz.com</a>.
            </p>
        </div>

    </div>

    <!-- Toast Notification for Copy -->
    <div id="copyToast" class="copy-toast">
        <i class="fa-solid fa-circle-check" style="color: #34D399;"></i>
        <span id="toastMsg">Reference copied to clipboard!</span>
    </div>

    <script>
        function showToast(message) {
            const toast = document.getElementById('copyToast');
            const msg = document.getElementById('toastMsg');
            msg.textContent = message;
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 2500);
        }

        function copyRef(reference) {
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(reference).then(() => {
                    showToast('Reference copied: ' + reference);
                }).catch(() => {
                    fallbackCopy(reference);
                });
            } else {
                fallbackCopy(reference);
            }
        }

        function fallbackCopy(text) {
            const textarea = document.createElement('textarea');
            textarea.value = text;
            textarea.style.position = 'fixed';
            textarea.style.opacity = '0';
            document.body.appendChild(textarea);
            textarea.select();
            try {
                document.execCommand('copy');
                showToast('Reference copied: ' + text);
            } catch (err) {
                showToast('Could not copy automatically');
            }
            document.body.removeChild(textarea);
        }

        function shareReceipt() {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $brandName }} Receipt - {{ $transaction->reference ?? "TX" }}',
                    text: 'Transaction receipt for ₦{{ $amountFormatted }} ({{ $statusText }}).',
                    url: window.location.href,
                }).catch(() => {});
            } else {
                copyRef(window.location.href);
                showToast('Receipt link copied to clipboard!');
            }
        }
    </script>
</body>
</html>
