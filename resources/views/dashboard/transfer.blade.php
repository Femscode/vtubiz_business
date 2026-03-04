@extends('dashboard.master1')

@section('header')
<style>
    .transfer-header {
        margin-bottom: var(--space-lg);
    }
    .transfer-header h1 {
        font-family: 'Fraunces', serif;
        font-size: 2.2rem;
        color: var(--primary-dark);
        margin-bottom: 8px;
    }
    .transfer-card {
        background: var(--surface);
        border-radius: var(--radius-lg);
        padding: var(--space-lg);
        box-shadow: var(--shadow-card);
    }
</style>
@endsection

@section('content')
<div class="transfer-header">
    <h1>Money Transfer</h1>
    <p class="text-muted">Send money instantly to other VTUBiz users.</p>
</div>

<div id="kt_app_content" class="app-content flex-column-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="transfer-card">
                <transfer-component :user='{{ $user }}'></transfer-component>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        @if (session('message'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session('message') }}",
                confirmButtonColor: '#0F3548'
            });
        @endif

        $("#u_amount").on('input', function() {
            var amount = parseInt($("#u_amount").val()) * 100;
            if(parseInt($("#u_amount").val()) < 2500) {
                $("#amount").val((amount) + (0.05 * amount));
            } else {
                $("#amount").val((amount) + (0.05 * amount) + 10000);
            }
        });
    });
</script>
@endsection
