@extends('layouts.app')

@section('content')

    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card uper">
                    <div class="card-header">
                        Edit Author Information 
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                        @endforeach
                                </ul>
                            </div><br>
                        @endif
                        <form method="post" action="{{route('authors.update',$author->id)}}">
                            @method('PATCH')
                            @csrf
                            <div class="form-group">
                                <label for="name">Author Name:</label>
                                <input type="text" class="form-control" name="a_name" value="{{ old('a_name', $author->a_name)}}">
                            </div>
                            <div class="form-group">
                                <label for="price">Email:</label>
                                <input type="text" class="form-control" name="a_email" value={{ old('a_email', $author->a_email)}}>
                            </div>              
                            <div class="form-group">
                            <label for="">Description:</label>
                            <textarea class="form-control" name="a_desc" rows="3">{{ old('a_desc', $author->a_desc)}}</textarea>
                            </div>
                            <button type="submit" class="btn btn-lg btn-block btn-primary">Update</button>
                            <a href="javascript:history.back()" class="btn btn-lg btn-block btn-secondary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection