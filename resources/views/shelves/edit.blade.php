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
                        Edit Shelf Information 
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
                        <form method="post" action="{{route('shelves.update',$shelf->id)}}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="name">Shelf Name:</label>
                            <input type="text" class="form-control" name="s_name" value="{{ old('s_name', $shelf->s_name)}}">
                        </div>            
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select name="s_status" id="inputState" class="form-control">
                            @if($shelf->status==1)
                                <option value="{{old('status',$shelf->status)}}" selected>Active</option>
                                <option value="0">Inactive</option>
                            @else
                                <option value="0" selected>Inactive</option>
                                <option value="1">Active</option>
                            @endif
                            </select>
                        </div>
                        <div class="form-group">
                          <label for="">Description:</label>
                        <textarea class="form-control" name="s_desc" rows="3">{{ old('s_desc', $shelf->s_desc)}}</textarea>
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