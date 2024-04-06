@extends('layouts.app')

@section('title', config('app.name', 'Laravel').' | Roles - Editar rol '.$role->name)

@section('page')
    Rol <span class="text-warning">{{ $role->name }}</span>
@endsection

@section('main')
    <div class="row">
        <x-adminlte-card class="col-6" title="Edite los campos" theme="warning" theme-mode="outline">
            <form action="{{ route('roles.update', $role) }}" method="post">
                @method('PUT')
                @csrf
                <x-adminlte-input name="name" type="text" label="Nombre del rol" value="{{ $role->name }}" autofocus/>
                <x-adminlte-button label="Guardar" theme="warning" type="submit"/>
                <a href="{{ route('roles.index') }}" class="btn btn-secondary" type="button">Cancelar</a>
            </form>
        </x-adminlte-card>
    </div>
@endsection
