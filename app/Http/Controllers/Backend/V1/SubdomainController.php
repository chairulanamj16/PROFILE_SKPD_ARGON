<?php

namespace App\Http\Controllers\Backend\V1;

use App\Models\User;
use App\Models\V1\Office;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class SubdomainController extends Controller
{
    protected $versi;
    protected $subdomain;

    public function __construct()
    {
        $this->versi = 'v1';
        $this->subdomain = request()->segment(1);
    }

    public function index(Request $request)
    {
        $data = [
            'tambah' =>  ucfirst(Route::currentRouteName()) . ' | '  . env('APP_NAME') . ' Tapin',
            'versi' => $this->versi
        ];
        return view('backend.' . $this->versi . '.' . $this->subdomain . '.index', compact('data'));
    }


    public function reset_password(Request $request, $id)
    {
        $request->validate([
            'password' => 'required'
        ]);

        $office = Office::find($id);
        $user = User::find($office->user->id);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back()->with('success', 'Subdomain berhasil di reset akun.');
    }
}
