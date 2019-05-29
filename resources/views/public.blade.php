@extends('layouts.app')

{{-- Carousel Item --}}
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="{{URL::to('img/SLA1.jpg')}}" alt="First slide">
            <div class="carousel-caption d-none d-md-block">
                <h5>Join Us!</h5>
                <p>Better Education for Better Future!</p>
            </div>
        </div>
        <div class="carousel-item">
        <img class="d-block w-100" src="{{URL::to('img/SLA2.jpg')}}" alt="Second slide">
        <div class="carousel-caption d-none d-md-block">
                <h5>Join Us!</h5>
                <p>Better Education for Better Future!</p>
            </div>
        </div>
        <div class="carousel-item">
        <img class="d-block w-100" src="{{URL::to('img/SLA3.jpg')}}" alt="Third slide">
        <div class="carousel-caption d-none d-md-block">
                <h5>Join Us!</h5>
                <p>Better Education for Better Future!</p>
            </div>
        </div>
        <div class="carousel-item">
        <img class="d-block w-100" src="{{URL::to('img/SLA4.jpg')}}" alt="Fourth slide">
        <div class="carousel-caption d-none d-md-block">
                <h5>Join Us!</h5>
                <p>Better Education for Better Future!</p>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    </div>

@section('content')

<div class="container">
    {{-- Latest Books --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        <span class="badge badge-pill badge-success">
                            Latest Books
                        </span>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if(!empty($latest_books))
                        @foreach($latest_books as $latest_book)
                        
                        <div class="col-md-3">
                            <div class="card" style="width: 15rem;">
                                <img class="card-img-top" src="{{URL::to('img/'.$latest_book->b_cover)}}" alt="Cover image" title="{{$latest_book->b_title}}">
                                <div class="card-body">
                                    <h5 class="card-title">{{$latest_book->b_title}}</h5>
                                    <p class="card-text">{{str_limit($latest_book->b_desc, 25)}}</p>
                                    @auth
                                    @if(Auth::user()->admin === 1)
                                        <a href="{{url('detail/admin/'.$latest_book->id)}}" class="btn btn-primary btn-block">Detail</a>
                                    @else
                                        <a href="{{url('detail/'.$latest_book->id)}}" class="btn btn-primary btn-block">Detail</a>
                                    @endif
                                    @endauth
                                    @guest
                                        <a href="{{url('detail/'.$latest_book->id)}}" class="btn btn-primary btn-block">Detail</a>
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
    </div><br>
    {{-- Latest Ebooks --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        <span class="badge badge-pill badge-success">
                            Latest Ebooks
                        </span>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if(!empty($latest_ebooks))
                        @foreach($latest_ebooks as $latest_ebook)
                        
                        <div class="col-md-3">
                            <div class="card" style="width: 15rem;">
                                <img class="card-img-top" src="{{URL::to('img/'.$latest_ebook->ebook_cover)}}" alt="Cover image" title="{{$latest_ebook->ebook_title}}">
                                <div class="card-body">
                                    <h5 class="card-title">{{$latest_ebook->ebook_title}}</h5>
                                    <p class="card-text">{{str_limit($latest_ebook->ebook_desc, 25)}}</p>
                                    @auth
                                    @if(Auth::user()->admin === 1)
                                        <a href="{{url('detail/admin/'.$latest_ebook->id)}}" class="btn btn-primary btn-block">Detail</a>
                                    @else
                                        <a href="{{url('detail/ebook/'.$latest_ebook->id)}}" class="btn btn-primary btn-block">Detail</a>
                                    @endif
                                    @endauth
                                    @guest
                                        <a href="{{url('detail/ebook/'.$latest_ebook->id)}}" class="btn btn-primary btn-block">Detail</a>
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