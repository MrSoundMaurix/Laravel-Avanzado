@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Usuarios
                    
                    {{-- <a class="btn btn-primary" href="{{url('usuarios/create')}}" title="Nuevo usuario" role="button">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                </a>--}}
                <a title="Nuevo Usuario" data-toggle="modal" data-target="#modalCreate" 
                  class="btn btn-primary btn-xs"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
            </div> 
          
                <div class="card-body">
                    @include('includes.messages')
                    @include('panel.usuarios.create')
                    @include('panel.usuarios.edit')
                <div class="table-responsive">
                    {{$usuarios->links()}}
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Mail</th>
                        <th scope="col">Fecha creacion </th>
                        <th scope="col">Ultima actualizacion</th>
                        <th scope="col">Rol</th>
                        
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $us)
                            <tr>
                                <th scope="row">{{$us->name}}</th>
                                <td>{{$us->email}}</td>
                                <td>{{$us->created_at}}</td>
                                <td>{{$us->updated_at}}</td>
                                <td>
 
                                        @if (count($us->roles) > 0)
                                            <ul class="list-group">
                                                @foreach ($us->roles as $rol)
                                                    <li class="list-group-item">{{$rol->display_name}}</li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                                <strong>El usuario no tiene roles registrados</strong>
                                            </div>
                                        @endif


                                </td>

                               
                                <td>

                                        <a title="Ver" href="{{route('usuarios.show',$us->id)}}" class="btn btn-info btn-xs"><i class="fa fa-folder-open" aria-hidden="true"></i></a>
                                       
                                        <a title="Cambiar rol" data-toggle="modal" data-target="#modalEdit" 
                                        data-name="{{$us->name}}" data-email="{{$us->email}}" 
                                        data-rol="{{count($us->roles)== 0 ?: $us->roles[0]->id}}" 
                                        href="#" data-action="{{route('usuarios.update',$us->id)}}"
                                        class="btn btn-success btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></a>
    
                                    {{-- <a title="Ver" href="{{route('peliculas.show',$pel->idPelicula)}}" class="btn btn-info btn-xs"><i class="fa fa-folder-open" aria-hidden="true"></i></a>
                                    @can('update',$pel)
                                    <a title="Editar" href="{{route('peliculas.edit',$pel->idPelicula)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <a title="Eliminar" data-toggle="modal" data-target="#modalDelete" 
                                    data-name="{{$pel->titulo}}" href="#"
                                    data-action="{{route('peliculas.destroy',$pel->idPelicula)}}"
                                    class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    @endcan --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                    {{$usuarios->links()}}
                </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@prepend('scripts')
<script type="text/javascript">
    $(document).ready(function () {
        $('#modalEdit').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var action = button.data('action');
            var name = button.data('name');
            var email = button.data('email');
            var idRol = button.data('rol');
            var modal = $(this);
            modal.find(".modal-content #name").val(name);
            modal.find(".modal-content #email").val(email);
            modal.find(".modal-content #idRol").val(idRol);
            modal.find(".modal-content form").attr('action', action);
        });
    });
</script>
@endprepend

