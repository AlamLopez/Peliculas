<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pelicula;
use Auth;

class PeliculaController extends Controller
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

        $logueado = Auth::user();

        //dd($request->all());

        $buscar = $request->buscar;
        $criterio = $request->criterio;
        $select_categoria = $request->select_categoria;
        $select_condicion = $request->select_condicion;

        if($buscar == null && $select_categoria == null && $select_condicion == null){

            $peliculas = Pelicula::select('peliculas.*', 'categorias.nombre as categoria')
                                    ->join('categorias', 'categorias.id', '=', 'peliculas.idcategoria')
                                    ->orderBy('titulo', 'desc')
                                    ->paginate(10);

        }elseif($buscar != null && $select_categoria == null && $select_condicion == null){

            $peliculas = Pelicula::select('peliculas.*', 'categorias.nombre as categoria')
                                    ->join('categorias', 'categorias.id', '=', 'peliculas.idcategoria')
                                    ->where($criterio, 'like', '%' . $buscar . '%')
                                    ->orderBy('titulo', 'desc')
                                    ->paginate(10);

        }elseif($buscar == null && $select_categoria != null && $select_condicion == null){
            $peliculas = Pelicula::select('peliculas.*', 'categorias.nombre as categoria')
                                    ->join('categorias', 'categorias.id', '=', 'peliculas.idcategoria')
                                    ->where('peliculas.idcategoria', $select_categoria)
                                    ->orderBy('titulo', 'desc')
                                    ->paginate(10);

        }elseif($buscar == null && $select_categoria == null && $select_condicion != null){
            $peliculas = Pelicula::select('peliculas.*', 'categorias.nombre as categoria')
                                    ->join('categorias', 'categorias.id', '=', 'peliculas.idcategoria')
                                    ->where('peliculas.condicion', $select_condicion)
                                    ->orderBy('titulo', 'desc')
                                    ->paginate(10);

        }elseif($buscar != null && $select_categoria != null && $select_condicion == null){

            $peliculas = Pelicula::select('peliculas.*', 'categorias.nombre as categoria')
                                    ->join('categorias', 'categorias.id', '=', 'peliculas.idcategoria')
                                    ->where('peliculas.idcategoria', $select_categoria)
                                    ->where($criterio, 'like', '%' . $buscar . '%')
                                    ->orderBy('titulo', 'desc')
                                    ->paginate(10);

        }elseif($buscar != null && $select_categoria == null && $select_condicion != null){

            $peliculas = Pelicula::select('peliculas.*', 'categorias.nombre as categoria')
                                    ->join('categorias', 'categorias.id', '=', 'peliculas.idcategoria')
                                    ->where('peliculas.condicion', $select_condicion)
                                    ->where($criterio, 'like', '%' . $buscar . '%')
                                    ->orderBy('titulo', 'desc')
                                    ->paginate(10);

        }elseif($buscar == null && $select_categoria != null && $select_condicion != null){

            $peliculas = Pelicula::select('peliculas.*', 'categorias.nombre as categoria')
                                    ->join('categorias', 'categorias.id', '=', 'peliculas.idcategoria')
                                    ->where('peliculas.condicion', $select_condicion)
                                    ->where('peliculas.idcategoria', $select_categoria)
                                    ->orderBy('titulo', 'desc')
                                    ->paginate(10);

        }else{
            $peliculas = Pelicula::select('peliculas.*', 'categorias.nombre as categoria')
                                    ->join('categorias', 'categorias.id', '=', 'peliculas.idcategoria')
                                    ->where('peliculas.condicion', $select_condicion)
                                    ->where('peliculas.idcategoria', $select_categoria)
                                    ->where($criterio, 'like', '%' . $buscar . '%')
                                    ->orderBy('titulo', 'desc')
                                    ->paginate(10);
        }


        return [
            
            'pagination' => [
                'total'         => $peliculas->total(),
                'current_page'  => $peliculas->currentPage(),
                'per_page'      => $peliculas->perPage(),
                'last_page'     => $peliculas->lastPage(),
                'from'          => $peliculas->firstItem(),
                'to'            => $peliculas->lastItem(),
            ],

            'peliculas' => $peliculas,

            'logueado' => $logueado

        ];

    }

    public function selectPelicula(Request $request)
    {
        /**
         * Devuelve los roles registrados con condicion Activo
         */

        $peliculas = Pelicula::where('condicion', true)->select('id', 'nombre')->orderBy('nombre', 'asc')->get();

        return ['peliculas' => $peliculas];
        
    }

    public function desactivar(Request $request)
    {
        /**
         * Cambiar el estado de un usuario a Desactivado
         */

        if(!$request->ajax()) return redirect('/');

        $pelicula = Pelicula::findOrFail($request->id);

            $pelicula->condicion = false;

        $pelicula->save();

    }

    public function activar(Request $request)
    {
        /**
         * Cambiar el estado de un usuario a Activado
         */

        if(!$request->ajax()) return redirect('/');

        $pelicula = Pelicula::findOrFail($request->id);

            $pelicula->condicion = true;

        $pelicula->save();

    }

}
