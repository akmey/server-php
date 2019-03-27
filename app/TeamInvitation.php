<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamInvitation extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function team()
    {
        return $this->belongsTo('App\Team');
    }
}
