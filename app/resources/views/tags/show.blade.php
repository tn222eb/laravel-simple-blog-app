@extends('master')

@section('page_title', '#' . $tag->name . ' | ')

@section('content')

    <h3>#{{ $tag->name }}</h3>

    @foreach ($articles as $article)
        <h3>{!! link_to_route('articles.show', $article->title, [$article->id]) !!}</h3>
    @endforeach

    {!! $articles->render() !!}
@stop