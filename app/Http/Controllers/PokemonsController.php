<?php

namespace App\Http\Controllers;

use App\Http\Requests\PokemonRequest;
use App\Http\Resources\PokemonResources;
use App\Models\Locations;
use App\Models\Pokemons;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PokemonsController extends Controller
{
    public function index(){
        $pokemons = Pokemons::all();

        return PokemonResources::collection($pokemons);
    }

    public function store(PokemonRequest $request){
        $data = $request->validated();
        $order = Pokemons::max('order');

        $pokemon = Pokemons::create([
            'name' => $data['name'],
            'img' => $data['img'],
            'order' => $order === null ? 1 : $order + 1,
            'form' => $data['form'],
            'ability_id' => $data['ability_id'],
            'location_id' => $data['location_id']
        ]);

        Storage::disk('public')->putFileAs('images', $data['img'], $data['img']->getClientOriginalName());

        return new PokemonResources($pokemon);
    }

    public function update(PokemonRequest $request){
        $data = $request->validated();
        if(isset($data['id'])){
            $pokemon = Pokemons::where('id', $data['id'])->first();
            $pokemon->update($data);

            return new PokemonResources($pokemon);
        }
    }

    public function show($id){
        if($pokemon = Pokemons::where('id', $id)->first()) {
            return new PokemonResources($pokemon);
        }
    }

    public function sort_filter(Request $request){
        $data = $request->validate(['action' => 'required|string', 'filter_name' => 'nullable']);

        switch ($data['action']){
            case 'sort':
                return PokemonResources::collection(Pokemons::orderBy('location_id')->get());
                break;
            case 'filter':
                if(isset($data['filter_name'])){
                    if(!is_numeric($data['filter_name'])){
                        return PokemonResources::collection(Pokemons::where('location_id', $data['filter_name'])->get());
                    }else{
                        $location = Locations::where('id', $data['filter_name'])->first();
                        return PokemonResources::collection(Pokemons::where('location_id', $location->id)->get());
                    }
                }else{
                    return response()->json(['message' => 'Выберите фильтр!']);
                }
                break;
            default:
                return PokemonResources::collection(Pokemons::all());
                break;
        }
    }
}
