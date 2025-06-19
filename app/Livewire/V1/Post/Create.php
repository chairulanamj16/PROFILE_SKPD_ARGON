<?php

namespace App\Livewire\V1\Post;

use App\Models\V1\Office;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use App\Models\V1\Post;
use App\Models\V1\PostCategory;
use Livewire\Attributes\On;

class Create extends Component
{
    use WithFileUploads;

    public $thumbnail;
    public $title;
    public $artikel;
    public $categories;
    public $account;

    protected $rules = [
        'thumbnail' => 'required|image|max:2048',
        'title' => 'required|string|max:255',
        'artikel' => 'required|string',
    ];

    public function mount($account)
    {
        $this->account = $account;
    }

    public function render()
    {
        $data['kategori'] = PostCategory::all();
        return view('livewire.v1.post.create', $data);
    }

    public function store()
    {
        $this->validate();

        $filename = $this->thumbnail->store('thumbnails', 'public');

        $post = Post::create([
            'office_id' => 1,
            'uuid' => Str::uuid(),
            'title' => $this->title,
            'body' => $this->artikel,
            'excercept' => Str::limit(strip_tags($this->artikel), 150),
            'thumb' => $filename,
        ]);
        $post->postCategories()->attach($this->categories);

        $this->dispatch('reinitSummernote', $this->artikel);
        return redirect()->route('post.index');
    }
}
