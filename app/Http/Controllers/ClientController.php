<?php

namespace App\Http\Controllers;

use App\Models\City;
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
        if($teste->validarClient($request) == true){
            $city = City::where('nome', $request->cidade_id)->first();
            if($city == null){
                return response()->json(['message'=>'Cidade inválida']);
            }
            $client = [
                'nome' => $request->nome,
                'apelido' => $request->apelido,
                'time' => $request->time,
                'CPF' => $request->CPF,
                'hobbie' => $request->hobbie,
                'cidade_id'=> $city->id
            ];
                $city->increment('quantidade_de_habitantes');
                $client = Client::create($client);
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
        // Ao inves disso
        $mostFrequent = DB::table('clients')->select('cidade',
        DB::raw('COUNT(*) as total'))->groupBy('cidade')->orderByDesc('total')->first();
        return $mostFrequent;
        //Escreva isso 

        $data = Client::all();
        $result = collect();
        foreach ($data->groupBy('cidade') as $cidade=>$values) {
                $result->push([
                    'cidade'=> $cidade,
                    'values'=> $values->count()
                ]);
        }
        return $result;
    }
    public function biggestCrown(){
        $data = Client::all();
        $result = collect();
        foreach ($data->groupBy('time') as $time=>$values) {
                $result->push([
                    'time'=> $time,
                    'values'=> $values->count()
                ]);
        }
        return $result;
    }
}