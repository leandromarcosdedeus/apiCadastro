<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function addCity(Request $request){
        $city = City::create($request->all());
        return response($city, 201);
    }
    public function getCity(){
        return response()->json(City::all(), 200);
    }
    public function updateCity(Request $request, $id){
        $city = City::find($id);
        if(is_null($city)){
            return response()->json(['message:'=>'Cidade não encontrada'], 404);
        }
        $city->update($request->all());
        return response($city, 200);
    }
    public function deleteCity(Request $request, $id){
        $city = City::find($id);
        if(is_null($city)){
            return response()->json(['message:'=>'Cidade não encontrada'], 404);
        }
        $city->delete();
        return response(null, 200);
    }
    public function getCityById($id){
        $city = City::find($id);

        if(is_null($city)){
            return response()->json(['message:'=>'Cliente não encontrado'], 404);
        }
        return response()->json($city::find($id));
    }
    public function bigCity(){
        $bigCity = City::max('quantidade_de_habitantes');
        $city = City::where('quantidade_de_habitantes', $bigCity)->first();
        return [$city];
    }
    
}
