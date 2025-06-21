<div>
    <div class="table-responsive text-nowrap mt-2">
        <x-filter-data />
        <table class="table align-items-center table-bordered">
            <thead class="text-sm bg-dark text-white">
                <tr class="text-nowrap">
                    <th>#</th>
                    <th>Gambar</th>
                    <th>Status</th>
                    <th>Verifikasi Tapinkab</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td>
                        <input type="file" class="form-control @error('images') is-invalid @enderror"
                            wire:model="images" id="images" multiple>
                    </td>
                    <td></td>
                    <td></td>
                    <td>
                        <button class="btn btn-primary btn-xs m-0" wire:click='store'>
                            <i class="fas fa-save fa-fw"></i>
                        </button>
                    </td>
                </tr>
                @foreach ($galeries as $galeri)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td> <img src="{{ url('storage/' . $galeri->image) }}" alt="" class="img-fluid rounded"
                                width="100"></td>
                        <td>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" value="0" checked="">
                            </div>
                        </td>
                        <td>
                            <div class="form-check form-switch">
                                <input type="checkbox"
                                    wire:blur="ubah('9a5ef7fa-b96c-4923-9247-fc84ca0e6037', 'show_disposisi_jabatan', $event.target.value)"
                                    wire:change="ubah('9a5ef7fa-b96c-4923-9247-fc84ca0e6037', 'show_disposisi_jabatan', $event.target.value)"
                                    class="form-check-input" value="0" checked="">
                            </div>
                        </td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger btn-xs m-0" data-bs-toggle="modal"
                                data-bs-target="#modelId{{ $galeri->id }}">
                                <i class="fas fa-times fa-fw"></i>
                                Hapus
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modelId{{ $galeri->id }}" tabindex="-1" role="dialog"
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
                                                <button type="button" class="btn btn-primary btn-xs m-0"
                                                    wire:click='hapus("{{ $galeri->id }}")' data-bs-dismiss="modal">
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
</div>
