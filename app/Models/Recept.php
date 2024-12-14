<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recept extends Model
{
    use HasFactory;

    protected $table = 'recepti';
    protected $fillable = [
        'recept_ime', 'opis', 'trajanje_pripreme', 'porcije', 'tezina', 'slika_recepta', 'sastojci', 'instrukcije',
    ];

    protected $casts = [
        'sastojci' => 'array',
        'instrukcije' => 'array',
    ];
}

