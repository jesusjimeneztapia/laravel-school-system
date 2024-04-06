@extends('layouts.app')

@section('title', config('app.name', 'Laravel').' | Roles - Rol '.$role->name)

@section('page')
    Rol <span class="text-info">{{ $role->name }}</span>
@endsection

@section('main')
    <div class="row">
        <x-adminlte-card class="col-6" title="Datos registrados" theme="info" theme-mode="outline">
            <label class="form-label">Nombre del rol</label>
            <p class="form-control border-0 px-0">{{ $role->name }}</p>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary" type="button">Volver</a>
        </x-adminlte-card>
    </div>
@endsection
