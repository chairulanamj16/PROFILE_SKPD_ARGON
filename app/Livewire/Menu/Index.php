<?php

namespace App\Livewire\Menu;

use App\Models\Menu;
use Illuminate\Support\Facades\Request;
use Livewire\Component;

class Index extends Component
{

    public $name, $subdomain, $icon, $order = 0, $parent_id;

    public function render()
    {
        $data['menus'] = Menu::with('children')->where('parent_id', null)->orderBy('order')->get();
        $data['form_parent'] = Menu::whereNull('parent_id')->get();
        return view('livewire.menu.index', $data);
    }


    public function store(Request $request)
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'subdomain' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'order' => 'integer',
            'parent_id' => 'nullable|exists:menus,id',
        ]);

        try {
            $menu = Menu::create(
                [
                    'name' => $this->name,
                    'subdomain' => $this->subdomain,
                    'icon' => $this->icon,
                    'order' => $this->order,
                    'permission_view' => 'view_' . $this->subdomain,
                    'parent_id' => $this->parent_id,
                ]
            );

            return response()->json([
                'status' => 'success',
                'message' => 'Menu saved successfully.',
                'menu' => $menu
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to save menu. Please try again.',
                'error' => $e->getMessage()
            ]);
        }
    }


    public function update($id, $field, $value)
    {
        $data = Menu::where('id', $id)->first();
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
            Menu::find($id)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Menu deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete menu. Please try again.',
                'error' => $e->getMessage()
            ]);
        }
    }
}
