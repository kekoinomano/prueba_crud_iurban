@extends('layouts.app')

@section('title', 'Puntos de Interés')

@section('content')
<div class="container">
    <h1>Puntos de Interés</h1>
	<!-- Mensaje de éxito -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('places.create') }}" class="btn btn-primary mb-3">Añadir punto de interés</a>
    
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($places as $place)
            <tr>
                <td><a href="{{ route('places.show', $place) }}">{{ $place->name }}</a></td>
                <td>{{ Str::limit($place->description, 50, '...') }}</td>
                <td><img src="{{ $place->img }}" alt="{{ $place->name }}" width="100"></td>
                <td>
                    <a href="{{ route('places.edit', $place) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                    <form action="{{ route('places.destroy', $place) }}" method="post" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    {{ $places->links() }} <!-- Paginación -->
</div>
@endsection
