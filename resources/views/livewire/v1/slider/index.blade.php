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
                        <td></td>
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
                {{-- @foreach ($subdomains as $subdomain)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @can('edit_subdomain')
                                @if ($editFieldRowId == $subdomain->id . '-name')
                                    <div class="input-group">
                                        <input wire:blur="ubah('{{ $subdomain->id }}', 'name', $event.target.value)"
                                            wire:keydown.enter="ubah('{{ $subdomain->id }}', 'name', $event.target.value)" class="form-control form-control-table"
                                            value="{{ $subdomain->name }}" />
                                    </div>
                                @else
                                    <span wire:click="editRow('{{ $subdomain->id . '-name' }}')">
                                        {{ $subdomain->name }}
                                    </span>
                                @endif
                            @endcan
                        </td>
                        <td>
                            @can('edit_subdomain')
                                @if ($editFieldRowId == $subdomain->id . '-subdomain')
                                    <div class="input-group">
                                        <input wire:blur="ubah('{{ $subdomain->id }}', 'subdomain', $event.target.value)"
                                            wire:keydown.enter="ubah('{{ $subdomain->id }}', 'subdomain', $event.target.value)" class="form-control form-control-table"
                                            value="{{ $subdomain->subdomain }}" />
                                    </div>
                                @else
                                    <span wire:click="editRow('{{ $subdomain->id . '-subdomain' }}')">
                                        {{ $subdomain->subdomain }}
                                    </span>
                                @endif
                            @endcan

                        </td>
                        <td>
                            <a href="https://{{ $subdomain->subdomain . '.profile.' . env('APP_URL') }}"
                                target="_blank">https://{{ $subdomain->subdomain . '.profile.' . env('APP_URL') }}</a>
                        </td>
                        <td class="text-center">
                            @can('delete_subdomain')
                                <button class="btn btn-danger btn-xs m-0" data-bs-toggle="modal" data-bs-target="#modelIdDelete{{ $loop->iteration }}">
                                    <i class="fas fa-trash fa-fw"></i>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="modelIdDelete{{ $loop->iteration }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus data ini ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Tutup
                                                </button>
                                                <button type="button" class="btn btn-primary">
                                                    Hapus Data
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endcan
                        </td>
                    </tr>
                @endforeach --}}
            </tbody>

        </table>

    </div>
    {{-- <x-pagination :data="$subdomains" /> --}}
</div>
