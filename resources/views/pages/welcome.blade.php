@extends('main')

<!--@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="styles.css">
@endsection-->


@section('title', '| Homepage')


@section('content')




        <div class="row">
            <div class="col-md-12">
            <div class="jumbotron">
               <h1 class="display-4">Welcome to my Blog!</h1>
               <p class="lead">This is my Website built with Laravel.Please read my popular post.</p>
               <hr class="my-4">
              
               <a class="btn btn-primary btn-lg" href="#" role="button">Popular Post</a>
            </div>
            </div>
        </div>
            

            <div class="row">
                <div class="col-md-8">


                @foreach($posts as $post)
                    <div class="post">
                        <h2>{{ $post->title }}</h2>
                        <p>{{ substr(strip_tags($post->body), 0, 30) }} {{ strlen(strip_tags($post->body)) > 30 ? "..." : ""}} </p>
                        <a href="{{ url('blog/'.$post->slug) }}" class="btn btn-primary">Read More</a>
                    </div>

                <hr>

                @endforeach

                </div>  
                
            
            

            <div class="col-md-3 col-md-offset-1">

                <h3>Sidebar</h3>
                
            </div>
        </div>    

@endsection     

<!--@section('scripts')
    <script>
        confirm('I loaded up some js')
    </script>
@endsection-->

   




























                

      