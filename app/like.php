<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    public function post(){
    	return $this->belongsTo(post::class);
    }

    public function users(){
    	return $this->hasmany(user::class);
    }
}
