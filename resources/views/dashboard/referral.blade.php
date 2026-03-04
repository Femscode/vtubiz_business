@extends('dashboard.master1')

@section('header')
<style>
    .referral-header {
        margin-bottom: var(--space-lg);
    }
    .referral-header h1 {
        font-family: 'Fraunces', serif;
        font-size: 2.2rem;
        color: var(--primary-dark);
        margin-bottom: 8px;
    }
    .referral-card {
        background: var(--surface) !important;
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        box-shadow: var(--shadow-card);
    }
    .referral-link-box {
        background: #FDFCF8;
        border: 1px dashed rgba(15, 53, 72, 0.2);
        border-radius: var(--radius-md);
        padding: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: var(--space-lg);
    }
    .referral-url {
        font-family: 'DM Sans', sans-serif;
        font-size: 0.95rem;
        color: var(--primary-dark);
        word-break: break-all;
        font-weight: 500;
    }
    .copy-btn-large {
        background: var(--primary-dark);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: var(--radius-pill);
        font-weight: 600;
        cursor: pointer;
        white-space: nowrap;
        transition: transform 0.1s;
    }
    .copy-btn-large:active { transform: scale(0.95); }

    .stat-box {
        background: #FDFCF8;
        border: 1px solid rgba(0,0,0,0.03);
        border-radius: var(--radius-md);
        padding: 25px;
        text-align: center;
        height: 100%;
    }
    .stat-icon-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: rgba(15, 53, 72, 0.05);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        font-size: 1.25rem;
        color: var(--primary-dark);
    }
    .stat-value-large {
        font-family: 'Fraunces', serif;
        font-size: 1.8rem;
        font-weight: 600;
        color: var(--primary-dark);
        margin-bottom: 5px;
    }
    .stat-label-large {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-secondary);
    }

    .modern-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 8px;
    }
    .modern-table thead th {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-light);
        padding: 10px 20px;
        font-weight: 700;
    }
    .modern-table tbody tr {
        background: #FDFCF8;
        transition: transform 0.2s;
    }
    .modern-table tbody td {
        padding: 15px 20px;
        font-size: 0.9rem;
        vertical-align: middle;
    }
    .modern-table tbody td:first-child { border-radius: 12px 0 0 12px; }
    .modern-table tbody td:last-child { border-radius: 0 12px 12px 0; }

    .btn-message {
        background: rgba(47, 128, 237, 0.1);
        color: var(--accent-blue);
        padding: 6px 14px;
        border-radius: 20px;
        text-decoration: none;
        font-size: 0.8rem;
        font-weight: 600;
    }
</style>
@endsection

@section('content')
<div class="referral-header">
    <h1>Referral Program</h1>
    <p class="text-muted">Invite your friends and earn rewards for every purchase they make.</p>
</div>

<div class="row g-5">
    <!-- Top Stats -->
    <div class="col-lg-8">
        <div class="referral-card">
            <h4 class="serif mb-4">Your Referral Link</h4>
            <p class="text-sm text-muted mb-3">Share this link with your friends and earn an enticing 5% cashback on every purchase they make!</p>
            
            <div class="referral-link-box">
                <span class="referral-url" id="referralUrl">https://vtubiz.com/register?referral_code={{ $user->brand_name }}</span>
                <button class="copy-btn-large" id="copyBtn2">Copy Link</button>
            </div>

            <div class="row g-4 mt-2">
                <div class="col-md-6">
                    <div class="stat-box">
                        <div class="stat-icon-circle"><i class="fa-solid fa-users"></i></div>
                        <div class="stat-value-large">{{ count($users) }}</div>
                        <div class="stat-label-large">Total Referrals</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-box">
                        <div class="stat-icon-circle" style="color: var(--accent-green); background: rgba(39, 174, 96, 0.05);"><i class="fa-solid fa-coins"></i></div>
                        <div class="stat-value-large">₦{{ number_format($earnings) }}</div>
                        <div class="stat-label-large">Total Earnings</div>
                        <a onclick='return confirm("Are you sure you want to remit earnings?")' href="/remitearning" class="btn btn-sm mt-3" style="background: var(--accent-green); color: white; border-radius: 20px; font-weight: 600; padding: 5px 15px;">Remit to Wallet</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Referral List -->
    <div class="col-lg-12">
        <div class="referral-card">
            <h4 class="serif mb-4">Referred Users</h4>
            
            <div class="table-responsive">
                <table class="datatable modern-table">
                    <thead>
                        <tr>
                            <th>User Details</th>
                            <th>Total Earnings</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $ref)
                        <tr>
                            <td>
                                <div style="font-weight: 600; color: var(--primary-dark);">{{ $ref->name }}</div>
                                <div class="text-xs text-muted">{{ $ref->phone }}</div>
                            </td>
                            <td style="font-family: 'Fraunces', serif; font-weight: 600; color: var(--accent-green);">
                                ₦{{ number_format($ref->earnings, 2) }}
                            </td>
                            <td>
                                <a href='https://wa.me/234{{ substr($ref->phone, 1) }}' class="btn-message">
                                    <i class="fab fa-whatsapp me-1"></i> Message
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
       
        // var oTable = $('.datatable').DataTable({
        //     ordering: false,
        //     searching: true
        // });

        $('#copyBtn2').on('click', function() {
            // alert('heh')
            var url = $('#referralUrl').text();
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(url).select();
            
            try {
                var successful = document.execCommand('copy');
                if (successful) {
                    var $btn = $(this);
                    $btn.text('Copied!').css('background', '#27ae60');
                    setTimeout(function() {
                        $btn.text('Copy Link').css('background', 'var(--primary-dark)');
                    }, 2000);
                }
            } catch (err) {
                console.error('jQuery Fallback: Unable to copy', err);
            }
            $temp.remove();
        });

        @if(session('message'))
            Swal.fire({ icon: 'success', title: 'Success!', text: "{{ session('message') }}", confirmButtonColor: '#0F3548' });
        @endif
    });
</script>
@endsection
