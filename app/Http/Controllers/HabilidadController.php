<?php

namespace App\Http\Controllers;

use App\Models\Habilidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HabilidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $habilidad = Habilidad::all();
        $data = [
            'habilidad' => $habilidad,
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
        $validator =  Validator::make($request->all(), [
            'nombre' => 'required|string',
            'descripcion' => 'required|string',
        ]);

        if ($validator->fails()) {
            $data = [
                'mensaje' => 'Error en la validacion de los datos',
                'errores' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        try {
            $habilidad = Habilidad::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion
            ]);

            return response()->json([
                'habilidades' => $habilidad,
                'mensaje' => 'Habilidad creada exitosamente',
                'status' => 201,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'mensaje' => 'Error en la creación de la habilidad',
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
        $habilidad = Habilidad::find($id);

        if (!$habilidad) {
            return response()->json([
                'mensaje' => 'habilidad no encontrada',
                'status' => 404
            ], 404);
        }

        $data = [
            'habilidad' => $habilidad,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Habilidad $habilidad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $habilidad = Habilidad::find($id);

        if (!$habilidad) {
            $data = [
                'mensaje' => 'habilidad no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator =  Validator::make($request->all(), [
            'nombre' => 'required|string',
            'descripcion' => 'required|string'

        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $habilidad->nombre = $request->nombre;
        $habilidad->descripcion = $request->descripcion;

        $habilidad->save();

        $data = [
            'mensaje' => 'habilidad actualizada',
            'habilidad' => $habilidad,
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $habilidad = habilidad::find($id);

        if (!$habilidad) {
            $data = [
                'mensaje' => 'habilidad no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $habilidad->delete();

        $data = [
            'message' => 'habilidad eliminada',
            'habilidad' => $habilidad,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
}
