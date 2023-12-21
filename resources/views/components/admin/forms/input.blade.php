<div class="mb-3">
    @if($label)
        <label for="{{ $id }}" class="form-label text-capitalize">
            {{ $label }}
            @if($required) <span class="text-danger">*</span> @else <span class="text-secondary">(Opsional)</span> @endif
            :
        </label>
    @endif
    <input type="{{ $type }}"
           class="form-control @if(!$isModal) @error($name) is-invalid @enderror @endif"
           name="{{ $name }}"
           id="{{ $id }}"
           placeholder="{{ $placeholder }}"
           accept="{{ $acceptFileType }}"
           @if($required) required @endif
           @if($readonly) readonly @endif
           @if(!$isModal) value="{{ old($name, $value) }}" @endif>
    @if($isModal)
        <span class="invalid-feedback {{ $name }}_error" role="alert"><strong></strong></span>
    @else
        @error($name)
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    @endif
</div>
