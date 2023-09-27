@extends('layouts.app')
@section('title', $place->name . " | Editar punto de interés")
@section('content')
<div class="container">
    <h2>Editar Punto</h2>
	@if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <form action="{{ route('places.update', $place->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nombre:</label>
            <input type="text" name="name" id="name" class="form-control" required value="{{ $place->name }}">
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Descripción:</label>
            <textarea name="description" id="description" class="form-control" required>{{ $place->description }}</textarea>
        </div>
        
        <div class="mb-3">
            <label for="img" class="form-label">Imagen:</label>
			<img width="100" src="{{ $place->img }}" alt="{{ $place->name }}" class="img-fluid mb-3">
            <input type="file" name="img" id="img" class="form-control">
        </div>
        
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
