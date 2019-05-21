@extends('main')

@section('title', '| All Categories')

@section('content')

    <div class="row">
        
        <div class="col-md-8">
            <h1>Categories</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                    </tr>
                </thead>




                <tbody>
                @foreach($categories as $category)
                    <tr>
                    
                        <th>{{ $category->id }}</th>
                        <td>{{ $category->name }}</td>

                       
                    </tr>
                @endforeach     
                </tbody>
            </table>
        </div> <!-- end of col-md-8 -->

        <div class="col-md-3">
            {!! Form::open(['route' => 'categories.store', 'method' => 'POST']) !!}
            {{ Form::label('name', 'New Category:') }}
            {{ Form::text('name', null, ['class' => 'form-control']) }}

            {{ Form::submit('submit', ['class' => 'btn btn-info btn-h1-spacing']) }}

            {!! Form::close() !!}
        </div>
     
    </div>
  

@endsection