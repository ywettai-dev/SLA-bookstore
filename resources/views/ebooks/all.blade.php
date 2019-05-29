@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Ebooks List</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="ebooks-list">
                            <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Ebook Title</th>
                                <th>ISBN</th>
                                <th>Author</th>
                                <th>Publishing Date</th>
                                <th>Edition</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach($all_ebooks as $ebook)
                                    <tr>
                                        <td>{{$no}}</td>
                                        <td>
                                            {{-- @auth
                                            <a href="{{url('detail/admin/ebook/'.$ebook['id'])}}">
                                                {{$ebook['ebook_title']}}
                                            </a>
                                            @else --}}
                                            <a href="{{url('detail/ebook/'.$ebook['id'])}}">
                                                {{$ebook['ebook_title']}}
                                            </a>
                                            {{-- @endauth --}}
                                        </td>
                                        <td>{{$ebook['ebook_isbn']}}</td>
                                        <td>{{$ebook['author']['a_name']}}</td>
                                        <td>{{$ebook['pub_date']}}</td>
                                        <td>{{$ebook['edition']}} Edition</td>
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
        $('#ebooks-list').DataTable();
    } );
</script>
@endsection