@extends('master')

@section('content')
        @foreach ($articles as $article)
            <h3>{!! link_to_route('articles.show', $article->title, [$article->id]) !!}</h3>
        @endforeach

        {!! $articles->render() !!}
@stop