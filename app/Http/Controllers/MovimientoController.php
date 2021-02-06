<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movimiento;

class MovimientoController extends Controller
{
    public function index(Request $request)
    {
        //
        /**
         * Desplegar el listado de roles registrados en el sistema con paginacion
         * Se pueden hacer busquedas de datos segun el criterio que el usuario elija
         */

        if(!$request->ajax()) return redirect('/');

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if($buscar == ''){

            $movimientos = Movimiento::select('peliculas.titulo as pelicula', 'users.nombrecompleto as cliente', 'movimientos.*')
                                        ->join('peliculas', 'peliculas.id', '=', 'movimientos.idpelicula')
                                        ->join('users', 'users.id', '=', 'movimientos.iduser')
                                        ->orderBy('fecha', 'desc')
                                        ->paginate(10);

        }else{

            $movimientos = Movimiento::select('peliculas.titulo as pelicula', 'users.nombrecompleto as cliente', 'movimientos.*')
                                        ->join('peliculas', 'peliculas.id', '=', 'movimientos.idpelicula')
                                        ->join('users', 'users.id', '=', 'movimientos.iduser')
                                        ->where($criterio, 'like', '%' . $buscar . '%')
                                        ->orderBy('fecha', 'desc')
                                        ->paginate(10);

        }


        return [
            
            'pagination' => [
                'total'         => $movimientos->total(),
                'current_page'  => $movimientos->currentPage(),
                'per_page'      => $movimientos->perPage(),
                'last_page'     => $movimientos->lastPage(),
                'from'          => $movimientos->firstItem(),
                'to'            => $movimientos->lastItem(),
            ],

            'movimientos' => $movimientos

        ];

    }
}
