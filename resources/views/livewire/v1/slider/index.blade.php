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
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @can('create_subdomain')
                    <tr>
                        <td></td>
                        <td class="{{ $image != null ? 'bg-success' : '' }}">
                            <input type="file" class="form-control-table @error('image') is-invalid @enderror"
                                wire:model.live='image'>
                        </td>
                        <td>
                            <label for="is_active">
                                <input type="checkbox" id="is_active" wire:model.live='is_active' value="1"
                                    class="form-control-table @error('subdomain') is-invalid @enderror">
                                Aktif
                            </label>
                        </td>
                        <td class="text-center">
                            <button wire:click="simpan" class="btn btn-primary btn-xs m-0">
                                <i class="fas fa-save fa-fw"></i>
                            </button>
                        </td>
                    </tr>
                @endcan

                @foreach ($sliders as $slider)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ url('storage') . '/' . $slider->image }}" alt="" height="50">
                        </td>
                        <td>
                            <div class="text-center">
                                <div class="form-check form-switch">
                                    <input type="checkbox" class="form-check-input"
                                        value="{{ $slider->is_active ? '0' : '1' }}"
                                        wire:change="ubah('{{ $slider->id }}', 'is_active', $event.target.value)"
                                        {{ $slider->is_active ? 'checked' : '' }}>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger btn-xs m-0" data-bs-toggle="modal"
                                data-bs-target="#modelId{{ $slider->id }}">
                                Hapus
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modelId{{ $slider->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            Apakah anda yakin ingin menghapus data ini ?
                                        </div>
                                        <div class="modal-footer">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-secondary btn-xs m-0"
                                                    data-bs-dismiss="modal">
                                                    Tutup
                                                </button>
                                                <button type="button" class="btn btn-danger btn-xs m-0"
                                                    wire:click='hapus("{{ $slider->id }}")' data-bs-dismiss="modal">
                                                    <i class="fas fa-trash fa-fw"></i>
                                                    Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </div>
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
