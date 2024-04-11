@extends('layouts.app')

@section('title', config('app.name', 'Laravel').' | Usuarios - Crear usuario')

@section('page')
    Crear nuevo usuario
@endsection

@section('main')
    @php
        $options = [];
        foreach ($roles as $role) {
            $id = $role->id;
            $name = $role->name;
            $options[$id] = $name;
        }
    @endphp

    <div class="row">
        <x-adminlte-card class="col-6" title="Llene los campos" theme="success" theme-mode="outline">
            <form action="{{ route('users.store') }}" method="post">
                @csrf
                <x-adminlte-select name="role_id" required>
                    <x-adminlte-options :options="$options" placeholder="Seleccione un rol..." selected="{{ old('role_id') }}" />
                    <x-slot name="appendSlot">
                        <a class="btn btn-success ml-2 rounded" href="{{ route('roles.create') }}" title="Crear nuevo rol">
                            <i class="fas fa-plus"></i>
                        </a>
                    </x-slot>
                </x-adminlte-select>
                <x-adminlte-input name="name" type="text" placeholder="Nombre del usuario" value="{{ old('name') }}" required/>
                <x-adminlte-input name="email" type="email" placeholder="Correo electrónico del usuario" value="{{ old('email') }}" required/>
                <x-adminlte-input name="password" type="password" placeholder="Contraseña" value="{{ old('password') }}" required/>
                <x-adminlte-input name="repeated_password" type="password" placeholder="Repita la contraseña" value="{{ old('repeated_password') }}" required/>
                <x-adminlte-button label="Crear" theme="success" type="submit"/>
                <a href="{{ route('users.index') }}" class="btn btn-secondary" type="button">Cancelar</a>
            </form>
        </x-adminlte-card>
    </div>
@endsection
