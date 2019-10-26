<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostsRequest;
use App\Post;
use App\Tag;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('verifyCategoriesCount')->only(['create', 'store']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
        // upload the image to storage
        $image = $request->image->store('posts');

        //print_r($request->published_at);die();

        $post = Post::create([
            'title'         => $request->title,
            'description'   => $request->description,
            'image'         => $image,
            'content'       => $request->content,
            'published_at'  => $request->published_at,
            'category_id'   => $request->category,
            'user_id'       => auth()->user()->id,
        ]);

        if($request->tags){

            $post->tags()->attach($request->tags);
        }

        // flash message

        session()->flash('success', 'Post created successfully');

        // redirect user

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
        return view('posts.create')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostsRequest $request, Post $post)
    {
        $data = $request->only(['title','description','published_at','content']);

        // check id new image
        if ($request->hasFile('image')){

            // upload it

            $image = $request->image->store('posts');

            // delete old one

            $post->deleteImage();

            $data['image'] = $image;
        }

        if($request->tags){

            $post->tags()->sync($request->tags); //sync helps for many to many relations
        }



        // update attribute

        $post->update($data);


        // flash message
        session()->flash('success', 'Post updated successfully');

        // redirect
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        if ($post->trashed()){
            $post->deleteImage();
            $post->forceDelete();
            session()->flash('success', 'Post Deleted successfully');

            return back();

        } else {

            $post->delete();
            session()->flash('success', 'Post trashed successfully');
            return redirect(route('posts.index'));
        }


        // flash message



        // redirect user


    }


    /**
     * Displays the list of all trashed posts
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        //


        $trashed = Post::onlyTrashed()->get();
        // redirect user

        return view('posts.index')->with('posts', $trashed);
    }

    public function restore($id){

        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        $post->restore();

        session()->flash('success', 'Post restored successfully');
        return redirect()->back();
    }
}
