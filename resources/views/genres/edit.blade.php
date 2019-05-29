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
                        Edit Genre Information 
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
                        <form method="post" action="{{route('genres.update',$genre->id)}}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="name">Genre Name:</label>
                            <input type="text" class="form-control" name="g_name" value="{{ old('g_name', $genre->g_name)}}">
                        </div>             
                        <div class="form-group">
                          <label for="description">Description:</label>
                        <textarea class="form-control" name="g_desc" rows="6">{{ old('g_desc', $genre->g_desc)}}</textarea>
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