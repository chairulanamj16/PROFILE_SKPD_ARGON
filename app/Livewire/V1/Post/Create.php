<?php

namespace App\Livewire\V1\Post;

use App\Models\V1\Office;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\V1\Post;
use Livewire\Attributes\On;

class Create extends Component
{
    use WithFileUploads;

    public $thumbnail;
    public $title;
    public $artikel;

    protected $rules = [
        'thumbnail' => 'required|image|max:2048',
        'title' => 'required|string|max:255',
        'artikel' => 'required|string',
    ];

    public function store()
    {
        $this->validate();

        $filename = $this->thumbnail->store('thumbnails', 'public');

        Post::create([
            'office_id' => 1,
            'uuid' => Str::uuid(),
            'title' => $this->title,
            'body' => $this->artikel,
            'excercept' => Str::limit(strip_tags($this->artikel), 150),
            'thumb' => $filename,
        ]);

        $this->dispatch('reinitSummernote', $this->artikel);
        return redirect()->route('post.index');
    }

    public function render()
    {
        return view('livewire.v1.post.create');
    }
}
