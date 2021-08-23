<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientBrief extends Model
{
    const STATUS_PENDING = 'pendiente';
    const STATUS_CHECKING = 'revision';
    const STATUS_COMPLETED = 'completado';

    protected $fillable = [
        'slug',
        'status',
    ];

    public function brief()
    {
        return $this->belongsTo(Brief::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
