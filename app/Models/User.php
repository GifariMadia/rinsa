<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
        'avatar', // Tambahan untuk foto profil
        'bio',    // Tambahan untuk bio singkat
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password'  => 'hashed',
        'is_active' => 'boolean',
    ];

    // Relationships
    public function orders(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Order::class, 'created_by');
    }

    // Helpers
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}