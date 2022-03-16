<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Controllers\Auth;
use DB;

use Illuminate\Support\Facades\Http;

class PostsController extends Controller
{
    /**
     * Display a listing of all the articles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        //filter the articles with the expire date and show only not expired articles
        $posts = Post::where('expire_date','>','CURRENT_TIMESTAMPS')
        ->orderBy('created_at', 'desc')->get();
        return view('posts.index')->with('posts' , $posts);
        //return $posts;


    }

    /**
     * Show the form for creating a new article.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created article in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //requirements
        $this->validate($request, [
            'name' => 'required|max:255',
            'content' => 'required',
            'user_id' => 'required|integer',
            'created_at' => 'nullable|date',
            'tag' => 'nullable'
        ]);

        //create a post
        $post = new Post;

        $post->name = $request->name;
        $post->content = $request->content;
        $post->user_id = $request->user_id;
        $post->expire_date = $request->expire_date;
        $post->save();

        return redirect('/posts')->with('success', 'Post successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $post->postGuzzleRequest();
        return view('posts.show')->with('post', $post);
        //return $post;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if(!isset($post)){
            return redirect('/posts')->with('error' , 'No Post Found');
        }

        return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //requirements
        $this->validate($request, [
            'name' => 'required|max:255',
            'content' => 'required',
            'user_id' => 'required|integer',
            'created_at' => 'nullable|date',
            'expire_date' => 'date'
        ]);

        

        $post =  Post::find($id);

        //Update a post
        $post->name = $request->input('name');
        $post->content = $request->input('content');
        $post->user_id = $request->input('user_id');
        $post->tag = $request->input('tag');
        $post->expire_date = $request->input('expire_date');
        $post->save();

        return redirect('/posts')->with('success','Post updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        //check for existing articles before deleting
        if(!isset($post)){
            return redirect('/posts')->with('error' , 'No Post Found');
        }

        $post->delete();

        return redirect('/posts')->with('success' , 'Succesfully deleted');
    }
}
