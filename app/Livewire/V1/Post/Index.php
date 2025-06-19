<?php

namespace App\Livewire\V1\Post;

use App\Models\V1\Post;
use Livewire\Component;

class Index extends Component
{
    public $page_count = 10, $search = '', $sortField = 'id', $sortDirection = 'asc';

    public $editFieldRowId;


    public function render()
    {
        $data['posts'] = Post::search($this->search)->orderBy($this->sortField, $this->sortDirection)->paginate($this->page_count);
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
}
