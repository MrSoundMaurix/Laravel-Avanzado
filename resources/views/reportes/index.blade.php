@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('messages.reports')</div>

                <div class="card-body">
                        <a title="Ver Reporte Usuarios" target="_blank" href="{{route('reportes.usuarios')}}" class="btn btn-info btn-xs"><i class="fa fa-folder-open" aria-hidden="true"></i>Usuarios</a>
                                       
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
