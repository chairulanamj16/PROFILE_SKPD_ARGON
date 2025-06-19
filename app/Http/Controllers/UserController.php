<?php

namespace App\Http\Controllers;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Menu;

class UserController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $users = User::with('roles')->get();
            return response()->json(['users' => $users]);
        }

        $sidebar_menus = Menu::with('children')->orderBy('order')->get();
        return view('users.index', compact('sidebar_menus'));
    }

    public function gridview(Request $request)
    {
        if ($request->ajax()) {
            $users = User::with('roles')->select(['id', 'name', 'email']);

            // Determine permissions
            $canEdit = true;
            $canDelete = true;

            return DataTables::of($users)
                ->addColumn('roles', function ($user) {
                    return $user->roles->pluck('name')->implode(', ');
                })
                ->addColumn('actions', function ($user) use ($canEdit, $canDelete) {
                    $editButton = $canEdit ? '<a href="javascript:void(0)" class="btn btn-warning btn-xs">Edit</a>' : '';
                    $deleteButton = $canDelete ? '<button data-id="' . $user->id . '" class="btn btn-xs btn-danger delete-user">Delete</button>' : '';
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
            'email' => 'required|string|email|max:255|unique:users,email,' . $request->input('id'),
            'password' => 'sometimes|nullable|string|min:8',
            'roles' => ''
        ]);

        try {
            $user = User::updateOrCreate(
                ['id' => $request->input('id')],
                [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => $request->input('password') ? bcrypt($request->input('password')) : User::find($request->input('id'))->password,
                ]
            );

            $user->syncRoles($request->input('roles', []));

            return response()->json([
                'status' => 'success',
                'message' => 'User saved successfully.',
                'user' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to save user. Please try again.',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            User::find($id)->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'User deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to delete user. Please try again.',
                'error' => $e->getMessage()
            ]);
        }
    }
}

