@extends('layouts.app')
{{-- import --}}

@section("content")
    <div class="container">

        {{-- {{ $articles->links() }} --}}
        @if($errors->any())
            <div class="alert alert-warning">
                @foreach($errors->all() as $err)
                {{ $err }}
                @endforeach
            </div>
        @endif

            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title">{{ $article->title }}</h3>
                    <div class="text-muted">
                        <b class="text-success">{{ $article->user->name }}:</b>
                        Category: <b>{{ $article->category->name}}</b>
                        Comment: <b>{{ count($article->comments)}}</b>
                        <small>{{ $article->created_at->diffForHumans() }}</small>
                    </div>
                    <div>
                        {{ $article->body }}
                    </div>

                    @auth
                        @can('delete-article', $article)
                            <a href="{{ url("/articles/delete/$article->id")}}" class="btn btn-danger mt-3 me-1">Delete</a>
                            <a href="{{ url("/articles/edit/$article->id")}}" class="btn btn-warning mt-3">Edit</a>
                        @endcan
                    @endauth
                    
                </div>
            </div>
            <hr>

            <ul class="list-group">
                <li class="list-group-item active">
                    Comments ({{ count($article->comments) }})
                </li>
                @foreach ($article->comments as $comment)
                <li class="list-group-item">
                    
                    @auth
                        @can('delete-comment', $comment)
                            <a href="{{ url("/comments/delete/$comment->id") }}" class="btn-close float-end"></a>
                        @endcan
                    @endauth

                    <b class="text-success">{{ $comment->user->name}}:</b>
                    {{ $comment->content }}
                </li>
                @endforeach
            </ul>
            @auth
                <form action="{{ url("/comments/add") }}" method="post">
                    @csrf
                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                    <textarea name="content" class="form-control my-2"></textarea>
                    <button class="btn btn-secondary">Add Comment</button>
                </form>
            @endauth
    </div>
@endsection