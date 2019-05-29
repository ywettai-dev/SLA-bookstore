@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-monospace">{{$detail['b_title']}}
                        <a href="javascript:history.back()" class="btn btn-md float-sm-right btn-secondary">
                           <i class="fas fa-chevron-circle-left"> Back</i>
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            @if($detail['b_cover']!=null)
                                <img src="{{URL::to('img/'.$detail['b_cover'])}}" class="img-fluid" alt="Cover image" title="Cover image">
                            @else
                                <img src="{{URL::to('img/cover.jpg')}}" width="100%" height="100%" alt="No cover image" title="No cover image">
                            @endif
                        </div>
                        <div class="col-md-5">
                            <h5 class="text-monospace">Book Title : {{$detail['b_title']}}</h5><br>
                            <h5 class="text-monospace">ISBN : {{$detail['b_isbn']}}</h5><br>
                            <h5 class="text-monospace">Author : {{$detail['author']['a_name']}}</h5><br>
                            <h5 class="text-monospace">Price : $ {{$detail['b_price']}}.00</h5><br>
                            <h5 class="text-monospace">
                                Availability : 
                                @if($detail['b_qty']>0)
                                <span class="badge badge-success">{{'Yes'}}</span>
                                @else
                                <span class="badge badge-success">{{'No'}}</span>
                                @endif
                            </h5><br>
                            <h5 class="text-monospace">In stock : {{$detail['b_qty']}} book(s)</h5><br>
                            <h5 class="text-monospace">Added at : {{$detail['created_at']}}</h5><br>
                        </div>
                        <div class="col-md-4">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Book Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Publisher</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Shelf</a>
                            </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <small class="text-monospace">{{$detail['b_desc']}}</small>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <small class="text-monospace">{{$detail['publisher']['p_name']}}</small><br>
                                <small class="text-monospace">Published at : </small><small class="text-monospace badge badge-success">{{$detail['pub_date']}}</small>
                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                <small class="text-monospace">Available at : </small><small class="text-monospace badge badge-success">{{$detail['shelf']['s_name']}}</small>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

