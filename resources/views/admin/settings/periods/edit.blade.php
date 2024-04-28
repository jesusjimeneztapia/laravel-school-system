@extends('layouts.app')

@section('title', config('app.name', 'Laravel').' | Gestiones - Editar gestión '.$period->period)

@section('page')
    Gestión <span class="text-warning">{{ $period->period }}</span>
@endsection

@php
    $options = ['1' => 'ACTIVO', '0' => 'INACTIVO'];
    $name = count($errors) > 0 ? old('period') ?? '' : $period->period;
    $selected = old('state') ?? $period->state;
@endphp

@section('main')
    <div class="row">
        <x-adminlte-card class="col-6" title="Edite los campos" theme="warning" theme-mode="outline">
            <form action="{{ route('settings.periods.update', $period) }}" method="post">
                @method('PUT')
                @csrf
                <x-adminlte-input name="period" type="text" placeholder="Gestión" value="{{ $name }}" required/>
                <x-adminlte-select name="state" required>
                    <x-adminlte-options :options="$options" placeholder="Seleccione un estado..." selected="{{ $selected }}" />
                </x-adminlte-select>
                <x-adminlte-button label="Guardar" theme="warning" type="submit"/>
                <a href="{{ route('settings.periods.index') }}" class="btn btn-secondary" type="button">Cancelar</a>
            </form>
        </x-adminlte-card>
    </div>
@endsection
