<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Menu;

class PermissionController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $permissions = Permission::all();
            return response()->json(['permissions' => $permissions]);
        }

        $sidebar_menus = Menu::with('children')->orderBy('order')->get();
        return view('permissions.index', compact('sidebar_menus'));
    }

    public function gridview(Request $request)
    {
        if ($request->ajax()) {
            $permissions = Permission::select(['id', 'name']);

            // Determine permissions
            $canEdit = auth()->user()->can('edit_permissions');
            $canDelete = auth()->user()->can('delete_permissions');

            return DataTables::of($permissions)
                ->addColumn('actions', function ($permission) use ($canEdit, $canDelete) {
                    $editButton = $canEdit ? '<a href="javascript:void(0)" class="btn btn-warning btn-xs">Edit</a>' : '';
                    $deleteButton = $canDelete ? '<button data-id="' . $permission->id . '" class="btn btn-danger delete-permission btn-xs">Delete</button>' : '';
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
            'name' => 'required|string|max:255'
        ]);

        try {
            $permission = Permission::updateOrCreate(
                ['id' => $request->input('id')],
                ['name' => $request->input('name')]
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
