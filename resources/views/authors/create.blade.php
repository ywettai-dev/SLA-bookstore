@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    Add New Author
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
                    <form action="{{route('authors.store')}}" method="post">
                        <div class="form-group">
                            @csrf
                            <label for="name">Author Name : </label>
                        <input type="text" class="form-control" name="a_name" value="{{old('a_name')}}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email : </label>
                            <input type="text" class="form-control" name="a_email" value="{{old('a_email')}}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description : </label>
                            <textarea name="a_desc" class="form-control" cols="30" rows="4" required>{{old('a_desc')}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-lg btn-block btn-primary">Add</button>
                        <a href="javascript:history.back()" class="btn btn-lg btn-block btn-secondary">Cancel</a>
                    </form>
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection
