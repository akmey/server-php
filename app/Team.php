<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'bio', 'creator_id', 'adminopen'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'adminopen'
    ];

    public function creator()
    {
        return $this->belongsTo('App\User', 'creator_id');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function invitations()
    {
        return $this->hasMany('App\TeamInvitation');
    }
}
