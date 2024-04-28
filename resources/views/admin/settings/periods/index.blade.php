@extends('layouts.app')

@section('title', config('app.name', 'Laravel').' | Gestiones - Listado de gestiones')

@section('page')
    Listado de gestiones
@endsection

@php
    $title = 'Gestiones registradas';
    $href = route('settings.periods.create');
    $createLabel = 'Crear gestión';
    $tableId = 'periods-table';

    $heads = [
        ['label' => 'Nro', 'no-export' => true, 'width' => 5],
        'Gestión',
        'Fecha de creación',
        'Estado',
        ['label' => 'Acciones', 'no-export' => true, 'width' => 5],
    ];

    $columns = [['className' => 'text-center'], null, null, null, ['orderable' => false]];

    $answer = ['title' => 'Eliminar gestión', 'text' => 'Desea eliminar la gestión'];
@endphp

@section('main')
    @include('components.table')
@endsection
