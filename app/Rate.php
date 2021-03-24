<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{

    protected $fillable = [
        'rateble_id', 
        'rateble_type', 
        'user_id', 
        'rate'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User')->withDefault();
    }

    public function rateble()
    {
        return $this->morphTo();
    }

    public function getDateAttribute()
    {
    	return date('d.m.Y H:i', strtotime($this->created_at));
    }
}
