@extends('layouts.app')

@section('content')
<div class="container">


    <div class="d-flex justify-content-end mb-2">
        <a href="{{route('categories.create')}}" class="btn btn-success">Add Category</a>
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

        <div class="card-header">Category</div>

        <div class="card-body">
            @if($categories->count()>0)
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th>Post Counts</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{$category->name}}</td>
                        <td>{{$category->posts->count()}}</td>
                        <td>
                            <a href="{{route('categories.edit',$category->id)}}" class="btn btn-info btn-sm">Edit</a>
                        </td>
                        <td>
                            <form class="delete_form" action="{{route('categories.destroy',$category->id)}}" method="post">
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
            <h3 class="text text-center">No Category</h3>
            @endif
        </div>

    </div>
</div>


@endsection