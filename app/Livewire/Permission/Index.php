<?php

namespace App\Livewire\Permission;

use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Index extends Component
{
    public $name, $page_count = 10, $search;

    public function render()
    {
        $data['permissions'] = Permission::select(['id', 'name'])
            ->where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'DESC')
            ->paginate($this->page_count);
        return view('livewire.permission.index', $data);
    }

    public function store(Request $request)
    {
        $this->validate([
            'name' => 'required|string|max:255'
        ]);

        try {
            $permission = Permission::create(
                ['name' => $this->name]
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Permission saved successfully.',
                'permission' => $permission
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to save permission. Please try again.',
                'error' => $e->getMessage()
            ]);
        }
    }


    public function update($id, $field, $value)
    {
        $data = Permission::where('id', $id)->first();
        if (!empty($value)) {
            $data->update(
                [
                    $field => $value
                ]
            );
        }
    }


    public function destroy($id)
    {
        try {
            Permission::find($id)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Permission deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete permission. Please try again.',
                'error' => $e->getMessage()
            ]);
        }
    }
}
