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
                        Edit Student Information 
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
                        <form method="post" action="{{route('students.update',$user->id)}}">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <label for="name">Student Name:</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $user->name)}}">
                        </div>
                        <div class="form-group">
                            <label for="price">Email:</label>
                            <input type="text" class="form-control" name="email" value={{ old('email', $user->email)}}>
                        </div>              
                        <div class="form-group">
                            <label for="status">Status:</label>
                            <select name="status" id="inputState" class="form-control">
                            @if($user->status==1)
                                <option value="{{old('status',$user->status)}}" selected>Active</option>
                                <option value="0">Inactive</option>
                            @else
                                <option value="0" selected>Inactive</option>
                                <option value="1">Active</option>
                            @endif
                            </select>
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