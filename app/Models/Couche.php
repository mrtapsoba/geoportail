<?php

namespace App\Models;

use App\Models\Thematique;
use App\Models\SousThematique;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Couche extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'fichier',
        'description',
        'annee_prod',
        'added_on',
    ];

    public function sousThematique()
    {
        return $this->belongsTo(SousThematique::class);
    }
    public function contributions()
    {
        return $this->hasMany(Contribution::class);
    }
    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }
}
