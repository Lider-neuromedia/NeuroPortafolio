<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    const ROLE_ADMIN = "admin"; // Administradores de neuromedia.
    const ROLE_VIEWER = "viewer"; // El usuario solo puede ver.

    protected $fillable = [
        'name', 'email', 'password', 'roles',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'roles' => 'array',
    ];

    public function getRoleDescriptionAttribute()
    {
        return self::roles()[$this->role];
    }

    public function hasRole($role)
    {
        return in_array($role, $this->roles);
    }

    public function isAdmin()
    {
        return $this->hasRole(self::ROLE_ADMIN);
    }

    public function isViewer()
    {
        return $this->hasRole(self::ROLE_VIEWER);
    }

    public static function roles()
    {
        return [
            self::ROLE_ADMIN => 'Administrador',
            self::ROLE_VIEWER => 'Espectador',
        ];
    }
}
