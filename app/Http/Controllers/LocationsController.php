<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use App\Models\Locations;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    public function index(){
        $locations = Locations::all();

        return response()->json(['locations' => $locations]);
    }

    public function store(LocationRequest $request){
        $data = $request->validated();
        Locations::create($data);

        return $this->index();
    }

    public function update(LocationRequest $request){
        $data = $request->validated();
        if(isset($data['id'])){
            $location = Locations::where('id', $data['id'])->first();
            $location->title = $data['title'];
            $location->save();

            return response()->json(['location' => $location]);
        }

        return response()->json(['message' => 'Не указан id локации!']);
    }

    public function show($id){
        $location = Locations::where('id', $id)->first();

        return response()->json(['location' => $location]);
    }
}
