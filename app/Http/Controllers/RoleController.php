<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;
use App\Models\Menu;

class RoleController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $roles = Role::all();
            return response()->json(['roles' => $roles]);
        }
        $sidebar_menus = Menu::with('children')->orderBy('order')->get();
        return view('roles.index', compact('sidebar_menus'));
    }

    public function gridview(Request $request)
    {
        if ($request->ajax()) {
            $roles = Role::with('permissions:name')->get();

            // Iterate through roles to add permission check
            foreach ($roles as $role) {
                $role->can_edit = auth()->user()->can('edit_roles');
                $role->can_delete = auth()->user()->can('delete_roles');
            }

            return DataTables::of($roles)
                ->addColumn('permissions', function ($role) {
                    return $role->permissions->pluck('name')->implode(', ');
                })
                ->addColumn('actions', function ($role) {
                    $editButton = $role->can_edit ? '<a href="javascript:void(0)" class="btn btn-xs btn-warning">Edit</a>' : '';
                    $deleteButton = $role->can_delete ? '<button data-id="' . $role->id . '" class="btn btn-xs btn-danger delete-role">Delete</button>' : '';
                    return $editButton . ' ' . $deleteButton;
                })
                ->addIndexColumn()
                ->rawColumns(['actions'])
                ->make(true);
        }

        return abort(404);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'array',
        ]);

        try {
            $role = Role::updateOrCreate(
                ['id' => $request->input('id')],
                ['name' => $request->input('name')]
            );

            $role->syncPermissions($request->input('permissions', []));

            return response()->json([
                'status' => 'success',
                'message' => 'Role saved successfully.',
                'role' => $role
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to save role. Please try again.',
                'error' => $e->getMessage()
            ]);
        }
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
