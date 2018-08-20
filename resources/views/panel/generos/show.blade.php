@extends('layouts.app')
@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Información de los Generos <a class="btn btn-primary" href="{{url('generos')}}" title="Regresar al listado" role="button">
                            <i class="fa fa-reply" aria-hidden="true"></i>
                    </a></div>
                    <hr>
                    <div class="container">
                    <h4>Géneros</h4>

                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item"><b>NOMBRE DEL GÉNERO :</b> {{$genero->nombre}}</li>
                            <li class="list-group-item"><b>FECHA DE CREACIÓN : </b> {{$genero->created_at}}</li>
                            <li class="list-group-item"><b>FECHA DE ACTUALIZACIÓN : </b> {{$genero->updated_at}}</li>
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
