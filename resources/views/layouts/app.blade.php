@extends('adminlte::page')

@section('title')
    @yield('title', config('app.name', 'Laravel'))
@endsection

@section('content_header')
    <h1>@yield('page')</h1>
@stop

@section('content')
    @yield('main')
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
