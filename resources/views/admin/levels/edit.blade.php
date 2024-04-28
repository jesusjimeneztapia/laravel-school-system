@extends('layouts.app')

@section('title', config('app.name', 'Laravel').' | Niveles - Editar nivel '.$level->name.' '.$level->shift.' '.$level->period()->get('period')[0]->period)

@section('page')
    Nivel <span class="text-info">{{ $level->name.' '.$level->shift.' '.$level->period()->get('period')[0]->period }}</span>
@endsection

@php

    $options = [];
    foreach ($periods as $period) {
        $id = $period->id;
        $name = $period->period;
        $options[$id] = $name;
    }
    $levels = ['INICIAL' => 'INICIAL', 'PRIMARIA' => 'PRIMARIA', 'SECUNDARIA' => 'SECUNDARIA'];
    $shifts = ['MAÑANA' => 'MAÑANA', 'TARDE' => 'TARDE', 'NOCHE' => 'NOCHE'];

    $period_id = count($errors) > 0 ? old('period_id') ?? '' : $level->period_id;
    $name = count($errors) > 0 ? old('name') ?? '' : $level->name;
    $shift = count($errors) > 0 ? old('shift') ?? '' : $level->shift;
@endphp

@section('main')
    <div class="row">
        <x-adminlte-card class="col-6" title="Edite los campos" theme="warning" theme-mode="outline">
            <form action="{{ route('levels.update', $level) }}" method="post">
                @method('PUT')
                @csrf
                <x-adminlte-select name="period_id" required>
                    <x-adminlte-options :options="$options" placeholder="Seleccione una gestión..." selected="{{ $period_id }}" />
                    <x-slot name="appendSlot">
                        <a class="btn btn-success ml-2 rounded" href="{{ route('settings.periods.create') }}" title="Crear nueva gestión">
                            <i class="fas fa-plus"></i>
                        </a>
                    </x-slot>
                </x-adminlte-select>
                <x-adminlte-select name="name" required>
                    <x-adminlte-options :options="$levels" placeholder="Seleccione un nivel..." selected="{{ $name }}" />
                </x-adminlte-select>
                <x-adminlte-select name="shift" required>
                    <x-adminlte-options :options="$shifts" placeholder="Seleccione un turno..." selected="{{ $shift }}" />
                </x-adminlte-select>
                <x-adminlte-button label="Guardar" theme="warning" type="submit"/>
                <a href="{{ route('levels.index') }}" class="btn btn-secondary" type="button">Cancelar</a>
            </form>
        </x-adminlte-card>
    </div>
@endsection
