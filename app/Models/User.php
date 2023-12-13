<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'phone',
        'account_type',
        'biographie',
        'profession',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function fonddecartes()
    {
        return $this->hasMany(FondDeCarte::class);
    }

    public function contributions()
    {
        return $this->hasMany(Contribution::class);
    }
    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }
    public function reponses()
    {
        return $this->hasMany(Reponse::class);
    }
    public function cartes()
    {
        return $this->hasMany(Carte::class);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
