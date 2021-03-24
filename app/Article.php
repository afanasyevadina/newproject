<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($article) {
            if($article->image && file_exists(public_path($article->image))) unlink(public_path($article->image));
            $article->categories()->sync([]);
        });
    }

    protected $fillable = ['title', 'subtitle', 'user_id', 'image', 'content', 'slug'];

    public function user()
    {
    	return $this->belongsTo('App\User')->withDefault();
    }

    public function categories()
    {
        return $this->morphToMany('App\Category', 'taggable');
    }

    public function getDateAttribute()
    {
        $time = strtotime($this->created_at);
        if(time() - $time < 60) return __('Just now');
        if(time() - $time < 3600) return ceil((time() - $time) / 60).' '.__('minutes ago');
        if(time() - $time < 24 * 3600) return ceil((time() - $time) / 3600).' '.__('hours ago');
        if(time() - $time < 7 * 24 * 3600) return ceil((time() - $time) / (24 * 3600)).' '.__('days ago');
    	return date('d.m.Y H:i', $time);
    }

    public function likes()
    {
        return $this->morphMany('App\Rate', 'rateble')->where('rate', 1);
    }

    public function dislikes()
    {
    	return $this->morphMany('App\Rate', 'rateble')->where('rate', 0);
    }

    public function rates()
    {
        return $this->morphMany('App\Rate', 'rateble');
    }

    public function comments()
    {
    	return $this->morphMany('App\Comment', 'commentable');
    }

    public function generateSlug()
    {
        if(!trim($this->title)) $this->slug = $this->id;
        else {
            $this->slug = \Str::slug($this->title);
            $i = 0;
            while(static::where('slug', $this->slug)->where('id', '<>', $this->id)->exists())
                $this->slug = \Str::slug($this->title).'_'.(++$i);
        }
        $this->save();
    }
}
