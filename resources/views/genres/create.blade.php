@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    Add New Genre
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
                    <form action="{{route('genres.store')}}" method="post">
                        <div class="form-group">
                            @csrf
                            <label for="name">Genre Name : </label>
                            <input type="text" class="form-control" name="g_name">
                        </div>
                        <div class="form-group">
                            <label for="description">Description : </label>
                            <textarea name="g_desc" class="form-control" cols="30" rows="6"></textarea>
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
