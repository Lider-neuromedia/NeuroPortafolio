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
        $logo = $this->assets()
            ->where('type', ProjectAsset::LOGO_ASSET)
            ->first();
        $logo->url = url("storage/projects/{$logo->path}");
        return $logo;
    }

    public function getVideosAttribute()
    {
        return $this->assets()
            ->where('type', ProjectAsset::VIDEO_ASSET)
            ->get()
            ->map(function ($i) {
                $i->url = str_replace("watch?v=", "embed/", $i->path);
                return $i;
            });
    }

    public function getImagesAttribute()
    {
        $images = $this->assets()
            ->where('type', ProjectAsset::IMAGE_ASSET)
            ->get()
            ->map(function ($i) {
                $i->url = url("storage/projects/{$i->path}");
                return $i;
            });
        return $images;
    }
}
