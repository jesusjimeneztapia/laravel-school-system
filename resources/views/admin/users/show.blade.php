@extends('layouts.app')

@section('title', config('app.name', 'Laravel').' | Usuarios - Usuario '.$user->name)

@section('page')
    Usuario <span class="text-info">{{ $user->name }}</span>
@endsection

@section('main')
    <div class="row">
        <x-adminlte-card class="col-sm-8 col-md-6" title="Datos registrados" theme="info" theme-mode="outline">
            <div class="mb-3">
                <label class="form-label">Nombre del usuario</label>
                <p class="form-control border-0 px-0">{{ $user->name }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label">Rol</label>
                <p class="form-control border-0 px-0">{{ $user->role()->get('name')[0]->name }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label">Correo electrónico</label>
                <p class="form-control border-0 px-0">{{ $user->email }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label">Fecha de creación</label>
                <p class="form-control border-0 px-0">{{ date('l j F Y', strtotime($user->created_at)) }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label">Estado</label>
                <p class="form-control border-0 px-0 @if($user->state) text-success @else text-danger @endif">
                    {{ $user->state == '1' ? 'Activo' : 'Inactivo' }}
                </p>
            </div>
            <a href="{{ route('users.index') }}" class="btn btn-secondary" type="button">Volver</a>
        </x-adminlte-card>
    </div>
@endsection
