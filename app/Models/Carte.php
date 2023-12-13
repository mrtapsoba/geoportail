<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carte extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nom',
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
