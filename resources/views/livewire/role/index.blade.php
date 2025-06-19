<div>
    @can('create_roles')
        <!-- Button to trigger modal -->
        <button type="button" id="add_role" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#roleModal">
            Add Role
        </button>

        <!-- Modal -->
        <div wire:ignore class="modal fade" id="roleModal" tabindex="-1" aria-labelledby="roleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="roleModalLabel">Add Role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="id" id="roleId">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" wire:model="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="permissions" class="form-label">Permissions</label>
                            <select class="form-control" id="select2-add" wire:modal="permissions" multiple>
                                @foreach ($permissions_data as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-xs btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" wire:click='store' class="btn btn-xs btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    @endcan

    <!-- Card Border Shadow -->
    <div class="card">
        <div class="card-header pb-0">
            <h6>Roles</h6>
        </div>
        <div class="card-body table-responsive">
            <x-filter-data></x-filter-data>
            <table class="table align-items-center table-bordered">
                <thead class="text-sm bg-dark text-white">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th style="width: 30%;">Permissions</th>
                        <th style="width: 30%;" class="text-center">
                            <i class="fas fa-edit fa-fw"></i> Permission
                        </th>
                        <th style="width:20%;" class="text-center">
                            <i class="fas fa-cog fa-fw"></i>
                        </th>
                    </tr>
                </thead>
                <tbody class="text-xs">
                    @foreach ($roles as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <div style="white-space: normal;word-wrap: break-word;max-width: 400px;">
                                    {{-- {{ $item->permissions->pluck('name')->implode(',') }} --}}
                                    @foreach ($item->permissions as $it)
                                        <span class="badge bg-primary mb-1">
                                            {{ $it->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="text-center">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary btn-xs" data-bs-toggle="modal"
                                    data-bs-target="#modelId{{ $item->id }}">
                                    <i class="fas fa-edit fa-fw"></i>
                                    Edit
                                </button>

                                <!-- Modal -->
                                <div wire:ignore class="modal fade" id="modelId{{ $item->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div>
                                                    <div wire:ignore>
                                                        <select class="form-control select2"
                                                            wire:change="savePermissions('{{ $item->id }}', $event.target.value)"
                                                            wire:blur="savePermissions('{{ $item->id }}', $event.target.value)"
                                                            data-role-id="{{ $item->id }}" multiple>
                                                            <option value="">Select Permission</option>
                                                            @foreach ($permissions_data as $permission)
                                                                <option value="{{ $permission->id }}"
                                                                    @if (in_array($permission->id, $item->permissions->pluck('id')->toArray())) selected @endif>
                                                                    {{ $permission->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <button wire:dblclick='destroy("{{ $item->id }}")'
                                    class="btn btn-xs btn-danger delete-role">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <x-pagination :data="$roles"></x-pagination>
        </div>
    </div>
</div>
</div>

@push('css')
    <link href="{{ url('vendors/select2') }}/select2.min.css" rel="stylesheet" />
@endpush

@push('js')
    <script src="{{ url('vendors/select2') }}/select2.min.js"></script>
    <script>
        // Inisialisasi Select2 setelah Livewire selesai memuat halaman
        initSelect2();

        function initSelect2() {
            // Untuk select2 Edit
            $('.select2').select2({
                allowClear: true,
                width: '100%',
            });
            // Untuk select2 Buat Baru
            $('#select2-add').select2({
                allowClear: true,
                width: '100%',
            });

            $('.select2').on('change', function() {
                var roleId = $(this).data('role-id');
                var permissionId = $(this).val(); // Ambil data permission yang dipilih
                @this.set('roleId', roleId); // Set role ID untuk Livewire
                @this.set('update_permissions', permissionId); // Set permission ID untuk Livewire
            });

            $('#select2-add').on('change', function() {
                var permissionId = $(this).val(); // Ambil data permission yang dipilih
                @this.set('permissions', permissionId); // Set permission ID untuk Livewire
            });

            cleanup();
        }
    </script>
@endpush
