@extends('layouts.app')
{{-- import --}}

@section("content")
    <div class="container">

        {{ $articles->links() }}

        @if (session("info"))
        <div class="alert alert-info">
            {{ session("info") }}
        </div>
        @endif

        @foreach ($articles as $article)
            <div class="card mb-4">
                <div class="card-body">
                    <h3 class="card-title">{{ $article->title }}</h3>
                    <div class="text-muted">
                        <b class="text-success">{{ $article->user->name }}:</b>
                        Category: <b>{{ $article->category->name}}</b>
                        Comments: <b>{{ count($article->comments)}}</b>
                        <small>{{ $article->created_at->diffForHumans() }}</small>
                        
                    </div>
                    <div>
                        {{ $article->body }}
                    </div>

                    <a href="{{ url("/articles/detail/$article->id")}}" class="btn btn-success mt-2 me-2">Detail</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection