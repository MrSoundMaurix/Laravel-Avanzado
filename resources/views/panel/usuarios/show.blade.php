@extends('layouts.app')
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Información del usuario <a class="btn btn-primary" href="{{url('usuarios')}}" title="Regresar al listado" role="button">
                            <i class="fa fa-reply" aria-hidden="true"></i>
                    </a></div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item"><b>Nombre:</b> {{$usuarios->name}}</li>
                            <li class="list-group-item"><b>Email:</b> {{$usuarios->email}} </li>
                            <li class="list-group-item"><b>Fecha Creacion:</b> {{$usuarios->created_at}}</li>
                            <li class="list-group-item"><b>Ultima modifiacion:</b> {{$usuarios->updated_at}}</li>
                            <li class="list-group-item"><b>Roles</b>
                                @foreach ($usuarios->roles as $r)
                                {{$r->display_name}} 
                                 @endforeach
     
                            </li>
                        </ul>
                        
                        {{-- @if (count($pelicula->generos) > 0)
                            <ul class="list-group">
                                @foreach ($pelicula->generos as $gen)
                                    <li class="list-group-item">{{$gen->nombre}}</li>
                                @endforeach
                            </ul>
                        @else
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong>La película no tiene géneros registrados</strong>
                            </div>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
