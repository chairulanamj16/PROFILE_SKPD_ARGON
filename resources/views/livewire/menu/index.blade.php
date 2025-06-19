<div>
    @can('create_menus')
        <button type="button" id="add_menu" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#menuModal">
            Add Menu
        </button>
        <!-- Modal -->
        <div class="modal fade" id="menuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="menuModalLabel">Add Menu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="menuId">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" wire:model="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="subdomain" class="form-label">Subdomain</label>
                            <input type="text" class="form-control" wire:model="subdomain">
                        </div>
                        <div class="mb-3">
                            <label for="icon" class="form-label">Icon</label>
                            <input type="text" class="form-control" wire:model="icon">
                        </div>
                        <div class="mb-3">
                            <label for="order" class="form-label">Order</label>
                            <input type="number" class="form-control" wire:model="order" value="0">
                        </div>
                        <div class="mb-3">
                            <label for="parent_id" class="form-label">Parent Menu</label>
                            <input type="hidden" id="parent_id_hidden">
                            <select class="form-select" wire:model="parent_id">
                                <option value="">None</option>
                                @foreach ($form_parent as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-xs btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button data-bs-dismiss="modal" wire:click='store' class="btn btn-xs btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    @endcan

    <div class="card">
        <div class="card-header pb-0">
            <h6>Menus</h6>
        </div>
        <div class="card-body table-responsive">
            <x-filter-data></x-filter-data>
            <table class="table align-items-center table-bordered">
                <thead class="text-sm bg-dark text-white">
                    <tr>
                        <th class="text-center">No</th>
                        <th>Name</th>
                        <th>Subdomain</th>
                        <th>Icon</th>
                        <th>Order</th>
                        <th>Parent Menu</th>
                        <th style="width:20%;" class="text-center">
                            <i class="fas fa-cog fa-fw"></i>
                        </th>
                    </tr>
                </thead>
                <tbody class="text-xs text-secondary">
                    @foreach ($menus as $item)
                        <tr class="{{ $item->parent_id == null ? 'bg-primary text-white' : '' }}">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                @can('edit_menus')
                                    <input type="text" class="form-control form-control-table text-white bg-transparent"
                                        wire:blur="update('{{ $item->id }}', 'name', $event.target.value)"
                                        value="{{ $item->name }}">
                                @elsecan('view_menus')
                                    {{ $item->name }}
                                @endcan

                            </td>
                            <td>
                                @can('edit_menus')
                                    <input type="text" class="form-control form-control-table text-white bg-transparent"
                                        wire:blur="update('{{ $item->id }}', 'subdomain', $event.target.value)"
                                        value="{{ $item->subdomain }}">
                                @elsecan('view_menus')
                                    {{ $item->subdomain }}
                                @endcan
                            </td>
                            <td>
                                @can('edit_menus')
                                    <div class="input-group">
                                        <span class="input-group-text bg-transparent border-0 " id="basic-addon1">
                                            <i class="fas {{ $item->icon }} fa-fw text-white text-sm opacity-10"></i>
                                        </span>
                                        <input type="text"
                                            class="form-control form-control-table text-white bg-transparent"
                                            wire:blur="update('{{ $item->id }}', 'icon', $event.target.value)"
                                            value="{{ $item->icon }}">
                                    </div>
                                @elsecan('view_menus')
                                    <i class="fas {{ $item->icon }} text-primary fa-fw text-sm opacity-10"></i>
                                @endcan
                            </td>
                            <td>
                                @can('edit_menus')
                                    <input type="text" class="form-control form-control-table text-white bg-transparent"
                                        wire:blur="update('{{ $item->id }}', 'order', $event.target.value)"
                                        value="{{ $item->order }}">
                                @elsecan('view_menus')
                                    {{ $item->order }}
                                @endcan

                            </td>
                            <td>
                                @can('edit_menus')
                                    <select type="text" class="form-control form-control-table text-white bg-transparent"
                                        wire:blur="update('{{ $item->id }}', 'parent_id', $event.target.value)">
                                        <option value="">None</option>
                                        @foreach ($form_parent as $form_par)
                                            <option {{ $item->parent_id == $form_par->id ? 'selected' : '' }}
                                                value="{{ $form_par->id }}">{{ $form_par->name }}</option>
                                        @endforeach
                                    </select>
                                @elsecan('view_menus')
                                    {{ $item->parent ? $item->parent->name : 'None' }}
                                @endcan

                            </td>
                            <td class="text-center">
                                <button wire:dblclick='destroy("{{ $item->id }}")'
                                    class="btn btn-danger btn-xs delete-menu">Delete</button>
                            </td>
                        </tr>
                        @foreach ($item->children as $child)
                            <tr>
                                <td class="text-end">
                                    <i class="ni ni-bold-right"></i>
                                </td>
                                <td>
                                    @can('edit_menus')
                                        <input type="text" class="form-control form-control-table"
                                            wire:blur="update('{{ $child->id }}', 'name', $event.target.value)"
                                            value="{{ $child->name }}">
                                    @elsecan('view_menus')
                                        {{ $child->name }}
                                    @endcan

                                </td>
                                <td>
                                    @can('edit_menus')
                                        <input type="text" class="form-control form-control-table"
                                            wire:blur="update('{{ $child->id }}', 'subdomain', $event.target.value)"
                                            value="{{ $child->subdomain }}">
                                    @elsecan('view_menus')
                                        {{ $child->subdomain }}
                                    @endcan
                                </td>
                                <td>
                                    @can('edit_menus')
                                        <div class="input-group">
                                            <span class="input-group-text border-0" id="basic-addon1">
                                                <i
                                                    class="fas {{ $child->icon }} fa-fw text-primary text-sm opacity-10"></i>
                                            </span>
                                            <input type="text" class="form-control form-control-table"
                                                wire:blur="update('{{ $child->id }}', 'icon', $event.target.value)"
                                                value="{{ $child->icon }}">
                                        </div>
                                    @elsecan('view_menus')
                                        <i class="fas {{ $child->icon }} fa-fw text-primary text-sm opacity-10"></i>
                                    @endcan
                                </td>
                                <td>
                                    @can('edit_menus')
                                        <input type="text" class="form-control form-control-table"
                                            wire:blur="update('{{ $child->id }}', 'order', $event.target.value)"
                                            value="{{ $child->order }}">
                                    @elsecan('view_menus')
                                        {{ $child->order }}
                                    @endcan

                                </td>
                                <td>
                                    @can('edit_menus')
                                        <select type="text" class="form-control form-control-table"
                                            wire:blur="update('{{ $child->id }}', 'parent_id', $event.target.value)">
                                            <option value="">None</option>
                                            @foreach ($form_parent as $form_par)
                                                <option {{ $child->parent_id == $form_par->id ? 'selected' : '' }}
                                                    value="{{ $form_par->id }}">{{ $form_par->name }}</option>
                                            @endforeach
                                        </select>
                                    @elsecan('view_menus')
                                        {{ $child->parent ? $child->parent->name : 'None' }}
                                    @endcan

                                </td>
                                <td class="text-center">
                                    <button wire:dblclick='destroy("{{ $child->id }}")'
                                        class="btn btn-danger btn-xs delete-menu">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
