@extends('layouts.app')

@section('title', config('app.name', 'Laravel').' | Instituciones - Institución '.$institution->name)

@section('page')
    Institución <span class="text-info">{{ $institution->name }}</span>
@endsection

@section('main')
    <div class="row">
        <x-adminlte-card class="col-md-8 col-xl-6" title="Datos registrados" theme="info" theme-mode="outline">
            <div class="row">
                <div class="col-md-6 col-lg-8">
                    <div class="mb-3">
                        <label class="form-label">Nombre de la institución</label>
                        <p class="form-control border-0 px-0">{{ $institution->name }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Dirección</label>
                        <p class="form-control border-0 px-0">{{ $institution->direction }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo electrónico</label>
                        <p class="form-control border-0 px-0">{{ $institution->email ?? '-' }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        <p class="form-control border-0 px-0">{{ $institution->phone ?? '-' }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Celular</label>
                        <p class="form-control border-0 px-0">{{ $institution->cellphone ?? '-' }}</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="mb-3">
                        <label class="form-label">Logo</label>
                        @if($institution->logo)
                            <img class="img-fluid img-thumbnail d-block" src="{{ asset($institution->logo) }}" alt="{{ $institution->name }} Logo" />
                        @else
                            <p class="form-control border-0 px-0">Sin logo</p>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Fecha de creación</label>
                        <p class="form-control border-0 px-0">{{ date('l j F Y', strtotime($institution->created_at)) }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Estado</label>
                        <p class="form-control border-0 px-0 @if($institution->state) text-success @else text-danger @endif">
                            {{ $institution->state == '1' ? 'Activo' : 'Inactivo' }}
                        </p>
                    </div>
                </div>
            </div>
            <a href="{{ route('settings.institutions.index') }}" class="btn btn-secondary" type="button">Volver</a>
        </x-adminlte-card>
    </div>
@endsection
