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
                    <h4>Manage Ebooks
                        <a href="{{route('ebooks.create')}}" class="btn btn-md btn-primary float-sm-right">
                            <i class="fas fa-plus-circle"></i> Add
                        </a>
                        <a href="{{ url('dynamic_pdf/pdfEbook') }}" class="btn btn-md btn-danger float-sm-right" style="margin-right:10px;">
                            <i class="fas fa-file-download"></i> Convert PDF
                        </a>  
                        <button onClick="swal('Coming Soon!','Export to CSV', 'warning')" class="btn btn-md btn-success float-sm-right" style="margin-right:10px;">
                            <i class="fas fa-file-download"></i> Export CSV
                        </button>         
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="ebooks-table">
                            <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Ebook Title</th>
                                <th>ISBN</th>
                                <th>Author</th>
                                <th>Genre</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach($ebooks as $ebook)
                                    <tr>
                                        <td>{{$no}}</td>
                                        <td>
                                            <a href="{{url('detail/admin/ebook/'.$ebook['id'])}}">
                                                {{$ebook['ebook_title']}}
                                            </a>
                                        </td>
                                        <td>{{$ebook['ebook_isbn']}}</td>
                                        <td>{{$ebook['author']['a_name']}}</td>
                                        <td>{{$ebook['genre']['g_name']}}</td>
                                        <td>
                                            <a href="{{route('ebooks.edit',$ebook['id'])}}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{route('ebooks.destroy',$ebook['id'])}}" method="post">
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
        $('#ebooks-table').DataTable();
    } );
</script>
@endsection