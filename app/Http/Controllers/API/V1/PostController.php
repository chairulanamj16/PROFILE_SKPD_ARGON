<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PostResource;
use App\Models\V1\Office;
use App\Models\V1\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function news(Request $request)
    {
        $paginate = $request->input('paginate') ? $request->input('paginate') : 7;
        $category =  $request->input('category') ? $request->input('category') : 'Berita';
        $office =  $request->input('office') ? $request->input('office') : '';
        $search =  $request->input('search') ? $request->input('search') : '';
        $post = Post::with('office')
            ->when($search, function ($q) use ($search) {
                return $q->where('title', 'like', '%' . $search . '%');
            })
            ->when($office, function ($q) use ($office) {
                $ofce = Office::where('subdomain', $office)->first();
                if (!empty($ofce)) {
                    return $q->where('office_id', $ofce->id);
                }
            })
            ->whereHas('postCategories', function ($query) use ($category) {
                return $query->where('name', $category);
            })
            ->orderBy('id', 'DESC')->paginate($paginate);
        return  PostResource::collection($post);
    }

    public function detail(Request $request, Post $post)
    {
        $post_first = Post::where('id', $post->id)
            ->with(['office', 'postCategories'])
            ->first();
        $category = $post_first->postCategories[0]->name;
        $post_more = Post::whereHas('postCategories', function ($query) use ($category) {
            return $query->where('name', $category);
        })
            ->orderBy('id', 'DESC')
            ->where('id', '!=', $post_first->id)
            ->limit(4)
            ->get();

        return [$post_first, PostResource::collection($post_more)];
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('q');
        $post = Post::with('office')
            ->where('title', 'like', '%' . $searchTerm . '%')
            ->orWhere('excercept', 'like', '%' . $searchTerm . '%')
            ->orderBy('id', 'DESC')
            ->paginate(6);
        return  PostResource::collection($post);
    }
}
