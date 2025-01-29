<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();

        return view('post.index', [ "posts" => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("post.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $post = new Post();
        $post->author = $request->input("author");
        $post->title = $request->input("title");
        $post->content = $request->input("content");
        $post->color = $request->input("color");
        $post->save();
        return redirect('/post')->with("message", "Post successfuly created");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        //$post = Post::findOrFail($id); // select * from post where id = $id
        $post = DB::select("select * from posts where id = ".$id);
        return view('post.show', ["post" => $post[0]]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = DB::select("select * from posts where id = ".$id);
        return view('post.edit', ["post" => $post[0]]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id); 
        $post->author = $request->input("author");
        $post->title = $request->input("title");
        $post->content = $request->input("content");
        $post->color = $request->input("color");
        $post->update();
        return redirect('/post')->with("message", "Post successfuly updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post=Post::findOrFail($id);
        $post->delete() ;
        return redirect('/post')->with("message", "Post successfuly deleted");

    }
}
