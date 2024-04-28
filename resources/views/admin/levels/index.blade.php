@extends('layouts.app')

@section('title', config('app.name', 'Laravel').' | Niveles - Listado de niveles')

@section('page')
    Listado de niveles
@endsection

@php
    $title = 'Niveles registrados';
    $href = route('levels.create');
    $createLabel = 'Crear nivel';
    $tableId = 'levels-table';

    $heads = [
        ['label' => 'Nro', 'no-export' => true, 'width' => 5],
        'Gestión',
        'Nivel',
        'Turno',
        'Estado',
        ['label' => 'Acciones', 'no-export' => true, 'width' => 5],
    ];

    $columns = [['className' => 'text-center'], null, null, null, null, ['orderable' => false]];

    $answer = ['title' => 'Eliminar nivel', 'text' => 'Desea eliminar el nivel'];
@endphp

@section('main')
    @include('components.table')
@endsection
