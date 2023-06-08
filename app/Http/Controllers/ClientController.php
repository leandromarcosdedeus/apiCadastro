<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function getClients(){
        return response()->json(Client::all(), 200);
    }
    public function getClientsById($id){
        $client = Client::find($id);

        if(is_null($client)){
            return response()->json(['message:'=>'Cliente não encontrado'], 404);
        }
        return response()->json($client::find($id));
    }
    public function addClient(Request $request){
        $client = Client::create($request->all());
        return response($client, 201);
    }
}
