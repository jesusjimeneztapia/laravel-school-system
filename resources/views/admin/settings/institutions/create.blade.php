@extends('layouts.app')

@section('title', config('app.name', 'Laravel').' | Instituciones - Crear institución')

@section('page')
    Crear nueva institución
@endsection

@section('main')
    <div class="row">
        <x-adminlte-card class="col-xl-8" title="Llene los campos" theme="success" theme-mode="outline">
            <form class="row" action="{{ route('settings.institutions.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="col-md-8">
                    <x-adminlte-input name="name" type="text" placeholder="Nombre de la institución" value="{{ old('name') }}" required/>
                    <x-adminlte-input name="email" type="email" placeholder="Correo electrónico de la institución" value="{{ old('email') }}"/>
                    <x-adminlte-input name="phone" type="number" placeholder="Teléfono" value="{{ old('phone') }}"/>
                    <x-adminlte-input name="cellphone" type="number" placeholder="Celular" value="{{ old('cellphone') }}"/>
                    <x-adminlte-input name="direction" type="text" placeholder="Dirección" value="{{ old('direction') }}" required/>
                </div>
                <div class="col-md-4">
                    <x-adminlte-input-file id="logo" name="logo" accept="image/*" legend="Navegar" placeholder="Seleccione una imagen..."/>
                    <output id="preview"></output>
                </div>
                <div class="col-12">
                    <x-adminlte-button label="Crear" theme="success" type="submit"/>
                    <a href="{{ route('settings.institutions.index') }}" class="btn btn-secondary" type="button">Cancelar</a>
                </div>
            </form>
        </x-adminlte-card>
    </div>
@endsection

@push('js')
    <script>
        function handleChange({ target: { files } }) {
            const image = files[0]
            if (image.type.match('image.*')) {
                const reader = new FileReader()
                reader.onload = ({ target: { result } }) => {
                    const preview = document.querySelector('output#preview')
                    preview.innerHTML = `<img class='img-thumbnail img-fluid mb-3' src='${result}' alt='${image.name}' title='${image.name}'/>`
                }
                reader.readAsDataURL(image)
            }
        }

        document.querySelector('input#logo').addEventListener('change', handleChange)
    </script>
@endpush
