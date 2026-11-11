{{-- Slim, re-openable announcement strip. Rendered inside #app, so v-pre stops Vue from compiling admin text. --}}
@if($announcements->count())
@php
    $first = $announcements->first();
    $ribbonIsDeal = $first['kind'] === 'deal';
@endphp
<div class="anx-ribbon {{ $ribbonIsDeal ? 'is-deal' : '' }}" id="anx-ribbon" hidden v-pre>
    <button type="button" class="anx-ribbon-main" data-anx-open>
        <span class="anx-ribbon-icon"><i class="fa-solid {{ $ribbonIsDeal ? 'fa-tags' : 'fa-bullhorn' }}"></i></span>
        <span class="anx-ribbon-text">
            @if($announcements->count() > 1)
                <b>{{ $announcements->count() }} updates</b> · {{ $first['item']->title }}
            @else
                {{ $first['item']->title }}
            @endif
        </span>
        <span class="anx-ribbon-cta">View <i class="fa-solid fa-arrow-right"></i></span>
    </button>
    <button type="button" class="anx-ribbon-x" data-anx-ribbon-close aria-label="Hide announcement bar">
        <i class="fa-solid fa-xmark"></i>
    </button>
</div>
@endif
