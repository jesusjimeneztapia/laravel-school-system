@extends('layouts.app')

@section('title', config('app.name', 'Laravel').' | Roles - Listado de roles')

@section('page')
    Listado de roles
@endsection

@php
    $title = 'Roles registrados';
    $href = route('roles.create');
    $createLabel = 'Crear rol';
    $tableId = 'roles-table';

    $heads = [
        ['label' => 'Nro', 'no-export' => true, 'width' => 5],
        'Nombre del rol',
        ['label' => 'Acciones', 'no-export' => true, 'width' => 5],
    ];

    $columns = [['className' => 'text-center'], null, ['orderable' => false]];

    $answer = ['title' => 'Eliminar rol', 'text' => 'Desea eliminar el rol'];
@endphp

@section('main')
    @include('components.table')
@endsection
