<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Validator;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();

        // if($students->isEmpty()){
        //     $data = [
        //         'menssage' => 'No sea encontraron Estudiantes',
        //         'status' => 200
        //     ];
        //     return response()->json($data, 404);
        // }

        $data = [
            'usuarios' => $usuarios,
            'status' => 200
        ];
        
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:55',
            'avatar' => 'required',
            'apellidoP' => 'required|max:35',
            'apellidoM'=> 'required|max:35',
            'email' => 'required|email|unique:usuario',
            'password' => 'required|max:100',
            'phone' => 'required|digits:10'
        ]);

        if($validator->fails()){
            $data = [
                'menssage' => 'Error en la Validacion de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        $usuario = Usuario::create([
            'name' => $request->name,
            'avatar' => $request->avatar,
            'apellidoP' => $request->apellidoP,
            'apellidoM'=> $request->apellidoM,
            'email' => $request->email,
            'password' => $request->password,
            'phone' => $request->phone
        ]);

        if(!$usuario){
            $data = [
                'menssage' => 'Error al crear el Usuario',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'usuario' => $usuario,
            'status' => 201
        ];
        return response()->json($data, 201);

    }

    public function show($id)
    {
        $usuario = Usuario::find($id);

        if(!$usuario){
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        
        $data =[
            'usuario' => $usuario,
            'status' => 200
        ];
        return response()->json($data,200);

    }

    public function destroy($id){
        $usuario = Usuario::find($id);

        if(!$usuario){
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }
        
        $usuario -> delete();

        $data =[
            'message' => 'Usuario Eliminado',
            'status' => 200
        ];
        return response()->json($data,200);
    }

    public function update($id, Request $request) {
        $usuario = Usuario::find($id);
    
        if (!$usuario) {
            return response()->json([
                'message' => 'Usuario no encontrado',
                'status' => 404
            ], 404);
        }
    
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:55',
            'avatar' => 'required|url',
            'apellidoP' => 'required|max:35',
            'apellidoM' => 'required|max:35',
            'password' => 'required|max:100',
            'phone' => 'required|digits:10'
        ]);
    
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error en la validación de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ], 400);
        }
    
        $usuario->name = $request->name;
        $usuario->avatar = $request->avatar;
        $usuario->apellidoP = $request->apellidoP;
        $usuario->apellidoM = $request->apellidoM;
        $usuario->password = $request->password;
        $usuario->phone = $request->phone;
    
        $usuario->save();
    
        return response()->json([
            'message' => 'Usuario actualizado correctamente',
            'usuario' => $usuario,
            'status' => 200
        ], 200);
    }
    
    

    public function updateParcial($id,Request $request){
        $usuario = Usuario::find($id);

        if(!$usuario){
            $data = [
                'message' => 'Usuario no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'max:55',
            'avatar' => 'required',
            'apellidoP' => 'max:35',
            'apellidoM'=> 'max:35',
            'email' => 'email|unique:usuario',
            'password' => 'max:100',
            'phone' => 'digits:10'
        ]);

        if($validator->fails()){
            $data = [
                'menssage' => 'Error en la Validacion de datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }


        if($request->has('name')){
            $usuario -> name = $request->name;
        }

        if($request->has('avatar')){
            $usuario -> avatar = $request->avatar;
        }

        if($request->has('apellidoP')){
            $usuario -> apellidoP = $request->apellidoP;
        }

        if($request->has('apellidoM')){
            $usuario -> apellidoM = $request->apellidoM;
        }

        if($request->has('email')){
            $usuario -> email = $request->email;
        }

        if($request->has('password')){
            $usuario -> password = $request->password;
        }

        if($request->has('phone')){
            $usuario -> phone = $request->phone;
        }

        $usuario->save();

        $data =[
            'message' => 'Usuario Actualizado',
            'usuario' => $usuario,
            'status' => 200
        ];
        return response()->json($data,200);

    }
}
