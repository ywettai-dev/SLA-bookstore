@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(session()->get('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session()->get('success') }}
                </div><br>
            @endif
            <div class="card">
                <div class="card-header">
                    <h4>Manage Students
                        <a href="{{url('/users')}}" class="btn btn-md btn-primary float-sm-right">
                            <i class="fas fa-plus-circle"></i> Approve
                        </a>    
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="students-table">
                            <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Student ID</th>
                                <th>Student Name</th>
                                <th>Email</th>
                                <th>Registerd At</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$no}}</td>
                                        <td>{{$user->uid}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->created_at}}</td>
                                        <td>
                                            @if($user->status == 1)
                                                <span class="badge badge-success">{{'Active'}}</span>
                                            @else
                                                <span class="badge badge-secondary">{{'Inactive'}}</span>
                                            @endif   
                                        </td>
                                        <td>
                                            <a href="{{route('students.edit',$user->id)}}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{route('students.destroy',$user->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger" type="submit">
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php
                                        $no++;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    $(document).ready(function() {
        $('#students-table').DataTable();
    } );
</script>
@endsection