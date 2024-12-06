<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PHPUnit\Event\Test\TestStubCreated;
use App\Models\Habilidad;

class PokemonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pokemon = Pokemon::all();
        $data = [
            'pokemons' => $pokemon -> load('habilidades'),
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string',
            'avatar' => 'required|string',
            'descripcion' => 'required|string',
            'peso' => 'required|numeric',
            'altura' => 'required|numeric',
            'hp' => 'required|numeric',
            'ataque' => 'required|numeric',
            'defensa' => 'required|numeric',
            'ataque_especial' => 'required|numeric',
            'defensa_especial' => 'required|numeric',
            'velocidad' => 'required|numeric',
            'habilidades' => 'nullable|array', 
            'habilidades.*' => 'exists:habilidads,id', 
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400,
            ], 400);
        }
    
        try {
            $pokemon = Pokemon::create($request->only([
                'nombre', 
                'avatar', 
                'descripcion', 
                'peso', 
                'altura', 
                'hp',
                'ataque', 
                'defensa', 
                'ataque_especial', 
                'defensa_especial', 
                'velocidad'
            ]));
    
            if ($request->has('habilidades')) {
                $pokemon->habilidades()->sync($request->habilidades); 
            }
    
            return response()->json([
                'pokemon' => $pokemon->load('habilidades'),
                'message' => 'Pokémon creado exitosamente',
                'status' => 201,
            ], 201);
    
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error en la creación del Pokémon',
                'error' => $e->getMessage(),
                'status' => 500,
            ], 500);
        }
    }
    


    /**
     * Display the specified resource.
     */

    public function show($id)
    {
        $pokemon = Pokemon::find($id);


        if (!$pokemon) {
            return response()->json([
                'mensaje' => 'Pokemon no encontrado',
                'status' => 404
            ], 404);
        }


        $data = [
            'pokemon' => $pokemon->load('habilidades'),
            'status' => 200
        ];

        return response()->json($data, 200);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pokemon $pokemon) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $pokemon = Pokemon::find($id);

        if (!$pokemon) {
            $data = [
                'mensaje' => 'Pokemon no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator =  Validator::make($request->all(), [
            'nombre' => 'required|string',
            'avatar' => 'required|string',
            'descripcion' => 'required|string',
            'peso' => 'required|numeric',
            'altura' => 'required|numeric',
            'hp' => 'required|numeric',
            'ataque' => 'required|numeric',
            'defensa' => 'required|numeric',
            'ataque_especial' => 'required|numeric',
            'defensa_especial' => 'required|numeric',
            'velocidad' => 'required|numeric',
            'habilidades' => 'nullable|array', 
            'habilidades.*' => 'exists:habilidads,id', 

        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        try {
            $pokemon->update($request->only([
                'nombre', 
                'avatar', 
                'descripcion',
                'peso', 
                'altura', 
                'hp', 
                'ataque', 
                'defensa', 
                'ataque_especial', 
                'defensa_especial', 
                'velocidad'
            ]));
    
            if ($request->has('habilidades')) {
                $pokemon->habilidades()->sync($request->habilidades); 
            }
    
            return response()->json([
                'mensaje' => 'Pokémon actualizado exitosamente',
                'pokemon' => $pokemon->load('habilidades'), 
                'status' => 200,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el Pokémon',
                'error' => $e->getMessage(),
                'status' => 500,
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    try {
        $pokemon = Pokemon::find($id);

        if (!$pokemon) {
            return response()->json([
                'mensaje' => 'Pokémon no encontrado',
                'status' => 404,
            ], 404);
        }

        $pokemon->habilidades()->detach();

        $pokemon->delete();

        return response()->json([
            'message' => 'Pokémon eliminado',
            'status' => 200,
        ], 200);

    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error al eliminar el Pokémon',
            'error' => $e->getMessage(),
            'status' => 500,
        ], 500);
    }
}

}
