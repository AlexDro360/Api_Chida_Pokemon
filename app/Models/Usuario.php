<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuario';

    protected $fillable = [
        'name',
        'avatar',
        'apellidoP',
        'apellidoM',
        'email',
        'password',
        'phone'
    ];
}
