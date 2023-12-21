<div class="mb-3">
    @if($label)
        <label for="{{ $id }}" class="form-label text-capitalize">
            {{ $label }}
            @if($required) <span class="text-danger">*</span> @else <span class="text-secondary">(Opsional)</span> @endif
            :
        </label>
    @endif
    <select class="form-select select2 @if(!$isModal) @error($name) is-invalid @enderror @endif"
            name="{{ $name }}"
            id="{{ $id }}"
            @if($required) required @endif
            @if($multiple) multiple @endif >
        {{ $slot }}
    </select>

        @if($isModal)
            <span class="invalid-feedback {{ $name }}_error" role="alert"><strong></strong></span>
        @else
            @error($name)
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        @endif
</div>
