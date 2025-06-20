<?php

namespace App\Livewire\V1\Slider;

use App\Models\V1\Office;
use App\Models\V1\Slider;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;
    public $page_count = 10, $search = '', $sortField = 'id', $sortDirection = 'asc';


    public $editFieldRowId;

    public $image, $is_active;
    public $account;

    public function mount($account)
    {
        $this->account = $account;
    }

    public function render()
    {
        $data['sliders'] = Slider::search($this->search)->orderBy($this->sortField, $this->sortDirection)->paginate($this->page_count);
        return view('livewire.v1.slider.index', $data);
    }

    public function simpan()
    {
        $this->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'is_active' => 'nullable',
        ]);

        $data['office_id'] = Office::where('subdomain', $this->account)->first()->id;
        $data['is_active'] = $this->is_active ? 1 : 0;
        $data['image'] = $this->image->store('assets/' . $this->account . '/slider', 'public');
        Slider::create($data);
    }


    public function editRow($id)
    {
        $this->editFieldRowId = $id;
    }

    public function ubah($id, $field, $value)
    {
        $data = Slider::find($id);
        $data->update(
            [
                $field => $value
            ]
        );
        $this->editFieldRowId = null;
    }

    public function hapus($id)
    {
        $slider = Slider::find($id);
        File::delete('storage/' . $slider->image);
        $slider->delete();
    }
}
