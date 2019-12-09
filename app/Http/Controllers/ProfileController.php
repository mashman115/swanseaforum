<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use Illuminate\Support\Facades\DB;


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
      return view('profile.show', ['profile' => $profile]);
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

      session()->flash('messagePost','Profile made!.');

      return redirect()->route('home');
  }
}
