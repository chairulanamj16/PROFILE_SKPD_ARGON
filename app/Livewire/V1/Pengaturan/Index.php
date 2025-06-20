<?php

namespace App\Livewire\V1\Pengaturan;

use App\Models\V1\Office;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;
    public $account;

    public $leader_name, $leader_position, $leaderImage, $welcome_text;

    protected $rules = [
        'leaderImage' => 'required|image|mimes:png,jpg,jpeg|max:5120', // max 5MB
    ];

    public function mount($account)
    {
        $this->account = $account;
        $office = Office::where('subdomain', $account)->first();
        $this->leader_name = $office->leader_name;
        $this->leader_position = $office->leader_position;
        $this->welcome_text = $office->welcome_text;
    }

    public function render()
    {
        $data['office'] = Office::where('subdomain', $this->account)->first();
        return view('livewire.v1.pengaturan.index', $data);
    }


    #[On('office-updated')]
    public function ubah($id, $field, $value)
    {
        $data = Office::find($id);
        if ($field == 'leader_image') {
            File::delete('storage/' . $data->leader_image);
            $value  = $this->leaderImage->store('assets/' . $data->subdomain . '/profil', 'public');
        }
        if (!empty($value)) {
            $data->update(
                [
                    $field => $value
                ]
            );
        }
    }

    public function ubah_js(...$id)
    {
        dd('ok');
        // $data = Office::find($id);
        // if ($field == 'leader_image') {
        //     File::delete('storage/' . $data->leader_image);
        //     $value  = $this->leaderImage->store('assets/' . $data->subdomain . '/profil', 'public');
        // }
        // if (!empty($value)) {
        //     $data->update(
        //         [
        //             $field => $value
        //         ]
        //     );
        // }
    }
}
