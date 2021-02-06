<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class ReporteriaController extends Controller
{
    public function movimiento(Request $request)
    {

        $data = $request->data;
     
        $data = PDF::loadView('reportes.movimientos', compact('data'))
                    ->setPaper('letter', 'landscape')
                    ->save(storage_path('app/public/') . 'movimiento.pdf');  
        
    }

    public function movimientoDescargar()
    {
        $file = storage_path() . '/app/public/movimiento.pdf';
 
        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response()->download($file, 'movimiento.pdf', $headers);
    }

    public function usuario(Request $request)
    {

        $data = $request->data;
     
        $data = PDF::loadView('reportes.usuarios', compact('data'))
                    ->setPaper('letter', 'landscape')
                    ->save(storage_path('app/public/') . 'usuarios-clientes.pdf');  
        
    }

    public function usuarioDescargar()
    {
        $file = storage_path() . '/app/public/usuarios-clientes.pdf';
 
        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response()->download($file, 'usuarios-clientes.pdf', $headers);
    }

    public function pelicula(Request $request)
    {

        $data = $request->data;
     
        $data = PDF::loadView('reportes.peliculas', compact('data'))
                    ->setPaper('letter', 'landscape')
                    ->save(storage_path('app/public/') . 'pelicula-categoria.pdf');  
        
    }

    public function peliculaDescargar()
    {
        $file = storage_path() . '/app/public/pelicula-categoria.pdf';
 
        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response()->download($file, 'pelicula-categoria.pdf', $headers);
    }

}
