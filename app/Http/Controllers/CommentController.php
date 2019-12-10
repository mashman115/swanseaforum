<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        'content' => 'required|max:255',
      ]);

      $comment = new Comment;

      $comment->content = $validatedData['content'];
      $comment->post_id = $request->input("post_id");
      $comment->user_id = auth()->user()->id;

      $comment->save();
      session()->flash('message','Comment added.');

      return redirect()->route('posts.show',['id' => $request->input("post_id")]);
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
    public function edit($id)
    {
        //
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
      $comment = Comment::findOrFail($id);

      $validatedData = $request->validate([
        'content' => 'required|max:255',
      ]);

      $comment->content = $validatedData['content'];

      $comment->save();
      $message = "messageEdit" . $comment->id;
      session()->flash($message,'Comment edited successfully.');

      return redirect()->route('posts.show',['id' => $comment->post_id]);
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

    public function apiIndex($id)
    {
      $comments = Comment::all()->where('post_id',$id);
      return $comments;
    }

    public function apiStore(Request $request, $id,$user_id)
    {
      $comment = new Comment;

      $comment->content = $request['name'];
      $comment->post_id = $id;
      $comment->user_id = $user_id;
      $comment->save();

      return $comment;
    }
}
