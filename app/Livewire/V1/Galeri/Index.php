<?php

namespace App\Livewire\V1\Galeri;

use App\Models\V1\Gallery;
use App\Models\V1\Office;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;
    public $page_count = 10, $search = '', $sortField = 'id', $sortDirection = 'asc';

    public $account;

    public $is_active = 1;
    public $images = [];

    protected $rules = [
        'images.*' => 'image|max:3048', // max 2MB per gambar
    ];

    public function mount($account)
    {
        $this->account = $account;
    }

    public function render()
    {
        $data['galeries'] = Gallery::search($this->search)->orderBy($this->sortField, $this->sortDirection)->paginate($this->page_count);
        return view('livewire.v1.galeri.index', $data);
    }

    public function store()
    {
        $this->validate();

        $office = Office::where('subdomain', $this->account)->first();
        foreach ($this->images as $image) {
            $url = $image->store('assets/' . $this->account . '/galleries', 'public');
            // $path = $image->store('uploads/images', 'public');
            Gallery::create([
                'office_id' => $office->id,
                'image' => $url,
                'is_active' => $this->is_active,
            ]);
        }
    }

    public function hapus($id)
    {
        $galeri = Gallery::find($id);
        File::delete('storage/' . $galeri->image);
        $galeri->delete();
    }
}
