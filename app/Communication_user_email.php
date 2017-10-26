<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Communication_user_email extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
