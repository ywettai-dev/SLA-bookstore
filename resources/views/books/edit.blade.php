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
            Edit Book Information
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br>
            @endif
            <form action="{{route('books.update',$book['id'])}}" method="post" enctype="multipart/form-data">
                @method('PATCH')
                @csrf
                <div class="row">
                    <div class="col-md-4">                
                        <div class="form-group">
                            @csrf
                            <label for="name">Book Title : </label>
                            <input type="text" class="form-control" name="b_title" value="{{ old('b_title', $book['b_title'])}}">
                        </div>
                        <div class="form-group">
                            <label for="isbn">ISBN : </label>
                            <input type="text" class="form-control" name="b_isbn" value="{{ old('b_isbn', $book['b_isbn'])}}">
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity : </label>
                            <input type="number" class="form-control" name="b_qty" value="{{ old('b_qty', $book['b_qty'])}}">
                        </div>
                        <div class="form-group">
                            <label for="pubdate">Publishing Date : </label>
                            <input type="date" class="form-control" name="pub_date" value="{{ old('pub_date', $book['pub_date'])}}">
                        </div>
                        <div class="form-group">
                            <label for="edition">Edition : </label>
                            <input type="text" class="form-control" name="b_edition" value="{{ old('edition', $book['edition'])}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Author : </label>
                            <select name="a_id" class="form-control">
                                @foreach($authors as $author)
                                @if($book['a_id']==$author['id'])
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
                                @if($book['g_id']==$genre['id'])
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
                                @if($book['p_id']==$publisher['id'])
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
                            <label for="name">Shelf : </label>
                            <select name="s_id" class="form-control">
                                @foreach($shelves as $shelf)
                                @if($book['s_id']==$shelf['id'])
                                    <option value="{{$shelf['id']}}" selected>
                                    {{$shelf['s_name']}}
                                    </option>
                                @else 
                                    <option value="{{$shelf['id']}}">
                                    {{$shelf['s_name']}}
                                    </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="page">Pages : </label>
                            <input type="text" class="form-control" name="b_page" value="{{ old('b_page', $book['b_page'])}}">
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="price">Prices : </label>
                            <input type="number" class="form-control" name="b_price" value="{{ old('b_price', $book['b_price'])}}">
                        </div>
                        <div class="form-group">
                            <label for="bookcover">Book Cover : </label>
                            <input type="file" class="form-control" name="b_cover">
                            <input type="hidden" name="origin_b_cover" value="{{ $book['b_cover']}}"><br>
                            <div class="card">
                                <div class="card-header">
                                    @if($book['b_cover']!= null)
                                        <img src="{{URL::to('img/'.$book['b_cover'])}}" width="30%" height="30%" alt="Cover image" title="Cover image">
                                        <span class="badge badge-info">{{$book['b_cover']}}</span>
                                    @else
                                        <span class="badge badge-info">No cover has uploaded.</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Description : </label>
                            <textarea class="form-control" name="b_desc" rows="3">{{ old('b_desc', $book['b_desc'])}}</textarea>
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