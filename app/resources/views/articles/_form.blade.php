<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group">
    {!! Form::label('body', 'Body:') !!}
    {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('published_at', 'Published On:') !!}
    {!! Form::input('date', 'published_at', $article->published_at, ['class' => 'form-control']) !!}
</div>

<div class="form-group">

    {!! Form::label('tag_list', 'Tag:') !!}
    {!! Form::select('tag_list[]', $tags, null, ['id' => 'tag_list', 'class' => 'form-control', 'multiple']) !!}
</div>

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary']) !!}
    {!! link_to_route($route, 'Cancel', $slug, ['class' => 'btn btn-default']) !!}
</div>

@section('footer')
    <script type="text/javascript">
        $('select').select2({
            placeholder: 'Choose A Tag',
            tag:false
        });
    </script>
@stop
