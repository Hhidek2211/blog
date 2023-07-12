<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">

        <title>ブログ</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    </head>

<x-app-layout>
    <x-slot name="header">Index</x-slot>
    <body>
        <h1>Blog Name</h1>
        <div class="Posts">
          @foreach ($posts as $post)
            <div class="Post">
                <h2 class="Title">
                    <a href="/posts/{{ $post -> id}}">
                    {{ $post -> title }}
                    </a>
                </h2>
                <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                <p class="body">{{ $post -> body }}</p>
                <form action="/posts/{{ $post->id }}" id="form_{{ $post->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deletePost( {{ $post->id }} )">delete</button>
                </form>
            </div>
          @endforeach
        </div>
        <div class='paginate'>
            {{ $posts -> links() }}
        </div>
        <a href="/posts/create">記事作成</a>
        
        <br>
        <p>ログインユーザー：{{ Auth::user()->name }}</p>
        <script>
            function deletePost(id) {
                'use strict'
                
                if (confirm('削除すると復元できません。\n本当に削除しますか？') ) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
        <br>
        <div>
            @foreach($questions as $question)
                <div>
                    <a href="https://teratail.com/questions/{{ $question['id']}}">{{ $question['title'] }}</a>
                </div>
            @endforeach
        </div>
        
    </body>
</x-app-layout>
    
</html>
