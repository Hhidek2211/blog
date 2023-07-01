<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">

        <title>記事編集</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    </head>
    
    <body>
       <form action = "/posts/{{ $post->id }}" method= "POST">
       @csrf
       @method('PUT')
           <div class="title">
               <h2>Title</h2>
               <input type="text" name="post[title]" value="{{ $post->title }}"/>
           </div>
           <div class="body">
               <h2>Body</h2>
               <input type="text" name="post[body]" value="{{ $post->body }}"/>
           </div>
           <input type="submit" value="store"/>
       </form>
       <div class="footer">
           [<a href="/">戻る</a>]
       </div>
    </body>
    
    
</html>
