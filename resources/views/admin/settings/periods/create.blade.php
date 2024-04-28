@extends('layouts.app')

@section('title', config('app.name', 'Laravel').' | Gestiones - Crear gestión')

@section('page')
    Crear nueva gestión
@endsection

@php
    $options = ['1' => 'ACTIVO', '0' => 'INACTIVO'];
    $selected = old('state') ?? '1';
@endphp

@section('main')
    <div class="row">
        <x-adminlte-card class="col-6" title="Llene los campos" theme="success" theme-mode="outline">
            <form action="{{ route('settings.periods.store') }}" method="post">
                @csrf
                <x-adminlte-input name="period" type="text" placeholder="Gestión" value="{{ old('period') }}" autofocus required/>
                <x-adminlte-select name="state" required>
                    <x-adminlte-options :options="$options" placeholder="Seleccione un estado..." selected="{{ $selected }}" />
                </x-adminlte-select>
                <x-adminlte-button label="Crear" theme="success" type="submit"/>
                <a href="{{ route('settings.periods.index') }}" class="btn btn-secondary" type="button">Cancelar</a>
            </form>
        </x-adminlte-card>
    </div>
@endsection
