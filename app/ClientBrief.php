<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientBrief extends Model
{
    const STATUS_PENDING = 'pendiente';
    const STATUS_COMPLETED = 'completado';

    protected $fillable = [
        'slug',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
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

    public function scopeNotCompleted($query)
    {
        return $query->where('status', '!=', self::STATUS_COMPLETED);
    }

    public function getIsCompletedAttribute()
    {
        return $this->status == self::STATUS_COMPLETED;
    }
    public function getIsNotCompletedAttribute()
    {
        return $this->status !== self::STATUS_COMPLETED;
    }
}
