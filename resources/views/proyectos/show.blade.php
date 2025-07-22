@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Detalle del Proyecto</h1>

    <div class="card">
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>ID:</strong> {{ $proyecto->id }}</li>
                <li class="list-group-item"><strong>Nombre:</strong> {{ $proyecto->nombre }}</li>
                <li class="list-group-item"><strong>Fecha de Inicio:</strong> {{ \Carbon\Carbon::parse($proyecto->fecha_inicio)->format('d/m/Y') }}</li>
                <li class="list-group-item">
                    <strong>Estado:</strong> 
                    @php
                        $colores = [
                            'Por hacer' => 'secondary',
                            'En análisis' => 'info',
                            'En planificación' => 'primary',
                            'En desarrollo' => 'warning',
                            'En pruebas' => 'light',
                            'En espera' => 'dark',
                            'Hecho' => 'success',
                            'Cancelado' => 'danger',
                        ];
                        $color = $colores[$proyecto->estado] ?? 'secondary';
                    @endphp
                    <span class="badge bg-{{ $color }}">{{ $proyecto->estado }}</span>
                </li>
                <li class="list-group-item"><strong>Responsable:</strong> {{ $proyecto->responsable }}</li>
                <li class="list-group-item"><strong>Monto:</strong> ${{ number_format($proyecto->monto, 0, ',', '.') }}</li>
            </ul>
        </div>
    </div>

    <div class="mt-4 d-flex gap-2">
        <a href="{{ route('proyectos.panel') }}" class="btn btn-secondary">← Volver al panel</a>
        <a href="{{ route('proyectos.edit', $proyecto->id) }}" class="btn btn-warning">✏️ Editar</a>
    </div>
</div>
@endsection
