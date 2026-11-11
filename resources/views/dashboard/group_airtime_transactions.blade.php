@extends('dashboard.master1')

@php
    $back = '/airtime_group';
    $backLabel = 'Airtime groups';
    $icon = 'fa-phone';
    $tone = 't-amber';
@endphp

@include('dashboard.partials.group-history')
