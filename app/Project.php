<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'description',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function assets()
    {
        return $this->hasMany(ProjectAsset::class);
    }

    public function links()
    {
        return $this->belongsToMany(Link::class);
    }

    public function getLogoAttribute()
    {
        return $this->assets()->where('type', ProjectAsset::LOGO_ASSET)->first();
    }

    public function getVideosAttribute()
    {
        return $this->assets()->where('type', ProjectAsset::VIDEO_ASSET)->get();
    }
    public function getImagesAttribute()
    {
        return $this->assets()->where('type', ProjectAsset::IMAGE_ASSET)->get();
    }
}
