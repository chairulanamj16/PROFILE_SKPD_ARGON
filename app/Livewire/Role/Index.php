<?php

namespace App\Livewire\Role;

use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    public $name, $permissions, $roleId, $update_permissions, $page_count = 10, $search;

    public function render()
    {
        $data['roles'] = Role::where('name', 'LIKE', '%' . $this->search . '%')->paginate($this->page_count);
        $data['permissions_data']  = Permission::all();
        return view('livewire.role.index', $data);
    }


    public function store(Request $request)
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'array',
            'permissions.*' => 'integer',
        ]);

        // Mengonversi ID ke nama permission
        $permissions = Permission::whereIn('id', $this->permissions)->pluck('name')->toArray();

        $role = new Role();
        $role->name = $this->name;
        $role->save();

        $role->syncPermissions($permissions);
        // Set pesan flash session
        session()->flash('success', 'Berhasil menambahkan role baru.');
        return redirect()->route('roles.index');
        // try {
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'status' => 'error',
        //         'message' => 'Failed to save role. Please try again.',
        //         'error' => $e->getMessage()
        //     ]);
        // }
    }

    public function updatedUpdatePermissions()
    {
        $this->savePermissions($this->roleId, $this->update_permissions);
    }


    public function savePermissions($roleId, $permissionId)
    {
        $role = Role::find($roleId);
        $permissions = Permission::whereIn('id', $this->update_permissions)->pluck('name')->toArray();
        if (!$role) {
            session()->flash('error', 'Role not found.');
            return;
        }

        // Cek jika permission kosong, maka hapus semua permission yang terhubung
        if (empty($permissions)) {
            $role->permissions()->detach();  // Jika tidak ada permission yang dipilih, hapus
            session()->flash('message', 'Permissions removed successfully.');
            return;
        }

        $role->syncPermissions([$permissions]);  // Sinkronkan permission dengan role
        session()->flash('message', 'Role permissions updated successfully.');
        $this->dispatch('updated-permission');
    }

    public function destroy($id)
    {
        try {
            Role::find($id)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Role deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete role. Please try again.',
                'error' => $e->getMessage()
            ]);
        }
    }
}
