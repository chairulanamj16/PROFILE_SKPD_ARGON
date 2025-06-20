@push('css')
@endpush

@push('js')
    <script>
        function initSummernote(content = '') {
            $('#welcome_text').summernote({
                height: 300,
                placeholder: 'Tulis konten artikel di sini...',
                callbacks: {
                    onChange: function(contents) {
                        @this.set('welcome_text', contents);

                    },
                    onBlur: function(contents) {
                        // ambil isi teks saat kehilangan fokus
                        const isi = $('#welcome_text').summernote('code');
                        Livewire.dispatch('office-updated', {
                            id: '{{ $office->id }}',
                            field: 'welcome_text',
                            value: isi
                        });
                    }
                }
            });

            // Jika ada isi, set ulang
            if (content) {
                $('#welcome_text').summernote('code', content);
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            initSummernote(@this.welcome_text ?? '');
        });

        Livewire.on('reinitSummernote', function(content = '') {
            $('#welcome_text').summernote('destroy');
            initSummernote(content);
        });
    </script>
@endpush

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Edit Profile</p>
                        <button class="btn btn-primary btn-sm ms-auto">Settings</button>
                    </div>
                </div>
                <div class="card-body">
                    <p class="text-uppercase text-sm">Informasi Kantor {{ $office->name }}</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">
                                    Nama Pimpinan
                                </label>
                                <input class="form-control" type="text" wire:model.live='leader_name'
                                    wire:focusout="ubah('{{ $office->id }}', 'leader_name', $event.target.value)">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Jabatan</label>
                                <input class="form-control" type="text" wire:model.live='leader_position'
                                    wire:focusout="ubah('{{ $office->id }}', 'leader_position', $event.target.value)">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Gambar Pimpinan</label>
                                <br>
                                <div class="input-group">
                                    {{-- <input class="form-control" type="file" wire:model='image'> --}}
                                    <input type="file"
                                        class="form-control @error('leaderImage') is-invalid @enderror {{ $leaderImage ? 'is-valid' : '' }}"
                                        wire:model='leaderImage'>
                                    <button class="btn btn-primary btn-xs m-0"
                                        wire:click="ubah('{{ $office->id }}', 'leader_image', $event.target.value)">

                                        <i class="fas fa-save fa-fw"></i>
                                    </button>
                                </div>
                                @error('leaderImage')
                                    <span>{{ $message }}</span>
                                @enderror
                                <span wire:loading wire:target="leaderImage" class="text-xs">
                                    Mengunggah gambar...
                                </span>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" wire:ignore>
                                <label for="example-text-input" class="form-control-label">Sambutan Pimpinan</label>
                                <textarea wire:model="welcome_text" id="welcome_text" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                    <p class="text-uppercase text-sm">Contact Information</p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Address</label>
                                <input class="form-control" type="text"
                                    value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09" onfocus="focused(this)"
                                    onfocusout="defocused(this)">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">City</label>
                                <input class="form-control" type="text" value="New York" onfocus="focused(this)"
                                    onfocusout="defocused(this)">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Country</label>
                                <input class="form-control" type="text" value="United States" onfocus="focused(this)"
                                    onfocusout="defocused(this)">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Postal code</label>
                                <input class="form-control" type="text" value="437300" onfocus="focused(this)"
                                    onfocusout="defocused(this)">
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                    <p class="text-uppercase text-sm">About me</p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">About me</label>
                                <input class="form-control" type="text"
                                    value="A beautiful Dashboard for Bootstrap 5. It is Free and Open Source."
                                    onfocus="focused(this)" onfocusout="defocused(this)">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-profile">
                <img src="../assets/img/bg-profile.jpg" alt="Image placeholder" class="card-img-top">
                <div class="row justify-content-center">
                    <div class="col-4 col-lg-4 order-lg-2">
                        <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                            <a href="javascript:;">
                                <img src="{{ url('storage') . '/' . $office->leader_image }}" class="img-fluid ">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
                    <div class="d-flex justify-content-between">
                        <a href="javascript:;" class="btn btn-sm btn-info mb-0 d-none d-lg-block">Connect</a>
                        <a href="javascript:;" class="btn btn-sm btn-info mb-0 d-block d-lg-none"><i
                                class="ni ni-collection"></i></a>
                        <a href="javascript:;"
                            class="btn btn-sm btn-dark float-right mb-0 d-none d-lg-block">Message</a>
                        <a href="javascript:;" class="btn btn-sm btn-dark float-right mb-0 d-block d-lg-none"><i
                                class="ni ni-email-83"></i></a>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col">
                            <div class="d-flex justify-content-center">
                                <div class="d-grid text-center">
                                    <span class="text-lg font-weight-bolder">22</span>
                                    <span class="text-sm opacity-8">Friends</span>
                                </div>
                                <div class="d-grid text-center mx-4">
                                    <span class="text-lg font-weight-bolder">10</span>
                                    <span class="text-sm opacity-8">Photos</span>
                                </div>
                                <div class="d-grid text-center">
                                    <span class="text-lg font-weight-bolder">89</span>
                                    <span class="text-sm opacity-8">Comments</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <h5>
                            Mark Davis<span class="font-weight-light">, 35</span>
                        </h5>
                        <div class="h6 font-weight-300">
                            <i class="ni location_pin mr-2"></i>Bucharest, Romania
                        </div>
                        <div class="h6 mt-4">
                            <i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer
                        </div>
                        <div>
                            <i class="ni education_hat mr-2"></i>University of Computer Science
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer pt-3  ">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="copyright text-center text-sm text-muted text-lg-start">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>2025,
                        made with <i class="fa fa-heart"></i> by
                        <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative
                            Tim</a>
                        for a better web.
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com" class="nav-link text-muted"
                                target="_blank">Creative Tim</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted"
                                target="_blank">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/blog" class="nav-link text-muted"
                                target="_blank">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                                target="_blank">License</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>
