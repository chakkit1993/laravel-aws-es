<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Category;
use App\Tag;
use App\Http\Middleware\VerifyCategory;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('verifyCategory')->only(['create', 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create')
        ->with('categories', Category::all())
        ->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        // insert data to db
        $image = $request->image->store('posts');
        $post = Post::create([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'image' => $image,
            'category_id' => $request->category_id,
            'user_id' => auth()->user()->id
        ]);

        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }


        Session()->flash('success', 'บันทึกข้อมูลสำเร็จ');

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')
        ->with('post', $post)
        ->with('categories', Category::all())
        ->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        // $post->update(([
        //     'title'=>$request->title

        // ]));
        $data = $request->only(['title', 'description', 'content']);

        if ($request->hasFile('image')) {

            $image = $request->image->store('posts');
            $post->deleteImage();
            $data['image'] = $image;
        }

        if ($request->category_id) {
            $data['category_id'] = $request->category_id;
        }

        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }



      

        $post->update($data);


        Session()->flash('success', 'แก้ไขข้อมูลสำเร็จ');

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tags()->detach($post->post_id);
        $post->delete();
        $post->deleteImage();
        Session()->flash('success', 'ลบข้อมูลสำเร็จ');

        return redirect(route('posts.index'));
    }
}
