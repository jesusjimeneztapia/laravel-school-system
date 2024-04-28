@extends('layouts.app')

@section('page')
    {{ config('app.name', 'Laravel') }}
@endsection

@section('main')
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <x-adminlte-small-box
                title="{{ $roles }}"
                text="Roles registrados"
                icon="fa fa-fw fa-bookmark"
                theme="primary"
                url="{{ route('roles.index') }}"
                url-text="Más información"/>
        </div>
        <div class="col-md-6 col-xl-3">
            <x-adminlte-small-box
                title="{{ $users }}"
                text="Usuarios registrados"
                icon="fa fa-fw fa-users"
                theme="info"
                url="{{ route('users.index') }}"
                url-text="Más información"/>
        </div>
        <div class="col-md-6 col-xl-3">
            <x-adminlte-small-box
                title="{{ $levels }}"
                text="Niveles registrados"
                icon="fa fa-fw fa-chart-line"
                theme="success"
                url="{{ route('levels.index') }}"
                url-text="Más información"/>
        </div>
    </div>
@endsection
