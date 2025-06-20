<?php

namespace App\Livewire\V1\Post;

use App\Models\V1\Office;
use App\Models\V1\Post;
use Illuminate\Support\Facades\File;
use Livewire\Component;

class Index extends Component
{
    public $page_count = 10, $search = '', $sortField = 'id', $sortDirection = 'asc';

    public $editFieldRowId;
    public $account;


    public function mount($account)
    {
        $this->account = $account;
    }

    public function render()
    {
        $office = Office::where('subdomain', $this->account)->first();
        $data['posts'] = Post::search($this->search)
            ->where('office_id', $office->id)
            ->orderBy($this->sortField, $this->sortDirection)->paginate($this->page_count);
        // $data['posts'] = Post::paginate($this->page_count);
        return view('livewire.v1.post.index', $data);
    }

    public function editRow($id)
    {
        $this->editFieldRowId = $id;
    }

    public function ubah($id, $field, $value)
    {
        $data = Post::find($id);
        if (!empty($value)) {
            $data->update(
                [
                    $field => $value
                ]
            );
        }
        $this->editFieldRowId = null;
    }

    public function hapus($uuid)
    {
        $post = Post::where('uuid', $uuid)->first();
        File::delete('storage/' . $post->thumb);
        $post->delete();
    }
}
