@extends('manager.master')
@section('header')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    .page-header h1 { font-family: 'Fraunces', serif; font-size: 2.2rem; color: var(--primary-dark); margin-bottom: 8px; }
    .stat-card { 
        background: white; border-radius: var(--radius-lg); padding: 25px; 
        box-shadow: var(--shadow-card); border: none; transition: transform 0.3s;
        display: flex; align-items: center; gap: 20px;
    }
    .stat-card:hover { transform: translateY(-5px); }
    .stat-icon { 
        width: 60px; height: 60px; border-radius: 15px; 
        display: flex; align-items: center; justify-content: center; font-size: 1.8rem;
    }
    .icon-trans { background: rgba(255, 111, 0, 0.1); color: var(--accent-orange); }
    
    .stat-info h3 { font-family: 'Fraunces', serif; font-size: 1.8rem; margin-bottom: 2px; color: var(--primary-dark); }
    .stat-info p { margin-bottom: 0; color: #6c757d; font-weight: 500; font-size: 0.9rem; }

    .chart-card { background: white; border-radius: var(--radius-lg); padding: 30px; box-shadow: var(--shadow-card); border: none; }
    .chart-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
    .chart-header h4 { font-family: 'Fraunces', serif; color: var(--primary-dark); margin-bottom: 0; }
    
    .chart-container { position: relative; height: 400px; width: 100%; }
</style>
@endsection

@section('content')
<div class="page-header mb-5">
    <h1>Purchase Analytics</h1>
    <p class="text-muted">Track transaction volume and platform usage trends.</p>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-12">
        <div class="stat-card">
            <div class="stat-icon icon-trans">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
            <div class="stat-info">
                <h3>{{number_format($total_transactions)}}</h3>
                <p>Total Transactions Processed</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="chart-card">
            <div class="chart-header">
                <h4>Transaction Volume Analysis</h4>
                <div class="badge bg-soft-primary text-primary px-3 py-2 rounded-pill">
                    <i class="fa-solid fa-calendar-days me-1"></i> Current Year
                </div>
            </div>
            <div class="chart-container">
                <canvas id="transChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('transChart').getContext('2d');
        
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(255, 111, 0, 0.2)');
        gradient.addColorStop(1, 'rgba(255, 111, 0, 0)');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Transactions',
                    data: [
                        {{ $january ?? 0 }}, {{ $february ?? 0 }}, {{ $march ?? 0 }}, 
                        {{ $april ?? 0 }}, {{ $may ?? 0 }}, {{ $june ?? 0 }}, 
                        {{ $july ?? 0 }}, {{ $august ?? 0 }}, {{ $september ?? 0 }}, 
                        {{ $october ?? 0 }}, {{ $november ?? 0 }}, {{ $december ?? 0 }}
                    ],
                    backgroundColor: '#FF6F00',
                    borderRadius: 8,
                    barThickness: 20
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { borderDash: [5, 5], color: 'rgba(0,0,0,0.05)' },
                        ticks: { font: { size: 12 }, color: '#6c757d' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 12 }, color: '#6c757d' }
                    }
                }
            }
        });
    });
</script>
@endsection