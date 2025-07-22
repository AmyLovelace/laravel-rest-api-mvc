@extends('layouts.app')

@section('content')
    <h1>Lista de Proyectos</h1>

    @if(session('success'))
        <div style="color: green">{{ session('success') }}</div>
    @endif

    <ul>
        @foreach($proyectos as $proyecto)
            <li>{{ $proyecto->nombre }} - {{ $proyecto->estado }}</li>
        @endforeach
    </ul>

    <a href="{{ url('/proyectos/create') }}">Crear nuevo proyecto</a>
@endsection
