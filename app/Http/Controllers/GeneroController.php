<?php

namespace App\Http\Controllers;

use App\Genero;
use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Database\QueryException;
use App\Http\Requests\GeneroRequest;
use App\Notifications\GeneroNotification;
use Notification;
use Auth;
use Lang;
use App\Jobs\ProcessEmail;
use Illuminate\Contracts\Queue\ShouldQueue;



class GeneroController extends Controller implements ShouldQueue
{
    use Queueable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        $query=Genero::query();
        $query=$query->withCount('peliculas')->orderBy('nombre');  
        if($request->display == "all"){
            $query =$query->withTrashed();
        }else if($request->display == "trash"){
            $query =$query->onlyTrashed();
        }
        $generos = $query->paginate(10);
        return view('panel.generos.index', compact('generos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GeneroRequest $request)
    {
        try{
            $genero=Genero::create($request->except(['imagen']));
            if ($request->imagen!=null && $request->hasFile('imagen')) {
                $genero->imagen = $request->file('imagen')->store('public/generos');
                $genero->save();
            }
         
            return redirect('generos')->with('success','Genero Registrado');
        }catch(Exception $e){
            return back()->withErrors(['exception'=>$e->getMessage()])->withInput();
        }
    }

    public function create()
    {
         // $generos=Genero::orderBy('nombre')->get(['idGenero','nombre']);
         ProcessEmail::dispatch();
        return view("panel.generos.create");
    
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $gen=Genero::select("idproducto","nombreproducto","stockproducto",
        // "precioproducto","codigoproducto")->findOrFail($id);
        // return response()->json($prod);

        //web service tipo rest 
        return  Genero::withTrashed()->where('idGenero',$id)->firstOrFail()->toJson();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            Genero::withTrashed()->where('idGenero',$id)->forceDelete();
            return redirect('generos')->with('success','Género eliminado permanentemente');
        }catch(Exception | QueryException $e){
            return back()->withErrors(['exception'=>$e->getMessage()]);
        }
    }

    public function restore($id)
    {
        try{
            $gen=Genero::withTrashed()->where('idGenero',$id)->restore();
            info($gen);
            return redirect('generos')->with('success','Género restaurado');
        }catch(Exception $e){
            return back()->withErrors(['exception'=>$e->getMessage()]);
        }
    }

    public function trash($id)
    {
        try {
            Genero::destroy($id);
            ProcessEmail::dispatch();
            $gen=Genero::withTrashed()->where('idGenero',$id)->first();
            // $gen = Genero::withTrashed()->where('idGenero', $id)->first();
            // $user = Auth::user();
            // $user->notify(new GeneroNotification($gen));


            //Mail::to($user)->send(new GeneroTrash());
            // Notification::route('mail', $email)
            // ->notify(new GeneroNotification());
            return redirect('generos')->with('success', Lang::get("messages.gender_trash",['name'=>$gen->nombre]));
           // return redirect('generos')->with('success', 'Género enviado a papelera');
        } catch (Exception $e) {
            return back()->withErrors(['exception' => $e->getMessage()]);
        }

    }

}
