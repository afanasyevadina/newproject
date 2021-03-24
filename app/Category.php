<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $fillable = ['name_ru', 'name_en', 'slug'];

    protected $appends = ['name'];

    public function getNameAttribute()
    {
        return $this['name_' . app()->getLocale()];
    }
}
