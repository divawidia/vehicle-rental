<button type="{{ $type }}" class="btn btn-{{ $color }} btn-{{ $size }} {{ $additionalClass }}" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ $tooltipsTitle }}">
    @if($icon)
        <i class="bx bx-{{ $icon }} align-middle {{ $iconMargin }}"></i>
    @endif
    {{ $text }}
</button>
