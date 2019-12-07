<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = DB::table('posts')->paginate(10);
        //$posts = Post::orderByDesc('created_at')->get();
        $posts = Post::orderByDesc('created_at')->paginate(15);
        return view('posts.index', ['posts' => $posts]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $validatedData = $request->validate([
          'title' => 'required|max:100',
          'content' => 'required|max:255',
          'photo_name' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().$request->file('photo_name')->getClientOriginalName();
        $request->file('photo_name')->move(base_path() . '/public/images/', $imageName);

        $post = new Post;
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
        $post->photo_name = $imageName;
        $post->user_id = auth()->user()->id;

        $post->save();
        session()->flash('messagePost','Post created.');

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
      $post = Post::findOrFail($id);

      $validatedData = $request->validate([
        'title' => 'required|max:100',
        'content' => 'required|max:255',
      ]);

      $post->title = $validatedData['title'];
      $post->content = $validatedData['content'];

      $post->save();
      session()->flash('messageEdit','Post edited successfully.');

      return redirect()->route('posts.index');


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
    }
}
