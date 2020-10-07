<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpsdateUserRequest;
use App\Models\UserModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //Get listar registro
    public function index(Request $request)
    {
        if($request->has('txtbuscar')){
            $usuario = UserModel::where('usuarioNombre','like','%' . $request->txtbuscar . '%')
                ->orWhere('usuarioTelefonoPrincipal', $request->txtbuscar)
                ->get();
        }else{
            $usuario =UserModel::all();
        }
        return $usuario;
    }

    //POST insert
    public function signup(CreateUserRequest $request)
    {
        $input= $request->all();
        $password = $input['usuarioContraseña'];
        $input['usuarioContraseña'] = password_hash($password, PASSWORD_BCRYPT);
        UserModel::create($input);
        return response()->json([
            'res' =>true,
            'message'=>'Resgistro creado correctamente.'
        ], 200);
    }

    public function login(Request $request)
    {
        $input= $request->all();
        $usuario = UserModel::where('usuarioEmail','like','%' . $input['usuarioEmail'] . '%')->get();
        if(count($usuario)==0){
            return response()->json([
                'res' =>false,
                'message'=>'Correo inexistente'
            ], 200);
        }
        if (!password_verify($input['usuarioContraseña'], $usuario[0]['usuarioContraseña'])){
            return response()->json([
                'res' =>false,
                'message'=>'Contraseña incorrecta'
            ], 200);
        }
        return response()->json([
            'res' =>true,
            'message'=>'Inicio de sesión correctamente.'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $usuarioId
     * @return \Illuminate\Http\Response
     */
    public function show(UserModel $user)
    {
        return $user;
    }

    public function recovery(UpsdateUserRequest $request, UserModel $user)
    {
        $input= $request->all();
        $usuario = UserModel::where('usuarioEmail','like','%' . $input['usuarioEmail'] . '%')->get();
        if(count($usuario)==0){
            return response()->json([
                'res' =>false,
                'message'=>'Correo inexistente'
            ], 200);
        }
        $user->update($input);
        return response()->json([
            'res' =>true,
            'message'=>'Resgistro actualizado correctamente.'
        ], 200);
    }

    //PUT actualizar registros
    public function update(UpsdateUserRequest $request, UserModel $user)
    {
        $input= $request->all();
        $user->update($input);
        return response()->json([
            'res' =>true,
            'message'=>'Resgistro actualizado correctamente.'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
