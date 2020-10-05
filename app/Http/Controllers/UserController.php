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
    public function store(CreateUserRequest $request)
    {
        $input= $request->all();
        if($input['usuarioContraseña'] != $input['confirmarContraseña']){
            return response()->json([
                'res' =>false,
                'message'=>'Confirmar contraseña debe ser igual.'
            ], 200);
        }
        $password = $input['usuarioContraseña'];
        $input['usuarioContraseña'] = password_hash($password, PASSWORD_BCRYPT);
        UserModel::create($input);
        return response()->json([
            'res' =>true,
            'message'=>'Resgistro creado correctamente.'
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

    public function render($request, Exception $exception)
    {
        //Useful since some methods cannot be accessed in certain URL extensions
        if ($exception instanceof AuthorizationException) {
            return response()->view('errors.404', [], 404);
        }

        return parent::render($request, $exception);
    }
}
