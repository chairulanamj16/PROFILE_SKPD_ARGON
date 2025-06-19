<div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
    <div class="d-flex align-items-center gap-3" style="white-space: nowrap;">
        <label for="tampil" class="form-label mb-0">Tampilkan</label>
        <select wire:model.live="page_count" id="tampil" class="form-select form-select-sm">
            <option value="1">1</option>
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="50">50</option>
            <option value="0">Semua</option>
        </select>

        <label for="tampil" class="form-label mb-0" style="white-space: nowrap;">
            baris
            @if ($page_count == 0)
                dari semua data ({{ $data->count() }})
            @else
                dari total {{ $data->total() }} data
            @endif
        </label>
    </div>

    @if ($page_counts != 0 && method_exists($data, 'links'))
        <nav>
            {{ $data->links() }}
        </nav>
    @endif
</div>
