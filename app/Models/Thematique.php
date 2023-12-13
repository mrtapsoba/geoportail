<?php

namespace App\Models;

use App\Models\SousThematique;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thematique extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'image',
    ];

    public function sousThematiques()
    {
        return $this->hasMany(SousThematique::class, 'thematique_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
