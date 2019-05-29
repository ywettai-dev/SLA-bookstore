@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        {{-- <div class="col-md-3">
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header">
                        <h5>Search by Categories : </h5>
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
                            <li><a href="{{url('author/'.$author['id'].'/a')}}" name="author">{{$author['a_name']}}</a></li>
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
                        Second #2
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
                        Third #1
                    </div>
                    </div>
                </div>
            </div>
        </div> --}}
        
        {{-- Search Result --}}
        
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        <span class="badge badge-pill badge-success">
                            Search Result 
                        </span>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if(!empty($results))
                        @foreach($results as $result)
                        <div class="col-md-3">
                            <div class="card" style="width: 15rem;">
                                <img class="card-img-top" src="{{URL::to('img/'.$result->b_cover)}}" alt="Cover image" title="{{$result->b_title}}">
                                <div class="card-body">
                                    <h5 class="card-title">{{$result->b_title}}</h5>
                                    <p class="card-text">{{str_limit($result->b_desc, 25)}}</p>
                                    @auth
                                    @if(Auth::user()->admin === 1)
                                        <a href="{{url('detail/admin/'.$result->id)}}" class="btn btn-primary btn-block">Detail</a>
                                    @else
                                        <a href="{{url('detail/'.$result->id)}}" class="btn btn-primary btn-block">Detail</a>
                                    @endif
                                    @endauth
                                    @guest
                                        <a href="{{url('detail/'.$result->id)}}" class="btn btn-primary btn-block">Detail</a>
                                    @endguest
                                </div>
                            </div><br>
                        </div>
                        @endforeach 
                        @endif 
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>
</div>

@endsection
