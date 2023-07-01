<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index(Post $post)//インポートしたPostをインスタンス化して$postとして使用。
    {
         return view('Posts.Index') -> with(['posts' => $post -> getPaginateByLimit()]);
    }
    
    public function show(Post $post)
    {
        return view('Posts.show') -> with(['post' => $post]);
    }
    
    public function create()
    {
        return view('Posts.create');
    }
    
    public function store(Post $post, PostRequest $request)
    {
        $input = $request['post'];
        $post -> fill($input) -> save();
        return redirect('/posts/' . $post -> id );
    }
}
