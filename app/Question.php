<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    const QUESTION_OPEN = 'abierta';
    const QUESTION_OPEN_AREA = 'abierta_area';
    const QUESTION_MULTIPLE = 'seleccion_multiple';
    const QUESTION_UNIQUE = 'seleccion_unica';

    protected $fillable = [
        'type',
        'question',
        'options',
        'created_at',
        'updated_at',
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

    public function isOpenArea()
    {
        return $this->type == self::QUESTION_OPEN_AREA;
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

    public static function types()
    {
        return [
            (Object) ['id' => self::QUESTION_OPEN, 'name' => 'Pregunta abierta'],
            (Object) ['id' => self::QUESTION_OPEN_AREA, 'name' => 'Pregunta abierta, area de texto'],
            (Object) ['id' => self::QUESTION_MULTIPLE, 'name' => 'Pregunta de selección múltiple'],
            (Object) ['id' => self::QUESTION_UNIQUE, 'name' => 'Pregunta de selección única'],
        ];
    }
}
