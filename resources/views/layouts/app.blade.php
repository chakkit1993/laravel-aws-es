<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"   ></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="{{ asset('js/sweetalert.js') }}" ></script>
  


    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix-core.js" charset="utf-8"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.js" charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.4/trix.css">
    <!-- <link rel="stylesheet" type="text/css" href="trix.css">
    <script type="text/javascript" src="trix.js"></script>  -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    
        <main class="py-4">
        @auth
        <div class="container">

        <div class="row">
        <div class="col-md-12">
            <img scr="{{ asset('img/jo-szczepanska-bjemWZcNF34-unsplash.jpg') }}"></img>
        </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <ul class="list-group">
                <li  class="list-group-item">
                <a href="{{route('categories.index')}}"> Category</a>
                
                </li>
                <li  class="list-group-item">
                <a href="{{route('posts.index')}}"> Post</a>
                
                </li>
                <li  class="list-group-item">
                <a href="{{route('tags.index')}}"> Tags</a>
                
                </li>
                @if(auth()->user()->isAdmin())
                <li  class="list-group-item">
                <a href="{{route('users.index')}}"> Users</a>
                
                </li>
                @endif
                </ul>
            </div>
            <div class="col-md-8">
                @if(Session()->has('success'))
                <div class="alert alert-success">
                    {{Session()->get('success')}}
                </div>
                @endif
                @if(Session()->has('error'))
                <div class="alert alert-danger">
                    {{Session()->get('error')}}
                </div>
                @endif
                   <example-component></example-component>
                 @yield('content')
            </div>
        </div> 
        </div>

        @else
       
            @yield('content')
        @endauth
        </main>
    </div>
</body>
</html>
