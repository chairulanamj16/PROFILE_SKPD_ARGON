<?php

namespace App\Livewire\V1\Subdomain;

use App\Models\V1\User;
use Livewire\Component;
use App\Models\V1\Office;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Index extends Component
{
    use WithPagination;

    public $page_count = 10;
    public $search = '';
    public $sortField = 'name';
    public $sortDirection = 'asc';

    public $nama;
    public $subdomain;
    public $editSubdomain;


    public $editFieldRowId;


    protected $paginationTheme = 'bootstrap';
    // Listener agar bisa di-trigger dari JS
    protected $listeners = ['refreshTable' => 'refreshTable'];


    public function render()
    {
        $data['subdomains'] = Office::search($this->search)->orderBy($this->sortField, $this->sortDirection)->paginate($this->page_count);

        return view('livewire.v1.subdomain.index', $data);
    }


    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function refreshTable()
    {
        // tidak perlu isi khusus, cukup trigger re-render
    }


    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->resetPage();
    }

    public function store()
    {
        $this->validate([
            'nama' => 'required',
            'subdomain' => 'required|string|regex:/\w+$/|unique:offices',
        ], [
            'nama.required' => 'Nama harus diisi',
            'subdomain.required' => 'Subdomain harus diisi',
            'subdomain.unique' => 'Subdomain sudah dipakai',
        ]);

        $data_user = [
            'name' => $this->nama,
            'username' => $this->subdomain,
            'password' => Hash::make('tapinkab'),
            'rule' => 'Admin'
        ];

        $data_subdomain = [
            'user_id' => Auth::user()->id,
            'name' => $this->nama,
            'subdomain' => $this->subdomain
        ];

        User::create($data_user);
        Office::create($data_subdomain);

        $this->dispatch('subdomainStore');
    }


    public function editRow($id)
    {
        $this->editFieldRowId = $id;
    }

    public function ubah($id, $field, $value)
    {
        $data = Office::find($id);
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
