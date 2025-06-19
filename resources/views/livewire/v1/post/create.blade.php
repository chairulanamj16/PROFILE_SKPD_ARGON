@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endpush

@push('js')
    <script src="{{ url('vendors/select2') }}/select2.min.js"></script>
    <script>
        function initSummernote(content = '') {
            $('#post-artikel').summernote({
                height: 300,
                placeholder: 'Tulis konten artikel di sini...',
                callbacks: {
                    onChange: function(contents) {
                        @this.set('artikel', contents);
                    }
                }
            });

            // Jika ada isi, set ulang
            if (content) {
                $('#post-artikel').summernote('code', content);
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            initSummernote(@this.artikel ?? '');
        });

        Livewire.on('reinitSummernote', function(content = '') {
            $('#post-artikel').summernote('destroy');
            initSummernote(content);
        });

        function initSelect2() {
            // Untuk select2 Buat Baru
            $('#select2').select2({
                placeholder: 'Pilih Kategori...',
                allowClear: true,
                width: '100%',
            });

            $('#select2').on('change', function() {
                var categories = $(this).val(); // Ambil data permission yang dipilih
                @this.set('categories', categories); // Set permission ID untuk Livewire
            });

            cleanup();
        }
        initSelect2();
    </script>
@endpush

<div>
    <form wire:submit.prevent="store">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('post.index', ['account' => $account]) }}" class="btn btn-primary mt-2 btn-xs">
                            <i class="fas fa-arrow-left"></i> kembali
                        </a>
                        <div class="form-group mt-3">
                            <label for="post-title">Judul</label>
                            <input type="text" id="post-title" wire:model="title" class="form-control"
                                placeholder="Masukkan judul postingan">
                            @error('title')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div wire:ignore class="form-group mt-3">
                            <label for="post-artikel">Artikel</label>
                            <textarea wire:model="artikel" id="post-artikel" class="form-control"></textarea>
                        </div>
                        @error('artikel')
                            <small class="text-danger d-block">{{ $message }}</small>
                        @enderror



                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group" wire:ignore>
                            <label for="">Kategori</label>
                            <select class="form-control" id="select2" wire:model.live='kategori' multiple>
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="post-thumbnail">Thumbnail</label>
                            <input type="file" id="post-thumbnail" wire:model="thumbnail" class="form-control"
                                accept="image/*">
                            @error('thumbnail')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-success btn-xs">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>

</div>
