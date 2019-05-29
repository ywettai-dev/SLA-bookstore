@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-monospace">{{$detail['ebook_title']}}
                        <a href="javascript:history.back()" class="btn btn-md float-sm-right btn-secondary">
                           <i class="fas fa-chevron-circle-left"> Back</i>
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            @if($detail['ebook_cover']!=null)
                                <img src="{{URL::to('img/'.$detail['ebook_cover'])}}" class="img-fluid" alt="Cover image" title="Cover image">
                            @else
                                <img src="{{URL::to('img/cover.jpg')}}" width="100%" height="100%" alt="No cover image" title="No cover image">
                            @endif
                        </div>
                        <div class="col-md-5">
                            <h5 class="text-monospace">Ebook Title : {{$detail['ebook_title']}}</h5><br>
                            <h5 class="text-monospace">ISBN : {{$detail['ebook_isbn']}}</h5><br>
                            <h5 class="text-monospace">Author : {{$detail['author']['a_name']}}</h5><br>
                            <h5 class="text-monospace">Genre : {{$detail['genre']['g_name']}}</h5><br>
                            <h5 class="text-monospace">Edition : {{$detail['edition']}}</h5><br>
                            <h5 class="text-monospace">Uploaded at : {{$detail['created_at']}}</h5><br>
                            @guest
                                 <button onClick="swal('You are not logged in!','Log in to download', 'warning')" class="btn btn-lg btn-success">
                                     Download
                                 </button> 
                            @else
                            @if(Auth::user()->status != 1)
                                 <button onClick="swal('Your account is not approved!','Wait for approval', 'warning')" class="btn btn-lg btn-success">
                                     Download
                                 </button> 
                            @else
                                <a href="{{ url('/download/'.$detail['id']) }}" class="btn btn-lg btn-success">Download</a>
                            @endif
                            @endguest 
                        </div>
                        <div class="col-md-4">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Ebook Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Publisher</a>
                            </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <small class="text-monospace">{{$detail['ebook_desc']}}</small>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <small class="text-monospace">{{$detail['publisher']['p_name']}}</small><br>
                                    <small class="text-monospace">Published at : </small><small class="text-monospace badge badge-success">{{$detail['pub_date']}}</small>
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