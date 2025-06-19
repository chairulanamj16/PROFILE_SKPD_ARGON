<?php

namespace App\Http\Controllers\Backend\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $versi;
    protected $path;

    public function __construct()
    {
        $this->versi = 'v1';
        $this->path = 'backend.' . $this->versi . '.' . request()->segment(1);
    }

    public function index(Request $request, $account)
    {
        $data['account'] = $account;
        return view($this->path . '.index', $data);
    }
    public function create(Request $request, $account)
    {
        $data['account'] = $account;
        return view($this->path . '.create', $data);
    }
}
