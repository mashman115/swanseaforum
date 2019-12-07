<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //

    /**
    * Get the comments on the post
    */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
    * Get the user that made the post
    */
    public function user()
    {
      return $this->belongsTo('App\User');
    }

    /**
    * Get the tags from a post
    */
    public function tags(){
      return $this->belongsToMany('App\Tag');
    }
}
