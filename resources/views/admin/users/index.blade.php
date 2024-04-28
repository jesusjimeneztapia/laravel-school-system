@extends('layouts.app')

@section('title', config('app.name', 'Laravel').' | Usuarios - Listado de usuarios')

@section('page')
    Listado de usuarios
@endsection

@php
    $title = 'Usuarios registrados';
    $href = route('users.create');
    $createLabel = 'Crear usuario';
    $tableId = 'users-table';

    $heads = [
        ['label' => 'Nro', 'no-export' => true, 'width' => 5],
        'Nombre del usuario',
        'Rol',
        'Correo electrónico',
        'Fecha de creación',
        'Estado',
        ['label' => 'Acciones', 'no-export' => true, 'width' => 5],
    ];

    $columns = [['className' => 'text-center'], null, null, null, null, null, ['orderable' => false]];

    $answer = ['title' => 'Eliminar usuario', 'text' => 'Desea eliminar el usuario'];
@endphp

@section('main')
    @include('components.table')
@endsection
