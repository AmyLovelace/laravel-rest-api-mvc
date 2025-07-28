@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Crear Proyecto</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('proyectos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}">
        </div>

        <div class="mb-3">
            <label>Fecha de inicio</label>
            <input type="date" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio') }}">
        </div>

        <div class="mb-3">
            <label>Estado</label>
        </div>
        <select name="estado" class="form-select">
            <option value="">-- Selecciona estado --</option>
            @foreach(\App\Models\Proyecto::ESTADOS as $estado)
                <option value="{{ $estado }}" {{ old('estado') == $estado ? 'selected' : '' }}>{{ $estado }}</option>
            @endforeach
        </select>



        <div class="mb-3">
            <label>Responsable</label>
            <input type="text" name="responsable" class="form-control" value="{{ old('responsable') }}">
        </div>

        <div class="mb-3">
            <label>Monto</label>
            <input type="number" name="monto" class="form-control" value="{{ old('monto') }}">
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('proyectos.panel') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '{{ session('success') }}',
            confirmButtonColor: '#3085d6'
        });
    </script>
@endif

@endsection
