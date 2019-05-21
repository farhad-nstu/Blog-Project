@extends('main')

@section('title', '| Delete Tags')

@section('content')
     
    {{ Form::model($tag, ['route' => ['tags.update', $tag->id], 'method' => "PUT"]) }}

        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
        {{ Form::submit('Save Change', ['class' => 'btn btn-primary', 'style' => 'margin-top:20px']) }}

    {{ Form::close() }}
  

@endsection