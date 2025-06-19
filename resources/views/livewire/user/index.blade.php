<div>
    @can('create_users')
        <!-- Tombol untuk memicu modal -->
        <button type="button" id="add_user" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#userModal">
            Add User
        </button>

        <!-- Modal -->
        <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="userForm">
                        <div class="modal-header">
                            <h5 class="modal-title" id="userModalLabel">Add User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @csrf
                            <input type="hidden" name="id" id="userId">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                            <div class="mb-3">
                                <label for="roles" class="form-label">Roles</label>
                                <select class="form-select">
                                    <option value="">None</option>
                                    @foreach ($roles as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-xs btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-xs btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan

    <!-- Card Border Shadow -->
    <div class="card">
        <div class="card-header pb-0">
            <h6>Users</h6>
        </div>
        <div class="card-body table-responsive">
            <x-filter-data></x-filter-data>
            <table class="table align-items-center table-bordered">
                <thead class="text-sm bg-dark text-white">
                    <tr>
                        <th class="text-center">No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th style="width:20%;" class="text-center">
                            <i class="fas fa-cog fa-fw"></i>
                        </th>
                    </tr>
                </thead>
                <tbody class="text-xs">
                    @foreach ($users as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->roles->pluck('name')->implode(', ') }}</td>
                            <td class="text-center">
                                <button class="btn btn-xs btn-danger">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <x-pagination :data="$users"></x-pagination>
        </div>
    </div>
</div>
