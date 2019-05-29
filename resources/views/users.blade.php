@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>User List To Approve</h4>
                </div>
                <div class="card-body">
                    @if(session('message'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session('message') }}
                        </div><br>
                    @endif
                    <div class="table-responsive">
                        <table class="table" id="students-table">
                            <tr>
                                <th>User name</th>
                                <th>Email</th>
                                <th>Registered at</th>
                                <th></th>
                            </tr>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td><a href="{{route('admin.users.approve', $user->id)}}" class="btn btn-primary btn-sm">Approve</a></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">No new users waiting for approval found.</td>
                                </tr>
                            @endforelse
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