@extends('adminlte::page')

@section('title')
    @yield('title', config('app.name', 'Laravel'))
@endsection

@section('plugins.Toastr', true)

@if(session($key = config('constants.TOASTR')))
    @php
        $mode = session($key)[config('constants.TOASTR_MODE')];
        $message = session($key)[config('constants.TOASTR_MESSAGE')];
        $title = session($key)[config('constants.TOASTR_TITLE')];
    @endphp
    @push('js')
        <script>
            toastr["{{ $mode }}"]("{{ $message }}", "{{ $title }}")
        </script>
    @endpush
    @php
        session()->forget($key);
    @endphp
@endif

@section('content_header')
    <h1>@yield('page')</h1>
@stop

@section('content')
    @yield('main')
@stop
