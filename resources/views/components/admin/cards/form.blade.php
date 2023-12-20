<form action="{{ $actionRoute }}" method="POST" enctype="multipart/form-data">
    @if($isEdit)
        @method('PUT')
    @endif
    @csrf
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">{{ $title }}</h4>
        </div>
        <div class="card-body">
            {{ $slot }}
        </div>
        <div class="card-footer">
            <div class="float-end">
                <x-button color="secondary" icon="arrow-back" text="Kembali" :route="$backRoute" :tooltipsTitle="$backButtonTolltips" />
                <x-button2 color="primary" icon="save" text="Simpan" type="submit" :tooltipsTitle="$submitButtonTolltips" />
            </div>
        </div>
    </div>
</form>
