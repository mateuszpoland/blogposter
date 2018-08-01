<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/toastr.min.js') }}"></script>
    <!-- modal -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/js/iziModal.min.js"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/toastr.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/tags.css') }}">
   
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ 'PostShare'  }}
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
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Zaloguj') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Rejestracja') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Wyloguj się') }}
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

        <!-- nawigacja boczna -->
        <div class="container">
            <div class="row">
                <!-- nawigacja widoczna tylko dla zalogowanych -->
                @if(Auth::check())
                     <!--nawigacja -->
                    <div class="col-lg-4">
                        <nav>
                            <ul class="list-group" id="nav">
                                <li class="list-group-item">
                                    <a href="{{ route('admin.home') }}">Strona Główna</a>
                                </li>
                                 <li class="list-group-item">
                                    <a href="{{ route('posts.index') }}">Posty</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('posts.create') }}">Dodaj nowy post</a>
                                </li>
                                 <li class="list-group-item">
                                    <a href="{{ route('category.create') }}">Dodaj nową kategorię</a>
                                </li>
                                 <li class="list-group-item">
                                    <a href="{{ route('categories') }}">Zobacz listę kategorii</a>
                                </li>
                                 <li class="list-group-item">
                                    <a href="{{ route('users.index') }}">Użytkownicy</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('tags.index') }}">Tagi</a>
                                </li>
                                <li class="list-group-item">
                                    <a href="{{ route('posts.trash') }}">Usunięte posty</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                @endif
               
                <!-- content -->
                <div class="col-lg-8">
                    @yield('content')
                </div>
            </div>
        </div>

        <main class="py-4">
            
        </main>
    </div>

   
<!--scripts -->
<script type="text/javascript">
    @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
    @elseif(Session::has('notify-delete'))
        toastr.warning("{{ Session::get('notify-delete') }}");  
    @endif
</script>
</body>
</html>
