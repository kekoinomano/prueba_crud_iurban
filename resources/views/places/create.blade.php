@extends('layouts.app')
@section('title', 'Nuevo | Punto de interés')
@section('content')
    <div class="container">
        <h1 class="mb-4">Crear Punto</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('places.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group my-5">
                <label for="name">Nombre:</label>
                <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
            </div>
            <div class="form-group my-5">
                <label for="description">Descripción:</label>
                <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
            </div>
            <div class="form-group my-5">
                <label for="img">Imagen:</label>
                <input type="file" name="img" id="img" class="form-control-file">
            </div>
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>
    </div>
@endsection
