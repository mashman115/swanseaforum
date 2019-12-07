<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
    * The posts this tag has
    */
    public function posts()
    {
      return $this->belongsToMany('App\Post');
    }
}
