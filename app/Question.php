<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    const QUESTION_OPEN = 'abierta';
    const QUESTION_MULTIPLE = 'seleccion_multiple';
    const QUESTION_UNIQUE = 'seleccion_unica';

    protected $fillable = [
        'type',
        'question',
        'options',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'options' => 'array',
    ];

    public function brief()
    {
        return $this->belongsTo(Brief::class);
    }

    public function isOpen()
    {
        return $this->type == self::QUESTION_OPEN;
    }

    public function isMultipleSelection()
    {
        return $this->type == self::QUESTION_MULTIPLE;
    }

    public function isUniqueSelection()
    {
        return $this->type == self::QUESTION_UNIQUE;
    }

    public function getTagIdAttribute()
    {
        return \Str::slug($this->type) . "-" . $this->id;
    }
}
