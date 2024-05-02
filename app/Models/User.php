<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guarded = [];
    // protected $hidden = ['puuid', 'summoner_id', 'tier', 'rank', 'point'];
    // protected $dates = ['last_match_history_update'];

    public function logs()
    {
        return $this->hasMany(Log::class, 'puuid', 'puuid');
    }
}

