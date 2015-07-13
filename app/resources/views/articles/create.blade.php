@extends('master')

@section('page_title', 'Create Article | ')

@section('content')

    @include('errors.list')

    <h2>Create Article</h2>

    {!! Form::model($article = new \App\Article, ['route' => 'articles.store', 'files' => true]) !!}
        @include('articles._form', ['submitButtonText' => 'Create', 'route' => 'articles.index',
         'slug' => []])
    {!! Form::close() !!}
@stop
