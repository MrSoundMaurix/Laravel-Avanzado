<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genero;
use App\Http\Requests\GeneroRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
class GeneroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $generos = Genero::orderBy('nombre')->paginate(10);
        return view('panel.generos.index', compact('generos'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $generos=Genero::orderBy('nombre')->get(['idGenero','nombre']);
        return view("panel.generos.create",compact('generos'));
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GeneroRequest $request)
    {
          Genero::create($request->all());
        return Redirect::to('generos')->with('success','Género Creado con éxito');
/*
        try{
            $genero=Genero::create($request->except('idGenero'));  ///duda
            $pelicula->generos()->sync($request->idGenero);
            return redirect('peliculas')->with('success','Película registrada');
        }catch(Exception $e){
            return back()->withErrors(['exception'=>$e->getMessage()])->withInput();
        }
*/

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $genero=Genero::findOrFail($id);
     return view("panel.generos.show",compact('genero'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $genero=Genero::findOrFail($id);
        return view('panel.generos.edit',compact('genero'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GeneroRequest $request, $id)
    {
        
        Genero::updateOrCreate(['idGenero'=>$id],$request->all());
        return Redirect::to('generos')->with('success','Género Actualizado con éxito');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Genero::destroy($id);
        return Redirect::to('generos')->with('success','Género Eliminado correctamente');
 
    }
}
