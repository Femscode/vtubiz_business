@extends('dashboard.master1')

@section('header')
<style>
    .verify-header {
        margin-bottom: var(--space-lg);
    }
    .verify-header h1 {
        font-family: 'Fraunces', serif;
        font-size: 2.2rem;
        color: var(--primary-dark);
        margin-bottom: 8px;
    }
    .verify-card {
        background: var(--surface);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        box-shadow: var(--shadow-card);
    }
    .form-control-custom {
        width: 100%;
        padding: 14px 18px;
        border-radius: var(--radius-md);
        border: 1px solid rgba(0,0,0,0.08);
        background: #F9F9F9;
        font-family: 'DM Sans', sans-serif;
        transition: all 0.2s ease;
    }
    .form-control-custom:focus {
        outline: none;
        border-color: var(--primary-dark);
        background: white;
        box-shadow: 0 0 0 4px rgba(15, 53, 72, 0.05);
    }
    .btn-verify {
        background: var(--primary-dark);
        color: white;
        border: none;
        padding: 14px 28px;
        border-radius: var(--radius-pill);
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.1s;
    }
    .btn-verify:active { transform: scale(0.98); }

    .modern-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
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
    }
    .modern-table tbody td {
        padding: 16px 20px;
        font-size: 0.9rem;
        vertical-align: middle;
    }
    .modern-table tbody td:first-child { border-radius: 12px 0 0 12px; }
    .modern-table tbody td:last-child { border-radius: 0 12px 12px 0; }
</style>
@endsection

@section('content')
<div class="verify-header">
    <h1>Verify Purchase</h1>
    <p class="text-muted">Track and verify the status of your transactions using their reference numbers.</p>
</div>

<div class="verify-card">
    <form method='post' action='{{ route("check_verify_purchase") }}'>
        @csrf
        <div class="row align-items-end g-3">
            <div class="col-md-9">
                <label class="form-label font-weight-bold mb-2" style="font-size: 0.9rem; color: var(--primary-dark);">Transaction Reference</label>
                <input type="text" value='{{ $ref ?? "" }}' id='reference' class="form-control-custom" name="reference" placeholder="Enter reference number (e.g. VTU-123456)">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn-verify w-100">Verify Now</button>
            </div>
        </div>
    </form>

    @if(isset($response))
    <div class="mt-5 pt-4 border-top">
        <h4 class="serif mb-4" style="color: var(--primary-dark);">Verification Result</h4>
        <div class="table-responsive">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>Reference</th>
                        <th>Details</th>
                        <th>Response</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="font-weight: 500;">{{ $response['reference_no'] ?? '' }}</td>
                        <td>
                            @if(isset($response['network']))
                                <div class="text-xs">
                                    <strong>Network:</strong> {{ $response['network'] }}<br>
                                    <strong>Mobile:</strong> {{ $response['mobileno'] }}<br>
                                    <strong>Plan:</strong> {{ $response['dataplan'] }}
                                </div>
                            @elseif(isset($response['company']))
                                <div class="text-xs">
                                    <strong>Company:</strong> {{ $response['company'] }}<br>
                                    <strong>Meter/IUC:</strong> {{ $response['meterno'] ?? $response['iucno'] ?? '' }}<br>
                                    <strong>Token:</strong> {{ $response['token'] ?? '' }}
                                </div>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td class="text-xs">{{ $response['message'] ?? '' }}</td>
                        <td>
                            <span class="badge" style="background: rgba(39, 174, 96, 0.1); color: var(--accent-green); border-radius: 20px; padding: 6px 12px;">
                                {{ $response['status'] ?? '' }}
                            </span>
                        </td>
                        <td>
                            <a href='#' class="btn btn-sm" style="background: var(--primary-dark); color: white; border-radius: 20px; padding: 5px 15px;">Print</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        @if (session('message'))
            Swal.fire({ icon: 'success', title: 'Success!', text: "{{ session('message') }}", confirmButtonColor: '#0F3548' });
        @endif
    });
</script>
@endsection
