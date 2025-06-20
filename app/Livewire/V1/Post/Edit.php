<?php

namespace App\Livewire\V1\Post;

use App\Models\V1\Post;
use App\Models\V1\PostCategory;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    public $post, $account;

    public $thumbnail;
    public $title;
    public $artikel;
    public $categories;

    protected $rules = [
        'thumbnail' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:5048',
        'title' => 'required|string|max:255',
        'artikel' => 'required',
    ];

    public function mount($account, $post)
    {
        $this->post = $post;
        $this->account = $account;
        $this->title = $post->title;
        $this->artikel = $post->body;
        $this->categories = $post->postCategories->pluck('id')->toArray();
    }

    public function render()
    {
        $data['kategori'] = PostCategory::all();
        return view('livewire.v1.post.edit', $data);
    }


    public function store()
    {
        $this->validate();

        if (!empty($this->thumbnail)) {
            File::delete('storage/' . $this->post->thumb);
            $filename = $this->thumbnail->store('assets/' . $this->account . '/post/thumb', 'public');
        } else {
            $filename = $this->post->thumb;
        }

        $this->post->update([
            'title' => $this->title,
            'body' => $this->artikel,
            'excercept' => Str::limit(strip_tags($this->artikel), 150),
            'thumb' => $filename,
        ]);
        $this->post->postCategories()->sync($this->categories);

        $this->dispatch('reinitSummernote', $this->artikel);
        return redirect()->route('post.index', ['account' => $this->account]);
    }
}
