@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Books List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="books-list">
                            <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Book Title</th>
                                <th>ISBN</th>
                                <th>Author</th>
                                <th>Shelf</th>
                                <th>Availability</th>
                                <th>Edition</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach($all_books as $book)
                                    <tr>
                                        <td>{{$no}}</td>
                                        <td>
                                            {{-- @auth
                                            <a href="{{url('detail/admin/'.$book['id'])}}">
                                                {{$book['b_title']}}
                                            </a>
                                            @else --}}
                                            <a href="{{url('detail/'.$book['id'])}}">
                                                {{$book['b_title']}}
                                            </a>
                                            {{-- @endauth --}}
                                        </td>
                                        <td>{{$book['b_isbn']}}</td>
                                        <td>{{$book['author']['a_name']}}</td>
                                        <td>{{$book['shelf']['s_name']}}</td>
                                        <td>
                                            @if($book['b_qty']>0)
                                            <span class="badge badge-success">{{'Yes'}}</span> 
                                            @else
                                            <span class="badge badge-success">{{'No'}}</span>
                                            @endif    
                                        </td>
                                        <td>{{$book['edition']}} Edition</td>
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
        $('#books-list').DataTable();
    } );
</script>
@endsection