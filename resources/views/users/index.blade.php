@extends('layouts.app')

@section('content')
<div class="container">

    <div class="d-flex justify-content-end mb-2">
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

        <div class="card-header">User</div>

        <div class="card-body">
        @if($users->count()>0)
            <table class="table">
                <thead>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Edit</th>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if(!$user->isAdmin())
                            <form class="" action="{{route('users.makeadmin',$user->id)}}" method="post">
                                @csrf
                              
                                <input type="submit"  class="btn btn-info btn-sm " Value="Make Admin" ></input>
                            </form>
                            @endif
                        </td>
                        <td>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <h3 class="text text-center">No User</h3>
            @endif
        </div>

    </div>
</div>


@endsection