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

    public function getLocation(){
        return $this->hasOne(Locations::class, 'id', 'location_id');
    }
}
