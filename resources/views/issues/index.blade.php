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
                    <h4>Manage Issued Books
                        <a href="{{route('issues.create')}}" class="btn btn-md btn-primary float-sm-right">
                            <i class="fas fa-plus-circle"></i> Add 
                        </a>
                        <a href="{{ url('dynamic_pdf/pdf') }}" class="btn btn-md btn-danger float-sm-right" style="margin-right:10px;">
                            <i class="fas fa-file-download"></i> Convert PDF
                        </a>  
                        <button onClick="swal('Coming Soon!','Export to CSV', 'warning')" class="btn btn-md btn-success float-sm-right" style="margin-right:10px;">
                            <i class="fas fa-file-download"></i> Export CSV
                        </button> 
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="issues-table">
                            <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Book Title</th>
                                <th>Student ID</th>
                                <th>Student Name</th>
                                <th>Issued Date</th>
                                <th>Returned Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach($issues as $issue)
                                    <tr>
                                        <td>{{$no}}</td>
                                        <td>
                                            <a href="{{url('detail/admin/'.$issue['book']['id'])}}">
                                                {{$issue['book']['b_title']}}
                                            </a>
                                        </td>
                                        <td>{{$issue['user']['uid']}}</td>
                                        <td>{{$issue['user']['name']}}</td>
                                        <td>
                                            <span class="badge badge-primary">
                                                 {{$issue['issued_date']}}
                                            </span>        
                                        </td>
                                        <td>
                                            @if($issue['returned_date']!= null)
                                                <span class="badge badge-success">
                                                    {{$issue['returned_date']}}
                                                </span>
                                            @else
                                                <span class="badge badge-secondary">
                                                    {{'Not Returned Yet'}}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('issues.edit',$issue['id'])}}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
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
        $('#issues-table').DataTable();
    } );
</script>
@endsection