@extends('layouts.app')

@section('title', config('app.name', 'Laravel').' | Usuarios - Editar usuario '.$user->name)

@section('page')
    Usuario <span class="text-warning">{{ $user->name }}</span>
@endsection

@section('main')
    @php
        $options = [];
        foreach ($roles as $role) {
            $id = $role->id;
            $name = $role->name;
            $options[$id] = $name;
        }
        $selected_role = old('role_id') ?? $role_id;
        $name = old('name') ?? $user->name;
        $email = old('email') ?? $user->email;
    @endphp

    <div class="row">
        <x-adminlte-card class="col-sm-8 col-md-6" title="Edite los campos" theme="warning" theme-mode="outline">
            <form action="{{ route('users.update', $user) }}" method="post">
                @method('PUT')
                @csrf
                <x-adminlte-select name="role_id" required>
                    <x-adminlte-options :options="$options" placeholder="Seleccione un rol..." selected="{{ $selected_role }}" />
                    <x-slot name="appendSlot">
                        <a class="btn btn-success ml-2 rounded" href="{{ route('roles.create') }}" title="Crear nuevo rol">
                            <i class="fas fa-plus"></i>
                        </a>
                    </x-slot>
                </x-adminlte-select>
                <x-adminlte-input name="name" type="text" placeholder="Nombre del usuario" value="{{ $name }}" required/>
                <x-adminlte-input name="email" type="email" placeholder="Correo electrónico del usuario" value="{{ $email }}" required/>
                <x-adminlte-input name="password" type="password" placeholder="Contraseña" value="{{ old('password') }}"/>
                <x-adminlte-input name="repeated_password" type="password" placeholder="Repita la contraseña" value="{{ old('repeated_password') }}"/>
                <x-adminlte-button label="Guardar" theme="warning" type="submit"/>
                <a href="{{ route('users.index') }}" class="btn btn-secondary" type="button">Cancelar</a>
            </form>
        </x-adminlte-card>
    </div>
@endsection
