@extends('layouts.app')

@section('title', config('app.name', 'Laravel').' | Roles - Crear rol')

@section('page')
    Crear nuevo rol
@endsection

@section('main')
    <div class="row">
        <x-adminlte-card class="col-6" title="Llene los campos" theme="success" theme-mode="outline">
            <form action="{{ route('roles.store') }}" method="post">
                @csrf
                <x-adminlte-input id="name" name="name" type="text" placeholder="Nombre del rol" value="{{ old('name') }}" autofocus/>
                <x-adminlte-button label="Crear" theme="success" type="submit"/>
                <a href="{{ route('roles.index') }}" class="btn btn-secondary" type="button">Cancelar</a>
            </form>
        </x-adminlte-card>
    </div>
@endsection
