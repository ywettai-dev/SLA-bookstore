@extends('layouts.app')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
<div class="container">
    <div class="card uper">
        <div class="card-header">
            Upload New Ebook
        </div>
        <div class="card-body">
            {{-- @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br>
            @endif --}}
            <form action="{{route('ebooks.update',$ebook['id'])}}" method="post" enctype="multipart/form-data">
                 @method('PATCH')
                @csrf
                <div class="row">
                    <div class="col-md-4">                
                        <div class="form-group">
                            @csrf
                            <label for="name">Ebook Title : </label>
                            <input type="text" class="form-control" name="ebook_title" value="{{old('ebook_title', $ebook['ebook_title'])}}">
                            <span class="text-danger">{{$errors->first('ebook_title')}}</span>
                        </div>
                        <div class="form-group">
                            <label for="isbn">ISBN : </label>
                            <input type="text" class="form-control" name="ebook_isbn" value="{{old('ebook_isbn', $ebook['ebook_isbn'])}}">
                            <span class="text-danger">{{$errors->first('ebook_isbn')}}</span>
                        </div>
                        <div class="form-group">
                            <label for="pubdate">Publishing Date : </label>
                            <input type="date" class="form-control" name="pub_date" value="{{old('pub_date', $ebook['pub_date'])}}">
                        </div>
                        <div class="form-group">
                            <label for="edition">Edition : </label>
                            <input type="text" class="form-control" name="ebook_edition" value="{{old('ebook_edition', $ebook['edition'])}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Author : </label>
                            <select name="a_id" class="form-control">
                                @foreach($authors as $author)
                                @if($ebook['a_id']==$author['id'])
                                    <option value="{{$author['id']}}" selected>
                                    {{$author['a_name']}}
                                    </option>
                                @else 
                                    <option value="{{$author['id']}}">
                                    {{$author['a_name']}}
                                    </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Genre : </label>
                            <select name="g_id" class="form-control">
                                @foreach($genres as $genre)
                                @if($ebook['g_id']==$genre['id'])
                                    <option value="{{$genre['id']}}" selected>
                                    {{$genre['g_name']}}
                                    </option>
                                @else 
                                    <option value="{{$genre['id']}}">
                                    {{$genre['g_name']}}
                                    </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Publisher : </label>
                            <select name="p_id" class="form-control">
                                @foreach($publishers as $publisher)
                                @if($ebook['p_id']==$publisher['id'])
                                    <option value="{{$publisher['id']}}" selected>
                                    {{$publisher['p_name']}}
                                    </option>
                                @else 
                                    <option value="{{$publisher['id']}}">
                                    {{$publisher['p_name']}}
                                    </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="page">Pages : </label>
                            <input type="text" class="form-control" name="ebook_page" value="{{old('ebook_page', $ebook['ebook_page'])}}">
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="ebookcover">Ebook Cover : </label>
                            <input type="file" class="form-control" name="ebook_cover">
                            <span class="text-danger">{{$errors->first('ebook_cover')}}</span>
                            <input type="hidden" name="origin_ebook_cover" value="{{ $ebook['ebook_cover']}}"><br>
                            <div class="card">
                                <div class="card-header">
                                    @if($ebook['ebook_cover']!= null)
                                    <img src="{{URL::to('img/'.$ebook['ebook_cover'])}}" width="30%" height="30%" alt="Cover image" title="{{$ebook['ebook_title']}}">
                                        <span class="badge badge-info">{{$ebook['ebook_cover']}}</span>
                                    @else
                                        <span class="badge badge-info">No cover has uploaded.</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="ebookpdf">Ebook File (in pdf) : </label>
                            <input type="file" class="form-control" name="ebook_pdf">
                            <input type="hidden" name="origin_ebook_pdf" value="{{ $ebook['ebook_pdf']}}"><br>
                            <span class="text-danger">{{$errors->first('ebook_pdf')}}</span>
                        </div>
                        <div class="form-group">
                            <label for="description">Description : </label>
                            <textarea class="form-control" name="ebook_desc" rows="5">{{old('ebook_desc', $ebook['ebook_desc'])}}</textarea>
                        </div>
                        <div class="float-sm-center">
                            <button type="submit" class="btn btn-lg btn-primary">Update</button>
                            <a href="javascript:history.back()" class="btn btn-lg btn-secondary">Cancel</a>
                        </div>
                    </div> 
                 </div>
            </form>
        </div>
    </div>
</div>
@endsection