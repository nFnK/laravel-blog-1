<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::with('tags', 'category', 'user')
                    ->withCount('comments')
                    ->published()
                    ->simplePaginate(5);

        return view('frontend.index', compact('posts'));
    }

    public function post(Post $post)
    {
        $post = $post->load(['comments.user', 'tags', 'user', 'category']);

        return view('frontend.post', compact('post'));
    }
}
