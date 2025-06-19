<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    public $page_count = 10, $search;

    public function render()
    {
        $data['users'] = User::with('roles')->paginate($this->page_count);
        $data['roles'] = Role::orderBy('id', 'ASC')->get();
        return view('livewire.user.index', $data);
    }
}
