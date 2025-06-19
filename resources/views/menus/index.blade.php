@extends('layouts.app2')

@section('content')
    @livewire('menu')
    {{-- <div class="container-xxl flex-grow-1 container-p-y">
        @can('create_menus')
            <button type="button" id="add_menu" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#menuModal">
                Add Menu
            </button>
        @endcan

        <div class="card">
            <div class="card-header pb-0">
                <h6>Menus</h6>
            </div>
            <div class="card-body table-responsive">
                <table class="table align-items-center mb-0" id="menus-table">
                    <thead class="text-xs text-secondary">
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Subdomain</th>
                            <th>Icon</th>
                            <th>Order</th>
                            <th>Parent Menu</th>
                            <th style="width:20%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs text-secondary">
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}

    {{-- @include('menus.popup_form') --}}
@endsection

@include('component.toast')
@include('component.confirmation_delete')

@section('js')
    <script>
        $(document).ready(function() {
            var table = $('#menus-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('menus.gridview') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    }
                },
                columns: [{
                        target: 0,
                        data: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'subdomain',
                        name: 'subdomain'
                    },
                    {
                        data: 'icon',
                        name: 'icon',
                        render: function(data) {
                            return '<i class="ni ' + data +
                                ' text-primary text-sm opacity-10"></i>';
                        }
                    },
                    {
                        data: 'order',
                        name: 'order'
                    },
                    {
                        data: 'parent_name',
                        name: 'parent_name'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            var actions = row.actions;
                            return actions;
                        }
                    }
                ],
                language: {
                    lengthMenu: '<span class="text-xs">Show</span> <select class="custom-select custom-select-sm form-control form-control-sm">' +
                        '<option value="10" class="text-xs">10</option>' +
                        '<option value="25" class="text-xs">25</option>' +
                        '<option value="50" class="text-xs">50</option>' +
                        '<option value="100" class="text-xs">100</option>' +
                        '</select> <span class="text-xs">entries</span>',
                    zeroRecords: '<span class="text-xs">No matching records found</span>',
                    info: '<span class="text-xs">Showing _START_ to _END_ of _TOTAL_ entries</span>',
                    infoEmpty: '<span class="text-xs">Showing 0 to 0 of 0 entries</span>',
                    infoFiltered: '<span class="text-xs">(filtered from _MAX_ total entries)</span>',
                    paginate: {
                        previous: '<span class="text-xxs"><</span>',
                        next: '<span class="text-xxs">></span>'
                    }
                },
                fnDrawCallback: function() {
                    $('.dataTables_paginate .paginate_button').addClass('text-xs');
                    $('.dataTables_length label').addClass('text-xs');
                    $('.dataTables_filter label').addClass('text-xs');
                    $('.dataTables_info').addClass('text-xs');
                }
            });

            $('#menus-table').on('click', '.btn-warning', function() {
                var data = table.row($(this).parents('tr')).data();
                $('#menuModalLabel').text('Edit Menu');
                $('#menuId').val(data.id);
                $('#name').val(data.name);
                $('#subdomain').val(data.subdomain);
                $('#icon').val(data.icon);
                $('#order').val(data.order);
                $('#parent_id').val(data.parent_id);
                $('#menuModal').modal('show');
                $('#parent_id_hidden').val(data.parent_id)
                fetchMenus();
            });

            $('#add_menu').on('click', function() {
                fetchMenus();
            });

            $('#menuForm').on('submit', function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    url: '{{ route('menus.store') }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        $('#menuModal').modal('hide');
                        table.ajax.reload();
                        showToast(response.status.toUpperCase(), response.message, response
                            .status)
                    },
                    error: function(response) {
                        Object.keys(xhr.responseJSON.errors).forEach(function(key) {
                            var messages = xhr.responseJSON.errors[key];
                            messages.forEach(function(message) {
                                showToast('Error!', message, 'error');
                            });
                        });
                    }
                });
            });

            $('#menus-table').on('click', '.delete-menu', function(e) {
                e.preventDefault();

                var menuId = $(this).data('id');
                showDeleteModal("{{ route('menus.destroy', ':id') }}".replace(':id', menuId));
            });

            // Event ketika modal ditutup, reset form dan label modal
            $('#menuModal').on('hidden.bs.modal', function() {
                $('#menuForm')[0].reset();
                $('#menuModalLabel').text('Add Menu');
                $('#menuId').val('');
            });

            $('.modal').on('hidden.bs.modal', function() {
                table.ajax.reload();
            });

            // Fungsi untuk mengambil data parent menu dari server
            function fetchMenus() {
                $.ajax({
                    url: '{{ route('menus.index') }}',
                    method: 'GET',
                    success: function(data) {
                        $('#parent_id').empty().append('<option value="">None</option>');
                        $.each(data.menus, function(key, menu) {
                            // Tambahkan opsi untuk setiap parent menu
                            if ($('#parent_id_hidden').val() == menu.id) {
                                $('#parent_id').append('<option selected value="' + menu.id +
                                    '">' + menu.name + '</option>');
                            } else {
                                $('#parent_id').append('<option value="' + menu.id + '">' + menu
                                    .name + '</option>');
                            }
                        });

                        // Set nilai parent_id dari data yang diterima
                        var parent_id = $('#parent_id').data('selected');
                        if (parent_id) {
                            $('#parent_id').val(parent_id);
                        }
                    }
                });
            }
        });
    </script>
@endsection
