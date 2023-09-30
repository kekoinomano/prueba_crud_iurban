# iUrban CRUD Prueba Técnica

## 🚀 Instrucciones de Instalación

1. Instalamos dependencias
   ```bash
   composer install
   ```
   ```bash
   npm install
   ```
2. Copiamos el archivo .env.example
   ```bash
   cp .env.example .env
   ```
   Modificamos el nombre de la base de datos de nuestro archivo .env al nombre que hayamos creado.

3. Generamos la llave:
   ```bash
   php artisan key:generate
   ```
4. Generar el enlace simbólico para la carpeta `public`:
   ```bash
   php artisan storage:link
   ```

5. Ejecutar la migración:
   ```bash
   php artisan migrate
   ```

6. Levantar el servidor virtual:
   ```bash
   php artisan serve
   ```

## 🧪 Instrucciones para Tests

1. Ejecutar:
   ```bash
   php artisan test
   ```

## 🔧 Versiones utilizadas

- **Laravel Framework:** 8.83.27
- **PHP:** 8.0.6

## 📝 Comentarios adicionales

1. Dado que se pedía en el enunciado crear tanto una API Rest como las vistas con blade, he decidido crear un controlador diferente para cada caso, aunque ambos parten de un controlador base para repetir el menos código posible. Las rutas son las rutas por defecto de cualquier crud usando los archivos api.php y web.php
2. Opté por un diseño sencillo utilizando Bootstrap vía CDN, añadiéndolo directamente en el `<head>` del layout.
3. La tabla de la vista principal ha sido paginada con herramientas de Laravel. Por defecto, Laravel usa Tailwind para la paginación. Al usar Bootstrap en este proyecto, hay que indicar que se pagine con bootstrap en el archivo `AppServiceProvider`.
