@extends('layouts.app')

@section('content')


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

    <div class="card-header">
        {{isset($post)? "Edit Post  ".$post->name :"Create Post"}}
    </div>
    <div class="card-body">
        <form action="{{isset($post)?route('posts.update',$post->id) :route('posts.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            @if(isset($post))
            @method('put')
            @endif
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" value="{{isset($post)?$post->title:''}}" name="title" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Description</label>
                <textarea type="text" value="" rows="4" cols="4" name="description" class="form-control">{{isset($post)?$post->description:''}}</textarea>
            </div>
            <div class="form-group">
                <label for="title">Content</label>
                <input id="x" type="hidden" name="content" value="{{isset($post)?$post->content:''}}">
                <trix-editor input="x"></trix-editor>

            </div>


            <div class="form-group">

                <label for="title">Category</label>
                <select class="form-control" name="category_id">
                    @foreach($categories as $category)
                    <option value="{{$category->id}}" @if(isset($post)) @if($category->id == $post->category->id)
                        selected
                        @endif
                        @endif
                        >
                        {{$category->name}}
                    </option>

                    @endforeach
                </select>

            </div>

            @if($tags->count() > 0)
            <div class="form-group">

                <label for="title">Tags</label>
                <select class="form-control" name="tags[]" id="select-tags" multiple>
                    @foreach($tags as $tag)
                    <option value="{{$tag->id}}"
                         @if(isset($post)) 
                            @if($post->hasTag($tag->id))
                             selected
                            @endif
                        @endif

                        >{{$tag->name}}</option>
                    @endforeach
                </select>

            </div>
            @endif


            <div class="form-group">

                <label for="title">Image</label>
                <input type="file" name="image" value="" class="form-control">
            </div>


            <div class="form-group">
                <input type="submit" class="btn btn-success" value="{{isset($post)?'Update Post':'Add Post'}}" name="">
            </div>
        </form>
        @if(isset($post))

        <img src="...storage/{{$post->image}}" alt="" width="50" height="50"></img>

        @endif
    </div>

</div>

<script type="text/javascript">
                $(document).ready(function(){
                        $('#select-tags').select2();
                });
</script>

@endsection