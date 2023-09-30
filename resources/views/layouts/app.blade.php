<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi aplicación con Laravel')</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
	
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light px-5">
    <a class="navbar-brand ms-4" href="/">iUrban | Puntos de interés</a>
    <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('places.create') }}">Añadir Punto de Interés</a>
            </li>
            <!-- Puedes añadir más elementos al menú aquí -->
        </ul>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>
<!-- Footer -->
<footer class="py-3 mt-4">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
      <li class="nav-item"><a href="/" class="nav-link px-2 text-white">Inicio</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-white">Blog</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-white">Precios</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-white">FAQs</a></li>
      <li class="nav-item"><a href="#" class="nav-link px-2 text-white">Sobre Nosotros</a></li>
    </ul>
    <p class="text-center text-black">© 2023 iUrban, Inc</p>
  </footer>
<script src="{{ mix('js/app.js') }}"></script>

</body>
</html>
