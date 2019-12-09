<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
  /**
  * Get the user from profile
  */
  public function user()
  {
      return $this->belongsTo('App\User');
  }

}
