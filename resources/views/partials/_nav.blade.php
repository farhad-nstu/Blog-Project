<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Laravel Blog</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link " href="/">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="blog">Blog</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about">About</a>
      </li>
      <li class="nav-item">  
        <a class="nav-link" href="contact">Contact</a>
      </li>
    </ul>

    <ul class="nav navbar-nav navbar-right"> 

      @if(Auth::check()) 

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Heloo {{ Auth::user()->name }}
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="{{ route('posts.index') }}">Posts</a></li>
          <li><a class="dropdown-item" href="{{ route('categories.index') }}">Categories</a></li>
          <li><a class="dropdown-item" href="{{ route('tags.index') }}">Tags</a></li>

          <li role="separator" class="divider"></li>
          <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
        </ul>
      </li>
      
      @else
      
      <a href="{{ route('login') }}" class="btn btn-primary pull-right">Login</a>

      @endif
    </ul>
  </div>
</nav>        
