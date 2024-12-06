<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    public function habilidades()
    {
        return $this->belongsToMany(Habilidad::class, 'habilidad_pokemon', 'pokemon_id', 'habilidad_id');
    }



    protected $table = 'pokemon';

    protected $fillable = [
        'nombre',
        'avatar',
        'descripcion',
        'peso',
        'altura',
        'hp',
        'ataque',
        'defensa',
        'ataque_especial',
        'defensa_especial',
        'velocidad'
    ];
}
