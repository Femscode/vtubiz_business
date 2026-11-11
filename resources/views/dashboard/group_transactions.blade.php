@extends('dashboard.master1')

@php
    $back = '/data_group';
    $backLabel = 'Data groups';
    $icon = 'fa-wifi';
    $tone = 't-blue';
@endphp

@include('dashboard.partials.group-history')
