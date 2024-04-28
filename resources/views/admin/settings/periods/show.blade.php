@extends('layouts.app')

@section('title', config('app.name', 'Laravel').' | Gestiones - Gestión '.$period->period)

@section('page')
    Gestión <span class="text-info">{{ $period->period }}</span>
@endsection

@section('main')
    <div class="row">
        <x-adminlte-card class="col-6" title="Datos registrados" theme="info" theme-mode="outline">
            <div class="mb-3">
                <label class="form-label">Gestión</label>
                <p class="form-control border-0 px-0">{{ $period->period }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label">Fecha y hora de creación</label>
                <p class="form-control border-0 px-0">{{ date('l j F Y H:i:s', strtotime($period->created_at)) }}</p>
            </div>
            <div class="mb-3">
                <label class="form-label">Estado</label>
                <p class="form-control border-0 px-0 @if($period->state) text-success @else text-danger @endif">
                    {{ $period->state == '1' ? 'Activo' : 'Inactivo' }}
                </p>
            </div>
            <a href="{{ route('settings.periods.index') }}" class="btn btn-secondary" type="button">Volver</a>
        </x-adminlte-card>
    </div>
@endsection
