@extends('layouts.app')

@section('title', config('app.name', 'Laravel').' | Niveles - Crear nivel')

@section('page')
    Crear nuevo nivel
@endsection

@section('main')
    @php
        $options = [];
        foreach ($periods as $period) {
            $id = $period->id;
            $name = $period->period;
            $options[$id] = $name;
        }

        $levels = ['INICIAL' => 'INICIAL', 'PRIMARIA' => 'PRIMARIA', 'SECUNDARIA' => 'SECUNDARIA'];
        $shifts = ['MAÑANA' => 'MAÑANA', 'TARDE' => 'TARDE', 'NOCHE' => 'NOCHE'];
    @endphp

    <div class="row">
        <x-adminlte-card class="col-6" title="Llene los campos" theme="success" theme-mode="outline">
            <form action="{{ route('levels.store') }}" method="post">
                @csrf
                <x-adminlte-select name="period_id" required>
                    <x-adminlte-options :options="$options" placeholder="Seleccione una gestión..." selected="{{ old('period_id') }}" />
                    <x-slot name="appendSlot">
                        <a class="btn btn-success ml-2 rounded" href="{{ route('settings.periods.create') }}" title="Crear nueva gestión">
                            <i class="fas fa-plus"></i>
                        </a>
                    </x-slot>
                </x-adminlte-select>
                <x-adminlte-select name="name" required>
                    <x-adminlte-options :options="$levels" placeholder="Seleccione un nivel..." selected="{{ old('name') }}" />
                </x-adminlte-select>
                <x-adminlte-select name="shift" required>
                    <x-adminlte-options :options="$shifts" placeholder="Seleccione un turno..." selected="{{ old('shift') }}" />
                </x-adminlte-select>
                <x-adminlte-button label="Crear" theme="success" type="submit"/>
                <a href="{{ route('levels.index') }}" class="btn btn-secondary" type="button">Cancelar</a>
            </form>
        </x-adminlte-card>
    </div>
@endsection
