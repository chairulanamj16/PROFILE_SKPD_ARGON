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
                @foreach ($galeries as $galeri)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td> <img src="{{ $galeri->image }}" alt="" width="100"></td>
                        <td>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input" value="0" checked="">
                            </div>
                        </td>
                        <td>
                            <div class="form-check form-switch">
                                <input type="checkbox" wire:blur="ubah('9a5ef7fa-b96c-4923-9247-fc84ca0e6037', 'show_disposisi_jabatan', $event.target.value)"
                                    wire:change="ubah('9a5ef7fa-b96c-4923-9247-fc84ca0e6037', 'show_disposisi_jabatan', $event.target.value)" class="form-check-input"
                                    value="0" checked="">
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>
