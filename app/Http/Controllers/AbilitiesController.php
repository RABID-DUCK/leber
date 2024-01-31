<?php

namespace App\Http\Controllers;

use App\Http\Requests\AbilityRequest;
use App\Models\Abilities;
use Illuminate\Http\Request;

class AbilitiesController extends Controller
{
    public function index(){
        $abilities = Abilities::all();

        return response()->json(['abilities' => $abilities]);
    }

    public function store(AbilityRequest $request){
        $data = $request->validated();
        Abilities::create($data);

        return $this->index();
    }

    public function update(AbilityRequest $request){
        $data = $request->validated();
        if(isset($data['id'])){
            $ability = Abilities::where('id', $data['id'])->first();
            $ability->title_ru = $data['title_ru'];
            $ability->title_en = $data['title_en'];
            $ability->image = $data['image'];
            $ability->save();

            return response()->json(['ability' => $ability]);
        }

        return response()->json(['message' => 'Не указан id локации!']);
    }

    public function show($id){
        $ability = Abilities::where('id', $id)->first();

        return response()->json(['ability' => $ability]);
    }
}
