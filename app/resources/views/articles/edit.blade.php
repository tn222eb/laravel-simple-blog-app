@extends('master')

@section('page_title', 'Edit Article | ')

@section('content')

    @include('errors.list')

    <h2>Edit Article</h2>

    {!! Form::model($article, ['route' => ['articles.update', $article->id], 'method' => 'PATCH']) !!}
        @include('articles._form', ['submitButtonText' => 'Update', 'route' => 'articles.show',
        'slug' => $article->id])
    {!! Form::close() !!}
@stop
