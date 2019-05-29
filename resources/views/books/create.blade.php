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
            Add New Book
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
            <form action="{{route('books.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-4">                
                        <div class="form-group">
                            @csrf
                            <label for="name">Book Title : </label>
                            <input type="text" class="form-control" name="b_title" value="{{old('b_title')}}">
                            <span class="text-danger">{{$errors->first('b_title')}}</span>
                        </div>
                        <div class="form-group">
                            <label for="isbn">ISBN : </label>
                            <input type="text" class="form-control" name="b_isbn" value="{{old('b_isbn')}}">
                            <span class="text-danger">{{$errors->first('b_isbn')}}</span>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity : </label>
                            <input type="number" class="form-control" name="b_qty" value="{{old('b_qty')}}">
                            <span class="text-danger">{{$errors->first('b_qty')}}</span>
                        </div>
                        <div class="form-group">
                            <label for="pubdate">Publishing Date : </label>
                            <input type="date" class="form-control" name="pub_date" value="{{old('pub_date')}}">
                        </div>
                        <div class="form-group">
                            <label for="edition">Edition : </label>
                            <input type="text" class="form-control" name="b_edition" value="{{old('b_edition')}}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name">Author : </label>
                            <select name="a_id" class="form-control">
                                <option value="">---Select Author---</option>
                                @foreach($authors as $author)
                                <option value="{{$author['id']}}">
                                {{$author['a_name']}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Genre : </label>
                            <select name="g_id" class="form-control">
                                <option value="">---Select Genre---</option>
                                @foreach($genres as $genre)
                                <option value="{{$genre['id']}}">
                                {{$genre['g_name']}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Publisher : </label>
                            <select name="p_id" class="form-control">
                                <option value="">---Select Publisher---</option>
                                @foreach($publishers as $publisher)
                                <option value="{{$publisher['id']}}">
                                {{$publisher['p_name']}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Shelf : </label>
                            <select name="s_id" class="form-control">
                                <option value="">---Select Shelf---</option>
                                @foreach($shelves as $shelf)
                                <option value="{{$shelf['id']}}">
                                {{$shelf['s_name']}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="page">Pages : </label>
                            <input type="text" class="form-control" name="b_page" value="{{old('b_page')}}">
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="price">Prices : </label>
                            <input type="number" class="form-control" name="b_price" value="{{old('b_price')}}">
                        </div>
                        <div class="form-group">
                            <label for="bookcover">Book Cover : </label>
                            <input type="file" class="form-control" name="b_cover">
                        </div>
                        <div class="form-group">
                            <label for="description">Description : </label>
                            <textarea class="form-control" name="b_desc" rows="8">{{old('b_desc')}}</textarea>
                        </div>
                        <div class="float-sm-center">
                            <button type="submit" class="btn btn-lg btn-primary">Add</button>
                            <a href="javascript:history.back()" class="btn btn-lg btn-secondary">Cancel</a>
                        </div>
                    </div> 
                 </div>
            </form>
        </div>
    </div>
</div>
@endsection