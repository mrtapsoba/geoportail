<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    use HasFactory;
    protected $fillable = [
        'objet',
        'auteur',
        'etat',
        'description', 'fichier',
        'couche_id',

    ];


    public function couches()
    {
        return $this->hasMany(Couche::class);
    }

    public function reponses()
    {
        return $this->morphMany(Reponse::class, 'commentable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
