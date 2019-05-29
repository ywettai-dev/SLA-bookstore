<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- favicon --}}
    <link rel="icon" href="{{ asset('img/burger-favicon.ico') }}">

    <title>SLA Online Library</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datatables.css')}}" rel="stylesheet">

</head>

<body>
    <div id="app">
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary navbar-laravel">
            <div class="container">
                <a class="navbar-brand py-1 text-monospace" href="{{ url('/') }}">
                    { SLA }
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    {{-- <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul> --}}

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            <a href="{{ route('all.books') }}" class="nav-link">
                                <font color="white">Books</font>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('all.ebooks') }}" class="nav-link">
                                <font color="white">Ebooks</font>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('searchCat') }}" class="nav-link">
                                <font color="white">Categories Search</font>
                            </a>
                        </li>
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <font color="white">Login</font>
                            </a>
                        </li>
                        <li class="nav-item">
                            @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">
                                <font color="white">Register?</font>
                            </a>
                            @endif
                        </li>
                        @else
                        {{-- AdminFeatures --}}
                        @if(Auth::check() && Auth::user()->admin == 1)
                        {{-- BookManage --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-book"> Books</i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{route('books.index')}}">Manage Books</a>
                                <a class="dropdown-item" href="{{route('ebooks.index')}}">Manage Ebooks</a>
                            </div>
                        </li>

                        {{-- Book Info --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-cogs"> Book Info</i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{route('shelves.index')}}">Manage Shelf</a>
                                <a class="dropdown-item" href="{{route('authors.index')}}">Mangage Authors</a>
                                <a class="dropdown-item" href="{{route('genres.index')}}">Manage Genre</a>
                                <a class="dropdown-item" href="{{route('publishers.index')}}">Manage Publisher</a>
                            </div>
                        </li>

                        {{-- UserManage --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-users"> Students</i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{route('admin.users.index')}}">Approve Students</a>
                                <a class="dropdown-item" href="{{route('students.index')}}">Manage Students</a>
                            </div>
                        </li>

                        {{-- IssueManage --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-share-square"> Issue Books</i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{route('issues.create')}}">Issue New Book</a>
                                <a class="dropdown-item" href="{{route('issues.index')}}">Manage Issued Books</a>
                            </div>
                        </li>
                        {{-- <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                        </li> --}}
                        @endif

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fas fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>

                        @endguest
                        {{-- <form class="form-inline mt-3 mt-md-0">
                            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                            <button class="btn btn-success my-2 my-sm-0" type="submit"><i class="fas fa-search"> Search</i></button>
                        </form> --}}
                    </ul>

                    {!! Form::open(array('url' => 'search','id'=>'search','class'=>'form-inline mt-3 mt-md-0')) !!}
                    <input type="text" name="search" class="form-control mr-sm-2" placeholder="Search Books..."
                        aria-label="Search">
                    <button class="btn btn-success my-2 my-sm-0" title="search" type="submit"><i
                            class="fas fa-search"></i></button>
                    {!! Form::close() !!}
                </div>
            </div>
        </nav>

        <main class="py-5">
            @yield('content')
        </main>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}" defer></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @yield('javascript')

    <footer class="footer">
        <div class="container">
            <span class="text-muted">Coded with passion.</span>
        </div>
    </footer>
</body>

</html>
