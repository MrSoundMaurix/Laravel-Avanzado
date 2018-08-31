<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Http\Requests\UserRequest;
use App\Notifications\NewUserNotification;
use App\Role;
use App\User;
use Auth;
use Faker;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;




class UserController extends Controller
{
    public function index()
    {
        //falt
        $usuarios = User::with("roles")->orderBy('name')->paginate(10);
        $roles=Role::orderBy('name')->get();
        return view('panel.usuarios.index', compact('usuarios','roles'));

    }

    public function show($id)
    {
        $usuarios=User::with(['roles' => function ($query) {
            $query->select('display_name');
        }])->findOrFail($id);
    return view("panel.usuarios.show",compact('usuarios'));

    }

    public function update(UserRequest $request, $id)
    {
        try {
            $user = User::findOrFail($id);
          //  $user->name=$request->name;
          //  $user->save();
            $user->roles()->sync($request->idRol);
            return redirect('usuarios')->with('success', 'Usuario actualizado');
        } catch (Exception | QueryException $e) {
            return back()->withErrors(['exception' => $e->getMessage()]);
        }
    }

    public function change_password(PasswordRequest $request)
    {
        try {
            $user = Auth::user();
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect('settings')->with('success', 'Contraseña actualizada');
        } catch (Exception | QueryException $e) {
            return back()->withErrors(['exception' => $e->getMessage()]);
        }
    }

    public function settings()
    {
        $usuario = Auth::user();
        return view('panel.usuarios.settings', compact('usuario'));
    }
    public function store(UserRequest $request)
    {
        try {
            $user = new User;
            $user->fill($request->except('idRol'));
            $faker = Faker\Factory::create();
            $password = $faker->password();
            $user->password = bcrypt($password);
            $user->save();
            $user->notify(new NewUserNotification($password));
            $user->roles()->attach($request->idRol);
            return redirect('usuarios')->with('success', 'Usuario creado');
        } catch (Exception | QueryException $e) {
            return back()->withErrors(['exception' => $e->getMessage()]);
        }

    }
    // public function store(UserRequest $request)
    // {
    //     try{
    //         $user=User::create($request->except('idRol'));   ///por defecto 
    //         $user->roles()->attach($request->idRol); // id only
    //         return redirect('usuarios')->with('success','Usuario Creado exitosamente');
    //     }catch(Exception | QueryException $e){
    //         return back()->withErrors(['exception'=>$e->getMessage()]);
    //     }

    // }
    


}
