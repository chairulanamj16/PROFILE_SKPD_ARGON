<?php

namespace App\Livewire\V1\Pengaturan;

use App\Models\V1\Office;
use App\Models\V1\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;
    public $account;

    public $leader_name, $leader_position, $leaderImage, $welcome_text, $address, $phone, $email, $map, $facebook, $instagram, $youtube, $logo, $password_lama, $password_baru;

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
        $this->address = $office->address;
        $this->phone = $office->phone;
        $this->email = $office->email;
        $this->map = $office->map;
        $this->facebook = $office->facebook;
        $this->instagram = $office->instagram;
        $this->youtube = $office->youtube;
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
            $this->leaderImage = '';
        }
        if ($field == 'logo') {
            File::delete('storage/' . $data->logo);
            $value  = $this->logo->store('assets/' . $data->subdomain . '/profil', 'public');
            $this->logo = '';
        }
        if (!empty($value)) {
            $data->update(
                [
                    $field => $value
                ]
            );
        }
    }

    public function ganti_password()
    {
        $this->validate([
            'password_lama' => 'required',
            'password_baru' => 'required',
        ]);
        $office = Office::where('subdomain', $this->account)->first();
        $user = User::find($office->user_id);
        // Cek apakah password lama cocok
        if (!Hash::check($this->password_lama, $user->password)) {
            throw ValidationException::withMessages([
                'password_lama' => 'Password lama tidak sesuai',
            ]);
        }

        $user->password = Hash::make($this->password_baru);
        $user->save();
        session()->flash('success', 'Password telah diganti');
        $this->password_lama = '';
        $this->password_baru = '';
    }
}
