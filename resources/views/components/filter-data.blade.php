<div class="row mb-3">
    <div class="col-4 col-md-2">
        <select class="form-control" wire:model.live="page_count">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
    </div>
    <div class="col-12 col-md-6">
        {{ $slot }}
    </div>
    <div class="col-12 col-md-4">
        <div class="form-group">
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1">
                    <i class="fas fa-search fa-fw"></i>
                </span>
                <input type="text" class="form-control " placeholder="Pencarian..."
                    wire:model.live.debounce.300ms='search'>
            </div>
        </div>
    </div>
</div>
