<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'surnames',
        'email',
        'pokemons',
        'birth_date',
        'role'
    ];

}
