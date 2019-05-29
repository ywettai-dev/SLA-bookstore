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
                    <h4>Manage publishers
                        <a href="{{route('publishers.create')}}" class="btn btn-md btn-primary float-sm-right">
                            <i class="fas fa-plus-circle"></i> Add
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="pubs-table">
                            <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Publisher Name</th>
                                <th>Email</th>
                                <th>Description</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach($pubs as $pub)
                                    <tr>
                                        <td>{{$no}}</td>
                                        <td>{{$pub->p_name}}</td>
                                        <td>{{$pub->p_email}}</td>
                                        <td>{{$pub->p_desc}}</td>
                                        <td>
                                            <a href="{{route('publishers.edit',$pub->id)}}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{route('publishers.destroy',$pub->id)}}" method="post">
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
        $('#pubs-table').DataTable();
    } );
</script>
@endsection