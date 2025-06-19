@push(Route::currentRouteName())
    <script>
        Livewire.on('subdomainStore', () => {

            $('#subdomainCreate').modal('hide');
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data subdomain berhasil disimpan!',
                timer: 2000,
                showConfirmButton: false,
                position: 'top'
            });
            Livewire.dispatch('refreshTable');

        });
    </script>
@endpush
