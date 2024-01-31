<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemons extends Model
{
    use HasFactory;
    protected $table = 'pokemons';
    protected $fillable = ['name', 'img', 'form', 'ability_id', 'location_id', 'order'];


    public function getAbility(){
        return $this->hasOne(Abilities::class, 'id', 'ability_id');
    }

    public function getLocations(){
        return $this->belongsToMany(Locations::class, 'pokemon_locations', 'pokemon_id', 'location_id');
    }
}
