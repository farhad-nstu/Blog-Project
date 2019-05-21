@extends('main')

@section('title', '| All Tags')

@section('content')

    <div class="row">
        
        <div class="col-md-8">
            <h1>Tags</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Tags</th>
                    </tr>
                </thead>




                <tbody>
                @foreach($tags as $tag)
                    <tr>
                    
                        <th>{{ $tag->id }}</th>
                        <td><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></td>
                        <td>{{ $tag->tags }}</td>

                       
                    </tr>
                @endforeach     
                </tbody>
            </table>
        </div> <!-- end of col-md-8 -->

        <div class="col-md-3">
            {!! Form::open(['route' => 'tags.store', 'method' => 'POST']) !!}
            {{ Form::label('name', 'Title:') }}
            {{ Form::text('name', null, ['class' => 'form-control']) }}
            {{ Form::label('tags', 'New Tag:') }}
            {{ Form::text('tags', null, ['class' => 'form-control']) }}

            {{ Form::submit('submit', ['class' => 'btn btn-info btn-h1-spacing']) }}

            {!! Form::close() !!}
        </div>
     
    </div>
  

@endsection