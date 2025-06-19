<div>
    <a href="{{ route('post.index') }}" class="btn btn-primary mt-2 btn-xs">
        <i class="fas fa-arrow-left"></i> kembali
    </a>

    <form wire:submit.prevent="store">
        @csrf

        <div class="form-group mt-3">
            <label for="post-thumbnail">Thumbnail</label>
            <input type="file" id="post-thumbnail" wire:model="thumbnail" class="form-control" accept="image/*">
            @error('thumbnail')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group mt-3">
            <label for="post-title">Judul</label>
            <input type="text" id="post-title" wire:model="title" class="form-control" placeholder="Masukkan judul postingan">
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

        <div class="d-flex justify-content-end mt-3">
            <button type="submit" class="btn btn-success btn-xs">
                <i class="fas fa-save"></i> Simpan
            </button>
        </div>
    </form>

    @push('scripts')
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
        </script>
    @endpush


</div>
