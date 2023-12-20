<div class="mb-3">
    @if($label) <label for="{{ $id }}" class="form-label text-capitalize">{{ $label }}</label>   @endif
    <input type="{{ $type }}"
           class="form-control @error($name) is-invalid @enderror"
           name="{{ $name }}"
           id="{{ $id }}"
           value="{{ old($name, $value) }}"
           placeholder="{{ $placeholder }}"
           accept="{{ $acceptFileType }}"
           @if($required) required @endif
           @if($readonly) readonly @endif>

    @error($name)
    <div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>
    @enderror
</div>
