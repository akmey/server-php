<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Key extends Model {

    protected $table = 'keys';

    protected $fillable = ['key', 'comment'];

    public function user() {
        return $this->belongsTo('App\User');
    }

}
