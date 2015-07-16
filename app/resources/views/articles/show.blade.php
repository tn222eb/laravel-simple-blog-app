@extends('master')

@section('page_title', $article->title . ' | ')

@section('content')

    @if (Auth::check() && Auth::user()->id == $article->user->id)
        <div class="form-group">
            {!! link_to_route('articles.edit', 'Edit', [$article->id], ['class' => 'btn btn-default']) !!}
            {!! link_to_route('articles.destroy.confirm', 'Delete', [$article->id], ['class' => 'btn btn-default']) !!}
        </div>
    @endif

    <h2>{{ $article->title }}</h2>

    <p> {{ $article->published_at }}</p>

    <p>{!! nl2br(htmlentities($article->body)) !!}</p>

    @unless($article->tags->isEmpty())
    <div class="tags">
        <h4>Tags:</h4>
        @foreach($article->tags as $tag)
            {!! link_to_route('tag.show', '#' . $tag->name, [$tag->name]) !!}
        @endforeach
    </div>
    @endunless
@stop