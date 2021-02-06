<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
        /**
         * Desplegar el listado de usuarios registrados en el sistema con paginacion
         * Se pueden hacer busquedas de datos segun el criterio que el usuario elija
         */

        if(!$request->ajax()) return redirect('/');

        $logueado = Auth::user();

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){

            $users = User::join('roles', 'roles.id', '=', 'users.idrol')
                        ->select('users.id', 'users.usuario', 'users.nombrecompleto', 'users.email', 'users.password', 'users.condicion', 'users.idrol', 'roles.nombre as rol')
                        ->orderBy('users.id', 'desc')
                        ->paginate(2);

        }else{

            $users = User::join('roles', 'roles.id', '=', 'users.idrol')
                        ->select('users.id', 'users.usuario', 'users.nombrecompleto', 'users.email', 'users.password', 'users.condicion', 'users.idrol', 'roles.nombre as rol')
                        ->where($criterio, 'like', '%' . $buscar . '%')
                        ->orderBy('users.id', 'desc')
                        ->paginate(2);

        }

        $user_cliente = User::select('users.id', 'users.usuario', 'users.nombrecompleto', 'users.email', 'users.password', 'users.condicion', 'users.idrol', 'roles.nombre as rol')
                            ->join('roles', 'roles.id', '=', 'users.idrol')
                            ->where('users.idrol', 3)
                            ->orderBy('users.nombrecompleto', 'asc')
                            ->paginate(2);
        return [
            
            'pagination' => [
                'total'         => $users->total(),
                'current_page'  => $users->currentPage(),
                'per_page'      => $users->perPage(),
                'last_page'     => $users->lastPage(),
                'from'          => $users->firstItem(),
                'to'            => $users->lastItem(),
            ],

            'usuarios' => $users,

            'usuariosclientes' => $user_cliente,

            'logueado' => $logueado

        ];

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * Guardar en la BD del sistema el nuevo registro de usuario
         */

        if(!$request->ajax()) return redirect('/');

        $user = new User();

            $user->usuario = $request->usuario;
            $user->nombrecompleto = $request->nombrecompleto;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->condicion = true;
            $user->idrol = $request->idrol;

        $user->save();

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        /**
         * Actualizar en la BD del sistema el registro seleccionado
         */

        if(!$request->ajax()) return redirect('/');

        $user = User::findOrFail($request->id);

            $user->usuario = $request->usuario;
            $user->nombrecompleto = $request->nombrecompleto;
            $user->email = $request->email;
            if($request->password != null) $user->password = bcrypt($request->password);
            $user->condicion = true;
            $user->idrol = $request->idrol;

        $user->save();

    }

    public function desactivar(Request $request)
    {
        /**
         * Cambiar el estado de un usuario a Desactivado
         */

        if(!$request->ajax()) return redirect('/');

        $user = User::findOrFail($request->id);

            $user->condicion = false;

        $user->save();

    }

    public function activar(Request $request)
    {
        /**
         * Cambiar el estado de un usuario a Activado
         */

        if(!$request->ajax()) return redirect('/');

        $user = User::findOrFail($request->id);

            $user->condicion = true;

        $user->save();

    }

    public function unico($usuario)
    {
        /**
         * Verifica que el nombre de usuario ingresado 
         * cuando se esta creando un registro de
         * usuario no exista en la BD del sistema 
         */

        $user = User::where('usuario', $usuario)->get();

        if($user->isEmpty()){
            return "si";
        }else{
            return "no";
        }

    }

    public function unico2($usuario, $user_id)
    {
        /**
         * Verifica que el nombre de usuario ingresado 
         * cuando se esta actualizando un registro de 
         * usuario no exista en la BD del sistema. 
         */

        $user = User::where('usuario', $usuario)->first();

        if($user == null){
            return "si";
        }elseif($user->id == $user_id){
            return "si";
        }else{
            return "no";
        }

    }

    public function unico3($email)
    {
        /**
         * Verifica que el email del usuario ingresado 
         * cuando se esta creando un registro de 
         * usuario no exista en la BD del sistema. 
         */

        $user = User::where('email', $email)->get();

        if($user->isEmpty()){
            return "si";
        }else{
            return "no";
        }
        
    }

    public function unico4($email, $user_id)
    {
        /**
         * Verifica que el email de usuario ingresado 
         * cuando se esta actualizando un registro de 
         * usuario no exista en la BD del sistema. 
         */

        $user = User::where('email', $email)->first();

        if($user == null){
            return "si";
        }elseif($user->id == $user_id){
            return "si";
        }else{
            return "no";
        }

    }

    public function selectUser(Request $request)
    {
        /**
         * Devuelve los usuarios con rol de atención al cliente registrados
         */

        $users = User::where('idrol', 5)
                        ->orWhere('idrol', 6)
                        ->select('id', 'nombrecompleto')
                        ->orderBy('nombrecompleto', 'asc')
                        ->get();

        return ['users' => $users];
        
    }

    public function getUser(Request $request)
    {
        /**
         * Devuelve los datos del usuario logueado
         */

        $user = Auth::user();

        return ['usuario' => $user];

    }
}
