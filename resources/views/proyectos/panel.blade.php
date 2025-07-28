@extends('layouts.app')


@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Panel de Proyectos</h1>

    <div class="mb-3">
    <a href="{{ route('proyectos.create') }}" class="btn btn-success">+ Crear nuevo proyecto</a>
    </div>

    <form action="{{ route('proyectos.buscar') }}" method="GET" class="row g-3 mb-4">
    <div class="col-auto">
        <input type="number" name="id" class="form-control" placeholder="Buscar proyecto por ID" required>
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </div>
</form>


    <table class="table table-hover table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Responsable</th>
                <th>Monto</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proyectos as $proyecto)
                <tr>
                    <td>{{ $proyecto->id }}</td>
                    <td>{{ $proyecto->nombre }}</td>
                    <td>
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

                    <span class="badge bg-{{ $color }}">
                        {{ $proyecto->estado }}
                    </span>
                </td>

                    <td>{{ $proyecto->responsable }}</td>
                    <td>${{ number_format($proyecto->monto, 0, ',', '.') }}</td>
                    <td class="text-center">
                        <a href="{{ route('proyectos.show', $proyecto->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('proyectos.edit', $proyecto->id) }}" class="btn btn-warning btn-sm">Editar</a>

                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{ $proyecto->id }}">
                            Borrar
                        </button>

                        <div class="modal fade" id="confirmDeleteModal{{ $proyecto->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $proyecto->id }}" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel{{ $proyecto->id }}">Confirmar Eliminación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                              </div>
                              <div class="modal-body">
                                ¿Estás seguro de que deseas eliminar el proyecto <strong>{{ $proyecto->nombre }}</strong>?
                              </div>
                              <div class="modal-footer">
                                <form action="{{ route('proyectos.destroy', $proyecto->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="alert alert-info d-flex justify-content-between align-items-center">
    <span><strong>Valor de la UF de hoy:</strong></span>
    <span>
        @if($uf)
            ${{ number_format($uf, 2, ',', '.') }}
        @else
            <span class="text-danger">No disponible</span>
        @endif
    </span>

</div>

</div>
@endsection
