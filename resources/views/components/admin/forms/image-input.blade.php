<x-admin.forms.input type="file" :label="$label" :id="$id" :name="$name" accept="image/*" :required="$isRequired"/>
<img id="preview-{{ $name }}" class="image-preview mt-3" alt="foto"
     @if($value != null)
         src="{{ Storage::url($value) }}"
     @else
         src="{{ asset('build/images/preview.png') }}"
    @endif
/>
