<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FondDeCarte extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'image',
        'lien',
        'attribution'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
