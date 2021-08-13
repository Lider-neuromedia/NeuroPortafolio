<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
        'slug',
    ];

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public static function generateUniqueSlug()
    {
        $slug = null;

        do {
            $slug = \Str::random(8);
        } while (Link::where('slug', $slug)->exists());

        return $slug;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
