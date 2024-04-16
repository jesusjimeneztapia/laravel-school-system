@extends('layouts.app')

@section('title', config('app.name', 'Laravel').' | Listado de instituciones')

@section('page')
    Listado de instituciones
@endsection

@php
    $title = 'Instituciones registradas';
    $href = route('settings.institutions.create');
    $createLabel = 'Crear institución';
    $tableId = 'institutions-table';

    $heads = [
        ['label' => 'Nro', 'no-export' => true, 'width' => 5],
        'Nombre de la institución',
        'Logo',
        'Dirección',
        'Teléfono',
        'Celular',
        'Correo electrónico',
        'Fecha de creación',
        'Estado',
        ['label' => 'Acciones', 'no-export' => true, 'width' => 5],
    ];

    $columns = [
        ['className' => 'text-center'],
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        ['orderable' => false]
    ];

    $answer = ['title' => 'Eliminar institución', 'text' => 'Desea eliminar la institución'];
@endphp

@section('main')
    @include('components.table');
@endsection
