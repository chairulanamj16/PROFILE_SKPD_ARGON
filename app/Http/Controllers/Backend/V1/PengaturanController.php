<?php

namespace App\Http\Controllers\Backend\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    protected $versi;

    public function __construct()
    {
        $this->versi = 'v1';
    }
    public function index(Request $request, $account)
    {
        $data['account'] = $account;
        return view('backend.' . $this->versi . '.' . request()->segment(1) . '.index', $data);
    }
}
