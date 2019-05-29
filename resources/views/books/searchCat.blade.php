@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header">
                        <h5>Search Books Categories : </h5>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingOne">
                    <h5 class="mb-0">
                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Authors : 
                        </button>
                    </h5>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                        <ul>
                            @foreach($authors as $author)
                            <li><a href="{{url('author/'.$author['id'].'/'.$author['a_name'])}}">{{$author['a_name']}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Genres :
                        </button>
                    </h5>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                    <div class="card-body">
                        <ul>
                            @foreach($genres as $genre)
                            <li><a href="{{url('genre/'.$genre['id'].'/'.$genre['g_name'])}}">{{$genre['g_name']}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Publishers
                        </button>
                    </h5>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                        <ul>
                            @foreach($publishers as $publisher)
                            <li><a href="{{url('publisher/'.$publisher['id'].'/'.$publisher['p_name'])}}">{{$publisher['p_name']}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-9">
            <div class="card">
                {{-- All books Search Result --}}
                @if(empty($res_author) && empty($res_genre) && empty($res_publisher))
                <div class="card-header">
                    <h4>
                        <span class="badge badge-pill badge-success">
                            All Books :  
                        </span>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if(!empty($books))
                        @foreach($books as $book)
                        <div class="col-md-4">
                            <div class="card" style="width: 15rem;">
                                <img class="card-img-top" src="{{URL::to('img/'.$book->b_cover)}}" alt="Cover image" title="{{$book->b_title}}">
                                <div class="card-body">
                                    <h5 class="card-title">{{$book->b_title}}</h5>
                                    <p class="card-text">{{str_limit($book->b_desc, 25)}}</p>
                                    @auth
                                    @if(Auth::user()->admin === 1)
                                        <a href="{{url('detail/admin/'.$book->id)}}" class="btn btn-primary btn-block">Detail</a>
                                    @else
                                        <a href="{{url('detail/'.$book->id)}}" class="btn btn-primary btn-block">Detail</a>
                                    @endif
                                    @endauth
                                    @guest
                                        <a href="{{url('detail/'.$book->id)}}" class="btn btn-primary btn-block">Detail</a>
                                    @endguest
                                </div>
                            </div><br>
                        </div>
                        @endforeach 
                        {{$books -> links()}}
                        @endif 
                    </div>
                </div>
                {{-- Author Search Category --}}
                @elseif(!empty($res_author))
                <div class="card-header">
                    <h4>
                        <span class="badge badge-pill badge-success">
                            {{$a_name."'s Books"}} :  
                        </span>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if(!empty($res_author))
                        @foreach($res_author as $author)
                        <div class="col-md-4">
                            <div class="card" style="width: 15rem;">
                                <img class="card-img-top" src="{{URL::to('img/'.$author->b_cover)}}" alt="Cover image" title="{{$author->b_title}}">
                                <div class="card-body">
                                    <h5 class="card-title">{{$author->b_title}}</h5>
                                    <p class="card-text">{{str_limit($author->b_desc, 25)}}</p>
                                    @auth
                                    @if(Auth::user()->admin === 1)
                                        <a href="{{url('detail/admin/'.$author->id)}}" class="btn btn-primary btn-block">Detail</a>
                                    @else
                                        <a href="{{url('detail/'.$author->id)}}" class="btn btn-primary btn-block">Detail</a>
                                    @endif
                                    @endauth
                                    @guest
                                        <a href="{{url('detail/'.$author->id)}}" class="btn btn-primary btn-block">Detail</a>
                                    @endguest
                                </div>
                            </div><br>
                        </div>
                        @endforeach 
                        {{$res_author -> render()}}
                        @endif 
                    </div>
                </div>
                {{-- Genre Search Category --}}
                @elseif(!empty($res_genre))
                <div class="card-header">
                    <h4>
                        <span class="badge badge-pill badge-success">
                            {{$g_name}} :  
                        </span>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if(!empty($res_genre))
                        @foreach($res_genre as $genre)
                        <div class="col-md-4">
                            <div class="card" style="width: 15rem;">
                                <img class="card-img-top" src="{{URL::to('img/'.$genre->b_cover)}}" alt="Cover image" title="{{$genre->b_title}}">
                                <div class="card-body">
                                    <h5 class="card-title">{{$genre->b_title}}</h5>
                                    <p class="card-text">{{str_limit($genre->b_desc, 25)}}</p>
                                    @auth
                                    @if(Auth::user()->admin === 1)
                                        <a href="{{url('detail/admin/'.$genre->id)}}" class="btn btn-primary btn-block">Detail</a>
                                    @else
                                        <a href="{{url('detail/'.$genre->id)}}" class="btn btn-primary btn-block">Detail</a>
                                    @endif
                                    @endauth
                                    @guest
                                        <a href="{{url('detail/'.$genre->id)}}" class="btn btn-primary btn-block">Detail</a>
                                    @endguest
                                </div>
                            </div><br>
                        </div>
                        @endforeach 
                        {{$res_genre -> render()}}
                        @endif 
                    </div>
                </div>
                {{-- Publisher Search Category --}}
                @elseif(!empty($res_publisher))
                <div class="card-header">
                    <h4>
                        <span class="badge badge-pill badge-success">
                            {{$p_name}} :  
                        </span>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if(!empty($res_publisher))
                        @foreach($res_publisher as $publisher)
                        <div class="col-md-4">
                            <div class="card" style="width: 15rem;">
                                <img class="card-img-top" src="{{URL::to('img/'.$publisher->b_cover)}}" alt="Cover image" title="{{$publisher->b_title}}">
                                <div class="card-body">
                                    <h5 class="card-title">{{$publisher->b_title}}</h5>
                                    <p class="card-text">{{str_limit($publisher->b_desc, 25)}}</p>
                                    @auth
                                    @if(Auth::user()->admin === 1)
                                        <a href="{{url('detail/admin/'.$publisher->id)}}" class="btn btn-primary btn-block">Detail</a>
                                    @else
                                        <a href="{{url('detail/'.$publisher->id)}}" class="btn btn-primary btn-block">Detail</a>
                                    @endif
                                    @endauth
                                    @guest
                                        <a href="{{url('detail/'.$publisher->id)}}" class="btn btn-primary btn-block">Detail</a>
                                    @endguest
                                </div>
                            </div><br>
                        </div>
                        @endforeach 
                        {{$res_publisher -> render()}}
                        @endif 
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
