<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">

        <title>ブログ</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    </head>
    
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
        <a href="/posts/create">記事の新規作成</a>
        
        <script>
            function deletePost(id) {
                'use strict'
                
                if (confirm('削除すると復元できません。\n本当に削除しますか？') ) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
        
    </body>
    
    
</html>
