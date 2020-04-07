<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserFormRequest;
use Illuminate\Support\Facades\Gate;
// use Auth;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        // return $request->input();

        // dd($request);
        // return response()->view();
        // return response()->download($pathToFile);
        $posts = Post::paginate(10);
        return view('post.index',compact("posts"));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       
        return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        // dd($request->all());

        /* $validator = Validator::make($request->all(),[
            'title' => 'required|min:5|max:10',
            'content' => 'required|min:5|max:50'
        ]);
        if ($validator->fails()) {
            return redirect()->route('posts.create')->withErrors($validator)->withInput();
        } */
        $post = new Post();
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->user_id = $request->user()->id;
        $post->save();
        // return $post->id;
        $posts = Post::paginate(10);
        // return view('post.index',compact("posts"))->with('message','Nuevo Post creado');
        return redirect()->route('posts.index',['post' => $posts])->with('message','Post actualizado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('post.show',compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('post.edit',compact("post"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, Post $post)
    {
        $this->authorize('delete', $post);
        
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();
        return redirect()->route('posts.edit',['post' => $post])->with('message','Post actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
/* 
        $user = Auth::user();
        if (Gate::forUser($user)->denies('delete-post', $post)) {
            return redirect()->back();
        } */

        /* if (Auth::user()->cant('delete', $post)) {
            return redirect()->route('posts.my')->with('message','No tienes permisos para eliminar este post');
        } */

        $this->authorize('delete', $post);
        $post->delete();
        
        return redirect()->route('posts.index')->with('message','Post Eliminado');
        
    }

    public function myPosts(Request $request)
    {
        $posts = Auth::user()->posts;
        // $post = Post::where('user_id');
        // echo $posts;
        return view('post.my',compact("posts"));
    }
}
