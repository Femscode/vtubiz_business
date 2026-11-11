@extends('dashboard.master1')

@php
    $groups = $airtime_groups;
    $cfg = [
        'kind' => 'Airtime',
        'title' => 'Airtime',
        'titleEm' => 'groups',
        'subtitle' => 'Top up many numbers at once, and recharge them anytime.',
        'icon' => 'fa-phone',
        'tone' => 't-amber',
        'createAction' => '/createAirtimeGroup',
        'placeholder' => 'e.g. Family, Team A',
        'recipientsUrl' => '/premium-airtime_recipients',
        'historyUrl' => '/premium-group_airtime_transactions',
        'deleteUrl' => '/delete_airtime_group',
        'rechargeUrl' => '/recharge_airtime_group',
        'successLoose' => true,
    ];
@endphp

@include('dashboard.partials.group-list')
