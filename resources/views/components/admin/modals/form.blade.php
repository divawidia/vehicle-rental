<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-{{ $size }}">
        <div class="modal-content">
            <form action="" method="POST" id="{{ $formId }}">
                @if($isEdit) @method('PUT') @endif
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ $slot }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <x-admin.buttons.basic-button type="submit" text="Simpan"/>
                </div>
            </form>
        </div>
    </div>
</div>

