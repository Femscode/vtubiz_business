@extends('dashboard.master1')

@php
    $tiers = [
        ['name' => "Starter", 'min' => 0, 'icon' => "fa-seedling", 'tone' => "t-ink", 'req' => "Registration", 'perks' => ["Access to all data plans"]],
        ['name' => "Enthusiast", 'min' => 10000, 'icon' => "fa-star", 'tone' => "t-blue", 'req' => "₦10,000 in transactions", 'perks' => ["Access to all data plans", "Schedule purchases", "Bulk purchases"]],
        ['name' => "Loyal", 'min' => 50000, 'icon' => "fa-heart", 'tone' => "t-pink", 'req' => "₦50,000 in transactions", 'perks' => ["Access to all data plans", "Schedule purchases", "Bulk purchases", "Create giveaways", "100MB free data weekly"]],
        ['name' => "Pro", 'min' => 200000, 'icon' => "fa-rocket", 'tone' => "t-purple", 'req' => "₦200,000 in transactions", 'perks' => ["Access to all data plans", "Schedule purchases", "Bulk purchases", "Create and join giveaways", "200MB free data weekly", "Reseller prices on all products"]],
        ['name' => "Elite", 'min' => 500000, 'icon' => "fa-gem", 'tone' => "t-teal", 'req' => "₦500,000 in transactions", 'perks' => ["Access to all data plans", "Schedule purchases", "Bulk purchases", "Create and join giveaways", "500MB free data weekly", "Reseller prices on all products", "A free VTU website"]],
        ['name' => "Legend", 'min' => 1000000, 'icon' => "fa-crown", 'tone' => "t-amber", 'req' => "₦1,000,000 in transactions", 'perks' => ["Access to all data plans", "Schedule purchases", "Bulk purchases", "Create and join giveaways", "1GB free data weekly", "Reseller prices on all products", "A free VTU website", "Exclusive customer support", "Priority access to new features"]]
    ];
    $spent = (float) $user->total_spent;
    $currentIdx = 0;
    foreach ($tiers as $i => $t) {
        if ($spent >= $t['min']) $currentIdx = $i;
    }
    $next = $tiers[$currentIdx + 1] ?? null;
    $progress = $next ? min(100, round(($spent - $tiers[$currentIdx]['min']) / max(1, $next['min'] - $tiers[$currentIdx]['min']) * 100)) : 100;
@endphp

@section('header')
<style>
    .tier-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 16px;
    }

    .tier {
        position: relative;
    }

    .tier.locked {
        opacity: .62;
    }

    .tier.current {
        border-color: var(--primary-dark);
        box-shadow: 0 0 0 3px rgba(0, 31, 63, .08), var(--shadow-card);
        opacity: 1;
    }

    .tier-top {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 14px;
    }

    .tier-top .ic {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        display: grid;
        place-items: center;
    }

    .tier-top b {
        display: block;
        font-family: 'Fraunces', serif;
        font-weight: 500;
        font-size: 1.2rem;
    }

    .tier-top small {
        color: var(--text-secondary);
        font-size: .8rem;
    }

    .tier ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: grid;
        gap: 8px;
    }

    .tier li {
        display: flex;
        gap: 8px;
        font-size: .88rem;
        color: #374151;
    }

    .tier li i {
        color: var(--accent-green);
        margin-top: 4px;
        font-size: .75rem;
    }

    .progress-v {
        height: 8px;
        background: rgba(255, 255, 255, .12);
        border-radius: 99px;
        overflow: hidden;
        margin: 16px 0 8px;
    }

    .progress-v span {
        display: block;
        height: 100%;
        background: var(--brand-orange);
        border-radius: 99px;
    }
</style>
@endsection

@section('content')
<div class="pg">
    <div class="pg-head">
        <div>
            <h1>Your <em>rewards</em></h1>
            <p>The more you transact, the more you unlock.</p>
        </div>
    </div>

    <div class="hero-v" style="margin-bottom:20px">
        <div class="k">Current level</div>
        <div class="v" style="font-size:2rem;margin-top:6px">{{ $tiers[$currentIdx]['name'] }}</div>
        <div class="progress-v"><span style="width: {{ $progress }}%"></span></div>
        <div style="color:rgba(255,255,255,.7);font-size:.88rem">
            @if($next)
                ₦{{ number_format(max(0, $next['min'] - $spent)) }} more to reach <b style="color:#fff">{{ $next['name'] }}</b>
            @else
                You've reached the top level. Thank you!
            @endif
        </div>
    </div>

    <div class="tier-grid">
        @foreach($tiers as $i => $t)
            <div class="panel tier {{ $i === $currentIdx ? 'current' : ($i > $currentIdx ? 'locked' : '') }}">
                <div class="tier-top">
                    <span class="ic {{ $t['tone'] }}"><i class="fa-solid {{ $t['icon'] }}"></i></span>
                    <div>
                        <b>{{ $t['name'] }}</b>
                        <small>{{ $t['req'] }}</small>
                    </div>
                    @if($i === $currentIdx)
                        <span class="badge-v ok" style="margin-left:auto">You</span>
                    @elseif($i > $currentIdx)
                        <i class="fa-solid fa-lock" style="margin-left:auto;color:var(--text-light)"></i>
                    @endif
                </div>
                <ul>
                    @foreach($t['perks'] as $perk)
                        <li><i class="fa-solid fa-check"></i>{{ $perk }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>
@endsection
