@extends('dashboard.master1')

@php
    $groups = $data_groups;
    $cfg = [
        'kind' => 'Data',
        'title' => 'Data',
        'titleEm' => 'groups',
        'subtitle' => 'Buy data for many people at once, and recharge them anytime.',
        'icon' => 'fa-wifi',
        'tone' => 't-blue',
        'createAction' => '/createGroup',
        'placeholder' => 'e.g. Family, Office team',
        'recipientsUrl' => '/premium-data_recipient',
        'historyUrl' => '/premium-group_transactions',
        'deleteUrl' => '/delete_group',
        'rechargeUrl' => '/recharge_group',
        'successLoose' => false,
    ];
@endphp

@include('dashboard.partials.group-list')
