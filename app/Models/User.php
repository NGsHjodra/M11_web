<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'tagline'];
    protected $hidden = ['summoner_id', 'tier', 'rank', 'point', 'created_at'];

    public function logs()
    {
        return $this->hasMany(Log::class);
    }
}

