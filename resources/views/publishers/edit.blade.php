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
                        Edit Publisher Information 
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
                        <form method="post" action="{{route('publishers.update',$pubs->id)}}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="name">Publisher Name:</label>
                            <input type="text" class="form-control" name="p_name" value="{{ old('p_name', $pubs->p_name)}}">
                        </div>
                        <div class="form-group">
                            <label for="price">Email:</label>
                            <input type="text" class="form-control" name="p_email" value={{ old('p_email', $pubs->p_email)}}>
                        </div>              
                        <div class="form-group">
                          <label for="">Description:</label>
                        <textarea class="form-control" name="p_desc" rows="3">{{ old('p_desc', $pubs->p_desc)}}</textarea>
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