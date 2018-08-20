@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Generos <a class="btn btn-primary" href="{{url('generos/create')}}" title="Nuevo Género" role="button">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                </a></div>
                <div class="card-body">
                    @include('includes.messages')
                    @include('panel.generos.delete')
                <div class="table-responsive">
                    {{$generos->links()}}
                    <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Nombre Género</th>
                        <th scope="col">Fecha de creación</th>
                        <th scope="col">Fecha de modificación</th>
                        <th scope="col">............</th>
                        <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($generos as $gen)
                            <tr>
                                <th scope="row">{{$gen->nombre}}</th>
                                <td>{{$gen->created_at}}</td>
                                <td>{{$gen->updated_at}}</td>
                                <td>
                                   
                                   
                                </td>
                                <td>
                                  
                                    <a title="Ver" href="{{route('generos.show',$gen->idGenero)}}" class="btn btn-info btn-xs"><i class="fa fa-folder-open" aria-hidden="true"></i></a>
                                    <a title="Editar" href="{{route('generos.edit',$gen->idGenero)}}" class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    <a title="Eliminar" data-toggle="modal" data-target="#modalDelete" 
                                    data-name="{{$gen->titulo}}" href="#"
                                    data-action="{{route('generos.destroy',$gen->idGenero)}}"
                                    class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                    {{$generos->links()}}
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
        $('#modalDelete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var action = button.data('action');
            var name = button.data('name');
            var modal = $(this);
            modal.find(".modal-content #txtEliminar").html("¿Está seguro de eliminar la película <b>" + name + "</b>?");
            modal.find(".modal-content form").attr('action', action);
        });
    });
</script>
@endprepend
