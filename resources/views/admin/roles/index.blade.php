@extends('layouts.app')

@section('title', config('app.name', 'Laravel').' | Roles - Listado de roles')

@section('page')
    Listado de roles
@endsection

@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugins', true)
@section('plugins.Sweetalert2', true)

@section('main')
    @php
        $heads = [
            ['label' => 'Nro', 'no-export' => true, 'width' => 5],
            'Nombre del rol',
            ['label' => 'Acciones', 'no-export' => true, 'width' => 5],
        ];

        $config = [
            'data' => $data,
            'order' => [[1, 'asc']],
            'columns' => [['className' => 'text-center'], null, ['orderable' => false]],
            'language' => ['url' => '//cdn.datatables.net/plug-ins/2.0.3/i18n/es-ES.json'],
            'buttons' => [
                [
                    'extend' => 'collection',
                    'text' => 'Reportes',
                    'orientation' => 'landscape',
                    'className' => 'bg-primary border-primary',
                    'buttons' => [
                        [
                            'text' => 'Copiar',
                            'extend' => 'copy'
                        ],
                        ['extend' => 'pdf'],
                        ['extend' => 'csv'],
                        ['extend' => 'excel'],
                        [
                            'text' => 'Imprimir',
                            'extend' => 'print'
                        ]
                    ]
                ]
            ]
        ];
    @endphp

    <form id='delete-form' method='post'>
        @method('DELETE')
        @csrf
    </form>

    <x-adminlte-card title="Roles registrados" theme="primary" theme-mode="outline">
        <x-slot name="toolsSlot">
            <a href="{{ route('roles.create') }}" class="btn btn-sm btn-success" title="Crear">
                <i class="fa fa-sm fa-fw fa-plus"></i> Crear rol
            </a>
        </x-slot>
        <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" bordered hoverable compressed with-buttons />
    </x-adminlte-card>
@endsection

@push('js')
    <script>
        function answer(role, action) {
            Swal.fire({
                title: 'Eliminar rol',
                text: `¿Desea eliminar el rol '${role.name}'?`,
                icon: 'question',
                showDenyButton: true,
                confirmButtonText: 'Eliminar',
                confirmButtonColor: '#dc3545',
                denyButtonText: 'Cancelar',
                denyButtonColor: '#6c757d',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#delete-form').attr('action', action).submit()
                }
            });
        }
    </script>
@endpush
