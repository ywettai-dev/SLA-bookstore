@extends('layouts.app')
{{-- @php
    dd($issue);
@endphp --}}
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h4>Manage Issue Book</h4>
                </div>
                <div class="card-body">
                    {{-- @if($errors->any())
                        <div class="alert alert-danger fade show">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br>
                    @endif --}}
                    <form action="{{route('issues.update',$issue['id'])}}" method="post">
                        <div class="form-group row">
                            @method('PATCH')
                            @csrf
                            <label for="student_id" class="col-sm-3 col-form-label">Student ID : </label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" name="student_id" value="{{old('student_id',$issue['student_id'])}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="student_name" class="col-sm-3 col-form-label">Student Name : </label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" name="student_name" value="{{old('student_name',$issue['user']['name'])}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="book_isbn" class="col-sm-3 col-form-label">ISBN Number : </label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" name="book_isbn" value="{{old('book_isbn',$issue['book']['b_isbn'])}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="book_title" class="col-sm-3 col-form-label">Book Title : </label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" name="book_title" value="{{old('book_title',$issue['book']['b_title'])}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="book_issue" class="col-sm-3 col-form-label">Issued Date : </label>
                            <div class="col-sm-9">
                            <input type="text" class="form-control" name="book_issue" value="{{old('issued_date',$issue['issued_date'])}}" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="book_return" class="col-sm-3 col-form-label">Return Date : </label>
                            <div class="col-sm-9">
                                @if($issue['returned_date']==null)
                                <span class="badge badge-secondary">{{'Not Returned Yet!'}}</span>
                                @else
                                <span class="badge badge-success">{{$issue['returned_date']}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="book_fine" class="col-sm-3 col-form-label">Fine : </label>
                            <div class="col-sm-9">
                            <input type="number" class="form-control" placeholder="0.00" required name="book_fine" min="0" value="0" step="0.01" title="Currency" pattern="^\d+(?:\.\d{1,2})?$">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-lg btn-block btn-primary">Return Book</button>
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
