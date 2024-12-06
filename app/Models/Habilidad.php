<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habilidad extends Model
{
    public function pokemon()
    {
        return $this->belongsToMany(Pokemon::class, 'habilidad_pokemon', 'habilidad_id', 'pokemon_id');
    }



    protected $table = 'habilidads';

    protected $fillable = [
        'nombre',
        'descripcion'
    ];
}
