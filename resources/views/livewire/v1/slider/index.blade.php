<div>
    <div class="table-responsive text-nowrap mt-2">

        <x-filter-data>

        </x-filter-data>
        <table class="table align-items-center table-bordered">
            <thead class="text-sm bg-dark text-white">
                <tr class="text-nowrap">
                    <th>#</th>
                    <th>Gambar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @can('create_subdomain')
                    <tr>
                        <td></td>
                        <td>
                            <input type="file" class="form-control-table @error('subdomain') is-invalid @enderror"
                                wire:model.live='image'>
                        </td>
                        <td>
                            <label for="status">
                                <input type="checkbox" wire:model.live='is_active' value="1"
                                    class="form-control-table @error('subdomain') is-invalid @enderror">
                                Aktif
                            </label>
                        </td>
                        <td class="text-center">
                            <button wire:click="store" class="btn btn-primary btn-xs">
                                <i class="fas fa-save fa-fw"></i>
                            </button>
                        </td>
                    </tr>
                @endcan

                @foreach ($sliders as $slider)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ $slider->image }}" alt="" width="100">
                        </td>
                        <td>
                            <div class="text-center">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input" value="0" checked="">
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>

    </div>
    <x-pagination :data="$sliders" />
</div>
