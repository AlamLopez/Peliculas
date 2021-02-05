<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            $categorias = Categoria::orderBy('nombre', 'desc')->paginate(10);
        }else{
            $categorias = Categoria::where($criterio, 'like', '%' . $buscar . '%')->orderBy('nombre', 'desc')->paginate(10);;
        }


        return [
            
            'pagination' => [
                'total'         => $categorias->total(),
                'current_page'  => $categorias->currentPage(),
                'per_page'      => $categorias->perPage(),
                'last_page'     => $categorias->lastPage(),
                'from'          => $categorias->firstItem(),
                'to'            => $categorias->lastItem(),
            ],

            'categorias' => $categorias

        ];

    }

    public function selectCategoria(Request $request)
    {
        /**
         * Devuelve los roles registrados con condicion Activo
         */

        $roles = Categoria::where('condicion', true)->select('id', 'nombre')->orderBy('nombre', 'asc')->get();

        return ['categorias' => $categorias];
        
    }
}
