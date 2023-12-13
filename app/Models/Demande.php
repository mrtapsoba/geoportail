<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;
    protected $fillable = [
        'objet',
        'auteur',
        'etat',
        'email',
        'mot_cle',
        'fiche_demande',
        'justificatifs',
        'reponses',
    ];



    public function reponses()
    {
        return $this->morphMany(Reponse::class, 'reponsetable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
