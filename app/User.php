<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'api_token',
        'slug',
        'avatar',
        'born',
        'gender',
        'about',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function interests()
    {
        return $this->belongsToMany('App\Category', 'interest_user');
    }

    public function skills()
    {
        return $this->belongsToMany('App\Category', 'skill_user');
    }

    public function goals()
    {
        return $this->belongsToMany('App\Category', 'goal_user');
    }

    public function subscribers()
    {
        return $this->hasMany('App\Subscription');
    }

    public function subscriptions()
    {
        return $this->hasMany('App\Subscription', 'subscriber_id');
    }

    public function articles()
    {
        return $this->hasMany('App\Article');
    }

    public function projects()
    {
        return $this->hasMany('App\Project');
    }

    public function getSubscriptionAttribute()
    {
        if(!\Auth::user()) return false;
        return $this->subscribers()->where('subscriber_id', \Auth::user()->id)->exists();
    }

    public function getSubscriberAttribute()
    {
        if(!\Auth::user()) return false;
        return $this->subscriptions()->where('subscriber_id', \Auth::user()->id)->exists();
    }

    public function generateSlug()
    {
        if(!trim($this->name)) $this->slug = $this->id;
        else {
            $this->slug = \Str::slug($this->name);
            $i = 0;
            while(static::where('slug', $this->slug)->where('id', '<>', $this->id)->exists())
                $this->slug = \Str::slug($this->name).'_'.(++$i);
        }
        $this->save();
    }
}
