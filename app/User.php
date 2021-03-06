<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','username', 'email', 'isAdmin', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
    * Get the posts that the user has made.
    */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
    /**
    * Get the comments that the user has made.
    */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    /**
    *
    */
    public function profile(){
      return $this->belongsTo('App\Profile');
    }

    public function isAdmin(){
      return DB::table('users')->where('id', auth()->user()->id)->value('isAdmin');

      // if ($isAdmin == true){
      //   return true;
      // }
      // return false;
    }
}
