<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use Illuminate\Support\Facades\DB;
use App\User;


class ProfileController extends Controller
{
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {

      $profile = Profile::where('user_id', $id)->first();
      if ($id == auth()->user()->id ){
        return view('profile.show', ['profile' => $profile]);
      }
      session()->flash('notAuthorized','Not authorized!');
      return redirect()->route('posts.index');
  }

  public function index()
  {
      return view('profile.index');
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
        'description' => 'required',
      ]);

      $profile = new Profile;
      $profile->description = $validatedData['description'];
      $profile->user_id = auth()->user()->id;
      $profile->save();

      session()->flash('messagePost','Profile made!');

      return redirect()->route('posts.index');
  }

  public function isAdmin()
  {
    $profiles = Profile::get();
    return view('profile.showAdmin', ['profiles' => $profiles]);
  }
}
