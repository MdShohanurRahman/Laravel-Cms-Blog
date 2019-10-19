<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\posts\UpdatePostRequest;
use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Image;
use File;

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
        return view('posts.create')->with('categories', Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
        // upload the image to store
        // note goto .env and paste 'FILESYSTEM_DRIVER  = public'
        if ($request->hasFile('image')) {
            //insert that image
            $image = $request->file('image');
            $img = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/posts/' . $img);
            Image::make($image)->save($location);
        }

        /**
         * for manually store image
         * $image = $request->image->store('posts');
         */

        // create the post
        // note add protected fillable in Post model
        Post::create([
            'title'         => $request->title,
            'description'   => $request->description,
            'content'       => $request->content,
            'image'         => $img,
            'published_at'  => $request->published_at,
            'category_id'   => $request->category,
            'user_id'       => 1
        ]);

        // flash the message
        session()->flash('success', 'post created successfully');

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
        return view('posts.create')->with('post', $post)->with('categories', Category::all());
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
        $data = $request->only(['title', 'description', 'published_at', 'content', 'category_id']);

        // check if new image
        if ($request->hasFile('image')) {

            // delete old one
            if (File::exists('images/posts/' . $post->image)) {
                File::delete('images/posts/' . $post->image);
            }

            // upload new image
            $image = $request->file('image');
            $img = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/posts/' . $img);
            Image::make($image)->save($location);

            // assign new image location
            $data['image'] = $img;
        }

        // update attributes
        // $data['category_id'] = $request->category_id;
        $post->update($data);

        // flash message
        session()->flash('success', 'Post updated successfully.');

        // redirect user
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
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        if ($post->trashed()) {
            // Delete post image
            if (File::exists('images/posts/' . $post->image)) {
                File::delete('images/posts/' . $post->image);
            }
            $post->forceDelete();
        } else {
            $post->delete();
        }

        session()->flash('success', 'Post trashed successfully');

        return redirect(route('posts.index'));
    }

    /**
     * Display the list of all trashed posts.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function trashed()
    {
        $trashed = Post::onlyTrashed()->get();

        return view('posts.index')->with('posts', $trashed);
    }

    /**
     * Restoring trashed posts.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->firstOrFail();

        $post->restore();

        session()->flash('success', 'Post restored successfully.');

        return redirect()->back();
    }
}
