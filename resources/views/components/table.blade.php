@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugins', true)
@section('plugins.Sweetalert2', true)

@php
    $config = [
        'data' => $data,
        'order' => $order ?? [[1, 'asc']],
        'columns' => $columns ?? [],
        'language' => ['url' => '//cdn.datatables.net/plug-ins/2.0.4/i18n/es-ES.json'],
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
            ],
            [
                'extend' => 'colvis',
                'text' => 'Visor de columnas'
            ]
        ]
    ];
@endphp

<form id='delete-form' method='post'>
    @method('DELETE')
    @csrf
</form>

<x-adminlte-card :title="$title" theme="primary" theme-mode="outline">
    <x-slot name="toolsSlot">
        <a href="{{ $href }}" class="btn btn-sm btn-success" title="Crear">
            <i class="fa fa-sm fa-fw fa-plus"></i>{{ $createLabel }}
        </a>
    </x-slot>
    <x-adminlte-datatable :id="$tableId" :heads="$heads" :config="$config" bordered hoverable compressed with-buttons />
</x-adminlte-card>

@push('js')
    <script>
        function answer(name, action) {
            Swal.fire({
                title: '{{ $answer['title'] }}',
                text: `¿{{ $answer['text'] }} '${name}'?`,
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
