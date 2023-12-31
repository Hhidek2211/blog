<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index(Post $post)//インポートしたPostをインスタンス化して$postとして使用。
    {
        $client = new \GuzzleHttp\Client();
        $url = 'https://teratail.com/api/v1/questions';
        
        $response = $client -> request(
            'GET', $url, ['Bearer' => config('services.teratail.token')]
            );
            
        $questions = json_decode($response->getBody(), true);
        
         return view('Posts.Index') -> with([
             'posts' => $post -> getPaginateByLimit(),
             'questions' => $questions['questions'],                               
         ]);
    }
    
    public function show(Post $post)
    {
        return view('Posts.show') -> with(['post' => $post]);
    }
    
    public function create(Category $category)
    {
        return view('Posts.create') -> with(['categories' => $category -> get() ]);
    }
    
    public function store(Post $post, PostRequest $request)
    {
        $input = $request['post'];
        $post -> fill($input) -> save();
        return redirect('/posts/' . $post -> id );
    }
    
    public function edit(Post $post)
    {
        return view('Posts.edit')->with(['post'=> $post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
        
        return redirect('/posts/' . $post->id );
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
}
