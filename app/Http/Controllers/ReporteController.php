<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\User;
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

public function index(){
    return view('reportes.index');
}

}

