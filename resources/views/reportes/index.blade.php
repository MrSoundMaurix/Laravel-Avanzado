@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('messages.reports')</div>

                <div class="card-body">
                        <a title="Ver Reporte Usuarios PDF" target="_blank" href="{{route('reportes.usuarios')}}" class="btn btn-info btn-xs"><i class="fa fa-folder-open" aria-hidden="true"></i>Usuarios PDF</a>
                      <a title="Ver Reporte Generos PDF" target="_blank" href="{{route('reportes.generos')}}" class="btn btn-info btn-xs"><i class="fa fa-folder-open" aria-hidden="true"></i>Generos PDF</a>

                        <a title="Ver Reporte Usuarios EXCEL"  href="{{route('reportes.usuarios.excel')}}" class="btn btn-info btn-xs"><i class="fa fa-folder-open" aria-hidden="true"></i>Usuarios EXCEL</a>
                        <a title="Ver Reporte Generos EXCEL"  href="{{route('reportes.generos.excel')}}" class="btn btn-info btn-xs"><i class="fa fa-folder-open" aria-hidden="true"></i>Generos EXCEL</a>
                        <a title="Ver Reporte Peliculas EXCEL"  href="{{route('reportes.peliculas.excel')}}" class="btn btn-info btn-xs"><i class="fa fa-folder-open" aria-hidden="true"></i>Peliculas EXCEL</a>
                        <a title="Ver Reporte Peliculas titulo EXCEL"  href="{{route('reportes.peliculas.excel')}}" class="btn btn-info btn-xs"><i class="fa fa-folder-open" aria-hidden="true"></i>Peliculas titulo EXCEL</a>
                                       
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
