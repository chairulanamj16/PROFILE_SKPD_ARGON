<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\V1\Office;
use App\Models\V1\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{


    public function show($account, Post $post)
    {
        $data['office'] = Office::where('subdomain', $account)->first();
        $data['post'] = $post;
        return view('frontend.bootslander.post.show', $data);
    }
}
