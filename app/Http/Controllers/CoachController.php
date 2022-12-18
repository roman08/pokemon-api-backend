<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use Illuminate\Http\Request;
use App\Http\Requests\CoachRequest;
class CoachController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entrenadores = Coach::all();
        return response()->json([
            'entrenadores' => $entrenadores,
        ]);
    }

 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CoachRequest $request)
    {
        try {


            $entrenador = Coach::create([
                'name' => $request['name'],
                'surnames' => $request['surnames'],
                'email' => $request['email'],
                'birth_date' => $request['birth_date'],
                'pokemons' => $request['pokemons'],
                'role' => $request['role']
            ]);

            return response()->json([
                'status' => 'success',
                'repuesta' => $entrenador,
            ],200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'error' => 'error'], 200);
        }
        
    }

    public function update(Request $request){
        try {
            $entrenador = Coach::find($request['id']);

            $entrenador->pokemons = $request['pokemons'];

            $entrenador->save();

            return response()->json([
                'status' => 'success',
                'repuesta' => $entrenador,
            ],200);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'error' => 'error'], 200);
        }
    }




}
