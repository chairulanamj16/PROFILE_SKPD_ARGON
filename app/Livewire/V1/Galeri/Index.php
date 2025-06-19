<?php

namespace App\Livewire\V1\Galeri;

use App\Models\V1\Gallery;
use Livewire\Component;

class Index extends Component
{
    public $page_count = 10, $search = '', $sortField = 'id', $sortDirection = 'asc';

    public function render()
    {
        $data['galeries'] = Gallery::search($this->search)->orderBy($this->sortField, $this->sortDirection)->paginate($this->page_count);
        return view('livewire.v1.galeri.index', $data);
    }
}
