@extends('layouts.app')

@section('title', config('app.name', 'Laravel').' | Niveles - Nivel '.$level->name.' '.$level->shift.' '.$level->period()->get('period')[0]->period)

@section('page')
    Nivel <span class="text-info">{{ $level->name.' '.$level->shift.' '.$level->period()->get('period')[0]->period }}</span>
@endsection

@section('main')
    <div class="row">
        <x-adminlte-card class="col-6" title="Datos registrados" theme="info" theme-mode="outline">
            <div class="mb-3">
                <label class="form-label">Gestión</label>
                <p class="form-control border-0 px-0">{{ $level->period()->get('period')[0]->period }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label">Nivel</label>
                <p class="form-control border-0 px-0">{{ $level->name }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label">Turno</label>
                <p class="form-control border-0 px-0">{{ $level->shift }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label">Fecha y hora de creación</label>
                <p class="form-control border-0 px-0">{{ date('l j F Y H:i:s', strtotime($level->created_at)) }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label">Estado</label>
                <p class="form-control border-0 px-0 @if($level->state) text-success @else text-danger @endif">
                    {{ $level->state == '1' ? 'Activo' : 'Inactivo' }}
                </p>
            </div>
            <a href="{{ route('levels.index') }}" class="btn btn-secondary" type="button">Volver</a>
        </x-adminlte-card>
    </div>
@endsection
