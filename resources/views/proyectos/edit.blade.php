@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Editar Proyecto</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('proyectos.update', $proyecto->id) }}" method="POST" class="card card-body shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $proyecto->nombre) }}">
        </div>

        <div class="mb-3">
            <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ old('fecha_inicio', $proyecto->fecha_inicio) }}">
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select">
                @php
                    $estados = [
                        'Por hacer',
                        'En análisis',
                        'En planificación',
                        'En desarrollo',
                        'En pruebas',
                        'En espera',
                        'Hecho',
                        'Cancelado'
                    ];
                @endphp
                @foreach ($estados as $estado)
                    <option value="{{ $estado }}" {{ old('estado', $proyecto->estado) === $estado ? 'selected' : '' }}>{{ $estado }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="responsable" class="form-label">Responsable</label>
            <input type="text" name="responsable" id="responsable" class="form-control" value="{{ old('responsable', $proyecto->responsable) }}">
        </div>

        <div class="mb-3">
            <label for="monto" class="form-label">Monto</label>
            <input type="number" name="monto" id="monto" class="form-control" value="{{ old('monto', $proyecto->monto) }}">
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('proyectos.panel') }}" class="btn btn-secondary">← Volver al panel</a>
        </div>
    </form>
</div>

{{-- SweetAlert2 --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
