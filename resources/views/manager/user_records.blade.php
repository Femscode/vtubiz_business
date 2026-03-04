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
    .icon-users { background: rgba(15, 53, 72, 0.1); color: var(--primary-dark); }
    .icon-active { background: rgba(255, 111, 0, 0.1); color: var(--accent-orange); }
    
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
    <h1>User Analytics</h1>
    <p class="text-muted">Comprehensive breakdown of user growth and activity metrics.</p>
</div>

<div class="row g-4 mb-5">
    <div class="col-md-6">
        <div class="stat-card">
            <div class="stat-icon icon-users">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="stat-info">
                <h3>{{number_format($total_users)}}</h3>
                <p>Total Registered Users</p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="stat-card">
            <div class="stat-icon icon-active">
                <i class="fa-solid fa-user-check"></i>
            </div>
            <div class="stat-info">
                <h3>{{number_format($active_users)}}</h3>
                <p>Active Users (Current Session)</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="chart-card">
            <div class="chart-header">
                <h4>User Growth Analysis</h4>
                <div class="badge bg-soft-primary text-primary px-3 py-2 rounded-pill">
                    <i class="fa-solid fa-calendar-days me-1"></i> Current Year
                </div>
            </div>
            <div class="chart-container">
                <canvas id="growthChart"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('growthChart').getContext('2d');
        
        // Gradient for the line chart
        const gradient = ctx.createLinearGradient(0, 0, 0, 400);
        gradient.addColorStop(0, 'rgba(15, 53, 72, 0.2)');
        gradient.addColorStop(1, 'rgba(15, 53, 72, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'New Users',
                    data: [
                        {{ $january ?? 0 }}, {{ $february ?? 0 }}, {{ $march ?? 0 }}, 
                        {{ $april ?? 0 }}, {{ $may ?? 0 }}, {{ $june ?? 0 }}, 
                        {{ $july ?? 0 }}, {{ $august ?? 0 }}, {{ $september ?? 0 }}, 
                        {{ $october ?? 0 }}, {{ $november ?? 0 }}, {{ $december ?? 0 }}
                    ],
                    borderColor: '#0F3548',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#0F3548',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
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