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
                                    <input type="file"
                                        class="form-control @error('leaderImage') is-invalid @enderror {{ $leaderImage ? 'is-valid' : '' }}"
                                        wire:model='leaderImage'>
                                    <button class="btn btn-primary btn-xs m-0"
                                        wire:click="ubah('{{ $office->id }}', 'leader_image', $event.target.value)">
                                        Simpan
                                    </button>
                                </div>
                                @error('leaderImage')
                                    <span>{{ $message }}</span>
                                @enderror


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
                    <p class="text-uppercase text-sm">Informasi Kontak</p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Alamat Kantor</label>
                                <textarea class="form-control" type="text" wire:model.live='address'
                                    wire:focusout="ubah('{{ $office->id }}', 'address', $event.target.value)"></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Telpon Kantor</label>
                                <input class="form-control" type="tel" wire:model.live='phone'
                                    wire:focusout="ubah('{{ $office->id }}', 'phone', $event.target.value)">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Email Kantor</label>
                                <input class="form-control" type="email" wire:model.live='email'
                                    wire:focusout="ubah('{{ $office->id }}', 'email', $event.target.value)">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Logo Kantor</label>
                                <div class="input-group">
                                    <input
                                        class="form-control  @error('logo') is-invalid @enderror {{ $logo ? 'is-valid' : '' }}"
                                        type="file" wire:model.live='logo'>
                                    <button class="btn btn-dark btn-xs m-0"
                                        wire:click="ubah('{{ $office->id }}', 'logo', $event.target.value)">
                                        Simpan
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center">
                                @if ($office->logo)
                                    <img src="{{ url('storage/' . $office->logo) }}" class="img-fluid" alt="">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Maps</label>
                                <div class="input-group">
                                    <textarea class="form-control" wire:model.live='map'
                                        wire:focusout="ubah('{{ $office->id }}', 'map', $event.target.value)" rows="5"></textarea>
                                    <button class="btn btn-primary btn-xs m-0" data-bs-toggle="modal"
                                        data-bs-target="#modelIdMap">
                                        <i class="fas fa-info fa-fw"></i>
                                    </button>
                                </div>
                                <div class="modal fade" id="modelIdMap" tabindex="-1" role="dialog"
                                    aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <ol>
                                                    <li>
                                                        <strong>Klik Tombol Bagikan</strong>
                                                        <img src="{{ url('assets/tutorial/map-share.PNG') }}"
                                                            class="img-fluid" alt="">
                                                    </li>
                                                    <li class="mt-4">
                                                        <strong>Pilih <u>Sematkan Peta</u>, Lalu <u>Salin HTML
                                                                iframe</u></strong>
                                                        <img src="{{ url('assets/tutorial/map-link.PNG') }}"
                                                            class="img-fluid" alt="">
                                                    </li>
                                                    <li class="mt-4">
                                                        <strong>Paste Link HTML ke Inputan, Seperti gambar di bawah
                                                            ini:</strong>
                                                        <img src="{{ url('assets/tutorial/map-paste.PNG') }}"
                                                            class="img-fluid" alt="">
                                                    </li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="horizontal dark">
                    <p class="text-uppercase text-sm">Sosial Media</p>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Facebook</label>
                                <input class="form-control" type="text" wire:model.live='facebook'
                                    wire:focusout="ubah('{{ $office->id }}', 'facebook', $event.target.value)">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Instagram</label>
                                <input class="form-control" type="text" wire:model.live='instagram'
                                    wire:focusout="ubah('{{ $office->id }}', 'instagram', $event.target.value)">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Youtube</label>
                                <input class="form-control" type="text" wire:model.live='youtube'
                                    wire:focusout="ubah('{{ $office->id }}', 'youtube', $event.target.value)">
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
                    <div class="col-4 col-lg-4 order-lg-2" style="position: relative">
                        <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                            <a href="javascript:;">
                                <img src="{{ url('storage') . '/' . $office->leader_image }}" class="img-fluid ">
                                <div style="position: absolute;bottom:0px;padding:0px 10px;border-radius:50px;"
                                    class="bg-primary text-white w-100 text-center">
                                    <small>
                                        <strong>
                                            {{ $office->leader_name }}
                                        </strong>
                                    </small>
                                    <small>
                                        {{ $office->leader_position }}
                                    </small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body pt-0">

                </div>
            </div>
        </div>
    </div>

</div>
