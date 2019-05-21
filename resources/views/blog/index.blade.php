@extends('main')

@section('title', '| Blog')

@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Blog</h1>
        </div>
    </div>

    @foreach($posts as $post)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>{{ $post->title }}</h2>
            <h5>Published at: {{ date('d/m/y', strtotime($post->created_at)) }}</h5>
            <p>{{ substr(strip_tags($post->body), 0, 40) }} {{ strlen(strip_tags($post->body)) > 40 ? "..." : ""}}</p>
            <a href="{{ route('blog.single', $post->slug) }}" class="btn btn-primary">Read More</a>  <!-- {{ url('blog/'.$post->slug) }} -->
            <hr>
        </div>
      
    </div>
    @endforeach  

    <div class="row">
        <div class="col-md-12">
            <div class="text-center">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
  

@endsection