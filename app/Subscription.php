<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{

    protected $fillable = ['user_id', 'subscriber_id'];

    public function user()
    {
    	return $this->belongsTo('App\User')->withDefault();
    }

    public function subscriber()
    {
        return $this->belongsTo('App\User', 'subscriber_id')->withDefault();
    }
}
