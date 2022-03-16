<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class PostsController extends Controller
{
    /**
     * Display a listing of all the articles.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //syntax with DB


        //syntax with eloquent
        $posts = Post::orderBy('created_at', 'desc')->get();
        return $posts;


    }

    /**
     * Show the form for creating a new article.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'name' => 'required',
            'content' => 'required'
        ]);

        //create a post

        $post = new Post;

        $post->name = $request->name;
        $post->content = $request->content;
        //$post->user_id=Auth::user()->id;
        $post->user_id = $request->user_id;
        $post->save();


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
        return $post;
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
            'name' => 'required',
            'content' => 'required'
        ]);

        

        $post =  Post::find($id);

        //Update a post


        $post->name = $request->input('name');
        $post->content = $request->input('content');
        $post->user_id = $request->input('user_id');
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
