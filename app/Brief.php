<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brief extends Model
{
    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function clientsAssigned()
    {
        return $this->hasMany(ClientBrief::class);
    }
}
