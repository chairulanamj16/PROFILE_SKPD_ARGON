<?php

namespace App\Http\Controllers\Backend\V1;

use App\Http\Controllers\Controller;
use App\Models\V1\Post;
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

    public function edit(Request $request,  $account, Post $post)
    {
        $data['account'] = $account;
        $data['post'] = $post;
        return view($this->path . '.edit', $data);
    }
}
