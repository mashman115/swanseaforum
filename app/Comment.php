<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    /**
    * Get the post the comment is from
    */
    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    /**
    * Get the user who posted the comment
    */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
