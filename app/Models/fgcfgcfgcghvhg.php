<?php

namespace App\Models;

use App\Models\Couche;
use App\Models\Thematique;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SousThematique extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'image',
    ];


    public function couches () {
        return $this->hasMany(Couche::class);
    }

    public function thematique () {
        return $this->belongsTo(Thematique::class);
    }
}
