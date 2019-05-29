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
                    <h4>Manage Books
                        <a href="{{route('books.create')}}" class="btn btn-md btn-primary float-sm-right">
                            <i class="fas fa-plus-circle"></i> Add
                        </a>
                        <a href="{{ url('dynamic_pdf/pdfBook') }}" class="btn btn-md btn-danger float-sm-right" style="margin-right:10px;">
                            <i class="fas fa-file-download"></i> Convert PDF
                        </a>  
                        <button onClick="swal('Coming Soon!','Export to CSV', 'warning')" class="btn btn-md btn-success float-sm-right" style="margin-right:10px;">
                            <i class="fas fa-file-download"></i> Export CSV
                        </button>     
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="books-table">
                            <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Book Title</th>
                                <th>ISBN</th>
                                <th>Author</th>
                                <th>Shelf</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach($books as $book)
                                    <tr>
                                        <td>{{$no}}</td>
                                        <td>
                                            <a href="{{url('detail/admin/'.$book['id'])}}">
                                                {{$book['b_title']}}
                                            </a>
                                        </td>
                                        <td>{{$book['b_isbn']}}</td>
                                        <td>{{$book['author']['a_name']}}</td>
                                        <td>{{$book['shelf']['s_name']}}</td>
                                        <td>
                                            <a href="{{route('books.edit',$book['id'])}}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{route('books.destroy',$book['id'])}}" method="post">
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
        $('#books-table').DataTable();
    } );
</script>
@endsection