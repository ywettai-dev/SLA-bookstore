@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h4>Issue Book</h4>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger fade show">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br>
                    @endif
                    <form action="{{route('issues.store')}}" method="post">
                        <div class="form-group">
                            @csrf
                            <label for="studentid">Student ID : </label>
                            <input type="text" class="form-control" name="student_id" placeholder="Enter Student ID" value="{{old('student_id')}}">
                            <span class="text-danger">{{$errors->first('student_id')}}</span>
                        </div>
                        <div class="form-group">
                            <label for="isbn">Book ISBN Number : </label>
                            <input type="text" class="form-control" name="book_isbn" placeholder="Enter Book ISBN Number" value="{{old('book_isbn')}}">
                            <span class="text-danger">{{$errors->first('book_isbn')}}</span>
                        </div>
                        <button type="submit" class="btn btn-lg btn-block btn-primary">Issue Book</button>
                        <a href="javascript:history.back()" class="btn btn-lg btn-block btn-secondary">Cancel</a>
                    </form>
                </div> 
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')

@endsection
