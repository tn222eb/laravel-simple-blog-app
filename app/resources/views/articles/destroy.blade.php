@extends('master')

@section('page_title', 'Delete Article | ')

@section('content')
    <h2>Delete Article</h2>
    <p>Are you sure you want to delete {{ $article->title }} ?</p>

    {!! Form::model($article, ['route' => ['articles.destroy', $article->id], 'method' => 'DELETE']) !!}

    {!! Form::submit('Confirm', ['class' => 'btn btn-primary']) !!}
    {!! link_to_route('articles.show', 'Cancel', [$article->id], ['class' => 'btn btn-default']) !!}

    {!! Form::close() !!}
@stop