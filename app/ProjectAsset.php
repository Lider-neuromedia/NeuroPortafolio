<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectAsset extends Model
{
    const VIDEO_ASSET = 'video';
    const IMAGE_ASSET = 'image';
    const LOGO_ASSET = 'logo';

    protected $fillable = [
        'path',
        'type',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
