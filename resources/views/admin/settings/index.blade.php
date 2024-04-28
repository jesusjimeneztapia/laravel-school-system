@extends('layouts.app')

@section('title', config('app.name', 'Laravel').' | Configuraciones del sistema')

@section('page')
    Configuraciones del sistema
@endsection

@section('main')
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <x-adminlte-info-box
                title="Instituciones"
                url="{{ route('settings.institutions.index') }}"
                icon="fa fa-lg fa-school text-primary"
                theme="gradient-primary" icon-theme="light"
                description="Listar, crear, ver, editar y eliminar instituciones"/>
        </div>
        <div class="col-md-6 col-xl-3">
            <x-adminlte-info-box
                title="Gestiones"
                url="{{ route('settings.institutions.index') }}"
                icon="fa fa-lg fa-calendar text-info"
                theme="gradient-info" icon-theme="light"
                description="Listar, crear, ver, editar y eliminar gestiones"/>
        </div>
    </div>
@endsection
