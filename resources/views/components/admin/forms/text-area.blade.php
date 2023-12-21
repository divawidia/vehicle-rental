<div class="mb-3">
    @if($label) <label for="{{ $id }}" class="form-label text-capitalize">{{ $label }}</label>   @endif
    <textarea class="form-control @if($isCkeditor) ckeditor @endif @if(!$isModal) @error($name) is-invalid @enderror @endif"
              name="{{ $name }}"
              id="{{ $id }}"
              placeholder="{{ $placeholder }}"
              @if($required) required @endif >
        @if(!$isModal) {{ old($name, $value) }} @endif
    </textarea>

        @if($isModal)
            <span class="invalid-feedback {{ $name }}_error" role="alert"><strong></strong></span>
        @else
            @error($name)
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        @endif
</div>
