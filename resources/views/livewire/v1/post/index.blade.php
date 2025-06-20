<div>
    <div class="table-responsive text-nowrap mb-3">
        <a href="{{ route('post.create', ['account' => $account]) }}" class="btn btn-primary mt-2 btn-xs">
            <i class="fas fa-plus"></i> Tambah
        </a>

        <x-filter-data />
        <table class="table align-items-center table-bordered">
            <thead class="text-sm bg-dark text-white">
                <tr class="text-nowrap">
                    <th class="text-center">#</th>
                    <th>Thumbnail</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Verifikasi Tapinkab</th>
                    <th class="text-center">Instansi</th>
                    <th class="text-center">Tanggal Publis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">
                            <img src="{{ url('storage') . '/' . $post->thumb }}" alt="" height="50"
                                class="rounded">
                        </td>
                        <td style="width: 10px; word-break: break-word;">
                            {{ $post->title }}
                        </td>
                        <td>
                            @foreach ($post->postCategories as $item)
                                <span class="badge bg-primary">
                                    {{ $item->name }}
                                </span>
                            @endforeach
                        </td>
                        <td>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" value="0" checked="">
                            </div>
                        </td>
                        <td class="text-center text-uppercase">{{ $post->office->subdomain }}</td>
                        <td class="text-center">{{ dateFormat($post->created_at) }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ route('post.edit', ['account' => $account, 'post' => $post->uuid]) }}"
                                    class="btn btn-primary btn-xs m-0">
                                    <i class="fas fa-edit fa-fw"></i>
                                </a>
                                <button class="btn btn-danger btn-xs m-0" data-bs-toggle="modal"
                                    data-bs-target="#modelIdDelete{{ $loop->iteration }}">
                                    <i class="fas fa-trash fa-fw"></i>
                                </button>
                            </div>
                            @can('delete_subdomain')
                                <!-- Modal -->
                                <div class="modal fade" id="modelIdDelete{{ $loop->iteration }}" tabindex="-1"
                                    role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <span>
                                                    Apakah anda yakin ingin menghapus data ini ?
                                                </span>
                                                <br>
                                                <br>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-xs m-0 btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Tutup
                                                    </button>
                                                    <button type="button" wire:click='hapus("{{ $post->uuid }}")'
                                                        class="btn btn-xs m-0 btn-primary" data-bs-dismiss="modal">
                                                        Hapus Data
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endcan
                        </td>
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
    {{-- <x-filter-bottom :data="$subdomain" /> --}}
    {{-- <x-pagination :data="$subdomains" /> --}}
</div>
