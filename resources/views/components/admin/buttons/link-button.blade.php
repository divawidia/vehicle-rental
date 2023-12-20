<a class="btn btn-{{ $color }} btn-{{ $size }} {{ $additionalClass }}" href="{{ $route }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $tooltipsTitle }}">
    @if($icon)
        <i class="bx bx-{{ $icon }} align-middle {{ $iconMargin }}"></i>
    @endif
    {{ $text }}
</a>
