@extends('main')

@section('title', '| All Posts')

@section('content')

     <div class="row">

       

        <div class="col-md-10">
            <h1> All posts </h1>
        </div>
        <div class="col-md-2">
             <h2 href="{{ route('posts.create') }}" class="btn btn-sm b btn-primary pull-right">Create a new Post</h2>
             
            <hr>
        </div> 

        <div class="col-md-12">
            <hr>
        </div>

     </div>

     <div class="row">
        <div class="col-md-12">
            <table class="table">
                 <thead>
                     <th>id</th>
                     <th>Title</th>
                     <th>Slug</th>
                     <th>Body</th>
                     <th>Created At</th>
                     
                 </thead>
                <tbody>
                    @foreach($posts as $post)
                    <tr>
                        <th>{{ $post->id }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->slug }}</td>
                        <td>{{ substr(strip_tags($post->body), 0, 40) }} {{ strlen(strip_tags($post->body)) > 40 ? "..." : ""}}</td> <!-- first 40 charater will show it -->
                        <td>{{ date('d/m/y', strtotime($post->created_at)) }}</td>
                        <td>
                           <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-primary">View</a>
                           <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-info">Edit</a>
                           <a href="{{ route('posts.destroy', $post->id) }}" class="btn btn-sm btn-danger" id="delete">Delete</a>
                        </td>
                    </tr> 
                    @endforeach
                </tbody>
            </table>
            <div class="text-center">{!! $posts->links() !!}</div>  <!-- we can also use {{ $posts->links() }} -->
        </div>
     </div>
  

@endsection