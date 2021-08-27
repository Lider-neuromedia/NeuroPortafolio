<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'question',
        'answer',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'answer' => 'array',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function clientBrief()
    {
        return $this->belongsTo(ClientBrief::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
