@extends('layout')

@section('content')

    <style>
        .uper {
            margin-top: 40px;
        }
    </style>

    <div class="uper">
        @if(session()->get('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session()->get('success') }}
            </div><br>
        @endif
        <table class="table table-striped">
            <thead>
            <tr>
                <td>ID</td>
                <td>Stock Name</td>
                <td>Stock Price</td>
                <td>Stock Quantity</td>
                <td colspan="2">Action</td>
            </tr>
            </thead>
            <tbody>
                @foreach($shares as $share)
                    <tr>
                        <td>{{$share->id}}</td>
                        <td>{{$share->share_name}}</td>
                        <td>{{$share->share_price}}</td>
                        <td>{{$share->share_qty}}</td>
                        <td><a href="{{route('shares.edit',$share->id)}}" class="btn btn-sm btn-warning">Edit</a></td>
                        <td>
                            <form action="{{route('shares.destroy',$share->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection
