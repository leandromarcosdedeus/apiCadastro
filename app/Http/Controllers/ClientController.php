<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Validacao\Validacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
        
        $teste = new Validacao;
        //nome, cpf, 
        if($teste->validarDados($request) == true){
            $client = Client::create($request->all());
            return response($client, 201);
        }
        else{
            return response()->json(['message'=>'Cadastro recusado']);
        }
    }
    public function updateClient(Request $request, $id){
        $client = Client::find($id);
        if(is_null($client)){
            return response()->json(['message:'=>'Cliente não encontrado'], 404);
        }
        $client->update($request->all());
        return response($client, 200);
    }
    public function deleteClient(Request $request, $id){
        $client = Client::find($id);
        if(is_null($client)){
            return response()->json(['message:'=>'Cliente não encontrado'], 404);          
        }
        $client->delete();
        return response()->json(null, 204);
    }
    public function mostFrequent(){
        $mostFrequent = DB::table('clients')->select('cidade',
        DB::raw('COUNT(*) as total'))->groupBy('cidade')->orderByDesc('total')->first();
        return $mostFrequent;

    }
}