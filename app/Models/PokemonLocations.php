<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PokemonLocations extends Model
{
    use HasFactory;
    protected $table = 'pokemon_locations';
    protected $fillable = ['pokemon_id', 'location_id'];
}
