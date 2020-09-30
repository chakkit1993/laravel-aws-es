@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
          
        
        </div>

    <div class="d-flex justify-content-end mb-2">
        <a href="{{route('tags.create')}}" class="btn btn-success">Add Tag</a>
    </div>
    <div class="card card-default">
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="list-group">
                @foreach($errors->all() as $error)
                <li class="list-group-item">{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card-header">Tags</div>

        <div class="card-body">
            @if($tags->count()>0)
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    @foreach($tags as $tag)
                    <tr>
                        <td>{{$tag->name}}</td>
                       
                        <td>
                            <a href="{{route('tags.edit',$tag->id)}}" class="btn btn-info btn-sm">Edit</a>
                        </td>
                        <td>
                            <form class="delete_form" action="{{route('tags.destroy',$tag->id)}}" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="submit" name="" value="Delete" class="btn btn-danger btn-sm">
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <h3 class="text text-center">No Tag</h3>
            @endif
        </div>

    </div>
</div>


@endsection