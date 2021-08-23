<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'question',
        'answer',
    ];

    protected $casts = [
        'answer' => 'array',
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
