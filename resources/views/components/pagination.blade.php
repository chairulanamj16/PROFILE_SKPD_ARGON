<div class="d-flex justify-content-between align-items-center" wire:ignore>
    <strong>
        MENAMPILKAN {{ $data->firstItem() }} - {{ $data->lastItem() }} DARI
        {{ $data->total() }}
        DATA
    </strong>
    {{ $data->links('vendor.pagination.bootstrap-4') }}
</div>
