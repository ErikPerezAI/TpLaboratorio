<!DOCTYPE html>
<html>
<head>
    <title>Gestión del Laboratorio</title>
</head>
<body>

<h1>Listado de Equipos</h1>

@forelse($equipos as $equipo)

    <hr>

    <p><strong>Nombre:</strong> {{ $equipo->nombre }}</p>

    <p><strong>Número de Serie:</strong> {{ $equipo->numero_serie }}</p>

    <p><strong>Descripción:</strong> {{ $equipo->descripcion }}</p>

@empty

    <p>No hay equipos registrados.</p>

@endforelse

<hr>

<h2>Agregar Equipo</h2>

<form action="{{ route('equipos.store') }}" method="POST">

    @csrf

    <label>Nombre</label>
    <br>
    <input type="text" name="nombre">
    <br><br>

    <label>Número de Serie</label>
    <br>
    <input type="text" name="numero_serie">
    <br><br>

    <label>Descripción</label>
    <br>
    <textarea name="descripcion"></textarea>
    <br><br>

    <button type="submit">
        Guardar Equipo
    </button>

</form>

</body>
</html>
