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

            if($logueado->idrol != 1){

                $peliculas = Pelicula::select('peliculas.*', 'categorias.nombre as categoria')
                                    ->join('categorias', 'categorias.id', '=', 'peliculas.idcategoria')
                                    ->where('peliculas.condicion', true)
                                    ->orderBy('titulo', 'desc')
                                    ->paginate(10);

            }else{

                $peliculas = Pelicula::select('peliculas.*', 'categorias.nombre as categoria')
                                    ->join('categorias', 'categorias.id', '=', 'peliculas.idcategoria')
                                    ->orderBy('titulo', 'desc')
                                    ->paginate(10);

            }

            

        }elseif($buscar != null && $select_categoria == null && $select_condicion == null){

            if($logueado->idrol != 1){

                $peliculas = Pelicula::select('peliculas.*', 'categorias.nombre as categoria')
                                    ->join('categorias', 'categorias.id', '=', 'peliculas.idcategoria')
                                    ->where('peliculas.condicion', true)
                                    ->where($criterio, 'like', '%' . $buscar . '%')
                                    ->orderBy('titulo', 'desc')
                                    ->paginate(10);

            }else{

                $peliculas = Pelicula::select('peliculas.*', 'categorias.nombre as categoria')
                                    ->join('categorias', 'categorias.id', '=', 'peliculas.idcategoria')
                                    ->where($criterio, 'like', '%' . $buscar . '%')
                                    ->orderBy('titulo', 'desc')
                                    ->paginate(10);

            }

            

        }elseif($buscar == null && $select_categoria != null && $select_condicion == null){

            if($logueado->idrol != 1){

                $peliculas = Pelicula::select('peliculas.*', 'categorias.nombre as categoria')
                                    ->join('categorias', 'categorias.id', '=', 'peliculas.idcategoria')
                                    ->where('peliculas.condicion', true)
                                    ->where('peliculas.idcategoria', $select_categoria)
                                    ->orderBy('titulo', 'desc')
                                    ->paginate(10);

            }else{

                $peliculas = Pelicula::select('peliculas.*', 'categorias.nombre as categoria')
                                    ->join('categorias', 'categorias.id', '=', 'peliculas.idcategoria')
                                    ->where('peliculas.idcategoria', $select_categoria)
                                    ->orderBy('titulo', 'desc')
                                    ->paginate(10);

            }
            

        }elseif($buscar == null && $select_categoria == null && $select_condicion != null){
            $peliculas = Pelicula::select('peliculas.*', 'categorias.nombre as categoria')
                                    ->join('categorias', 'categorias.id', '=', 'peliculas.idcategoria')
                                    ->where('peliculas.condicion', $select_condicion)
                                    ->orderBy('titulo', 'desc')
                                    ->paginate(10);

        }elseif($buscar != null && $select_categoria != null && $select_condicion == null){

            if($logueado->idrol != 1){

                $peliculas = Pelicula::select('peliculas.*', 'categorias.nombre as categoria')
                                    ->join('categorias', 'categorias.id', '=', 'peliculas.idcategoria')
                                    ->where('peliculas.condicion', true)
                                    ->where('peliculas.idcategoria', $select_categoria)
                                    ->where($criterio, 'like', '%' . $buscar . '%')
                                    ->orderBy('titulo', 'desc')
                                    ->paginate(10);

            }else{

                $peliculas = Pelicula::select('peliculas.*', 'categorias.nombre as categoria')
                                    ->join('categorias', 'categorias.id', '=', 'peliculas.idcategoria')
                                    ->where('peliculas.idcategoria', $select_categoria)
                                    ->where($criterio, 'like', '%' . $buscar . '%')
                                    ->orderBy('titulo', 'desc')
                                    ->paginate(10);

            }

            

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

        $pelicula = new Pelicula();

            $pelicula->titulo = $request->titulo;
            $pelicula->director = $request->director;
            $pelicula->duracion = $request->duracion;
            $pelicula->anio_estreno = $request->anio_estreno;
            $pelicula->multa_diaria = $request->multa_diaria;
            $pelicula->idcategoria = $request->idcategoria;
            $pelicula->condicion = true;

        $pelicula->save();

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

        $pelicula = Pelicula::findOrFail($request->id);

            $pelicula->titulo = $request->titulo;
            $pelicula->director = $request->director;
            $pelicula->duracion = $request->duracion;
            $pelicula->anio_estreno = $request->anio_estreno;
            $pelicula->multa_diaria = $request->multa_diaria;
            $pelicula->idcategoria = $request->idcategoria;
            $pelicula->condicion = true;

        $pelicula->save();

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
