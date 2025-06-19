<div>
    <div class="table-responsive text-nowrap mt-2">

        <x-filter-data>

        </x-filter-data>
        <table class="table align-items-center table-bordered">
            <thead class="text-sm bg-dark text-white">
                <tr class="text-nowrap">
                    <th>
                        #
                    </th>
                    <th wire:click="sortBy('name')" style="cursor:pointer">
                        Nama
                    </th>
                    <th wire:click="sortBy('subdomain')" style="cursor: pointer">
                        Subdomain
                    </th>

                    <th>Tautan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @can('create_subdomain')
                    <tr>
                        <td></td>
                        <td class="{{ $nama != '' ? 'bg-success' : '' }}">
                            <input wire:model.live='nama' type="text"
                                class="form-control form-control-table
                                @error('nama') is-invalid @enderror"
                                placeholder="Tulis nama skpd di sini">
                            @error('nama')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td class="{{ $subdomain != '' ? 'bg-success' : '' }}">
                            <input wire:model.live='subdomain' type="text"
                                class="form-control form-control-table
                                @error('subdomain') is-invalid @enderror"
                                placeholder="tulis subdomain di sini">
                            @error('subdomain')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                        <td>
                            https://{{ $subdomain . '.profile.' . env('APP_URL') }}
                        </td>
                        <td class="text-center">
                            <button wire:click="store" class="btn btn-primary btn-xs">
                                <i class="fas fa-save fa-fw"></i>
                            </button>
                        </td>
                    </tr>
                @endcan
                @foreach ($subdomains as $subdomain)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            @can('update_subdomain')
                                @if ($editFieldRowId == $subdomain->id . '-name')
                                    <div class="input-group">
                                        <input wire:blur="ubah('{{ $subdomain->id }}', 'name', $event.target.value)"
                                            wire:keydown.enter="ubah('{{ $subdomain->id }}', 'name', $event.target.value)"
                                            class="form-control form-control-table" value="{{ $subdomain->name }}" />
                                    </div>
                                @else
                                    <span wire:click="editRow('{{ $subdomain->id . '-name' }}')">
                                        {{ $subdomain->name }}
                                    </span>
                                @endif
                            @else
                                {{ $subdomain->name }}
                            @endcan
                        </td>
                        <td>
                            @can('update_subdomain')
                                @if ($editFieldRowId == $subdomain->id . '-subdomain')
                                    <div class="input-group">
                                        <input wire:blur="ubah('{{ $subdomain->id }}', 'subdomain', $event.target.value)"
                                            wire:keydown.enter="ubah('{{ $subdomain->id }}', 'subdomain', $event.target.value)"
                                            class="form-control form-control-table" value="{{ $subdomain->subdomain }}" />
                                    </div>
                                @else
                                    <span wire:click="editRow('{{ $subdomain->id . '-subdomain' }}')">
                                        {{ $subdomain->subdomain }}
                                    </span>
                                @endif
                            @else
                                {{ $subdomain->subdomain }}
                            @endcan

                        </td>
                        <td>
                            <a href="https://{{ $subdomain->subdomain . '.profile.' . env('APP_URL') }}"
                                target="_blank">https://{{ $subdomain->subdomain . '.profile.' . env('APP_URL') }}</a>
                        </td>
                        <td class="text-center">
                            @can('delete_subdomain')
                                <button class="btn btn-danger btn-xs m-0" data-bs-toggle="modal"
                                    data-bs-target="#modelIdDelete{{ $loop->iteration }}">
                                    <i class="fas fa-trash fa-fw"></i>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="modelIdDelete{{ $loop->iteration }}" tabindex="-1"
                                    role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
                @endforeach
            </tbody>

        </table>

    </div>
    {{-- <x-filter-bottom :data="$subdomain" /> --}}
    <x-pagination :data="$subdomains" />
</div>
