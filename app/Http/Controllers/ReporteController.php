<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use PDF;
use App\User;
use App\Genero;
use App\Exports\UsersExport;
use App\Exports\GenerosExport;
use App\Exports\PeliculaExport;
use App\Exports\PeliculaTittleExport;
use Illuminate\Support\Facades\Auth;
class ReporteController extends Controller
{
    //
public function testPDF(){
    $user=Auth::user();

    $reporte = PDF::loadView('reportes.test',compact('user'));
    $reporte=$reporte->stream('Reporte Test.pdf');
    return $reporte;
}
public function reporteUsuarios(){
    $usuarios=User::with('roles')->orderBy('name')->get();

    $reporte = PDF::loadView('reportes.Usuarios',compact('usuarios'));
    $reporte=$reporte->stream('Reporte Usuarios.pdf');
    return $reporte;
}
public function reporteGeneros(){
    $generos=Genero::orderBy('nombre')->get();

    $reporte = PDF::loadView('reportes.Generos',compact('generos'));
    $reporte=$reporte->stream('Reporte Generos.pdf');
    return $reporte;
}

public function index(){
    return view('reportes.index');
}

public function reporteUsuariosExcel(){
    return Excel::download(new UsersExport,'usuarios.xlsx');
}
public function reportePeliculasExcel(){
    return Excel::download(new PeliculaExport,'peliculas.xlsx');
}
public function reporteGenerosExcel(){
    return Excel::download(new GenerosExport,'generos.xlsx');
}
public function reportePeliculasTittleExcel(){
    return Excel::download(new PeliculaTittleExport,'generostitulo.xlsx');
}

}

