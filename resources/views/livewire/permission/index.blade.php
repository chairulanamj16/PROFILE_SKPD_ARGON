<div class="container-xxl flex-grow-1 container-p-y">
    @can('create_permissions')
        <!-- Button to trigger modal -->
        <button type="button" id="add_permission" class="btn btn-success mb-3" data-bs-toggle="modal"
            data-bs-target="#permissionModal">
            Add Permission
        </button>

        <!-- Modal -->
        <div wire:ignore.self class="modal fade" id="permissionModal" tabindex="-1" aria-labelledby="permissionModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="permissionModalLabel">Add Permission</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="permissionId">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" wire:model="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-xs btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" wire:click='store' data-bs-dismiss="modal"
                            class="btn btn-xs btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    @endcan

    <!-- Card Border Shadow -->
    <div class="card">
        <div class="card-header pb-0">
            <h6>Permissions</h6>
        </div>
        <div class="card-body table-responsive">
            <x-filter-data></x-filter-data>
            <table class="table table-sm align-items-center table-bordered">
                <thead class="bg-dark text-white text-sm">
                    <tr>
                        <th class="text-center">No</th>
                        <th>Name</th>
                        <th style="width:20%;" class="text-center">
                            <i class="fas fa-cog fa-fw"></i>
                        </th>
                    </tr>
                </thead>
                <tbody class="text-xs text-secondary">
                    @foreach ($permissions as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                @can('edit_permissions')
                                    <input type="text" class="form-control form-control-table"
                                        wire:blur="update('{{ $item->id }}', 'name', $event.target.value)"
                                        value="{{ $item->name }}">
                                @elsecan('view_permissions')
                                    {{ $item->name }}
                                @endcan
                            </td>
                            <td class="text-center">
                                <button onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');"
                                    wire:click='destroy({{ $item->id }})'
                                    class="btn btn-danger delete-permission btn-xs">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <x-pagination :data="$permissions"></x-pagination>
        </div>
    </div>

</div>
