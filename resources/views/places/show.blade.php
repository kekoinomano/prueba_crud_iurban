@extends('layouts.app')
@section('title', $place->name . " | Punto de interés")
@section('content')
<div class="container mt-5">
    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <!-- Imagen del punto de interés -->
        <img src="{{ $place->img }}" alt="{{ $place->name }}" class="card-img-top" style="max-height: 400px; object-fit: cover;">

        <!-- Contenido del punto de interés -->
        <div class="card-body">
            <h4 class="card-title">{{ $place->name }}</h4>
            <p class="card-text">{{ $place->description }}</p>

            <!-- Botones de acción -->
            <a href="{{ route('places.edit', $place) }}" class="btn btn-warning">Editar</a>
            <form action="{{ route('places.destroy', $place) }}" method="post" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
        </div>
    </div>
</div>
@endsection
