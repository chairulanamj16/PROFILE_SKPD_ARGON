<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MenuController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $menus = Menu::whereNull('parent_id')->get();
            return response()->json(['menus' => $menus]);
        }

        // $sidebar_menus = Menu::with('children')->orderBy('order')->get();
        return view('menus.index');
    }

    public function gridview(Request $request)
    {
        if ($request->ajax()) {
            $menus = Menu::with(['parent', 'children'])
                ->select(['id', 'name', 'subdomain', 'icon', 'order', 'parent_id']);

            // Determine permissions
            $canEdit = auth()->user()->can('edit_menus');
            $canDelete = auth()->user()->can('delete_menus');

            return DataTables::of($menus)
                ->addColumn('parent_name', function ($menu) {
                    return $menu->parent ? $menu->parent->name : 'None';
                })
                ->addColumn('actions', function ($menu) use ($canEdit, $canDelete) {
                    $editButton = $canEdit ? '<a href="javascript:void(0)" class="btn btn-warning btn-xs">Edit</a>' : '';
                    $deleteButton = $canDelete ? '<button data-id="' . $menu->id . '" class="btn btn-danger btn-xs delete-menu">Delete</button>' : '';
                    return $editButton . ' ' . $deleteButton;
                })
                ->addIndexColumn()
                ->rawColumns(['actions'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'subdomain' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'order' => 'integer',
            'parent_id' => 'nullable|exists:menus,id',
        ]);

        try {
            $menu = Menu::updateOrCreate(
                ['id' => $request->input('id')],
                [
                    'name' => $request->input('name'),
                    'subdomain' => $request->input('subdomain'),
                    'icon' => $request->input('icon'),
                    'order' => $request->input('order'),
                    'permission_view' => 'view_' . $request->input('subdomain'),
                    'parent_id' => $request->input('parent_id'),
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
